<?php
/**
 * @since rocket-lift-parent-theme 2.0
 */

/**
 * Inline "Grammatical" navigation walker
 *
 * Note: Currently does not use Oxford commas.
 * @since rocket-lift-parent-theme-2.0
 * @see http://wordpress.stackexchange.com/questions/26671/bar-separated-navigation-by-extending-walker-nav-menu#answer-26675
 */

class RLI_Walker_Inline_Grammatical_Nav_Menu extends Walker_Nav_Menu {
	public $count;

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<span' . $id . $value . $class_names .'>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	function end_el( &$output, $item, $depth = 0 ) {
        static $count;
        $count++;
		$output .= "</span>";
		if ( $this->count *2 - 1 > $count ) {
			$output .= ", ";
		} else if ( $this->count * 2 > $count ) {
			$output .= " and ";
		} else {
			$output .= ". ";
		}
	}
	
    function walk( $elements, $max_depth, $r ) {
        $this->count = count( $elements );
        return parent::walk( $elements, $max_depth, $r );
    }
    
}