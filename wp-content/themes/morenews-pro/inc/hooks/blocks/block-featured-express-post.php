<?php
    $morenews_show_excerpt = 'archive-content-excerpt';
    $morenews_category = morenews_get_option('select_express_post_category_1');
    $morenews_express_section_title = morenews_get_option('frontpage_express_post_section_title_1');
    $morenews_featured_express_posts_one = morenews_get_posts(5, $morenews_category);

$color_class = '';
if(absint($morenews_category) > 0){
    $color_id = "category_color_" . $morenews_category;
    // retrieve the existing value(s) for this meta field. This returns an array
    $term_meta = get_option($color_id);
    $color_class = ($term_meta) ? $term_meta['color_class_term_meta'] : 'category-color-1';
}
?>

<div class="af-main-banner-categorized-posts express-posts layout-1 morenews-customizer">
    <div class="section-wrapper af-container-row clearfix">
        <div class="col-66 pad float-l small-grid-style clearfix">
            <?php
                if ($morenews_featured_express_posts_one->have_posts()) :
                    ?>

                        <?php if (!empty($morenews_express_section_title)): ?>
                            <?php morenews_render_section_title($morenews_express_section_title, $color_class); ?>
                        <?php endif; ?>

                    <div class="featured-post-items-wrap clearfix af-container-row af-widget-body">
                        <?php
                            $morenews_count = 1;
                            while ($morenews_featured_express_posts_one->have_posts()) :
                                $morenews_featured_express_posts_one->the_post();
                                global $post;
                                $morenews_img_thumb_id = get_post_thumbnail_id($post->ID);
                                $morenews_first_section_class = '';
                                if ($morenews_count == 1):

                                    ?>
                                    <div class="col-2 pad float-l af-sec-post">
                                        <?php do_action('morenews_action_loop_grid', $post->ID, 'grid-design-default', 'morenews-medium', true); ?>
                                    </div>
                                <?php else:

                                    
                                    ?>
                                    <div class="col-2 pad float-l list-part af-sec-post">
                                        <?php do_action('morenews_action_loop_list', $post->ID, 'thumbnail', 0, false, true, false); ?>
                                    </div>
                                <?php endif; ?>
                                <?php
                                $morenews_count++;
                            endwhile;
                            wp_reset_postdata();
                        ?>
                    </div>
                <?php endif;
            ?>
        </div>
        <div class="col-3 pad float-l small-grid-style clearfix">
            <?php
                $morenews_category_two = morenews_get_option('select_express_post_category_2');
                $morenews_express_section_name_two = morenews_get_option('frontpage_express_post_section_title_2');
                $morenews_featured_express_posts_two = morenews_get_posts(4, $morenews_category_two);

            $color_class = '';
            if(absint($morenews_category_two) > 0){
                $color_id = "category_color_" . $morenews_category_two;
                // retrieve the existing value(s) for this meta field. This returns an array
                $term_meta = get_option($color_id);
                $color_class = ($term_meta) ? $term_meta['color_class_term_meta'] : 'category-color-1';
            }
            ?>

            <div class="af-main-banner-categorized-posts layout-1">
                <div class="section-wrapper">
                    <div class="small-grid-style clearfix">
                        <?php
                            if ($morenews_featured_express_posts_two->have_posts()) :?>

                                    <?php if (!empty($morenews_express_section_name_two)): ?>
                                        <?php morenews_render_section_title($morenews_express_section_name_two, $color_class); ?>
                                    <?php endif; ?>

                                <div class="af-widget-body">
                                    <?php
                                        $morenews_count = 1;
                                        while ($morenews_featured_express_posts_two->have_posts()) :
                                            $morenews_featured_express_posts_two->the_post();
                                            global $post;

                                            ?>
                                            <div class="list-part af-sec-post">
                                                <?php do_action('morenews_action_loop_list', $post->ID, 'thumbnail', 0, false, true, false); ?>
                                            </div>
                                            
                                            <?php
                                            $morenews_count++;
                                        endwhile;
                                        wp_reset_postdata();
                                    ?>
                                </div>
                            <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Editors Pick line END -->
