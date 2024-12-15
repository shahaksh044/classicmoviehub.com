<?php
$morenews_featured_news_title = morenews_get_option('featured_post_carousel_section_title');
$widget_no_title_class = empty($morenews_featured_news_title) ? 'aft-featured-no-title' : '';
$morenews_category = morenews_get_option('select_featured_post_carousel_category');
$morenews_no_of_post = morenews_get_option('number_of_featured_gird');
$morenews_featured_posts = morenews_get_posts($morenews_no_of_post, $morenews_category);

$color_class = '';
if (absint($morenews_category) > 0) {
    $color_id = "category_color_" . $morenews_category;
    // retrieve the existing value(s) for this meta field. This returns an array
    $term_meta = get_option($color_id);
    $color_class = ($term_meta) ? $term_meta['color_class_term_meta'] : 'category-color-1';
}
?>

<div class="af-main-banner-categorized-posts express-carousel layout-2 morenews-customizer <?php echo esc_attr($widget_no_title_class)?>">
    <div class="section-wrapper">

            <?php if (!empty($morenews_featured_news_title)): ?>
                <?php morenews_render_section_title($morenews_featured_news_title, $color_class); ?>
            <?php endif; ?>

        <div class="slick-wrapper af-featured-post-carousel af-post-carousel clearfix af-cat-widget-carousel af-widget-carousel af-widget-body">
            <?php


            if ($morenews_featured_posts->have_posts()) :
                $morenews_count = 1;
                while ($morenews_featured_posts->have_posts()) :
                    $morenews_featured_posts->the_post();
                    global $post;

                    ?>
                    <div class="slick-item pad float-l af-sec-post">
                        <?php do_action('morenews_action_loop_grid', $post->ID, 'grid-design-texts-over-image'); ?>
                    </div>
                    <?php
                    $morenews_count++;
                endwhile;
                wp_reset_postdata();
                ?>
            <?php endif; ?>
        </div>
        <div class="af-widget-featured-post-carousel-navcontrols af-slick-navcontrols"></div>

    </div>
</div>
<!-- Editors Pick line END -->
