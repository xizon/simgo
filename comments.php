<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 * 
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
 
 
if ( post_password_required() ) {
	return;
}
 
 /**
 * Custom comment output
 */
function simgo_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment; 
?>
<li <?php echo comment_class( 'clearfix' );?> id="li-comment-<?php echo comment_ID();?>"><!-- Required -->


	<div class="comment-block" id="comment-<?php echo comment_ID();?>">
       
       <span class="comment-avatar">
           <?php echo get_avatar( $comment->comment_author_email,75 );?>
       </span>
		

		<div class="comment-wrap">
			<div class="comment-info">
            
                <cite class="comment-cite"><?php echo get_comment_author_link();?></cite>
	
				<a class="comment-time" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) );?>"><?php echo printf( __( '%1$s at %2$s', 'simgo' ),get_comment_date(),get_comment_time() );?></a><?php echo edit_comment_link( __( '( Edit )', 'simgo' ),'  ','' );?>
			</div>

			<div class="comment-content">
				<?php echo comment_text();?>
				<p class="reply">
					<?php echo comment_reply_link( array_merge( $args,array( 'depth' => $depth,'max_depth' => $args['max_depth'] ) ) );?>
				</p>
			</div>

			<?php if ( $comment->comment_approved == '0' ) { ?>
				<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'simgo' ) ?></em>
			<?php } ?>
		</div>
	</div>
<?php
}

?>


<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) { ?>
		<h3 class="comment-title">
			<?php
			    
				printf( _nx( 'One Comment', '%1$s Comments', get_comments_number(), 'comments title', 'simgo' ),
					number_format_i18n( get_comments_number() ),get_the_title() );
			?>
		</h3>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { // are there comments to navigate through ?>
		<div id="comment-nav-above" class="comment-navigation" role="navigation">
			<h3 class="screen-reader-text"><?php _e( 'Comment navigation', 'simgo' ); ?></h3>
			<div class="nav-previous"><?php echo previous_comments_link( __( '&larr; Older Comments', 'simgo' ) );?></div>
			<div class="nav-next"><?php echo next_comments_link( __( 'Newer Comments &rarr;', 'simgo' ) );?></div>
		</div><!-- #comment-nav-above -->
		<?php } // check for comment navigation ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array( 
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 50,
					'callback'    => 'simgo_comment'
				 ) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { // are there comments to navigate through ?>
		<div id="comment-nav-above" class="comment-navigation" role="navigation">
			<h3 class="screen-reader-text"><?php _e( 'Comment navigation', 'simgo' ); ?></h3>
			<div class="nav-previous"><?php echo previous_comments_link( __( '&larr; Older Comments', 'simgo' ) );?></div>
			<div class="nav-next"><?php echo next_comments_link( __( 'Newer Comments &rarr;', 'simgo' ) );?></div>
		</div><!-- #comment-nav-above -->
		<?php } // check for comment navigation ?>

	<?php } // have_comments() ?>

	<?php
		// If comments are closed and there are comments,let's leave a little note,shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) {
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'simgo' ); ?></p>
	<?php } ?>



</div><!-- #comments -->





