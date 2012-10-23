<?php
/**
 * The index.php template that all other templates inherit from
 *
 *
 * @package Rocket Lift Parent Theme
 * @since Rocket Lift Parent Theme 1.0
 */
?>

<?php fractal_template(); ?>

<?php fractal_block( 'content', function(){?>
	<article id="post-0" class="post error404 not-found">
		<header class="entry-header">
			<h1 class="entry-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'rocket_lift_parent_theme' ); ?></h1>
		</header><!-- .entry-header -->
	
		<div class="entry-content">
			<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'rocket_lift_parent_theme' ); ?></p>
	
			<?php get_search_form(); ?>
	
			<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>
	
			<div class="widget">
				<h2 class="widgettitle"><?php _e( 'Most Used Categories', 'rocket_lift_parent_theme' ); ?></h2>
				<ul>
				<?php wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 10 ) ); ?>
				</ul>
			</div><!-- .widget -->
	
			<?php
			/* translators: %1$s: smilie */
			$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s', 'rocket_lift_parent_theme' ), convert_smilies( ':)' ) ) . '</p>';
			the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
			?>
	
			<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>
	
		</div><!-- .entry-content -->
	</article><!-- #post-0 .post .error404 .not-found -->
<?php }); /* end 'content' fractal block */ ?>

<?php fractal( 'base' );