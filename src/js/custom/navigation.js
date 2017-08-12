/**
 * Description:     Navigation Scripts
 * Author:          Brainrider
 * Author URI:      http://brainrider.com
*/


/*--------------------------------------------------------------
>>> TABLE OF CONTENTS:
----------------------------------------------------------------
1.0 Mobile Navigation Toggle


/*--------------------------------------------------------------
?.? Mobile Navigation Toggle
--------------------------------------------------------------*/
jQuery( document ).ready( function( $ ) {

	'use strict';
	
	$( '#site-navigation-toggle' ).on( 'click', function( e ) {

		// Prevent default link click
		e.preventDefault();

		// Add open class to toggle 
		$( '#site-navigation-toggle' ).toggleClass( 'open' );

		// Slide out/in navigation
		$( '.site-navigation' ).slideToggle( 250 );
	} );
} );