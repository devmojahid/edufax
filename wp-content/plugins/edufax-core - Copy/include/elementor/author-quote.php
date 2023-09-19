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
class TP_Author_Quote extends Widget_Base {

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
		return 'tp-author-quote';
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
		return __( 'TP Author Quote', 'tpcore' );
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

    protected function register_controls_section(){
        // layout Panel
        $this->start_controls_section(
            'tp_layout',
            [
                'label' => esc_html__('Design Layout', 'tp-core'),
            ]
        );
        $this->add_control(
            'tp_design_style',
            [
                'label' => esc_html__('Select Layout', 'tp-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'tp-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
		 'tp_author_quote_sec',
			 [
			   'label' => esc_html__( 'Author Info', 'tpcore' ),
			   'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			 ]
		);

        $this->add_control(
         'tp_author_thumb',
         [
           'label'   => esc_html__( 'Upload Author Image', 'tpcore' ),
           'type'    => \Elementor\Controls_Manager::MEDIA,
             'default' => [
               'url' => \Elementor\Utils::get_placeholder_image_src(),
           ],
         ]
        );

		$this->add_control(
		'tp_author_name',
            [
                'label'       => esc_html__( 'Author Name', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Theodore Handle', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Title', 'tpcore' ),
                'label_block' => true
            ]
		);
		$this->add_control(
		'tp_author_designation',
            [
                'label'       => esc_html__( 'Author Designation', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( ' UI/UX design ', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Title', 'tpcore' ),
                'label_block' => true
            ]
		);
		
		$this->add_control(
         'tp_author_quote',
         [
           'label'       => esc_html__( 'Author Quote Text', 'tpcore' ),
           'type'        => \Elementor\Controls_Manager::TEXTAREA,
           'rows'        => 10,
           'default'     => esc_html__( 'We work with top suppliers and manufacturers to ensure that every item we ', 'tpcore' ),
           'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
         ]
        );

        $this->add_control(
         'tp_author_shape_switch',
         [
           'label'        => esc_html__( 'Enable Shape ?', 'tpcore' ),
           'type'         => \Elementor\Controls_Manager::SWITCHER,
           'label_on'     => esc_html__( 'Show', 'tpcore' ),
           'label_off'    => esc_html__( 'Hide', 'tpcore' ),
           'return_value' => 'yes',
           'default'      => 'yes',
         ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
		
		$this->end_controls_section();

        $this->start_controls_section(
         'tp_author_bg_sec',
             [
               'label' => esc_html__( 'Background Image', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );
        
        $this->add_control(
         'tp_author_bg_image',
         [
           'label'   => esc_html__( 'Upload Background Image', 'tpcore' ),
           'type'    => \Elementor\Controls_Manager::MEDIA,
             'default' => [
               'url' => \Elementor\Utils::get_placeholder_image_src(),
           ],
         ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail_bg',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        
        $this->end_controls_section();

		$this->start_controls_section(
		 'tp_brand_sec',
			 [
			   'label' => esc_html__( 'Brand List', 'tpcore' ),
			   'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			 ]
		);
		
		$repeater = new \Elementor\Repeater();
		
		$repeater->add_control(
		'tp_brand_title',
		  [
			'label'   => esc_html__( 'Brand Title', 'tpcore' ),
			'type'        => \Elementor\Controls_Manager::TEXT,
			'default'     => esc_html__( 'Brand', 'tpcore' ),
			'label_block' => true,
		  ]
		);

        $repeater->add_control(
         'tp_brand_image',
         [
           'label'   => esc_html__( 'Upload Brand Image', 'tpcore' ),
           'type'    => \Elementor\Controls_Manager::MEDIA,
             'default' => [
               'url' => \Elementor\Utils::get_placeholder_image_src(),
           ],
         ]
        );
		
		$this->add_control(
		  'tp_brand_list',
		  [
			'label'       => esc_html__( 'Brand List', 'tpcore' ),
			'type'        => \Elementor\Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'default'     => [
			  [
				'tp_brand_title'   => esc_html__( 'Brand Image', 'tpcore' ),
			  ],
			  [
				'tp_brand_title'   => esc_html__( 'Brand Image', 'tpcore' ),
			  ],
			  [
				'tp_brand_title'   => esc_html__( 'Brand Image', 'tpcore' ),
			  ],
			],
			'title_field' => '{{{ tp_brand_title }}}',
		  ]
		);
		
		
		$this->end_controls_section();
    }

    protected function style_tab_content(){
		$this->tp_basic_style_controls('history_title', 'Title', '.tp-el-box-title');
		$this->tp_basic_style_controls('history_list', 'List', '.tp-el-box-list');
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

            if ( !empty($settings['tp_author_bg_image']['url']) ) {
                $tp_author_bg_image_url = !empty($settings['tp_author_bg_image']['id']) ? wp_get_attachment_image_url( $settings['tp_author_bg_image']['id'], $settings['thumbnail_size']) : $settings['tp_author_bg_image']['url'];
                $tp_author_bg_image_alt = get_post_meta($settings["tp_author_bg_image"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['tp_author_thumb']['url']) ) {
                $tp_author_thumb_url = !empty($settings['tp_author_thumb']['id']) ? wp_get_attachment_image_url( $settings['tp_author_thumb']['id'], $settings['thumbnail_size']) : $settings['tp_author_thumb']['url'];
                $tp_author_thumb_alt = get_post_meta($settings["tp_author_thumb"]["id"], "_wp_attachment_image_alt", true);
            }
		?>


         <!-- author area start -->
         <section class="tp-author-area pb-120">
            <div class="container">
               <div class="tp-author-inner p-relative z-index-1 tp-author-bg-overlay fix" data-bg-color="#821F40">

                    <?php if($settings['tp_author_shape_switch'] == 'yes'): ?>
                    <!-- shape -->
                    <span class="tp-author-shape-1"></span>
                    <!-- shape end -->
                    <?php endif; ?>

                  <div class="tp-author-bg include-bg "  data-background="<?php echo esc_url($tp_author_bg_image_url); ?>"></div>
                  <div class="row align-items-center">
                     <div class="col-xl-6 col-lg-6">
                        <div class="tp-author-wrapper p-relative z-index-1">
                           <div class="tp-author-info-wrapper d-flex align-items-center mb-30">

                                <?php if(!empty($tp_author_thumb_url)): ?>
                                <div class="tp-author-info-avater mr-10">
                                    <img src="<?php echo esc_url($tp_author_thumb_url); ?>" alt="<?php echo esc_attr($tp_author_bg_image_alt); ?>">
                                </div>
                                <?php endif; ?>

                              <div class="tp-author-info">

                                <?php if(!empty($settings['tp_author_name'])) : ?>
                                <h3 class="tp-author-info-title"><?php echo esc_html($settings['tp_author_name']); ?></h3>
                                <?php endif; ?>
                                
                                <?php if(!empty($settings['tp_author_designation'])) : ?>
                                <span class="tp-author-info-designation"><?php echo esc_html($settings['tp_author_designation']); ?></span>
                                <?php endif; ?>
                              </div>
                           </div>
                            <?php if(!empty($settings['tp_author_quote'])) : ?>
                           <div class="tp-author-content">
                              <p><?php echo esc_html($settings['tp_author_quote']); ?></p>
                           </div>
                            <?php endif; ?>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6">
                        <div class="tp-author-brand-wrapper d-flex flex-wrap align-items-center justify-content-lg-end">
                            <?php foreach ($settings['tp_brand_list'] as $key => $item) :  
                                if ( !empty($item['tp_brand_image']['url']) ) {
                                    $tp_brand_image_url = !empty($item['tp_brand_image']['id']) ? wp_get_attachment_image_url( $item['tp_brand_image']['id'], $settings['thumbnail_size']) : $item['tp_brand_image']['url'];
                                    $tp_brand_image_alt = get_post_meta($item["tp_brand_image"]["id"], "_wp_attachment_image_alt", true);
                                }
                            ?>
                           <div class="tp-author-brand-item text-center">
                              <img src="<?php echo esc_url($tp_brand_image_url); ?>" alt="<?php echo esc_attr($tp_brand_image_alt); ?>">
                           </div>
                           <?php endforeach; ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- testimonial area end -->
         

        <?php 
	}
}

$widgets_manager->register( new TP_Author_Quote() );