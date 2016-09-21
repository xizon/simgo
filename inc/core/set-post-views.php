<?php
/**
 * Theme functions
 * *
 
 --------------------------------------
 
 * Get and set post views
 *
 * This little improvement  will enable you to display how many times a post has been viewed in total. 
 * The total views are displayed in entry meta of each post.
 */
 
if ( !function_exists( 'simgo_get_post_views' ) ) {
	function simgo_get_post_views ($post_id) {
		$count_key = 'views';
		$count = get_post_meta($post_id,$count_key,true);
		if ($count == '' ) {
			delete_post_meta($post_id,$count_key);
			add_post_meta($post_id,$count_key,'0' );
			$count = '0';
		}
		return number_format_i18n($count);
	}

}

if ( !function_exists( 'simgo_set_post_views' ) ) {
	function simgo_set_post_views () {
		global $post;
		if ( get_the_ID() ){
			$post_id = get_the_ID();
			$count_key = 'views';
			$count = get_post_meta($post_id,$count_key,true);
			if (is_single() || is_page() ) {
				if ($count == '' ) {
					delete_post_meta($post_id,$count_key);
					add_post_meta($post_id,$count_key,'0' );
				} else {
					update_post_meta($post_id,$count_key,$count + 1);
				}
			}
	
		}
	}


}
add_action( 'get_header','simgo_set_post_views' );

