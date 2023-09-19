<?php

/**
 * Single Product Rating
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/rating.php.
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

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

global $product;

if (!wc_review_ratings_enabled()) {
	return;
}

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();
$availability = $product->is_in_stock();

$class = $availability  ? 'in-stock' : 'out-of-stock';
$stockClass = $availability ? 'In Stock ' : 'Out Of Stock';

?>

<div class="tp-product-details-inventory d-flex align-items-center mb-10">
	<div class="tp-product-details-stock mb-10">
		<span class="stock <?php echo esc_attr($class); ?>"><?php echo esc_html($stockClass); ?></span>
	</div>
	<?php if ($rating_count > 0) : ?>
		<div class="tp-product-details-rating-wrapper d-flex align-items-center mb-10">
			<div class="tp-product-details-rating">
				<span><?php echo wc_get_rating_html($average, $rating_count); ?></span>
			</div>

			<div class="woocommerce-product-rating tp-product-details-reviews">

				<?php if (comments_open()) : ?>
					<?php //phpcs:disable 
					?>
					<a href="#reviews" class="woocommerce-review-link" rel="nofollow">(<?php printf(_n('%s Review', '%s Reviews', $review_count, 'edufax'), '<span class="count">' . esc_html($review_count) . '</span>'); ?>)</a>
					<?php // phpcs:enable 
					?>
				<?php endif; ?>
			</div>
		</div>

	<?php endif; ?>
</div>