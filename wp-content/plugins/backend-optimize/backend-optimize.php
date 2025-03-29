<?php
/**
 * Plugin Name:       Backend Optimize
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Plugin này được Tính viết với mục đích tối ưu hoá Backend của WordPress sử dụng cho việc cá nhân
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Phan Văn Tính
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       backend-optimize
 */


require_once 'custom-login.php';
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
add_filter( 'xmlrpc_enabled', '__return_false' );
remove_action( 'wp_head', 'wp_generator' );
add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );

/**
 * @param $links
 *
 * @return void
 */
function disable_pingback( &$links ) {
	foreach ( $links as $l => $link ) {
		if ( 0 === strpos( $link, get_option( 'home' ) ) ) {
			unset( $links[ $l ] );
		}
	}
}

add_action( 'pre_ping', 'disable_pingback' );

function remove_dashboard_widgets() {
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_recent_draft', 'dashboard', 'side' );
	remove_meta_box( 'rank_math_dashboard_widget', 'dashboard', 'normal' );
	remove_meta_box( 'wc_admin_dashboard_setup', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_site_health', 'dashboard', 'normal' );//since 3.8
	remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );//since 3.8
	remove_meta_box( 'rg_forms_dashboard', 'dashboard', 'normal' );//since 3.8
}

add_action( 'wp_dashboard_setup', 'remove_dashboard_widgets' );


/**
 * @return void
 */
function example_admin_bar_remove_logo() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu( 'wp-logo' );
}

add_action( 'wp_before_admin_bar_render', 'example_admin_bar_remove_logo', 0 );

/**
 * hide update notifications
 * @return object
 */
function remove_core_updates() {
	global $wp_version;

	return (object) array( 'last_checked' => time(), 'version_checked' => $wp_version, );
}

add_filter( 'pre_site_transient_update_core', 'remove_core_updates' ); //hide updates for WordPress itself
add_filter( 'pre_site_transient_update_plugins', 'remove_core_updates' ); //hide updates for all plugins
add_filter( 'pre_site_transient_update_themes', 'remove_core_updates' ); //hide updates for all themes


add_filter( 'rest_authentication_errors', function ( $result ) {
	if ( true === $result || is_wp_error( $result ) ) {
		return $result;
	}

	if ( ! is_user_logged_in() ) {
		return new WP_Error(
			'rest_not_logged_in',
			__( 'You are not currently logged in.' ),
			array( 'status' => 401 )
		);
	}

	return $result;
} );
