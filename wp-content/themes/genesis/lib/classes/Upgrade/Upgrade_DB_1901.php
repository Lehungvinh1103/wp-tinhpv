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

namespace StudioPress\Genesis\Upgrade;

/**
 * Upgrade class. Called when `db_version` Genesis setting is below 1901.
 *
 * @since 3.1.0
 */
class Upgrade_DB_1901 implements Upgrade_DB_Interface {
	/**
	 * Upgrade method.
	 *
	 * @since 1.9.0
	 * @since 3.1.0 Moved to class method.
	 */
	public function upgrade() {
		// Get menu locations.
		$menu_locations = get_theme_mod( 'nav_menu_locations' );

		// Clear assigned nav if nav disabled.
		if ( isset( $menu_locations['primary'] ) && $menu_locations['primary'] && ! genesis_get_option( 'nav' ) ) {
			$menu_locations['primary'] = 0;
			set_theme_mod( 'nav_menu_locations', $menu_locations );
		}

		// Clear assigned subnav if subnav disabled.
		if ( isset( $menu_locations['secondary'] ) && $menu_locations['secondary'] && ! genesis_get_option( 'subnav' ) ) {
			$menu_locations['secondary'] = 0;
			set_theme_mod( 'nav_menu_locations', $menu_locations );
		}
	}
}
