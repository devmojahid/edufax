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
class MS_Newsletter extends Widget_Base
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
        return 'ms-newsletter';
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
        return __('MS Newsletter', 'mscore');
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
                    'layout-2' => esc_html__('Layout 2', 'ms-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ms_text_sec',
            [
                'label' => esc_html__('Title & Description', 'mscore'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'ms_text_title',
            [
                'label'       => esc_html__('Title', 'mscore'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Subscribe our Newsletter', 'mscore'),
                'placeholder' => esc_html__('Your Title', 'mscore'),
                'label_block' => true
            ]
        );

        $this->add_control(
            'ms_text_subtitle',
            [
                'label'       => esc_html__('Subtitle', 'mscore'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Sale 20% off all store ', 'mscore'),
                'placeholder' => esc_html__('Your Text', 'mscore'),
            ]
        );

        $this->add_control(
            'ms_subscribe_shape',
            [
                'label'        => esc_html__('Enable BG Shape', 'mscore'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'mscore'),
                'label_off'    => esc_html__('Hide', 'mscore'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'ms_man_shape',
            [
                'label'        => esc_html__('Enable Man Shape', 'mscore'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'mscore'),
                'label_off'    => esc_html__('Hide', 'mscore'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'ms_square_style_switch',
            [
                'label'        => esc_html__('Enable Square Style ?', 'mscore'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'mscore'),
                'label_off'    => esc_html__('Hide', 'mscore'),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ms_subscribe_form_sec',
            [
                'label' => esc_html__('Form Control', 'mscore'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
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
    }

    protected function style_tab_content()
    {
        $this->ms_basic_style_controls('history_title', 'Title', '.ms-el-box-title');
        $this->ms_basic_style_controls('history_list', 'List', '.ms-el-box-list');
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
        $bloginfo = get_bloginfo('name');
?>

        <?php if ($settings['ms_design_style']  == 'layout-2') : ?>


        <?php else :
            $enable_square_style = $settings['ms_square_style_switch'] == 'yes'  ? 'ms-subscribe-square' : '';
        ?>

            <!-- subscribe area start -->
            <section class="ms-subscribe-area <?php echo esc_attr($enable_square_style); ?> pt-70 pb-65 theme-bg p-relative z-index-1">

                <div class="ms-subscribe-shape">
                    <?php if ($settings['ms_subscribe_shape'] == 'yes') : ?>
                        <img class="ms-subscribe-shape-1" src="<?php echo get_template_directory_uri(); ?>/assets/img/subscribe/subscribe-shape-1.png" alt="<?php echo esc_attr($bloginfo); ?>">
                        <img class="ms-subscribe-shape-2" src="<?php echo get_template_directory_uri(); ?>/assets/img/subscribe/subscribe-shape-2.png" alt="<?php echo esc_attr($bloginfo); ?>">
                        <img class="ms-subscribe-shape-3" src="<?php echo get_template_directory_uri(); ?>/assets/img/subscribe/subscribe-shape-3.png" alt="<?php echo esc_attr($bloginfo); ?>">
                    <?php endif; ?>

                    <?php if ($settings['ms_man_shape'] == 'yes') : ?>
                        <img class="ms-subscribe-shape-4" src="<?php echo get_template_directory_uri(); ?>/assets/img/subscribe/subscribe-shape-4.png" alt="<?php echo esc_attr($bloginfo); ?>">
                        <!-- plane shape -->
                        <div class="ms-subscribe-plane">
                            <img class="ms-subscribe-plane-shape" src="<?php echo get_template_directory_uri(); ?>/assets/img/subscribe/plane.png" alt="<?php echo esc_attr($bloginfo); ?>">
                            <svg width="399" height="110" class="d-none d-sm-block" viewBox="0 0 399 110" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.499634 1.00049C8.5 20.0005 54.2733 13.6435 60.5 40.0005C65.6128 61.6426 26.4546 130.331 15 90.0005C-9 5.5 176.5 127.5 218.5 106.5C301.051 65.2247 202 -57.9188 344.5 40.0003C364 53.3997 384 22 399 22" stroke="white" stroke-opacity="0.5" stroke-dasharray="3 3" />
                            </svg>
                            <svg class="d-sm-none" width="193" height="110" viewBox="0 0 193 110" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 1C4.85463 20.0046 26.9085 13.6461 29.9086 40.0095C32.372 61.6569 13.5053 130.362 7.98637 90.0217C-3.57698 5.50061 85.7981 127.53 106.034 106.525C145.807 65.2398 98.0842 -57.9337 166.742 40.0093C176.137 53.412 185.773 22.0046 193 22.0046" stroke="white" stroke-opacity="0.5" stroke-dasharray="3 3" />
                            </svg>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-7 col-lg-7">
                            <div class="ms-subscribe-content">
                                <?php if (!empty($settings['ms_text_subtitle'])) : ?>
                                    <span><?php echo esc_html($settings['ms_text_subtitle']); ?></span>
                                <?php endif; ?>
                                <?php if (!empty($settings['ms_text_title'])) : ?>
                                    <h3 class="ms-subscribe-title"><?php echo esc_html($settings['ms_text_title']); ?></h3>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-5">
                            <div class="ms-subscribe-form">
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
            <!-- subscribe area end -->

        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new MS_Newsletter());
