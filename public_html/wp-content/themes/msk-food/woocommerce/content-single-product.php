<?php

/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>
	<div class="row">
		<div class="col-md-6">
			<?php if ($product->get_gallery_image_ids()) { ?>
				<div class="product__slider-nav ">
					<?php $attachment_ids = $product->get_gallery_image_ids(); ?>

					<?php foreach ($attachment_ids as $attachment_id) { ?>

						<div class="product__slide-nav">


							<img src="<?php echo wp_get_attachment_url($attachment_id); ?>" alt="">

						</div>
					<?php } ?>
				</div>
				<div class="product__slider-for ">
					<?php $attachment_ids = $product->get_gallery_image_ids(); ?>

					<?php foreach ($attachment_ids as $attachment_id) { ?>
						<div class="product__slide-for">

							<a class="fancybox" rel="group" href="<?php echo wp_get_attachment_url($attachment_id); ?>" data-fancybox="images">
								<img class="zoom" src="<?php echo wp_get_attachment_url($attachment_id); ?>" alt="">
							</a>
						</div>

					<?php } ?>
				</div>
				

			<?php	} else { ?>
				<?php $post_thumbnail_id = $product->get_image_id(); ?>

				<div class="product__image">
					<a href="<?php echo wp_get_attachment_url($post_thumbnail_id); ?>" data-fancybox="product-gallery">
						<img src="<?php echo wp_get_attachment_url($post_thumbnail_id); ?>" alt="">
					</a>
				</div>
			<?php	} ?>
		</div>
		<div class="col-md-6 product__summary">
			<?php woocommerce_template_single_title(); ?>
			<div class="product__price">
				<?php woocommerce_template_single_price(); ?>
			</div>
			<div class="product__meta">
				<?php woocommerce_template_single_meta(); ?>
			</div>
			<div class="product__excert">
				<p class="bold600">Краткое описание:</p>
				<?php woocommerce_template_single_excerpt(); ?>
			</div>
			<div class="product__add-to-cart">
				<?php woocommerce_template_single_add_to_cart(); ?>
			</div>

		</div>
	</div>
	<?php
	/**
	 * Hook: woocommerce_before_single_product_summary.
	 *
	 * @hooked woocommerce_show_product_sale_flash - 10
	 * @hooked woocommerce_show_product_images - 20
	 */
	//do_action('woocommerce_before_single_product_summary');
	?>

	<div class="summary entry-summary">

	</div>
	<div class="row">
		<?php  woocommerce_output_product_data_tabs(); ?>
	
	</div>
	<div class="row">
		<?php woocommerce_upsell_display(); ?>
	</div>
	<div class="row">
		<?php woocommerce_output_related_products(); ?>
	</div>
	
</div>

<?php do_action('woocommerce_after_single_product'); ?>