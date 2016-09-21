<?php
/**
 * Theme functions
 * *
 
 --------------------------------------
 
 * Filter tagcloud
 *
 * Given the count of the posts with that tag.
 */

if ( !function_exists( 'simgo_filter_tagcloud' ) ) {
	function simgo_filter_tagcloud($text) {
		$text = preg_replace_callback( '|<a (.+?)</a>|i','simgo_filter_tagcloud_callback',$text);
		return $text;
	}

}


if ( !function_exists( 'simgo_filter_tagcloud_callback' ) ) {
	function simgo_filter_tagcloud_callback($matches) {
		$text = $matches[1];
		preg_match( '|title=(.+?)style|i', $text, $a);
		preg_match("/[0-9]/", $a[1], $a);
		$text = str_replace( 'class=','class=\'tag-link\' data-tag-id=',
		        str_replace( 'style=','data-no-style=',
		       $text
			   ));
		
		//return "<a ".$text."<em class='tag-link-num'>(".$a[0].")</em></a>";
		return "<a ".$text."</a>";
		
	}

}
add_filter( 'wp_tag_cloud', 'simgo_filter_tagcloud', 1);