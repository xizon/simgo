<?php
/**
 * Theme functions
 * *
 
 --------------------------------------
 
 * Filter post tag
 *
 * Add a filter to add a class to tag link in wordpress.
 */
if ( !function_exists( 'simgo_add_tag_class' ) ) {
	function simgo_add_tag_class($links) {
		return str_replace('<a href="', '<a class="tag-list" target="_blank" href="', $links);
	}


}
add_filter( "term_links-post_tag", 'simgo_add_tag_class');
