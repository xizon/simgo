<?php
/**
 * The default template for displaying entries.
 * 
 */


?>
        <!-- //// -->
        <div class="post-content">
        
              <?php
		  
				/**
				 * Custom excerpts based on wp_trim_words
				 *
				 * @link	http://codex.wordpress.org/Function_Reference/wp_trim_words
				 */
				
				 if( 'quote' != get_post_format() ) {
					 echo simgo_excerpt( intval( get_theme_mod( 'custom_blog_excerpt_words', 150 ) ), true );
				 }

    
              ?>
    
          
        </div>
        
        
        <!-- //// -->
        <div class="post-date"> 
      
            <?php
                $time_string = '<time class="post-date" datetime="%1$s">%2$s</time>';
    
                printf( $time_string,
                    esc_attr( get_the_date( 'c' ) ),
                    get_the_date()
                );
            
            ?>

          | <?php _e( 'Views', 'simgo' ) ?>: <?php echo simgo_get_post_views( get_the_ID() );?>
        </div>
        
        <!-- //// --> 
        <span class="post-author">
             
              
              <?php //_e( 'Author', 'simgo' ) ?>
              <!-- : -->
              
              <?php 
			    //echo '<a href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'" rel="author">'.get_the_author().'</a>';
              //the_author( ',' );
              ?>
    
        </span> 
        <!-- //// --> 
        <span class="post-cat">
              
              <?php //_e( 'Categories', 'simgo' ) ?>
              <!-- : -->
				<?php 
				//echo get_the_term_list( get_the_ID(), 'category', '', ', ', '' );
              ?>
            
        </span> 
        
        
        <!-- //// --> 
        <span class="post-comments">
              <?php
              //comments_popup_link( __( 'No Comments', 'simgo' ),__( '1 Comment', 'simgo' ),__( '% Comments', 'simgo' ) );
              ?>
              
        </span> 
    
        <!-- //// -->
        
        <?php the_tags( '<p class="post-tags" itemprop="keywords">', '', '</p>' ); ?>
        