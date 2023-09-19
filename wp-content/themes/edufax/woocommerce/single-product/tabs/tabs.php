<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $product_tabs ) ) : ?>
	<div class="tp-product-details-bottom pb-140">
		<div class="container">
			<div class="row">
				<div class="col-xl-12">
					<div class="tp-product-details-tab-nav tp-tab">
						
						<nav>
							<div class="nav nav-tabs justify-content-center p-relative tp-product-tab" id="navPresentationTab" role="tablist">
								<?php foreach ( $product_tabs as $key => $product_tab ) : 

									$active = ($key == array_key_first($product_tabs)) ? 'active' : '';
								?>
								<button class="nav-link <?php echo esc_attr( $key ); ?>_tab <?php echo esc_attr($active); ?>" id="nav-desc-tab-<?php echo esc_attr( $key ); ?>" data-bs-toggle="tab" data-bs-target="#nav-desc-<?php echo esc_attr( $key ); ?>" type="button" role="tab" aria-controls="nav-desc-<?php echo esc_attr( $key ); ?>" aria-selected="true"><?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ); ?></button>
								<?php endforeach; ?>	
								<span id="productTabMarker" class="tp-product-details-tab-line"></span>
							</div>
						</nav>  

						<div class="tab-content tp-woo-single-desc-body" id="navPresentationTabContent">
							<?php foreach ( $product_tabs as $key => $product_tab ) : 
								$active = ($key == array_key_first($product_tabs)) ? 'show active' : '';
							?>
							<div class="tab-pane fade  <?php echo esc_attr($active); ?>" id="nav-desc-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="nav-desc-tab-<?php echo esc_attr( $key ); ?>">
								<div class="tp-product-details-desc-wrapper pt-80">
								<?php
									if ( isset( $product_tab['callback'] ) ) {
										call_user_func( $product_tab['callback'], $key, $product_tab );
									}
								?>
								</div>
							</div>
							<?php endforeach; ?>
							
						</div>                                                
					</div>
				</div>
			</div>
		</div>
	</div>



<?php endif; ?>
