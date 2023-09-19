<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Product_Collection_Countdown extends Widget_Base
{

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
    public function get_name()
    {
        return 'product-collection-countdown';
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
        return __('Countdown', 'tpcore');
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
    public function get_categories()
    {
        return ['tpcore'];
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
        return ['tpcore'];
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
         'collection_countdown',
             [
               'label' => esc_html__( 'Countdown', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );
        
        $this->add_control(
        'collection_countdown_date',
         [
            'label'       => esc_html__( 'Enter Date', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'Sep 30 2024 20:20:22', 'tpcore' ),
            'placeholder' => esc_html__( 'Sep 30 2024 20:20:22', 'tpcore' ),
            'description' => "Add you date as given format. You can view it in placeholer"
         ]
        );
        
        
        $this->end_controls_section();


    }

    // style_tab_content
    protected function style_tab_content()
    {


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

        <?php if ($settings['tp_design_style'] == 'layout-2'):
            $this->add_render_attribute('title_args', 'class', 'tp-section-title-2 tp-el-title');
            ?>



        <?php else:?>
            <div class="tp-collection-countdown d-flex align-items-center justify-content-center justify-content-md-start ml-20 mt-20">
                <div class="tp-product-countdown" data-countdown="" data-date="<?php echo esc_attr($settings['collection_countdown_date']) ?>">
                    <div class="tp-product-countdown-inner">
                        <ul>
                            <li><span data-days=""></span> <?php echo esc_html__('Days', 'tpcore'); ?></li>
                            <li><span data-hours=""></span> <?php echo esc_html__('Hrs', 'tpcore'); ?></li>
                            <li><span data-minutes=""></span> <?php echo esc_html__('Min', 'tpcore'); ?></li>
                        </ul>
                    </div>
                </div>
                <div class="tp-product-countdown has-second" data-countdown="" data-date="<?php echo esc_attr($settings['collection_countdown_date']) ?>">
                    <div class="tp-product-countdown-inner">
                        <ul>
                            <li><span data-seconds=""></span> <?php echo esc_html__('Sec', 'tpcore'); ?></li>
                        </ul>
                    </div>
                </div>
            </div>

        <?php endif; ?>

        <?php
    }
}

$widgets_manager->register(new TP_Product_Collection_Countdown());