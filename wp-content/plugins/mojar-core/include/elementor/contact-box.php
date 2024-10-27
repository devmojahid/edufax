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
 * Elementor widget for contact box.
 *
 * @since 1.0.0
 */
class MS_Contact_Box extends Widget_Base
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
        return 'contact-page';
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
        return __('Contact Page', 'mscore');
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
     * contact form 7 setup.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access protected
     */

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
        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Content', 'mscore'),
            ]
        );

        $this->add_control(
            'section_title',
            [
                'label' => __('Section Title', 'mscore'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Get In Touch With Us', 'mscore'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'icon',
            [
                'label' => __('Icon', 'mscore'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-envelope',
                    'library' => 'solid',
                ],
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label' => __('Title', 'mscore'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Email', 'mscore'),
            ]
        );

        $repeater->add_control(
            'subtitle',
            [
                'label' => __('Subtitle', 'mscore'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Our friendly team is here to help.', 'mscore'),
            ]
        );

        $repeater->add_control(
            'info',
            [
                'label' => __('Information', 'mscore'),
                'type' => Controls_Manager::TEXT,
                'default' => __('example@gmail.com', 'mscore'),
            ]
        );

        $this->add_control(
            'contact_info_items',
            [
                'label' => __('Contact Info Items', 'mscore'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'icon' => [
                            'value' => 'fas fa-envelope',
                            'library' => 'solid',
                        ],
                        'title' => __('Email', 'mscore'),
                        'subtitle' => __('Our friendly team is here to help.', 'mscore'),
                        'info' => __('example@gmail.com', 'mscore'),
                    ],
                    [
                        'icon' => [
                            'value' => 'fas fa-map-marker-alt',
                            'library' => 'solid',
                        ],
                        'title' => __('Office', 'mscore'),
                        'subtitle' => __('Come say hello at our office.', 'mscore'),
                        'info' => __('8502 Preston Rd. Maine 98380, USA', 'mscore'),
                    ],
                    [
                        'icon' => [
                            'value' => 'fas fa-phone-alt',
                            'library' => 'solid',
                        ],
                        'title' => __('Phone', 'mscore'),
                        'subtitle' => __('Mon-Fri from 8am to 5pm.', 'mscore'),
                        'info' => __('+088 (246) 642-27', 'mscore'),
                    ],
                    [
                        'icon' => [
                            'value' => 'fas fa-clock',
                            'library' => 'solid',
                        ],
                        'title' => __('Working Hours', 'mscore'),
                        'subtitle' => __('Satday to Friday:', 'mscore'),
                        'info' => __('09:00am - 10:00pm', 'mscore'),
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_form',
            [
                'label' => __('Contact Form', 'mscore'),
            ]
        );

        $this->add_control(
            'form_shortcode',
            [
                'label' => __('Contact Form Shortcode', 'mscore'),
                'type'    => Controls_Manager::SELECT,
                'default' => '0',
                'options' => $this->get_ms_contact_form(),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_map',
            [
                'label' => __('Map', 'mscore'),
            ]
        );

        $this->add_control(
            'map_iframe',
            [
                'label' => __('Map iFrame', 'mscore'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d58404.90712306111!2d90.33188860263257!3d23.807690708042205!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8b087026b81%3A0x8fa563bbdd5904c2!2sDhaka!5e0!3m2!1sen!2sbd!4v1685520321950!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style',
            [
                'label' => __('Style', 'mscore'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'section_title_color',
            [
                'label' => __('Section Title Color', 'mscore'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tf__contact_page h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'info_box_bg_color',
            [
                'label' => __('Info Box Background Color', 'mscore'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tf__contact_info' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'info_box_icon_color',
            [
                'label' => __('Info Box Icon Color', 'mscore'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tf__contact_info i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'info_box_title_color',
            [
                'label' => __('Info Box Title Color', 'mscore'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tf__contact_info h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'info_box_subtitle_color',
            [
                'label' => __('Info Box Subtitle Color', 'mscore'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tf__contact_info span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'info_box_text_color',
            [
                'label' => __('Info Box Text Color', 'mscore'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tf__contact_info p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
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
<section class="tf__contact_page pt_110 xs_pt_70 pb_120 xs_pb_80">
    <div class="container">
        <div class="row">
            <h2><?php echo esc_html($settings['section_title']); ?></h2>
            <div class="col-xl-6">
                <div class="row">
                    <?php foreach ($settings['contact_info_items'] as $item) : ?>
                    <div class="col-xl-6 col-md-6 wow fadeInUp" data-wow-duration="1s">
                        <div class="tf__contact_info">
                            <?php \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true']); ?>
                            <h3><?php echo esc_html($item['title']); ?></h3>
                            <span><?php echo esc_html($item['subtitle']); ?></span>
                            <p><?php echo esc_html($item['info']); ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-xl-6 wow fadeInRight" data-wow-duration="1s">
                <?php if (!empty($settings['form_shortcode'])) : ?>
                <?php echo do_shortcode('[contact-form-7  id="' . $settings['form_shortcode'] . '"]'); ?>
                <?php else : ?>
                <?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'mscore') . '</p></div>'; ?>
                <?php endif; ?>
            </div>
            <div class="col-12 wow fadeInUp" data-wow-duration="1s">
                <div class="tf__contact_map mt_120 xs_mt_80">
                    <?php echo $settings['map_iframe']; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
    }
}

$widgets_manager->register(new MS_Contact_Box());