<?php

namespace MSCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Ms Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class MS_Product_Category extends Widget_Base
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
        return 'product-category-slider';
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
        return __('Product Category', 'mscore');
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->ms_section_title_render_controls('category', 'Section - Title & Desciption', ['layout-2', 'layout-3']);


        // Service group
        $this->start_controls_section(
            'ms_support',
            [
                'label' => esc_html__('Category List', 'mscore'),
                'description' => esc_html__('Control all the style settings from Style tab', 'mscore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
                    'style_3' => __('Style 3', 'mscore'),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'ms_category_box_image',
            [
                'label'   => esc_html__('Upload Thumbnail', 'mscore'),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );


        $repeater->add_control(
            'ms_category_box_title',
            [
                'label' => esc_html__('Title', 'mscore'),
                'description' => ms_get_allowed_html_desc('basic'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'mscore'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'ms_category_box_subtitle',
            [
                'label' => esc_html__('Sub Title', 'mscore'),
                'description' => ms_get_allowed_html_desc('basic'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('25 Product', 'mscore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'ms_category_link_switcher',
            [
                'label' => esc_html__('Add Category link', 'mscore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'mscore'),
                'label_off' => esc_html__('No', 'mscore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'ms_category_btn_text',
            [
                'label' => esc_html__('Button Text', 'mscore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'mscore'),
                'title' => esc_html__('Enter button text', 'mscore'),
                'label_block' => true,
                'condition' => [
                    'ms_category_link_switcher' => 'yes',
                    'repeater_condition' => 'style_2'
                ],
            ]
        );

        $repeater->add_control(
            'ms_category_link_type',
            [
                'label' => esc_html__('Category Link Type', 'mscore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'ms_category_link_switcher' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'ms_category_link',
            [
                'label' => esc_html__('Category Link', 'mscore'),
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
                    'ms_category_link_type' => '1',
                    'ms_category_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'ms_category_page_link',
            [
                'label' => esc_html__('Select Category Link Page', 'mscore'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => ms_get_all_pages(),
                'condition' => [
                    'ms_category_link_type' => '2',
                    'ms_category_link_switcher' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'want_customize',
            [
                'label' => esc_html__('Want To Customize?', 'mscore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'mscore'),
                'label_off' => esc_html__('No', 'mscore'),
                'return_value' => 'yes',
                'description' => esc_html__('You can customize this item from here or customize from Style tab', 'mscore'),
                'style_transfer' => true,
                'condition' => [
                    'repeater_condition' => 'style_3'
                ],
            ]
        );

        $repeater->add_control(
            'ms_category_bg_color',
            [
                'label'       => esc_html__('BG Color', 'mscore'),
                'type'     => \Elementor\Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}'],
                'default' => '#E6F1E0',
                'condition' => [
                    'want_customize' => 'yes',
                    'repeater_condition' => 'style_3'
                ],
            ]
        );
        $repeater->add_control(
            'ms_category_subtitle_color',
            [
                'label'       => esc_html__('Subtitle Color', 'mscore'),
                'type'     => \Elementor\Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} {{CURRENT_ITEM}} .ms-category-content-5 span' => 'color: {{VALUE}}'],
                'default' => '#5C8C10',
                'condition' => [
                    'want_customize' => 'yes',
                    'repeater_condition' => 'style_3'
                ],
            ]
        );


        $this->add_control(
            'ms_category_list',
            [
                'label' => esc_html__('Category - List', 'mscore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'ms_category_box_title' => esc_html__('Business Stratagy', 'mscore'),
                    ],
                    [
                        'ms_category_box_title' => esc_html__('Website Development', 'mscore')
                    ],
                    [
                        'ms_category_box_title' => esc_html__('Website Development', 'mscore')
                    ]
                ],
                'title_field' => '{{{ ms_category_box_title }}}',
            ]
        );


        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
            ]
        );
        $this->end_controls_section();

        $this->ms_button_render_controls('tpbtn', 'Button', ['layout-4']);

        $this->start_controls_section(
            'ms_colcolumns_section',
            [
                'label' => esc_html__('Product Column', 'mscore'),
                'condition' => [
                    'ms_design_style' => ['layout-4']
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
        $this->ms_section_style_controls('services_section', 'Section - Style', '.ms-el-section');

        $this->ms_basic_style_controls('services_section_box', 'Box - Title', '.ms-el-box-title');
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
?>

        <?php if ($settings['ms_design_style']  == 'layout-2') :
            $this->add_render_attribute('title_args', 'class', 'ms-section-title-2 ms-el-title');
        ?>

            <!-- category area start -->
            <section class="ms-category-area pb-95 pt-95">
                <div class="container">
                    <?php if (!empty($settings['ms_category_section_title_show'])) : ?>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="ms-section-title-wrapper-2 text-center mb-50">
                                    <?php if (!empty($settings['ms_category_sub_title'])) : ?>
                                        <span class="ms-section-title-pre-2">
                                            <?php echo ms_kses($settings['ms_category_sub_title']); ?>
                                            <svg width="82" height="22" viewBox="0 0 82 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M81 14.5798C0.890564 -8.05914 -5.81154 0.0503902 5.00322 21" stroke="currentColor" stroke-opacity="0.3" stroke-width="2" stroke-miterlimit="3.8637" stroke-linecap="round" />
                                            </svg>
                                        </span>
                                    <?php endif; ?>

                                    <?php
                                    if (!empty($settings['ms_category_title'])) :
                                        printf(
                                            '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape($settings['ms_category_title_tag']),
                                            $this->get_render_attribute_string('title_args'),
                                            ms_kses($settings['ms_category_title'])
                                        );
                                    endif;
                                    ?>
                                    <?php if (!empty($settings['ms_category_description'])) : ?>
                                        <p><?php echo ms_kses($settings['ms_category_description']); ?></p>
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
                                        <?php foreach ($settings['ms_category_list'] as $key => $item) :

                                            if (!empty($item['ms_category_box_image']['url'])) {
                                                $ms_category_box_image_url = !empty($item['ms_category_box_image']['id']) ? wp_get_attachment_image_url($item['ms_category_box_image']['id'], $settings['thumbnail_size']) : $item['ms_category_box_image']['url'];
                                                $ms_category_box_image_alt = get_post_meta($item["ms_category_box_image"]["id"], "_wp_attachment_image_alt", true);
                                            }
                                            // Link
                                            if ('2' == $item['ms_category_link_type']) {
                                                $link = get_permalink($item['ms_category_page_link']);
                                                $target = '_self';
                                                $rel = 'nofollow';
                                            } else {
                                                $link = !empty($item['ms_category_link']['url']) ? $item['ms_category_link']['url'] : '';
                                                $target = !empty($item['ms_category_link']['is_external']) ? '_blank' : '';
                                                $rel = !empty($item['ms_category_link']['nofollow']) ? 'nofollow' : '';
                                            }
                                        ?>
                                            <div class="ms-category-item-2 p-relative z-index-1 text-center swiper-slide">
                                                <div class="ms-category-thumb-2">
                                                    <?php if ($item['ms_category_link_switcher'] == 'yes') : ?>
                                                        <a href="<?php echo esc_url($link); ?>">
                                                            <img src="<?php echo esc_url($ms_category_box_image_url); ?>" alt="<?php echo esc_attr($ms_category_box_image_alt) ?>">
                                                        </a>
                                                    <?php else : ?>
                                                        <img src="<?php echo esc_url($ms_category_box_image_url); ?>" alt="<?php echo esc_attr($ms_category_box_image_alt) ?>">
                                                    <?php endif; ?>
                                                </div>
                                                <div class="ms-category-content-2">
                                                    <?php if (!empty($item['ms_category_box_subtitle'])) : ?>
                                                        <span><?php echo ms_kses($item['ms_category_box_subtitle']); ?></span>
                                                    <?php endif; ?>

                                                    <?php if (!empty($item['ms_category_box_title'])) : ?>
                                                        <h3 class="ms-category-title-2 ms-el-box-title">
                                                            <?php if ($item['ms_category_link_switcher'] == 'yes') : ?>
                                                                <a href="<?php echo esc_url($link); ?>"><?php echo ms_kses($item['ms_category_box_title']); ?></a>
                                                            <?php else : ?>
                                                                <?php echo ms_kses($item['ms_category_box_title']); ?>
                                                            <?php endif; ?>
                                                        </h3>
                                                    <?php endif; ?>

                                                    <?php if (!empty($link)) : ?>
                                                        <div class="ms-category-btn-2">
                                                            <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" class="ms-btn ms-btn-border"><?php echo ms_kses($item['ms_category_btn_text']); ?></a>
                                                        </div>
                                                    <?php endif; ?>

                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="swiper-scrollbar ms-swiper-scrollbar ms-swiper-scrollbar-drag"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- category area end -->

        <?php elseif ($settings['ms_design_style']  == 'layout-3') :
            $this->add_render_attribute('title_args', 'class', 'ms-section-title-5 ms-el-title');
        ?>

            <!-- category area start -->
            <section class="ms-category-area pt-110 pb-110">
                <div class="container">
                    <?php if (!empty($settings['ms_category_section_title_show'])) : ?>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="ms-section-title-wrapper-5 mb-50 text-center">

                                    <?php if (!empty($settings['ms_category_sub_title'])) : ?>
                                        <span class="ms-section-title-pre-5">
                                            <?php echo ms_kses($settings['ms_category_sub_title']); ?>
                                            <svg width="82" height="22" viewBox="0 0 82 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M81 14.5798C0.890564 -8.05914 -5.81154 0.0503902 5.00322 21" stroke="currentColor" stroke-opacity="0.3" stroke-width="2" stroke-miterlimit="3.8637" stroke-linecap="round" />
                                            </svg>
                                        </span>
                                    <?php endif; ?>

                                    <?php
                                    if (!empty($settings['ms_category_title'])) :
                                        printf(
                                            '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape($settings['ms_category_title_tag']),
                                            $this->get_render_attribute_string('title_args'),
                                            ms_kses($settings['ms_category_title'])
                                        );
                                    endif;
                                    ?>
                                    <?php if (!empty($settings['ms_category_description'])) : ?>
                                        <p><?php echo ms_kses($settings['ms_category_description']); ?></p>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="ms-category-slider-5">
                                <div class="ms-category-slider-active-5 swiper-container mb-50">
                                    <div class="swiper-wrapper">
                                        <?php foreach ($settings['ms_category_list'] as $key => $item) :

                                            if (!empty($item['ms_category_box_image']['url'])) {
                                                $ms_category_box_image_url = !empty($item['ms_category_box_image']['id']) ? wp_get_attachment_image_url($item['ms_category_box_image']['id'], $settings['thumbnail_size']) : $item['ms_category_box_image']['url'];
                                                $ms_category_box_image_alt = get_post_meta($item["ms_category_box_image"]["id"], "_wp_attachment_image_alt", true);
                                            }
                                            // Link
                                            if ('2' == $item['ms_category_link_type']) {
                                                $link = get_permalink($item['ms_category_page_link']);
                                                $target = '_self';
                                                $rel = 'nofollow';
                                            } else {
                                                $link = !empty($item['ms_category_link']['url']) ? $item['ms_category_link']['url'] : '';
                                                $target = !empty($item['ms_category_link']['is_external']) ? '_blank' : '';
                                                $rel = !empty($item['ms_category_link']['nofollow']) ? 'nofollow' : '';
                                            }
                                        ?>
                                            <div class="ms-category-item-5 p-relative z-index-1 fix swiper-slide elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>">
                                                <a href="shop-category.html">
                                                    <div class="ms-category-thumb-5 include-bg" data-background="<?php echo esc_url($ms_category_box_image_url); ?>"></div>
                                                    <div class="ms-category-content-5">
                                                        <?php if (!empty($item['ms_category_box_title'])) : ?>
                                                            <h3 class="ms-category-title-5 ms-el-box-title">
                                                                <?php if ($item['ms_category_link_switcher'] == 'yes') : ?>
                                                                    <a href="<?php echo esc_url($link); ?>"><?php echo ms_kses($item['ms_category_box_title']); ?></a>
                                                                <?php else : ?>
                                                                    <?php echo ms_kses($item['ms_category_box_title']); ?>
                                                                <?php endif; ?>
                                                            </h3>
                                                        <?php endif; ?>

                                                        <?php if (!empty($item['ms_category_box_subtitle'])) : ?>
                                                            <span><?php echo ms_kses($item['ms_category_box_subtitle']); ?></span>
                                                        <?php endif; ?>

                                                    </div>
                                                </a>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="ms-category-5-swiper-scrollbar ms-swiper-scrollbar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- category area end -->

        <?php elseif ($settings['ms_design_style']  == 'layout-4') :
            $this->add_render_attribute('title_args', 'class', 'ms-section-title-5 ms-el-title');

            $this->ms_link_controls_render('tpbtn', 'ms-load-more-btn', $this->get_settings());
        ?>

            <!-- category area start -->
            <section class="ms-category-area pb-120">
                <div class="container">
                    <div class="row">
                        <?php foreach ($settings['ms_category_list'] as $key => $item) :

                            if (!empty($item['ms_category_box_image']['url'])) {
                                $ms_category_box_image_url = !empty($item['ms_category_box_image']['id']) ? wp_get_attachment_image_url($item['ms_category_box_image']['id'], $settings['thumbnail_size']) : $item['ms_category_box_image']['url'];
                                $ms_category_box_image_alt = get_post_meta($item["ms_category_box_image"]["id"], "_wp_attachment_image_alt", true);
                            }
                            // Link
                            if ('2' == $item['ms_category_link_type']) {
                                $link = get_permalink($item['ms_category_page_link']);
                                $target = '_self';
                                $rel = 'nofollow';
                            } else {
                                $link = !empty($item['ms_category_link']['url']) ? $item['ms_category_link']['url'] : '';
                                $target = !empty($item['ms_category_link']['is_external']) ? '_blank' : '';
                                $rel = !empty($item['ms_category_link']['nofollow']) ? 'nofollow' : '';
                            }
                        ?>
                            <div class="col-xl-<?php echo esc_attr($settings['ms_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['ms_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['ms_col_for_tablet']); ?> col-<?php echo esc_attr($settings['ms_col_for_mobile']); ?>">
                                <div class="ms-category-main-box mb-25 p-relative fix grey-bg-11">
                                    <div class="ms-category-main-thumb include-bg transition-3" data-background="<?php echo esc_url($ms_category_box_image_url); ?>"></div>
                                    <div class="ms-category-main-content">
                                        <?php if (!empty($item['ms_category_box_title'])) : ?>
                                            <h3 class="ms-category-main-title ms-el-box-title">
                                                <?php if ($item['ms_category_link_switcher'] == 'yes') : ?>
                                                    <a href="<?php echo esc_url($link); ?>"><?php echo ms_kses($item['ms_category_box_title']); ?></a>
                                                <?php else : ?>
                                                    <?php echo ms_kses($item['ms_category_box_title']); ?>
                                                <?php endif; ?>
                                            </h3>
                                        <?php endif; ?>

                                        <?php if (!empty($item['ms_category_box_subtitle'])) : ?>
                                            <span class="ms-category-main-item"><?php echo ms_kses($item['ms_category_box_subtitle']); ?></span>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <?php if (!empty($settings['ms_' . $control_id . '_text']) && $settings['ms_' . $control_id . '_button_show'] == 'yes') : ?>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="ms-category-main-more text-center mt-50">
                                    <!-- button start -->
                                    <a <?php echo $this->get_render_attribute_string('ms-button-arg'); ?>> <?php echo $settings['ms_' . $control_id . '_text']; ?> </a>
                                    <!-- button end -->
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
            <!-- category area end -->

        <?php else :
            $bloginfo = get_bloginfo('name');
            $this->add_render_attribute('title_args', 'class', 'section__title-7 ms-el-title');

        ?>

            <!-- product category area start -->
            <section class="ms-product-category pt-60 pb-15">
                <div class="container">
                    <div class="row row-cols-xl-5 row-cols-lg-5 row-cols-md-4">
                        <?php foreach ($settings['ms_category_list'] as $key => $item) :

                            if (!empty($item['ms_category_box_image']['url'])) {
                                $ms_category_box_image_url = !empty($item['ms_category_box_image']['id']) ? wp_get_attachment_image_url($item['ms_category_box_image']['id'], $settings['thumbnail_size']) : $item['ms_category_box_image']['url'];
                                $ms_category_box_image_alt = get_post_meta($item["ms_category_box_image"]["id"], "_wp_attachment_image_alt", true);
                            }
                            // Link
                            if ('2' == $item['ms_category_link_type']) {
                                $link = get_permalink($item['ms_category_page_link']);
                                $target = '_self';
                                $rel = 'nofollow';
                            } else {
                                $link = !empty($item['ms_category_link']['url']) ? $item['ms_category_link']['url'] : '';
                                $target = !empty($item['ms_category_link']['is_external']) ? '_blank' : '';
                                $rel = !empty($item['ms_category_link']['nofollow']) ? 'nofollow' : '';
                            }
                        ?>
                            <div class="col">
                                <div class="ms-product-category-item text-center mb-40">
                                    <div class="ms-product-category-thumb fix">
                                        <?php if ($item['ms_category_link_switcher'] == 'yes') : ?>
                                            <a href="<?php echo esc_url($link); ?>">
                                                <img src="<?php echo esc_url($ms_category_box_image_url); ?>" alt="<?php echo esc_attr($ms_category_box_image_alt) ?>">
                                            </a>
                                        <?php else : ?>
                                            <img src="<?php echo esc_url($ms_category_box_image_url); ?>" alt="<?php echo esc_attr($ms_category_box_image_alt) ?>">
                                        <?php endif; ?>
                                    </div>
                                    <div class="ms-product-category-content">
                                        <?php if (!empty($item['ms_category_box_title'])) : ?>
                                            <h3 class="ms-product-category-title ms-el-box-title">
                                                <?php if ($item['ms_category_link_switcher'] == 'yes') : ?>
                                                    <a href="<?php echo esc_url($link); ?>"><?php echo ms_kses($item['ms_category_box_title']); ?></a>
                                                <?php else : ?>
                                                    <?php echo ms_kses($item['ms_category_box_title']); ?>
                                                <?php endif; ?>
                                            </h3>
                                        <?php endif; ?>

                                        <?php if (!empty($item['ms_category_box_subtitle'])) : ?>
                                            <p><?php echo ms_kses($item['ms_category_box_subtitle']); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
            <!-- product category area end -->

        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new MS_Product_Category());
