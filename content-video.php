<?php
/**
 * The template for displaying posts in the Video post format
 * 
 */


if ( is_singular() ) { 
/* ==================  single ==================  */  
?>
    

    <?php if ( !empty( get_post_meta( get_the_ID(), 'cus_post_ex_video', true ) ) ) { ?>
        <div class="post-video">
                <?php echo wp_oembed_get( get_post_meta( get_the_ID(), 'cus_post_ex_video', true ) ); ?>
        </div>
    <?php } ?>
    
<?php 
/* ==================  /single ==================  */ 


} else { 
/* ==================  loop ==================  */  

    $post_class = implode(' ',get_post_class( 'infinite-scroll-list', $post->ID ) );
?>


    <div class="infinite-scroll-list post-list"> 
    
        
        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
                <!-- //// -->
                <h3 class="entry-title"><i class="fa fa-video-camera"></i>&nbsp;<a href="<?php echo esc_url( get_permalink() );?>" title="<?php echo esc_attr( get_the_title() ); ?>">
                  <?php the_title();?>
                  </a>
                </h3>
                
                
                <!-- //// -->
                
                
			   <?php
               
               if ( !empty( get_post_meta( get_the_ID(), 'cus_post_ex_video', true ) ) ) {
                   echo '<div class="post-video">'.wp_oembed_get( get_post_meta( get_the_ID(), 'cus_post_ex_video', true ), array( 'width'=>644, 'height'=>437 ) ).'</div>';
               } else {
                   if ( !empty( Simgo_Core::get_first_video() ) ) echo '<div class="post-video">'.Simgo_Core::get_first_video().'</div>';
               }
            
               ?>
             
            
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
