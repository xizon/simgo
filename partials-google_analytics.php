<?php
/**
 * The template for displaying  Google analytics.
 *
 * 
 */


$google_analytics = get_theme_mod( 'custom_google_analytics' );
if ( !empty( $google_analytics ) ) {
	echo '
   <!-- Google analytics begin  -->
	<script>
	  (function(i,s,o,g,r,a,m){i[\'GoogleAnalyticsObject\']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,\'script\',\'//www.google-analytics.com/analytics.js\',\'ga\');
	
	  ga(\'create\', \''.get_theme_mod( 'custom_google_analytics').'\', \'auto\');
	  ga(\'send\', \'pageview\');
	
	</script>
	<!-- Google analytics end  -->
	';
  
} 



