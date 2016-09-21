<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * 
 */


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
