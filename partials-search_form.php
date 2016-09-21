<?php
/**
 * The template for displaying Search Form.
 *
 * 
 */

 ?>

<form method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" class="field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="<?php esc_attr_e( 'Search','simgo' ); ?>" />
</form>
