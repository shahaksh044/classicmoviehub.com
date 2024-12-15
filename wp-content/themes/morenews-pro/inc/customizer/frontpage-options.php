<?php

/**
 * Option Panel
 *
 * @package MoreNews
 */

$morenews_default = morenews_get_default_theme_options();


/**
 * Frontpage options section
 *
 * @package MoreNews
 */


// Add Frontpage Options Panel.
$wp_customize->add_panel('main_banner_option_panel',
    array(
        'title' => esc_html__('Main Banner Options', 'morenews'),
        'priority' => 199,
        'capability' => 'edit_theme_options',
    )
);


/**
 * Main Banner Slider Section
 * */

// Main banner Sider Section.
$wp_customize->add_section('frontpage_main_banner_section_settings',
    array(
        'title' => esc_html__('Main Banner', 'morenews'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'main_banner_option_panel',
    )
);


// Setting - show_main_news_section.
$wp_customize->add_setting('show_main_news_section',
    array(
        'default' => $morenews_default['show_main_news_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_checkbox',
    )
);

$wp_customize->add_control('show_main_news_section',
    array(
        'label' => esc_html__('Enable Main Banner Section', 'morenews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'checkbox',
        'priority' => 100,

    )
);


// Setting banner_advertisement_section.
$wp_customize->add_setting('main_banner_background_section',
    array(
        'default' => $default['main_banner_background_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(
    new WP_Customize_Cropped_Image_Control($wp_customize, 'main_banner_background_section',
        array(
            'label' => esc_html__('Main Banner Background Image', 'morenews'),
            'description' => sprintf(esc_html__('Recommended Size %1$s px X %2$s px', 'morenews'), 1024, 800),
            'section' => 'frontpage_main_banner_section_settings',
            'width' => 1024,
            'height' => 800,
            'flex_width' => true,
            'flex_height' => true,
            'priority' => 100,
            'active_callback' => 'morenews_main_banner_section_status'
        )
    )
);

//main banner layout

$wp_customize->add_setting('select_main_banner_layout_section',
    array(
        'default' => $morenews_default['select_main_banner_layout_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);

$wp_customize->add_control('select_main_banner_layout_section',
    array(
        'label' => esc_html__('Select Main Banner Layout', 'morenews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'select',
        'choices' => array(
            'layout-3' => esc_html__("Slider, Trending and Tabs", 'morenews'),
            'layout-1' => esc_html__("Slider, Editors Picks and Tabs", 'morenews'),
            'layout-2' => esc_html__("Slider, Editors Picks and Trending", 'morenews'),
            'layout-4' => esc_html__("Slider and Editors Picks", 'morenews'),
            'layout-5' => esc_html__("Slider and Tabs", 'morenews'),
            'layout-6' => esc_html__("Slider and Trending", 'morenews'),
            'layout-7' => esc_html__("Carousel", 'morenews'),
        ),
        'priority' => 100,
        'active_callback' => 'morenews_main_banner_section_status'
    ));

//main banner order

$wp_customize->add_setting('select_main_banner_order',
    array(
        'default' => $morenews_default['select_main_banner_order'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);

$wp_customize->add_control('select_main_banner_order',
    array(
        'label' => esc_html__('Select Main Banner Order', 'morenews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'select',
        'choices' => array(
            'order-1' => esc_html__("Order 1", 'morenews'),
            'order-2' => esc_html__("Order 2", 'morenews'),
            'order-3' => esc_html__("Order 3", 'morenews'),
            'order-4' => esc_html__("Order 4", 'morenews'),
            'order-5' => esc_html__("Order 5", 'morenews'),
            'order-6' => esc_html__("Order 6", 'morenews'),
        ),
        'priority' => 100,
        'active_callback' => 'morenews_main_banner_3_col_section_status'
    ));


//main banner order

$wp_customize->add_setting('select_main_banner_order_2',
    array(
        'default' => $morenews_default['select_main_banner_order_2'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);

$wp_customize->add_control('select_main_banner_order_2',
    array(
        'label' => esc_html__('Select Main Banner Order', 'morenews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'select',
        'choices' => array(
            'order-1' => esc_html__("Order 1", 'morenews'),
            'order-2' => esc_html__("Order 2", 'morenews'),
        ),
        'priority' => 100,
        'active_callback' => 'morenews_main_banner_2_col_section_status'
    ));

//main banner order

$wp_customize->add_setting('select_main_banner_order_3',
    array(
        'default' => $morenews_default['select_main_banner_order_3'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);

$wp_customize->add_control('select_main_banner_order_3',
    array(
        'label' => esc_html__('Select Main Banner Order', 'morenews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'select',
        'choices' => array(
            'order-1' => esc_html__("Order 1", 'morenews'),
            'order-2' => esc_html__("Order 2", 'morenews'),
            'order-3' => esc_html__("Order 3", 'morenews'),
            'order-4' => esc_html__("Order 4", 'morenews'),
        ),
        'priority' => 100,
        'active_callback' => 'morenews_main_banner_2_col_2_row_section_status'
    ));



/**
 * Main Banner Section
 * */

//section title
$wp_customize->add_setting('main_banner_panel_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new MoreNews_Section_Title(
        $wp_customize,
        'main_banner_panel_section_title',
        array(
            'label' => esc_html__('Main News Section ', 'morenews'),
            'section' => 'frontpage_main_banner_section_settings',
            'priority' => 100,
            'active_callback' => 'morenews_main_banner_section_status',
        )
    )
);

$wp_customize->add_setting('main_banner_news_section_title',
    array(
        'default' => $morenews_default['main_banner_news_section_title'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('main_banner_news_section_title',
    array(
        'label' => esc_html__('Section Title ', 'morenews'),
        'section' => 'frontpage_main_banner_section_settings',
        'settings' => 'main_banner_news_section_title',
        'type' => 'text',
        'priority' => 100,
        'active_callback' => 'morenews_main_banner_section_status'

    )

);



// Setting - select_main_banner_section_mode.
$wp_customize->add_setting('select_main_banner_carousel_filterby',
    array(
        'default' => $morenews_default['select_main_banner_carousel_filterby'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);

$wp_customize->add_control('select_main_banner_carousel_filterby',
    array(
        'label' => esc_html__('Filter Posts By', 'morenews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'select',
        'choices' => array(
            'cat' => esc_html__("Category", 'morenews'),
            'tag' => esc_html__("Tag", 'morenews'),
            'comment' => esc_html__("Comment Count", 'morenews'),
            'view' => esc_html__("View Count", 'morenews'),
        ),
        'priority' => 100,
        'active_callback' => 'morenews_main_banner_section_status'
    ));


// Setting - drop down category for slider.
$wp_customize->add_setting('select_slider_news_category',
    array(
        'default' => $morenews_default['select_slider_news_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(new MoreNews_Dropdown_Taxonomies_Control($wp_customize, 'select_slider_news_category',
    array(
        'label' => esc_html__('Select Category', 'morenews'),
        'description' => esc_html__('Select category to be shown on main slider section', 'morenews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'dropdown-taxonomies',
        'taxonomy' => 'category',
        'priority' => 100,
        'active_callback' => function ($control) {
            return (
                morenews_main_banner_section_status($control)
                &&
                morenews_main_banner_section_filterby_cat_status($control)
            );
        },

    )));


// Setting - drop down category for slider.
$wp_customize->add_setting('select_slider_news_tag',
    array(
        'default' => $morenews_default['select_slider_news_tag'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(new MoreNews_Dropdown_Taxonomies_Control($wp_customize, 'select_slider_news_tag',
    array(
        'label' => esc_html__('Select Tag', 'morenews'),
        'description' => esc_html__('Select tag to be shown on main slider section', 'morenews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'dropdown-taxonomies',
        'taxonomy' => 'post_tag',
        'priority' => 100,
        'active_callback' => function ($control) {
            return (
                morenews_main_banner_section_status($control)
                &&
                morenews_main_banner_section_filterby_tag_status($control)
            );
        },
    )));


// Setting - number_of_slides.
$wp_customize->add_setting('number_of_slides',
    array(
        'default' => $morenews_default['number_of_slides'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);
$wp_customize->add_control('number_of_slides',
    array(
        'label' => esc_html__('Number of Posts', 'morenews'),
        'description' => esc_html__('Accepts any postive number.', 'morenews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'number',
        'priority' => 100,
        'active_callback' => 'morenews_main_banner_section_status'

    )
);


/**
 * Editor's Picks Post Section
 * */


//section title
$wp_customize->add_setting('editors_picks_panel_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new MoreNews_Section_Title(
        $wp_customize,
        'editors_picks_panel_section_title',
        array(
            'label' => esc_html__("Editor's Picks Section", 'morenews'),
            'section' => 'frontpage_main_banner_section_settings',
            'priority' => 100,
            'active_callback' => function($control){
                return(
                    morenews_main_banner_section_status($control)
                    &&
                    morenews_main_banner_layout_editor_picks_status($control)
                );
            },
        )
    )
);


$wp_customize->add_setting('main_editors_picks_section_title',
    array(
        'default' => $morenews_default['main_editors_picks_section_title'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('main_editors_picks_section_title',
    array(
        'label' => esc_html__('Section Title ', 'morenews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'text',
        'priority' => 100,
        'active_callback' => function($control){
            return(
                morenews_main_banner_section_status($control)
                &&
                morenews_main_banner_layout_editor_picks_status($control)
            );
        },

    )

);


// Setting - select_main_banner_section_mode.
$wp_customize->add_setting('select_editors_picks_filterby',
    array(
        'default' => $morenews_default['select_editors_picks_filterby'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);

$wp_customize->add_control('select_editors_picks_filterby',
    array(
        'label' => esc_html__('Filter Posts By', 'morenews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'select',
        'choices' => array(
            'cat' => esc_html__("Category", 'morenews'),
            'tag' => esc_html__("Tag", 'morenews'),
            'comment' => esc_html__("Comment Count", 'morenews'),
            'view' => esc_html__("View Count", 'morenews'),
        ),
        'priority' => 100,
        'active_callback' => function($control){
            return(
                morenews_main_banner_section_status($control)
                &&
                morenews_main_banner_layout_editor_picks_status($control)
            );
        },
    ));


// Setting - drop down category for slider.
$wp_customize->add_setting('select_editors_picks_news_category',
    array(
        'default' => $morenews_default['select_editors_picks_news_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(new MoreNews_Dropdown_Taxonomies_Control($wp_customize, 'select_editors_picks_news_category',
    array(
        'label' => esc_html__('Select', 'morenews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'dropdown-taxonomies',
        'taxonomy' => 'category',
        'priority' => 100,
        'active_callback' => function ($control) {
            return (
                morenews_main_banner_section_status($control)
                &&
                morenews_editors_picks_section_filterby_cat_status($control)
                &&
                morenews_main_banner_layout_editor_picks_status($control)
            );
        },

    )));


// Setting - drop down category for slider.
$wp_customize->add_setting('select_editors_picks_news_tag',
    array(
        'default' => $morenews_default['select_editors_picks_news_tag'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(new MoreNews_Dropdown_Taxonomies_Control($wp_customize, 'select_editors_picks_news_tag',
    array(
        'label' => esc_html__('Select Tag', 'morenews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'dropdown-taxonomies',
        'taxonomy' => 'post_tag',
        'priority' => 100,
        'active_callback' => function ($control) {
            return (
                morenews_main_banner_section_status($control)
                &&
                morenews_editors_picks_section_filterby_tag_status($control)
                &&
                morenews_main_banner_layout_editor_picks_status($control)
            );
        },
    )));

/**
 * Trending Post Section
 * */

//section title
$wp_customize->add_setting('trending_post_panel_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new MoreNews_Section_Title(
        $wp_customize,
        'trending_post_panel_section_title',
        array(
            'label' => esc_html__("Trending Section", 'morenews'),
            'section' => 'frontpage_main_banner_section_settings',
            'priority' => 100,
            'active_callback' => function ($control) {
                return (
                    morenews_main_banner_section_status($control)
                    &&
                    morenews_main_banner_layout_trending_status($control)
                );
            },
        )
    )
);


$wp_customize->add_setting('main_trending_news_section_title',
    array(
        'default' => $morenews_default['main_trending_news_section_title'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('main_trending_news_section_title',
    array(
        'label' => esc_html__('Section Title ', 'morenews'),
        'section' => 'frontpage_main_banner_section_settings',
        'settings' => 'main_trending_news_section_title',
        'type' => 'text',
        'priority' => 100,
        'active_callback' => function ($control) {
            return (
                morenews_main_banner_section_status($control)
                &&
                morenews_main_banner_layout_trending_status($control)
            );
        },

    )

);


// Setting - select_main_banner_section_mode.
$wp_customize->add_setting('select_trending_post_filterby',
    array(
        'default' => $morenews_default['select_trending_post_filterby'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);

$wp_customize->add_control('select_trending_post_filterby',
    array(
        'label' => esc_html__('Filter Posts By', 'morenews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'select',
        'choices' => array(
            'cat' => esc_html__("Category", 'morenews'),
            'tag' => esc_html__("Tag", 'morenews'),
            'comment' => esc_html__("Comment Count", 'morenews'),
            'view' => esc_html__("View Count", 'morenews'),
        ),
        'priority' => 100,
        'active_callback' => function ($control) {
            return (
                morenews_main_banner_section_status($control)
                &&
                morenews_main_banner_layout_trending_status($control)
            );
        },
    ));



// Setting - drop down category for slider.
$wp_customize->add_setting('select_trending_post_category',
    array(
        'default' => $morenews_default['select_trending_post_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(new MoreNews_Dropdown_Taxonomies_Control($wp_customize, 'select_trending_post_category',
    array(
        'label' => esc_html__('Select', 'morenews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'dropdown-taxonomies',
        'taxonomy' => 'category',
        'priority' => 100,
        'active_callback' => function ($control) {
            return (
                morenews_main_banner_section_status($control)
                &&
                morenews_trending_post_section_filterby_cat_status($control)
                &&
                morenews_main_banner_layout_trending_status($control)
            );
        },

    )));



// Setting - drop down category for slider.
$wp_customize->add_setting('select_trending_post_tag',
    array(
        'default' => $morenews_default['select_trending_post_tag'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(new MoreNews_Dropdown_Taxonomies_Control($wp_customize, 'select_trending_post_tag',
    array(
        'label' => esc_html__('Select Tag', 'morenews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'dropdown-taxonomies',
        'taxonomy' => 'post_tag',
        'priority' => 100,
        'active_callback' => function ($control) {
            return (
                morenews_main_banner_section_status($control)
                &&
                morenews_trending_post_section_filterby_tag_status($control)
                &&
                morenews_main_banner_layout_trending_status($control)
            );
        },

    )));



/**
 * Latest Post Section
 * */

//section title
$wp_customize->add_setting('banner_latest_post_panel_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new MoreNews_Section_Title(
        $wp_customize,
        'banner_latest_post_panel_section_title',
        array(
            'label' => esc_html__("Latest Section", 'morenews'),
            'section' => 'frontpage_main_banner_section_settings',            
            'priority' => 100,
            'active_callback' => function ($control) {
                return (
                    morenews_main_banner_section_status($control)
                    &&
                    morenews_main_banner_layout_tabs_status($control)
                );
            },
        )
    )
);



$wp_customize->add_setting('main_latest_news_section_title',
    array(
        'default' => $morenews_default['main_latest_news_section_title'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('main_latest_news_section_title',
    array(
        'label' => esc_html__('Section Title ', 'morenews'),
        'section' => 'frontpage_main_banner_section_settings',
        'settings' => 'main_latest_news_section_title',
        'type' => 'text',
        'priority' => 100,
        'active_callback' => function ($control) {
            return (
                morenews_main_banner_section_status($control)
                &&
                morenews_main_banner_layout_tabs_status($control)
            );
        },

    )

);

// Setting - select_main_banner_section_mode.
$wp_customize->add_setting('select_banner_latest_post_filterby',
    array(
        'default' => $morenews_default['select_banner_latest_post_filterby'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);

$wp_customize->add_control('select_banner_latest_post_filterby',
    array(
        'label' => esc_html__('Filter Posts By', 'morenews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'select',
        'choices' => array(
            'cat' => esc_html__("Category", 'morenews'),
            'tag' => esc_html__("Tag", 'morenews'),
            'comment' => esc_html__("Comment Count", 'morenews'),
            'view' => esc_html__("View Count", 'morenews'),
        ),
        'priority' => 100,
        'active_callback' => function ($control) {
            return (
                morenews_main_banner_section_status($control)
                &&
                morenews_main_banner_layout_tabs_status($control)
            );
        },
    ));



// Setting - drop down category for slider.
$wp_customize->add_setting('select_banner_latest_post_category',
    array(
        'default' => $morenews_default['select_banner_latest_post_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(new MoreNews_Dropdown_Taxonomies_Control($wp_customize, 'select_banner_latest_post_category',
    array(
        'label' => esc_html__('Select', 'morenews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'dropdown-taxonomies',
        'taxonomy' => 'category',
        'priority' => 100,
        'active_callback' => function ($control) {
            return (
                morenews_main_banner_section_status($control)
                &&
                morenews_banner_latest_post_section_filterby_cat_status($control)
                &&
                morenews_main_banner_layout_tabs_status($control)
            );
        },

    )));


// Setting - drop down category for slider.
$wp_customize->add_setting('select_latest_post_tag',
    array(
        'default' => $morenews_default['select_latest_post_tag'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(new MoreNews_Dropdown_Taxonomies_Control($wp_customize, 'select_latest_post_tag',
    array(
        'label' => esc_html__('Select Tag', 'morenews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'dropdown-taxonomies',
        'taxonomy' => 'post_tag',
        'priority' => 100,
        'active_callback' => function ($control) {
            return (
                morenews_main_banner_section_status($control)
                &&
                morenews_banner_latest_post_section_filterby_tag_status($control)
                &&
                morenews_main_banner_layout_tabs_status($control)

            );
        },

    )));


/**
 * Popular Post Section
 * */

//section title
$wp_customize->add_setting('popular_post_panel_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new MoreNews_Section_Title(
        $wp_customize,
        'popular_post_panel_section_title',
        array(
            'label' => esc_html__("Popular Section", 'morenews'),
            'section' => 'frontpage_main_banner_section_settings',
            'priority' => 100,
            'active_callback' => function ($control) {
                return (
                    morenews_main_banner_section_status($control)
                    &&
                    morenews_main_banner_layout_tabs_status($control)

                );
            },
        )
    )
);


$wp_customize->add_setting('main_popular_news_section_title',
    array(
        'default' => $morenews_default['main_popular_news_section_title'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('main_popular_news_section_title',
    array(
        'label' => esc_html__('Section Title ', 'morenews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'text',
        'priority' => 100,
        'active_callback' => function ($control) {
            return (
                morenews_main_banner_section_status($control)
                &&
                morenews_main_banner_layout_tabs_status($control)
            );
        },

    )

);

// Setting - select_main_banner_section_mode.
$wp_customize->add_setting('select_popular_post_filterby',
    array(
        'default' => $morenews_default['select_popular_post_filterby'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);

$wp_customize->add_control('select_popular_post_filterby',
    array(
        'label' => esc_html__('Filter Posts By', 'morenews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'select',
        'choices' => array(
            'cat' => esc_html__("Category", 'morenews'),
            'tag' => esc_html__("Tag", 'morenews'),
            'comment' => esc_html__("Comment Count", 'morenews'),
            'view' => esc_html__("View Count", 'morenews'),
        ),
        'priority' => 100,
        'active_callback' => function ($control) {
            return (
                morenews_main_banner_section_status($control)
                &&
                morenews_main_banner_layout_tabs_status($control)

            );
        },
    ));



// Setting - drop down category for slider.
$wp_customize->add_setting('select_popular_post_category',
    array(
        'default' => $morenews_default['select_popular_post_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(new MoreNews_Dropdown_Taxonomies_Control($wp_customize, 'select_popular_post_category',
    array(
        'label' => esc_html__('Select', 'morenews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'dropdown-taxonomies',
        'taxonomy' => 'category',
        'priority' => 100,
        'active_callback' => function ($control) {
            return (
                morenews_main_banner_section_status($control)
                &&
                morenews_main_banner_layout_tabs_status($control)
                &&
                morenews_popular_post_section_filterby_cat_status($control)

            );
        },

    )));

// Setting - drop down category for slider.
$wp_customize->add_setting('select_popular_post_tag',
    array(
        'default' => $morenews_default['select_popular_post_tag'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(new MoreNews_Dropdown_Taxonomies_Control($wp_customize, 'select_popular_post_tag',
    array(
        'label' => esc_html__('Select Tag', 'morenews'),
        'section' => 'frontpage_main_banner_section_settings',
        'type' => 'dropdown-taxonomies',
        'taxonomy' => 'post_tag',
        'priority' => 100,
        'active_callback' => function ($control) {
            return (
                morenews_main_banner_section_status($control)
                &&
                morenews_main_banner_layout_tabs_status($control)
                &&
                morenews_popular_post_section_filterby_tag_status($control)

            );
        },

    )));



//Popular Tags
// Advertisement Section.
$wp_customize->add_section('frontpage_popular_tags_settings',
    array(
        'title' => esc_html__('Popular Tags', 'morenews'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'main_banner_option_panel',
    )
);


// Setting banner_advertisement_section.
$wp_customize->add_setting('frontpage_popular_tags_settings',
    array(
        'default' => $morenews_default['frontpage_popular_tags_settings'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_setting('show_popular_tags_section',
    array(
        'default' => $morenews_default['show_popular_tags_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_checkbox',
    )
);
$wp_customize->add_control('show_popular_tags_section',
    array(
        'label' => esc_html__('Enable Trending Tags', 'morenews'),
        'section' => 'frontpage_popular_tags_settings',
        'type' => 'checkbox',
        'priority' => 100,
    )
);


$wp_customize->add_setting('frontpage_popular_tags_section_title',
    array(
        'default' => $morenews_default['frontpage_popular_tags_section_title'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('frontpage_popular_tags_section_title',
    array(
        'label' => esc_html__('Section Title ', 'morenews'),
        'section' => 'frontpage_popular_tags_settings',
        'settings' => 'frontpage_popular_tags_section_title',
        'type' => 'text',
        'priority' => 100,
        'active_callback' => 'morenews_popular_tags_section_status'

    )

);


//Flash news
$wp_customize->add_section('frontpage_flash_news_settings',
    array(
        'title' => esc_html__('Breaking News', 'morenews'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'main_banner_option_panel',
    )
);


// Setting banner_advertisement_section.
$wp_customize->add_setting('frontpage_flash_news_settings',
    array(
        'default' => $morenews_default['frontpage_flash_news_settings'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_setting('show_flash_news_section',
    array(
        'default' => $morenews_default['show_flash_news_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_checkbox',
    )
);
$wp_customize->add_control('show_flash_news_section',
    array(
        'label' => esc_html__('Enable Flash News', 'morenews'),
        'section' => 'frontpage_flash_news_settings',
        'type' => 'checkbox',
        'priority' => 100,
    )
);


$wp_customize->add_setting('flash_news_title',
    array(
        'default' => $morenews_default['flash_news_title'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('flash_news_title',
    array(
        'label' => esc_html__('Section Title ', 'morenews'),
        'section' => 'frontpage_flash_news_settings',
        'settings' => 'flash_news_title',
        'type' => 'text',
        'priority' => 100,
        'active_callback' => 'morenews_flash_posts_section_status'

    )

);

$wp_customize->add_setting('select_flash_news_category',
    array(
        'default'           => $morenews_default['select_flash_news_category'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(new morenews_Dropdown_Taxonomies_Control($wp_customize, 'select_flash_news_category',
    array(
        'label'       => esc_html__('Flash Posts Category', 'morenews'),
        'description' => esc_html__('Select category to be shown on trending posts ', 'morenews'),
        'section'     => 'frontpage_flash_news_settings',
        'type'        => 'dropdown-taxonomies',
        'taxonomy'    => 'category',
        'priority'    => 100,
        'active_callback' => 'morenews_flash_posts_section_status'
    )));



// Setting - flash news.
$wp_customize->add_setting('number_of_flash_news',
    array(
        'default'           => $morenews_default['number_of_flash_news'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control( 'number_of_flash_news',
    array(
        'label'    => __( 'Number of Flash Posts ', 'morenews' ),
        'section'  => 'frontpage_flash_news_settings',
        'type'     => 'number',
        'priority' => 100,
        'active_callback' => 'morenews_flash_posts_section_status'
    )
);

/**
 * Frontpage options section
 *
 * @package MoreNews
 */


// Add Frontpage Options Panel.
$wp_customize->add_panel('frontpage_option_panel',
    array(
        'title' => esc_html__('Frontpage Options', 'morenews'),
        'priority' => 199,
        'capability' => 'edit_theme_options',
    )
);



/**
 * Featured Post Section
 * */

    $wp_customize->add_section('frontpage_featured_posts_settings',
        array(
            'title' => esc_html__('Featured Posts', 'morenews'),
            'priority' => 50,
            'capability' => 'edit_theme_options',
            'panel' => 'frontpage_option_panel',
        )
    );




// Setting - show_featured_posts_section.
    $wp_customize->add_setting('show_featured_posts_section',
        array(
            'default' => $morenews_default['show_featured_posts_section'],
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'morenews_sanitize_checkbox',
        )
    );

    $wp_customize->add_control('show_featured_posts_section',
        array(
            'label' => esc_html__('Enable Featured Post Section', 'morenews'),
            'section' => 'frontpage_featured_posts_settings',
            'type' => 'checkbox',
            'priority' => 22,


        )
    );

    $wp_customize->add_setting('featured_news_section_title',
        array(
            'default' => $morenews_default['featured_news_section_title'],
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control('featured_news_section_title',
        array(
            'label' => esc_html__('Section Title ', 'morenews'),
            'section' => 'frontpage_featured_posts_settings',
            'settings' => 'featured_news_section_title',
            'type' => 'text',
            'priority' => 130,
            'active_callback' => 'morenews_featured_posts_section'

        )

    );

    //List of categories

    $wp_customize->add_setting('select_featured_news_category',
        array(
            'default' => $morenews_default['select_featured_news_category'],
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'absint',
        )
    );

    $wp_customize->add_control(new MoreNews_Dropdown_Taxonomies_Control($wp_customize, 'select_featured_news_category',
        array(
            'label' => sprintf(__('Select ', 'morenews')),
            'description' => esc_html__('Select category to be shown on featured section ', 'morenews'),
            'section' => 'frontpage_featured_posts_settings',
            'type' => 'dropdown-taxonomies',
            'taxonomy' => 'category',
            'priority' => 130,
            'active_callback' => 'morenews_featured_posts_section',


        )));

// Setting - number of posts
    $wp_customize->add_setting('number_of_featured_news',
        array(
            'default' => $morenews_default['number_of_featured_news'],
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'absint',
        )
    );

    $wp_customize->add_control('number_of_featured_news',
        array(
            'label' => __('Number of Posts', 'morenews'),
            'section' => 'frontpage_featured_posts_settings',
            'type' => 'number',
            'priority' => 130,
            'active_callback' => 'morenews_featured_posts_section'
        )
    );

    /*
     * Youtube Video section
     */

    $wp_customize->add_section('frontpage_youtube_video_settings',
        array(
            'title' => esc_html__('Youtube Videos', 'morenews'),
            'priority' => 50,
            'capability' => 'edit_theme_options',
            'panel' => 'frontpage_option_panel',
        )
    );


    $wp_customize->add_setting('frontpage_youtube_video_settings',
        array(
            'default' => $morenews_default['frontpage_youtube_video_settings'],
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'absint',
        )
    );


    $wp_customize->add_setting('show_youtube_video',
        array(
            'default' => $morenews_default['show_youtube_video'],
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'morenews_sanitize_checkbox',
        )
    );
    $wp_customize->add_control('show_youtube_video',
        array(
            'label' => esc_html__('Show Youtube Video', 'morenews'),
            'section' => 'frontpage_youtube_video_settings',
            'type' => 'checkbox',
            'priority' => 100,
        )
    );

    $wp_customize->add_setting('frontpage_youtube_video_section_title',
        array(
            'default' => $morenews_default['frontpage_youtube_video_section_title'],
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control('frontpage_youtube_video_section_title',
        array(
            'label' => esc_html__('Section Title ', 'morenews'),
            'section' => 'frontpage_youtube_video_settings',
            'type' => 'text',
            'priority' => 100,
           'active_callback' => 'morenews_youtube_video_section_status'

        )

    );

    for ($morenews_i = 1; $morenews_i <= 5; $morenews_i++) {


        // Setting - featured  category1.
        $wp_customize->add_setting('youtube_video_url' . $morenews_i,
            array(
                'default' => $morenews_default['youtube_video_url' . $morenews_i],
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'esc_url_raw',
            )
        );

        $wp_customize->add_control( 'youtube_video_url' . $morenews_i,
            array(
                'label' => sprintf(esc_html__('YouTube Video URL %d', 'morenews'), $morenews_i),
                'description' => esc_html__('Add youtube video', 'morenews'),
                'section' => 'frontpage_youtube_video_settings',
                'type' => 'text',
                'priority' => 130,
                'active_callback' => 'morenews_youtube_video_section_status'
            ));


    }


    /*
     * End Youtube Video section
     */


    /*
     * Express post section
     */


    $wp_customize->add_section('frontpage_express_section_settings',
        array(
            'title' => esc_html__('Express Posts', 'morenews'),
            'priority' => 50,
            'capability' => 'edit_theme_options',
            'panel' => 'frontpage_option_panel',
        )
    );


    $wp_customize->add_setting('frontpage_express_section_settings',
        array(
            'default' => $morenews_default['frontpage_express_section_settings'],
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'absint',
        )
    );


    $wp_customize->add_setting('show_express_post_section',
        array(
            'default' => $morenews_default['show_express_post_section'],
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'morenews_sanitize_checkbox',
        )
    );
    $wp_customize->add_control('show_express_post_section',
        array(
            'label' => esc_html__('Show Express Post Section', 'morenews'),
            'section' => 'frontpage_express_section_settings',
            'type' => 'checkbox',
            'priority' => 100,
        )
    );



    //section title
    $wp_customize->add_setting('express_posts_panel_section_title_1',
        array(
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        new MoreNews_Section_Title(
            $wp_customize,
            'express_posts_panel_section_title_1',
            array(
                'label' => esc_html__("Section 1", 'morenews'),
                'section' => 'frontpage_express_section_settings',
                'priority' => 130,
                'active_callback' => 'morenews_express_posts_section_status'
            )
        )
    );

    $wp_customize->add_setting('frontpage_express_post_section_title_1',
        array(
            'default' => $morenews_default['frontpage_express_post_section_title_1'],
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control('frontpage_express_post_section_title_1',
        array(
            'label' => esc_html__('Section Title ', 'morenews'),
            'section' => 'frontpage_express_section_settings',
            'type' => 'text',
            'priority' => 130,
            'active_callback' => 'morenews_express_posts_section_status'

        )

    );




        // Setting - featured  category1.
        $wp_customize->add_setting('select_express_post_category_1',
            array(
                'default' => $morenews_default['select_express_post_category_1'],
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'absint',
            )
        );

        $wp_customize->add_control(new MoreNews_Dropdown_Taxonomies_Control($wp_customize, 'select_express_post_category_1',
            array(
                'label' => esc_html__('Category', 'morenews'),
                'description' => esc_html__('Select category to be shown on express post section ', 'morenews'),
                'section' => 'frontpage_express_section_settings',
                'type' => 'dropdown-taxonomies',
                'taxonomy' => 'category',
                'priority' => 130,
                'active_callback' => 'morenews_express_posts_section_status'
            )));


            //section title
            $wp_customize->add_setting('express_posts_panel_section_title_2',
                array(
                    'sanitize_callback' => 'sanitize_text_field',
                )
            );

            $wp_customize->add_control(
                new MoreNews_Section_Title(
                    $wp_customize,
                    'express_posts_panel_section_title_2',
                    array(
                        'label' => esc_html__("Section 2", 'morenews'),
                        'section' => 'frontpage_express_section_settings',
                        'priority' => 130,
                        'active_callback' => 'morenews_express_posts_section_status'
                    )
                )
            );




$wp_customize->add_setting('frontpage_express_post_section_title_2',
        array(
            'default' => $morenews_default['frontpage_express_post_section_title_2'],
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control('frontpage_express_post_section_title_2',
        array(
            'label' => esc_html__('Section Title', 'morenews'),
            'section' => 'frontpage_express_section_settings',
            'type' => 'text',
            'priority' => 130,
            'active_callback' => 'morenews_express_posts_section_status'

        )

    );
    // Setting - featured  category1.
    $wp_customize->add_setting('select_express_post_category_2',
        array(
            'default' => $morenews_default['select_express_post_category_2'],
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'absint',
        )
    );

    $wp_customize->add_control(new MoreNews_Dropdown_Taxonomies_Control($wp_customize, 'select_express_post_category_2',
        array(
            'label' => esc_html__('Category', 'morenews'),
            'description' => esc_html__('Select category to be shown on express post section ', 'morenews'),
            'section' => 'frontpage_express_section_settings',
            'type' => 'dropdown-taxonomies',
            'taxonomy' => 'category',
            'priority' => 130,
            'active_callback' => 'morenews_express_posts_section_status'
        )));

    /*
     * End Express post Section
     */

    /**
     * Posts List Section
     * */


    $wp_customize->add_section('frontpage_featured_post_list_settings',
        array(
            'title' => esc_html__('Posts List', 'morenews'),
            'priority' => 50,
            'capability' => 'edit_theme_options',
            'panel' => 'frontpage_option_panel',
        )
    );

// Setting - show_featured_category_section.
    $wp_customize->add_setting('show_featured_post_list_section',
        array(
            'default' => $morenews_default['show_featured_post_list_section'],
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'morenews_sanitize_checkbox',
        )
    );

    $wp_customize->add_control('show_featured_post_list_section',
        array(
            'label' => esc_html__('Enable Post List Section', 'morenews'),
            'section' => 'frontpage_featured_post_list_settings',
            'type' => 'checkbox',
            'priority' => 22,


        )
    );

    for ($morenews_i = 1; $morenews_i <= 3; $morenews_i++) {

        //section title
        $wp_customize->add_setting('express_posts_panel_section_title_'.$morenews_i,
            array(
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control(
            new MoreNews_Section_Title(
                $wp_customize,
                'express_posts_panel_section_title_'.$morenews_i,
                array(
                    'label' => sprintf(esc_html__('Section %d', 'morenews'),$morenews_i),
                    'section' => 'frontpage_featured_post_list_settings',
                    'priority' => 130,
                    'active_callback' => 'morenews_featured_post_list_section_status'
                )
            )
        );


        // Setting - featured_category_section.
        $wp_customize->add_setting('featured_post_list_section_title_'.$morenews_i,
            array(
                'default' => $morenews_default['featured_post_list_section_title_'.$morenews_i],
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );
        $wp_customize->add_control(
            'featured_post_list_section_title_'.$morenews_i,
            array(
                'label' => esc_html__('Section Title', 'morenews'),
                'section' => 'frontpage_featured_post_list_settings',
                'type' => 'text',
                'priority' => 130,
                'active_callback' => 'morenews_featured_post_list_section_status'

            )

        );


        // Setting - featured  category1.
        $wp_customize->add_setting('featured_post_list_category_section_' . $morenews_i,
            array(
                'default' => $morenews_default['featured_post_list_category_section_' . $morenews_i],
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'absint',
            )
        );

        $wp_customize->add_control(new MoreNews_Dropdown_Taxonomies_Control($wp_customize, 'featured_post_list_category_section_' . $morenews_i,
            array(
                'label' => esc_html__('Category', 'morenews'),
                'description' => esc_html__('Select category to be shown on featured section ', 'morenews'),
                'section' => 'frontpage_featured_post_list_settings',
                'type' => 'dropdown-taxonomies',
                'taxonomy' => 'category',
                'priority' => 130,
                'active_callback' => 'morenews_featured_post_list_section_status'
            )));


    }
    /* End Featured Category Section */

    /**
     * Grid Post Section
     * */


    $wp_customize->add_section('frontpage_post_carousel_settings',
        array(
            'title' => esc_html__('Posts Carousel', 'morenews'),
            'priority' => 50,
            'capability' => 'edit_theme_options',
            'panel' => 'frontpage_option_panel',
        )
    );

// Setting - show_featured_posts_section.
    $wp_customize->add_setting('show_post_carousel_section',
        array(
            'default' => $morenews_default['show_post_carousel_section'],
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'morenews_sanitize_checkbox',
        )
    );

    $wp_customize->add_control('show_post_carousel_section',
        array(
            'label' => esc_html__('Enable Posts Carousel Section', 'morenews'),
            'section' => 'frontpage_post_carousel_settings',
            'type' => 'checkbox',
            'priority' => 22,


        )
    );

    $wp_customize->add_setting('featured_post_carousel_section_title',
        array(
            'default' => $morenews_default['featured_post_carousel_section_title'],
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control('featured_post_carousel_section_title',
        array(
            'label' => esc_html__('Section Title ', 'morenews'),
            'section' => 'frontpage_post_carousel_settings',
            'type' => 'text',
            'priority' => 130,
            'active_callback' => 'morenews_featured_post_carousel_section_status'

        )

    );

    //List of categories

    $wp_customize->add_setting('select_featured_post_carousel_category',
        array(
            'default' => $morenews_default['select_featured_post_carousel_category'],
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'absint',
        )
    );

    $wp_customize->add_control(new MoreNews_Dropdown_Taxonomies_Control($wp_customize, 'select_featured_post_carousel_category',
        array(
            'label' => sprintf(__('Select ', 'morenews')),
            'description' => esc_html__('Select category to be shown on featured section ', 'morenews'),
            'section' => 'frontpage_post_carousel_settings',
            'type' => 'dropdown-taxonomies',
            'taxonomy' => 'category',
            'priority' => 130,
            'active_callback' => 'morenews_featured_post_carousel_section_status',


        )));

// Setting - number of posts
    $wp_customize->add_setting('number_of_featured_gird',
        array(
            'default' => $morenews_default['number_of_featured_gird'],
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'absint',
        )
    );

    $wp_customize->add_control('number_of_featured_gird',
        array(
            'label' => __('Number of Posts', 'morenews'),
            'section' => 'frontpage_post_carousel_settings',
            'type' => 'number',
            'priority' => 130,
            'active_callback' => 'morenews_featured_post_carousel_section_status'
        )
    );



// Frontpage Layout Section.
$wp_customize->add_section('frontpage_layout_settings',
    array(
        'title' => esc_html__('Frontpage Layout Settings', 'morenews'),
        'priority' => 10,
        'capability' => 'edit_theme_options',
        'panel' => 'frontpage_option_panel',
    )
);



// Setting - show_main_news_section.
$wp_customize->add_setting('frontpage_content_type',
    array(
        'default' => $morenews_default['frontpage_content_type'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);

$wp_customize->add_control('frontpage_content_type',
    array(
        'label' => esc_html__('Frontpage Content Display', 'morenews'),
        'description' => esc_html__('Select frontpage content display', 'morenews'),
        'section' => 'frontpage_layout_settings',
        'type' => 'select',
        'choices' => array(
            'frontpage-widgets' => esc_html__('Frontpage Widgets', 'morenews'),
            'frontpage-widgets-and-content' => esc_html__('Page Contents & Frontpage Widgets', 'morenews'),            
        ),
        'priority' => 10,
    ));


// Setting - show_main_news_section.
$wp_customize->add_setting('frontpage_content_alignment',
    array(
        'default' => $morenews_default['frontpage_content_alignment'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);

$wp_customize->add_control('frontpage_content_alignment',
    array(
        'label' => esc_html__('Frontpage Content Alignment', 'morenews'),
        'description' => esc_html__('Select frontpage content alignment', 'morenews'),
        'section' => 'frontpage_layout_settings',
        'type' => 'select',
        'choices' => array(
            'align-content-left' => esc_html__('Home Content - Home Sidebar', 'morenews'),
            'align-content-right' => esc_html__('Home Sidebar - Home Content', 'morenews'),
            'full-width-content' => esc_html__('Only Home Content', 'morenews')
        ),
        'priority' => 10,
    ));