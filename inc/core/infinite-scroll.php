<?php
/**
 * Theme functions
 * *
 
 --------------------------------------
 
 */
 
 
/**
 * Infinite scroll support
 *
 * Infinite scroll allows you automatically load new content into view when a reader approaches the bottom of the page. 
 * Note: The function will be used to .php file of theme when get_header() exist. The code could also be sought for header.php file.
 *
 * The .php file of theme contains the following standard code:
 
   add_action( 'wp_footer', 'simgo_infinite_scroll_init', 100 );
 
 */


if ( !function_exists( 'simgo_infinite_scroll_init' ) ) {
	
	function simgo_infinite_scroll_init() {
		
		$vars = '
		        var blog_inscrollbox             = "#infinite-scroll-content",
				    blog_inscrollloop            = ".infinite-scroll-list",
				    blog_inscrollNext            = ".pagination-infinitescroll",
					blog_inscrollNextActiveClass = "anim-move-waiting-stripes",
					blog_inscrollNextActiveTxt   = "'.__( 'Loading...', 'simgo' ).'",
					blog_inscrollNextDefaultTxt  = "'.__( 'Load More', 'simgo' ).'",
					blog_loadSpeed               = 300,
					blog_preventList             = false;

					';
				
		$layout = get_theme_mod( 'custom_blog_layout', 'standard' );
	
	
		$inscroll_masonrySCript = '';
		if ( $layout == 'masonry' ) {
			$inscroll_masonrySCript = "
			
				var masonryObj = $( '#masonry-blog' );
				masonryObj.masonry( 'appended', result, true );
			
			";
		
		}	
			
				
				
		$successActFun = '
					$( blog_inscrollbox ).append( result.fadeIn( blog_loadSpeed ) );
					$( blog_inscrollNext ).find( "a" ).removeClass( blog_inscrollNextActiveClass ).text( blog_inscrollNextDefaultTxt );
					if ( nextHref != undefined ) {
						$( blog_inscrollNext ).find( "a" ).attr( "href", nextHref );
					} else {
						$( blog_inscrollNext ).remove();
					}
					
			
					/*! 
					 *************************************
					 * Callback
					 *************************************
					 */	
					 
					 '.$inscroll_masonrySCript.'


					 
		';			
				
				
		$successAct = '
		
		        var result = $( data ).find( blog_inscrollbox + " " + blog_inscrollloop ),
					nextHref = $( data ).find( blog_inscrollNext + " a" ).attr( "href" );
					
				imagesLoaded( result ).on( "always", function() {
					'.$successActFun.'
				});
				
				blog_preventList = false;
			
		';
		
		
		$autoJs = '
			<script>
			
			    '.$vars.'
			
				( function($) {
					"use strict";
					
						 $( window ).bind( "scroll", function() {
								
								if ( $( blog_inscrollNext ).css( "display" ) === "block" && blog_preventList === false ){
									
									if( $( window ).scrollTop() == $( document ).height() - $( window ).height() ){
										
										blog_preventList = true;
							
										$( blog_inscrollNext ).find( "a" ).addClass( blog_inscrollNextActiveClass ).text( blog_inscrollNextActiveTxt );
	
										$.ajax({
											type: "POST",
											url: $( blog_inscrollNext ).find( "a" ).attr( "href" ),
											success: function( data ) {
												
												'.$successAct.'
											}
										});
										
								
									}

								}
								
							});	

				
				} ) ( jQuery );


			</script>

		';


		$buttonJs = '
			<script>
			
			    '.$vars.'
			
				( function($) {
					"use strict";
						
					$( document ).ready( function() {
						
							$( blog_inscrollNext ).find( "a" ).live( "click", function() {
								
								if ( $( blog_inscrollNext ).css( "display" ) === "block" && blog_preventList === false ){
									
									blog_preventList = true;
									
									$( this ).addClass( blog_inscrollNextActiveClass ).text( blog_inscrollNextActiveTxt );
									
									$.ajax({
										type: "POST",
										url: $( this ).attr( "href" ),
										success: function( data ) {
	
											
											'.$successAct.'
											
											
										}
									});
									
								}
								
								return false;
								
								
							});

				
					} ); 
				
				} ) ( jQuery );

			
				
			</script>

		';
		
		
		//Determine if theres pagination
		$prev_link = get_previous_posts_link( '' );
		$next_link = get_next_posts_link( '' );
		if ( $prev_link == '' && $next_link == '' ) {
			$autoJs = '';
			$buttonJs = '';
		}
		

		//Output
		if ( !is_singular() ) {

			 if ( get_theme_mod( 'custom_blog_infinitescroll_list', false ) ) {
				if ( get_theme_mod( 'custom_blog_infinitescroll_eff', false ) ) {
					 //if true
					 echo $autoJs;
				} else {
					//if false
					echo $buttonJs;	
				}
	 
			 }
				 
	
		}
	}

}  






