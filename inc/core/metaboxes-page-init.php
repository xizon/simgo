<?php
/*
 * Custom Metaboxes and Fields
 *
 * Define the metabox and field configurations.
 * @param  array $meta_boxes
 * @return array
 *
 */
 
/*
 * Creating the Custom Field Box
 * 
 */
 


if ( !function_exists( 'simgo_page_ex_metaboxes_1' ) ) {
	function simgo_page_ex_metaboxes_1(){  
		add_meta_box( 
			'simgo_page_meta_heading', 
			__( 'Title & Subheading Settings', 'simgo' ), 
			'simgo_page_ex_metaboxes_options_1', 
			'page', 
			'normal', 
			'high'
		);  
	}  

}
add_action( 'admin_init', 'simgo_page_ex_metaboxes_1' );     

if ( !function_exists( 'simgo_page_ex_metaboxes_options_1' ) ) {
	
	function simgo_page_ex_metaboxes_options_1( $object ) {  
	
		wp_nonce_field( basename( __FILE__ ) , 'meta-box-nonce' );
	
?>  
         
         
		<!-- Begin Fields -->
		<table class="form-table custom_metabox">
        

			<tr>
				<th style="width:18%"><label><?php _e( 'Capitalization', 'simgo' ); ?></label><p class="custom_metabox_title_desc"><?php _e( 'Change the capitalization of the page title & subheading', 'simgo' ); ?></p></th>
				<td>
				   
						<label class="custom_radio_text"><input type="radio" name="cus_page_ex_headingcase" value="uppercase" <?php if ( get_post_meta( $object->ID, 'cus_page_ex_headingcase', true ) == 'uppercase' || empty( get_post_meta( $object->ID, 'cus_page_ex_headingcase', true ) ) ){ echo 'checked';}; ?>/><?php _e( 'Upper case', 'simgo' ); ?></label>
					   <label class="custom_radio_text"><input type="radio" name="cus_page_ex_headingcase" value="lowercase" <?php if ( get_post_meta( $object->ID, 'cus_page_ex_headingcase', true ) == 'lowercase' ){ echo 'checked';}; ?>/><?php _e( 'Lower case', 'simgo' ); ?></label>
                       <label class="custom_radio_text"><input type="radio" name="cus_page_ex_headingcase" value="capitalize" <?php if ( get_post_meta( $object->ID, 'cus_page_ex_headingcase', true ) == 'capitalize' ){ echo 'checked';}; ?>/><?php _e( 'Capitalized case', 'simgo' ); ?></label>
                       <label class="custom_radio_text"><input type="radio" name="cus_page_ex_headingcase" value="none" <?php if ( get_post_meta( $object->ID, 'cus_page_ex_headingcase', true ) == 'none' ){ echo 'checked';}; ?>/><?php _e( 'None', 'simgo' ); ?></label>
                       
				</td>
			</tr>
            
        
 			<tr>
				<th style="width:18%"><label><?php _e( 'Subheading', 'simgo' ); ?></label><p class="custom_metabox_title_desc"><?php _e( 'Enter your page subheading. It could be left blank.', 'simgo' ); ?></p></th>
				<td>
				       <textarea rows="3" cols="40" name="cus_page_ex_subheading" id="cus_page_ex_subheading"><?php echo get_post_meta( $object->ID, 'cus_page_ex_subheading', true ); ?></textarea>
                       
				</td>
			</tr>
            
            
        
 			<tr>
				<th style="width:18%"><label><?php _e( 'Letter Spacing', 'simgo' ); ?></label><p class="custom_metabox_title_desc"><?php _e( 'The space between characters for the page title & subheading.', 'simgo' ); ?></p></th>
				<td>
                <input type="text" class="custom_short_text" value="<?php if ( get_post_meta( $object->ID, 'cus_page_ex_letterspacing', true ) == '' ){ echo 2;} else {  echo get_post_meta( $object->ID, 'cus_page_ex_letterspacing', true ); }; ?>" name="cus_page_ex_letterspacing">px
                
				
				</td>
			</tr>
        
			
     
		</table>
		<!-- End Fields -->
	
    
<?php  
	}  
}


//------------------------------------------------------------------------------------------------------
 
 


if ( !function_exists( 'simgo_page_ex_metaboxes_2' ) ) {
	function simgo_page_ex_metaboxes_2(){  
		add_meta_box( 
			'simgo_page_meta_attr', 
			__( 'Page Settings', 'simgo' ), 
			'simgo_page_ex_metaboxes_options_2', 
			'page', 
			'normal', 
			'high'
		);  
	}  

}
add_action( 'admin_init', 'simgo_page_ex_metaboxes_2' );     

if ( !function_exists( 'simgo_page_ex_metaboxes_options_2' ) ) {
	
	function simgo_page_ex_metaboxes_options_2( $object ) {  
	
		wp_nonce_field( basename( __FILE__ ) , 'meta-box-nonce' );
	
?>  
         
         
		<!-- Begin Fields -->
		<table class="form-table custom_metabox">
            
             <div class="note">
                 <p>
                 <em><?php _e( 'Just make sure to select this template file as the <strong>"Default Template"</strong> for this page from the <strong>"Page Attributes"</strong> section. ', 'simgo' ); ?></em>
                 </p>
             </div>
        
  		
			<tr>
				<th style="width:18%"><label><?php _e( 'Display Page Title', 'simgo' ); ?></label></th>
				<td>
				   
                     
						<label class="custom_radio_text"><input type="radio" name="cus_page_ex_title" value="hide" <?php if ( get_post_meta( $object->ID, 'cus_page_ex_title', true ) == 'hide' ){ echo 'checked';}; ?>/><?php _e( 'Disable', 'simgo' ); ?></label>
					   <label class="custom_radio_text"><input type="radio" name="cus_page_ex_title" value="show" <?php if ( get_post_meta( $object->ID, 'cus_page_ex_title', true ) == 'show' || empty( get_post_meta( $object->ID, 'cus_page_ex_title', true ) ) ){ echo 'checked';}; ?>/><?php _e( 'Enable', 'simgo' ); ?></label>
				</td>
			</tr>
            
            
            
			<tr>
				<th style="width:18%"><label><?php _e( 'Sidebar', 'simgo' ); ?></label></th>
				<td>
				<select name="cus_page_ex_sidebar">	
					<option value="none"  <?php if ( get_post_meta( $object->ID, 'cus_page_ex_sidebar', true ) == 'none' ){ echo 'selected'; }; ?> ><?php _e( 'No Sidebar', 'simgo' ); ?></option>
					<option value="has"  <?php if ( get_post_meta( $object->ID, 'cus_page_ex_sidebar', true ) == 'has' ){ echo 'selected'; }; ?>><?php _e( 'Right Sidebar', 'simgo' ); ?></option>
                    <option value="has2"  <?php if ( get_post_meta( $object->ID, 'cus_page_ex_sidebar', true ) == 'has2' ){ echo 'selected'; }; ?>><?php _e( 'Left Sidebar', 'simgo' ); ?></option>
				</select>
			   
				</td>
			</tr>
            
     
     
		</table>
		<!-- End Fields -->
	
    
<?php  
	}  
}



/*
 * Saving the Custom Data
 * 
 */ 
if ( !function_exists( 'simgo_page_save_custom_meta_box' ) ) {
	function simgo_page_save_custom_meta_box( $post_id, $post, $update ) {
		if ( !isset( $_POST[ 'meta-box-nonce' ] ) || !wp_verify_nonce($_POST[ 'meta-box-nonce' ], basename( __FILE__ ) ) ) return $post_id;
		if( !current_user_can( 'edit_post', $post_id ) )return $post_id;
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return $post_id;
		
		$slug = "page";
		if( $slug != $post->post_type ) return $post_id;
	
		if( isset( $_POST[ 'cus_page_ex_title' ] ) ) update_post_meta($post_id, 'cus_page_ex_title', $_POST[ 'cus_page_ex_title' ] );
		if( isset( $_POST[ 'cus_page_ex_sidebar' ] ) ) update_post_meta($post_id, 'cus_page_ex_sidebar', $_POST[ 'cus_page_ex_sidebar' ] );
		if( isset( $_POST[ 'cus_page_ex_subheading' ] ) ) update_post_meta($post_id, 'cus_page_ex_subheading', $_POST[ 'cus_page_ex_subheading' ] );
		if( isset( $_POST[ 'cus_page_ex_letterspacing' ] ) ) update_post_meta($post_id, 'cus_page_ex_letterspacing', $_POST[ 'cus_page_ex_letterspacing' ] );
		if( isset( $_POST[ 'cus_page_ex_headingcase' ] ) ) update_post_meta($post_id, 'cus_page_ex_headingcase', $_POST[ 'cus_page_ex_headingcase' ] );
		
	
	}

}

add_action( 'save_post', 'simgo_page_save_custom_meta_box', 10, 3);



/*
 * Removing a Meta Box
 * 
 */ 
if ( !function_exists( 'simgo_page_remove_custom_field_meta_box' ) ) {
	function simgo_page_remove_custom_field_meta_box() {
		remove_meta_box( 'postimagediv', 'page', 'side' );
	}
}
add_action( 'do_meta_boxes', 'simgo_page_remove_custom_field_meta_box' );


if ( !function_exists( 'simgo_page_featured_image_column_remove_post_types' ) ) {
	function simgo_page_featured_image_column_remove_post_types( $post_types ) {
		foreach( $post_types as $key => $post_type ) {
			if ( 'page' === $post_type ) // Post type you'd like removed. Ex: 'post' or 'page'
				unset( $post_types[$key] );
		}
		return $post_types;
	}
}
add_filter( 'featured_image_column_post_types', 'simgo_page_featured_image_column_remove_post_types', 11 );



/*
 * Remove comments metabox of "page" but still allow comments
 *
*/

if ( is_admin() ) {
    function simgo_remove_meta_boxes() {
       remove_meta_box( 'commentstatusdiv', 'page', 'normal' );
		
    }
    add_action( 'admin_menu', 'simgo_remove_meta_boxes' );

}


