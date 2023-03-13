<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package msk-food
 */

?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</div>
	</div>
</div>
	
		



	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'msk-food' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	

