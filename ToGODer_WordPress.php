<?php
/*
 * Plugin Name:       ToGODer Plugin
 * Plugin URI:        https://github.com/tanevanwifferen/ToGODer_WordPress/
 * Description:       Custom elements for ToGODer integration.
 * Version:           0.0.1
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Tane van Wifferen
 * Author URI:        https://github.com/tanevanwifferen/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */

if (!defined('ABSPATH')) {
	die;
}

include_once plugin_dir_path(__FILE__) . 'functions/activation.php';
include_once plugin_dir_path(__FILE__) . 'functions/api.php';

// Hook to add admin menu for settings page
add_action('admin_menu', 'custom_settings_add_menu');

function custom_settings_add_menu()
{
	add_menu_page('ToGODer', 'ToGODer', 'manage_options', 'togoder-config', 'custom_settings_page');
}

// Include the settings page file
function custom_settings_page()
{
	include 'togoder_settings.php';
}

register_activation_hook(
	__FILE__,
	'togoder_activate_plugin'
);