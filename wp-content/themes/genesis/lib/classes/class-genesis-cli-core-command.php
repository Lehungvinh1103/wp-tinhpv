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

/**
 * Manage Genesis Core Framework via cli.
 */
class Genesis_Cli_Core_Command {
	/**
	 * Show current Genesis core files version
	 *
	 * ## CORE
	 *
	 * ## EXAMPLES
	 *
	 *  $ wp genesis core version
	 *  2.9.1
	 *
	 * @subcommand version
	 *
	 * @since 2.10.0
	 *
	 * @param array $args       Positional arguments.
	 * @param array $assoc_args Stores all the arguments defined like --key=value or --flag or --no-flag.
	 */
	public function version( $args, $assoc_args ) {

		WP_CLI::log( PARENT_THEME_VERSION );

	}

	/**
	 * Updates Genesis, upgrades the database.
	 *
	 * ## EXAMPLES
	 *
	 *  $ wp genesis core update
	 *
	 * @since 2.10.0
	 *
	 * @param array $args       Positional arguments.
	 * @param array $assoc_args Stores all the arguments defined like --key=value or --flag or --no-flag.
	 */
	public function update( $args, $assoc_args ) {

		// Clear the transient to force a check in the API.
		genesis_clear_update_transient();

		WP_CLI::runcommand( 'theme update genesis' );
		WP_CLI::runcommand( 'genesis db upgrade' );

	}
}
