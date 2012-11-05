<?php
fractal_template(); ?>
<?php fractal_block( 'section-1', function() { ?>
	<h3>sub-title, level 3, for section 1 (from index-3)</h3>
	<?php fractal_parent(); ?>
<?php }); ?>

<?php fractal_block( 'section-2', function() { ?>
	<h3>sub-title, level 3, section 2 (from index-3)</h3>
	<?php fractal_parent(); ?>
	<?php fractal_block( 'section-2-subsection-1', function(){?>
		<h4>Section 2, Subsection 1 (from index-3)</h4>
		<p>The first paragraph of 2-1 (from index-3)</p>
	<?php }); ?>
	<?php fractal_block( 'section-2-subsection-2', function(){?>
		<h4>Section 2, Subsection 2 (from index-3)</h4>
		<p>The first paragraph of 2-2 (from index-3)</p>
	<?php }); ?>
<?php }); ?>

<?php fractal_block( 'section-3', function(){?>
	<h3>sub-title, level 3 (from index-3)</h3>
	<?php fractal_parent(); ?>
	<?php fractal_block( 'section-3-subsection-1', function(){?>
		<h4>Subsection 1, section 3 (from index-3)</h4>
		<p>The first paragraph of this subsection (from index-3)</p>
	<?php }); ?>
	<?php fractal_block( 'section-3-subsection-2', function(){?>
		<h4>Subsection 2, section 3 (from index-3)</h4>
		<p>The first paragraph of this subsection (from index-3)</p>
	<?php }); ?>
<?php });

fractal( 'base' );