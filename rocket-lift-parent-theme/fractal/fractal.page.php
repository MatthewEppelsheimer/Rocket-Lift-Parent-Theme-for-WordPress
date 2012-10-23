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

<?php fractal_block( 'content-loop-inside', function(){ ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</header><!-- .entry-header -->
	
		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'rocket_lift_parent_theme' ), 'after' => '</div>' ) ); ?>
			<?php edit_post_link( __( 'Edit', 'rocket_lift_parent_theme' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-content -->
	</article><!-- #post-<?php the_ID(); ?> -->	
	
	<?php fractal_block( 'comments', function(){?>
		<?php fractal_parent(); ?>
	<?php }); /* end 'comments' fractal_block */ ?>
<?php }); /* end 'content-loop-inside' */ ?>

<?php fractal( 'base' );