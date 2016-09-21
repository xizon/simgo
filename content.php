<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * 
 */

if ( is_singular() ) { 
/* ==================  single ==================  */  
?>
    
	<?php
    // Get gallery image ids
    $attachments = get_gallery_ids();
	?> 
    
    
     <?php 
	 $thumbnail_output = '';
	 $thumbnail = '';
     if ( has_post_thumbnail()) {
     ?>
    
            <?php
            // Display post thumbnail
            ob_start();
				the_post_thumbnail( 'post-thumbnail-large', array(
					'alt' => get_the_title(),
					'class'	=> 'post-img',
					'itemprop'	=> 'image',
					
				) ); 
                $thumbnail = ob_get_contents();
            ob_end_clean(); 
            ?>
            
            <?php
			$thumbnail_output = '<div class="post-single-thumbnail">'.$thumbnail.'</div>';
			?>
  
    
     <?php }  ?>
    
    <?php 
	
    if ( is_array( $attachments ) && !empty( $attachments ) ) {
        $thumbnail_output = '';
    }
    ?>
    
		<?php
        // Loop through each attachment ID
        if ( is_array( $attachments ) ) {
        ?>

		<?php
        // Loop through each attachment ID
        foreach ( $attachments as $attachment ) :
            $img_url	= wp_get_attachment_url( $attachment );
            $img_alt	= get_post_meta( $attachment, '_wp_attachment_image_alt', true );
            $img_html	= wp_get_attachment_image( $attachment, 'post-thumbnail-large' ); 
			$img_html   = preg_replace( '/(width|height)=\"\d*\"\s/', '', $img_html );
			
			if ( !empty( $img_html ) ) {
			?>
            <p>
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
            </p>
            <?php 
				}
			endforeach; 
			?>

        
    
    <?php }  ?>
    
    
    
    
    <?php  echo $thumbnail_output; ?>
    
    

<?php 
/* ==================  /single ==================  */ 


} else { 
/* ==================  loop ==================  */  

    $post_class = implode(' ',get_post_class( 'infinite-scroll-list', $post->ID ) );

?>


    <div class="infinite-scroll-list post-list"> 
    
        
        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    
                <!-- //// -->
                <h3 class="entry-title"><a href="<?php echo esc_url( get_permalink() );?>" title="<?php echo esc_attr( get_the_title() ); ?>">
                  <?php the_title();?>
                  </a>
                </h3>
                
                
                <!-- //// -->
                <div class="post-thumbnail">
                    <figure>
                         
                         <?php if ( has_post_thumbnail()) { ?>
                         
                          
                              <p><a class="featured-image" href="<?php echo esc_url( get_permalink() ); ?>" >
                        
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
