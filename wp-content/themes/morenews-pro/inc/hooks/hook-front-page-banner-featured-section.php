<?php
if (!function_exists('morenews_banner_featured_section')):
    /**
     * Ticker Slider
     *
     * @since MoreNews 1.0.0
     *
     */
    function morenews_banner_featured_section()
    {
        ?>
        <div class="aft-frontpage-feature-section-wrapper">

            <?php $morenews_show_featured_section = morenews_get_option('show_featured_posts_section');
            if ($morenews_show_featured_section): ?>
                <section class="aft-blocks af-main-banner-featured-posts morenews-customizer">
                    <div class="container-wrapper">
                        <?php do_action('morenews_action_banner_featured_posts'); ?>
                    </div>
                </section>
            <?php endif; ?>

            <?php
            $morenews_show_youtube_section = morenews_get_option('show_youtube_video');
            $morenews_show_express_post_section = morenews_get_option('show_express_post_section');
            $morenews_show_post_list_section = morenews_get_option('show_featured_post_list_section');
            $morenews_show_post_grid_section = morenews_get_option('show_post_carousel_section');
            ?>

            <?php if ($morenews_show_youtube_section) {

                $morenews_links = array();

                for ($i = 1; $i <= 5; $i++) {
                    $morenews_youtube_video_url = morenews_get_option('youtube_video_url' . $i);
                    if (!empty($morenews_youtube_video_url)) {
                        $morenews_youtube_url = $morenews_youtube_video_url;
                        parse_str(parse_url($morenews_youtube_url, PHP_URL_QUERY), $my_array_of_vars);
                        $morenews_links[] = 'https://www.youtube.com/embed/' . $my_array_of_vars["v"] . '?rel=0&showinfo=0&autohide=1';

                    }
                }
                if ($morenews_links) {
                    ?>
                    <section class="aft-blocks aft-featured-video-section featured-yt-sec morenews-customizer">
                        <div class="container-wrapper">

                            <?php morenews_get_block('youtube-section', 'featured'); ?>

                        </div>
                    </section>
                <?php }
            } ?>

            <?php if ($morenews_show_express_post_section) { ?>
                <section class="aft-blocks aft-featured-category-section featured-cate-sec morenews-customizer">
                    <div class="container-wrapper">
                        <?php morenews_get_block('express-post', 'featured'); ?>
                    </div>
                </section>
            <?php } ?>
            <?php if ($morenews_show_post_list_section) { ?>
                <section class="aft-blocks aft-featured-category-section af-list-post featured-cate-sec morenews-customizer">
                    <div class="container-wrapper">

                            <?php morenews_get_block('list-posts', 'featured'); ?>

                    </div>
                </section>
            <?php } ?>

            <?php if ($morenews_show_post_grid_section) { ?>
                <section class="aft-blocks aft-featured-category-section featured-cate-sec morenews-customizer">
                    <div class="container-wrapper">
                        <?php morenews_get_block('post-carousel', 'featured'); ?>
                    </div>
                </section>
            <?php } ?>

            <?php
            if (is_active_sidebar('home-below-featured-posts-widgets')): ?>

                <div class="home-featured-widgets">
                    <div class="container-wrapper">
                        <?php dynamic_sidebar('home-below-featured-posts-widgets'); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    <?php }
endif;


add_action('morenews_action_banner_featured_section', 'morenews_banner_featured_section', 10);