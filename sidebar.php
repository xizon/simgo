<?php
/**
 * The sidebar containing the main widget area.
 *
 * 
 */

?>


<?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>

    <div class="side" role="complementary">
        <?php simgo_dynamic_sidebar( 'sidebar-1' ); ?>
    </div><!-- .side -->

<?php } ?>