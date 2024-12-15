<?php
/**
 * Easy Digital Downloads Theme Updater
 *
 * @package EDD Sample Theme
 */

// Includes the files needed for the theme updater
if (!class_exists('EDD_Theme_Updater_Admin')) {
	include (dirname(__FILE__).'/theme-updater-admin.php');
}

// Loads the updater classes
$updater = new EDD_Theme_Updater_Admin(

	// Config settings
	$config = array(
		'remote_api_url' => 'https://www.afthemes.com', // Site where EDD is hosted
		'item_name'      => 'MoreNews Pro', // Name of theme
		'theme_slug'     => 'morenews-pro', // Theme slug
		'version'        => '1.0.0', // The current version of this theme
		'author'         => 'AF themes', // The author of this theme
		'download_id'    => '', // Optional, used for generating a license renewal link
		'renew_url'      => 'https://afthemes.com/my-accounts/'// Optional, allows for a custom license renewal link
	),

	// Strings
	$strings = array(
		'theme-license'             => __('Theme License', 'morenews'),
		'enter-key'                 => __('Enter your theme license key.', 'morenews'),
		'license-key'               => __('License Key', 'morenews'),
		'license-action'            => __('License Action', 'morenews'),
		'deactivate-license'        => __('Deactivate License', 'morenews'),
		'activate-license'          => __('Activate License', 'morenews'),
		'status-unknown'            => __('License status is unknown.', 'morenews'),
		'renew'                     => __('Renew?', 'morenews'),
		'unlimited'                 => __('unlimited', 'morenews'),
		'license-key-is-active'     => __('License key is active.', 'morenews'),
		'expires%s'                 => __('Expires %s.', 'morenews'),
		'%1$s/%2$-sites'            => __('You have %1$s / %2$s sites activated.', 'morenews'),
		'license-key-expired-%s'    => __('License key expired %s.', 'morenews'),
		'license-key-expired'       => __('License key has expired.', 'morenews'),
		'license-keys-do-not-match' => __('License keys do not match.', 'morenews'),
		'license-is-inactive'       => __('License is inactive.', 'morenews'),
		'license-key-is-disabled'   => __('License key is disabled.', 'morenews'),
		'site-is-inactive'          => __('Site is inactive.', 'morenews'),
		'license-status-unknown'    => __('License status is unknown.', 'morenews'),
		'update-notice'             => __("Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'morenews'),
		'update-available'          => __('<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'morenews')
	)

);
