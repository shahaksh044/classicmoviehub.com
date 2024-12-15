<?php

// Load widget base.
require_once get_template_directory() . '/inc/widgets/widgets-base.php';


/* Theme Widget sidebars. */
require get_template_directory() . '/inc/widgets/widgets-common-functions.php';

/**
 * Load Init for Hook files.
 */

require get_template_directory() . '/inc/widgets/widgets-register-sidebars.php';

/*
 * Load Post carousel
 */

require get_template_directory() . '/inc/widgets/widget-posts-carousel.php';


/*
* Load Post List
*/

require get_template_directory() . '/inc/widgets/widget-posts-list.php';


/*
* Load Post List
*/

require get_template_directory() . '/inc/widgets/widget-posts-grid.php';

/*
* Load Express Posts List
*/

require get_template_directory() . '/inc/widgets/widget-express-posts-list.php';


/*
* Load Post List
*/

require get_template_directory() . '/inc/widgets/widget-posts-single-column.php';

/*
* Load Post List
*/

require get_template_directory() . '/inc/widgets/widget-posts-double-column.php';

/*
* Load Express Posts List
*/

require get_template_directory() . '/inc/widgets/widget-express-posts-grid.php';


/*
 * Load Trending Posts
 */

require get_template_directory() . '/inc/widgets/widget-trending-posts.php';

/*
 * Load Trending Posts by Tag
 */

require get_template_directory() . '/inc/widgets/widget-trending-posts-by-tag.php';

/*
 * Load Trending Posts by View
 */

require get_template_directory() . '/inc/widgets/widget-trending-posts-by-view.php';

/*
  * Load Popular Posts
  */

require get_template_directory() . '/inc/widgets/widget-popular-posts.php';


/*
 * Load Prime News
 */

require get_template_directory() . '/inc/widgets/widget-author-info.php';

/*
 * Load Posts Slider
 */

require get_template_directory() . '/inc/widgets/widget-posts-slider.php';

/*
 * Load Post Tabs
 */

require get_template_directory() . '/inc/widgets/widget-posts-slider.php';

/*
 * Load Post Tabs
 */

require get_template_directory() . '/inc/widgets/widget-posts-tabs.php';


/*
* Load Social contact
*/

require get_template_directory() . '/inc/widgets/widget-social-contacts.php';


/*

/*
* Load youtube Video
*/

require get_template_directory() . '/inc/widgets/widget-youtube-video.php';


/* Register site widgets */
if (!function_exists('morenews_widgets')) :
    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function morenews_widgets()
    {
        register_widget('MoreNews_author_info');
        register_widget('MoreNews_Posts_Carousel');
        register_widget('MoreNews_Posts_lists');
        register_widget('MoreNews_Youtube_Video');
        register_widget('MoreNews_Express_Posts_List');
        register_widget('MoreNews_Express_Posts_Grid');
        register_widget('MoreNews_Express_Posts_Single_Column');
        register_widget('MoreNews_Express_Posts_Double_Column');
        register_widget('MoreNews_Featured_Post');
        register_widget('MoreNews_Posts_Slider');
        register_widget('MoreNews_Tabbed_Posts');
        register_widget('MoreNews_Trending_Posts');
        register_widget('MoreNews_Trending_Posts_By_Tag');
        register_widget('MoreNews_Trending_Posts_By_View');
        register_widget('MoreNews_Popular_Posts');
        register_widget('MoreNews_Social_Contacts');


    }
endif;
add_action('widgets_init', 'morenews_widgets');