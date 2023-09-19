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
class MS_Author_Quote extends Widget_Base
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
    return 'ms-author-quote';
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
    return __('MS Author Quote', 'mscore');
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
        ],
        'default' => 'layout-1',
      ]
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'ms_author_quote_sec',
      [
        'label' => esc_html__('Author Info', 'mscore'),
        'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

    $this->add_control(
      'ms_author_thumb',
      [
        'label'   => esc_html__('Upload Author Image', 'mscore'),
        'type'    => \Elementor\Controls_Manager::MEDIA,
        'default' => [
          'url' => \Elementor\Utils::get_placeholder_image_src(),
        ],
      ]
    );

    $this->add_control(
      'ms_author_name',
      [
        'label'       => esc_html__('Author Name', 'mscore'),
        'type'        => \Elementor\Controls_Manager::TEXT,
        'default'     => esc_html__('Theodore Handle', 'mscore'),
        'placeholder' => esc_html__('Your Title', 'mscore'),
        'label_block' => true
      ]
    );
    $this->add_control(
      'ms_author_designation',
      [
        'label'       => esc_html__('Author Designation', 'mscore'),
        'type'        => \Elementor\Controls_Manager::TEXT,
        'default'     => esc_html__(' UI/UX design ', 'mscore'),
        'placeholder' => esc_html__('Your Title', 'mscore'),
        'label_block' => true
      ]
    );

    $this->add_control(
      'ms_author_quote',
      [
        'label'       => esc_html__('Author Quote Text', 'mscore'),
        'type'        => \Elementor\Controls_Manager::TEXTAREA,
        'rows'        => 10,
        'default'     => esc_html__('We work with top suppliers and manufacturers to ensure that every item we ', 'mscore'),
        'placeholder' => esc_html__('Your Text', 'mscore'),
      ]
    );

    $this->add_control(
      'ms_author_shape_switch',
      [
        'label'        => esc_html__('Enable Shape ?', 'mscore'),
        'type'         => \Elementor\Controls_Manager::SWITCHER,
        'label_on'     => esc_html__('Show', 'mscore'),
        'label_off'    => esc_html__('Hide', 'mscore'),
        'return_value' => 'yes',
        'default'      => 'yes',
      ]
    );

    $this->add_group_control(
      Group_Control_Image_Size::get_type(),
      [
        'name' => 'thumbnail',
        'default' => 'full',
        'exclude' => [
          'custom'
        ]
      ]
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'ms_author_bg_sec',
      [
        'label' => esc_html__('Background Image', 'mscore'),
        'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

    $this->add_control(
      'ms_author_bg_image',
      [
        'label'   => esc_html__('Upload Background Image', 'mscore'),
        'type'    => \Elementor\Controls_Manager::MEDIA,
        'default' => [
          'url' => \Elementor\Utils::get_placeholder_image_src(),
        ],
      ]
    );

    $this->add_group_control(
      Group_Control_Image_Size::get_type(),
      [
        'name' => 'thumbnail_bg',
        'default' => 'full',
        'exclude' => [
          'custom'
        ]
      ]
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'ms_brand_sec',
      [
        'label' => esc_html__('Brand List', 'mscore'),
        'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

    $repeater = new \Elementor\Repeater();

    $repeater->add_control(
      'ms_brand_title',
      [
        'label'   => esc_html__('Brand Title', 'mscore'),
        'type'        => \Elementor\Controls_Manager::TEXT,
        'default'     => esc_html__('Brand', 'mscore'),
        'label_block' => true,
      ]
    );

    $repeater->add_control(
      'ms_brand_image',
      [
        'label'   => esc_html__('Upload Brand Image', 'mscore'),
        'type'    => \Elementor\Controls_Manager::MEDIA,
        'default' => [
          'url' => \Elementor\Utils::get_placeholder_image_src(),
        ],
      ]
    );

    $this->add_control(
      'ms_brand_list',
      [
        'label'       => esc_html__('Brand List', 'mscore'),
        'type'        => \Elementor\Controls_Manager::REPEATER,
        'fields'      => $repeater->get_controls(),
        'default'     => [
          [
            'ms_brand_title'   => esc_html__('Brand Image', 'mscore'),
          ],
          [
            'ms_brand_title'   => esc_html__('Brand Image', 'mscore'),
          ],
          [
            'ms_brand_title'   => esc_html__('Brand Image', 'mscore'),
          ],
        ],
        'title_field' => '{{{ ms_brand_title }}}',
      ]
    );


    $this->end_controls_section();
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

    if (!empty($settings['ms_author_bg_image']['url'])) {
      $ms_author_bg_image_url = !empty($settings['ms_author_bg_image']['id']) ? wp_get_attachment_image_url($settings['ms_author_bg_image']['id'], $settings['thumbnail_size']) : $settings['ms_author_bg_image']['url'];
      $ms_author_bg_image_alt = get_post_meta($settings["ms_author_bg_image"]["id"], "_wp_attachment_image_alt", true);
    }

    if (!empty($settings['ms_author_thumb']['url'])) {
      $ms_author_thumb_url = !empty($settings['ms_author_thumb']['id']) ? wp_get_attachment_image_url($settings['ms_author_thumb']['id'], $settings['thumbnail_size']) : $settings['ms_author_thumb']['url'];
      $ms_author_thumb_alt = get_post_meta($settings["ms_author_thumb"]["id"], "_wp_attachment_image_alt", true);
    }
?>


    <!-- author area start -->
    <section class="ms-author-area pb-120">
      <div class="container">
        <div class="ms-author-inner p-relative z-index-1 ms-author-bg-overlay fix" data-bg-color="#821F40">

          <?php if ($settings['ms_author_shape_switch'] == 'yes') : ?>
            <!-- shape -->
            <span class="ms-author-shape-1"></span>
            <!-- shape end -->
          <?php endif; ?>

          <div class="ms-author-bg include-bg " data-background="<?php echo esc_url($ms_author_bg_image_url); ?>"></div>
          <div class="row align-items-center">
            <div class="col-xl-6 col-lg-6">
              <div class="ms-author-wrapper p-relative z-index-1">
                <div class="ms-author-info-wrapper d-flex align-items-center mb-30">

                  <?php if (!empty($ms_author_thumb_url)) : ?>
                    <div class="ms-author-info-avater mr-10">
                      <img src="<?php echo esc_url($ms_author_thumb_url); ?>" alt="<?php echo esc_attr($ms_author_bg_image_alt); ?>">
                    </div>
                  <?php endif; ?>

                  <div class="ms-author-info">

                    <?php if (!empty($settings['ms_author_name'])) : ?>
                      <h3 class="ms-author-info-title"><?php echo esc_html($settings['ms_author_name']); ?></h3>
                    <?php endif; ?>

                    <?php if (!empty($settings['ms_author_designation'])) : ?>
                      <span class="ms-author-info-designation"><?php echo esc_html($settings['ms_author_designation']); ?></span>
                    <?php endif; ?>
                  </div>
                </div>
                <?php if (!empty($settings['ms_author_quote'])) : ?>
                  <div class="ms-author-content">
                    <p><?php echo esc_html($settings['ms_author_quote']); ?></p>
                  </div>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-xl-6 col-lg-6">
              <div class="ms-author-brand-wrapper d-flex flex-wrap align-items-center justify-content-lg-end">
                <?php foreach ($settings['ms_brand_list'] as $key => $item) :
                  if (!empty($item['ms_brand_image']['url'])) {
                    $ms_brand_image_url = !empty($item['ms_brand_image']['id']) ? wp_get_attachment_image_url($item['ms_brand_image']['id'], $settings['thumbnail_size']) : $item['ms_brand_image']['url'];
                    $ms_brand_image_alt = get_post_meta($item["ms_brand_image"]["id"], "_wp_attachment_image_alt", true);
                  }
                ?>
                  <div class="ms-author-brand-item text-center">
                    <img src="<?php echo esc_url($ms_brand_image_url); ?>" alt="<?php echo esc_attr($ms_brand_image_alt); ?>">
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- testimonial area end -->


<?php
  }
}

$widgets_manager->register(new MS_Author_Quote());
