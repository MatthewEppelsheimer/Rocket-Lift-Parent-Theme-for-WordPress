<?php

/**
 *	Add debugging functions to hooks
 */

add_action( 'fractal_block_begin', function( $block ){ fractal_debug_capture( 'fractal_block', 'before doing work', $block ); }, 10 );
add_action( 'fractal_block_end', function( $block ){ fractal_debug_capture( 'fractal_block', 'after doing work', $block ); }, 10 );
// add_action( 'fractal_collapse_begin', function( $block ) { fractal_debug_capture( 'fractal_collapse', "setting 'working_block' to $block", $block ); }, 10 );
add_action( 'fractal_collapse_end', function( $block ) { global $fractal; fractal_debug_capture( 'fractal_collapse', "after assembling output for block '$block', which is: " . $fractal['blocks'][$block]['html'], $block ); }, 10 )	;

/**
 *	Capture debugging info during fractal_collapse function
 */

function fractal_test_suite_debug_capture_fractal_collapse( $calling_function, $context, $block ) {
	global $fractal_debug, $fractal;
	if ( ! isset( $fractal_debug['log'] ) )
		$fractal_debug['log'] = '<ul>'; 

	$output = "<li><p>";
	if ( isset( $calling_function ) )
		$output .= "During $calling_function(), ";
	if ( isset( $block ) )
		$output .="with \$block of <strong>'$block'</strong>, ";
	if ( isset( $context ) )
		$output .= "$context, ";
	$output .= "the \$fractal global's state is currently:";
	$output .= "</p>\n" . print_r( $fractal, true ) . "</li>";
	
	$fractal_debug['log'] .= $output;
}

add_action( 'fractal_debug_capture_fractal_collapse', 'fractal_test_suite_debug_capture_fractal_collapse', 10, 3 );

/**
 *	Capture debugging info during fractal_block function
 */

function fractal_test_suite_debug_capture_fractal_block( $calling_function, $context, $block ) {
	global $fractal_debug, $fractal;
	if ( ! isset( $fractal_debug['log'] ) )
		$fractal_debug['log'] = '<ul>'; 
	
	$output = "<li><p>";
	if ( isset( $calling_function ) )
		$output .= "Durring $calling_function(), ";
	if ( isset( $block ) )
		$output .="with \$block of <strong>'$block'</strong>, ";
	if ( isset( $context ) )
		$output .= "$context, ";
	$output .= "the \$fractal global's state is currently:";
	$output .= "</p>\n" . print_r( $fractal, true ) . "</li>";

	$fractal_debug['log'] .= $output;	
}

add_action( 'fractal_debug_capture_fractal_block', 'fractal_test_suite_debug_capture_fractal_block', 10, 3 );

/**
 *	Display debugging info
 */

function fractal_test_suite_debug_display(){
	global $fractal_debug;
	if ( isset( $fractal_debug['log'] ) ) {
		$fractal_debug['log'] .= "</ul>";
		echo $fractal_debug['log'];
	}
}

add_action( 'fractal_after', 'fractal_test_suite_debug_display', 10 );