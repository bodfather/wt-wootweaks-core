<?php
/*
Plugin Name: WooTweaks Core
Description: The core menu for WooTweaks suite of plugins, enhancing WooCommerce functionality.
Version: 1.0
Author: Bodfather
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Plugin URI: https://github.com/bodfather/wt-wootweaks-core
Plugin Repository: bodfather/wt-wootweaks-core
Author URI: https://github.com/bodfather
Requires at Least: 5.0
Tested Up To: 6.6.1
Text Domain: wt-wootweaks
Tags: woocommerce, tweaks, customization, admin
Requires PHP: 7.0
Update URI: https://api.github.com/repos/bodfather/wt-wootweaks-core/releases/latest
Banner URI: /assets/banner.jpg
Icon URI: /assets/icon.png
Short Description: Core plugin for managing WooTweaks suite and WooCommerce settings.
*/

// Safety first
if (!defined('ABSPATH')) {
    header('Location: https://yourwebsite.com/welcome.php'); // Replace with your desired redirect
    exit;
}

// Enqueue Font Awesome for admin styles
function wt_wootweaks_enqueue_admin_styles() {
    wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css', array(), '5.15.1');
}
add_action('admin_enqueue_scripts', 'wt_wootweaks_enqueue_admin_styles');

// Add the WooTweaks admin menu
function wt_wootweaks_admin_menu() {
    add_menu_page(
        'WooTweaks',           // Page title
        'WooTweaks',           // Menu title
        'manage_options',      // Capability
        'wt-wootweaks',        // Menu slug (unique identifier)
        'wt_wootweaks_dashboard', // Callback function
        'none',                // Icon (we'll use custom CSS instead)
        55.5                   // Position
    );
}
add_action('admin_menu', 'wt_wootweaks_admin_menu');

// Dashboard page content
function wt_wootweaks_dashboard() {
    ?>
    <div class="wrap">
        <h1>Welcome to WooTweaks</h1>
        <p>Configure your WooCommerce settings from here.</p>
    </div>
    <?php
}

// Custom icon for the admin menu
function wt_wootweaks_admin_styles() {
    ?>
    <style>
        #adminmenu .toplevel_page_wt-wootweaks .wp-menu-image:before {
            font-family: "Font Awesome 5 Free";
            content: "\f044"; /* Font Awesome unicode for "edit" icon */
            font-weight: 900; /* Required for solid icons in Font Awesome 5 */
        }
    </style>
    <?php
}
add_action('admin_head', 'wt_wootweaks_admin_styles');

?>