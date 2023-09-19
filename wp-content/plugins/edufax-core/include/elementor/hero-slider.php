<?php

namespace MSCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Ms Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class MS_Hero_Slider extends Widget_Base
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
        return 'ms-slider';
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
        return __('Hero Slider', 'mscore');
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
                ],
                'default' => 'layout-1',
            ]
        );
        $this->end_controls_section();


        $this->start_controls_section(
            'ms_main_slider',
            [
                'label' => esc_html__('Main Slider', 'mscore'),
                'description' => esc_html__('Control all the style settings from Style tab', 'mscore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'ms_slider_arrows_enable',
            [
                'label'        => esc_html__('Enable Navigation Arrows', 'mscore'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'mscore'),
                'label_off'    => esc_html__('Hide', 'mscore'),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition' => [
                    'ms_design_style' => ['layout-1', 'layout-3']
                ]
            ]
        );

        $this->add_control(
            'ms_slider_dots_enable',
            [
                'label'        => esc_html__('Enable Navigation Dots', 'mscore'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'mscore'),
                'label_off'    => esc_html__('Hide', 'mscore'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'ms_slider_shape',
            [
                'label'        => esc_html__('Enable Shapae ?', 'mscore'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'mscore'),
                'label_off'    => esc_html__('Hide', 'mscore'),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition' => [
                    'ms_design_style' => ['layout-1', 'layout-2']
                ]
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
            'enable_light_bg',
            [
                'label'        => esc_html__('Enable Light BG', 'mscore'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'mscore'),
                'label_off'    => esc_html__('Hide', 'mscore'),
                'return_value' => 'yes',
                'default'      => 'no',
                'condition' => [
                    'repeater_condition' => ['style_1']
                ]
            ]
        );

        $repeater->add_control(
            'ms_slider_image',
            [
                'label' => esc_html__('Upload Image', 'mscore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $repeater->add_control(
            'ms_slider_sub_title',
            [
                'label' => esc_html__('Sub Title', 'mscore'),
                'description' => ms_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Starting at 247',
                'placeholder' => esc_html__('Type Before Heading Text', 'mscore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'ms_slider_title',
            [
                'label' => esc_html__('Title', 'mscore'),
                'description' => ms_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Grow business.', 'mscore'),
                'placeholder' => esc_html__('Type Heading Text', 'mscore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'ms_slider_title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'mscore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'mscore'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'mscore'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'mscore'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => esc_html__('H4', 'mscore'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => esc_html__('H5', 'mscore'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => esc_html__('H6', 'mscore'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h2',
                'toggle' => false,
            ]
        );

        $repeater->add_control(
            'ms_slider_description',
            [
                'label' => esc_html__('Description', 'mscore'),
                'description' => ms_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('There are many variations of passages of Lorem Ipsum available but the majority have suffered alteration.', 'mscore'),
                'placeholder' => esc_html__('Type section description here', 'mscore'),
            ]
        );

        $repeater->add_control(
            'ms_btn_link_switcher',
            [
                'label' => esc_html__('Add Button link', 'mscore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'mscore'),
                'label_off' => esc_html__('No', 'mscore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'ms_btn_btn_text',
            [
                'label' => esc_html__('Button Text', 'mscore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'mscore'),
                'title' => esc_html__('Enter button text', 'mscore'),
                'label_block' => true,
                'condition' => [
                    'ms_btn_link_switcher' => 'yes',
                ],
            ]
        );
        $repeater->add_control(
            'ms_btn_link_type',
            [
                'label' => esc_html__('Button Link Type', 'mscore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'ms_btn_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'ms_btn_link',
            [
                'label' => esc_html__('Button Link', 'mscore'),
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
                    'ms_btn_link_type' => '1',
                    'ms_btn_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'ms_btn_page_link',
            [
                'label' => esc_html__('Select Button Link Page', 'mscore'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => ms_get_all_pages(),
                'condition' => [
                    'ms_btn_link_type' => '2',
                    'ms_btn_link_switcher' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'slider_list',
            [
                'label' => esc_html__('Slider List', 'mscore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'ms_slider_title' => esc_html__('Grow business.', 'mscore')
                    ],
                    [
                        'ms_slider_title' => esc_html__('Development.', 'mscore')
                    ],
                    [
                        'ms_slider_title' => esc_html__('Marketing.', 'mscore')
                    ],
                ],
                'title_field' => '{{{ ms_slider_title }}}',
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                // 'default' => 'ms-portfolio-thumb',
            ]
        );
        $this->end_controls_section();
    }


    protected function style_tab_content()
    {
        $this->ms_section_style_controls('about_section', 'Section - Style', '.ms-el-section');
        $this->ms_section_style_controls('services_section_box', 'Slider - Style', '.ms-el-box');
        $this->ms_basic_style_controls('slider_subtitle', 'Slider - Subtitle', '.ms-el-subtitle');
        $this->ms_basic_style_controls('slider_title', 'Slider - Title', '.ms-el-title');
        $this->ms_basic_style_controls('slider_description', 'Slider - Description', '.ms-el-content p');
        $this->ms_link_controls_style('slider_btn', 'Slider - Button', '.ms-el-btn');
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

            <!-- slider area start -->
            <section class="ms-slider-area p-relative z-index-1">
                <div class="ms-slider-active-2 swiper-container">
                    <div class="swiper-wrapper">
                        <?php foreach ($settings['slider_list'] as $item) :
                            $this->add_render_attribute('title_args', 'class', 'ms-slider-title-2 ms-el-title');

                            if (!empty($item['ms_slider_image']['url'])) {
                                $ms_slider_image_url = !empty($item['ms_slider_image']['id']) ? wp_get_attachment_image_url($item['ms_slider_image']['id'], $settings['thumbnail_size']) : $item['ms_slider_image']['url'];
                                $ms_slider_image_alt = get_post_meta($item["ms_slider_image"]["id"], "_wp_attachment_image_alt", true);
                            }

                            // btn Link
                            if ('2' == $item['ms_btn_link_type']) {
                                $link = get_permalink($item['ms_btn_page_link']);
                                $target = '_self';
                                $rel = 'nofollow';
                            } else {
                                $link = !empty($item['ms_btn_link']['url']) ? $item['ms_btn_link']['url'] : '';
                                $target = !empty($item['ms_btn_link']['is_external']) ? '_blank' : '';
                                $rel = !empty($item['ms_btn_link']['nofollow']) ? 'nofollow' : '';
                            }

                        ?>
                            <div class="ms-slider-item-2 ms-slider-height-2 p-relative swiper-slide grey-bg-5 d-flex align-items-end">

                                <?php if ($settings['ms_slider_shape'] == 'yes') : ?>
                                    <div class="ms-slider-2-shape">
                                        <img class="ms-slider-2-shape-1" src="<?php echo get_template_directory_uri(); ?>/assets/img/slider/2/shape/shape-1.png" alt="<?php echo esc_attr($bloginfo); ?>">
                                    </div>
                                <?php endif; ?>
                                <div class="container">
                                    <div class="row align-items-center">
                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="ms-slider-content-2">

                                                <?php if (!empty($item['ms_slider_sub_title'])) : ?>
                                                    <span class="ms-el-subtitle"><?php echo ms_kses($item['ms_slider_sub_title']); ?></span>
                                                <?php endif; ?>

                                                <?php
                                                if ($item['ms_slider_title_tag']) :
                                                    printf(
                                                        '<%1$s %2$s>%3$s</%1$s>',
                                                        tag_escape($item['ms_slider_title_tag']),
                                                        $this->get_render_attribute_string('title_args'),
                                                        ms_kses($item['ms_slider_title'])
                                                    );
                                                endif;
                                                ?>

                                                <?php if (!empty($item['ms_slider_description'])) : ?>
                                                    <p><?php echo ms_kses($item['ms_slider_description']); ?></p>
                                                <?php endif; ?>

                                                <?php if (!empty($link)) : ?>
                                                    <div class="ms-slider-btn-2">
                                                        <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" class="ms-btn ms-btn-border"><?php echo ms_kses($item['ms_btn_btn_text']); ?></a>
                                                    </div>
                                                <?php endif; ?>

                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="ms-slider-thumb-2-wrapper p-relative">

                                                <?php if ($settings['ms_slider_shape'] == 'yes') : ?>
                                                    <div class="ms-slider-thumb-2-shape">
                                                        <img class="ms-slider-thumb-2-shape-1" src="<?php echo get_template_directory_uri(); ?>/assets/img/slider/2/shape/shape-2.png" alt="<?php echo esc_attr($bloginfo); ?>">
                                                        <img class="ms-slider-thumb-2-shape-2" src="<?php echo get_template_directory_uri(); ?>/assets/img/slider/2/shape/shape-3.png" alt="<?php echo esc_attr($bloginfo); ?>">
                                                    </div>
                                                <?php endif; ?>
                                                <div class="ms-slider-thumb-2 text-end">
                                                    <span class="ms-slider-thumb-2-gradient"></span>
                                                    <img src="<?php echo esc_url($ms_slider_image_url); ?>" alt="<?php echo esc_attr($ms_slider_image_alt); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <?php if ($settings['ms_slider_dots_enable'] == 'yes') : ?>
                        <div class="ms-swiper-dot ms-slider-2-dot"></div>
                    <?php endif; ?>
                </div>
            </section>
            <!-- slider area end -->


        <?php elseif ($settings['ms_design_style']  == 'layout-3') :
            $bloginfo = get_bloginfo('name');
        ?>

            <!-- slider area start -->
            <section class="ms-slider-area p-relative z-index-1">
                <div class="ms-slider-active-3 swiper-container">

                    <div class="swiper-wrapper">
                        <?php foreach ($settings['slider_list'] as $item) :
                            $this->add_render_attribute('title_args', 'class', 'ms-slider-title-3 ms-el-title');

                            if (!empty($item['ms_slider_image']['url'])) {
                                $ms_slider_image_url = !empty($item['ms_slider_image']['id']) ? wp_get_attachment_image_url($item['ms_slider_image']['id'], $settings['thumbnail_size']) : $item['ms_slider_image']['url'];
                                $ms_slider_image_alt = get_post_meta($item["ms_slider_image"]["id"], "_wp_attachment_image_alt", true);
                            }

                            // btn Link
                            if ('2' == $item['ms_btn_link_type']) {
                                $link = get_permalink($item['ms_btn_page_link']);
                                $target = '_self';
                                $rel = 'nofollow';
                            } else {
                                $link = !empty($item['ms_btn_link']['url']) ? $item['ms_btn_link']['url'] : '';
                                $target = !empty($item['ms_btn_link']['is_external']) ? '_blank' : '';
                                $rel = !empty($item['ms_btn_link']['nofollow']) ? 'nofollow' : '';
                            }

                        ?>
                            <div class="ms-slider-item-3 ms-slider-height-3 p-relative swiper-slide black-bg d-flex align-items-center">

                                <div class="ms-slider-thumb-3 include-bg" data-background="<?php echo esc_url($ms_slider_image_url); ?>"></div>

                                <div class="container">
                                    <div class="row align-items-center">
                                        <div class="col-xl-6 col-lg-6 col-md-8">
                                            <div class="ms-slider-content-3">

                                                <?php if (!empty($item['ms_slider_sub_title'])) : ?>
                                                    <span class="ms-el-subtitle"><?php echo ms_kses($item['ms_slider_sub_title']); ?></span>
                                                <?php endif; ?>

                                                <?php
                                                if ($item['ms_slider_title_tag']) :
                                                    printf(
                                                        '<%1$s %2$s>%3$s</%1$s>',
                                                        tag_escape($item['ms_slider_title_tag']),
                                                        $this->get_render_attribute_string('title_args'),
                                                        ms_kses($item['ms_slider_title'])
                                                    );
                                                endif;
                                                ?>

                                                <?php if (!empty($item['ms_slider_description'])) : ?>
                                                    <p><?php echo ms_kses($item['ms_slider_description']); ?></p>
                                                <?php endif; ?>


                                                <div class="ms-slider-feature-3 d-flex flex-wrap align-items-center p-relative z-index-1 mb-15">
                                                    <div class="ms-slider-feature-item-3 d-flex mb-30">
                                                        <div class="ms-slider-feature-icon-3">
                                                            <span>
                                                                <svg width="28" height="41" viewBox="0 0 28 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M12.8051 22.9021L12.8051 22.9017C12.8041 22.6329 12.7339 22.3692 12.6017 22.1359C12.7338 21.9026 12.804 21.6389 12.8051 21.3701V21.3697V8.04926C12.8051 7.00767 12.5222 5.92241 11.8338 5.09565C11.1429 4.26579 10.0527 3.70774 8.46361 3.70774H5.2408C4.19921 3.70774 3.11412 3.99067 2.28755 4.67905C1.45787 5.37002 0.9 6.46016 0.9 8.04926L0.899999 21.3704L0.900001 21.3708C0.901066 21.6397 0.971276 21.9033 1.10341 22.1366C0.971242 22.3699 0.901029 22.6336 0.9 22.9024V22.9028V36.2233C0.9 37.8127 1.45786 38.9029 2.28755 39.5938C3.11414 40.2821 4.19923 40.5648 5.2408 40.5648H8.46361C10.0527 40.5648 11.1429 40.0067 11.8338 39.1769C12.5222 38.3501 12.8051 37.2649 12.8051 36.2233V22.9021ZM2.58119 22.9519L11.1744 23.0015V24.4797H2.5755L2.58119 22.9519ZM8.46361 38.934H5.2408C4.72457 38.934 4.04621 38.8437 3.49929 38.4637C2.95901 38.0884 2.53082 37.4189 2.53077 36.2235C2.53077 36.2234 2.53077 36.2233 2.53077 36.2233L2.56902 26.1104H11.1744V36.2233C11.1744 36.7395 11.0841 37.418 10.7041 37.9652C10.3287 38.5056 9.65914 38.934 8.46361 38.934ZM2.53077 8.04926C2.53077 6.85372 2.95898 6.1842 3.49929 5.80879C4.04621 5.4288 4.72457 5.33851 5.2408 5.33851H8.46361C9.65877 5.33851 10.3283 5.76688 10.7038 6.30739C11.0839 6.8545 11.1744 7.53305 11.1744 8.04926V21.3209L2.53077 21.271V8.04926Z" fill="currentColor" stroke="currentColor" stroke-width="0.2" />
                                                                    <path d="M27.1001 22.9022L27.1001 22.9021C27.0994 22.483 26.9327 22.0813 26.6364 21.785C26.3401 21.4887 25.9384 21.322 25.5193 21.3214H25.5192H21.9629V12.2929H23.7293C23.9456 12.2929 24.153 12.207 24.3059 12.0541C24.4588 11.9012 24.5447 11.6938 24.5447 11.4775C24.5447 11.2613 24.4588 11.0539 24.3059 10.901C24.153 10.748 23.9456 10.6621 23.7293 10.6621H21.9629V10.0452H23.7293C23.9456 10.0452 24.153 9.95927 24.3059 9.80635C24.4588 9.65344 24.5447 9.44604 24.5447 9.22979C24.5447 9.01353 24.4588 8.80614 24.3059 8.65322C24.153 8.50031 23.9456 8.4144 23.7293 8.4144H21.9629V7.79529H23.7293C23.9456 7.79529 24.153 7.70938 24.3059 7.55647C24.4588 7.40355 24.5447 7.19616 24.5447 6.9799C24.5447 6.76365 24.4588 6.55625 24.3059 6.40334C24.153 6.25042 23.9456 6.16452 23.7293 6.16452H21.9629V5.54612H23.7293C23.9456 5.54612 24.153 5.46021 24.3059 5.3073C24.4588 5.15438 24.5447 4.94699 24.5447 4.73073C24.5447 4.51448 24.4588 4.30708 24.3059 4.15417C24.153 4.00125 23.9456 3.91535 23.7293 3.91535H21.9629V3.29623H23.7293C23.9456 3.29623 24.153 3.21033 24.3059 3.05741C24.4588 2.9045 24.5447 2.6971 24.5447 2.48085C24.5447 2.26459 24.4588 2.0572 24.3059 1.90428C24.153 1.75137 23.9456 1.66546 23.7293 1.66546H21.9613C21.9492 1.46742 21.8652 1.27993 21.7241 1.13882C21.5711 0.985907 21.3637 0.9 21.1475 0.9C20.9312 0.9 20.7238 0.985906 20.5709 1.13882C20.4298 1.27993 20.3458 1.46742 20.3336 1.66546H18.5628C18.3465 1.66546 18.1392 1.75137 17.9862 1.90428C17.8333 2.0572 17.7474 2.26459 17.7474 2.48085C17.7474 2.6971 17.8333 2.9045 17.9862 3.05741C18.1392 3.21033 18.3465 3.29623 18.5628 3.29623H20.3321V3.91535H18.5628C18.3465 3.91535 18.1392 4.00125 17.9862 4.15417C17.8333 4.30708 17.7474 4.51448 17.7474 4.73073C17.7474 4.94699 17.8333 5.15438 17.9862 5.3073C18.1392 5.46021 18.3465 5.54612 18.5628 5.54612H20.3321V6.16452H18.5628C18.3465 6.16452 18.1392 6.25042 17.9862 6.40334C17.8333 6.55625 17.7474 6.76365 17.7474 6.9799C17.7474 7.19616 17.8333 7.40355 17.9862 7.55647C18.1392 7.70938 18.3465 7.79529 18.5628 7.79529H20.3321V8.4144H18.5628C18.3465 8.4144 18.1392 8.50031 17.9862 8.65322C17.8333 8.80614 17.7474 9.01353 17.7474 9.22979C17.7474 9.44604 17.8333 9.65344 17.9862 9.80635C18.1392 9.95927 18.3465 10.0452 18.5628 10.0452H20.3321V10.6643H18.5628C18.3465 10.6643 18.1392 10.7502 17.9862 10.9031C17.8333 11.056 17.7474 11.2634 17.7474 11.4797C17.7474 11.6959 17.8333 11.9033 17.9862 12.0562C18.1392 12.2092 18.3465 12.2951 18.5628 12.2951H20.3321V21.3235H16.7758H16.7756C16.3566 21.3241 15.9549 21.4909 15.6586 21.7872C15.3623 22.0835 15.1955 22.4852 15.1949 22.9042V22.9044V36.2234C15.1949 37.8129 15.753 38.903 16.5827 39.5939C17.4094 40.2822 18.4945 40.5649 19.5357 40.5649H22.7585C24.3476 40.5649 25.4378 40.0069 26.1287 39.177C26.8171 38.3503 27.1001 37.265 27.1001 36.2234V22.9022ZM22.7585 38.9342H19.5357C19.0195 38.9342 18.3411 38.8439 17.7942 38.4639C17.2539 38.0885 16.8257 37.419 16.8257 36.2236C16.8257 36.2235 16.8257 36.2235 16.8257 36.2234L16.8639 26.1106H25.4693V36.2234C25.4693 36.7396 25.379 37.4182 24.9991 37.9653C24.6237 38.5058 23.9544 38.9342 22.7592 38.9342H22.7585ZM16.8761 22.952L25.4693 23.0016V24.4798H16.8704L16.8761 22.952Z" fill="currentColor" stroke="currentColor" stroke-width="0.2" />
                                                                </svg>
                                                            </span>
                                                        </div>
                                                        <div class="ms-slider-feature-content-3">
                                                            <h3 class="ms-slider-feature-title-3">High-end <br> Cosmetics</h3>
                                                        </div>
                                                    </div>
                                                    <div class="ms-slider-feature-item-3 d-flex mb-30">
                                                        <div class="ms-slider-feature-icon-3">
                                                            <span>
                                                                <svg width="28" height="40" viewBox="0 0 28 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M1.43606 31.7795L1.43608 31.7795L7.27824 18.452L7.27881 18.4507C7.33969 18.317 7.41819 18.1922 7.51217 18.0795C7.51057 18.0714 7.50926 18.062 7.50887 18.0519C7.48244 17.7896 7.22091 14.9211 7.42573 11.6695C7.52866 10.0354 7.74957 8.30115 8.17876 6.75096C8.60746 5.20257 9.24687 3.82698 10.1942 2.92111L10.1964 2.91907L10.1964 2.9191C11.7369 1.53104 13.7638 0.808575 15.8349 0.909275C17.5023 0.928739 19.1549 1.22561 20.7249 1.78771L20.7347 1.79124L20.7345 1.79173C20.8964 1.86953 22.507 2.67578 24.0667 4.12264C25.6253 5.56847 27.1473 7.66752 27.0989 10.3294C27.0751 11.6397 26.4972 13.042 25.6495 14.4067C24.8007 15.773 23.6755 17.1109 22.544 18.2945C20.2808 20.6616 17.983 22.4204 17.7942 22.5639M1.43606 31.7795L7.60874 18.0457C7.5611 17.578 6.54963 6.54443 10.2633 2.99339C11.7847 1.6226 13.7865 0.909311 15.8319 1.00925C17.4888 1.02838 19.1311 1.32329 20.6912 1.88186C21.0056 2.03297 27.0942 5.08644 26.9989 10.3276C26.9056 15.4639 18.108 22.1998 17.7337 22.4843M1.43606 31.7795C0.756892 33.3309 0.774728 34.607 1.20122 35.5993C1.62683 36.5895 2.45312 37.2824 3.36411 37.6819L6.17112 38.9126L6.21267 38.8217L6.17254 38.9132L6.17171 38.9129C6.73064 39.1683 7.33642 39.3053 7.95089 39.3151H7.95248C9.1126 39.3151 9.98457 38.7871 10.6121 38.1519C11.2384 37.5181 11.625 36.774 11.8198 36.3282M1.43606 31.7795L7.95248 39.2151C10.2055 39.2151 11.3436 37.1683 11.7281 36.2882M17.7942 22.5639L17.7826 22.5486C17.7815 22.5571 17.7803 22.5656 17.779 22.5741M17.7942 22.5639C17.7942 22.5639 17.7942 22.5638 17.7943 22.5638L17.7826 22.5485C17.7838 22.539 17.785 22.5296 17.7861 22.5201L17.7585 22.5169L17.7337 22.4843M17.7942 22.5639C17.7891 22.5678 17.7839 22.5712 17.779 22.5741M17.779 22.5741C17.7675 22.5812 17.7571 22.5858 17.7512 22.5884L17.7509 22.5885C17.7417 22.5925 17.7402 22.5933 17.7402 22.5933C17.7402 22.5932 17.7403 22.5932 17.7404 22.5931L17.6867 22.5088M17.779 22.5741C17.7576 22.7213 17.7172 22.8651 17.6589 23.002L17.6585 23.0029L12.8564 33.9616L11.8198 36.3282M17.6867 22.5088L17.7585 22.5169L17.7337 22.4843M17.6867 22.5088C17.6689 22.6651 17.6286 22.818 17.5669 22.9628L12.7648 33.9215L11.7281 36.2882M17.6867 22.5088C17.6933 22.5045 17.7005 22.5014 17.7077 22.4982C17.7167 22.4943 17.7257 22.4903 17.7337 22.4843M11.8198 36.3282L11.7281 36.2882M11.8198 36.3282L11.8197 36.3283L11.7281 36.2882M13.3048 2.8533C12.5478 3.09808 11.8536 3.50758 11.2727 4.05303C10.6455 4.65149 10.1709 5.58127 9.81829 6.70218C9.46615 7.82159 9.23862 9.12203 9.09931 10.4517C8.82405 13.0792 8.89443 15.8094 9.02154 17.4581L9.30695 17.5831L9.30697 17.5831L16.926 20.9182L16.9263 20.9183L17.2116 21.0422C18.5076 20.0205 20.5601 18.222 22.3044 16.2385C23.1871 15.2347 23.9888 14.1857 24.5737 13.1678C25.1593 12.1485 25.5223 11.169 25.5389 10.3022C25.5447 9.77005 25.4681 9.24061 25.3122 8.73253L20.2352 14.137L20.2349 14.1373C20.0929 14.2872 19.8973 14.3747 19.691 14.3808C19.4846 14.3868 19.2842 14.3109 19.1337 14.1696C18.9832 14.0282 18.8948 13.833 18.8879 13.6267C18.8809 13.4204 18.956 13.2197 19.0967 13.0685L19.097 13.0682L24.61 7.19725C23.9686 6.20978 23.165 5.33788 22.2332 4.61832L19.6676 8.96923C19.6675 8.96941 19.6674 8.96958 19.6673 8.96975C19.6158 9.05893 19.5471 9.13704 19.4653 9.19956C19.3833 9.26221 19.2897 9.30798 19.1899 9.33422C19.09 9.36046 18.986 9.36665 18.8838 9.35243C18.7816 9.33822 18.6832 9.30388 18.5944 9.2514C18.5055 9.19892 18.4279 9.12934 18.3661 9.0467C18.3043 8.96405 18.2595 8.86997 18.2343 8.7699C18.2091 8.66983 18.204 8.56575 18.2193 8.46369C18.2345 8.36181 18.2698 8.26396 18.323 8.17578C18.3231 8.17562 18.3232 8.17546 18.3233 8.1753L20.9587 3.71423C20.4873 3.41824 20.1588 3.2464 20.1108 3.22178C19.6615 3.06661 19.2042 2.93555 18.7409 2.82917L17.838 6.34874L17.838 6.34889C17.7862 6.5494 17.6569 6.72115 17.4785 6.82633C17.3001 6.93152 17.0873 6.96154 16.8868 6.90978C16.6862 6.85802 16.5145 6.72872 16.4093 6.55034C16.3041 6.37195 16.2741 6.15908 16.3259 5.95856L17.1988 2.55502C16.7464 2.50036 16.2911 2.47216 15.8353 2.47058C15.5203 2.47182 15.2056 2.48908 14.8923 2.52229C14.8942 2.54321 14.8951 2.56423 14.8952 2.58527L14.8953 2.59362L14.8949 2.59359L14.3599 9.32604L14.3599 9.32607L14.2602 9.31814C14.2467 9.48919 14.169 9.64881 14.0428 9.76505C13.9166 9.88129 13.7511 9.94557 13.5796 9.94504L13.3048 2.8533ZM13.3048 2.8533L12.8006 9.20473C12.7924 9.30694 12.8046 9.40975 12.8362 9.50729C12.8678 9.60482 12.9183 9.69517 12.9849 9.77318C13.0514 9.85118 13.1327 9.91531 13.224 9.9619C13.3154 10.0085 13.415 10.0366 13.5172 10.0447L13.5172 10.045H13.5251L13.5792 10.045L13.3048 2.8533ZM10.3902 35.7029L10.4818 35.743L10.3902 35.7029C10.2535 36.0152 9.98901 36.5313 9.58351 36.9679C9.17876 37.4036 8.64107 37.7526 7.95434 37.753C7.55583 37.7432 7.16361 37.6513 6.80211 37.4833L6.80011 37.4824L3.99168 36.2511C3.54457 36.0551 2.99777 35.7049 2.69456 35.1057C2.39352 34.5108 2.32201 33.649 2.86693 32.405L2.77533 32.3648L2.86693 32.4049L3.59052 30.7527L11.1145 34.0492L10.3902 35.7029ZM16.2331 22.369L16.2329 22.3688L16.2297 22.3761L11.7407 32.6204L4.21666 29.3239L8.705 19.0789L8.70525 19.0783C8.71276 19.0609 8.72304 19.0449 8.73561 19.031L16.2443 22.3213C16.2444 22.3238 16.2444 22.3263 16.2443 22.3289C16.2436 22.3429 16.2398 22.3566 16.2331 22.369Z" fill="white" stroke="white" stroke-width="0.2" />
                                                                </svg>
                                                            </span>
                                                        </div>
                                                        <div class="ms-slider-feature-content-3">
                                                            <h3 class="ms-slider-feature-title-3">Vegan <br> Product</h3>
                                                        </div>
                                                    </div>
                                                    <div class="ms-slider-feature-item-3 d-flex mb-30">
                                                        <div class="ms-slider-feature-icon-3">
                                                            <span>
                                                                <svg width="30" height="38" viewBox="0 0 30 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M15 0.9C11.063 0.9 7.54671 1.68118 5.01091 2.96618C2.47971 4.24886 0.9 6.04875 0.9 8.09456V11.7749C0.9 13.2693 1.74609 14.6321 3.18677 15.7553C4.54605 16.8151 6.44256 17.6688 8.68826 18.2289C6.44256 18.7879 4.54605 19.6411 3.18678 20.7007C1.74608 21.8238 0.9 23.1867 0.9 24.6812V29.934C0.9 31.9798 2.47972 33.7794 5.01092 35.0618C7.54672 36.3464 11.063 37.1273 15 37.1273C18.937 37.1273 22.4533 36.3461 24.9891 35.0611C27.5203 33.7784 29.1 31.9785 29.1 29.9327V24.6812C29.1 23.1867 28.2539 21.824 26.8132 20.7008C25.4539 19.6411 23.5573 18.7875 21.3115 18.2277C23.5573 17.6679 25.4539 16.8142 26.8132 15.7543C28.2539 14.631 29.1 13.268 29.1 11.7736V8.09327C29.1 6.04746 27.5203 4.24789 24.9891 2.96554C22.4533 1.68086 18.937 0.9 15 0.9ZM27.6179 29.934C27.6179 30.689 27.2693 31.4227 26.6275 32.1026C25.9853 32.7829 25.0539 33.4042 23.9026 33.9302C21.6002 34.9821 18.4354 35.6452 15 35.6452C11.5646 35.6452 8.39975 34.9821 6.0974 33.9302C4.94609 33.4042 4.01473 32.7829 3.37254 32.1026C2.73067 31.4227 2.38211 30.689 2.38211 29.934V27.9334C3.50033 29.0862 5.1984 30.0504 7.28695 30.7364C9.48846 31.4596 12.1303 31.8758 15 31.8758C17.8696 31.8758 20.5115 31.4599 22.713 30.7369C24.8016 30.051 26.4997 29.0868 27.6179 27.9335V29.934ZM27.6179 24.6812C27.6179 25.4362 27.2693 26.1699 26.6275 26.85C25.9853 27.5304 25.0539 28.1519 23.9026 28.678C21.6002 29.7303 18.4354 30.3937 15 30.3937C11.5646 30.3937 8.39976 29.7303 6.09741 28.678C4.9461 28.1519 4.01474 27.5304 3.37255 26.85C2.73067 26.1699 2.38211 25.4362 2.38211 24.6812C2.38211 23.9263 2.73067 23.1925 3.37255 22.5124C4.01474 21.832 4.9461 21.2106 6.09741 20.6844C8.39976 19.6322 11.5646 18.9688 15 18.9688C18.4354 18.9688 21.6002 19.6322 23.9026 20.6844C25.0539 21.2106 25.9853 21.832 26.6275 22.5124C27.2693 23.1925 27.6179 23.9263 27.6179 24.6812ZM15 17.4867C11.5646 17.4867 8.39976 16.8233 6.09741 15.7709C4.94611 15.2447 4.01474 14.6232 3.37255 13.9427C2.73067 13.2626 2.38211 12.5287 2.38211 11.7736C2.38211 11.0185 2.73067 10.2846 3.37255 9.6044C4.01474 8.92392 4.94611 8.30241 6.09741 7.77619C8.39976 6.72388 11.5646 6.06048 15 6.06048C18.4354 6.06048 21.6002 6.72388 23.9026 7.77611C25.0539 8.30229 25.9853 8.92374 26.6275 9.60414C27.2693 10.2842 27.6179 11.018 27.6179 11.7729C27.6179 12.5279 27.2693 13.2617 26.6274 13.9419C25.9853 14.6224 25.0539 15.2441 23.9026 15.7704C21.6002 16.8229 18.4354 17.4867 15 17.4867ZM27.6179 8.09456V8.52126C26.4997 7.36794 24.8014 6.40357 22.7128 5.71755C20.5112 4.99443 17.8693 4.57837 15 4.57837C12.1307 4.57837 9.48879 4.99427 7.2872 5.71723C5.19858 6.4031 3.50035 7.36732 2.38211 8.52062V8.09327C2.38211 7.33833 2.73067 6.60463 3.37254 5.92469C4.01473 5.24441 4.94609 4.62312 6.0974 4.0971C8.39975 3.04519 11.5646 2.38211 15 2.38211C18.4354 2.38211 21.6002 3.04551 23.9026 4.09774C25.0539 4.62392 25.9853 5.24537 26.6275 5.92576C27.2693 6.60583 27.6179 7.3396 27.6179 8.09456Z" fill="currentColor" stroke="currentColor" stroke-width="0.2" />
                                                                    <path d="M14.9995 29.2987C17.441 29.2987 19.6238 28.7996 21.1999 27.9774C22.7721 27.1573 23.764 26.0014 23.764 24.6811C23.764 23.3609 22.7721 22.205 21.1999 21.3849C19.6238 20.5627 17.441 20.0636 14.9995 20.0636C12.5579 20.0636 10.3751 20.5627 8.799 21.3849C7.22678 22.205 6.23496 23.3609 6.23496 24.6811C6.23496 26.0014 7.22678 27.1573 8.799 27.9774C10.3751 28.7996 12.5579 29.2987 14.9995 29.2987ZM14.9995 21.5457C17.1625 21.5457 18.993 21.9698 20.2791 22.58C20.9224 22.8851 21.4259 23.2351 21.7672 23.5985C22.1089 23.9624 22.2818 24.3326 22.2818 24.6811C22.2818 25.0297 22.1089 25.3999 21.7672 25.7638C21.4259 26.1272 20.9224 26.4772 20.2791 26.7823C18.993 27.3925 17.1625 27.8166 14.9995 27.8166C12.8365 27.8166 11.006 27.3925 9.7198 26.7823C9.07652 26.4772 8.57301 26.1272 8.23171 25.7638C7.88997 25.3999 7.71707 25.0297 7.71707 24.6811C7.71707 24.3326 7.88997 23.9624 8.23171 23.5985C8.57301 23.2351 9.07652 22.8851 9.7198 22.58C11.006 21.9698 12.8365 21.5457 14.9995 21.5457Z" fill="currentColor" stroke="currentColor" stroke-width="0.2" />
                                                                </svg>
                                                            </span>
                                                        </div>
                                                        <div class="ms-slider-feature-content-3">
                                                            <h3 class="ms-slider-feature-title-3">Express <br> Make-up</h3>
                                                        </div>
                                                    </div>
                                                </div>

                                                <?php if (!empty($link)) : ?>
                                                    <div class="ms-slider-btn-3">
                                                        <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" class="ms-btn ms-btn-border ms-btn-border-white"><?php echo ms_kses($item['ms_btn_btn_text']); ?></a>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- dot style -->
                    <?php
                    $dot_class =  $settings['ms_slider_arrows_enable'] == 'yes' ? '' : 'd-sm-none';
                    if ($settings['ms_slider_dots_enable'] == 'yes') :
                    ?>
                        <div class="ms-swiper-dot ms-slider-3-dot <?php echo esc_attr($dot_class); ?>"></div>
                    <?php endif; ?>

                    <!-- arrow style -->
                    <?php if ($settings['ms_slider_arrows_enable'] == 'yes') : ?>
                        <div class="ms-slider-arrow-3 d-none d-sm-block">
                            <button type="button" class="ms-slider-3-button-prev">
                                <svg width="22" height="42" viewBox="0 0 22 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M21 0.999999L1 21L21 41" stroke="currentColor" stroke-opacity="0.3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                            <button type="button" class="ms-slider-3-button-next">
                                <svg width="22" height="42" viewBox="0 0 22 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 0.999999L21 21L1 41" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
            <!-- slider area end -->

        <?php else :
            $bloginfo = get_bloginfo('name');
        ?>

            <!-- slider area start -->
            <section class="ms-slider-area p-relative z-index-1">
                <div class="ms-slider-active ms-slider-variation swiper-container">

                    <div class="swiper-wrapper">
                        <?php foreach ($settings['slider_list'] as $item) :
                            $this->add_render_attribute('title_args', 'class', 'ms-slider-title ms-el-title');

                            if (!empty($item['ms_slider_image']['url'])) {
                                $ms_slider_image_url = !empty($item['ms_slider_image']['id']) ? wp_get_attachment_image_url($item['ms_slider_image']['id'], $settings['thumbnail_size']) : $item['ms_slider_image']['url'];
                                $ms_slider_image_alt = get_post_meta($item["ms_slider_image"]["id"], "_wp_attachment_image_alt", true);
                            }

                            // btn Link
                            if ('2' == $item['ms_btn_link_type']) {
                                $link = get_permalink($item['ms_btn_page_link']);
                                $target = '_self';
                                $rel = 'nofollow';
                            } else {
                                $link = !empty($item['ms_btn_link']['url']) ? $item['ms_btn_link']['url'] : '';
                                $target = !empty($item['ms_btn_link']['is_external']) ? '_blank' : '';
                                $rel = !empty($item['ms_btn_link']['nofollow']) ? 'nofollow' : '';
                            }

                            if ($item['enable_light_bg'] == 'yes') {
                                $light_class = 'is-light grey-bg-10';
                            } else {
                                $light_class = 'green-dark-bg';
                            }

                        ?>
                            <div class="ms-slider-item ms-slider-height d-flex align-items-center swiper-slide <?php echo esc_attr($light_class); ?>">

                                <?php if ($settings['ms_slider_shape'] == 'yes') : ?>
                                    <div class="ms-slider-shape">
                                        <img class="ms-slider-shape-1" src="<?php echo get_template_directory_uri(); ?>/assets/img/slider/shape/slider-shape-1.png" alt="<?php echo esc_attr($bloginfo); ?>">
                                        <img class="ms-slider-shape-2" src="<?php echo get_template_directory_uri(); ?>/assets/img/slider/shape/slider-shape-2.png" alt="<?php echo esc_attr($bloginfo); ?>">
                                        <img class="ms-slider-shape-3" src="<?php echo get_template_directory_uri(); ?>/assets/img/slider/shape/slider-shape-3.png" alt="<?php echo esc_attr($bloginfo); ?>">
                                        <img class="ms-slider-shape-4" src="<?php echo get_template_directory_uri(); ?>/assets/img/slider/shape/slider-shape-4.png" alt="<?php echo esc_attr($bloginfo); ?>">
                                    </div>
                                <?php endif; ?>

                                <div class="container">
                                    <div class="row align-items-center">
                                        <div class="col-xl-5 col-lg-6 col-md-6">
                                            <div class="ms-slider-content p-relative z-index-1">

                                                <?php if (!empty($item['ms_slider_sub_title'])) : ?>
                                                    <span class="ms-el-subtitle"><?php echo ms_kses($item['ms_slider_sub_title']); ?></span>
                                                <?php endif; ?>

                                                <?php
                                                if ($item['ms_slider_title_tag']) :
                                                    printf(
                                                        '<%1$s %2$s>%3$s</%1$s>',
                                                        tag_escape($item['ms_slider_title_tag']),
                                                        $this->get_render_attribute_string('title_args'),
                                                        ms_kses($item['ms_slider_title'])
                                                    );
                                                endif;
                                                ?>

                                                <?php if (!empty($item['ms_slider_description'])) : ?>
                                                    <p><?php echo ms_kses($item['ms_slider_description']); ?></p>
                                                <?php endif; ?>


                                                <?php if (!empty($link)) : ?>
                                                    <div class="ms-slider-btn">
                                                        <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" class="ms-btn ms-btn-2 ms-btn-white">
                                                            <?php echo ms_kses($item['ms_btn_btn_text']); ?>
                                                            <svg width="17" height="14" viewBox="0 0 17 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M16 6.99976L1 6.99976" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                <path d="M9.9502 0.975414L16.0002 6.99941L9.9502 13.0244" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="col-xl-7 col-lg-6 col-md-6">
                                            <div class="ms-slider-thumb text-end">
                                                <img src="<?php echo esc_url($ms_slider_image_url); ?>" alt="<?php echo esc_attr($ms_slider_image_alt); ?>">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <?php if ($settings['ms_slider_arrows_enable'] == 'yes') : ?>
                        <div class="ms-slider-arrow ms-swiper-arrow d-none d-lg-block">
                            <button type="button" class="ms-slider-button-prev">
                                <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7 13L1 7L7 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                            <button type="button" class="ms-slider-button-next">
                                <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 13L7 7L1 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                    <?php endif; ?>

                    <?php if ($settings['ms_slider_dots_enable'] == 'yes') : ?>
                        <div class="ms-slider-dot ms-swiper-dot"></div>
                    <?php endif; ?>
                </div>
            </section>
            <!-- slider area end -->


        <?php endif; ?>


<?php
    }
}

$widgets_manager->register(new MS_Hero_Slider());
