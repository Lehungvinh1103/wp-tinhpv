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
 * Upgrade class. Called when `db_version` Genesis setting is below 2700.
 *
 * @since 3.1.0
 */
class Upgrade_DB_2700 implements Upgrade_DB_Interface {
	/**
	 * Upgrade method.
	 *
	 * @since 2.7.0
	 * @since 3.1.0 Moved to class method.
	 */
	public function upgrade() {
		delete_option( 'genesis-scribe-nag-disabled' );
	}
}
