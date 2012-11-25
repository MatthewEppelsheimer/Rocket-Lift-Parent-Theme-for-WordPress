<?php
/**
 * Custom template tags for this theme.
 *
 * @package Rocket Lift Parent Theme
 * @since Rocket Lift Parent Theme 1.0
 */

if ( ! function_exists( 'rocket_lift_parent_theme_content_nav' ) ):
/**
 * Display navigation to next/previous pages when applicable
 *
 * @since Rocket Lift Parent Theme 1.0
 */
function rocket_lift_parent_theme_content_nav( $nav_id ) {
	global $wp_query, $post;

	// Don't print empty markup on single pages if there's nowhere to navigate.
	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}

	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;

	$nav_class = 'site-navigation paging-navigation';
	if ( is_single() )
		$nav_class = 'site-navigation post-navigation';

	?>
	<nav role="navigation" id="<?php echo $nav_id; ?>" class="<?php echo $nav_class; ?>">
		<h1 class="assistive-text"><?php _e( 'Post navigation', 'rocket_lift_parent_theme' ); ?></h1>

	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'rocket_lift_parent_theme' ) . '</span> %title' ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'rocket_lift_parent_theme' ) . '</span>' ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'rocket_lift_parent_theme' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'rocket_lift_parent_theme' ) ); ?></div>
		<?php endif; ?>

	<?php endif; ?>

	</nav><!-- #<?php echo $nav_id; ?> -->
	<?php
}
endif; // rocket_lift_parent_theme_content_nav

if ( ! function_exists( 'rocket_lift_parent_theme_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Rocket Lift Parent Theme 1.0
 */
function rocket_lift_parent_theme_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'rocket_lift_parent_theme' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'rocket_lift_parent_theme' ), ' ' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer>
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, 40 ); ?>
					<?php printf( __( '%s <span class="says">says:</span>', 'rocket_lift_parent_theme' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
				</div><!-- .comment-author .vcard -->
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'rocket_lift_parent_theme' ); ?></em>
					<br />
				<?php endif; ?>

				<div class="comment-meta commentmetadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
					<?php
						/* translators: 1: date, 2: time */
						printf( __( '%1$s at %2$s', 'rocket_lift_parent_theme' ), get_comment_date(), get_comment_time() ); ?>
					</time></a>
					<?php edit_comment_link( __( '(Edit)', 'rocket_lift_parent_theme' ), ' ' );
					?>
				</div><!-- .comment-meta .commentmetadata -->
			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for rocket_lift_parent_theme_comment()

if ( ! function_exists( 'rocket_lift_parent_theme_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since Rocket Lift Parent Theme 1.0
 */
function rocket_lift_parent_theme_posted_on() {
	printf( __( 'Posted on <a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="byline"> by <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'rocket_lift_parent_theme' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'rocket_lift_parent_theme' ), get_the_author() ) ),
		esc_html( get_the_author() )
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category
 *
 * @since Rocket Lift Parent Theme 1.0
 */
function rocket_lift_parent_theme_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so rocket_lift_parent_theme_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so rocket_lift_parent_theme_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in rocket_lift_parent_theme_categorized_blog
 *
 * @since Rocket Lift Parent Theme 1.0
 */
function rocket_lift_parent_theme_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
// add_action( 'edit_category', 'rocket_lift_parent_theme_category_transient_flusher' );
// add_action( 'save_post', 'rocket_lift_parent_theme_category_transient_flusher' );

/**
 * Get an HTML img element representing an image attachment
 * Based on wp_get_attachment_image(), without height and width.
 *
 * While $size will accept an array, it is better to register a size with
 * add_image_size() so that a cropped version is generated. It's much more
 * efficient than having to find the closest-sized image and then having the
 * browser scale down the image.
 *
 * @since 2.0
 * @see add_image_size()
 * @uses apply_filters() Calls 'wp_get_attachment_image_attributes' hook on attributes array
 * @uses wp_get_attachment_image_src() Gets attachment file URL and dimensions
 * @since 2.5.0
 *
 * @param int $attachment_id Image attachment ID.
 * @param string $size Optional, default is 'thumbnail'.
 * @param bool $icon Optional, default is false. Whether it is an icon.
 * @return string HTML img element or empty string on failure.
 */
function rli_library_wp_get_attachment_image_without_height_and_width($attachment_id, $size = 'thumbnail', $icon = false, $attr = '') {

	$html = '';
	$image = wp_get_attachment_image_src($attachment_id, $size, $icon);
	if ( $image ) {
		list($src, $width, $height) = $image;
		if ( is_array($size) )
			$size = join('x', $size);
		$attachment =& get_post($attachment_id);
		$default_attr = array(
			'src'	=> $src,
			'class'	=> "attachment-$size",
			'alt'	=> trim(strip_tags( get_post_meta($attachment_id, '_wp_attachment_image_alt', true) )), // Use Alt field first
			'title'	=> trim(strip_tags( $attachment->post_title )),
		);
		if ( empty($default_attr['alt']) )
			$default_attr['alt'] = trim(strip_tags( $attachment->post_excerpt )); // If not, Use the Caption
		if ( empty($default_attr['alt']) )
			$default_attr['alt'] = trim(strip_tags( $attachment->post_title )); // Finally, use the title

		$attr = wp_parse_args($attr, $default_attr);
		$attr = apply_filters( 'wp_get_attachment_image_attributes', $attr, $attachment );
		$attr = array_map( 'esc_attr', $attr );
		$html = rtrim("<img ");
		foreach ( $attr as $name => $value ) {
			$html .= " $name=" . '"' . $value . '"';
		}
		$html .= ' />';
	}

	return $html;
}

/**
 * Retrieve Post Thumbnail.
 * Based on get_the_post_thumbnail().
 *
 * @since 2.0
 * @param int $post_id Optional. Post ID.
 * @param string $size Optional. Image size. Defaults to 'post-thumbnail'.
 * @param string|array $attr Optional. Query string or array of attributes.
 * @uses rli_library_wp_get_attachment_image_without_height_and_width
 */
function rli_library_get_the_post_thumbnail_without_height_and_width( $post_id = null, $size = 'post-thumbnail', $attr = '' ) {
	$post_id = ( null === $post_id ) ? get_the_ID() : $post_id;
	$post_thumbnail_id = get_post_thumbnail_id( $post_id );
	$size = apply_filters( 'post_thumbnail_size', $size );
	if ( $post_thumbnail_id ) {
		do_action( 'begin_fetch_post_thumbnail_html', $post_id, $post_thumbnail_id, $size ); // for "Just In Time" filtering of all of wp_get_attachment_image()'s filters
		if ( in_the_loop() )
			update_post_thumbnail_cache();
		$html = rli_library_wp_get_attachment_image_without_height_and_width( $post_thumbnail_id, $size, false, $attr );
		do_action( 'end_fetch_post_thumbnail_html', $post_id, $post_thumbnail_id, $size );
	} else {
		$html = '';
	}
	return apply_filters( 'post_thumbnail_html', $html, $post_id, $post_thumbnail_id, $size, $attr );
}

/**
 *	Disable automatic attachment linking
 */
 
function rli_library_disable_attachment_link( $input, $id, $size, $permalink, $icon, $text ){
	$id = intval( $id );
	$_post = & get_post( $id );
	
	if ( $text )
		$link_text = $text;
	elseif ( $size && 'none' != $size )
		$link_text = wp_get_attachment_image( $id, $size, $icon );
	else
		$link_text = '';
		
	if ( trim( $link_text ) == '' )
		$link_text = $_post->post_title;
	
	return $link_text;
}
// To use, add this in a theme or plugin:
// add_filter( 'wp_get_attachment_link', 'rli_library_disable_attachment_link', 10, 6 );

/**
 * Retrieve edit posts link for post with an option ECHO OR RETURN them
 * Based on edit_post_link() in wp-includes/link-template.php
 *
 *
 * @param string $link Optional. Anchor text.
 * @param string $before Optional. Display before edit link.
 * @param string $after Optional. Display after edit link.
 * @param int $id Optional. Post ID.
 * @param bool $echo Optional. Defaults to true to echo. False to return. 
 */
function rli_library_edit_post_link( $link = null, $before = '', $after = '', $id = 0 , $echo = true ) {
	if ( !$post = &get_post( $id ) )
		return;

	if ( !$url = get_edit_post_link( $post->ID ) )
		return;

	if ( null === $link )
		$link = __('Edit This');

	$post_type_obj = get_post_type_object( $post->post_type );
	$link = '<a class="post-edit-link" href="' . $url . '" title="' . esc_attr( $post_type_obj->labels->edit_item ) . '">' . $link . '</a>';
	if ( $echo )
		echo $before . apply_filters( 'edit_post_link', $link, $post->ID ) . $after;
	else
		return $before . apply_filters( 'edit_post_link', $link, $post->ID ) . $after;
}
