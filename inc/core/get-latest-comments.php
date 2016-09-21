<?php
/**
 * Theme functions
 * *
 
 --------------------------------------
 
 * Get latest comments
 *
 * Support for customizable comments block. 
 */
 
if ( !function_exists( 'simgo_get_latest_comments' ) ) {
	function simgo_get_latest_comments($limit){
		global $wpdb;
		
		$sql = "SELECT DISTINCT ID,post_title,post_password,comment_ID,comment_post_ID,comment_author,comment_date_gmt,comment_approved,comment_type,comment_author_url,comment_author_email,SUBSTRING(comment_content,1,20) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' ORDER BY comment_date_gmt DESC LIMIT $limit";
		
		$comments = $wpdb->get_results($sql);
		$out=array();
		$k=0;
		foreach ( (array)$comments as $comment) {
			
			$out[$k]['permalink']=get_permalink($comment->ID);
			$out[$k]['avatar']=get_avatar($comment,32);
			$out[$k]['avatar_small']=get_avatar($comment,16);
			$out[$k]['author']=strip_tags($comment->comment_author);
			$out[$k]['excerpt']=strip_tags($comment->com_excerpt);
			$out[$k]['id']=$comment->comment_ID;
			$out[$k]['posttitle']=$comment->post_title;
			$out[$k]['time']=Simgo_Core::time_tran( $comment->comment_date_gmt );
			$k++;
		
		}
	
		return $out;
		
	
	}

}
