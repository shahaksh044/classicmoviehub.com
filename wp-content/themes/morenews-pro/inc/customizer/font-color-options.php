<?php

/**
 * Font and Color Option Panel
 *
 * @package MoreNews
 */

$morenews_default = morenews_get_default_theme_options();


// Setting - global content alignment of news.
$wp_customize->add_setting('global_site_mode_setting',
    array(
        'default' => $morenews_default['global_site_mode_setting'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);

$wp_customize->add_control('global_site_mode_setting',
    array(
        'label' => esc_html__('Site Color Mode', 'morenews'),
        'section' => 'colors',
        'type' => 'select',
        'choices' => array(
            'aft-default-mode' => esc_html__('Light', 'morenews'),
            'aft-dark-mode' => esc_html__('Dark', 'morenews'),
        ),
        'priority' => 5,
    ));

//section title
$wp_customize->add_setting('site_background_color_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new MoreNews_Section_Title(
        $wp_customize,
        'site_background_color_section_title',
        array(
            'label' => esc_html__('Primary Color Section ', 'morenews'),
            'section' => 'colors',
            'priority' => 5,
            //'active_callback' => 'morenews_global_site_mode_status'
        )
    )
);


//section title
$wp_customize->add_setting('global_color_section_notice',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new MoreNews_Simple_Notice_Custom_Control(
        $wp_customize,
        'global_color_section_notice',
        array(
            'description' => esc_html__('Body Background Color (Dark Mode) will be applied for this mode.', 'morenews'),
            'section' => 'colors',
            'priority' => 10,
            'active_callback' => 'morenews_global_site_mode_dark_status'
        )
    )
);



// Setting - slider_caption_bg_color.
$wp_customize->add_setting('dark_background_color',
    array(
        'default' => $morenews_default['dark_background_color'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'dark_background_color',
        array(
            'label' => esc_html__('Body Background Color (Dark Mode)', 'morenews'),
            'section' => 'colors',
            'type' => 'color',
            'priority' => 10,
            'active_callback' => 'morenews_global_site_mode_dark_status'

        )
    )
);

// Setting - show_site_title_section.
$wp_customize->add_setting('site_default_post_box_color',
    array(
        'default' => $morenews_default['site_default_post_box_color'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'site_default_post_box_color',
        array(
            'label' => esc_html__('Box Background Color', 'morenews'),
            'section' => 'colors',
            'priority' => 10,
            'active_callback' => function ($control) {
                return (
                    morenews_global_site_mode_dark_status($control)
                );
            },

        )
    )
);

// Setting - show_site_title_section.
$wp_customize->add_setting('site_light_post_box_color',
    array(
        'default' => $morenews_default['site_light_post_box_color'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'site_light_post_box_color',
        array(
            'label' => esc_html__('Box Background Color', 'morenews'),
            'section' => 'colors',
            'priority' => 10,
            'active_callback' => function ($control) {
                return (
                    morenews_global_site_mode_light_status($control)

                );
            },
        )
    )
);


// Setting - primary_color.
$wp_customize->add_setting('primary_color',
    array(
        'default' => $morenews_default['primary_color'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(

    new WP_Customize_Color_Control(
        $wp_customize,
        'primary_color',
        array(
            'label' => esc_html__('Primary Color', 'morenews'),
            'section' => 'colors',
            'type' => 'color',
            'priority' => 10,
            'active_callback' => 'morenews_global_site_mode_dark_status'
        )
    )
);

// Setting - primary_color.
$wp_customize->add_setting('primary_color_light',
    array(
        'default' => $morenews_default['primary_color_light'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(

    new WP_Customize_Color_Control(
        $wp_customize,
        'primary_color_light',
        array(
            'label' => esc_html__('Primary Color', 'morenews'),
            'section' => 'colors',
            'type' => 'color',
            'priority' => 10,
            'active_callback' => 'morenews_global_site_mode_light_status'
        )
    )
);

//section title
$wp_customize->add_setting('secondary_color_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new MoreNews_Section_Title(
        $wp_customize,
        'secondary_color_section_title',
        array(
            'label' => esc_html__('Secondary Color Section ', 'morenews'),
            'section' => 'colors',
            'priority' => 10,
            //'active_callback' => 'morenews_global_site_mode_status'
        )
    )
);


// Setting - secondary_color.
$wp_customize->add_setting('secondary_color',
    array(
        'default' => $morenews_default['secondary_color'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(

    new WP_Customize_Color_Control(
        $wp_customize,
        'secondary_color',
        array(
            'label' => esc_html__('Secondary Color', 'morenews'),
            'section' => 'colors',
            'type' => 'color',
            'priority' => 10,
            //'active_callback' => 'morenews_solid_secondary_color_status'
        )
    )
);

// Setting - secondary_color.
$wp_customize->add_setting('text_over_secondary_color',
    array(
        'default' => $morenews_default['text_over_secondary_color'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(

    new WP_Customize_Color_Control(
        $wp_customize,
        'text_over_secondary_color',
        array(
            'label' => esc_html__('Texts over Secondary Color', 'morenews'),
            'section' => 'colors',
            'type' => 'color',
            'priority' => 10,
            //'active_callback' => 'morenews_solid_secondary_color_status'
        )
    )
);


//section title
$wp_customize->add_setting('top_header_color_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new MoreNews_Section_Title(
        $wp_customize,
        'top_header_color_section_title',
        array(
            'label' => esc_html__('Top Header Section ', 'morenews'),
            'section' => 'colors',
            'priority' => 100,
            //'active_callback' => 'morenews_global_site_mode_status'
        )
    )
);


// Setting - slider_caption_bg_color.
$wp_customize->add_setting('top_header_background_color',
    array(
        'default' => $morenews_default['top_header_background_color'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(

    new WP_Customize_Color_Control(
        $wp_customize,
        'top_header_background_color',
        array(
            'label' => esc_html__('Background Color', 'morenews'),
            'section' => 'colors',
            'type' => 'color',
            'priority' => 100,
            //'active_callback' => 'morenews_global_site_mode_status'
        )
    )
);

// Setting - slider_caption_bg_color.
$wp_customize->add_setting('top_header_texts_color',
    array(
        'default' => $morenews_default['top_header_texts_color'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(

    new WP_Customize_Color_Control(
        $wp_customize,
        'top_header_texts_color',
        array(
            'label' => esc_html__('Texts Color', 'morenews'),
            'section' => 'colors',
            'type' => 'color',
            'priority' => 100,
            //'active_callback' => 'morenews_global_site_mode_status'
        )
    )
);




//section title
$wp_customize->add_setting('global_primay_menu_color_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new MoreNews_Section_Title(
        $wp_customize,
        'global_primay_menu_color_section_title',
        array(
            'label' => esc_html__('Primary Navigation Section ', 'morenews'),
            'section' => 'colors',
            'priority' => 100,
            //'active_callback' => 'morenews_global_site_mode_status'
        )
    )
);


// Setting - slider_caption_bg_color.
$wp_customize->add_setting('main_navigation_custom_background_color',
    array(
        'default' => $morenews_default['main_navigation_custom_background_color'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(

    new WP_Customize_Color_Control(
        $wp_customize,
        'main_navigation_custom_background_color',
        array(
            'label' => esc_html__('Background Color', 'morenews'),
            'section' => 'colors',
            'type' => 'color',
            'priority' => 100,
            //'active_callback' => 'morenews_global_site_mode_status'
        )
    )
);

// Setting - slider_caption_bg_color.
$wp_customize->add_setting('main_navigation_link_color',
    array(
        'default' => $morenews_default['main_navigation_link_color'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(

    new WP_Customize_Color_Control(
        $wp_customize,
        'main_navigation_link_color',
        array(
            'label' => esc_html__('Menu Item Color', 'morenews'),
            'section' => 'colors',
            'type' => 'color',
            'priority' => 100,
            //'active_callback' => 'morenews_global_site_mode_status'
        )
    )
);

// Setting - slider_caption_bg_color.
$wp_customize->add_setting('main_navigation_badge_background',
    array(
        'default' => $morenews_default['main_navigation_badge_background'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(

    new WP_Customize_Color_Control(
        $wp_customize,
        'main_navigation_badge_background',
        array(
            'label' => esc_html__('Badge Background', 'morenews'),
            'section' => 'colors',
            'type' => 'color',
            'priority' => 100,
            //'active_callback' => 'morenews_global_site_mode_status'
        )
    )
);

// Setting - slider_caption_bg_color.
$wp_customize->add_setting('main_navigation_badge_color',
    array(
        'default' => $morenews_default['main_navigation_badge_color'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(

    new WP_Customize_Color_Control(
        $wp_customize,
        'main_navigation_badge_color',
        array(
            'label' => esc_html__('Badge Text Color', 'morenews'),
            'section' => 'colors',
            'type' => 'color',
            'priority' => 100,
            //'active_callback' => 'morenews_global_site_mode_status'
        )
    )
);



// Setting - slider_caption_bg_color.
$wp_customize->add_setting('watch_online_background',
    array(
        'default' => $morenews_default['watch_online_background'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'watch_online_background',
        array(
            'label' => esc_html__('Watch Online Background', 'morenews'),
            'section' => 'colors',
            'type' => 'color',
            'priority' => 100,

        )
    )
);



// Setting - slider_caption_bg_color.
$wp_customize->add_setting('breaking_news_background',
    array(
        'default' => $morenews_default['breaking_news_background'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'breaking_news_background',
        array(
            'label' => esc_html__('Breaking News Background', 'morenews'),
            'section' => 'colors',
            'type' => 'color',
            'priority' => 100,

        )
    )
);


//section title
$wp_customize->add_setting('global_archive_widgets_color_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new MoreNews_Section_Title(
        $wp_customize,
        'global_archive_widgets_color_section_title',
        array(
            'label' => esc_html__('Archive/Widgets Section ', 'morenews'),
            'section' => 'colors',
            'priority' => 100,

        )
    )
);

// Setting - slider_caption_bg_color.
$wp_customize->add_setting('title_link_color',
    array(
        'default' => $morenews_default['title_link_color'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(

    new WP_Customize_Color_Control(
        $wp_customize,
        'title_link_color',
        array(
            'label' => esc_html__('Post Title', 'morenews'),
            'section' => 'colors',
            'type' => 'color',
            'priority' => 100,
            'active_callback' => 'morenews_global_site_mode_dark_status'
        )
    )
);

// Setting - slider_caption_bg_color.
$wp_customize->add_setting('title_link_light_color',
    array(
        'default' => $morenews_default['title_link_light_color'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(

    new WP_Customize_Color_Control(
        $wp_customize,
        'title_link_light_color',
        array(
            'label' => esc_html__('Post Title', 'morenews'),
            'section' => 'colors',
            'type' => 'color',
            'priority' => 100,
            'active_callback' => 'morenews_global_site_mode_light_status'
        )
    )
);

// Setting - slider_caption_bg_color.
$wp_customize->add_setting('title_over_image_color',
    array(
        'default' => $morenews_default['title_over_image_color'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(

    new WP_Customize_Color_Control(
        $wp_customize,
        'title_over_image_color',
        array(
            'label' => esc_html__('Post Title Over Image', 'morenews'),
            'section' => 'colors',
            'type' => 'color',
            'priority' => 100,
            //'active_callback' => 'morenews_global_site_mode_status'
        )
    )
);


//========== category colors  options ===============


//section title
$wp_customize->add_setting('global_category_color_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new MoreNews_Section_Title(
        $wp_customize,
        'global_category_color_section_title',
        array(
            'label' => esc_html__('Category Color Section ', 'morenews'),
            'section' => 'colors',
            'priority' => 100,

        )
    )
);

// Single Section.
$wp_customize->add_section('site_category_color_settings',
    array(
        'title' => esc_html__('Category Colors', 'morenews'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);


for ($morenews_i = 1; $morenews_i <= 7; $morenews_i++) {
// Setting - slider_caption_bg_color.
    $wp_customize->add_setting('category_color_' . $morenews_i,
        array(
            'default' => $morenews_default['category_color_' . $morenews_i],
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'category_color_' . $morenews_i,
            array(
                'label' => sprintf(esc_html__('Category %d Background', 'morenews'), $morenews_i),
                'section' => 'colors',
                'type' => 'color',
                'priority' => 100,
            )
        )
    );

    // Setting - slider_caption_bg_color.
    $wp_customize->add_setting('category_texts_color_' . $morenews_i,
        array(
            'default' => $morenews_default['category_texts_color_' . $morenews_i],
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'category_texts_color_' . $morenews_i,
            array(
                'label' => sprintf(esc_html__('Category %d Texts Color', 'morenews'), $morenews_i),
                'section' => 'colors',
                'type' => 'color',
                'priority' => 100,
            )
        )
    );


}


//============= Font Options ===================
// font Section.
$wp_customize->add_section('font_typo_section',
    array(
        'title' => esc_html__('Fonts & Typography', 'morenews'),
        'priority' => 5,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);

global $morenews_google_fonts;


// Trending Section.
$wp_customize->add_setting('site_title_font_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new MoreNews_Section_Title(
        $wp_customize,
        'site_title_font_section_title',
        array(
            'label' => esc_html__("Font Family Section", 'morenews'),
            'section' => 'font_typo_section',
            'priority' => 100,

        )
    )
);



// Setting - secondary_font.
$wp_customize->add_setting('site_title_font',
    array(
        'default' => $morenews_default['site_title_font'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);
$wp_customize->add_control('site_title_font',
    array(
        'label' => esc_html__('Site Title Font', 'morenews'),

        'section' => 'font_typo_section',
        'type' => 'select',
        'choices' => $morenews_google_fonts,
        'priority' => 100,
    )
);

// Setting - primary_font.
$wp_customize->add_setting('primary_font',
    array(
        'default' => $morenews_default['primary_font'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);
$wp_customize->add_control('primary_font',
    array(
        'label' => esc_html__('Primary Font', 'morenews'),

        'section' => 'font_typo_section',
        'type' => 'select',
        'choices' => $morenews_google_fonts,
        'priority' => 100,
    )
);

// Setting - secondary_font.
$wp_customize->add_setting('secondary_font',
    array(
        'default' => $morenews_default['secondary_font'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);
$wp_customize->add_control('secondary_font',
    array(
        'label' => esc_html__('Secondary Font', 'morenews'),

        'section' => 'font_typo_section',
        'type' => 'select',
        'choices' => $morenews_google_fonts,
        'priority' => 110,
    )
);


// Trending Section.
$wp_customize->add_setting('font_formatting_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new MoreNews_Section_Title(
        $wp_customize,
        'font_formatting_section_title',
        array(
            'label' => esc_html__("Texts Formatting Section", 'morenews'),
            'section' => 'font_typo_section',
            'priority' => 110,

        )
    )
);


// Setting - global content alignment of news.
$wp_customize->add_setting('title_font_weight',
    array(
        'default' => $morenews_default['title_font_weight'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);

$wp_customize->add_control('title_font_weight',
    array(
        'label' => esc_html__('Title Font Weight', 'morenews'),
        'description' => sprintf(esc_html__('Default Value: %d', 'morenews'), $morenews_default['title_font_weight']),
        'section' => 'font_typo_section',
        'type' => 'select',
        'choices' => array(
            '100' => esc_html__('100', 'morenews'),
            '200' => esc_html__('200', 'morenews'),
            '300' => esc_html__('300', 'morenews'),
            '400' => esc_html__('400', 'morenews'),
            '500' => esc_html__('500', 'morenews'),
            '600' => esc_html__('600', 'morenews'),
            '700' => esc_html__('700', 'morenews'),
            '800' => esc_html__('800', 'morenews'),
            '900' => esc_html__('900', 'morenews'),
        ),
        'priority' => 110,
    ));

// Setting - secondary_font.
$wp_customize->add_setting('letter_spacing',
    array(
        'default' => $morenews_default['letter_spacing'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('letter_spacing',
    array(
        'label' => esc_html__('Global Letter Spacing', 'morenews'),
        'description' => sprintf(esc_html__('Default Value: %d', 'morenews'), $morenews_default['letter_spacing']),
        'section' => 'font_typo_section',
        'type' => 'number',
        'priority' => 110,
    )
);

// Setting - secondary_font.
$wp_customize->add_setting('title_line_height',
    array(
        'default' => $morenews_default['title_line_height'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('title_line_height',
    array(
        'label' => esc_html__('Title Line height', 'morenews'),
        'description' => sprintf(esc_html__('Default Value: %g', 'morenews'), $morenews_default['title_line_height']),
        'section' => 'font_typo_section',
        'type' => 'number',
        'priority' => 110,
    )
);

// Setting - secondary_font.
$wp_customize->add_setting('line_height',
    array(
        'default' => $morenews_default['line_height'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('line_height',
    array(
        'label' => esc_html__('Global Line height', 'morenews'),
        'description' => sprintf(esc_html__('Default Value: %g', 'morenews'), $morenews_default['line_height']),
        'section' => 'font_typo_section',
        'type' => 'number',
        'priority' => 110,
    )
);


// Trending Section.
$wp_customize->add_setting('font_size_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new MoreNews_Section_Title(
        $wp_customize,
        'font_size_section_title',
        array(
            'label' => esc_html__("Font Size Section", 'morenews'),
            'section' => 'font_typo_section',
            'priority' => 110,

        )
    )
);

// Setting - secondary_font.
$wp_customize->add_setting('global_font_size',
    array(
        'default' => $morenews_default['global_font_size'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('global_font_size',
    array(
        'label' => esc_html__('General Font Size', 'morenews'),
        'description' => sprintf(esc_html__('Default Value: %d', 'morenews'), $morenews_default['global_font_size']),
        'section' => 'font_typo_section',
        'type' => 'number',
        'priority' => 110,
    )
);

// Setting - secondary_font.
$wp_customize->add_setting('morenews_section_title_font_size',
    array(
        'default' => $morenews_default['morenews_section_title_font_size'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control('morenews_section_title_font_size',
    array(
        'label' => esc_html__('Global Section Title Size', 'morenews'),
        'description' => sprintf(esc_html__('Default Value: %d', 'morenews'), $morenews_default['morenews_section_title_font_size']),
        'section' => 'font_typo_section',
        'type' => 'number',
        'priority' => 110,
    )
);


// Setting - secondary_font.
$wp_customize->add_setting('title_type_1',
    array(
        'default' => $morenews_default['title_type_1'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('title_type_1',
    array(
        'label' => esc_html__('Big Spotlight Post Title Size', 'morenews'),
        'description' => sprintf(esc_html__('Default Value: %d', 'morenews'), $morenews_default['title_type_1']),
        'section' => 'font_typo_section',
        'type' => 'number',
        'priority' => 110,
    )
);

// Setting - secondary_font.
$wp_customize->add_setting('title_type_2',
    array(
        'default' => $morenews_default['title_type_2'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('title_type_2',
    array(
        'label' => esc_html__('Medium Spotlight Post Title Size', 'morenews'),
        'description' => sprintf(esc_html__('Default Value: %d', 'morenews'), $morenews_default['title_type_2']),
        'section' => 'font_typo_section',
        'type' => 'number',
        'priority' => 110,
    )
);


// Setting - secondary_font.
$wp_customize->add_setting('title_type_3',
    array(
        'default' => $morenews_default['title_type_3'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('title_type_3',
    array(
        'label' => esc_html__('General Post Title Size (Grid)', 'morenews'),
        'description' => sprintf(esc_html__('Default Value: %d', 'morenews'), $morenews_default['title_type_3']),
        'section' => 'font_typo_section',
        'type' => 'number',
        'priority' => 110,
    )
);


// Setting - secondary_font.
$wp_customize->add_setting('title_type_4',
    array(
        'default' => $morenews_default['title_type_4'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('title_type_4',
    array(
        'label' => esc_html__('General Post Title Size (List)', 'morenews'),
        'description' => sprintf(esc_html__('Default Value: %d', 'morenews'), $morenews_default['title_type_3']),
        'section' => 'font_typo_section',
        'type' => 'number',
        'priority' => 110,
    )
);



// Setting - secondary_font.
$wp_customize->add_setting('morenews_page_posts_title_font_size',
    array(
        'default' => $morenews_default['morenews_page_posts_title_font_size'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control('morenews_page_posts_title_font_size',
    array(
        'label' => esc_html__('Single Page/Posts Title Size', 'morenews'),
        'description' => sprintf(esc_html__('Default Value: %d', 'morenews'), $morenews_default['morenews_page_posts_title_font_size']),
        'section' => 'font_typo_section',
        'type' => 'number',
        'priority' => 110,
    )
);

// Setting - secondary_font.
$wp_customize->add_setting('morenews_page_posts_paragraph_font_size',
    array(
        'default' => $morenews_default['morenews_page_posts_paragraph_font_size'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control('morenews_page_posts_paragraph_font_size',
    array(
        'label' => esc_html__('Single Page/Posts Paragraph Size', 'morenews'),
        'description' => sprintf(esc_html__('Default Value: %d', 'morenews'), $morenews_default['morenews_page_posts_paragraph_font_size']),
        'section' => 'font_typo_section',
        'type' => 'number',
        'priority' => 110,
    )
);

//section title
$wp_customize->add_setting('global_mailchimp_color_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new MoreNews_Section_Title(
        $wp_customize,
        'global_mailchimp_color_section_title',
        array(
            'label' => esc_html__('MailChimp Section', 'morenews'),
            'section' => 'colors',
            'priority' => 110,
            'active_callback' => function ($control) {
                return (
                morenews_mailchimp_subscriptions_status($control)
                );
            }
        )
    )
);

// Setting - show_site_title_section.
$wp_customize->add_setting('footer_mailchimp_background_color',
    array(
        'default' => $morenews_default['footer_mailchimp_background_color'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'footer_mailchimp_background_color',
        array(
            'label' => esc_html__('Background Color', 'morenews'),
            'section' => 'colors',
            'settings' => 'footer_mailchimp_background_color',
            'priority' => 110,
            'active_callback' => function ($control) {
                return (
                    morenews_mailchimp_subscriptions_status($control)
                );
            }

        )
    )
);

// Setting - show_site_title_section.
$wp_customize->add_setting('footer_mailchimp_text_color',
    array(
        'default' => $morenews_default['footer_mailchimp_text_color'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'footer_mailchimp_text_color',
        array(
            'label' => esc_html__('Texts Color', 'morenews'),
            'section' => 'colors',
            'settings' => 'footer_mailchimp_text_color',
            'priority' => 110,
            'active_callback' => function ($control) {
                return (
                    morenews_mailchimp_subscriptions_status($control)

                );
            }

        )
    )
);



//section title
$wp_customize->add_setting('global_footer_color_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new MoreNews_Section_Title(
        $wp_customize,
        'global_footer_color_section_title',
        array(
            'label' => esc_html__('Footer Section', 'morenews'),
            'section' => 'colors',
            'priority' => 110,
            //'active_callback' => 'morenews_global_site_mode_status'
        )
    )
);


// Setting - show_site_title_section.
$wp_customize->add_setting('footer_background_color',
    array(
        'default' => $morenews_default['footer_background_color'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'footer_background_color',
        array(
            'label' => esc_html__('Background Color', 'morenews'),
            'section' => 'colors',
            'settings' => 'footer_background_color',
            'priority' => 110,
            //'active_callback' => 'morenews_global_site_mode_status'

        )
    )
);

// Setting - show_site_title_section.
$wp_customize->add_setting('footer_texts_color',
    array(
        'default' => $morenews_default['footer_texts_color'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'footer_texts_color',
        array(
            'label' => esc_html__('Texts Color', 'morenews'),
            'section' => 'colors',
            'settings' => 'footer_texts_color',
            'priority' => 110,
            //'active_callback' => 'morenews_global_site_mode_status'
        )
    )
);


// Setting - show_site_title_section.
$wp_customize->add_setting('footer_credits_background_color',
    array(
        'default' => $morenews_default['footer_credits_background_color'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'footer_credits_background_color',
        array(
            'label' => esc_html__('Credits Background Color', 'morenews'),
            'section' => 'colors',
            'settings' => 'footer_credits_background_color',
            'priority' => 110,
            //'active_callback' => 'morenews_global_site_mode_status'
        )
    )
);

// Setting - show_site_title_section.
$wp_customize->add_setting('footer_credits_texts_color',
    array(
        'default' => $morenews_default['footer_credits_texts_color'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'footer_credits_texts_color',
        array(
            'label' => esc_html__('Credits Texts Color', 'morenews'),
            'section' => 'colors',
            'settings' => 'footer_credits_texts_color',
            'priority' => 110,
            //'active_callback' => 'morenews_global_site_mode_status'

        )
    )
);