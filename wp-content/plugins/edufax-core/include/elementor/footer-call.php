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
class MS_Footer_Call extends Widget_Base
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
    return 'ms-footer-call';
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
    return __('Footer Call', 'mscore');
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
      'ms_footer_call_sec',
      [
        'label' => esc_html__('Footer Call', 'mscore'),
        'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

    $this->add_control(
      'ms_footer_call_subtitle',
      [
        'label'       => esc_html__('Title', 'mscore'),
        'type'        => \Elementor\Controls_Manager::TEXT,
        'default'     => esc_html__('Got Questions? Call us', 'mscore'),
        'placeholder' => esc_html__('Your Text', 'mscore'),
        'label_block' => true
      ]
    );


    $repeater = new \Elementor\Repeater();


    $repeater->add_control(
      'ms_footer_call_title',
      [
        'label'   => esc_html__('Contact Title', 'mscore'),
        'type'        => \Elementor\Controls_Manager::TEXT,
        'default'     => esc_html__('Contact Title', 'mscore'),
        'label_block' => true,
      ]
    );

    $repeater->add_control(
      'ms_footer_call_type',
      [
        'label'   => esc_html__('Select Type', 'mscore'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'options' => [
          'email'  => esc_html__('Email', 'mscore'),
          'phone'  => esc_html__('Phone', 'mscore'),
          'map'  => esc_html__('Map', 'mscore'),
          'default'  => esc_html__('Default', 'mscore'),
        ],
        'default' => 'default',
      ]
    );

    $repeater->add_control(
      'ms_footer_call_default_url',
      [
        'label'   => esc_html__('Default URL', 'mscore'),
        'type'        => \Elementor\Controls_Manager::URL,
        'default'     => [
          'url'               => '#',
          'is_external'       => true,
          'nofollow'          => true,
          'custom_attributes' => '',
        ],
        'placeholder' => esc_html__('Your URL', 'mscore'),
        'label_block' => true,
        'condition' => [
          'ms_footer_call_type' => 'default'
        ]
      ]
    );

    $repeater->add_control(
      'ms_footer_call_phone_url',
      [
        'label'   => esc_html__('Phone URL', 'mscore'),
        'type'        => \Elementor\Controls_Manager::URL,
        'default'     => [
          'url'               => '#',
          'is_external'       => true,
          'nofollow'          => true,
          'custom_attributes' => '',
        ],
        'placeholder' => esc_html__('Your URL', 'mscore'),
        'label_block' => true,
        'condition' => [
          'ms_footer_call_type' => 'phone'
        ]
      ]
    );
    $repeater->add_control(
      'ms_footer_call_mail_url',
      [
        'label'   => esc_html__('Email URL', 'mscore'),
        'type'        => \Elementor\Controls_Manager::URL,
        'default'     => [
          'url'               => '#',
          'is_external'       => true,
          'nofollow'          => true,
          'custom_attributes' => '',
        ],
        'placeholder' => esc_html__('Your URL', 'mscore'),
        'label_block' => true,
        'condition' => [
          'ms_footer_call_type' => 'email'
        ]
      ]
    );

    $repeater->add_control(
      'ms_footer_call_map_url',
      [
        'label'   => esc_html__('Map URL', 'mscore'),
        'type'        => \Elementor\Controls_Manager::URL,
        'default'     => [
          'url'               => '#',
          'is_external'       => true,
          'nofollow'          => true,
          'custom_attributes' => '',
        ],
        'placeholder' => esc_html__('Your URL', 'mscore'),
        'label_block' => true,
        'condition' => [
          'ms_footer_call_type' => 'map'
        ]
      ]
    );

    $this->add_control(
      'ms_footer_call_list',
      [
        'label'       => esc_html__('Call Repeater', 'mscore'),
        'type'        => \Elementor\Controls_Manager::REPEATER,
        'fields'      => $repeater->get_controls(),
        'default'     => [
          [
            'ms_footer_call_title'   => esc_html__('012 458 246', 'mscore'),
          ],
        ],
        'title_field' => '{{{ ms_footer_call_title }}}',
      ]
    );

    $this->end_controls_section();
  }


  protected function style_tab_content()
  {
    $this->ms_basic_style_controls('footer_subtitle', 'Title', '.ms-el-title');
    $this->ms_link_controls_style('portfolio_description', 'Link - Style', '.ms-el-box-btn');
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

    <div class="ms-footer-talk">

      <?php if (!empty($settings['ms_footer_call_subtitle'])) : ?>
        <span class="ms-el-title"><?php echo esc_html($settings['ms_footer_call_subtitle']); ?></span>
      <?php endif; ?>

      <?php foreach ($settings['ms_footer_call_list'] as $item) :

        $contact_type = $item['ms_footer_call_type'];

        if ($contact_type === 'mail') {
          $contact_url = 'mailto:' . $item['ms_footer_call_mail_url']['url'];
        } elseif ($contact_type === 'phone') {
          $contact_url = 'tel:' . $item['ms_footer_call_phone_url']['url'];
        } elseif ($contact_type === 'map') {
          $contact_url = $item['ms_footer_call_map_url']['url'];
        } elseif ($contact_type === 'default') {
          $contact_url = $item['ms_footer_call_default_url']['url'];
        } else {
          $contact_url = "#";
        }

      ?>
        <h4><a href="<?php echo esc_url($contact_url); ?>" class="ms-el-box-btn"><?php echo esc_html($item['ms_footer_call_title']); ?></a></h4>
      <?php endforeach; ?>
    </div>

<?php
  }
}

$widgets_manager->register(new MS_Footer_Call());
