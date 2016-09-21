<?php
/**
 * Theme functions
 * *
 
 --------------------------------------
 
 
 * Customize controls print theme notice
 *
 * The idea is to reduce repetitive actions.
 */
 
if ( !function_exists( 'simgo_customize_ex_js' ) ) {
	
	function simgo_customize_ex_js(){
		echo '
			<script>
				jQuery(document).ready(function(){  
				
				    jQuery(\'.accordion-section:eq(1)\').prepend(\'<span class="get-addon" style="display:block;"><a href="https://uiux.cc/?rel='.home_url( '/' ).'" target="_blank">Theme Available!<br> Take a look more themes from UIUX Lab &rarr;</a></span>\').hide();
					
				
				});
				
			</script>

		';
		
	}

}

add_action( 'customize_controls_print_footer_scripts', 'simgo_customize_ex_js' );



if ( !function_exists( 'simgo_customize_ex_css' ) ) {
	function simgo_customize_ex_css() {
		echo '
		<style>
			
			.get-addon {
				padding: 5px;
				display: inline-block;
			}
			
			.get-addon a {
				display: block;
				padding-left: 15px;
				padding-right: 0;
				background: #57C97A;
				color: #FFF;
				font-size: 11px;
				padding: 3px 5px;
				font-weight: bold;
				-moz-transition: .2s ease-in-out;
				-o-transition: .2s ease-in-out;
				-webkit-transition: .2s ease-in-out;
				transition: .2s ease-in-out;
			}
			
			.get-addon a:hover {
				background: #333;
			}
			
		
			
		</style>
		';
	}

}

add_action( 'customize_controls_print_styles', 'simgo_customize_ex_css' );
