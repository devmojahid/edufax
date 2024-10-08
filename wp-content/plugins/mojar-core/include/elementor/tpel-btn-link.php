<?php

namespace MSCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Ms Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class MS_ElBtn_Link extends Widget_Base
{

	use \MSCore\Widgets\MSCoreElementFunctions;

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'tpel-btn-link';
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
	public function get_title()
	{
		return __('MS Elements Link BTN', 'mscore');
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
	public function get_icon()
	{
		return 'ms-icon';
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
	public function get_categories()
	{
		return ['mscore'];
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
	public function get_script_depends()
	{
		return ['mscore'];
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

	protected function register_controls()
	{
		$this->register_controls_section();
		$this->style_tab_content();
	}

	protected function register_controls_section()
	{
		$this->start_controls_section(
			'ms_layout',
			[
				'label' => esc_html__('Design Layout', 'ms-core'),
			]
		);
		$this->add_control(
			'ms_design_style',
			[
				'label' => esc_html__('Select Layout', 'ms-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'layout-1' => esc_html__('Layout 1', 'ms-core'),
					'layout-2' => esc_html__('Layout 2', 'ms-core'),
				],
				'default' => 'layout-1',
			]
		);

		$this->end_controls_section();

		$this->ms_button_render_controls('tpbtn', 'Button Border');
	}

	protected function style_tab_content()
	{
		$this->ms_link_controls_style('tpel_btn', 'Button Style', '.ms-el-btn');
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
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$control_id = 'tpbtn';
?>

		<?php if ($settings['ms_design_style']  == 'layout-2') :
			$this->ms_link_controls_render('tpbtn', 'ms-link-btn-circle justify-content-center', $this->get_settings());
		?>

			<!-- button start -->
			<?php if (!empty($settings['ms_' . $control_id . '_text']) && $settings['ms_' . $control_id . '_button_show'] == 'yes') : ?>
				<a <?php echo $this->get_render_attribute_string('ms-button-arg'); ?>>
					<?php echo $settings['ms_' . $control_id . '_text']; ?>
					<span>
						<i class="fa-regular fa-arrow-right"></i>
						<i class="fa-regular fa-arrow-right"></i>
					</span>
				</a>
			<?php endif; ?>
			<!-- button end -->

			<!-- button style 1 -->
		<?php else :
			// Link
			$this->ms_link_controls_render('tpbtn', 'ms-link-btn-2', $this->get_settings());
		?>

			<!-- button start -->
			<?php if (!empty($settings['ms_' . $control_id . '_text']) && $settings['ms_' . $control_id . '_button_show'] == 'yes') : ?>
				<a <?php echo $this->get_render_attribute_string('ms-button-arg'); ?>>
					<?php echo $settings['ms_' . $control_id . '_text']; ?>
					<span>
						<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M1 7H13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
							<path d="M7 1L13 7L7 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
						</svg>
					</span>
				</a>
			<?php endif; ?>
			<!-- button end -->

		<?php endif; ?>

<?php
	}
}

$widgets_manager->register(new MS_ElBtn_Link());
