<?php
fractal_template(); ?>
<?php fractal_block( 'section-1', function() { ?>
	<h3>sub-title, level 3</h3>
	<?php fractal_parent(); ?>
<?php }); ?>

<?php fractal_block( 'section-2', function() { ?>
	<h3>sub-title, level 3</h3>
	<?php fractal_parent(); ?>
	<?php fractal_block( 'section-2-subsection-1', function(){?>
		<h4>Section 2, Subsection 1</h4>
		<p>The first paragraph of 2-1</p>
	<?php }); ?>
	<?php fractal_block( 'section-2-subsection-2', function(){?>
		<h4>Section 2, Subsection 2</h4>
		<p>The first paragraph of 2-2</p>
	<?php }); ?>
<?php }); ?>

<?php fractal_block( 'section-3', function(){?>
	<h3>sub-title, level 3</h3>
	<?php fractal_parent(); ?>
	<?php fractal_block( 'section-3-subsection-1', function(){?>
		<h4>Subsection 1</h4>
		<p>The first paragraph of this subsection</p>
	<?php }); ?>
	<?php fractal_block( 'section-3-subsection-2', function(){?>
		<h4>Subsection 2</h4>
		<p>The first paragraph of this subsection</p>
	<?php }); ?>
<?php });

fractal( 'base' );