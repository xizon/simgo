<?php
/**
 * Common functions
 * *
 
 */

class Simgo_Core {
	

	/*
	 * Sends an X-PJAX header
	 * @since Simgo 1.0
	 *
	 */
	public static function is_pjax() {

	  return array_key_exists( 'HTTP_X_PJAX', $_SERVER) && $_SERVER['HTTP_X_PJAX'];

	}
	
	/*
	 * Enqueue inline Javascript. @see wp_enqueue_script().
	 * 
	 * KNOWN BUG: Inline scripts cannot be enqueued before 
	 *  any inline scripts it depends on, (unless they are
	 *  placed in header, and the dependant in footer).
	 * 
	 * @param string      $handle    Identifying name for script
	 * @param string      $src       The JavaScript code
	 * @param array       $deps      (optional) Array of script names on which this script depends
	 * @param bool        $in_footer (optional) Whether to enqueue the script before </head> or before </body> 
	 * 
	 * @return null
	 *
	 * Usage:
	 		Simgo_Core::enqueue_inline_script( SIMGO_THEME_SLUG . '-js-name', '
			alert( "THis is a function" );
		',
		array( 'jquery' ) );
	 *
	 */
	public static function enqueue_inline_script( $handle, $js, $deps = array(), $in_footer = false ) {
		
		if ( ! empty( $js ) ) {
	
			// Callback for printing inline script.
			$cb = function()use( $handle, $js ){
				// Ensure script is only included once.
				if( wp_script_is( $handle, 'done' ) )
					return;
				// Print script & mark it as included.
				echo "<script type=\"text/javascript\" id=\"js-$handle\">\n( function($) {\n\"use strict\";\n$( function() {\n$js\n} );\n} ) ( jQuery );\n</script>\n";
				global $wp_scripts;
				$wp_scripts->done[] = $handle;
			};
			// (`wp_print_scripts` is called in header and footer, but $cb has re-inclusion protection.)
			$hook = $in_footer ? 'wp_print_footer_scripts' : 'wp_print_scripts';
		
			// If no dependencies, simply hook into header or footer.
			if( empty($deps)){
				add_action( $hook, $cb );
				return;
			}
		
			// Delay printing script until all dependencies have been included.
			$cb_maybe = function()use( $deps, $in_footer, $cb, &$cb_maybe ){
				foreach( $deps as &$dep ){
					if( !wp_script_is( $dep, 'done' ) ){
						// Dependencies not included in head, try again in footer.
						if( ! $in_footer ){
							add_action( 'wp_print_footer_scripts', $cb_maybe, 11 );
						}
						else{
							// Dependencies were not included in `wp_head` or `wp_footer`.
						}
						return;
					}
				}
				call_user_func( $cb );
			};
			
			add_action( $hook, $cb_maybe, 100 );
		
		}

	}
	
	
	
	/*
	 * Get current URI
	 * @since Simgo 1.0
	 *
	 */
	public static function cur_uri() {

		$protocol = strpos( strtolower( $_SERVER['SERVER_PROTOCOL'] ), 'https' )  === false ? 'http' : 'https';
		$thisURL = $protocol.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$weburl = $protocol.'://'.$_SERVER['HTTP_HOST'];
		
		if ( isset( $_SERVER['REQUEST_URI'] ) ) {
			$uri = $_SERVER['REQUEST_URI'];
		} else {
			if ( isset($_SERVER['argv'] ) ) {
				$uri = $_SERVER['PHP_SELF'] .'?'. $_SERVER['argv'][0];
			} else {
				$uri = $_SERVER['PHP_SELF'] .'?'. $_SERVER['QUERY_STRING'];
			}
		}
		return $weburl.$uri;


	}
	
	/*
	 * Code compression
	 * @since Simgo 1.0
	 *
	 */
	public static function code_compression( $str ) {

		$str = str_replace("\r\n", '', $str );
		$str = str_replace("\n", '', $str );
		$str = str_replace("\t", '', $str ); 
		$str = str_replace("\t", '', $str );
		
		$pattern = array(
		"/> *([^ ]*) *</",
		"/[\s]+/",
		"/<!--[^!]*-->/",
		"/\"  /",
		"/ \"/",
		"'/\*[^*]*\*/'"
		);
		$replace = array(
		">\\1<",
		" ",
		"",
		"\"",
		"\"",
		""
		);
		
	  $outputcode = preg_replace( $pattern, $replace, $str );
		
	  return $outputcode;


	}
	
	
	/*
	 * Time Conversion
	 * @since Simgo 1.0
	 *
	 */
	public static function time_tran( $the_time ) {

		$the_time=date("Y-m-d H:i:s",strtotime($the_time) );
		$now_time = date("Y-m-d H:i:s",time() );
		$now_time = strtotime($now_time);
		$show_time = strtotime($the_time);
		$dur = $now_time - $show_time;
	
		//futrue
		if ($dur < 0){
			if($dur > -60){
				return 'after '.abs($dur).' '.__( 'seconds in the future', 'simgo' );
			}elseif($dur > -3600){
				return 'after '.floor(abs($dur)/60).' '.__( 'minutes in the future', 'simgo' );
			}elseif($dur > -86400){
				return 'after '.floor(abs($dur)/3600).' '.__( 'hours in the future', 'simgo' );
			}elseif($dur > -259200){
				return 'after '.floor(abs($dur)/86400).' '.__( 'days in the future', 'simgo' );
			}else{
				return 'after '.floor(abs($dur)/86400).' '.__( 'days in the future', 'simgo' );
			}
			
	
		}else{

			if($dur < 0){
				return __( 'in the future', 'simgo' );
			}elseif($dur < 60){
				return $dur.' '.__( 'seconds ago', 'simgo' );
			}elseif($dur < 3600){
				return floor($dur/60).' '.__( 'minutes ago', 'simgo' );
			}elseif($dur < 86400){
				return floor($dur/3600).' '.__( 'hours ago', 'simgo' );
			}elseif($dur < 259200){
				return floor($dur/86400).' '.__( 'days ago', 'simgo' );
			}else{
				return floor($dur/86400).' '.__( 'days ago', 'simgo' );
			}
			
		}

	}
	
	
	/*
	 * Character interception
	 * @since Simgo 1.0
	 *
	 * 
	 * Unit: Byte 
	 */
	public static function str_cut( $string, $length = 0, $type=1, $replace = '...' ) {

		if ($type == 1) $string = wpautop($string);
		
	
		if (strlen ( $string ) < $length) {
			$string = substr ( $string, 0 );
			$replace = '';
		} else {
			$char = ord ( $string [$length - 1] );
			if ($char >= 224 && $char <= 239) {
				$string = substr ( $string, 0, $length - 1 );
			} else {
				$char = ord ( $string [$length - 2] );
				if ($char >= 224 && $char <= 239) {
					$string = substr ( $string, 0, $length - 2 );
				} else {
					$string = substr ( $string, 0, $length );
				}
			}
		}
	
		// Label Array(a,span,div...)
		$starts = $start_str = $ends = array ();
		preg_match_all ( '/<\w+[^>]*>?/', $string, $starts, PREG_OFFSET_CAPTURE );
		preg_match_all ( '/<\/\w+>/', $string, $ends, PREG_OFFSET_CAPTURE );
	
		//Initialization interception
		$cut_pos = 0;
		//Finally append string
		$last_str = '';
	
		if (! empty ( $starts [0] ) ) {
			$starts = array_reverse ( $starts [0] );
			if (! empty ( $ends [0] ) ) {
				$ends = $ends [0];
			}
	
			foreach ( $starts as $sk => $s ) {
				// Determine whether the start tag includes closing syntax<img alt="" />
				$auto = false;
				if ($auto != false && $auto = strripos ( $s [0], '/>' ) ) {
					//If there is
					if ($cut_pos < $auto) {
						$cut_pos = $s [1];
						$last_str = $s [0];
						unset ( $starts [$sk] );
					}
				} else {
					// Get start tag name:a,div,span...
					preg_match ( '/<(\w+).*>?/', $s [0], $start_str );
					if (! empty ( $ends ) ) {
						foreach ( $ends as $ek => $e ) {
							// Get end tag name
							$end_str = trim ( $e [0], '</>' );
						
							if ($end_str == $start_str [1] && $e [1] > $s [1]) {
								
								if ($cut_pos < $e [1]) {
									$cut_pos = $e [1];
									
									$last_str = $e [0];
								}
							
								unset ( $ends [$ek] );
								break;
							}
						}
					} else {
						/*
						 * if empty($ends)
						 */
						$last_str = '';
						$cut_pos = $s [1];
					}
				}
			}
			//Splice remainder of strings
			$res_str = substr ( $string, 0, $cut_pos ) . $last_str;
			$less_str = substr ( $string, strlen ( $res_str ) );
			$less_pos = strpos ( $less_str, '<' );
			$less_str = $less_pos !== false ? substr ( $less_str, 0, $less_pos ) : $less_str;
			
			
			$string = $res_str . $less_str . $replace;
			$string = str_replace( '</p>'.$replace,$replace.'</p>',
					  str_replace( '</div>'.$replace,$replace.'</div>',
					  self::code_compression($string) ));
			
			
		}
		return $string;

	}
	
	
	/*
	 * Get template ID
	 * @since Simgo 1.0
	 *
	 */
	public static function get_pageid_from_template( $template ) {

	   global $wpdb;
	
	   $page_id = $wpdb->get_var($wpdb->prepare("SELECT `post_id` 
								  FROM `$wpdb->postmeta`, `$wpdb->posts`
								  WHERE `post_id` = `ID`
										AND `post_status` = 'publish'
										AND `meta_key` = '_wp_page_template'
										AND `meta_value` = %s
										LIMIT 1;", $template));
	
	   return $page_id;

	}
	
	
	/*
	 * The function finds the position of the first occurrence of a string inside another string.
	 *
	 * As strpos may return either FALSE (substring absent) or 0 (substring at start of string), strict versus loose equivalency operators must be used very carefully.
	 *
	 */
	public static function inc_str( $str, $incstr ) {
	
		if ( mb_strlen( strpos( $str, $incstr ), 'UTF8' ) > 0 ) {
			return true;
		} else {
			return false;
		}

	}
	
	/*
	 * Browser Compatibility
	 *
	 * Declare multple X-UA-Compatible meta contents in a single wordpress site for IE compatibility hack.
	 *
	 */
	public static function browser_compatibility() {
		if( self::inc_str( $_SERVER[ 'HTTP_USER_AGENT' ], 'MSIE' ) ) {
			echo "<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\">\n";
		}
	}
	 
	
	/**
	 * Get URL of first video in a post
	 * 
	 */
	public static function get_first_video() {
		global $post, $posts;
	
		// capture output
		ob_start();
			the_content();
			$out = ob_get_contents();
		ob_end_clean();
		
		if ( !strpos( $post->post_content, '<!--more-->' ) ) {
			if ( self::inc_str( $out, '<video' ) ) {
				$output = preg_match_all('/<video.+src=[\'"]([^\'"]+)[\'"].*<\/video>/i', $out, $matches);
			} else {
				$fr = 'rame';
				$output = preg_match_all('/<if'.$fr.'.+src=[\'"]([^\'"]+)[\'"].*<\/if'.$fr.'>/i', $out, $matches);
		
			}
		
			if( count( $matches[1] ) > 0 ) { 
				return $matches [0] [0];
			} else {
				return '';
			}
	
		} else {
		    return '';	
		}
	
	}
	
	/**
	 * Get URL of first audio in a post
	 * 
	 */
	public static function get_first_audio() {
		global $post, $posts;
	
		// capture the post content with html
		ob_start();
			the_content();
			$out = ob_get_contents();
		ob_end_clean();
		
		if ( !strpos( $post->post_content, '<!--more-->' ) ) {
			
			if ( self::inc_str( $out, '<audio' ) ) {
				$output = preg_match_all('/<audio.+src=[\'"]([^\'"]+)[\'"].*<\/audio>/i', $out, $matches);
			} else {
				$fr = 'rame';
				$output = preg_match_all('/<if'.$fr.'.+src=[\'"]([^\'"]+)[\'"].*<\/if'.$fr.'>/i', $out, $matches);
		
			}
		
			
			if( count( $matches[1] ) > 0 ) { 
				return $matches [0] [0];
			} else {
				return '';
			}
		
	
			
		} else {
		    return '';	
		}
	}
	
	/**
	 * Uotput Audio Code (Support Soundcloud)
	 * 
	 */
	public static function output_audio( $url = '' ) {
		
		$wp_media_suffix = 'mp3|m4a|ogg|wav';
		$md = explode( '|', $wp_media_suffix);
		$soundcloud = true;
		$output = '';
		
		foreach( $md as $v ) {
			if ( strpos( $url, $v ) ) {
				$output = wp_audio_shortcode( array(
												'src'      => $url,
												'loop'     => 0,
												'autoplay' => 0,
												'preload' => 'none'
												) );
				
				$soundcloud = false;
				break;
			}
			
		}
		
		if ( $soundcloud ) {
			$output = wp_oembed_get( $url );
		}
		
		return $output;
				
		
	}
	
	
	
	
}

