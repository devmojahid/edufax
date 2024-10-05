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
class MS_Product_Post extends Widget_Base
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
      return 'ms-product';
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
      return __('Product Post', 'mscore');
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

      $this->start_controls_section(
         'ms_section_sec',
         [
            'label' => esc_html__('Section Title', 'mscore'),
            'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            'condition' => [
               'ms_design_style!' => 'layout-2'
            ]

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
               'ms_design_style' => ['layout-5', 'layout-6']
            ]
         ]
      );



      $this->add_control(
         'ms_section_title',
         [
            'label'       => esc_html__('Title', 'mscore'),
            'type'        => \Elementor\Controls_Manager::TEXTAREA,
            'default'     => esc_html__('Your Title', 'mscore'),
            'placeholder' => esc_html__('Your Text', 'mscore'),
            'label_block' => true
         ]
      );

      $this->end_controls_section();



      $this->ms_product_badges();



      // Product Query
      $this->ms_query_controls('product', 'Product', '6', '10', 'product', 'product_cat');

      $this->ms_product_layout('product', 'Product Layouts');


      $this->start_controls_section(
         'ms_colcolumns_section',
         [
            'label' => esc_html__('Product Column', 'mscore'),
            'condition' => [
               'ms_design_style' => ['layout-2', 'layout-6']
            ]
         ]
      );

      $this->add_control(
         'ms_col_for_desktop',
         [
            'label' => esc_html__('Columns for Desktop', 'mscore'),
            'description' => esc_html__('Screen width equal to or greater than 1200px', 'mscore'),
            'type' => Controls_Manager::SELECT,
            'options' => [
               12 => esc_html__('1 Columns', 'mscore'),
               6 => esc_html__('2 Columns', 'mscore'),
               4 => esc_html__('3 Columns', 'mscore'),
               3 => esc_html__('4 Columns', 'mscore'),
               5 => esc_html__('5 Columns (For Carousel Item)', 'mscore'),
               2 => esc_html__('6 Columns', 'mscore'),
               1 => esc_html__('12 Columns', 'mscore'),
            ],
            'separator' => 'before',
            'default' => 4,
            'style_transfer' => true,
         ]
      );
      $this->add_control(
         'ms_col_for_laptop',
         [
            'label' => esc_html__('Columns for Large', 'mscore'),
            'description' => esc_html__('Screen width equal to or greater than 992px', 'mscore'),
            'type' => Controls_Manager::SELECT,
            'options' => [
               12 => esc_html__('1 Columns', 'mscore'),
               6 => esc_html__('2 Columns', 'mscore'),
               4 => esc_html__('3 Columns', 'mscore'),
               3 => esc_html__('4 Columns', 'mscore'),
               5 => esc_html__('5 Columns (For Carousel Item)', 'mscore'),
               2 => esc_html__('6 Columns', 'mscore'),
               1 => esc_html__('12 Columns', 'mscore'),
            ],
            'separator' => 'before',
            'default' => 6,
            'style_transfer' => true,
         ]
      );
      $this->add_control(
         'ms_col_for_tablet',
         [
            'label' => esc_html__('Columns for Tablet', 'mscore'),
            'description' => esc_html__('Screen width equal to or greater than 768px', 'mscore'),
            'type' => Controls_Manager::SELECT,
            'options' => [
               12 => esc_html__('1 Columns', 'mscore'),
               6 => esc_html__('2 Columns', 'mscore'),
               4 => esc_html__('3 Columns', 'mscore'),
               3 => esc_html__('4 Columns', 'mscore'),
               5 => esc_html__('5 Columns (For Carousel Item)', 'mscore'),
               2 => esc_html__('6 Columns', 'mscore'),
               1 => esc_html__('12 Columns', 'mscore'),
            ],
            'separator' => 'before',
            'default' => 6,
            'style_transfer' => true,
         ]
      );
      $this->add_control(
         'ms_col_for_mobile',
         [
            'label' => esc_html__('Columns for Mobile', 'mscore'),
            'description' => esc_html__('Screen width less than 767px', 'mscore'),
            'type' => Controls_Manager::SELECT,
            'options' => [
               12 => esc_html__('1 Columns', 'mscore'),
               6 => esc_html__('2 Columns', 'mscore'),
               4 => esc_html__('3 Columns', 'mscore'),
               3 => esc_html__('4 Columns', 'mscore'),
               5 => esc_html__('5 Columns (For Carousel Item)', 'mscore'),
               2 => esc_html__('6 Columns', 'mscore'),
               1 => esc_html__('12 Columns', 'mscore'),
            ],
            'separator' => 'before',
            'default' => 12,
            'style_transfer' => true,
         ]
      );

      $this->end_controls_section();

      $this->ms_button_render_controls('tpbtn', 'Button', ['layout-1', 'layout-6']);
   }

   // style_tab_content
   protected function style_tab_content()
   {
      $this->ms_section_style_controls('blog_section', 'Section - Style', '.ms-el-section');

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

      $enable_trending_badge    = $settings['product_trending_badge_enable'];
      $enable_hot_badge       = $settings['product_hot_badge_enable'];

      $product_badge_type    = $settings['product_badge_type'];


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


      $sale_count_to_show    = $settings['sale_count_to_show'];
      $rating_count_to_show    = $settings['rating_count_to_show'];
      $review_count_to_show    = $settings['review_count_to_show'];
      $view_count_to_show    = $settings['view_count_to_show'];
      $date_diff_to_show       = $settings['date_diff_to_show'];


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
      $control_id = 'tpbtn';

      /**
       * Setup the post arguments.
       */
      $query_args = MS_Helper::get_query_args('product', 'product_cat', $this->get_settings());

      // The Query
      $query = new \WP_Query($query_args);

      $filter_list = $settings['category'];


   ?>

      <?php if ($settings['ms_design_style']  == 'layout-2') : ?>


         <div class="row">
            <?php
            while ($query->have_posts()) :
               $query->the_post();
               global $product;
               global $post;
               global $woocommerce;

               $rating = wc_get_rating_html($product->get_average_rating());
               $review_count = $product->get_review_count();
               $rating_count = $product->get_rating_count();
               $terms = get_the_terms(get_the_ID(), 'product_cat');


               if (!is_null($product->get_date_on_sale_to())) {
                  $_sale_date_end = $product->get_date_on_sale_to()->date("M d Y h:m:i");
               }
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
                           <?php endforeach; ?>
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

      <?php elseif ($settings['ms_design_style']  == 'layout-3') :
         $this->add_render_attribute('title_args', 'class', 'section__title-4 ms-el-title');
      ?>

         <!-- product arrival area start -->
         <section class="ms-product-arrival-area pb-55">
            <div class="container">
               <div class="row align-items-end">
                  <div class="col-xl-5 col-sm-6">
                     <?php if (!empty($settings['ms_section_title'])) : ?>
                        <div class="ms-section-title-wrapper mb-40">
                           <h3 class="ms-section-title"><?php echo ms_kses($settings['ms_section_title']); ?> </h3>
                        </div>
                     <?php endif; ?>
                  </div>
                  <div class="col-xl-7 col-sm-6">
                     <div class="ms-product-arrival-more-wrapper d-flex justify-content-end">
                        <div class="ms-product-arrival-arrow ms-swiper-arrow mb-40 text-end ms-product-arrival-border">
                           <button type="button" class="ms-arrival-slider-button-prev">
                              <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M7 13L1 7L7 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                              </svg>
                           </button>
                           <button type="button" class="ms-arrival-slider-button-next">
                              <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M1 13L7 7L1 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                              </svg>
                           </button>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-xl-12">
                     <div class="ms-product-arrival-slider fix">
                        <div class="ms-product-arrival-active swiper-container">
                           <div class="swiper-wrapper">
                              <?php
                              while ($query->have_posts()) :
                                 $query->the_post();
                                 global $product;
                                 global $post;
                                 global $woocommerce;

                                 $rating = wc_get_rating_html($product->get_average_rating());
                                 $review_count = $product->get_review_count();
                                 $rating_count = $product->get_rating_count();
                                 $terms = get_the_terms(get_the_ID(), 'product_cat');


                                 if (!is_null($product->get_date_on_sale_to())) {
                                    $_sale_date_end = $product->get_date_on_sale_to()->date("M d Y h:m:i");
                                 }
                              ?>
                                 <div class="swiper-slide">
                                    <div class="ms-product-item transition-3 mb-25">
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
                                             <?php endforeach; ?>
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
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- product arrival area end -->

      <?php elseif ($settings['ms_design_style']  == 'layout-4') :
         $this->add_render_attribute('title_args', 'class', 'section__title-4 ms-el-title');
      ?>

         <div class="ms-product-sm-list mb-50">
            <?php if (!empty($settings['ms_section_title'])) : ?>
               <div class="ms-section-title-wrapper mb-40">
                  <h3 class="ms-section-title ms-section-title-sm"><?php echo ms_kses($settings['ms_section_title']); ?></h3>
               </div>
            <?php endif; ?>


            <div class="ms-product-sm-wrapper mr-20">
               <?php
               while ($query->have_posts()) :
                  $query->the_post();
                  global $product;
                  global $post;
                  global $woocommerce;

                  $rating = wc_get_rating_html($product->get_average_rating());
                  $review_count = $product->get_review_count();
                  $rating_count = $product->get_rating_count();
                  $terms = get_the_terms(get_the_ID(), 'product_cat');


                  if (!is_null($product->get_date_on_sale_to())) {
                     $_sale_date_end = $product->get_date_on_sale_to()->date("M d Y h:m:i");
                  }
               ?>
                  <div class="ms-product-sm-item d-flex align-items-center">

                     <?php if (has_post_thumbnail()) : ?>
                        <div class="ms-product-thumb mr-25 fix">
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
                        </div>
                     <?php endif; ?>

                     <div class="ms-product-sm-content">

                        <div class="ms-product-category">
                           <?php foreach ($terms as $key => $term) :
                              $count = count($terms) - 1;
                              $name = ($count > $key) ? $term->name . ', ' : $term->name
                           ?>
                              <?php if (!empty($term)) : ?>
                                 <a href="<?php echo get_term_link($term->slug, 'product_cat'); ?> "> <?php echo esc_html($name); ?></a>
                              <?php endif; ?>
                           <?php endforeach; ?>
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
               <?php endwhile;
               wp_reset_query(); ?>
            </div>
         </div>

      <?php elseif ($settings['ms_design_style']  == 'layout-5') :
         $this->add_render_attribute('title_args', 'class', 'section__title-4 ms-el-title');
      ?>

         <div class="ms-trending-wrapper">

            <?php if (!empty($settings['ms_section_title']) || !empty($settings['ms_section_subtitle'])) : ?>
               <div class="ms-section-title-wrapper-2 mb-50">
                  <?php if (!empty($settings['ms_section_subtitle'])) : ?>
                     <span class="ms-section-title-pre-2">
                        <?php echo ms_kses($settings['ms_section_subtitle']); ?>
                     </span>
                  <?php endif; ?>

                  <?php if (!empty($settings['ms_section_title'])) : ?>
                     <div class="ms-section-title-wrapper mb-40">
                        <h3 class="ms-section-title-2"><?php echo ms_kses($settings['ms_section_title']); ?></h3>
                     </div>
                  <?php endif; ?>
               </div>
            <?php endif; ?>

            <div class="ms-trending-slider">
               <div class="ms-trending-slider-active swiper-container">
                  <div class="swiper-wrapper">
                     <?php
                     while ($query->have_posts()) :
                        $query->the_post();
                        global $product;
                        global $post;
                        global $woocommerce;

                        $rating = wc_get_rating_html($product->get_average_rating());
                        $review_count = $product->get_review_count();
                        $rating_count = $product->get_rating_count();
                        $terms = get_the_terms(get_the_ID(), 'product_cat');


                        if (!is_null($product->get_date_on_sale_to())) {
                           $_sale_date_end = $product->get_date_on_sale_to()->date("M d Y h:m:i");
                        }
                     ?>
                        <div class="swiper-slide">
                           <div class="ms-trending-item">
                              <div class="ms-product-item-2">

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
                                       <div class="ms-product-badge-2 ">
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
                        </div>
                     <?php endwhile;
                     wp_reset_query(); ?>

                  </div>
               </div>
               <div class="ms-trending-slider-dot ms-swiper-dot text-center mt-45"></div>
            </div>
         </div>

      <?php elseif ($settings['ms_design_style']  == 'layout-6') :
         $this->add_render_attribute('title_args', 'class', 'section__title-4 ms-el-title');

         $this->ms_link_controls_render('tpbtn', 'ms-btn ms-btn-border ms-btn-border-sm', $this->get_settings());
      ?>

         <!-- best seller area start -->
         <section class="ms-seller-area pb-140">
            <div class="container">
               <?php if (!empty($settings['ms_section_title']) || !empty($settings['ms_section_subtitle'])) : ?>
                  <div class="row">
                     <div class="col-xl-12">
                        <div class="ms-section-title-wrapper-2 mb-50">
                           <?php if (!empty($settings['ms_section_subtitle'])) : ?>
                              <span class="ms-section-title-pre-2">
                                 <?php echo ms_kses($settings['ms_section_subtitle']); ?>
                              </span>
                           <?php endif; ?>

                           <?php if (!empty($settings['ms_section_title'])) : ?>
                              <h3 class="ms-section-title-2"><?php echo ms_kses($settings['ms_section_title']); ?></h3>
                           <?php endif; ?>
                        </div>
                     </div>
                  </div>
               <?php endif; ?>

               <div class="row">

                  <?php
                  while ($query->have_posts()) :
                     $query->the_post();
                     global $product;
                     global $post;
                     global $woocommerce;

                     $rating = wc_get_rating_html($product->get_average_rating());
                     $review_count = $product->get_review_count();
                     $rating_count = $product->get_rating_count();
                     $terms = get_the_terms(get_the_ID(), 'product_cat');


                     if (!is_null($product->get_date_on_sale_to())) {
                        $_sale_date_end = $product->get_date_on_sale_to()->date("M d Y h:m:i");
                     }
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
                                 <div class="ms-product-badge-2 ">
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
               <!-- button start -->
               <?php if (!empty($settings['ms_' . $control_id . '_text']) && $settings['ms_' . $control_id . '_button_show'] == 'yes') : ?>
                  <div class="row">
                     <div class="col-xl-12">
                        <div class="ms-seller-more text-center mt-10">
                           <a <?php echo $this->get_render_attribute_string('ms-button-arg'); ?>> <?php echo $settings['ms_' . $control_id . '_text']; ?> </a>
                        </div>
                     </div>
                  </div>
               <?php endif; ?>
               <!-- button end -->

            </div>
         </section>
         <!-- best seller area end -->

      <?php else :

         $this->ms_link_controls_render('tpbtn', 'ms-btn ms-btn-2 ms-btn-blue', $this->get_settings());
      ?>


         <!-- product offer area start -->
         <section class="ms-product-offer grey-bg-2 pt-70 pb-80">
            <div class="container">
               <div class="row align-items-end">
                  <div class="col-xl-4 col-md-5 col-sm-6">
                     <?php if (!empty($settings['ms_section_title'])) : ?>
                        <div class="ms-section-title-wrapper mb-40">
                           <h3 class="ms-section-title">
                              <?php echo ms_kses($settings['ms_section_title']); ?>
                           </h3>
                        </div>
                     <?php endif; ?>

                  </div>
                  <?php if (!empty($settings['ms_' . $control_id . '_text']) && $settings['ms_' . $control_id . '_button_show'] == 'yes') : ?>
                     <div class="col-xl-8 col-md-7 col-sm-6">
                        <div class="ms-product-offer-more-wrapper d-flex justify-content-sm-end p-relative z-index-1">
                           <div class="ms-product-offer-more mb-40 text-sm-end grey-bg-2">
                              <a <?php echo $this->get_render_attribute_string('ms-button-arg'); ?>> <?php echo $settings['ms_' . $control_id . '_text']; ?> </a>
                              <span class="ms-product-offer-more-border"></span>
                           </div>
                        </div>
                     </div>
                  <?php endif; ?>
               </div>
               <div class="row">
                  <div class="col-xl-12">
                     <div class="ms-product-offer-slider fix">


                        <div class="ms-product-offer-slider-active swiper-container">
                           <div class="swiper-wrapper">

                              <?php
                              while ($query->have_posts()) :
                                 $query->the_post();
                                 global $product;
                                 global $post;
                                 global $woocommerce;

                                 $rating = wc_get_rating_html($product->get_average_rating());
                                 $review_count = $product->get_review_count();
                                 $rating_count = $product->get_rating_count();
                                 $terms = get_the_terms(get_the_ID(), 'product_cat');


                                 if (!is_null($product->get_date_on_sale_to())) {
                                    $_sale_date_end = $product->get_date_on_sale_to()->date("M d Y h:m:i");
                                 }
                              ?>

                                 <div class="swiper-slide">
                                    <div class="ms-product-offer-item ms-product-item transition-3">
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

                                             <div class="ms-woo-action ms-woo-action-3">
                                                <div class="ms-product-add-cart-btn-large-3 is-primary ms-woo-add-cart-btn ms-woo-action-btn">
                                                   <?php woocommerce_template_loop_add_to_cart(); ?>
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
                                             <?php endforeach; ?>

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
                                          <?php endif; ?>


                                          <div class="ms-product-price-wrapper ms-woo-price ms-woo-price-2">
                                             <?php echo woocommerce_template_loop_price(); ?>
                                          </div>


                                          <?php if (!is_null($product->get_date_on_sale_to())) : ?>
                                             <div class="ms-product-countdown position-relative" data-countdown data-date="<?php echo esc_attr($_sale_date_end); ?>">
                                                <div class="ms-product-countdown-inner">
                                                   <ul>
                                                      <li><span data-days><?php echo esc_html__('0', 'shofy'); ?></span><?php echo esc_html__('DAYS', 'shofy'); ?></li>
                                                      <li><span data-hours><?php echo esc_html__('0', 'shofy'); ?></span><?php echo esc_html__('HRS', 'shofy'); ?></li>
                                                      <li><span data-minutes><?php echo esc_html__('0', 'shofy'); ?></span><?php echo esc_html__('MIN', 'shofy'); ?></li>
                                                      <li><span data-seconds><?php echo esc_html__('0', 'shofy'); ?></span><?php echo esc_html__('SEC', 'shofy'); ?></li>
                                                   </ul>
                                                </div>
                                             </div>
                                          <?php endif; ?>

                                       </div>

                                    </div>
                                 </div>
                              <?php endwhile;
                              wp_reset_query(); ?>

                           </div>

                           <div class="ms-deals-slider-dot ms-swiper-dot text-center mt-40"></div>

                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- product deal area end -->


      <?php endif; ?>

<?php
   }
}

$widgets_manager->register(new MS_Product_Post());
