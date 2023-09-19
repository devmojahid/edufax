<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Product_Post_2 extends Widget_Base {

    use \TPCore\Widgets\TPCoreElementFunctions;

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'tp-product-2';
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
	public function get_title() {
		return __( 'Product Post 2', 'tpcore' );
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
	public function get_icon() {
		return 'tp-icon';
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
	public function get_categories() {
		return [ 'tpcore' ];
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
	public function get_script_depends() {
		return [ 'tpcore' ];
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
    protected function register_controls(){
        $this->register_controls_section();
        $this->style_tab_content();
    }   

	protected function register_controls_section() {

        // layout Panel
        $this->start_controls_section(
            'tp_layout',
            [
                'label' => esc_html__('Product Layout', 'tpcore'),
            ]
        );
        $this->add_control(
            'tp_design_style',
            [
                'label' => esc_html__('Select Layout', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'tpcore'),
                    'layout-2' => esc_html__('Layout 2', 'tpcore'),
                    'layout-3' => esc_html__('Layout 3', 'tpcore'),
                    'layout-4' => esc_html__('Layout 4', 'tpcore'),
                    'layout-5' => esc_html__('Layout 5', 'tpcore'),
                    'layout-6' => esc_html__('Layout 6', 'tpcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

     $this->start_controls_section(
         'tp_section_sec',
         [
           'label' => esc_html__( 'Title', 'tpcore' ),
           'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
           
         ]
     );
     
     $this->add_control(
      'tp_section_subtitle',
         [
         'label'       => esc_html__( 'Title', 'tpcore' ),
         'type'        => \Elementor\Controls_Manager::TEXTAREA,
         'default'     => esc_html__( 'Your Sub Title', 'tpcore' ),
         'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
         'label_block' => true,
         ]
     );
     
     $this->add_control(
      'tp_section_title',
         [
         'label'       => esc_html__( 'Title', 'tpcore' ),
         'type'        => \Elementor\Controls_Manager::TEXTAREA,
         'default'     => esc_html__( 'Your Title', 'tpcore' ),
         'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
         'label_block' => true
         ]
     );
     
     $this->end_controls_section();


     $this->tp_product_badges();


      // Product Query
      $this->tp_query_controls('product', 'Product', '6', '10', 'product', 'product_cat');

      $this->start_controls_section(
        'tp_col_columns_section',
        [
            'label' => esc_html__('Product Column', 'tpcore'),
            'condition' => [
              'tp_design_style' => ['layout-1']
            ]
        ]
    );

    $this->add_control(
        'tp_col_for_desktop',
        [
            'label' => esc_html__( 'Columns for Desktop', 'tpcore' ),
            'description' => esc_html__( 'Screen width equal to or greater than 1200px', 'tpcore' ),
            'type' => Controls_Manager::SELECT,
            'options' => [
                12 => esc_html__( '1 Columns', 'tpcore' ),
                6 => esc_html__( '2 Columns', 'tpcore' ),
                4 => esc_html__( '3 Columns', 'tpcore' ),
                3 => esc_html__( '4 Columns', 'tpcore' ),
                5 => esc_html__( '5 Columns (For Carousel Item)', 'tpcore' ),
                2 => esc_html__( '6 Columns', 'tpcore' ),
                1 => esc_html__( '12 Columns', 'tpcore' ),
            ],
            'separator' => 'before',
            'default' => 4,
            'style_transfer' => true,
        ]
    );
    $this->add_control(
        'tp_col_for_laptop',
        [
            'label' => esc_html__( 'Columns for Large', 'tpcore' ),
            'description' => esc_html__( 'Screen width equal to or greater than 992px', 'tpcore' ),
            'type' => Controls_Manager::SELECT,
            'options' => [
                12 => esc_html__( '1 Columns', 'tpcore' ),
                6 => esc_html__( '2 Columns', 'tpcore' ),
                4 => esc_html__( '3 Columns', 'tpcore' ),
                3 => esc_html__( '4 Columns', 'tpcore' ),
                5 => esc_html__( '5 Columns (For Carousel Item)', 'tpcore' ),
                2 => esc_html__( '6 Columns', 'tpcore' ),
                1 => esc_html__( '12 Columns', 'tpcore' ),
            ],
            'separator' => 'before',
            'default' => 6,
            'style_transfer' => true,
        ]
    );
    $this->add_control(
        'tp_col_for_tablet',
        [
            'label' => esc_html__( 'Columns for Tablet', 'tpcore' ),
            'description' => esc_html__( 'Screen width equal to or greater than 768px', 'tpcore' ),
            'type' => Controls_Manager::SELECT,
            'options' => [
                12 => esc_html__( '1 Columns', 'tpcore' ),
                6 => esc_html__( '2 Columns', 'tpcore' ),
                4 => esc_html__( '3 Columns', 'tpcore' ),
                3 => esc_html__( '4 Columns', 'tpcore' ),
                5 => esc_html__( '5 Columns (For Carousel Item)', 'tpcore' ),
                2 => esc_html__( '6 Columns', 'tpcore' ),
                1 => esc_html__( '12 Columns', 'tpcore' ),
            ],
            'separator' => 'before',
            'default' => 6,
            'style_transfer' => true,
        ]
    );
    $this->add_control(
        'tp_col_for_mobile',
        [
            'label' => esc_html__( 'Columns for Mobile', 'tpcore' ),
            'description' => esc_html__( 'Screen width less than 767px', 'tpcore' ),
            'type' => Controls_Manager::SELECT,
            'options' => [
                12 => esc_html__( '1 Columns', 'tpcore' ),
                6 => esc_html__( '2 Columns', 'tpcore' ),
                4 => esc_html__( '3 Columns', 'tpcore' ),
                3 => esc_html__( '4 Columns', 'tpcore' ),
                5 => esc_html__( '5 Columns (For Carousel Item)', 'tpcore' ),
                2 => esc_html__( '6 Columns', 'tpcore' ),
                1 => esc_html__( '12 Columns', 'tpcore' ),
            ],
            'separator' => 'before',
            'default' => 12,
            'style_transfer' => true,
        ]
    );

    $this->end_controls_section();

      $this->tp_button_render_controls('tpbtn', 'Button', ['layout-1']);
	}

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('blog_section', 'Section - Style', '.tp-el-section');

        $this->tp_basic_style_controls('blog_box_title', 'Box - Title', '.tp-el-box-title');
    }


    protected function product_badge(){ 
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
			<?php if( $product->is_on_sale()) : ?>
			<li>
				<?php woocommerce_show_product_loop_sale_flash(); ?>
			</li>
			<?php endif; ?>

				
				<?php if($enable_trending_badge === "yes") : ?>

					<?php if($product_badge_type === "sales") : ?>
						<!-- it depends on sales -->
						<?php if($sale_count > $sale_count_to_show) : ?>
						<li>
							<span class="onsale on-trending"><?php echo esc_html__('Trending', 'shofy'); ?></span>
						</li>
						<!-- it depends on sales end -->
						<?php endif; ?>

					<?php elseif($product_badge_type === "rating") : ?>
						
						<!-- it depends on rating -->
						<?php if(floatval($product_rating_count) >= floatval($rating_count_to_show)) : ?>
						<li>
							<span class="onsale on-trending"><?php echo esc_html__('Trending', 'shofy'); ?></span>
						</li>
						<!-- it depends on rating end -->
						<?php endif; ?>

					<?php elseif($product_badge_type === "review") : ?>
						
						<!-- it depends on review -->
						<?php if($review_count >= $review_count_to_show) : ?>
						<li>
							<span class="onsale on-trending"><?php echo esc_html__('Trending', 'shofy'); ?></span>
						</li>
						<!-- it depends on review end -->
						<?php endif; ?>

					<?php elseif($product_badge_type === "views") : ?>
						
						<!-- it depends on views -->
						<?php if($view_count >= $view_count_to_show) : ?>
						<li>
							<span class="onsale on-trending"><?php echo esc_html__('Trending', 'shofy'); ?></span>
						</li>
						<!-- it depends on views end -->
						<?php endif; ?>

					<?php endif; ?>
				<?php endif; ?>

				
			


      <?php if($enable_hot_badge == 'yes') : ?>
				<?php if($date_diff <= $date_diff_to_show) : ?>
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
	protected function render() {
		$settings = $this->get_settings_for_display();
      $control_id = 'tpbtn';

        /**
         * Setup the post arguments.
        */
        $query_args = TP_Helper::get_query_args('product', 'product_cat', $this->get_settings());

        // The Query
        $query = new \WP_Query($query_args);

        $filter_list = $settings['category'];


        ?>

        <?php if ( $settings['tp_design_style']  == 'layout-2' ): ?>


         <div class="tp-special-wrapper grey-bg-9 pt-85 pb-35">
            <?php if(!empty($settings['tp_section_title']) || !empty($settings['tp_section_subtitle'])) : ?>
            <div class="tp-section-title-wrapper-3 mb-40 text-center">

               <?php if(!empty($settings['tp_section_subtitle'])) : ?>
               <span class="tp-section-title-pre-3"><?php echo tp_kses($settings['tp_section_subtitle']); ?></span>
               <?php endif; ?>
                                       
               <?php if(!empty($settings['tp_section_title'])) : ?>
               <h3 class="tp-section-title-3"><?php echo tp_kses($settings['tp_section_title']); ?></h3>
               <?php endif; ?>

            </div>
            <?php endif; ?>

            <div class="tp-special-slider ">
               <div class="row gx-0 justify-content-center">
                  <div class="col-xl-5 col-lg-7 col-md-9 col-sm-7">
                     <div class="tp-special-slider-inner p-relative  ">

                        <div class="tp-special-slider-active swiper-container">
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


                                    if(!is_null($product->get_date_on_sale_to())){
                                       $_sale_date_end = $product->get_date_on_sale_to()->date("M d Y h:m:i");
                                    }

                                    $has_rating = $rating_count > 0 ? 'has-rating' : '';
                                 ?>
                                 <div class="swiper-slide grey-bg-9">
                                    <div class="tp-special-item ">
                                       <div class="tp-product-item-3 mb-50 text-center">
                                          <?php if( has_post_thumbnail() ) : ?>
                                             <div class="tp-product-thumb-3 mb-15 fix p-relative z-index-1">
      
                                                   <a href="<?php the_permalink(); ?>">
                                                      <?php 
                                                         $get_img_from_meta = function_exists( 'tpmeta_image_field' ) ? tpmeta_image_field( 'shofy_get_img_thumbnail' ) : NULL;
                                                         if(!empty($get_img_from_meta)): ?>
                                                         <img src="<?php echo esc_url($get_img_from_meta['url']) ?>" alt="<?php echo esc_attr($get_img_from_meta['alt']); ?>">
                                                         <?php else: 
                                                            the_post_thumbnail();
                                                         endif; 
                                                      ?>
                                                   </a>
      
                                                   <!-- product badge -->
                                                   <div class="tp-product-badge-2 ">
                                                      <?php echo $this->product_badge(); ?>                 
                                                   </div>
      
                                                   <!-- product action -->
                                                   <div class="tp-product-action-3 tp-product-action-blackStyle tp-woo-action tp-woo-action-2 tp-woo-action-3 tp-woo-tooltip-left">
                                                      <div class="tp-product-action-item-3 d-flex flex-column">
      
      
                                                         <!-- quick view button -->
                                                         <?php if( class_exists( 'WPCleverWoosq' )) : ?>
                                                         <div class="tp-product-action-btn-3 tp-woo-quick-view-btn tp-woo-action-btn">
                                                               <?php echo do_shortcode('[woosq]'); ?> 
                                                         </div>
                                                         <?php endif; ?>
      
                                                         
                                                         <?php if( function_exists( 'woosw_init' )) : ?>
                                                         <!-- wishlist button -->
                                                         <div class="tp-product-action-btn-3 tp-woo-add-to-wishlist-btn tp-woo-action-btn">
                                                               <?php echo do_shortcode('[woosw]'); ?>
                                                         </div>
                                                         <?php endif; ?>
      
      
                                                         <?php if( function_exists( 'woosc_init' )) : ?>
                                                         <!-- compare button -->
                                                         <div class="tp-product-action-btn-3 tp-woo-add-to-compare-btn tp-woo-action-btn">
                                                               <?php echo do_shortcode('[woosc]');?> 
                                                               <span class="tp-product-tooltip tp-woo-tooltip"> <?php echo esc_html__('Add To Compare', 'shofy'); ?></span>                                      
                                                         </div>
                                                         <?php endif; ?>
      
                                                      </div>
                                                   </div>
      
                                                   <div class="tp-woo-action tp-woo-action-3">
                                                      <div class="tp-product-add-cart-btn-large-3 tp-woo-add-cart-btn tp-woo-action-btn">
                                                         <?php woocommerce_template_loop_add_to_cart();?>                                      
                                                      </div>
                                                   </div>
                                             </div>
                                             <?php endif; ?>
      
                                             <div class="tp-product-content-3">
                                                   <div class="tp-product-tag-3">
                                                      <?php foreach ($terms as $key => $term) : 
                                                         $count = count($terms) - 1;
      
                                                         $name = ($count > $key) ? $term->name . ', ' : $term->name
                                                         ?>
                                                         <?php if(!empty($term)): ?>
                                                            <a href="<?php echo get_term_link($term->slug, 'product_cat'); ?> "> <?php echo esc_html($name ); ?></a>
                                                         <?php endif; ?>
                                                      <?php endforeach; ?>
                                                   </div>
      
                                                   <h3 class="tp-product-title-3 <?php echo esc_attr($has_rating); ?>">
                                                      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                   </h3>
      
                                                   <?php if ( $rating_count > 0 ) : ?>
                                                   <div class="tp-product-rating tp-product-rating-3 d-flex align-items-center justify-content-center <?php echo esc_attr($has_rating); ?>">
                                                      <div class="tp-product-rating-icon">
                                                         <?php echo shofy_kses($rating); ?> 
                                                      </div>
                                                      <div class="tp-product-rating-text">
                                                         <?php if ( comments_open() ) : ?>
                                                               <?php //phpcs:disable ?>
                                                                  <a href="#reviews" class="woocommerce-review-link" rel="nofollow"><?php printf( _n( '( %s Review )', '( %s Reviews )', $review_count, 'shofy' ), '<span class="count">' . esc_html( $review_count ) . '</span>' ); ?></a>
                                                               <?php // phpcs:enable ?>
                                                         <?php endif; ?>
                                                      </div>
                                                   </div>
                                                   <?php endif; ?>
      
                                                   <div class="tp-product-price-wrapper-3 tp-woo-price">
                                                      <?php echo woocommerce_template_loop_price();?>
                                                   </div>
                                             </div>
                                          </div>
                                    </div>
                                 </div>
                              <?php endwhile; wp_reset_query(); ?>
                           </div>
                        </div>

                        <!-- dot style -->
                        <div class="tp-swiper-dot tp-special-slider-dot d-sm-none text-center "></div>

                        <div class="tp-special-arrow d-none d-sm-block">
                           <button class="tp-special-slider-button-prev">
                              <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M7 1L1 7L7 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                              </svg>
                           </button>

                           <button class="tp-special-slider-button-next">
                              <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M1 1L7 7L1 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                              </svg>
                           </button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>

         <?php elseif ( $settings['tp_design_style']  == 'layout-3' ): ?>

         <!-- category area start -->
         <section class="tp-category-area pt-115 pb-105 tp-category-plr-85 grey-bg-6">
            <div class="container-fluid">
            <?php if(!empty($settings['tp_section_title']) || !empty($settings['tp_section_subtitle'])) : ?>
               <div class="row">
                  <div class="col-xl-12">
                     <div class="tp-section-title-wrapper-4 mb-60 text-center">

                        <?php if(!empty($settings['tp_section_subtitle'])) : ?>
                        <span class="tp-section-title-pre-4"><?php echo tp_kses($settings['tp_section_subtitle']); ?></span>
                        <?php endif; ?>
                                                
                        <?php if(!empty($settings['tp_section_title'])) : ?>
                        <h3 class="tp-section-title-4"><?php echo tp_kses($settings['tp_section_title']); ?></h3>
                        <?php endif; ?>
                     </div>
                  </div>
               </div>
               <?php endif; ?>
               <div class="row">
                  <div class="col-xl-12">
                     <div class="tp-category-slider-4">
                        <div class="tp-category-slider-active-4 swiper-container mb-70">
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


                                    if(!is_null($product->get_date_on_sale_to())){
                                       $_sale_date_end = $product->get_date_on_sale_to()->date("M d Y h:m:i");
                                    }

                                    $has_rating = $rating_count > 0 ? 'has-rating' : '';
                                 ?>
                                 <div class="swiper-slide">
                                    <div class="tp-category-item-4 p-relative z-index-1 fix text-center mb-40 white-bg">
  
                                         <?php if( has_post_thumbnail() ) : ?>
                                          <?php 
                                             $get_img_from_meta = function_exists( 'tpmeta_image_field' ) ? tpmeta_image_field( 'shofy_get_img_thumbnail' ) : NULL;
                                             if(!empty($get_img_from_meta)): ?>
                                             <div class="tp-category-thumb-4 include-bg white-bg" data-background="<?php echo esc_url($get_img_from_meta['url']); ?>" ></div>
                                             
                                             <?php else: ?>
                                                <div class="tp-category-thumb-4 include-bg white-bg" data-background="<?php the_post_thumbnail_url(); ?>" ></div>
                                            <?php endif; 
                                          ?>
                                         <?php endif; ?>
  
  
                                         <!-- product badge -->
                                         <div class="tp-product-badge-2 ">
                                            <?php echo $this->product_badge(); ?>                 
                                         </div>
  
                                         <!-- product action -->
                                         <div class="tp-product-action-3 tp-product-action-4 tp-product-action-blackStyle tp-product-action-brownStyle tp-woo-action tp-woo-action-4 tp-woo-action-5">
                                            <div class="tp-product-action-item-3 d-flex flex-column">
  
                                               <!-- quick view button -->
                                               <?php if( class_exists( 'WPCleverWoosq' )) : ?>
                                               <div class="tp-product-action-btn-3 tp-woo-quick-view-btn tp-woo-action-btn">
                                                     <?php echo do_shortcode('[woosq]'); ?> 
                                               </div>
                                               <?php endif; ?>
  
                                               
                                               <?php if( function_exists( 'woosw_init' )) : ?>
                                               <!-- wishlist button -->
                                               <div class="tp-product-action-btn-3 tp-woo-add-to-wishlist-btn tp-woo-action-btn">
                                                     <?php echo do_shortcode('[woosw]'); ?>
                                               </div>
                                               <?php endif; ?>
  
  
                                               <?php if( function_exists( 'woosc_init' )) : ?>
                                               <!-- compare button -->
                                               <div class="tp-product-action-btn-3 tp-woo-add-to-compare-btn tp-woo-action-btn">
                                                     <?php echo do_shortcode('[woosc]');?> 
                                                     <span class="tp-product-tooltip tp-woo-tooltip"> <?php echo esc_html__('Add To Compare', 'shofy'); ?></span>                                      
                                               </div>
                                               <?php endif; ?>
  
                                            </div>
                                         </div>
                                         <div class="tp-category-content-4">
                                            <h3 class="tp-category-title-4">
                                               <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </h3>
                                            <div class="tp-category-price-wrapper-4 tp-woo-price tp-woo-price-4 tp-woo-price-5">
  
                                               <?php echo woocommerce_template_loop_price();?> 
  
                                               <div class="tp-category-add-to-cart ">
                                                     <div class="tp-category-add-to-cart-4 tp-woo-action tp-woo-action-4 tp-woo-action-5">
                                                        <div class="tp-woo-add-cart-btn tp-woo-action-btn">
                                                           <?php woocommerce_template_loop_add_to_cart();?> 
                                                        </div>
                                                     </div>
                                               </div>
                                            </div>
                                         </div>
  
                                      </div>
                                 </div>
                              <?php endwhile; wp_reset_query(); ?>
                           </div>
                        </div>
                        <div class="tp-category-swiper-scrollbar tp-swiper-scrollbar"></div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- category area end -->

         <?php elseif ( $settings['tp_design_style']  == 'layout-4' ): ?>
            <!-- best area start -->
            <section class="tp-best-area pt-115">
               <div class="container"> 
               <?php if(!empty($settings['tp_section_title']) || !empty($settings['tp_section_subtitle'])) : ?>
                  <div class="row">
                     <div class="col-xl-12">
                        <div class="tp-section-title-wrapper-4 mb-50 text-center">
   
                        <?php if(!empty($settings['tp_section_subtitle'])) : ?>
                           <span class="tp-section-title-pre-4"><?php echo tp_kses($settings['tp_section_subtitle']); ?></span>
                           <?php endif; ?>
                                                   
                           <?php if(!empty($settings['tp_section_title'])) : ?>
                           <h3 class="tp-section-title-4"><?php echo tp_kses($settings['tp_section_title']); ?></h3>
                           <?php endif; ?>
                  
                        </div>
                     </div>
                  </div>
                  <?php endif; ?>
                  <div class="row">
                     <div class="col-xl-12">
                        <div class="tp-best-slider">
                           <div class="tp-best-slider-active swiper-container mb-10">
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
   
   
                                       if(!is_null($product->get_date_on_sale_to())){
                                          $_sale_date_end = $product->get_date_on_sale_to()->date("M d Y h:m:i");
                                       }
   
                                       $has_rating = $rating_count > 0 ? 'has-rating' : '';
                                    ?>
                                 <div class="swiper-slide">
                                    <div class="tp-product-item-4 p-relative mb-40">
                                       <?php if( has_post_thumbnail() ) : ?>
                                          <div class="tp-product-thumb-4 w-img fix">
         
                                             <a href="<?php the_permalink(); ?>">
                                                <?php 
                                                   $get_img_from_meta = function_exists( 'tpmeta_image_field' ) ? tpmeta_image_field( 'shofy_get_img_thumbnail' ) : NULL;
                                                   if(!empty($get_img_from_meta)): ?>
                                                   <img src="<?php echo esc_url($get_img_from_meta['url']) ?>" alt="<?php echo esc_attr($get_img_from_meta['alt']); ?>">
                                                   <?php else: 
                                                      the_post_thumbnail();
                                                   endif; 
                                                ?>
                                             </a>
         
                                             <!-- product badge -->
                                             <div class="tp-product-badge-2 ">
                                                <?php echo $this->product_badge(); ?>                 
                                             </div>
         
                                             <!-- product action -->
                                             <div class="tp-product-action-3 tp-product-action-4 has-shadow tp-product-action-blackStyle tp-product-action-brownStyle tp-woo-action tp-woo-action-4 tp-woo-tooltip-left">
                                                <div class="tp-product-action-item-3 d-flex flex-column">
         
                                                   <!-- quick view button -->
                                                   <?php if( class_exists( 'WPCleverWoosq' )) : ?>
                                                   <div class="tp-product-action-btn-3 tp-woo-quick-view-btn tp-woo-action-btn">
                                                      <?php echo do_shortcode('[woosq]'); ?> 
                                                   </div>
                                                   <?php endif; ?>
         
                                                   
                                                   <?php if( function_exists( 'woosw_init' )) : ?>
                                                   <!-- wishlist button -->
                                                   <div class="tp-product-action-btn-3 tp-woo-add-to-wishlist-btn tp-woo-action-btn">
                                                      <?php echo do_shortcode('[woosw]'); ?>
                                                   </div>
                                                   <?php endif; ?>
         
         
                                                   <?php if( function_exists( 'woosc_init' )) : ?>
                                                   <!-- compare button -->
                                                   <div class="tp-product-action-btn-3 tp-woo-add-to-compare-btn tp-woo-action-btn">
                                                      <?php echo do_shortcode('[woosc]');?> 
                                                      <span class="tp-product-tooltip tp-woo-tooltip"> <?php echo esc_html__('Add To Compare', 'shofy'); ?></span>                                      
                                                   </div>
                                                   <?php endif; ?>
                                                
                                                </div>
                                             </div>
         
                                          </div>
                                          <?php endif; ?>
                                          <div class="tp-product-content-4">
                                             <h3 class="tp-product-title-4">
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                             </h3>
                                             <div class="tp-product-info-4">
                                                <?php foreach ($terms as $key => $term) : 
                                                   $count = count($terms) - 1;
         
                                                   $name = ($count > $key) ? $term->name . ', ' : $term->name
                                                   ?>
                                                   <?php if(!empty($term)): ?>
                                                      <a href="<?php echo get_term_link($term->slug, 'product_cat'); ?> "> <?php echo esc_html($name ); ?></a>
                                                   <?php endif; ?>
                                                <?php endforeach; ?>
                                             </div>
                                             <?php if ( $rating_count > 0 ) : ?>
                                             <div class="tp-product-rating tp-product-rating-3 d-flex align-items-center <?php echo esc_attr($has_rating); ?>">
                                                <div class="tp-product-rating-icon">
                                                   <?php echo shofy_kses($rating); ?> 
                                                </div>
                                                <div class="tp-product-rating-text">
                                                   <?php if ( comments_open() ) : ?>
                                                      <?php //phpcs:disable ?>
                                                         <a href="#reviews" class="woocommerce-review-link" rel="nofollow"><?php printf( _n( '( %s Review )', '( %s Reviews )', $review_count, 'shofy' ), '<span class="count">' . esc_html( $review_count ) . '</span>' ); ?></a>
                                                      <?php // phpcs:enable ?>
                                                   <?php endif; ?>
                                                </div>
                                             </div>
                                             <?php endif; ?>
                                             <div class="tp-product-price-inner-4">
                                                <div class="tp-product-price-wrapper-4 tp-woo-price tp-woo-price-4">
                                                   <?php echo woocommerce_template_loop_price();?> 
                                                </div>
         
                                                <div class="tp-product-price-add-to-cart tp-woo-action tp-woo-action-4">
                                                   <div class="tp-product-add-to-cart-4 tp-woo-add-cart-btn tp-woo-action-btn">
                                                      <?php woocommerce_template_loop_add_to_cart();?> 
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                    </div>
                                 </div>
                                 <?php endwhile; wp_reset_query(); ?>
                                 
                              </div>
                           </div>
                           <div class="tp-best-swiper-scrollbar tp-swiper-scrollbar"></div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            <!-- best area end -->

         <?php elseif ( $settings['tp_design_style']  == 'layout-5' ): ?>

            <div class="tp-product-sm-wrapper-5 mb-60">

               <?php if(!empty($settings['tp_section_title']) || !empty($settings['tp_section_subtitle'])) : ?>
                  <?php if(!empty($settings['tp_section_subtitle'])) : ?>
                  <span class="tp-section-title-pre-5"><?php echo tp_kses($settings['tp_section_subtitle']); ?></span>
                  <?php endif; ?>
                                          
                  <?php if(!empty($settings['tp_section_title'])) : ?>
                  <h3 class="tp-product-sm-section-title"><?php echo tp_kses($settings['tp_section_title']); ?></h3>
                  <?php endif; ?>
               <?php endif; ?>

               <div class="tp-product-sm-item-wrapper-5">

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


                     if(!is_null($product->get_date_on_sale_to())){
                        $_sale_date_end = $product->get_date_on_sale_to()->date("M d Y h:m:i");
                     }

                     $has_rating = $rating_count > 0 ? 'has-rating' : '';
                  ?>
                  <div class="tp-product-sm-item-5 d-flex align-items-center">

                     <?php if( has_post_thumbnail() ) : ?>
                     <div class="tp-product-sm-thumb-5 fix">
                        <a href="<?php the_permalink(); ?>">
                           <?php 
                              $get_img_from_meta = function_exists( 'tpmeta_image_field' ) ? tpmeta_image_field( 'shofy_get_img_thumbnail' ) : NULL;
                              if(!empty($get_img_from_meta)): ?>
                              <img src="<?php echo esc_url($get_img_from_meta['url']) ?>" alt="<?php echo esc_attr($get_img_from_meta['alt']); ?>">
                              <?php else: 
                                 the_post_thumbnail();
                              endif; 
                           ?>   
                        </a>
                     </div>
                     <?php endif; ?>

                     <div class="tp-product-sm-content-5">
                        <div class="tp-product-sm-tag-5">
                           <?php foreach ($terms as $key => $term) : 
                              $count = count($terms) - 1;

                              $name = ($count > $key) ? $term->name . ', ' : $term->name
                              ?>
                              <span>
                              <?php if(!empty($term)): ?>
													<a href="<?php echo get_term_link($term->slug, 'product_cat'); ?> "> <?php echo esc_html($name ); ?></a>
												<?php endif; ?>
                              </span>
                           <?php endforeach; ?>
                        </div>
                        <h4 class="tp-product-sm-title-5">
                           <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h4>

                        <?php if ( $rating_count > 0 ) : ?>
                        <div class="tp-product-sm-rating-5">
                           <?php echo shofy_kses($rating); ?>
                        </div>
                        <?php endif; ?>

                        <div class="tp-product-sm-price-wrapper-5 tp-woo-price">
                           <?php echo woocommerce_template_loop_price();?> 
                        </div>
                     </div>
                  </div>
                  <?php endwhile; wp_reset_query(); ?>
               </div>
            </div>

         <?php elseif ( $settings['tp_design_style']  == 'layout-6' ): ?>
            <div class="tp-best-slider-wrapper-5">

               <?php if(!empty($settings['tp_section_title']) || !empty($settings['tp_section_subtitle'])) : ?>
               <div class="tp-section-title-wrapper-5 mb-35">
                  <?php if(!empty($settings['tp_section_subtitle'])) : ?>
                  <span class="tp-section-title-pre-5 has-mb-0"><?php echo tp_kses($settings['tp_section_subtitle']); ?></span>
                  <?php endif; ?>


                  <?php if(!empty($settings['tp_section_title'])) : ?>
                  <h3 class="tp-section-title-5"><?php echo tp_kses($settings['tp_section_title']); ?></h3>
                  <?php endif; ?>
               </div>
               <?php endif; ?>
                             
               <div class="tp-best-slider-5 p-relative">
                  <div class="tp-best-slider-active-5 swiper-container">

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


                              if(!is_null($product->get_date_on_sale_to())){
                                 $_sale_date_end = $product->get_date_on_sale_to()->date("M d Y h:m:i");
                              }

                              $has_rating = $rating_count > 0 ? 'has-rating' : '';
                           ?>
                        <div class="swiper-slide">
                           <div class="tp-product-item-5 p-relative white-bg mb-40">
										<?php if( has_post_thumbnail() ) : ?>
										<div class="tp-product-thumb-5 w-img fix mb-15">
											<a href="<?php the_permalink(); ?>">
                                    <?php 
                                       $get_img_from_meta = function_exists( 'tpmeta_image_field' ) ? tpmeta_image_field( 'shofy_get_img_thumbnail' ) : NULL;
                                       if(!empty($get_img_from_meta)): ?>
                                       <img src="<?php echo esc_url($get_img_from_meta['url']) ?>" alt="<?php echo esc_attr($get_img_from_meta['alt']); ?>">
                                       <?php else: 
                                          the_post_thumbnail();
                                       endif; 
                                    ?>
											</a>

											<div class="tp-product-badge-2 tp-product-badge-5 d-flex">
												<?php echo $this->product_badge(); ?>
											</div>

											<!-- product action -->
											<div class="tp-product-action-2 tp-product-action-5 tp-product-action-greenStyle tp-woo-action tp-woo-action-6 tp-woo-tooltip-right">
												<div class="tp-product-action-item-2 d-flex flex-column">

														<div class="tp-product-action-btn-2 tp-woo-add-cart-btn tp-woo-action-btn">
															<?php  woocommerce_template_loop_add_to_cart();?>
														</div>
														<!-- quick view button -->
														<?php if( class_exists( 'WPCleverWoosq' )) : ?>
														<div class="tp-product-action-btn-2 tp-woo-quick-view-btn tp-woo-action-btn">
															<?php echo do_shortcode('[woosq]'); ?> 
														</div>
														<?php endif; ?>

														
														<?php if( function_exists( 'woosw_init' )) : ?>
														<!-- wishlist button -->
														<div class="tp-product-action-btn-2 tp-woo-add-to-wishlist-btn tp-woo-action-btn">
															<?php echo do_shortcode('[woosw]'); ?>
														</div>
														<?php endif; ?>


														<?php if( function_exists( 'woosc_init' )) : ?>
														<!-- compare button -->
														<div class="tp-product-action-btn-2 tp-woo-add-to-compare-btn tp-woo-action-btn">
															<?php echo do_shortcode('[woosc]');?> 
															<span class="tp-product-tooltip tp-product-tooltip-right tp-woo-tooltip"> <?php echo esc_html__('Add To Compare', 'shofy'); ?></span>                                      
														</div>
														<?php endif; ?>

												</div>
											</div>
										</div>
										<?php endif; ?>

										<div class="tp-product-content-5">
											<div class="tp-product-tag-5">
												<?php foreach ($terms as $key => $term) : 
													$count = count($terms) - 1;

													$name = ($count > $key) ? $term->name . ', ' : $term->name
													?>
													<?php if(!empty($term)): ?>
													<a href="<?php echo get_term_link($term->slug, 'product_cat'); ?> "> <?php echo esc_html($name ); ?></a>
												<?php endif; ?>
												<?php endforeach; ?>
											</div>

											<h3 class="tp-product-title-5">
												<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
											</h3>

											<?php if ( $rating_count > 0 ) : ?>
											<div class="tp-product-rating-5">
												<?php echo shofy_kses($rating); ?> 
											</div>
											<?php endif; ?>
															

											<div class="tp-product-price-wrapper-5 tp-woo-price tp-woo-price-6">
												<?php echo woocommerce_template_loop_price();?> 
											</div>
										</div>

									</div>
                        </div>
                        <?php endwhile; wp_reset_query(); ?>
                     </div>
                  </div>

                  <div class="tp-best-slider-arrow-5 d-none d-sm-block">
                     <button type="submit" class="tp-best-slider-5-button-prev">
                        <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <path d="M7 13L1 7L7 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                     </button>
                     <button type="button" class="tp-best-slider-5-button-next">
                        <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <path d="M1 13L7 7L1 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                     </button>
                  </div>

               </div>

               <div class="tp-best-slider-dot-5 tp-swiper-dot mt-15 text-center d-sm-none"></div>
            </div>

        <?php else: 
            $this->tp_link_controls_render('tpbtn', 'tp-btn', $this->get_settings());
        ?>


         <!-- product area start -->
         <section class="tp-product-area grey-bg-8 pt-95 pb-80">
            <div class="container">
               <div class="row align-items-end">
               <?php if(!empty($settings['tp_section_title']) || !empty($settings['tp_section_subtitle'])) : ?>
                  <div class="col-lg-6 col-md-8">
                     <div class="tp-section-title-wrapper-3 mb-55">
                        <?php if(!empty($settings['tp_section_subtitle'])) : ?>
                        <span class="tp-section-title-pre-3"><?php echo tp_kses($settings['tp_section_subtitle']); ?></span>
                        <?php endif; ?>

                        <?php if(!empty($settings['tp_section_title'])) : ?>
                        <h3 class="tp-section-title-3"><?php echo tp_kses($settings['tp_section_title']); ?></h3>
                        <?php endif; ?>
                     </div>
                  </div>
                  <?php endif; ?>

                  <?php if (!empty($settings['tp_' . $control_id .'_text']) && $settings['tp_' . $control_id .'_button_show'] == 'yes') : ?>
                  <div class="col-lg-6 col-md-4">
                     <div class="tp-product-more-3 text-md-end mb-65">
                        <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>>
                            <?php echo $settings['tp_' . $control_id .'_text']; ?>
                           <svg width="12" height="10" viewBox="0 0 12 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M10.9994 4.99981L1.04004 4.99981" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M6.98291 1L10.9998 4.99967L6.98291 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                           </svg>
                        </a>
                     </div>
                  </div>
                  <?php endif; ?>
                                    
               </div>
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


                     if(!is_null($product->get_date_on_sale_to())){
                        $_sale_date_end = $product->get_date_on_sale_to()->date("M d Y h:m:i");
                     }
                     $has_rating = $rating_count > 0 ? 'has-rating' : '';

                  ?>
                  <div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']); ?> col-<?php echo esc_attr($settings['tp_col_for_mobile']); ?>">
                     <div class="tp-product-item-3 mb-50">
                        <?php if( has_post_thumbnail() ) : ?>
                           <div class="tp-product-thumb-3 mb-15 fix p-relative z-index-1">

                                 <a href="<?php the_permalink(); ?>">
                                 <?php 
												$get_img_from_meta = function_exists( 'tpmeta_image_field' ) ? tpmeta_image_field( 'shofy_get_img_thumbnail' ) : NULL;
                                       if(!empty($get_img_from_meta)): ?>
                                       <img src="<?php echo esc_url($get_img_from_meta['url']) ?>" alt="<?php echo esc_attr($get_img_from_meta['alt']); ?>">
                                       <?php else: 
                                          the_post_thumbnail();
                                       endif; 
                                    ?>
                                 </a>

                              
                                    <!-- product badge -->
                                    <div class="tp-product-badge-2 ">
                                       <?php echo $this->product_badge(); ?>                 
                                    </div>
                              
                                       
                              

                                 <!-- product action -->
                                 <div class="tp-product-action-3 tp-product-action-blackStyle tp-woo-action tp-woo-action-2 tp-woo-action-3 tp-woo-tooltip-left">
                                    <div class="tp-product-action-item-3 d-flex flex-column">


                                       <!-- quick view button -->
                                       <?php if( class_exists( 'WPCleverWoosq' )) : ?>
                                       <div class="tp-product-action-btn-3 tp-woo-quick-view-btn tp-woo-action-btn">
                                             <?php echo do_shortcode('[woosq]'); ?> 
                                       </div>
                                       <?php endif; ?>

                                       
                                       <?php if( function_exists( 'woosw_init' )) : ?>
                                       <!-- wishlist button -->
                                       <div class="tp-product-action-btn-3 tp-woo-add-to-wishlist-btn tp-woo-action-btn">
                                             <?php echo do_shortcode('[woosw]'); ?>
                                       </div>
                                       <?php endif; ?>


                                       <?php if( function_exists( 'woosc_init' )) : ?>
                                       <!-- compare button -->
                                       <div class="tp-product-action-btn-3 tp-woo-add-to-compare-btn tp-woo-action-btn">
                                             <?php echo do_shortcode('[woosc]');?> 
                                             <span class="tp-product-tooltip tp-woo-tooltip"> <?php echo esc_html__('Add To Compare', 'shofy'); ?></span>                                      
                                       </div>
                                       <?php endif; ?>

                                    </div>
                                 </div>

                                 <div class="tp-woo-action tp-woo-action-3">
                                    <div class="tp-product-add-cart-btn-large-3 tp-woo-add-cart-btn tp-woo-action-btn">
                                       <?php woocommerce_template_loop_add_to_cart();?>                                      
                                    </div>
                                 </div>
                           </div>
                           <?php endif; ?>

                           <div class="tp-product-content-3">
                                 <div class="tp-product-tag-3">
                                    <?php foreach ($terms as $key => $term) : 
                                       $count = count($terms) - 1;

                                       $name = ($count > $key) ? $term->name . ', ' : $term->name
                                       ?>
                                       <?php if(!empty($term)): ?>
                                          <a href="<?php echo get_term_link($term->slug, 'product_cat'); ?> "> <?php echo esc_html($name ); ?></a>
                                       <?php endif; ?>
                                    <?php endforeach; ?>
                                 </div>

                                 <h3 class="tp-product-title-3 <?php echo esc_attr($has_rating); ?>">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                 </h3>

                                 <?php if ( $rating_count > 0 ) : ?>
                                 <div class="tp-product-rating tp-product-rating-3 d-flex align-items-center <?php echo esc_attr($has_rating); ?>">
                                    <div class="tp-product-rating-icon">
                                       <?php echo shofy_kses($rating); ?> 
                                    </div>
                                    <div class="tp-product-rating-text">
                                       <?php if ( comments_open() ) : ?>
                                             <?php //phpcs:disable ?>
                                                <a href="#reviews" class="woocommerce-review-link" rel="nofollow"><?php printf( _n( '( %s Review )', '( %s Reviews )', $review_count, 'shofy' ), '<span class="count">' . esc_html( $review_count ) . '</span>' ); ?></a>
                                             <?php // phpcs:enable ?>
                                       <?php endif; ?>
                                    </div>
                                 </div>
                                 <?php endif; ?>

                                 <div class="tp-product-price-wrapper-3 tp-woo-price">
                                    <?php echo woocommerce_template_loop_price();?>
                                 </div>
                           </div>
                        </div>
                  </div>
                  <?php endwhile; wp_reset_query(); ?>
               </div>
            </div>
         </section>
         <!-- product area end -->
         

    	<?php endif; ?>

       <?php
	}

}

$widgets_manager->register( new TP_Product_Post_2() );