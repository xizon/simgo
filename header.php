<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * 
 */
//Building WordPress themes using the Kirki Customizer
if ( ! class_exists( 'Kirki' ) ) {
	die( esc_attr__( 'Please enable the Kirki Plugin in order to see the demo in the Customizer', 'simgo' ) );
}

//Check if we're on the homepage.
global $myhomepage;
if ( is_home() || is_front_page() ) {
	$myhomepage = true;
} else {
	$myhomepage = false;
}

?>
<!DOCTYPE html>
<html <?php echo language_attributes();?>><head>

	<meta charset="<?php echo bloginfo('charset');?>">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1" />
    <?php Simgo_Core::browser_compatibility(); ?>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php echo bloginfo('pingback_url');?>">
    
   
	<?php wp_head(); ?>
    
    <style type="text/css">
	
	<?php if ( !is_home() && !is_front_page() ) { ?>
	<?php if ( get_header_image() ){ ?>
		.top-fixed {
			background:url(<?php header_image(); ?>) !important;
		}
	
	<?php } ?>
	<?php } ?>
	
	
	</style>
    

</head>

<body <?php body_class(); ?>>



   
  
	<header id="header">
    
    
         <div class="main-header">
         
                 <div class="top-fixed">
                     
                     
                     <div class="container">
                     
                 
                        <!-- ==================  Branding ==================  -->
        
                        <section class="branding">
                   
                            <?php 
							$logo_url = simgo_the_custom_logo_url();
							
							if ( $myhomepage ) {
							    $brand_tag = 'h1';
							} else {
								$brand_tag = 'h2';
								
							}
							if ( !empty( $logo_url ) ) { 
							?>
                            
                               <<?php echo $brand_tag; ?> class="site-img-logo">
                        
                                    <a href="<?php echo home_url(); ?>" rel="home">
                                        <img src="<?php echo $logo_url; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
                                    </a>
                                    
                               </<?php echo $brand_tag; ?>>
                    
                            <?php } else { ?>
                    
                                <<?php echo $brand_tag; ?> class="site-text-logo">
                                
                                    <a href="<?php echo home_url(); ?>" rel="home">
                                        <?php bloginfo( 'name' ); ?>
                                    </a>
                    
                                </<?php echo $brand_tag; ?>><!-- .site-text-logo -->
                                
                
                                <?php if ( get_bloginfo( 'description' ) ) { ?>
                
                                    <div class="site-description"><?php bloginfo( 'description' ); ?></div>
                
                                <?php } ?>

                                
                    
                            <?php } ?>
                    
                        </section><!-- #logo -->
                        
                        <!-- ==================  /Branding ==================  -->
                        

                        
                        <!-- ==================  Navigation ==================  -->
                        <div id="sidr-close"><a href="#sidr-close" class="toggle-sidr-close"></a></div>
                        <div id="main-navigation-wrap">
                            <a href="#sidr-main" id="navigation-toggle"><span class="fa fa-bars"></span><?php echo __( 'Menu', 'simgo' ); ?></a>
                            <nav id="main-navigation">
                                
                    
                              <?php
                              
                                    /*
                                     * Display main menu
                                     *
                                    */    
									if ( has_nav_menu( 'primary' ) ) :
							
										wp_nav_menu(
												array(
													'theme_location'  => 'primary', //The location in the theme to be used--must be registered with register_nav_menu() in order to be selectable by the user
													'menu'            => '', //The menu that is desired; accepts (matching in order) id, slug, name
													'container'       => false, //Whether to wrap the ul, and what to wrap it with. Allowed tags are div and nav. Use false for no container e.g.
													'container_class' => '', //The class that is applied to the container
													'container_id'    => '',//The ID that is applied to the container
													'menu_class'      => '', //he class that is applied to the ul element which encloses the menu items. 
													'menu_id'         => 'primary-menu',// The ID that is applied to the ul element which encloses the menu items.
													'echo'            => true,//Whether to echo the menu or return it. For returning menu use '0'
													'fallback_cb'     => 'simgo_page_menu',// If the menu doesn't exist, the fallback function to use. Set to false for no fallback. Default: wp_page_menu
													'before'          => '',//Output text before the <a> of the link
													'after'           => '',//Output text after the </a> of the link
													'link_before'     => '',//Output text before the link text
													'link_after'      => '',//Output text after the link text
													'items_wrap'      => '<ul class="dropdown-menu sf-menu" id="%1$s">%3$s</ul>', //Evaluated as the format string argument of a sprintf() expression. 
													'depth'           => 0,// How many levels of the hierarchy are to be included where 0 means all.
													'walker'          => new Simgo_Dropdown_Walker_Nav_Menu() //Custom walker object to use (Note: You must pass an actual object to use, not a string)
												)
											);	
				
				
											function simgo_page_menu() {
												
												echo '<ul class="dropdown-menu sf-menu" id="primary-menu">
														 <li class="menu-item mega-menu '.( $myhomepage ? 'current-menu-item' : '' ).'"><a href="'.home_url().'">'.__( 'Home', 'simgo' ).'</a></li>
													 </ul>                            
												';
											
											}
											
									endif;
       
                              ?>
                              
                              
                            
                            </nav>
                        
                         </div><!-- /#site-navigation-wrap -->
                        
                        <!-- ==================  /Navigation ==================  -->

                     </div><!-- /.container -->
                 
                 
                 </div><!--  /.top-fixed  -->



         
         </div><!-- /.main-header -->

            
	</header>
    
    
    <!-- ================== Carousel ================== -->
    
    <?php 
	
	// Return if disabled or not homepage
	if ( $myhomepage ) {
	
		get_template_part( 'partials', 'uix-slides' ); 
		
		// Return if doesn't have the class.
		if ( !class_exists( 'UixSlides' ) ) { 
			echo '<div style="height:50px;"></div>';
		}
	
	}

	?>
    
    <!-- ================== /Carousel ================== -->

    
    

	<div class="page-wrapper">
    
         <main role="main">

