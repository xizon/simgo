<?php
/**
 * Theme functions
 * *
 
 --------------------------------------
 
 * Get Paginate
 *
 * Support for customizable pagination styles. 
 */


/**
 * Numbered Pagination
 *
 */
if ( ! function_exists( 'simgo_pagination') ) {

	function simgo_pagination( $show=3, $custom_prev = '&larr; Previous', $custom_next = 'Next &rarr;', $li = true, $inf_enable = false, $custom_query = '' ) {
		
		
		$GLOBALS[ 'paged_temp' ] = 1;
		
		$pagehtml = '';
		
		$pageshow = '';
		
		$pagehtml_1 = '<ul class="pager">';
		
		$pagehtml_2 = '</ul>';
		

		// Get currect number of pages and define total var
		if ( $custom_query ) {
			$total = $custom_query->max_num_pages;
		} else {
			global $wp_query;
			$total = $wp_query->max_num_pages;
		}
		

		// Display pagination if total var is greater then 1 ( current query is paginated )
		if ( $total > 1 )  {

			// Set current page if not defined
			if ( ! $current_page = get_query_var( 'paged') ) {
				 $current_page = 1;
			 }

			// Get currect format
			if ( get_option( 'permalink_structure') ) {
				$format = 'page/%#%/';
			} else {
				$format = '&paged=%#%';
			}

			// Display pagination
			$paginate = paginate_links(array(
				'base'      => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
				'format'    => $format,
				'current'   => max( 1, get_query_var( 'paged') ),
				'total'     => $total,
				'mid_size'  => 2,
				'end_size'  => $show,//How many numbers on either the start and the end list edges.
				'type'      => 'array',
				'prev_text' => $custom_prev,
				'next_text' => $custom_next,
			) );
			
			if( is_array( $paginate ) ) {
				
				foreach ( $paginate as $page ) {
					
						if ($li === true){
							
							if ( strpos( $page, 'prev') ){
								$pagehtml .= '<li class="previous">'.$page.'</li>';
							}elseif ( strpos( $page, 'next' ) ){
								$pagehtml .= '<li class="next">'.$page.'</li>';
							}elseif ( strpos( $page, 'current' ) ){
								$pagehtml .= '<li class="active">'.$page.'</li>';
							}else{
								$pagehtml .= '<li>'.$page.'</li>';	
							}
							
						}else{
							
							$pagehtml_1 = '';
							$pagehtml_2 = '';
							$pagehtml .= $page;
			
							
						}

	
				}
			
			}
		
			
			$pageshow = $pagehtml_1.$pagehtml.$pagehtml_2;
			
			
			//Use Infinite Scroll
			if ( $inf_enable == true ) $pageshow = '';

			
			echo $pageshow;
			
			
			
			
		}
	}

}


/**
 * Next and previous pagination
 *
 */
if ( ! function_exists( 'simgo_pagejump' ) ) {

	function simgo_pagejump( $custom_prev = '&larr; Previous', $custom_next = 'Next &rarr;', $li = true, $inf_enable = false, $pages = '' ) {

		
		

		// Set correct paged var
		global $paged;
		

		$pageshow = '';
		
		
		if ( empty( $paged ) ) {
			$paged = 1;
		}

		// Get pages var
		if ( ! $pages ) {
			global $wp_query;
			$pages = $wp_query->max_num_pages;
			if ( ! $pages ) {
				$pages = 1;
			}
		}

		// Display next/previous pagination
		if ( 1 != $pages ) {
			
			if ($li === true){
              
				$pageshow .= '<ul class="pager"><li class="previous">';
				$pageshow .= get_previous_posts_link( $custom_prev );
				$pageshow .= '</li><li class="next">';
				$pageshow .= get_next_posts_link( $custom_next );
				$pageshow .= '</li></ul>';
	

			}else{
				
				$pageshow .= get_previous_posts_link( $custom_prev );
				$pageshow .= get_next_posts_link( $custom_next );
				
			}
				
			
		}
		

		//Use Infinite Scroll
		if ( $inf_enable == true ) $pageshow = '';
	
		
		echo $pageshow;
		
		
		
		
	}

}

/**
 * Load more button
 *
 */
if ( ! function_exists( 'simgo_loadmore' ) ) {

	function simgo_loadmore() {

		echo '<div class="pagination-infinitescroll">';
		next_posts_link( __( 'Load More', 'simgo' ) );
		echo '</div>';

		
	}

}

