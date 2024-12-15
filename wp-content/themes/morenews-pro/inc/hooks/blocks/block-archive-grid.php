<?php
    /**
     * List block part for displaying page content in page.php
     *
     * @package MoreNews
     */


$morenews_thumbnail_size = 'medium';
$morenews_grid_design ='grid-design-default';

$morenews_term_meta_grid = '';
if(is_category()){
    $morenews_queried_object = get_queried_object();
    $morenews_t_id = $morenews_queried_object->term_id;
    $morenews_term_meta_grid = get_option("category_layout_grid_$morenews_t_id");
}

if (!empty($morenews_term_meta_grid)) {
    $morenews_archive_image = $morenews_term_meta_grid['archive_layout_alignment_term_meta_gird'];
} else {
    $morenews_archive_image = morenews_get_option('archive_image_alignment_grid');
}

if($morenews_archive_image  == 'archive-image-tile'){
    $morenews_grid_design ='grid-design-texts-over-image';
}



$morenews_content_view = morenews_get_option('archive_content_view');
$morenews_show_excerpt = true;
if($morenews_content_view == 'archive-content-none'){
    $morenews_show_excerpt = false;
}
?>

<div class="archive-grid-post">
    <?php do_action('morenews_action_loop_grid', $post->ID, $morenews_grid_design, $morenews_thumbnail_size, $morenews_show_excerpt, $morenews_content_view); ?>

    <?php
        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'morenews'),
            'after' => '</div>',
        ));
    ?>
</div>








