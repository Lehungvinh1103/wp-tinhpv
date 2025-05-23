<?php
/**
 * Genesis Framework.
 *
 * WARNING: This file is part of the core Genesis Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package Genesis\Schema
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/genesis/
 */

namespace StudioPress\Genesis\Functions\Rest;

use function genesis_breadcrumb_options_enabled;
use function genesis_get_layouts;
use function genesis_post_types_with_singular_images_enabled;
use function get_option;
use function register_rest_route;

add_action( 'rest_api_init', __NAMESPACE__ . '\\layouts' );
/**
 * Add `layouts` endpoint to the REST API.
 *
 * Example: `curl https://example.com/wp-json/genesis/v1/layouts/site`
 * Example: `curl https://example.com/wp-json/genesis/v1/layouts/singular,page,24`
 *
 * @since 3.3.0 Accept multiple comma-separated layout types.
 *              Types are checked from right to left, returning the first type
 *              with registered layouts and falling back to 'site' if no passed
 *              types have registered layouts.
 * @since 3.1.0
 */
function layouts() {
	register_rest_route(
		'genesis/v1',
		'/layouts/(?P<type>[a-z0-9,_-]+)',
		[
			'methods'             => 'GET',
			'callback'            => function( $params ) {
				$type = $params['type'];
				if ( strpos( $type, ',' ) !== false ) {
					$type = explode( ',', $type );
				}
				return genesis_get_layouts( $type );
			},
			'permission_callback' => '__return_true',
		]
	);
}

add_action( 'rest_api_init', __NAMESPACE__ . '\\get_singular_images' );
/**
 * Add `singular-images` endpoint to the REST API.
 *
 * Returns an array of post types that have genesis-singular-images support
 * with singular images enabled in the Singular Content panel in the Customizer.
 *
 * Example: `curl https://example.com/wp-json/genesis/v1/singular-images`
 *
 * Example response:
 *
 * [
 *     'post', // Featured Images are enabled on posts.
 *     'page'  // Featured Images are enabled on pages.
 * ]
 *
 * @since 3.1.0
 */
function get_singular_images() {
	register_rest_route(
		'genesis/v1',
		'/singular-images',
		[
			'methods'             => 'GET',
			'callback'            => '\genesis_post_types_with_singular_images_enabled',
			'permission_callback' => '__return_true',
		]
	);
}

add_action( 'rest_api_init', __NAMESPACE__ . '\\set_singular_images' );
/**
 * Update singular image state to turn featured image output on or off for
 * the provided post types.
 *
 * Expects to receive a JSON object with post type as key, then 1 for the value
 * to enable images, and 0 to disable.
 *
 * {
 *    "pages": 0, // Disable featured images on pages.
 *    "posts": 1  // Enable featured images on posts.
 * }
 *
 * Returns an array of all post types that now have featured images enabled
 * after the update is applied. For the above example, assuming no other post
 * types have `genesis-singular-images` support:
 *
 * [ "posts" ]
 *
 * @since 3.1.0
 */
function set_singular_images() {
	register_rest_route(
		'genesis/v1',
		'/singular-images',
		[
			'methods'             => 'PUT',
			'callback'            => function( $request ) {
				$post_types = $request->get_json_params();

				foreach ( $post_types as $type => $value ) {
					$genesis_options = get_option( GENESIS_SETTINGS_FIELD );

					$genesis_options[ "show_featured_image_{$type}" ] = $value;
					update_option( GENESIS_SETTINGS_FIELD, $genesis_options );
				}

				return genesis_post_types_with_singular_images_enabled();

			},
			'permission_callback' => function() {
				return current_user_can( 'edit_theme_options' );
			},
		]
	);
}

add_action( 'rest_api_init', __NAMESPACE__ . '\\get_breadcrumbs' );
/**
 * Add `breadcrumbs` endpoint to the REST API.
 *
 * Returns an array of options that have breadcrumbs enabled.
 *
 * Example: `curl https://example.com/wp-json/genesis/v1/breadcrumbs`
 *
 * Example response: [ "breadcrumb_single", "breadcrumb_page" ]
 *
 * @since 3.1.0
 */
function get_breadcrumbs() {
	register_rest_route(
		'genesis/v1',
		'/breadcrumbs',
		[
			'methods'             => 'GET',
			'callback'            => '\genesis_breadcrumb_options_enabled',
			'permission_callback' => '__return_true',
		]
	);
}

add_action( 'rest_api_init', __NAMESPACE__ . '\\set_breadcrumbs' );
/**
 * Update breadcrumbs state to turn breadcrumb output on or off for
 * the provided option type.
 *
 * Expects to receive a JSON object with breadcrumb type as key,
 * then 1 for the value to enable breadcrumbs, and 0 to disable.
 *
 * {
 *    "breadcrumb_front_page": 0, // Disable breadcrumbs on the front page.
 *    "breadcrumb_single": 1      // Enable breadcrumbs on posts.
 *    "breadcrumb_page": 1        // Enable breadcrumbs on pages.
 * }
 *
 * Returns an array of all options that now have breadcrumbs enabled after
 * the update is applied. For the above example, assuming no other breadcrumbs
 * are enabled:
 *
 * [ "breadcrumb_single", "breadcrumb_page" ]
 *
 * @since 3.1.0
 */
function set_breadcrumbs() {
	register_rest_route(
		'genesis/v1',
		'/breadcrumbs',
		[
			'methods'             => 'PUT',
			'callback'            => function( $request ) {
				$types           = $request->get_json_params();
				$genesis_options = get_option( GENESIS_SETTINGS_FIELD );

				foreach ( $types as $type => $value ) {
					// Prevent updates of non-breadcrumb options via this endpoint.
					if ( strpos( $type, 'breadcrumb_' ) !== 0 ) {
						continue;
					}

					$genesis_options[ $type ] = $value;
				}

				update_option( GENESIS_SETTINGS_FIELD, $genesis_options );

				return genesis_breadcrumb_options_enabled();

			},
			'permission_callback' => function() {
				return current_user_can( 'edit_theme_options' );
			},
		]
	);
}

add_action( 'rest_api_init', __NAMESPACE__ . '\\get_reading_settings' );
/**
 * Presents show_on_front, page_on_front, and page_for_posts settings.
 *
 * These settings are not currently offered by the WordPress REST API. We could
 * switch to `wp` endpoints once the settings are exposed there.
 *
 * Example: `curl https://example.com/wp-json/genesis/v1/reading-settings`
 *
 * Example response:
 *
 * {"show_on_front":"page","page_on_front":123,"page_for_posts":456}
 *
 * @since 3.1.0
 */
function get_reading_settings() {
	register_rest_route(
		'genesis/v1',
		'/reading-settings',
		[
			'methods'             => 'GET',
			'callback'            => function() {
				return [
					'show_on_front'  => get_option( 'show_on_front' ),
					'page_on_front'  => (int) get_option( 'page_on_front' ),
					'page_for_posts' => (int) get_option( 'page_for_posts' ),
				];
			},
			'permission_callback' => '__return_true',
		]
	);
}
