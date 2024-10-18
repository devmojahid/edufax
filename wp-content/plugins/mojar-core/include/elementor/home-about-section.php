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
 * Elementor widget for home about section.
 *
 * @since 1.0.0
 */
class MS_Home_About_Section extends Widget_Base
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
        return 'ms-home-about-section';
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
        return __('Home About Section', 'mscore');
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
        return 'ms-icon eicon-columns';
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
        $this->start_controls_section(
            'layout_section',
            [
                'label' => esc_html__('Layout', 'mscore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'layout_style',
            [
                'label' => esc_html__('Layout Style', 'mscore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [
                    'style1' => esc_html__('Style 1', 'mscore'),
                    'style2' => esc_html__('Style 2', 'mscore'),
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'mscore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'section_bg_image',
            [
                'label' => esc_html__('Background Image', 'mscore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'image_1',
            [
                'label' => esc_html__('Image 1', 'mscore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'image_2',
            [
                'label' => esc_html__('Image 2', 'mscore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'mscore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('We do great things together', 'mscore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'mscore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Lorem ipsum dolor sit amet consectetur. Aliquet suspendisse elementum feugiat sit vel scelerisque. Pellentesque elit purus vel viverra rhoncus. Tempus eget dolor feugiat porttitor. Et gravida tortor vel venenatis varius odio vivamus. Quam sed egestas amet vel. Sed et viverra leo in pellentesque varius.', 'mscore'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'icon',
            [
                'label' => esc_html__('Icon', 'mscore'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
            ]
        );

        $repeater->add_control(
            'item_title',
            [
                'label' => esc_html__('Title', 'mscore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Item Title', 'mscore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'item_description',
            [
                'label' => esc_html__('Description', 'mscore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Item description', 'mscore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'items',
            [
                'label' => esc_html__('Items', 'mscore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'icon' => [
                            'value' => 'fas fa-star',
                            'library' => 'solid',
                        ],
                        'item_title' => esc_html__('Build your career', 'mscore'),
                        'item_description' => esc_html__('Online course quickly from anywhere.', 'mscore'),
                    ],
                    [
                        'icon' => [
                            'value' => 'fas fa-pencil-ruler',
                            'library' => 'solid',
                        ],
                        'item_title' => esc_html__('Grow your skill', 'mscore'),
                        'item_description' => esc_html__('Online course quickly from anywhere.', 'mscore'),
                    ],
                ],
                'title_field' => '{{{ item_title }}}',
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'mscore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('More About Us', 'mscore'),
                'condition' => [
                    'layout_style' => 'style2',
                ],
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => esc_html__('Button Link', 'mscore'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'mscore'),
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'condition' => [
                    'layout_style' => 'style2',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__('Style', 'mscore'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'mscore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tf__section_heading h2' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .tf__section_heading h2',
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__('Description Color', 'mscore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tf__about_us_text p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .tf__about_us_text p',
            ]
        );

        $this->add_control(
            'item_title_color',
            [
                'label' => esc_html__('Item Title Color', 'mscore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tf__about_us_text ul li h4' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'item_title_typography',
                'selector' => '{{WRAPPER}} .tf__about_us_text ul li h4',
            ]
        );

        $this->add_control(
            'item_description_color',
            [
                'label' => esc_html__('Item Description Color', 'mscore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tf__about_us_text ul li p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'item_description_typography',
                'selector' => '{{WRAPPER}} .tf__about_us_text ul li p',
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => esc_html__('Button Color', 'mscore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tf__common_btn2' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'layout_style' => 'style2',
                ],
            ]
        );

        $this->add_control(
            'button_background_color',
            [
                'label' => esc_html__('Button Background Color', 'mscore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tf__common_btn2' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'layout_style' => 'style2',
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

        if ($settings['layout_style'] === 'style1') {
            $this->render_style_1($settings);
        } else {
            $this->render_style_2($settings);
        }
    }

    protected function render_style_1($settings)
    {
        $section_bg_image = $settings['section_bg_image']['url'];
        $image_1 = $settings['image_1']['url'];
        $image_2 = $settings['image_2']['url'];
?>

        <section class="tf__about_us pt_120 xs_pt_80 pb_120 xs_pb_80"
            style="background: url(<?php echo esc_url($section_bg_image); ?>);">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-xl-5 col-md-9 col-lg-6 wow fadeInLeft" data-wow-duration="1s">
                        <div class="tf__about_us_img">
                            <div class="img_1">
                                <img src="<?php echo esc_url($image_1); ?>" alt="about us" class="img-fluid w-100">
                            </div>
                            <div class="img_2">
                                <img src="<?php echo esc_url($image_2); ?>" alt="about us" class="img-fluid w-100">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 wow fadeInRight" data-wow-duration="1s">
                        <div class="tf__about_us_text">
                            <div class="tf__section_heading mb_25">
                                <h2><?php echo esc_html($settings['title']); ?></h2>
                            </div>
                            <p><?php echo esc_html($settings['description']); ?></p>
                            <ul class="d-flex flex-wrap">
                                <?php foreach ($settings['items'] as $item) : ?>
                                    <li>
                                        <span>
                                            <?php \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true']); ?>
                                        </span>
                                        <h4><?php echo esc_html($item['item_title']); ?></h4>
                                        <p><?php echo esc_html($item['item_description']); ?></p>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <?php
    }

    protected function render_style_2($settings)
    {
        $section_bg_image = $settings['section_bg_image']['url'];
        $image_1 = $settings['image_1']['url'];
        $image_2 = $settings['image_2']['url'];
    ?>

        <section class="tf__student_choose pt_120 xs_pt_80 pb_115 xs_pb_75"
            style="background: url(<?php echo esc_url($section_bg_image); ?>);">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 wow fadeInLeft" data-wow-duration="1s">
                        <div class="tf__student_choose_text">
                            <div class="tf__section_heading mb_35">
                                <h2><?php echo esc_html($settings['title']); ?></h2>
                            </div>
                            <p><?php echo esc_html($settings['description']); ?></p>
                            <ul>
                                <?php foreach ($settings['items'] as $item) : ?>
                                    <li><?php echo esc_html($item['item_title']); ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <a class="tf__common_btn2" href="<?php echo esc_url($settings['button_link']['url']); ?>"
                                <?php echo $settings['button_link']['is_external'] ? 'target="_blank"' : ''; ?>
                                <?php echo $settings['button_link']['nofollow'] ? 'rel="nofollow"' : ''; ?>>
                                <?php echo esc_html($settings['button_text']); ?>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-10 col-lg-6 wow fadeInRight" data-wow-duration="1s">
                        <div class="tf__student_choose_img">
                            <div class="img_1">
                                <img src="<?php echo esc_url($image_1); ?>" alt="student choose" class="img-fluid w-100">
                            </div>
                            <div class="img_2">
                                <img src="<?php echo esc_url($image_2); ?>" alt="student choose" class="img-fluid w-100">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<?php
    }
}

$widgets_manager->register(new MS_Home_About_Section());
