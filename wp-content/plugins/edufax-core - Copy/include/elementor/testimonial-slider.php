<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use TPCore\Elementor\Controls\Group_Control_TPBGGradient;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Testimonial_Slider extends Widget_Base {

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
		return 'tp-testimonial-slider';
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
		return __( 'Testimonial Slider', 'tpcore' );
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
                    'layout-3' => esc_html__('Layout 3', 'tpcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->tp_section_title_render_controls('testimonial', 'Section Title', ['layout-2', 'layout-3']);

        $this->start_controls_section(
            'tp_tes_sec_',
                [
                  'label' => esc_html__( 'Title & Description', 'tpcore' ),
                  'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                  'condition' => [
                    'tp_design_style' => 'layout-1'
                ]
                ]
           );

           $this->add_control(
           'tp_tes_sec_title',
            [
               'label'       => esc_html__( 'Your Title', 'tpcore' ),
               'type'        => \Elementor\Controls_Manager::TEXT,
               'default'     => esc_html__( 'The Review Are In', 'tpcore' ),
               'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
            ]
           );
           
           $this->end_controls_section();
   
           $this->start_controls_section(
            'tp_testimonial_shape_sec',
                [
                  'label' => esc_html__( 'Shape Controls', 'tpcore' ),
                  'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                  'condition' => [
                    'tp_design_style' => 'layout-1'
                  ]
                ]
           );
           
           $this->add_control(
            'tp_testimonial_shape_switch',
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

        // Review group
        $this->start_controls_section(
            'review_list',
            [
                'label' => esc_html__( 'Review List', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
            'reviewer_image',
            [
                'label' => esc_html__( 'Reviewer Image', 'tpcore' ),
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
            'reviewer_name', [
                'label' => esc_html__( 'Reviewer Name', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Rasalina William' , 'tpcore' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'reviewer_title', [
                'label' => esc_html__( 'Reviewer Title', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( '- CEO at YES Germany' , 'tpcore' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'review_content',
            [
                'label' => esc_html__( 'Review Content', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => 'Aklima The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections Bonorum et Malorum original.',
                'placeholder' => esc_html__( 'Type your review content here', 'tpcore' ),
            ]
        );

        $repeater->add_control(
            'review_rating',
            [
                'label' => esc_html__('Select Rating', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '5',
                'options' => [
                    '5' => esc_html__('Rating 5', 'tpcore'),
                    '4' => esc_html__('Rating 4', 'tpcore'),
                    '3' => esc_html__('Rating 3', 'tpcore'),
                    '2' => esc_html__('Rating 2', 'tpcore'),
                    '1' => esc_html__('Rating 1', 'tpcore'),
                ],   
                            
            ]
        );

        $repeater->add_control(
         'review_shape_switch',
         [
           'label'        => esc_html__( 'Enable Shape ?', 'tpcore' ),
           'type'         => \Elementor\Controls_Manager::SWITCHER,
           'label_on'     => esc_html__( 'Show', 'tpcore' ),
           'label_off'    => esc_html__( 'Hide', 'tpcore' ),
           'return_value' => 'yes',
           'default'      => 'yes',
           'condition' => [
            'repeater_condition' => ['style_2']
            ] 
         ]
        );

        $this->add_control(
            'reviews_list',
            [
                'label' => esc_html__( 'Review List', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' =>  $repeater->get_controls(),
                'default' => [
                    [
                        'reviewer_name' => esc_html__( 'Rasalina William', 'tpcore' ),
                        'reviewer_title' => esc_html__( 'CEO at YES Germany', 'tpcore' ),
                        'review_content' => esc_html__( 'Construction can be defined as the art of building something. These construction quotes will put into perspective the fact that construction can be', 'tpcore' ),
                    ],
                    [
                        'reviewer_name' => esc_html__( 'Rasalina William', 'tpcore' ),
                        'reviewer_title' => esc_html__( 'CEO at YES Germany', 'tpcore' ),
                        'review_content' => esc_html__( 'Construction can be defined as the art of building something. These construction quotes will put into perspective the fact that construction can be', 'tpcore' ),
                    ],
                    [
                        'reviewer_name' => esc_html__( 'Rasalina William', 'tpcore' ),
                        'reviewer_title' => esc_html__( 'CEO at YES Germany', 'tpcore' ),
                        'review_content' => esc_html__( 'Construction can be defined as the art of building something. These construction quotes will put into perspective the fact that construction can be', 'tpcore' ),
                    ],

                ],
                'title_field' => '{{{ reviewer_name }}}',
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

        $this->end_controls_section();	}

    // style_tab_content
    protected function style_tab_content(){
  
        $this->tp_section_style_controls('team_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('team_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('team_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('team_description', 'Section - Description', '.tp-el-content p');
        $this->tp_link_controls_style('coming_time_social', 'Section - Button', '.tp-el-btn');

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

		<!--	testimonial style 2 -->
		<?php if ( $settings['tp_design_style']  == 'layout-2' ): 
            $this->add_render_attribute('title_args', 'class', 'tp-section-title-3 tp-el-title');
        ?>
         <!-- testimonial area start -->
         <section class="tp-testimonial-area pt-115 pb-100">
            <div class="container">
            <?php if ( !empty($settings['tp_testimonial_section_title_show']) ) : ?>
               <div class="row">
                  <div class="col-xl-12">
                     <div class="tp-section-title-wrapper-3 mb-45 text-center">

                        <?php if ( !empty($settings['tp_testimonial_sub_title']) ) : ?>
                        <span class="tp-section-title-pre-3 tp-el-subtitle">
                            <?php echo tp_kses( $settings['tp_testimonial_sub_title'] ); ?>
                        </span>
                        <?php endif; ?>
                        <?php
                            if ( !empty($settings['tp_testimonial_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_testimonial_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    tp_kses( $settings['tp_testimonial_title' ] )
                                    );
                            endif;
                        ?>

                        <?php if ( !empty($settings['tp_testimonial_description']) ) : ?>
                            <p><?php echo tp_kses( $settings['tp_testimonial_description'] ); ?></p>
                        <?php endif; ?>

                     </div>
                  </div>
               </div>
               <?php endif; ?>
               <div class="row">
                  <div class="col-xl-12">
                     <div class="tp-testimonial-slider-3">
                        <div class="tp-testimoinal-slider-active-3 swiper-container">
                           <div class="swiper-wrapper">
                                <?php foreach ($settings['reviews_list'] as $index => $item) :
                                    if ( !empty($item['reviewer_image']['url']) ) {
                                    $tp_reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id'], $settings['thumbnail_size_size']) : $item['reviewer_image']['url'];
                                    $tp_reviewer_image_alt = get_post_meta($item["reviewer_image"]["id"], "_wp_attachment_image_alt", true);
                                    }
                                ?>
                              <div class="tp-testimonial-item-3 swiper-slide grey-bg-7 p-relative z-index-1">
                                    <?php if($item['review_shape_switch'] == 'yes') : ?>
                                 <div class="tp-testimonial-shape-3">
                                    <img class="tp-testimonial-shape-3-quote" src="<?php echo get_template_directory_uri(); ?>/assets/img/testimonial/testimonial-quote.png" alt="">
                                 </div>
                                 <?php endif; ?>

                                 <div class="tp-testimonial-rating tp-testimonial-rating-3">
                                        <?php for ($i=0; $i < $item['review_rating']; $i++) : ?> 
                                        <span><i class="fa-solid fa-star"></i></span>
                                        <?php endfor; ?>  
                                 </div>

                                <?php if ( !empty($item['review_content']) ) : ?>
                                    <div class="tp-testimonial-content-3">
                                        <p class="tp-el-box-desc"><?php echo tp_kses($item['review_content']); ?></p>
                                    </div>
                                <?php endif; ?>

                                 <div class="tp-testimonial-user-wrapper-3 d-flex">
                                    <div class="tp-testimonial-user-3 d-flex align-items-center">
                                       <?php if ( !empty($tp_reviewer_image) ) : ?>
                                            <div class="tp-testimonial-avater-3 mr-10">
                                                <img src="<?php echo esc_url($tp_reviewer_image); ?>" alt="<?php echo esc_url($tp_reviewer_image_alt); ?>">
                                            </div>
                                        <?php endif; ?>
                                       <div class="tp-testimonial-user-3-info tp-testimonial-user-translate">
                                            <?php if ( !empty($item['reviewer_name']) ) : ?>
                                            <h3 class="tp-testimonial-user-3-title"><?php echo tp_kses($item['reviewer_name']); ?></h3>
                                            <?php endif; ?>
                                            <?php if ( !empty($item['reviewer_title']) ) : ?>
                                            <span class="tp-testimonial-3-designation"><?php echo tp_kses($item['reviewer_title']); ?></span>
                                            <?php endif; ?>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <?php endforeach; ?>
                           </div>
                        </div>
                        <div class="tp-testimoinal-slider-dot-3 tp-swiper-dot-border text-center mt-50"></div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- testimonial area end -->

        <?php elseif ( $settings['tp_design_style']  == 'layout-3' ): 
            $this->add_render_attribute('title_args', 'class', 'tp-section-title-5 tp-el-title');
        ?>

         <!-- testimonial area start -->
         <section class="tp-testimonial-area">
            <div class="container">
               <div class="row justify-content-center">
                  <div class="col-xl-12">
                     <div class="tp-testimonial-slider-wrapper-5">
                     <?php if ( !empty($settings['tp_testimonial_section_title_show']) ) : ?>
                        <div class="row">
                           <div class="col-xl-7 offset-xl-3">
                              <div class="tp-section-title-wrapper-5 mb-45">
                              <?php if ( !empty($settings['tp_testimonial_sub_title']) ) : ?>
                                 <span class="tp-section-title-pre-5">
                                 <?php echo tp_kses( $settings['tp_testimonial_sub_title'] ); ?>
                                    <svg width="82" height="22" viewBox="0 0 82 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M81 14.5798C0.890564 -8.05914 -5.81154 0.0503902 5.00322 21" stroke="currentColor" stroke-opacity="0.3" stroke-width="2" stroke-miterlimit="3.8637" stroke-linecap="round"/>
                                    </svg>
                                 </span>
                                <?php endif; ?>

                                <?php
                                    if ( !empty($settings['tp_testimonial_title' ]) ) :
                                        printf( '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape( $settings['tp_testimonial_title_tag'] ),
                                            $this->get_render_attribute_string( 'title_args' ),
                                            tp_kses( $settings['tp_testimonial_title' ] )
                                            );
                                    endif;
                                ?>

                                <?php if ( !empty($settings['tp_testimonial_description']) ) : ?>
                                    <p><?php echo tp_kses( $settings['tp_testimonial_description'] ); ?></p>
                                <?php endif; ?>
                              </div>
                           </div>
                        </div>
                        <?php endif; ?>
                        <div class="tp-testimonial-slider-5 p-relative">
                           <div class="tp-testimonial-slider-active-5 swiper-container pb-15">
                              <div class="swiper-wrapper">
                                <?php foreach ($settings['reviews_list'] as $index => $item) :
                                    if ( !empty($item['reviewer_image']['url']) ) {
                                    $tp_reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id'], $settings['thumbnail_size_size']) : $item['reviewer_image']['url'];
                                    $tp_reviewer_image_alt = get_post_meta($item["reviewer_image"]["id"], "_wp_attachment_image_alt", true);
                                    }
                                ?>
                                 <div class="tp-testimonial-item-5 d-md-flex swiper-slide white-bg">
                                 <?php if ( !empty($tp_reviewer_image) ) : ?>
                                    <div class="tp-testimonial-avater-wrapper-5 p-relative">
                                       <div class="tp-avater-rounded mr-60">
                                          <div class="tp-testimonial-avater-5 ">
                                          <img src="<?php echo esc_url($tp_reviewer_image); ?>" alt="<?php echo esc_url($tp_reviewer_image_alt); ?>">
                                          </div>
                                       </div>
                                       <span class="quote-icon">
                                          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/testimonial/testimonial-quote-2.png" alt="">
                                       </span>
                                    </div>
                                    <?php endif; ?>
      
                                    <div class="tp-testimonial-content-5">
                                       <div class="tp-testimonial-rating tp-testimonial-rating-5">
                                            <?php for ($i=0; $i < $item['review_rating']; $i++) : ?> 
                                            <span><i class="fa-solid fa-star"></i></span>
                                            <?php endfor; ?> 
                                       </div>
      
                                       <?php if ( !empty($item['review_content']) ) : ?>
                                        <p class="tp-el-box-desc"><?php echo tp_kses($item['review_content']); ?></p>
                                        <?php endif; ?>
      
                                       <div class="tp-testimonial-user-5-info">
                                            <?php if ( !empty($item['reviewer_name']) ) : ?>
                                            <h3 class="tp-testimonial-user-5-title"><?php echo tp_kses($item['reviewer_name']); ?></h3>
                                            <?php endif; ?>
                                            <?php if ( !empty($item['reviewer_title']) ) : ?>
                                            <span class="tp-testimonial-user-5-designation"><?php echo tp_kses($item['reviewer_title']); ?></span>
                                            <?php endif; ?>
                                       </div>
                                    </div>
                                 </div>
                                 <?php endforeach; ?>
                              </div>
                           </div>
                           <div class="tp-testimonial-arrow-5">
                              <button type="button" class="tp-testimonial-slider-5-button-prev">
                                 <svg width="33" height="16" viewBox="0 0 33 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.10059 7.97559L32.1006 7.97559" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M8.15039 0.999999L1.12076 7.99942L8.15039 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                 </svg>
                              </button>
                              <button type="button" class="tp-testimonial-slider-5-button-next">
                                 <svg width="33" height="16" viewBox="0 0 33 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M31.1006 7.97559L1.10059 7.97559" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M25.0508 0.999999L32.0804 7.99942L25.0508 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                 </svg>
                              </button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- testimonial area end -->

		<!-- default style -->
		<?php else:
            $this->add_render_attribute('title_args', 'class', 'section__title section__title-1-2 tp-el-title');
            $bloginfo = get_bloginfo( 'name' );
            
        ?>
         <!-- testimonial area start -->
         <section class="tp-testimonial-area grey-bg-7 pt-130 pb-135">
            <div class="container">
               <div class="row justify-content-center">
                  <div class="col-xl-12">
                     <div class="tp-testimonial-slider p-relative z-index-1">
                        <?php if($settings['tp_testimonial_shape_switch'] == "yes") : ?>
                        <div class="tp-testimonial-shape">
                           <span class="tp-testimonial-shape-gradient"></span>
                        </div>
                        <?php endif; ?>

                        <?php if(!empty($settings['tp_tes_sec_title'])) : ?>
                        <h3 class="tp-testimonial-section-title text-center"><?php echo esc_html($settings['tp_tes_sec_title']); ?></h3>
                        <?php endif; ?>

                        <div class="row justify-content-center">
                           <div class="col-xl-8 col-lg-8 col-md-10">
                              <div class="tp-testimonial-slider-active swiper-container">
                                 <div class="swiper-wrapper">
                                 <?php foreach ($settings['reviews_list'] as $index => $item) :
                                    if ( !empty($item['reviewer_image']['url']) ) {
                                    $tp_reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id'], $settings['thumbnail_size_size']) : $item['reviewer_image']['url'];
                                    $tp_reviewer_image_alt = get_post_meta($item["reviewer_image"]["id"], "_wp_attachment_image_alt", true);
                                    }
                                ?>
                                    <div class="tp-testimonial-item text-center mb-20 swiper-slide">
                                       <div class="tp-testimonial-rating">                                          
                                            <?php for ($i=0; $i < $item['review_rating']; $i++) : ?> 
                                            <span><i class="fa-solid fa-star"></i></span>
                                            <?php endfor; ?>                                                
                                       </div>
                                       <?php if ( !empty($item['review_content']) ) : ?>
                                       <div class="tp-testimonial-content">
                                            <p class="tp-el-box-desc"><?php echo tp_kses($item['review_content']); ?></p>
                                        </div>
                                        <?php endif; ?>

                                       <div class="tp-testimonial-user-wrapper d-flex align-items-center justify-content-center">
                                          <div class="tp-testimonial-user d-flex align-items-center">
                                          <?php if ( !empty($tp_reviewer_image) ) : ?>
                                            <div class="tp-testimonial-avater mr-10">
                                                <img src="<?php echo esc_url($tp_reviewer_image); ?>" alt="<?php echo esc_url($tp_reviewer_image_alt); ?>">
                                            </div>

                                            <?php endif; ?>

                                            <div class="tp-testimonial-user-info tp-testimonial-user-translate">
                                                <?php if ( !empty($item['reviewer_name']) ) : ?>
                                                <h3 class="tp-testimonial-user-title"><?php echo tp_kses($item['reviewer_name']); ?></h3>
                                                <?php endif; ?>
                                                <?php if ( !empty($item['reviewer_title']) ) : ?>
                                                <span class="tp-testimonial-designation"><?php echo tp_kses($item['reviewer_title']); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        
                                          </div>
                                       </div>
                                    </div>
                                    <?php endforeach; ?>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="tp-testimonial-arrow d-none d-md-block">
                           <button class="tp-testimonial-slider-button-prev">
                              <svg width="17" height="14" viewBox="0 0 17 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M1.061 6.99959L16 6.99959" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M7.08618 1L1.06079 6.9995L7.08618 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                              </svg>
                           </button>
                           <button class="tp-testimonial-slider-button-next">
                              <svg width="17" height="14" viewBox="0 0 17 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M15.939 6.99959L1 6.99959" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M9.91382 1L15.9392 6.9995L9.91382 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                              </svg>
                           </button>
                        </div>
                        <div class="tp-testimonial-slider-dot tp-swiper-dot text-center mt-30 tp-swiper-dot-style-darkRed d-md-none"></div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- testimonial area end -->

        <?php endif; ?>

        <?php
	}
}

$widgets_manager->register( new TP_Testimonial_Slider() );
