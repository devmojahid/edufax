<?php

/**
 * 
 * Shortcodes
 */

if( !function_exists('pure_wc_archive_swatches') ){
    function pure_wc_archive_swatches(){
		$get_options = TP_Wvs_Helper::get_option('tpwvs_shop');
		if(!$get_options['enable_swatches']){
			return;
		}
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
		
		?>
		<div class="tpwvs-variations-form variations_form" data-product_variations="<?php echo esc_attr( $variations_json ); ?>" data-product_id="<?php echo absint( $product_id ); ?>">
			<?php if ( empty( $available_variations ) && false !== $available_variations ) { ?>
				<p class="stock out-of-stock"><?php echo esc_html( apply_filters( 'woocommerce_out_of_stock_message', __( 'This product is currently out of stock and unavailable.', 'pure-wc-swatches' ) ) ); ?></p>
			<?php } else { ?>
				<div class="tpwvs-shop-variations variations" cellspacing="0">
					<ul>
						<?php foreach ( $attributes as $attribute_name => $options ) { ?>
							<li>
								<?php if ( get_option('label') ) { ?>
									<div class="label woocommerce-loop-product__title">
										<label for="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>">
											<?php echo esc_html( wc_attribute_label( $attribute_name ) ); ?>
										</label>
									</div>
								<?php } ?>
								<div class="value">
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
								</div>
							</li>
						<?php } ?>
					</ul>
				</div>
			<?php } ?>
		</div>
		<?php
    }

    add_shortcode('pure_wc_swatches', 'pure_wc_archive_swatches');
}
