<?php
/**
 * Template Name: Flexible Content
 *
 * Page template which makes use of the core flexible content setup (src)
 *
 * @package Brainrider
 * @since   1.0.0
 *
 */

get_header();

if ( have_posts() ) :

	while ( have_posts() ) :

		the_post();

		get_template_part( 'template-parts/content', 'flexible-content' );

	endwhile;

endif;

get_footer();
