<?php

/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.3.0
 */

defined('ABSPATH') || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if (!function_exists('wc_get_gallery_image_html')) {
	return;
}

global $product;


// all for list view
$product_single_layout_from_meta_field = function_exists('tpmeta_field') ? tpmeta_field('edufax_product_single_layout') : NULL;
$product_single_layout_from_from_customizer = get_theme_mod('shop_single_layout');


if ($product_single_layout_from_meta_field === "list") {
	$_is_list_view = 'is-list-view';
} elseif (!empty($_GET['singleLayout'])) {
	$_is_list_view = ($_GET['singleLayout'] === "list") ? 'is-list-view' : '';
} elseif ($product_single_layout_from_from_customizer === "list") {
	$_is_list_view = 'is-list-view';
} else {
	$_is_list_view = '';
}


// all for grid view
if ($product_single_layout_from_meta_field === "grid") {
	$_is_grid_view = 'is-grid-view';
	$_is_grid_view_columns = 'row row-cols-lg-2 ';
} elseif (!empty($_GET['singleLayout'])) {
	$_is_grid_view = ($_GET['singleLayout'] === "grid") ? 'is-grid-view' : '';
	$_is_grid_view_columns = ($_GET['singleLayout'] === "grid") ? 'row row-cols-lg-2 ' : '';
} elseif ($product_single_layout_from_from_customizer === "grid") {
	$_is_grid_view = 'is-grid-view';
	$_is_grid_view_columns = 'row row-cols-lg-2 ';
} else {
	$_is_grid_view = '';
	$_is_grid_view_columns = '';
}


// for carousel
if ($product_single_layout_from_meta_field === "carousel") {
	$_is_carousel_view = 'is-carousel-view';
	$_carousel_active = 'tp-woo-single-carousel-active';
} elseif (!empty($_GET['singleLayout'])) {
	$_is_carousel_view = ($_GET['singleLayout'] === "carousel") ? 'is-carousel-view' : '';
	$_carousel_active = 'tp-woo-single-carousel-active';
} elseif ($product_single_layout_from_from_customizer === "carousel") {
	$_is_carousel_view = 'is-carousel-view';
	$_carousel_active = 'tp-woo-single-carousel-active';
} else {
	$_is_carousel_view = '';
	$_carousel_active = '';
}


// all for vertical tab view
/* check if product has thumbnails */
$product_id = new WC_product($product);
$attachment_ids = $product_id->get_gallery_image_ids();

$gallery_margin_pos = !empty($attachment_ids) ? 'is-vertical-tab-pl' : '';


if ($product_single_layout_from_meta_field === "vertical") {
	$_is_vertical_tab = 'is-vertical-tab ' . $gallery_margin_pos;
} elseif (!empty($_GET['singleLayout'])) {
	$_is_vertical_tab = ($_GET['singleLayout'] === "vertical") ? ('is-vertical-tab ' . $gallery_margin_pos) : '';
} elseif ($product_single_layout_from_from_customizer === "vertical") {
	$_is_vertical_tab = 'is-vertical-tab ' . $gallery_margin_pos;
} else {
	$_is_vertical_tab = '';
}

$product_single_class = $_is_carousel_view . ' ' . $_is_vertical_tab . ' ' .  $_is_grid_view . ' ' .  $_is_list_view;


$columns           = apply_filters('woocommerce_product_thumbnails_columns', 4);
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters(
	'woocommerce_single_product_image_gallery_classes',
	array(
		'woocommerce-product-gallery',
		'woocommerce-product-gallery--' . ($post_thumbnail_id ? 'with-images' : 'without-images'),
		'woocommerce-product-gallery--columns-' . absint($columns),
		'images',
	)
);
?>



<div class="tp-woo-single-gallery-wrapper <?php echo esc_attr($product_single_class); ?>  <?php echo esc_attr(implode(' ', array_map('sanitize_html_class', $wrapper_classes))); ?>" data-columns="<?php echo esc_attr($columns); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
	<div class="woocommerce-product-gallery__wrapper  <?php echo esc_attr($_carousel_active); ?> <?php echo esc_attr($_is_grid_view_columns); ?>">
		<?php


		if ($post_thumbnail_id) {
			$arr = [
				'data-src' => wp_get_attachment_image_url($post_thumbnail_id, 'full'),
				'data-large_image' => wp_get_attachment_image_url($post_thumbnail_id, 'full'),
			];
			$full_src          = wp_get_attachment_image_src($post_thumbnail_id, "full");
			$html = wp_get_attachment_image(
				$post_thumbnail_id,
				'full',
				false,
				apply_filters(
					'woocommerce_gallery_image_html_attachment_image_params',
					array(
						'title'                   => _wp_specialchars(get_post_field('post_title', $post_thumbnail_id), ENT_QUOTES, 'UTF-8', true),
						'data-caption'            => _wp_specialchars(get_post_field('post_excerpt', $post_thumbnail_id), ENT_QUOTES, 'UTF-8', true),
						'data-src'                => esc_url($full_src[0]),
						'data-large_image'        => esc_url($full_src[0]),
						'data-large_image_width'  => esc_attr($full_src[1]),
						'data-large_image_height' => esc_attr($full_src[2]),
						'class'                   => esc_attr('wp-post-image'),
					),
					$post_thumbnail_id,
					"full",
					true
				)
			);
		} else {
			$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
			$html .= sprintf('<img src="%s" alt="%s" class="wp-post-image" />', esc_url(wc_placeholder_img_src('woocommerce_single')), esc_html__('Awaiting product image', 'edufax'));
			$html .= '</div>';
		}

		echo apply_filters('woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped

		do_action('woocommerce_product_thumbnails');
		?>
	</div>
	<div class="tp-woo-single-arrow text-center mt-20"></div>
</div>