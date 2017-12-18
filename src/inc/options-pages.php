<?php
/**
 * Add ACF option pages (src)
 *
 * This file is only included in the admin interface
 *
 * @package Brainrider-Boilerplate
 * @since	1.0.0
 */

/**
 * Register options pages for ACF fields
 *
 * @since	1.0.0
 * @return	void
 */
function br_bp_add_options_pages() {

	// Only add options pages in the admin
	if ( ! is_admin() ) {
		return;
	}

	// Check to make sure ACF is loaded
	if ( ! function_exists( 'acf_add_options_page' ) ) {
		return;
	}

	// Create the main menu entry (i.e. theme settings)
	$args = array(
		'page_title'	=> 'Theme Settings',
		'menu_title'	=> 'Theme_Settings',
		'menu_slug'		=> 'br_bp_theme_settings',
		'capability'	=> 'manage_options',
	);
	acf_add_options_page( $args );

	$args = array(
			'page_title'	=> 'Header Settings',
			'menu_title'	=> 'Header Settings',
			'menu_slug'		=> 'br_header_settings',
			'capability'	=> 'manage_options',
			'parent_slug'	=> 'br_bp_theme_settings',

	);
	acf_add_options_sub_page( $args );

	// Add other ACF pages and subpages as needed
	// ...
}
add_action( 'init', 'br_bp_add_options_pages' );
