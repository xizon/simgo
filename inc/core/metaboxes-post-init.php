<?php
/*
 * Custom Metaboxes and Fields
 *
 */
 
 
/*
 * Display the Correct Metabox at the Correct Time
 * 
 */
if ( !function_exists( 'simgo_post_ex_metaboxes_display_script' ) ) {
	function simgo_post_ex_metaboxes_display_script() {
		global $metaboxes;
		if ( get_post_type() == "post" ) :
			?>
			<script type="text/javascript">
			( function( $ ) {
			
				var formats = { 
					'post-format-video': 'video_settings', 
					'post-format-link': 'link_settings',
					'post-format-audio': 'audio_settings',
					'post-format-gallery': 'gallery-metabox',
					
					
				};
				var ids = '#video_settings,#link_settings,#audio_settings,#gallery-metabox';
				
				function displayMetaboxes() {
					// Hide all post format metaboxes
					$(ids).hide();
					// Get current post format
					var selectedElt = $("input[name='post_format']:checked").attr("id");
	 
					// If exists, fade in current post format metabox
					if ( formats[selectedElt] )
						$("#" + formats[selectedElt]).fadeIn();
				}
	 
				$(function() {
					// Show/hide metaboxes on page load
					displayMetaboxes();
	 
					// Show/hide metaboxes on change event
					$("input[name='post_format']").change(function() {
						displayMetaboxes();
					});
				});
			
			} )( jQuery );
			</script>
			<?php
		endif;
	}		

}
add_action( 'admin_print_scripts', 'simgo_post_ex_metaboxes_display_script', 1000 );
 
 
/*
 * Creating the Custom Field Box (link)
 * 
 */
if ( !function_exists( 'simgo_post_ex_metaboxes_link' ) ) {
	function simgo_post_ex_metaboxes_link(){  
		add_meta_box( 
			'link_settings', 
			__( 'Link Settings', 'simgo' ), 
			'simgo_post_ex_metaboxes_link_options', 
			'post', 
			'normal', 
			'high'
		);  
	}  

}
add_action( 'admin_init', 'simgo_post_ex_metaboxes_link' );     

if ( !function_exists( 'simgo_post_ex_metaboxes_link_options' ) ) {

	function simgo_post_ex_metaboxes_link_options( $object ) {  
	
		wp_nonce_field( basename( __FILE__ ) , 'meta-box-nonce' );
		
		/** Nonce **/
		echo '<input type="hidden" name="post_format_meta_box_nonce" value="' . wp_create_nonce( basename( __FILE__ ) ) . '" />';
		
	
	?>  
    
		<!-- Begin Fields -->
		<table class="form-table custom_metabox">
	
		<tr>
			<th style="width:18%"><label>Link Format URL</label></th>
			<td>
		<input type="text" class="regular-text" name="cus_post_ex_link" value="<?php echo get_post_meta( $object->ID, 'cus_post_ex_link', true ); ?>"/>
		<p class="custom_metabox_description"><?php _e( 'Enter the url for your link format URL.', 'simgo' ); ?> </p>
		
			</td>
		</tr>
	
        </table>
		<!-- End Fields -->
<?php  
	}  
}


/*
 * Creating the Custom Field Box (video)
 * 
 */
if ( !function_exists( 'simgo_post_ex_metaboxes_video' ) ) {
	function simgo_post_ex_metaboxes_video(){  
		add_meta_box( 
			'video_settings', 
			__( 'Video Settings', 'simgo' ), 
			'simgo_post_ex_metaboxes_video_options', 
			'post', 
			'normal', 
			'high'
		);  
	}  

}
add_action( 'admin_init', 'simgo_post_ex_metaboxes_video' );     

if ( !function_exists( 'simgo_post_ex_metaboxes_video_options' ) ) {

	function simgo_post_ex_metaboxes_video_options( $object ) {  
	
		wp_nonce_field( basename( __FILE__ ) , 'meta-box-nonce' );
		
		/** Nonce **/
		echo '<input type="hidden" name="post_format_meta_box_nonce" value="' . wp_create_nonce( basename( __FILE__ ) ) . '" />';
		
	
	?>  
    
		<!-- Begin Fields -->
		<table class="form-table custom_metabox">
		<tr>
			<th style="width:18%"><label><?php _e( 'Video URL', 'simgo' ); ?></label></th>
			<td>
		<input type="text" class="regular-text" name="cus_post_ex_video" value="<?php echo get_post_meta( $object->ID, 'cus_post_ex_video', true ); ?>"/>
		<p class="custom_metabox_description"><?php _e( 'Enter in a video URL that is compatible with WordPress\'s built-in oEmbed feature. E.g.,https://www.youtube.com/watch?v=abc', 'simgo' ); ?> </p>
		
			</td>
		</tr>
	
        
        </table>
		<!-- End Fields -->
<?php  
	}  
}


/*
 * Creating the Custom Field Box (audio)
 * 
 */
if ( !function_exists( 'simgo_post_ex_metaboxes_audio' ) ) {
	function simgo_post_ex_metaboxes_audio(){  
		add_meta_box( 
			'audio_settings', 
			__( 'Audio Settings', 'simgo' ), 
			'simgo_post_ex_metaboxes_audio_options', 
			'post', 
			'normal', 
			'high'
		);  
	}  

}
add_action( 'admin_init', 'simgo_post_ex_metaboxes_audio' );     

if ( !function_exists( 'simgo_post_ex_metaboxes_audio_options' ) ) {

	function simgo_post_ex_metaboxes_audio_options( $object ) {  
	
		wp_nonce_field( basename( __FILE__ ) , 'meta-box-nonce' );
		
		/** Nonce **/
		echo '<input type="hidden" name="post_format_meta_box_nonce" value="' . wp_create_nonce( basename( __FILE__ ) ) . '" />';
		
	
	?>  
    
		<!-- Begin Fields -->
		<table class="form-table custom_metabox">
	
		<tr>
			<th style="width:18%"><label><?php _e( 'Audio URL', 'simgo' ); ?></label></th>
			<td>
		<input type="text" class="regular-text" name="cus_post_ex_audio" value="<?php echo get_post_meta( $object->ID, 'cus_post_ex_audio', true ); ?>"/>
		<p class="custom_metabox_description"><?php _e( 'Just enter the MP3, SoundCloud or Audiomack URL.', 'simgo' ); ?></p>
		
			</td>
		</tr></table>
		<!-- End Fields -->
<?php  
	}  
}


/*
 * Saving the Custom Data
 * 
 */  
if ( !function_exists( 'simgo_post_ex_save_custom_meta_box' ) ) {
	function simgo_post_ex_save_custom_meta_box( $post_id, $post, $update ) {
		if ( !isset( $_POST[ 'meta-box-nonce' ] ) || !wp_verify_nonce($_POST[ 'meta-box-nonce' ], basename( __FILE__ ) ) ) return $post_id;
		if( !current_user_can( 'edit_post', $post_id ) )return $post_id;
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return $post_id;
		
		$slug = "post";
		if( $slug != $post->post_type ) return $post_id;
	
		if( isset( $_POST[ 'cus_post_ex_video' ] ) ) update_post_meta($post_id, 'cus_post_ex_video', $_POST[ 'cus_post_ex_video' ] );
		if( isset( $_POST[ 'cus_post_ex_link' ] ) ) update_post_meta($post_id, 'cus_post_ex_link', $_POST[ 'cus_post_ex_link' ] );
		if( isset( $_POST[ 'cus_post_ex_audio' ] ) ) update_post_meta($post_id, 'cus_post_ex_audio', $_POST[ 'cus_post_ex_audio' ] );
	
	}

}

add_action( 'save_post', 'simgo_post_ex_save_custom_meta_box', 10, 3);


