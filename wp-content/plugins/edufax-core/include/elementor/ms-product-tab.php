<?php

namespace MSCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Ms Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class MS_Product_Tab extends Widget_Base
{

	use \MSCore\Widgets\MSCoreElementFunctions;

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'ms-product-tab';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return __('Product Tab', 'mscore');
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'ms-icon';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories()
	{
		return ['mscore'];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends()
	{
		return ['mscore'];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls()
	{
		$this->register_controls_section();
		$this->style_tab_content();
	}

	protected function register_controls_section()
	{


		// layout Panel
		$this->start_controls_section(
			'ms_layout',
			[
				'label' => esc_html__('Design Layout', 'mscore'),
			]
		);
		$this->add_control(
			'ms_design_style',
			[
				'label' => esc_html__('Select Layout', 'mscore'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'layout-1' => esc_html__('Layout 1', 'mscore'),
					'layout-2' => esc_html__('Layout 2', 'mscore'),
					'layout-3' => esc_html__('Layout 3', 'mscore'),
					'layout-4' => esc_html__('Layout 4', 'mscore'),
					'layout-5' => esc_html__('Layout 5', 'mscore'),
				],
				'default' => 'layout-1',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ms_section_sec',
			[
				'label' => esc_html__('Title', 'mscore'),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'ms_section_subtitle',
			[
				'label'       => esc_html__('Sub Title', 'mscore'),
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'default'     => esc_html__('Your Sub Title', 'mscore'),
				'placeholder' => esc_html__('Your Text', 'mscore'),
				'label_block' => true,
				'condition' => [
					'ms_design_style' => ['layout-2', 'layout-3', 'layout-4', 'layout-5']
				]
			]
		);

		$this->add_control(
			'ms_section_title',
			[
				'label'       => esc_html__('Title', 'mscore'),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__('Your Title', 'mscore'),
				'placeholder' => esc_html__('Your Text', 'mscore'),
				'label_block' => true
			]
		);

		$this->end_controls_section();

		$this->ms_product_badges();

		// Product Query
		$this->ms_query_controls('product', 'Product', 6, 10, 'product', 'product_cat');

		// column controls
		$this->ms_columns('col');
	}

	// style_tab_content
	protected function style_tab_content()
	{
		$this->ms_section_style_controls('blog_section', 'Section - Style', '.ms-el-section');
		$this->ms_basic_style_controls('blog_title', 'Title', '.ms-el-title');

		$this->ms_basic_style_controls('blog_box_title', 'Box - Title', '.ms-el-box-title');
	}

	protected function product_badge()
	{
		$settings = $this->get_settings_for_display();

		global $product;
		global $post;
		global $woocommerce;
		$rating = wc_get_rating_html($product->get_average_rating());
		$terms = get_the_terms(get_the_ID(), 'product_cat');

		$enable_trending_badge 	= $settings['product_trending_badge_enable'];
		$enable_hot_badge 		= $settings['product_hot_badge_enable'];

		$product_badge_type 	= $settings['product_badge_type'];


		//sale count
		$sale_count = get_post_meta($product->get_id(), 'total_sales', true);

		// view count
		$view_count = get_post_meta($product->get_id(), 'view_count', true);

		// avarage rating
		$product_rating_count = $product->get_average_rating();

		// review count
		$review_count = $product->get_review_count();

		// date difference count
		$count_time = new \DateTime($product->get_date_created()->date("y-m-d"));
		$current_time = new \DateTime(date('y-m-d'));
		$date_diff = date_diff($count_time, $current_time, true)->days;


		$sale_count_to_show 	= $settings['sale_count_to_show'];
		$rating_count_to_show 	= $settings['rating_count_to_show'];
		$review_count_to_show 	= $settings['review_count_to_show'];
		$view_count_to_show 	= $settings['view_count_to_show'];
		$date_diff_to_show 		= $settings['date_diff_to_show'];


?>

		<ul class="d-flex">
			<?php if ($product->is_on_sale()) : ?>
				<li>
					<?php woocommerce_show_product_loop_sale_flash(); ?>
				</li>
			<?php endif; ?>


			<?php if ($enable_trending_badge === "yes") : ?>

				<?php if ($product_badge_type === "sales") : ?>
					<!-- it depends on sales -->
					<?php if ($sale_count > $sale_count_to_show) : ?>
						<li>
							<span class="onsale on-trending"><?php echo esc_html__('Trending', 'shofy'); ?></span>
						</li>
						<!-- it depends on sales end -->
					<?php endif; ?>

				<?php elseif ($product_badge_type === "rating") : ?>

					<!-- it depends on rating -->
					<?php if (floatval($product_rating_count) >= floatval($rating_count_to_show)) : ?>
						<li>
							<span class="onsale on-trending"><?php echo esc_html__('Trending', 'shofy'); ?></span>
						</li>
						<!-- it depends on rating end -->
					<?php endif; ?>

				<?php elseif ($product_badge_type === "review") : ?>

					<!-- it depends on review -->
					<?php if ($review_count >= $review_count_to_show) : ?>
						<li>
							<span class="onsale on-trending"><?php echo esc_html__('Trending', 'shofy'); ?></span>
						</li>
						<!-- it depends on review end -->
					<?php endif; ?>

				<?php elseif ($product_badge_type === "views") : ?>

					<!-- it depends on views -->
					<?php if ($view_count >= $view_count_to_show) : ?>
						<li>
							<span class="onsale on-trending"><?php echo esc_html__('Trending', 'shofy'); ?></span>
						</li>
						<!-- it depends on views end -->
					<?php endif; ?>

				<?php endif; ?>
			<?php endif; ?>





			<?php if ($enable_hot_badge == 'yes') : ?>
				<?php if ($date_diff <= $date_diff_to_show) : ?>
					<li>
						<span class="onsale on-hot"><?php echo esc_html__('Hot', 'shofy'); ?></span>
					</li>
				<?php endif; ?>
			<?php endif; ?>
		</ul>

	<?php
	}


	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();

		/**
		 * Setup the post arguments.
		 */
		$query_args = MS_Helper::get_query_args('product', 'product_cat', $this->get_settings());

		// The Query
		$query = new \WP_Query($query_args);

		$filter_list = $settings['category'];


	?>

		<?php if ($settings['ms_design_style']  == 'layout-2') :
			$this->add_render_attribute('title_args', 'class', 'section__title-4 ms-el-title');
		?>


			<!-- product area start -->
			<section class="ms-product-area pb-90">
				<div class="container">
					<?php if (!empty($settings['ms_section_title']) || !empty($settings['ms_section_subtitle'])) : ?>
						<div class="row">
							<div class="col-xl-12">
								<div class="ms-section-title-wrapper-2 text-center mb-35">
									<?php if (!empty($settings['ms_section_subtitle'])) : ?>
										<span class="ms-section-title-pre-2"><?php echo ms_kses($settings['ms_section_subtitle']); ?></span>
									<?php endif; ?>

									<?php if (!empty($settings['ms_section_title'])) : ?>
										<h3 class="ms-section-title-2"><?php echo ms_kses($settings['ms_section_title']); ?></h3>
									<?php endif; ?>

								</div>
							</div>
						</div>
					<?php endif; ?>

					<?php if (!empty($filter_list) && count($filter_list) > 0) : ?>
						<div class="row">
							<div class="col-xl-12">
								<div class="ms-product-tab-2 ms-tab mb-50 text-center">
									<nav>
										<div class="nav nav-tabs justify-content-center" id="nav-tab" role="tablist">

											<?php
											$posts_per_page = (!empty($settings['posts_per_page'])) ? $settings['posts_per_page'] : '-1';


											$count = 0;

											foreach ($filter_list as $key => $list) :
												$active = ($count == 0) ? 'active' : '';

												$post_args = [
													'post_status' => 'publish',
													'post_type' => 'product',
													'posts_per_page' => $posts_per_page,
													'tax_query' => array(
														array(
															'taxonomy' => 'product_cat',
															'field' => 'slug',
															'terms' => $list,
														),
													),
												];
												$pro_query = new \WP_Query($post_args);

												$item_count = 0;
												while ($pro_query->have_posts()) :
													$pro_query->the_post();
													$item_count++;
												endwhile;
											?>
												<button class="nav-link <?php echo esc_attr($active); ?>" id="nav-allCollection-tab-2-<?php echo esc_attr($key); ?>" data-bs-toggle="tab" data-bs-target="#nav-allCollection-2-<?php echo esc_attr($key); ?>" type="button" role="tab" aria-controls="nav-allCollection-2-<?php echo esc_attr($key); ?>" aria-selected="true">
													<?php echo esc_html($list); ?>
													<span class="ms-product-tab-tooltip"><?php echo esc_html($item_count); ?></span>
												</button>
											<?php $count++;
											endforeach; ?>

										</div>
									</nav>
								</div>
							</div>
						</div>
					<?php endif; ?>
					<div class="row">
						<div class="col-xl-12">
							<?php if (!empty($filter_list)) : ?>
								<div class="tab-content" id="nav-tabContent2">
									<?php
									$posts_per_page = (!empty($settings['posts_per_page'])) ? $settings['posts_per_page'] : '-1';
									foreach ($filter_list as $key => $list) :
										$active_tab = ($key == 0) ? 'active show' : '';
									?>
										<div class="tab-pane fade <?php echo esc_attr($active_tab); ?>" id="nav-allCollection-2-<?php echo esc_attr($key); ?>" role="tabpanel" aria-labelledby="nav-allCollection-tab-2-<?php echo esc_attr($key); ?>" tabindex="0">
											<div class="row">

												<?php

												$post_args = [
													'post_status' => 'publish',
													'post_type' => 'product',
													'posts_per_page' => $posts_per_page,
													'tax_query' => array(
														array(
															'taxonomy' => 'product_cat',
															'field' => 'slug',
															'terms' => $list,
														),
													),
												];
												$pro_query = new \WP_Query($post_args);
												while ($pro_query->have_posts()) :
													$pro_query->the_post();

													global $product;
													global $post;
													global $woocommerce;

													$attachment_ids = $product->get_gallery_image_ids();


													foreach ($attachment_ids as $key => $attachment_id) {
														$image_link =  wp_get_attachment_url($attachment_id);
														$arr[] = $image_link;
													}


													$rating = wc_get_rating_html($product->get_average_rating());
													$terms = get_the_terms(get_the_ID(), 'product_cat');
													$rating_count = $product->get_rating_count();
													$review_count = $product->get_review_count();



												?>
													<div class="col-xl-<?php echo esc_attr($settings['ms_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['ms_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['ms_col_for_tablet']); ?> col-<?php echo esc_attr($settings['ms_col_for_mobile']); ?>">
														<div class="ms-product-item-2 mb-40">
															<?php if (has_post_thumbnail()) : ?>
																<div class="ms-product-thumb-2 p-relative z-index-1 fix w-img">
																	<a href="<?php the_permalink(); ?>">
																		<?php
																		$get_img_from_meta = function_exists('tpmeta_image_field') ? tpmeta_image_field('shofy_get_img_thumbnail') : NULL;
																		if (!empty($get_img_from_meta)) : ?>
																			<img src="<?php echo esc_url($get_img_from_meta['url']) ?>" alt="<?php echo esc_attr($get_img_from_meta['alt']); ?>">
																		<?php else :
																			the_post_thumbnail();
																		endif;
																		?>
																	</a>

																	<!-- product badge -->
																	<div class="ms-product-badge-2">
																		<?php echo $this->product_badge(); ?>
																	</div>

																	<!-- product action -->
																	<div class="ms-product-action-2 ms-product-action-blackStyle ms-woo-action ms-woo-tooltip-right">
																		<div class="ms-product-action-item-2 d-flex flex-column">

																			<div class="ms-product-action-btn-2 ms-woo-add-cart-btn ms-woo-action-btn">
																				<?php woocommerce_template_loop_add_to_cart(); ?>
																			</div>
																			<!-- quick view button -->
																			<?php if (class_exists('WPCleverWoosq')) : ?>
																				<div class="ms-product-action-btn-2 ms-woo-quick-view-btn ms-woo-action-btn">
																					<?php echo do_shortcode('[woosq]'); ?>
																				</div>
																			<?php endif; ?>


																			<?php if (function_exists('woosw_init')) : ?>
																				<!-- wishlist button -->
																				<div class="ms-product-action-btn-2 ms-woo-add-to-wishlist-btn ms-woo-action-btn">
																					<?php echo do_shortcode('[woosw]'); ?>
																				</div>
																			<?php endif; ?>


																			<?php if (function_exists('woosc_init')) : ?>
																				<!-- compare button -->
																				<div class="ms-product-action-btn-2 ms-woo-add-to-compare-btn ms-woo-action-btn">
																					<?php echo do_shortcode('[woosc]'); ?>
																					<span class="ms-product-tooltip ms-product-tooltip-right ms-woo-tooltip"> <?php echo esc_html__('Add To Compare', 'shofy'); ?></span>
																				</div>
																			<?php endif; ?>

																		</div>
																	</div>
																</div>
															<?php endif; ?>
															<div class="ms-product-content-2 pt-15">
																<div class="ms-product-tag-2">
																	<?php foreach ($terms as $key => $term) :
																		$count = count($terms) - 1;

																		$name = ($count > $key) ? $term->name . ', ' : $term->name
																	?>
																		<?php if (!empty($term)) : ?>
																			<a href="<?php echo get_term_link($term->slug, 'product_cat'); ?> "> <?php echo esc_html($name); ?></a>
																		<?php endif; ?>
																	<?php endforeach; ?>
																</div>

																<h3 class="ms-product-title-2">
																	<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
																</h3>

																<?php if ($rating_count > 0) : ?>
																	<div class="ms-product-rating-icon ms-product-rating-icon-2">
																		<?php echo ms_kses($rating); ?>
																	</div>
																<?php endif; ?>
																<div class="ms-product-price-wrapper-2 ms-woo-price">
																	<?php echo woocommerce_template_loop_price(); ?>
																</div>
															</div>
														</div>
													</div>
												<?php endwhile;
												wp_reset_query(); ?>
											</div>
										</div>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</section>
			<!-- product area end -->

		<?php elseif ($settings['ms_design_style']  == 'layout-3') :
			$this->add_render_attribute('title_args', 'class', 'section__title-4 ms-el-title');
		?>

			<!-- best collection area start -->
			<section class="ms-best-area pb-60 pt-130">
				<div class="container">
					<div class="row align-items-end">
						<?php if (!empty($settings['ms_section_title']) || !empty($settings['ms_section_subtitle'])) : ?>
							<div class="col-xl-6 col-lg-6">
								<div class="ms-section-title-wrapper-3 mb-45 text-center text-lg-start">

									<?php if (!empty($settings['ms_section_subtitle'])) : ?>
										<span class="ms-section-title-pre-3"><?php echo ms_kses($settings['ms_section_subtitle']); ?></span>
									<?php endif; ?>

									<?php if (!empty($settings['ms_section_title'])) : ?>
										<h3 class="ms-section-title-3"><?php echo ms_kses($settings['ms_section_title']); ?></h3>
									<?php endif; ?>
								</div>
							</div>
						<?php endif; ?>

						<?php if (!empty($filter_list) && count($filter_list) > 0) : ?>
							<div class="col-xl-6 col-lg-6">
								<div class="ms-product-tab-2 ms-product-tab-3  ms-tab mb-50 text-center">
									<div class="ms-product-tab-inner-3 d-flex align-items-center justify-content-center justify-content-lg-end">
										<nav>
											<div class="nav nav-tabs justify-content-center ms-product-tab ms-tab-menu p-relative" id="nav-tab" role="tablist">
												<?php
												$posts_per_page = (!empty($settings['posts_per_page'])) ? $settings['posts_per_page'] : '-1';


												$count = 0;

												foreach ($filter_list as $key => $list) :
													$active = ($count == 0) ? 'active' : '';

													$post_args = [
														'post_status' => 'publish',
														'post_type' => 'product',
														'posts_per_page' => $posts_per_page,
														'tax_query' => array(
															array(
																'taxonomy' => 'product_cat',
																'field' => 'slug',
																'terms' => $list,
															),
														),
													];
													$pro_query = new \WP_Query($post_args);

													$item_count = 0;
													while ($pro_query->have_posts()) :
														$pro_query->the_post();
														$item_count++;
													endwhile;


												?>
													<button class="nav-link <?php echo esc_attr($active); ?>" id="nav-allCollection-tab-3-<?php echo esc_attr($key); ?>" data-bs-toggle="tab" data-bs-target="#nav-allCollection-3-<?php echo esc_attr($key); ?>" type="button" role="tab" aria-controls="nav-allCollection-3-<?php echo esc_attr($key); ?>" aria-selected="true">
														<?php echo esc_html($list); ?>
														<span class="ms-product-tab-tooltip"><?php echo esc_html($item_count); ?></span>
													</button>
												<?php $count++;
												endforeach; ?>
												<span id="productTabMarker" class="ms-tab-line d-none d-sm-inline-block"></span>
											</div>
										</nav>
									</div>
								</div>
							</div>
						<?php endif; ?>
					</div>
					<div class="row">
						<div class="col-xl-12">
							<?php if (!empty($filter_list)) : ?>
								<div class="tab-content" id="nav-tabContent3">
									<?php
									$posts_per_page = (!empty($settings['posts_per_page'])) ? $settings['posts_per_page'] : '-1';
									foreach ($filter_list as $key => $list) :
										$active_tab = ($key == 0) ? 'active show' : '';
									?>

										<div class="tab-pane fade <?php echo esc_attr($active_tab); ?>" id="nav-allCollection-3-<?php echo esc_attr($key); ?>" role="tabpanel" aria-labelledby="nav-allCollection-tab-3-<?php echo esc_attr($key); ?>" tabindex="0">

											<div class="row">
												<?php

												$post_args = [
													'post_status' => 'publish',
													'post_type' => 'product',
													'posts_per_page' => $posts_per_page,
													'tax_query' => array(
														array(
															'taxonomy' => 'product_cat',
															'field' => 'slug',
															'terms' => $list,
														),
													),
												];
												$pro_query = new \WP_Query($post_args);
												while ($pro_query->have_posts()) :
													$pro_query->the_post();

													global $product;
													global $post;
													global $woocommerce;

													$attachment_ids = $product->get_gallery_image_ids();


													foreach ($attachment_ids as $key => $attachment_id) {
														$image_link =  wp_get_attachment_url($attachment_id);
														$arr[] = $image_link;
													}


													$rating = wc_get_rating_html($product->get_average_rating());
													$terms = get_the_terms(get_the_ID(), 'product_cat');
													$rating_count = $product->get_rating_count();
													$review_count = $product->get_review_count();
													$has_rating = $rating_count > 0 ? 'has-rating' : '';
												?>

													<div class="col-xl-<?php echo esc_attr($settings['ms_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['ms_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['ms_col_for_tablet']); ?> col-<?php echo esc_attr($settings['ms_col_for_mobile']); ?>">
														<div class="ms-product-item-3 mb-50">
															<?php if (has_post_thumbnail()) : ?>
																<div class="ms-product-thumb-3 mb-15 fix p-relative z-index-1">

																	<a href="<?php the_permalink(); ?>">
																		<?php
																		$get_img_from_meta = function_exists('tpmeta_image_field') ? tpmeta_image_field('shofy_get_img_thumbnail') : NULL;
																		if (!empty($get_img_from_meta)) : ?>
																			<img src="<?php echo esc_url($get_img_from_meta['url']) ?>" alt="<?php echo esc_attr($get_img_from_meta['alt']); ?>">
																		<?php else :
																			the_post_thumbnail();
																		endif;
																		?>
																	</a>
																	<!-- product badge -->
																	<div class="ms-product-badge-2 ">
																		<?php echo $this->product_badge(); ?>
																	</div>

																	<!-- product action -->
																	<div class="ms-product-action-3 ms-product-action-blackStyle ms-woo-action ms-woo-action-2 ms-woo-action-3 ms-woo-tooltip-left">
																		<div class="ms-product-action-item-3 d-flex flex-column">


																			<!-- quick view button -->
																			<?php if (class_exists('WPCleverWoosq')) : ?>
																				<div class="ms-product-action-btn-3 ms-woo-quick-view-btn ms-woo-action-btn">
																					<?php echo do_shortcode('[woosq]'); ?>
																				</div>
																			<?php endif; ?>


																			<?php if (function_exists('woosw_init')) : ?>
																				<!-- wishlist button -->
																				<div class="ms-product-action-btn-3 ms-woo-add-to-wishlist-btn ms-woo-action-btn">
																					<?php echo do_shortcode('[woosw]'); ?>
																				</div>
																			<?php endif; ?>


																			<?php if (function_exists('woosc_init')) : ?>
																				<!-- compare button -->
																				<div class="ms-product-action-btn-3 ms-woo-add-to-compare-btn ms-woo-action-btn">
																					<?php echo do_shortcode('[woosc]'); ?>
																					<span class="ms-product-tooltip ms-woo-tooltip"> <?php echo esc_html__('Add To Compare', 'shofy'); ?></span>
																				</div>
																			<?php endif; ?>

																		</div>
																	</div>

																	<div class="ms-woo-action ms-woo-action-3">
																		<div class="ms-product-add-cart-btn-large-3 ms-woo-add-cart-btn ms-woo-action-btn">
																			<?php woocommerce_template_loop_add_to_cart(); ?>
																		</div>
																	</div>
																</div>
															<?php endif; ?>

															<div class="ms-product-content-3">
																<div class="ms-product-tag-3">
																	<?php foreach ($terms as $key => $term) :
																		$count = count($terms) - 1;

																		$name = ($count > $key) ? $term->name . ', ' : $term->name
																	?>

																		<?php if (!empty($term)) : ?>
																			<a href="<?php echo get_term_link($term->slug, 'product_cat'); ?> "> <?php echo esc_html($name); ?></a>
																		<?php endif; ?>
																	<?php endforeach; ?>
																</div>

																<h3 class="ms-product-title-3 <?php echo esc_attr($has_rating); ?>">
																	<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
																</h3>

																<?php if ($rating_count > 0) : ?>
																	<div class="ms-product-rating ms-product-rating-3 d-flex align-items-center <?php echo esc_attr($has_rating); ?>">
																		<div class="ms-product-rating-icon">
																			<?php echo shofy_kses($rating); ?>
																		</div>
																		<div class="ms-product-rating-text">
																			<?php if (comments_open()) : ?>
																				<?php //phpcs:disable 
																				?>
																				<a href="#reviews" class="woocommerce-review-link" rel="nofollow"><?php printf(_n('( %s Review )', '( %s Reviews )', $review_count, 'shofy'), '<span class="count">' . esc_html($review_count) . '</span>'); ?></a>
																				<?php // phpcs:enable 
																				?>
																			<?php endif; ?>
																		</div>
																	</div>
																<?php endif; ?>

																<div class="ms-product-price-wrapper-3 ms-woo-price">
																	<?php echo woocommerce_template_loop_price(); ?>
																</div>
															</div>
														</div>
													</div>
												<?php endwhile;
												wp_reset_query(); ?>
											</div>
										</div>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
						</div>
					</div>

				</div>
			</section>
			<!-- best collection area end -->

		<?php elseif ($settings['ms_design_style']  == 'layout-4') :
			$this->add_render_attribute('title_args', 'class', 'section__title-4 ms-el-title');
		?>

			<!-- product area start -->
			<section class="ms-product-area pt-115 pb-80">
				<div class="container">
					<div class="row align-items-end">
						<?php if (!empty($settings['ms_section_title']) || !empty($settings['ms_section_subtitle'])) : ?>
							<div class="col-xl-6 col-lg-6">
								<div class="ms-section-title-wrapper-4 mb-40 text-center text-lg-start">
									<?php if (!empty($settings['ms_section_subtitle'])) : ?>
										<span class="ms-section-title-pre-4"><?php echo ms_kses($settings['ms_section_subtitle']); ?></span>
									<?php endif; ?>

									<?php if (!empty($settings['ms_section_title'])) : ?>
										<h3 class="ms-section-title-4"><?php echo ms_kses($settings['ms_section_title']); ?></h3>
									<?php endif; ?>
								</div>
							</div>
						<?php endif; ?>

						<?php if (!empty($filter_list) && count($filter_list) > 0) : ?>
							<div class="col-xl-6 col-lg-6">
								<div class="ms-product-tab-2 ms-product-tab-3  ms-tab mb-45">
									<div class="ms-product-tab-inner-3 d-flex align-items-center justify-content-center justify-content-lg-end">
										<nav>
											<div class="nav nav-tabs justify-content-center ms-product-tab ms-tab-menu p-relative" id="nav-tab" role="tablist">

												<?php
												$posts_per_page = (!empty($settings['posts_per_page'])) ? $settings['posts_per_page'] : '-1';


												$count = 0;

												foreach ($filter_list as $key => $list) :
													$active = ($count == 0) ? 'active' : '';

													$post_args = [
														'post_status' => 'publish',
														'post_type' => 'product',
														'posts_per_page' => $posts_per_page,
														'tax_query' => array(
															array(
																'taxonomy' => 'product_cat',
																'field' => 'slug',
																'terms' => $list,
															),
														),
													];
													$pro_query = new \WP_Query($post_args);

													$item_count = 0;
													while ($pro_query->have_posts()) :
														$pro_query->the_post();
														$item_count++;
													endwhile;
												?>
													<button class="nav-link <?php echo esc_attr($active); ?>" id="nav-allCollection-tab-4-<?php echo esc_attr($key); ?>" data-bs-toggle="tab" data-bs-target="#nav-allCollection-4-<?php echo esc_attr($key); ?>" type="button" role="tab" aria-controls="nav-allCollection-4-<?php echo esc_attr($key); ?>" aria-selected="true">
														<?php echo esc_html($list); ?>
														<span class="ms-product-tab-tooltip"><?php echo esc_html($item_count); ?></span>
													</button>
												<?php $count++;
												endforeach; ?>

												<span id="productTabMarker" class="ms-tab-line d-none d-sm-inline-block"></span>
											</div>
										</nav>
									</div>
								</div>
							</div>
						<?php endif; ?>
					</div>
					<div class="row">
						<div class="col-xl-12">

							<?php if (!empty($filter_list)) : ?>
								<div class="tab-content" id="nav-tabContent4">
									<?php


									$posts_per_page = (!empty($settings['posts_per_page'])) ? $settings['posts_per_page'] : '-1';
									foreach ($filter_list as $key => $list) :
										$active_tab = ($key == 0) ? 'active show' : '';
									?>
										<div class="tab-pane fade <?php echo esc_attr($active_tab); ?>" id="nav-allCollection-4-<?php echo esc_attr($key); ?>" role="tabpanel" aria-labelledby="nav-allCollection-tab-4-<?php echo esc_attr($key); ?>" tabindex="0">
											<div class="row">

												<?php

												$post_args = [
													'post_status' => 'publish',
													'post_type' => 'product',
													'posts_per_page' => $posts_per_page,
													'tax_query' => array(
														array(
															'taxonomy' => 'product_cat',
															'field' => 'slug',
															'terms' => $list,
														),
													),
												];
												$pro_query = new \WP_Query($post_args);
												while ($pro_query->have_posts()) :
													$pro_query->the_post();

													global $product;
													global $post;
													global $woocommerce;

													$attachment_ids = $product->get_gallery_image_ids();


													foreach ($attachment_ids as $key => $attachment_id) {
														$image_link =  wp_get_attachment_url($attachment_id);
														$arr[] = $image_link;
													}


													$rating = wc_get_rating_html($product->get_average_rating());
													$terms = get_the_terms(get_the_ID(), 'product_cat');
													$rating_count = $product->get_rating_count();
													$review_count = $product->get_review_count();
													$has_rating = $rating_count > 0 ? 'has-rating' : '';
												?>

													<div class="col-xl-<?php echo esc_attr($settings['ms_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['ms_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['ms_col_for_tablet']); ?> col-<?php echo esc_attr($settings['ms_col_for_mobile']); ?>">
														<div class="ms-product-item-4 p-relative mb-40">
															<?php if (has_post_thumbnail()) : ?>
																<div class="ms-product-thumb-4 w-img fix">

																	<a href="<?php the_permalink(); ?>">
																		<?php
																		$get_img_from_meta = function_exists('tpmeta_image_field') ? tpmeta_image_field('shofy_get_img_thumbnail') : NULL;
																		if (!empty($get_img_from_meta)) : ?>
																			<img src="<?php echo esc_url($get_img_from_meta['url']) ?>" alt="<?php echo esc_attr($get_img_from_meta['alt']); ?>">
																		<?php else :
																			the_post_thumbnail();
																		endif;
																		?>
																	</a>

																	<!-- product badge -->
																	<div class="ms-product-badge-2 ">
																		<?php echo $this->product_badge(); ?>
																	</div>

																	<!-- product action -->
																	<div class="ms-product-action-3 ms-product-action-4 has-shadow ms-product-action-blackStyle ms-product-action-brownStyle ms-woo-action ms-woo-action-4 ms-woo-tooltip-left">
																		<div class="ms-product-action-item-3 d-flex flex-column">

																			<!-- quick view button -->
																			<?php if (class_exists('WPCleverWoosq')) : ?>
																				<div class="ms-product-action-btn-3 ms-woo-quick-view-btn ms-woo-action-btn">
																					<?php echo do_shortcode('[woosq]'); ?>
																				</div>
																			<?php endif; ?>


																			<?php if (function_exists('woosw_init')) : ?>
																				<!-- wishlist button -->
																				<div class="ms-product-action-btn-3 ms-woo-add-to-wishlist-btn ms-woo-action-btn">
																					<?php echo do_shortcode('[woosw]'); ?>
																				</div>
																			<?php endif; ?>


																			<?php if (function_exists('woosc_init')) : ?>
																				<!-- compare button -->
																				<div class="ms-product-action-btn-3 ms-woo-add-to-compare-btn ms-woo-action-btn">
																					<?php echo do_shortcode('[woosc]'); ?>
																					<span class="ms-product-tooltip ms-woo-tooltip"> <?php echo esc_html__('Add To Compare', 'shofy'); ?></span>
																				</div>
																			<?php endif; ?>

																		</div>
																	</div>

																</div>
															<?php endif; ?>
															<div class="ms-product-content-4">
																<h3 class="ms-product-title-4">
																	<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
																</h3>
																<div class="ms-product-info-4">
																	<?php foreach ($terms as $key => $term) :
																		$count = count($terms) - 1;

																		$name = ($count > $key) ? $term->name . ', ' : $term->name
																	?>
																		<?php if (!empty($term)) : ?>
																			<a href="<?php echo get_term_link($term->slug, 'product_cat'); ?> "> <?php echo esc_html($name); ?></a>
																		<?php endif; ?>
																	<?php endforeach; ?>
																</div>
																<?php if ($rating_count > 0) : ?>
																	<div class="ms-product-rating ms-product-rating-3 d-flex align-items-center <?php echo esc_attr($has_rating); ?>">
																		<div class="ms-product-rating-icon">
																			<?php echo shofy_kses($rating); ?>
																		</div>
																		<div class="ms-product-rating-text">
																			<?php if (comments_open()) : ?>
																				<?php //phpcs:disable 
																				?>
																				<a href="#reviews" class="woocommerce-review-link" rel="nofollow"><?php printf(_n('( %s Review )', '( %s Reviews )', $review_count, 'shofy'), '<span class="count">' . esc_html($review_count) . '</span>'); ?></a>
																				<?php // phpcs:enable 
																				?>
																			<?php endif; ?>
																		</div>
																	</div>
																<?php endif; ?>
																<div class="ms-product-price-inner-4">
																	<div class="ms-product-price-wrapper-4 ms-woo-price ms-woo-price-4">
																		<?php echo woocommerce_template_loop_price(); ?>
																	</div>

																	<div class="ms-product-price-add-to-cart ms-woo-action ms-woo-action-4">
																		<div class="ms-product-add-to-cart-4 ms-woo-add-cart-btn ms-woo-action-btn">
																			<?php woocommerce_template_loop_add_to_cart(); ?>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>


												<?php endwhile;
												wp_reset_query(); ?>
											</div>
										</div>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
						</div>
					</div>

				</div>
			</section>
			<!-- product area end -->

		<?php elseif ($settings['ms_design_style']  == 'layout-5') :
			$this->add_render_attribute('title_args', 'class', 'section__title-4 ms-el-title');
		?>

			<section class="ms-product-area pb-70">
				<div class="container">
					<div class="row align-items-end">
						<?php if (!empty($settings['ms_section_title']) || !empty($settings['ms_section_subtitle'])) : ?>
							<div class="col-xl-6 col-lg-5">
								<div class="ms-section-title-wrapper-5 mb-45 text-center text-lg-start">

									<?php if (!empty($settings['ms_section_subtitle'])) : ?>
										<span class="ms-section-title-pre-5"><?php echo ms_kses($settings['ms_section_subtitle']); ?></span>
									<?php endif; ?>

									<?php if (!empty($settings['ms_section_title'])) : ?>
										<h3 class="ms-section-title-5"><?php echo ms_kses($settings['ms_section_title']); ?></h3>
									<?php endif; ?>
								</div>
							</div>
						<?php endif; ?>

						<?php if (!empty($filter_list) && count($filter_list) > 0) : ?>
							<div class="col-xl-6 col-lg-7">
								<div class="ms-product-tab-2 ms-product-tab-5 ms-tab mb-55">
									<div class="ms-product-tab-inner-3 d-flex align-items-center justify-content-center justify-content-lg-end">
										<nav>
											<div class="nav nav-tabs justify-content-center ms-product-tab ms-tab-menu p-relative" id="nav-tab" role="tablist">

												<?php
												$posts_per_page = (!empty($settings['posts_per_page'])) ? $settings['posts_per_page'] : '-1';


												$count = 0;

												foreach ($filter_list as $key => $list) :
													$active = ($count == 0) ? 'active' : '';

													$post_args = [
														'post_status' => 'publish',
														'post_type' => 'product',
														'posts_per_page' => $posts_per_page,
														'tax_query' => array(
															array(
																'taxonomy' => 'product_cat',
																'field' => 'slug',
																'terms' => $list,
															),
														),
													];
													$pro_query = new \WP_Query($post_args);

													$item_count = 0;
													while ($pro_query->have_posts()) :
														$pro_query->the_post();
														$item_count++;
													endwhile;
												?>
													<button class="nav-link <?php echo esc_attr($active); ?>" id="nav-allCollection-tab-5-<?php echo esc_attr($key); ?>" data-bs-toggle="tab" data-bs-target="#nav-allCollection-5-<?php echo esc_attr($key); ?>" type="button" role="tab" aria-controls="nav-allCollection-5-<?php echo esc_attr($key); ?>" aria-selected="true">
														<?php echo esc_html($list); ?>
														<span class="ms-product-tab-tooltip"><?php echo esc_html($item_count); ?></span>
													</button>
												<?php $count++;
												endforeach; ?>

												<span id="productTabMarker" class="ms-tab-line d-none d-sm-inline-block"></span>
											</div>
										</nav>
									</div>
								</div>
							</div>
						<?php endif; ?>
					</div>

					<div class="row">
						<div class="col-xl-12">
							<?php if (!empty($filter_list)) : ?>
								<div class="tab-content" id="nav-tabContent5">
									<?php


									$posts_per_page = (!empty($settings['posts_per_page'])) ? $settings['posts_per_page'] : '-1';
									foreach ($filter_list as $key => $list) :
										$active_tab = ($key == 0) ? 'active show' : '';
									?>
										<div class="tab-pane fade <?php echo esc_attr($active_tab); ?>" id="nav-allCollection-5-<?php echo esc_attr($key); ?>" role="tabpanel" aria-labelledby="nav-allCollection-tab-5-<?php echo esc_attr($key); ?>" tabindex="0">
											<div class="row">

												<?php

												$post_args = [
													'post_status' => 'publish',
													'post_type' => 'product',
													'posts_per_page' => $posts_per_page,
													'tax_query' => array(
														array(
															'taxonomy' => 'product_cat',
															'field' => 'slug',
															'terms' => $list,
														),
													),
												];
												$pro_query = new \WP_Query($post_args);
												while ($pro_query->have_posts()) :
													$pro_query->the_post();

													global $product;
													global $post;
													global $woocommerce;

													$attachment_ids = $product->get_gallery_image_ids();


													foreach ($attachment_ids as $key => $attachment_id) {
														$image_link =  wp_get_attachment_url($attachment_id);
														$arr[] = $image_link;
													}


													$rating = wc_get_rating_html($product->get_average_rating());
													$terms = get_the_terms(get_the_ID(), 'product_cat');
													$rating_count = $product->get_rating_count();
													$review_count = $product->get_review_count();
												?>

													<div class="col-xl-<?php echo esc_attr($settings['ms_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['ms_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['ms_col_for_tablet']); ?> col-<?php echo esc_attr($settings['ms_col_for_mobile']); ?>">
														<div class="ms-product-item-5 p-relative white-bg mb-40">
															<?php if (has_post_thumbnail()) : ?>
																<div class="ms-product-thumb-5 w-img fix mb-15">
																	<a href="<?php the_permalink(); ?>">
																		<?php
																		$get_img_from_meta = function_exists('tpmeta_image_field') ? tpmeta_image_field('shofy_get_img_thumbnail') : NULL;
																		if (!empty($get_img_from_meta)) : ?>
																			<img src="<?php echo esc_url($get_img_from_meta['url']) ?>" alt="<?php echo esc_attr($get_img_from_meta['alt']); ?>">
																		<?php else :
																			the_post_thumbnail();
																		endif;
																		?>
																	</a>

																	<div class="ms-product-badge-2 ms-product-badge-5 d-flex">
																		<?php echo $this->product_badge(); ?>
																	</div>

																	<!-- product action -->
																	<div class="ms-product-action-2 ms-product-action-5 ms-product-action-greenStyle ms-woo-action ms-woo-action-6 ms-woo-tooltip-right">
																		<div class="ms-product-action-item-2 d-flex flex-column">

																			<div class="ms-product-action-btn-2 ms-woo-add-cart-btn ms-woo-action-btn">
																				<?php woocommerce_template_loop_add_to_cart(); ?>
																			</div>
																			<!-- quick view button -->
																			<?php if (class_exists('WPCleverWoosq')) : ?>
																				<div class="ms-product-action-btn-2 ms-woo-quick-view-btn ms-woo-action-btn">
																					<?php echo do_shortcode('[woosq]'); ?>
																				</div>
																			<?php endif; ?>


																			<?php if (function_exists('woosw_init')) : ?>
																				<!-- wishlist button -->
																				<div class="ms-product-action-btn-2 ms-woo-add-to-wishlist-btn ms-woo-action-btn">
																					<?php echo do_shortcode('[woosw]'); ?>
																				</div>
																			<?php endif; ?>


																			<?php if (function_exists('woosc_init')) : ?>
																				<!-- compare button -->
																				<div class="ms-product-action-btn-2 ms-woo-add-to-compare-btn ms-woo-action-btn">
																					<?php echo do_shortcode('[woosc]'); ?>
																					<span class="ms-product-tooltip ms-product-tooltip-right ms-woo-tooltip"> <?php echo esc_html__('Add To Compare', 'shofy'); ?></span>
																				</div>
																			<?php endif; ?>

																		</div>
																	</div>
																</div>
															<?php endif; ?>

															<div class="ms-product-content-5">
																<div class="ms-product-tag-5">
																	<?php foreach ($terms as $key => $term) :
																		$count = count($terms) - 1;

																		$name = ($count > $key) ? $term->name . ', ' : $term->name
																	?>
																		<?php if (!empty($term)) : ?>
																			<a href="<?php echo get_term_link($term->slug, 'product_cat'); ?> "> <?php echo esc_html($name); ?></a>
																		<?php endif; ?>
																	<?php endforeach; ?>
																</div>

																<h3 class="ms-product-title-5">
																	<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
																</h3>

																<?php if ($rating_count > 0) : ?>
																	<div class="ms-product-rating-5">
																		<?php echo shofy_kses($rating); ?>
																	</div>
																<?php endif; ?>


																<div class="ms-product-price-wrapper-5 ms-woo-price ms-woo-price-6">
																	<?php echo woocommerce_template_loop_price(); ?>
																</div>
															</div>

														</div>
													</div>

												<?php endwhile;
												wp_reset_query(); ?>
											</div>
										</div>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
						</div>
					</div>

				</div>
			</section>

		<?php else : ?>



			<section class="ms-product-area pb-55">
				<div class="container">
					<div class="row align-items-end">
						<?php if (!empty($settings['ms_section_title'])) : ?>
							<div class="col-xl-5 col-lg-6 col-md-5">
								<div class="ms-section-title-wrapper mb-40">
									<h3 class="ms-section-title"><?php echo ms_kses($settings['ms_section_title']); ?></h3>
								</div>
							</div>
						<?php endif; ?>

						<?php if (!empty($filter_list) && count($filter_list) > 0) : ?>
							<div class="col-xl-7 col-lg-6 col-md-7">
								<div class="ms-product-tab ms-product-tab-border mb-45 ms-tab d-flex justify-content-md-end">
									<ul class="nav nav-tabs justify-content-sm-end" id="productTab" role="tablist">
										<?php

										$count = 0;

										foreach ($filter_list as $key => $list) :
											$active = ($count == 0) ? 'active' : '';
										?>
											<li class="nav-item" role="presentation">
												<button class="nav-link <?php echo esc_attr($active); ?>" id="new-tab-<?php echo esc_attr($key); ?>" data-bs-toggle="tab" data-bs-target="#new-tab-pane-<?php echo esc_attr($key); ?>" type="button" role="tab" aria-controls="new-tab-pane-<?php echo esc_attr($key); ?>" aria-selected="true">
													<?php echo esc_html($list); ?>
													<span class="ms-product-tab-line">
														<svg width="52" height="13" viewBox="0 0 52 13" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path d="M1 8.97127C11.6061 -5.48521 33 3.99996 51 11.4635" stroke="currentColor" stroke-width="2" stroke-miterlimit="3.8637" stroke-linecap="round"></path>
														</svg>
													</span>
												</button>
											</li>
										<?php $count++;
										endforeach; ?>
									</ul>
								</div>
							</div>
						<?php endif; ?>
					</div>
					<div class="row">
						<div class="col-xl-12">
							<div class="ms-product-tab-content">
								<?php if (!empty($filter_list)) : ?>
									<div class="tab-content" id="myTabContent1">
										<?php
										$posts_per_page = (!empty($settings['posts_per_page'])) ? $settings['posts_per_page'] : '-1';
										foreach ($filter_list as $key => $list) :
											$active_tab = ($key == 0) ? 'active show' : '';
										?>
											<div class="tab-pane fade <?php echo esc_attr($active_tab); ?>" id="new-tab-pane-<?php echo esc_attr($key); ?>" role="tabpanel" aria-labelledby="new-tab-<?php echo esc_attr($key); ?>" tabindex="0">
												<div class="row">
													<?php

													$post_args = [
														'post_status' => 'publish',
														'post_type' => 'product',
														'posts_per_page' => $posts_per_page,
														'tax_query' => array(
															array(
																'taxonomy' => 'product_cat',
																'field' => 'slug',
																'terms' => $list,
															),
														),
													];
													$pro_query = new \WP_Query($post_args);
													while ($pro_query->have_posts()) :
														$pro_query->the_post();

														global $product;
														global $post;
														global $woocommerce;

														$attachment_ids = $product->get_gallery_image_ids();


														foreach ($attachment_ids as $key => $attachment_id) {
															$image_link =  wp_get_attachment_url($attachment_id);
															$arr[] = $image_link;
														}


														$rating = wc_get_rating_html($product->get_average_rating());
														$terms = get_the_terms(get_the_ID(), 'product_cat');
														$rating_count = $product->get_rating_count();
														$review_count = $product->get_review_count();



													?>
														<div class="col-xl-<?php echo esc_attr($settings['ms_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['ms_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['ms_col_for_tablet']); ?> col-<?php echo esc_attr($settings['ms_col_for_mobile']); ?>">
															<div class="ms-product-item p-relative transition-3 mb-25">
																<?php if (has_post_thumbnail()) : ?>
																	<div class="ms-product-thumb p-relative fix m-img">
																		<a href="<?php the_permalink(); ?>">

																			<?php
																			$get_img_from_meta = function_exists('tpmeta_image_field') ? tpmeta_image_field('shofy_get_img_thumbnail') : NULL;
																			if (!empty($get_img_from_meta)) : ?>
																				<img src="<?php echo esc_url($get_img_from_meta['url']) ?>" alt="<?php echo esc_attr($get_img_from_meta['alt']); ?>">
																			<?php else :
																				the_post_thumbnail();
																			endif;
																			?>
																		</a>

																		<!-- product badge -->
																		<div class="ms-product-badge ms-product-badge-2">
																			<?php echo $this->product_badge(); ?>
																		</div>

																		<!-- product action -->
																		<div class="ms-product-action ms-woo-action ms-woo-action-2 ms-woo-tooltip-left">
																			<div class="ms-product-action-item d-flex flex-column">

																				<div type="button" class="ms-product-action-btn ms-product-add-cart-btn ms-woo-add-cart-btn ms-woo-action-btn">
																					<?php woocommerce_template_loop_add_to_cart(); ?>
																				</div>

																				<!-- quick view button -->
																				<?php if (class_exists('WPCleverWoosq')) : ?>
																					<div class="ms-product-action-btn ms-woo-quick-view-btn ms-woo-action-btn">
																						<?php echo do_shortcode('[woosq]'); ?>
																					</div>
																				<?php endif; ?>


																				<?php if (function_exists('woosw_init')) : ?>
																					<!-- wishlist button -->
																					<div class="ms-product-action-btn ms-woo-add-to-wishlist-btn ms-woo-action-btn">
																						<?php echo do_shortcode('[woosw]'); ?>
																					</div>
																				<?php endif; ?>


																				<?php if (function_exists('woosc_init')) : ?>
																					<!-- compare button -->
																					<div class="ms-product-action-btn ms-woo-add-to-compare-btn ms-woo-action-btn">
																						<?php echo do_shortcode('[woosc]'); ?>
																						<span class="ms-product-tooltip ms-woo-tooltip"> <?php echo esc_html__('Add To Compare', 'shofy'); ?></span>
																					</div>
																				<?php endif; ?>
																			</div>
																		</div>
																	</div>
																<?php endif; ?>
																<!-- product content -->
																<div class="ms-product-content">

																	<div class="ms-product-category">
																		<?php foreach ($terms as $key => $term) :
																			$count = count($terms) - 1;

																			$name = ($count > $key) ? $term->name . ', ' : $term->name
																		?>
																			<?php if (!empty($term)) : ?>
																				<a href="<?php echo get_term_link($term->slug, 'product_cat'); ?> "> <?php echo esc_html($name); ?></a>
																			<?php endif; ?>
																		<?php endforeach;  ?>

																	</div>

																	<h3 class="ms-product-title">
																		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
																	</h3>

																	<?php if ($rating_count > 0) : ?>
																		<div class="ms-product-rating d-flex align-items-center">
																			<div class="ms-product-rating-icon">
																				<?php echo ms_kses($rating); ?>
																			</div>
																			<div class="ms-product-rating-text">
																				<?php if (comments_open()) : ?>
																					<?php //phpcs:disable 
																					?>
																					<span><a href="#reviews" class="woocommerce-review-link" rel="nofollow"><?php printf(_n('( %s Review )', '( %s Reviews )', $review_count, 'shofy'), '<span class="count">' . esc_html($review_count) . '</span>'); ?></a></span>
																					<?php // phpcs:enable 
																					?>
																				<?php endif; ?>
																			</div>
																		</div>

																	<?php else : ?>
																		<div class="ms-product-rating d-flex align-items-center">
																			<div class="ms-product-rating-icon no-rating">
																				<span><i class="fa-solid fa-star"></i></span>
																				<span><i class="fa-solid fa-star"></i></span>
																				<span><i class="fa-solid fa-star"></i></span>
																				<span><i class="fa-solid fa-star"></i></span>
																				<span><i class="fa-solid fa-star"></i></span>
																			</div>
																			<div class="ms-product-rating-text">
																				<span><?php echo esc_html__('(0 Review)', 'shofy'); ?></span>
																			</div>
																		</div>

																	<?php endif; ?>

																	<div class="ms-product-price-wrapper ms-woo-price ms-woo-price-2">
																		<?php echo woocommerce_template_loop_price(); ?>
																	</div>
																</div>
															</div>
														</div>
													<?php endwhile;
													wp_reset_query(); ?>
												</div>
											</div>
										<?php endforeach; ?>
									</div>

								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</section>



		<?php endif; ?>

<?php
	}
}

$widgets_manager->register(new MS_Product_Tab());
