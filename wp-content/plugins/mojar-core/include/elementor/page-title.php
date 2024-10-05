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
class MS_Page_Title extends Widget_Base
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
		return 'ms-page-title';
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
		return __('Page Title', 'mscore');
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
		// layout Panel
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

		$this->ms_section_title_render_controls('page', 'Section Title');
	}

	protected function style_tab_content()
	{
		$this->ms_basic_style_controls('history_title', 'Title', '.ms-el-box-title');
		$this->ms_basic_style_controls('history_list', 'List', '.ms-el-box-list');
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

?>

		<?php if ($settings['ms_design_style']  == 'layout-2') :
			$this->add_render_attribute('title_args', 'class', 'ms-about-banner-title ms-el-title');
		?>
			<div class="ms-about-banner-wrapper">

				<?php if (!empty($settings['ms_page_sub_title'])) : ?>
					<span class="ms-about-banner-subtitle ms-el-subtitle">
						<?php echo ms_kses($settings['ms_page_sub_title']); ?>
					</span>
				<?php endif; ?>

				<?php
				if (!empty($settings['ms_page_title'])) :
					printf(
						'<%1$s %2$s>%3$s</%1$s>',
						tag_escape($settings['ms_page_title_tag']),
						$this->get_render_attribute_string('title_args'),
						ms_kses($settings['ms_page_title'])
					);
				endif;
				?>

				<?php if (!empty($settings['ms_page_description'])) : ?>
					<p><?php echo ms_kses($settings['ms_page_description']); ?></p>
				<?php endif; ?>
			</div>

		<?php else :
			$this->add_render_attribute('title_args', 'class', 'ms-section-title-7 ms-el-title');
		?>

			<!-- section title area start -->
			<div class="ms-section-title-wrapper-7">
				<?php if (!empty($settings['ms_page_section_title_show'])) : ?>
					<?php if (!empty($settings['ms_page_sub_title'])) : ?>
						<span class="ms-section-title-pre-7 ms-el-subtitle">
							<?php echo ms_kses($settings['ms_page_sub_title']); ?>
						</span>
					<?php endif; ?>

					<?php
					if (!empty($settings['ms_page_title'])) :
						printf(
							'<%1$s %2$s>%3$s</%1$s>',
							tag_escape($settings['ms_page_title_tag']),
							$this->get_render_attribute_string('title_args'),
							ms_kses($settings['ms_page_title'])
						);
					endif;
					?>

					<?php if (!empty($settings['ms_page_description'])) : ?>
						<p><?php echo ms_kses($settings['ms_page_description']); ?></p>
					<?php endif; ?>

				<?php endif; ?>
			</div>
			<!-- section title area end -->


		<?php endif; ?>

<?php
	}
}

$widgets_manager->register(new MS_Page_Title());
