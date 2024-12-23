<?php
    if (!class_exists('MoreNews_Posts_Carousel')) :
        /**
         * Adds MoreNews_Posts_Carousel widget.
         */
        class MoreNews_Posts_Carousel extends MoreNews_Widget_Base
        {
            /**
             * Sets up a new widget instance.
             *
             * @since 1.0.0
             */
            function __construct()
            {
                $this->text_fields = array('morenews-posts-slider-title', 'morenews-posts-slider-number');
                $this->select_fields = array('morenews-select-category');
                
                $widget_ops = array(
                    'classname' => 'morenews_posts_carousel_widget carousel-layout',
                    'description' => __('Displays posts carousel from selected category.', 'morenews'),
                    'customize_selective_refresh' => false,
                );
                
                parent::__construct('morenews_posts_carousel', __('AFTMN Posts Carousel', 'morenews'), $widget_ops);
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
                /** This filter is documented in wp-includes/default-widgets.php */
    
                $morenews_featured_news_title = apply_filters('widget_title', $instance['morenews-posts-slider-title'], $instance, $this->id_base);

                $widget_no_title_class = empty($morenews_featured_news_title) ? 'aft-widgets-no-title' : '';
                $morenews_no_of_post = !empty($instance['morenews-posts-slider-number']) ? $instance['morenews-posts-slider-number'] :7;
                $morenews_category = !empty($instance['morenews-select-category']) ? $instance['morenews-select-category'] : '0';

                $color_class = '';
                if(absint($morenews_category) > 0){
                    $color_id = "category_color_" . $morenews_category;
                    // retrieve the existing value(s) for this meta field. This returns an array
                    $term_meta = get_option($color_id);
                    $color_class = ($term_meta) ? $term_meta['color_class_term_meta'] : 'category-color-1';
                }
                
                $morenews_featured_posts = morenews_get_posts($morenews_no_of_post, $morenews_category);
                // open the widget container
                echo $args['before_widget'];
                ?>
                <div class="af-main-banner-categorized-posts express-carousel pad-v <?php echo esc_attr($widget_no_title_class)?>">
                <div class="section-wrapper">
                    <?php if (!empty($morenews_featured_news_title)): ?>
                        <?php morenews_render_section_title($morenews_featured_news_title, $color_class); ?>
                    <?php endif; ?>
                    <div class="slick-wrapper af-post-carousel af-widget-post-carousel clearfix af-cat-widget-carousel af-widget-carousel af-widget-body">
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
                    <div class="af-widget-post-carousel-navcontrols af-slick-navcontrols"></div>
                </div>
                </div>
                
                <?php
                //print_pre($all_posts);
                
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
                $categories = morenews_get_terms();
                if (isset($categories) && !empty($categories)) {
                    // generate the text input for the title of the widget. Note that the first parameter matches text_fields array entry
                    echo parent::morenews_generate_text_input('morenews-posts-slider-title', 'Title', 'Posts Carousel');
                    echo parent::morenews_generate_select_options('morenews-select-category', __('Select category', 'morenews'), $categories);
                    echo parent::morenews_generate_text_input('morenews-posts-slider-number', __('Number of posts', 'morenews'), '5');
                    
                    
                }
            }
        }
    endif;