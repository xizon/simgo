<?php
/**
 * Custom Widget
 *
 * @link https://codex.wordpress.org/Widgets_API#Developing_Widgets
 * *

 */


/**
 * Load some the shortcodes panel for widget
 *
 */
class Simgo_UixShortcodes_Loader {
	
	 public function __construct() {
	 	add_action( 'load-widgets.php', array( __CLASS__, 'load_js' ) );
		add_action( 'customize_controls_print_scripts', array( __CLASS__, 'load_forms' ) );
	 }
	 
    public static function load_js(){
		add_action( 'admin_footer', array( __CLASS__, 'load_forms' ) );
    }

     //Callback Uix Shortcodes form you want
	 public static function load_forms() {
        if ( class_exists( 'UixShortcodes' ) ) {
			UixShortcodes::call_form( 'pricing-3-col' );
            UixShortcodes::call_form( 'features-2-col' );
            UixShortcodes::call_form( 'features-3-col' );
            UixShortcodes::call_form( 'team-grid' );	
			UixShortcodes::call_form( 'progress-bar' );
			UixShortcodes::call_form( 'testimonials' );
			UixShortcodes::call_form( 'map' );
        }
	 }
	 
	 //Returns this theme base width of container
	 public static function container_width() {
		 return 980;
	 } 
	 
     
}
$widget_forms = new Simgo_UixShortcodes_Loader;



/**
 * Widget for displaying Social Media Buttons
 *
 */
class Simgo_SocialMedia_Buttons_Widget extends WP_Widget {


	public function __construct() {
		$widget_ops = array(
			'classname' => 'widget_social_icons',
			'description' => __( 'Add social media buttons for your site.', 'simgo' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'social_icons', __( 'Social Media Buttons', 'simgo' ), $widget_ops );
	}
	


	/**
	 * Output the HTML for this widget.
	 *
	 */
	public function widget( $args, $instance ) {
		
		global $social_footer;

		$title  = apply_filters( 'widget_title', !isset( $instance['title'] ) ? __( 'Follow Us', 'simgo' ) : $instance['title'], $instance, $this->id_base );

		echo $args['before_widget'];
		?>
		 <?php
         if ( !empty( $title ) ) {
            echo $args['before_title'] . $title . $args['after_title'];
         }
         ?>
		<div class="brand" itemscope itemtype="http://schema.org/Organization">  
			<link itemprop="url" href="<?php echo get_site_url(); ?>"> 
			<ul class="social-list">
				<?php 
				  get_template_part( 'partials', 'social' );
				  echo $social_footer;
				 ?>
			</ul>

		</div>
		<?php

		echo $args['after_widget'];

	}

	/**
	 * Deal with the settings when they are saved by the admin.
	 *
	 * Here is where any validation should happen.
	 *
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;
	}

	/**
	 * Display the form for this widget on the Widgets page of the Admin area.
	 *
	 */
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => __( 'Follow Us', 'simgo' ) ) );
		$title    = sanitize_text_field( $instance['title'] );
		?>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'simgo' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"></p>
       
            <p><?php printf( __( 'Edit your social media buttons by going to <a href="%1$s"><strong>Appearance &raquo; Customize</strong></a>.', 'simgo' ), admin_url( 'customize.php' ) ); ?></p>

		<?php
	}
}
 

 
