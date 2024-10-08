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
class MS_Menu_Product extends Widget_Base
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
        return 'ms-menu-product';
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
        return __('Menu Product', 'mscore');
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
                    'ms_design_style' => ['layout-1']
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



        // Product Query
        $this->ms_query_controls('product', 'Product', '6', '10', 'product', 'product_cat');
    }

    // style_tab_content
    protected function style_tab_content()
    {
        $this->ms_section_style_controls('blog_section', 'Section - Style', '.ms-el-section');

        $this->ms_basic_style_controls('blog_box_title', 'Box - Title', '.ms-el-box-title');
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


        <?php else : ?>


            <div class="mega-menu-right grey-bg-12">
                <?php if (!empty($settings['ms_section_title'])) : ?>
                    <h3 class="mega-menu-right-title"><?php echo ms_kses($settings['ms_section_title']); ?></h3>
                <?php endif; ?>
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
                    <div class="menu-shop-item d-flex align-items-center">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="menu-shop-thumb">
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

                        <div class="menu-shop-content">
                            <div class="menu-shop-meta">
                                <?php foreach ($terms as $key => $term) :
                                    $count = count($terms) - 1;

                                    $name = ($count > $key) ? $term->name . ', ' : $term->name
                                ?>
                                    <span>
                                        <a href="<?php echo get_term_link($term->slug, 'product_cat'); ?> "> <?php echo esc_html($name); ?></a>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                            <h4 class="menu-shop-title">
                                <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['ms_blog_title_word'], ''); ?></a>
                            </h4>
                            <div class="menu-shop-price-wrapper">
                                <div class="menu-shop-price">
                                    <?php echo woocommerce_template_loop_price(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile;
                wp_reset_query(); ?>
            </div>


        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new MS_Menu_Product());
