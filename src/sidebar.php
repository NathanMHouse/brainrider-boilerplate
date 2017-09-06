<?php
/**
 * Sidebar Template
 *
 * The template for the main widget area (src)
 *
 *
 * @package Brainrider-Boilerplate
 * @since   1.0.0
 *
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
