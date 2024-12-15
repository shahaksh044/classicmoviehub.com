<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package MoreNews
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function morenews_body_classes($classes)
{
    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    $first_post_full = morenews_get_option('archive_layout_first_post_full');
    if ($first_post_full) {
        $classes[] = 'archive-first-post-full';
    }


    $global_site_mode_setting = morenews_get_option('global_site_mode_setting');

    if (!empty($global_site_mode_setting)) {
        $classes[] = $global_site_mode_setting;
    }

    $secondary_color_mode = morenews_get_option('secondary_color_mode');
    if (!empty($secondary_color_mode)) {
        $classes[] = 'aft-secondary-' . $secondary_color_mode;
    }

    $header_layout = morenews_get_option('header_layout');
    if (!empty($header_layout)) {
        $classes[] = 'aft-' . $header_layout;
    }

    $select_header_image_mode = morenews_get_option('select_header_image_mode');
    if ($select_header_image_mode == 'full') {
        $classes[] = 'header-image-full';
    } else {
        $classes[] = 'header-image-default';
    }

    $remove_gaps = morenews_get_option('remove_gaps_between_thumbs');
    if ($remove_gaps) {
        $classes[] = 'aft-no-thumbs-gap';
    }

    $global_widget_title_border = morenews_get_option('global_widget_title_border');
    if (!empty($global_widget_title_border)) {
        $classes[] = $global_widget_title_border;
    }


    global $post;

    $global_layout = morenews_get_option('global_content_layout');
    if (!empty($global_layout)) {
        $classes[] = $global_layout;
    }


    $global_alignment = morenews_get_option('global_content_alignment');
    $page_layout = $global_alignment;
    $disable_class = '';
    $frontpage_content_status = morenews_get_option('frontpage_content_status');
    if (1 != $frontpage_content_status) {
        $disable_class = 'disable-default-home-content';
    }

    // Check if single.
    if ($post && is_singular()) {
        $post_options = get_post_meta($post->ID, 'morenews-meta-content-alignment', true);
        if (!empty($post_options)) {
            $page_layout = $post_options;
        } else {
            $page_layout = $global_alignment;
        }
    }

    // Check if single.
    if ($post && is_singular()) {
        $global_single_content_mode = morenews_get_option('global_single_content_mode');
        $post_single_content_mode = get_post_meta($post->ID, 'morenews-meta-content-mode', true);
        if (!empty($post_single_content_mode)) {
            $classes[] = $post_single_content_mode;
        } else {
            $classes[] = $global_single_content_mode;
        }
    }

    // Check if single.
    if ($post && is_singular()) {
        $single_post_title_view = morenews_get_option('single_post_title_view');
        $classes[] = 'single-post-title-' . $single_post_title_view;
    }


    if (is_front_page()) {
        $frontpage_layout = morenews_get_option('frontpage_content_alignment');
        if (!empty($frontpage_layout)) {
            $page_layout = $frontpage_layout;
        }
    }

    if (!is_front_page() && is_home()) {
        $page_layout = $global_alignment;
    }

    if ($page_layout == 'align-content-right') {
        if (is_front_page() && !is_home()) {
            if (is_active_sidebar('home-sidebar-widgets')) {
                $classes[] = 'align-content-right';
            } else {
                $classes[] = 'full-width-content';
            }
        } else {
            if (is_active_sidebar('sidebar-1')) {
                $classes[] = 'align-content-right';
            } else {
                $classes[] = 'full-width-content';
            }
        }
    } elseif ($page_layout == 'full-width-content') {
        $classes[] = 'full-width-content';
    } else {
        if (is_front_page() && !is_home()) {
            if (is_active_sidebar('home-sidebar-widgets')) {
                $classes[] = 'align-content-left';
            } else {
                $classes[] = 'full-width-content';
            }
        } else {
            if (is_active_sidebar('sidebar-1')) {
                $classes[] = 'align-content-left';
            } else {
                $classes[] = 'full-width-content';
            }
        }
    }


    $banner_layout = morenews_get_option('global_site_layout_setting');

    if ($banner_layout == 'wide') {
        $classes[] = 'af-wide-layout';
    } elseif ($banner_layout == 'full') {
        $classes[] = 'af-full-layout';
    } else {
        $classes[] = 'af-boxed-layout';

        $global_topbottom_gaps = morenews_get_option('global_site_layout_topbottom_gaps');
        if ($global_topbottom_gaps) {
            $classes[] = 'aft-enable-top-bottom-gaps';
        }
    }


    return $classes;
}

add_filter('body_class', 'morenews_body_classes');


function morenews_is_elementor()
{
    global $post;
    return \Elementor\Plugin::$instance->db->is_built_with_elementor($post->ID);
}

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function morenews_pingback_header()
{
    if (is_singular() && pings_open()) {
        echo '<link rel="pingback" href="', esc_url(get_bloginfo('pingback_url')), '">';
    }
}

add_action('wp_head', 'morenews_pingback_header');


/**
 * Returns posts.
 *
 * @since MoreNews 1.0.0
 */
if (!function_exists('morenews_get_posts')) :
    function morenews_get_posts($number_of_posts, $tax_id = '0', $filterby = 'cat')
    {

        $ins_args = array(
            'post_type' => 'post',
            'posts_per_page' => absint($number_of_posts),
            'post_status' => 'publish',
            'order' => 'DESC',
            'ignore_sticky_posts' => true
        );

        $tax_id = isset($tax_id) && !empty($tax_id) ? absint($tax_id) : 0;
        // var_dump($tax_id);

        if ((absint($tax_id) > 0) && ($filterby == 'tag')) {
            $ins_args['tag_id'] = absint($tax_id);
            $ins_args['orderby'] = 'date';
        } elseif (($filterby == 'view')) {
            $ins_args['orderby'] = 'meta_value_num';
            $ins_args['meta_key'] = 'af_post_views_count';
        } elseif (($filterby == 'comment')) {
            $ins_args['orderby'] = 'comment_count';
        } elseif ((absint($tax_id) > 0) && ($filterby == 'cat')) {
            $ins_args['cat'] = absint($tax_id);
            $ins_args['orderby'] = 'date';
        } else {
            $ins_args['orderby'] = 'date';
        }

        $all_posts = new WP_Query($ins_args);

        return $all_posts;
    }

endif;


/**
 * Returns no image url.
 *
 * @since  MoreNews 1.0.0
 */
if (!function_exists('morenews_post_format')) :
    function morenews_post_format($post_id)
    {
        $post_format = get_post_format($post_id);
        switch ($post_format) {
            case "image":
                $post_format = "<div class='af-post-format em-post-format'><i class='fas fa-image'></i></div>";
                break;
            case "video":
                $post_format = "<div class='af-post-format em-post-format'><i class='fas fa-play'></i></div>";

                break;
            case "gallery":
                $post_format = "<div class='af-post-format em-post-format'><i class='fas fa-images'></i></div>";
                break;
            default:
                $post_format = "";
        }

        echo wp_kses_post($post_format);
    }

endif;


if (!function_exists('morenews_get_block')) :
    /**
     *
     * @param null
     *
     * @return null
     *
     * @since MoreNews 1.0.0
     *
     */
    function morenews_get_block($block = 'grid', $section = 'post')
    {

        get_template_part('inc/hooks/blocks/block-' . $section, $block);
    }
endif;

if (!function_exists('morenews_archive_title')) :
    /**
     *
     * @param null
     *
     * @return null
     *
     * @since MoreNews 1.0.0
     *
     */

    function morenews_archive_title($title)
    {
        if (is_category()) {
            $title = single_cat_title('', false);
        } elseif (is_tag()) {
            $title = single_tag_title('', false);
        } elseif (is_author()) {
            $title = '<span class="vcard">' . get_the_author() . '</span>';
        } elseif (is_post_type_archive()) {
            $title = post_type_archive_title('', false);
        } elseif (is_tax()) {
            $title = single_term_title('', false);
        }

        return $title;
    }

endif;
add_filter('get_the_archive_title', 'morenews_archive_title');


/* Display Breadcrumbs */
if (!function_exists('morenews_get_breadcrumb')) :

    /**
     * Simple breadcrumb.
     *
     * @since 1.0.0
     */
    function morenews_get_breadcrumb()
    {

        $enable_breadcrumbs = morenews_get_option('enable_breadcrumb');

        if (1 != $enable_breadcrumbs) {
            return;
        }
        // Bail if Home Page.
        if (is_front_page() || is_home()) {
            return;
        }

        $select_breadcrumbs = morenews_get_option('select_breadcrumb_mode');

?>
        <div class="af-breadcrumbs font-family-1 color-pad">

            <?php
            if ((function_exists('yoast_breadcrumb')) && ($select_breadcrumbs == 'yoast')) {
                yoast_breadcrumb();
            } elseif ((function_exists('rank_math_the_breadcrumbs')) && ($select_breadcrumbs == 'rankmath')) {
                rank_math_the_breadcrumbs();
            } elseif ((function_exists('bcn_display')) && ($select_breadcrumbs == 'bcn')) {
                bcn_display();
            } else {
                morenews_get_breadcrumb_trail();
            }
            ?>

        </div>
        <?php


    }

endif;
add_action('morenews_action_get_breadcrumb', 'morenews_get_breadcrumb');

/* Display Breadcrumbs */
if (!function_exists('morenews_get_breadcrumb_trail')) :

    /**
     * Simple excerpt length.
     *
     * @since 1.0.0
     */

    function morenews_get_breadcrumb_trail()
    {

        if (!function_exists('breadcrumb_trail')) {

            /**
             * Load libraries.
             */

            require_once get_template_directory() . '/lib/breadcrumb-trail/breadcrumb-trail.php';
        }

        $breadcrumb_args = array(
            'container' => 'div',
            'show_browse' => false,
        );

        breadcrumb_trail($breadcrumb_args);
    }

endif;


/**
 * Front-page main banner section layout
 */
if (!function_exists('morenews_front_page_main_section_scope')) {

    function morenews_front_page_main_section_scope()
    {

        $morenews_hide_on_blog = morenews_get_option('disable_main_banner_on_blog_archive');

        if ($morenews_hide_on_blog) {
            if (is_front_page()) {
                do_action('morenews_action_front_page_main_section');
            }
        } else {
            if (is_front_page() || is_home()) {
                do_action('morenews_action_front_page_main_section');
            }
        }
    }
}
add_action('morenews_action_front_page_main_section_scope', 'morenews_front_page_main_section_scope');


/* Display Breadcrumbs */
if (!function_exists('morenews_excerpt_length')) :

    /**
     * Simple excerpt length.
     *
     * @since 1.0.0
     */

    function morenews_excerpt_length($length)
    {

        $morenews_global_excerpt_length = morenews_get_option('global_excerpt_length');
        if (is_admin()) {
            return $length;
        }
        return $morenews_global_excerpt_length;
    }

endif;
add_filter('excerpt_length', 'morenews_excerpt_length', 999);


/* Display Breadcrumbs */
if (!function_exists('morenews_excerpt_more')) :

    /**
     * Simple excerpt more.
     *
     * @since 1.0.0
     */
    function morenews_excerpt_more($more)
    {
        if (is_admin()) {
            return $more;
        }
        global $post;
        $morenews_global_read_more_texts = morenews_get_option('global_read_more_texts');
        //return $morenews_global_read_more_texts;
        return '';
    }

endif;
add_filter('excerpt_more', 'morenews_excerpt_more');


/* Display Breadcrumbs */
if (!function_exists('morenews_get_the_excerpt')) :

    /**
     * Simple excerpt more.
     *
     * @since 1.0.0
     */
    function morenews_get_the_excerpt($post_id)
    {


        if (empty($post_id))
            return;

        $morenews_default_excerpt = get_the_excerpt($post_id);
        $morenews_global_read_more_texts = morenews_get_option('global_read_more_texts');

        $morenews_read_more = '<div class="aft-readmore-wrapper"><a href="' . get_permalink($post_id) . '" class="aft-readmore" aria-label="' . the_title() . '">' . $morenews_global_read_more_texts . '</a></div>';

        $morenews_global_excerpt_length = morenews_get_option('global_excerpt_length');
        $excerpt = explode(' ', $morenews_default_excerpt, $morenews_global_excerpt_length);
        if (count($excerpt) >= $morenews_global_excerpt_length) {
            array_pop($excerpt);
            $excerpt = implode(" ", $excerpt) . '...';
        } else {
            $excerpt = implode(" ", $excerpt);
        }
        $excerpt = preg_replace('`[[^]]*]`', '', $excerpt);
        $excerpt = $excerpt . $morenews_read_more;
        return $excerpt;
    }

endif;


/* Display Pagination */
if (!function_exists('morenews_numeric_pagination')) :

    /**
     * Simple excerpt more.
     *
     * @since 1.0.0
     */
    function morenews_numeric_pagination()
    {

        $morenews_pagination_type = morenews_get_option('archive_pagination_view');
        switch ($morenews_pagination_type) {
            case 'archive-default':
                the_posts_pagination(array(
                    'mid_size' => 3,
                    'prev_text' => __('Previous', 'morenews'),
                    'next_text' => __('Next', 'morenews'),
                ));
                break;

            case 'archive-ajax-loadmore':
        ?>
                <div class="morenews-ajax-pagination">
                    <?php morenews_ajax_pagination('click'); ?>
                </div>
            <?php
                break;
            case 'archive-infinite-scroll':
            ?>
                <div class="morenews-ajax-pagination">
                    <?php morenews_ajax_pagination('scroll'); ?>
                </div>
    <?php
                break;
            default:
                break;
        }

        return;
    }

endif;


/* Word read count Pagination */
if (!function_exists('morenews_count_content_words')) :
    /**
     * @param $content
     *
     * @return string
     */
    function morenews_count_content_words($post_id)
    {
        $morenews_show_read_mins = morenews_get_option('global_show_min_read');
        if ($morenews_show_read_mins == 'yes') {
            $content = apply_filters('the_content', get_post_field('post_content', $post_id));
            $morenews_read_words = morenews_get_option('global_show_min_read_number');
            $morenews_decode_content = html_entity_decode($content);
            $morenews_filter_shortcode = do_shortcode($morenews_decode_content);
            $morenews_strip_tags = wp_strip_all_tags($morenews_filter_shortcode, true);
            $morenews_count = str_word_count($morenews_strip_tags);
            $morenews_word_per_min = (absint($morenews_count) / $morenews_read_words);
            $morenews_word_per_min = ceil($morenews_word_per_min);

            if (absint($morenews_word_per_min) > 0) {
                $word_count_strings = sprintf(__("%s min read", 'morenews'), number_format_i18n($morenews_word_per_min));
                if ('post' == get_post_type($post_id)) :
                    echo '<span class="min-read">';
                    echo esc_html($word_count_strings);
                    echo '</span>';
                endif;
            }
        }
    }

endif;


/**
 * Check if given term has child terms
 *
 * @param Integer $term_id
 * @param String $taxonomy
 *
 * @return Boolean
 */
function morenews_list_popular_taxonomies($taxonomy = 'post_tag', $title = "Popular Tags", $number = 5)
{
    $popular_taxonomies = get_terms(array(
        'taxonomy' => $taxonomy,
        'number' => absint($number),
        'orderby' => 'count',
        'order' => 'DESC',
        'hide_empty' => true,
    ));

    $html = '';

    if (isset($popular_taxonomies) && !empty($popular_taxonomies)) :
        $html .= '<div class="aft-popular-taxonomies-lists clearfix">';
        if (!empty($title)) :
            $html .= '<span>';
            $html .= esc_html($title);
            $html .= '</span>';
        endif;
        $html .= '<ul>';
        foreach ($popular_taxonomies as $tax_term) :
            $html .= '<li>';
            $html .= '<a href="' . esc_url(get_term_link($tax_term)) . '">';
            $html .= $tax_term->name;
            $html .= '</a>';
            $html .= '</li>';
        endforeach;
        $html .= '</ul>';
        $html .= '</div>';
    endif;

    echo wp_kses_post($html);
}


/**
 * @param $post_id
 * @param string $size
 *
 * @return mixed|string
 */
function morenews_get_freatured_image_url($post_id, $size = 'morenews-featured')
{
    $url = '';
    if (has_post_thumbnail($post_id)) {
        $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), $size);
        if (isset($thumb)) {
            $url = $thumb['0'];
        }
    } else {
        $url = '';
    }

    return $url;
}


//Get attachment alt tag

if (!function_exists('morenews_get_img_alt')) :
    function morenews_get_img_alt($attachment_ID)
    {
        // Get ALT
        $thumb_alt = get_post_meta($attachment_ID, '_wp_attachment_image_alt', true);

        // No ALT supplied get attachment info
        if (empty($thumb_alt))
            $attachment = get_post($attachment_ID);

        // Use caption if no ALT supplied
        if (empty($thumb_alt))
            $thumb_alt = $attachment->post_excerpt;

        // Use title if no caption supplied either
        if (empty($thumb_alt))
            $thumb_alt = $attachment->post_title;

        // Return ALT
        return trim(strip_tags($thumb_alt));
    }
endif;

// Move Jetpack from the_content / the_excerpt to another position

function morenews_jptweak_remove_share()
{
    if (is_singular('post')) {
        remove_filter('the_content', 'sharing_display', 19);
        remove_filter('the_excerpt', 'sharing_display', 19);
    }
}

add_action('loop_start', 'morenews_jptweak_remove_share');


/**
 * @param $post_id
 */
function morenews_get_comments_views_share($post_id)
{

    $aft_post_type = get_post_type($post_id);

    if ($aft_post_type !== 'post') {
        return;
    }

    ?>
    <span class="aft-comment-view-share">
        <?php
        $show_comment_count = $section_mode = morenews_get_option('global_show_comment_count');
        if ($show_comment_count == 'yes') :
            $comment_count = get_comments_number($post_id);
            if (absint($comment_count) > 1) :
        ?>
                <span class="aft-comment-count">
                    <a href="<?php the_permalink(); ?>">
                        <i class="far fa-comment"></i>
                        <span class="aft-show-hover">
                            <?php echo wp_kses_post(get_comments_number($post_id)); ?>
                        </span>
                    </a>
                </span>
            <?php endif;
        endif;

        $show_view_count = $section_mode = morenews_get_option('global_show_view_count');
        if ($show_view_count == 'yes') :
            ?>
            <span class="aft-view-count">
                <a href="<?php the_permalink(); ?>">
                    <i class="far fa-eye"></i>
                    <span class="aft-show-hover">
                        <?php echo wp_kses_post(morenews_get_post_views($post_id)); ?>
                    </span>
                </a>
            </span>

        <?php endif;
        ?>
    </span>
    <?php
}


/**
 * @param $post_id
 */
function morenews_archive_social_share_icons($post_id)
{
    if (class_exists('Jetpack') && Jetpack::is_module_active('sharedaddy')) :
        if (function_exists('sharing_display')) :
            $sharer = new Sharing_Service();
            $global = $sharer->get_global_options();
            if (in_array('index', $global['show']) && (is_home() || is_front_page() || is_archive() || is_search() || in_array(get_post_type(), $global['show']))) :
    ?>
                <div class="aft-comment-view-share">
                    <span class="aft-jpshare">
                        <i class="fa fa-share-alt" aria-hidden="true"></i>
                        <?php sharing_display('', true); ?>
                    </span>
                </div>
        <?php
            endif;
        endif;
    endif;
}

//Social share icons and comments view for single page

function morenews_single_post_social_share_icons()
{
    if (class_exists('Jetpack') && Jetpack::is_module_active('sharedaddy')) :

        $social_share_icon_opt = morenews_get_option('single_post_social_share_view');

        if ($social_share_icon_opt == 'side') {
            echo '<div class="vertical-left-right">';
        }
        ?>
        <div class="aft-social-share">
            <?php
            if (function_exists('sharing_display')) {
                sharing_display('', true);
            }
            ?>

        </div>
    <?php
        if ($social_share_icon_opt == 'side') {
            echo '</div>';
        }
    endif;
}

function morenews_single_post_commtents_view($post_id)
{
    ?>
    <div class="aft-comment-view-share">
        <?php
        $show_comment_count = $section_mode = morenews_get_option('global_show_comment_count');
        if ($show_comment_count == 'yes') :
            $comment_count = get_comments_number($post_id);
            if (absint($comment_count) > 1) :
        ?>
                <span class="aft-comment-count">
                    <a href="<?php the_permalink(); ?>">
                        <i class="far fa-comment"></i>
                        <span class="aft-show-hover">
                            <?php echo esc_html(get_comments_number($post_id)); ?>
                        </span>
                    </a>
                </span>
            <?php endif;
        endif;

        $show_view_count = $section_mode = morenews_get_option('global_show_view_count');
        if ($show_view_count == 'yes') :
            ?>
            <span class="aft-view-count">
                <a href="<?php the_permalink(); ?>">
                    <i class="far fa-eye"></i>
                    <span class="aft-show-hover">
                        <?php echo esc_html(morenews_get_post_views($post_id)); ?>
                    </span>
                </a>
            </span>
        <?php endif;
        ?>
    </div>
<?php
}


/*
 * Enqueue and localization for pagination js
 *
 */
if (!function_exists('morenews_pagination_scripts_args')) :
    function morenews_pagination_scripts_args()
    {


        //Ajax load
        $args['nonce'] = wp_create_nonce('morenews-load-more-nonce');
        $args['ajaxurl'] = admin_url('admin-ajax.php');
        $view_count_onscroll = morenews_get_option('single_post_view_count');
        if ($view_count_onscroll == 'count-content-scroll') {
            $args['view_count'] = true;
        } else {
            $args['view_count'] = false;
        }


        if (is_front_page()) {
            $args['post_type'] = 'post';
        }

        //Custom post types
        if (is_post_type_archive()) {
            $args['post_type'] = get_queried_object()->name;
        }

        //Search
        if (is_search()) {
            $args['search'] = get_search_query();
        }


        //Author
        if (is_author()) {
            $args['author'] = get_the_author_meta('user_nicename');
        }


        //Date archive
        if (is_date()) {
            $args['year'] = get_query_var('year');
            $args['month'] = get_query_var('monthnum');
            $args['day'] = get_query_var('day');
        }

        /*
         *  Categories and taxonomies
         *  Get the affiliated post type for custom taxonomy
         */

        if (is_category() || is_tag() || is_tax()) {
            $args['cat'] = get_queried_object()->slug;
            $args['taxonomy'] = get_queried_object()->taxonomy;
            if (is_tax()) {
                global $wp_taxonomies;
                $tax_object = isset($wp_taxonomies[$args['taxonomy']]) ? $wp_taxonomies[$args['taxonomy']]->object_type : array();
                $args['post_type'] = array_pop($tax_object);
            }
        }

        return $args;
    }
endif;


// function to display number of posts.
if (!function_exists('morenews_get_post_views')) :
    function morenews_get_post_views($postID)
    {
        $morenews_count_key = 'af_post_views_count';
        $morenews_count = get_post_meta($postID, $morenews_count_key, true);
        if ($morenews_count == '') {
            delete_post_meta($postID, $morenews_count_key);
            add_post_meta($postID, $morenews_count_key, '0');
            return "0";
        }
        return $morenews_count;
    }
endif;

add_action('template_redirect', 'morenews_af_post_view_count');
if (!function_exists('morenews_af_post_view_count')) :

    function morenews_af_post_view_count()
    {
        if (is_single()) {

            $morenews_count_option = morenews_get_option('single_post_view_count');


            global $post;
            $postID = $post->ID;
            $morenews_count_key = 'af_post_views_count';
            $morenews_count = get_post_meta($postID, $morenews_count_key, true);
            if ($morenews_count == '') {
                $morenews_count = 0;
                delete_post_meta($postID, $morenews_count_key);
                add_post_meta($postID, $morenews_count_key, '0');
            } else {
                if ($morenews_count_option == 'each-load-default' && $morenews_count_option != 'count-content-scroll') {

                    $morenews_count++;
                    update_post_meta($postID, $morenews_count_key, $morenews_count);
                }
            }
        }
    }
endif;


add_action('wp_ajax_morenews_ajax_post_view_count', 'morenews_ajax_post_view_count');
add_action('wp_ajax_nopriv_morenews_ajax_post_view_count', 'morenews_ajax_post_view_count');

function morenews_ajax_post_view_count()
{
    $view_count_onscroll = morenews_get_option('single_post_view_count');
    if ($view_count_onscroll == 'count-content-scroll') {

        check_ajax_referer('morenews-load-more-nonce', 'nonce');

        if (isset($_GET['post_id'])) {
            $postID = sanitize_text_field(wp_unslash($_GET['post_id']));
            $morenews_count_key = 'af_post_views_count';
            $morenews_count = get_post_meta($postID, $morenews_count_key, true);

            if ($morenews_count == '') {
                $morenews_count = 0;
                delete_post_meta($postID, $morenews_count_key);
                add_post_meta($postID, $morenews_count_key, '0');
            } else {

                $morenews_count++;
                update_post_meta($postID, $morenews_count_key, $morenews_count);
                echo 'count_added';
            }
        }

        exit;
    }
}


function morenews_tone_filter_default_theme_options($defaults)
{

    // $global_site_layout_tone = morenews_get_option('global_site_layout_tone');
    $global_site_layout_tone = get_theme_mod('global_site_layout_tone', 'default'); 

    if ($global_site_layout_tone == 'centralnews') {
        $defaults['site_title_font_size'] = 72;
        $defaults['site_title_uppercase']  = 0;
        $defaults['disable_header_image_tint_overlay']  = 1;
        $defaults['show_primary_menu_desc']  = 0;
        $defaults['header_layout'] = 'header-layout-centered';
        $defaults['aft_custom_title']           = __('Video', 'morenews');
        $defaults['secondary_color'] = '#BF0A30';
        $defaults['global_show_min_read'] = 'no';
        $defaults['frontpage_content_type']  = 'frontpage-widgets-and-content';
        $defaults['featured_news_section_title'] = __('Featured', 'morenews');
        $defaults['show_featured_post_list_section']  = 1;
        $defaults['featured_post_list_section_title_1']           = __('General', 'morenews');
        $defaults['featured_post_list_section_title_2']           = __('Update', 'morenews');
        $defaults['featured_post_list_section_title_3']           = __('More', 'morenews');
        $defaults['main_navigation_custom_background_color']     = '#BF0A30';
        $defaults['main_navigation_badge_background']     = '#002868 ';
        $defaults['watch_online_background']    = '#002868 ';
        $defaults['breaking_news_background']   = '#002868 ';
        $defaults['category_color_1']    = '#002868 ';
        $defaults['category_color_2']    = '#BF0A30';
        
    }

    if ($global_site_layout_tone == 'globalnews') {
        $defaults['global_site_mode_setting']    = 'aft-dark-mode';
        $defaults['site_default_post_box_color']    = '#222222';
        $defaults['primary_color']    = '#e0e0e0';
        $defaults['dark_background_color']     = '#1A1A1A';
        $defaults['site_title_font_size'] = 64;
        $defaults['site_title_uppercase']  = 0;
        $defaults['disable_header_image_tint_overlay']  = 1;
        $defaults['show_primary_menu_desc']  = 0;
        $defaults['header_layout'] = 'header-layout-centered';
        $defaults['flash_news_title'] = __('Breaking News', 'morenews');
        $defaults['aft_custom_title']           = __('Watch Video', 'morenews');
        $defaults['main_popular_news_section_title'] = __('Popular News', 'morenews');
        $defaults['main_latest_news_section_title'] = __('Latest News', 'morenews');
        $defaults['secondary_color'] = '#ff0000';
        $defaults['global_fetch_content_image_setting'] = 'disable';
        $defaults['global_show_min_read'] = 'no';
        $defaults['frontpage_content_type']  = 'frontpage-widgets-and-content';
        $defaults['featured_news_section_title'] = __('Featured News', 'morenews');
        $defaults['show_featured_post_list_section'] = 1;
        $defaults['featured_post_list_section_title_1']           = __('General News', 'morenews');
        $defaults['featured_post_list_section_title_2']           = __('Central News', 'morenews');
        $defaults['featured_post_list_section_title_3']           = __('More News', 'morenews');
        $defaults['main_navigation_custom_background_color']     = '#af0700';
        $defaults['main_navigation_badge_background']     = '#333333 ';
        $defaults['watch_online_background']    = '#333333 ';
        $defaults['breaking_news_background']   = '#af0700 ';
        $defaults['category_color_1']    = '#af0700 ';
        $defaults['category_color_2']    = '#007ACC';
        $defaults['category_color_3']    = '#333333';
    }

    if ($global_site_layout_tone == 'newsmore') {

        $defaults['site_title_font_size'] = 80;
        $defaults['site_title_uppercase']  = 0;
        $defaults['show_primary_menu_desc']  = 0;
        $defaults['header_layout'] = 'header-layout-centered';
        $defaults['disable_header_image_tint_overlay']  = 1;
        $defaults['flash_news_title'] = __('Breaking News', 'morenews');
        $defaults['aft_custom_title']           = __('Watch', 'morenews');
        $defaults['select_main_banner_layout_section'] = 'layout-1';
        $defaults['select_main_banner_order'] = 'order-3';
        $defaults['global_fetch_content_image_setting'] = 'disable';
        $defaults['secondary_color'] = '#002868';
        $defaults['global_show_min_read'] = 'no';
        $defaults['frontpage_content_type']  = 'frontpage-widgets-and-content';
        $defaults['featured_news_section_title'] = __('Featured', 'morenews');
        $defaults['show_featured_post_list_section']  = 1;
        $defaults['featured_post_list_section_title_1']           = __('General', 'morenews');
        $defaults['featured_post_list_section_title_2']           = __('Update', 'morenews');
        $defaults['featured_post_list_section_title_3']           = __('More', 'morenews');
        $defaults['main_navigation_custom_background_color']     = '#002868';
        $defaults['main_navigation_badge_background']     = '#BF0A30 ';
        $defaults['watch_online_background']    = '#BF0A30 ';
        $defaults['breaking_news_background']   = '#BF0A30 ';
        $defaults['category_color_1']    = '#BF0A30 ';
        $defaults['category_color_2']    = '#002868';
        // $defaults['category_color_3']    = '#333333';
    }

    if ($global_site_layout_tone == 'generalnews') {
        $defaults['site_title_font_size'] = 56;
        $defaults['site_title_font']   = 'Source+Sans+Pro:400,400i,700,700i';
        $defaults['primary_font']      = 'Lato:400,300,400italic,900,700';
        $defaults['secondary_font']    = 'Source+Sans+Pro:400,400i,700,700i';
        $defaults['secondary_color'] = '#bb1919';
        $defaults['select_main_banner_layout_section'] = 'layout-1';
        $defaults['site_title_uppercase']  = 0;
        $defaults['show_watch_online_section']  = 0;
        $defaults['aft_custom_title']           = __('Watch Videos', 'morenews');
        // $defaults['main_navigation_custom_background_color']     = '#002868';
        $defaults['main_navigation_badge_background']     = '#bb1919 ';
        // $defaults['watch_online_background']    = '#BF0A30 ';
        $defaults['breaking_news_background']   = '#bb1919 ';
        $defaults['category_color_1']    = '#bb1919 ';
        $defaults['category_color_2']    = '#0098fe';
        $defaults['category_color_3']    = '#353535';
    }

    if ($global_site_layout_tone == 'moremag') {
        $defaults['site_title_font_size'] = 56;
        $defaults['secondary_color'] = '#0c794f';
        $defaults['select_main_banner_layout_section'] = 'layout-5';
        $defaults['site_title_uppercase']  = 0;
        $defaults['flash_news_title']  = __('Breaking News', 'morenews');
        $defaults['show_watch_online_section']  = 0;
        $defaults['global_show_min_read'] = 'no';
        $defaults['aft_custom_title']  = __('Subscribe', 'morenews');
        $defaults['main_latest_news_section_title']  = __("Editor's Picks", 'morenews');
        $defaults['main_popular_news_section_title']  = __('Trending Now', 'morenews');
        $defaults['frontpage_content_type']  = 'frontpage-widgets-and-content';
        $defaults['main_navigation_custom_background_color']     = '#095437';
        $defaults['main_navigation_badge_background']     = '#d72924 ';
        // $defaults['watch_online_background']    = '#BF0A30 ';
        $defaults['breaking_news_background']   = '#095437 ';
        $defaults['category_color_1']    = '#0c794f ';
        // $defaults['category_color_2']    = '#0098fe';
        // $defaults['category_color_3']    = '#353535';
    }

    return $defaults;
}
add_filter('morenews_filter_default_theme_options', 'morenews_tone_filter_default_theme_options');
