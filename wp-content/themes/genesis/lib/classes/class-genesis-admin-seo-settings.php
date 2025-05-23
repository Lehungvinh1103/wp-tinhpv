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
 * Registers a new admin page, providing content and corresponding menu item for the SEO Settings page.
 *
 * Although this class was added in 1.8.0, some of the methods were originally standalone functions added in previous
 * versions of Genesis.
 *
 * @package Genesis\Admin
 *
 * @since 1.8.0
 */
class Genesis_Admin_SEO_Settings extends Genesis_Admin_Basic {

	/**
	 * Create an admin menu item and settings page.
	 *
	 * @since 1.8.0
	 */
	public function __construct() {

		$this->redirect_to = admin_url( 'customize.php?autofocus[panel]=genesis-seo' );

		$page_id = 'seo-settings';

		$menu_ops = [
			'submenu' => [
				'parent_slug' => 'genesis',
				'page_title'  => __( 'Genesis - SEO Settings', 'genesis' ),
				'menu_title'  => __( 'SEO Settings', 'genesis' ),
			],
		];

		$settings_field = GENESIS_SEO_SETTINGS_FIELD;

		$this->create( $page_id, $menu_ops );
	}

	/**
	 * Required to use `Genesis_Admin_Basic`.
	 *
	 * @since 3.0
	 */
	public function admin() {}
}
