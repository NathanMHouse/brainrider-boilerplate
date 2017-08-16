<?php
/**
 * Template part for displaying page content (src)
 *
 *
 * @package Brainrider-Boilerplate
 * @since	1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="container">
		<div class="row">
			<div class="entry-content col-md-8">

				<?php 

				// The page content
				the_content(); 
				wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'brainrider-boilerplate' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'brainrider-boilerplate' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
				) );
				?>
		
				<?php 

				// The page footer
				if ( get_edit_post_link() ) : ?>
					<footer class="entry-footer">
						<?php
							edit_post_link(
								sprintf(
									wp_kses(
										/* translators: %s: Name of current post. Only visible to screen readers */
										__( 'Edit <span class="screen-reader-text">%s</span>', 'brainrider-boilerplate' ),
										array(
											'span' => array(
												'class' => array(),
											),
										)
									),
									get_the_title()
								),
								'<span class="edit-link">',
								'</span>'
							);
						?>
					</footer><!-- .entry-footer -->
				<?php endif; ?>
			</div><!-- .col -->

			<?php

			// The page sidebar
			?>
			<div class="entry-sidebar col-md-4">
				<?php get_sidebar(); ?>
			</div><!-- .entry-sidebar -->
		</div><!-- .row -->
	</div><!-- .container -->
</article><!-- #post-<?php the_ID(); ?> -->

