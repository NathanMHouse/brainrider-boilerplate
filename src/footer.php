<?php
/**
 * Footer Template
 *
 * The template for displaying the footer (src)
 *
 *
 * @package Brainrider-Boilerplate
 * @since   1.0.0
 *
 */

?>

	</div><!-- #content -->

	<footer class="site-footer">
		<div class="container">

			<?php

			// The footer logo
			?>
			<div class="row">

				<?php

				// Vars
				$footer_logo = get_field( 'footer_logo', 'option' );

				// Display the footer logo
				if ( $footer_logo ) {
				?>
					<div class="col-md-12">
						<img src="<?php echo esc_attr( $footer_logo['url'] ); ?>" 
							 alt="<?php echo esc_attr( $footer_logo['alt'] ); ?>"
							 class="footer-logo">
					  </div><!-- .col -->
				<?php

				// Else if no logo found, just display site name
				} else {
				?>
					<h2><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h2>
				<?php } ?>
			</div><!-- .row -->

			<div class="row">

				<?php

				// The footer menus setup

				// Define an array of menu location slugs for footer
				$footer_menu_locations = array(
					'footer_primary',
					'footer_secondary',

					// Add additional menus as needed...
				);

				// Get all the menus in order to look up the title
				$all_menus = wp_get_nav_menus();

				// Get all menu locations
				$all_locations = get_nav_menu_locations();

				// Store the footer menus
				$footer_menus = array();

				// Loop through array of defined footer menu locations
				foreach ( $footer_menu_locations as $location ) {

					// Get the menu
					$footer_menus[ $location ]['menu'] = wp_nav_menu(
						array(
							'theme_location'    => $location,
							'container'         => null,
							'echo'              => false,
							'depth'             => 1,
							'items_wrap'        => '%3$s',
							'fallback_cb'       => false,
						)
					);
				}

				// The footer menus setup (social)

				// Get the ACF field group
				$footer_social_media = get_field( 'footer_social_media', 'option' );

				// Define a list of supported social media services
				$social_media_services = array(
					'facebook',
					'twitter',
					'linkedin',
					'youtube_play',

					// Add aditional social services as needed...
				);

				// Create empty var to contain our social menu output
				$social_menu = '';

				// Check if a URL has been provided for the service
				foreach ( $social_media_services as $service ) {

					// Get the URL
					$link = $footer_social_media[ $service ];

					if ( $link ) {

						// Build the menu item
						$social_menu .= '<li><a href="' . $link . '"<i class="fa fa-lg fa-';
						$social_menu .= str_replace( '_', '-', $service );
						$social_menu .= '"</i></a></li> ';
					}
				}
				?>

				<?php

				// Check if footer menus exist
				if ( $footer_menus['footer_primary']['menu']
					 || $footer_menus['footer_secondary']['menu']
					 || $social_menu ) {
				?>
					<div class="footer-menus col-md-8 col-md-push-4">
						<div class="row">

							<?php

							// The footer primary menu
							if ( $footer_menus['footer_primary_top']['menu'] ) {
							?>
								<div class="col-md-4">
									<ul class="footer-primary footer-list-menu">
										<?php
										echo wp_kses(
											$footer_menus['footer_primary']['menu'],
											array(
												'ul' => array(
													'class' => array(),
												),
												'li' => array(
													'id'    => array(),
													'class' => array(),
												),
												'a'  => array(
													'href'  => array(),
												),
											)
										);
										?>
									</ul><!-- .footer-primary-top -->
								</div><!-- .col -->
							<?php
							}

							// The footer secondary menu
							if ( $footer_menus['footer_secondary']['menu'] ) {
							?>
								<div class="col-md-4">
									<ul class="footer-secondary footer-list-menu">
										<?php
										echo wp_kses(
											$footer_menus['footer_secondary']['menu'],
											array(
												'ul' => array(
													'class' => array(),
												),
												'li' => array(
													'id'    => array(),
													'class' => array(),
												),
												'a'  => array(
													'href'  => array(),
												),
											)
										);
										?>
									</ul><!-- .footer-secondary -->
								</div><!-- .col -->
							<?php
							}

							// The social menu
							if ( $social_menu ) {
							?>
								<div class="col-md-4">
									<ul class="footer-social">
										<?php
										echo wp_kses(
											$social_menu,
											array(
												'li' => array(
													'class' => array(),
												),
												'a'  => array(
													'href'  => array(),
												),
												'i'  => array(
													'class' => array(),
												),
											)
										);
										?>
									</ul><!-- .footer-social -->
								</div><!-- .col -->
							<?php } ?>

						</div><!-- .row -->
					</div><!-- .footer-menus -->

				<?php
				}

				// The footer contact details
				?>
				<div class="footer-contact-details col-md-4 col-md-pull-8">

					<ul class="footer-address">
						<li><?php echo 'Address - replace w/ ACF values'; ?></li>
						<li><?php echo 'Address - replace w/ ACF values'; ?></li>
						<li><?php echo 'Address - replace w/ ACF values'; ?></li>
						<?php

						// Add lines as needed
						?>
					</ul><!-- .footer-address -->
				
					<div class="footer-copyright">
						<?php echo 'Copyright - Replace w/ ACF values'; ?>
					</div><!-- .footer-copyright -->
						
				</div><!-- .footer-contact-details -->

			</div><!-- .row -->

		</div><!-- .container -->
	</footer><!-- .site-footer -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
