 ( function($) { 
    "use strict";
	
	$( function(){  
	
		/*! 
		 *
		 * Button of insert demo data trigger for widgets
		 *
		 */	
		$( document ).on( 'click', '.insert-demo-btn', function( evt ){
			var demoid = $( this ).data( 'demo-id' ),
			    tid = $( this ).data( 'target' ),
				oldvalue = $( '#' + demoid ).val();
			
			$( '#' + tid ).val( oldvalue ).focus();
		});
		
		/*! 
		 *
		 * Keep a widget-sidebar open by default
		 *
		 */		
		$( '#widgets-right .widgets-holder-wrap' ).each(function() {
			$(this).removeClass( 'closed' );
		});
	
		
		/*! 
		 *
		 * Color Picker for widgets
		 *
		 */	
		var colorfield =  '.widget-color-picker';
			
		if ( $( 'body.widgets-php' ).length > 0 ) {
			$(document).ready(function() {
				$( '.widget-liquid-right' ).find( colorfield ).wpColorPicker();
			});

		}
		
		jQuery(document).on( 'widget-added', function(e, widget){
			widget.find( colorfield ).wpColorPicker();
		});
		
		jQuery(document).on( 'widget-updated', function(e, widget){
			widget.find( colorfield ).wpColorPicker();
		});
			
			
		
		/*! 
		 *
		 * Upload Media Control for widgets
		 *
		 */	
		
		$( document ).on( 'click', '.upload-media-btn', function( event ){
			var pid = $( this ).data( 'insert-preview' ),
			    rid = $( this ).data( 'remove-btn' ),
			    tid = $( this ).data( 'insert-img' );
				
			var upload_frame, attachment, _closebtn = "#" + rid;
			
			event.preventDefault();
			
			if( upload_frame ){
				upload_frame.open();
				return;
			}
			upload_frame = wp.media( {
				title: "Select Files",
				button: {
				text: "Insert into post",
			},
				multiple: false
			} );
			upload_frame.on( "select",function(){
				attachment = upload_frame.state().get( "selection" ).first().toJSON();
				$( "#" + tid ).val( attachment.url );
				$( "#" + pid ).find( "img" ).attr( "src",attachment.url );//image preview
				$( "#" + pid ).show();
				
				if ( _closebtn ){
					$( _closebtn ).show();
				}
			
				
			} );
			 
			upload_frame.open();
			

			 //Delete pictrue   
			 if ( _closebtn ){
				$( document ).on( 'click', _closebtn, function( event ){
				
					$( "#" + tid ).val( "" );
					$( "#" + pid ).find( "img" ).attr( "src","" );
					$( "#" + pid ).hide();
				
					$( this ).hide();
				
					
				} );		
 
			 }	
		  
	
		});
		
		

	
	});
	
 } )( jQuery );



/*! 
 * ************************************
 * Toggle
 *************************************
 */	

( function( $ ) {
  jQuery.fn.m_divToggle = function( options ) {
		var settings=$.extend( {
			'btnID':'.social_toggle',
			'targetID':'.social_box'
		}
		,options );
		return this.each( function() {
		
				jQuery( settings.btnID ).live( 'click',function(){
				
					jQuery( this ).parent().parent( 'tr' ).hide();
					jQuery( settings.targetID ).show();

				} );	
	
		  
		} );
	
  };
} )( jQuery );



/*! 
 * ************************************
 * Radio Selector
 *************************************
 */	
( function( $ ) {
  jQuery.fn.m_radioSelector = function( options ) {
		var settings=$.extend( {
			'containerID':'#demo',
			'targetID': '#input'
		}
		,options );
		return this.each( function() {
	        
			
			jQuery( settings.containerID ).find( 'span' ).live( 'click',function(){
				var _curValue = jQuery( this ).attr( 'data-value' );
				jQuery( settings.containerID ).find( 'span' ).removeClass( 'active' );
				jQuery( settings.targetID ).val( _curValue );
				jQuery( this ).addClass( 'active' );
			} );	

 
		} );
	
  };
} )( jQuery );



/*! 
 * ************************************
 * Tabs
 *************************************
 */	

( function( $ ) {
  jQuery.fn.m_tabs = function( options ) {
		var settings=$.extend( {
			'containerID':'.custom-tab-group'
		}
		,options );
		return this.each( function() {
		
		      var tabID = jQuery( settings.containerID ).attr( 'id' );
				//Create ID
				jQuery( settings.containerID ).find( '> ul' ).find( 'li' ).each(function (index) {
				  jQuery( ' a', this).attr( 'href', '#tab-'+index+tabID);
				});
				jQuery( settings.containerID ).find('.item').each(function (index) {
				  jQuery(this).attr( 'id', 'tab-'+index+tabID);
				});
			  
			  
			  jQuery( settings.containerID ).find( '> ul' ).each(function(){
				// For each set of tabs, we want to keep track of
				// which tab is active and its associated content
				var active, content, links = jQuery(this).find('a');
			
				// If the location.hash matches one of the links, use that as the active tab.
				// If no match is found, use the first link as the initial active tab.
				active = jQuery(links.filter('[href="'+location.hash+'"]')[0] || links[0]);
				active.addClass('active');
			
				content = jQuery(active[0].hash);

			
				// Hide the remaining content
				jQuery( settings.containerID ).find( '> ul' ).find( 'li a' ).removeClass('active');
				links.not(active).each(function () {
				      jQuery(this.hash).hide();
				});
				
				jQuery( settings.containerID ).find( '> ul' ).find( 'li:first a' ).addClass('active');
				jQuery( settings.containerID ).find('.item:first').show();
			
				// Bind the click event handler
				jQuery(this).on('click', 'a', function(e){
					  // Make the old tab inactive.
					  active.removeClass('active');
					  content.hide();
				
					  // Update the variables with the new link and content
					  active = jQuery(this);
					  content = jQuery(this.hash);
				
					  // Make the tab active.
					  active.addClass('active');
					  content.show();
				
					  // Prevent the anchor's default click action
					  e.preventDefault();
				});
				
				
				
				
			  });
			  
		} );
	
  };
} )( jQuery );
