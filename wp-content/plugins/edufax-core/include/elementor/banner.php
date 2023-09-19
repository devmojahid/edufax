<?php

namespace MSCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use MSCore\Elementor\Controls\Group_Control_MSBGGradient;
use MSCore\Elementor\Controls\Group_Control_MSGradient;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Ms Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class MS_Banner extends Widget_Base
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
        return 'ms-banner';
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
        return __('Banner', 'mscore');
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

        $this->ms_section_title_render_controls('banner', 'Section - Title & Desciption', ['layout-2']);

        // Service group
        $this->start_controls_section(
            'ms_services',
            [
                'label' => esc_html__('Banner List', 'mscore'),
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
            'ms_services_image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __('Image', 'mscore'),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );


        $repeater->add_control(
            'ms_service_subtitle',
            [
                'label' => esc_html__('Sub Title', 'mscore'),
                'description' => ms_get_allowed_html_desc('basic'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('23 Products', 'mscore'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_2']
                ]
            ]
        );

        $repeater->add_control(
            'ms_service_title',
            [
                'label' => esc_html__('Title', 'mscore'),
                'description' => ms_get_allowed_html_desc('basic'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'mscore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'ms_services_link_switcher',
            [
                'label' => esc_html__('Add Banner link', 'mscore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'mscore'),
                'label_off' => esc_html__('No', 'mscore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        $repeater->add_control(
            'ms_services_btn_text',
            [
                'label' => esc_html__('Button Text', 'mscore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'mscore'),
                'title' => esc_html__('Enter button text', 'mscore'),
                'label_block' => true,
                'condition' => [
                    'ms_services_link_switcher' => 'yes',
                ],
            ]
        );
        $repeater->add_control(
            'ms_services_link_type',
            [
                'label' => esc_html__('Banner Link Type', 'mscore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'ms_services_link_switcher' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'ms_services_link',
            [
                'label' => esc_html__('Banner Link', 'mscore'),
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
                    'ms_services_link_type' => '1',
                    'ms_services_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'ms_services_page_link',
            [
                'label' => esc_html__('Select Banner Link Page', 'mscore'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => ms_get_all_pages(),
                'condition' => [
                    'ms_services_link_type' => '2',
                    'ms_services_link_switcher' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'ms_service_list',
            [
                'label' => esc_html__('Banner - List', 'mscore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'ms_service_title' => esc_html__('Business Stratagy', 'mscore'),
                    ],
                    [
                        'ms_service_title' => esc_html__('Website Development', 'mscore')
                    ],
                    [
                        'ms_service_title' => esc_html__('Marketing & Reporting', 'mscore')
                    ]
                ],
                'title_field' => '{{{ ms_service_title }}}',
            ]
        );
        $this->add_responsive_control(
            'ms_service_align',
            [
                'label' => esc_html__('Alignment', 'mscore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'text-left' => [
                        'title' => esc_html__('Left', 'mscore'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__('Center', 'mscore'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'text-right' => [
                        'title' => esc_html__('Right', 'mscore'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => true,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'exclude' => ['custom'],
            ]
        );
        $this->end_controls_section();

        $this->ms_button_render_controls('tpbtn', 'Button', ['layout-2']);
        // colum controls
        $this->ms_columns('col');
    }

    // style_tab_content
    protected function style_tab_content()
    {
        $this->ms_section_style_controls('services_section', 'Section - Style', '.ms-el-section');
        $this->ms_basic_style_controls('services_subtitle', 'Services - Subtitle', '.ms-el-subtitle');
        $this->ms_basic_style_controls('services_title', 'Services - Title', '.ms-el-title');
        $this->ms_basic_style_controls('services_description', 'Services - Description', '.ms-el-content p');

        $this->ms_basic_style_controls('services_box_title', 'Services - Box - Title', '.ms-el-box-title');
        $this->ms_basic_style_controls('services_box_subtitle', 'Services - Box - Subtitle', '.ms-el-box-subtitle');
        $this->ms_basic_style_controls('services_box_description', 'Services - Box - Description', '.ms-el-box-desc');
        $this->ms_icon_style('services_box_icon', 'Services - Icon/Image/SVG', '.ms-el-box-icon span');
        $this->ms_link_controls_style('services_box_link_btn', 'Services - Box - Button', '.ms-el-box-btn');
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
            $this->add_render_attribute('title_args', 'class', 'ms-section-title-3 ms-el-title');

            $this->ms_link_controls_render('tpbtn', 'ms-btn', $this->get_settings());
        ?>

            <!-- category area start -->
            <section class="ms-category-area pt-95">
                <div class="container">
                    <div class="row align-items-end">
                        <div class="col-lg-6 col-md-8">

                            <?php if (!empty($settings['ms_banner_section_title_show'])) : ?>
                                <div class="ms-section-title-wrapper-3 mb-45">
                                    <?php if (!empty($settings['ms_banner_sub_title'])) : ?>
                                        <span class="ms-section-title-pre-3 ms-el-subtitle"><?php echo ms_kses($settings['ms_banner_sub_title']); ?></span>
                                    <?php endif; ?>

                                    <?php
                                    if (!empty($settings['ms_banner_title'])) :
                                        printf(
                                            '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape($settings['ms_banner_title_tag']),
                                            $this->get_render_attribute_string('title_args'),
                                            ms_kses($settings['ms_banner_title'])
                                        );
                                    endif;
                                    ?>

                                    <?php if (!empty($settings['ms_banner_description'])) : ?>
                                        <p><?php echo ms_kses($settings['ms_banner_description']); ?></p>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                        </div>

                        <?php if ($settings['ms_' . $control_id . '_button_show'] == 'yes') : ?>
                            <div class="col-lg-6 col-md-4">
                                <div class="ms-category-more-3 text-md-end mb-55">
                                    <a <?php echo $this->get_render_attribute_string('ms-button-arg'); ?>>
                                        <?php echo ms_kses($settings['ms_' . $control_id . '_text']); ?>
                                        <svg width="12" height="10" viewBox="0 0 12 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10.9994 4.99981L1.04004 4.99981" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M6.98291 1L10.9998 4.99967L6.98291 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="row">
                        <?php foreach ($settings['ms_service_list'] as $key => $item) :

                            if (!empty($item['ms_services_image']['url'])) {
                                $ms_image_url = !empty($item['ms_services_image']['id']) ? wp_get_attachment_image_url($item['ms_services_image']['id'], $settings['thumbnail_size']) : $item['ms_services_image']['url'];
                                $ms_image_alt = get_post_meta($item["ms_services_image"]["id"], "_wp_attachment_image_alt", true);
                            }
                            // Link
                            if ('2' == $item['ms_services_link_type']) {
                                $link = get_permalink($item['ms_services_page_link']);
                                $target = '_self';
                                $rel = 'nofollow';
                            } else {
                                $link = !empty($item['ms_services_link']['url']) ? $item['ms_services_link']['url'] : '';
                                $target = !empty($item['ms_services_link']['is_external']) ? '_blank' : '';
                                $rel = !empty($item['ms_services_link']['nofollow']) ? 'nofollow' : '';
                            }
                        ?>
                            <div class="col-xl-<?php echo esc_attr($settings['ms_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['ms_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['ms_col_for_tablet']); ?> col-<?php echo esc_attr($settings['ms_col_for_mobile']); ?>">
                                <div class="ms-category-item-3 p-relative black-bg text-center z-index-1 fix mb-30">
                                    <div class="ms-category-thumb-3 include-bg" data-background="<?php echo esc_url($ms_image_url); ?>"></div>
                                    <div class="ms-category-content-3 transition-3">

                                        <?php if (!empty($item['ms_service_title'])) : ?>
                                            <h3 class="ms-category-title-3 ms-el-box-title">
                                                <?php if ($item['ms_services_link_switcher'] == 'yes') : ?>
                                                    <a href="<?php echo esc_url($link); ?>"><?php echo ms_kses($item['ms_service_title']); ?></a>
                                                <?php else : ?>
                                                    <?php echo ms_kses($item['ms_service_title']); ?>
                                                <?php endif; ?>
                                            </h3>
                                        <?php endif; ?>

                                        <?php if (!empty($item['ms_service_subtitle'])) : ?>
                                            <span class="ms-categroy-ammount-3"><?php echo ms_kses($item['ms_service_subtitle']); ?></span>
                                        <?php endif; ?>

                                        <?php if (!empty($link)) : ?>
                                            <div class="ms-category-btn-3">
                                                <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" class="ms-link-btn ms-link-btn-2">
                                                    <?php echo ms_kses($item['ms_services_btn_text']); ?>
                                                    <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M1 1L6.02116 5.99958L1 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
            <!-- category area end -->


        <?php else :
            $this->add_render_attribute('title_args', 'class', 'section__title ms-el-title');
            $bloginfo = get_bloginfo('name');

        ?>

            <!-- banner area start -->
            <section class="ms-banner-area mt-20">
                <div class="container-fluid ms-gx-40">
                    <div class="row ms-gx-20">
                        <?php foreach ($settings['ms_service_list'] as $key => $item) :

                            if (!empty($item['ms_services_image']['url'])) {
                                $ms_image_url = !empty($item['ms_services_image']['id']) ? wp_get_attachment_image_url($item['ms_services_image']['id'], $settings['thumbnail_size']) : $item['ms_services_image']['url'];
                                $ms_image_alt = get_post_meta($item["ms_services_image"]["id"], "_wp_attachment_image_alt", true);
                            }
                            // Link
                            if ('2' == $item['ms_services_link_type']) {
                                $link = get_permalink($item['ms_services_page_link']);
                                $target = '_self';
                                $rel = 'nofollow';
                            } else {
                                $link = !empty($item['ms_services_link']['url']) ? $item['ms_services_link']['url'] : '';
                                $target = !empty($item['ms_services_link']['is_external']) ? '_blank' : '';
                                $rel = !empty($item['ms_services_link']['nofollow']) ? 'nofollow' : '';
                            }
                        ?>
                            <div class="col-xl-<?php echo esc_attr($settings['ms_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['ms_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['ms_col_for_tablet']); ?> col-<?php echo esc_attr($settings['ms_col_for_mobile']); ?>">
                                <div class="ms-banner-item-2 p-relative z-index-1 grey-bg-2 mb-20 fix">

                                    <div class="ms-banner-thumb-2 include-bg transition-3" data-background="<?php echo esc_url($ms_image_url); ?>"></div>


                                    <?php if (!empty($item['ms_service_title'])) : ?>
                                        <h3 class="ms-banner-title-2 ms-el-box-title">
                                            <?php if ($item['ms_services_link_switcher'] == 'yes') : ?>
                                                <a href="<?php echo esc_url($link); ?>"><?php echo ms_kses($item['ms_service_title']); ?></a>
                                            <?php else : ?>
                                                <?php echo ms_kses($item['ms_service_title']); ?>
                                            <?php endif; ?>
                                        </h3>
                                    <?php endif; ?>

                                    <?php if (!empty($link)) : ?>
                                        <div class="ms-banner-btn-2">

                                            <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" class="ms-btn ms-btn-border ms-btn-border-sm">
                                                <?php echo ms_kses($item['ms_services_btn_text']); ?>
                                                <svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M16 7.49988L1 7.49988" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M9.9502 1.47554L16.0002 7.49954L9.9502 13.5245" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </a>

                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
            <!-- banner area end -->


        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new MS_Banner());
