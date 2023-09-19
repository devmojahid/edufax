<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Control_Media;
use \Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Product_Banner_Slider extends Widget_Base {

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
		return 'tp-product-banner-slider';
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
		return __( 'Product Banner Slider', 'tpcore' );
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
                    'layout-2' => esc_html__('Layout 2', 'tpcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
         'tp_portfolio_sec',
             [
               'label' => esc_html__( 'Product Slider', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );
        
        
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'repeater_condition',
            [
                'label' => __( 'Field condition', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __( 'Style 1', 'tpcore' ),
                    'style_2' => __( 'Style 2', 'tpcore' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'tp_portfolio_image',
            [
                'label' => esc_html__('Upload Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $repeater->add_control(
            'tp_portfolio_offer_image',
            [
                'label' => esc_html__('Upload Offer Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'repeater_condition' => 'style_2'
                ],
            ]
        );
        
         $repeater->add_control(
         'tp_portfolio_box_subtitle',
           [
             'label'   => esc_html__( 'Sub Title', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::TEXT,
             'default'     => esc_html__( 'Tablet Collection 2023', 'tpcore' ),
             'label_block' => true,
           ]
         );
         $repeater->add_control(
         'tp_portfolio_box_title',
           [
             'label'   => esc_html__( 'Title', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::TEXT,
             'default'     => esc_html__( 'Product Title', 'tpcore' ),
             'label_block' => true,
           ]
         );
         $repeater->add_control(
         'tp_portfolio_box_bg_text',
           [
             'label'   => esc_html__( 'BG Text', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::TEXT,
             'default'     => esc_html__( 'Tablet', 'tpcore' ),
             'label_block' => true,
             'condition' => [
                'tp_portfolio_link_switcher' => 'yes',
                'repeater_condition' => 'style_2'
                ],
            ]
         );

         $repeater->add_control(
         'tp_portfolio_box_price',
           [
             'label'   => esc_html__( 'Price', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::TEXT,
             'default'     => esc_html__( '$90.80', 'tpcore' ),
             'label_block' => true,
             'condition' => [
                'repeater_condition' => 'style_2'
                ],
            ]
         );
         $repeater->add_control(
         'tp_portfolio_box_old_price',
           [
             'label'   => esc_html__( 'Old Price', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::TEXT,
             'default'     => esc_html__( '$10.20', 'tpcore' ),
             'label_block' => true,
             'condition' => [
                'repeater_condition' => 'style_2'
                ],
            ]
         );
         
         $repeater->add_control(
            'tp_portfolio_link_switcher',
            [
                'label' => esc_html__( 'Add Product link', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'tp_portfolio_btn_text',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_portfolio_link_switcher' => 'yes',
                    'repeater_condition' => 'style_2'
                ],
            ]
        );

        $repeater->add_control(
            'tp_portfolio_link_type',
            [
                'label' => esc_html__( 'Product Link Type', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_portfolio_link_switcher' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'tp_portfolio_link',
            [
                'label' => esc_html__( 'Proudct Link', 'tpcore' ),
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
                    'tp_portfolio_link_type' => '1',
                    'tp_portfolio_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'tp_portfolio_page_link',
            [
                'label' => esc_html__( 'Select Proudct Link Page', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_portfolio_link_type' => '2',
                    'tp_portfolio_link_switcher' => 'yes',
                ]
            ]
        );

         
        $this->add_control(
           'tp_portfolio_list',
           [
             'label'       => esc_html__( 'Proudct List', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::REPEATER,
             'fields'      => $repeater->get_controls(),
             'default'     => [
                [
                    'tp_portfolio_box_title' => esc_html__('Business Stratagy', 'tpcore'),
                ],
                [
                    'tp_portfolio_box_title' => esc_html__('Website Development', 'tpcore')
                ],
                [
                    'tp_portfolio_box_title' => esc_html__('Marketing & Reporting', 'tpcore')
                ],
             ],
             'title_field' => '{{{ tp_portfolio_box_title }}}',
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
    protected function style_tab_content(){
        // $this->tp_section_style_controls('video_section', 'Section - Style', '.tp-el-section');
        // $this->tp_basic_style_controls('section_title', 'Section - Title', '.tp-el-title');
        // $this->tp_basic_style_controls('section_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        // $this->tp_basic_style_controls('section_description', 'Section - Description', '.tp-el-content p');
        // $this->tp_link_controls_style('video_box_play_btn', 'Video - Button', '.tp-el-box-btn');
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
		?> 
         
         <!-- product banner area start -->
         <div class="tp-product-banner-area pb-90">
            <div class="container">
               <div class="tp-product-banner-slider fix">
                  <div class="tp-product-banner-slider-active swiper-container">
                     <div class="swiper-wrapper">
                        <?php foreach ($settings['tp_portfolio_list'] as $item) :
                            if ( !empty($item['tp_portfolio_image']['url']) ) {
                                $tp_portfolio_image_url = !empty($item['tp_portfolio_image']['id']) ? wp_get_attachment_image_url( $item['tp_portfolio_image']['id'], $settings['thumbnail_size']) : $item['tp_portfolio_image']['url'];
                                $tp_portfolio_image_alt = get_post_meta($item["tp_portfolio_image"]["id"], "_wp_attachment_image_alt", true);
                            }

                            if ( !empty($item['tp_portfolio_offer_image']['url']) ) {
                                $tp_portfolio_offer_image_url = !empty($item['tp_portfolio_offer_image']['id']) ? wp_get_attachment_image_url( $item['tp_portfolio_offer_image']['id'], $settings['thumbnail_size']) : $item['tp_portfolio_offer_image']['url'];
                                $tp_portfolio_offer_image_alt = get_post_meta($item["tp_portfolio_offer_image"]["id"], "_wp_attachment_image_alt", true);
                            }
                            // Link
                            if ('2' == $item['tp_portfolio_link_type']) {
                                $link = get_permalink($item['tp_portfolio_page_link']);
                                $target = '_self';
                                $rel = 'nofollow';
                            } else {
                                $link = !empty($item['tp_portfolio_link']['url']) ? $item['tp_portfolio_link']['url'] : '';
                                $target = !empty($item['tp_portfolio_link']['is_external']) ? '_blank' : '';
                                $rel = !empty($item['tp_portfolio_link']['nofollow']) ? 'nofollow' : '';
                            }

                        ?>
                        <div class="tp-product-banner-inner theme-bg p-relative z-index-1 fix swiper-slide">

                            <?php if(!empty($item['tp_portfolio_box_bg_text'])) :?>
                            <h4 class="tp-product-banner-bg-text"><?php echo esc_html($item['tp_portfolio_box_bg_text']); ?></h4>
                            <?php endif; ?>

                           <div class="row align-items-center">
                              <div class="col-xl-6 col-lg-6">
                                 <div class="tp-product-banner-content p-relative z-index-1">
                                 
                            
                                    <?php if (!empty($item['tp_portfolio_box_subtitle'])) : ?>
                                    <span class="tp-product-banner-subtitle"><?php echo tp_kses($item['tp_portfolio_box_subtitle' ]); ?></span>
                                    <?php endif; ?>


                                    <h3 class="tp-product-banner-title">
                                        <?php if ($item['tp_portfolio_link_switcher'] == 'yes') : ?>
                                        <a href="<?php echo esc_url($link); ?>"><?php echo tp_kses($item['tp_portfolio_box_title' ]); ?></a>
                                        <?php else : ?>
                                            <?php echo tp_kses($item['tp_portfolio_box_title' ]); ?>
                                        <?php endif; ?>
                                    </h3>

                                    <?php if(!empty($item['tp_portfolio_box_old_price' ]) OR !empty($item['tp_portfolio_box_price' ])) : ?>
                                    <div class="tp-product-banner-price mb-40">

                                        <?php if(!empty($item['tp_portfolio_box_old_price' ])) : ?>
                                        <span class="old-price"><?php echo tp_kses($item['tp_portfolio_box_old_price' ]); ?></span>
                                        <?php endif; ?>

                                        <?php if(!empty($item['tp_portfolio_box_price' ])) : ?>
                                        <p class="new-price"><?php echo tp_kses($item['tp_portfolio_box_price' ]); ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <?php endif; ?>

                                    <?php if (!empty($link)) : ?>
                                    <div class="tp-product-banner-btn">
                                       <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" class="tp-btn tp-btn-2"><?php echo tp_kses($item['tp_portfolio_btn_text']); ?></a>
                                    </div>
                                    <?php endif; ?>                             

                                 </div>
                              </div>
                              <div class="col-xl-6 col-lg-6">
                                 <div class="tp-product-banner-thumb-wrapper p-relative">

                                    <div class="tp-product-banner-thumb-shape">
                                       <span class="tp-product-banner-thumb-gradient"></span>
                                       <?php if(!empty($tp_portfolio_offer_image_url)) : ?>
                                       <img class="tp-offer-shape" src="<?php echo esc_url($tp_portfolio_offer_image_url); ?>" alt="<?php echo esc_url($tp_portfolio_image_alt); ?>">
                                       <?php endif; ?>  
                                    </div>

                                    <?php if(!empty($tp_portfolio_image_url)) : ?>
                                    <div class="tp-product-banner-thumb text-end p-relative z-index-1">
                                       <img src="<?php echo esc_url($tp_portfolio_image_url); ?>" alt="<?php echo esc_url($tp_portfolio_image_alt); ?>">
                                    </div>
                                    <?php endif; ?>  
                                 </div>
                              </div>
                           </div>
                        </div>
                        <?php endforeach; ?>  
                     </div>
                     <div class="tp-product-banner-slider-dot tp-swiper-dot"></div>
                  </div>
               </div>
            </div>
         </div>
         <!-- product banner area end -->

		<?php else:
         $bloginfo = get_bloginfo( 'name' );
			$this->add_render_attribute('title_args', 'class', 'video__title tp-el-title');
		?>



         <div class="tp-product-gadget-banner">
            <div class="tp-product-gadget-banner-slider-active swiper-container">
                <div class="swiper-wrapper">
                    <?php foreach ($settings['tp_portfolio_list'] as $item) :
                        if ( !empty($item['tp_portfolio_image']['url']) ) {
                            $tp_portfolio_image_url = !empty($item['tp_portfolio_image']['id']) ? wp_get_attachment_image_url( $item['tp_portfolio_image']['id'], $settings['thumbnail_size']) : $item['tp_portfolio_image']['url'];
                            $tp_portfolio_image_alt = get_post_meta($item["tp_portfolio_image"]["id"], "_wp_attachment_image_alt", true);
                        }
                        // Link
                        if ('2' == $item['tp_portfolio_link_type']) {
                            $link = get_permalink($item['tp_portfolio_page_link']);
                            $target = '_self';
                            $rel = 'nofollow';
                        } else {
                            $link = !empty($item['tp_portfolio_link']['url']) ? $item['tp_portfolio_link']['url'] : '';
                            $target = !empty($item['tp_portfolio_link']['is_external']) ? '_blank' : '';
                            $rel = !empty($item['tp_portfolio_link']['nofollow']) ? 'nofollow' : '';
                        }

                    ?>
                    <div class="tp-product-gadget-banner-item swiper-slide include-bg" data-background="<?php echo esc_url($tp_portfolio_image_url); ?>">
                        <div class="tp-product-gadget-banner-content">

                            <?php if (!empty($item['tp_portfolio_box_subtitle'])) : ?>
                            <span class="tp-product-gadget-banner-price"><?php echo tp_kses($item['tp_portfolio_box_subtitle' ]); ?></span>
                            <?php endif; ?>

                            <h3 class="tp-product-gadget-banner-title">
                                <?php if ($item['tp_portfolio_link_switcher'] == 'yes') : ?>
                                <a href="<?php echo esc_url($link); ?>"><?php echo tp_kses($item['tp_portfolio_box_title' ]); ?></a>
                                <?php else : ?>
                                    <?php echo tp_kses($item['tp_portfolio_box_title' ]); ?>
                                <?php endif; ?>
                            </h3>
                        </div>
                    </div>
                    <?php endforeach; ?>  
                </div>
                <div class="tp-product-gadget-banner-slider-dot tp-swiper-dot"></div>
            </div>
        </div>


        <?php endif; ?>

        <?php

	}

}

$widgets_manager->register( new TP_Product_Banner_Slider() );
