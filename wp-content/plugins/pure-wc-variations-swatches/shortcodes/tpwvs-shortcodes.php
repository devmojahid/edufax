<?php

/**
 * 
 * Shortcodes
 */

if( !function_exists('tpwvs_archive_swatches') ){
    function tpwvs_archive_swatches(){
        global $product;

		if ( ! $product->is_type( 'variable' ) ) {
			return;
		}

		if ( ! $product->get_available_variations() ) {
			return;
		}
		$product_id = $product->get_id();
		
		// Get Available variations?
		$get_variations       = count( $product->get_children() ) <= apply_filters( 'woocommerce_ajax_variation_threshold', 30, $product );
		$available_variations = $get_variations ? $product->get_available_variations() : false;
		$attributes           = $product->get_variation_attributes();

		$attribute_keys  = array_keys( $attributes );
		$variations_json = wp_json_encode( $available_variations );
		//var_dump($variations_json);
		?>
		<div class="tpwvs-variations-form variations_form" data-product_variations="<?php echo esc_attr( $variations_json ); ?>" data-product_id="<?php echo absint( $product_id ); ?>">
			<?php if ( empty( $available_variations ) && false !== $available_variations ) { ?>
				<p class="stock out-of-stock"><?php echo esc_html( apply_filters( 'woocommerce_out_of_stock_message', __( 'This product is currently out of stock and unavailable.', 'variation-swatches-woo' ) ) ); ?></p>
			<?php } else { ?>
				<table class="tpwvs-shop-variations variations" cellspacing="0">
					<tbody>
						<?php foreach ( $attributes as $attribute_name => $options ) { ?>
							<tr>
								<?php if ( get_option('label') ) { ?>
									<td class="label woocommerce-loop-product__title"><label for="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>">
											<?php echo esc_html( wc_attribute_label( $attribute_name ) ); ?>
										</label>
									</td>
								<?php } ?>
							</tr>
							<tr>
								<td class="value">
									<?php
									wc_dropdown_variation_attribute_options(
										array(
											'options'   => $options,
											'attribute' => $attribute_name,
											'product'   => $product,
										)
									);
									echo end( $attribute_keys ) === $attribute_name ? wp_kses_post( apply_filters( 'woocommerce_reset_variations_link', '' ) ) : '';
									?>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			<?php } ?>
		</div>
		<?php
    }

    add_shortcode('tpwvs', 'tpwvs_archive_swatches');
}