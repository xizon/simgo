<?php
/**
 * Theme functions
 * *
 
 --------------------------------------
 
 * Filter admin bar
 *
 * Some menus were able to on top of WordPress admin bar.
 */

if ( !function_exists( 'simgo_filter_admin_bar' ) ) {

	function simgo_filter_admin_bar($content){
		
	     remove_action( 'wp_head', '_admin_bar_bump_cb' ); 
	
			
	}
}
add_action( 'get_header', 'simgo_filter_admin_bar' );

