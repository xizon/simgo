<?php
/**
 * Initialize custom widgets
 * 
 
 --------------------------------------
 
 */


/**
 * Enqueue the script and style to widget (eg. color picker)
 *
 */
if ( ! function_exists( 'simgo_custom_load' ) ) {
	
	function simgo_custom_load() {    
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
	}
	
}
add_action( 'load-widgets.php', 'simgo_custom_load' );