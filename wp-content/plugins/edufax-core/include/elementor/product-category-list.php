<?php

namespace MSCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

/**
 * Ms Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class MS_Product_Category_List extends Widget_Base
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
        return 'product-category-list';
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
        return __('Product Category List', 'mscore');
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();


        // Service group
        $this->start_controls_section(
            'ms_support',
            [
                'label' => esc_html__('Category List', 'mscore'),
                'description' => esc_html__('Control all the style settings from Style tab', 'mscore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'ms_category_list_title',
            [
                'label' => esc_html__('Widget Title', 'mscore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Electronic Gadgets', 'mscore'),
                'placeholder' => esc_html__('Your Text', 'mscore'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'ms_category_link_switcher',
            [
                'label' => esc_html__('Enable Link?', 'mscore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'mscore'),
                'label_off' => esc_html__('Hide', 'mscore'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $repeater->add_control(
            'ms_category_btn_text',
            [
                'label' => esc_html__('Button Text', 'mscore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'mscore'),
                'title' => esc_html__('Enter button text', 'mscore'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'ms_category_link_type',
            [
                'label' => esc_html__('Service Link Type', 'mscore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'ms_category_link_switcher' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'ms_category_link',
            [
                'label' => esc_html__('Service Link link', 'mscore'),
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
                    'ms_category_link_type' => '1',
                    'ms_category_link_switcher' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'ms_category_page_link',
            [
                'label' => esc_html__('Select Service Link Page', 'mscore'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => ms_get_all_pages(),
                'condition' => [
                    'ms_category_link_type' => '2',
                    'ms_category_link_switcher' => 'yes'
                ]
            ]
        );


        $this->add_control(
            'ms_category_list',
            [
                'label' => esc_html__('Features - List', 'mscore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'ms_category_btn_text' => esc_html__('Microscope', 'mscore'),
                    ],
                    [
                        'ms_category_btn_text' => esc_html__('Website Development', 'mscore')
                    ],
                    [
                        'ms_category_btn_text' => esc_html__('Website Development', 'mscore')
                    ]
                ],
                'title_field' => '{{{ ms_category_btn_text }}}',
            ]
        );


        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'ms_category_thumb_sec',
            [
                'label' => esc_html__('Thumbnail', 'mscore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'ms_category_image',
            [
                'label' => esc_html__('Upload Thumbnail', 'mscore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->end_controls_section();

        $this->ms_button_render_controls('tpbtn', 'Button', ['layout-1']);
    }

    // style_tab_content
    protected function style_tab_content()
    {
        $this->ms_section_style_controls('services_section', 'Section - Style', '.ms-el-section');

        $this->ms_basic_style_controls('services_section_box', 'Box - Title', '.ms-el-box-title');
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

        <?php if ($settings['ms_design_style'] == 'layout-2') :
            $this->add_render_attribute('title_args', 'class', 'ms-section-title-2 ms-el-title');
        ?>



        <?php else :
            $bloginfo = get_bloginfo('name');
            $this->add_render_attribute('title_args', 'class', 'section__title-7 ms-el-title');
            if (!empty($settings['ms_category_image']['url'])) {
                $ms_category_image_url = !empty($settings['ms_category_image']['id']) ? wp_get_attachment_image_url($settings['ms_category_image']['id'], $settings['thumbnail_size']) : $settings['ms_category_image']['url'];
                $ms_category_image_alt = get_post_meta($settings["ms_category_image"]["id"], "_wp_attachment_image_alt", true);
            }

            $this->ms_link_controls_render('tpbtn', 'ms-link-btn', $this->get_settings());
        ?>

            <div class="ms-product-gadget-categories p-relative fix mb-10">

                <?php if (!empty($ms_category_image_url)) : ?>
                    <div class="ms-product-gadget-thumb">
                        <img src="<?php echo esc_url($ms_category_image_url); ?>" alt="<?php echo esc_attr($ms_category_image_alt); ?>">
                    </div>
                <?php endif; ?>

                <?php if (!empty($settings['ms_category_list_title'])) : ?>
                    <h3 class="ms-product-gadget-categories-title">
                        <?php echo ms_kses($settings['ms_category_list_title']); ?>
                    </h3>
                <?php endif; ?>

                <div class="ms-product-gadget-categories-list">
                    <ul>
                        <?php foreach ($settings['ms_category_list'] as $key => $item) :

                            // Link
                            if ('2' == $item['ms_category_link_type']) {
                                $link = get_permalink($item['ms_category_page_link']);
                                $target = '_self';
                                $rel = 'nofollow';
                            } else {
                                $link = !empty($item['ms_category_link']['url']) ? $item['ms_category_link']['url'] : '';
                                $target = !empty($item['ms_category_link']['is_external']) ? '_blank' : '';
                                $rel = !empty($item['ms_category_link']['nofollow']) ? 'nofollow' : '';
                            }
                        ?>
                            <li>
                                <?php if ($item['ms_category_link_switcher'] == 'yes') : ?>
                                    <a href="<?php echo esc_url($link); ?>"><?php echo ms_kses($item['ms_category_btn_text']); ?></a>
                                <?php else : ?>
                                    <span>
                                        <?php echo ms_kses($item['ms_category_btn_text']); ?>
                                    </span>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <?php if ($settings['ms_' . $control_id . '_button_show'] == 'yes') : ?>
                    <div class="ms-product-gadget-btn">
                        <a <?php echo $this->get_render_attribute_string('ms-button-arg'); ?>>
                            <?php echo ms_kses($settings['ms_' . $control_id . '_text']); ?>
                            <svg width="15" height="13" viewBox="0 0 15 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.9998 6.19656L1 6.19656" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M8.75674 0.975394L14 6.19613L8.75674 11.4177" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    </div>
                <?php endif; ?>
            </div>

        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new MS_Product_Category_List());
