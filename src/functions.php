<?php
/**
 * Functions File
 *
 * Functions and definitions (src)
 *
 * @package Brainrider-Boilerplate
 *
 */

/*--------------------------------------------------------------
>>> TABLE OF CONTENTS:
----------------------------------------------------------------
?.? Theme Setup
    ?.? Set Up Theme
    ?.? Register Widget Area
    ?.? Conditionally Include Functions
    ?.? Enqueue Scripts and Styles


/*--------------------------------------------------------------
?.? Theme Setup
--------------------------------------------------------------*/
/**
 * ?.? Set Up Theme
 *
 * Sets up theme defaults and registers support for various WordPress features.
 */
if ( ! function_exists( 'br_bp_setup' ) ) :

	function br_bp_setup() {

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// Switch default core markup for search form, comment forms, and
		// comments to output valid HTML5.
		add_theme_support(
			'html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Register menu locations
		register_nav_menus(
			array(

				// Header menus
				'primary'   => __( 'Header Primary Menu', 'brainrider-boilerplate' ),
				'secondary' => __( 'Header Secondary Menu', 'brainrider-boilerplate' ),

				// Add other header menus as appropriate

				// Footer menus

				// Add footer menus as appropriate
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'br_bp_setup' );


/**
 * ?.? Register Widget Area
 *
 * Register default sidebar widget area (i.e. sidebar-1).
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function br_bp_widgets_init() {
	 register_sidebar(
		 array(
			 'name'          => esc_html__( 'Sidebar 1', 'test-project' ),
			 'id'            => 'sidebar-1',
			 'description'   => esc_html__( 'Add widgets here.', 'test-project' ),
			 'before_widget' => '<section>',
			 'after_widget'  => '</section>',
			 'before_title'  => '<h2 class="widget-title">',
			 'after_title'   => '</h2>',
		 )
	 );
}
 add_action( 'widgets_init', 'br_bp_widgets_init' );


 /**
 * ?.? Conditionally Include Functions
 *
 * Include relevant functions depending upon certain conditionals.
 *
 */
function br_bp_conditionally_include_functions() {

	 $dir = get_template_directory();

	 // Include admin functions
	if ( is_admin() ) {

		// Options pages
		include $dir . '/inc/options-pages.php';
	}
}
 br_bp_conditionally_include_functions();


/**
 * ?.? Enqueue Scripts and Styles
 *
 * Loads default styles and scripts.
 *
 */
function br_bp_scripts() {

	// Enqueue default styles.
	wp_enqueue_style( 'br_bp_styles', get_stylesheet_uri() );

	// Enqueue vendor scripts.
	wp_enqueue_script( 'br_bp_vendor_scripts', get_template_directory_uri() . '/assets/js/vendor.min.js', array(), false, true );

	// Enqueue custom scripts.
	wp_enqueue_script( 'br_bp_custom_scripts', get_template_directory_uri() . '/assets/js/custom.min.js', array(), false, true );
}
add_action( 'wp_enqueue_scripts', 'br_bp_scripts' );
