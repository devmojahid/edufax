<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Contact_Common extends Widget_Base {

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
		return 'tp-contact-common';
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
		return __( 'TP Common Contact', 'tpcore' );
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


    public function get_tp_contact_form(){
        if ( ! class_exists( 'WPCF7' ) ) {
            return;
        }
        $tp_cfa         = array();
        $tp_cf_args     = array( 'posts_per_page' => -1, 'post_type'=> 'wpcf7_contact_form' );
        $tp_forms       = get_posts( $tp_cf_args );
        $tp_cfa         = ['0' => esc_html__( 'Select Form', 'tpcore' ) ];
        if( $tp_forms ){
            foreach ( $tp_forms as $tp_form ){
                $tp_cfa[$tp_form->ID] = $tp_form->post_title;
            }
        }else{
            $tp_cfa[ esc_html__( 'No contact form found', 'tpcore' ) ] = 0;
        }
        return $tp_cfa;
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
            'tpcore_contact',
            [
                'label' => esc_html__('Contact Form', 'tpcore'),
            ]
        );

        $this->add_control(
            'tpcore_select_contact_form',
            [
                'label'   => esc_html__( 'Select Form', 'tpcore' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '0',
                'options' => $this->get_tp_contact_form(),
            ]
        );

        $this->end_controls_section();


        // tp_section_title
        $this->start_controls_section(
            'tp_section_title',
            [
                'label' => esc_html__('Title & Content', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_section_title_show',
            [
                'label' => esc_html__( 'Section Title & Content', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tpcore' ),
                'label_off' => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'tp_sub_title',
            [
                'label' => esc_html__('Sub Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('TP Sub Title', 'tpcore'),
                'placeholder' => esc_html__('Type Sub Heading Text', 'tpcore'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'tp_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('TP Title Here', 'tpcore'),
                'placeholder' => esc_html__('Type Heading Text', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tp_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('TP section description here', 'tpcore'),
                'placeholder' => esc_html__('Type section description here', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_title_tag',
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

        $this->add_responsive_control(
            'tp_align',
            [
                'label' => esc_html__('Alignment', 'tpcore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'tpcore'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'tpcore'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'tpcore'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => false,
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};'
                ]
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
         'tp_job_contact_btn_sec',
             [
               'label' => esc_html__( 'Button', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
               'condition' => [
                    'tp_design_style' => 'layout-2'
               ]
             ]
        );
        
        
        $this->add_control(
            'tp_btn_button_show',
            [
                'label' => esc_html__( 'Show Button', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tpcore' ),
                'label_off' => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'tp_btn_text',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_btn_button_show' => 'yes'
                ],
            ]
        );
      
        
        $this->end_controls_section();

        $this->start_controls_section(
         'tp_contact_info_sec',
             [
               'label' => esc_html__( 'Box Title & Content', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
               'condition' => [
                'tp_design_style' => 'layout-3'
               ]
             ]
        );
        
        $this->add_control(
            'tp_contact_info_title',
             [
                'label'       => esc_html__( 'Title', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Send Us a Mail', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
                'label_block' => true,
             ]
        );

        $this->add_control(
         'tp_contact_info_desc',
            [
                'label'       => esc_html__( 'Description', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'rows'        => 10,
                'default'     => esc_html__( 'Do you have a query about your order, or need a hand with getting your products set up?', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
            ]
        );
        
        $this->end_controls_section();


        $this->start_controls_section(
         'tp_contact_box_sec',
             [
               'label' => esc_html__( 'Info Box', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
               'condition' => [
                'tp_design_style' => 'layout-3'
               ]
             ]
        );
        
        $this->add_control(
            'tp_contact_box_title',
             [
                'label'       => esc_html__( 'Title', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Reach Out', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
                'label_block' => true,
             ]
        );
        
        $this->add_control(
            'tp_contact_box_desc',
               [
                   'label'       => esc_html__( 'Description', 'tpcore' ),
                   'type'        => \Elementor\Controls_Manager::TEXTAREA,
                   'rows'        => 10,
                   'default'     => esc_html__( 'Any confusion about your order? We are here to help 24/7', 'tpcore' ),
                   'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
               ]
        );

        $this->add_control(
         'tp_contact_info_note',
         [
           'label'       => esc_html__( 'Additional Info', 'tpcore' ),
           'type'        => \Elementor\Controls_Manager::TEXTAREA,
           'rows'        => 10,
           'default'     => esc_html__( 'See our Refund Policies or FAQ', 'tpcore' ),
           'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
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
            'tp_box_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'tpcore'),
                    'icon' => esc_html__('Icon', 'tpcore'),
                    'svg' => esc_html__('SVG', 'tpcore'),
                ],
            ]
        );
        $repeater->add_control(
            'tp_box_icon_svg',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'tpcore'),
                'condition' => [
                    'tp_box_icon_type' => 'svg',
                ]
            ]
        );

        $repeater->add_control(
            'tp_box_icon_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_box_icon_type' => 'image',
                ]
            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tp_box_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tp_box_icon_type' => 'icon',
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'tp_box_selected_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fas fa-star',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'tp_box_icon_type' => 'icon',
                    ]
                ]
            );
        }
        
        $repeater->add_control(
         'tp_contact_box_title',
           [
             'label'   => esc_html__( 'Conact Title', 'tpcore' ),
             'type'        => \Elementor\Controls_Manager::TEXT,
             'default'     => esc_html__( 'Contact Us', 'tpcore' ),
             'label_block' => true,
           ]
         );

         $repeater->add_control(
            'tp_contact_type',
            [
              'label'   => esc_html__( 'Select Type', 'tpcore' ),
              'type' => \Elementor\Controls_Manager::SELECT,
              'options' => [
                'default'  => esc_html__( 'Default', 'tpcore' ),
                'email'  => esc_html__( 'Email', 'tpcore' ),
                'phone'  => esc_html__( 'Phone', 'tpcore' ),
                'map'  => esc_html__( 'Map', 'tpcore' ),
              ],
              'default' => 'default',
            ]
           );

         $repeater->add_control(
          'tp_contact_box_title_url',
          [
            'label'   => esc_html__( 'URL', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::URL,
            'default'     => [
                'url'               => '#',
                'is_external'       => true,
                'nofollow'          => true,
                'custom_attributes' => '',
              ],
              'placeholder' => esc_html__( 'Your URL', 'tpcore' ),
              'label_block' => true,
            ]
          );

         $repeater->add_control(
          'enable_underline_style',
          [
            'label'        => esc_html__( 'Enable Underline Style', 'tpcore' ),
            'type'         => \Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Show', 'tpcore' ),
            'label_off'    => esc_html__( 'Hide', 'tpcore' ),
            'return_value' => 'yes',
            'default'      => 'no',
          ]
         );

        
   
           $repeater->add_control(
            'tp_contact_map_url',
            [
              'label'   => esc_html__( 'Map URL', 'tpcore' ),
              'type'        => \Elementor\Controls_Manager::URL,
              'default'     => [
                  'url'               => '#',
                  'is_external'       => true,
                  'nofollow'          => true,
                  'custom_attributes' => '',
                ],
                'placeholder' => esc_html__( 'Your URL', 'tpcore' ),
                'label_block' => true,
                'condition' => [
                   'tp_contact_type' => 'map'
                ]
              ]
        );
         
         $this->add_control(
            'tp_contact_box_list',
            [
              'label'       => esc_html__( 'Info List', 'tpcore' ),
              'type'        => \Elementor\Controls_Manager::REPEATER,
              'fields'      => $repeater->get_controls(),
              'default'     => [
                [
                  'tp_contact_box_title'   => esc_html__( 'Start Chat', 'tpcore' ),
                ],
              ],
              'title_field' => '{{{ tp_contact_box_title }}}',
            ]
          );
        
        $this->end_controls_section();

        
        $this->tp_section_style_controls('comint_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('about_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('about_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('about_description', 'Section - Description', '.tp-el-content p');

		$this->tp_basic_style_controls('section_subtitle', 'Contact - Title', '.tp-el-contact-title');
		$this->tp_basic_style_controls('section_contact_desc', 'Contact - Description', '.tp-el-contact-desc');

		$this->tp_icon_style('section_icon', 'Box - Icon', '.tp-el-box-icon');
		$this->tp_basic_style_controls('section_title', 'Box - Title', '.tp-el-box-title');
		$this->tp_basic_style_controls('section_desc', 'Box - Description', '.tp-el-box-desc');
		$this->tp_basic_style_controls('section_info', 'Box - Info', '.tp-el-box-info p');
		$this->tp_basic_style_controls('section_note', 'Box - Note', '.tp-el-box-note p');

        $this->tp_input_controls_style('contact_input', 'Box - Input', '.tp-el-contact-input input','.tp-el-contact-input textarea');
        $this->tp_link_controls_style('contact_btn', 'Box - Button', '.tp-el-contact-input-btn button');
        $this->tp_link_controls_style('contact_btn_btn', 'Box - Button', '.tp-el-box-btn');
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
            $this->add_render_attribute('title_args', 'class', 'job__form-title tp-el-title');
		?>
		
         <!-- job details area start -->
         <section class="job__details-area tp-el-section">
            <div class="container">
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="job__details-wrapper">
                     <?php if (!empty($settings['tp_btn_text'])) : ?>
                        <div class="job__details-btn">
                           <button type="button" class="tp-btn job-form-open-btn tp-el-box-btn"><?php echo $settings['tp_btn_text']; ?></button>
                        </div>
                        <?php endif; ?>
                        <div class="job__form job-apply-form mt-40 tp-el-content tp-el-contact-input tp-el-contact-input-btn">
                        <?php if ( !empty($settings['tp_section_title_show']) ) : ?>

                            <?php if ( !empty($settings['tp_sub_title']) ) : ?>
                            <span class="faq__title-pre tp-el-subtitle">
                                <?php echo tp_kses( $settings['tp_sub_title'] ); ?>
                            </span>
                            <?php endif; ?>

                           <?php
                                if ( !empty($settings['tp_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tp_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tp_title' ] )
                                        );
                                endif;
                            ?>
                            <?php if ( !empty($settings['tp_description']) ) : ?>
                                <p><?php echo tp_kses( $settings['tp_description'] ); ?></p>
                            <?php endif; ?>
                        <?php endif; ?>

                        <!-- form here -->
                        <?php if( !empty($settings['tpcore_select_contact_form']) ) : ?>
							<?php echo do_shortcode( '[contact-form-7  id="'.$settings['tpcore_select_contact_form'].'"]' ); ?>

						<?php else : ?>
							<?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'tpcore' ). '</p></div>'; ?>
						<?php endif; ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- job details area emd -->


        <?php elseif( $settings['tp_design_style']  == 'layout-3' ):
            $this->add_render_attribute('title_args', 'class', 'tp-section-title-2 tp-el-title');
		?>

         <!-- contact area start -->
         <section class="contact__area grey-bg-4 pb-120 pt-110 tp-el-section">
            <div class="container">
            <?php if ( !empty($settings['tp_section_title_show']) ) : ?>
               <div class="row justify-content-center">
                  <div class="col-xl-7 col-lg-8">
                     <div class="tp-section-wrapper-2 text-center mb-70 tp-el-subtitle">
                        <?php if ( !empty($settings['tp_sub_title']) ) : ?>
                            <span class="faq__title-pre tp-el-subtitle">
                                <?php echo tp_kses( $settings['tp_sub_title'] ); ?>
                            </span>
                            <?php endif; ?>

                           <?php
                                if ( !empty($settings['tp_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tp_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tp_title' ] )
                                        );
                                endif;
                            ?>
                            <?php if ( !empty($settings['tp_description']) ) : ?>
                                <p><?php echo tp_kses( $settings['tp_description'] ); ?></p>
                            <?php endif; ?>
                     </div>
                  </div>
               </div>
               <?php endif; ?>
               <div class="row">
                  <div class="col-xl-4 col-lg-4">
                     <div class="contact__wrapper-2">
                        <div class="contact__content-2">
                           <?php if ( !empty($settings['tp_contact_info_title']) ) : ?>
                           <h3 class="contact-title tp-el-contact-title"><?php echo tp_kses( $settings['tp_contact_info_title'] ); ?></h3>
                           <?php endif; ?>

                           <?php if ( !empty($settings['tp_contact_info_desc']) ) : ?>
                                <p class="tp-el-contact-desc"><?php echo tp_kses( $settings['tp_contact_info_desc'] ); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="contact__info-box">

                            <?php if ( !empty($settings['tp_contact_box_title']) ) : ?>
                           <h3 class="contact__info-box-title tp-el-box-title"><?php echo tp_kses( $settings['tp_contact_box_title'] ); ?></h3>
                           <?php endif; ?>

                            <?php if ( !empty($settings['tp_contact_box_desc']) ) : ?>
                                <p class="tp-el-box-desc"><?php echo tp_kses( $settings['tp_contact_box_desc'] ); ?></p>
                            <?php endif; ?>

                           <div class="contact__info-item-wrapper d-flex flex-wrap align-items-center">
                            
                           <?php  foreach ($settings['tp_contact_box_list'] as $key => $item) :
                            
                                $enable_underline_style = ($item['enable_underline_style'] == 'yes') ? 'has-fw-400' : '';
                            ?>

                              <div class="contact__info-item">
                                 <div class="contact__info-icon tp-el-box-icon">
                                    <?php if($item['tp_box_icon_type'] == 'icon') : ?>
                                    <?php if (!empty($item['tp_box_icon']) || !empty($item['tp_box_selected_icon']['value'])) : ?>
                                        <span><?php tp_render_icon($item, 'tp_box_icon', 'tp_box_selected_icon'); ?></span>
                                    <?php endif; ?>
                                    <?php elseif( $item['tp_box_icon_type'] == 'image' ) : ?>
                                        <span>
                                            <?php if (!empty($item['tp_box_icon_image']['url'])): ?>
                                            <img src="<?php echo $item['tp_box_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                            <?php endif; ?>
                                        </span>
                                    <?php else : ?>
                                        <span>
                                            <?php if (!empty($item['tp_box_icon_svg'])): ?>
                                            <?php echo $item['tp_box_icon_svg']; ?>
                                            <?php endif; ?>
                                        </span>
                                    <?php endif; ?>
                                 </div>
                                 <div class="contact__info-content tp-el-box-info <?php echo esc_attr($enable_underline_style); ?>">
                                 <?php if($item['tp_contact_type'] == 'email') : ?>
                                    <p><a href="mailto:<?php echo esc_url($item['tp_contact_box_title_url']['url']); ?>"><?php echo esc_html($item['tp_contact_box_title']); ?></a></p>

                                    <?php elseif($item['tp_contact_type'] == 'phone') : ?>
                                    <p><a href="tel:<?php echo esc_url($item['tp_contact_box_title_url']['url']); ?>"><?php echo esc_html($item['tp_contact_box_title']); ?></a></p>
                                    
                                    <?php elseif($item['tp_contact_type'] == 'map') : ?>
                                    <p><a href="<?php echo esc_url($item['tp_contact_map_url']['url']); ?>" target="_blank"><?php echo esc_html($item['tp_contact_box_title']); ?></a></p>
                                    
                                    <?php else : ?>
                                    <p><a href="<?php echo esc_url($item['tp_contact_box_title_url']['url']); ?>" target="_blank"><?php echo esc_html($item['tp_contact_box_title']); ?></a></p>
                                    <?php endif; ?>
                                 </div>
                              </div>

                              <?php endforeach; ?>
                           </div>

                           <?php if(!empty($settings['tp_contact_info_note'])) : ?>
                           <div class="contact__info-box-refund tp-el-box-note">
                              <p><?php echo tp_kses($settings['tp_contact_info_note']); ?></p>
                           </div>
                           <?php endif; ?>
                        </div>

                     </div>
                  </div>
                  <div class="col-xl-8 col-lg-8">
                     <div class="contact__form-3 ml-70 tp-el-contact-input tp-el-contact-input-btn">
                        <?php if( !empty($settings['tpcore_select_contact_form']) ) : ?>
                        <?php echo do_shortcode( '[contact-form-7  id="'.$settings['tpcore_select_contact_form'].'"]' ); ?>
						<?php else : ?>
							<?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'tpcore' ). '</p></div>'; ?>
						<?php endif; ?>              
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- contact area end -->

		<?php else :
			$this->add_render_attribute('title_args', 'class', 'portfolio__comment-title tp-el-title');
		?>
			

         <!-- portfolio comment area start -->
         <section class="portfolio__comment grey-bg-7 pt-90 pb-105 tp-el-section">
            <div class="container">
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="portfolio__comment-top tp-el-content">
                        <?php if ( !empty($settings['tp_sub_title']) ) : ?>
							<span class="tp-sub-title mb-15 tp-el-subtitle"><?php echo tp_kses( $settings['tp_sub_title'] ); ?></span>
						<?php endif; ?>
                        <?php
							if ( !empty($settings['tp_title' ]) ) :
								printf( '<%1$s %2$s>%3$s</%1$s>',
									tag_escape( $settings['tp_title_tag'] ),
									$this->get_render_attribute_string( 'title_args' ),
									tp_kses( $settings['tp_title' ] )
									);
							endif;
						?>
                        <?php if ( !empty($settings['tp_description']) ) : ?>
							<p><?php echo tp_kses( $settings['tp_description'] ); ?></p>
						<?php endif; ?>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="portfolio__comment-form tp-el-contact-input tp-el-contact-input-btn">
                     <?php if( !empty($settings['tpcore_select_contact_form']) ) : ?>
                        <?php echo do_shortcode( '[contact-form-7  id="'.$settings['tpcore_select_contact_form'].'"]' ); ?>
						<?php else : ?>
							<?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'tpcore' ). '</p></div>'; ?>
						<?php endif; ?>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- portfolio comment area end -->

        <?php endif; ?>

        <?php
	}
}

$widgets_manager->register( new TP_Contact_Common() );
