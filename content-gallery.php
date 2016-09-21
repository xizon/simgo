<?php
/**
 * The template for displaying posts in the Gallery post format
 * 
 */

if ( is_singular() ) { 
/* ==================  single ==================  */  
?>

	<?php
    // Get gallery image ids
    $attachments = get_gallery_ids();
    
    // Return if there aren't any images
    if ( ! $attachments ) {
        return;
    } ?>
    

	<div id="blog-carousel-wrap-single">

		<div id="blog-carousel" class="custom-theme-flexslider">

			<div class="custom-theme-slides">

			<?php
            // Loop through each attachment ID
            foreach ( $attachments as $attachment ) :
                $img_url	= wp_get_attachment_url( $attachment );
                $img_alt	= get_post_meta( $attachment, '_wp_attachment_image_alt', true );
                $img_html	= wp_get_attachment_image( $attachment, 'post-thumbnail-large' );
				$img_html   = preg_replace( '/(width|height)=\"\d*\"\s/', '', $img_html );
				
				if ( !empty( $img_html ) ) {
				?>
                <div class="item">
                    <?php
                    // Display image with lightbox
                    if (  'on' == gallery_is_lightbox_enabled() ) { ?>
                        <a href="<?php echo $img_url; ?>" title="<?php echo $img_alt; ?>" rel="prettyPhoto[unusual]">
                            <?php echo $img_html; ?>
                        </a>
                    <?php
                    // Lightbox is disabled, only show image
					} else { ?>
                        <?php echo $img_html; ?>
                    <?php } ?>
                </div>
            <?php 
				}
			endforeach; 
			?>
    

			</div><!-- .custom-theme-slides -->

		</div><!-- .custom-theme-flexslider -->

	</div><!-- #blog-carousel-wrap-single -->
    
 
<?php 
/* ==================  /single ==================  */ 


} else { 
/* ==================  loop ==================  */  

    $post_class = implode(' ',get_post_class( 'infinite-scroll-list', $post->ID ) );
?>


    <div class="infinite-scroll-list post-list"> 
    
        
        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
                <!-- //// -->
                <h3 class="entry-title"><i class="fa fa-file-video-o"></i>&nbsp;<a href="<?php echo esc_url( get_permalink() );?>" title="<?php echo esc_attr( get_the_title() ); ?>">
                  <?php the_title();?>
                  </a>
                </h3>
                
                
                <!-- //// -->
                <div class="post-thumbnail">
                    <figure>
                        
                              <p><a class="featured-image" href="<?php echo esc_url( get_permalink() );?>" >
                        
								<?php
                                
								     
                                  if ( has_post_format( 'gallery' ) ) {
									
		                               
											if ( has_post_thumbnail() ) {
												
												// Display post thumbnail
												the_post_thumbnail( 'post-thumbnail', array(
													'alt' => get_the_title(),
													'class'	=> 'post-img',
													'data-retina' => wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'post-retina-thumbnail' )[0],
													
												) ); 												
												
												
								           } else {
											   
												// Get gallery image ids
												$attachments = get_gallery_ids();
												
												if ( is_array( $attachments ) ) {
													
													foreach ( $attachments as $attachment ) :
														$img_url	= wp_get_attachment_url( $attachment );
														$img_alt	= get_post_meta( $attachment, '_wp_attachment_image_alt', true );
														$img_html	= wp_get_attachment_image( $attachment, 'post-thumbnail', false, array(
																								'alt' => get_the_title(),
																								'class'	=> 'post-img',
																								'data-retina' => wp_get_attachment_image_src( $attachment, 'post-retina-thumbnail' )[0],
																							   )
																							); 
					
														
														echo preg_replace( '/(width|height)=\"\d*\"\s/', '', $img_html );
														
														if ( !empty( $img_html ) ) break;
														
													endforeach; 
													
	
													
												}
											}
		
										
									} 
									
									?>                 
            
                               </a></p>
                           
                        
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
