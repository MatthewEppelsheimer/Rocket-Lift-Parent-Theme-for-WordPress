<?php
fractal_template(); ?>
<?php fractal_block( 'section-3-subsection-2', function(){?>
	<?php fractal_parent(); ?>
	<p>Second paragraph of this subsection.</p>
<?php });?>

<?php fractal_block( 'section-1', function() { ?>
	<h2>sub-title</h2>
	<?php fractal_parent(); ?>
<?php });?>

<?php fractal_block( 'section-2', function(){?>
	<h2>sub-title</h2>
	<?php fractal_parent(); ?>
<?php });?>

<?php fractal_block( 'section-3', function(){?>
	<h2>sub-title</h2>
	<?php fractal_parent(); ?>
<?php });

fractal( 'index-3' );