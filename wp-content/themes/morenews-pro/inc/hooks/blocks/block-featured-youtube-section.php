<?php
    $morenews_youtube_video_section_title = morenews_get_option('frontpage_youtube_video_section_title');
    $widget_no_title_class = empty($morenews_youtube_video_section_title) ? 'aft-featured-no-title' : '';
    $morenews_links = array();
    
    for ($morenews_i = 1; $morenews_i <= 5; $morenews_i++) {
        $morenews_youtube_video_url = morenews_get_option('youtube_video_url' . $morenews_i);
        if (!empty($morenews_youtube_video_url)) {
            $morenews_links[] = $morenews_youtube_video_url;
            
        }
    }
    if ($morenews_links) {
        ?>
        <div class="af-main-banner-categorized-posts layout-2 morenews-customizer  <?php echo esc_attr($widget_no_title_class)?>">
            <div class="section-wrapper">

                    <?php if (!empty($morenews_youtube_video_section_title)): ?>
                        <?php morenews_render_section_title($morenews_youtube_video_section_title); ?>
                    <?php endif; ?>

                <div class="af-youtube-video-list clearfix af-container-row af-widget-body">
                    <div class="slick-wrapper primary-video aft-yt-video-item-wrapper af-youtube-video-carousel">
                        <?php foreach ($morenews_links as $morenews_link): ?>
                        <div class="slick-item">
                            <?php morenews_single_yt_video($morenews_link, 'hqdefault'); ?>
                        </div>
                       <?php endforeach; ?>
                    </div>
                    <div class="af-widget-featured-video-carousel-navcontrols af-slick-navcontrols"></div>
                </div>
            </div>
        </div>
        <!-- Editors Pick line END -->
    <?php }
?>

