<?php
/**
 * The template for displaying search forms in Rocket Lift Parent Theme
 *
 * @package Rocket Lift Parent Theme
 * @since Rocket Lift Parent Theme 1.0
 */
?>
	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<label for="s" class="assistive-text"><?php _e( 'Search', 'rocket_lift_parent_theme' ); ?></label>
		<input type="text" class="field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="<?php esc_attr_e( 'Search &hellip;', 'rocket_lift_parent_theme' ); ?>" />
		<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'rocket_lift_parent_theme' ); ?>" />
	</form>
