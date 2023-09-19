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
class MS_El_Carousel extends Widget_Base
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
        return 'tpel-carousel';
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
        return __('MS Elements Carousel', 'mscore');
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
                    'layout-2' => esc_html__('Layout 2', 'mscore'),
                    'layout-3' => esc_html__('Layout 3', 'mscore'),
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

            <div class="elements__carousel elements__carousel-img p-relative fix">
                <div class="elements__carousel-img-active">
                    <?php foreach ($settings['slider_list'] as $item) :
                        if (!empty($item['ms_slider_image']['url'])) {
                            $ms_slider_image_url = !empty($item['ms_slider_image']['id']) ? wp_get_attachment_image_url($item['ms_slider_image']['id'], $settings['thumbnail_size']) : $item['ms_slider_image']['url'];
                            $ms_slider_image_alt = get_post_meta($item["ms_slider_image"]["id"], "_wp_attachment_image_alt", true);
                        }
                    ?>
                        <div class="elements__carousel-item w-img">
                            <img src="<?php echo esc_url($ms_slider_image_url); ?>" alt="<?php echo esc_attr($ms_slider_image_alt); ?>">
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="elements-img-arrow"></div>
            </div>

        <?php elseif ($settings['ms_design_style']  == 'layout-3') : ?>

            <div class="elements__carousel elements__carousel-img-dot p-relative fix">
                <div class="elements__carousel-img-dot-active">
                    <?php foreach ($settings['slider_list'] as $item) :
                        if (!empty($item['ms_slider_image']['url'])) {
                            $ms_slider_image_url = !empty($item['ms_slider_image']['id']) ? wp_get_attachment_image_url($item['ms_slider_image']['id'], $settings['thumbnail_size']) : $item['ms_slider_image']['url'];
                            $ms_slider_image_alt = get_post_meta($item["ms_slider_image"]["id"], "_wp_attachment_image_alt", true);
                        }
                    ?>
                        <div class="elements__carousel-item w-img">
                            <img src="<?php echo esc_url($ms_slider_image_url); ?>" alt="<?php echo esc_attr($ms_slider_image_alt); ?>">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        <?php else : ?>

            <section class="elements__carousel-area pt-110">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="elements__carousel p-relative">
                                <div class="elements__carousel-active">
                                    <?php foreach ($settings['slider_list'] as $item) :
                                        if (!empty($item['ms_slider_image']['url'])) {
                                            $ms_slider_image_url = !empty($item['ms_slider_image']['id']) ? wp_get_attachment_image_url($item['ms_slider_image']['id'], $settings['thumbnail_size']) : $item['ms_slider_image']['url'];
                                            $ms_slider_image_alt = get_post_meta($item["ms_slider_image"]["id"], "_wp_attachment_image_alt", true);
                                        }
                                    ?>
                                        <div>
                                            <div class="elements__carousel-item w-img">
                                                <img src="<?php echo esc_url($ms_slider_image_url); ?>" alt="<?php echo esc_attr($ms_slider_image_alt); ?>">
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="elements-arrow"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php endif; ?>


<?php
    }
}

$widgets_manager->register(new MS_El_Carousel());
