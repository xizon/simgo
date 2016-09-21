<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * 
 */


// Layout
$layout = get_theme_mod( 'custom_blog_layout', 'standard' );


// To change the number of posts displayed on your blog
$per = get_option( 'posts_per_page' );
if ( get_theme_mod( 'custom_blog_show' ) ) {	 
	 $per = intval( get_theme_mod( 'custom_blog_show', 10 ) );
	 update_option( 'posts_per_page' , $per );
}

get_header(); ?>

  
    <div class="container">
    

        <section class="body">

      
                <div class="content-container">

                  
                    <!-- ==================  Post list ==================  -->
                    <?php if ( have_posts() ) { ?>
    
            
                        <?php while ( have_posts() ) : the_post(); ?>
            
                            <?php
            
                                /*
                                 * Include the Post-Format-specific template for the content.
                                 * If you want to override this in a child theme, then include a file
                                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                 */
                                     
                                     if ( $layout == 'standard' ) {
                                         
                                         get_template_part( 'content', get_post_format() );
                                         
                                     }
                                
                            ?>
            
                        <?php endwhile; ?>
            
            
                    <?php } else { ?>
            
                        <?php get_template_part( 'content', 'none' ); ?>
            
                    <?php } ?>
                    <!-- ==================  /Post list ==================  -->
                    
                    
                    <a class="more-link" href="<?php echo get_permalink( Simgo_Core::get_pageid_from_template( 'blog.php' ) ); ?>" title="<?php echo get_bloginfo( 'name' ); ?>" >View all &rarr;</a>
    
                
                </div><!-- /.content-container -->
                
                <div class="sidebar-container">
                     
                     
                       <?php get_sidebar(); ?>
                    
                    
                    
                    
                </div><!-- /.sidebar-container -->
                
                <div class="clear"></div>
        
  
     
                     
        </section>
    
    </div><!-- /.container -->    
    

    
  
<?php get_footer(); ?>
