<?php
if (!function_exists('morenews_archive_layout_selection')) :
    /**
     *
     * @param null
     *
     * @return null
     *
     * @since MoreNews 1.0.0
     *
     */
    function morenews_archive_layout_selection($morenews_archive_layout = 'default')
    {

        switch ($morenews_archive_layout) {

            case "archive-layout-list":
                morenews_get_block('list', 'archive');
                break;
            case "archive-layout-full":
                morenews_get_block('full', 'archive');
                break;
            case "archive-layout-masonry":
                morenews_get_block('masonry', 'archive');
                break;
            default:
                morenews_get_block('grid', 'archive');
        }
    }
endif;

if (!function_exists('morenews_archive_layout')) :
    /**
     *
     * @param null
     *
     * @return null
     *
     * @since MoreNews 1.0.0
     *
     */
    function morenews_archive_layout($cat_slug = '')
    {

        $morenews_archive_args = morenews_archive_layout_class($cat_slug);
        if (!empty($morenews_archive_args['data_mh'])): ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class($morenews_archive_args['add_archive_class']); ?>
                 data-mh="<?php echo esc_attr($morenews_archive_args['data_mh']); ?>">
            <?php morenews_archive_layout_selection($morenews_archive_args['archive_layout']); ?>
        </article>
    <?php else: ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class($morenews_archive_args['add_archive_class']); ?> >
            <?php morenews_archive_layout_selection($morenews_archive_args['archive_layout']); ?>
        </article>
    <?php endif; ?>

        <?php

    }

    add_action('morenews_action_archive_layout', 'morenews_archive_layout', 10, 1);
endif;

function morenews_archive_layout_class($morenews_cat_slug)
{


    if (is_category() || !empty($morenews_cat_slug)) {

        $morenews_term_meta = '';
        $morenews_term_meta_list = '';
        $morenews_term_meta_grid = '';
        if (!empty($morenews_cat_slug)) {
            $morenews_ajax_term = get_term_by('slug', $morenews_cat_slug, 'category');
            $morenews_t_id = $morenews_ajax_term->term_id;
        } else {
            $morenews_queried_object = get_queried_object();
            $morenews_t_id = $morenews_queried_object->term_id;

        }

        $morenews_term_meta = get_option("category_layout_$morenews_t_id");
        $morenews_term_meta_list = get_option("category_layout_list_$morenews_t_id");
        $morenews_term_meta_grid = get_option("category_layout_grid_$morenews_t_id");

        $morenews_archive_args = [];

        if (!empty($morenews_term_meta)) {
            $morenews_archive_class = $morenews_term_meta['archive_layout_term_meta'];
        } else {
            $morenews_archive_class = morenews_get_option('archive_layout');
        }

        if (!empty($morenews_term_meta_list)) {
            $morenews_archive_layout_list = $morenews_term_meta_list['archive_layout_alignment_term_meta_list'];

        } else {

            $morenews_archive_layout_list = morenews_get_option('archive_image_alignment');

        }

        if (!empty($morenews_term_meta_grid)) {
            $morenews_archive_layout_grid = $morenews_term_meta_grid['archive_layout_alignment_term_meta_gird'];
        } else {
            $morenews_archive_layout_grid = morenews_get_option('archive_image_alignment_grid');
        }

    } else {


        $morenews_archive_class = morenews_get_option('archive_layout');
        $morenews_archive_layout_list = morenews_get_option('archive_image_alignment');
        $morenews_archive_layout_grid = morenews_get_option('archive_image_alignment_grid');

    }

    if ($morenews_archive_class == 'archive-layout-grid') {
        $morenews_archive_args['archive_layout'] = 'archive-layout-grid';
        $morenews_archive_args['add_archive_class'] = 'af-sec-post latest-posts-grid col-3 float-l pad ';
        //$morenews_archive_layout_mode = morenews_get_option('archive_image_alignment_grid');
        $morenews_archive_layout_mode = $morenews_archive_layout_grid;
        if ($morenews_archive_layout_mode == 'archive-image-full-alternate' || $morenews_archive_layout_mode == 'archive-image-list-alternate') {
            $morenews_archive_args['data_mh'] = '';
        } else {
            $morenews_archive_args['data_mh'] = 'archive-layout-grid';
        }
        $morenews_image_align_class = $morenews_archive_layout_grid;
        $morenews_archive_args['add_archive_class'] .= ' ' . $morenews_archive_class . ' ' . $morenews_image_align_class;

    } elseif ($morenews_archive_class == 'archive-layout-masonry') {
        $morenews_archive_args['archive_layout'] = 'archive-layout-masonry';
        $morenews_archive_args['add_archive_class'] = 'af-sec-post latest-posts-masonry col-2 float-l pad';
        $morenews_archive_args['data_mh'] = '';
    } elseif ($morenews_archive_class == 'archive-layout-list') {
        $morenews_archive_args['archive_layout'] = 'archive-layout-list';
        $morenews_archive_args['add_archive_class'] = 'latest-posts-list col-1 float-l pad';
        $morenews_archive_args['data_mh'] = '';
        $morenews_image_align_class = $morenews_archive_layout_list;
        $morenews_archive_args['add_archive_class'] .= ' ' . $morenews_archive_class . ' ' . $morenews_image_align_class;
    } else {
        $morenews_archive_args['archive_layout'] = 'archive-layout-full';
        $morenews_archive_args['add_archive_class'] = 'af-sec-post latest-posts-full col-1 float-l pad';
        $morenews_archive_args['data_mh'] = '';
    }

    return $morenews_archive_args;

}


//Archive div wrap before loop

if (!function_exists('morenews_archive_layout_before_loop')) :

    /**
     *
     * @param null
     *
     * @return null
     *
     * @since MoreNews 1.0.0
     *
     */

    function morenews_archive_layout_before_loop()
    {

        if (is_category()) {

            //check is category
            $morenews_archive_class = '';
            $morenews_archive_mode = morenews_get_option('archive_layout');
            $morenews_queried_object = get_queried_object();
            $morenews_t_id = $morenews_queried_object->term_id;
            $morenews_term_meta = get_option("category_layout_".$morenews_t_id);
            $morenews_term_meta_masonry = get_option("category_layout_masonry_".$morenews_t_id);
            $morenews_term_meta_full = get_option("category_layout_full_".$morenews_t_id);
            $morenews_term_meta_grid_column = get_option("category_layout_grid_column_".$morenews_t_id);

            if (!empty($morenews_term_meta)) {
                $morenews_term_meta = $morenews_term_meta['archive_layout_term_meta'];
                // grid  column layout
                if ($morenews_term_meta == 'archive-layout-grid') {

                    if ($morenews_term_meta_grid_column['archive_layout_grid'] == 'grid-layout-two') {
                        $morenews_col_grid = 'two-col-masonry';

                    } else if ($morenews_term_meta_grid_column['archive_layout_grid'] == 'grid-layout-four') {
                        $morenews_col_grid = 'four-col-masonry';

                    } else {
                        $morenews_col_grid = 'three-col-masonry';

                    }

                    $morenews_archive_class .= 'archive-layout-grid'  . " " . $morenews_col_grid;
                } //masonry column layout
                else if ($morenews_term_meta == 'archive-layout-masonry') {

                    if ($morenews_term_meta_masonry['archive_layout_masonry'] == 'masonry-layout-two') {
                        $morenews_col_masonry = 'two-col-masonry';
                    } else if ($morenews_term_meta_masonry['archive_layout_masonry'] == 'masonry-layout-four') {
                        $morenews_col_masonry = 'four-col-masonry';
                    } else {
                        $morenews_col_masonry = 'three-col-masonry';
                    }
                    $morenews_archive_class = 'aft-masonry-archive-posts' . " " . $morenews_col_masonry;
                } //full layout option
                else if ($morenews_term_meta == 'archive-layout-full') {
                    if ($morenews_term_meta_full['archive_layout_full'] == 'full-image-first') {
                        $morenews_archive_class = 'archive-layout-full' . " " . 'archive-image-first';
                    } else if ($morenews_term_meta_full['archive_layout_full'] == 'full-title-first') {
                        $morenews_archive_class = 'archive-layout-full' . " " . 'archive-title-first';
                    } else if ($morenews_term_meta_full['archive_layout_full'] == 'archive-full-grid') {
                        $morenews_archive_class = 'archive-layout-full' . " " . "full-with-grid";
                    } else {
                        $morenews_archive_class = 'archive-layout-full' . " " . 'archive-title-first';
                    }
                } else {
                    $morenews_archive_class = $morenews_term_meta;
                }

            } else {
                //grid layout option
                if ($morenews_archive_mode == 'archive-layout-grid') {
                    $morenews_archive_layout_grid = morenews_get_option('archive_grid_column_layout');
                    if ($morenews_archive_layout_grid == 'grid-layout-two') {
                        $morenews_col_grid = $morenews_archive_mode . " " . 'two-col-masonry';
                    } else if ($morenews_archive_layout_grid == 'grid-layout-four') {
                        $morenews_col_grid = $morenews_archive_mode . " " . 'four-col-masonry';
                    } else {
                        $morenews_col_grid = $morenews_archive_mode . " " . 'three-col-masonry';
                    }
                    $morenews_archive_class = $morenews_col_grid;
                } //masonry layout option
                else if ($morenews_archive_mode == 'archive-layout-masonry') {
                    $morenews_archive_layout_masonary = morenews_get_option('archive_layout_masonry');
                    if ($morenews_archive_layout_masonary == 'masonry-layout-two') {
                        $morenews_col_masonry = 'two-col-masonry';
                    } else if ($morenews_archive_layout_masonary == 'masonry-layout-four') {
                        $morenews_col_masonry = 'four-col-masonry';
                    } else {
                        $morenews_col_masonry = 'three-col-masonry';
                    }
                    $morenews_archive_class = 'aft-masonry-archive-posts' . " " . $morenews_col_masonry;
                } //full layout option
                elseif ($morenews_archive_mode == 'archive-layout-full') {
                    $morenews_archive_layout_full = morenews_get_option('archive_layout_full');
                    if ($morenews_archive_layout_full == 'full-image-first') {
                        $morenews_archive_class = $morenews_archive_mode . " " . 'archive-image-first';
                    } else if ($morenews_archive_layout_full == 'full-title-first') {
                        $morenews_archive_class = $morenews_archive_mode . " " . 'archive-title-first';
                    } else if ($morenews_archive_layout_full == 'archive-full-grid') {
                        $morenews_archive_class = $morenews_archive_mode . " " . "full-with-grid";
                    } else {
                        $morenews_archive_class = $morenews_archive_mode . " " . 'archive-title-first';
                    }
                } else {
                    $morenews_archive_class = $morenews_archive_mode;
                }
            }
        } else {
            //grid layout option
            $morenews_archive_mode = morenews_get_option('archive_layout');
            if ($morenews_archive_mode == 'archive-layout-grid') {
                $morenews_archive_layout_grid = morenews_get_option('archive_grid_column_layout');
                if ($morenews_archive_layout_grid == 'grid-layout-two') {
                    $morenews_col_grid = $morenews_archive_mode . " " . 'two-col-masonry';
                } else if ($morenews_archive_layout_grid == 'grid-layout-four') {
                    $morenews_col_grid = $morenews_archive_mode . " " . 'four-col-masonry';
                } else {
                    $morenews_col_grid = $morenews_archive_mode . " " . 'three-col-masonry';
                }
                $morenews_archive_class = $morenews_col_grid;
            } //masonry layout option
            else if ($morenews_archive_mode == 'archive-layout-masonry') {
                $morenews_archive_layout_masonary = morenews_get_option('archive_layout_masonry');
                if ($morenews_archive_layout_masonary == 'masonry-layout-two') {
                    $morenews_col_masonry = 'two-col-masonry';
                } else if ($morenews_archive_layout_masonary == 'masonry-layout-four') {
                    $morenews_col_masonry = 'four-col-masonry';
                } else {
                    $morenews_col_masonry = 'three-col-masonry';
                }
                $morenews_archive_class = 'aft-masonry-archive-posts' . " " . $morenews_col_masonry;
            } //full layout option
            else if ($morenews_archive_mode == 'archive-layout-full') {
                $morenews_archive_layout_full = morenews_get_option('archive_layout_full');
                if ($morenews_archive_layout_full == 'full-image-first') {
                    $morenews_archive_class = $morenews_archive_mode . " " . 'full-image-first';
                } else if ($morenews_archive_layout_full == 'full-title-first') {
                    $morenews_archive_class = $morenews_archive_mode . " " . 'archive-title-first';
                } else if ($morenews_archive_layout_full == 'archive-full-grid') {
                    $morenews_archive_class = $morenews_archive_mode . " " . "full-with-grid";
                } else {
                    $morenews_archive_class = $morenews_archive_mode;
                }
            } else {

                $morenews_archive_class = $morenews_archive_mode;
            }
        }
        ?>
        <div class="af-container-row aft-archive-wrapper morenews-customizer clearfix <?php echo esc_attr($morenews_archive_class); ?>">
        <?php

    }

    add_action('morenews_archive_layout_before_loop', 'morenews_archive_layout_before_loop');
endif;

if (!function_exists('morenews_archive_layout_after_loop')):

    function morenews_archive_layout_after_loop()
    {
        ?>
        </div>
    <?php }

    add_action('morenews_archive_layout_after_loop', 'morenews_archive_layout_after_loop');

endif;


add_action('morenews_action_single_yt_video', 'morenews_single_yt_video', 40);

function morenews_single_yt_video($yt_url = '', $thumb_size = 'hqdefault')
{
   if(empty($yt_url)){
        return;
    }

    parse_str(parse_url($yt_url, PHP_URL_QUERY), $my_array_of_vars);
    $yt_item = $my_array_of_vars['v'];
    $link = 'https://www.youtube.com/embed/' . $my_array_of_vars["v"] . '?autoplay=1&rel=0&showinfo=0&autohide=1';
    $yt_video_thumbs = morenews_youtube_thumbnail_img($yt_item, $thumb_size);

    if (!empty($yt_video_thumbs)):
        ?>


        <div class="slider-pro entry-header-yt-video-container pad-youtube" >
            <iframe class="vid_frame entry-header-yt-iframe af-hide-item" allowfullscreen></iframe>
            <div class="entry-header-yt-video-wrapper entry-header-yt-thumbnail af-custom-thumbnail-play" data-video-link="<?php echo esc_attr($link); ?>">
                <span class="af-yt-video-play">
                    <i class="fas fa-play" aria-hidden="true"></i>
                </span>
                <span class="vid-thumb">
                    <img class="morenews-yt-thumb" src="<?php echo esc_url($yt_video_thumbs); ?>"/>
                </span>
            </div>
        </div>

    <?php
    endif;

}

if(!function_exists('morenews_youtube_thumbnail_img')):

    function morenews_youtube_thumbnail_img($item, $thumbsize = ''){


        //If maxres image exists do something with it.

        if(!empty($thumbsize)){
            $thumb_url = "https://img.youtube.com/vi/" . $item . "/".$thumbsize.".jpg";
            return  $thumb_url;
        }else{

            $MaxResURL = 'https://i1.ytimg.com/vi/'.$item.'/maxresdefault.jpg';

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $MaxResURL,
                CURLOPT_HEADER => true,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_NOBODY => true));

            $header = explode("\n", curl_exec($curl));
            curl_close($curl);

            if (strpos($header[0], '200') !== false) {
                $thumb_url = "https://img.youtube.com/vi/" . $item . "/maxresdefault.jpg";
                return  $thumb_url;
            }else{
                $thumb_url = "https://img.youtube.com/vi/" . $item . "/sddefault.jpg";
                return  $thumb_url;
            }
        }

    }
endif;

