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
class MS_Footer_Contact extends Widget_Base
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
    return 'ms-footer-contact';
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
    return __('Footer Contact', 'mscore');
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
      'ms_footer_contact',
      [
        'label' => esc_html__('Footer Contact Info', 'mscore'),
        'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
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
        ],
        'default' => 'style_1',
        'frontend_available' => true,
        'style_transfer' => true,
      ]
    );


    $repeater->add_control(
      'ms_box_icon_type',
      [
        'label' => esc_html__('Select Icon Type', 'mscore'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => 'image',
        'options' => [
          'image' => esc_html__('Image', 'mscore'),
          'icon' => esc_html__('Icon', 'mscore'),
          'svg' => esc_html__('SVG', 'mscore'),
        ],
        'condition' => [
          'repeater_condition' => ['style_1'],
        ]
      ]
    );
    $repeater->add_control(
      'ms_box_icon_svg',
      [
        'show_label' => false,
        'type' => Controls_Manager::TEXTAREA,
        'label_block' => true,
        'placeholder' => esc_html__('SVG Code Here', 'mscore'),
        'condition' => [
          'ms_box_icon_type' => 'svg',
          'repeater_condition' => ['style_1'],
        ]
      ]
    );

    $repeater->add_control(
      'ms_box_icon_image',
      [
        'label' => esc_html__('Upload Icon Image', 'mscore'),
        'type' => Controls_Manager::MEDIA,
        'default' => [
          'url' => Utils::get_placeholder_image_src(),
        ],
        'condition' => [
          'ms_box_icon_type' => 'image',
          'repeater_condition' => ['style_1'],
        ]
      ]
    );

    if (ms_is_elementor_version('<', '2.6.0')) {
      $repeater->add_control(
        'ms_box_icon',
        [
          'show_label' => false,
          'type' => Controls_Manager::ICON,
          'label_block' => true,
          'default' => 'fa fa-star',
          'condition' => [
            'ms_box_icon_type' => 'icon',
            'repeater_condition' => ['style_1'],
          ]
        ]
      );
    } else {
      $repeater->add_control(
        'ms_box_selected_icon',
        [
          'show_label' => false,
          'type' => Controls_Manager::ICONS,
          'fa4compatibility' => 'icon',
          'label_block' => true,
          'default' => [
            'value' => 'fas fa-star',
            'library' => 'solid',
          ],
          'condition' => [
            'ms_box_icon_type' => 'icon',
            'repeater_condition' => ['style_1'],
          ]
        ]
      );
    }

    $repeater->add_control(
      'ms_footer_contact_title',
      [
        'label'   => esc_html__('Contact Title', 'mscore'),
        'type'        => \Elementor\Controls_Manager::TEXT,
        'default'     => esc_html__('Contact Title', 'mscore'),
        'label_block' => true,
      ]
    );

    $repeater->add_control(
      'ms_contact_type',
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
      'ms_contact_default_url',
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
          'ms_contact_type' => 'default'
        ]
      ]
    );

    $repeater->add_control(
      'ms_contact_phone_url',
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
          'ms_contact_type' => 'phone'
        ]
      ]
    );
    $repeater->add_control(
      'ms_contact_mail_url',
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
          'ms_contact_type' => 'email'
        ]
      ]
    );

    $repeater->add_control(
      'ms_contact_map_url',
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
          'ms_contact_type' => 'map'
        ]
      ]
    );

    $this->add_control(
      'ms_footer_contact_list',
      [
        'label'       => esc_html__('Contact Repeater', 'mscore'),
        'type'        => \Elementor\Controls_Manager::REPEATER,
        'fields'      => $repeater->get_controls(),
        'default'     => [
          [
            'ms_footer_contact_title'   => esc_html__('shofy@mail.com', 'mscore'),
          ],
          [
            'ms_footer_contact_title'   => esc_html__('+012 456 5852', 'mscore'),
          ],
        ],
        'title_field' => '{{{ ms_footer_contact_title }}}',
      ]
    );

    $this->end_controls_section();
  }


  protected function style_tab_content()
  {
    $this->ms_icon_style('services_box_icon', 'Contact - Icon/Image/SVG', '.ms-el-box-icon span');

    $this->ms_link_controls_style('portfolio_description', 'Contact - Link Style', '.ms-el-box-btn');
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

    <div class="ms-footer-contact">

      <?php foreach ($settings['ms_footer_contact_list'] as $item) :

        $contact_type = $item['ms_contact_type'];

        if ($contact_type === 'mail') {
          $contact_url = 'mailto:' . $item['ms_contact_mail_url']['url'];
        } elseif ($contact_type === 'phone') {
          $contact_url = 'tel:' . $item['ms_contact_phone_url']['url'];
        } elseif ($contact_type === 'map') {
          $contact_url = $item['ms_contact_map_url']['url'];
        } elseif ($contact_type === 'default') {
          $contact_url = $item['ms_contact_default_url']['url'];
        } else {
          $contact_url = "#";
        }
      ?>
        <div class="ms-footer-contact-item d-flex align-items-start">
          <div class="ms-footer-contact-icon ms-el-box-icon">
            <?php if ($item['ms_box_icon_type'] == 'icon') : ?>
              <?php if (!empty($item['ms_box_icon']) || !empty($item['ms_box_selected_icon']['value'])) : ?>
                <span><?php ms_render_icon($item, 'ms_box_icon', 'ms_box_selected_icon'); ?></span>
              <?php endif; ?>
            <?php elseif ($item['ms_box_icon_type'] == 'image') : ?>
              <span>
                <?php if (!empty($item['ms_box_icon_image']['url'])) : ?>
                  <img src="<?php echo $item['ms_box_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['ms_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                <?php endif; ?>
              </span>
            <?php else : ?>
              <span>
                <?php if (!empty($item['ms_box_icon_svg'])) : ?>
                  <?php echo $item['ms_box_icon_svg']; ?>
                <?php endif; ?>
              </span>
            <?php endif; ?>
          </div>

          <div class="ms-footer-contact-content">
            <p><a class="ms-el-box-btn" href="<?php echo esc_url($contact_url); ?>"> <?php echo ms_kses($item['ms_footer_contact_title']); ?></a></p>
          </div>
        </div>
      <?php endforeach; ?>

    </div>

<?php
  }
}

$widgets_manager->register(new MS_Footer_Contact());
