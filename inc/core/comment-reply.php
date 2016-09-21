<?php
/**
 * Theme functions
 * *
 
 --------------------------------------
 
 * Custom Quick Reply Link
   
    * Change the comment reply link to use 'Reply to <Author First Name>'
 
 *
 */
 
if ( !function_exists( 'simgo_add_comment_author_to_reply_link' ) ) {
	function simgo_add_comment_author_to_reply_link($link, $args, $comment){
	
		$comment = get_comment( $comment );
	
		// If no comment author is blank, use 'Anonymous'
		if ( empty($comment->comment_author) ) {
			if (!empty($comment->user_id)){
				$user=get_userdata($comment->user_id);
				$author=$user->user_login;
			} else {
				$author = get_the_author_meta( 'display_name', $comment->user_id );
			}
		} else {
			$author = $comment->comment_author;
		}
	
		// If the user provided more than a first name, use only first name
		if(strpos($author, ' ')){
			$author = substr($author, 0, strpos($author, ' '));
		}
	
		// Replace Reply Link with "Reply to &lt;Author First Name>"
		$reply_link_text = $args['reply_text'];
		$link = str_replace($reply_link_text, 'Reply to ' . $author, $link);
	
		return $link;
	}
}
add_filter( 'comment_reply_link', 'simgo_add_comment_author_to_reply_link', 10, 3 );





	
		