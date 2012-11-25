<?php
/**
 * Rocket Lift Parent Theme functions and definitions
 *
 * @package Rocket Lift Parent Theme
 * @since Rocket Lift Parent Theme 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Rocket Lift Parent Theme 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'rocket_lift_parent_theme_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since Rocket Lift Parent Theme 1.0
 */
function rocket_lift_parent_theme_setup() {

	/**
	 * Utilities
	 */
	require( get_template_directory() . '/inc/utilities.php' );

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom Walkers
	 */
	require( get_template_directory() . '/inc/walkers.php' );

	/**
	 * Custom Theme Options
	 */
	require( get_template_directory() . '/inc/theme-options/theme-options.php' );
	
	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on Rocket Lift Parent Theme, use a find and replace
	 * to change 'rocket_lift_parent_theme' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'rocket_lift_parent_theme', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'rocket_lift_parent_theme' ),
	) );

	/**
	 * Add support for the Aside Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', ) );
}
endif; // rocket_lift_parent_theme_setup
add_action( 'after_setup_theme', 'rocket_lift_parent_theme_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since Rocket Lift Parent Theme 1.0
 */
function rocket_lift_parent_theme_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'rocket_lift_parent_theme' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'widgets_init', 'rocket_lift_parent_theme_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function rocket_lift_parent_theme_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'rocket_lift_parent_theme_scripts' );

/**
 * Implement the Custom Header feature
 */
//require( get_template_directory() . '/inc/custom-header.php' );


/**
 *	Rocket Lift Attribution
 */

if ( ! function_exists( 'rocket_lift_attribution' ) ) {
	function rocket_lift_attribution() {
		printf( __( 'Website designed and maintained by %1$s.', 'rocket_lift_parent_theme' ), '<a href="http://rocketlift.com/" rel="designer">Rocket Lift Inc</a>' );
	}
	add_action( 'rocket_lift_parent_theme_attribution', 'rocket_lift_attribution', 10 );
}
