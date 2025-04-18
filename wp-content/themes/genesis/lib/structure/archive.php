<?php
/**
 * Genesis Framework.
 *
 * WARNING: This file is part of the core Genesis Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package Genesis\Archives
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/genesis/
 */

add_action( 'genesis_before_loop', 'genesis_do_taxonomy_title_description', 15 );
/**
 * Add custom heading and / or description to category / tag / taxonomy archive pages.
 *
 * If the page is not a category, tag or taxonomy term archive, or there's no term, or
 * no term meta set, then nothing extra is displayed.
 *
 * If there's a title to display, it is marked up as a level 1 heading.
 *
 * If there's a description to display, it runs through `wpautop()`,
 * `do_shortcode()` and `autoembed()` before being added to a div.
 *
 * @since 2.10.0 Filter intro text with `do_shortcode()` and `autoembed()`.
 * @since 1.3.0
 *
 * @global WP_Query $wp_query Query object.
 * @global WP_Embed $wp_embed Embed object.
 *
 * @return void Return early if not the correct archive page, or no term is found.
 */
function genesis_do_taxonomy_title_description() {

	global $wp_query, $wp_embed;

	if ( ! is_category() && ! is_tag() && ! is_tax() ) {
		return;
	}

	$term = is_tax() ? get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ) : $wp_query->get_queried_object();

	if ( ! $term ) {
		return;
	}

	$heading = get_term_meta( $term->term_id, 'headline', true );
	if ( empty( $heading ) && genesis_a11y( 'headings' ) ) {
		$heading = $term->name;
	}

	$intro_text = get_term_meta( $term->term_id, 'intro_text', true );
	$intro_text = $wp_embed->autoembed( $intro_text );
	$intro_text = do_shortcode( $intro_text );
	$intro_text = wpautop( $intro_text );

	/**
	 * Filter the archive intro text.
	 *
	 * @since 1.9.0
	 *
	 * @param string $intro_text The current archive intro text.
	 */
	$intro_text = apply_filters( 'genesis_term_intro_text_output', $intro_text ?: '' );

	/**
	 * Fires at end of doing taxonomy archive title and description.
	 *
	 * Allows you to reorganize output of the archive headings.
	 *
	 * @since 2.5.0
	 *
	 * @param string $heading    Archive heading.
	 * @param string $intro_text Archive intro text.
	 * @param string $context    Context.
	 */
	do_action( 'genesis_archive_title_descriptions', $heading, $intro_text, 'taxonomy-archive-description' );

}

add_filter( 'genesis_author_intro_text_output', 'wpautop' );
add_action( 'genesis_before_loop', 'genesis_do_author_title_description', 15 );
/**
 * Add custom headline and description to author archive pages.
 *
 * If we're not on an author archive page, then nothing extra is displayed.
 *
 * If there's a custom headline to display, it is marked up as a level 1 heading.
 *
 * If there's a description (intro text) to display, it is run through `wpautop()` before being added to a div.
 *
 * @since 1.4.0
 *
 * @return void Return early if not author archive.
 */
function genesis_do_author_title_description() {

	if ( ! is_author() ) {
		return;
	}

	$heading = get_the_author_meta( 'headline', (int) get_query_var( 'author' ) );

	if ( empty( $heading ) && genesis_a11y( 'headings' ) ) {
		$heading = get_the_author_meta( 'display_name', (int) get_query_var( 'author' ) );
	}

	$intro_text = get_the_author_meta( 'intro_text', (int) get_query_var( 'author' ) );
	$intro_text = apply_filters( 'genesis_author_intro_text_output', $intro_text ?: '' );

	/** This action is documented in lib/structure/archive.php */
	do_action( 'genesis_archive_title_descriptions', $heading, $intro_text, 'author-archive-description' );

}

add_action( 'genesis_before_loop', 'genesis_do_author_box_archive', 15 );
/**
 * Add author box to the top of author archive.
 *
 * If the headline and description are set to display the author box appears underneath them.
 *
 * @since 1.4.0
 *
 * @see genesis_do_author_title_and_description Author title and description.
 *
 * @return void Return early if not author archive or not page one.
 */
function genesis_do_author_box_archive() {

	if ( ! is_author() || get_query_var( 'paged' ) >= 2 ) {
		return;
	}

	if ( get_the_author_meta( 'genesis_author_box_archive', get_query_var( 'author' ) ) ) {
		genesis_author_box( 'archive' );
	}

}

add_filter( 'genesis_cpt_archive_intro_text_output', 'wpautop' );
add_action( 'genesis_before_loop', 'genesis_do_cpt_archive_title_description' );
/**
 * Add custom headline and description to relevant custom post type archive pages.
 *
 * If we're not on a post type archive page, then nothing extra is displayed.
 *
 * If there's a custom headline to display, it is marked up as a level 1 heading.
 *
 * If there's a description (intro text) to display, it is run through wpautop() before being added to a div.
 *
 * @since 2.0.0
 *
 * @return void Return early if not on post type archive or post type does not
 *              have `genesis-cpt-archives-settings` support
 */
function genesis_do_cpt_archive_title_description() {

	if ( ! is_post_type_archive() || ! genesis_has_post_type_archive_support() ) {
		return;
	}

	$heading = genesis_get_cpt_option( 'headline' );

	if ( empty( $heading ) && genesis_a11y( 'headings' ) ) {
		$heading = post_type_archive_title( '', false );
	}

	$intro_text = genesis_get_cpt_option( 'intro_text' );
	$intro_text = apply_filters( 'genesis_cpt_archive_intro_text_output', $intro_text ?: '' );

	/** This action is documented in lib/structure/archive.php */
	do_action( 'genesis_archive_title_descriptions', $heading, $intro_text, 'cpt-archive-description' );

}

add_action( 'genesis_before_loop', 'genesis_do_date_archive_title' );
/**
 * Add custom heading to date archive pages.
 *
 * If we're not on a date archive page, then nothing extra is displayed.
 *
 * @since 2.2.0
 *
 * @return void Return early if not on date archive.
 */
function genesis_do_date_archive_title() {

	if ( ! is_date() ) {
		return;
	}

	if ( is_day() ) {
		$heading = __( 'Archives for ', 'genesis' ) . get_the_date();
	} elseif ( is_month() ) {
		$heading = __( 'Archives for ', 'genesis' ) . single_month_title( ' ', false );
	} elseif ( is_year() ) {
		$heading = __( 'Archives for ', 'genesis' ) . get_query_var( 'year' );
	}

	/** This action is documented in lib/structure/archive.php */
	do_action( 'genesis_archive_title_descriptions', $heading, '', 'date-archive-description' );

}

add_action( 'genesis_before_loop', 'genesis_do_blog_template_heading' );
/**
 * Add custom heading and description to blog template pages.
 *
 * If we're not on a blog template page, then nothing extra is displayed.
 *
 * @since 2.2.0
 *
 * @return void Return early if not on blog template archive, or `headings` is not
 *              enabled for Genesis accessibility.
 */
function genesis_do_blog_template_heading() {

	if (
		! is_page_template( 'page_blog.php' )
		|| ! genesis_a11y( 'headings' )
		|| get_queried_object_id() === get_option( 'page_for_posts' )
	) {
		return;
	}

	printf( '<div %s>', genesis_attr( 'blog-template-description' ) );
		genesis_do_post_title();
	echo '</div>';

}

add_action( 'genesis_before_loop', 'genesis_do_posts_page_heading' );
/**
 * Add custom heading to assigned posts page.
 *
 * If we're not on a posts page, then nothing extra is displayed.
 *
 * @since 2.2.1
 *
 * @return void Return early if `headings` is not enabled for Genesis accessibility, there is no
 *              page for posts assigned, this is not the home (posts) page, or this is not the page found at `/`.
 */
function genesis_do_posts_page_heading() {

	if ( ! genesis_a11y( 'headings' ) ) {
		return;
	}

	$posts_page = get_option( 'page_for_posts' );

	if ( null === $posts_page ) {
		return;
	}

	if ( ! is_home() || genesis_is_root_page() ) {
		return;
	}

	if ( genesis_entry_header_hidden_on_current_page() ) {
		return;
	}

	/** This action is documented in lib/structure/archive.php */
	do_action( 'genesis_archive_title_descriptions', get_the_title( $posts_page ), '', 'posts-page-description' );

}

add_action( 'genesis_archive_title_descriptions', 'genesis_do_archive_headings_open', 5, 3 );
/**
 * Add open markup for archive headings to archive pages.
 *
 * @since 2.5.0
 *
 * @param string $heading    Optional. Archive heading, default is empty string.
 * @param string $intro_text Optional. Archive intro text, default is empty string.
 * @param string $context    Optional. Archive context, default is empty string.
 */
function genesis_do_archive_headings_open( $heading = '', $intro_text = '', $context = '' ) {

	if ( $heading || $intro_text ) {

		genesis_markup(
			[
				'open'    => '<div %s>',
				'context' => $context,
			]
		);

	}
}

add_action( 'genesis_archive_title_descriptions', 'genesis_do_archive_headings_close', 15, 3 );
/**
 * Add close markup for archive headings to archive pages.
 *
 * @since 2.5.0
 *
 * @param string $heading    Optional. Archive heading, default is empty string.
 * @param string $intro_text Optional. Archive intro text, default is empty string.
 * @param string $context    Optional. Archive context, default is empty string.
 */
function genesis_do_archive_headings_close( $heading = '', $intro_text = '', $context = '' ) {

	if ( $heading || $intro_text ) {

		genesis_markup(
			[
				'close'   => '</div>',
				'context' => $context,
			]
		);

	}
}

add_action( 'genesis_archive_title_descriptions', 'genesis_do_archive_headings_headline', 10, 3 );
/**
 * Add headline for archive headings to archive pages.
 *
 * @since 2.5.0
 *
 * @param string $heading    Optional. Archive heading, default is empty string.
 * @param string $intro_text Optional. Archive intro text, default is empty string.
 * @param string $context    Optional. Archive context, default is empty string.
 */
function genesis_do_archive_headings_headline( $heading = '', $intro_text = '', $context = '' ) {

	if ( $context && $heading ) {
		printf( '<h1 %s>%s</h1>', genesis_attr( 'archive-title' ), esc_html( wp_strip_all_tags( $heading ) ) );
	}

}

add_action( 'genesis_archive_title_descriptions', 'genesis_do_archive_headings_intro_text', 12, 3 );
/**
 * Add intro text for archive headings to archive pages.
 *
 * @since 2.5.0
 *
 * @param string $heading    Optional. Archive heading, default is empty string.
 * @param string $intro_text Optional. Archive intro text, default is empty string.
 * @param string $context    Optional. Archive context, default is empty string.
 */
function genesis_do_archive_headings_intro_text( $heading = '', $intro_text = '', $context = '' ) {

	if ( $context && $intro_text ) {
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo $intro_text;
	}

}
