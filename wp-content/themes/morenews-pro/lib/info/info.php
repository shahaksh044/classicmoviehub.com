<?php
/**
 * Info setup
 *
 * @package MoreNews
 */

if ( ! function_exists( 'morenews_details_setup' ) ) :

    /**
     * Info setup.
     *
     * @since 1.0.0
     */
    function morenews_details_setup() {

        $config = array(

            // Welcome content.
            'welcome-texts' => sprintf( esc_html__( 'Howdy %1$s, we would like to thank you for installing and activating %2$s theme for your precious site. All of the features provided by the theme are now ready to use; Here, we have gathered all of the essential details and helpful links for you and your better experience with %2$s. Once again, Thanks for using our theme!', 'morenews' ), get_bloginfo('name'), 'MoreNews' ),

            // Tabs.
            'tabs' => array(
                'getting-started' => esc_html__( 'Getting Started', 'morenews' ),
                'support'         => esc_html__( 'Support', 'morenews' ),
                'useful-plugins'  => esc_html__( 'Useful Plugins', 'morenews' ),
                'demo-content'    => esc_html__( 'Demo Content', 'morenews' ),
                //'upgrade-to-pro'  => esc_html__( 'Upgrade to Pro', 'morenews' ),
            ),

            // Quick links.
            'quick_links' => array(
                'theme_url' => array(
                    'text' => esc_html__( 'Theme Details', 'morenews' ),
                    'url'  => 'https://afthemes.com/products/morenews-pro/',
                ),
                'demo_url' => array(
                    'text' => esc_html__( 'View Demo', 'morenews' ),
                    'url'  => 'https://afthemes.com/morenews-pro-professional-wordpress-theme-for-news-blog-and-magazine-websites/',
                ),
                'documentation_url' => array(
                    'text' => esc_html__( 'View Documentation', 'morenews' ),
                    'url'  => 'https://docs.afthemes.com/morenews-pro/',
                ),
                'rating_url' => array(
                    'text' => esc_html__( 'Rate This Theme','morenews' ),
                    'url'  => 'https://wordpress.org/support/theme/morenews/reviews/#new-post',
                ),
            ),

            // Getting started.
            'getting_started' => array(
                'one' => array(
                    'title'       => esc_html__( 'Theme Documentation', 'morenews' ),
                    'icon'        => 'dashicons dashicons-format-aside',
                    'description' => esc_html__( 'Please check our full documentation for detailed information on how to setup and customize the theme.', 'morenews' ),
                    'button_text' => esc_html__( 'View Documentation', 'morenews' ),
                    'button_url'  => 'https://docs.afthemes.com/morenews-pro/',
                    'button_type' => 'link',
                    'is_new_tab'  => true,
                ),
                'two' => array(
                    'title'       => esc_html__( 'Static Front Page', 'morenews' ),
                    'icon'        => 'dashicons dashicons-admin-generic',
                    'description' => esc_html__( 'To achieve custom home page other than blog listing, you need to create and set static front page.', 'morenews' ),
                    'button_text' => esc_html__( 'Static Front Page', 'morenews' ),
                    'button_url'  => admin_url( 'customize.php?autofocus[section]=static_front_page' ),
                    'button_type' => 'primary',
                ),
                'three' => array(
                    'title'       => esc_html__( 'Theme Options', 'morenews' ),
                    'icon'        => 'dashicons dashicons-admin-customizer',
                    'description' => esc_html__( 'Theme uses Customizer API for theme options. Using the Customizer you can easily customize different aspects of the theme.', 'morenews' ),
                    'button_text' => esc_html__( 'Customize', 'morenews' ),
                    'button_url'  => wp_customize_url(),
                    'button_type' => 'primary',
                ),
                'four' => array(
                    'title'       => esc_html__( 'Widgets', 'morenews' ),
                    'icon'        => 'dashicons dashicons-welcome-widgets-menus',
                    'description' => esc_html__( 'Theme uses Wedgets API for widget options. Using the Widgets you can easily customize different aspects of the theme.', 'morenews' ),
                    'button_text' => esc_html__( 'Widgets', 'morenews' ),
                    'button_url'  => admin_url('widgets.php'),
                    'button_type' => 'primary',
                ),
                'five' => array(
                    'title'       => esc_html__( 'Demo Content', 'morenews' ),
                    'icon'        => 'dashicons dashicons-layout',
                    'description' => sprintf( esc_html__( 'To import sample demo content, %1$s plugin should be installed and activated. After plugin is activated, visit AF Companion Dashboard from admin menu.', 'morenews' ), '<a href="https://wordpress.org/plugins/af-companion/" target="_blank">AF Companion</a>' ),
                    'button_text' => esc_html__( 'Demo Content', 'morenews' ),
                    'button_url'  => admin_url( 'themes.php?page=morenews-pro-details&tab=demo-content' ),
                    'button_type' => 'secondary',
                ),
                'six' => array(
                    'title'       => esc_html__( 'Theme Preview', 'morenews' ),
                    'icon'        => 'dashicons dashicons-welcome-view-site',
                    'description' => esc_html__( 'You can check out the theme demos for reference to find out what you can achieve using the theme and how it can be customized.', 'morenews' ),
                    'button_text' => esc_html__( 'View Demo', 'morenews' ),
                    'button_url'  => 'https://afthemes.com/morenews-pro-professional-wordpress-theme-for-news-blog-and-magazine-websites/',
                    'button_type' => 'link',
                    'is_new_tab'  => true,
                ),
            ),

            // Support.
            'support' => array(
                'one' => array(
                    'title'       => esc_html__( 'Contact Support', 'morenews' ),
                    'icon'        => 'dashicons dashicons-sos',
                    'description' => esc_html__( 'Got theme support question or found bug or got some feedbacks? Best place to ask your query is the dedicated Support forum for the theme.', 'morenews' ),
                    'button_text' => esc_html__( 'Contact Support', 'morenews' ),
                    'button_url'  => 'https://wordpress.org/support/theme/morenews/',
                    'button_type' => 'link',
                    'is_new_tab'  => true,
                ),
                'two' => array(
                    'title'       => esc_html__( 'Theme Documentation', 'morenews' ),
                    'icon'        => 'dashicons dashicons-format-aside',
                    'description' => esc_html__( 'Please check our full documentation for detailed information on how to setup and customize the theme.', 'morenews' ),
                    'button_text' => esc_html__( 'View Documentation', 'morenews' ),
                    'button_url'  => 'https://docs.afthemes.com/morenews-pro/',
                    'button_type' => 'link',
                    'is_new_tab'  => true,
                ),
                'three' => array(
                    'title'       => esc_html__( 'Child Theme', 'morenews' ),
                    'icon'        => 'dashicons dashicons-admin-tools',
                    'description' => esc_html__( 'For advanced theme customization, it is recommended to use child theme rather than modifying the theme file itself. Using this approach, you wont lose the customization after theme update.', 'morenews' ),
                    'button_text' => esc_html__( 'Learn More', 'morenews' ),
                    'button_url'  => 'https://developer.wordpress.org/themes/advanced-topics/child-themes/',
                    'button_type' => 'link',
                    'is_new_tab'  => true,
                ),
            ),

            //Useful plugins.
            'useful_plugins' => array(
                'description' => esc_html__( 'Theme supports some helpful WordPress plugins to enhance your site. But, please enable only those plugins which you need in your site. For example, enable WooCommerce only if you are using e-commerce.', 'morenews' ),
            ),

            //Demo content.
            'demo_content' => array(
                'description' => sprintf( esc_html__( 'To import demo content for this theme, %1$s plugin is needed. Please make sure plugin is installed and activated. After plugin is activated, you will see AF Companion Dashboard from admin menu.', 'morenews' ), '<a href="https://wordpress.org/plugins/af-companion/" target="_blank">' . esc_html__( 'AF Companion', 'morenews' ) . '</a>' ),
            ),

            //Free vs Pro.
            'free_vs_pro' => array(

                'features' => array(
                    'Live editing in Customizer' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Typography style and colors' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'Preloader Option' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Multiple Header Options' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'Logo and title customization' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Multiple Frontpage Banner Options' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'Featured Posts on Banner Section' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Banner Featured Posts Controls' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'WooCommerce Compatibility' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Category Color Options' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Number of Category Color Options' => array('3 Available', '7 Available'),
                    'Banner Advertisements' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Posts Section Advertisements' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'Custom Widgets' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Number of Custom Widgets' => array('7+ Available', '10+ Available'),
                    'Author Biography' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Posts Slider Widget' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Posts Carousel Widget' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Posts Grid Widget' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Posts Double Coulmn Double Categories Widget' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Posts Tabbed Widget' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Social Contacts Widget' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Posts Single Column Widget' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'Trending Posts Vertical Carousel Widget' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'YouTube Video Slider Widget' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'Custom Widgets Controls' => array('Basic', 'Advanced'),
                    'Archive Layout' => array('Full, Grid', 'List, Full, Grid'),
                    'Instagram Feeds' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'Mailchimp Subscription Section' => array('No', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Display Related Posts' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'Footer Widgets Section' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Hide Theme Credit Link' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                    'Responsive Layout' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'Translations Ready' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                    'SEO' => array('Optimized', 'Optimized'),
                    'Support' => array('Yes', 'High Priority Dedicated Support')
                ),
            ),

            // Upgrade content.
            'upgrade_to_pro' => array(
                'description' => esc_html__( 'If you want more advanced features then you can upgrade to the premium version of the theme.', 'morenews' ),
                'button_text' => esc_html__( 'Upgrade Now', 'morenews' ),
                'button_url'  => 'https://afthemes.com/products/morenews-pro',
                'button_type' => 'primary',
                'is_new_tab'  => true,
            ),
        );

        MoreNews_Info::init( $config );
    }

endif;

add_action( 'after_setup_theme', 'morenews_details_setup' );