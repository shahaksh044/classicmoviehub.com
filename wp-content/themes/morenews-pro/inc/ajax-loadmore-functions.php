<?php

if ( ! function_exists( 'morenews_ajax_pagination' ) ) :
	/**
	 * Outputs the required structure for ajax loading posts on scroll and click
	 *
	 * @since 1.0.0
	 * @param $type string Ajax Load Type
	 */
	function morenews_ajax_pagination($type) {
		if ( $GLOBALS['wp_query']->max_num_pages > 1 ) {
			?>
			<div class="morenews-load-more-posts aft-readmore-wrapper" data-load-type="<?php echo esc_attr($type); ?>">
				<a href="#" class="aft-readmore">
                    <span class="ajax-loader">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
					<span class="load-btn"><?php esc_html_e('Load More', 'morenews') ?></span>
				</a>
			</div>
			<?php
		}
	}
endif;

if ( ! function_exists( 'morenews_load_more' ) ) :
	/**
	 * Ajax Load posts Callback.
	 *
	 * @since 1.0.0
	 *
	 */
	function morenews_load_more() {

		//echo "herere";die();

		check_ajax_referer( 'morenews-load-more-nonce', 'nonce' );

		$morenews_output['more_post'] = false;
		$morenews_output['content'] = array();
        $morenews_cat_slug = '';
        if(isset($_GET['post_type'])&& !empty($_GET['post_type'] )){
            $morenews_args['post_type'] = sanitize_text_field(wp_unslash($_GET['post_type']));
        }else{
            $morenews_args['post_type'] = 'post';
        }
		$morenews_args['post_status'] = 'publish';
        if(isset($_GET['page'])){
            $morenews_args['paged'] = sanitize_text_field(wp_unslash( $_GET['page'] ));
    
        }
		
		if( isset( $_GET['cat'] ) && isset( $_GET['taxonomy'] ) ){
			$morenews_args['tax_query'] = array(
				array(
					'taxonomy' => sanitize_text_field(wp_unslash($_GET['taxonomy'])),
					'field'    => 'slug',
					'terms'    => array(sanitize_text_field(wp_unslash($_GET['cat']))),
				),
			);
			$morenews_cat_slug = sanitize_text_field(wp_unslash($_GET['cat']));
		}

		if( isset($_GET['search']) ){
			$morenews_args['s'] = sanitize_text_field(wp_unslash( $_GET['search'] ));
		}

		if( isset($_GET['author']) ){
			$morenews_args['author_name'] = sanitize_text_field(wp_unslash( $_GET['author'] ));
		}

		if( isset($_GET['year']) || isset($_GET['month']) || isset($_GET['day']) ){

			$morenews_date_arr = [];

			if( !empty($_GET['year']) ){
				$morenews_date_arr['year'] = sanitize_text_field(wp_unslash($_GET['year']));
			}
			if( !empty($_GET['month']) ){
				$morenews_date_arr['month'] = sanitize_text_field(wp_unslash($_GET['month']));
			}
			if( !empty($_GET['day']) ){
				$morenews_date_arr['day'] = sanitize_text_field(wp_unslash($_GET['day']));
			}

			if( !empty($morenews_date_arr) ){
				$morenews_args['date_query'] = array($morenews_date_arr);
			}
		}

		$morenews_loop = new WP_Query( $morenews_args );
		if($morenews_loop->max_num_pages > $morenews_args['paged']){
			$morenews_output['more_post'] = true;
		}
		if ( $morenews_loop->have_posts() ):
			$template_part = isset($morenews_args['s']) ? 'search' : get_post_type();

			$counter = 1;
			while ( $morenews_loop->have_posts() ): $morenews_loop->the_post();
				ob_start();

					//get_template_part( 'template-parts/content', $template_part );

                do_action('morenews_action_archive_layout', $morenews_cat_slug);
				$morenews_output['content'][] = ob_get_clean();
				$counter++;
			endwhile;wp_reset_postdata();
			wp_send_json_success($morenews_output);
		else:
			$morenews_output['more_post'] = false;
			wp_send_json_error($morenews_output);
		endif;
		wp_die();
	}
endif;
add_action( 'wp_ajax_morenews_load_more', 'morenews_load_more' );
add_action( 'wp_ajax_nopriv_morenews_load_more', 'morenews_load_more' );