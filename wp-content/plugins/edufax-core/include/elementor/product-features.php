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
class MS_Product_Features extends Widget_Base
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
        return 'product-features';
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
        return __('Product Features', 'mscore');
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
            'ms_section_title_sec',
            [
                'label' => esc_html__('Section Title', 'mscore'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'ms_design_style' => 'layout-2'
                ]
            ]
        );

        $this->add_control(
            'ms_section_title',
            [
                'label'       => esc_html__('Title', 'mscore'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Specification', 'mscore'),
                'placeholder' => esc_html__('Your Text', 'mscore'),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        // _ms_image
        $this->start_controls_section(
            '_ms_image_section',
            [
                'label' => esc_html__('BG Image', 'ms-core'),
                'condition' => [
                    'ms_design_style' => 'layout-2'
                ]
            ]
        );
        $this->add_control(
            'ms_image',
            [
                'label' => esc_html__('Choose Image', 'ms-core'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'ms_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'ms_slider_side_sec',
            [
                'label' => esc_html__('Side Text', 'mscore'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'ms_design_style' => 'layout-2'
                ]
            ]
        );

        $this->add_control(
            'ms_slider_side_text_show',
            [
                'label'        => esc_html__('Enable Side Text ?', 'mscore'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'mscore'),
                'label_off'    => esc_html__('Hide', 'mscore'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'ms_slider_side_text',
            [
                'label'       => esc_html__('Slider Side Text', 'mscore'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('headphone', 'mscore'),
                'placeholder' => esc_html__('Your Text', 'mscore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'ms_slider_side_text_transform',
            [
                'label' => esc_html__('Transform', 'mscore'),
                'type' => Controls_Manager::TEXT,
                'selectors' => [
                    '{{WRAPPER}} .slider__bg-text' => 'transform: {{VALUE}};',
                ],
                'label_block' => true,
                'placeholder' => esc_html__('translate(200px) rotate(-90deg)', 'mscore'),
            ]
        );



        $this->end_controls_section();

        // Service group
        $this->start_controls_section(
            'ms_features',
            [
                'label' => esc_html__('Features List', 'mscore'),
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
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'ms_box_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'mscore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'mscore'),
                    'icon' => esc_html__('Icon', 'mscore'),
                    'svg' => esc_html__('SVG', 'mscore'),
                ],
                'condition' => [
                    'repeater_condition' => ['style_1', 'style_2'],
                ]
            ]
        );
        $repeater->add_control(
            'ms_box_icon_svg',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'mscore'),
                'condition' => [
                    'ms_box_icon_type' => 'svg',
                    'repeater_condition' => ['style_1', 'style_2'],
                ]
            ]
        );

        $repeater->add_control(
            'ms_box_icon_image',
            [
                'label' => esc_html__('Upload Icon Image', 'mscore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'ms_box_icon_type' => 'image',
                ]
            ]
        );

        if (ms_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'ms_box_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'ms_box_icon_type' => 'icon',
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'ms_box_selected_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fas fa-star',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'ms_box_icon_type' => 'icon',
                    ]
                ]
            );
        }

        $repeater->add_control(
            'ms_features_title',
            [
                'label' => esc_html__('Title', 'mscore'),
                'description' => ms_get_allowed_html_desc('basic'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'mscore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'ms_features_description',
            [
                'label' => esc_html__('Description', 'mscore'),
                'description' => ms_get_allowed_html_desc('intermediate'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered.',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'ms_features_link_switcher',
            [
                'label' => esc_html__('Add Features link', 'mscore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'mscore'),
                'label_off' => esc_html__('No', 'mscore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'ms_features_link_type',
            [
                'label' => esc_html__('Features Link Type', 'mscore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'ms_features_link_switcher' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'ms_features_link',
            [
                'label' => esc_html__('Features Link link', 'mscore'),
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
                    'ms_features_link_type' => '1',
                    'ms_features_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'ms_features_page_link',
            [
                'label' => esc_html__('Select Features Link Page', 'mscore'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => ms_get_all_pages(),
                'condition' => [
                    'ms_features_link_type' => '2',
                    'ms_features_link_switcher' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'ms_features_list',
            [
                'label' => esc_html__('Features - List', 'mscore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'ms_features_title' => esc_html__('Business Stratagy', 'mscore'),
                    ],
                    [
                        'ms_features_title' => esc_html__('Website Development', 'mscore')
                    ],
                    [
                        'ms_features_title' => esc_html__('Marketing & Reporting', 'mscore')
                    ]
                ],
                'title_field' => '{{{ ms_features_title }}}',
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                // 'default' => 'ms-post-thumb',
            ]
        );
        $this->end_controls_section();

        // colum controls
        $this->ms_columns('col');
    }

    // style_tab_content
    protected function style_tab_content()
    {
        $this->ms_section_style_controls('services_section', 'Section - Style', '.ms-el-section');
        $this->ms_basic_style_controls('services_title', 'Section - Title', '.ms-el-title');

        $this->ms_section_style_controls('services_section_box', 'Box - Style', '.ms-el-box');
        $this->ms_icon_style('section_icon', 'Box - Icon', '.ms-el-box-icon span');
        $this->ms_basic_style_controls('services_box_title', 'Box - Title', '.ms-el-box-title');
        $this->ms_basic_style_controls('services_box_description', 'Box - Description', '.ms-el-box-desc');
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
            $this->add_render_attribute('title_args', 'class', 'section__title-6 ms-el-title');

            if (!empty($settings['ms_image']['url'])) {
                $ms_image = !empty($settings['ms_image']['id']) ? wp_get_attachment_image_url($settings['ms_image']['id'], $settings['ms_image_size_size']) : $settings['ms_image']['url'];
                $ms_image_alt = get_post_meta($settings["ms_image"]["id"], "_wp_attachment_image_alt", true);
            }
        ?>

            <div class="slider__item-11 d-flex align-items-center p-relative is-pink ms-el-section">

                <?php if (($settings['ms_slider_side_text_show'] == 'yes')) : ?>
                    <div class="slider__bg-text">
                        <h3><?php echo ms_kses($settings['ms_slider_side_text']); ?></h3>
                    </div>
                <?php endif; ?>

                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-8 col-sm-10">
                            <div class="product__features-wrapper p-relative z-index-1">
                                <?php if (!empty($settings['ms_section_title'])) : ?>
                                    <h3 class="product-section-title ms-el-title"><?php echo esc_html($settings['ms_section_title']); ?></h3>
                                <?php endif; ?>

                                <div class="product__features-item-wrapper">
                                    <div class="row justify-content-between">
                                        <?php foreach ($settings['ms_features_list'] as $key => $item) :

                                            // Link
                                            if ('2' == $item['ms_features_link_type']) {
                                                $link = get_permalink($item['ms_features_page_link']);
                                                $target = '_self';
                                                $rel = 'nofollow';
                                            } else {
                                                $link = !empty($item['ms_features_link']['url']) ? $item['ms_features_link']['url'] : '';
                                                $target = !empty($item['ms_features_link']['is_external']) ? '_blank' : '';
                                                $rel = !empty($item['ms_features_link']['nofollow']) ? 'nofollow' : '';
                                            }
                                        ?>
                                            <div class="col-xl-<?php echo esc_attr($settings['ms_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['ms_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['ms_col_for_tablet']); ?> col-<?php echo esc_attr($settings['ms_col_for_mobile']); ?>">
                                                <div class="product__features-item mb-35 ms-el-box">
                                                    <div class="product__features-icon ms-el-box-icon">
                                                        <?php if ($item['ms_box_icon_type'] == 'icon') : ?>
                                                            <?php if (!empty($item['ms_box_icon']) || !empty($item['ms_box_selected_icon']['value'])) : ?>
                                                                <span><?php ms_render_icon($item, 'ms_box_icon', 'ms_box_selected_icon'); ?></span>
                                                            <?php endif; ?>
                                                        <?php elseif ($item['ms_box_icon_type'] == 'image') : ?>
                                                            <span>
                                                                <?php if (!empty($item['ms_box_icon_image']['url'])) : ?>
                                                                    <img src="<?php echo $item['ms_box_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['ms_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                                                <?php endif; ?>
                                                            </span>
                                                        <?php else : ?>
                                                            <span>
                                                                <?php if (!empty($item['ms_box_icon_svg'])) : ?>
                                                                    <?php echo $item['ms_box_icon_svg']; ?>
                                                                <?php endif; ?>
                                                            </span>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="product__features-content">
                                                        <?php if (!empty($item['ms_features_title'])) : ?>
                                                            <h3 class="product__features-title ms-el-box-title">
                                                                <?php if ($item['ms_features_link_switcher'] == 'yes') : ?>
                                                                    <a href="<?php echo esc_url($link); ?>"><?php echo ms_kses($item['ms_features_title']); ?></a>
                                                                <?php else : ?>
                                                                    <?php echo ms_kses($item['ms_features_title']); ?>
                                                                <?php endif; ?>
                                                            </h3>
                                                        <?php endif; ?>

                                                        <?php if (!empty($item['ms_features_description'])) : ?>
                                                            <p class="ms-el-box-desc"><?php echo ms_kses($item['ms_features_description']); ?></p>
                                                        <?php endif; ?>

                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-4 col-sm-2">
                            <div class="product__features-thumb text-end">
                                <img src="<?php echo esc_url($ms_image) ?>" alt="<?php echo esc_attr($ms_image_alt); ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        <?php else :
            $bloginfo = get_bloginfo('name');
            $this->add_render_attribute('title_args', 'class', 'section__title-7 ms-el-title');
        ?>

            <section class="features__area pt-80 pb-20 ms-el-section">
                <div class="container">
                    <div class="row">
                        <?php foreach ($settings['ms_features_list'] as $key => $item) :
                            // Link
                            if ('2' == $item['ms_features_link_type']) {
                                $link = get_permalink($item['ms_features_page_link']);
                                $target = '_self';
                                $rel = 'nofollow';
                            } else {
                                $link = !empty($item['ms_features_link']['url']) ? $item['ms_features_link']['url'] : '';
                                $target = !empty($item['ms_features_link']['is_external']) ? '_blank' : '';
                                $rel = !empty($item['ms_features_link']['nofollow']) ? 'nofollow' : '';
                            }

                        ?>
                            <div class="col-xl-<?php echo esc_attr($settings['ms_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['ms_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['ms_col_for_tablet']); ?> col-<?php echo esc_attr($settings['ms_col_for_mobile']); ?>">
                                <div class="features__item-13 d-flex align-items-start mb-40 ms-el-box">
                                    <div class="features__icon-13 ms-el-box-icon">
                                        <?php if ($item['ms_box_icon_type'] == 'icon') : ?>
                                            <?php if (!empty($item['ms_box_icon']) || !empty($item['ms_box_selected_icon']['value'])) : ?>
                                                <span><?php ms_render_icon($item, 'ms_box_icon', 'ms_box_selected_icon'); ?></span>
                                            <?php endif; ?>
                                        <?php elseif ($item['ms_box_icon_type'] == 'image') : ?>
                                            <span>
                                                <?php if (!empty($item['ms_box_icon_image']['url'])) : ?>
                                                    <img src="<?php echo $item['ms_box_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['ms_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                                <?php endif; ?>
                                            </span>
                                        <?php else : ?>
                                            <span>
                                                <?php if (!empty($item['ms_box_icon_svg'])) : ?>
                                                    <?php echo $item['ms_box_icon_svg']; ?>
                                                <?php endif; ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="features__content-13">

                                        <?php if (!empty($item['ms_features_title'])) : ?>
                                            <h3 class="features__title-13 ms-el-box-title">
                                                <?php if ($item['ms_features_link_switcher'] == 'yes') : ?>
                                                    <a href="<?php echo esc_url($link); ?>"><?php echo ms_kses($item['ms_features_title']); ?></a>
                                                <?php else : ?>
                                                    <?php echo ms_kses($item['ms_features_title']); ?>
                                                <?php endif; ?>
                                            </h3>
                                        <?php endif; ?>

                                        <?php if (!empty($item['ms_features_description'])) : ?>
                                            <p class="ms-el-box-desc"><?php echo ms_kses($item['ms_features_description']); ?></p>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
            <!-- features area end -->


        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new MS_Product_Features());
