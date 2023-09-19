<?php

/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

global $product;

$enable_sku = get_theme_mod('edufax_product_single_sku_switch', true);
$enable_categories = get_theme_mod('edufax_product_single_categories_switch', true);
$enable_tags = get_theme_mod('edufax_product_single_tags_switch', true);
$enable_social = get_theme_mod('edufax_product_single_social_switch', false);

?>

<div class="tp-product-details-query">
    <?php do_action('woocommerce_product_meta_start'); ?>

    <?php if ($enable_sku && wc_product_sku_enabled() && ($product->get_sku() || $product->is_type('variable'))) : ?>
        <div class="tp-product-details-query-item d-flex align-items-center">
            <span><?php esc_html_e('SKU:', 'edufax'); ?> </span>
            <p><?php echo wp_kses_post($sku = $product->get_sku()) ? esc_html($sku) : esc_html__('N/A', 'edufax'); ?></p>
        </div>
    <?php endif; ?>

    <?php if ($enable_categories) : ?>
        <div class="tp-product-details-query-item d-flex align-items-center">
            <?php echo wc_get_product_category_list($product->get_id(), '<span class="comma">,  </span>', '<span class="posted_in">' . _n('Category:  ', 'Categories:  ', count($product->get_category_ids()), 'edufax')  . '</span> '); ?>
        </div>
    <?php endif; ?>

    <?php if ($enable_tags) : ?>
        <div class="tp-product-details-query-item d-flex align-items-center">
            <?php echo wc_get_product_tag_list($product->get_id(), '<span class="comma">,  </span>', '<span class="tagged_as">' . _n('Tag:', 'Tags:', count($product->get_tag_ids()), 'edufax') . '</span> '); ?>
        </div>
    <?php endif; ?>
    <?php do_action('woocommerce_product_meta_end'); ?>

</div>

<?php if ($enable_social && function_exists('edufax_product_single_social')) : ?>
    <?php echo edufax_product_single_social(); ?>
<?php endif; ?>