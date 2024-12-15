<?php
    /**
     * List block part for displaying header content in page.php
     *
     * @package MoreNews
     */
    
    
    $morenews_header_layout = morenews_get_option('header_layout');
    if ($morenews_header_layout == 'header-layout-compressed-full') {
        $morenews_header_layout_class = 'full-width';
    } elseif ($morenews_header_layout == 'header-layout-transparent') {
        $morenews_header_layout_class = 'full-width af-transparent-head';
    } else {
        $morenews_header_layout_class = 'af-boxed';
    }
$morenews_show_top_header_section = morenews_get_option('show_top_header_section');
?>
<?php if($morenews_show_top_header_section): ?>
<div class="top-header">
    <div class="container-wrapper">
        <div class="top-bar-flex">
            <div class="top-bar-left col-2">
                <?php if (is_active_sidebar('express-off-canvas-panel')) : ?>
                    <div class="off-cancas-panel">
                        <?php do_action('morenews_load_off_canvas'); ?>
                    </div>
                    <div id="sidr" class="primary-background">
                        <a class="sidr-class-sidr-button-close" href="#sidr-nav"><i class="fa fa-window-close"></i></a>
                        <?php dynamic_sidebar('express-off-canvas-panel'); ?>
                    </div>
                <?php endif; ?>
                <div class="date-bar-left">
                    <?php do_action('morenews_load_date'); ?>
                </div>
            </div>
            <div class="top-bar-right col-2">
                <div class="aft-small-social-menu">
                    <?php do_action('morenews_load_social_menu'); ?>
                </div>
                <div class="aft-hide-on-mobile"><?php do_action('morenews_load_watch_online'); ?></div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<div id="main-navigation-bar" class="bottom-header">
    <div class="af-for-transparent">
        <div class="container-wrapper">
            <div class="bottom-pos-rel">
                <div class="bottom-bar-up">
                    <div class="bottom-bar-flex">
                        <div class="logo">
                            <?php do_action('morenews_load_site_branding'); ?>
                        </div>
                        <div class="bottom-nav">
                            <?php do_action('morenews_action_main_menu_nav'); ?>
                        </div>
                        <div class="aft-hide-on-mobile aft-search-compress"><?php do_action('morenews_load_search_form'); ?></div>
                        <div class="search-watch aft-show-on-mobile">
                            <?php do_action('morenews_load_search_form'); ?>
                            <?php do_action('morenews_load_watch_online'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    $morenews_banner_advertisement = morenews_get_option('banner_advertisement_section');
    if (('' != $morenews_banner_advertisement) || is_active_sidebar('home-advertisement-widgets')) :
        $morenews_header_layout = morenews_get_option('header_layout');
        if ($morenews_header_layout == 'header-layout-compressed-full'): ?>
            <?php
            $morenews_banner_advertisement_scope = morenews_get_option('banner_advertisement_scope');
            if ($morenews_banner_advertisement_scope == 'front-page-only'):
                if (is_home() || is_front_page()):
                    ?>
                    <section class="aft-blocks below-banner-advertisment-section">
                        <?php do_action('morenews_action_banner_advertisement'); ?>
                    </section>
                <?php endif; ?>
            <?php else: ?>
                <section class="aft-blocks below-banner-advertisment-section">
                    <?php do_action('morenews_action_banner_advertisement'); ?>
                </section>
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>
