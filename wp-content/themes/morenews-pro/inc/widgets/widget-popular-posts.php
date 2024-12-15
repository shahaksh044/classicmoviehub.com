<?php
    
    if (!class_exists('MoreNews_Popular_Posts')) :
        /**
         * Adds MoreNews_Prime_News widget.
         */
        class MoreNews_Popular_Posts extends MoreNews_Widget_Base
        {
            /**
             * Sets up a new widget instance.
             *
             * @since 1.0.0
             */
            function __construct()
            {
                $this->text_fields = array(
                    'morenews-popular-news-title',
                    'morenews-number-of-posts',
                
                );
                $this->select_fields = array(
                    
                    'morenews-news_filter-by',
                    'morenews-select-category',
                
                );
                
                $widget_ops = array(
                    'classname' => 'morenews_popular_news_widget',
                    'description' => __('Displays grid from selected categories.', 'morenews'),
                    'customize_selective_refresh' => false,
                );
                
                parent::__construct('morenews_popular_news', __('AFTMN Popular News', 'morenews'), $widget_ops);
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
                
                $morenews_popular_news_section_title = apply_filters('widget_title', $instance['morenews-popular-news-title'], $instance, $this->id_base);

                $widget_no_title_class = empty($morenews_popular_news_section_title) ? 'aft-widgets-no-title' : '';
    
                $morenews_number_of_posts = !empty($instance['morenews-number-of-posts']) ? $instance['morenews-number-of-posts'] :7;
                $morenews_posts_filter_by = !empty($instance['morenews-news_filter-by']) ? $instance['morenews-news_filter-by'] : 'cat';
                
                
                // open the widget container
                echo $args['before_widget'];?>
                <div class="full-wid-resp pad-v <?php echo esc_attr($widget_no_title_class)?>">
                <?php
                
                if (!empty($morenews_popular_news_section_title)) { ?>
                    <?php morenews_render_section_title($morenews_popular_news_section_title); ?>
                <?php }
                ?>
                <div class="slick-wrapper af-popular-widget-carousel af-post-carousel-list banner-vertical-slider af-widget-carousel af-widget-body">
                        
                        <?php
                            $morenews_featured_posts = morenews_get_posts($morenews_number_of_posts, 0, $morenews_posts_filter_by);
                            if ($morenews_featured_posts->have_posts()) :
                                $morenews_count = 1;
                                while ($morenews_featured_posts->have_posts()) :
                                    $morenews_featured_posts->the_post();
                                    global $post;

                                    
                                    ?>
                                    <div class="slick-item pad">
                                        <?php do_action('morenews_action_loop_list', $post->ID, 'thumbnail', $morenews_count, false, true, false); ?>
                                    </div>
                                <?php
                                    $morenews_count++;
                                endwhile;
                                wp_reset_postdata();
                                ?>
                            <?php endif; ?>
                    
                </div>
                    <div class="af-widget-popular-carousel-navcontrols af-slick-navcontrols"></div>
                </div>
                <?php echo $args['after_widget'];
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
                
                
                
                $popular_news_filterby = array(
                    'comment'=>"Comment",
                    'view'=>"Post View"
                );
                
                $categories = morenews_get_terms();
                
                echo parent::morenews_generate_text_input('morenews-popular-news-title', __('Title', 'morenews'), 'Popular News');
                echo parent::morenews_generate_select_options('morenews-news_filter-by', __('Filter Posts By', 'morenews'), $popular_news_filterby);
                echo parent::morenews_generate_text_input('morenews-number-of-posts', __('Number of posts', 'morenews'), '7','text','Accepts any postive number.');
            }
            
        }
    
    endif;