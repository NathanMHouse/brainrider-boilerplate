<?php
/**
 * Content Flexible Content Template
 *
 * Content template for displaying flexible content blocks (src)
 *
 * @package Brainrider
 * @since   1.0.0
 *
 */

if ( have_rows( 'flexible_content' ) ) :

	// Row count
	$i = 0;

	while ( have_rows( 'flexible_content' ) ) :

		the_row();

		// Increment the row count
		$i++;

		// Set up the generic values
		$title            = get_sub_field( 'title' );
		$description      = get_sub_field( 'description' );
		$content          = get_sub_field( 'content' );
		$image            = get_sub_field( 'image' );
		$background_color = get_sub_field( 'background_color' );

		// Set up the content area depending on the row layout
		$row_layout = get_row_layout();

		// Create classes for the row
		$content_row_class       = "content-row-$row_layout";
		$content_row_count_class = "content-row-$i";

		// Construct the path to the expected template file
		$file_path = get_template_directory() . '/template-parts/flexible-content-' . $row_layout . '.php';

		// Check if the flexible content template file exists
		if ( file_exists( $file_path ) && is_file( $file_path ) ) {

			// Include the template file
			include $file_path;
		}

	endwhile;

endif;
