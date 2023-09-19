<?php

namespace MSCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Ms Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class MS_Footer_Menu extends Widget_Base
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
        return 'ms-footer-menu';
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
        return __('Footer Menu', 'mscore');
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
                'label' => esc_html__('Design Layout', 'mscore'),
            ]
        );
        $this->add_control(
            'ms_design_style',
            [
                'label' => esc_html__('Select Layout', 'mscore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'mscore'),
                    'layout-2' => esc_html__('Layout 2', 'mscore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'ms_sec',
            [
                'label' => esc_html__('Design Layout', 'mscore'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'ms_footer_link_switcher',
            [
                'label' => esc_html__('Add Footer link', 'mscore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'mscore'),
                'label_off' => esc_html__('No', 'mscore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        $repeater->add_control(
            'ms_footer_btn_text',
            [
                'label' => esc_html__('Link Text', 'mscore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Link Text', 'mscore'),
                'title' => esc_html__('Enter link text', 'mscore'),
                'label_block' => true,
                'condition' => [
                    'ms_footer_link_switcher' => 'yes'
                ],
            ]
        );
        $repeater->add_control(
            'ms_footer_link_type',
            [
                'label' => esc_html__('Footer Link Type', 'mscore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'ms_footer_link_switcher' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'ms_footer_link',
            [
                'label' => esc_html__('Footer Link link', 'mscore'),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'mscore'),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'condition' => [
                    'ms_footer_link_type' => '1',
                    'ms_footer_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'ms_footer_page_link',
            [
                'label' => esc_html__('Select Footer Link Page', 'mscore'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => ms_get_all_pages(),
                'condition' => [
                    'ms_footer_link_type' => '2',
                    'ms_footer_link_switcher' => 'yes',
                ]
            ]
        );


        $this->add_responsive_control(
            'ms_align',
            [
                'label' => esc_html__('Alignment', 'mscore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'mscore'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'mscore'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'mscore'),
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
            'ms_footer_list',
            [
                'label' => esc_html__('Footer - List', 'mscore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'ms_footer_btn_text' => esc_html__('Business Stratagy', 'mscore'),
                    ],
                    [
                        'ms_footer_btn_text' => esc_html__('Website Development', 'mscore')
                    ],
                    [
                        'ms_footer_btn_text' => esc_html__('Marketing & Reporting', 'mscore')
                    ]
                ],
                'title_field' => '{{{ ms_footer_btn_text }}}',
            ]
        );
        $this->end_controls_section();
    }


    protected function style_tab_content()
    {
        $this->ms_link_controls_style('portfolio_description', 'List - Style', '.ms-el-box-btn');
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
            $this->add_render_attribute('title_args', 'class', 'sectionTitle__big');
        ?>

            <ul id="footer-list-inline-3">
                <?php foreach ($settings['ms_footer_list'] as $key => $item) :
                    // Link
                    if ('2' == $item['ms_footer_link_type']) {
                        $link = get_permalink($item['ms_footer_page_link']);
                        $target = '_self';
                        $rel = 'nofollow';
                    } else {
                        $link = !empty($item['ms_footer_link']['url']) ? $item['ms_footer_link']['url'] : '';
                        $target = !empty($item['ms_footer_link']['is_external']) ? '_blank' : '';
                        $rel = !empty($item['ms_footer_link']['nofollow']) ? 'nofollow' : '';
                    }
                ?>
                    <li>
                        <a class="ms-el-box-btn" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>"><?php echo ms_kses($item['ms_footer_btn_text']); ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>

        <?php else :
            $this->add_render_attribute('title_args', 'class', 'title');
        ?>


            <ul id="footer-list-inline">
                <?php foreach ($settings['ms_footer_list'] as $key => $item) :
                    // Link
                    if ('2' == $item['ms_footer_link_type']) {
                        $link = get_permalink($item['ms_footer_page_link']);
                        $target = '_self';
                        $rel = 'nofollow';
                    } else {
                        $link = !empty($item['ms_footer_link']['url']) ? $item['ms_footer_link']['url'] : '';
                        $target = !empty($item['ms_footer_link']['is_external']) ? '_blank' : '';
                        $rel = !empty($item['ms_footer_link']['nofollow']) ? 'nofollow' : '';
                    }
                ?>
                    <li>
                        <a class="ms-el-box-btn" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>"><?php echo ms_kses($item['ms_footer_btn_text']); ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>

        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new MS_Footer_Menu());
