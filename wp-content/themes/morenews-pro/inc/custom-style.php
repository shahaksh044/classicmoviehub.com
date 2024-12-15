<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}


/**
 * Customizer
 *
 * @class   morenews
 */

if (!function_exists('morenews_custom_style')) {

    function morenews_custom_style()
    {

        global $morenews_google_fonts;

        $top_header_texts_color = morenews_get_option('top_header_texts_color');

        $primary_color = morenews_get_option('primary_color');
        $light_primary_color = morenews_get_option('primary_color_light');

        $morenews_background_color = get_background_color();
        $light_background_color = '#' . $morenews_background_color;
        $dark_background_color = morenews_get_option('dark_background_color');

        $secondary_color = morenews_get_option('secondary_color');
        $text_over_secondary_color = morenews_get_option('text_over_secondary_color');
        $site_default_post_box_color = morenews_get_option('site_default_post_box_color');
        $site_light_post_box_color = morenews_get_option('site_light_post_box_color');

        $top_header_background_color = morenews_get_option('top_header_background_color');

        $main_navigation_link_color = morenews_get_option('main_navigation_link_color');
        $main_navigation_custom_background_color = morenews_get_option('main_navigation_custom_background_color');
        $main_navigation_badge_background = morenews_get_option('main_navigation_badge_background');
        $main_navigation_badge_color = morenews_get_option('main_navigation_badge_color');

        $site_wide_title_color = morenews_get_option('site_wide_title_color');
        $title_link_color = morenews_get_option('title_link_color');
        $title_link_light_color = morenews_get_option('title_link_light_color');


        $title_over_image_color = morenews_get_option('title_over_image_color');
        $post_format_color = morenews_get_option('post_format_color');
        $watch_online_background = morenews_get_option('watch_online_background');
        $breaking_news_background = morenews_get_option('breaking_news_background');
        $footer_background_color = morenews_get_option('footer_background_color');
        $footer_texts_color = morenews_get_option('footer_texts_color');
        $footer_credits_background_color = morenews_get_option('footer_credits_background_color');
        $footer_credits_texts_color = morenews_get_option('footer_credits_texts_color');
        $category_color_1 = morenews_get_option('category_color_1');
        $category_color_2 = morenews_get_option('category_color_2');
        $category_color_3 = morenews_get_option('category_color_3');
        $category_color_4 = morenews_get_option('category_color_4');
        $category_color_5 = morenews_get_option('category_color_5');
        $category_color_6 = morenews_get_option('category_color_6');
        $category_color_7 = morenews_get_option('category_color_7');

        $category_texts_color_1 = morenews_get_option('category_texts_color_1');
        $category_texts_color_2 = morenews_get_option('category_texts_color_2');
        $category_texts_color_3 = morenews_get_option('category_texts_color_3');
        $category_texts_color_4 = morenews_get_option('category_texts_color_4');
        $category_texts_color_5 = morenews_get_option('category_texts_color_5');
        $category_texts_color_6 = morenews_get_option('category_texts_color_6');
        $category_texts_color_7 = morenews_get_option('category_texts_color_7');

        $site_title_font = $morenews_google_fonts[morenews_get_option('site_title_font')];
        $primary_font = $morenews_google_fonts[morenews_get_option('primary_font')];
        $secondary_font = $morenews_google_fonts[morenews_get_option('secondary_font')];

        $global_font_size = morenews_get_option('global_font_size');

        $title_type_1 = morenews_get_option('title_type_1');
        $title_type_2 = morenews_get_option('title_type_2');
        $title_type_3 = morenews_get_option('title_type_3');
        $title_type_4 = morenews_get_option('title_type_4');
        $morenews_section_title_font_size = morenews_get_option('morenews_section_title_font_size');
        $morenews_page_posts_title_font_size = morenews_get_option('morenews_page_posts_title_font_size');
        $morenews_page_posts_paragraph_font_size = morenews_get_option('morenews_page_posts_paragraph_font_size');


        $footer_mailchimp_background_color = morenews_get_option('footer_mailchimp_background_color');
        $footer_mailchimp_text_color = morenews_get_option('footer_mailchimp_text_color');


        $title_font_weight = morenews_get_option('title_font_weight');
        $letter_spacing = morenews_get_option('letter_spacing');
        $title_line_height = morenews_get_option('title_line_height');
        $line_height = morenews_get_option('line_height');


        ob_start();
        ?>

        <?php if (!empty($dark_background_color)): ?>
        body.aft-dark-mode #sidr,
        body.aft-dark-mode,
        body.aft-dark-mode.custom-background,
        body.aft-dark-mode #af-preloader {
            background-color: <?php morenews_esc_custom_style($dark_background_color) ?>;
        }
        <?php endif; ?>

        <?php if (!empty($light_background_color)): ?>
            body.aft-default-mode #sidr,
            body.aft-default-mode #af-preloader,
            body.aft-default-mode {
                background-color: <?php morenews_esc_custom_style($light_background_color) ?>;
            }

        <?php endif; ?>

        <?php if (!empty($light_primary_color )): ?>

            body.aft-default-mode .main-navigation .menu .menu-mobile li a, 
            body.aft-default-mode .main-navigation .menu .menu-desktop .sub-menu li a,

            body.aft-default-mode .morenews-widget.widget_text a,
            body.aft-default-mode.woocommerce-account .entry-content .woocommerce-MyAccount-navigation ul li.is-active a,
            body.aft-default-mode ul.products li.product .price,
            body.aft-default-mode .entry-content > [class*="wp-block-"] .woocommerce a:not(.has-text-color).button:hover,
            body.aft-default-mode pre .woocommerce,
            body.aft-default-mode .wp-block-tag-cloud a, 
            body.aft-default-mode .tagcloud a,
            body.aft-default-mode .wp-post-author-meta h4 a,
            body.aft-default-mode .wp-post-author-meta .wp-post-author-meta-more-posts a,
            body.aft-default-mode .wp_post_author_widget .awpa-display-name,
            body.aft-default-mode .af-breadcrumbs a,
            body.aft-default-mode .morenews-pagination .nav-links .page-numbers,
            body.aft-default-mode .af-slick-navcontrols .slide-icon, 
            body.aft-default-mode .af-youtube-slider .slide-icon, 
            body.aft-default-mode .aft-yt-video-item-wrapper .slide-icon,
            body.aft-default-mode .wp-block-latest-comments li.wp-block-latest-comments__comment a,
            body.aft-default-mode .entry-content > .wp-block-tag-cloud a:not(.has-text-color),
            body.aft-default-mode .entry-content .wp-block-archives-list.wp-block-archives a:not(.has-text-color),
            body.aft-default-mode .entry-content .wp-block-latest-posts a:not(.has-text-color), 
            body.aft-default-mode .entry-content .wp-block-categories-list.wp-block-categories a:not(.has-text-color),

            .aft-default-mode .wp-block-archives-list.wp-block-archives a:not(.has-text-color),
            .aft-default-mode .wp-block-latest-posts a:not(.has-text-color), 
            .aft-default-mode .wp-block-categories-list.wp-block-categories a:not(.has-text-color),
            .aft-default-mode .wp-block-latest-comments li.wp-block-latest-comments__comment a,
            body.aft-default-mode footer.comment-meta a,

            body.aft-default-mode.widget-title-border-bottom .wp-block-group .wp-block-heading,
            body.aft-default-mode.widget-title-border-center .wp-block-group .wp-block-heading,

            body.aft-default-mode.widget-title-border-bottom .widget-title .heading-line,
            body.aft-default-mode.widget-title-border-center .widget-title .heading-line,
            body.aft-default-mode.widget-title-border-none .widget-title .heading-line,

            body.aft-default-mode.widget-title-border-bottom .wp_post_author_widget .widget-title .header-after,
            body.aft-default-mode.widget-title-border-center .wp_post_author_widget .widget-title .header-after,
            body.aft-default-mode.widget-title-border-none .wp_post_author_widget .widget-title .header-after,

            body.aft-default-mode.widget-title-border-bottom .aft-posts-tabs-panel .nav-tabs>li>a,
            body.aft-default-mode.widget-title-border-center .aft-posts-tabs-panel .nav-tabs>li>a,
            body.aft-default-mode.widget-title-border-none .aft-posts-tabs-panel .nav-tabs>li>a,

            body.aft-default-mode #secondary .widget > ul > li a,
            body.aft-default-mode.single span.tags-links a,
            body.aft-default-mode .page-title,
            body.aft-default-mode h1.entry-title,
            body.aft-default-mode .aft-popular-taxonomies-lists ul li a,
            body.aft-default-mode #wp-calendar thead,
            body.aft-default-mode #wp-calendar tbody,
            body.aft-default-mode #wp-calendar caption,
            body.aft-default-mode h3,
            body.aft-default-mode .aft-readmore-wrapper a.aft-readmore,
            body.aft-default-mode #secondary .morenews-widget ul[class*="wp-block-"] a,
            body.aft-default-mode #secondary .morenews-widget ol[class*="wp-block-"] a,
            body.aft-default-mode a.post-edit-link,
            body.aft-default-mode .comment-form a,
            body.aft-default-mode footer.site-footer .aft-readmore-wrapper a.aft-readmore,
            body.aft-default-mode .author-links a,
            body.aft-default-mode .main-navigation ul.children li a,
            body.aft-default-mode .nav-links a,
            body.aft-default-mode .read-details .entry-meta span,
            body.aft-default-mode .aft-comment-view-share > span > a,
            body.aft-default-mode h4.af-author-display-name,
            body.aft-default-mode .wp-block-image figcaption,
            body.aft-default-mode ul.trail-items li a,
            body.aft-default-mode #sidr,
            body.aft-default-mode {
                color: <?php morenews_esc_custom_style($light_primary_color) ?>;
            }
            body.aft-default-mode .aft-readmore-wrapper a.aft-readmore,
            body.aft-default-mode .wp-post-author-meta .wp-post-author-meta-more-posts a{
                border-color: <?php morenews_esc_custom_style($light_primary_color) ?>;
            }
            body.aft-default-mode .main-navigation .menu .menu-mobile li a button:before, 
            body.aft-default-mode .main-navigation .menu .menu-mobile li a button:after{
                background-color: <?php morenews_esc_custom_style($light_primary_color) ?>;
            }

        <?php endif; ?>

        <?php if (!empty($top_header_background_color)): ?>
            
            body .morenews-header .top-header{
            background-color: <?php morenews_esc_custom_style($top_header_background_color) ?>;
            }

        <?php endif; ?>

        <?php if (!empty($top_header_texts_color)): ?>

            body .morenews-header .date-bar-left,
            body .morenews-header .top-header{
            color: <?php morenews_esc_custom_style($top_header_texts_color) ?>;
            }

            body .header-layout-compressed-full .offcanvas-menu span{
            background-color: <?php morenews_esc_custom_style($top_header_texts_color) ?>;
            }

        <?php endif; ?>

        <?php if (!empty($primary_color)): ?>

            body.aft-dark-mode .main-navigation .menu .menu-mobile li a, 
            body.aft-dark-mode .main-navigation .menu .menu-desktop .sub-menu li a,

            body.aft-dark-mode .morenews-pagination .nav-links .page-numbers,
            body.aft-dark-mode select,
            body.aft-dark-mode legend,
            .aft-dark-mode .wp-post-author-meta .wp-post-author-meta-more-posts a,
            .aft-dark-mode .wp_post_author_widget .awpa-display-name a,
            
            body.aft-dark-mode .morenews-widget.widget_text a,
            body.aft-dark-mode.woocommerce-account .entry-content .woocommerce-MyAccount-navigation ul li.is-active a,
            body.aft-dark-mode ul.products li.product .price,
            body.aft-dark-mode pre .woocommerce,
            body.aft-dark-mode .tagcloud a,
            body.aft-dark-mode .wp_post_author_widget .awpa-display-name,
            body.aft-dark-mode .af-breadcrumbs a,
            body.aft-dark-mode .af-slick-navcontrols .slide-icon, 
            body.aft-dark-mode .af-youtube-slider .slide-icon, 
            body.aft-dark-mode .aft-yt-video-item-wrapper .slide-icon,
            body.aft-dark-mode .wp-block-latest-comments li.wp-block-latest-comments__comment a,
            body.aft-dark-mode .wp-block-tag-cloud a,
            body.aft-dark-mode .entry-content > .wp-block-tag-cloud a:not(.has-text-color),
            body.aft-dark-mode .entry-content .wp-block-archives-list.wp-block-archives a:not(.has-text-color),
            body.aft-dark-mode .entry-content .wp-block-latest-posts a:not(.has-text-color), 
            body.aft-dark-mode .entry-content .wp-block-categories-list.wp-block-categories a:not(.has-text-color),

            .aft-dark-mode .wp-block-archives-list.wp-block-archives a:not(.has-text-color),
            .aft-dark-mode .wp-block-latest-posts a:not(.has-text-color), 
            .aft-dark-mode .wp-block-categories-list.wp-block-categories a:not(.has-text-color),
            .aft-dark-mode .wp-block-latest-comments li.wp-block-latest-comments__comment a,
            body.aft-dark-mode footer.comment-meta a,

            body.aft-dark-mode.widget-title-border-bottom .wp-block-group .wp-block-heading,
            body.aft-dark-mode.widget-title-border-center .wp-block-group .wp-block-heading,

            body.aft-dark-mode.widget-title-border-bottom .widget-title .heading-line,
            body.aft-dark-mode.widget-title-border-center .widget-title .heading-line,
            body.aft-dark-mode.widget-title-border-none .widget-title .heading-line,

            body.aft-dark-mode.widget-title-border-bottom .wp_post_author_widget .widget-title .header-after,
            body.aft-dark-mode.widget-title-border-center .wp_post_author_widget .widget-title .header-after,
            body.aft-dark-mode.widget-title-border-none .wp_post_author_widget .widget-title .header-after,

            body.aft-dark-mode.widget-title-border-bottom .aft-posts-tabs-panel .nav-tabs>li>a,
            body.aft-dark-mode.widget-title-border-center .aft-posts-tabs-panel .nav-tabs>li>a,
            body.aft-dark-mode.widget-title-border-none .aft-posts-tabs-panel .nav-tabs>li>a,

            body.aft-dark-mode.single span.tags-links a,
            body.aft-dark-mode .page-title,
            body.aft-dark-mode h1.entry-title,
            body.aft-dark-mode ul.trail-items li:after,
            body.aft-dark-mode .aft-popular-taxonomies-lists ul li a,
            body.aft-dark-mode #wp-calendar thead,
            body.aft-dark-mode #wp-calendar tbody,
            body.aft-dark-mode .entry-meta span,
            body.aft-dark-mode .entry-meta span a,
            body.aft-dark-mode h3,
            body.aft-dark-mode .color-pad #wp-calendar caption,
            body.aft-dark-mode .aft-readmore-wrapper a.aft-readmore,
            body.aft-dark-mode #secondary .morenews-widget ul[class*="wp-block-"] a,
            body.aft-dark-mode #secondary .morenews-widget ol[class*="wp-block-"] a,
            body.aft-dark-mode a.post-edit-link,
            body.aft-dark-mode .comment-form a,
            body.aft-dark-mode .wp-post-author-meta a,
            body.aft-dark-mode .wp-post-author-meta a:visited,
            body.aft-dark-mode .posts-author a,
            body.aft-dark-mode .posts-author a:visited,
            body.aft-dark-mode .author-links a,
            body.aft-dark-mode .nav-links a,
            body.aft-dark-mode .read-details .entry-meta span,
            body.aft-dark-mode .aft-comment-view-share > span > a,
            body.aft-dark-mode h4.af-author-display-name,
            body.aft-dark-mode #wp-calendar caption,
            body.aft-dark-mode .wp-block-image figcaption,
            body.aft-dark-mode ul.trail-items li a,
            body.aft-dark-mode .widget > ul > li a,

            body.aft-dark-mode #sidr,
            body.aft-dark-mode, 
            body.aft-dark-mode .color-pad{
                color: <?php morenews_esc_custom_style($primary_color) ?>;
            }
            body.aft-dark-mode .aft-readmore-wrapper a.aft-readmore,
            body.aft-dark-mode .wp-post-author-meta .wp-post-author-meta-more-posts a{
                border-color: <?php morenews_esc_custom_style($primary_color) ?>;
            }
            body.aft-dark-mode .main-navigation .menu .menu-mobile li a button:before, 
            body.aft-dark-mode .main-navigation .menu .menu-mobile li a button:after{
                background-color: <?php morenews_esc_custom_style($primary_color) ?>;
            }

        <?php endif; ?>

        <?php if (!empty($secondary_color)): ?>
            .frm_style_formidable-style.with_frm_style .frm_compact .frm_dropzone.dz-clickable .dz-message, 
            .frm_style_formidable-style.with_frm_style input[type=submit], 
            .frm_style_formidable-style.with_frm_style .frm_submit input[type=button], 
            .frm_style_formidable-style.with_frm_style .frm_submit button, 
            .frm_form_submit_style, 
            .frm_style_formidable-style.with_frm_style .frm-edit-page-btn,

            .woocommerce span.onsale,
            .woocommerce #respond input#submit.disabled, 
            .woocommerce #respond input#submit:disabled, 
            .woocommerce #respond input#submit:disabled[disabled], 
            .woocommerce a.button.disabled, 
            .woocommerce a.button:disabled, 
            .woocommerce a.button:disabled[disabled], 
            .woocommerce button.button.disabled, 
            .woocommerce button.button:disabled, 
            .woocommerce button.button:disabled[disabled], 
            .woocommerce input.button.disabled, 
            .woocommerce input.button:disabled, 
            .woocommerce input.button:disabled[disabled],
            .woocommerce #respond input#submit, 
            .woocommerce a.button, 
            .woocommerce button.button, 
            .woocommerce input.button,
            .woocommerce #respond input#submit.alt, 
            .woocommerce a.button.alt, 
            .woocommerce button.button.alt, 
            .woocommerce input.button.alt,
            .woocommerce-account .addresses .title .edit,

            body .wc-block-components-button,

            .widget-title-fill-and-border .wp-block-search__label,
            .widget-title-fill-and-border .wp-block-group .wp-block-heading,
            .widget-title-fill-and-no-border .wp-block-search__label,
            .widget-title-fill-and-no-border .wp-block-group .wp-block-heading,

            .widget-title-fill-and-border .wp_post_author_widget .widget-title .header-after,
            .widget-title-fill-and-border .widget-title .heading-line,
            .widget-title-fill-and-border .aft-posts-tabs-panel .nav-tabs>li>a.active,
            .widget-title-fill-and-border .aft-main-banner-wrapper .widget-title .heading-line ,
            .widget-title-fill-and-no-border .wp_post_author_widget .widget-title .header-after,
            .widget-title-fill-and-no-border .widget-title .heading-line,
            .widget-title-fill-and-no-border .aft-posts-tabs-panel .nav-tabs>li>a.active,
            .widget-title-fill-and-no-border .aft-main-banner-wrapper .widget-title .heading-line,
            a.sidr-class-sidr-button-close,
            body.widget-title-border-bottom .header-after1 .heading-line-before, 
            body.widget-title-border-bottom .widget-title .heading-line-before,

            .widget-title-border-center .wp-block-search__label::after,
            .widget-title-border-center .wp-block-group .wp-block-heading::after,
            .widget-title-border-center .wp_post_author_widget .widget-title .heading-line-before,
            .widget-title-border-center .aft-posts-tabs-panel .nav-tabs>li>a.active::after,
            .widget-title-border-center .wp_post_author_widget .widget-title .header-after::after, 
            .widget-title-border-center .widget-title .heading-line-after,

            .widget-title-border-bottom .wp-block-search__label::after,
            .widget-title-border-bottom .wp-block-group .wp-block-heading::after,
            .widget-title-border-bottom .heading-line::before, 
            .widget-title-border-bottom .wp-post-author-wrap .header-after::before,
            .widget-title-border-bottom .aft-posts-tabs-panel .nav-tabs>li>a.active span::after,

            .aft-dark-mode .is-style-fill a.wp-block-button__link:not(.has-background), 
            .aft-default-mode .is-style-fill a.wp-block-button__link:not(.has-background),

            a.comment-reply-link,
            body.aft-default-mode .reply a,
            body.aft-dark-mode .reply a,
            .aft-popular-taxonomies-lists span::before ,
            .woocommerce div.product .woocommerce-tabs ul.tabs li.active,
            #loader-wrapper div,
            span.heading-line::before,
            .wp-post-author-wrap .header-after::before,
            body.aft-default-mode.woocommerce span.onsale,
            body.aft-dark-mode input[type="button"],
            body.aft-dark-mode input[type="reset"],
            body.aft-dark-mode input[type="submit"],
            body.aft-dark-mode .inner-suscribe input[type=submit],
            body.aft-default-mode input[type="button"],
            body.aft-default-mode input[type="reset"],
            body.aft-default-mode input[type="submit"],
            body.aft-default-mode .inner-suscribe input[type=submit],
            .woocommerce-product-search button[type="submit"],
            input.search-submit,
            .wp-block-search__button,
            .af-youtube-slider .af-video-wrap .af-bg-play i,
            .af-youtube-video-list .entry-header-yt-video-wrapper .af-yt-video-play i,
            .af-post-format i,
            body .btn-style1 a:visited,
            body .btn-style1 a,
            body .morenews-pagination .nav-links .page-numbers.current,
            body #scroll-up,
            button,
            body article.sticky .read-single:before,
            .aft-readmore-wrapper a.aft-readmore:hover,
            body.aft-dark-mode .aft-readmore-wrapper a.aft-readmore:hover, 
            footer.site-footer .aft-readmore-wrapper a.aft-readmore:hover,
            .aft-readmore-wrapper a.aft-readmore:hover,
            body .trending-posts-vertical .trending-no{
            background-color: <?php morenews_esc_custom_style($secondary_color) ?>;
            }

            div.wpforms-container-full button[type=submit]:hover,
            div.wpforms-container-full button[type=submit]:not(:hover):not(:active){
                background-color: <?php morenews_esc_custom_style($secondary_color) ?> !important;
            }

            .grid-design-texts-over-image .aft-readmore-wrapper a.aft-readmore:hover, 
            .aft-readmore-wrapper a.aft-readmore:hover,
            body.aft-dark-mode .aft-readmore-wrapper a.aft-readmore:hover, 
            body.aft-default-mode .aft-readmore-wrapper a.aft-readmore:hover, 

            body.single .entry-header .aft-post-excerpt-and-meta .post-excerpt,
            body.aft-dark-mode.single span.tags-links a:hover,
            .morenews-pagination .nav-links .page-numbers.current,
            .aft-readmore-wrapper a.aft-readmore:hover,
            p.awpa-more-posts a:hover{
            border-color: <?php morenews_esc_custom_style($secondary_color) ?>;
            }
            .wp-post-author-meta .wp-post-author-meta-more-posts a.awpa-more-posts:hover{
                border-color: <?php morenews_esc_custom_style($secondary_color) ?>;
            }
            body:not(.rtl) .aft-popular-taxonomies-lists span::after {
                border-left-color: <?php morenews_esc_custom_style($secondary_color) ?>;
            }
            body.rtl .aft-popular-taxonomies-lists span::after {
                border-right-color: <?php morenews_esc_custom_style($secondary_color) ?>;
            }
            .widget-title-fill-and-no-border .wp-block-search__label::after,
            .widget-title-fill-and-no-border .wp-block-group .wp-block-heading::after,
            .widget-title-fill-and-no-border .aft-posts-tabs-panel .nav-tabs>li a.active::after,
            .widget-title-fill-and-no-border .morenews-widget .widget-title::before,
            .widget-title-fill-and-no-border .morenews-customizer .widget-title::before{
                border-top-color: <?php morenews_esc_custom_style($secondary_color) ?>;

            }
            #scroll-up::after,
            .aft-dark-mode #loader,
            .aft-default-mode #loader {
                border-bottom-color: <?php morenews_esc_custom_style($secondary_color) ?>;
            }
            footer.site-footer .wp-calendar-nav a:hover,
            footer.site-footer .wp-block-latest-comments__comment-meta a:hover,
            .aft-dark-mode .tagcloud a:hover, 
            .aft-dark-mode .widget ul.menu >li a:hover, 
            .aft-dark-mode .widget > ul > li a:hover,
            .banner-exclusive-posts-wrapper a:hover,
            .list-style .read-title h3 a:hover,
            .grid-design-default .read-title h3 a:hover,
            body.aft-dark-mode .banner-exclusive-posts-wrapper a:hover,
            body.aft-dark-mode .banner-exclusive-posts-wrapper a:visited:hover,
            body.aft-default-mode .banner-exclusive-posts-wrapper a:hover,
            body.aft-default-mode .banner-exclusive-posts-wrapper a:visited:hover,
            body.wp-post-author-meta .awpa-display-name a:hover,
            .widget_text a ,
            .post-description a:not(.aft-readmore), .post-description a:not(.aft-readmore):visited,

            .wp_post_author_widget .wp-post-author-meta .awpa-display-name a:hover, 
            .wp-post-author-meta .wp-post-author-meta-more-posts a.awpa-more-posts:hover,
            body.aft-default-mode .af-breadcrumbs a:hover,
            body.aft-dark-mode .af-breadcrumbs a:hover,
            body .wp-block-latest-comments li.wp-block-latest-comments__comment a:hover,

            body .site-footer .color-pad .read-title h3 a:hover,
            body.aft-default-mode .site-footer .tagcloud a:hover,
            body.aft-dark-mode .site-footer .tagcloud a:hover,
            body.aft-default-mode .site-footer .wp-block-tag-cloud a:hover,
            body.aft-dark-mode .site-footer .wp-block-tag-cloud a:hover,

            body.aft-dark-mode #secondary .morenews-widget ul[class*="wp-block-"] a:hover,
            body.aft-dark-mode #secondary .morenews-widget ol[class*="wp-block-"] a:hover,
            body.aft-dark-mode a.post-edit-link:hover,
            body.aft-default-mode #secondary .morenews-widget ul[class*="wp-block-"] a:hover,
            body.aft-default-mode #secondary .morenews-widget ol[class*="wp-block-"] a:hover,
            body.aft-default-mode a.post-edit-link:hover,
            body.aft-default-mode #secondary .widget > ul > li a:hover,

            body.aft-default-mode footer.comment-meta a:hover,
            body.aft-dark-mode footer.comment-meta a:hover,
            body.aft-default-mode .comment-form a:hover,
            body.aft-dark-mode .comment-form a:hover,
            body.aft-dark-mode .entry-content > .wp-block-tag-cloud a:not(.has-text-color):hover,
            body.aft-default-mode .entry-content > .wp-block-tag-cloud a:not(.has-text-color):hover,
            body.aft-dark-mode .entry-content .wp-block-archives-list.wp-block-archives a:not(.has-text-color):hover,
            body.aft-default-mode .entry-content .wp-block-archives-list.wp-block-archives a:not(.has-text-color):hover,
            body.aft-dark-mode .entry-content .wp-block-latest-posts a:not(.has-text-color):hover, 
            body.aft-dark-mode .entry-content .wp-block-categories-list.wp-block-categories a:not(.has-text-color):hover,
            body.aft-default-mode .entry-content .wp-block-latest-posts a:not(.has-text-color):hover, 
            body.aft-default-mode .entry-content .wp-block-categories-list.wp-block-categories a:not(.has-text-color):hover,

            .aft-default-mode .wp-block-archives-list.wp-block-archives a:not(.has-text-color):hover,
            .aft-default-mode .wp-block-latest-posts a:not(.has-text-color):hover, 
            .aft-default-mode .wp-block-categories-list.wp-block-categories a:not(.has-text-color):hover,
            .aft-default-mode .wp-block-latest-comments li.wp-block-latest-comments__comment a:hover,
            .aft-dark-mode .wp-block-archives-list.wp-block-archives a:not(.has-text-color):hover,
            .aft-dark-mode .wp-block-latest-posts a:not(.has-text-color):hover, 
            .aft-dark-mode .wp-block-categories-list.wp-block-categories a:not(.has-text-color):hover,
            .aft-dark-mode .wp-block-latest-comments li.wp-block-latest-comments__comment a:hover,

            body.aft-default-mode .site-footer .wp-block-latest-comments li.wp-block-latest-comments__comment a:hover,
            body.aft-dark-mode .site-footer .wp-block-latest-comments li.wp-block-latest-comments__comment a:hover,
            .aft-default-mode .site-footer .wp-block-archives-list.wp-block-archives a:not(.has-text-color):hover,
            .aft-default-mode .site-footer .wp-block-latest-posts a:not(.has-text-color):hover, 
            .aft-default-mode .site-footer .wp-block-categories-list.wp-block-categories a:not(.has-text-color):hover,
            .aft-dark-mode .site-footer .wp-block-archives-list.wp-block-archives a:not(.has-text-color):hover,
            .aft-dark-mode .site-footer .wp-block-latest-posts a:not(.has-text-color):hover, 
            .aft-dark-mode .site-footer .wp-block-categories-list.wp-block-categories a:not(.has-text-color):hover,

            body.aft-dark-mode .morenews-pagination .nav-links a.page-numbers:hover,
            body.aft-default-mode .morenews-pagination .nav-links a.page-numbers:hover,
            body .site-footer .secondary-footer a:hover,
            body.aft-default-mode .aft-popular-taxonomies-lists ul li a:hover ,
            body.aft-dark-mode .aft-popular-taxonomies-lists ul li a:hover,
            body.aft-dark-mode .wp-calendar-nav a,
            body .entry-content > .wp-block-heading a:not(.has-link-color),
            body .entry-content > ul a,
            body .entry-content > ol a,
            body .entry-content > p a ,
            body.aft-default-mode p.logged-in-as a,
            body.aft-dark-mode p.logged-in-as a,
            body.aft-dark-mode .woocommerce-loop-product__title:hover,
            body.aft-default-mode .woocommerce-loop-product__title:hover,
            a:hover,
            p a,
            .stars a:active,
            .stars a:focus,
            .morenews-widget.widget_text a,
            body.aft-default-mode .wp-block-latest-comments li.wp-block-latest-comments__comment a:hover,
            body.aft-dark-mode .wp-block-latest-comments li.wp-block-latest-comments__comment a:hover,
            .entry-content .wp-block-latest-comments a:not(.has-text-color):hover,

            body.aft-default-mode .entry-content h1:not(.has-link-color):not(.wp-block-post-title) a,
            body.aft-default-mode .entry-content h2:not(.has-link-color):not(.wp-block-post-title) a,
            body.aft-default-mode .entry-content h3:not(.has-link-color):not(.wp-block-post-title) a,
            body.aft-default-mode .entry-content h4:not(.has-link-color):not(.wp-block-post-title) a,
            body.aft-default-mode .entry-content h5:not(.has-link-color):not(.wp-block-post-title) a,
            body.aft-default-mode .entry-content h6:not(.has-link-color):not(.wp-block-post-title) a,
            body.aft-dark-mode .entry-content h1:not(.has-link-color):not(.wp-block-post-title) a,
            body.aft-dark-mode .entry-content h2:not(.has-link-color):not(.wp-block-post-title) a,
            body.aft-dark-mode .entry-content h3:not(.has-link-color):not(.wp-block-post-title) a,
            body.aft-dark-mode .entry-content h4:not(.has-link-color):not(.wp-block-post-title) a,
            body.aft-dark-mode .entry-content h5:not(.has-link-color):not(.wp-block-post-title) a,
            body.aft-dark-mode .entry-content h6:not(.has-link-color):not(.wp-block-post-title) a,

            body.aft-default-mode .comment-content a,
            body.aft-dark-mode .comment-content a,
            body.aft-default-mode .post-excerpt a,
            body.aft-dark-mode .post-excerpt a,
            body.aft-default-mode .wp-block-tag-cloud a:hover,
            body.aft-default-mode .tagcloud a:hover,
            body.aft-default-mode.single span.tags-links a:hover,
            body.aft-default-mode p.awpa-more-posts a:hover,
            body.aft-default-mode p.awpa-website a:hover ,
            body.aft-default-mode .wp-post-author-meta h4 a:hover,
            body.aft-default-mode .widget ul.menu >li a:hover,
            body.aft-default-mode .widget > ul > li a:hover,
            body.aft-default-mode .nav-links a:hover,
            body.aft-default-mode ul.trail-items li a:hover,
            body.aft-dark-mode .wp-block-tag-cloud a:hover,
            body.aft-dark-mode .tagcloud a:hover,
            body.aft-dark-mode.single span.tags-links a:hover,
            body.aft-dark-mode p.awpa-more-posts a:hover,
            body.aft-dark-mode p.awpa-website a:hover ,
            body.aft-dark-mode .widget ul.menu >li a:hover,
            body.aft-dark-mode .nav-links a:hover,
            body.aft-dark-mode ul.trail-items li a:hover{
            color:<?php morenews_esc_custom_style($secondary_color) ?>;
            }

            @media only screen and (min-width: 992px){
                body.aft-default-mode .morenews-header .main-navigation .menu-desktop > ul > li:hover > a:before,
                body.aft-default-mode .morenews-header .main-navigation .menu-desktop > ul > li.current-menu-item > a:before {
                background-color: <?php morenews_esc_custom_style($secondary_color) ?>;
                }
            }
        <?php endif; ?>

        <?php if (!empty($secondary_color)): ?>
            .woocommerce-product-search button[type="submit"], input.search-submit{
                background-color: <?php morenews_esc_custom_style($secondary_color) ?>;
            }
            .aft-dark-mode .entry-content a:hover, .aft-dark-mode .entry-content a:focus, .aft-dark-mode .entry-content a:active,
            .wp-calendar-nav a,
            #wp-calendar tbody td a,
            body.aft-dark-mode #wp-calendar tbody td#today,
            body.aft-default-mode #wp-calendar tbody td#today,
            body.aft-default-mode .entry-content > .wp-block-heading a:not(.has-link-color),
            body.aft-dark-mode .entry-content > .wp-block-heading a:not(.has-link-color),
            body .entry-content > ul a, body .entry-content > ul a:visited,
            body .entry-content > ol a, body .entry-content > ol a:visited,
            body .entry-content > p a, body .entry-content > p a:visited
            {
            color: <?php morenews_esc_custom_style($secondary_color) ?>;
            }
            .woocommerce-product-search button[type="submit"], input.search-submit,
            body.single span.tags-links a:hover,
            body .entry-content > .wp-block-heading a:not(.has-link-color),
            body .entry-content > ul a, body .entry-content > ul a:visited,
            body .entry-content > ol a, body .entry-content > ol a:visited,
            body .entry-content > p a, body .entry-content > p a:visited{
            border-color: <?php morenews_esc_custom_style($secondary_color) ?>;
            }

            @media only screen and (min-width: 993px){
                .main-navigation .menu-desktop > li.current-menu-item::after, 
                .main-navigation .menu-desktop > ul > li.current-menu-item::after, 
                .main-navigation .menu-desktop > li::after, .main-navigation .menu-desktop > ul > li::after{
                    background-color: <?php morenews_esc_custom_style($secondary_color) ?>;
                }
            }
        <?php endif; ?>  

        <?php if (!empty($text_over_secondary_color)): ?>
            .woocommerce #respond input#submit.disabled, 
            .woocommerce #respond input#submit:disabled, 
            .woocommerce #respond input#submit:disabled[disabled], 
            .woocommerce a.button.disabled, 
            .woocommerce a.button:disabled, 
            .woocommerce a.button:disabled[disabled], 
            .woocommerce button.button.disabled, 
            .woocommerce button.button:disabled, 
            .woocommerce button.button:disabled[disabled], 
            .woocommerce input.button.disabled, 
            .woocommerce input.button:disabled, 
            .woocommerce input.button:disabled[disabled],
            .woocommerce #respond input#submit, 
            .woocommerce a.button, 
            body .entry-content > [class*="wp-block-"] .woocommerce a:not(.has-text-color).button,
            .woocommerce button.button, 
            .woocommerce input.button,
            .woocommerce #respond input#submit.alt, 
            .woocommerce a.button.alt, 
            .woocommerce button.button.alt, 
            .woocommerce input.button.alt,
            .woocommerce-account .addresses .title .edit,
            
            body .morenews-pagination .nav-links .page-numbers.current,
            body.aft-default-mode .grid-design-texts-over-image .aft-readmore-wrapper a.aft-readmore:hover,
            .grid-design-texts-over-image .aft-readmore-wrapper a.aft-readmore:hover, 
            body.aft-dark-mode .grid-design-texts-over-image .aft-readmore-wrapper a.aft-readmore:hover,
            .aft-readmore-wrapper a.aft-readmore:hover,
            body.aft-dark-mode .aft-readmore-wrapper a.aft-readmore:hover, 
            body.aft-default-mode .aft-readmore-wrapper a.aft-readmore:hover, 
            footer.site-footer .aft-readmore-wrapper a.aft-readmore:hover,
            body.aft-default-mode .reply a,
            body.aft-dark-mode .reply a,

            .widget-title-fill-and-border .wp-block-search__label,
            .widget-title-fill-and-border .wp-block-group .wp-block-heading,
            .widget-title-fill-and-no-border .wp-block-search__label,
            .widget-title-fill-and-no-border .wp-block-group .wp-block-heading,

            .widget-title-fill-and-border .wp_post_author_widget .widget-title .header-after,
            .widget-title-fill-and-border .widget-title .heading-line,
            .widget-title-fill-and-border .aft-posts-tabs-panel .nav-tabs>li>a.active,
            .widget-title-fill-and-border .aft-main-banner-wrapper .widget-title .heading-line ,
            .widget-title-fill-and-no-border .wp_post_author_widget .widget-title .header-after,
            .widget-title-fill-and-no-border .widget-title .heading-line,
            .widget-title-fill-and-no-border .aft-posts-tabs-panel .nav-tabs>li>a.active,
            .widget-title-fill-and-no-border .aft-main-banner-wrapper .widget-title .heading-line,

            .aft-dark-mode .is-style-fill a.wp-block-button__link:not(.has-text-color), 
            .aft-default-mode .is-style-fill a.wp-block-button__link:not(.has-text-color),

            div.wpforms-container-full button[type=submit]:hover,
            div.wpforms-container-full button[type=submit]:not(:hover):not(:active),

            body.aft-dark-mode .aft-popular-taxonomies-lists span,
            body.aft-default-mode .aft-popular-taxonomies-lists span,
            .af-post-format i,
            .read-img .af-post-format i,
            .af-youtube-slider .af-video-wrap .af-bg-play, 
            body.aft-dark-mode.woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
            .woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
            .woocommerce div.product .woocommerce-tabs ul.tabs li.active,
            .af-youtube-slider .af-video-wrap .af-hide-iframe i,
            .af-youtube-video-list .entry-header-yt-video-wrapper .af-yt-video-play i,
            .woocommerce-product-search button[type="submit"], input.search-submit,
            body.aft-default-mode button,
            body.aft-default-mode input[type="button"],
            body.aft-default-mode input[type="reset"],
            body.aft-default-mode input[type="submit"],
            body.aft-dark-mode button,
            body.aft-dark-mode input[type="button"],
            body.aft-dark-mode input[type="reset"],
            body.aft-dark-mode input[type="submit"],
            body .trending-posts-vertical .trending-no,
            body.aft-dark-mode .btn-style1 a,
            body.aft-default-mode .btn-style1 a,
            body.aft-dark-mode #scroll-up {
            color: <?php morenews_esc_custom_style($text_over_secondary_color) ?>;
            }
            body.aft-default-mode #scroll-up::before,
            body.aft-dark-mode #scroll-up::before {
                border-bottom-color: <?php morenews_esc_custom_style($text_over_secondary_color) ?>;
            }
            a.sidr-class-sidr-button-close::before, a.sidr-class-sidr-button-close::after {
                background-color: <?php morenews_esc_custom_style($text_over_secondary_color) ?>;
            }

        <?php endif; ?>

        <?php if (!empty($site_default_post_box_color)): ?>
            .aft-dark-mode .aft-main-banner-wrapper .af-slick-navcontrols,
            .aft-dark-mode .morenews-widget .af-slick-navcontrols,
            .aft-dark-mode .morenews-customizer .section-wrapper .af-slick-navcontrols,

            body.aft-dark-mode.single-post-title-full .entry-header-details,
            body.aft-dark-mode .main-navigation .menu .menu-mobile,
            body.aft-dark-mode .main-navigation .menu > ul > li > ul, 
            body.aft-dark-mode .main-navigation .menu > ul ul, 
            body.aft-dark-mode .af-search-form,
            body.aft-dark-mode .aft-popular-taxonomies-lists,
            body.aft-dark-mode .exclusive-slides::before, 
            body.aft-dark-mode .exclusive-slides::after,
            body.aft-dark-mode .banner-exclusive-posts-wrapper .exclusive-posts:before,
            
            body.aft-dark-mode.woocommerce div.product,
            body.aft-dark-mode.home.blog main.site-main,
            body.aft-dark-mode main.site-main,
            body.aft-dark-mode.single main.site-main .entry-content-wrap,
            body.aft-dark-mode .af-main-banner-latest-posts.grid-layout.morenews-customizer .container-wrapper, 
            body.aft-dark-mode .af-middle-header,
            body.aft-dark-mode .mid-header-wrapper, 
            body.aft-dark-mode .comments-area, 
            body.aft-dark-mode .af-breadcrumbs, 
            .aft-dark-mode .morenews-customizer, 
            body.aft-dark-mode .morenews-widget{
                background-color: <?php morenews_esc_custom_style($site_default_post_box_color) ?>;
            }
            @media only screen and (min-width: 993px){
                body.aft-dark-mode .main-navigation .menu ul ul ul ,
                body.aft-dark-mode .main-navigation .menu > ul > li > ul{
                    background-color: <?php morenews_esc_custom_style($site_default_post_box_color) ?>;
                }
            }

        <?php endif; ?>

        <?php if (!empty($site_light_post_box_color)): ?>
            .aft-default-mode .aft-main-banner-wrapper .af-slick-navcontrols,
            .aft-default-mode .morenews-widget .af-slick-navcontrols,
            .aft-default-mode .morenews-customizer .section-wrapper .af-slick-navcontrols,

            body.aft-default-mode.single-post-title-full .entry-header-details,
            body.aft-default-mode .main-navigation .menu .menu-mobile,
            body.aft-default-mode .main-navigation .menu > ul > li > ul, 
            body.aft-default-mode .main-navigation .menu > ul ul, 
            body.aft-default-mode .af-search-form,
            body.aft-default-mode .aft-popular-taxonomies-lists,
            body.aft-default-mode .exclusive-slides::before, 
            body.aft-default-mode .exclusive-slides::after,
            body.aft-default-mode .banner-exclusive-posts-wrapper .exclusive-posts:before,

            body.aft-default-mode.woocommerce div.product,
            body.aft-default-mode.home.blog main.site-main,
            body.aft-default-mode main.site-main,
            body.aft-default-mode.single main.site-main .entry-content-wrap,
            body.aft-default-mode .af-main-banner-latest-posts.grid-layout.morenews-customizer .container-wrapper, 
            body.aft-default-mode .af-middle-header,
            body.aft-default-mode .mid-header-wrapper, 
            body.aft-default-mode .comments-area, 
            body.aft-default-mode .af-breadcrumbs, 
            .aft-default-mode .morenews-customizer, 
            body.aft-default-mode .morenews-widget{
                background-color: <?php morenews_esc_custom_style($site_light_post_box_color) ?>;
            }
        <?php endif; ?>

        <?php if (!empty($main_navigation_link_color)): ?>

            body:not(.home) .header-layout-compressed-full .full-width.af-transparent-head .af-for-transparent .main-navigation .menu > ul > li > a,
            body .header-layout-compressed .compress-bar-mid .date-bar-mid,
            body .main-navigation ul.menu > li > a,
            body .main-navigation ul li a,
            body.aft-dark-mode .main-navigation ul li a:hover,
            body .morenews-header .search-icon:visited,
            body .morenews-header .search-icon:hover,
            body .morenews-header .search-icon:focus,
            body .morenews-header .search-icon:active,
            body .morenews-header .search-icon{
            color: <?php morenews_esc_custom_style($main_navigation_link_color) ?>;
            }
            body .header-layout-side .offcanvas-menu span,
            body .header-layout-centered .offcanvas-menu span,
            body .ham:before,
            body .ham:after,
            body .ham{
            background-color: <?php morenews_esc_custom_style($main_navigation_link_color) ?>;
            }
            @media screen and (max-width: 990px){
                body .morenews-header.header-layout-centered .search-watch.aft-show-on-mobile .search-icon{
                    color: <?php morenews_esc_custom_style($main_navigation_link_color) ?>;
                }
                .header-layout-centered .main-navigation .toggle-menu a,
                .header-layout-side .main-navigation .toggle-menu a,
                .header-layout-compressed-full .main-navigation .toggle-menu a{
                    outline-color: <?php morenews_esc_custom_style($main_navigation_link_color) ?>;
                }
            }
        <?php endif; ?>

        <?php if (!empty($main_navigation_custom_background_color)): ?>
            body div#main-navigation-bar{
            background-color: <?php morenews_esc_custom_style($main_navigation_custom_background_color) ?>;
            }
        <?php endif; ?>


        <?php if (!empty($main_navigation_badge_background)): ?>
            body .main-navigation .menu-description {
            background-color: <?php morenews_esc_custom_style($main_navigation_badge_background) ?>;
            }
            body .main-navigation .menu-description:after{
            border-top-color: <?php morenews_esc_custom_style($main_navigation_badge_background) ?>;
            }
        <?php endif; ?>

        <?php if (!empty($main_navigation_badge_color)): ?>
            body .main-navigation .menu-description {
            color: <?php morenews_esc_custom_style($main_navigation_badge_color) ?>;
            }
        <?php endif; ?>

        <?php if (!empty($title_link_color)): ?>
            body.aft-dark-mode .banner-exclusive-posts-wrapper a,
            body.aft-dark-mode .banner-exclusive-posts-wrapper a:visited,
            body.aft-dark-mode .featured-category-item .read-img a,

            body.aft-dark-mode .woocommerce-loop-product__title,
            body.aft-dark-mode .widget > ul > li .comment-author-link,
            body.aft-dark-mode .widget ul.menu >li a,
            body.aft-dark-mode .read-title h2 a ,
            body.aft-dark-mode .read-title h3 a {
                color: <?php morenews_esc_custom_style($title_link_color) ?>;
            }
        <?php endif; ?>

        <?php if (!empty($title_link_light_color)): ?>
            body.aft-default-mode .banner-exclusive-posts-wrapper a,
            body.aft-default-mode .banner-exclusive-posts-wrapper a:visited,
            body.aft-default-mode .featured-category-item .read-img a,

            body.aft-default-mode .woocommerce-loop-product__title,
            body.aft-default-mode .widget > ul > li .comment-author-link,
            body.aft-default-mode .widget ul.menu >li a,
            body.aft-default-mode .widget > ul > li a,
            body.aft-default-mode .read-title h2 a ,
            body.aft-default-mode .read-title h3 a {
            color: <?php morenews_esc_custom_style($title_link_light_color) ?>;
            }
        <?php endif; ?>


        <?php if (!empty($title_over_image_color)): ?>
            body.aft-default-mode .grid-design-texts-over-image .aft-readmore-wrapper a.aft-readmore,
            .grid-design-texts-over-image .aft-readmore-wrapper a.aft-readmore, 
            body.aft-dark-mode .grid-design-texts-over-image .aft-readmore-wrapper a.aft-readmore,

            body.aft-dark-mode .af-main-banner-thumb-posts .small-grid-style .af-sec-post:first-child .read-details .read-title h3 a,
            body.aft-dark-mode .site-footer .color-pad .grid-design-texts-over-image .read-details .entry-meta span a,
            body.aft-dark-mode .site-footer .color-pad .grid-design-texts-over-image .read-details .entry-meta span,
            body.aft-dark-mode .site-footer .color-pad .grid-design-texts-over-image .read-title h3 a,
            body.aft-dark-mode .site-footer .color-pad .grid-design-texts-over-image .read-details,
            body.aft-dark-mode .grid-design-texts-over-image .read-details .entry-meta span a,
            body.aft-dark-mode .grid-design-texts-over-image .read-details .entry-meta span,
            body.aft-dark-mode .grid-design-texts-over-image .read-title h3 a,
            body.aft-dark-mode .grid-design-texts-over-image .read-details,
            body.aft-default-mode .af-main-banner-thumb-posts .small-grid-style .af-sec-post:first-child .read-details .read-title h3 a,
            body.aft-default-mode .site-footer .color-pad .grid-design-texts-over-image .read-details .entry-meta span a,
            body.aft-default-mode .site-footer .color-pad .grid-design-texts-over-image .read-details .entry-meta span,
            body.aft-default-mode .site-footer .color-pad .grid-design-texts-over-image .read-title h3 a,
            body.aft-default-mode .site-footer .color-pad .grid-design-texts-over-image .read-details,
            body.aft-default-mode .grid-design-texts-over-image .read-details .entry-meta span a,
            body.aft-default-mode .grid-design-texts-over-image .read-details .entry-meta span,
            body.aft-default-mode .grid-design-texts-over-image .read-title h3 a,
            body.aft-default-mode .grid-design-texts-over-image .read-details{
            color: <?php morenews_esc_custom_style($title_over_image_color) ?>;
            }
        <?php endif; ?>

        <?php if (!empty($watch_online_background)): ?>
            body .morenews-header.header-layout-compressed-full div.custom-menu-link > a,
            body .morenews-header.header-layout-centered div.custom-menu-link > a,
            body .morenews-header.header-layout-centered .top-bar-right div.custom-menu-link > a,
            body .morenews-header.header-layout-compressed-full .top-bar-right div.custom-menu-link > a,
            body .morenews-header.header-layout-side .search-watch div.custom-menu-link > a{
            background: <?php morenews_esc_custom_style($watch_online_background) ?>;
            }
        <?php endif; ?>

        <?php if (!empty($breaking_news_background)): ?>
            body .exclusive-posts .exclusive-now{
            background: <?php morenews_esc_custom_style($breaking_news_background) ?>;
            }
        <?php endif; ?>


        <?php if (!empty($footer_mailchimp_background_color)): ?>
            .aft-dark-mode .mailchimp-block,
            body .mailchimp-block{
            background-color: <?php morenews_esc_custom_style($footer_mailchimp_background_color) ?>;
            }
        <?php endif; ?>

        <?php if (!empty($footer_mailchimp_text_color)): ?>
            body .mailchimp-block, .mailchimp-block .block-title{
                color: <?php morenews_esc_custom_style($footer_mailchimp_text_color) ?>;
            }
        <?php endif; ?>


        <?php if (!empty($footer_background_color)): ?>
            body.aft-dark-mode footer.site-footer,
            body footer.site-footer{
            background-color: <?php morenews_esc_custom_style($footer_background_color) ?>;
            }
        <?php endif; ?>

        <?php if (!empty($footer_texts_color)): ?>
            body.aft-dark-mode footer .af-slick-navcontrols .slide-icon,
            body.aft-dark-mode footer h3,
            body.aft-default-mode footer .af-slick-navcontrols .slide-icon,
            body.aft-default-mode footer h3,
            footer.site-footer .wp-calendar-nav a,
            footer.site-footer .wp-block-latest-comments__comment-meta a,
            body.aft-default-mode.widget-title-border-bottom footer.site-footer .widget-title .heading-line,
            body.aft-default-mode.widget-title-border-center footer.site-footer .widget-title .heading-line,
            body.aft-default-mode.widget-title-border-none footer.site-footer .widget-title .heading-line,
            body.aft-default-mode.widget-title-border-bottom footer.site-footer .wp_post_author_widget .widget-title .header-after,
            body.aft-default-mode.widget-title-border-center footer.site-footer .wp_post_author_widget .widget-title .header-after,
            body.aft-default-mode.widget-title-border-none footer.site-footer .wp_post_author_widget .widget-title .header-after,
            body.aft-default-mode.widget-title-border-bottom footer.site-footer .aft-posts-tabs-panel .nav-tabs>li>a,
            body.aft-default-mode.widget-title-border-center footer.site-footer .aft-posts-tabs-panel .nav-tabs>li>a,
            body.aft-default-mode.widget-title-border-none footer.site-footer .aft-posts-tabs-panel .nav-tabs>li>a,

            body.aft-default-mode.widget-title-border-bottom footer.site-footer .wp-block-group .wp-block-heading,
            body.aft-default-mode.widget-title-border-center footer.site-footer .wp-block-group .wp-block-heading,

            body.aft-dark-mode.widget-title-border-bottom footer.site-footer .wp-block-group .wp-block-heading,
            body.aft-dark-mode.widget-title-border-center footer.site-footer .wp-block-group .wp-block-heading,

            body.aft-dark-mode.widget-title-border-bottom footer.site-footer .widget-title .heading-line,
            body.aft-dark-mode.widget-title-border-center footer.site-footer .widget-title .heading-line,
            body.aft-dark-mode.widget-title-border-none footer.site-footer .widget-title .heading-line,
            body.aft-dark-mode.widget-title-border-bottom footer.site-footer .wp_post_author_widget .widget-title .header-after,
            body.aft-dark-mode.widget-title-border-center footer.site-footer .wp_post_author_widget .widget-title .header-after,
            body.aft-dark-mode.widget-title-border-none footer.site-footer .wp_post_author_widget .widget-title .header-after,
            body.aft-dark-mode.widget-title-border-bottom footer.site-footer .aft-posts-tabs-panel .nav-tabs>li>a,
            body.aft-dark-mode.widget-title-border-center footer.site-footer .aft-posts-tabs-panel .nav-tabs>li>a,
            body.aft-dark-mode.widget-title-border-none footer.site-footer .aft-posts-tabs-panel .nav-tabs>li>a,

            body.aft-default-mode .site-footer .morenews-widget.widget_text a,
            body.aft-dark-mode .site-footer .morenews-widget.widget_text a,
            body.aft-default-mode .site-footer #wp-calendar thead,
            body.aft-default-mode .site-footer #wp-calendar tbody,
            body.aft-default-mode .site-footer #wp-calendar caption,
            body.aft-dark-mode .site-footer #wp-calendar thead,
            body.aft-dark-mode .site-footer #wp-calendar tbody,
            body.aft-dark-mode .site-footer #wp-calendar caption,
            body.aft-default-mode .site-footer .wp-block-tag-cloud a, 
            body.aft-default-mode .site-footer .tagcloud a,
            body.aft-default-mode .site-footer .wp-block-latest-comments li.wp-block-latest-comments__comment a,
            body.aft-dark-mode .site-footer .wp-block-latest-comments li.wp-block-latest-comments__comment a,

            .aft-default-mode .site-footer .wp-block-archives-list.wp-block-archives a:not(.has-text-color),
            .aft-default-mode .site-footer .wp-block-latest-posts a:not(.has-text-color), 
            .aft-default-mode .site-footer .wp-block-categories-list.wp-block-categories a:not(.has-text-color),
            .aft-dark-mode .site-footer .wp-block-archives-list.wp-block-archives a:not(.has-text-color),
            .aft-dark-mode .site-footer .wp-block-latest-posts a:not(.has-text-color), 
            .aft-dark-mode .site-footer .wp-block-categories-list.wp-block-categories a:not(.has-text-color),

            footer p:not([class*="wp-elements-"]) a, 
            footer p:not([class*="wp-elements-"]) a:visited, 
            .widget-title-border-center footer .wp-block-group .wp-block-heading:not(.has-text-color), 
            .widget-title-border-bottom footer .wp-block-group .wp-block-heading:not(.has-text-color),

            body.aft-dark-mode .site-footer .wp-block-tag-cloud a,
            body.aft-dark-mode .site-footer .tagcloud a,
            body.aft-dark-mode .site-footer .widget-area.color-pad .widget > ul > li,
            body .site-footer .widget ul.menu >li a,
            body .site-footer .widget > ul > li a,
            body .site-footer h4.af-author-display-name,
            body .site-footer .morenews_tabbed_posts_widget .nav-tabs > li > a,
            body .site-footer .color-pad .entry-meta span a,
            body .site-footer .color-pad .entry-meta span,
            body .site-footer .color-pad .read-title h3 a,
            body .site-footer .header-after1,
            body .site-footer .widget-title,
            body .site-footer .widget ul li,
            body .site-footer .color-pad ,
            body .site-footer ,
            body footer.site-footer{
            color: <?php morenews_esc_custom_style($footer_texts_color) ?>;
            }

        <?php endif; ?>

        <?php if (!empty($footer_credits_background_color)): ?>
            body.aft-dark-mode .site-info,
            body.aft-default-mode .site-info{
            background-color: <?php morenews_esc_custom_style($footer_credits_background_color) ?>;
            }
        <?php endif; ?>

        <?php if (!empty($footer_credits_texts_color)): ?>
            body.aft-dark-mode .site-info .color-pad a,
            body.aft-dark-mode .site-info .color-pad,
            body.aft-default-mode .site-info .color-pad a,
            body.aft-default-mode .site-info .color-pad{
            color: <?php morenews_esc_custom_style($footer_credits_texts_color) ?>;
            }
        <?php endif; ?>

        <?php if (!empty($category_color_1)): ?>
            .widget-title-fill-and-border .aft-posts-tabs-panel .nav-tabs>li.category-color-1>a.active,
            .widget-title-fill-and-no-border .aft-posts-tabs-panel .nav-tabs>li.category-color-1>a.active,
            .widget-title-border-bottom .widget-title.category-color-1 .heading-line::before,
            .widget-title-border-center .widget-title.category-color-1 .heading-line-after,
            .widget-title-fill-and-no-border .widget-title.category-color-1 .heading-line, 
            .widget-title-fill-and-border .widget-title.category-color-1 .heading-line,

            body .af-cat-widget-carousel a.morenews-categories.category-color-1{
                background-color: <?php morenews_esc_custom_style($category_color_1) ?>;
            }
            .widget-title-fill-and-no-border .aft-posts-tabs-panel .nav-tabs>li.category-color-1 a.active::after,
            .widget-title-fill-and-no-border .morenews-widget .widget-title.category-color-1::before, 
            .widget-title-fill-and-no-border .morenews-customizer .widget-title.category-color-1::before{
                border-top-color: <?php morenews_esc_custom_style($category_color_1) ?>;
            }
        <?php endif; ?>
        <?php if (!empty($category_texts_color_1)): ?>
            .widget-title-fill-and-border .aft-posts-tabs-panel .nav-tabs>li.category-color-1>a.active,
            .widget-title-fill-and-no-border .aft-posts-tabs-panel .nav-tabs>li.category-color-1>a.active,
            .widget-title-fill-and-no-border .widget-title.category-color-1 .heading-line, 
            .widget-title-fill-and-border .widget-title.category-color-1 .heading-line,

            body a.morenews-categories.category-color-1 ,
            body .af-cat-widget-carousel a.morenews-categories.category-color-1{
                color: <?php morenews_esc_custom_style($category_texts_color_1) ?>;
            }
        <?php endif; ?>

        <?php if (!empty($category_color_2)): ?>
            .widget-title-fill-and-border .aft-posts-tabs-panel .nav-tabs>li.category-color-2>a.active,
            .widget-title-fill-and-no-border .aft-posts-tabs-panel .nav-tabs>li.category-color-2>a.active,
            .widget-title-border-bottom .widget-title.category-color-2 .heading-line::before,
            .widget-title-border-center .widget-title.category-color-2 .heading-line-after,
            .widget-title-fill-and-no-border .widget-title.category-color-2 .heading-line, 
            .widget-title-fill-and-border .widget-title.category-color-2 .heading-line,

            body .af-cat-widget-carousel a.morenews-categories.category-color-2{
                background-color: <?php morenews_esc_custom_style($category_color_2) ?>;
            }

            .widget-title-fill-and-no-border .aft-posts-tabs-panel .nav-tabs>li.category-color-2 a.active::after,
            .widget-title-fill-and-no-border .morenews-widget .widget-title.category-color-2::before, 
            .widget-title-fill-and-no-border .morenews-customizer .widget-title.category-color-2::before{
                border-top-color: <?php morenews_esc_custom_style($category_color_2) ?>;
            }
        <?php endif; ?>
        <?php if (!empty($category_texts_color_2)): ?>
            .widget-title-fill-and-border .aft-posts-tabs-panel .nav-tabs>li.category-color-2>a.active,
            .widget-title-fill-and-no-border .aft-posts-tabs-panel .nav-tabs>li.category-color-2>a.active,
            .widget-title-fill-and-no-border .widget-title.category-color-2 .heading-line, 
            .widget-title-fill-and-border .widget-title.category-color-2 .heading-line,

            body a.morenews-categories.category-color-2 ,
            body .af-cat-widget-carousel a.morenews-categories.category-color-2{
                color: <?php morenews_esc_custom_style($category_texts_color_2) ?>;
            }
        <?php endif; ?>

        <?php if (!empty($category_color_3)): ?>
            .widget-title-fill-and-border .aft-posts-tabs-panel .nav-tabs>li.category-color-3>a.active,
            .widget-title-fill-and-no-border .aft-posts-tabs-panel .nav-tabs>li.category-color-3>a.active,
            .widget-title-border-bottom .widget-title.category-color-3 .heading-line::before,
            .widget-title-border-center .widget-title.category-color-3 .heading-line-after,
            .widget-title-fill-and-no-border .widget-title.category-color-3 .heading-line, 
            .widget-title-fill-and-border .widget-title.category-color-3 .heading-line,

            body .af-cat-widget-carousel a.morenews-categories.category-color-3{
                background-color: <?php morenews_esc_custom_style($category_color_3) ?>;
            }

            .widget-title-fill-and-no-border .aft-posts-tabs-panel .nav-tabs>li.category-color-3 a.active::after,
            .widget-title-fill-and-no-border .morenews-widget .widget-title.category-color-3::before, 
            .widget-title-fill-and-no-border .morenews-customizer .widget-title.category-color-3::before{
                border-top-color: <?php morenews_esc_custom_style($category_color_3) ?>;
            }
        <?php endif; ?>
        <?php if (!empty($category_texts_color_3)): ?>
            .widget-title-fill-and-border .aft-posts-tabs-panel .nav-tabs>li.category-color-3>a.active,
            .widget-title-fill-and-no-border .aft-posts-tabs-panel .nav-tabs>li.category-color-3>a.active,
            .widget-title-fill-and-no-border .widget-title.category-color-3 .heading-line, 
            .widget-title-fill-and-border .widget-title.category-color-3 .heading-line,

            body a.morenews-categories.category-color-3 ,
            body .af-cat-widget-carousel a.morenews-categories.category-color-3{
                color: <?php morenews_esc_custom_style($category_texts_color_3) ?>;
            }
        <?php endif; ?>

        <?php if (!empty($category_color_4)): ?>
            .widget-title-fill-and-border .aft-posts-tabs-panel .nav-tabs>li.category-color-4>a.active,
            .widget-title-fill-and-no-border .aft-posts-tabs-panel .nav-tabs>li.category-color-4>a.active,
            .widget-title-border-bottom .widget-title.category-color-4 .heading-line::before,
            .widget-title-border-center .widget-title.category-color-4 .heading-line-after,
            .widget-title-fill-and-no-border .widget-title.category-color-4 .heading-line, 
            .widget-title-fill-and-border .widget-title.category-color-4 .heading-line,

            body .af-cat-widget-carousel a.morenews-categories.category-color-4{
                background-color: <?php morenews_esc_custom_style($category_color_4) ?>;
            }

            .widget-title-fill-and-no-border .aft-posts-tabs-panel .nav-tabs>li.category-color-4 a.active::after,
            .widget-title-fill-and-no-border .morenews-widget .widget-title.category-color-4::before, 
            .widget-title-fill-and-no-border .morenews-customizer .widget-title.category-color-4::before{
                border-top-color: <?php morenews_esc_custom_style($category_color_4) ?>;
            }
        <?php endif; ?>
        <?php if (!empty($category_texts_color_4)): ?>
            .widget-title-fill-and-border .aft-posts-tabs-panel .nav-tabs>li.category-color-4>a.active,
            .widget-title-fill-and-no-border .aft-posts-tabs-panel .nav-tabs>li.category-color-4>a.active,
            .widget-title-fill-and-no-border .widget-title.category-color-4 .heading-line, 
            .widget-title-fill-and-border .widget-title.category-color-4 .heading-line,

            body a.morenews-categories.category-color-4 ,
            body .af-cat-widget-carousel a.morenews-categories.category-color-4{
                color: <?php morenews_esc_custom_style($category_texts_color_4) ?>;
            }
        <?php endif; ?>

        <?php if (!empty($category_color_5)): ?>
            .widget-title-fill-and-border .aft-posts-tabs-panel .nav-tabs>li.category-color-5>a.active,
            .widget-title-fill-and-no-border .aft-posts-tabs-panel .nav-tabs>li.category-color-5>a.active,
            .widget-title-border-bottom .widget-title.category-color-5 .heading-line::before,
            .widget-title-border-center .widget-title.category-color-5 .heading-line-after,
            .widget-title-fill-and-no-border .widget-title.category-color-5 .heading-line, 
            .widget-title-fill-and-border .widget-title.category-color-5 .heading-line,

            body .af-cat-widget-carousel a.morenews-categories.category-color-5{
                background-color: <?php morenews_esc_custom_style($category_color_5) ?>;
            }

            .widget-title-fill-and-no-border .aft-posts-tabs-panel .nav-tabs>li.category-color-5 a.active::after,
            .widget-title-fill-and-no-border .morenews-widget .widget-title.category-color-5::before, 
            .widget-title-fill-and-no-border .morenews-customizer .widget-title.category-color-5::before{
                border-top-color: <?php morenews_esc_custom_style($category_color_5) ?>;
            }
        <?php endif; ?>
        <?php if (!empty($category_texts_color_5)): ?>
            .widget-title-fill-and-border .aft-posts-tabs-panel .nav-tabs>li.category-color-5>a.active,
            .widget-title-fill-and-no-border .aft-posts-tabs-panel .nav-tabs>li.category-color-5>a.active,
            .widget-title-fill-and-no-border .widget-title.category-color-5 .heading-line, 
            .widget-title-fill-and-border .widget-title.category-color-5 .heading-line,

            body a.morenews-categories.category-color-5 ,
            body .af-cat-widget-carousel a.morenews-categories.category-color-5{
                color: <?php morenews_esc_custom_style($category_texts_color_5) ?>;
            }
        <?php endif; ?>

        <?php if (!empty($category_color_6)): ?>
            .widget-title-fill-and-border .aft-posts-tabs-panel .nav-tabs>li.category-color-6>a.active,
            .widget-title-fill-and-no-border .aft-posts-tabs-panel .nav-tabs>li.category-color-6>a.active,
            .widget-title-border-bottom .widget-title.category-color-6 .heading-line::before,
            .widget-title-border-center .widget-title.category-color-6 .heading-line-after,
            .widget-title-fill-and-no-border .widget-title.category-color-6 .heading-line, 
            .widget-title-fill-and-border .widget-title.category-color-6 .heading-line,

            body .af-cat-widget-carousel a.morenews-categories.category-color-6{
                background-color: <?php morenews_esc_custom_style($category_color_6) ?>;
            }

            .widget-title-fill-and-no-border .aft-posts-tabs-panel .nav-tabs>li.category-color-6 a.active::after,
            .widget-title-fill-and-no-border .morenews-widget .widget-title.category-color-6::before, 
            .widget-title-fill-and-no-border .morenews-customizer .widget-title.category-color-6::before{
                border-top-color: <?php morenews_esc_custom_style($category_color_6) ?>;
            }
        <?php endif; ?>
        <?php if (!empty($category_texts_color_6)): ?>
            .widget-title-fill-and-border .aft-posts-tabs-panel .nav-tabs>li.category-color-6>a.active,
            .widget-title-fill-and-no-border .aft-posts-tabs-panel .nav-tabs>li.category-color-6>a.active,
            .widget-title-fill-and-no-border .widget-title.category-color-6 .heading-line, 
            .widget-title-fill-and-border .widget-title.category-color-6 .heading-line,

            body a.morenews-categories.category-color-6 ,
            body .af-cat-widget-carousel a.morenews-categories.category-color-6{
                color: <?php morenews_esc_custom_style($category_texts_color_6) ?>;
            }
        <?php endif; ?>

        <?php if (!empty($category_color_7)): ?>
            .widget-title-fill-and-border .aft-posts-tabs-panel .nav-tabs>li.category-color-7>a.active,
            .widget-title-fill-and-no-border .aft-posts-tabs-panel .nav-tabs>li.category-color-7>a.active,
            .widget-title-border-bottom .widget-title.category-color-7 .heading-line::before,
            .widget-title-border-center .widget-title.category-color-7 .heading-line-after,
            .widget-title-fill-and-no-border .widget-title.category-color-7 .heading-line, 
            .widget-title-fill-and-border .widget-title.category-color-7 .heading-line,

            body .af-cat-widget-carousel a.morenews-categories.category-color-7{
                background-color: <?php morenews_esc_custom_style($category_color_7) ?>;
            }

            .widget-title-fill-and-no-border .aft-posts-tabs-panel .nav-tabs>li.category-color-7 a.active::after,
            .widget-title-fill-and-no-border .morenews-widget .widget-title.category-color-7::before, 
            .widget-title-fill-and-no-border .morenews-customizer .widget-title.category-color-7::before{
                border-top-color: <?php morenews_esc_custom_style($category_color_7) ?>;
            }
        <?php endif; ?>
        <?php if (!empty($category_texts_color_7)): ?>
            .widget-title-fill-and-border .aft-posts-tabs-panel .nav-tabs>li.category-color-7>a.active,
            .widget-title-fill-and-no-border .aft-posts-tabs-panel .nav-tabs>li.category-color-7>a.active,
            .widget-title-fill-and-no-border .widget-title.category-color-7 .heading-line, 
            .widget-title-fill-and-border .widget-title.category-color-7 .heading-line,

            body a.morenews-categories.category-color-7 ,
            body .af-cat-widget-carousel a.morenews-categories.category-color-7{
                color: <?php morenews_esc_custom_style($category_texts_color_7) ?>;
            }
        <?php endif; ?>


        <?php if (!empty($site_title_font)): ?>
            .site-title {
            font-family: <?php morenews_esc_custom_style($site_title_font) ?>;
            }
        <?php endif; ?>

        <?php if (!empty($primary_font)): ?>
            body,
            button,
            input,
            select,
            optgroup,
            .cat-links li a,
            .min-read,
            .af-social-contacts .social-widget-menu .screen-reader-text,
            textarea {
            font-family: <?php morenews_esc_custom_style($primary_font) ?>;
            }
        <?php endif; ?>

        <?php if (!empty($secondary_font)): ?>
            .wp-block-blockspare-blockspare-tabs .bs-tabs-title-list li a.bs-tab-title,
            .navigation.post-navigation .nav-links a,
            div.custom-menu-link > a,
            .exclusive-posts .exclusive-now span,
            .aft-popular-taxonomies-lists span,
            .exclusive-posts a,
            .aft-posts-tabs-panel .nav-tabs>li>a,
            .widget-title-border-bottom .aft-posts-tabs-panel .nav-tabs>li>a,
            .nav-tabs>li,
            .widget ul ul li, 
            .widget ul.menu >li ,
            .widget > ul > li,
            .wp-block-search__label,
            .wp-block-latest-posts.wp-block-latest-posts__list li,
            .wp-block-latest-comments li.wp-block-latest-comments__comment,
            .wp-block-group ul li a,
            .main-navigation ul li a,
            h1, h2, h3, h4, h5, h6 {
            font-family: <?php morenews_esc_custom_style($secondary_font) ?>;
            }
        <?php endif; ?>

        <?php if (!empty($global_font_size)): ?>
            body, button, input, select, optgroup, textarea {
            font-size: <?php morenews_esc_custom_style($global_font_size) ?>px;
            }
        <?php endif; ?>

        <?php if (!empty($morenews_section_title_font_size)): ?>
            .widget-title-border-center .wp-block-search__label,
            .widget-title-border-center .morenews-widget .wp-block-heading,
            .widget-title-border-bottom .wp-block-search__label,
            .widget-title-border-bottom .morenews-widget .wp-block-heading,
            .widget-title-border-none .wp-block-search__label,
            .widget-title-border-none .morenews-widget .wp-block-heading,
            .aft-posts-tabs-panel .nav-tabs>li>a,
            h4.af-author-display-name,
            body.widget-title-border-bottom .widget-title, 
            body.widget-title-border-center .widget-title, 
            body.widget-title-border-none .widget-title{
                font-size: <?php morenews_esc_custom_style($morenews_section_title_font_size) ?>px;
            }
            .widget-title-fill-and-border .aft-posts-tabs-panel .nav-tabs>li>a, 
            .widget-title-fill-and-no-border .aft-posts-tabs-panel .nav-tabs>li>a,
            .widget-title-fill-and-border h4.af-author-display-name,
            .widget-title-fill-and-no-border h4.af-author-display-name,
            .widget-title-fill-and-border .wp_post_author_widget .widget-title .header-after,
            .widget-title-fill-and-no-border .wp_post_author_widget .widget-title .header-after,

            .widget-title-fill-and-no-border .widget-title .heading-line, 
            .widget-title-fill-and-border .widget-title .heading-line{
                font-size: calc(<?php morenews_esc_custom_style($morenews_section_title_font_size) ?>px - 2px);
            }
        <?php endif; ?>

        <?php if (!empty($title_type_1)): ?>
            .mailchimp-block .block-title,
            .morenews_posts_slider_widget .read-single .read-details .read-title h3,
            article.latest-posts-full .read-title h3,
            .af-banner-carousel .read-title h3{
                font-size: <?php morenews_esc_custom_style($title_type_1) ?>px;
            }
        <?php endif; ?>
        
        
        <?php if (!empty($title_type_3)): ?>
            .widget:not(.morenews_social_contacts_widget) ul.menu >li,
            #sidr .morenews_express_posts_grid_widget .af-express-grid-wrap .read-single:first-child .read-title h3,
            #secondary .morenews_express_posts_grid_widget .af-express-grid-wrap .read-single:first-child .read-title h3,
            .morenews_express_posts_grid_widget .af-express-grid-wrap .read-single .read-title h3,
            .af-reated-posts .read-title h3,
            .af-main-banner-latest-posts .read-title h3,
            .four-col-masonry article.col-3 .read-title h3,
            .four-col-masonry article.latest-posts-grid.col-3 .read-title h3,
            .af-main-banner-thumb-posts .af-sec-post .read-title h3,
            .aft-main-banner-section.aft-banner-layout-2 .af-main-banner-thumb-posts .af-sec-post .read-title h3,
            .af-main-banner-categorized-posts.express-carousel .af-sec-post .read-title h3,
            .af-main-banner-featured-posts .read-title h3{
                font-size: <?php morenews_esc_custom_style($title_type_3) ?>px;
            }
            <?php endif; ?>

            <?php if (!empty($title_type_4)): ?>
                .widget ul ul li, 
                .widget > ul > li,
                .af-list-post .read-title h3,
                .navigation.post-navigation .nav-links a,
                .aft-trending-posts.list-part .af-double-column.list-style .read-title h3,
                .aft-main-banner-wrapper .aft-trending-posts.list-part .af-double-column.list-style .read-title h3,
                .af-trending-posts .aft-trending-posts.list-part .af-double-column.list-style .read-title h3,
                .morenews_posts_double_columns_widget .af-widget-body .af-double-column.list-style .read-title h3,
                .morenews_popular_news_widget .banner-vertical-slider .af-double-column.list-style .read-title h3,
                .af-main-banner-categorized-posts.express-posts .af-sec-post.list-part .read-title h3{
                    font-size: <?php morenews_esc_custom_style($title_type_4) ?>px;
                }
                .aft-banner-layout-1 .aft-main-banner-wrapper .aft-trending-posts.list-part .af-double-column.list-style .read-title h3,
                .aft-banner-layout-2 .aft-main-banner-wrapper .aft-trending-posts.list-part .af-double-column.list-style .read-title h3,
                .aft-banner-layout-3 .aft-main-banner-wrapper .aft-trending-posts.list-part .af-double-column.list-style .read-title h3{
                    font-size: calc(<?php morenews_esc_custom_style($title_type_4) ?>px - 2px);
                }
                .wp-block-tag-cloud a, 
                .tagcloud a{
                    font-size: <?php morenews_esc_custom_style($title_type_4) ?>px !important;
                }
            <?php endif; ?>
            
            <?php if (!empty($morenews_page_posts_paragraph_font_size)): ?>
                .entry-content{
                    font-size: <?php morenews_esc_custom_style($morenews_page_posts_paragraph_font_size) ?>px;
                }
            <?php endif; ?>
                    
            <?php if (!empty($morenews_page_posts_title_font_size)): ?>
                body.single-post .entry-title,
                h1.page-title{
                    font-size: <?php morenews_esc_custom_style($morenews_page_posts_title_font_size) ?>px;
                }
            <?php endif; ?>
    
            <?php if (!empty($title_type_2)): ?>
                #secondary .archive-list-post .read-title h3, 
                #sidr .archive-list-post .read-title h3, 
                footer .archive-list-post .read-title h3,
                body:not(.full-width-content) #primary .morenews_express_posts_grid_widget .af-express-grid-wrap .read-single:first-child .read-title h3,
                body .primary-footer-area:first-child:nth-last-child(3) .morenews_posts_slider_widget .read-single .read-details .read-title h3, 
                body .primary-footer-area:first-child:nth-last-child(3) ~ .primary-footer-area .morenews_posts_slider_widget .read-single .read-details .read-title h3,
                #sidr .morenews_posts_slider_widget .read-single .read-details .read-title h3 ,
                #secondary .morenews_posts_slider_widget .read-single .read-details .read-title h3,
                .morenews_posts_double_columns_widget .af-widget-body .af-sec-post .read-title h3,
                .archive-list-post .read-title h3,
                .archive-masonry-post .read-title h3,
                body:not(.archive-first-post-full) .archive-layout-grid.four-col-masonry article:nth-of-type(5n).archive-image-list-alternate  .archive-grid-post .read-title h3,
                body:not(.archive-first-post-full) .archive-layout-grid.two-col-masonry article:nth-of-type(3n).archive-image-list-alternate  .archive-grid-post .read-title h3,
                body:not(.archive-first-post-full) .archive-layout-grid.three-col-masonry article:nth-of-type(4n).archive-image-list-alternate  .archive-grid-post .read-title h3,
                .archive-first-post-full .archive-layout-grid.four-col-masonry article:nth-of-type(5n+6).archive-image-list-alternate  .archive-grid-post .read-title h3,
                .archive-first-post-full .archive-layout-grid.two-col-masonry article:nth-of-type(3n+4).archive-image-list-alternate  .archive-grid-post .read-title h3,
                .archive-first-post-full .archive-layout-grid.three-col-masonry article:nth-of-type(4n+5).archive-image-list-alternate  .archive-grid-post .read-title h3,
                article.latest-posts-grid .read-title h3,
                .two-col-masonry article.latest-posts-grid.col-3 .read-title h3,
                .af-main-banner-categorized-posts.express-posts .af-sec-post:not(.list-part) .read-title h3,
                .af-main-banner-thumb-posts .read-single:not(.af-cat-widget-carousel) .read-title h3{
                font-size: <?php morenews_esc_custom_style($title_type_2) ?>px;
                }
                @media screen and (max-width: 768px) {
                    body:not(.archive-first-post-full) .archive-layout-grid.four-col-masonry article:nth-of-type(5n).archive-image-list-alternate  .archive-grid-post .read-title h3,
                    body:not(.archive-first-post-full) .archive-layout-grid.two-col-masonry article:nth-of-type(3n).archive-image-list-alternate  .archive-grid-post .read-title h3,
                    body:not(.archive-first-post-full) .archive-layout-grid.three-col-masonry article:nth-of-type(4n).archive-image-list-alternate  .archive-grid-post .read-title h3 {
                        font-size: 20px;
                    }
                }
            <?php endif; ?>

        <?php if (!empty($title_font_weight)): ?>
            .widget-title-border-bottom .wp_post_author_widget .widget-title .header-after,
            .widget-title-border-bottom .widget-title .heading-line,
            .widget-title-border-bottom .aft-posts-tabs-panel .nav-tabs>li>a,

            .widget-title-border-center .aft-posts-tabs-panel .nav-tabs>li>a,
            .widget-title-border-center .wp_post_author_widget .widget-title .header-after,
            .widget-title-border-center .widget-title .heading-line,

            .widget-title-border-none .aft-posts-tabs-panel .nav-tabs>li>a,
            .widget-title-border-none .wp_post_author_widget .widget-title .header-after,
            .widget-title-border-none .widget-title .heading-line,

            .aft-readmore-wrapper a.aft-readmore,
            button, input[type="button"], input[type="reset"], input[type="submit"],
            .widget-title-fill-and-border .wp_post_author_widget .widget-title .header-after,
            .widget-title-fill-and-no-border .wp_post_author_widget .widget-title .header-after,
            .widget-title-fill-and-no-border .widget-title .heading-line,
            .widget-title-fill-and-border .widget-title .heading-line,
            .aft-posts-tabs-panel .nav-tabs>li>a,
            .aft-main-banner-wrapper .widget-title .heading-line,
            .aft-popular-taxonomies-lists span,
            .exclusive-posts .exclusive-now ,
            .exclusive-posts .marquee a,
            div.custom-menu-link > a,
            .main-navigation .menu-desktop > li, .main-navigation .menu-desktop > ul > li,
            .site-title, h1, h2, h3, h4, h5, h6 {
            font-weight: <?php morenews_esc_custom_style($title_font_weight) ?>;
            }
        <?php endif; ?>

        <?php if (!empty($letter_spacing)): ?>
            body,
            .widget-title span, .header-after1 span {
            letter-spacing: <?php morenews_esc_custom_style($letter_spacing) ?>px;
            }
        <?php endif; ?>

        <?php if (!empty($title_line_height)): ?>

            h1, h2, h3, h4, h5, h6,
            .widget-title span,
            .header-after1 span,
            .read-title h3 {
            line-height: <?php morenews_esc_custom_style($title_line_height) ?>;
            }
        <?php endif; ?>

        <?php if (!empty($line_height)): ?>
            body{
            line-height: <?php morenews_esc_custom_style($line_height) ?>;
            }
        <?php endif; ?>
        
        .elementor-page .elementor-section.elementor-section-full_width > .elementor-container,
        .elementor-page .elementor-section.elementor-section-boxed > .elementor-container,
        .elementor-default .elementor-section.elementor-section-full_width > .elementor-container,
        .elementor-default .elementor-section.elementor-section-boxed > .elementor-container{
            max-width: 1204px;
        }

        .container-wrapper .elementor {
            max-width: 100%;
        }
        .full-width-content .elementor-section-stretched,
        .align-content-left .elementor-section-stretched,
        .align-content-right .elementor-section-stretched {
            max-width: 100%;
            left: 0 !important;
        }
        <?php
        return ob_get_clean();
    }
}

if (!function_exists('morenews_esc_custom_style(')) {

    function morenews_esc_custom_style($props)  {
        echo wp_kses( $props, array( "\'", '\"' ) );
        
    }
}
