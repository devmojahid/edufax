<?php

/**
 * Single variation cart button
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined('ABSPATH') || exit;

global $product;
?>

<div class="tp-product-details-action-wrapper">
	<h3 class="tp-product-details-action-title"><?php echo esc_html__('Quantity', 'edufax'); ?></h3>
	<div class="tp-product-details-action-item-wrapper d-flex align-items-center">
		<?php do_action('woocommerce_before_add_to_cart_button'); ?>

		<?php
		do_action('woocommerce_before_add_to_cart_quantity');

		woocommerce_quantity_input(
			array(
				'min_value'   => apply_filters('woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product),
				'max_value'   => apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product),
				'input_value' => isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
			)
		);

		do_action('woocommerce_after_add_to_cart_quantity');
		?>
		<div class="tp-product-details-add-to-cart mb-15 w-100">
			<button type="submit" class="tp-product-details-add-to-cart-btn w-100 single_add_to_cart_button product-add-cart-btn product-add-cart-btn-3 button alt<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>">
				<?php echo esc_html($product->single_add_to_cart_text()); ?>
			</button>
		</div>
	</div>
	<?php do_action('woocommerce_after_add_to_cart_button'); ?>
	<input type="hidden" name="add-to-cart" value="<?php echo absint($product->get_id()); ?>" />
	<input type="hidden" name="product_id" value="<?php echo absint($product->get_id()); ?>" />
	<input type="hidden" name="variation_id" class="variation_id" value="0" />
</div>