<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 * 
 */

get_header(); ?>

    <div class="container" style="height:500px">

            <header>
                <h1 class="heading">
                    <?php _e( 'Not Found', 'simgo' ); ?>
                </h1>
            </header>
            
        
            
            <section class="body">
            
               <p>
            
                  <?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'simgo' ); ?>  
        
        
               </p>
         
                         
            </section>
    
    </div><!-- /.container -->
    
	

<?php get_footer(); ?>
