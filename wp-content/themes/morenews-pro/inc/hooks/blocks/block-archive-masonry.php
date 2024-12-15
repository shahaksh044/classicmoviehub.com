<?php
    /**
     * List block part for displaying page content in page.php
     *
     * @package MoreNews
     */

$morenews_grid_design = 'grid-design-default';
$morenews_thumbnail_size = 'morenews-featured';
$morenews_content_view = morenews_get_option('archive_content_view');
$morenews_show_excerpt = true;
if ($morenews_content_view == 'archive-content-none') {
    $morenews_show_excerpt = false;
}
?>

<div class="archive-masonry-post">
    <?php do_action('morenews_action_loop_grid', $post->ID, $morenews_grid_design, $morenews_thumbnail_size, $morenews_show_excerpt, $morenews_content_view); ?>
    <?php
        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'morenews'),
            'after' => '</div>',
        ));
    ?>
</div>







