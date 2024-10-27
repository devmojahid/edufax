<?php

namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for instructor slider.
 *
 * @since 1.0.0
 */
class MS_Instructor_Slider extends Widget_Base
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
        return 'ms-instructor-slider';
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
        return __('Instructor Slider', 'mscore');
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

        // Content Tab Start
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Content', 'mscore'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'mscore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Our Expert Instructor', 'mscore'),
                'placeholder' => esc_html__('Type your title here', 'mscore'),
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'mscore'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Take your learning organization to the next level. to the next level. Who will share their knowledge to people around the world.', 'mscore'),
                'placeholder' => esc_html__('Type your description here', 'mscore'),
            ]
        );

        $this->add_control(
            'background_image',
            [
                'label' => esc_html__('Background Image', 'mscore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->start_controls_tabs('instructor_tabs');

        $repeater->start_controls_tab(
            'instructor_content_tab',
            [
                'label' => __('Content', 'mscore'),
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Choose Image', 'mscore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'name',
            [
                'label' => esc_html__('Name', 'mscore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('John Doe', 'mscore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'designation',
            [
                'label' => esc_html__('Designation', 'mscore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Web Designer', 'mscore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'item_url',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Profile URL', 'mscore'),
                'label_block' => true,
                'placeholder' => __('Type link here', 'mscore'),
                'default' => __('#', 'mscore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
            '_tab_member_links',
            [
                'label' => __('Links', 'mscore'),
            ]
        );

        $repeater->add_control(
            'show_social',
            [
                'label' => __('Show Social Links?', 'mscore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'mscore'),
                'label_off' => __('No', 'mscore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'style_transfer' => true,
            ]
        );

        $social_links = [
            'web_title' => 'Website',
            'email_title' => 'Email',
            'phone_title' => 'Phone',
            'facebook_title' => 'Facebook',
            'twitter_title' => 'Twitter',
            'instagram_title' => 'Instagram',
            'linkedin_title' => 'LinkedIn',
            'youtube_title' => 'Youtube',
            'googleplus_title' => 'Google Plus',
            'flickr_title' => 'Flickr',
            'vimeo_title' => 'Vimeo',
            'behance_title' => 'Behance',
            'dribble_title' => 'Dribbble',
            'pinterest_title' => 'Pinterest',
            'gitub_title' => 'Github',
        ];

        foreach ($social_links as $key => $label) {
            $repeater->add_control(
                $key,
                [
                    'type' => Controls_Manager::TEXT,
                    'label_block' => false,
                    'label' => __($label, 'mscore'),
                    'placeholder' => __("Add your {$label} link", 'mscore'),
                    'dynamic' => [
                        'active' => true,
                    ],
                    'condition' => [
                        'show_social' => 'yes',
                    ],
                ]
            );
        }

        $repeater->end_controls_tab();

        $repeater->end_controls_tabs();

        $this->add_control(
            'instructors',
            [
                'label' => esc_html__('Instructors', 'mscore'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'name' => esc_html__('Darrell Steward', 'mscore'),
                        'designation' => esc_html__('Sales & Marketing', 'mscore'),
                    ],
                    [
                        'name' => esc_html__('Devon Lane', 'mscore'),
                        'designation' => esc_html__('Web Designer', 'mscore'),
                    ],
                    [
                        'name' => esc_html__('Floyd Miles', 'mscore'),
                        'designation' => esc_html__('Graphic Designer', 'mscore'),
                    ],
                ],
                'title_field' => '{{{ name }}}',
            ]
        );

        $this->end_controls_section();
        // Content Tab End

        // Style Tab Start
        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__('Style', 'mscore'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'mscore'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tf__section_heading h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__('Description Color', 'mscore'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tf__section_heading p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'instructor_name_color',
            [
                'label' => esc_html__('Instructor Name Color', 'mscore'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tf__instructor_text a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'instructor_designation_color',
            [
                'label' => esc_html__('Instructor Designation Color', 'mscore'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tf__instructor_text p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
        // Style Tab End
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

<section class="tf__instructor mt_120 xs_mt_80"
    style="background: url(<?php echo esc_url($settings['background_image']['url']); ?>);">
    <div class="tf__instructor_overlay pt_110 xs_pt_75 pb_80 xs_pb_40">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-md-9 col-lg-7 m-auto">
                    <div class="tf__section_heading heading_center mb_35 xs_mb_30">
                        <h2><?php echo esc_html($settings['title']); ?></h2>
                        <p><?php echo esc_html($settings['description']); ?></p>
                    </div>
                </div>
            </div>
            <div class="row team_slider">
                <?php foreach ($settings['instructors'] as $instructor) : ?>
                <div class="col-xl-3 wow fadeInUp" data-wow-duration="1s">
                    <div class="tf__single_instructor">
                        <a href="#" class="tf__single_instructor_img">
                            <img src="<?php echo esc_url($instructor['image']['url']); ?>" alt="instructor"
                                class="img-fluid w-100">
                        </a>
                        <div class="tf__instructor_text">
                            <a href="#"><?php echo esc_html($instructor['name']); ?></a>
                            <p><?php echo esc_html($instructor['designation']); ?></p>
                        </div>
                        <?php if ($instructor['show_social'] === 'yes') : ?>
                        <ul>
                            <?php
                                            $social_links = [
                                                'facebook_title' => 'facebook',
                                                'twitter_title' => 'twitter',
                                                'linkedin_title' => 'linkedin',
                                                'instagram_title' => 'instagram',
                                                'youtube_title' => 'youtube',


                                            ];
                                            foreach ($social_links as $key => $class) :
                                                if (!empty($instructor[$key])) :
                                            ?>
                            <li>
                                <a class="<?php echo esc_attr($class); ?>"
                                    href="<?php echo esc_url($instructor[$key]); ?>"><i
                                        class="fab fa-<?php echo esc_attr($class); ?>"></i>
                                </a>
                            </li>
                            <?php
                                                endif;
                                            endforeach;
                                            ?>
                        </ul>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<?php
    }
}

$widgets_manager->register(new MS_Instructor_Slider());