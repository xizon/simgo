<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * 
 */

$heading_case = get_post_meta( get_the_ID(), 'cus_page_ex_headingcase', true );
$heading_letterspacing = ( get_post_meta( get_the_ID(), 'cus_page_ex_letterspacing', true ) == '' ) ? 0 : get_post_meta( get_the_ID(), 'cus_page_ex_letterspacing', true );
$subheading      = get_post_meta( get_the_ID(), 'cus_page_ex_subheading', true );
$sidebar         = get_post_meta( get_the_ID(), 'cus_page_ex_sidebar', true );
$title_status    = get_post_meta( get_the_ID(), 'cus_page_ex_title', true );

// Check if the custom field has a value.
if ( empty( $sidebar ) ) $sidebar = 'none';
if ( empty( $title_status ) ) $title_status = 'show';
if ( empty( $heading_case ) ) {
	$case = 'style="text-transform:none;letter-spacing:normal;"';
} else {
	$case = 'style="text-transform:'.$heading_case.';letter-spacing:'.$heading_letterspacing.'px;"';
}


get_header(); ?>

        
<?php 
    
   // Start the loop.
   while ( have_posts() ) : the_post();?>
                           
    <div class="container">
    
    
            <header>
                <?php if ( $title_status == 'show' ) { ?>
                <h1 class="heading" <?php echo $case; ?>>
                    <?php the_title();?>
					<?php if ( $subheading ) { ?>
                    <p class="subheading" <?php echo $case; ?>>
                        <?php echo $subheading;?>
                    </p>
                    <?php } ?>
                    
                </h1>
                
                <?php } else { ?>
                    <p></p>
                    <p></p>
                
                <?php } ?>
                


                
            </header>
            
        
            
            <section class="body">
            
                
                    <?php if ( $sidebar == 'has' ) { ?>
                    
                        <div class="content-container">
                        
                    <?php } ?>
                    
                    
                                    <?php 
									the_content(); 
									                            
									/*
									 *
									 * Displays page-links for paginated posts 
									 *
									*/
								
									wp_link_pages( array(
										'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'simgo' ) . '</span>',
										'after'       => '</div>',
										'link_before' => '<span>',
										'link_after'  => '</span>',
										'pagelink'    => '<span class="num">%</span>',
									) );
                                    ?>
                        
                    
                                    <?php
                    
                                        /*
                                         * Displays a link to edit the current post, if a user is logged in and allowed to edit the post. 
                                         */
                                        edit_post_link( esc_html__( 'Edit', 'simgo' ), '<span class="edit-link">', '</span>' );
                
                                    ?>
                                
                                


                    <?php if ( $sidebar == 'has' ) { ?>
                    
                        </div><!-- /.content-container -->
                        
                        <div class="sidebar-container">
                             
                             
                               <?php get_sidebar(); ?>
                            
                            
                            
                            
                        </div><!-- /.sidebar-container -->
                        
                        <div class="clear"></div>

                    <?php } ?>
                    
                    
                
                         
            </section>
    
    
    </div><!-- /.container -->

  <?php
// End the loop.
endwhile;
?>  



<?php get_footer(); ?>
