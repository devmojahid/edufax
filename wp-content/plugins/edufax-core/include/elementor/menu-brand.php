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
class MS_Menu_Brand extends Widget_Base
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
        return 'ms-menu-brand';
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
        return __('Menu Brand', 'mscore');
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
            'ms_brand_section',
            [
                'label' => __('Brand Item', 'mscore'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();


        $repeater->add_control(
            'ms_brand_image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __('Image', 'mscore'),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );


        $repeater->add_control(
            'ms_brand_url',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __('URL', 'mscore'),
                'default' => __('#', 'mscore'),
                'placeholder' => __('Type url here', 'mscore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'ms_brand_slides',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => esc_html__('Brand Item', 'mscore'),
                'default' => [
                    [
                        'ms_brand_image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'ms_brand_image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'medium_large',
                'separator' => 'before',
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
        $this->ms_section_style_controls('section_section', 'Section - Style', '.ms-el-section');
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
            $this->add_render_attribute('title_args', 'class', 'ms-title ms-el-title');
        ?>

        <?php else : ?>


            <div class="mega-menu-brand">
                <?php foreach ($settings['ms_brand_slides'] as $item) :
                    if (!empty($item['ms_brand_image']['url'])) {
                        $ms_brand_image_url = !empty($item['ms_brand_image']['id']) ? wp_get_attachment_image_url($item['ms_brand_image']['id'], $settings['thumbnail_size']) : $item['ms_brand_image']['url'];
                        $ms_brand_image_alt = get_post_meta($item["ms_brand_image"]["id"], "_wp_attachment_image_alt", true);
                    }
                ?>
                    <?php if (!empty($item['ms_brand_url'])) : ?>
                        <a href="<?php echo esc_url($item['ms_brand_url']); ?>">
                            <img src="<?php echo esc_url($ms_brand_image_url); ?>" alt="<?php echo esc_url($ms_brand_image_alt); ?>">
                        </a>

                    <?php else : ?>
                        <img src="<?php echo esc_url($ms_brand_image_url); ?>" alt="<?php echo esc_url($ms_brand_image_alt); ?>">
                    <?php endif; ?>

                <?php endforeach; ?>
            </div>

        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new MS_Menu_Brand());
