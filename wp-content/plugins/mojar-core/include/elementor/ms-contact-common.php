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
class MS_Contact_Common extends Widget_Base
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
        return 'ms-contact-common';
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
        return __('MS Common Contact', 'mscore');
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


    public function get_ms_contact_form()
    {
        if (!class_exists('WPCF7')) {
            return;
        }
        $ms_cfa         = array();
        $ms_cf_args     = array('posts_per_page' => -1, 'post_type' => 'wpcf7_contact_form');
        $ms_forms       = get_posts($ms_cf_args);
        $ms_cfa         = ['0' => esc_html__('Select Form', 'mscore')];
        if ($ms_forms) {
            foreach ($ms_forms as $ms_form) {
                $ms_cfa[$ms_form->ID] = $ms_form->post_title;
            }
        } else {
            $ms_cfa[esc_html__('No contact form found', 'mscore')] = 0;
        }
        return $ms_cfa;
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
            'mscore_contact',
            [
                'label' => esc_html__('Contact Form', 'mscore'),
            ]
        );

        $this->add_control(
            'mscore_select_contact_form',
            [
                'label'   => esc_html__('Select Form', 'mscore'),
                'type'    => Controls_Manager::SELECT,
                'default' => '0',
                'options' => $this->get_ms_contact_form(),
            ]
        );

        $this->end_controls_section();


        // ms_section_title
        $this->start_controls_section(
            'ms_section_title',
            [
                'label' => esc_html__('Title & Content', 'mscore'),
            ]
        );

        $this->add_control(
            'ms_section_title_show',
            [
                'label' => esc_html__('Section Title & Content', 'mscore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'mscore'),
                'label_off' => esc_html__('Hide', 'mscore'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'ms_sub_title',
            [
                'label' => esc_html__('Sub Title', 'mscore'),
                'description' => ms_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('MS Sub Title', 'mscore'),
                'placeholder' => esc_html__('Type Sub Heading Text', 'mscore'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'ms_title',
            [
                'label' => esc_html__('Title', 'mscore'),
                'description' => ms_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('MS Title Here', 'mscore'),
                'placeholder' => esc_html__('Type Heading Text', 'mscore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'ms_description',
            [
                'label' => esc_html__('Description', 'mscore'),
                'description' => ms_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('MS section description here', 'mscore'),
                'placeholder' => esc_html__('Type section description here', 'mscore'),
            ]
        );

        $this->add_control(
            'ms_title_tag',
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

        $this->add_responsive_control(
            'ms_align',
            [
                'label' => esc_html__('Alignment', 'mscore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'mscore'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'mscore'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'mscore'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => false,
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};'
                ]
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'ms_job_contact_btn_sec',
            [
                'label' => esc_html__('Button', 'mscore'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'ms_design_style' => 'layout-2'
                ]
            ]
        );


        $this->add_control(
            'ms_btn_button_show',
            [
                'label' => esc_html__('Show Button', 'mscore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'mscore'),
                'label_off' => esc_html__('Hide', 'mscore'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'ms_btn_text',
            [
                'label' => esc_html__('Button Text', 'mscore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'mscore'),
                'title' => esc_html__('Enter button text', 'mscore'),
                'label_block' => true,
                'condition' => [
                    'ms_btn_button_show' => 'yes'
                ],
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'ms_contact_info_sec',
            [
                'label' => esc_html__('Box Title & Content', 'mscore'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'ms_design_style' => 'layout-3'
                ]
            ]
        );

        $this->add_control(
            'ms_contact_info_title',
            [
                'label'       => esc_html__('Title', 'mscore'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Send Us a Mail', 'mscore'),
                'placeholder' => esc_html__('Your Text', 'mscore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'ms_contact_info_desc',
            [
                'label'       => esc_html__('Description', 'mscore'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'rows'        => 10,
                'default'     => esc_html__('Do you have a query about your order, or need a hand with getting your products set up?', 'mscore'),
                'placeholder' => esc_html__('Your Text', 'mscore'),
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'ms_contact_box_sec',
            [
                'label' => esc_html__('Info Box', 'mscore'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'ms_design_style' => 'layout-3'
                ]
            ]
        );

        $this->add_control(
            'ms_contact_box_title',
            [
                'label'       => esc_html__('Title', 'mscore'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Reach Out', 'mscore'),
                'placeholder' => esc_html__('Your Text', 'mscore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'ms_contact_box_desc',
            [
                'label'       => esc_html__('Description', 'mscore'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'rows'        => 10,
                'default'     => esc_html__('Any confusion about your order? We are here to help 24/7', 'mscore'),
                'placeholder' => esc_html__('Your Text', 'mscore'),
            ]
        );

        $this->add_control(
            'ms_contact_info_note',
            [
                'label'       => esc_html__('Additional Info', 'mscore'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'rows'        => 10,
                'default'     => esc_html__('See our Refund Policies or FAQ', 'mscore'),
                'placeholder' => esc_html__('Your Text', 'mscore'),
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
            'ms_contact_box_title',
            [
                'label'   => esc_html__('Conact Title', 'mscore'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Contact Us', 'mscore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'ms_contact_type',
            [
                'label'   => esc_html__('Select Type', 'mscore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'default'  => esc_html__('Default', 'mscore'),
                    'email'  => esc_html__('Email', 'mscore'),
                    'phone'  => esc_html__('Phone', 'mscore'),
                    'map'  => esc_html__('Map', 'mscore'),
                ],
                'default' => 'default',
            ]
        );

        $repeater->add_control(
            'ms_contact_box_title_url',
            [
                'label'   => esc_html__('URL', 'mscore'),
                'type'        => \Elementor\Controls_Manager::URL,
                'default'     => [
                    'url'               => '#',
                    'is_external'       => true,
                    'nofollow'          => true,
                    'custom_attributes' => '',
                ],
                'placeholder' => esc_html__('Your URL', 'mscore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'enable_underline_style',
            [
                'label'        => esc_html__('Enable Underline Style', 'mscore'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'mscore'),
                'label_off'    => esc_html__('Hide', 'mscore'),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );



        $repeater->add_control(
            'ms_contact_map_url',
            [
                'label'   => esc_html__('Map URL', 'mscore'),
                'type'        => \Elementor\Controls_Manager::URL,
                'default'     => [
                    'url'               => '#',
                    'is_external'       => true,
                    'nofollow'          => true,
                    'custom_attributes' => '',
                ],
                'placeholder' => esc_html__('Your URL', 'mscore'),
                'label_block' => true,
                'condition' => [
                    'ms_contact_type' => 'map'
                ]
            ]
        );

        $this->add_control(
            'ms_contact_box_list',
            [
                'label'       => esc_html__('Info List', 'mscore'),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'ms_contact_box_title'   => esc_html__('Start Chat', 'mscore'),
                    ],
                ],
                'title_field' => '{{{ ms_contact_box_title }}}',
            ]
        );

        $this->end_controls_section();


        $this->ms_section_style_controls('comint_section', 'Section - Style', '.ms-el-section');
        $this->ms_basic_style_controls('about_subtitle', 'Section - Subtitle', '.ms-el-subtitle');
        $this->ms_basic_style_controls('about_title', 'Section - Title', '.ms-el-title');
        $this->ms_basic_style_controls('about_description', 'Section - Description', '.ms-el-content p');

        $this->ms_basic_style_controls('section_subtitle', 'Contact - Title', '.ms-el-contact-title');
        $this->ms_basic_style_controls('section_contact_desc', 'Contact - Description', '.ms-el-contact-desc');

        $this->ms_icon_style('section_icon', 'Box - Icon', '.ms-el-box-icon');
        $this->ms_basic_style_controls('section_title', 'Box - Title', '.ms-el-box-title');
        $this->ms_basic_style_controls('section_desc', 'Box - Description', '.ms-el-box-desc');
        $this->ms_basic_style_controls('section_info', 'Box - Info', '.ms-el-box-info p');
        $this->ms_basic_style_controls('section_note', 'Box - Note', '.ms-el-box-note p');

        $this->ms_input_controls_style('contact_input', 'Box - Input', '.ms-el-contact-input input', '.ms-el-contact-input textarea');
        $this->ms_link_controls_style('contact_btn', 'Box - Button', '.ms-el-contact-input-btn button');
        $this->ms_link_controls_style('contact_btn_btn', 'Box - Button', '.ms-el-box-btn');
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
            $this->add_render_attribute('title_args', 'class', 'job__form-title ms-el-title');
        ?>

            <!-- job details area start -->
            <section class="job__details-area ms-el-section">
                <div class="container">
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="job__details-wrapper">
                                <?php if (!empty($settings['ms_btn_text'])) : ?>
                                    <div class="job__details-btn">
                                        <button type="button" class="ms-btn job-form-open-btn ms-el-box-btn"><?php echo $settings['ms_btn_text']; ?></button>
                                    </div>
                                <?php endif; ?>
                                <div class="job__form job-apply-form mt-40 ms-el-content ms-el-contact-input ms-el-contact-input-btn">
                                    <?php if (!empty($settings['ms_section_title_show'])) : ?>

                                        <?php if (!empty($settings['ms_sub_title'])) : ?>
                                            <span class="faq__title-pre ms-el-subtitle">
                                                <?php echo ms_kses($settings['ms_sub_title']); ?>
                                            </span>
                                        <?php endif; ?>

                                        <?php
                                        if (!empty($settings['ms_title'])) :
                                            printf(
                                                '<%1$s %2$s>%3$s</%1$s>',
                                                tag_escape($settings['ms_title_tag']),
                                                $this->get_render_attribute_string('title_args'),
                                                ms_kses($settings['ms_title'])
                                            );
                                        endif;
                                        ?>
                                        <?php if (!empty($settings['ms_description'])) : ?>
                                            <p><?php echo ms_kses($settings['ms_description']); ?></p>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <!-- form here -->
                                    <?php if (!empty($settings['mscore_select_contact_form'])) : ?>
                                        <?php echo do_shortcode('[contact-form-7  id="' . $settings['mscore_select_contact_form'] . '"]'); ?>

                                    <?php else : ?>
                                        <?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'mscore') . '</p></div>'; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- job details area emd -->


        <?php elseif ($settings['ms_design_style']  == 'layout-3') :
            $this->add_render_attribute('title_args', 'class', 'ms-section-title-2 ms-el-title');
        ?>

            <!-- contact area start -->
            <section class="contact__area grey-bg-4 pb-120 pt-110 ms-el-section">
                <div class="container">
                    <?php if (!empty($settings['ms_section_title_show'])) : ?>
                        <div class="row justify-content-center">
                            <div class="col-xl-7 col-lg-8">
                                <div class="ms-section-wrapper-2 text-center mb-70 ms-el-subtitle">
                                    <?php if (!empty($settings['ms_sub_title'])) : ?>
                                        <span class="faq__title-pre ms-el-subtitle">
                                            <?php echo ms_kses($settings['ms_sub_title']); ?>
                                        </span>
                                    <?php endif; ?>

                                    <?php
                                    if (!empty($settings['ms_title'])) :
                                        printf(
                                            '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape($settings['ms_title_tag']),
                                            $this->get_render_attribute_string('title_args'),
                                            ms_kses($settings['ms_title'])
                                        );
                                    endif;
                                    ?>
                                    <?php if (!empty($settings['ms_description'])) : ?>
                                        <p><?php echo ms_kses($settings['ms_description']); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-xl-4 col-lg-4">
                            <div class="contact__wrapper-2">
                                <div class="contact__content-2">
                                    <?php if (!empty($settings['ms_contact_info_title'])) : ?>
                                        <h3 class="contact-title ms-el-contact-title"><?php echo ms_kses($settings['ms_contact_info_title']); ?></h3>
                                    <?php endif; ?>

                                    <?php if (!empty($settings['ms_contact_info_desc'])) : ?>
                                        <p class="ms-el-contact-desc"><?php echo ms_kses($settings['ms_contact_info_desc']); ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="contact__info-box">

                                    <?php if (!empty($settings['ms_contact_box_title'])) : ?>
                                        <h3 class="contact__info-box-title ms-el-box-title"><?php echo ms_kses($settings['ms_contact_box_title']); ?></h3>
                                    <?php endif; ?>

                                    <?php if (!empty($settings['ms_contact_box_desc'])) : ?>
                                        <p class="ms-el-box-desc"><?php echo ms_kses($settings['ms_contact_box_desc']); ?></p>
                                    <?php endif; ?>

                                    <div class="contact__info-item-wrapper d-flex flex-wrap align-items-center">

                                        <?php foreach ($settings['ms_contact_box_list'] as $key => $item) :

                                            $enable_underline_style = ($item['enable_underline_style'] == 'yes') ? 'has-fw-400' : '';
                                        ?>

                                            <div class="contact__info-item">
                                                <div class="contact__info-icon ms-el-box-icon">
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
                                                <div class="contact__info-content ms-el-box-info <?php echo esc_attr($enable_underline_style); ?>">
                                                    <?php if ($item['ms_contact_type'] == 'email') : ?>
                                                        <p><a href="mailto:<?php echo esc_url($item['ms_contact_box_title_url']['url']); ?>"><?php echo esc_html($item['ms_contact_box_title']); ?></a></p>

                                                    <?php elseif ($item['ms_contact_type'] == 'phone') : ?>
                                                        <p><a href="tel:<?php echo esc_url($item['ms_contact_box_title_url']['url']); ?>"><?php echo esc_html($item['ms_contact_box_title']); ?></a></p>

                                                    <?php elseif ($item['ms_contact_type'] == 'map') : ?>
                                                        <p><a href="<?php echo esc_url($item['ms_contact_map_url']['url']); ?>" target="_blank"><?php echo esc_html($item['ms_contact_box_title']); ?></a></p>

                                                    <?php else : ?>
                                                        <p><a href="<?php echo esc_url($item['ms_contact_box_title_url']['url']); ?>" target="_blank"><?php echo esc_html($item['ms_contact_box_title']); ?></a></p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                        <?php endforeach; ?>
                                    </div>

                                    <?php if (!empty($settings['ms_contact_info_note'])) : ?>
                                        <div class="contact__info-box-refund ms-el-box-note">
                                            <p><?php echo ms_kses($settings['ms_contact_info_note']); ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-8">
                            <div class="contact__form-3 ml-70 ms-el-contact-input ms-el-contact-input-btn">
                                <?php if (!empty($settings['mscore_select_contact_form'])) : ?>
                                    <?php echo do_shortcode('[contact-form-7  id="' . $settings['mscore_select_contact_form'] . '"]'); ?>
                                <?php else : ?>
                                    <?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'mscore') . '</p></div>'; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- contact area end -->

        <?php else :
            $this->add_render_attribute('title_args', 'class', 'portfolio__comment-title ms-el-title');
        ?>


            <!-- portfolio comment area start -->
            <section class="portfolio__comment grey-bg-7 pt-90 pb-105 ms-el-section">
                <div class="container">
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="portfolio__comment-top ms-el-content">
                                <?php if (!empty($settings['ms_sub_title'])) : ?>
                                    <span class="ms-sub-title mb-15 ms-el-subtitle"><?php echo ms_kses($settings['ms_sub_title']); ?></span>
                                <?php endif; ?>
                                <?php
                                if (!empty($settings['ms_title'])) :
                                    printf(
                                        '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape($settings['ms_title_tag']),
                                        $this->get_render_attribute_string('title_args'),
                                        ms_kses($settings['ms_title'])
                                    );
                                endif;
                                ?>
                                <?php if (!empty($settings['ms_description'])) : ?>
                                    <p><?php echo ms_kses($settings['ms_description']); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="portfolio__comment-form ms-el-contact-input ms-el-contact-input-btn">
                                <?php if (!empty($settings['mscore_select_contact_form'])) : ?>
                                    <?php echo do_shortcode('[contact-form-7  id="' . $settings['mscore_select_contact_form'] . '"]'); ?>
                                <?php else : ?>
                                    <?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'mscore') . '</p></div>'; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- portfolio comment area end -->

        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new MS_Contact_Common());
