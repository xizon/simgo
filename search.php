<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 * 
 */


//Blog paged template declaration
add_action( 'wp_footer', 'simgo_infinite_scroll_init', 100 );
		
	
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
                    <?php printf( esc_html__( 'Search Results for: %s', 'simgo' ), '<span>' . get_search_query() . '</span>' ); ?>
                </h1>
            </header>
            
        
            
            <section class="body">
            
                
        
                        <div class="content-container">


                                    <!-- ==================  Post list ==================  -->
                                    <div class="site-blog-tiles" <?php echo $infinitescroll_attr; ?>> 
                                    
             
                                    <?php if ( have_posts() ) { ?>
                    
                            
                                        <?php      while ( have_posts() ) : the_post(); 
                            
                            
                            
                                                                /*
                                                                 * Include the Post-Format-specific template for the content.
                                                                 * If you want to override this in a child theme, then include a file
                                                                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                                                 */
                                                                get_template_part( 'content', 'search' ); 
                                                        
                                                    endwhile; 
                                                    
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

