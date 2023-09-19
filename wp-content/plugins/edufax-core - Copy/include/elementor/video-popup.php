<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Control_Media;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Video_Popup extends Widget_Base {

     use \TPCore\Widgets\TPCoreElementFunctions;

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'tp-video-popup';
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
	public function get_title() {
		return __( 'TP Video', 'tpcore' );
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
	public function get_icon() {
		return 'tp-icon';
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
	public function get_categories() {
		return [ 'tpcore' ];
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
	public function get_script_depends() {
		return [ 'tpcore' ];
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
	protected function register_controls() {

        // layout Panel
        $this->start_controls_section(
            'tp_layout',
            [
                'label' => esc_html__('Design Layout', 'tpcore'),
            ]
        );
        $this->add_control(
            'tp_design_style',
            [
                'label' => esc_html__('Select Layout', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'tpcore'),
                    'layout-2' => esc_html__('Layout 2', 'tpcore'),
                    'layout-3' => esc_html__('Layout 3', 'tpcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
         'tp_video_title_section',
             [
               'label' => esc_html__( 'Video Title', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );
        $this->add_control(
        'tp_video_subtitle',
         [
            'label'       => esc_html__( 'Video Subtitle', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'We are here for you.', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
            'label_block' => true,
            'condition' => [
                'tp_design_style' => 'layout-3'
            ]
         ]
        );
        $this->add_control(
        'tp_video_title',
            [
                'label'       => esc_html__( 'Video Title', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => esc_html__( 'Video Title', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
                'label_block' => true,
            ]
        );
        
        
        
        $this->end_controls_section();

        // tp_video
        $this->start_controls_section(
            'tp_video',
            [
                'label' => esc_html__('Video', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_video_url',
            [
                'label' => esc_html__('Video', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => 'https://www.youtube.com/watch?v=AjgD3CvWzS0',
                'title' => esc_html__('Video url', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
         'tp_video_shape_sec',
             [
               'label' => esc_html__( 'Shape Controls', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
               'condition' => [
                    'tp_design_style' => 'layout-3'
                ]
             ]
        );
        
        $this->add_control(
         'tp_video_shape_switch',
         [
           'label'        => esc_html__( 'Enable Shape', 'tpcore' ),
           'type'         => \Elementor\Controls_Manager::SWITCHER,
           'label_on'     => esc_html__( 'Show', 'tpcore' ),
           'label_off'    => esc_html__( 'Hide', 'tpcore' ),
           'return_value' => 'yes',
           'default'      => 'yes',
         ]
        );
        
        $this->end_controls_section();

        // Button 
        $this->tp_button_render('video', 'Button');

        // _tp_image
        $this->start_controls_section(
            '_tp_image_section',
            [
                'label' => esc_html__('Thumbnail', 'tpcore'),
            ]
        );
        $this->add_control(
            'tp_image',
            [
                'label' => esc_html__( 'Choose Image', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        $this->end_controls_section();

        $this->tp_section_style_controls('video_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('section_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('section_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_link_controls_style('video_box_play_btn', 'Video - Button', '.tp-el-box-btn');
        $this->tp_link_controls_style('video_box_play_bg', 'Video - Button BG', '.tp-el-box-btn-bg');
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
	protected function render() {
		$settings = $this->get_settings_for_display();

		?>

		<?php if ( $settings['tp_design_style']  == 'layout-2' ) : 
            $bloginfo = get_bloginfo( 'name' );

            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }
		?> 
         
         <!-- video area start -->
         <section class="video__area video__overlay box-plr-145 black-bg-13 tp-el-section">
            <div class="container-fluid">
               <div class="video__inner-8 pt-185 pb-155 include-bg wow fadeInUp" data-background="<?php echo esc_url($tp_image); ?>" data-wow-delay=".3s" data-wow-duration="1s">
                  <div class="row justify-content-center">
                     <div class="col-xxl-7 col-xl-8 col-lg-10">
                        <div class="video__content-8 text-center">
                            <?php if ( !empty($settings['tp_video_url']) ) : ?>
                            <div class="video__play-8 mb-20">
                                <a href="<?php echo esc_url($settings["tp_video_url"]); ?>" class="popup-video video__play-btn video__play-btn-8 tp-pulse-border tp-el-box-btn">
                                    <span class="video-play-bg tp-el-box-btn-bg"></span>
                                    <img src="<?php echo get_template_directory_uri() . '/assets/img/video/video-icon-play.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                                </a>
                            </div>
                            <?php endif; ?>

                            <div class="section__title-wrapper-8 text-center">
                                <?php if(!empty($settings['tp_video_title']))  :?>
                                <h3 class="section__title-8 tp-el-title"><?php echo tp_kses($settings['tp_video_title']) ?></h3>
                                <?php endif; ?>
                            </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- video area end -->

         <?php elseif ( $settings['tp_design_style']  == 'layout-3' ) : 
            $bloginfo = get_bloginfo( 'name' );

            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }
		?> 

         <!-- video area start -->
         <section class="video__area p-relative z-index-1 video__bg video__pt-183 video__pb-223 tp-el-section">
            <div class="video__bg-shape include-bg" data-background="<?php echo esc_url($tp_image); ?>"></div>

            <?php if(!empty($settings['tp_video_shape_switch'])) : ?>
            <div class="video__shape">
               <img class="video__shape-1" src="<?php echo get_template_directory_uri() . '/assets/img/video/video-dot-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="video__shape-2" src="<?php echo get_template_directory_uri() . '/assets/img/video/video-dot-2.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
            </div>
            <?php endif; ?>
            <div class="container">
               <div class="row justify-content-center">
                  <div class="col-xl-10">
                     <div class="video__content-2 text-center">
                     <?php if ( !empty($settings['tp_video_url']) ) : ?>
                        <div class="video__play-2">
                           <a href="<?php echo esc_url($settings["tp_video_url"]); ?>" class="popup-video video__play-btn video__play-btn-2 tp-pulse-border tp-el-box-btn">
                              <span class="video-play-bg tp-el-box-btn-bg"></span>
                              <svg width="17" height="20" viewBox="0 0 17 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M17 10.2L0.200001 19.8995V0.500546L17 10.2Z" fill="currentColor"/>
                              </svg>                                                                
                           </a>
                        </div>
                        <?php endif; ?>

                        <?php if(!empty($settings['tp_video_subtitle'])):?>
                        <span class="tp-el-subtitle"><?php echo tp_kses($settings['tp_video_subtitle']); ?></span>
                        <?php endif; ?>

                        <?php if(!empty($settings['tp_video_title']))  :?>
                        <h3 class="video__title-2 tp-el-title"><?php echo tp_kses($settings['tp_video_title']) ?></h3>
                        <?php endif; ?>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- video area end -->

		<?php else:
         $bloginfo = get_bloginfo( 'name' );
			$this->add_render_attribute('title_args', 'class', 'video__title tp-el-title');
            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }

            if ('2' == $settings['tp_video_btn_link_type']) {
                $link = get_permalink($settings['tp_video_btn_page_link']);
                $target = '_self';
                $rel2 = 'nofollow';
            } else {
                $link = !empty($settings['tp_video_btn_link']['url']) ? $settings['tp_video_btn_link']['url'] : '';
                $target = !empty($settings['tp_video_btn_link']['is_external']) ? '_blank' : '';
                $rel = !empty($settings['tp_video_btn_link']['nofollow']) ? 'nofollow' : '';
            }

		?>

        <!-- video area start -->
        <section class="video__area pt-145 pb-125 include-bg jarallax tp-el-section" data-overlay="dark" data-overlay-opacity="6" data-background="<?php echo esc_url($tp_image); ?>">
            <div class="container">
               <div class="row justify-content-center">
                  <div class="col-xxl-10 col-xl-10">
                     <div class="video__content text-center">
                     <?php if ( !empty($settings['tp_video_url']) ) : ?>
                        <div class="video__play">
                           <a href="<?php echo esc_url($settings["tp_video_url"]); ?>" class="video__play-btn tp-pulse-border popup-video">
                              <span class="video-play-bg tp-el-box-btn-bg"></span>
                              <img src="<?php echo get_template_directory_uri() . '/assets/img/video/video-icon-play.png' ?> " alt="<?php echo esc_attr($bloginfo); ?>">
                           </a>
                        </div>
                        <?php endif; ?>

                        <?php if(!empty($settings['tp_video_title']))  :?>
                        <h3 class="video__title tp-el-title"><?php echo tp_kses($settings['tp_video_title']) ?></h3>
                        <?php endif; ?>

                        <?php if (!empty($link)) : ?>
                        <div class="video__btn">
                           <a class="tp-btn-transparent tp-el-box-btn" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>"><?php echo tp_kses($settings['tp_video_btn_text']); ?> <i class="fa-regular fa-arrow-right-long"></i></a>
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

$widgets_manager->register( new TP_Video_Popup() );
