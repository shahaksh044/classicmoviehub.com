<?php

/**
 * Option Panel
 *
 * @package MoreNews
 */

$morenews_default = morenews_get_default_theme_options();
/*theme option panel info*/
require get_template_directory() . '/inc/customizer/frontpage-options.php';

//font and color options
require get_template_directory() . '/inc/customizer/font-color-options.php';


/**
 * Frontpage options section
 *
 * @package MoreNews
 */


// Add Frontpage Options Panel.
$wp_customize->add_panel(
    'site_header_option_panel',
    array(
        'title' => esc_html__('Header Options', 'morenews'),
        'priority' => 198,
        'capability' => 'edit_theme_options',
    )
);

/**
 * Header section
 *
 * @package MoreNews
 */

// Frontpage Section.
$wp_customize->add_section(
    'header_options_settings',
    array(
        'title' => esc_html__('Header Settings', 'morenews'),
        'priority' => 49,
        'capability' => 'edit_theme_options',
        'panel' => 'site_header_option_panel',
    )
);

// Setting - global content alignment of news.
$wp_customize->add_setting(
    'header_layout',
    array(
        'default' => $morenews_default['header_layout'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);


$wp_customize->add_control(
    'header_layout',
    array(
        'label' => esc_html__('Header Layout', 'morenews'),
        'description' => esc_html__('Select global header layout', 'morenews'),
        'section' => 'header_options_settings',
        'type' => 'select',
        'choices' => array(
            'header-layout-side' => esc_html__('Side', 'morenews'),
            'header-layout-centered' => esc_html__('Centered', 'morenews'),
            'header-layout-compressed-full' => esc_html__('Compressed', 'morenews'),
        ),
        'priority' => 5,
    )
);


//section title
$wp_customize->add_setting(
    'show_top_header_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new MoreNews_Section_Title(
        $wp_customize,
        'show_top_header_section_title',
        array(
            'label' => esc_html__("Top Header Section", 'morenews'),
            'section' => 'header_options_settings',
            'priority' => 10,

        )
    )
);


// Setting - show_site_title_section.
$wp_customize->add_setting(
    'show_top_header_section',
    array(
        'default' => $morenews_default['show_top_header_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_checkbox',
    )
);

$wp_customize->add_control(
    'show_top_header_section',
    array(
        'label' => esc_html__('Show Top Header', 'morenews'),
        'section' => 'header_options_settings',
        'type' => 'checkbox',
        'priority' => 10,
        //'active_callback' => 'morenews_top_header_status'
    )
);

// Setting - show_site_title_section.
$wp_customize->add_setting(
    'show_social_menu_section',
    array(
        'default' => $morenews_default['show_social_menu_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_checkbox',
    )
);

$wp_customize->add_control(
    'show_social_menu_section',
    array(
        'label' => esc_html__('Show Social Menu', 'morenews'),
        'section' => 'header_options_settings',
        'type' => 'checkbox',
        'priority' => 10,
        'active_callback' => 'morenews_top_header_status'
    )
);


// Setting - show_site_title_section.
$wp_customize->add_setting(
    'show_date_section',
    array(
        'default' => $morenews_default['show_date_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'show_date_section',
    array(
        'label' => esc_html__('Show Date', 'morenews'),
        'section' => 'header_options_settings',
        'type' => 'checkbox',
        'priority' => 10,
        'active_callback' => 'morenews_top_header_status'
    )
);


// Setting - global content alignment of news.
$wp_customize->add_setting(
    'global_show_primary_menu_border',
    array(
        'default' => $morenews_default['global_show_primary_menu_border'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);

$wp_customize->add_control(
    'global_show_primary_menu_border',
    array(
        'label' => esc_html__('Menu Border', 'morenews'),
        'section' => 'header_options_settings',
        'type' => 'select',
        'choices' => array(
            'show-menu-border' => esc_html__('Show', 'morenews'),
            'hide-menu-border' => esc_html__('Hide', 'morenews'),

        ),
        'priority' => 130,
    )
);


// Advertisement Section.
$wp_customize->add_section(
    'frontpage_advertisement_settings',
    array(
        'title' => esc_html__('Header Advertisement', 'morenews'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'site_header_option_panel',
    )
);


// Setting banner_advertisement_section.
$wp_customize->add_setting(
    'banner_advertisement_section',
    array(
        'default' => $morenews_default['banner_advertisement_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(
    new WP_Customize_Cropped_Image_Control(
        $wp_customize,
        'banner_advertisement_section',
        array(
            'label' => esc_html__('Header Section Advertisement', 'morenews'),
            'description' => sprintf(esc_html__('Recommended Size %1$s px X %2$s px', 'morenews'), 930, 110),
            'section' => 'frontpage_advertisement_settings',
            'settings' => 'banner_advertisement_section',
            'width' => 930,
            'height' => 110,
            'flex_width' => true,
            'flex_height' => true,
            'priority' => 120,
        )
    )
);

/*banner_advertisement_section_url*/
$wp_customize->add_setting(
    'banner_advertisement_section_url',
    array(
        'default' => $morenews_default['banner_advertisement_section_url'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control(
    'banner_advertisement_section_url',
    array(
        'label' => esc_html__('URL Link', 'morenews'),
        'section' => 'frontpage_advertisement_settings',
        'type' => 'text',
        'priority' => 130,
    )
);

/*banner_advertisement_section_url*/
$wp_customize->add_setting(
    'banner_advertisement_open_on_new_tab',
    array(
        'default' => $morenews_default['banner_advertisement_open_on_new_tab'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'banner_advertisement_open_on_new_tab',
    array(
        'label' => esc_html__('Open In New Tab', 'morenews'),
        'section' => 'frontpage_advertisement_settings',
        'type' => 'checkbox',
        'priority' => 130,
    )
);


// Setting - select_main_banner_section_mode.
$wp_customize->add_setting(
    'banner_advertisement_scope',
    array(
        'default' => $morenews_default['banner_advertisement_scope'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);

$wp_customize->add_control(
    'banner_advertisement_scope',
    array(
        'label' => esc_html__('Show Header Advertisement On', 'morenews'),
        'description' => esc_html__('Select scope to display on header advertisement section', 'morenews'),
        'section' => 'frontpage_advertisement_settings',
        'type' => 'select',
        'choices' => array(
            'site-wide' => esc_html__('Show Site-wide', 'morenews'),
            'front-page-only' => esc_html__('Show on Homepage only', 'morenews'),
        ),
        'priority' => 130,

    )
);


// Add Theme Options Panel.
$wp_customize->add_panel(
    'theme_option_panel',
    array(
        'title' => esc_html__('Theme Options', 'morenews'),
        'priority' => 200,
        'capability' => 'edit_theme_options',
    )
);



/**
 * Layout options section
 *
 * @package MoreNews
 */

// Layout Section.
$wp_customize->add_section(
    'site_layout_mode_settings',
    array(
        'title' => esc_html__('Site Layout Mode', 'morenews'),
        'priority' => 9,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);


// Setting - global banner layout.
$wp_customize->add_setting(
    'global_site_layout_tone',
    array(
        'default' => $morenews_default['global_site_layout_tone'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);

$wp_customize->add_control(
    'global_site_layout_tone',
    array(
        'label' => esc_html__('Theme Tone', 'morenews'),
        'description' => esc_html__('Publish and reload to preview changes', 'morenews'),
        'section' => 'site_layout_mode_settings',
        'type' => 'select',
        'choices' => array(
            'default' => esc_html__("Default", 'morenews'),
            'centralnews' => esc_html__("CentralNews", 'morenews'),            
            'generalnews' => esc_html__("General News", 'morenews'),
            'globalnews' => esc_html__("GlobalNews", 'morenews'),
            'moremag' => esc_html__("MoreMag", 'morenews'),
            'newsmore' => esc_html__("NewsMore", 'morenews'),
        ),
        'priority' => 130,
    )
);

// Setting - global banner layout.
$wp_customize->add_setting(
    'global_site_layout_setting',
    array(
        'default' => $morenews_default['global_site_layout_setting'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);

$wp_customize->add_control(
    'global_site_layout_setting',
    array(
        'label' => esc_html__('Layout Option', 'morenews'),
        'section' => 'site_layout_mode_settings',
        'type' => 'select',
        'choices' => array(
            'boxed' => esc_html__("Boxed", 'morenews'),
            'wide' => esc_html__("Wide", 'morenews'),
        ),
        'priority' => 130,
    )
);


$wp_customize->add_setting(
    'global_site_layout_topbottom_gaps',
    array(
        'default' => $morenews_default['global_site_layout_topbottom_gaps'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_checkbox',
    )
);

$wp_customize->add_control(
    'global_site_layout_topbottom_gaps',
    array(
        'label' => esc_html__("Enable Box's Top/Bottom Gaps", 'morenews'),
        'section' => 'site_layout_mode_settings',
        'type' => 'checkbox',
        'priority' => 130,
        'active_callback' => 'global_site_layout_boxed_layout_status'
    )
);




// Breadcrumb Section.
$wp_customize->add_section(
    'site_breadcrumb_settings',
    array(
        'title' => esc_html__('Breadcrumb Options', 'morenews'),
        'priority' => 49,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);


// Setting - breadcrumb.
$wp_customize->add_setting(
    'enable_breadcrumb',
    array(
        'default' => $morenews_default['enable_breadcrumb'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_checkbox',
    )
);

$wp_customize->add_control(
    'enable_breadcrumb',
    array(
        'label' => esc_html__('Show breadcrumbs', 'morenews'),
        'section' => 'site_breadcrumb_settings',
        'type' => 'checkbox',
        'priority' => 10,
    )
);

// Setting - global content alignment of news.
$wp_customize->add_setting(
    'select_breadcrumb_mode',
    array(
        'default' => $default['select_breadcrumb_mode'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);

$wp_customize->add_control(
    'select_breadcrumb_mode',
    array(
        'label' => esc_html__('Select Breadcrumbs', 'morenews'),
        'description' => esc_html__("Please ensure that you have enabled the plugin's breadcrumbs before choosing other than Default", 'morenews'),
        'section' => 'site_breadcrumb_settings',
        'type' => 'select',
        'choices' => array(
            'default' => esc_html__('Default', 'morenews'),
            'yoast' => esc_html__('Yoast SEO', 'morenews'),
            'rankmath' => esc_html__('Rank Math', 'morenews'),
            'bcn' => esc_html__('NavXT', 'morenews'),
        ),
        'priority' => 100,
    )
);




/**
 * Layout options section
 *
 * @package MoreNews
 */

// Layout Section.
$wp_customize->add_section(
    'site_layout_settings',
    array(
        'title' => esc_html__('Global Settings', 'morenews'),
        'priority' => 9,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);


// Setting - preloader.
$wp_customize->add_setting(
    'enable_site_preloader',
    array(
        'default' => $morenews_default['enable_site_preloader'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_checkbox',
    )
);

$wp_customize->add_control(
    'enable_site_preloader',
    array(
        'label' => esc_html__('Enable Preloader', 'morenews'),
        'section' => 'site_layout_settings',
        'type' => 'checkbox',
        'priority' => 10,
    )
);


// Setting - global content alignment of news.
$wp_customize->add_setting(
    'global_content_alignment',
    array(
        'default' => $morenews_default['global_content_alignment'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);

$wp_customize->add_control(
    'global_content_alignment',
    array(
        'label' => esc_html__('Global Content Alignment', 'morenews'),
        'section' => 'site_layout_settings',
        'type' => 'select',
        'choices' => array(
            'align-content-left' => esc_html__('Content - Primary sidebar', 'morenews'),
            'align-content-right' => esc_html__('Primary sidebar - Content', 'morenews'),
            'full-width-content' => esc_html__('Full width content', 'morenews')
        ),
        'priority' => 130,
    )
);

// Setting - global content alignment of news.
$wp_customize->add_setting('global_fetch_content_image_setting',
array(
    'default'           => $default['global_fetch_content_image_setting'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'morenews_sanitize_select',
)
);

$wp_customize->add_control( 'global_fetch_content_image_setting',
array(
    'label'       => esc_html__('Also Show Content Image in Archive', 'morenews'),
    'description'       => esc_html__('If there is no Post Featured image set', 'morenews'),
    'section'     => 'site_layout_settings',
    'type'        => 'select',
    'choices'               => array(
        'enable' => esc_html__( 'Enable ', 'morenews' ),
        'disable' => esc_html__( 'Disable', 'morenews' ),

    ),
    'priority'    => 130,
));



// Setting - global content alignment of news.
$wp_customize->add_setting('global_toggle_image_lazy_load_setting',
    array(
        'default'           => $default['global_toggle_image_lazy_load_setting'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);

$wp_customize->add_control( 'global_toggle_image_lazy_load_setting',
    array(
        'label'       => esc_html__('Image Lazy Loading', 'morenews'),
        'description'       => esc_html__('Set for better performance', 'morenews'),
        'section'     => 'site_layout_settings',
        'type'        => 'select',
        'choices'               => array(
            'enable' => esc_html__( 'Enable ', 'morenews' ),
            'disable' => esc_html__( 'Disable', 'morenews' ),

        ),
        'priority'    => 130,
    ));


// Setting - global content alignment of news.
$wp_customize->add_setting('global_decoding_image_async_setting',
array(
    'default'           => $default['global_decoding_image_async_setting'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'morenews_sanitize_select',
)
);

$wp_customize->add_control( 'global_decoding_image_async_setting',
array(
    'label'       => esc_html__('Image Async Decoding', 'morenews'),
    'description'       => esc_html__('Set to enhance rendering speed', 'morenews'),
    'section'     => 'site_layout_settings',
    'type'        => 'select',
    'choices'               => array(
        'enable' => esc_html__( 'Enable ', 'morenews' ),
        'disable' => esc_html__( 'Disable', 'morenews' ),

    ),
    'priority'    => 130,
));



// Setting - global content alignment of news.
$wp_customize->add_setting(
    'global_widget_title_border',
    array(
        'default' => $morenews_default['global_widget_title_border'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);

$wp_customize->add_control(
    'global_widget_title_border',
    array(
        'label' => esc_html__('Widget Title Style', 'morenews'),
        'section' => 'site_layout_settings',
        'type' => 'select',
        'choices' => array(
            'widget-title-border-bottom' => esc_html__('Border Bottom', 'morenews'),
            'widget-title-border-center' => esc_html__('Border Center', 'morenews'),
            'widget-title-fill-and-border' => esc_html__('Fill and Border', 'morenews'),
            'widget-title-fill-and-no-border' => esc_html__('Fill', 'morenews'),
            'widget-title-border-none' => esc_html__('None', 'morenews'),

        ),
        'priority' => 130,
    )
);


// Setting - global content alignment of news.
$wp_customize->add_setting(
    'global_scroll_to_top_position',
    array(
        'default' => $morenews_default['global_scroll_to_top_position'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);

$wp_customize->add_control(
    'global_scroll_to_top_position',
    array(
        'label' => esc_html__('Scroll to Top Position', 'morenews'),
        'section' => 'site_layout_settings',
        'type' => 'select',
        'choices' => array(
            'right' => esc_html__('Right', 'morenews'),
            'left' => esc_html__('Left', 'morenews'),
            'none' => esc_html__('None', 'morenews')

        ),
        'priority' => 130,
    )
);


// Global Section.
$wp_customize->add_section(
    'site_categories_settings',
    array(
        'title' => esc_html__('Categories Settings', 'morenews'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);

// Setting - global content alignment of news.
$wp_customize->add_setting(
    'global_show_categories',
    array(
        'default' => $morenews_default['global_show_categories'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);

$wp_customize->add_control(
    'global_show_categories',
    array(
        'label' => esc_html__('Post Categories', 'morenews'),
        'section' => 'site_categories_settings',
        'type' => 'select',
        'choices' => array(
            'yes' => esc_html__('Show', 'morenews'),
            'no' => esc_html__('Hide', 'morenews'),

        ),
        'priority' => 130,
    )
);


// Setting - global content alignment of news.
$wp_customize->add_setting(
    'global_number_of_categories',
    array(
        'default' => $morenews_default['global_number_of_categories'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);

$wp_customize->add_control(
    'global_number_of_categories',
    array(
        'label' => esc_html__('Categories to be displayed', 'morenews'),
        'section' => 'site_categories_settings',
        'type' => 'select',
        'choices' => array(
            'all' => esc_html__('Show All', 'morenews'),
            'one' => esc_html__('Top One Category', 'morenews'),
            'custom' => esc_html__('Custom', 'morenews'),

        ),
        'priority' => 130,
        'active_callback' => 'morenews_global_show_category_number_status'

    )
);

// Setting - sticky_header_option.
$wp_customize->add_setting(
    'global_custom_number_of_categories',
    array(
        'default' => $morenews_default['global_custom_number_of_categories'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);
$wp_customize->add_control(
    'global_custom_number_of_categories',
    array(
        'label' => esc_html__('Number of Categories', 'morenews'),
        'section' => 'site_categories_settings',
        'type' => 'number',
        'priority' => 130,
        'active_callback' => 'morenews_global_show_custom_category_number_status'
    )
);


// Setting - global content alignment of news.
$wp_customize->add_setting(
    'global_show_comment_count',
    array(
        'default' => $morenews_default['global_show_comment_count'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);

$wp_customize->add_control(
    'global_show_comment_count',
    array(
        'label' => esc_html__('Comment Count', 'morenews'),
        'section' => 'site_layout_settings',
        'type' => 'select',
        'choices' => array(
            'yes' => esc_html__('Show', 'morenews'),
            'no' => esc_html__('Hide', 'morenews'),

        ),
        'priority' => 130,
    )
);

// Global Section.
$wp_customize->add_section(
    'site_view_count_settings',
    array(
        'title' => esc_html__('View Count Settings', 'morenews'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);


// Setting - global content alignment of news.
$wp_customize->add_setting(
    'global_show_view_count',
    array(
        'default' => $morenews_default['global_show_view_count'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);

$wp_customize->add_control(
    'global_show_view_count',
    array(
        'label' => esc_html__('View Count', 'morenews'),
        'section' => 'site_view_count_settings',
        'type' => 'select',
        'choices' => array(
            'yes' => esc_html__('Show', 'morenews'),
            'no' => esc_html__('Hide', 'morenews'),

        ),
        'priority' => 130,
    )
);

//Post view count option
$wp_customize->add_setting(
    'single_post_view_count',
    array(
        'default' => $morenews_default['single_post_view_count'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);

$wp_customize->add_control(
    'single_post_view_count',
    array(
        'label' => esc_html__('View Count Option', 'morenews'),
        'description' => esc_html__('Select post view count for single post', 'morenews'),
        'section' => 'site_view_count_settings',
        'type' => 'select',
        'choices' => array(
            'each-load-default' => esc_html__('Default - Each View', 'morenews'),
            'count-content-scroll' => esc_html__('Count On Content Scroll', 'morenews'),
        ),
        'priority' => 130,
        'active_callback' => 'morenews_global_show_view_count_status'
    )
);


// Global Section.
$wp_customize->add_section(
    'site_author_and_date_settings',
    array(
        'title' => esc_html__('Author and Date Settings', 'morenews'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);


// Setting - global content alignment of news.
$wp_customize->add_setting(
    'global_post_date_author_setting',
    array(
        'default' => $morenews_default['global_post_date_author_setting'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);

$wp_customize->add_control(
    'global_post_date_author_setting',
    array(
        'label' => esc_html__('For Spotlight Posts', 'morenews'),
        'section' => 'site_author_and_date_settings',
        'type' => 'select',
        'choices' => array(
            'show-date-author' => esc_html__('Show Date and Author', 'morenews'),
            'show-date-only' => esc_html__('Show Date Only', 'morenews'),
            'show-author-only' => esc_html__('Show Author Only', 'morenews'),
            'hide-date-author' => esc_html__('Hide All', 'morenews'),
        ),
        'priority' => 130,
    )
);


// Setting - global content alignment of news.
$wp_customize->add_setting(
    'small_grid_post_date_author_setting',
    array(
        'default' => $morenews_default['small_grid_post_date_author_setting'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);

$wp_customize->add_control(
    'small_grid_post_date_author_setting',
    array(
        'label' => esc_html__('For Small Grid', 'morenews'),
        'section' => 'site_author_and_date_settings',
        'type' => 'select',
        'choices' => array(
            'show-date-author' => esc_html__('Show Date and Author', 'morenews'),
            'show-date-only' => esc_html__('Show Date Only', 'morenews'),
            'show-author-only' => esc_html__('Show Author Only', 'morenews'),
            'hide-date-author' => esc_html__('Hide All', 'morenews'),
        ),
        'priority' => 130,
    )
);

// Setting - global content alignment of news.
$wp_customize->add_setting(
    'list_post_date_author_setting',
    array(
        'default' => $morenews_default['list_post_date_author_setting'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);

$wp_customize->add_control(
    'list_post_date_author_setting',
    array(
        'label' => esc_html__('For List', 'morenews'),
        'section' => 'site_author_and_date_settings',
        'type' => 'select',
        'choices' => array(
            'show-date-author' => esc_html__('Show Date and Author', 'morenews'),
            'show-date-only' => esc_html__('Show Date Only', 'morenews'),
            'show-author-only' => esc_html__('Show Author Only', 'morenews'),
            'hide-date-author' => esc_html__('Hide All', 'morenews'),
        ),
        'priority' => 130,
    )
);

// Setting - global content alignment of news.
$wp_customize->add_setting(
    'global_author_icon_gravatar_display_setting',
    array(
        'default' => $morenews_default['global_author_icon_gravatar_display_setting'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);

$wp_customize->add_control(
    'global_author_icon_gravatar_display_setting',
    array(
        'label' => esc_html__('Author Icon/Gravatar', 'morenews'),
        'section' => 'site_author_and_date_settings',
        'type' => 'select',
        'choices' => array(
            'display-gravatar' => esc_html__('Show Gravatar', 'morenews'),
            'display-icon' => esc_html__('Show Icon', 'morenews'),
            'display-none' => esc_html__('None', 'morenews'),
        ),
        'priority' => 130,
        'active_callback' => 'morenews_display_author_status'
    )
);


// Setting - global content alignment of news.
$wp_customize->add_setting(
    'global_date_display_setting',
    array(
        'default' => $morenews_default['global_date_display_setting'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);

$wp_customize->add_control(
    'global_date_display_setting',
    array(
        'label' => esc_html__('Date Format', 'morenews'),
        'section' => 'site_author_and_date_settings',
        'type' => 'select',
        'choices' => array(
            'default-date' => esc_html__('WordPress Default Date Format', 'morenews'),
            'theme-date' => esc_html__('Ago Date Format', 'morenews'),
            'year-and-month' => esc_html__('Year and Month Format', 'morenews'),
            'month-and-day' => esc_html__('Month and Day Format', 'morenews'),
            'year' => esc_html__('Year Format', 'morenews'),
            'month' => esc_html__('Month Format', 'morenews'),
            'day' => esc_html__('Day Format', 'morenews'),
            '24-hours' => esc_html__('24 Hours Format', 'morenews'),
            '12-hours' => esc_html__('12 Hours Format', 'morenews'),


        ),
        'priority' => 130,
        'active_callback' => 'morenews_display_date_status'
    )
);


//========== minutes read count options ===============

// Global Section.
$wp_customize->add_section(
    'site_min_read_settings',
    array(
        'title' => esc_html__('Minutes Read Count', 'morenews'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);


// Setting - global content alignment of news.
$wp_customize->add_setting(
    'global_show_min_read',
    array(
        'default' => $morenews_default['global_show_min_read'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);

$wp_customize->add_control(
    'global_show_min_read',
    array(
        'label' => esc_html__('Minutes Read Count', 'morenews'),
        'section' => 'site_min_read_settings',
        'type' => 'select',
        'choices' => array(
            'yes' => esc_html__('Show', 'morenews'),
            'no' => esc_html__('Hide', 'morenews'),

        ),
        'priority' => 130,
    )
);

// Setting - sticky_header_option.
$wp_customize->add_setting(
    'global_show_min_read_number',
    array(
        'default' => $morenews_default['global_show_min_read_number'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);
$wp_customize->add_control(
    'global_show_min_read_number',
    array(
        'label' => esc_html__('Number of Words per Minute Read', 'morenews'),
        'section' => 'site_min_read_settings',
        'type' => 'number',
        'priority' => 130,
        'active_callback' => 'morenews_global_show_minutes_count_status'
    )
);


// Global Section.
$wp_customize->add_section(
    'site_excerpt_settings',
    array(
        'title' => esc_html__('Excerpt Settings', 'morenews'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);


// Setting - related posts.
$wp_customize->add_setting(
    'global_excerpt_length',
    array(
        'default' => $morenews_default['global_excerpt_length'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    'global_excerpt_length',
    array(
        'label' => __('Global Excerpt Length', 'morenews'),
        'section' => 'site_excerpt_settings',
        'type' => 'number',
        'priority' => 130,

    )
);

// Setting - related posts.
$wp_customize->add_setting(
    'global_read_more_texts',
    array(
        'default' => $morenews_default['global_read_more_texts'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    'global_read_more_texts',
    array(
        'label' => __('Global Excerpt Read More', 'morenews'),
        'section' => 'site_excerpt_settings',
        'type' => 'text',
        'priority' => 130,

    )
);


//============= Watch Online Section ==========
//section title
$wp_customize->add_setting(
    'show_watch_online_section_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new MoreNews_Section_Title(
        $wp_customize,
        'show_watch_online_section_section_title',
        array(
            'label' => esc_html__("Custom Menu Section", 'morenews'),
            'section' => 'header_options_settings',
            'priority' => 100,

        )
    )
);

$wp_customize->add_setting(
    'show_watch_online_section',
    array(
        'default' => $morenews_default['show_watch_online_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_checkbox',
    )
);

$wp_customize->add_control(
    'show_watch_online_section',
    array(
        'label' => esc_html__('Enable Custom Menu Section', 'morenews'),
        'section' => 'header_options_settings',
        'type' => 'checkbox',
        'priority' => 100,

    )
);


$wp_customize->add_setting(
    'aft_custom_icon_mode',
    array(
        'default' => $morenews_default['aft_custom_icon_mode'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);

$wp_customize->add_control(
    'aft_custom_icon_mode',
    array(
        'label' => esc_html__('Icon Mode', 'morenews'),
        'section' => 'header_options_settings',
        'type' => 'select',
        'choices' => array(
            'aft-custom-ripple' => esc_html__('Ripple', 'morenews'),
            'aft-custom-fa-icon' => esc_html__('FontAwesome Icon', 'morenews'),
        ),
        'priority' => 100,
    )
);



// Setting - related posts.
$wp_customize->add_setting(
    'aft_custom_icon',
    array(
        'default' => $morenews_default['aft_custom_icon'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    'aft_custom_icon',
    array(
        'label' => __('Icon', 'morenews'),
        'section' => 'header_options_settings',
        'type' => 'text',
        'priority' => 100,
        'active_callback' => function ($control) {
            return (
                morenews_show_watch_online_section_status($control)
                &&
                morenews_aft_custom_icon_mode_status($control)
            );
        }
    )
);

// Setting - related posts.
$wp_customize->add_setting(
    'aft_custom_title',
    array(
        'default' => $morenews_default['aft_custom_title'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    'aft_custom_title',
    array(
        'label' => __('Title', 'morenews'),
        'section' => 'header_options_settings',
        'type' => 'text',
        'priority' => 100,
        'active_callback' => 'morenews_show_watch_online_section_status'
    )
);

// Setting - related posts.
$wp_customize->add_setting(
    'aft_custom_link',
    array(
        'default' => $morenews_default['aft_custom_link'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    )
);

$wp_customize->add_control(
    'aft_custom_link',
    array(
        'label' => __('Link', 'morenews'),
        'section' => 'header_options_settings',
        'type' => 'text',
        'priority' => 100,
        'active_callback' => 'morenews_show_watch_online_section_status'
    )
);


//========== single posts options ===============

// Single Section.
$wp_customize->add_section(
    'site_single_posts_settings',
    array(
        'title' => esc_html__('Single Post', 'morenews'),
        'priority' => 9,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);

// Setting - related posts.
$wp_customize->add_setting(
    'single_show_featured_image',
    array(
        'default' => $morenews_default['single_show_featured_image'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_checkbox',
    )
);

$wp_customize->add_control(
    'single_show_featured_image',
    array(
        'label' => __('Show Featured Image', 'morenews'),
        'section' => 'site_single_posts_settings',
        'type' => 'checkbox',
        'priority' => 100,
    )
);


$wp_customize->add_setting(
    'single_post_title_view',
    array(
        'default' => $morenews_default['single_post_title_view'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);

$wp_customize->add_control(
    'single_post_title_view',
    array(
        'label' => esc_html__('Post Title Option', 'morenews'),
        'section' => 'site_single_posts_settings',
        'type' => 'select',
        'choices' => array(
            'boxed' => esc_html__('Boxed - Default', 'morenews'),
            'full' => esc_html__('Full', 'morenews'),
        ),
        'priority' => 100,
    )
);


// Setting - global content alignment of news.
$wp_customize->add_setting(
    'global_single_content_mode',
    array(
        'default'           => $default['global_single_content_mode'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);

$wp_customize->add_control(
    'global_single_content_mode',
    array(
        'label'       => esc_html__('Single Content Mode', 'morenews'),
        'section'     => 'site_single_posts_settings',
        'type'        => 'select',
        'choices'               => array(
            'single-content-mode-default' => esc_html__('Default', 'morenews'),
            'single-content-mode-boxed' => esc_html__('Spacious', 'morenews'),
        ),
        'priority'    => 100,
    )
);


//Social share option

if (class_exists('Jetpack') && Jetpack::is_module_active('sharedaddy')) :
    $wp_customize->add_setting(
        'single_post_social_share_view',
        array(
            'default' => $morenews_default['single_post_social_share_view'],
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'morenews_sanitize_select',
        )
    );

    $wp_customize->add_control(
        'single_post_social_share_view',
        array(
            'label' => esc_html__('Social Share Option', 'morenews'),
            'description' => esc_html__('Social Share from Jetpack plugin', 'morenews'),
            'section' => 'site_single_posts_settings',
            'type' => 'select',
            'choices' => array(
                'after-title-default' => esc_html__('Top - Default', 'morenews'),
                'after-content' => esc_html__('Bottom', 'morenews'),
            ),
            'priority' => 100,
        )
    );
endif;

// Setting - trending posts.
$wp_customize->add_setting(
    'single_show_tags_list',
    array(
        'default' => $morenews_default['single_show_tags_list'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_checkbox',
    )
);

$wp_customize->add_control(
    'single_show_tags_list',
    array(
        'label' => __('Show Tags under Content', 'morenews'),
        'section' => 'site_single_posts_settings',
        'settings' => 'single_show_tags_list',
        'type' => 'checkbox',
        'priority' => 100,
    )
);


// Setting - mailchimp posts.
$wp_customize->add_setting(
    'single_show_mailchimp_subscriptions',
    array(
        'default' => $morenews_default['single_show_mailchimp_subscriptions'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_checkbox',
    )
);

$wp_customize->add_control(
    'single_show_mailchimp_subscriptions',
    array(
        'label' => __('Show MailChimp Subscription Box', 'morenews'),
        'section' => 'site_single_posts_settings',
        'type' => 'checkbox',
        'priority' => 100,
    )
);

// Setting - trending posts.
$wp_customize->add_setting(
    'single_show_trending_post_list',
    array(
        'default' => $morenews_default['single_show_trending_post_list'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_checkbox',
    )
);

$wp_customize->add_control(
    'single_show_trending_post_list',
    array(
        'label' => __('Show Trending Posts List', 'morenews'),
        'section' => 'site_single_posts_settings',
        'type' => 'checkbox',
        'priority' => 100,
    )
);


//========== related posts  options ===============

$wp_customize->add_setting(
    'single_related_posts_section_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new MoreNews_Section_Title(
        $wp_customize,
        'single_related_posts_section_title',
        array(
            'label' => esc_html__("Related Posts Settings", 'morenews'),
            'section' => 'site_single_posts_settings',
            'priority' => 100,

        )
    )
);

// Setting - related posts.
$wp_customize->add_setting(
    'single_show_related_posts',
    array(
        'default' => $morenews_default['single_show_related_posts'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_checkbox',
    )
);

$wp_customize->add_control(
    'single_show_related_posts',
    array(
        'label' => __('Enable Related Posts', 'morenews'),
        'section' => 'site_single_posts_settings',
        'type' => 'checkbox',
        'priority' => 100,
    )
);

// Setting - related posts.
$wp_customize->add_setting(
    'single_related_posts_title',
    array(
        'default' => $morenews_default['single_related_posts_title'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    'single_related_posts_title',
    array(
        'label' => __('Title', 'morenews'),
        'section' => 'site_single_posts_settings',
        'type' => 'text',
        'priority' => 100,
        'active_callback' => 'morenews_related_posts_status'
    )
);


// Setting - related posts.
$wp_customize->add_setting(
    'single_number_of_related_posts',
    array(
        'default' => $morenews_default['single_number_of_related_posts'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    'single_number_of_related_posts',
    array(
        'label' => __('Maximum Number of Related Posts', 'morenews'),
        'section' => 'site_single_posts_settings',
        'type' => 'number',
        'priority' => 100,
        'active_callback' => 'morenews_related_posts_status'
    )
);



/**
 * Archive options section
 *
 * @package MoreNews
 */

// Archive Section.
$wp_customize->add_section(
    'site_archive_settings',
    array(
        'title' => esc_html__('Archive Settings', 'morenews'),
        'priority' => 9,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);


// Disable main banner in blog
$wp_customize->add_setting(
    'disable_main_banner_on_blog_archive',
    array(
        'default'           => $default['disable_main_banner_on_blog_archive'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_checkbox',
    )
);

$wp_customize->add_control(
    'disable_main_banner_on_blog_archive',
    array(
        'label'    => esc_html__('Disable Main Banner on Blog', 'morenews'),
        'section'  => 'site_archive_settings',
        'type'     => 'checkbox',
        'priority' => 50,
        'active_callback' => 'morenews_main_banner_section_status'
    )
);

//Setting - archive content view of news.
$wp_customize->add_setting(
    'archive_layout',
    array(
        'default' => $morenews_default['archive_layout'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);

$wp_customize->add_control(
    'archive_layout',
    array(
        'label' => esc_html__('Archive layout', 'morenews'),
        'description' => esc_html__('Select layout for archive', 'morenews'),
        'section' => 'site_archive_settings',
        'type' => 'select',
        'choices' => array(
            'archive-layout-grid' => esc_html__('Grid', 'morenews'),
            'archive-layout-list' => esc_html__('List', 'morenews'),
            'archive-layout-full' => esc_html__('Full', 'morenews'),
            'archive-layout-masonry' => esc_html__('Masonry', 'morenews'),
        ),
        'priority' => 130,
    )
);

// Setting - latest blog carousel.
$wp_customize->add_setting(
    'archive_layout_first_post_full',
    array(
        'default' => $morenews_default['archive_layout_first_post_full'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_checkbox',
    )
);

$wp_customize->add_control(
    'archive_layout_first_post_full',
    array(
        'label' => __('Make First Post Full', 'morenews'),
        'section' => 'site_archive_settings',
        'type' => 'checkbox',
        'priority' => 130,
        'active_callback' => 'morenews_archive_layout_first_post_full_status'
    )
);


// Setting - archive content view of news.
$wp_customize->add_setting(
    'archive_image_alignment',
    array(
        'default' => $morenews_default['archive_image_alignment'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);

$wp_customize->add_control(
    'archive_image_alignment',
    array(
        'label' => esc_html__('Image Alignment', 'morenews'),
        'description' => esc_html__('Select image alignment for archive', 'morenews'),
        'section' => 'site_archive_settings',
        'type' => 'select',
        'choices' => array(
            'archive-image-left' => esc_html__('Left', 'morenews'),
            'archive-image-right' => esc_html__('Right', 'morenews'),
            'archive-image-alternate' => esc_html__('Alternate', 'morenews'),
        ),
        'priority' => 130,
        'active_callback' => 'morenews_archive_image_status'
    )
);


// Setting - archive content view of news.
$wp_customize->add_setting(
    'archive_image_alignment_grid',
    array(
        'default' => $morenews_default['archive_image_alignment_grid'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);

$wp_customize->add_control(
    'archive_image_alignment_grid',
    array(
        'label' => esc_html__('Image Alignment', 'morenews'),
        'description' => esc_html__('Select image alignment for archive', 'morenews'),
        'section' => 'site_archive_settings',
        'type' => 'select',
        'choices' => array(
            'archive-image-default' => esc_html__('Default', 'morenews'),
            'archive-image-up-alternate' => esc_html__('Alternate', 'morenews'),
            'archive-image-tile' => esc_html__('Tile', 'morenews'),
            'archive-image-list-alternate' => esc_html__('Default With List', 'morenews'),
        ),
        'priority' => 130,
        'active_callback' => 'morenews_archive_image_gird_status'
    )
);


// Setting - archive grid view column option
$wp_customize->add_setting(
    'archive_grid_column_layout',
    array(
        'default' => $morenews_default['archive_grid_column_layout'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);

$wp_customize->add_control(
    'archive_grid_column_layout',
    array(
        'label' => esc_html__('Grid Column Layout', 'morenews'),
        'description' => esc_html__('Select column for archive grid', 'morenews'),
        'section' => 'site_archive_settings',
        'type' => 'select',
        'choices' => array(
            'grid-layout-two' => esc_html__('Two Column', 'morenews'),
            'grid-layout-three' => esc_html__('Three Column', 'morenews'),
            'grid-layout-four' => esc_html__('Four Column', 'morenews'),
        ),
        'priority' => 130,
        'active_callback' => 'morenews_archive_image_gird_status'
    )
);


//Settings - archive content masonry view
$wp_customize->add_setting(
    'archive_layout_masonry',
    array(
        'default' => $morenews_default['archive_layout_masonry'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);

$wp_customize->add_control(
    'archive_layout_masonry',
    array(
        'label' => esc_html__('Select Masonry Layout', 'morenews'),
        'description' => esc_html__('Select masonry layout for archive', 'morenews'),
        'section' => 'site_archive_settings',
        'type' => 'select',
        'choices' => array(
            'masonry-layout-two' => esc_html__('Two Column', 'morenews'),
            'masonry-layout-default' => esc_html__('Three Column', 'morenews'),
            'masonry-layout-four' => esc_html__('Four Column', 'morenews'),
        ),
        'priority' => 130,
        'active_callback' => 'morenews_archive_masonry_status'
    )
);

//Settings - archive content full view
$wp_customize->add_setting(
    'archive_layout_full',
    array(
        'default' => $morenews_default['archive_layout_full'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);

$wp_customize->add_control(
    'archive_layout_full',
    array(
        'label' => esc_html__('Select Title Position', 'morenews'),
        'description' => esc_html__('Select full layout for archive', 'morenews'),
        'section' => 'site_archive_settings',
        'type' => 'select',
        'choices' => array(
            'full-image-first' => esc_html__('After Image', 'morenews'),
            'full-title-first' => esc_html__('Before Image', 'morenews'),
            'full-image-tile' => esc_html__('Over Image', 'morenews'),

        ),
        'priority' => 130,
        'active_callback' => 'morenews_archive_full_status'
    )
);

//Setting - archive content view of news.
$wp_customize->add_setting(
    'archive_content_view',
    array(
        'default' => $morenews_default['archive_content_view'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);

$wp_customize->add_control(
    'archive_content_view',
    array(
        'label' => esc_html__('Content View', 'morenews'),
        'description' => esc_html__('Select content view for archive', 'morenews'),
        'section' => 'site_archive_settings',
        'type' => 'select',
        'choices' => array(
            'archive-content-excerpt' => esc_html__('Post Excerpt', 'morenews'),
            'archive-content-full' => esc_html__('Full Content', 'morenews'),
            'archive-content-none' => esc_html__('None', 'morenews'),

        ),
        'priority' => 130,
    )
);

//Setting - archive pagination view of news.
$wp_customize->add_setting(
    'archive_pagination_view',
    array(
        'default' => $morenews_default['archive_pagination_view'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);

$wp_customize->add_control(
    'archive_pagination_view',
    array(
        'label' => esc_html__('Pagination', 'morenews'),
        'description' => esc_html__('Select pagination view for archive', 'morenews'),
        'section' => 'site_archive_settings',
        'type' => 'select',
        'choices' => array(
            'archive-default' => esc_html__('Default', 'morenews'),
            'archive-ajax-loadmore' => esc_html__('Ajax Load More', 'morenews'),
            'archive-infinite-scroll' => esc_html__('Infinite Scroll', 'morenews'),

        ),
        'priority' => 130,
    )
);


//========== sidebar blocks options ===============

// Trending Section.
$wp_customize->add_section(
    'sidebar_block_settings',
    array(
        'title' => esc_html__('Sidebar Settings', 'morenews'),
        'priority' => 9,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);


// Setting - frontpage_sticky_sidebar.
$wp_customize->add_setting(
    'frontpage_sticky_sidebar',
    array(
        'default' => $default['frontpage_sticky_sidebar'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_checkbox',
    )
);

$wp_customize->add_control(
    'frontpage_sticky_sidebar',
    array(
        'label' => esc_html__('Make Sidebar Sticky', 'morenews'),
        'section' => 'sidebar_block_settings',
        'type' => 'checkbox',
        'priority' => 100,

    )
);

// Setting - global content alignment of news.
$wp_customize->add_setting(
    'frontpage_sticky_sidebar_position',
    array(
        'default' => $default['frontpage_sticky_sidebar_position'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);

$wp_customize->add_control(
    'frontpage_sticky_sidebar_position',
    array(
        'label' => esc_html__('Sidebar Sticky Position', 'morenews'),
        'section' => 'sidebar_block_settings',
        'type' => 'select',
        'choices' => array(
            'sidebar-sticky-top' => esc_html__('Top', 'morenews'),
            'sidebar-sticky-bottom' => esc_html__('Bottom', 'morenews'),
        ),
        'priority' => 100,
        'active_callback' => 'frontpage_sticky_sidebar_status'
    )
);

//========== footer latest blog carousel options ===============

// Footer Section.
$wp_customize->add_section(
    'frontpage_latest_posts_settings',
    array(
        'title' => esc_html__('You May Have Missed', 'morenews'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);
// Setting - latest blog carousel.
$wp_customize->add_setting(
    'frontpage_show_latest_posts',
    array(
        'default' => $morenews_default['frontpage_show_latest_posts'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_checkbox',
    )
);

$wp_customize->add_control(
    'frontpage_show_latest_posts',
    array(
        'label' => __('Show Above Footer', 'morenews'),
        'section' => 'frontpage_latest_posts_settings',
        'type' => 'checkbox',
        'priority' => 100,
    )
);


// Setting - featured_news_section_title.
$wp_customize->add_setting(
    'frontpage_latest_posts_section_title',
    array(
        'default' => $morenews_default['frontpage_latest_posts_section_title'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'frontpage_latest_posts_section_title',
    array(
        'label' => esc_html__('Posts Section Title', 'morenews'),
        'section' => 'frontpage_latest_posts_settings',
        'type' => 'text',
        'priority' => 100,
        'active_callback' => 'morenews_latest_news_section_status'

    )
);


// Setting - number of posts
$wp_customize->add_setting(
    'number_of_frontpage_latest_posts',
    array(
        'default' => $morenews_default['number_of_frontpage_latest_posts'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(
    'number_of_frontpage_latest_posts',
    array(
        'label' => __('Number of Posts', 'morenews'),
        'section' => 'frontpage_latest_posts_settings',
        'type' => 'text',
        'priority' => 100,
        'active_callback' => 'morenews_latest_news_section_status'
    )
);


//========== mailchimp subscription box options ===============

// Footer Section.
$wp_customize->add_section(
    'site_footer_mailchimp_settings',
    array(
        'title' => esc_html__('Mailchimp Subscriptions', 'morenews'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);

// Setting - mailchimp.
$wp_customize->add_setting(
    'footer_show_mailchimp_subscriptions',
    array(
        'default' => $morenews_default['footer_show_mailchimp_subscriptions'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_checkbox',
    )
);

$wp_customize->add_control(
    'footer_show_mailchimp_subscriptions',
    array(
        'label' => __('Show Above Footer', 'morenews'),
        'section' => 'site_footer_mailchimp_settings',
        'type' => 'checkbox',
        'priority' => 100,
    )
);

// Setting - mailchimp.
$wp_customize->add_setting(
    'footer_mailchimp_title',
    array(
        'default' => $morenews_default['footer_mailchimp_title'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    'footer_mailchimp_title',
    array(
        'label' => __('Title', 'morenews'),
        'section' => 'site_footer_mailchimp_settings',
        'type' => 'text',
        'priority' => 100,
        'active_callback' => 'morenews_mailchimp_subscriptions_status'
    )
);


// Setting - mailchimp.
$wp_customize->add_setting(
    'footer_mailchimp_shortcode',
    array(
        'default' => $morenews_default['footer_mailchimp_shortcode'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    'footer_mailchimp_shortcode',
    array(
        'label' => __('Shortcode', 'morenews'),
        'section' => 'site_footer_mailchimp_settings',
        'type' => 'text',
        'priority' => 100,
        'active_callback' => 'morenews_mailchimp_subscriptions_status'
    )
);


// Setting number_of_footer_widget.
$wp_customize->add_setting(
    'footer_mailchimp_subscriptions_scopes',
    array(
        'default' => $morenews_default['footer_mailchimp_subscriptions_scopes'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_select',
    )
);


$wp_customize->add_control(
    'footer_mailchimp_subscriptions_scopes',
    array(
        'label' => esc_html__('Visible In:', 'morenews'),
        'section' => 'site_footer_mailchimp_settings',
        'type' => 'select',
        'priority' => 100,
        'choices' => array(
            'front-page' => esc_html__('Front page only', 'morenews'),
            'all-pages' => esc_html__('All pages', 'morenews'),

        ),
        'active_callback' => 'morenews_mailchimp_subscriptions_status'
    )
);


//========== footer section options ===============
// Footer Section.
$wp_customize->add_section(
    'site_footer_settings',
    array(
        'title' => esc_html__('Footer', 'morenews'),
        'priority' => 50,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);


// Setting banner_advertisement_section.
$wp_customize->add_setting(
    'footer_background_image',
    array(
        'default' => $default['footer_background_image'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(
    new WP_Customize_Cropped_Image_Control(
        $wp_customize,
        'footer_background_image',
        array(
            'label' => esc_html__('Footer Background Image', 'morenews'),
            'description' => sprintf(esc_html__('Recommended Size %1$s px X %2$s px', 'morenews'), 1024, 800),
            'section' => 'site_footer_settings',
            'width' => 1024,
            'height' => 800,
            'flex_width' => true,
            'flex_height' => true,
            'priority' => 100,
        )
    )
);

// Setting - global content alignment of news.
$wp_customize->add_setting(
    'footer_copyright_text',
    array(
        'default' => $morenews_default['footer_copyright_text'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    'footer_copyright_text',
    array(
        'label' => __('Copyright Text', 'morenews'),
        'section' => 'site_footer_settings',
        'type' => 'text',
        'priority' => 100,
    )
);


// Setting - global content alignment of news.
$wp_customize->add_setting(
    'hide_footer_menu_section',
    array(
        'default' => $morenews_default['hide_footer_menu_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_checkbox',
    )
);

$wp_customize->add_control(
    'hide_footer_menu_section',
    array(
        'label' => __('Hide footer Menu Section', 'morenews'),
        'section' => 'site_footer_settings',
        'type' => 'checkbox',
        'priority' => 100,
    )
);


// Setting - global content alignment of news.
$wp_customize->add_setting(
    'hide_footer_copyright_credits',
    array(
        'default' => $morenews_default['hide_footer_copyright_credits'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'morenews_sanitize_checkbox',
    )
);

$wp_customize->add_control(
    'hide_footer_copyright_credits',
    array(
        'label' => __('Hide Theme Credits', 'morenews'),
        'section' => 'site_footer_settings',
        'type' => 'checkbox',
        'priority' => 100,
    )
);
