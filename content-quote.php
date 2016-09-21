<?php
/**
 * The template for displaying posts in the Quote post format
 * 
 */

if ( is_singular() ) { 
/* ==================  single ==================  */  
?>
    


<?php 
/* ==================  /single ==================  */ 


} else { 
/* ==================  loop ==================  */  

    $post_class = implode(' ',get_post_class( 'infinite-scroll-list', $post->ID ) );
?>


    <div class="infinite-scroll-list post-list"> 
    
        
        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        
                 <blockquote>
                     <?php the_content(); ?>
                 </blockquote>
                  
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
