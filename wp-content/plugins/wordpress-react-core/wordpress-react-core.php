<?php
/**
 * Plugin Name: WordPress React Core
 * Plugin URI: https://vinhlh.dev.com/wordpress-react-core
 * Description: Core React plugin để các plugin khác có thể sử dụng React, Axios, TailwindCSS, và Ant Design
 * Version: 1.0.0
 * Author: vinhlh
 * Author URI: https://vinhlh.dev.com
 * Text Domain: wordpress-react-core
 * Domain Path: /languages
 * License: GPL v2 or later
 */

// Prevent direct access to the file
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('WP_REACT_CORE_VERSION', '1.0.0');
define('WP_REACT_CORE_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('WP_REACT_CORE_PLUGIN_URL', plugin_dir_url(__FILE__));
define('WP_REACT_CORE_PLUGIN_BASENAME', plugin_basename(__FILE__));

// Require main class file
require_once WP_REACT_CORE_PLUGIN_DIR . 'includes/class-wp-react-core.php';

// Initialize the plugin
function wp_react_core_init() {
    // Load text domain for translations
    load_plugin_textdomain('wordpress-react-core', false, dirname(WP_REACT_CORE_PLUGIN_BASENAME) . '/languages');
    
    // Initialize the main plugin class
    $wp_react_core = new WP_React_Core();
    $wp_react_core->init();
}

// Hook into WordPress init
add_action('plugins_loaded', 'wp_react_core_init');

// Register activation hook
register_activation_hook(__FILE__, 'wp_react_core_activate');
function wp_react_core_activate() {
    // Activation tasks
    // For example, you might want to set default options
    $default_options = array(
        'wp_react_core_enabled' => true,
        'include_tailwind' => true,
        'include_antd' => true,
        'include_axios' => true
    );
    update_option('wp_react_core_options', $default_options);
    
    // Maybe create custom database tables if needed
}

// Register deactivation hook
register_deactivation_hook(__FILE__, 'wp_react_core_deactivate');
function wp_react_core_deactivate() {
    // Cleanup tasks when plugin is deactivated
}

// Register uninstall hook
register_uninstall_hook(__FILE__, 'wp_react_core_uninstall');
function wp_react_core_uninstall() {
    // Cleanup tasks when plugin is uninstalled
    delete_option('wp_react_core_options');
}

// Define function to check if plugin is loaded
// Other plugins can use this to check if React Core is active
function wp_react_core_is_loaded() {
    return defined('WP_REACT_CORE_VERSION');
}