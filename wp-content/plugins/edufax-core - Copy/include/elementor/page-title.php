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
class TP_Page_Title extends Widget_Base {

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
		return 'tp-page-title';
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
		return __( 'Page Title', 'tpcore' );
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
                    'layout-2' => esc_html__('Layout 2', 'tp-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->tp_section_title_render_controls('page', 'Section Title');

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

		?>

		<?php if ( $settings['tp_design_style']  == 'layout-2' ): 
			$this->add_render_attribute('title_args', 'class', 'tp-about-banner-title tp-el-title');
		?>
			<div class="tp-about-banner-wrapper">

				<?php if ( !empty($settings['tp_page_sub_title']) ) : ?>
				<span class="tp-about-banner-subtitle tp-el-subtitle">
					<?php echo tp_kses( $settings['tp_page_sub_title'] ); ?>
				</span>
				<?php endif; ?>

				<?php
					if ( !empty($settings['tp_page_title' ]) ) :
						printf( '<%1$s %2$s>%3$s</%1$s>',
							tag_escape( $settings['tp_page_title_tag'] ),
							$this->get_render_attribute_string( 'title_args' ),
							tp_kses( $settings['tp_page_title' ] )
							);
					endif;
				?>

				<?php if ( !empty($settings['tp_page_description']) ) : ?>
					<p><?php echo tp_kses( $settings['tp_page_description'] ); ?></p>
				<?php endif; ?>
			</div>

		<?php else: 
            $this->add_render_attribute('title_args', 'class', 'tp-section-title-7 tp-el-title');
        ?>	
            
        <!-- section title area start -->
        <div class="tp-section-title-wrapper-7">
			<?php if ( !empty($settings['tp_page_section_title_show']) ) : ?>
				<?php if ( !empty($settings['tp_page_sub_title']) ) : ?>
				<span class="tp-section-title-pre-7 tp-el-subtitle">
					<?php echo tp_kses( $settings['tp_page_sub_title'] ); ?>
				</span>
				<?php endif; ?>

				<?php
					if ( !empty($settings['tp_page_title' ]) ) :
						printf( '<%1$s %2$s>%3$s</%1$s>',
							tag_escape( $settings['tp_page_title_tag'] ),
							$this->get_render_attribute_string( 'title_args' ),
							tp_kses( $settings['tp_page_title' ] )
							);
					endif;
				?>

				<?php if ( !empty($settings['tp_page_description']) ) : ?>
					<p><?php echo tp_kses( $settings['tp_page_description'] ); ?></p>
				<?php endif; ?>

			<?php endif; ?>
		</div>
        <!-- section title area end -->
         

        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new TP_Page_Title() );