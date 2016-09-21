<?php
/**
 * Building WordPress themes using the Kirki Customizer
 *
 * @package Simgo
 */

if ( class_exists( 'Kirki' ) ) {
	
	global $wp_customize;
	
	$simgo_kirki_config_id = 'simgo_kirki_custom';
	


	/*
	*
	* Kirki customizer configuration
	*
	*/
	
	Kirki::add_config( $simgo_kirki_config_id, array(
		'capability'    => 'edit_theme_options',
		'option_type'   => 'theme_mod',
	) );
	

	
	
	//Function of "Allowing html in text"
	function simgo_kirki_do_not_filter_anything( $value ) {
		return $value;
	}
		
	//Customizer styling
	function simgo_kirki_custom_configuration() {
	  $args = array(
		'logo_image'   => get_template_directory_uri() . '/inc/add-ons/customizer-extras/images/customizer-logo.png',
		'description'  => '',
		//'color_accent' => '#00bcd4',
		//'color_back'   => '#455a64',
		//'width'        => '20%',
		
	  );
	  return $args;
	}
	add_filter( 'kirki/config', 'simgo_kirki_custom_configuration' );	
			
			
	//This function adds some styles to the WordPress Customizer
	function simgo_kirki_custom_style() {
	
		wp_enqueue_style( 'kirki-customizer-custom-css', get_template_directory_uri() . '/inc/add-ons/customizer-extras/css/main.css', null, null );

	}
	if ( $wp_customize ) {
	
		add_action( 'customize_controls_print_styles', 'simgo_kirki_custom_style', 100 );
		
	}
	
	

	
    /*
     * ------------------------------------------------------------------------------------------------
     */

	
	 
	Kirki::add_section( 'panel-theme-general', array(
		'title'          => __( 'General', 'simgo' ),
		'priority'       => 1,
		'capability'     => 'edit_theme_options',

	) );
	
	/**
	 * Add the configuration.
	 * 
	 * will inherit these options
	 */
	if ( !function_exists( 'the_custom_logo' ) ) {
		Kirki::add_field( $simgo_kirki_config_id, array(
			'type'        => 'image',
			'settings'    => 'theme_extra_custom_logo',
			'label'       => __( 'Logo', 'simgo' ),
			'description' => __( 'Upload your site logo to the server. The max height for photos in this theme view is <strong>50</strong> pixels.', 'simgo' ),
			'section'     => 'panel-theme-general',
			'default'     => '',
			'priority'    => 10,
		) );
	}


	Kirki::add_field( $simgo_kirki_config_id, array(
		'type'        => 'textarea',
		'settings'    => 'custom_copyright',
		'label'       => __( 'Copyright Info', 'simgo' ),
		'description' => __( 'Add custom copyright info to WordPress footer <br>(Support HTML tags)', 'simgo' ),
		'section'     => 'panel-theme-general',
		'default'     => '&copy; '.__( 'Copyright', 'simgo' ).' 2016 &middot; <a href="'.esc_url(home_url('/')).'" title="'.get_bloginfo( 'name' ).'">'.get_bloginfo( 'name' ).'</a> | <a href="'.esc_url( __( 'https://wordpress.org/', 'simgo' ) ).'">'.sprintf( __( 'Powered by %s', 'simgo' ), 'WordPress' ).'</a>',
		'priority'    => 10,
		'sanitize_callback' => 'simgo_kirki_do_not_filter_anything',//Allowing html in text
	) );


	Kirki::add_field( $simgo_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_google_analytics',
		'label'       => __( 'Google Analytics', 'simgo' ),
		'description' => __( 'Send analytics for your shots and profile to Google Analytics, e.g. UA-00000000-0', 'simgo' ),
		'section'     => 'panel-theme-general',
		'default'     => 'UA-70658525-1',
		'priority'    => 10,
	) );
	
	
	
	
	
	Kirki::add_field( $simgo_kirki_config_id, array(
		'type'        => 'switch',
		'settings'    => 'custom_seo_canonical2',
		'label'       => __( 'SEO - Canonical Meta Tag', 'simgo' ),
		'description' => __( 'It tells search engines which page to index when multiple URLs have identical or very similar content.', 'simgo' ),
		'section'     => 'panel-theme-general',
		'default'     => true,
		'priority'    => 10,
	) );
	



    /*
     * ------------------------------------------------------------------------------------------------
     */

	
	 
	Kirki::add_section( 'panel-theme-post', array(
		'title'          => __( 'Blog Settings', 'simgo' ),
		'priority'       => 1,
		'capability'     => 'edit_theme_options',

	) );
	

	
	Kirki::add_field( $simgo_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_blog_excerpt_words',
		'label'       => __( 'Limit the Number of Words in Excerpt', 'simgo' ),
		'description' => __( 'If the post has not a custom excerpt or does not contain &lt;!--more--&gt; tag, then it\'ll automatically generate an excerpt with limit number of words.', 'simgo' ),
		'section'     => 'panel-theme-post',
		'default'     => 150,
		'priority'    => 10
	) );
	
	Kirki::add_field( $simgo_kirki_config_id, array(
		'type'        => 'slider',
		'settings'    => 'custom_blog_show',
		'label'       => __( 'Blog Pages Show at Most', 'simgo' ),
		'description' => '',
		'section'     => 'panel-theme-post',
		'default'     => get_option( 'posts_per_page' ),
		'priority'    => 10,
		'choices' => array(
			'min' => 1,
			'max' => 100,
			'step' => 1,
		),
	) );
	

	
	Kirki::add_field( $simgo_kirki_config_id, array(
		'type'        => 'radio-image',
		'settings'    => 'custom_blog_layout',
		'label'       => __( 'Blog Layout', 'simgo' ),
		'description' => '',
		'section'     => 'panel-theme-post',
		'default'     => 'standard',
		'priority'    => 10,
		'choices'     => array(
			'standard'   => get_template_directory_uri() . '/inc/add-ons/customizer-extras/images/blog/layout-style-1.png',
			'no-sidebar' => get_template_directory_uri() . '/inc/add-ons/customizer-extras/images/blog/layout-style-2.png',
			'masonry'  => get_template_directory_uri() . '/inc/add-ons/customizer-extras/images/blog/layout-style-3.png',
		),
	) );
	
	Kirki::add_field( $simgo_kirki_config_id, array(
		'type'        => 'switch',
		'settings'    => 'custom_blog_infinitescroll_list',
		'label'       => __( 'Add Infinite Scroll to Your Blog', 'simgo' ),
		'description' => __( 'Automatically append the next page of posts (via AJAX) to your page when a user scrolls to the bottom or clicks button of loading from the bottom.', 'simgo' ),
		'section'     => 'panel-theme-post',
		'default'     => false,
		'priority'    => 10,
	) );

	
	Kirki::add_field( $simgo_kirki_config_id, array(
		'type'        => 'switch',
		'settings'    => 'custom_blog_infinitescroll_eff',
		'label'       => __( 'Infinite Scrolling Occurs when You Scroll to The Bottom', 'simgo' ),
		'description' => __( 'Close to the bottom the refresh occurs, and this option acts on posts. When this option is enabled, you will see the effect.', 'simgo' ),
		'section'     => 'panel-theme-post',
		'default'     => false,
		'priority'    => 10,
	) );

	
	
	
	
	
    /*
     * ------------------------------------------------------------------------------------------------
     */

	
	 
	Kirki::add_panel( 'panel-theme-styling', array(
		'priority'       => 2,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __( 'Styling', 'simgo' ),
		'description'    => '',
	) );
	
	/**
	 * ----------------------  Add sub section. ----------------------
	 * 
	 */
	
	Kirki::add_section( 'panel-theme-paging', array(
		'title'          => __( 'Paging Navigation', 'simgo' ),
		'priority'       => 2,
		'capability'     => 'edit_theme_options',
		'panel'          => 'panel-theme-styling',
	) );
	
	/**
	 * Add the configuration.
	 * 
	 * will inherit these options
	 */
	

	Kirki::add_field( $simgo_kirki_config_id, array(
		'type'        => 'switch',
		'settings'    => 'custom_pagination',
		'label'       => __( 'Numeric Pagination', 'simgo' ),
		'description' => __( 'If this option turned on, the post list will use numeric pagination.', 'simgo' ),
		'section'     => 'panel-theme-paging',
		'default'     => true,
		'priority'    => 10,
	) );
	
	
	
	
	
	/**
	 * ----------------------  Add sub section. ----------------------
	 * 
	 */
	
    if ( class_exists( 'UixShortcodes' ) ) {
	
		Kirki::add_section( 'panel-theme-map', array(
			'title'          => __( 'Google Map', 'simgo' ),
			'priority'       => 2,
			'capability'     => 'edit_theme_options',
			'panel'          => 'panel-theme-styling',
		) );
		
		/**
		 * Add the configuration.
		 * 
		 * will inherit these options
		 */
		
		
		Kirki::add_field( $simgo_kirki_config_id, array(
			'type'        => 'radio-image',
			'settings'    => 'custom_map_style',
			'label'       => __( 'Map Style', 'simgo' ),
			'description' => __( 'You can make a search, use the name of a place, city, state, or address, or click the location on the map to get lat long coordinates. &rarr; <a href="//www.latlong.net/" target="_blank">Get Latitude Longitude</a>', 'simgo' ),
			'section'     => 'panel-theme-map',
			'default'     => 'normal',
			'priority'    => 10,
			'choices'     => array(
					'normal'   => UixShortcodes::plug_directory() .'assets/images/map/map-style-1.png',
					'gray'   => UixShortcodes::plug_directory() .'assets/images/map/map-style-2.png',
					'black'   => UixShortcodes::plug_directory() .'assets/images/map/map-style-3.png',
					'real'   => UixShortcodes::plug_directory() .'assets/images/map/map-style-4.png',
					'terrain'   => UixShortcodes::plug_directory() .'assets/images/map/map-style-5.png',
					'white'   => UixShortcodes::plug_directory() .'assets/images/map/map-style-6.png',
					'dark-blue'   => UixShortcodes::plug_directory() .'assets/images/map/map-style-7.png',
					'dark-blue-2'   => UixShortcodes::plug_directory() .'assets/images/map/map-style-8.png',
					'blue'   => UixShortcodes::plug_directory() .'assets/images/map/map-style-9.png',
					'flat'   => UixShortcodes::plug_directory() .'assets/images/map/map-style-10.png',
				
			),
		) );
		
		Kirki::add_field( $simgo_kirki_config_id, array(
			'type'        => 'text',
			'settings'    => 'custom_map_name',
			'label'       => __( 'Place Name', 'simgo' ),
			'description' => '',
			'section'     => 'panel-theme-map',
			'default'     => 'SEO San Francisco, CA, Gough Street, San Francisco, CA',
			'priority'    => 10,
		) );
		
		Kirki::add_field( $simgo_kirki_config_id, array(
			'type'        => 'text',
			'settings'    => 'custom_map_latitude',
			'label'       => __( 'Latitude', 'simgo' ),
			'description' => '',
			'section'     => 'panel-theme-map',
			'default'     => '37.7770776',
			'priority'    => 10,
		) );
		
		
		Kirki::add_field( $simgo_kirki_config_id, array(
			'type'        => 'text',
			'settings'    => 'custom_map_longitude',
			'label'       => __( 'Longitude', 'simgo' ),
			'description' => '',
			'section'     => 'panel-theme-map',
			'default'     => '-122.4414289',
			'priority'    => 10,
		) );
	
		
		Kirki::add_field( $simgo_kirki_config_id, array(
			'type'        => 'slider',
			'settings'    => 'custom_map_zoom',
			'label'       => __( 'Zoom', 'simgo' ),
			'description' => '',
			'section'     => 'panel-theme-map',
			'default'     => '14',
			'priority'    => 10,
			'choices' => array(
				'min' => 3,
				'max' => 21,
				'step' => 1,
			),
		) );
		
		
		Kirki::add_field( $simgo_kirki_config_id, array(
			'type'        => 'text',
			'settings'    => 'custom_map_height',
			'label'       => __( 'Map Height', 'simgo' ),
			'description' => __( 'It default to using a 100% width. The height pixel (px) unit is adjustable.', 'simgo' ),
			'section'     => 'panel-theme-map',
			'default'     => '285',
			'priority'    => 10,
		) );
	
		Kirki::add_field( $simgo_kirki_config_id, array(
			'type'        => 'image',
			'settings'    => 'custom_map_marker',
			'label'       => __( 'Marker', 'simgo' ),
			'description' => __( 'By default, a marker uses a standard image. Markers can display custom images, in which case they are usually referred to as "icons."', 'simgo' ),
			'section'     => 'panel-theme-map',
			'default'     => UixShortcodes::plug_directory() .'assets/images/map/map-location.png',
			'priority'    => 10,
		) );

	}

	
	
 

	
    /*
     * ------------------------------------------------------------------------------------------------
     */

	 
	Kirki::add_section( 'panel-theme-social', array(
		'title'          => __( 'Social Links', 'simgo' ),
		'priority'       => 6,
		'capability'     => 'edit_theme_options',

	) );
	
	/**
	 * Add the configuration.
	 * 
	 * will inherit these options
	 */
	 
	/*Usage*/
	Kirki::add_field( $simgo_kirki_config_id, array(
		'type'        => 'custom',
		'settings'    => 'custom_usage-social',
		'section'     => 'panel-theme-social',
		'default'     => '<div class="kirki-tipbox"><div>
		'.__( 'Add social media icons to your website or blog. For example,', 'simgo' ).' <code>https://twitter.com/username</code>
		</div></div>',
		'priority'    => 10,
	) );
	 
	
	Kirki::add_field( $simgo_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_social_twitter',
		'label'       => '<i class="fa fa-twitter"></i> ' . __( 'Twitter', 'simgo' ),
		'description'        => __( 'Your Twitter Page URL', 'simgo' ),
		'section'     => 'panel-theme-social',
		'default'     => '',
		'priority'    => 10,
	) );
	
	Kirki::add_field( $simgo_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_social_facebook',
		'label'       => '<i class="fa fa-facebook"></i> ' . __( 'Facebook', 'simgo' ),
		'description'        => __( 'Your Facebook Page URL', 'simgo' ),
		'section'     => 'panel-theme-social',
		'default'     => '',
		'priority'    => 10,
	) );
	
	Kirki::add_field( $simgo_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_social_googleplus',
		'label'       => '<i class="fa fa-google-plus"></i> ' . __( 'Google+', 'simgo' ),
		'description'        => __( 'Your Google+ Page URL', 'simgo' ),
		'section'     => 'panel-theme-social',
		'default'     => '',
		'priority'    => 10,
	) );
	
	Kirki::add_field( $simgo_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_social_medium',
		'label'       => '<i class="fa fa-medium"></i> ' . __( 'Medium', 'simgo' ),
		'description'        => __( 'Your Medium Page URL', 'simgo' ),
		'section'     => 'panel-theme-social',
		'default'     => '',
		'priority'    => 10,
	) );
	
	
	Kirki::add_field( $simgo_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_social_producthunt',
		'label'       => '<i class="fa fa-product-hunt"></i> ' . __( 'Product Hunt', 'simgo' ),
		'description'        => __( 'Your Product Hunt Page URL', 'simgo' ),
		'section'     => 'panel-theme-social',
		'default'     => '',
		'priority'    => 10,
	) );
	
	Kirki::add_field( $simgo_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_social_lastfm',
		'label'       => '<i class="fa fa-lastfm"></i> ' . __( 'Last.fm', 'simgo' ),
		'description'        => __( 'Your Last.fm Page URL', 'simgo' ),
		'section'     => 'panel-theme-social',
		'default'     => '',
		'priority'    => 10,
	) );
	
	Kirki::add_field( $simgo_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_social_soundcloud',
		'label'       => '<i class="fa fa-soundcloud"></i> ' . __( 'SoundCloud', 'simgo' ),
		'description'        => __( 'Your SoundCloud Page URL', 'simgo' ),
		'section'     => 'panel-theme-social',
		'default'     => '',
		'priority'    => 10,
	) );
	
	Kirki::add_field( $simgo_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_social_dropbox',
		'label'       => '<i class="fa fa-dropbox"></i> ' . __( 'Dropbox', 'simgo' ),
		'description'        => __( 'Your Dropbox Page URL', 'simgo' ),
		'section'     => 'panel-theme-social',
		'default'     => '',
		'priority'    => 10,
	) );
	
	
	Kirki::add_field( $simgo_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_social_dribbble',
		'label'       => '<i class="fa fa-dribbble"></i> ' . __( 'Dribbble', 'simgo' ),
		'description'        => __( 'Your Dribbble Page URL', 'simgo' ),
		'section'     => 'panel-theme-social',
		'default'     => '',
		'priority'    => 10,
	) );
	
	Kirki::add_field( $simgo_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_social_pinterest',
		'label'       => '<i class="fa fa-pinterest"></i> ' . __( 'Pinterest', 'simgo' ),
		'description'        => __( 'Your Pinterest Page URL', 'simgo' ),
		'section'     => 'panel-theme-social',
		'default'     => '',
		'priority'    => 10,
	) );
	
	Kirki::add_field( $simgo_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_social_behance',
		'label'       => '<i class="fa fa-behance"></i> ' . __( 'Behance', 'simgo' ),
		'description'        => __( 'Your Behance Page URL', 'simgo' ),
		'section'     => 'panel-theme-social',
		'default'     => '',
		'priority'    => 10,
	) );
	
	Kirki::add_field( $simgo_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_social_deviantart',
		'label'       => '<i class="fa fa-deviantart"></i> ' . __( 'Deviantart', 'simgo' ),
		'description'        => __( 'Your Deviantart Page URL', 'simgo' ),
		'section'     => 'panel-theme-social',
		'default'     => '',
		'priority'    => 10,
	) );
	
	Kirki::add_field( $simgo_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_social_flickr',
		'label'       => '<i class="fa fa-flickr"></i> ' . __( 'Flickr', 'simgo' ),
		'description'        => __( 'Your Flickr Page URL', 'simgo' ),
		'section'     => 'panel-theme-social',
		'default'     => '',
		'priority'    => 10,
	) );
	
	Kirki::add_field( $simgo_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_social_github',
		'label'       => '<i class="fa fa-github"></i> ' . __( 'Github', 'simgo' ),
		'description'        => __( 'Your Github Page URL', 'simgo' ),
		'section'     => 'panel-theme-social',
		'default'     => '',
		'priority'    => 10,
	) );	
	
	
	Kirki::add_field( $simgo_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_social_instagram',
		'label'       => '<i class="fa fa-instagram"></i> ' . __( 'Instagram', 'simgo' ),
		'description'        => __( 'Your Instagram Page URL', 'simgo' ),
		'section'     => 'panel-theme-social',
		'default'     => '',
		'priority'    => 10,
	) );	
	
	
	Kirki::add_field( $simgo_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_social_linkedin',
		'label'       => '<i class="fa fa-linkedin"></i> ' . __( 'Linkedin', 'simgo' ),
		'description'        => __( 'Your Linkedin Page URL', 'simgo' ),
		'section'     => 'panel-theme-social',
		'default'     => '',
		'priority'    => 10,
	) );	
	
	Kirki::add_field( $simgo_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_social_digg',
		'label'       => '<i class="fa fa-digg"></i> ' . __( 'Digg', 'simgo' ),
		'description'        => __( 'Your Digg Page URL', 'simgo' ),
		'section'     => 'panel-theme-social',
		'default'     => '',
		'priority'    => 10,
	) );	
	
	
	Kirki::add_field( $simgo_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_social_tumblr',
		'label'       => '<i class="fa fa-tumblr"></i> ' . __( 'Tumblr', 'simgo' ),
		'description'        => __( 'Your Tumblr Page URL', 'simgo' ),
		'section'     => 'panel-theme-social',
		'default'     => '',
		'priority'    => 10,
	) );	
	
	Kirki::add_field( $simgo_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_social_youtube',
		'label'       => '<i class="fa fa-youtube"></i> ' . __( 'Youtube', 'simgo' ),
		'description'        => __( 'Your Youtube Page URL', 'simgo' ),
		'section'     => 'panel-theme-social',
		'default'     => '',
		'priority'    => 10,
	) );	
	
	Kirki::add_field( $simgo_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_social_vimeo',
		'label'       => '<i class="fa fa-vimeo-square"></i> ' . __( 'Vimeo', 'simgo' ),
		'description'        => __( 'Your Vimeo Page URL', 'simgo' ),
		'section'     => 'panel-theme-social',
		'default'     => '',
		'priority'    => 10,
	) );	
	
	Kirki::add_field( $simgo_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_social_reddit',
		'label'       => '<i class="fa fa-reddit"></i> ' . __( 'Reddit', 'simgo' ),
		'description'        => __( 'Your Reddit Page URL', 'simgo' ),
		'section'     => 'panel-theme-social',
		'default'     => '',
		'priority'    => 10,
	) );	
	
	
	Kirki::add_field( $simgo_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_social_weibo',
		'label'       => '<i class="fa fa-weibo"></i> ' . __( 'Weibo', 'simgo' ),
		'description'        => __( 'Your Weibo Page URL', 'simgo' ),
		'section'     => 'panel-theme-social',
		'default'     => '',
		'priority'    => 10,
	) );	
	
	
	Kirki::add_field( $simgo_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_social_web',
		'label'       => '<i class="fa fa-globe"></i> ' . __( 'Website', 'simgo' ),
		'description'        => __( 'Your Website URL', 'simgo' ),
		'section'     => 'panel-theme-social',
		'default'     => '',
		'priority'    => 10,
	) );	
	
		/*
		 * ------------------------------------------------------------------------------------------------
		 ------------------------------------------------------------------------------------------------
		 ------------------------------------------------------------------------------------------------
		 */
	
	
	if ( class_exists( 'UixSlides' )  ) {
		
		
		
		/*
		 * ------------------------------------------------------------------------------------------------
		 */
	
	 
		Kirki::add_section( 'panel-theme-uix-slides', array(
			'title'          => __( 'Uix Slides Settings', 'simgo' ),
			'priority'       => 1,
			'capability'     => 'edit_theme_options',
	
		) );
		
		/**
		 * Add the configuration.
		 * 
		 * will inherit these options
		 */
		
			
	
	
		Kirki::add_field( $simgo_kirki_config_id, array(
			'type'        => 'radio',
			'settings'    => 'custom_uix_slides_effect',
			'label'       => __( 'Effect', 'simgo' ),
			'description' => '',
			'section'     => 'panel-theme-uix-slides',
			'default'     => 'fade',
			'priority'    => 10,
			'choices'     => array(
				'slide'   => __( 'Slide', 'simgo' ),
				'fade' => __( 'Fade', 'simgo' ),
			),
		) );
		
		Kirki::add_field( $simgo_kirki_config_id, array(
			'type'        => 'switch',
			'settings'    => 'custom_uix_slides_auto',
			'label'       => __( 'Automatically Transition', 'simgo' ),
			'description' => __( 'Setup a slideshow for the slider to animate automatically.', 'simgo' ),
			'section'     => 'panel-theme-uix-slides',
			'default'     => true,
			'priority'    => 10,
		) );
		
		Kirki::add_field( $simgo_kirki_config_id, array(
			'type'        => 'slider',
			'settings'    => 'custom_uix_slides_effect_duration',
			'label'       => __( 'Speed of images appereance in ms', 'simgo' ),
			'description' => '',
			'section'     => 'panel-theme-uix-slides',
			'default'     => 600,
			'priority'    => 10,
			'choices' => array(
				'min' => 0,
				'max' => 5000,
				'step' => 100,
			),
		) );
	
	
		Kirki::add_field( $simgo_kirki_config_id, array(
			'type'        => 'slider',
			'settings'    => 'custom_uix_slides_speed',
			'label'       => __( 'Delay between images in ms', 'simgo' ),
			'description' => '',
			'section'     => 'panel-theme-uix-slides',
			'default'     => 10000,
			'priority'    => 10,
			'choices' => array(
				'min' => 0,
				'max' => 15000,
				'step' => 100,
			),
		) );
	
		
		Kirki::add_field( $simgo_kirki_config_id, array(
			'type'        => 'switch',
			'settings'    => 'custom_uix_slides_arr_nav',
			'label'       => __( 'Show Arrow Navigation', 'simgo' ),
			'description' => __( 'Create previous/next arrow navigation.', 'simgo' ),
			'section'     => 'panel-theme-uix-slides',
			'default'     => true,
			'priority'    => 10,
		) );
		
	
		Kirki::add_field( $simgo_kirki_config_id, array(
			'type'        => 'switch',
			'settings'    => 'custom_uix_slides_paging_nav',
			'label'       => __( 'Show Paging Navigation', 'simgo' ),
			'description' => __( 'Create navigation for paging control of each slide.', 'simgo' ),
			'section'     => 'panel-theme-uix-slides',
			'default'     => false,
			'priority'    => 10,
		) );
	
	
		Kirki::add_field( $simgo_kirki_config_id, array(
			'type'        => 'switch',
			'settings'    => 'custom_uix_slides_animloop',
			'label'       => __( 'Animation Loop', 'simgo' ),
			'description' => __( 'Gives the slider a seamless infinite loop.', 'simgo' ),
			'section'     => 'panel-theme-uix-slides',
			'default'     => true,
			'priority'    => 10,
		) );
	
		Kirki::add_field( $simgo_kirki_config_id, array(
			'type'        => 'switch',
			'settings'    => 'custom_uix_slides_smoothheight',
			'label'       => __( 'Smooth Height', 'simgo' ),
			'description' => __( 'Animate the height of the slider smoothly for slides of varying height.', 'simgo' ),
			'section'     => 'panel-theme-uix-slides',
			'default'     => false,
			'priority'    => 10,
		) );
	
	
		Kirki::add_field( $simgo_kirki_config_id, array(
			'type'        => 'switch',
			'settings'    => 'custom_uix_slides_textinfo',
			'label'       => __( 'Show Text Information', 'simgo' ),
			'description' => '',
			'section'     => 'panel-theme-uix-slides',
			'default'     => true,
			'priority'    => 10,
		) );
	
	
		
		Kirki::add_field( $simgo_kirki_config_id, array(
			'type'        => 'custom',
			'settings'    => 'custom_uix_slides_single_size_title',
			'label'       => __( 'Image Size for Entry', 'simgo' ),
			'description' => '',
			'section'     => 'panel-theme-uix-slides',
			'default'     => '',
			'priority'    => 10,
		) );
	
	
		Kirki::add_field( $simgo_kirki_config_id, array(
			'type'        => 'text',
			'settings'    => 'custom_uix_slides_single_size_w',
			'label'       => '',
			'description' => __( 'Max Width (in px)', 'simgo' ),
			'section'     => 'panel-theme-uix-slides',
			'default'     => '1920',
			'priority'    => 10
		) );
		
		Kirki::add_field( $simgo_kirki_config_id, array(
			'type'        => 'text',
			'settings'    => 'custom_uix_slides_single_size_h',
			'label'       => '',
			'description' => __( 'Max Height (in px)', 'simgo' ),
			'section'     => 'panel-theme-uix-slides',
			'default'     => '9999',
			'priority'    => 10
		) );
		
	
	
	
	
		/**
		 * ----------------------  Add google fonts section. ----------------------
		 * 
		 */
		
		Kirki::add_field( $simgo_kirki_config_id, array(
			'type'        => 'custom',
			'settings'    => 'custom_uix_slides_gf_title',
			'label'       => __( 'Slider Title', 'simgo' ),
			'description' => '',
			'section'     => 'panel-theme-uix-slides',
			'default'     => '',
			'priority'    => 10,
		) );
		
		
		/**
		 * Add the configuration.
		 * 
		 * will inherit these options
		 */
	
		Kirki::add_field( $simgo_kirki_config_id, array(
			'type'     => 'typography',
			'settings' => 'custom_uix_slides_google_font_slidetitle_family',
			'description'    => __( 'Font Family', 'simgo' ),
			'section'  => 'panel-theme-uix-slides',
			'default'     => array(
				'font-family'    => 'Open Sans',
				'variant'        => '700',
				'font-size'      => '35px',
				'letter-spacing' => '0',
				'subsets'        => array( 'latin-ext' ),
				'text-transform' => 'none',
			),
			'priority'    => 10,
			'output'      => array(
				array(
					'element' => '.uix-slides-homepage-title',
				),
			),
			
		) );
		
	
	
		
		/**
		 * ----------------------  Add google fonts section. ----------------------
		 * 
		 */
		
		Kirki::add_field( $simgo_kirki_config_id, array(
			'type'        => 'custom',
			'settings'    => 'custom_uix_slides_gf_caption',
			'label'       => __( 'Slider Caption', 'simgo' ),
			'description' => '',
			'section'     => 'panel-theme-uix-slides',
			'default'     => '',
			'priority'    => 10,
		) );
		
		
		/**
		 * Add the configuration.
		 * 
		 * will inherit these options
		 */
	
		Kirki::add_field( $simgo_kirki_config_id, array(
			'type'     => 'typography',
			'settings' => 'custom_uix_slides_google_font_slidecaption_family',
			'description'    => __( 'Font Family', 'simgo' ),
			'section'  => 'panel-theme-uix-slides',
			'default'     => array(
				'font-family'    => 'Open Sans',
				'variant'        => 'regular',
				'font-size'      => '14px',
				'letter-spacing' => '0',
				'subsets'        => array( 'latin-ext' ),
				'text-transform' => 'none',
			),
			'priority'    => 10,
			'output'      => array(
				array(
					'element' => '.uix-slides-homepage-caption',
				),
			),
			
			
		) );
	
	

		Kirki::add_field( $simgo_kirki_config_id, array(
			'type'        => 'custom',
			'settings'    => 'custom_uix_slides_css_tip',
			'label'       => __( 'Custom CSS', 'simgo' ),
			'description' => __( 'You can overview the original styles to overwrite it. It will be on creating new styles to your website, without modifying original <code>.css</code> files.', 'simgo' ),
			'section'     => 'panel-theme-uix-slides',
			'default'     => '
			<p>'.__( 'CSS file root directory:', 'simgo' ).'
				<a href="'.get_template_directory_uri().'/uix-slides-style.css" id="uix_slides_view_css" target="_blank" >'.get_template_directory_uri().'/uix-slides-style.css</a>
			</p>  
			',
			'priority'    => 10
		) );
		
		Kirki::add_field( $simgo_kirki_config_id, array(
			'type'        => 'code',
			'settings'    => 'custom_uix_slides_css',
			'label'       => '',
			'description' => '',
			'section'     => 'panel-theme-uix-slides',
			'default'     => '',
			'priority'    => 10,
			'choices'     => array(
				'language' => 'css',
				'theme'    => 'monokai',
				'height'   => 250,
			),
		) );
	
		
	
	
	
	}






}


