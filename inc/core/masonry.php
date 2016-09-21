<?php
/**
 * Theme functions
 * *
 
 --------------------------------------
 
 */
 
 
/**
 * Masonry support
 *
 * Note: The function will be used to .php file of theme when get_header() exist. The code could also be sought for header.php file.
 *
 * The .php file of theme contains the following standard code:
 
   add_action( 'wp_footer', 'simgo_masonry_init', 100 );
 
 */



if ( !function_exists( 'simgo_masonry_init' ) ) {
	
	function simgo_masonry_init() {
	
	    echo "
		<script>
		( function($) {
			'use strict';
				
			
			$( function() {
				
				/*! 
				 * ************************************
				 * Initialize Blog Masonry
				 *************************************
				 */
				var masonryObj = $( '#masonry-blog' );
				
				imagesLoaded( masonryObj ).on( 'always', function() {
					  masonryObj.masonry({
						itemSelector: '.post-item'
					  });
				}); 
			
			
			} ); 
		
			
			
		} ) ( jQuery );
		</script>
		";	
	
	
	}

}  

