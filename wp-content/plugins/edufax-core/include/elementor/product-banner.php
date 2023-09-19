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
class MS_Product_Banner extends Widget_Base
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
        return 'product-banner';
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
        return __('Product Banner', 'mscore');
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();


        // Service group
        $this->start_controls_section(
            'ms_banner_sec',
            [
                'label' => esc_html__('Banner Content', 'mscore'),
                'description' => esc_html__('Control all the style settings from Style tab', 'mscore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'ms_image',
            [
                'label'   => esc_html__('Upload Thumbnail', 'mscore'),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'ms_banner_subtitle',
            [
                'label'       => esc_html__('Banner Subtitle', 'mscore'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Subtitle', 'mscore'),
                'placeholder' => esc_html__('Your Text', 'mscore'),
                'label_block' => true
            ]
        );

        $this->add_control(
            'ms_banner_title',
            [
                'label'       => esc_html__('Banner Title', 'mscore'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('My Product Title', 'mscore'),
                'placeholder' => esc_html__('Your Text', 'mscore'),
                'label_block' => true
            ]
        );

        $this->add_control(
            'ms_banner_desc',
            [
                'label'       => esc_html__('Description', 'mscore'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'rows'        => 10,
                'default'     => esc_html__('Last call for up to 32% off! ', 'mscore'),
                'placeholder' => esc_html__('Your Text', 'mscore'),
            ]
        );

        $this->add_control(
            'ms_banner_link_switcher',
            [
                'label' => esc_html__('Add Baner link', 'mscore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'mscore'),
                'label_off' => esc_html__('No', 'mscore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'ms_banner_btn_text',
            [
                'label' => esc_html__('Button Text', 'mscore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'mscore'),
                'title' => esc_html__('Enter button text', 'mscore'),
                'label_block' => true,
                'condition' => [
                    'ms_banner_link_switcher' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'ms_banner_link_type',
            [
                'label' => esc_html__('Banner Link Type', 'mscore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'ms_banner_link_switcher' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'ms_banner_link',
            [
                'label' => esc_html__('Banner link', 'mscore'),
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
                    'ms_banner_link_type' => '1',
                    'ms_banner_link_switcher' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'ms_banner_page_link',
            [
                'label' => esc_html__('Select Service Link Page', 'mscore'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => ms_get_all_pages(),
                'condition' => [
                    'ms_banner_link_type' => '2',
                    'ms_banner_link_switcher' => 'yes',
                ]
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
    }

    // style_tab_content
    protected function style_tab_content()
    {

        $this->ms_section_style_controls('services_section', 'Section - Style', '.ms-el-section');

        $this->ms_section_style_controls('services_section_box', 'Box - Style', '.ms-el-box');
        $this->ms_basic_style_controls('services_box_number', 'Box - Subtitle', '.ms-el-box-subtitle');
        $this->ms_basic_style_controls('services_box_title', 'Box - Title', '.ms-el-box-title');
        $this->ms_basic_style_controls('services_box_description', 'Box - Description', '.ms-el-box-desc');
        $this->ms_link_controls_style('pricing_btn', 'Box - Button', '.ms-el-box-btn');
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
            $this->add_render_attribute('title_args', 'class', 'ms-section-title-2 ms-el-title');
        ?>



        <?php else :
            $bloginfo = get_bloginfo('name');
            $this->add_render_attribute('title_args', 'class', 'section__title-7 ms-el-title');

            if (!empty($settings['ms_image']['url'])) {
                $ms_image_url = !empty($settings['ms_image']['id']) ? wp_get_attachment_image_url($settings['ms_image']['id'], $settings['thumbnail_size']) : $settings['ms_image']['url'];
                $ms_image_alt = get_post_meta($settings["ms_image"]["id"], "_wp_attachment_image_alt", true);
            }


            // Link
            if ('2' == $settings['ms_banner_link_type']) {
                $link = get_permalink($settings['ms_banner_page_link']);
                $target = '_self';
                $rel = 'nofollow';
            } else {
                $link = !empty($settings['ms_banner_link']['url']) ? $settings['ms_banner_link']['url'] : '';
                $target = !empty($settings['ms_banner_link']['is_external']) ? '_blank' : '';
                $rel = !empty($settings['ms_banner_link']['nofollow']) ? 'nofollow' : '';
            }
        ?>


            <!-- banner area start -->
            <section class="banner__area ms-el-section">
                <div class="container">
                    <div class="banner__inner include-bg ms-el-box" data-background="<?php echo esc_url($ms_image_url); ?>">
                        <div class="row">
                            <div class="col-xl-5 col-lg-6 col-md-8">
                                <div class="banner__content">


                                    <?php if (!empty($settings['ms_banner_subtitle'])) : ?>
                                        <span class="ms-el-box-subtitle"><?php echo ms_kses($settings['ms_banner_subtitle']); ?></span>
                                    <?php endif; ?>

                                    <?php if (!empty($settings['ms_banner_title'])) : ?>
                                        <h3 class="banner__title ms-el-box-title">
                                            <?php if ($settings['ms_banner_link_switcher'] == 'yes') : ?>
                                                <a href="<?php echo esc_url($link); ?>"><?php echo ms_kses($settings['ms_banner_title']); ?></a>
                                            <?php else : ?>
                                                <?php echo ms_kses($settings['ms_banner_title']); ?>
                                            <?php endif; ?>
                                        </h3>
                                    <?php endif; ?>

                                    <?php if (!empty($settings['ms_banner_desc'])) : ?>
                                        <p class="ms-el-box-desc"><?php echo ms_kses($settings['ms_banner_desc']); ?></p>
                                    <?php endif; ?>

                                    <?php if (!empty($link)) : ?>
                                        <div class="banner__btn">
                                            <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" class="ms-btn ms-el-box-btn">
                                                <?php echo ms_kses($settings['ms_banner_btn_text']); ?>
                                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1 7H13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M7 1L13 7L7 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </a>
                                        </div>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- banner area end -->

        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new MS_Product_Banner());
