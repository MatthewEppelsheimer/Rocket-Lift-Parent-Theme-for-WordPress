<?php
fractal_template();
fractal_block( 'section-1', function() { ?>
	<h1>Section 1</h1>
	<?php fractal_parent(); ?>
<?php }); ?>

<?php fractal_block( 'section-2', function() { ?>
	<h1>Section 2</h1>
	<?php fractal_parent(); ?>
<?php }); ?>

<?php fractal_block( 'section-3', function(){?>
	<h1>Section 3</h1>
	<?php fractal_parent(); ?>
<?php });

fractal( 'index-2' );