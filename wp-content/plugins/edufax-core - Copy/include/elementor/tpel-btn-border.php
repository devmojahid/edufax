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
class TP_ElBtn_Border extends Widget_Base {

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
		return 'tpel-btn-border';
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
		return __( 'TP Elements Bordered BTN', 'tpcore' );
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
                    'layout-2' => esc_html__('Layout 2', 'tp-core'),
                    'layout-3' => esc_html__('Layout 3', 'tp-core'),
                    'layout-4' => esc_html__('Layout 4', 'tp-core'),
                    'layout-5' => esc_html__('Layout 5', 'tp-core'),
                    'layout-6' => esc_html__('Layout 6', 'tp-core'),
                    'layout-7' => esc_html__('Layout 7', 'tp-core'),
                    'layout-8' => esc_html__('Layout 8', 'tp-core'),
                    'layout-9' => esc_html__('Layout 9', 'tp-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->tp_button_render_controls('tpbtn', 'Button Border');
    }

	protected function style_tab_content() {
       $this->tp_link_controls_style('tpel_btn', 'Button Style', '.tp-el-btn');
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
            $control_id = 'tpbtn';
		?>

		<?php if ( $settings['tp_design_style']  == 'layout-2' ): 
            $this->tp_link_controls_render('tpbtn', 'tp-btn-border-brown', $this->get_settings());
        ?>

            <!-- button start -->
            <?php if (!empty($settings['tp_' . $control_id .'_text']) && $settings['tp_' . $control_id .'_button_show'] == 'yes') : ?>
            <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>> <?php echo $settings['tp_' . $control_id .'_text']; ?> </a>
            <?php endif; ?>
            <!-- button end -->

        <!-- button style 3 -->
        <?php elseif ( $settings['tp_design_style']  == 'layout-3' ): 
            $this->tp_link_controls_render('tpbtn', 'tp-btn-border-green', $this->get_settings());
        ?>
        
            <!-- button start -->
            <?php if (!empty($settings['tp_' . $control_id .'_text']) && $settings['tp_' . $control_id .'_button_show'] == 'yes') : ?>
            <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>> <?php echo $settings['tp_' . $control_id .'_text']; ?> </a>
            <?php endif; ?>
            <!-- button end -->

        <!-- button style 4 -->
        <?php elseif ( $settings['tp_design_style']  == 'layout-4' ): 
            $this->tp_link_controls_render('tpbtn', 'tp-btn-9', $this->get_settings());
        ?>
        
            <!-- button start -->
            <?php if (!empty($settings['tp_' . $control_id .'_text']) && $settings['tp_' . $control_id .'_button_show'] == 'yes') : ?>
            <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>> <?php echo $settings['tp_' . $control_id .'_text']; ?> </a>
            <?php endif; ?>
            <!-- button end -->

        <!-- button style 5 -->
        <?php elseif ( $settings['tp_design_style']  == 'layout-5' ): 
            $this->tp_link_controls_render('tpbtn', 'tp-load-more-btn', $this->get_settings());
        ?>
        
            <!-- button start -->
            <?php if (!empty($settings['tp_' . $control_id .'_text']) && $settings['tp_' . $control_id .'_button_show'] == 'yes') : ?>
            <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>> <?php echo $settings['tp_' . $control_id .'_text']; ?> </a>
            <?php endif; ?>
            <!-- button end -->

        <!-- button style 6 -->
        <?php elseif ( $settings['tp_design_style']  == 'layout-6' ): 
            $this->tp_link_controls_render('tpbtn', 'tp-btn-border-5', $this->get_settings());
        ?>
        
            <!-- button start -->
            <?php if (!empty($settings['tp_' . $control_id .'_text']) && $settings['tp_' . $control_id .'_button_show'] == 'yes') : ?>
            <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>> <?php echo $settings['tp_' . $control_id .'_text']; ?> </a>
            <?php endif; ?>
            <!-- button end -->

        <!-- button style 7 -->
        <?php elseif ( $settings['tp_design_style']  == 'layout-7' ): 
            $this->tp_link_controls_render('tpbtn', 'tp-btn-border-9', $this->get_settings());
        ?>
        
            <!-- button start -->
            <?php if (!empty($settings['tp_' . $control_id .'_text']) && $settings['tp_' . $control_id .'_button_show'] == 'yes') : ?>
            <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>> <?php echo $settings['tp_' . $control_id .'_text']; ?> </a>
            <?php endif; ?>
            <!-- button end -->

        <!-- button style 8 -->
        <?php elseif ( $settings['tp_design_style']  == 'layout-8' ): 
            $this->tp_link_controls_render('tpbtn', 'tp-btnr-border tp-btn-shine-effect', $this->get_settings());
        ?>
        
            <!-- button start -->
            <?php if (!empty($settings['tp_' . $control_id .'_text']) && $settings['tp_' . $control_id .'_button_show'] == 'yes') : ?>
            <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>> <?php echo $settings['tp_' . $control_id .'_text']; ?> </a>
            <?php endif; ?>
            <!-- button end -->

        <!-- button style 1 -->
		<?php else: 
            // Link
            $this->tp_link_controls_render('tpbtn', 'tp-btn-border-pink', $this->get_settings());
		?>	

        <!-- button start -->
        <?php if (!empty($settings['tp_' . $control_id .'_text']) && $settings['tp_' . $control_id .'_button_show'] == 'yes') : ?>
        <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>> <?php echo $settings['tp_' . $control_id .'_text']; ?> </a>
        <?php endif; ?>
        <!-- button end -->

        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new TP_ElBtn_Border() );