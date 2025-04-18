<?php
/**
 * Genesis Framework.
 *
 * WARNING: This file is part of the core Genesis Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package StudioPress\Genesis
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/genesis/
 */

global $wp_version;

/**
 * The configuration array that is passed to `Genesis_Update_Check` in `Genesis_Update`.
 *
 * This array is used to build the POST that retrieves update information from an update server.
 *
 * @since 2.7.0
 */
return [
	'post_url'      => 'https://api.genesistheme.com/update-themes/',
	'post_args'     => [
		'body' => [
			'genesis_version' => PARENT_THEME_VERSION,
			'html5'           => current_theme_supports( 'html5' ),
			'php_version'     => PHP_VERSION,
			'uri'             => home_url(),
			'stylesheet'      => get_stylesheet(),
			'theme_version'   => wp_get_theme()->get( 'Version' ),
			'locale'          => get_locale(),
			'multisite'       => is_multisite(),
			'user-agent'      => "WordPress/$wp_version;",
			'wp_version'      => $wp_version,
		],
	],
	'req_data_keys' => [ 'theme', 'new_version', 'url', 'package', 'changelog_url' ],
];
