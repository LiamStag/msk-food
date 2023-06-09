<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

get_header('shop');
?>
<div class="container">
	<div class="row">
		<?php
		woocommerce_breadcrumb();
		
		?>


	</div>
	<div class="row">
		<?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
			<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
		<?php endif; ?>
	</div>
	<div class="row">
		<?php
		if (woocommerce_product_loop()) {

			

		?>
		

	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="archive__count">
			<?php  woocommerce_result_count(); ?>
			</div>
		</div>
		<div class="col-md-6">
			<div class="archive__sort">
				Сортировка: <?php woocommerce_catalog_ordering(); ?>
			</div>
		</div>
	</div>
	<div class="row archive">



		<?php

			if (wc_get_loop_prop('total')) {
				while (have_posts()) {
					the_post();

					/**
					 * Hook: woocommerce_shop_loop.
					 */
					do_action('woocommerce_shop_loop');

					wc_get_template_part('content', 'product-home');
				}
			}

		?>
	</div>
</div>
<?php

			/**
			 * Hook: woocommerce_after_shop_loop.
			 *
			 * @hooked woocommerce_pagination - 10
			 */
			do_action('woocommerce_after_shop_loop');
		} else {
			/**
			 * Hook: woocommerce_no_products_found.
			 *
			 * @hooked wc_no_products_found - 10
			 */
			do_action('woocommerce_no_products_found');
		}

		/**
		 * Hook: woocommerce_after_main_content.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action('woocommerce_after_main_content');



		get_footer('shop');
