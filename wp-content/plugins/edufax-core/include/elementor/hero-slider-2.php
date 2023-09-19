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
class MS_Hero_Slider_2 extends Widget_Base
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
        return 'ms-slider-2';
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
        return __('Hero Slider 2', 'mscore');
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
            'ms_slider_nav_image',
            [
                'label'   => esc_html__('Upload Nav Image', 'mscore'),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
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
            'ms_slider_nav_title',
            [
                'label' => esc_html__('Navigation Title', 'mscore'),
                'description' => ms_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Diamond  Necklaces', 'mscore'),
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
            'ms_slider_video_url',
            [
                'label'   => esc_html__('Video URL', 'mscore'),
                'type'        => \Elementor\Controls_Manager::URL,
                'default'     => [
                    'url'               => '#',
                    'is_external'       => true,
                    'nofollow'          => true,
                    'custom_attributes' => '',
                ],
                'placeholder' => esc_html__('Placeholder Text', 'mscore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'ms_slider_video_text_image',
            [
                'label'   => esc_html__('Video Button Text Image', 'mscore'),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
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
                    [
                        'ms_slider_title' => esc_html__('Technology.', 'mscore')
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

        <?php else :
            $bloginfo = get_bloginfo('name');
        ?>

            <!-- slider area start -->
            <section class="ms-slider-area p-relative z-index-1 fix">
                <div class="ms-slider-active-4 khaki-bg">
                    <?php foreach ($settings['slider_list'] as $item) :
                        $this->add_render_attribute('title_args', 'class', 'ms-slider-title-4 ms-el-title');

                        if (!empty($item['ms_slider_image']['url'])) {
                            $ms_slider_image_url = !empty($item['ms_slider_image']['id']) ? wp_get_attachment_image_url($item['ms_slider_image']['id'], $settings['thumbnail_size']) : $item['ms_slider_image']['url'];
                            $ms_slider_image_alt = get_post_meta($item["ms_slider_image"]["id"], "_wp_attachment_image_alt", true);
                        }

                        if (!empty($item['ms_slider_video_text_image']['url'])) {
                            $ms_slider_video_text_image_url = !empty($item['ms_slider_video_text_image']['id']) ? wp_get_attachment_image_url($item['ms_slider_video_text_image']['id'], $settings['thumbnail_size']) : $item['ms_slider_video_text_image']['url'];
                            $ms_slider_video_text_image_alt = get_post_meta($item["ms_slider_video_text_image"]["id"], "_wp_attachment_image_alt", true);
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
                        <div class="ms-slider-item-4 ms-slider-height-4 p-relative khaki-bg">

                            <div class="ms-slider-thumb-4">

                                <img src="<?php echo esc_url($ms_slider_image_url); ?>" alt="<?php echo esc_attr($ms_slider_image_alt); ?>">

                                <?php if ($settings['ms_slider_shape'] == 'yes') : ?>
                                    <div class="ms-slider-thumb-4-shape">
                                        <span class="ms-slider-thumb-4-shape-1"></span>
                                        <span class="ms-slider-thumb-4-shape-2"></span>
                                    </div>
                                <?php endif; ?>

                            </div>

                            <?php if (!empty($item['ms_slider_video_url']['url'])) : ?>
                                <div class="ms-slider-video-wrapper">

                                    <!-- video -->
                                    <div class="ms-slider-video transition-3">
                                        <video loop>
                                            <source type="video/mp4" src="<?php echo esc_url($item['ms_slider_video_url']['url']); ?>#t=3">
                                        </video>
                                    </div>
                                    <!-- video button -->

                                    <div class="ms-slider-play">

                                        <button type="button" class="ms-slider-play-btn ms-slider-video-move-btn ms-video-toggle-btn">
                                            <img class="text-shape" src="<?php echo esc_url($ms_slider_video_text_image_url) ?>" alt="<?php echo esc_attr($ms_slider_video_text_image_alt); ?>">
                                            <span class="play-icon">
                                                <svg width="19" height="21" viewBox="0 0 19 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M0.607695 20.7988L0.607695 0.0142176L18.6077 10.4065L0.607695 20.7988Z" fill="currentColor" />
                                                </svg>
                                            </span>
                                            <span class="pause-icon">
                                                <svg width="15" height="20" viewBox="0 0 15 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect width="5" height="20" fill="currentColor" />
                                                    <rect x="10" width="5" height="20" fill="currentColor" />
                                                </svg>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="container">
                                <div class="row align-items-center">
                                    <div class="col-xl-7 col-lg-6 col-md-8">
                                        <div class="ms-slider-content-4 p-relative z-index-1">

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
                                                <div class="ms-slider-btn-4">
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

                <?php if ($settings['ms_slider_arrows_enable'] == 'yes') : ?>
                    <div class="ms-slider-arrow-4"></div>
                <?php endif; ?>

                <div class="ms-slider-nav-wrapper d-none d-xl-block">
                    <div class="container">
                        <div class="ms-slider-nav">
                            <div class="ms-slider-nav-active">
                                <?php foreach ($settings['slider_list'] as $item) :
                                    $this->add_render_attribute('nav_title_args', 'class', 'ms-slider-nav-title ms-el-title');

                                    if (!empty($item['ms_slider_nav_image']['url'])) {
                                        $ms_slider_nav_image_url = !empty($item['ms_slider_nav_image']['id']) ? wp_get_attachment_image_url($item['ms_slider_nav_image']['id'], $settings['thumbnail_size']) : $item['ms_slider_nav_image']['url'];
                                        $ms_slider_nav_image_alt = get_post_meta($item["ms_slider_nav_image"]["id"], "_wp_attachment_image_alt", true);
                                    }

                                ?>
                                    <div class="ms-slider-nav-item d-flex align-items-center">

                                        <div class="ms-slider-nav-icon">
                                            <span>
                                                <img src="<?php echo esc_url($ms_slider_nav_image_url) ?>" alt="<?php echo esc_attr($ms_slider_nav_image_alt); ?>">
                                            </span>
                                        </div>

                                        <div class="ms-slider-nav-content">

                                            <?php
                                            if ($item['ms_slider_title_tag']) :
                                                printf(
                                                    '<%1$s %2$s>%3$s</%1$s>',
                                                    tag_escape($item['ms_slider_title_tag']),
                                                    $this->get_render_attribute_string('nav_title_args'),
                                                    ms_kses($item['ms_slider_nav_title'])
                                                );
                                            endif;
                                            ?>
                                        </div>

                                    </div>
                                <?php endforeach; ?>
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

$widgets_manager->register(new MS_Hero_Slider_2());
