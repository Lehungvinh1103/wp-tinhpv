<?php
/**
 * Main class for WordPress React Core Plugin
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Check if class already exists
if (!class_exists('WP_React_Core')) {

    class WP_React_Core {
        /**
         * The single instance of the class
         */
        private static $instance = null;

        /**
         * Plugin options
         */
        private $options;

        /**
         * Main WP_React_Core Instance
         *
         * Ensures only one instance of WP_React_Core is loaded or can be loaded.
         */
        public static function instance() {
            if (is_null(self::$instance)) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        /**
         * Constructor
         */
        public function __construct() {
            $this->options = get_option('wp_react_core_options', array());
            
            // Include required files
            $this->includes();
        }

        /**
         * Include required files
         */
        private function includes() {
            // Load class for enqueuing scripts and styles
            require_once WP_REACT_CORE_PLUGIN_DIR . 'includes/class-wp-react-enqueue.php';
            
            // Load class for REST API
            require_once WP_REACT_CORE_PLUGIN_DIR . 'includes/class-wp-react-api.php';
        }

        /**
         * Initialize the plugin
         */
        public function init() {
            // Initialize Enqueue class
            $enqueue = new WP_React_Enqueue($this->options);
            $enqueue->init();
            
            // Initialize API class
            $api = new WP_React_API();
            $api->init();
            
            // Add admin menu
            add_action('admin_menu', array($this, 'add_admin_menu'));
            
            // Register REST API endpoints for this plugin
            add_action('rest_api_init', array($this, 'register_rest_routes'));
        }

        /**
         * Add admin menu
         */
        public function add_admin_menu() {
            add_menu_page(
                __('React Core', 'wordpress-react-core'),
                __('React Core', 'wordpress-react-core'),
                'manage_options',
                'wordpress-react-core',
                array($this, 'render_admin_page'),
                'dashicons-admin-generic',
                100
            );
        }

        /**
         * Render admin page
         */
        public function render_admin_page() {
            // This div will be the root for the React admin app
            echo '<div id="wp-react-core-admin-root"></div>';
        }

        /**
         * Register REST API routes
         */
        public function register_rest_routes() {
            register_rest_route('wp-react-core/v1', '/settings', array(
                'methods' => 'GET',
                'callback' => array($this, 'get_settings'),
                'permission_callback' => function () {
                    return current_user_can('manage_options');
                }
            ));
            
            register_rest_route('wp-react-core/v1', '/settings', array(
                'methods' => 'POST',
                'callback' => array($this, 'update_settings'),
                'permission_callback' => function () {
                    return current_user_can('manage_options');
                }
            ));
        }

        /**
         * Get plugin settings
         */
        public function get_settings() {
            return rest_ensure_response($this->options);
        }

        /**
         * Update plugin settings
         */
        public function update_settings($request) {
            $params = $request->get_params();
            
            // Validate and sanitize the input
            $options = array(
                'wp_react_core_enabled' => isset($params['wp_react_core_enabled']) ? (bool) $params['wp_react_core_enabled'] : true,
                'include_tailwind' => isset($params['include_tailwind']) ? (bool) $params['include_tailwind'] : true,
                'include_antd' => isset($params['include_antd']) ? (bool) $params['include_antd'] : true,
                'include_axios' => isset($params['include_axios']) ? (bool) $params['include_axios'] : true
            );
            
            // Update options
            update_option('wp_react_core_options', $options);
            $this->options = $options;
            
            return rest_ensure_response(array(
                'success' => true,
                'options' => $options
            ));
        }

        /**
         * Get a specific option
         */
        public function get_option($key, $default = false) {
            return isset($this->options[$key]) ? $this->options[$key] : $default;
        }
    }
}

// Function to return the main instance of WP_React_Core
function WP_React_Core() {
    return WP_React_Core::instance();
}