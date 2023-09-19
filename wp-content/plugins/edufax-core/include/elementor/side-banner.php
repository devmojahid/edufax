<?php

namespace MSCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use MSCore\Elementor\Controls\Group_Control_MSBGGradient;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Ms Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class MS_Side_Banner extends Widget_Base
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
        return 'ms-side-banner';
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
        return __('Side Banner', 'mscore');
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

        // Image group
        $this->start_controls_section(
            'side_image_list_sec',
            [
                'label' => esc_html__('Image List', 'mscore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'side_image',
            [
                'label' => esc_html__('Upload Image', 'mscore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'side_image_title',
            [
                'label' => esc_html__('Image Title', 'mscore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('My Image', 'mscore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'side_image_list',
            [
                'label' => esc_html__('Image List', 'mscore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' =>  $repeater->get_controls(),
                'default' => [
                    [
                        'side_image_title' => esc_html__('My Image', 'mscore'),
                    ],
                    [
                        'side_image_title' => esc_html__('My Image 2', 'mscore'),
                    ],
                    [
                        'side_image_title' => esc_html__('My Image 3', 'mscore'),
                    ],
                ],
                'title_field' => '{{{ side_image_title }}}',
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail_size',
                'default' => 'thumbnail',
                'exclude' => ['custom'],
                'separator' => 'none',
            ]
        );

        $this->end_controls_section();
    }

    // style_tab_content
    protected function style_tab_content()
    {

        $this->ms_section_style_controls('section_section', 'Section - Style', '.ms-el-section');
        $this->ms_basic_style_controls('section_subtitle', 'Section - Subtitle', '.ms-el-subtitle');
        $this->ms_basic_style_controls('section_title', 'Section - Title', '.ms-el-title');
        $this->ms_basic_style_controls('section_description', 'Section - Description', '.ms-el-content p');
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

        <!-- testimonial style 2 -->
        <?php if ($settings['ms_design_style']  == 'layout-2') : ?>


            <!-- default style -->
        <?php else :
            $bloginfo = get_bloginfo('name');
        ?>

            <div class="ms-best-banner-5 p-relative">
                <div class="ms-best-banner-slider-active-5 swiper-container">
                    <div class="swiper-wrapper">
                        <?php foreach ($settings['side_image_list'] as $index => $item) :
                            if (!empty($item['side_image']['url'])) {
                                $ms_side_image = !empty($item['side_image']['id']) ? wp_get_attachment_image_url($item['side_image']['id'], $settings['thumbnail_size_size']) : $item['side_image']['url'];
                                $ms_side_image_alt = get_post_meta($item["side_image"]["id"], "_wp_attachment_image_alt", true);
                            }
                        ?>
                            <div class="ms-best-banner-item-5 p-relative fix swiper-slide">
                                <div class="ms-best-banner-thumb-5 include-bg grey-bg" data-background="<?php echo esc_url($ms_side_image); ?>"></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="ms-best-banner-slider-dot-5 ms-swiper-dot"></div>
            </div>

        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new MS_Side_Banner());
