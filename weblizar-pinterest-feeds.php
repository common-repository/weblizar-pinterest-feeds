<?php
/*
 * Plugin Name:	Weblizar Pin Feeds
 * Description: Weblizar team introduce Pinterest feeds  plugin  which is used to show your Pinterest feed at any where your site. You can use shortcode and widgets to show your Pinterest images.
 * Version:	1.2.7
 * Author: 	Weblizar
 * Text Domain: pinterest_feed_wordpress
 * Domain path:	/languages
 * Author URI:	https://weblizar.com
 * Plugin URI: https://weblizar.com/plugins/pinterest-feed-pro/
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

/**
 * Default Constants
 */
define('PFFREE_TEXT_DOMAIN','pinterest_feed_wordpress'); // Your textdomain
include 'options/option-panel.php';
include 'options/default-options.php';

//Name shows up on the admin settings screen.
define("PFFREE_PLUGIN_SHORT_NAME", "Pinterest Feed Wordpress" );
define("PFFREE_VERSION", "1.2.6"); // Plugin Version Number
define("PFFREE_PLUGIN_URL", plugin_dir_path(__FILE__));
define("PFFREE_PLUGIN_FILE_URL", plugin_dir_url( __FILE__ ) );
define("PFFREE_PLUGIN_LINK", 'https://weblizar.com/plugins/pinterest_feed_wordpress/');

add_action('plugins_loaded', 'PFFREE_Language_Translater');
function PFFREE_Language_Translater() {
	load_plugin_textdomain( PFFREE_TEXT_DOMAIN , FALSE, dirname( plugin_basename(__FILE__)).'/languages' );
}

function weblizar_pffree_activation(){
	$pffree_default_options_data = pffree_default_options_data();
	$pffree_default_options_data_settings = get_option('weblizar_pffree_options'); // get existing option data
	if($pffree_default_options_data_settings) {
		$pffree_default_options_data_settings = array_merge($pffree_default_options_data, $pffree_default_options_data_settings);
		update_option('weblizar_pffree_options', $pffree_default_options_data_settings);	// Set existing and new option data
	} else {
		add_option('weblizar_pffree_options', $pffree_default_options_data);  // set New option data
	}
}
register_activation_hook( __FILE__, 'weblizar_pffree_activation' );

// Do redirect when Plugin activate
function PFFREE_nht_plugin_activate() {
 add_option('PFFREE_nht_plugin_do_activation_redirect', true);
}
function PFFREE_nht_plugin_redirect() {
	if (get_option('PFFREE_nht_plugin_do_activation_redirect', false)) {
		delete_option('PFFREE_nht_plugin_do_activation_redirect');
		if(!isset($_GET['activate-multi'])) {
			wp_redirect("admin.php?page=pffree-weblizar");
		}
	}
}
register_activation_hook(__FILE__, 'PFFREE_nht_plugin_activate');
add_action('admin_init', 'PFFREE_nht_plugin_redirect');

// Add settings link on plugin page
function pin_settings_link($links) {
	$pin_settings_link = '<a href="admin.php?page=pffree-weblizar">'. esc_html__( 'Settings', PFFREE_TEXT_DOMAIN ) .'</a>';
	$pin_pro_link = '<a href="https://weblizar.com/plugins/pinterest-feed-pro/" target="_blank">'. esc_html__( 'Go Pro', PFFREE_TEXT_DOMAIN ) .'</a>';
    array_unshift($links, $pin_pro_link,$pin_settings_link);
    return $links;
}
$pin_plugin_name = plugin_basename(__FILE__);
add_filter("plugin_action_links_$pin_plugin_name", 'pin_settings_link' );
