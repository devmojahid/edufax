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

// all for vertical tab view
/* check if product has thumbnails */
$product_id = new WC_product($product);
$attachment_ids = $product_id->get_gallery_image_ids();

$gallery_margin_pos = !empty($attachment_ids) ? 'is-vertical-tab-pl' : '';


$enable_vertical_tab_from_meta_field = function_exists('tpmeta_field') ? tpmeta_field('edufax_product_single_layout') : NULL;
$enable_single_vertical_tab_from_customizer = get_theme_mod('shop_single_layout');


if ($enable_vertical_tab_from_meta_field === "vertical") {
	$_is_vertical_tab = 'is-vertical-thumb ';
} elseif (!empty($_GET['singleLayout'])) {
	$_is_vertical_tab = ($_GET['singleLayout'] === "vertical") ? ('is-vertical-thumb ') : '';
} elseif ($enable_single_vertical_tab_from_customizer === "vertical") {
	$_is_vertical_tab = 'is-vertical-thumb ';
} else {
	$_is_vertical_tab = '';
}

$product_single_layout_from_meta_field = function_exists('tpmeta_field') ? tpmeta_field('edufax_product_single_layout') : NULL;

$product_single_layout_from_from_customizer = get_theme_mod('shop_single_layout');

if ($product_single_layout_from_meta_field === "carousel") {
	$_is_carousel_view = 'container-shop';
	$_carousel_left_col = 'col-lg-8';
	$_carousel_right_col = 'col-lg-4';
} elseif (!empty($_GET['singleLayout'])) {
	$_is_carousel_view = ($_GET['singleLayout'] === "carousel") ? 'container-shop' : '';
	$_carousel_left_col = 'col-lg-8';
	$_carousel_right_col = 'col-lg-4';
} elseif ($product_single_layout_from_from_customizer === "carousel") {
	$_is_carousel_view = 'container-shop';
	$_carousel_left_col = 'col-lg-8';
	$_carousel_right_col = 'col-lg-4';
} else {
	$_is_carousel_view = '';
	$_carousel_left_col = 'col-lg-6';
	$_carousel_right_col = 'col-lg-6';
}

?>
<div class="container <?php echo esc_attr($_is_carousel_view); ?>">
	<div class="row">
		<div class="col-xl-12">
			<?php woocommerce_breadcrumb(); ?>
		</div>
	</div>
	<div id="product-<?php the_ID(); ?>" <?php wc_product_class('tp-woo-single-body', $product); ?>>
		<div class="tp-product-details-top pb-110">
			<div class="row">
				<div class="<?php echo esc_attr($_carousel_left_col); ?>">
					<div class="tp-product-details-thumb-wrapper tp-tab p-relative tp-woo-single-thumb <?php echo esc_attr($_is_vertical_tab); ?>">
						<?php
						/**
						 * Hook: woocommerce_before_single_product_summary.
						 *
						 * @hooked woocommerce_show_product_sale_flash - 10
						 * @hooked woocommerce_show_product_images - 20
						 */
						do_action('woocommerce_before_single_product_summary');
						?>
					</div>
				</div>
				<div class="<?php echo esc_attr($_carousel_right_col); ?>">
					<div class="tp-product-details-wrapper tp-woo-single-wrapper summary entry-summary">
						<?php
						/**
						 * Hook: woocommerce_single_product_summary.
						 *
						 * @hooked woocommerce_template_single_title - 5
						 * @hooked woocommerce_template_single_rating - 10
						 * @hooked woocommerce_template_single_price - 10
						 * @hooked woocommerce_template_single_excerpt - 20
						 * @hooked woocommerce_template_single_add_to_cart - 30
						 * @hooked woocommerce_template_single_meta - 40
						 * @hooked woocommerce_template_single_sharing - 50
						 * @hooked WC_Structured_Data::generate_product_data() - 60
						 */
						do_action('woocommerce_single_product_summary');
						?>
					</div>
				</div>
			</div>
		</div>

		<?php
		/**
		 * Hook: woocommerce_after_single_product_summary.
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action('woocommerce_after_single_product_summary');
		?>
	</div>
</div>

<?php do_action('woocommerce_after_single_product'); ?>