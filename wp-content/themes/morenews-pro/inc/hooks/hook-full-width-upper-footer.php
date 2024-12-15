<?php

/**
 * Front page section additions.
 */


if (!function_exists('morenews_full_width_upper_footer_section')) :
    /**
     *
     * @since MoreNews 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function morenews_full_width_upper_footer_section()
    {



        ?>

        <section class="aft-blocks above-footer-widget-section">
            <?php

            if (1 == morenews_get_option('frontpage_show_latest_posts')) {
                morenews_get_block('latest');
            }


            $morenews_mailchimp_scope = morenews_get_option('footer_mailchimp_subscriptions_scopes');
            if ($morenews_mailchimp_scope == 'front-page') {
                if (is_front_page() || is_home()) {
                    if (1 == morenews_get_option('footer_show_mailchimp_subscriptions')) {
                        morenews_get_block('mailchimp');
                    }
                }
            } else {
                if (1 == morenews_get_option('footer_show_mailchimp_subscriptions')) {
                    morenews_get_block('mailchimp');
                }
            }


            ?>
        </section>
        <?php

    }
endif;
add_action('morenews_action_full_width_upper_footer_section', 'morenews_full_width_upper_footer_section');
