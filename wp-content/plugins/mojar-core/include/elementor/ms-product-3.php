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
class MS_Product_Post_3 extends Widget_Base
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
        return 'ms-product-3';
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
        return __('Product Post 3', 'mscore');
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
                'label' => esc_html__('Product Layout', 'mscore'),
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
                'condition' => [
                    'ms_design_style' => ['layout-1', 'layout-2']
                ]
            ]
        );

        $this->add_control(
            'ms_section_subtitle',
            [
                'label'       => esc_html__('Title', 'mscore'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => esc_html__('Your Sub Title', 'mscore'),
                'placeholder' => esc_html__('Your Text', 'mscore'),
                'label_block' => true,
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

        $this->start_controls_section(
            'ms_col_columns_section',
            [
                'label' => esc_html__('Product Column', 'mscore'),
                'condition' => [
                    'ms_design_style' => ['layout-1']
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

        $enable_trending_badge     = $settings['product_trending_badge_enable'];
        $enable_hot_badge         = $settings['product_hot_badge_enable'];

        $product_badge_type     = $settings['product_badge_type'];


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


        $sale_count_to_show     = $settings['sale_count_to_show'];
        $rating_count_to_show     = $settings['rating_count_to_show'];
        $review_count_to_show     = $settings['review_count_to_show'];
        $view_count_to_show     = $settings['view_count_to_show'];
        $date_diff_to_show         = $settings['date_diff_to_show'];


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

        <?php if ($settings['ms_design_style']  == 'layout-2') : ?>
            <!-- product slider area start -->
            <section class="ms-featured-slider-area grey-bg-6 fix pt-95 pb-120">
                <div class="container">
                    <?php if (!empty($settings['ms_section_title']) || !empty($settings['ms_section_subtitle'])) : ?>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="ms-section-title-wrapper-2 mb-50">

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
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="ms-featured-slider">
                                <div class="ms-featured-slider-active swiper-container">
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
                                            $has_rating = $rating_count > 0 ? 'has-rating' : '';

                                        ?>
                                            <div class="swiper-slide">
                                                <div class="ms-featured-item white-bg p-relative z-index-1">
                                                    <?php if (has_post_thumbnail()) : ?>

                                                        <?php
                                                        $get_img_from_meta = function_exists('tpmeta_image_field') ? tpmeta_image_field('shofy_get_img_thumbnail') : NULL;
                                                        if (!empty($get_img_from_meta)) : ?>
                                                            <div class="ms-featured-thumb include-bg" data-background="<?php echo esc_url($get_img_from_meta['url']); ?>"></div>
                                                        <?php else : ?>
                                                            <div class="ms-featured-thumb include-bg" data-background="<?php echo esc_url(get_the_post_thumbnail_url()); ?>"></div>
                                                        <?php endif; ?>
                                                    <?php endif; ?>

                                                    <div class="ms-featured-content">
                                                        <h3 class="ms-featured-title">
                                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                        </h3>
                                                        <div class="ms-featured-price-wrapper ms-woo-price <?php echo esc_attr($has_rating); ?>">
                                                            <?php echo woocommerce_template_loop_price(); ?>
                                                        </div>

                                                        <?php if ($rating_count > 0) : ?>
                                                            <div class="ms-product-rating-icon ms-product-rating-icon-2">
                                                                <?php echo ms_kses($rating); ?>
                                                            </div>
                                                        <?php endif; ?>

                                                        <div class="ms-featured-btn">
                                                            <a href="<?php the_permalink(); ?>" class="ms-btn ms-btn-border ms-btn-border-sm">
                                                                <?php echo esc_html__('Shop Now', 'mscore') ?>
                                                                <svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M16 7.49988L1 7.49988" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path d="M9.9502 1.47554L16.0002 7.49954L9.9502 13.5245" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                            </a>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        <?php endwhile;
                                        wp_reset_query(); ?>
                                    </div>
                                </div>
                                <div class="ms-featured-slider-arrow mt-45">
                                    <button class="ms-featured-slider-button-prev">
                                        <svg width="33" height="16" viewBox="0 0 33 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.97974 7.97534L31.9797 7.97534" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M8.02954 0.999999L0.999912 7.99942L8.02954 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                    <button class="ms-featured-slider-button-next">
                                        <svg width="33" height="16" viewBox="0 0 33 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M30.9795 7.97534L0.979492 7.97534" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M24.9297 0.999999L31.9593 7.99942L24.9297 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- product slider area end -->


        <?php else :
        ?>

            <!-- category area start -->
            <section class="ms-category-area pb-95 pt-95">
                <div class="container">

                    <?php if (!empty($settings['ms_section_title']) || !empty($settings['ms_section_subtitle'])) : ?>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="ms-section-title-wrapper-2 text-center mb-50">

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

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="ms-category-slider-2">
                                <div class="ms-category-slider-active-2 swiper-container mb-50">
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
                                            $has_rating = $rating_count > 0 ? 'has-rating' : '';

                                        ?>
                                            <div class="swiper-slide">
                                                <div class="ms-category-item-2 p-relative z-index-1 text-center ">
                                                    <?php if (has_post_thumbnail()) : ?>
                                                        <div class="ms-category-thumb-2">
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


                                                    <div class="ms-category-content-2">
                                                        <div class="ms-category-price-2">
                                                            <?php echo woocommerce_template_loop_price(); ?>
                                                        </div>

                                                        <h3 class="ms-category-title-2">
                                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                        </h3>

                                                        <div class="ms-category-btn-2">
                                                            <?php woocommerce_template_loop_add_to_cart(); ?>

                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        <?php endwhile;
                                        wp_reset_query(); ?>
                                    </div>
                                </div>
                                <div class="swiper-scrollbar ms-swiper-scrollbar ms-swiper-scrollbar-drag"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- category area end -->


        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new MS_Product_Post_3());
