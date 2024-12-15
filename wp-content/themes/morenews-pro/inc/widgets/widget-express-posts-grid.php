<?php
if (!class_exists('MoreNews_Express_Posts_Grid')) :
    /**
     * Adds MoreNews_Express_Posts_Grid widget.
     */
    class MoreNews_Express_Posts_Grid extends MoreNews_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array(
                'morenews-express-posts-section-title',
                'morenews-number-of-posts',
            );
            $this->select_fields = array(
                'morenews-select-category',
            );

            $widget_ops = array(
                'classname' => 'morenews_express_posts_grid_widget',
                'description' => __('Displays Express Posts from selected categories.', 'morenews'),
                'customize_selective_refresh' => false,
            );

            parent::__construct('morenews_express_posts_grid', __('AFTMN Express Posts Grid', 'morenews'), $widget_ops);
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
    
            $morenews_express_section_title = apply_filters('widget_title', $instance['morenews-express-posts-section-title'], $instance, $this->id_base);

    
            $morenews_no_of_post = !empty($instance['morenews-number-of-posts']) ? $instance['morenews-number-of-posts'] :3;

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
            <div class="af-main-banner-categorized-posts express-grid pad-v">
                <div class="section-wrapper">
                    <?php if (!empty($morenews_express_section_title)): ?>
                        <?php morenews_render_section_title($morenews_express_section_title, $color_class); ?>
                    <?php endif; ?>
                    <div class="af-widget-body">
                    <div class="af-express-grid-wrap">
                        <?php
                        if ($morenews_featured_posts->have_posts()) :
                            $morenews_count = 1;
                            while ($morenews_featured_posts->have_posts()) :
                                $morenews_featured_posts->the_post();
                                global $post;

                                if($morenews_count == 1){
                                    $morenews_thumbnail_size = 'morenews-medium';
                                }else{
                                    $morenews_thumbnail_size = 'medium';
                                }

                                ?>
                                <?php do_action('morenews_action_loop_grid', $post->ID, 'grid-design-texts-over-image', $morenews_thumbnail_size); ?>

                                <?php
                                $morenews_count++;
                            endwhile;
                            wp_reset_postdata();
                            ?>
                        <?php endif; ?>
                    </div>
                    </div>
                </div>
            </div>
            <?php
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


            //print_pre($terms);
            $categories = morenews_get_terms();
            


            if (isset($categories) && !empty($categories)) {
                // generate the text input for the title of the widget. Note that the first parameter matches text_fields array entry
                echo parent::morenews_generate_text_input('morenews-express-posts-section-title', __('Title', 'morenews'), 'Express Posts Grid');
                echo parent::morenews_generate_select_options('morenews-select-category', __('Select', 'morenews'), $categories);
                echo parent::morenews_generate_text_input('morenews-number-of-posts', __('Number of posts', 'morenews'), '3');

            }

            //print_pre($terms);


        }

    }
endif;