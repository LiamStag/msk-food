<?php

/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
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
global $post;
$product = wc_get_product($post);
// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
	return;
}
?>
<div class="col-md-3">
	<div class="home-product__slide">
		<div <?php wc_product_class('', $post); ?>>
			<?php // echo do_shortcode('[yith_wcwl_add_to_wishlist]'); 
			?>
			<?php if ($product->get_gallery_image_ids()) { ?>
				<div class="gallery-slider d-none">
					<?php $attachment_ids = $product->get_gallery_image_ids(); ?>
					<?php foreach ($attachment_ids as $attachment_id) { ?>
						<div class="product-welcome__slide">
							<a href="<?php echo $product->get_permalink(); ?>">
								<img src="<?php echo wp_get_attachment_url($attachment_id); ?>" alt="">
							</a>
						</div>
					<?php } ?>
				</div>
			<?php	} else { ?>
				<?php $post_thumbnail_id = $product->get_image_id(); ?>
				<div class="product-welcome__slide">
					<a href="<?php echo $product->get_permalink(); ?>">
						<img src="<?php echo wp_get_attachment_url($post_thumbnail_id); ?>" alt="">
					</a>
				</div>
			<?php	} ?>
			<div class="product-home__name">
				<a href="<?php echo $product->get_permalink(); ?>">
					<p><?php echo $product->get_title(); ?></p>
				</a>
			</div>
			<div class="product-home__price">
				<?php woocommerce_template_loop_price(); ?>
			</div>
			<div class="prroduct-home__add-to-cart">
				<?php woocommerce_template_loop_add_to_cart(); ?>
			</div>
		</div>
	</div>
</div>