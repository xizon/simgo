<?php
/**
 * The template for displaying the footer.
 *
 * 
 */






//Get global vars
global $social_footer;


?>

         </main><!-- / role="main" -->

	</div><!-- /.page-wrapper -->



    
	<footer id="footer">
    
    
        <!-- ==================  Footer widgets ==================  -->
        
        <section class="footer-widgets container">  
        
            <div class="footer-box col-1">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-one')) { ?>
							<div class="footer-widget widget_text">
								<h6 class="widget-title"><?php _e( 'Footer Widget 1', 'simgo' ); ?></h6>			
								<div class="textwidget">
									<p><?php printf( __( 'Replace this widget content by going to <a href="%1$s"><strong>Appearance &raquo; Widgets</strong></a> and dragging widgets into "Footer Widget 1".', 'simgo' ), admin_url( 'widgets.php' ) ); ?></p>
									
								</div>
							</div>
						<?php } ?>

            </div><!-- .footer-box -->
        
            <div class="footer-box col-2">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-two')) { ?>
							<div class="footer-widget widget_text">
								<h6 class="widget-title"><?php _e( 'Footer Widget 2', 'simgo' ); ?></h6>			
								<div class="textwidget">
									<p><?php printf( __( 'Replace this widget content by going to <a href="%1$s"><strong>Appearance &raquo; Widgets</strong></a> and dragging widgets into "Footer Widget 2".', 'simgo' ), admin_url( 'widgets.php' ) ); ?></p>
									
								</div>
							</div>
						<?php } ?>
    
            </div><!-- .footer-box -->
        
            <div class="footer-box col-3">
                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-three')) { ?>
                    <div class="footer-widget widget_text">
                        <h6 class="widget-title"><?php _e( 'Footer Widget 3', 'simgo' ); ?></h6>			
                        <div class="textwidget">
                            <p><?php printf( __( 'Replace this widget content by going to <a href="%1$s"><strong>Appearance &raquo; Widgets</strong></a> and dragging widgets into "Footer Widget 3".', 'simgo' ), admin_url( 'widgets.php' ) ); ?></p>
                            
                        </div>
                    </div>
                <?php } ?>
   
            </div><!-- .footer-box -->
            
            <div class="clear"></div>
    
        
        </section>
        
        <!-- ==================  /Footer widgets ==================  -->


        <!-- ==================  Copyright ==================  -->
    

		<section class="footer-copyright">
            
            <div class="copyright-wrap">
            
            
				<?php
                // Display custom copyright
                echo do_shortcode( html_entity_decode( get_theme_mod( 'custom_copyright', '&copy; '.__( 'Copyright', 'simgo' ).' 2016 &middot; <a href="'.esc_url(home_url('/')).'" title="'.get_bloginfo( 'name' ).'">'.get_bloginfo( 'name' ).'</a>' ) ) );
                ?>
                 | <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'simgo' ) ); ?>"><?php echo sprintf( __( 'Powered by %s', 'simgo' ), 'WordPress' ); ?></a> | <a href="<?php echo esc_url( __( 'https://uiux.cc', 'simgo' ) ); ?>"><?php echo sprintf( __( 'Theme by %s', 'simgo' ), 'UIUX Lab' ); ?></a>

            </div>
            
            
		</section>
        
        <!-- ==================  /Copyright ==================  -->
        
        
        
	</footer>
    
    
    <?php get_template_part( 'partials', 'google_analytics' ); ?>


<?php wp_footer(); ?>

</body>
</html>
