<?php

/**
 * Adds MoreNews_Youtube_Video widget.
 */
class MoreNews_Youtube_Video extends MoreNews_Widget_Base
{
    /**
     * Sets up a new widget instance.
     *
     * @since 1.0.0
     */
    function __construct()
    {
        $this->text_fields = array('morenews-youtube-video-slider-title');

        $this->url_fields = array('morenews-youtube-video-url-1', 'morenews-youtube-video-url-2', 'morenews-youtube-video-url-3', 'morenews-youtube-video-url-4', 'morenews-youtube-video-url-5');

        $widget_ops = array(
            'classname' => 'morenews_youtube_video_widget',
            'description' => __('Displays youtube video slider.', 'morenews'),
            'customize_selective_refresh' => false,
        );

        parent::__construct('morenews_youtube_video_slider', __('AFTMN YouTube Video', 'morenews'), $widget_ops);
    }

    /**
     * Outputs the content for the current widget instance.
     *
     * @param array $args Display arguments.
     * @param array $instance Saved values from database.
     * @since 1.0.0
     *
     */
    public function widget($args, $instance)
    {
        $instance = parent::morenews_sanitize_data($instance, $instance);
        $title = apply_filters('widget_title', $instance['morenews-youtube-video-slider-title'], $instance, $this->id_base);
        $widget_no_title_class = empty($title) ? 'aft-widgets-no-title' : '';
        echo $args['before_widget'];
        $morenews_links = array();

        for ($morenews_i = 1; $morenews_i <= 5; $morenews_i++) {
            $morenews_youtube_video_url = $instance['morenews-youtube-video-url-' . $morenews_i];
            if (!empty($morenews_youtube_video_url)) {
                $morenews_links[] = $morenews_youtube_video_url;
            }
        }

        if ($morenews_links) {
            ?>
            <div class="af-main-banner-categorized-posts layout-2 pad-v <?php echo esc_attr($widget_no_title_class)?>">
                <div class="section-wrapper">
                    <?php if (!empty($title)): ?>
                        <?php morenews_render_section_title($title); ?>
                    <?php endif; ?>
                    <div class="widget-block widget-wrapper">
                        <div class="slider-pro af-widget-body  clearfix">

                            <?php
                            $mp_video_url_1 = $instance['morenews-youtube-video-url-1'];
                            parse_str(parse_url($mp_video_url_1, PHP_URL_QUERY), $my_array_of_vars_1);
                            if ($mp_video_url_1):
                                ?>
                                <div class="vid-main-wrapper af-youtube-slider col-75 float-l pad clearfix">
                                    <!-- THE YOUTUBE PLAYER -->

                                    <?php for ($i = 1; $i <= 5; $i++) {
                                        ?>

                                        <?php $mp_video_url = $instance['morenews-youtube-video-url-' . $i]; ?>
                                        <?php if (!empty($mp_video_url)) { ?>
                                            <?php
                                            $url = $mp_video_url;
                                            parse_str(parse_url($url, PHP_URL_QUERY), $my_array_of_vars);
                                            $yt_item = $my_array_of_vars['v'];
                                            $max_full_url = morenews_youtube_thumbnail_img($yt_item);
                                            $link = 'https://www.youtube.com/embed/' . $my_array_of_vars["v"] . '?autoplay=1&rel=0&showinfo=0&autohide=1';
                                            ?>
                                            <div class="slick-item">
                                                <div class="vid-container af-video-wrap secondary-video">
                                                    <iframe class="vid_frame widget-yt-iframe af-hide-iframe"
                                                            allowfullscreen></iframe>
                                                    <div class="widget-yt-thumbnail"
                                                         data-video-link="<?php echo esc_attr($link); ?>">
                                                        <img src="<?php echo $max_full_url; ?>"/>
                                                        <span class="af-bg-play">
                                    <i class="fa fa-play" aria-hidden="true"></i>
                                </span>
                                                    </div>

                                                </div>
                                            </div>

                                        <?php } else {
                                            //_e('Video URL not found','morenews' );
                                        } ?>

                                    <?php } ?>
                                </div>
                                <div class="af-widget-youtube-video-navcontrols af-slick-navcontrols"></div>

                                <div class="slick-wrapper af-youtube-slider-thumbnail col-4 float-l pad"
                                     style="list-style-type: none; padding: 0;">
                                    <?php for ($i = 1; $i <= 5; $i++) {
                                        if ($i == 1) {
                                            $first_image_class = 'first_thb_img';
                                        } else {
                                            $first_image_class = '';
                                        }
                                        ?>

                                        <?php $mp_video_url = $instance['morenews-youtube-video-url-' . $i]; ?>
                                        <?php if (!empty($mp_video_url)) { ?>
                                            <?php
                                            $url = $mp_video_url;
                                            parse_str(parse_url($url, PHP_URL_QUERY), $my_array_of_vars);
                                            $yt_item = $my_array_of_vars['v'];
                                            $max_full_url = morenews_youtube_thumbnail_img($yt_item);
                                            $link = 'https://www.youtube.com/embed/' . $my_array_of_vars["v"] . '?autoplay=1&rel=0&showinfo=0&autohide=1';
                                            ?>
                                            <div class="slick-item">
                                                <a class="af-custom-thumbnail <?php echo $first_image_class; ?>"
                                                   href="javascript:void(0)"
                                                   data-item="<?php echo $max_full_url; ?>"
                                                   data-video="<?php echo $link; ?>">
                                                  <span class="vid-thumb">
                                                     <img src="https://img.youtube.com/vi/<?php echo $my_array_of_vars['v']; ?>/mqdefault.jpg"/>
                                                </span>
                                                </a>
                                            </div>

                                        <?php } else {
                                            //_e('Video URL not found','morenews' );
                                        } ?>

                                    <?php } ?>
                                </div>

                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Editors Pick line END -->
        <?php }

        ?>


        <?php
        echo $args['after_widget'];
    }

    /**
     * Back-end widget form.
     *
     * @param array $instance Previously saved values from database.
     *
     *
     * @since 1.0.0
     *
     */
    public function form($instance)
    {
        $this->form_instance = $instance;
        // generate the text input for the title of the widget. Note that the first parameter matches text_fields array entry
        echo parent::morenews_generate_text_input('morenews-youtube-video-slider-title', 'Title', 'YouTube Video');


        ?><h4><?php _e('YouTube Videos:', 'morenews'); ?></h4>
        <?php

        echo parent::morenews_generate_text_input('morenews-youtube-video-url-1', 'Video URL 1', '');
        echo parent::morenews_generate_text_input('morenews-youtube-video-url-2', 'Video URL 2', '');
        echo parent::morenews_generate_text_input('morenews-youtube-video-url-3', 'Video URL 3', '');
        echo parent::morenews_generate_text_input('morenews-youtube-video-url-4', 'Video URL 4', '');
        echo parent::morenews_generate_text_input('morenews-youtube-video-url-5', 'Video URL 5', '');


    }

}