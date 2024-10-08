<?php

namespace MSCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;
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
class MS_About extends Widget_Base
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
        return 'about';
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
        return __('About', 'ms-core');
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

        $this->ms_section_title_render_controls('about', 'Section Title');


        // _ms_image
        $this->start_controls_section(
            '_ms_image',
            [
                'label' => esc_html__('Thumbnail', 'ms-core'),
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
            'ms_image_2',
            [
                'label' => esc_html__('Choose Image 2', 'ms-core'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        $this->end_controls_section();

        $this->ms_button_render_controls('tpbtn', 'Button', ['layout-1']);
    }

    // style_tab_content
    protected function style_tab_content()
    {

        $this->ms_section_style_controls('about_section', 'Section - Style', '.ms-el-section');
        $this->ms_basic_style_controls('about_subtitle', 'About - Subtitle', '.ms-el-subtitle');
        $this->ms_basic_style_controls('about_title', 'About - Title', '.ms-el-title');
        $this->ms_basic_style_controls('about_description', 'About - Description', '.ms-el-content p');
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
            $this->add_render_attribute('title_args', 'class', 'section__title-4-2 ms-el-title');
            $bloginfo = get_bloginfo('name');

        ?>



        <?php else :

            $bloginfo = get_bloginfo('name');

            if (!empty($settings['ms_image']['url'])) {
                $ms_image = !empty($settings['ms_image']['id']) ? wp_get_attachment_image_url($settings['ms_image']['id'], $settings['thumbnail_size']) : $settings['ms_image']['url'];
                $ms_image_alt = get_post_meta($settings["ms_image"]["id"], "_wp_attachment_image_alt", true);
            }
            if (!empty($settings['ms_image_2']['url'])) {
                $ms_image_2 = !empty($settings['ms_image_2']['id']) ? wp_get_attachment_image_url($settings['ms_image_2']['id'], $settings['thumbnail_size']) : $settings['ms_image_2']['url'];
                $ms_image_2_alt = get_post_meta($settings["ms_image_2"]["id"], "_wp_attachment_image_alt", true);
            }

            $this->add_render_attribute('title_args', 'class', 'ms-section-title-4 fz-50 ms-el-title');

            $this->ms_link_controls_render('tpbtn', 'ms-btn', $this->get_settings());
        ?>

            <!-- about area start -->
            <section class="ms-about-area pt-125 pb-180">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-6">
                            <div class="ms-about-thumb-wrapper p-relative mr-35">
                                <?php if (!empty($ms_image)) : ?>
                                    <div class="ms-about-thumb m-img">
                                        <img src="<?php echo esc_url($ms_image); ?>" alt="<?php echo esc_attr($ms_image_alt); ?>">
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($ms_image_2)) : ?>
                                    <div class="ms-about-thumb-2">
                                        <img src="<?php echo esc_url($ms_image_2); ?>" alt="<?php echo esc_attr($ms_image_2_alt); ?>">
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-xl-7 col-lg-6">
                            <div class="ms-about-wrapper pl-80 pt-75 pr-60">
                                <?php if (!empty($settings['ms_about_section_title_show'])) : ?>
                                    <div class="ms-section-title-wrapper-4 mb-50">

                                        <?php if (!empty($settings['ms_about_sub_title'])) : ?>
                                            <span class="ms-section-title-pre-4">
                                                <?php echo ms_kses($settings['ms_about_sub_title']); ?>
                                            </span>
                                        <?php endif; ?>

                                        <?php
                                        if (!empty($settings['ms_about_title'])) :
                                            printf(
                                                '<%1$s %2$s>%3$s</%1$s>',
                                                tag_escape($settings['ms_about_title_tag']),
                                                $this->get_render_attribute_string('title_args'),
                                                ms_kses($settings['ms_about_title'])
                                            );
                                        endif;
                                        ?>

                                    <?php endif; ?>
                                    </div>
                                    <div class="ms-about-content pl-120">
                                        <?php if (!empty($settings['ms_about_section_title_show'])) : ?>
                                            <?php if (!empty($settings['ms_about_description'])) : ?>
                                                <p><?php echo ms_kses($settings['ms_about_description']); ?></p>
                                            <?php endif; ?>
                                        <?php endif; ?>


                                        <?php if ($settings['ms_' . $control_id . '_button_show'] == 'yes') : ?>
                                            <div class="ms-about-btn">
                                                <a <?php echo $this->get_render_attribute_string('ms-button-arg'); ?>>
                                                    <?php echo ms_kses($settings['ms_' . $control_id . '_text']); ?>
                                                    <svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M16 7.49976L1 7.49976" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M9.9502 1.47541L16.0002 7.49941L9.9502 13.5244" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
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
            <!-- about area end -->

        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new MS_About());
