<?php

/**
 * Order Item Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-item.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

if (!defined('ABSPATH')) {
	exit;
}

if (!apply_filters('woocommerce_order_item_visible', true, $item)) {
	return;
}
?>

<li class="<?php echo esc_attr(apply_filters('woocommerce_order_item_class', 'woocommerce-table__line-item order_item', $item, $order)); ?> tp-order-info-list-desc">
	<p class="woocommerce-table__product-name product-name">
		<?php
		$is_visible        = $product && $product->is_visible();
		$product_permalink = apply_filters('woocommerce_order_item_permalink', $is_visible ? $product->get_permalink($item) : '', $item, $order);

		echo wp_kses_post(apply_filters('woocommerce_order_item_name', $product_permalink ? sprintf('<a href="%s">%s</a>', $product_permalink, $item->get_name()) : $item->get_name(), $item, $is_visible));

		$qty          = $item->get_quantity();
		$refunded_qty = $order->get_qty_refunded_for_item($item_id);

		if ($refunded_qty) {
			$qty_display = '<del>' . edufax_kses($qty) . '</del> <ins>' . edufax_kses($qty - ($refunded_qty * -1)) . '</ins>';
		} else {
			$qty_display = edufax_kses($qty);
		}

		echo apply_filters('woocommerce_order_item_quantity_html', ' <strong class="product-quantity">' . sprintf('&times;&nbsp;%s', $qty_display) . '</strong>', $item); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		do_action('woocommerce_order_item_meta_start', $item_id, $item, $order, false);

		wc_display_item_meta($item);

		do_action('woocommerce_order_item_meta_end', $item_id, $item, $order, false);
		?>
	</p>
	<span class="woocommerce-table__product-total product-total">
		<?php echo edufax_kses($order->get_formatted_line_subtotal($item)); ?>
	</span>
</li>

<?php if ($show_purchase_note && $purchase_note) : ?>

	<li class="tp-order-info-list-desc product-note woocommerce-table__product-purchase-note product-purchase-note">

		<p><?php echo wpautop(do_shortcode(wp_kses_post($purchase_note))); ?></p>

	</li>

<?php endif; ?>