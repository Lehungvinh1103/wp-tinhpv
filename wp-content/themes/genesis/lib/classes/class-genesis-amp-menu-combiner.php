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
 * Genesis AMP Menu Combiner
 *
 * @since 3.0.0
 */
class Genesis_AMP_Menu_Combiner extends AMP_Base_Sanitizer {

	/**
	 * XPath.
	 *
	 * @var DOMXPath
	 */
	protected $xpath;

	/**
	 * Main Menu element.
	 *
	 * @var DOMElement
	 */
	protected $main_menu;

	/**
	 * Array of menu(s) to combine with the main menu.
	 *
	 * @var array
	 */
	protected $menus_to_combine;

	/**
	 * Fix up core themes to do things in the AMP way.
	 *
	 * @since 3.0.0
	 */
	public function sanitize() {

		if ( ! isset( $this->args['combine'] ) ) {
			return;
		}

		$this->xpath = new DOMXPath( $this->dom );

		$this->combine();
	}

	/**
	 * Combine the menus.
	 *
	 * @since 3.0.0
	 */
	protected function combine() {

		$this->menus_to_combine = $this->args['combine'];

		// Bail out if we didn't find the main menu.
		if ( ! $this->find_main_menu() ) {
			return;
		}

		$this->find_and_combine();
	}

	/**
	 * Find the main menu.
	 *
	 * @since 3.0.0
	 *
	 * @return bool `true` when main menu found; else `false`.
	 */
	protected function find_main_menu() {

		$main_menu_attribute = array_shift( $this->menus_to_combine );
		$this->main_menu     = $this->find_nav_ul( $main_menu_attribute );

		return ! empty( $this->main_menu );

	}

	/**
	 * Find and combine the nav menu items to the main menu.
	 *
	 * @since 3.0.0
	 */
	protected function find_and_combine() {

		foreach ( $this->menus_to_combine as $attribute ) {
			$nav_menu = $this->find_nav_ul( $attribute );
			if ( ! $nav_menu ) {
				continue;
			}

			// Clone to avoid removing from current menu.
			$menu_items = $nav_menu->cloneNode( true );

			// Combine the menu items with the main menu.
			// phpcs:disable WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
			for ( $index = 0; $index < $menu_items->childNodes->length; $index++ ) {
				$menu_item = $menu_items->childNodes->item( $index );

				// Skip if this is not an element node.
				if ( ! ( $menu_item instanceof DOMElement ) ) {
					continue;
				}

				// Set a class attribute to hide when viewport is larger than responsive width.
				$menu_item->setAttribute( 'class', 'genesis-amp-combined ' . $menu_item->getAttribute( 'class' ) );

				$this->main_menu->appendChild( $menu_item );
			}
			// phpcs:enable
		}

	}

	/**
	 * Find the nav menu's `<ul>` by it's `id` or `class` attribute.
	 *
	 * @since 3.0.0
	 *
	 * @param string $attribute Nav menu's `id` or `class` attribute.
	 *
	 * @return bool|DOMNode Nav's `<ul>` element upon success; else `false`.
	 */
	protected function find_nav_ul( $attribute ) {

		if ( '.' === $attribute[0] ) {
			$pattern = sprintf( 'contains( @class, "%s" )', ltrim( $attribute, '.' ) );
		} elseif ( '#' === $attribute[0] ) {
			$pattern = sprintf( '@id = "%s"', ltrim( $attribute, '#' ) );
		} else {
			return false;
		}

		return $this->xpath->query( "//nav[ $pattern ]//ul | //nav[ $pattern ]//div//ul" )->item( 0 );

	}
}
