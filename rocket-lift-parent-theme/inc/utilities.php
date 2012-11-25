<?php
/**
 * RLI Utilities
 * Mostly used by plugins
 *
 * @since Rocket Lift Parent Theme 2.0
 */

/**
 * RLI Utility to get get custom posts of a given type
 *
 *	@param		str		$post_type	The post type to query for
 *	@param		array	$args	Array of arguments formulated to pass to the WP_Query class constructor
 *	@param		array	$defaults_override	Array of default arguments formulated to pass to the 
 *						WP_Query class constructor and override the utility's own defaults
 *	@returns			an array of WP_Query results of the custom post type passed
 *
 *	@since		Rocket Lift Parent Theme 2.0
 *	@date		2012/11/01
 */

if ( ! function_exists( 'rli_library_get_custom_posts' ) ) {
	function rli_library_get_custom_posts( $post_type, $args, $defaults_override = array() ) {
		$defaults = array(
			'posts_per_page' => -1,
			'order' => 'ASC',
			'orderby' => 'menu_order'
		);
		$new_defaults = wp_parse_args( $defaults, $defaults_override );
		$query_args = wp_parse_args( $new_defaults, $args );
		$query_args['post_type'] = $post_type;
	
		$results = new WP_Query( $query_args );
	
		return $results;
	}
}