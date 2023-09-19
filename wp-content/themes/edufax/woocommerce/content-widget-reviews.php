<?php

/**
 * The template for displaying product widget entries.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-widget-reviews.php
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

global $product;
$rating_count = $product->get_rating_count();

?>
<li class="tp-shop-widget-product-item d-flex align-items-center">
	<?php do_action('woocommerce_widget_product_review_item_start', $args); ?>

	<?php
	// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
	?>

	<div class="tp-shop-widget-product-thumb">
		<a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
			<?php // echo esc_html( $product->get_image()); // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
			?>
			<?php echo get_the_post_thumbnail(); ?>
		</a>
	</div>
	<div class="tp-shop-widget-product-content">

		<?php if ($rating_count > 0) : ?>
			<div class="tp-shop-widget-product-rating-wrapper d-flex align-items-center">
				<div class="tp-shop-widget-product-rating">
					<?php echo wc_get_rating_html($product->get_average_rating()); // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
					?>
				</div>
				<div class="tp-shop-widget-product-rating-number">
					<span><?php echo esc_html__('(', 'edufax');
							echo esc_html($product->get_average_rating());
							echo esc_html__(')', 'edufax'); ?></span>
				</div>
			</div>
		<?php endif; ?>

		<h4 class="tp-shop-widget-product-title"><?php echo wp_kses_post($product->get_name()); ?></h4>

		<span class="reviewer">
			<span> <?php echo esc_html__('by ', 'edufax'); ?> <span><?php echo get_comment_author($comment->comment_ID) ?></span> </span>
		</span>
	</div>

	<?php
	// phpcs:enable WordPress.Security.EscapeOutput.OutputNotEscaped
	?>

	<?php do_action('woocommerce_widget_product_review_item_end', $args); ?>
</li>