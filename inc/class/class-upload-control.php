<?php
/**
 * Upload Media Control
 *
 * 
 */

class Simgo_UploadMedia {
	
	public static function add( $args ) {
		
		if ( !is_array( $args ) ) return;
		$title            = ( isset( $args[ 'title' ] ) ) ? $args[ 'title' ] : '';
		$value            = ( isset( $args[ 'value' ] ) ) ? esc_attr( $args[ 'value' ] ) : '';
		$placeholder      = ( isset( $args[ 'placeholder' ] ) ) ? esc_attr( $args[ 'placeholder' ] ) : '';
		$id               = ( isset( $args[ 'id' ] ) ) ? esc_attr( $args[ 'id' ] ) : '';
		$name             = ( isset( $args[ 'name' ] ) ) ? esc_attr( $args[ 'name' ] ) : '';
		
		//Enqueue the media scripts
		wp_enqueue_media();

		echo '
		<div class="custom-upbtn-container">
			
			<label for="'.$id.'">'.$title.'</label>
			'.( !empty( $id ) ? '<input type="text" id="'.$id.'" class="widefat" name="'.$name.'" value="'.$value.'" placeholder="'.$placeholder.'" />' : '' ).' 
			<a href="javascript:" class="custom-button custom-upbtn upload-media-btn" id="trigger_id_'.$id.'" data-remove-btn="drop_trigger_id_'.$id.'" data-insert-img="'.$id.'" data-insert-preview="'.$id.'_preview"><i class="dashicons dashicons-format-image"></i>'.__( 'Select an image', 'simgo' ).'</a>
			<a href="javascript:" class="remove-btn" id="drop_trigger_id_'.$id.'" data-insert-img="'.$id.'" data-insert-preview="'.$id.'_preview" style="display:none">'.__( 'remove image', 'simgo' ).'</a>
			'.( !empty( $value ) ? '<div id="'.$id.'_preview" class="custom-field_img_preview" style="display:block"><img src="'.$value.'" alt=""></div>' : '<div id="'.$id.'_preview" class="custom-field_img_preview"><img src="" alt=""></div>' ).' 
			
		</div>
		'."\n";	
	 
	}
	

}

