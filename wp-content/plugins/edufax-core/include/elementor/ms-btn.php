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
class MS_Btn extends Widget_Base
{

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
        return 'ms-btn';
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
        return __('MS BTN', 'mscore');
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

        // ms_btn_button_group
        $this->start_controls_section(
            'ms_btn_button_group',
            [
                'label' => esc_html__('Button', 'mscore'),
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
        $this->add_control(
            'ms_btn_link_type',
            [
                'label' => esc_html__('Button Link Type', 'mscore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'label_block' => true,
                'condition' => [
                    'ms_btn_button_show' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'ms_btn_link',
            [
                'label' => esc_html__('Button link', 'mscore'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'mscore'),
                'show_external' => false,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'condition' => [
                    'ms_btn_link_type' => '1',
                    'ms_btn_button_show' => 'yes'
                ],
                'label_block' => true,
            ]
        );
        $this->add_control(
            'ms_btn_page_link',
            [
                'label' => esc_html__('Select Button Page', 'mscore'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => ms_get_all_pages(),
                'condition' => [
                    'ms_btn_link_type' => '2',
                    'ms_btn_button_show' => 'yes'
                ]
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
            // Link
            if ('2' == $settings['ms_btn_link_type']) {
                $this->add_render_attribute('ms-button-arg', 'href', get_permalink($settings['ms_btn_page_link']));
                $this->add_render_attribute('ms-button-arg', 'target', '_self');
                $this->add_render_attribute('ms-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('ms-button-arg', 'class', 'ms-btn ms-btn-border');
            } else {
                if (!empty($settings['ms_btn_link']['url'])) {
                    $this->add_link_attributes('ms-button-arg', $settings['ms_btn_link']);
                    $this->add_render_attribute('ms-button-arg', 'class', 'ms-btn ms-btn-border');
                }
            }
        ?>

        <?php else :
            // Link
            if ('2' == $settings['ms_btn_link_type']) {
                $this->add_render_attribute('ms-button-arg', 'href', get_permalink($settings['ms_btn_page_link']));
                $this->add_render_attribute('ms-button-arg', 'target', '_self');
                $this->add_render_attribute('ms-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('ms-button-arg', 'class', 'ms-btn-border-9');
            } else {
                if (!empty($settings['ms_btn_link']['url'])) {
                    $this->add_link_attributes('ms-button-arg', $settings['ms_btn_link']);
                    $this->add_render_attribute('ms-button-arg', 'class', 'ms-btn-border-9');
                }
            }
        ?>

            <?php if (!empty($settings['ms_btn_text'])) : ?>
                <div class="blog__more-10 text-center wow fadeInUp" data-wow-delay=".9s" data-wow-duration="1s">
                    <a <?php echo $this->get_render_attribute_string('ms-button-arg'); ?>><?php echo $settings['ms_btn_text']; ?> <i class="fa-regular fa-angle-right"></i></a>
                </div>
            <?php endif; ?>

        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new MS_Btn());
