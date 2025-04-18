<?php
/**
 * Genesis Framework.
 *
 * WARNING: This file is part of the core Genesis Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package Genesis\PostMeta
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/genesis/
 */

add_action( 'init', 'genesis_register_post_meta' );
/**
 * Register post meta for Genesis Block Editor features, such as the title
 * and breadcrumbs checkbox controls.
 *
 * Meta must be registered to allow getting and setting via the REST API.
 *
 * Protecting fields by prefixing them with an underscore prevents them from
 * appearing in the Custom Fields meta box, where they would override changes
 * to the Block Editor Redux store.
 *
 * Passing '__return_true' for `auth_callback` allows the field to be updated
 * via the REST API even though it is protected.
 *
 * @since 3.1.0
 */
function genesis_register_post_meta() {
	$args = [
		'auth_callback' => '__return_true',
		'type'          => 'boolean',
		'single'        => true,
		'show_in_rest'  => true,
	];

	$string_args = array_merge( $args, [ 'type' => 'string' ] );

	// Hide title: true if title should be hidden, false or empty otherwise.
	register_meta( 'post', '_genesis_hide_title', $args );

	// Hide breadcrumbs: true if breadcrumbs should be hidden, false or empty otherwise.
	register_meta( 'post', '_genesis_hide_breadcrumbs', $args );

	// Hide image: true if featured image should be hidden, false or empty otherwise.
	register_meta( 'post', '_genesis_hide_singular_image', $args );

	// Hide footer widgets: true if widgets should be hidden, false or empty otherwise.
	register_meta( 'post', '_genesis_hide_footer_widgets', $args );

	// Body class: string to add to the body element class attribute.
	register_meta( 'post', '_genesis_custom_body_class', $string_args );

	// Post class: string to add to the article.entry element class attribute.
	register_meta( 'post', '_genesis_custom_post_class', $string_args );

	// Layout: string layout.
	register_meta( 'post', '_genesis_layout', $string_args );
}
