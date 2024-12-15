<?php
if (!class_exists('MoreNews_Tabbed_Posts')) :
    /**
     * Adds MoreNews_Tabbed_Posts widget.
     */
    class MoreNews_Tabbed_Posts extends MoreNews_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array('morenews-tabbed-popular-posts-title', 'morenews-tabbed-latest-posts-title', 'morenews-tabbed-categorised-posts-title', 'morenews-excerpt-length', 'morenews-posts-number');

            $this->select_fields = array('morenews-show-excerpt', 'morenews-select-latest-posts-category', 'morenews-select-popular-posts-category', 'morenews-show-category');

            $widget_ops = array(
                'classname' => 'morenews_tabbed_posts_widget aft-posts-tabs-panel',
                'description' => __('Displays tabbed posts lists from selected settings.', 'morenews'),
                'customize_selective_refresh' => false,

            );

            parent::__construct('morenews_tabbed_posts', __('AFTMN Posts Tabs', 'morenews'), $widget_ops);
        }

        /**
         * Front-end display of widget.
         *
         * @see WP_Widget::widget()
         *
         * @param array $args Widget arguments.
         * @param array $instance Saved values from database.
         */

        public function widget($args, $instance)
        {
            $instance = parent::morenews_sanitize_data($instance, $instance);
            $tab_id = 'tabbed-' . $this->number;

            $number_of_posts = isset($instance['morenews-posts-number']) ? $instance['morenews-posts-number'] : '5';

            $latest_title = isset($instance['morenews-tabbed-latest-posts-title']) ? $instance['morenews-tabbed-latest-posts-title'] : __('AFTMN Latest', 'morenews');
            $latest_category = isset($instance['morenews-select-latest-posts-category']) ? $instance['morenews-select-latest-posts-category'] : '0';

            $popular_title = isset($instance['morenews-tabbed-popular-posts-title']) ? $instance['morenews-tabbed-popular-posts-title'] : __('AFTMN Popular', 'morenews');
                 $popular_category = isset($instance['morenews-select-popular-posts-category']) ? $instance['morenews-select-popular-posts-category'] : '0';


                 $latest_color_class = '';
                 if(absint($latest_category) > 0){
                     $color_id = "category_color_" . $latest_category;
                     // retrieve the existing value(s) for this meta field. This returns an array
                     $term_meta = get_option($color_id);
                     $latest_color_class = ($term_meta) ? $term_meta['color_class_term_meta'] : 'category-color-1';
                 }

                 $popular_color_class = '';
                 if(absint($popular_category) > 0){
                     $color_id = "category_color_" . $popular_category;
                     // retrieve the existing value(s) for this meta field. This returns an array
                     $term_meta = get_option($color_id);
                     $popular_color_class = ($term_meta) ? $term_meta['color_class_term_meta'] : 'category-color-1';
                 }

            // open the widget container
            echo $args['before_widget'];
               morenews_render_tabbed_posts($tab_id, $latest_title, 'cat', $latest_category, $latest_color_class, $popular_title, 'cat', $popular_category, $popular_color_class, $number_of_posts);
            // close the widget container
            echo $args['after_widget'];
        }

        /**
         * Back-end widget form.
         *
         * @see WP_Widget::form()
         *
         * @param array $instance Previously saved values from database.
         */
        public function form($instance)
        {
            $this->form_instance = $instance;
            $enable_categorised_tab = array(
                'true' => __('Yes', 'morenews'),
                'false' => __('No', 'morenews')

            );

            $options = array(
                'true' => __('Yes', 'morenews'),
                'false' => __('No', 'morenews'),

            );


            $categories = morenews_get_terms();

            // generate the text input for the title of the widget. Note that the first parameter matches text_fields array entry
            ?><h4><?php _e('Latest Posts', 'morenews'); ?></h4><?php
            echo parent::morenews_generate_text_input('morenews-tabbed-latest-posts-title', __('Title', 'morenews'), __('Latest', 'morenews'));
            echo parent::morenews_generate_select_options('morenews-select-latest-posts-category', __('Select category', 'morenews'), $categories);

            ?><h4><?php _e('Popular Posts', 'morenews'); ?></h4><?php
            echo parent::morenews_generate_text_input('morenews-tabbed-popular-posts-title', __('Title', 'morenews'), __('Popular', 'morenews'));
            echo parent::morenews_generate_select_options('morenews-select-popular-posts-category', __('Select category', 'morenews'), $categories);

            ?><h4><?php _e('Settings for all tabs', 'morenews'); ?></h4><?php

            echo parent::morenews_generate_text_input('morenews-posts-number', __('Number of posts per tab', 'morenews'), '5');

        }
    }
endif;