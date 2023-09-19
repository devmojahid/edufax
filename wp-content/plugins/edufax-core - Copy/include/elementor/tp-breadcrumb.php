<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;
use Elementor\Core\Utils\ImportExport\Url;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Breadcrumb extends Widget_Base {

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
        return 'tp-breadcrumb';
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
        return __( 'TP Breadcrumb', 'tpcore' );
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
         'tp_banner_sec',
             [
               'label' => esc_html__( 'Title & Content', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );
        
        $this->add_control(
        'tp_breadcrumb_subtitle',
         [
            'label'       => esc_html__( 'Breadcrumb Subtitle', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'About Us', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
            'label_block' => true,
            'condition'=> [
                'tp_design_style' => 'layout-2'
            ]
         ]
        );
        
        $this->add_control(
        'tp_breadcrumb_title',
         [
            'label'       => esc_html__( 'Breadcrumb Title', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'Keep it Minimal, yet Expressive', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
            'label_block' => true
         ]
        );
        $this->add_responsive_control(
            'tp_section_align',
            [
                'label' => esc_html__('Alignment', 'tp-core'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'text-start' => [
                        'title' => esc_html__('Left', 'tp-core'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__('Center', 'tp-core'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'text-end' => [
                        'title' => esc_html__('Right', 'tp-core'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'text-center',
                'toggle' => false,
            ]
        );

        $this->end_controls_section();

    }

    protected function style_tab_content(){
		$this->tp_section_style_controls('services_section', 'Section - Style', '.tp-el-section');
        
        $this->tp_basic_style_controls('services_box_title', 'Box - Title', '.tp-el-title');
        $this->tp_basic_style_controls('services_box_list', 'Box - List', '.tp-el-list span');
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

        <?php if ( $settings['tp_design_style']  == 'layout-2' ): ?>




        <?php else:
            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }
        ?>

         <!-- breadcrumb area start -->
         <section class="breadcrumb__area include-bg <?php echo esc_attr($settings['tp_section_align']); ?> pt-95 pb-50 tp-el-section">
            <div class="container">
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="breadcrumb__content p-relative z-index-1">
                        <?php if(!empty($settings['tp_breadcrumb_title'])) : ?>                        
                        <h3 class="breadcrumb__title tp-el-title"><?php echo tp_kses($settings['tp_breadcrumb_title']); ?></h3>
                        <?php endif; ?>
                        <div class="breadcrumb__list tp-el-list">
                            <?php if(function_exists('bcn_display')) {
                                bcn_display();
                            } ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- breadcrumb area end -->

        <?php endif; ?>

        <?php
    }
}

$widgets_manager->register( new TP_Breadcrumb() );
