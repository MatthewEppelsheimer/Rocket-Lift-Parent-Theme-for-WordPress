<?php
/**
 * The search.php template
 *
 *
 * @package Rocket Lift Parent Theme
 * @since Rocket Lift Parent Theme 1.0
 */
?>

<?php fractal_template(); ?>

<?php fractal_block( 'content-loop-inside', function(){ ?>
	<header class="page-header">
		<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'rocket_lift_parent_theme' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
	</header><!-- .page-header -->

	<?php rocket_lift_parent_theme_content_nav( 'nav-above' ); ?>

	<?php /* Start the Loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', 'search' ); ?>

	<?php endwhile; ?>

	<?php rocket_lift_parent_theme_content_nav( 'nav-below' ); ?>
<?php }); /* end 'content-loop-inside' */ ?>

<?php fractal( 'base' );