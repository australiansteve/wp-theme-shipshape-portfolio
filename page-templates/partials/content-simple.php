<?php
/**
 * @package Shipshapeportfolio
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php
		/* translators: %s: Name of current post */
		the_content( sprintf(
			__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'shipshapeportfolio' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		) );
	?>

</article><!-- #post-## -->