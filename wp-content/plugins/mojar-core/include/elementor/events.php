<?php

namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;

use \Etn\Utils\Helper as Helper;

if (! defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Event_New_Post extends Widget_Base
{
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
        return 'event-test';
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
        return __('Event Post', 'mscore');
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

    public function get_event_category()
    {
        return Helper::get_event_category();
    }

    public function get_event_tag()
    {
        return Helper::get_event_tag();
    }


    protected function register_controls()
    {
        $this->register_controls_section();
        $this->style_tab_content();
    }

    protected function register_controls_section()
    {

        // Start of event section
        $this->start_controls_section(
            'section_tab',
            [
                'label' => esc_html__('Edufax Event', 'mscore'),
            ]
        );
        $this->add_control(
            'etn_event_cat',
            [
                'label'    => esc_html__('Event Category', 'mscore'),
                'type'     => Controls_Manager::SELECT2,
                'options'  => $this->get_event_category(),
                'multiple' => true,
            ]
        );
        $this->add_control(
            'etn_event_tag',
            [
                'label'    => esc_html__('Event Tag', 'mscore'),
                'type'     => Controls_Manager::SELECT2,
                'options'  => $this->get_event_tag(),
                'multiple' => true,
            ]
        );
        $this->add_control(
            'etn_event_count',
            [
                'label'   => esc_html__('Event count', 'mscore'),
                'type'    => Controls_Manager::NUMBER,
                'default' => '6',
            ]
        );

        $this->add_control(
            'etn_desc_show',
            [
                'label'   => esc_html__('Show Description', 'mscore'),
                'type'    => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'mscore'),
                'label_off' => esc_html__('No', 'mscore'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'etn_desc_limit',
            [
                'label'   => esc_html__('Description Limit', 'mscore'),
                'type'    => Controls_Manager::NUMBER,
                'default' => 20,
            ]
        );

        $this->add_control(
            'etn_event_col',
            [
                'label'   => esc_html__('Event column', 'mscore'),
                'type'    => Controls_Manager::SELECT,
                'default' => '4',
                'options' => [
                    '3' => esc_html__('4 Column ', 'mscore'),
                    '4' => esc_html__('3 Column', 'mscore'),
                    '6' => esc_html__('2 Column', 'mscore'),

                ],
            ]
        );

        $this->add_control(
            'filter_with_status',
            [
                'label'     => esc_html__('Event status filter By', 'mscore'),
                'type'      => Controls_Manager::SELECT,
                'default'   => '',
                'options'   => [
                    ''        => esc_html__('All', 'mscore'),
                    'upcoming' => esc_html__('upcoming Event', 'mscore'),
                    'expire' => esc_html__('Expire Event', 'mscore'),
                ],
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label'     => esc_html__('Order Event By', 'mscore'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'post_date',
                'options'   => [
                    'ID'        => esc_html__('Id', 'mscore'),
                    'title'     => esc_html__('Title', 'mscore'),
                    'post_date' => esc_html__('Post Date', 'mscore'),
                    'etn_start_date' => esc_html__('Event Start Date', 'mscore'),
                    'etn_end_date' => esc_html__('Event End Date', 'mscore'),
                ],
            ]
        );

        $this->add_control(
            'order',
            [
                'label'   => esc_html__('Event Order', 'mscore'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'DESC',
                'options' => [
                    'ASC' => esc_html__('Ascending', 'mscore'),
                    'DESC' => esc_html__('Descending', 'mscore'),
                ],
            ]
        );
        $this->add_control(
            'show_event_location',
            [
                'label'   => esc_html__('Show Event Location', 'mscore'),
                'type'    => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'mscore'),
                'label_off' => esc_html__('No', 'mscore'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_parent_event',
            [
                'label'   => esc_html__('Show Recurring Parent Events', 'mscore'),
                'type'    => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'mscore'),
                'label_off' => esc_html__('No', 'mscore'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'show_child_event',
            [
                'label'   => esc_html__('Show Recurring Child Event', 'mscore'),
                'type'    => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'mscore'),
                'label_off' => esc_html__('No', 'mscore'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'show_event_time',
            [
                'label'   => esc_html__('Show Event Time', 'mscore'),
                'type'    => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'mscore'),
                'label_off' => esc_html__('No', 'mscore'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'show_event_btn',
            [
                'label'   => esc_html__('Show Event Button', 'mscore'),
                'type'    => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'mscore'),
                'label_off' => esc_html__('No', 'mscore'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'show_event_btn_text',
            [
                'label'   => esc_html__('Show Event Button Text', 'mscore'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Read More',
            ]
        );

        $this->end_controls_section();
    }

    protected function style_tab_content()
    {
        // Event Title Style
        $this->start_controls_section(
            'event_title_style',
            [
                'label' => esc_html__('Title', 'mscore'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Color', 'mscore'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tf__single_event_text h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .tf__single_event_text h3',
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__('Margin', 'mscore'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .tf__single_event_text h3' => 'margin: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

        $this->end_controls_section();

        // Meta Style
        $this->start_controls_section(
            'event_meta_style',
            [
                'label' => esc_html__('Meta', 'mscore'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'meta_color',
            [
                'label' => esc_html__('Color', 'mscore'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tf__single_event_text ul li' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'meta_icon_color',
            [
                'label' => esc_html__('Icon Color', 'mscore'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tf__single_event_text ul li i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Button Style
        $this->start_controls_section(
            'event_button_style',
            [
                'label' => esc_html__('Button', 'mscore'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => esc_html__('Color', 'mscore'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tf__single_event_text a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label' => esc_html__('Hover Color', 'mscore'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tf__single_event_text a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
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

        $event_cat          = $settings["etn_event_cat"];
        $event_tag          = $settings["etn_event_tag"];
        $event_count        = $settings["etn_event_count"];
        $etn_event_col      = $settings["etn_event_col"];
        $etn_desc_limit     = $settings["etn_desc_limit"];
        $order              = (isset($settings["order"]) ? $settings["order"] : 'DESC');
        $show_event_location = (isset($settings["show_event_location"]) ? $settings["show_event_location"] : 'yes');
        $show_end_date      = (isset($settings["show_end_date"]) ? $settings["show_end_date"] : 'no');
        $etn_desc_show      = (isset($settings["etn_desc_show"]) ? $settings["etn_desc_show"] : 'yes');
        $orderby            = $settings["orderby"];
        $show_child_event   = $settings["show_child_event"];
        $show_parent_event  = $settings["show_parent_event"];
        $show_event_time  = $settings["show_event_time"];
        $show_event_btn  = $settings["show_event_btn"];

        if ($orderby == "etn_start_date" || $orderby == "etn_end_date") {
            $orderby_meta       = "meta_value";
        } else {
            $orderby_meta       = null;
        }
        $filter_with_status       = $settings['filter_with_status'];
        $post_parent = Helper::show_parent_child($show_parent_event, $show_child_event);

        $data           = Helper::post_data_query(
            'etn',
            $event_count,
            $order,
            $event_cat,
            'etn_category',
            null,
            null,
            $event_tag,
            $orderby_meta,
            $orderby,
            $filter_with_status,
            $post_parent
        );

?>
        <section class="tf__event pt_110 xs_pt_75 pb_120 xs_pb_80">
            <div class="container">
                <?php if (!empty($data)) : ?>
                    <div class="row">
                        <?php foreach ($data as $value) :
                            $social = get_post_meta($value->ID, 'etn_event_socials', true);
                            $etn_event_location = get_post_meta($value->ID, 'etn_event_location', true);
                            $start_date = get_post_meta($value->ID, 'etn_start_date', true);
                            $start_time = get_post_meta($value->ID, 'etn_start_time', true);

                            $start_date_digit = date("d", strtotime($start_date));
                            $start_month_year = date("M, Y", strtotime($start_date));
                        ?>
                            <div class="col-xl-6 col-lg-6 wow fadeInUp" data-wow-duration="1s">
                                <div class="tf__single_event">
                                    <div class="tf__single_event_date">
                                        <?php echo get_the_post_thumbnail($value->ID, 'full', ['class' => 'img-fluid w-100']); ?>
                                        <h2><?php echo esc_html($start_date_digit); ?>
                                            <span><?php echo esc_html($start_month_year); ?></span>
                                        </h2>
                                    </div>
                                    <div class="tf__single_event_text">
                                        <h3><?php echo get_the_title($value->ID); ?></h3>
                                        <ul>
                                            <?php if (!empty($settings['show_event_time'])) : ?>
                                                <li><i class="fal fa-stopwatch"></i> <?php echo esc_html($start_time); ?></li>
                                            <?php endif; ?>
                                            <?php if (!empty($settings['show_event_location'])) : ?>
                                                <li><i
                                                        class="far fa-map-marker-alt"></i><?php echo is_array($etn_event_location) ? esc_html(implode(', ', $etn_event_location)) : esc_html($etn_event_location); ?>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                        <?php if (!empty($settings['etn_desc_show'])) : ?>
                                            <p><?php echo wp_trim_words(get_the_content($value->ID), $settings['etn_desc_limit']); ?></p>
                                        <?php endif; ?>
                                        <?php if (!empty($settings['show_event_btn'])) : ?>
                                            <a href="<?php echo get_the_permalink($value->ID); ?>">
                                                <?php echo esc_html($settings['show_event_btn_text']); ?>
                                                <i class="far fa-long-arrow-right"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <p class="etn-not-found-post"><?php echo esc_html__('No Event Found', 'mscore'); ?></p>
                <?php endif; ?>
            </div>
        </section>

<?php
    }
}

$widgets_manager->register(new TP_Event_New_Post());
