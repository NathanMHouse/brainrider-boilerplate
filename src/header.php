<?php
/**
 * The header file (src)
 *
 *
 * @package Brainrider-Boilerplate
 * @since	1.0.0
 *
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<meta name="robots" content="noindex, nofollow">

	<?php wp_head(); ?>

	<!-- HTML5 shiv and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- [if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>

<body <?php body_class(); ?>>
<div id="page" class="site">

	<header class="site-header">

		<?php
		// Define the header menu name(s)
		$header_menu_locations = array(
			'primary',
			'secondary',
		);

		// Create variable to store header menu(s)
		$header_menus = array();

		// Create output for header menu(s) and assign to variable
		foreach ( $header_menu_locations as $location ) {

			$header_menu_locations[ $location ] = wp_nav_menu( array(
				'theme_location'	=> $location,
				'container'			=> null,
				'echo'				=> false,
				'depth'				=> 2,
				'items_wrap'		=> '<ul>%3$s</ul>',
				'fallback_cb'		=> false
			) );
		}
		?>

		<div class="container">

			<?php

			// The site branding
			?>
			<div class="site-branding">
				<?php

				// Vars
				$navigation_logo = get_field( 'navigation_logo', 'option' );
				
				// Display the logo
				if ( $navigation_logo ) { ?>

					<a href="/">
						<img src="<?php echo $navigation_logo['url']; ?>" alt="<?php echo get_bloginfo( 'name' ); ?>">
					</a>

				<?php 

				// Display the site name as text if no logo
				} else { ?>

					<h1><a href="/"><?php echo get_bloginfo( 'name' ); ?></a></h1>

				<?php } ?>
				
			</div><!-- .site-branding -->

			<?php

			// The mobile site navigation controls
			?>
			<div class="site-navigation-control">
				<a href="#" id="site-navigation-toggle">
				<?php _e( 'Menu', 'brainrider-boilerplate' ) ?>
				</a><!-- .site-navigation-toggle -->
			</div><!-- .site-navigation-control -->

			<?php

			// The site navigation
			?>
			<div class="site-navigation">

				<?

				// The secondary navigation
				?>

				<nav class="primary-navigation">
					<?php echo $header_menu_locations[ 'secondary' ]; ?>
				</nav><!-- .secondary-navigation -->

				<?php

				// Vars
				$navigation_cta_url		= get_field( 'navigation_cta_url', 'option' );
				$navigation_cta_text	= get_field( 'navigation_cta_text', 'option' );
				$navigation_cta_target	= get_field( 'navigation_cta_target', 'option' );

				// The site navigation CTA
				if ( $navigation_cta_text
					 && $navigation_cta_url ) { ?>

					<div class="navigation-cta">
						<a href="<?php echo $navigation_cta_url; ?>"
						   target="<?php echo $navigation_cta_target; ?>" 
						   class="button button-primary">
						   <?php echo $navigation_cta_text; ?>
					   	</a><!-- .button -->
					</div><!-- .navigation-cta -->

				<?php } 

				// The primary navigation
				?>
				<nav class="primary-navigation">
					<?php echo $header_menu_locations[ 'primary' ]; ?>
				</nav><!-- .primary-navigation -->
				
			</div><!-- .site-navigation -->
		</div><!-- .container -->
	</header><!-- .site-header -->

	<div id="content" class="site-content">
	