<?php

namespace MSCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Control_Media;
use \Elementor\Utils;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Ms Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class MS_Product_Banner_Slider extends Widget_Base
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
        return 'ms-product-banner-slider';
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
        return __('Product Banner Slider', 'mscore');
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ms_portfolio_sec',
            [
                'label' => esc_html__('Product Slider', 'mscore'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );


        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'repeater_condition',
            [
                'label' => __('Field condition', 'mscore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __('Style 1', 'mscore'),
                    'style_2' => __('Style 2', 'mscore'),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'ms_portfolio_image',
            [
                'label' => esc_html__('Upload Image', 'mscore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $repeater->add_control(
            'ms_portfolio_offer_image',
            [
                'label' => esc_html__('Upload Offer Image', 'mscore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'repeater_condition' => 'style_2'
                ],
            ]
        );

        $repeater->add_control(
            'ms_portfolio_box_subtitle',
            [
                'label'   => esc_html__('Sub Title', 'mscore'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Tablet Collection 2023', 'mscore'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'ms_portfolio_box_title',
            [
                'label'   => esc_html__('Title', 'mscore'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Product Title', 'mscore'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'ms_portfolio_box_bg_text',
            [
                'label'   => esc_html__('BG Text', 'mscore'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Tablet', 'mscore'),
                'label_block' => true,
                'condition' => [
                    'ms_portfolio_link_switcher' => 'yes',
                    'repeater_condition' => 'style_2'
                ],
            ]
        );

        $repeater->add_control(
            'ms_portfolio_box_price',
            [
                'label'   => esc_html__('Price', 'mscore'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('$90.80', 'mscore'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => 'style_2'
                ],
            ]
        );
        $repeater->add_control(
            'ms_portfolio_box_old_price',
            [
                'label'   => esc_html__('Old Price', 'mscore'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('$10.20', 'mscore'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => 'style_2'
                ],
            ]
        );

        $repeater->add_control(
            'ms_portfolio_link_switcher',
            [
                'label' => esc_html__('Add Product link', 'mscore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'mscore'),
                'label_off' => esc_html__('No', 'mscore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'ms_portfolio_btn_text',
            [
                'label' => esc_html__('Button Text', 'mscore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'mscore'),
                'title' => esc_html__('Enter button text', 'mscore'),
                'label_block' => true,
                'condition' => [
                    'ms_portfolio_link_switcher' => 'yes',
                    'repeater_condition' => 'style_2'
                ],
            ]
        );

        $repeater->add_control(
            'ms_portfolio_link_type',
            [
                'label' => esc_html__('Product Link Type', 'mscore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'ms_portfolio_link_switcher' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'ms_portfolio_link',
            [
                'label' => esc_html__('Proudct Link', 'mscore'),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'mscore'),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'condition' => [
                    'ms_portfolio_link_type' => '1',
                    'ms_portfolio_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'ms_portfolio_page_link',
            [
                'label' => esc_html__('Select Proudct Link Page', 'mscore'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => ms_get_all_pages(),
                'condition' => [
                    'ms_portfolio_link_type' => '2',
                    'ms_portfolio_link_switcher' => 'yes',
                ]
            ]
        );


        $this->add_control(
            'ms_portfolio_list',
            [
                'label'       => esc_html__('Proudct List', 'mscore'),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'ms_portfolio_box_title' => esc_html__('Business Stratagy', 'mscore'),
                    ],
                    [
                        'ms_portfolio_box_title' => esc_html__('Website Development', 'mscore')
                    ],
                    [
                        'ms_portfolio_box_title' => esc_html__('Marketing & Reporting', 'mscore')
                    ],
                ],
                'title_field' => '{{{ ms_portfolio_box_title }}}',
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'medium_large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->end_controls_section();
    }

    // style_tab_content
    protected function style_tab_content()
    {
        // $this->ms_section_style_controls('video_section', 'Section - Style', '.ms-el-section');
        // $this->ms_basic_style_controls('section_title', 'Section - Title', '.ms-el-title');
        // $this->ms_basic_style_controls('section_subtitle', 'Section - Subtitle', '.ms-el-subtitle');
        // $this->ms_basic_style_controls('section_description', 'Section - Description', '.ms-el-content p');
        // $this->ms_link_controls_style('video_box_play_btn', 'Video - Button', '.ms-el-box-btn');
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

?>

        <?php if ($settings['ms_design_style']  == 'layout-2') :
            $bloginfo = get_bloginfo('name');
        ?>

            <!-- product banner area start -->
            <div class="ms-product-banner-area pb-90">
                <div class="container">
                    <div class="ms-product-banner-slider fix">
                        <div class="ms-product-banner-slider-active swiper-container">
                            <div class="swiper-wrapper">
                                <?php foreach ($settings['ms_portfolio_list'] as $item) :
                                    if (!empty($item['ms_portfolio_image']['url'])) {
                                        $ms_portfolio_image_url = !empty($item['ms_portfolio_image']['id']) ? wp_get_attachment_image_url($item['ms_portfolio_image']['id'], $settings['thumbnail_size']) : $item['ms_portfolio_image']['url'];
                                        $ms_portfolio_image_alt = get_post_meta($item["ms_portfolio_image"]["id"], "_wp_attachment_image_alt", true);
                                    }

                                    if (!empty($item['ms_portfolio_offer_image']['url'])) {
                                        $ms_portfolio_offer_image_url = !empty($item['ms_portfolio_offer_image']['id']) ? wp_get_attachment_image_url($item['ms_portfolio_offer_image']['id'], $settings['thumbnail_size']) : $item['ms_portfolio_offer_image']['url'];
                                        $ms_portfolio_offer_image_alt = get_post_meta($item["ms_portfolio_offer_image"]["id"], "_wp_attachment_image_alt", true);
                                    }
                                    // Link
                                    if ('2' == $item['ms_portfolio_link_type']) {
                                        $link = get_permalink($item['ms_portfolio_page_link']);
                                        $target = '_self';
                                        $rel = 'nofollow';
                                    } else {
                                        $link = !empty($item['ms_portfolio_link']['url']) ? $item['ms_portfolio_link']['url'] : '';
                                        $target = !empty($item['ms_portfolio_link']['is_external']) ? '_blank' : '';
                                        $rel = !empty($item['ms_portfolio_link']['nofollow']) ? 'nofollow' : '';
                                    }

                                ?>
                                    <div class="ms-product-banner-inner theme-bg p-relative z-index-1 fix swiper-slide">

                                        <?php if (!empty($item['ms_portfolio_box_bg_text'])) : ?>
                                            <h4 class="ms-product-banner-bg-text"><?php echo esc_html($item['ms_portfolio_box_bg_text']); ?></h4>
                                        <?php endif; ?>

                                        <div class="row align-items-center">
                                            <div class="col-xl-6 col-lg-6">
                                                <div class="ms-product-banner-content p-relative z-index-1">


                                                    <?php if (!empty($item['ms_portfolio_box_subtitle'])) : ?>
                                                        <span class="ms-product-banner-subtitle"><?php echo ms_kses($item['ms_portfolio_box_subtitle']); ?></span>
                                                    <?php endif; ?>


                                                    <h3 class="ms-product-banner-title">
                                                        <?php if ($item['ms_portfolio_link_switcher'] == 'yes') : ?>
                                                            <a href="<?php echo esc_url($link); ?>"><?php echo ms_kses($item['ms_portfolio_box_title']); ?></a>
                                                        <?php else : ?>
                                                            <?php echo ms_kses($item['ms_portfolio_box_title']); ?>
                                                        <?php endif; ?>
                                                    </h3>

                                                    <?php if (!empty($item['ms_portfolio_box_old_price']) or !empty($item['ms_portfolio_box_price'])) : ?>
                                                        <div class="ms-product-banner-price mb-40">

                                                            <?php if (!empty($item['ms_portfolio_box_old_price'])) : ?>
                                                                <span class="old-price"><?php echo ms_kses($item['ms_portfolio_box_old_price']); ?></span>
                                                            <?php endif; ?>

                                                            <?php if (!empty($item['ms_portfolio_box_price'])) : ?>
                                                                <p class="new-price"><?php echo ms_kses($item['ms_portfolio_box_price']); ?></p>
                                                            <?php endif; ?>
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if (!empty($link)) : ?>
                                                        <div class="ms-product-banner-btn">
                                                            <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" class="ms-btn ms-btn-2"><?php echo ms_kses($item['ms_portfolio_btn_text']); ?></a>
                                                        </div>
                                                    <?php endif; ?>

                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6">
                                                <div class="ms-product-banner-thumb-wrapper p-relative">

                                                    <div class="ms-product-banner-thumb-shape">
                                                        <span class="ms-product-banner-thumb-gradient"></span>
                                                        <?php if (!empty($ms_portfolio_offer_image_url)) : ?>
                                                            <img class="ms-offer-shape" src="<?php echo esc_url($ms_portfolio_offer_image_url); ?>" alt="<?php echo esc_url($ms_portfolio_image_alt); ?>">
                                                        <?php endif; ?>
                                                    </div>

                                                    <?php if (!empty($ms_portfolio_image_url)) : ?>
                                                        <div class="ms-product-banner-thumb text-end p-relative z-index-1">
                                                            <img src="<?php echo esc_url($ms_portfolio_image_url); ?>" alt="<?php echo esc_url($ms_portfolio_image_alt); ?>">
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="ms-product-banner-slider-dot ms-swiper-dot"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- product banner area end -->

        <?php else :
            $bloginfo = get_bloginfo('name');
            $this->add_render_attribute('title_args', 'class', 'video__title ms-el-title');
        ?>



            <div class="ms-product-gadget-banner">
                <div class="ms-product-gadget-banner-slider-active swiper-container">
                    <div class="swiper-wrapper">
                        <?php foreach ($settings['ms_portfolio_list'] as $item) :
                            if (!empty($item['ms_portfolio_image']['url'])) {
                                $ms_portfolio_image_url = !empty($item['ms_portfolio_image']['id']) ? wp_get_attachment_image_url($item['ms_portfolio_image']['id'], $settings['thumbnail_size']) : $item['ms_portfolio_image']['url'];
                                $ms_portfolio_image_alt = get_post_meta($item["ms_portfolio_image"]["id"], "_wp_attachment_image_alt", true);
                            }
                            // Link
                            if ('2' == $item['ms_portfolio_link_type']) {
                                $link = get_permalink($item['ms_portfolio_page_link']);
                                $target = '_self';
                                $rel = 'nofollow';
                            } else {
                                $link = !empty($item['ms_portfolio_link']['url']) ? $item['ms_portfolio_link']['url'] : '';
                                $target = !empty($item['ms_portfolio_link']['is_external']) ? '_blank' : '';
                                $rel = !empty($item['ms_portfolio_link']['nofollow']) ? 'nofollow' : '';
                            }

                        ?>
                            <div class="ms-product-gadget-banner-item swiper-slide include-bg" data-background="<?php echo esc_url($ms_portfolio_image_url); ?>">
                                <div class="ms-product-gadget-banner-content">

                                    <?php if (!empty($item['ms_portfolio_box_subtitle'])) : ?>
                                        <span class="ms-product-gadget-banner-price"><?php echo ms_kses($item['ms_portfolio_box_subtitle']); ?></span>
                                    <?php endif; ?>

                                    <h3 class="ms-product-gadget-banner-title">
                                        <?php if ($item['ms_portfolio_link_switcher'] == 'yes') : ?>
                                            <a href="<?php echo esc_url($link); ?>"><?php echo ms_kses($item['ms_portfolio_box_title']); ?></a>
                                        <?php else : ?>
                                            <?php echo ms_kses($item['ms_portfolio_box_title']); ?>
                                        <?php endif; ?>
                                    </h3>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="ms-product-gadget-banner-slider-dot ms-swiper-dot"></div>
                </div>
            </div>


        <?php endif; ?>

<?php

    }
}

$widgets_manager->register(new MS_Product_Banner_Slider());
