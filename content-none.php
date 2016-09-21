<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * 
 */

?>


<p><strong><?php _e('Nothing Found','simgo'); ?></strong></p>

<?php if ( is_home() && current_user_can( 'publish_posts' ) ) { ?>

     <p><?php sprintf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'simgo' ),admin_url( 'post-new.php' ) ); ?></p>

<?php } elseif ( is_search() ) { ?>

     <p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'simgo' ); ?></p>
  
<?php } else { ?>

     <p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'simgo' ); ?></p>

<?php } ?>

