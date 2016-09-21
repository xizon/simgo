<?php
/**
 * Theme functions
 * *
 
 --------------------------------------
 
 * Filter thumbnail 
 *
 * Remove image dimension attributes
 */

if ( !function_exists( 'simgo_remove_thumbnail_dimensions' ) ) {
	function simgo_remove_thumbnail_dimensions( $html, $post_id, $post_image_id, $post_thumbnail ) {
		
		if ( $post_thumbnail== 'post-thumbnail' || $post_thumbnail== 'post-thumbnail-large' ){
			$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
		}
		return $html;
	}
}
add_filter( 'post_thumbnail_html', 'simgo_remove_thumbnail_dimensions', 10, 4 );