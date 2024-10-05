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
class MS_History extends Widget_Base
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
        return 'history';
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
        return __('History', 'mscore');
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


        $this->ms_section_title_render_controls('history', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');

        // history group
        $this->start_controls_section(
            'ms_history',
            [
                'label' => esc_html__('History List', 'mscore'),
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
            'ms_history_image',
            [
                'label' => esc_html__('Upload Image', 'mscore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $repeater->add_control(
            'ms_history_thumb_text',
            [
                'label'       => esc_html__('Thumb Text', 'mscore'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => esc_html__('Welcome to our Shofy eCommerce Theme', 'mscore'),
                'placeholder' => esc_html__('Placeholder Text', 'mscore'),
            ]
        );

        $repeater->add_control(
            'ms_history_title',
            [
                'label' => esc_html__('Title', 'mscore'),
                'description' => ms_get_allowed_html_desc('basic'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('History Title', 'mscore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'ms_history_description',
            [
                'label' => esc_html__('Description', 'mscore'),
                'description' => ms_get_allowed_html_desc('intermediate'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered.',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'ms_history_year',
            [
                'label' => esc_html__('Year', 'mscore'),
                'description' => ms_get_allowed_html_desc('intermediate'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '2000',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'ms_history_list',
            [
                'label' => esc_html__('History - List', 'mscore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'ms_history_title' => esc_html__('Discover', 'mscore'),
                    ],
                    [
                        'ms_history_title' => esc_html__('Latest', 'mscore'),
                    ],
                    [
                        'ms_history_title' => esc_html__('Invention', 'mscore'),
                    ],
                ],
                'title_field' => '{{{ ms_history_title }}}',
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
    }

    // style_tab_content
    protected function style_tab_content()
    {
        $this->ms_section_style_controls('history_section', 'Section - Style', '.ms-el-section');
        $this->ms_basic_style_controls('history_subtitle', 'History - Subtitle', '.ms-el-subtitle');
        $this->ms_basic_style_controls('history_title', 'History - Title', '.ms-el-title');
        $this->ms_basic_style_controls('history_description', 'History - Description', '.ms-el-content > p');
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

        <?php if ($settings['ms_design_style']  == 'layout-2') : ?>



        <?php else :
            $this->add_render_attribute('title_args', 'class', 'section__title-4 ms-el-title');
        ?>

            <!-- history area start -->
            <section class="ms-history-area pt-140 pb-140" data-bg-color="#F8F8F8">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="ms-history-slider mb-50">
                                <div class="ms-history-slider-active swiper-container">
                                    <div class="swiper-wrapper">
                                        <?php foreach ($settings['ms_history_list'] as $key => $item) :

                                            if (!empty($item['ms_history_image']['url'])) {
                                                $ms_history_image_url = !empty($item['ms_history_image']['id']) ? wp_get_attachment_image_url($item['ms_history_image']['id'], $settings['thumbnail_size']) : $item['ms_history_image']['url'];
                                                $ms_history_image_alt = get_post_meta($item["ms_history_image"]["id"], "_wp_attachment_image_alt", true);
                                            }
                                        ?>
                                            <div class="ms-thistory-item swiper-slide" data-bg-color="#F8F8F8">
                                                <div class="row">
                                                    <div class="col-xl-5 col-lg-6 col-md-6">
                                                        <div class="ms-history-wrapper pr-45">
                                                            <div class="ms-history-content mb-40">

                                                                <?php if (!empty($item['ms_history_title'])) : ?>
                                                                    <h3 class="ms-history-title ms-el-box-title"><?php echo ms_kses($item['ms_history_title']); ?></h3>
                                                                <?php endif; ?>

                                                                <?php if (!empty($item['ms_history_description'])) : ?>
                                                                    <p class="ms-el-box-desc"><?php echo ms_kses($item['ms_history_description']); ?></p>
                                                                <?php endif; ?>
                                                            </div>

                                                            <?php if (!empty($item['ms_history_year'])) : ?>
                                                                <div class="ms-history-year">
                                                                    <p><?php echo esc_html($item['ms_history_year']); ?></p>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-7 col-lg-6 col-md-6">
                                                        <div class="ms-history-thumb-wrapper ml-150 p-relative">
                                                            <?php if (!empty($ms_history_image_url)) : ?>
                                                                <?php if (!empty($item['ms_history_thumb_text'])) : ?>
                                                                    <div class="ms-history-thumb-text">
                                                                        <p><?php echo ms_kses($item['ms_history_thumb_text']); ?></p>
                                                                    </div>
                                                                <?php endif; ?>

                                                                <div class="ms-history-thumb m-img">
                                                                    <img src="<?php echo esc_url($ms_history_image_url); ?>" alt="<?php echo esc_attr($ms_history_image_alt); ?>">
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="ms-history-nav">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="ms-history-nav-active swiper-container">
                                    <div class="swiper-wrapper">
                                        <?php foreach ($settings['ms_history_list'] as $key => $item) : ?>
                                            <?php if (!empty($item['ms_history_year'])) : ?>
                                                <div class="ms-history-nav-year swiper-slide text-center">
                                                    <p><?php echo esc_html($item['ms_history_year']); ?></p>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- history area end -->


        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new MS_History());
