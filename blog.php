<?php
/**
 * Template Name: Blog
 *
 * The template for displaying blog pages.
 *
 * 
 */


		 
//Blog paged template declaration
add_action( 'wp_footer', 'simgo_infinite_scroll_init', 100 );


// Layout
$layout = get_theme_mod( 'custom_blog_layout', 'standard' );


// To change the number of posts displayed on your blog
$per = get_option( 'posts_per_page' );
if ( get_theme_mod( 'custom_blog_show' ) ) {	 
	 $per = intval( get_theme_mod( 'custom_blog_show', 10 ) );
	 update_option( 'posts_per_page' , $per );
}


	
// Infinite scroll support
$infinitescroll_attr = '';
$infinitescroll_enable = false;

if ( get_theme_mod( 'custom_blog_infinitescroll_list', false ) ) {
  //if true
  $infinitescroll_attr = 'id="infinite-scroll-content"';	
  $infinitescroll_enable = true;
} 


get_header(); ?>

    <div class="container">
            
            <header>
                <h1 class="heading">
                    <?php the_title();?>
                </h1>
            </header>
            
        
            
            <section class="body">
            
      
                
                        <div class="content-container">
                        
                                    

                                    <!-- ==================  Post list ==================  -->
                                    <div class="site-blog-tiles" <?php echo $infinitescroll_attr; ?>> 
                                    
                                    <?php 
                                    
                                        // Query
                                        $wp_query = new WP_Query(
                                            array(
                                                'post_type'      => 'post',
                                                'showposts' => $per, 
                                                'paged' => $paged
                                            )
                                        );
        
                                        if ( $wp_query->have_posts() ) { 
                                    
                                                                        
                                                    // Loop through each item
                                                    while ($wp_query->have_posts()) : $wp_query->the_post(); 
                            
                            
                                                      
                                                    /*
                                                     * Include the Post-Format-specific template for the content.
                                                     * If you want to override this in a child theme, then include a file
                                                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                                     */
                                                           if ( $layout == 'standard' ) {
                                                               get_template_part( 'content', get_post_format() ); 
                                                           }
                                                    
                                                        
                                                    endwhile; 
													
												// Reset post data to prevent conflicts with the main query
												wp_reset_postdata();	
	
													
                                                    
                                         ?>
                                         
                                         <?php } else { ?>
                            
                                        <?php get_template_part( 'content', 'none' ); ?>
                            
                                    <?php } ?>
                                    
                                    </div><!-- /.site-blog-tiles --> 
                                    
                                    <!-- ==================  /Post list ==================  -->
                            
                                    
                                    <!-- ==================  Pagination ==================  -->
                                    <div class="clear"></div>
                                    <div class="pagination">
                                        <?php 
                                                //Use Infinite Scroll
                                                if ( $infinitescroll_enable == true ) {
                                                    simgo_loadmore();
                                                    
                                                }

                          
												 if ( get_theme_mod( 'custom_pagination', true ) ) {
														//Use numeric Paginate
														simgo_pagination( 3, '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>', true, $infinitescroll_enable );	 
												 } else {
														//Only "next" and "previous" button
														simgo_pagejump( '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>', true, $infinitescroll_enable ); 
												 }
												 
                                                
                                          
                                        ?>
                                    </div>
                                    <!-- ==================  /Pagination ==================  -->
                                    
                                   
                        
                        </div><!-- /.content-container -->
                        
                        <div class="sidebar-container">
                             
                             
                               <?php get_sidebar(); ?>
                            
                            
                            
                            
                        </div><!-- /.sidebar-container -->
                        
                        <div class="clear"></div>
                        
                        
                      
                    
                         
            </section>

    </div><!-- /.container -->



<?php get_footer(); ?>


