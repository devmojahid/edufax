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
class TP_Footer_Widget_Title extends Widget_Base {

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
        return 'tp-footer-widget-title';
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
        return __( 'Footer Widget Title', 'tpcore' );
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

        $this->start_controls_section(
            'tp_footer_title_sec',
            [
                'label' => esc_html__('Footer Widet Title', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_footer_widget_title',
            [
                'label'       => esc_html__( 'Widget Title', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'My Widget List', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
            ]
        );

        $this->end_controls_section();

    }


    protected function style_tab_content(){
        $this->tp_basic_style_controls('footer_widget_title', 'Title', '.tp-el-title');
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
            <?php if(!empty($settings['tp_footer_widget_title'])) : ?>
            <h4 class="tp-footer-widget-title tp-el-title"><?php echo esc_html($settings['tp_footer_widget_title']); ?></h4>
            <?php endif; ?>

        <?php
    }
}

$widgets_manager->register( new TP_Footer_Widget_Title() );
