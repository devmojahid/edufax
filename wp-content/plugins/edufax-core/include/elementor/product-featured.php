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
class MS_Product_Featured extends Widget_Base
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
        return 'product-featured';
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
        return __('Product Featured', 'mscore');
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
                'label' => esc_html__('Product List', 'mscore'),
                'description' => esc_html__('Control all the style settings from Style tab', 'mscore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );


        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'repeater_condition',
            [
                'label' => __('Field condition', 'mscore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __('Style 1', 'mscore'),
                    'style_2' => __('Style 2', 'mscore'),
                    'style_3' => __('Style 3', 'mscore'),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'ms_category_box_image',
            [
                'label'   => esc_html__('Upload Thumbnail', 'mscore'),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );


        $repeater->add_control(
            'ms_category_box_title',
            [
                'label' => esc_html__('Title', 'mscore'),
                'description' => ms_get_allowed_html_desc('basic'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'mscore'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'ms_category_box_desc',
            [
                'label' => esc_html__('Sub Title', 'mscore'),
                'description' => ms_get_allowed_html_desc('basic'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('25 Product', 'mscore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'ms_category_box_price',
            [
                'label' => esc_html__('Price', 'mscore'),
                'description' => ms_get_allowed_html_desc('basic'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('$72', 'mscore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'ms_category_link_switcher',
            [
                'label' => esc_html__('Add Category link', 'mscore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'mscore'),
                'label_off' => esc_html__('No', 'mscore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
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
                'condition' => [
                    'ms_category_link_switcher' => 'yes',
                    'repeater_condition' => 'style_2'
                ],
            ]
        );

        $repeater->add_control(
            'ms_category_link_type',
            [
                'label' => esc_html__('Category Link Type', 'mscore'),
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
                'label' => esc_html__('Category Link', 'mscore'),
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
                    'ms_category_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'ms_category_page_link',
            [
                'label' => esc_html__('Select Category Link Page', 'mscore'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => ms_get_all_pages(),
                'condition' => [
                    'ms_category_link_type' => '2',
                    'ms_category_link_switcher' => 'yes',
                ]
            ]
        );


        $this->add_control(
            'ms_category_list',
            [
                'label' => esc_html__('Product - List', 'mscore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'ms_category_box_title' => esc_html__('Matte Liquid Lipstick & Lip Liner', 'mscore'),
                    ],
                    [
                        'ms_category_box_title' => esc_html__('Crushed Liquid Lip - Cherry Crush', 'mscore')
                    ],
                    [
                        'ms_category_box_title' => esc_html__('Mega Waterproof Concealer - 125 Bisque', 'mscore')
                    ]
                ],
                'title_field' => '{{{ ms_category_box_title }}}',
            ]
        );


        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
            ]
        );
        $this->end_controls_section();
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
?>

        <?php if ($settings['ms_design_style']  == 'layout-2') :
            $this->add_render_attribute('title_args', 'class', 'ms-section-title-2 ms-el-title');
        ?>

        <?php else :
            $bloginfo = get_bloginfo('name');
            $this->add_render_attribute('title_args', 'class', 'section__title-7 ms-el-title');

        ?>

            <section class="ms-featured-product-area pt-70 pb-150">
                <div class="container">

                    <div class="row gx-0">

                        <?php foreach ($settings['ms_category_list'] as $key => $item) :

                            if (!empty($item['ms_category_box_image']['url'])) {
                                $ms_category_box_image_url = !empty($item['ms_category_box_image']['id']) ? wp_get_attachment_image_url($item['ms_category_box_image']['id'], $settings['thumbnail_size']) : $item['ms_category_box_image']['url'];
                                $ms_category_box_image_alt = get_post_meta($item["ms_category_box_image"]["id"], "_wp_attachment_image_alt", true);
                            }
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
                            <div class="col-lg-4 col-md-6">
                                <div class="ms-featured-item-3 text-center">
                                    <div class="ms-featured-thumb-3 d-flex align-items-end justify-content-center">
                                        <?php if ($item['ms_category_link_switcher'] == 'yes') : ?>
                                            <a href="<?php echo esc_url($link); ?>">
                                                <img src="<?php echo esc_url($ms_category_box_image_url); ?>" alt="<?php echo esc_attr($ms_category_box_image_alt) ?>">
                                            </a>
                                        <?php else : ?>
                                            <img src="<?php echo esc_url($ms_category_box_image_url); ?>" alt="<?php echo esc_attr($ms_category_box_image_alt) ?>">
                                        <?php endif; ?>
                                    </div>
                                    <div class="ms-featured-content-3">
                                        <?php if (!empty($item['ms_category_box_title'])) : ?>
                                            <h3 class="ms-featured-title-3 ms-el-box-title">
                                                <?php if ($item['ms_category_link_switcher'] == 'yes') : ?>
                                                    <a href="<?php echo esc_url($link); ?>"><?php echo ms_kses($item['ms_category_box_title']); ?></a>
                                                <?php else : ?>
                                                    <?php echo ms_kses($item['ms_category_box_title']); ?>
                                                <?php endif; ?>
                                            </h3>
                                        <?php endif; ?>

                                        <?php if (!empty($item['ms_category_box_desc'])) : ?>
                                            <p><?php echo ms_kses($item['ms_category_box_desc']); ?></p>
                                        <?php endif; ?>

                                        <?php if (!empty($item['ms_category_box_price'])) : ?>
                                            <div class="ms-featured-price-3">
                                                <span><?php echo ms_kses($item['ms_category_box_price']); ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new MS_Product_Featured());
