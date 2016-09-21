<?php
/**
 * Theme functions
 * *
 
 --------------------------------------
 
 * Canonical
 *
 * Canonical SEO Content syndication add-on adds rel=canonical tag for content syndication. 
 * The meta box is added at front-end page.
 * The code added here is injected into the <head> tag on every page in your site.
 */

if ( !function_exists( 'simgo_add_rel_canonical' ) ) {
	function simgo_add_rel_canonical($para='meta' ) {
	
		global $post;
		$_c = '';
		
		
		if ( is_single() || is_page() ) {
			$_c =  '<link rel="canonical" href="'.get_permalink( get_the_ID() ).'" />'."\n";
			if ($para == 'url' ) $_c = get_permalink( get_the_ID() );
		}
		if ( is_home() || is_front_page() ) {
			$_c =  '<link rel="canonical" href="'.home_url( '/' ).'" />'."\n";
			if ($para == 'url' ) $_c = home_url('/');
		}
		if ( is_category() || is_category() && is_paged() ) {
			$_c =  '<link rel="canonical" href="'.get_category_link(get_query_var( 'cat' ) ).'" />'."\n";
			if ($para == 'url' ) $_c = get_category_link(get_query_var( 'cat' ) );
		}
		if ( is_tag() || is_tag() && is_paged() ) {
			$_c =  '<link rel="canonical" href="'.get_term_link(get_query_var( 'tag' ), 'post_tag' ).'" />'."\n";
			if ($para == 'url' ) $_c = get_term_link(get_query_var( 'tag' ), 'post_tag' );
		}
		if ( is_search() || is_search() && is_paged() ) {
			$_c =  '<link rel="canonical" href="'.get_search_link(get_query_var( 'search' ) ).'" />'."\n";
			if ($para == 'url' ) $_c = get_search_link(get_query_var( 'search' ) );
		}
		if ( is_author() ) {
			$_c =  '<link rel="canonical" href="'.esc_url(get_author_posts_url(get_the_author_meta( 'ID' ) )).'" />'."\n";
			if ($para == 'url' ) $_c = esc_url(get_author_posts_url(get_the_author_meta( 'ID' ) ));
		}
		if ( is_date() ) {
			$_c =  '<link rel="canonical" href="'.get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d')).'" />'."\n";
			if ($para == 'url' ) $_c = get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d'));
		}
		
		if ( $_c == '' ) {
			$cururl = Simgo_Core::cur_uri();
			if ( is_paged() ) {
				
				if ( strpos( $cururl, '&paged=') ){
					$cururl_new = explode( '&paged=', $cururl );
					$cururl = $cururl_new[0];
					
				}
				
				
				if ( strpos( $cururl, '/page') ){
					$cururl_new = explode( '/page', $cururl );
					$cururl = $cururl_new[0];
				}
				
		
				
			}
			$_c =  '<link rel="canonical" href="'.$cururl.'" />'."\n";
			if ($para == 'url' ) $_c = $cururl;
		}
		
			
		if ( !get_theme_mod( 'custom_seo_canonical2', true ) ) {
			//if false
		    $_c = '';
		} 
				
	
		
	
		//output
		if ($para == 'url' ){
			return $_c;
		}else{
			echo $_c;
		}
		
		
	}
}  
add_action( 'wp_head', 'simgo_add_rel_canonical' );
remove_action( 'wp_head', 'rel_canonical' );// Display the canonical (Use new canonical tag)
