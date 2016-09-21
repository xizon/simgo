<?php
/**
 * Theme functions
 * *
 
 --------------------------------------
 
 */
 
 
/**
 * Changing excerpt more
 */
  

if ( ! function_exists( 'simgo_modify_read_more_link' ) ) {
	
	function simgo_modify_read_more_link($more) {
	    
		return '<p class="more-link-container"><a href="' . get_permalink() . '" class="more-link">' .__( 'Continue reading', 'simgo' ). '</a></p>';
		
	}
	
}
add_filter( 'the_content_more_link', 'simgo_modify_read_more_link' );

 
/**
 * List categories for specific taxonomy
 * 
 * @link    http://codex.wordpress.org/Function_Reference/wp_get_post_terms
 * @since   1.0.0
 */
if ( ! function_exists( 'simgo_list_post_terms' ) ) {

    function simgo_list_post_terms( $taxonomy = 'category', $echo = true ) {
		
		
			$list_terms = array();
			$terms      = wp_get_post_terms( get_the_ID(), $taxonomy );
			
			if ( is_array ( $terms ) ) {
				
				foreach ( $terms as $term ) {
					$permalink      = get_term_link( $term->term_id, $taxonomy );
					$list_terms[]   = '<a href="'. $permalink .'" title="'. $term->name .'">'. $term->name .'</a>';
				}
				if ( ! $list_terms ) {
					return;
				}
				$list_terms = implode( ', ', $list_terms );
				if ( $echo ) {
					echo $list_terms;
				} else {
					return $list_terms;
				}
				
				
			}

		
    }
    
}

/**
 * Custom excerpts based on wp_trim_words
 *
 * @since	1.0.0
 * @link	http://codex.wordpress.org/Function_Reference/wp_trim_words
 */
if ( ! function_exists( 'simgo_excerpt' ) ) {

	function simgo_excerpt( $length = 150, $readmore = false ) {

		// Get global post
		global $post;

		// Get post data
		$id			    = $post->ID;
		$excerpt	    = $post->post_excerpt;
		$content        = get_the_content( $id );
		$readmore_link = '';
		
		//returns tags @link	http://codex.wordpress.org/Function_Reference/get_the_tags
		$tags = get_the_tags();
		$output_tags = '';
		if ( $tags ) {
			$output_tags .= '<p class="post-tags" itemprop="keywords">';
			foreach ( $tags as $tag ){
				
				$tag_link = get_tag_link( $tag->term_id );
		
				$output_tags .= "<a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug}'>";
				$output_tags .= "{$tag->name}</a>";
				
			}
			$output_tags .= '</p>';
		}

		
		
		//More button
		if ( $readmore == true ) {
			$btn_text	= apply_filters( 'simgo_redmore_text', __( 'Continue reading', 'simgo' ) );
			$btn_link	= '<p class="more-link-container"><a href="'. get_permalink( $id ) .'" class="more-link">'. $btn_text .'</a></p>';
			$readmore_link = apply_filters( 'simgo_redmore_link', $btn_link );
		}
		
	
		if ( $excerpt ) {
			/**
			 * Display custom excerpt
			 *
			 * @since	1.0.0
			 */		
			$output = $excerpt;
			
			if ( simgo_has_ultimate_excerpt( $output, $content ) ) {
				$readmore_link = '';
			}
	
			$output .= $readmore_link;
			
			echo $output;
			
		} elseif ( strpos( $post->post_content, '<!--more-->' ) ) {

			/**
			 * Check for more tag
			 *
			 * @since	1.0.0
			 */			
			the_content();
			
		} else {

			/**
			 * Generate auto excerpt
			 *
			 * @since	1.0.0
			 */
			 
			$wp_media_suffix = 'mp3|m4a|ogg|wav|mp4|m4v|mov|wmv|avi|mpg|ogv|3gp|3g2';
			
			// capture the post content with html
			ob_start();
				the_content();
				$out = ob_get_contents();
			ob_end_clean();
			
			//Determine whether content includes media element
			$fr = 'rame';
			$md = explode( '|', $wp_media_suffix);
			
			//remove wp media
			if ( strpos( $out, 'if'.$fr ) ) {
				$content = preg_replace( '/<if'.$fr.'.*<\/if'.$fr.'>/i', '', $out ); 
			}
			
			 
			//strip shortcodes
			$content = strip_shortcodes( $content );
			
			//Determine whether content includes chinese
			if ( preg_match('/[\p{Han}]/simu', $content ) ) {
				$output = wp_html_excerpt( $content, $length, '...' );
			} else {
				$output = wp_trim_words( $content, $length );
			}
			
			//remove hyperlink for video and audio
			if ( ! strpos( $out, 'if'.$fr ) ) {
				foreach( $md as $v ) {
					if ( strpos( $out, $v ) ) {
						$output = preg_replace( '/(http)(.)*([a-z0-9\-\.\_])+\.('.$wp_media_suffix.')/i', '', $output );
						break;
					}
					
				}
			}
			
			if ( empty( $output ) || simgo_has_ultimate_excerpt( $output, get_the_content( $id ) ) ) {
				$readmore_link = '';
			}
	
	
			$output .= $readmore_link;
			
			echo $output;
			
		}


	}
}


//Detect If the "ultimate excerpt" is empty
if ( ! function_exists( 'simgo_has_ultimate_excerpt' ) ) {

	function simgo_has_ultimate_excerpt( $str1, $str2 ) {

		if ( mb_strlen( wp_strip_all_tags( $str1, true ), 'UTF8' ) >= mb_strlen( wp_strip_all_tags( $str2, true), 'UTF8' )  ) {
			return true;
		} else {
			return false;
		}


	}
}

