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
 * Elementor widget for testimonial.
 *
 * @since 1.0.0
 */
class MS_Testimonial extends Widget_Base
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
        return 'ms-testimonial';
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
        return __('Testimonial', 'mscore');
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
        return 'ms-icon eicon-testimonial';
    }

    /**
     * Retrieve the list of categories the widget belongs to.
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
     * @since 1.0.0
     *
     * @access protected
     */
    protected function register_controls()
    {
        $this->register_content_controls();
        $this->register_style_controls();
        $this->register_background_controls();
    }

    /**
     * Register content controls
     */
    protected function register_content_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'mscore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'background_image_testimonial',
            [
                'label' => esc_html__('Background Image', 'mscore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'section_title',
            [
                'label' => esc_html__('Section Title', 'mscore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('What Our Student Saying', 'mscore'),
            ]
        );

        $this->add_control(
            'section_description',
            [
                'label' => esc_html__('Section Description', 'mscore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Take your learning organization to the next level. to the next level. Who will share their knowledge to people around the world.', 'mscore'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'testimonial_image',
            [
                'label' => esc_html__('Testimonial Image', 'mscore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'testimonial_name',
            [
                'label' => esc_html__('Name', 'mscore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Leslie Alexander', 'mscore'),
            ]
        );

        $repeater->add_control(
            'testimonial_position',
            [
                'label' => esc_html__('Position', 'mscore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Dog Trainer', 'mscore'),
            ]
        );

        $repeater->add_control(
            'testimonial_rating',
            [
                'label' => esc_html__('Rating', 'mscore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '5',
                'options' => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                ],
            ]
        );

        $repeater->add_control(
            'testimonial_content',
            [
                'label' => esc_html__('Content', 'mscore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Lorem ipsum dolor sit amet consectetur. Hac ullamcorper nisi con velit eget dignissim pharetra at. Libero ultrices semper aliquet fusce aliquam nunc. Platea cursus in duis semper non lectus. Facili nibh duis viverra faucibus a turpis.', 'mscore'),
            ]
        );

        $this->add_control(
            'testimonials',
            [
                'label' => esc_html__('Testimonials', 'mscore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'testimonial_name' => esc_html__('Leslie Alexander', 'mscore'),
                        'testimonial_position' => esc_html__('Dog Trainer', 'mscore'),
                        'testimonial_content' => esc_html__('Lorem ipsum dolor sit amet consectetur. Hac ullamcorper nisi con velit eget dignissim pharetra at. Libero ultrices semper aliquet fusce aliquam nunc. Platea cursus in duis semper non lectus. Facili nibh duis viverra faucibus a turpis.', 'mscore'),
                    ],
                    [
                        'testimonial_name' => esc_html__('Leslie Alexander', 'mscore'),
                        'testimonial_position' => esc_html__('Dog Trainer', 'mscore'),
                        'testimonial_content' => esc_html__('Lorem ipsum dolor sit amet consectetur. Hac ullamcorper nisi con velit eget dignissim pharetra at. Libero ultrices semper aliquet fusce aliquam nunc. Platea cursus in duis semper non lectus. Facili nibh duis viverra faucibus a turpis.', 'mscore'),
                    ],
                ],
                'title_field' => '{{{ testimonial_name }}}',
            ]
        );

        $this->add_control(
            'slider_settings',
            [
                'label' => esc_html__('Slider Settings', 'mscore'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'slides_to_show',
            [
                'label' => esc_html__('Slides to Show', 'mscore'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 10,
                'step' => 1,
                'default' => 3,
            ]
        );

        $this->add_control(
            'slides_to_scroll',
            [
                'label' => esc_html__('Slides to Scroll', 'mscore'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 10,
                'step' => 1,
                'default' => 1,
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => esc_html__('Autoplay', 'mscore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'mscore'),
                'label_off' => esc_html__('No', 'mscore'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label' => esc_html__('Autoplay Speed', 'mscore'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1000,
                'max' => 10000,
                'step' => 500,
                'default' => 3000,
                'condition' => [
                    'autoplay' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Register style controls
     */
    protected function register_style_controls()
    {
        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__('Style', 'mscore'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'section_title_color',
            [
                'label' => esc_html__('Section Title Color', 'mscore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tf__section_heading h2' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'section_description_color',
            [
                'label' => esc_html__('Section Description Color', 'mscore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tf__section_heading p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'testimonial_name_color',
            [
                'label' => esc_html__('Name Color', 'mscore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tf__single_testimonial h4' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'testimonial_position_color',
            [
                'label' => esc_html__('Position Color', 'mscore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tf__single_testimonial span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'testimonial_content_color',
            [
                'label' => esc_html__('Content Color', 'mscore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tf__single_testimonial .description' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'rating_color',
            [
                'label' => esc_html__('Rating Color', 'mscore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tf__single_testimonial .rating i' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'section_title_typography',
                'label' => esc_html__('Section Title Typography', 'mscore'),
                'selector' => '{{WRAPPER}} .tf__section_heading h2',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'section_description_typography',
                'label' => esc_html__('Section Description Typography', 'mscore'),
                'selector' => '{{WRAPPER}} .tf__section_heading p',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'testimonial_name_typography',
                'label' => esc_html__('Name Typography', 'mscore'),
                'selector' => '{{WRAPPER}} .tf__single_testimonial h4',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'testimonial_position_typography',
                'label' => esc_html__('Position Typography', 'mscore'),
                'selector' => '{{WRAPPER}} .tf__single_testimonial span',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'testimonial_content_typography',
                'label' => esc_html__('Content Typography', 'mscore'),
                'selector' => '{{WRAPPER}} .tf__single_testimonial .description',
            ]
        );

        $this->end_controls_section();
    }

    protected function register_background_controls()
    {
        $this->start_controls_section(
            'background_section',
            [
                'label' => esc_html__('Background', 'mscore'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => esc_html__('Background', 'mscore'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .tf__testimonial',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render the widget output on the frontend.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>
<section class="tf__testimonial pt_110 xs_pt_75 pb_115 xs_pb_75"
    style="background: url(<?php echo esc_url($settings['background_image_testimonial']['url']); ?>);">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-md-9 col-lg-7">
                <div class="tf__section_heading mb_60">
                    <h2><?php echo esc_html($settings['section_title']); ?></h2>
                    <p><?php echo esc_html($settings['section_description']); ?></p>
                </div>
            </div>
        </div>
        <div class="row testi_slider" data-slides-to-show="<?php echo esc_attr($settings['slides_to_show']); ?>"
            data-slides-to-scroll="<?php echo esc_attr($settings['slides_to_scroll']); ?>"
            data-autoplay="<?php echo esc_attr($settings['autoplay']); ?>"
            data-autoplay-speed="<?php echo esc_attr($settings['autoplay_speed']); ?>">
            <?php foreach ($settings['testimonials'] as $testimonial) : ?>
            <div class="col-xl-4 wow fadeInUp" data-wow-duration="1s">
                <div class="tf__single_testimonial">
                    <div class="img">
                        <?php echo wp_get_attachment_image($testimonial['testimonial_image']['id'], 'full', false, array('class' => 'img-fluid w-100')); ?>
                    </div>
                    <h4><?php echo esc_html($testimonial['testimonial_name']); ?></h4>
                    <span><?php echo esc_html($testimonial['testimonial_position']); ?></span>
                    <p class="rating">
                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                        <i class="fas fa-star<?php echo $i <= $testimonial['testimonial_rating'] ? '' : '-o'; ?>"></i>
                        <?php endfor; ?>
                    </p>
                    <p class="description"><?php echo esc_html($testimonial['testimonial_content']); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php
    }
}

$widgets_manager->register(new MS_Testimonial());