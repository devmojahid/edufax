<?php

/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.5.1
 */

defined('ABSPATH') || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if (!function_exists('wc_get_gallery_image_html')) {
	return;
}

global $product;

$attachment_ids = $product->get_gallery_image_ids();

// all for list view
$product_single_layout_from_meta_field = function_exists('tpmeta_field') ? tpmeta_field('edufax_product_single_layout') : NULL;

$product_single_layout_from_from_customizer = get_theme_mod('shop_single_layout');

if ($product_single_layout_from_meta_field === "list") {
	$_is_list_view = true;
} elseif (!empty($_GET['singleLayout'])) {
	$_is_list_view = ($_GET['singleLayout'] === "list") ? true : false;
} elseif ($product_single_layout_from_from_customizer  === "list") {
	$_is_list_view = true;
} else {
	$_is_list_view = false;
}


// all for grid view
if ($product_single_layout_from_meta_field === "grid") {
	$_is_grid_view = true;
} elseif (!empty($_GET['singleLayout'])) {
	$_is_grid_view = ($_GET['singleLayout'] === "grid") ? true : false;
} elseif ($product_single_layout_from_from_customizer === "grid") {
	$_is_grid_view = true;
} else {
	$_is_grid_view = false;
}

// all for carousel view
if ($product_single_layout_from_meta_field === "carousel") {
	$_is_carousel_view = true;
} elseif (!empty($_GET['singleLayout'])) {
	$_is_carousel_view = ($_GET['singleLayout'] === "carousel") ? true : false;
} elseif ($product_single_layout_from_from_customizer === "carousel") {
	$_is_carousel_view = true;
} else {
	$_is_carousel_view = false;
}

if ($_is_list_view) : ?>
	<?php foreach ($attachment_ids as $key => $attachment_id) : ?>
		<div class="tp-product-details-thumb-list-item">
			<?php echo  wc_get_gallery_image_html($attachment_id); ?>
		</div>
	<?php endforeach; ?>

<?php elseif ($_is_grid_view) : ?>
	<?php foreach ($attachment_ids as $key => $attachment_id) : ?>
		<div class="tp-product-details-thumb-gallery-item">
			<?php echo  wc_get_gallery_image_html($attachment_id); ?>
		</div>
	<?php endforeach; ?>

<?php elseif ($_is_carousel_view) : ?>
	<?php foreach ($attachment_ids as $key => $attachment_id) : ?>
		<div class="tp-woo-single-carousel-item">
			<?php echo  wc_get_gallery_image_html($attachment_id); ?>
		</div>
	<?php endforeach; ?>

<?php else : ?>
	<?php
	if ($attachment_ids && $product->get_image_id()) {

		foreach ($attachment_ids as $key => $attachment_id) {
			echo  wc_get_gallery_image_html($attachment_id);
		}
	}
	?>
<?php endif; ?>