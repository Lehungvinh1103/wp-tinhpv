<?php
/**
 * Class for handling REST API
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Check if class already exists
if (!class_exists('WP_React_API')) {

    class WP_React_API {
        /**
         * Constructor
         */
        public function __construct() {
            // Constructor logic
        }

        /**
         * Initialize hooks
         */
        public function init() {
            // Register REST API endpoints
            add_action('rest_api_init', array($this, 'register_routes'));
        }

        /**
         * Register REST API routes
         */
        public function register_routes() {
            // Register route to check if a script is registered
            register_rest_route('wp-react-core/v1', '/scripts/registered', array(
                'methods' => 'GET',
                'callback' => array($this, 'is_script_registered'),
                'permission_callback' => function () {
                    return true; // Public endpoint
                },
                'args' => array(
                    'handle' => array(
                        'required' => true,
                        'sanitize_callback' => 'sanitize_text_field'
                    )
                )
            ));
            
            // Register route to get all registered scripts
            register_rest_route('wp-react-core/v1', '/scripts', array(
                'methods' => 'GET',
                'callback' => array($this, 'get_registered_scripts'),
                'permission_callback' => function () {
                    return current_user_can('manage_options');
                }
            ));
            
            // Register route to get plugin status
            register_rest_route('wp-react-core/v1', '/status', array(
                'methods' => 'GET',
                'callback' => array($this, 'get_plugin_status'),
                'permission_callback' => function () {
                    return true; // Public endpoint
                }
            ));
        }

        /**
         * Check if a script is registered
         */
        public function is_script_registered($request) {
            $handle = $request->get_param('handle');
            
            $is_registered = WP_React_Enqueue::is_script_registered($handle);
            
            return rest_ensure_response(array(
                'handle' => $handle,
                'registered' => $is_registered
            ));
        }

        /**
         * Get all registered scripts
         */
        public function get_registered_scripts() {
            global $wp_scripts;
            
            $registered_scripts = array();
            
            foreach ($wp_scripts->registered as $handle => $script) {
                $registered_scripts[] = array(
                    'handle' => $handle,
                    'src' => $script->src,
                    'deps' => $script->deps,
                    'ver' => $script->ver
                );
            }
            
            return rest_ensure_response($registered_scripts);
        }

        /**
         * Get plugin status
         */
        public function get_plugin_status() {
            $options = get_option('wp_react_core_options', array());
            
            return rest_ensure_response(array(
                'version' => WP_REACT_CORE_VERSION,
                'enabled' => isset($options['wp_react_core_enabled']) ? (bool) $options['wp_react_core_enabled'] : false,
                'libraries' => array(
                    'react' => WP_React_Enqueue::is_script_registered('react'),
                    'react-dom' => WP_React_Enqueue::is_script_registered('react-dom'),
                    'axios' => WP_React_Enqueue::is_script_registered('axios'),
                    'antd' => WP_React_Enqueue::is_script_registered('antd'),
                    'tailwind' => WP_React_Enqueue::is_style_registered('tailwind-css')
                )
            ));
        }
    }
}