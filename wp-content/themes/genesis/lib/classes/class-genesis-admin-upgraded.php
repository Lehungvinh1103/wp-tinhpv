<?php
/**
 * Genesis Framework.
 *
 * WARNING: This file is part of the core Genesis Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package Genesis\Admin
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/genesis/
 */

/**
 * Registers a new admin page, providing content and corresponding menu item for the "What's new" page.
 *
 * @package Genesis\Admin
 *
 * @since 1.9.0
 */
class Genesis_Admin_Upgraded extends Genesis_Admin_Basic {

	/**
	 * Create the page.
	 *
	 * @since 1.9.0
	 */
	public function __construct() {

		$page_id = 'genesis-upgraded';

		$menu_ops = [
			'submenu' => [
				'parent_slug' => 'admin.php',
				'menu_title'  => '',
				/* translators: %s: Genesis version. */
				'page_title'  => sprintf( __( 'Welcome to Genesis %s', 'genesis' ), PARENT_THEME_BRANCH ),
			],
		];

		$this->create( $page_id, $menu_ops );

		add_action( 'admin_enqueue_scripts', 'add_thickbox' );

	}

	/**
	 * Required to use `Genesis_Admin_Basic`.
	 *
	 * @since 1.9.0
	 */
	public function admin() {
		require_once $this->views_base . '/pages/genesis-admin-upgraded.php';
	}

}
