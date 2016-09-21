<?php
/**
 * Theme functions
 * *
 
 --------------------------------------
 
 * Get latest posts
 *
 * Support for customizable latest posts block. 
 *
 * Usage:
 
		$output_articles = '';
		$output_articles_post = simgo_get_latest_posts( get_option( 'posts_per_page' ) );
		
		if ( isset( $output_articles_post ) ) {
		
			foreach( (array)$output_articles_post as $key=>$value ){
				if ( $value['imageURL'] == '' ){
					$featured_image = '';
				}else{
					$featured_image = '<img src="'.$value['imageURL'].'" width="20" height="20"> ';
				}
					$output_articles.='
					<li>
						<a href="'.$value['link'].'" title="'.$value['title'].'" >'.$value['title'].'</a>
					</li>
					';
			}
			echo $output_articles;			
		
		
		}else{
			get_template_part( 'content', 'none' );
		}
 
 
 */
 
if ( !function_exists( 'simgo_get_latest_posts' ) ) {
	function simgo_get_latest_posts($limit){
		global $post;
		$limit = ( $limit == '' || !$limit ) ? 10 : $limit;	
		$new_args = array( 'orderby' => 'date',
			'order' => 'desc',
			'posts_per_page' => $limit,
			'post_status' => 'publish',
		);
		$list = new WP_Query( $new_args );
		if( $list->have_posts() ){
			$out = array();
			$k = 0;
			while( $list->have_posts() ) : $list->the_post();
			        
					//featured image
					$thumbnail_src  =  wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
					$post_thumbnail_src  =  $thumbnail_src[0];
		
					$out[$k]['id'] = get_the_ID();
					$out[$k]['imageURL'] = $post_thumbnail_src;
					$out[$k]['title'] = get_the_title();
					$out[$k]['link'] = get_permalink();
					$out[$k]['comment'] = get_comments_number();
					$out[$k]['time'] = Simgo_Core::time_tran( get_the_time( 'Y-m-d H:i:s',$post) );
					$out[$k]['author'] = '<a title = "Author:'.get_the_author_link().'" href = "'.esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )).'">'.get_the_author_link().'</a>';
				$k++;
			endwhile;
			// Reset the post data
			wp_reset_postdata();
			
		}else{
			$out = null;
		}
	
		return $out;
	}
}

