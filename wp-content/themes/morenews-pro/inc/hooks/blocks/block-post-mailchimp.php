<?php
    $morenews_mailchimp_title = esc_html(morenews_get_option('footer_mailchimp_title'));
    $morenews_mailchimp_shortcode = wp_kses_post(morenews_get_option('footer_mailchimp_shortcode'));
    
    if (!empty($morenews_mailchimp_shortcode)) {
        ?>
        <div class="mailchimp-block">
            <div class="container-wrapper">
                <h3 class="block-title text-center">
                    <?php echo esc_html($morenews_mailchimp_title); ?>
                </h3>
            </div>
            <div class="container-wrapper">
                <div class="inner-suscribe">
                    <?php echo do_shortcode($morenews_mailchimp_shortcode); ?>
                </div>
            </div>
        </div>
        <?php
    }