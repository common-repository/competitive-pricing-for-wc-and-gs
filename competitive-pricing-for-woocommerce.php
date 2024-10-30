<?php

/**
 *
 *
 * @link              https://www.apigenius.io/
 * @since             1.2.1
 * @package           competitive_pricing_for_woocommerce
 *
 * @wordpress-plugin
 * Plugin Name:       Competitive Pricing for WooCommerce and Google Shopping
 * Plugin URI:        https://www.apigenius.io/software/competitive-pricing-for-woocommerce-google-shopping/
 * Description:       Dynamically change this price of products based on your competition's pricing on Google Shopping. Make sure you have the most competitive pricing possible.
 * Version:           1.7
 * Author:            ApiGenius.io
 * Author URI:        https://www.apigenius.io
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       competitive-pricing-for-woocommerce
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (! defined('WPINC')) {
	die;
}

// create plugin options
add_option('api_pp_search', '');
add_option('api_pp_automation_count', '');
add_option('api_pp_total_products_start', '');
add_option('api_pp_automation_all', '');
add_option('api_pp_automation_status', '');
add_option('api_pp_automation_start_time', '');

// Top level menu - Product Dashboard
function api_pp_dashboard() {
   add_menu_page('Product Pricing', 'Product Pricing', 'manage_woocommerce', 'api-pp-dashboard', 'api_pp_dashboard_callback', 'dashicons-editor-code', 105);
}
add_action('admin_menu', 'api_pp_dashboard');

function api_pp_dashboard_callback() {
   include(plugin_dir_path(__FILE__) . 'admin-pages/dashboard.php');
}

// Settings page
function api_pp_settings() {
   add_submenu_page('api-pp-dashboard', 'Settings', 'Settings','manage_woocommerce', 'api-pp-settings', 'api_pp_settings_callback');
}
add_action('admin_menu', 'api_pp_settings');

function api_pp_settings_callback() {
   include(plugin_dir_path(__FILE__) . 'admin-pages/settings.php');
}

// How to page
if (!function_exists ('api_pp_how_to')) {
	function api_pp_how_to() {
	   add_submenu_page('api-pp-dashboard', 'How To & Help', 'How To & Help','manage_woocommerce', 'api-pp-how_to', 'api_pp_how_to_callback');
	}
	add_action('admin_menu', 'api_pp_how_to');
}
if (!function_exists ('api_pp_how_to_callback')) {
	function api_pp_how_to_callback() {
	   include(plugin_dir_path(__FILE__) . 'admin-pages/how-to.php');
	}
}

// Other Plugins
if (!function_exists ('api_pp_other_plugins')) {
	function api_pp_other_plugins() {
	   add_submenu_page('api-pp-dashboard', 'Other Great Plugins', 'Other Plugins','manage_woocommerce', 'api-pp-other-plugins', 'api_pp_other_plugins_callback');
	}
	add_action('admin_menu', 'api_pp_other_plugins');
}
if (!function_exists ('api_pp_other_plugins_callback')) {
	function api_pp_other_plugins_callback() {
	   include(plugin_dir_path(__FILE__) . 'admin-pages/other-plugins.php');
	}
}


// Plugin settings
include(plugin_dir_path(__FILE__) . 'settings/settings-register.php');
include(plugin_dir_path(__FILE__) . 'settings/settings-callback.php');
include(plugin_dir_path(__FILE__) . 'settings/settings-validation.php');

// woocommerce custom fields
include(plugin_dir_path(__FILE__) . 'functions/woocommerce-functions.php');

/* Default options */
function api_pp_default_options() {
	return array(

	);
}
