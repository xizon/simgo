<?php
/**
 * Social buttons
 *
 * Add icons linked to social profiles on the front page.
 *
 */
 


// Footer social buttons
global $social_footer;
$social_footer = '';

$social_property = 'itemprop="sameAs" rel="nofollow" target="_blank"';

$twitter = get_theme_mod( 'custom_social_twitter' );
$facebook = get_theme_mod( 'custom_social_facebook' );
$googleplus = get_theme_mod( 'custom_social_googleplus' );
$medium = get_theme_mod( 'custom_social_medium' );
$dribbble = get_theme_mod( 'custom_social_dribbble' );
$pinterest = get_theme_mod( 'custom_social_pinterest' );
$behance = get_theme_mod( 'custom_social_behance' );
$deviantart = get_theme_mod( 'custom_social_deviantart' );
$flickr = get_theme_mod( 'custom_social_flickr' );
$github = get_theme_mod( 'custom_social_github' );
$instagram = get_theme_mod( 'custom_social_instagram' );
$linkedin = get_theme_mod( 'custom_social_linkedin' );
$digg = get_theme_mod( 'custom_social_digg' );
$tumblr = get_theme_mod( 'custom_social_tumblr' );
$youtube = get_theme_mod( 'custom_social_youtube' );
$vimeo = get_theme_mod( 'custom_social_vimeo' );
$reddit = get_theme_mod( 'custom_social_reddit' );
$producthunt = get_theme_mod( 'custom_social_producthunt' );
$lastfm = get_theme_mod( 'custom_social_lastfm' );
$soundcloud = get_theme_mod( 'custom_social_soundcloud' );
$dropbox = get_theme_mod( 'custom_social_dropbox' );
$weibo = get_theme_mod( 'custom_social_weibo' );
$web = get_theme_mod( 'custom_social_web' );



if ( !empty( $twitter ) )  $social_footer .= '<li><a href="'.$twitter.'" '.$social_property.'><i class="fa fa-twitter"></i></a></li>';
if ( !empty( $facebook ) )  $social_footer .= '<li><a href="'.$facebook.'" '.$social_property.'><i class="fa fa-facebook"></i></a></li>';
if ( !empty( $googleplus ) )  $social_footer .= '<li><a href="'.$googleplus.'" '.$social_property.'><i class="fa fa-google-plus"></i></a></li>';
if ( !empty( $medium ) )  $social_footer .= '<li><a href="'.$medium.'" '.$social_property.'><i class="fa fa-medium"></i></a></li>';
if ( !empty( $dribbble ) )  $social_footer .= '<li><a href="'.$dribbble.'" '.$social_property.'><i class="fa fa-dribbble"></i></a></li>';
if ( !empty( $pinterest ) )  $social_footer .= '<li><a href="'.$pinterest.'" '.$social_property.'><i class="fa fa-pinterest"></i></a></li>';
if ( !empty( $behance) )  $social_footer .= '<li><a href="'.$behance.'" '.$social_property.'><i class="fa fa-behance"></i></a></li>';
if ( !empty( $deviantart) )  $social_footer .= '<li><a href="'.$deviantart.'" '.$social_property.'><i class="fa fa-deviantart"></i></a></li>';
if ( !empty( $flickr) )  $social_footer .= '<li><a href="'.$flickr.'" '.$social_property.'><i class="fa fa-flickr"></i></a></li>';
if ( !empty( $github) )  $social_footer .= '<li><a href="'.$github.'" '.$social_property.'><i class="fa fa-github"></i></a></li>';
if ( !empty( $instagram) )  $social_footer .= '<li><a href="'.$instagram.'" '.$social_property.'><i class="fa fa-instagram"></i></a></li>';
if ( !empty( $linkedin) )  $social_footer .= '<li><a href="'.$linkedin.'" '.$social_property.'><i class="fa fa-linkedin"></i></a></li>';
if ( !empty( $digg) )  $social_footer .= '<li><a href="'.$digg.'" '.$social_property.'><i class="fa fa-digg"></i></a></li>';
if ( !empty( $tumblr) )  $social_footer .= '<li><a href="'.$tumblr.'" '.$social_property.'><i class="fa fa-tumblr"></i></a></li>';
if ( !empty( $youtube) )  $social_footer .= '<li><a href="'.$youtube.'" '.$social_property.'><i class="fa fa-youtube"></i></a></li>';
if ( !empty( $vimeo) )  $social_footer .= '<li><a href="'.$vimeo.'" '.$social_property.'><i class="fa fa-vimeo-square"></i></a></li>';
if ( !empty( $reddit) )  $social_footer .= '<li><a href="'.$reddit.'" '.$social_property.'><i class="fa fa-reddit"></i></a></li>';
if ( !empty( $producthunt) )  $social_footer .= '<li><a href="'.$producthunt.'" '.$social_property.'><i class="fa fa-product-hunt"></i></a></li>';
if ( !empty( $lastfm) )  $social_footer .= '<li><a href="'.$lastfm.'" '.$social_property.'><i class="fa fa-lastfm"></i></a></li>';
if ( !empty( $soundcloud) )  $social_footer .= '<li><a href="'.$soundcloud.'" '.$social_property.'><i class="fa fa-soundcloud"></i></a></li>';
if ( !empty( $dropbox) )  $social_footer .= '<li><a href="'.$dropbox.'" '.$social_property.'><i class="fa fa-dropbox"></i></a></li>';
if ( !empty( $weibo) )  $social_footer .= '<li><a href="'.$weibo.'" '.$social_property.'><i class="fa fa-weibo"></i></a></li>';
if ( !empty( $web) )  $social_footer .= '<li><a href="'.$web.'" '.$social_property.'><i class="fa fa-globe"></i></a></li>';

?>
