<?php
/**
 * Theme functions and definitions.
 * Theme by http://uiux.cc
 * 
 */

/**
 * Set up the content width value based on the theme's design.
 *
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640;
}

if ( !defined ( 'SIMGO_THEME_NAME' ) ){
	define('SIMGO_THEME_NAME',wp_get_theme());
	define('SIMGO_THEME_VERSION',wp_get_theme()->display( 'Version' ));
	define('SIMGO_THEME_SLUG',wp_get_theme()->get( 'TextDomain' ));

}


/*
 * Theme Class
 * @since Simgo 1.0
 *
 */
if ( ! class_exists( 'Simgo_Core' ) ) {
	require get_template_directory() . '/inc/class/class-theme-core.php';
}



/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
if ( ! function_exists( 'simgo_setup' ) ) {

	function simgo_setup() {
	    
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Simgo, use a find and replace
		 * to change 'simgo' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'simgo', get_template_directory() . '/languages' );
	
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );
	
		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded "title" tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
		
		

		/**
		 * Implement the Custom Header feature.
		 */
		add_theme_support( 'custom-header', array(
			'default-image'          => '',
			'random-default'         => false,
			'width'                  => 0,
			'height'                 => 0,
			'flex-height'            => false,
			'flex-width'             => false,
			'default-text-color'     => '',
			'header-text'            => false,
			'uploads'                => true,
			'wp-head-callback'       => '',
			'admin-head-callback'    => '',
			'admin-preview-callback' => '',
		) );
	

	
		/*
		 * This theme uses wp_nav_menu() in one location.
		 *
		 */
		register_nav_menus( array(
			'primary' => __( 'Primary Menu', 'simgo' ),
		) );
	
		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
	

		/*
		 * Enable support for custom logo.
		 *
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 320,
			'width'       => 320,
			'flex-height' => true,
		) );
	
	
		/*
		 * Set up the WordPress core custom background feature.
		 *
		 */
		add_theme_support( 'custom-background', array(
			'default-color'          => '#ffffff',
			'default-image'          => '',
			'wp-head-callback'       => '_custom_background_cb',
			'admin-head-callback'    => '',
			'admin-preview-callback' => ''
		));
		

		
		
		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		 
		add_theme_support('post-formats', array(
			'video', 'quote', 'link', 'audio', 'gallery'
		));
		
		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails', array( 'post' ) );
		
		//Note: This function will not resize your existing featured images. To regenerate existing images in the new size, use the Regenerate Thumbnails plugin.
		set_post_thumbnail_size( 705, 303, true );
	
	    //Add image sizes
		add_image_size( 'post-thumbnail-large', 1920, 9999, false );
		
		// Add image sizes for retina
		add_image_size( 'post-retina-thumbnail', 705*2, 303*2, true );
		
			
			
	}
}
add_action( 'after_setup_theme', 'simgo_setup' ); 


/*
 * This theme styles the visual editor to resemble the theme style,
 * specifically font, colors, icons, and column width.
 */
function simgo_add_editor_styles() {
    add_editor_style( get_template_directory_uri() . '/inc/add-ons/dashboard/custom-editor-style.css' );
}
add_action( 'init', 'simgo_add_editor_styles' );

/*
 * Featured Image
 * Add support for a custom default image
 */
require get_template_directory() . '/inc/add-ons/featured-image-column/featured-image-column.php';

function simgo_custom_featured_image_column_image( $image ) {
    if ( !has_post_thumbnail() ) {
        return trailingslashit( get_stylesheet_directory_uri() ) . 'inc/add-ons/featured-image-column/featured-image.png';
	}
}
add_filter( 'featured_image_column_default_image', 'simgo_custom_featured_image_column_image' );




/*
 * Remove unnecessary meta tags from WordPress header
 *
 * If you look at the HTML source code of your WordPress site, you will find a couple of meta tags in the header that aren't really required. 
 * For instance, the version of WordPress software running on your server can be easily retrieved by looking at your source header.
*/
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head'); //remove auto loading rel=next post link in header
remove_action( 'wp_head', 'wp_shortlink_wp_head' );//Display the shortlink 	
remove_action( 'wp_head', 'wp_generator' );//Display the XHTML generator


/**
 * Enqueue scripts and styles  in the backstage
 *
 */
function simgo_scripts_backstage() {
	
	
    
	if ( is_admin() ) {
		
		//Main dashboard
		wp_enqueue_style( SIMGO_THEME_SLUG . '-dashboard', get_template_directory_uri().'/inc/add-ons/dashboard/dashboard.css', false, SIMGO_THEME_VERSION, 'all');
		wp_enqueue_script( SIMGO_THEME_SLUG . '-dashboard', get_template_directory_uri() . '/inc/add-ons/dashboard/dashboard.js', array( 'jquery' ), SIMGO_THEME_VERSION, false );	
		
		

		// Add Icons(font-awesome)
		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/inc/add-ons/fontawesome/font-awesome.css', false, '4.5.0', 'all');	
				
				
	}



}
add_action( 'admin_enqueue_scripts', 'simgo_scripts_backstage' );



/**
 * Enqueue scripts and styles.
 *
 */
function simgo_scripts() {


    // Internet Explorer 8 media query support
    wp_enqueue_script( SIMGO_THEME_SLUG . '-ie-respond', get_template_directory_uri() . '/js/respond.min.js', false, '1.4.2', false);
    wp_script_add_data( SIMGO_THEME_SLUG . '-ie-respond', 'conditional', 'lt IE 9' );

	
	//Load our IE specific stylesheet for a range of older versions
	wp_enqueue_style( SIMGO_THEME_SLUG . '-old-ie', get_template_directory_uri() . '/css/old-ie.css', false, SIMGO_THEME_VERSION, 'all' );
	wp_style_add_data( SIMGO_THEME_SLUG . '-old-ie', 'conditional', 'lt IE 10' );
	

	// Add basic jquery
	wp_enqueue_script( 'jquery-easing', get_template_directory_uri() . '/js/jquery/jquery.easing.js', array( 'jquery' ), '1.3', false );
	wp_enqueue_script( 'jquery-mousewheel', get_template_directory_uri() . '/js/jquery/jquery.mousewheel.js', array( 'jquery' ), '3.0.6', false );
	
	// Modernizr.
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.min.js', false, '3.3.1', false );
	
	// imagesloaded
	wp_enqueue_script( 'imagesloaded', get_template_directory_uri() . '/js/imagesloaded.min.js', array( 'jquery' ), '4.1.0', true );	

	// Masonry
	wp_enqueue_script( 'masonry', get_template_directory_uri() . '/js/masonry.js', array( 'jquery' ), '2.1.08', true );	
	

	// Add Icons(font-awesome)
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/inc/add-ons/fontawesome/font-awesome.css', false, '4.5.0', 'all');

	
	// waitforimages
	wp_enqueue_script( SIMGO_THEME_SLUG . '-waitforimages', get_template_directory_uri() . '/js/jquery/jquery.waitforimages.js', array( 'jquery' ), '1.5.0', true );	

	
	// Add Superfish menu
	wp_enqueue_script( SIMGO_THEME_SLUG . '-superfish', get_template_directory_uri() . '/js/jquery/jquery.superfish.js', array( 'jquery' ), '1.7.5', true );	
	
	// Hover Intent
	wp_enqueue_script( SIMGO_THEME_SLUG . '-hoverIntent', get_template_directory_uri() . '/js/jquery/jquery.hoverIntent.js', array( 'jquery' ), '1.0.0', true );	

	// Add mobile menu
	wp_enqueue_script( SIMGO_THEME_SLUG . '-sidr', get_template_directory_uri() . '/js/jquery/jquery.sidr.js', array( 'jquery' ), '1.0.0', true );	

	// Form validation
	wp_enqueue_script( SIMGO_THEME_SLUG . '-validate', get_template_directory_uri() . '/js/jquery/jquery.validate.min.js', array( 'jquery' ), '1.14.0', true );
	
	// prettyPhoto
	wp_enqueue_script( 'prettyPhoto', get_template_directory_uri() . '/js/jquery/jquery.prettyPhoto.js', array( 'jquery' ), '3.1.5', true );
	wp_enqueue_style( 'prettyPhoto', get_template_directory_uri() . '/css/jquery.prettyPhoto.css', false, '3.1.5', 'all');
	
	// FlexSlider
	wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/jquery/jquery.flexslider.min.js', array( 'jquery' ), '2.5.0', true );
	wp_enqueue_style( SIMGO_THEME_SLUG . 'flexslider', get_template_directory_uri() . '/css/flexslider.css', false, '2.5.0', 'all');
	
	
    // Add main javascript.
	wp_enqueue_script( SIMGO_THEME_SLUG . '-main', get_template_directory_uri() . '/js/global.js', array( 'jquery' ), SIMGO_THEME_VERSION, true );	
	
    // Add main stylesheet.
	wp_enqueue_style( SIMGO_THEME_SLUG . '-main', get_template_directory_uri() . '/style.css', false, SIMGO_THEME_VERSION, 'all' );

    //Quick Reply is the ability to respond to a message without URL jump.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
		
	
	
}
add_action( 'wp_enqueue_scripts', 'simgo_scripts' );


/**
 * Returns the optional custom logo URL.
 *
 *
 */
function simgo_the_custom_logo_url() {
	
	//Capture output from the WP custom logo. If you have the WordPress on a lower version of 4.5 to your website, you will use get_theme_mod( 'custom_logo' ).
	if ( function_exists( 'the_custom_logo' ) ) {
		ob_start();
			the_custom_logo();
			$logo_wp = ob_get_contents();
		ob_end_clean();
		
		$pattern = '/<img.+src=\"(.*?)\".+>/i';
		$matchCount = preg_match( $pattern, $logo_wp, $match ); 
		if ( $matchCount > 0 ) {
			$logo_url = $match[ 1 ];
		} else {
			$logo_url = '';
		}
	
	  
		
	} else {
	    $logo_url = esc_html( get_theme_mod( 'theme_extra_custom_logo' ) );
	}
	
	return $logo_url;
}


/**
 * Register widget area.
 *
 */
require_once get_template_directory() . '/inc/class/class-modify-category-widget.php';
require_once get_template_directory() . '/inc/class/class-modify-recentpost-widget.php';
require_once get_template_directory() . '/inc/class/class-modify-meta-widget.php';
require_once get_template_directory() . '/inc/class/class-reg-widgets.php';

function simgo_widgets_init() {
	
	register_widget( 'Simgo_WP_widget_categories' );
	register_widget( 'Simgo_WP_Widget_Recent_Posts' );
	register_widget( 'Simgo_WP_Widget_Meta' );
	register_widget( 'Simgo_SocialMedia_Buttons_Widget' );

	
	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'simgo' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Main sidebar that appears on the left.', 'simgo' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s side-post-list">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	
	// Footer 1
	register_sidebar( array(
		'name'			=> __( 'Footer Widget 1', 'simgo' ),
		'id'			    => 'footer-one',
		'description'	=> __( 'Widgets in this area are used in the first footer region.', 'simgo' ),
		'before_widget'	=> '<div class="footer-widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h6 class="widget-title">',
		'after_title'	=> '</h6>',
	) );

	// Footer 2
	register_sidebar( array(
		'name'			=> __( 'Footer Widget 2', 'simgo' ),
		'id'			    => 'footer-two',
		'description'	=> __( 'Widgets in this area are used in the second footer region.', 'simgo' ),
		'before_widget'	=> '<div class="footer-widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h6 class="widget-title">',
		'after_title'	=> '</h6>',
	) );
	
	// Footer 3
	register_sidebar( array(
		'name'			=> __( 'Footer Widget 3', 'simgo' ),
		'id'			    => 'footer-three',
		'description'	=> __( 'Widgets in this area are used in the third footer region.', 'simgo' ),
		'before_widget'	=> '<div class="footer-widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h6 class="widget-title">',
		'after_title'	=> '</h6>',
	) );
	
	
	
}
add_action( 'widgets_init', 'simgo_widgets_init' );


//Custom widget categories's count
function simgo_categories_list_group_filter ($variable) {
   $variable = str_replace('(', '<span class="cat-item-count"> ', $variable);
   $variable = str_replace(')', ' </span>', $variable);
   return $variable;
}
add_filter('wp_list_categories','simgo_categories_list_group_filter');


/**
 * Returns sidebar HTML code
 *
 */
function simgo_dynamic_sidebar( $index ) {
	
    // capture output from the widgets
	ob_start();
		dynamic_sidebar( $index );
		$out = ob_get_contents();
	ob_end_clean();
 
 
   $out = 
               //uix portfolio
			   str_replace( 'class="recent-portfolio-item"', 'class="recent-portfolio-item" data-target-pjax-singleSide="1"', 
			  
			   //menu
			   str_replace( 'class="menu"', 'class="menu" data-target-pjax="1"', 
			   
			   //post & pages & archives list
			   str_replace( '<ul>', '<ul data-target-pjax="1">', 
			   
			   //tagcloud
			   str_replace( 'class="tagcloud"', 'class="tagcloud post-tags" data-target-pjax="1"', 
			   
			   //recent comments
			   str_replace( 'id="recentcomments"', 'id="recentcomments" data-target-pjax-singleFullscreen="1"', 
			   
			   //calendar
               str_replace( 'id="wp-calendar"', 'id="wp-calendar" style="width:100%;" data-target-pjax="1"', 
			   
			   //search form
               preg_replace( '%role="search"(.*?)action=%si', 'method="get" target="_blank" id="search-box" class="search-box relative ma-t-20" action=', 
               preg_replace( '%<input type="submit"(.*?)>%si', '<i class="fa fa-search" id="wp-search-submit"></i>', 
			   
			   
			   $out
			   ))))))));
	
   
   
   echo $out;
}

/*
* Moving the Comment Text Field to Bottom
*
*/
function simgo_move_comment_field_to_bottom( $fields ) {
	$comment_field = $fields[ 'comment' ];
	unset( $fields[ 'comment' ] );
	$fields[ 'comment' ] = $comment_field;
	return $fields;
}

add_filter( 'comment_form_fields', 'simgo_move_comment_field_to_bottom' );


/*
* Custom HTML in comment_form() 
*
*/
function simgo_comment_form( $form_options ) {

	//Extend WordPress comment form with your own custom fields.
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$required_text = sprintf( ' ' . __('Required fields are marked %s','simgo'), '<span class="req-icon">*</span>' );
	$post_id = get_the_ID();
	$user = wp_get_current_user();
	$user_identity = $user->exists() ? $user->display_name : '';
	
	
	
	$fields =  array( 
	
	'author' => '<p class="comment-form-author">
					  <label for="author">'.__( 'Name', 'simgo' ).'</label>'.( $req ? '<span class="req-icon">*</span>' : '' ).
					  '<input id="author" name="author" type="text" class="required" value="'.esc_attr( $commenter['comment_author'] ).'" size="45" '.$aria_req.' />
				</p>',
				
	'email'  => '<p class="comment-form-email">
					  <label for="email">'.__( 'Email', 'simgo' ).'</label>'.( $req ? '<span class="req-icon">*</span>' : '' ).
					  '<input id="email" name="email" type="text" class="required email" value="'.esc_attr( $commenter['comment_author_email'] ).'" size="45" '.$aria_req.' />
				 </p>',
				 
	'url'    => '<p class="comment-form-url">
					 <label for="url">'.__( 'Website', 'simgo' ).'</label>'.
					 '<input id="url" name="url" type="text" value="'.esc_attr( $commenter['comment_author_url'] ).'" size="45" />
				</p>', );
	
	
	$form_options = array( 
	
		'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
		
		'comment_field'        => '<p class="comment-form-comment">
										<label for="comment">'.__( 'Comment', 'simgo' ).'</label>'.( $req ? '<span class="req-icon">*</span>' : '' ).
										'<textarea id="comment" class="required" name="comment" cols="45" rows="8" '.$aria_req.'></textarea>
								   </p>
								   
								   ',
								   
		'must_log_in'          => '<p class="must-log-in">
									   '.__( 'You must be', 'simgo' ).' <a href="'.wp_login_url( apply_filters( 'the_permalink',get_permalink( $post_id ) ) ).'">'.__( 'logged in', 'simgo' ).'</a> '.__( 'to post a comment', 'simgo' ).'.
								  </p>',
		
		'logged_in_as'         => ''.__( 'Logged in as', 'simgo' ).' <a href="'.admin_url( 'profile.php' ).'">'.$user_identity.'</a>.
								   <a href="'.wp_logout_url( apply_filters( 'the_permalink',get_permalink( $post_id ) ) ).'" title="'.__( 'Log out of this account', 'simgo' ).'">'.__( 'Log out', 'simgo' ).'?</a>
								   <hr>
								   ',
								   
		'comment_notes_before' => '<p class="comment-notes">'.__( 'Your email address will not be published', 'simgo' ).''.( $req ? $required_text : '' ).'</p>',
		
	
		
		'id_form'              => 'commentform',
		'id_submit'            => 'submit',
		'class_submit'         => 'submit btn-custom-default',
		'title_reply'          => __( 'Leave a Reply', 'simgo' ),
		'title_reply_to'       => __( 'Leave a Reply to %s', 'simgo' ),
		'cancel_reply_link'    => __( 'Cancel reply', 'simgo' ),
		'label_submit'         => __( 'Leave a message', 'simgo' )
	 );

	return $form_options;
}

add_filter( 'comment_form_defaults', 'simgo_comment_form' );
	

/**
 * Extend the default WordPress body classes.
 *
 */
function simgo_body_class( $classes ) {
	
	if ( is_home() || is_front_page() ) {
		$classes[] = 'custom-homepage';
	}
	
	
	if ( ! is_multi_author() ) {
		$classes[] = 'single-author';
	}
		

	if ( is_active_sidebar( 'sidebar-1' ) && ! is_attachment() && ! is_404() ) {
		$classes[] = 'sidebar';
	}
		
	if ( !class_exists( 'UixSlides' ) ) { 
	    $classes[] = 'noplugins-slides';
		
	}
	

	
	if ( !class_exists( 'UixShortcodes' ) ) { 
	    $classes[] = 'noplugins-shortcodes';
		
	}
	


	return $classes;
}
add_filter( 'body_class', 'simgo_body_class' );


/**
 * Limit Search Results to Custom Post Type
 */
function simgo_searchfilter( $query ) {
    if ( $query->is_search ) {
        $query->set( 'post_type', array( 'post', 'uix_products' ) );
    };
    return $query;
}
add_filter( 'pre_get_posts', 'simgo_searchfilter' );




/*
 * Upload Media Control
 *
 */
require get_template_directory() . '/inc/class/class-upload-control.php';



/**
 * Gallery metabox
 */
require get_template_directory() . '/inc/add-ons/gallery-metabox/init.php';
require get_template_directory() . '/inc/add-ons/gallery-metabox/front-display.php';


/*
 * Modify WP menu for dropdown styles
 *
 */
require get_template_directory() . '/inc/class/class-walker-menu.php';



/**
 * Since I'm already doing a tutorial, I'm not going to include comments to
 * this code, but if you want, you can check out the "example.php" file
 * inside the ZIP you downloaded - it has a very detailed documentation.
 */
 
require_once get_template_directory() . '/inc/class/class-tgm-plugin-activation.php';

function simgo_require_plugins() {
 
    $plugins = array(
	
			array(
				'name'               => 'Kirki', 
				'slug'               => 'kirki', 
				'source'             => 'https://downloads.wordpress.org/plugin/kirki.2.3.6.zip',
				'required'           => true, 
				'version'            => '2.3.6'
			),
	
			array(
				'name'               => 'Uix Shortcodes', 
				'slug'               => 'uix-shortcodes', 
				'source'             => 'https://downloads.wordpress.org/plugin/uix-shortcodes.1.0.4.zip',
				'required'           => false, 
				'version'            => '1.0.4'
			),
		
			array(
				'name'               => 'Uix Slides', 
				'slug'               => 'uix-slides', 
				'source'             => 'https://github.com/xizon/Uix-Slides/archive/master.zip',
				'required'           => false,
				'version'            => '1.0.0'
			),	
		
	);
    $config = array(
		'id'           => 'simgo-tgmpa', // your unique TGMPA ID
		'default_path' => '', // default absolute path
		'menu'         => 'simgo-install-required-plugins', // menu slug
		'has_notices'  => true, // Show admin notices
		'dismissable'  => false, // the notices are NOT dismissable
		'dismiss_msg'  => '', // this message will be output at top of nag
		'is_automatic' => true, // automatically activate plugins after installation
		'message'      => '', // message to output right before the plugins table
		'strings'      => array() // The array of message strings that TGM Plugin Activation uses
	);
 
    tgmpa( $plugins, $config );
 
}
add_action( 'tgmpa_register', 'simgo_require_plugins' );




/*
 * Theme functions:  Custom Metaboxes and Fields
 *
 * Adding Custom Meta Boxes to the WordPress Admin Interface
 */
require get_template_directory() . '/inc/core/metaboxes-post-init.php';
require get_template_directory() . '/inc/core/metaboxes-page-init.php';



/*
 * Theme functions:  Initialize custom widgets
 *
 */
require get_template_directory() . '/inc/core/activate-widgets.php';


/*
 * Theme functions:  Canonical
 *
 * Canonical SEO Content syndication add-on adds rel=canonical tag for content syndication. 
 * The meta box is added at front-end page.
 * The code added here is injected into the <head> tag on every page in your site.
 */
 

require get_template_directory() . '/inc/core/canonical.php';



/*
 * Theme functions:  Custom Quick Reply Link
 *
 * Change the comment reply link to use 'Reply to <Author First Name>'
 */
//require get_template_directory() . '/inc/core/comment-reply.php';



/*
 * Theme functions:  Infinite scroll support
 *
 * Infinite scroll allows you automatically load new content into view when a reader approaches the bottom of the page. 
 */
require get_template_directory() . '/inc/core/infinite-scroll.php';


/*
 * Theme functions:  Masonry support
 *
 * Note: The function will be used to .php file of theme when get_header() exist. The code could also be sought for header.php file.
 * The .php file of theme contains the following standard code:
 
   add_action( 'wp_footer', 'simgo_masonry_init', 100 );
   
 */
require get_template_directory() . '/inc/core/masonry.php';



/*
 * Theme functions:  Get and set post views
 *
 * This little improvement  will enable you to display how many times a post has been viewed in total. 
 * The total views are displayed in entry meta of each post.
 */
require get_template_directory() . '/inc/core/set-post-views.php';

/*
 * Theme functions: Get latest posts
 *
 * Support for customizable latest posts block. 
 */
require get_template_directory() . '/inc/core/get-latest-posts.php';


/*
 * Theme functions: Get hottest posts
 *
 * Support for customizable hottest posts block. 
 */
require get_template_directory() . '/inc/core/get-hot-posts.php';





/*
 * Theme functions: Get latest comments
 *
 * Support for customizable comments block. 
 */
require get_template_directory() . '/inc/core/get-latest-comments.php';



/*
 * Theme functions: Get Paginate
 *
 * Support for customizable pagination styles. 
 */
 
require get_template_directory() . '/inc/core/get-paginate.php';


/*
 * Theme functions: Get post meta
 *
 * Support for customizable post types. 
 */
 
require get_template_directory() . '/inc/core/get-post-meta.php';





/*
 * Theme functions:  Filter tagcloud
 *
 *
 * Given the count of the posts with that tag.
 */
require get_template_directory() . '/inc/core/filter-tagcloud.php';




/*
 * Theme functions:  Filter post tag
 *
 *
 * Add a filter to add a class to tag link in wordpress.
 */
require get_template_directory() . '/inc/core/filter-post-tag.php';




/*
 * Theme functions: Filter admin bar
 *
 * Some menus were able to on top of WordPress admin bar.
 */
require get_template_directory() . '/inc/core/filter-admin-bar.php';

/*
 * Filter thumbnail 
 *
 * Remove image dimension attributes
 */
require get_template_directory() . '/inc/core/filter-thumb.php';


/*
 * Customize controls print theme notice
 *
 * The idea is to reduce repetitive actions.
 */
require get_template_directory() . '/inc/core/customize-ex.php';




/**
 * Initialize the update checker.  
 * 
 * From now on, you can update our themes and plugins just like you would any other theme 
 * that you have downloaded from the WordPress.org repository. Just click "update" and you're 
 * done! No longer will you need to re-download and re-install our themes when a new version 
 * is released.
 *
 */
	
require get_template_directory() . '/inc/update/automatic-theme-plugin-update.php';




/*
 *  Building WordPress themes using the Kirki Customizer
 *
 */
require get_template_directory() . '/inc/add-ons/customizer-extras/options-init.php';

