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
class TP_Footer_List extends Widget_Base {

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
        return 'tp-footer-list';
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
        return __( 'Footer List', 'tpcore' );
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
            'tp_sec',
            [
                'label' => esc_html__('Footer List', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_footer_list_title',
            [
                'label'       => esc_html__( 'Widget Title', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'My Widget List', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'tp_footer_link_switcher',
            [
                'label' => esc_html__( 'Add Footer link', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        $repeater->add_control(
            'tp_footer_btn_text',
            [
                'label' => esc_html__('Link Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Link Text', 'tpcore'),
                'title' => esc_html__('Enter link text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_footer_link_switcher' => 'yes'
                ],
            ]
        );
        $repeater->add_control(
            'tp_footer_link_type',
            [
                'label' => esc_html__( 'Footer Link Type', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_footer_link_switcher' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'tp_footer_link',
            [
                'label' => esc_html__( 'Footer Link link', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__( 'https://your-link.com', 'tpcore' ),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'condition' => [
                    'tp_footer_link_type' => '1',
                    'tp_footer_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'tp_footer_page_link',
            [
                'label' => esc_html__( 'Select Footer Link Page', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_footer_link_type' => '2',
                    'tp_footer_link_switcher' => 'yes',
                ]
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

        $this->add_control(
            'tp_footer_list',
            [
                'label' => esc_html__('Footer - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_footer_btn_text' => esc_html__('Business Stratagy', 'tpcore'),
                    ],
                    [
                        'tp_footer_btn_text' => esc_html__('Website Development', 'tpcore')
                    ],
                    [
                        'tp_footer_btn_text' => esc_html__('Marketing & Reporting', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_footer_btn_text }}}',
            ]
        );
        $this->end_controls_section();

    }


    protected function style_tab_content(){
        $this->tp_basic_style_controls('footer_subtitle', 'Title', '.tp-el-title');
        $this->tp_link_controls_style('footer_description', 'List - Style', '.tp-el-box-btn');
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

        <div class="tp-footer-widget">
            <?php if(!empty($settings['tp_footer_list_title'])) : ?>
            <h4 class="tp-footer-widget-title tp-el-title"><?php echo esc_html($settings['tp_footer_list_title']); ?></h4>
            <?php endif; ?>

            <div class="tp-footer-widget-content">
                <ul>
                    <?php foreach ($settings['tp_footer_list'] as $key => $item) :
                        if ('2' == $item['tp_footer_link_type']) {
                            $link = get_permalink($item['tp_footer_page_link']);
                            $target = '_self';
                            $rel = 'nofollow';
                        } else {
                            $link = !empty($item['tp_footer_link']['url']) ? $item['tp_footer_link']['url'] : '';
                            $target = !empty($item['tp_footer_link']['is_external']) ? '_blank' : '';
                            $rel = !empty($item['tp_footer_link']['nofollow']) ? 'nofollow' : '';
                        }
                    ?>
                    <li>
                        <a class="tp-el-box-btn" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" ><?php echo tp_kses($item['tp_footer_btn_text']); ?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>

        </div>

        <?php
    }
}

$widgets_manager->register( new TP_Footer_List() );
