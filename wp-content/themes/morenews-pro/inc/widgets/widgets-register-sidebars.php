<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function morenews_widgets_init()
{
   
    
    register_sidebar(array(
        'name' => esc_html__('Main Sidebar', 'morenews'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets for main sidebar.', 'morenews'),
        'before_widget' => '<div id="%1$s" class="widget morenews-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span class="heading-line-before"></span><span class="heading-line">',
        'after_title' => '</span><span class="heading-line-after"></span></h2>',
    ));


    
    register_sidebar(array(
        'name' => esc_html__('Front-page Content Section', 'morenews'),
        'id' => 'home-content-widgets',
        'description' => esc_html__('Add widgets to front-page contents section.', 'morenews'),
        'before_widget' => '<div id="%1$s" class="widget morenews-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span class="heading-line-before"></span><span class="heading-line">',
        'after_title' => '</span><span class="heading-line-after"></span></h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Front-page Sidebar Section', 'morenews'),
        'id' => 'home-sidebar-widgets',
        'description' => esc_html__('Add widgets to front-page sidebar section.', 'morenews'),
        'before_widget' => '<div id="%1$s" class="widget morenews-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span class="heading-line-before"></span><span class="heading-line">',
        'after_title' => '</span><span class="heading-line-after"></span></h2>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Banner Ad Section', 'morenews'),
        'id'            => 'home-advertisement-widgets',
        'description'   => esc_html__('Add widgets for frontpage banner section advertisement.', 'morenews'),
        'before_widget' => '<div id="%1$s" class="widget morenews-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span class="heading-line-before"></span><span class="heading-line">',
        'after_title' => '</span><span class="heading-line-after"></span></h2>',
    ));


    register_sidebar(array(
        'name'          => esc_html__('Off Canvas', 'morenews'),
        'id'            => 'express-off-canvas-panel',
        'description'   => esc_html__('Add widgets for off-canvas section.', 'morenews'),
        'before_widget' => '<div id="%1$s" class="widget morenews-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span class="heading-line-before"></span><span class="heading-line">',
        'after_title' => '</span><span class="heading-line-after"></span></h2>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Above Main Banner Section', 'morenews'),
        'id'            => 'home-above-main-banner-widgets',
        'description'   => esc_html__('Add widgets for above main banner section.', 'morenews'),
        'before_widget' => '<div id="%1$s" class="widget morenews-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span class="heading-line-before"></span><span class="heading-line">',
        'after_title' => '</span><span class="heading-line-after"></span></h2>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Below Main Banner Section', 'morenews'),
        'id'            => 'home-below-main-banner-widgets',
        'description'   => esc_html__('Add widgets for below main banner section.', 'morenews'),
        'before_widget' => '<div id="%1$s" class="widget morenews-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span class="heading-line-before"></span><span class="heading-line">',
        'after_title' => '</span><span class="heading-line-after"></span></h2>',
    ));




    register_sidebar(array(
        'name'          => esc_html__('Below Featured Section', 'morenews'),
        'id'            => 'home-below-featured-posts-widgets',
        'description'   => esc_html__('Add widgets for below featured section.', 'morenews'),
        'before_widget' => '<div id="%1$s" class="widget morenews-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span class="heading-line-before"></span><span class="heading-line">',
        'after_title' => '</span><span class="heading-line-after"></span></h2>',
    ));
    
    

    
    register_sidebar(array(
        'name' => esc_html__('Footer First Section', 'morenews'),
        'id' => 'footer-first-widgets-section',
        'description' => esc_html__('Displays items on footer first column.', 'morenews'),
        'before_widget' => '<div id="%1$s" class="widget morenews-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span class="heading-line-before"></span><span class="heading-line">',
        'after_title' => '</span><span class="heading-line-after"></span></h2>',
    ));


    register_sidebar(array(
        'name' => esc_html__('Footer Second Section', 'morenews'),
        'id' => 'footer-second-widgets-section',
        'description' => esc_html__('Displays items on footer second column.', 'morenews'),
        'before_widget' => '<div id="%1$s" class="widget morenews-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span class="heading-line-before"></span><span class="heading-line">',
        'after_title' => '</span><span class="heading-line-after"></span></h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Third Section', 'morenews'),
        'id' => 'footer-third-widgets-section',
        'description' => esc_html__('Displays items on footer third column.', 'morenews'),
        'before_widget' => '<div id="%1$s" class="widget morenews-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span class="heading-line-before"></span><span class="heading-line">',
        'after_title' => '</span><span class="heading-line-after"></span></h2>',
    ));


    register_sidebar(array(
        'name'          => esc_html__('Below Posts Title Ad Section', 'morenews'),
        'id'            => 'single-below-posts-title-advertisement-widgets',
        'description'   => esc_html__('Add widgets for single below posts title advertisement.', 'morenews'),
        'before_widget' => '<div id="%1$s" class="widget morenews-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span class="heading-line-before"></span>',
        'after_title' => '</span><span class="heading-line-after"></span></h2>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Below Posts Content Ad Section', 'morenews'),
        'id'            => 'single-below-posts-content-advertisement-widgets',
        'description'   => esc_html__('Add widgets for single posts advertisement.', 'morenews'),
        'before_widget' => '<div id="%1$s" class="widget morenews-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span class="heading-line-before"></span>',
        'after_title' => '</span><span class="heading-line-after"></span></h2>',
    ));


}

add_action('widgets_init', 'morenews_widgets_init');