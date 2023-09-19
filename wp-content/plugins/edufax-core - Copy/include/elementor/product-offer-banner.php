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
class TP_Product_Offer extends Widget_Base {

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
		return 'tp-product-offer';
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
		return __( 'Product Offer Banner', 'tpcore' );
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

        $this->tp_section_title_render_controls('product_offer', 'Section Title');

        $this->start_controls_section(
         'tp_product_offer_sec',
             [
               'label' => esc_html__( 'Offer Banner', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );
        
        $this->add_control(
        'tp_product_offer_time',
         [
            'label'       => esc_html__( 'Offer Time', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'Sep 30 2024 20:20:22', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Date', 'tpcore' ),
            'label_block' => true
         ]
        );

        $this->add_control(
         'tp_product_offer_shape_switcher',
         [
           'label'        => esc_html__( 'Enable Shape?', 'tpcore' ),
           'type'         => \Elementor\Controls_Manager::SWITCHER,
           'label_on'     => esc_html__( 'Show', 'tpcore' ),
           'label_off'    => esc_html__( 'Hide', 'tpcore' ),
           'return_value' => 'yes',
           'default'      => 'yes',
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
        $bloginfo = get_bloginfo( 'name' );  
		?>

		<?php if ( $settings['tp_design_style']  == 'layout-2' ): ?>

		<?php else: 
            $this->add_render_attribute('title_args', 'class', 'tp-deal-title tp-el-title');
		?>	
        
         <!-- deal area start -->
         <section class="tp-deal-area pt-135 pb-140 p-relative z-index-1 fix scene" data-bg-color="#F3F3F3">

         <?php if($settings['tp_product_offer_shape_switcher'] == 'yes') : ?>
            <div class="tp-deal-shape">
               <img class="tp-deal-shape-7" src="<?php echo get_template_directory_uri(); ?>/assets/img/deal/shape/shape-7.png" alt="<?php echo esc_attr($bloginfo); ?>">
            </div>
            <div class="tp-deal-shape">
               <div class="tp-deal-shape-1">
                  <img class="layer" data-depth=".2" src="<?php echo get_template_directory_uri(); ?>/assets/img/deal/shape/shape-1.png" alt="<?php echo esc_attr($bloginfo); ?>">
               </div>
               <div class="tp-deal-shape-2">
                  <img class="layer" data-depth=".3" src="<?php echo get_template_directory_uri(); ?>/assets/img/deal/shape/shape-2.png" alt="<?php echo esc_attr($bloginfo); ?>">
               </div>
               <div class="tp-deal-shape-3">
                  <img class="layer" data-depth=".4" src="<?php echo get_template_directory_uri(); ?>/assets/img/deal/shape/shape-3.png" alt="<?php echo esc_attr($bloginfo); ?>">
               </div>
               <div class="tp-deal-shape-4">
                  <img class="layer" data-depth=".5" src="<?php echo get_template_directory_uri(); ?>/assets/img/deal/shape/shape-4.png" alt="<?php echo esc_attr($bloginfo); ?>">
               </div>
               <div class="tp-deal-shape-5">
                  <img class="layer" data-depth=".6" src="<?php echo get_template_directory_uri(); ?>/assets/img/deal/shape/shape-5.png" alt="<?php echo esc_attr($bloginfo); ?>">
               </div>
               <div class="tp-deal-shape-6">
                  <img class="layer" data-depth=".7" src="<?php echo get_template_directory_uri(); ?>/assets/img/deal/shape/shape-6.png" alt="<?php echo esc_attr($bloginfo); ?>">
               </div>
            </div>
            <?php endif; ?>
            <div class="container">
               <div class="row justify-content-center">
                  <div class="col-xl-6 col-lg-7">
                     <div class="tp-deal-content text-center">
                     <?php if ( !empty($settings['tp_product_offer_section_title_show']) ) : ?>
                        <div class="tp-deal-content-wrapper mb-35">
                            <?php if ( !empty($settings['tp_product_offer_sub_title']) ) : ?>
                                <span class="tp-deal-title-pre">
                                    <?php echo tp_kses( $settings['tp_product_offer_sub_title'] ); ?>
                                    <svg width="82" height="22" viewBox="0 0 82 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M81 14.5798C0.890564 -8.05914 -5.81154 0.0503902 5.00322 21" stroke="currentColor" stroke-opacity="0.3" stroke-width="2" stroke-miterlimit="3.8637" stroke-linecap="round"/>
                                    </svg>
                                </span>
                            <?php endif; ?>
    
                            <?php
                                if ( !empty($settings['tp_product_offer_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['tp_product_offer_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        tp_kses( $settings['tp_product_offer_title' ] )
                                        );
                                endif;
                            ?>
    
                            <?php if ( !empty($settings['tp_product_offer_description']) ) : ?>
                                <p><?php echo tp_kses( $settings['tp_product_offer_description'] ); ?></p>
                            <?php endif; ?>

                        </div>
                        <?php endif; ?>
                        <div class="tp-deal-countdown">
                           <div class="tp-product-countdown" data-countdown data-date="<?php echo esc_attr($settings['tp_product_offer_time']) ?>">
                              <div class="tp-product-countdown-inner">
                                 <ul>
                                    <li><span data-days>0</span> Days</li>
                                    <li><span data-hours>0</span> Hours</li>
                                    <li><span data-minutes>0</span> Mins</li>
                                    <li><span data-seconds>0</span> Secs</li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- deal area end -->

        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new TP_Product_Offer() );