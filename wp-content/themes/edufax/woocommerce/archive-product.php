<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );


$product_column = is_active_sidebar( 'product-sidebar' ) ? 'col-xl-9 col-lg-8' : 'col-xl-12 col-lg-12';

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */

 do_action( 'woocommerce_before_main_content' );


 $shop_layout = get_theme_mod('shop_layout');

 $product_col = !empty($_GET['pcol']) ? $_GET['pcol'] : wc_get_loop_prop( 'columns' );

 $product_sidebar = !empty($_GET['sidebar']) ? $_GET['sidebar'] : '';

 if($product_sidebar === "no" || $shop_layout === "no_sidebar" || !is_active_sidebar( 'product-sidebar' )){
 	$_sidebar = 'd-none';
 	$shop_col = 'col-xl-12 col-lg-12';
 }
 elseif($product_sidebar === "right" || $shop_layout === "right_sidebar"){
 	$_sidebar = 'col-xl-3 col-lg-4 order-last';
 	$_sidebar_margin = 'ml-10 tp-woo-shop-sidebar-on-right';
 	$shop_col = 'col-xl-9 col-lg-8 order-first';
}
else{
 	$_sidebar = "col-xl-3 col-lg-4";
	$_sidebar_margin = 'mr-10 tp-woo-shop-sidebar-on-left';
	$shop_col = 'col-xl-9 col-lg-8';
}

$shop_full_width = !empty($_GET['layout']) ? $_GET['layout'] : '';

if($shop_full_width === "full" ||  $shop_layout === "full"){
	$container_class = 'container-fluid tp-shop-full-width-padding';
}
else{
	$container_class = 'container';
}

$sixteen_layout = !empty($_GET['layout']) ? $_GET['layout'] : '';

if($sixteen_layout === "1600px" || $shop_layout === "1600px"){
	$sixteen_container = 'container-shop';
	$_sidebar = "col-xl-2 col-lg-3";
	$shop_col = 'col-xl-10 col-lg-9';

}else{
	$sixteen_container = '';
}

$list_layout = !empty($_GET['tab']) ? $_GET['tab'] : '';

if(!empty($_GET['tab']) && (($_GET['tab'] == 'grid') || ($_GET['tab'] == 'list')) ){
	$tab_active = '';
	$nav_active = '';
}else{
	$tab_active = 'show active';
	$nav_active = 'active';
}

$grid_active = ('grid' === $list_layout) ? 'show active' : '';
$list_active = ('list' === $list_layout) ? 'show active' : '';

$grid_nav_active = ('grid' === $list_layout) ? 'active' : '';
$list_nav_active = ('list' === $list_layout) ? 'active' : '';


?>
<div class="<?php echo esc_attr($container_class); ?> <?php echo esc_attr($sixteen_container); ?>">
	<div class="row">
		<div class="col-lg-12 ">
			<header class="woocommerce-products-header">
				<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
					<h1 class="woocommerce-products-header__title page-title tp-woo-shop-page-title"><?php woocommerce_page_title(); ?></h1>
				<?php endif; ?>

				

				<?php
				
				/**
				 * Hook: woocommerce_archive_description.
				 *
				 * @hooked woocommerce_taxonomy_archive_description - 10
				 * @hooked woocommerce_product_archive_description - 10
				 */
				do_action( 'woocommerce_archive_description' );
				?>
			</header>
			<?php
			if ( woocommerce_product_loop() ) {
				?>

				<div class="tp-shop-main shop__main">
					<div class="row">
						<?php if ( is_active_sidebar( 'product-sidebar' ) ): ?>
						<div class="<?php echo esc_attr($_sidebar); ?>">
							<!-- if sidebar on left add class on-left -->
							<div class="tp-shop-sidebar <?php echo esc_attr($_sidebar_margin) ?> tp-woo-shop-sidebar">
							<?php dynamic_sidebar('product-sidebar');?>
							</div>
						</div>
						<?php endif;?>
						<div class="<?php echo esc_attr($shop_col); ?>">
							<div class="tp-shop-main-wrapper">
							
								<div class="tp-shop-top mb-45">
									<div class="row">
										<div class="col-xl-6">
											<div class="tp-shop-top-left d-flex align-items-center flex-wrap">
												<div class="tp-shop-top-tab tp-tab">
														<ul class="nav nav-tabs" id="productTab" role="tablist">
														<li class="nav-item" role="presentation">
															<button class="nav-link <?php echo esc_attr($nav_active); echo esc_attr($grid_nav_active); ?>" id="grid-tab" data-bs-toggle="tab" data-bs-target="#grid-tab-pane" type="button" role="tab" aria-controls="grid-tab-pane" aria-selected="true">
																<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
																	<path d="M16.3327 6.01341V2.98675C16.3327 2.04675 15.906 1.66675 14.846 1.66675H12.1527C11.0927 1.66675 10.666 2.04675 10.666 2.98675V6.00675C10.666 6.95341 11.0927 7.32675 12.1527 7.32675H14.846C15.906 7.33341 16.3327 6.95341 16.3327 6.01341Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
																	<path d="M16.3327 15.18V12.4867C16.3327 11.4267 15.906 11 14.846 11H12.1527C11.0927 11 10.666 11.4267 10.666 12.4867V15.18C10.666 16.24 11.0927 16.6667 12.1527 16.6667H14.846C15.906 16.6667 16.3327 16.24 16.3327 15.18Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
																	<path d="M7.33268 6.01341V2.98675C7.33268 2.04675 6.90602 1.66675 5.84602 1.66675H3.15268C2.09268 1.66675 1.66602 2.04675 1.66602 2.98675V6.00675C1.66602 6.95341 2.09268 7.32675 3.15268 7.32675H5.84602C6.90602 7.33341 7.33268 6.95341 7.33268 6.01341Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
																	<path d="M7.33268 15.18V12.4867C7.33268 11.4267 6.90602 11 5.84602 11H3.15268C2.09268 11 1.66602 11.4267 1.66602 12.4867V15.18C1.66602 16.24 2.09268 16.6667 3.15268 16.6667H5.84602C6.90602 16.6667 7.33268 16.24 7.33268 15.18Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
																</svg>
															</button>
														</li>
														<li class="nav-item" role="presentation">
															<button class="nav-link <?php echo esc_attr($list_nav_active); ?>" id="list-tab" data-bs-toggle="tab" data-bs-target="#list-tab-pane" type="button" role="tab" aria-controls="list-tab-pane" aria-selected="false">
																<svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
																	<path d="M15 7.11108H1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
																	<path d="M15 1H1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
																	<path d="M15 13.2222H1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
																</svg>
															</button>
														</li>
													</ul>
												</div>
												<div class="tp-shop-top-result">
													<?php
														/**
														 * Hook: woocommerce_before_shop_loop.
														 *
														 * @hooked woocommerce_output_all_notices - 10
														 * @hooked woocommerce_result_count - 20
														 * @hooked woocommerce_catalog_ordering - 30
														 */
														do_action( 'woocommerce_before_shop_loop' );
													?>
												</div>
											</div>
										</div>
										<div class="col-xl-6">
											<div class="tp-shop-top-right d-sm-flex align-items-center justify-content-xl-end">
												<div class="tp-shop-top-select">
													<?php woocommerce_catalog_ordering();?>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="tp-shop-items-wrapper tp-shop-item-primary">
									<div class="tab-content" id="productTabContent">
										<div class="tab-pane fade <?php echo esc_attr($tab_active); echo esc_attr($grid_active); ?>" id="grid-tab-pane" role="tabpanel" aria-labelledby="grid-tab" tabindex="0">
												<?php 
												print '<div class="row row-cols-xl-'. esc_attr($product_col).' row-cols-lg-2 row-cols-md-2 row-cols-sm-2 row-cols-1">';
												woocommerce_product_loop_start();
													if ( wc_get_loop_prop( 'total' ) ) {
														while ( have_posts() ) {
															the_post(); ?>

															<?php

															print '<div class="tp-product-grid-item-wrapper">';

															/**
															 * Hook: woocommerce_shop_loop.
															*/
															do_action( 'woocommerce_shop_loop' );

															wc_get_template_part( 'content', 'product' );
															print '</div>';
														}
													}
												woocommerce_product_loop_end(); 
												print '</div>';
											?>
										</div>
										<div class="tab-pane fade <?php echo esc_attr($list_active); ?>" id="list-tab-pane" role="tabpanel" aria-labelledby="list-tab" tabindex="0">
											<div class="tp-shop-list-wrapper tp-shop-item-primary mb-70">
												<div class="row">
													<?php 
														if ( wc_get_loop_prop( 'total' ) ) {
															while ( have_posts() ) {
																the_post(); ?>

																<?php

																print '<div class="col-lg-12">';

																/**
																 * Hook: woocommerce_shop_loop.
																*/
																do_action( 'woocommerce_shop_loop' );

																wc_get_template_part( 'content', 'product-list' );
																print '</div>';
															}
														}
													?>
												</div>	
											</div>
										</div>
									</div>                            
								</div>
							</div> <!-- main close -->
							<?php
								/**
									* Hook: woocommerce_after_shop_loop.
									*
									* @hooked woocommerce_pagination - 10
									*/
								do_action( 'woocommerce_after_shop_loop' );
							?>
						</div>
					</div>
				</div>

				<?php   
			} else {
				/**
				 * Hook: woocommerce_no_products_found.
				 *
				 * @hooked wc_no_products_found - 10
				 */
				do_action( 'woocommerce_no_products_found' );
			}
			?>
	</div>


	<?php
			/**
			 * Hook: woocommerce_after_main_content.
			 *
			 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
			 */
			do_action( 'woocommerce_after_main_content' );

			/**
			 * Hook: woocommerce_sidebar.
			 *
			 * @hooked woocommerce_get_sidebar - 10
			 */
			do_action( 'woocommerce_sidebar' );
	?>
	</div>
</div>
<?php

get_footer( 'shop' );
