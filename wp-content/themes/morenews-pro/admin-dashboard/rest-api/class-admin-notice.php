<?php
class AdminNotice
{

  private $dismiss_notice_key = 'aft_notice_dismissed';

  private $theme_name;
  private $theme_slug;
  private $page_slug;
  private $screenshot;

  public function __construct()
  {

    $theme = wp_get_theme();
    if (! is_child_theme()) {
      $this->screenshot =  get_template_directory_uri() . "/screenshot.png";
    } else {
      $this->screenshot =  get_stylesheet_directory_uri() . "/screenshot.png";
    }

    $this->theme_name = $theme->get('Name');
    $this->theme_slug    = $theme->get_template();
    $this->page_slug     = $this->theme_slug;

    if (get_option($this->dismiss_notice_key) !== 'yes') {
      add_action('admin_notices', [$this, 'morenews_admin_notice'], 0);
      add_action('wp_ajax_aft_notice_dismiss', [$this, 'morenews_notice_dismiss']);
    }
  }

  function morenews_admin_notice()
  {
    $current_screen = get_current_screen();

    if ($current_screen->id != 'tools' && $current_screen->id != 'plugins' && $current_screen->id != 'options-general' && $current_screen->id !== 'dashboard' && $current_screen->id !== 'themes' && $current_screen->id !== 'appearance_page_af-dashbaord-details') {

      return;
    }



    if (defined('DOING_AJAX') && DOING_AJAX) {
      return;
    }

    if (is_network_admin()) {
      return;
    }

    if (! current_user_can('manage_options')) {
      return;
    }

    global $current_user;
    $user_id          = $current_user->ID;
    $dismissed_notice = get_user_meta($user_id, $this->dismiss_notice_key, true);


    if ($dismissed_notice === 'dismissed') {
      update_option($this->dismiss_notice_key, 'yes');
    }

    if (get_option($this->dismiss_notice_key, 'no') === 'yes') {
      return;
    }
    echo '<div class="aft-notice-content-wrapper updated notice">';
    echo '<button type="button" class="notice-dismiss aft-dismiss-notice"><span class="screen-reader-text">Dismiss this notice.</span></button>';
    $this->morenews_dashboard_notice_content();
    echo '</div>';
  }

  function morenews_dashboard_notice_content()
  {

    $plugins = apply_filters('aft_plugins_for_starter_sites', array("templatespare"));

    $morenews_templatespare_subtitle = '';
    $activate_plugins = [];
    $install_plugin = [];

    if (!empty($plugins)) {
      foreach ($plugins as $key => $plugin) {

        $main_plugin_file = morenews_get_plugin_file($plugin); // Get main plugin file
        if (!empty($main_plugin_file)) {

          if (!is_plugin_active($main_plugin_file)) {

            $btn_class = 'aft-bulk-active-plugin-installer';
            $morenews_templatespare_url = '#';
            $activate_plugins[] = $plugin;
          }
        } else {
          $install_plugin[$key] = $plugin;
          $btn_class = 'aft-bulk-plugin-installer';
          $morenews_templatespare_url = "#";
        }
      }
    }

    if (empty($activate_plugins) && empty($install_plugin)) {
      $btn_class = '';
      $morenews_templatespare_url = site_url() . '/wp-admin/admin.php?page=' . $this->page_slug;
      //$morenews_templatespare_subtitle = __( 'The "Get Started" action will install/activate the AF Companion and Blockspare plugins for Starter Sites and Templates.', 'morenews' );
      $morenews_templatespare_title = __('Get Starter Sites', 'morenews');
    } else {
      $btn_class = 'aft-bulk-active-plugin-installer';
      $morenews_templatespare_url = '#';
      $morenews_templatespare_title = __('Get Started', 'morenews');
      $morenews_templatespare_subtitle = __('The "Get Started" action will install/activate the Templatespare  plugin for Starter Sites and Templates.', 'morenews');
    }



    $main_template = '<div class="aft-notice-wrapper">
        %1$s
        
        <div class="aft-notice-msg-wrapper">%2$s %3$s %4$s  </div>
        
        </div>';

    $notice_header = sprintf(
      '<h2>%1$s</h2><p class="about-description">%2$s</p></hr>',
      esc_html__('Howdy!', 'morenews'),
      sprintf(
        esc_html__('%s is now installed and ready to use. We\'ve assembled some links to get you started.', 'morenews'),
        $this->theme_name
      )
    );

    $notice_picture    = sprintf(
      '<div class="aft-notice-col-1"><figure>
					<img src="%1$s"/>
				</figure></div>',
      esc_url($this->screenshot)
    );

    $demo_link = "https://afthemes.com/products/morenews-pro/";


    $notice_starter_msg = sprintf(
      '<div class="aft-notice-col-2">
				<div class="aft-general-info">
					<h3><span class="dashicons dashicons-images-alt2">
					</span>%1$s</h3>
					<p>%2$s</p>
					<p>%10$s</p>
				</div>
				<div class="aft-general-info-link %9$s ">
					<div>
					<a href="%3$s"  data-install=' . json_encode($install_plugin) . ' data-activate=' . json_encode($activate_plugins) . ' data-page=' . $this->page_slug . ' class="button button-primary">%4$s</a>
					<a href="%7$s"  class="button-secondary">%8$s</a>
						
					</div>
					<div>
						<a href="%5$s" target="_blank"><span aria-hidden="true" class="dashicons dashicons-external"></span>%6$s</a>
					</div>
				</div>
				</div>',
      __('Explore Our Pre-Built Starter Websites!', 'morenews'),
      esc_html__('Let your imagination soar! Designed with User-Friendly features, incorporating the Latest Trends and SEO-Friendly Markups. We genuinely appreciate you choosing our theme!', 'morenews'),
      $morenews_templatespare_url,
      $morenews_templatespare_title,
      esc_url($demo_link),
      esc_html__('Demos/product', 'morenews'),
      esc_url(admin_url() . "admin.php?page=" . $this->page_slug),
      esc_html__('Theme dashboard', 'morenews'),
      esc_attr($btn_class),
      $morenews_templatespare_subtitle,

    );


    $notice_external_msg = sprintf(
      '<div class="aft-notice-col-3">
			<div class="aft-documentation">
				<h3><span class="dashicons dashicons-format-aside"></span>%1$s</h3>
				<p>%2$s</p>
			</div>
			<div class="aft-documentation-links">
				<div>
					<a href="https://docs.afthemes.com/morenews-pro/" target="_blank"><span aria-hidden="true" class="dashicons dashicons-external"></span>%3$s</a>
					<a href="https://www.youtube.com/watch?v=W8NeOsnBK_A&list=PL8nUD79gscmjvGYgtQfVKgJMsBLIspJ1A" target="_blank"><span aria-hidden="true" class="dashicons dashicons-external"></span>%4$s</a>
					<a href="https://afthemes.com/blog/" target="_blank"><span aria-hidden="true" class="dashicons dashicons-external"></span>%5$s</a>
				</div>
				<div>
					<a href="https://wordpress.org/support/theme/morenews/reviews/?filter=5" class="button" target="_blank">%6$s</a>
				</div>
			</div>
			</div>',
      __('Documentation', 'morenews'),
      esc_html__('Please check our full documentation for detailed information on how to setup and customize the theme.', 'morenews'),
      esc_html__('Docs', 'morenews'),
      esc_html__('Videos', 'morenews'),
      esc_html__('Blog', 'morenews'),
      esc_html__('Rate This Theme', 'morenews')

    );


    echo sprintf(
      $main_template,
      $notice_header,
      $notice_picture,
      $notice_starter_msg,
      $notice_external_msg
    );
  }


  public function morenews_notice_dismiss()
  {


    if (! isset($_POST['nonce'])) {
      return;
    }
    $nonce =  $_POST['nonce'];
    if (! wp_verify_nonce($nonce, 'aft_installer_nonce')) {
      return;
    }


    update_option($this->dismiss_notice_key, 'yes');
    $json = array(
      'status' => 'success'

    );
    wp_send_json($json);
    wp_die();
  }
}

$data = new AdminNotice();
