<?php
/**
 * The template for displaying posts in the Link post format
 * 
 */

if ( is_singular() ) { 
/* ==================  single ==================  */  
?>
	<div class="post-single-thumbnail">
			  <?php if ( has_post_thumbnail()) { ?>
                <a class="featured-image" href="<?php echo esc_url( esc_url( get_post_meta( get_the_ID(), 'cus_post_ex_link', true ) ) ); ?>" target="_blank">
				<?php
                // Display post thumbnail
                the_post_thumbnail( 'post-thumbnail-large', array(
                    'alt' => get_the_title(),
                    'class'	=> 'post-img',
                    'itemprop'	=> 'image',
                ) ); 
                ?>
                </a>

             <?php } ?>
	</div>
    <div class="post-single-link">
        <a href="<?php echo esc_url( get_post_meta( get_the_ID(), 'cus_post_ex_link', true ) );?>" title="<?php echo esc_attr( get_the_title() ); ?>" target="_blank">
            <?php echo get_post_meta( get_the_ID(), 'cus_post_ex_link', true );?>
        </a>
    </div>
    
    
    

<?php 
/* ==================  /single ==================  */ 


} else { 
/* ==================  loop ==================  */  

    $post_class = implode(' ',get_post_class( 'infinite-scroll-list', $post->ID ) );
?>
    
    
    <div class="infinite-scroll-list post-list"> 
    
        
        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
   
                 <!-- //// -->
                <h3 class="entry-title"><i class="fa fa-link"></i>&nbsp;<a href="<?php echo esc_url( get_post_meta( get_the_ID(), 'cus_post_ex_link', true ) );?>" title="<?php echo esc_attr( get_the_title() ); ?>" target="_blank">
                  <?php the_title();?>
                  </a>
                </h3>
                
                
                <!-- //// -->
                <div class="post-thumbnail">
                    <figure>
                    
                          <?php if ( has_post_thumbnail()) { ?>
                         
                          
                              <p><a class="featured-image" href="<?php echo esc_url( esc_url( get_post_meta( get_the_ID(), 'cus_post_ex_link', true ) ) ); ?>"  target="_blank">
                        
                                <?php
                                // Display post thumbnail
                                the_post_thumbnail( 'post-thumbnail', array(
                                    'alt' => get_the_title(),
                                    'class'	=> 'post-img',
									'data-retina' => wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'post-retina-thumbnail' )[0],
									
									
                                ) ); 
                                ?>
            
                               </a></p>
                           
                         <?php } ?>
        
        
                    </figure>
                </div>
                
            
                <!-- //// -->
                <?php
                get_template_part( 'partials', 'common_entries' );
                
                ?>
                
          </div><!-- #post-## -->
          
        
    </div>


<?php 
/* ==================  /loop ==================  */ 
} 
?>
