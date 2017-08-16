<?php
/**
 * The template for displaying all pages (src)
 *
 *
 * @package Brainrider-Boilerplate
 * @since	1.0.0
 *
 */

get_header();
	if ( have_posts() ) :

		// Get page title
		get_template_part( 'template-parts/module', 'title' );

		while ( have_posts() ) : the_post();

			// Get page content
			get_template_part( 'template-parts/content', 'page' );

		endwhile;
	endif;
get_footer();
