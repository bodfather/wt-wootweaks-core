<?php
/*
Plugin Name: WooTweaks Core
Description: The core menu for WooTweaks suite of plugins, enhancing WooCommerce functionality.
Version: 0.0.3
Author: Bodfather
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Plugin URI: https://github.com/bodfather/wt-wootweaks-core
Plugin Repository: bodfather/wt-wootweaks-core
Author URI: https://github.com/bodfather
Requires at Least: 5.0
Tested Up To: 6.7
Text Domain: wt-wootweaks
Tags: woocommerce, tweaks, customization, admin
Requires PHP: 7.2
Update URI: https://api.github.com/repos/bodfather/wt-wootweaks-core/releases/latest
Banner URI: /assets/banner-772x250.jpg
Icon URI: /assets/icon-128x128.png
Short Description: Core plugin for managing WooTweaks suite and WooCommerce settings.
*/

// Safety first
if ( ! defined( 'ABSPATH' ) ) {
	header( 'Location: https://bodmerch.com/welcome.php' );
	exit;
}

// Define plugin constants
define( 'WOOTWEAKS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'WOOTWEAKS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Include necessary files
require_once WOOTWEAKS_PLUGIN_DIR . 'includes/api-token-manager.php';
require_once WOOTWEAKS_PLUGIN_DIR . 'includes/updater.php';
require_once WOOTWEAKS_PLUGIN_DIR . 'includes/class-plugin-info.php'; // Add this
require_once WOOTWEAKS_PLUGIN_DIR . 'admin/includes/class-admin-settings.php';

// Initialize the plugin
class WT_Core_Plugin {
	private static $instance = null;

	public static function get_instance() {
		if ( self::$instance === null ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct() {
		// Initialize admin settings
		$admin_settings = new WT_Core_Admin_Settings();
		$admin_settings->init();

		// Initialize plugin info
		$plugin_info = new WT_Wootweaks_Core_Plugin_Info();
		add_filter( 'plugins_api', array( $plugin_info, 'plugin_info' ), 20, 3 );
		add_filter( 'plugin_row_meta', array( $plugin_info, 'plugin_row_meta' ), 10, 2 );

		// Add assets
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_assets' ) );

		// Setup updater
		wt_wootweaks_core_setup_plugin_updater( __FILE__ ); // Uncommented for consistency
	}

	public function enqueue_admin_assets( $hook ) {
		if ( strpos( $hook, 'wt-wootweaks' ) === false ) {
			return;
		}

		wp_enqueue_style(
			'wt-admin-style',
			WOOTWEAKS_PLUGIN_URL . 'admin/css/admin-style.css',
			array(),
			'1.0.0'
		);

		wp_enqueue_script(
			'wt-admin-script',
			WOOTWEAKS_PLUGIN_URL . 'admin/js/admin-script.js',
			array( 'jquery' ),
			'1.0.0',
			true
		);

		wp_enqueue_style(
			'fontawesome',
			'https://use.fontawesome.com/releases/latest/css/all.css',
			array(),
			null
		);
	}
}

// Kick off the plugin
WT_Core_Plugin::get_instance();
