<?php
/*
Plugin Name: Simple Restaurant Menu
Plugin URI: https://fixmysite.com
Description: The simplest solution to display beautiful restaurant menus in WordPress.
Author: William Hagerty
Version: 1.2
Author URI: https://fixmysite.com
License: GPL-2.0+
License URI: http://www.gnu.org/licenses/gpl-2.0.txt
Text Domain: srm-domain
Domain Path: /languages
*/

// Exit If Accessed Directly
if(!defined('ABSPATH')){
    exit;
}

// Global Options Variable
$srm_options = get_option('srm_settings');

require_once(plugin_dir_path(__FILE__) . '/includes/srm-cpts.php');
require_once(plugin_dir_path(__FILE__) . '/includes/srm-settings.php');
require_once(plugin_dir_path(__FILE__) . '/includes/srm-shortcode.php');
require_once(plugin_dir_path(__FILE__) . '/includes/srm-cpts-columns.php');
require_once(plugin_dir_path(__FILE__) . '/includes/srm-menu-meta.php');
require_once(plugin_dir_path(__FILE__) . '/includes/srm-menu-item-meta.php');
require_once(plugin_dir_path(__FILE__) . '/includes/srm-scripts.php');



/**
 * Load plugin textdomain.
 */
add_action( 'init', 'tasty_srm_load_textdomain' );
function tasty_srm_load_textdomain() {
	load_plugin_textdomain( 'srm-domain', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}
