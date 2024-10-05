<?php

namespace MSCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Control_Media;
use \Elementor\Repeater;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Box_Shadow;
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
class MS_Hero_Banner extends Widget_Base
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
        return 'hero-banner';
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
        return __('Hero Banner', 'ms-core');
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
        return ['ms-core'];
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
        return ['ms-core'];
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
                'label' => esc_html__('Design Layout', 'ms-core'),
            ]
        );
        $this->add_control(
            'ms_design_style',
            [
                'label' => esc_html__('Select Layout', 'ms-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'ms-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'hero_content_sec',
            [
                'label' => esc_html__('Hero Content', 'mscore'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'ms_subtitle_image',
            [
                'label'   => esc_html__('Upload Subtitle Image', 'mscore'),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
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

        $this->add_control(
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

        $this->add_control(
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

        $this->add_control(
            'ms_slider_description',
            [
                'label' => esc_html__('Description', 'mscore'),
                'description' => ms_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('There are many variations of passages of Lorem Ipsum available but the majority have suffered alteration.', 'mscore'),
                'placeholder' => esc_html__('Type section description here', 'mscore'),
            ]
        );

        $this->end_controls_section();


        $this->ms_button_render_controls('tpbtn', 'Button');

        // _ms_image
        $this->start_controls_section(
            '_ms_image_section',
            [
                'label' => esc_html__('BG Image', 'ms-core'),
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

        $this->add_control(
            'ms_offer_image',
            [
                'label' => esc_html__('Choose Offer Image', 'ms-core'),
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
            'ms_slider_shape',
            [
                'label' => esc_html__('Hero Shape Switch', 'mscore'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'ms_slider_shape_switch',
            [
                'label'        => esc_html__('Shape On/Off', 'mscore'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'mscore'),
                'label_off'    => esc_html__('Hide', 'mscore'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->end_controls_section();
    }


    // style_tab_content
    protected function style_tab_content()
    {
        $this->ms_section_style_controls('hero_section', 'Section - Style', '.ms-el-section');
        $this->ms_section_style_controls('hero_section_box', 'Box - Style', '.ms-el-section-box');

        $this->ms_basic_style_controls('hero_subtitle', 'Hero - Subtitle', '.ms-el-subtitle');
        $this->ms_basic_style_controls('hero_title', 'Hero - Title', '.ms-el-title');
        $this->ms_basic_style_controls('hero_description', 'Hero - Description', '.ms-el-content > p');


        $this->ms_link_controls_style('hero_button', 'Hero - Button', '.ms-el-box-btn');
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

            $bloginfo = get_bloginfo('name');
            $this->add_render_attribute('title_args', 'class', 'slider__title-2 ms-el-title');

        ?>


        <?php else :
            // main img
            if (!empty($settings['ms_image']['url'])) {
                $ms_image = !empty($settings['ms_image']['id']) ? wp_get_attachment_image_url($settings['ms_image']['id'], $settings['ms_image_size_size']) : $settings['ms_image']['url'];
                $ms_image_alt = get_post_meta($settings["ms_image"]["id"], "_wp_attachment_image_alt", true);
            }

            // main img offer 
            if (!empty($settings['ms_offer_image']['url'])) {
                $ms_offer_image = !empty($settings['ms_offer_image']['id']) ? wp_get_attachment_image_url($settings['ms_offer_image']['id'], $settings['ms_image_size_size']) : $settings['ms_offer_image']['url'];
                $ms_offer_image_alt = get_post_meta($settings["ms_offer_image"]["id"], "_wp_attachment_image_alt", true);
            }

            // subtitle img
            if (!empty($settings['ms_subtitle_image']['url'])) {
                $ms_subtitle_image = !empty($settings['ms_subtitle_image']['id']) ? wp_get_attachment_image_url($settings['ms_subtitle_image']['id'], $settings['ms_image_size_size']) : $settings['ms_subtitle_image']['url'];
                $ms_subtitle_image_alt = get_post_meta($settings["ms_subtitle_image"]["id"], "_wp_attachment_image_alt", true);
            }

            $this->ms_link_controls_render('tpbtn', 'ms-btn-green', $this->get_settings());

            $bloginfo = get_bloginfo('name');
            $this->add_render_attribute('title_args', 'class', 'ms-slider-title-5 ms-el-title');
        ?>

            <!-- slider area start -->
            <section class="ms-slider-area p-relative z-index-1 fix">
                <div class="ms-slider-active-5s swiper-containers">
                    <div class="swiper-wrappers">
                        <div class="ms-slider-item-5 scene ms-slider-height-5 swiper-slide d-flex align-items-center" data-bg-color="#F3F3F3">

                            <?php if ($settings['ms_slider_shape_switch'] == 'yes') : ?>
                                <div class="ms-slider-shape-5 ">
                                    <div class="ms-slider-shape-5-1">
                                        <img class="layer" data-depth=".2" src="<?php echo get_template_directory_uri(); ?>/assets/img/slider/5/shape/shape-1.png" alt="<?php echo esc_attr($bloginfo); ?>">
                                    </div>
                                    <div class="ms-slider-shape-5-2">
                                        <img class="layer" data-depth=".2" src="<?php echo get_template_directory_uri(); ?>/assets/img/slider/5/shape/shape-2.png" alt="<?php echo esc_attr($bloginfo); ?>">
                                    </div>
                                    <div class="ms-slider-shape-5-3">
                                        <img class="layer" data-depth=".2" src="<?php echo get_template_directory_uri(); ?>/assets/img/slider/5/shape/shape-3.png" alt="<?php echo esc_attr($bloginfo); ?>">
                                    </div>
                                    <div class="ms-slider-shape-5-4">
                                        <img class="layer" data-depth=".2" src="<?php echo get_template_directory_uri(); ?>/assets/img/slider/5/shape/shape-4.png" alt="<?php echo esc_attr($bloginfo); ?>">
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="container">
                                <div class="row align-items-center">
                                    <div class="col-xxl-7 col-xl-7 col-lg-6">
                                        <div class="ms-slider-content-5 p-relative z-index-1">

                                            <?php if (!empty($ms_subtitle_image)) : ?>
                                                <div class="ms-slider-subtitle-img">
                                                    <img src="<?php echo esc_url($ms_subtitle_image); ?>" alt="<?php echo esc_attr($ms_subtitle_image_alt); ?>">
                                                </div>
                                            <?php endif; ?>

                                            <?php if (!empty($settings['ms_slider_sub_title'])) : ?>
                                                <span class="ms-slider-subtitle-4 ms-el-subtitle"><?php echo ms_kses($settings['ms_slider_sub_title']); ?></span>
                                            <?php endif; ?>

                                            <?php
                                            if (!empty($settings['ms_slider_title'])) :
                                                printf(
                                                    '<%1$s %2$s>%3$s</%1$s>',
                                                    tag_escape($settings['ms_slider_title_tag']),
                                                    $this->get_render_attribute_string('title_args'),
                                                    ms_kses($settings['ms_slider_title'])
                                                );
                                            endif;
                                            ?>

                                            <?php if (!empty($settings['ms_slider_description'])) : ?>
                                                <p><?php echo ms_kses($settings['ms_slider_description']); ?></p>
                                            <?php endif; ?>

                                            <!-- button start -->
                                            <?php if ($settings['ms_' . $control_id . '_button_show'] == 'yes') : ?>
                                                <div class="ms-slider-btn-5">
                                                    <a <?php echo $this->get_render_attribute_string('ms-button-arg'); ?>> <?php echo $settings['ms_' . $control_id . '_text']; ?> </a>
                                                </div>
                                            <?php endif; ?>
                                            <!-- button end -->

                                        </div>
                                    </div>
                                    <div class="col-xxl-5 col-xl-5 col-lg-6">
                                        <div class="ms-slider-thumb-wrapper-5 p-relative">

                                            <?php if (!empty($ms_offer_image)) : ?>
                                                <div class="ms-slider-thumb-shape-5 one d-none d-sm-block">
                                                    <img data-depth="0.1" class="layer offer" src="<?php echo esc_url($ms_offer_image); ?>" alt="<?php echo esc_attr($ms_offer_image_alt); ?>">
                                                </div>
                                            <?php endif; ?>

                                            <div class="ms-slider-thumb-5 main-img">
                                                <img data-depth="0.2" class="layer" src="<?php echo esc_url($ms_image); ?>" alt="<?php echo esc_attr($ms_image_alt); ?>">
                                                <span class="ms-slider-thumb-5-gradient"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- slider area end -->


        <?php endif; ?>

<?php

    }
}

$widgets_manager->register(new MS_Hero_Banner());
