<?php fractal_template(); ?>

<?php fractal_block( 'base', function() { ?>

	<?php fractal_block( 'section-1', function() { ?>
		<p>Paragraph from 'base'</p>
	<?php }); ?>
	
	<?php fractal_block( 'section-2', function(){?>
		<p>Paragraph from 'base'</p>
	<?php }); ?>
	
	<?php fractal_block( 'section-3', function(){?>
		<p>Paragraph from 'base'</p>
	<?php }); ?>

<?php }); /* 'base' */ ?>

<?php fractal();