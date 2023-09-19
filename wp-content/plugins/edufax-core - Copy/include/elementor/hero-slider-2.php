<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Hero_Slider_2 extends Widget_Base {

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
		return 'tp-slider-2';
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
		return __( 'Hero Slider 2', 'tpcore' );
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

    protected function register_controls(){
        $this->register_controls_section();
        $this->style_tab_content();
    }  

	protected function register_controls_section() {
		

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
                ],
                'default' => 'layout-1',
            ]
        );
        $this->end_controls_section();

		
		$this->start_controls_section(
            'tp_main_slider',
            [
                'label' => esc_html__('Main Slider', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'tp_slider_arrows_enable',
            [
                'label'        => esc_html__( 'Enable Navigation Arrows', 'tpcore' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'tpcore' ),
                'label_off'    => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'tp_slider_shape',
            [
                'label'        => esc_html__( 'Enable Shapae ?', 'tpcore' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'tpcore' ),
                'label_off'    => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition' => [
                    'tp_design_style' => ['layout-1', 'layout-2']
                ]
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'tp_slider_image',
            [
                'label' => esc_html__('Upload Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $repeater->add_control(
         'tp_slider_nav_image',
         [
           'label'   => esc_html__( 'Upload Nav Image', 'tpcore' ),
           'type'    => \Elementor\Controls_Manager::MEDIA,
             'default' => [
               'url' => \Elementor\Utils::get_placeholder_image_src(),
           ],
         ]
        );

        $repeater->add_control(
            'tp_slider_sub_title',
            [
                'label' => esc_html__('Sub Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Starting at 247',
                'placeholder' => esc_html__('Type Before Heading Text', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_slider_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Grow business.', 'tpcore'),
                'placeholder' => esc_html__('Type Heading Text', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_slider_nav_title',
            [
                'label' => esc_html__('Navigation Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Diamond  Necklaces', 'tpcore'),
                'placeholder' => esc_html__('Type Heading Text', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_slider_title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'tpcore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'tpcore'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'tpcore'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'tpcore'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => esc_html__('H4', 'tpcore'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => esc_html__('H5', 'tpcore'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => esc_html__('H6', 'tpcore'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h2',
                'toggle' => false,
            ]
        );

        $repeater->add_control(
            'tp_slider_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('There are many variations of passages of Lorem Ipsum available but the majority have suffered alteration.', 'tpcore'),
                'placeholder' => esc_html__('Type section description here', 'tpcore'),
            ]
        );

        $repeater->add_control(
         'tp_slider_video_url',
         [
           'label'   => esc_html__( 'Video URL', 'tpcore' ),
           'type'        => \Elementor\Controls_Manager::URL,
           'default'     => [
               'url'               => '#',
               'is_external'       => true,
               'nofollow'          => true,
               'custom_attributes' => '',
             ],
             'placeholder' => esc_html__( 'Placeholder Text', 'tpcore' ),
             'label_block' => true,
           ]
         );

         $repeater->add_control(
          'tp_slider_video_text_image',
          [
            'label'   => esc_html__( 'Video Button Text Image', 'tpcore' ),
            'type'    => \Elementor\Controls_Manager::MEDIA,
              'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
          ]
         );

		$repeater->add_control(
            'tp_btn_link_switcher',
            [
                'label' => esc_html__( 'Add Button link', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'tp_btn_btn_text',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_btn_link_switcher' => 'yes',
                ],
            ]
        );
        $repeater->add_control(
            'tp_btn_link_type',
            [
                'label' => esc_html__( 'Button Link Type', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_btn_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'tp_btn_link',
            [
                'label' => esc_html__( 'Button Link', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__( 'https://your-link.com', 'tpcore' ),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'condition' => [
                    'tp_btn_link_type' => '1',
                    'tp_btn_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'tp_btn_page_link',
            [
                'label' => esc_html__( 'Select Button Link Page', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_btn_link_type' => '2',
                    'tp_btn_link_switcher' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'slider_list',
            [
                'label' => esc_html__('Slider List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_slider_title' => esc_html__('Grow business.', 'tpcore')
                    ],
                    [
                        'tp_slider_title' => esc_html__('Development.', 'tpcore')
                    ],
                    [
                        'tp_slider_title' => esc_html__('Marketing.', 'tpcore')
                    ],
                    [
                        'tp_slider_title' => esc_html__('Technology.', 'tpcore')
                    ],
                ],
                'title_field' => '{{{ tp_slider_title }}}',
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                // 'default' => 'tp-portfolio-thumb',
            ]
        );
        $this->end_controls_section();

                
	}

    
    protected function style_tab_content(){
        $this->tp_section_style_controls('about_section', 'Section - Style', '.tp-el-section');
        $this->tp_section_style_controls('services_section_box', 'Slider - Style', '.tp-el-box');
        $this->tp_basic_style_controls('slider_subtitle', 'Slider - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('slider_title', 'Slider - Title', '.tp-el-title');
        $this->tp_basic_style_controls('slider_description', 'Slider - Description', '.tp-el-content p');
        $this->tp_link_controls_style('slider_btn', 'Slider - Button', '.tp-el-btn');
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

		<?php if ( $settings['tp_design_style']  == 'layout-2' ): 
            $bloginfo = get_bloginfo( 'name' );      
        ?>

		<?php else: 
            $bloginfo = get_bloginfo( 'name' );  
		?>
         
         <!-- slider area start -->
         <section class="tp-slider-area p-relative z-index-1 fix">
            <div class="tp-slider-active-4 khaki-bg">
                <?php foreach ($settings['slider_list'] as $item) :
                    $this->add_render_attribute('title_args', 'class', 'tp-slider-title-4 tp-el-title');

                    if ( !empty($item['tp_slider_image']['url']) ) {
                        $tp_slider_image_url = !empty($item['tp_slider_image']['id']) ? wp_get_attachment_image_url( $item['tp_slider_image']['id'], $settings['thumbnail_size']) : $item['tp_slider_image']['url'];
                        $tp_slider_image_alt = get_post_meta($item["tp_slider_image"]["id"], "_wp_attachment_image_alt", true);
                    }

                    if ( !empty($item['tp_slider_video_text_image']['url']) ) {
                        $tp_slider_video_text_image_url = !empty($item['tp_slider_video_text_image']['id']) ? wp_get_attachment_image_url( $item['tp_slider_video_text_image']['id'], $settings['thumbnail_size']) : $item['tp_slider_video_text_image']['url'];
                        $tp_slider_video_text_image_alt = get_post_meta($item["tp_slider_video_text_image"]["id"], "_wp_attachment_image_alt", true);
                    }

                    // btn Link
                    if ('2' == $item['tp_btn_link_type']) {
                        $link = get_permalink($item['tp_btn_page_link']);
                        $target = '_self';
                        $rel = 'nofollow';
                    } else {
                        $link = !empty($item['tp_btn_link']['url']) ? $item['tp_btn_link']['url'] : '';
                        $target = !empty($item['tp_btn_link']['is_external']) ? '_blank' : '';
                        $rel = !empty($item['tp_btn_link']['nofollow']) ? 'nofollow' : '';
                    }

                ?> 
               <div class="tp-slider-item-4 tp-slider-height-4 p-relative khaki-bg" >

                  <div class="tp-slider-thumb-4">

                    <img src="<?php echo esc_url($tp_slider_image_url); ?>" alt="<?php echo esc_attr($tp_slider_image_alt); ?>">

                    <?php if($settings['tp_slider_shape'] == 'yes'): ?>
                    <div class="tp-slider-thumb-4-shape">
                        <span class="tp-slider-thumb-4-shape-1"></span>
                        <span class="tp-slider-thumb-4-shape-2"></span>
                    </div>
                    <?php endif; ?>

                  </div>

                  <?php if(!empty($item['tp_slider_video_url']['url'])) : ?>
                  <div class="tp-slider-video-wrapper">

                     <!-- video -->
                     <div class="tp-slider-video transition-3">
                        <video loop>
                           <source type="video/mp4" src="<?php echo esc_url($item['tp_slider_video_url']['url']); ?>#t=3">
                        </video>
                     </div>
                     <!-- video button -->

                     <div class="tp-slider-play">
                        
                        <button type="button" class="tp-slider-play-btn tp-slider-video-move-btn tp-video-toggle-btn">
                           <img class="text-shape" src="<?php echo esc_url($tp_slider_video_text_image_url) ?>" alt="<?php echo esc_attr($tp_slider_video_text_image_alt); ?>">
                           <span class="play-icon">
                              <svg width="19" height="21" viewBox="0 0 19 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M0.607695 20.7988L0.607695 0.0142176L18.6077 10.4065L0.607695 20.7988Z" fill="currentColor"/>
                              </svg>
                           </span>
                           <span class="pause-icon">
                              <svg width="15" height="20" viewBox="0 0 15 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <rect width="5" height="20" fill="currentColor"/>
                                 <rect x="10" width="5" height="20" fill="currentColor"/>
                              </svg>
                           </span>
                        </button>
                     </div>
                  </div>
                  <?php endif; ?>

                  <div class="container">
                     <div class="row align-items-center">
                        <div class="col-xl-7 col-lg-6 col-md-8">
                           <div class="tp-slider-content-4 p-relative z-index-1">

                                <?php if (!empty($item['tp_slider_sub_title'])) : ?>
                                <span class="tp-el-subtitle"><?php echo tp_kses( $item['tp_slider_sub_title'] ); ?></span>
                                <?php endif; ?>

                                <?php
                                    if ($item['tp_slider_title_tag']) :
                                        printf('<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape($item['tp_slider_title_tag']),
                                            $this->get_render_attribute_string('title_args'),
                                            tp_kses($item['tp_slider_title'])
                                        );
                                    endif;
                                ?>

                                <?php if (!empty($item['tp_slider_description'])) : ?>
                                <p><?php echo tp_kses( $item['tp_slider_description'] ); ?></p>
                                <?php endif; ?>

                                <?php if (!empty($link)) : ?>
                                <div class="tp-slider-btn-4">
                                    <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>"  class="tp-btn tp-btn-border tp-btn-border-white"><?php echo tp_kses($item['tp_btn_btn_text']); ?></a>
                                </div>
                                <?php endif; ?>  
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <?php endforeach; ?> 
            </div>

            <?php if($settings['tp_slider_arrows_enable'] == 'yes') : ?>
            <div class="tp-slider-arrow-4"></div>
            <?php endif; ?>  

            <div class="tp-slider-nav-wrapper d-none d-xl-block">
                <div class="container">
                    <div class="tp-slider-nav">
                    <div class="tp-slider-nav-active">
                            <?php foreach ($settings['slider_list'] as $item) :
                                $this->add_render_attribute('nav_title_args', 'class', 'tp-slider-nav-title tp-el-title');

                                if ( !empty($item['tp_slider_nav_image']['url']) ) {
                                    $tp_slider_nav_image_url = !empty($item['tp_slider_nav_image']['id']) ? wp_get_attachment_image_url( $item['tp_slider_nav_image']['id'], $settings['thumbnail_size']) : $item['tp_slider_nav_image']['url'];
                                    $tp_slider_nav_image_alt = get_post_meta($item["tp_slider_nav_image"]["id"], "_wp_attachment_image_alt", true);
                                }

                            ?>
                        <div class="tp-slider-nav-item d-flex align-items-center">

                            <div class="tp-slider-nav-icon">
                                <span>
                                <img src="<?php echo esc_url($tp_slider_nav_image_url) ?>" alt="<?php echo esc_attr($tp_slider_nav_image_alt);?>">
                                </span>
                            </div>

                            <div class="tp-slider-nav-content">

                                <?php
                                    if ($item['tp_slider_title_tag']) :
                                        printf('<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape($item['tp_slider_title_tag']),
                                            $this->get_render_attribute_string('nav_title_args'),
                                            tp_kses($item['tp_slider_nav_title'])
                                        );
                                    endif;
                                ?>
                            </div>

                        </div>
                        <?php endforeach; ?>
                    </div>
                    </div>
                </div>
            </div>
         </section>
         <!-- slider area end -->
         <?php endif; ?>


		<?php 
	}
}

$widgets_manager->register( new TP_Hero_Slider_2() );