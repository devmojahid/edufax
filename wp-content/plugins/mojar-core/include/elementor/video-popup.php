<?php

namespace MSCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Control_Media;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Ms Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class MS_Video_Popup extends Widget_Base
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
        return 'ms-video-popup';
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
        return __('MS Video', 'mscore');
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
            'ms_video_title_section',
            [
                'label' => esc_html__('Video Title', 'mscore'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'ms_video_subtitle',
            [
                'label'       => esc_html__('Video Subtitle', 'mscore'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('We are here for you.', 'mscore'),
                'placeholder' => esc_html__('Your Text', 'mscore'),
                'label_block' => true,
                'condition' => [
                    'ms_design_style' => 'layout-3'
                ]
            ]
        );
        $this->add_control(
            'ms_video_title',
            [
                'label'       => esc_html__('Video Title', 'mscore'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => esc_html__('Video Title', 'mscore'),
                'placeholder' => esc_html__('Your Text', 'mscore'),
                'label_block' => true,
            ]
        );



        $this->end_controls_section();

        // ms_video
        $this->start_controls_section(
            'ms_video',
            [
                'label' => esc_html__('Video', 'mscore'),
            ]
        );

        $this->add_control(
            'ms_video_url',
            [
                'label' => esc_html__('Video', 'mscore'),
                'type' => Controls_Manager::TEXT,
                'default' => 'https://www.youtube.com/watch?v=AjgD3CvWzS0',
                'title' => esc_html__('Video url', 'mscore'),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ms_video_shape_sec',
            [
                'label' => esc_html__('Shape Controls', 'mscore'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'ms_design_style' => 'layout-3'
                ]
            ]
        );

        $this->add_control(
            'ms_video_shape_switch',
            [
                'label'        => esc_html__('Enable Shape', 'mscore'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'mscore'),
                'label_off'    => esc_html__('Hide', 'mscore'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->end_controls_section();

        // Button 
        $this->ms_button_render('video', 'Button');

        // _ms_image
        $this->start_controls_section(
            '_ms_image_section',
            [
                'label' => esc_html__('Thumbnail', 'mscore'),
            ]
        );
        $this->add_control(
            'ms_image',
            [
                'label' => esc_html__('Choose Image', 'mscore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'ms_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        $this->end_controls_section();

        $this->ms_section_style_controls('video_section', 'Section - Style', '.ms-el-section');
        $this->ms_basic_style_controls('section_title', 'Section - Title', '.ms-el-title');
        $this->ms_basic_style_controls('section_subtitle', 'Section - Subtitle', '.ms-el-subtitle');
        $this->ms_link_controls_style('video_box_play_btn', 'Video - Button', '.ms-el-box-btn');
        $this->ms_link_controls_style('video_box_play_bg', 'Video - Button BG', '.ms-el-box-btn-bg');
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
            $bloginfo = get_bloginfo('name');

            if (!empty($settings['ms_image']['url'])) {
                $ms_image = !empty($settings['ms_image']['id']) ? wp_get_attachment_image_url($settings['ms_image']['id'], $settings['ms_image_size_size']) : $settings['ms_image']['url'];
                $ms_image_alt = get_post_meta($settings["ms_image"]["id"], "_wp_attachment_image_alt", true);
            }
        ?>

            <!-- video area start -->
            <section class="video__area video__overlay box-plr-145 black-bg-13 ms-el-section">
                <div class="container-fluid">
                    <div class="video__inner-8 pt-185 pb-155 include-bg wow fadeInUp" data-background="<?php echo esc_url($ms_image); ?>" data-wow-delay=".3s" data-wow-duration="1s">
                        <div class="row justify-content-center">
                            <div class="col-xxl-7 col-xl-8 col-lg-10">
                                <div class="video__content-8 text-center">
                                    <?php if (!empty($settings['ms_video_url'])) : ?>
                                        <div class="video__play-8 mb-20">
                                            <a href="<?php echo esc_url($settings["ms_video_url"]); ?>" class="popup-video video__play-btn video__play-btn-8 ms-pulse-border ms-el-box-btn">
                                                <span class="video-play-bg ms-el-box-btn-bg"></span>
                                                <img src="<?php echo get_template_directory_uri() . '/assets/img/video/video-icon-play.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                                            </a>
                                        </div>
                                    <?php endif; ?>

                                    <div class="section__title-wrapper-8 text-center">
                                        <?php if (!empty($settings['ms_video_title'])) : ?>
                                            <h3 class="section__title-8 ms-el-title"><?php echo ms_kses($settings['ms_video_title']) ?></h3>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- video area end -->

        <?php elseif ($settings['ms_design_style']  == 'layout-3') :
            $bloginfo = get_bloginfo('name');

            if (!empty($settings['ms_image']['url'])) {
                $ms_image = !empty($settings['ms_image']['id']) ? wp_get_attachment_image_url($settings['ms_image']['id'], $settings['ms_image_size_size']) : $settings['ms_image']['url'];
                $ms_image_alt = get_post_meta($settings["ms_image"]["id"], "_wp_attachment_image_alt", true);
            }
        ?>

            <!-- video area start -->
            <section class="video__area p-relative z-index-1 video__bg video__pt-183 video__pb-223 ms-el-section">
                <div class="video__bg-shape include-bg" data-background="<?php echo esc_url($ms_image); ?>"></div>

                <?php if (!empty($settings['ms_video_shape_switch'])) : ?>
                    <div class="video__shape">
                        <img class="video__shape-1" src="<?php echo get_template_directory_uri() . '/assets/img/video/video-dot-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                        <img class="video__shape-2" src="<?php echo get_template_directory_uri() . '/assets/img/video/video-dot-2.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                    </div>
                <?php endif; ?>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-10">
                            <div class="video__content-2 text-center">
                                <?php if (!empty($settings['ms_video_url'])) : ?>
                                    <div class="video__play-2">
                                        <a href="<?php echo esc_url($settings["ms_video_url"]); ?>" class="popup-video video__play-btn video__play-btn-2 ms-pulse-border ms-el-box-btn">
                                            <span class="video-play-bg ms-el-box-btn-bg"></span>
                                            <svg width="17" height="20" viewBox="0 0 17 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M17 10.2L0.200001 19.8995V0.500546L17 10.2Z" fill="currentColor" />
                                            </svg>
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($settings['ms_video_subtitle'])) : ?>
                                    <span class="ms-el-subtitle"><?php echo ms_kses($settings['ms_video_subtitle']); ?></span>
                                <?php endif; ?>

                                <?php if (!empty($settings['ms_video_title'])) : ?>
                                    <h3 class="video__title-2 ms-el-title"><?php echo ms_kses($settings['ms_video_title']) ?></h3>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- video area end -->

        <?php else :
            $bloginfo = get_bloginfo('name');
            $this->add_render_attribute('title_args', 'class', 'video__title ms-el-title');
            if (!empty($settings['ms_image']['url'])) {
                $ms_image = !empty($settings['ms_image']['id']) ? wp_get_attachment_image_url($settings['ms_image']['id'], $settings['ms_image_size_size']) : $settings['ms_image']['url'];
                $ms_image_alt = get_post_meta($settings["ms_image"]["id"], "_wp_attachment_image_alt", true);
            }

            if ('2' == $settings['ms_video_btn_link_type']) {
                $link = get_permalink($settings['ms_video_btn_page_link']);
                $target = '_self';
                $rel2 = 'nofollow';
            } else {
                $link = !empty($settings['ms_video_btn_link']['url']) ? $settings['ms_video_btn_link']['url'] : '';
                $target = !empty($settings['ms_video_btn_link']['is_external']) ? '_blank' : '';
                $rel = !empty($settings['ms_video_btn_link']['nofollow']) ? 'nofollow' : '';
            }

        ?>

            <!-- video area start -->
            <section class="video__area pt-145 pb-125 include-bg jarallax ms-el-section" data-overlay="dark" data-overlay-opacity="6" data-background="<?php echo esc_url($ms_image); ?>">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xxl-10 col-xl-10">
                            <div class="video__content text-center">
                                <?php if (!empty($settings['ms_video_url'])) : ?>
                                    <div class="video__play">
                                        <a href="<?php echo esc_url($settings["ms_video_url"]); ?>" class="video__play-btn ms-pulse-border popup-video">
                                            <span class="video-play-bg ms-el-box-btn-bg"></span>
                                            <img src="<?php echo get_template_directory_uri() . '/assets/img/video/video-icon-play.png' ?> " alt="<?php echo esc_attr($bloginfo); ?>">
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($settings['ms_video_title'])) : ?>
                                    <h3 class="video__title ms-el-title"><?php echo ms_kses($settings['ms_video_title']) ?></h3>
                                <?php endif; ?>

                                <?php if (!empty($link)) : ?>
                                    <div class="video__btn">
                                        <a class="ms-btn-transparent ms-el-box-btn" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>"><?php echo ms_kses($settings['ms_video_btn_text']); ?> <i class="fa-regular fa-arrow-right-long"></i></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- video area end -->



        <?php endif; ?>

<?php

    }
}

$widgets_manager->register(new MS_Video_Popup());
