<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 * 
 */

get_header(); ?>



<?php 
// Start the loop.
while ( have_posts() ) : the_post();
?>


	<div class="container">

        
                <article itemscope itemtype="http://schema.org/Article">
        
        
                        
                            <div class="content-container">
                            
                            
                                    <section class="post-container post">
                                    
                                              <header class="post-header">
                                                
                                                    <!-- ==================  Heading ==================  -->	
                                                    <h1 class="entry-title" itemprop="headline"><?php echo get_the_title(); ?></h1>
                                                    <!-- ==================  /Heading ==================  -->	
        
                                                             
                                              </header>
                                              
                       
                                              
                                
                                                <section class="post-content post-content-side post-content-detail">
                                                
                                                
                                                    <div class="entry-meta">
                        
                                                      
                                                          <!-- ==================  Status ==================  -->	
                                                          <div class="clearfix">
                                                                <p class="post-info">
                                                                    <i class="fa fa-clock-o"></i> 
                                                                    <?php
                                                                        $time_string = '<time class="post-date" itemprop="datePublished" datetime="%1$s">%2$s</time>';
                                                                    
                                                                        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
                                                                            //$time_string = '<time class="post-date" itemprop="datePublished" datetime="%1$s">%2$s<time datetime="%3$s">&nbsp;&nbsp;('.__( 'Latest modified on', 'simgo' ).' %4$s</time>)</time>';
                                                                        }
                                                                    
                                                                        printf( $time_string,
                                                                            esc_attr( get_the_date( 'c' ) ),
                                                                            get_the_date(),
                                                                            esc_attr( get_the_modified_date( 'c' ) ),
                                                                            get_the_modified_date()
                                                                        );
                                                                    
                                                                    ?>
                                                    
                                                                     &nbsp;&nbsp;
                                                                    <span class="post-submitted" itemscope itemtype="http://schema.org/Person" itemprop="author">
                                                                        <i class="fa fa-user"></i> <?php _e( 'by', 'simgo' ) ?>
                                                                        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author" itemprop="url">
                                                                            <span itemprop="name"><?php echo get_the_author(); ?></span>
                                                                        </a>
                                                                    </span>
                                                                    &nbsp;&nbsp;
                                                                    <span class="post-comments"><i class="fa fa-comment"></i> 
                                                                            <?php
                                                                                printf( _nx( 'One Comment', '%1$s Comments', get_comments_number(), 'comments title', 'simgo' ),
                                                                                    number_format_i18n( get_comments_number() ),get_the_title() );
                                                                                    
                                                                            
                                                                      ?>
                                                                      
                                                                    </span>
                                                                    &nbsp;&nbsp;
                                                                    <span class="post-views"><i class="fa fa-eye"></i> <?php echo simgo_get_post_views(get_the_ID()); ?> <?php _e( 'views', 'simgo' ) ?></span>
                                                                    &nbsp;&nbsp;
                                                                    <span class="post-views"><i class="fa fa-bookmark"></i> 
                                                                            <?php echo get_the_term_list( get_the_ID(), 'category', '', ', ', '' );?> 
                                                                    </span>
                                                                    &nbsp;&nbsp;
                                                                    
                                                                
                                                                    <?php
                                                                    if ( class_exists( 'UixShortcodes' ) ) {
                                                                        echo do_shortcode( "[uix_share_buttons color='1' size='1' fillet='25px' show='facebook,twitter,google_plus,pinterest']" );
                                                                    }
                                                                    
                                                                     ?>
            
                                                                    
                                                                </p>
                                                              
                                                            </div>
                                                           <!-- ==================  /Status ==================  -->
                                                            
            
   
                                            
                                
                                                    </div><!-- /.entry-meta -->
                                                            
                                                    
                                                    <div itemprop="articleBody">
                                                    
                                                    
                                                       <!-- ==================  Display media ==================  -->	    
                                                             <?php
                                                        // 
                                                        if( 'quote' != get_post_format() ) {
                                                            get_template_part( 'content', get_post_format() ); 
                                                        } 
                                                        ?>
                                                        <!-- ==================  /Display media ==================  -->	
                                               
                                              
                                              
                                                        
                                                        <!-- ==================  Post Content ==================  -->	 
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
                                                               
                                                               
                                                               
                                                        <!-- ==================  /Post Content ==================  -->	 
                                                        
                                                        
                                                       <!-- ==================  Tags ==================  -->	
                                                          <?php
                                                              the_tags( '<p class="post-tags" itemprop="keywords">', '', '</p>' );
                                                              ?>
                                                         <!-- ==================  /Tags ==================  -->  
                                               
                        
                                                            
                                                        
                                                        
                                                        
                                                        <!-- ==================  Edit button ==================  -->	 
                                                        <?php edit_post_link( __( 'Edit', 'simgo' ), '<p class="edit-link">', '</p>' ); ?>
                                                        <!-- ==================  /Edit button ==================  -->	
        
        
                                                    
                                                    </div>
                              
                                                </section> 
                                
                                
                                
                                
                                
                                                  <div class="clearfix post-content-side">
        
                                                  
                                  
                                                        <!-- ==================  Pagination ==================  -->	
                                                        <div class="site-pagination normal">
                                                          <ul class="pager">
                                                          
                                                            <li class="previous"><?php echo str_replace( 'rel="prev"', 'class="prev page-numbers"', get_previous_post_link( '%link', ''.__( 'Previous Post', 'simgo' ).'' )); ?></li>
                                                            <li class="next"><?php echo str_replace( 'rel="next"', 'class="next page-numbers"', get_next_post_link( '%link', ''.__( 'Next Post', 'simgo' ).'' )); ?></li>
                        
                                                          </ul>
                                                        </div>	
                                                        <!-- ==================  /Pagination ==================  -->	
                                                     
                                                      
                                                        <!-- ==================  Comments (list & form) ==================  -->	
                                                        <div class="clear"></div>
                                                        
                                                        <?php comments_template();  ?>
                                                        
                                                        <?php if ( ! post_password_required() )  { ?>
                                                            <div id="comment-form" data-validate="1">
														    <?php 
															comment_form(); 
															
															?>
                                                            </div>
                                                        <?php } ?>
                                                      
                                                       <!-- ==================  /Comments (list & form) ==================  -->	
            
        
                                                        
                                                        
                                                        
                                                  </div>
        
        
                                </section>
                                <!-- post end -->	
                                
        
        
                            
                            </div><!-- /.content-container -->
                            
                            <div class="sidebar-container sidebar-container-single">
                            
                                 <?php get_sidebar(); ?>
    
                            </div><!-- /.sidebar-container -->
                            
                            <div class="clear"></div>
                            
             
            
                                            
          </article>
        
    
        
   </div><!-- /.container --> 
             

<?php
// End the loop.
endwhile;
?>  
    
    
<?php get_footer(); ?>
