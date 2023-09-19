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
class MS_Product_Hotspot_Banner extends Widget_Base
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
        return 'product-hotspot-banner';
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
        return __('Product Hotspot Banner', 'mscore');
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
            'ms_hotspot_thumb_sec',
            [
                'label' => esc_html__('Background Image', ''),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'ms_hotspot_image',
            [
                'label'   => esc_html__('Upload Thumbnail', ''),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
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

        $this->add_control(
            'ms_hotspot_image_height',
            [
                'label'       => esc_html__('Image Height', 'mscore'),
                'type'     => \Elementor\Controls_Manager::TEXT,
                'selectors' => ['{{WRAPPER}} .ms_hotspot_image_height' => 'height: {{VALUE}}'],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ms_hotspot_banner_sec',
            [
                'label' => esc_html__('Banner Controls', 'mscore'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'ms_design_style' => ['layout-2']
                ]
            ]
        );

        $this->add_control(
            'ms_hotspot_banner_subtitle',
            [
                'label'       => esc_html__('Subtitle', 'mscore'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('BUILD YOUR OWN SETS ', 'mscore'),
                'placeholder' => esc_html__('Your Text', 'mscore'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'ms_hotspot_banner_title',
            [
                'label'       => esc_html__('Title', 'mscore'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Our finest jewelry', 'mscore'),
                'placeholder' => esc_html__('Your Text', 'mscore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'ms_hotspot_banner_image',
            [
                'label'   => esc_html__('Upload Thumbnail', 'mscore'),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'ms_hotspot_banner_side_image',
            [
                'label'   => esc_html__('Upload Side Text Thumbnail', 'mscore'),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail_banner', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                // 'default' => 'ms-portfolio-thumb',
            ]
        );


        $this->end_controls_section();

        // Service group
        $this->start_controls_section(
            'ms_support',
            [
                'label' => esc_html__('Hotspot List', 'mscore'),
                'description' => esc_html__('Control all the style settings from Style tab', 'mscore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'ms_hotspot_top_title',
            [
                'label'       => esc_html__('Title', 'mscore'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('with NEW LOOK & NEW COLLECTION', 'mscore'),
                'placeholder' => esc_html__('Your Text', 'mscore'),
                'label_block' => true,
                'condition' => [
                    'ms_design_style' => ['layout-2']
                ]
            ]
        );


        $repeater = new \Elementor\Repeater();




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
            'ms_category_box_desc',
            [
                'label' => esc_html__('Sub Title', 'mscore'),
                'description' => ms_get_allowed_html_desc('basic'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('25 Product', 'mscore'),
                'label_block' => true,
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
            ]
        );

        $repeater->add_control(
            'ms_category_position',
            [
                'label'       => esc_html__('Position', 'mscore'),
                'type'     => \Elementor\Controls_Manager::TEXT,
                'selectors' => ['{{WRAPPER}} {{CURRENT_ITEM}}' => 'transform: {{VALUE}}'],
                'placeholder' => esc_html__('translate(200px, 100px)', 'mscore'),
                'condition' => [
                    'want_customize' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'ms_category_list',
            [
                'label' => esc_html__('Hotspot - List', 'mscore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'ms_category_box_title' => esc_html__('Skincare Product', 'mscore'),
                    ],
                    [
                        'ms_category_box_title' => esc_html__('Skincare Product', 'mscore')
                    ]
                ],
                'title_field' => '{{{ ms_category_box_title }}}',
            ]
        );

        $this->end_controls_section();

        $this->ms_button_render_controls('tpbtn', 'Button', ['layout-2']);
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

            if (!empty($settings['ms_hotspot_image']['url'])) {
                $ms_hotspot_image_url = !empty($settings['ms_hotspot_image']['id']) ? wp_get_attachment_image_url($settings['ms_hotspot_image']['id'], $settings['thumbnail_size']) : $settings['ms_hotspot_image']['url'];
                $ms_hotspot_image_alt = get_post_meta($settings["ms_hotspot_image"]["id"], "_wp_attachment_image_alt", true);
            }
            if (!empty($settings['ms_hotspot_banner_image']['url'])) {
                $ms_hotspot_banner_image_url = !empty($settings['ms_hotspot_banner_image']['id']) ? wp_get_attachment_image_url($settings['ms_hotspot_banner_image']['id'], $settings['thumbnail_banner_size']) : $settings['ms_hotspot_banner_image']['url'];
                $ms_hotspot_banner_image_alt = get_post_meta($settings["ms_hotspot_banner_image"]["id"], "_wp_attachment_image_alt", true);
            }

            if (!empty($settings['ms_hotspot_banner_side_image']['url'])) {
                $ms_hotspot_banner_side_image_url = !empty($settings['ms_hotspot_banner_side_image']['id']) ? wp_get_attachment_image_url($settings['ms_hotspot_banner_side_image']['id'], $settings['thumbnail_banner_size']) : $settings['ms_hotspot_banner_side_image']['url'];
                $ms_hotspot_banner_side_image_alt = get_post_meta($settings["ms_hotspot_banner_side_image"]["id"], "_wp_attachment_image_alt", true);
            }

            $this->ms_link_controls_render('tpbtn', 'ms-link-btn-line-2', $this->get_settings());

        ?>
            <section class="ms-collection-area">
                <div class="container-fluid">
                    <div class="ms-collection-inner-4 pl-100 pr-100">
                        <div class="row gx-0">
                            <div class="col-xl-6 col-lg-6">
                                <div class="ms-collection-thumb-wrapper-4 p-relative fix z-index-1 ms_hotspot_image_height">

                                    <div class="ms-collection-thumb-4 include-bg black-bg" data-background="<?php echo esc_url($ms_hotspot_image_url) ?>"></div>

                                    <?php if (!empty($settings['ms_hotspot_top_title'])) : ?>
                                        <span class="ms-collection-thumb-info-4"><?php echo esc_html($settings['ms_hotspot_top_title']) ?></span>
                                    <?php endif; ?>

                                    <?php foreach ($settings['ms_category_list'] as $key => $item) : ?>
                                        <div class="ms-collection-hotspot-item ms-collection-hotspot-1 elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>">
                                            <span class="ms-hotspot ms-pulse-border ">
                                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M7 1V13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M1 7H13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                            </span>
                                            <div class="ms-collection-hotspot-content">
                                                <?php if (!empty($item['ms_category_box_title'])) : ?>
                                                    <h3 class="ms-collection-hotspot-title"><?php echo ms_kses($item['ms_category_box_title']); ?></h3>
                                                <?php endif; ?>

                                                <?php if (!empty($item['ms_category_box_desc'])) : ?>
                                                    <p><?php echo ms_kses($item['ms_category_box_desc']); ?></p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>

                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6">
                                <div class="ms-collection-wrapper-4 p-relative pt-90 pb-95 grey-bg-7">
                                    <?php if (!empty($ms_hotspot_banner_side_image_url)) : ?>
                                        <span class="ms-collection-side-text">
                                            <img src="<?php echo esc_url($ms_hotspot_banner_side_image_url); ?>" alt="<?php echo esc_attr($ms_hotspot_banner_side_image_alt); ?>">
                                        </span>
                                    <?php endif; ?>
                                    <div class="row justify-content-center">
                                        <div class="col-xl-6 col-lg-8">
                                            <div class="ms-collection-item-4 text-center">

                                                <?php if (!empty($settings['ms_hotspot_banner_subtitle'])) : ?>
                                                    <span class="ms-collection-subtitle-4"><?php echo ms_kses($settings['ms_hotspot_banner_subtitle']); ?></span>
                                                <?php endif; ?>

                                                <?php if (!empty($ms_hotspot_banner_image_url)) : ?>
                                                    <div class="ms-collection-thumb-banner-4 m-img">
                                                        <img src="<?php echo esc_url($ms_hotspot_banner_image_url); ?>" alt="<?php echo esc_attr($ms_hotspot_banner_image_alt); ?>">
                                                    </div>
                                                <?php endif; ?>
                                                <div class="ms-collection-content-4">

                                                    <?php if (!empty($settings['ms_hotspot_banner_title'])) : ?>
                                                        <h3 class="ms-collection-title-4"><?php echo ms_kses($settings['ms_hotspot_banner_title']); ?></h3>
                                                    <?php endif; ?>

                                                    <?php if (!empty($settings['ms_' . $control_id . '_text']) && $settings['ms_' . $control_id . '_button_show'] == 'yes') : ?>
                                                        <div class="ms-collection-btn-4">
                                                            <a <?php echo $this->get_render_attribute_string('ms-button-arg'); ?>>
                                                                <?php echo $settings['ms_' . $control_id . '_text']; ?>
                                                                <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M1 1L6.02116 5.99958L1 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                </svg>
                                                            </a>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php else :
            $bloginfo = get_bloginfo('name');
            if (!empty($settings['ms_hotspot_image']['url'])) {
                $ms_hotspot_image_url = !empty($settings['ms_hotspot_image']['id']) ? wp_get_attachment_image_url($settings['ms_hotspot_image']['id'], $settings['thumbnail_size']) : $settings['ms_hotspot_image']['url'];
                $ms_hotspot_image_alt = get_post_meta($settings["ms_hotspot_image"]["id"], "_wp_attachment_image_alt", true);
            }

        ?>

            <div class="ms-special-slider-thumb ms_hotspot_image_height">
                <div class="ms-special-thumb black-bg">

                    <img src="<?php echo esc_url($ms_hotspot_image_url); ?>" alt="<?php echo esc_url($ms_hotspot_image_alt); ?>">

                    <?php foreach ($settings['ms_category_list'] as $key => $item) : ?>

                        <div class="ms-special-hotspot-item ms-special-hotspot-1 text-center elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>">

                            <span class="ms-hotspot ms-pulse-border ">
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7 1V13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M1 7H13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>

                            <div class="ms-special-hotspot-content">
                                <?php if (!empty($item['ms_category_box_title'])) : ?>
                                    <h3 class="ms-special-hotspot-title"><?php echo ms_kses($item['ms_category_box_title']); ?></h3>
                                <?php endif; ?>

                                <?php if (!empty($item['ms_category_box_desc'])) : ?>
                                    <p><?php echo ms_kses($item['ms_category_box_desc']); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new MS_Product_Hotspot_Banner());
