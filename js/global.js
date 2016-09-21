/*! 
 *
 * Main Javascript
 *
 */

( function($) {
    'use strict';
		
	var bodyWidth = $( document.body ).width(),
		bodyHeight = $( document.body ).height(),
		screenWidth = window.screen.width,
		screenHeight = window.screen.height,
		baseFullURL = window.location.protocol+'//'+window.location.hostname+window.location.pathname;
		
	
	$( document ).ready( function() {
		

		/*! 
		 * ************************************
		 * Navigation
		 *************************************
		 */
		//Abreast menu
		$( 'li.mega-menu.section ul.sub-menu ul' ).removeClass( 'sub-menu' );
		
		 
		// Main menu superfish
		$( 'ul.sf-menu' ).superfish( {
			delay     : 200,
			animation : {
				opacity :'show',
				height  :'show'
			},
			speed     : 'fast',
			cssArrows : false,
			disableHI : true
		} );
		
		// Mobile Menu
		$( '#navigation-toggle' ).sidr( {
			name   : 'sidr-main',
			source : '#sidr-close, #main-navigation',
			side   : 'left'
		} );
		$( '.sidr-class-toggle-sidr-close' ).click( function() {
			$.sidr( 'close', 'sidr-main' );
			return false;
		} );

		// Close the menu on window change
		$( window ).resize( function() {
			$.sidr( 'close', 'sidr-main' );
		} );
		
		
		
		/*! 
		 * ************************************
		 * search
		 *************************************
		 */	
		$( '#wp-search-submit' ).click(function () {
			$( this ).parent( 'form' ).submit();
		});

		 
		
		/*! 
		 * ************************************
		 * prettyPhoto
		 *************************************
		 */
		 $( "a[rel^='prettyPhoto']" ).prettyPhoto({
			 animation_speed:'normal',
			 theme:'dark_rounded',
			 slideshow:3000,
			 utoplay_slideshow: false
		 });


		/*! 
		 * ************************************
		 * Retina graphics for your website
		 *************************************
		 */
		$.retinaGraphics();

		/*! 
		 * ************************************
		 * FlexSlider
		 *************************************
		 */
		$(".custom-theme-flexslider").flexslider({
			namespace	      :"custom-theme-flex-",
			animation         : "slide",
			selector          : ".custom-theme-slides > div.item",
			controlNav        : true,
			smoothHeight      : true,
			prevText          : "<i class='fa fa-chevron-left'></i>",
			nextText          : "<i class='fa fa-chevron-right'></i>",
			animationSpeed    : 600,
			slideshowSpeed    : 10000,
			slideshow         : true,
			animationLoop     : true
		});


		
		/*! 
		 * ************************************
		 * Form validate
		 *************************************
		 */
		$( '[data-validate=1]' ).find(  'form'  ).validate( {
				submitHandler: function( form ) {
		
					var acturl = $(form).attr( 'action' );
					
					//Normal submitting
					/*
					$(form).find( "[type='submit']" ).attr('disabled', 'disabled');
					$(form).find( "[type='submit']" ).val('Your message has been sent successfully, all comments visible after page refresh.');
					this.form.submit();
					*/
					
					//Submit A Form Without Page Refresh using jQuery
					
					$(form).find( "[type='submit']" ).val( 'Please wait.. Process Loading...' );
					$(form).find( "[type='submit']" ).attr( 'disabled', 'disabled' );
					$.post( acturl, $(form).serialize(), function( data ) {
							$(form).find( "[type='submit']" ).val( 'Your message has been sent successfully, all comments visible after page refresh.' );
							return false;
					});
					
					
				
				},
				rules: {
					email: "required email"
				},
				messages: {
					author: "Please specify your name.",
					comment: "Please enter your message.",
					email: {
						required: "We need your email address to contact you.",
						email: "Your email address must be in the format of name@domain.com"
					},
					
					my_author: "Please specify your name.",
					my_comment: "Please enter your message.",
					my_email: {
						required: "We need your email address to contact you.",
						email: "Your email address must be in the format of name@domain.com"
					}
				
				}
		});

		
		
		

	} ); 
	
	
	
	/*! 
	 * ************************************
	 * Retina graphics for your website
	 *
	 * @link https://github.com/imulus/retinajs
	 *************************************
	 */	
	$.extend({ 
		retinaGraphics:function ( options ) { 
	
			//Determine if you have retinal display
			var hasRetina = false,
				rootRetina = (typeof exports === 'undefined' ? window : exports),
				mediaQuery = '(-webkit-min-device-pixel-ratio: 1.5), (min--moz-device-pixel-ratio: 1.5), (-o-min-device-pixel-ratio: 3/2), (min-resolution: 1.5dppx)';
		
			if ( rootRetina.devicePixelRatio > 1 || rootRetina.matchMedia && rootRetina.matchMedia( mediaQuery ).matches ) {
				hasRetina = true;
			} 
	
			if ( hasRetina ) {
				//do something
				$( '[data-retina]' ).each( function() {
					
					$( this ).attr( {
						'src'     : $( this ).attr( 'data-retina' ),
					} );


				});
			
			} 
			
			
		} 
	}); 
	

	
	$( 'body' ).waitForImages(function() {
		
		
	});
	
	
	
} ) ( jQuery );