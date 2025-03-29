<?php
/**
 * Class for handling script and style enqueuing
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Check if class already exists
if (!class_exists('WP_React_Enqueue')) {

    class WP_React_Enqueue {
        /**
         * Plugin options
         */
        private $options;

        /**
         * Constructor
         */
        public function __construct($options) {
            $this->options = $options;
        }

        /**
         * Initialize hooks
         */
        public function init() {
            // Enqueue admin scripts
            add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_assets'));
            
            // Enqueue frontend scripts
            add_action('wp_enqueue_scripts', array($this, 'enqueue_frontend_assets'));
            
            // Register React, React DOM and other core libraries
            add_action('init', array($this, 'register_core_scripts'));
        }

        /**
         * Register core scripts that will be available to other plugins
         */
        public function register_core_scripts() {
            // React version
            $react_version = '18.2.0';
            // React DOM version
            $react_dom_version = '18.2.0';
            // Axios version
            $axios_version = '1.5.0';
            // Ant Design version
            $antd_version = '5.8.6';
            // Tailwind version
            $tailwind_version = '3.3.3';
            
            // Register React and React DOM (development versions for now)
            wp_register_script(
                'react',
                "https://unpkg.com/react@{$react_version}/umd/react.development.js",
                array(),
                $react_version,
                true
            );
            
            wp_register_script(
                'react-dom',
                "https://unpkg.com/react-dom@{$react_dom_version}/umd/react-dom.development.js",
                array('react'),
                $react_dom_version,
                true
            );
            
            // Register Axios if enabled
            if (isset($this->options['include_axios']) && $this->options['include_axios']) {
                wp_register_script(
                    'axios',
                    "https://unpkg.com/axios@{$axios_version}/dist/axios.min.js",
                    array(),
                    $axios_version,
                    true
                );
            }
            
            // Register Ant Design if enabled
            if (isset($this->options['include_antd']) && $this->options['include_antd']) {
                wp_register_script(
                    'antd',
                    "https://unpkg.com/antd@{$antd_version}/dist/antd.min.js",
                    array('react', 'react-dom'),
                    $antd_version,
                    true
                );
                
                wp_register_style(
                    'antd-css',
                    "https://unpkg.com/antd@{$antd_version}/dist/reset.css",
                    array(),
                    $antd_version
                );
            }
            
            // Register Tailwind if enabled
            if (isset($this->options['include_tailwind']) && $this->options['include_tailwind']) {
                wp_register_style(
                    'tailwind-css',
                    "https://unpkg.com/tailwindcss@{$tailwind_version}/dist/tailwind.min.css",
                    array(),
                    $tailwind_version
                );
            }
            
            // Register our bundled scripts
            wp_register_script(
                'wp-react-core-admin',
                WP_REACT_CORE_PLUGIN_URL . 'build/admin.js',
                array('react', 'react-dom', 'wp-api'),
                WP_REACT_CORE_VERSION,
                true
            );
            
            wp_register_script(
                'wp-react-core-public',
                WP_REACT_CORE_PLUGIN_URL . 'build/public.js',
                array('react', 'react-dom'),
                WP_REACT_CORE_VERSION,
                true
            );
            
            // Register vendor bundle
            wp_register_script(
                'wp-react-core-vendor',
                WP_REACT_CORE_PLUGIN_URL . 'build/vendor.js',
                array('react', 'react-dom'),
                WP_REACT_CORE_VERSION,
                true
            );
            
            // Add WordPress data to be available in JavaScript
            wp_localize_script('wp-react-core-admin', 'wpReactCore', array(
                'apiUrl' => esc_url_raw(rest_url()),
                'nonce' => wp_create_nonce('wp_rest'),
                'options' => $this->options
            ));
        }

        /**
         * Enqueue scripts and styles for admin
         */
        public function enqueue_admin_assets($hook) {
            // Only load on plugin admin page
            if ('toplevel_page_wordpress-react-core' !== $hook) {
                return;
            }
            
            // Enqueue React and React DOM
            wp_enqueue_script('react');
            wp_enqueue_script('react-dom');
            
            // Enqueue Axios if enabled
            if (isset($this->options['include_axios']) && $this->options['include_axios']) {
                wp_enqueue_script('axios');
            }
            
            // Enqueue Ant Design if enabled
            if (isset($this->options['include_antd']) && $this->options['include_antd']) {
                wp_enqueue_script('antd');
                wp_enqueue_style('antd-css');
            }
            
            // Enqueue Tailwind if enabled
            if (isset($this->options['include_tailwind']) && $this->options['include_tailwind']) {
                wp_enqueue_style('tailwind-css');
            }
            
            // Enqueue admin script
            wp_enqueue_script('wp-react-core-admin');
            
            // Enqueue vendor script
            wp_enqueue_script('wp-react-core-vendor');
        }

        /**
         * Enqueue scripts and styles for frontend
         */
        public function enqueue_frontend_assets() {
            // Check if plugin is enabled for frontend
            if (!isset($this->options['wp_react_core_enabled']) || !$this->options['wp_react_core_enabled']) {
                return;
            }
            
            // We don't automatically enqueue scripts on the frontend
            // Other plugins will need to enqueue what they need
            
            // But we do localize the script for use by other plugins
            wp_localize_script('wp-react-core-public', 'wpReactCore', array(
                'apiUrl' => esc_url_raw(rest_url()),
                'nonce' => wp_create_nonce('wp_rest'),
                'options' => $this->options
            ));
        }

        /**
         * Helper function to check if a script is registered
         */
        public static function is_script_registered($handle) {
            return wp_script_is($handle, 'registered');
        }

        /**
         * Helper function to check if a style is registered
         */
        public static function is_style_registered($handle) {
            return wp_style_is($handle, 'registered');
        }
    }
}