<?php

namespace MSCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Utils;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Repeater;


if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Ms Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class MS_Header_04 extends Widget_Base
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
      return 'ms-header-style-4';
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
      return __('Header Builder Style 4', 'mscore');
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
    * Menu index.
    *
    * @access protected
    * @var $nav_menu_index
    */
   protected $nav_menu_index = 1;

   /**
    * Retrieve the menu index.
    *
    * Used to get index of nav menu.
    *
    * @since 1.3.0
    * @access protected
    *
    * @return string nav index.
    */
   protected function get_nav_menu_index()
   {
      return $this->nav_menu_index++;
   }

   /**
    * Retrieve the list of available menus.
    *
    * Used to get the list of available menus.
    *
    * @since 1.3.0
    * @access private
    *
    * @return array get WordPress menus list.
    */
   private function get_available_menus()
   {

      $menus = wp_get_nav_menus();

      $options = [];

      foreach ($menus as $menu) {
         $options[$menu->slug] = $menu->name;
      }

      return $options;
   }



   protected static function get_profile_names()
   {
      return [
         '500px' => esc_html__('500px', 'mscore'),
         'apple' => esc_html__('Apple', 'mscore'),
         'behance' => esc_html__('Behance', 'mscore'),
         'bitbucket' => esc_html__('BitBucket', 'mscore'),
         'codepen' => esc_html__('CodePen', 'mscore'),
         'delicious' => esc_html__('Delicious', 'mscore'),
         'deviantart' => esc_html__('DeviantArt', 'mscore'),
         'digg' => esc_html__('Digg', 'mscore'),
         'dribbble' => esc_html__('Dribbble', 'mscore'),
         'email' => esc_html__('Email', 'mscore'),
         'facebook' => esc_html__('Facebook', 'mscore'),
         'flickr' => esc_html__('Flicker', 'mscore'),
         'foursquare' => esc_html__('FourSquare', 'mscore'),
         'github' => esc_html__('Github', 'mscore'),
         'houzz' => esc_html__('Houzz', 'mscore'),
         'instagram' => esc_html__('Instagram', 'mscore'),
         'jsfiddle' => esc_html__('JS Fiddle', 'mscore'),
         'linkedin' => esc_html__('LinkedIn', 'mscore'),
         'medium' => esc_html__('Medium', 'mscore'),
         'pinterest' => esc_html__('Pinterest', 'mscore'),
         'product-hunt' => esc_html__('Product Hunt', 'mscore'),
         'reddit' => esc_html__('Reddit', 'mscore'),
         'slideshare' => esc_html__('Slide Share', 'mscore'),
         'snapchat' => esc_html__('Snapchat', 'mscore'),
         'soundcloud' => esc_html__('SoundCloud', 'mscore'),
         'spotify' => esc_html__('Spotify', 'mscore'),
         'stack-overflow' => esc_html__('StackOverflow', 'mscore'),
         'tripadvisor' => esc_html__('TripAdvisor', 'mscore'),
         'tumblr' => esc_html__('Tumblr', 'mscore'),
         'twitch' => esc_html__('Twitch', 'mscore'),
         'twitter' => esc_html__('Twitter', 'mscore'),
         'vimeo' => esc_html__('Vimeo', 'mscore'),
         'vk' => esc_html__('VK', 'mscore'),
         'website' => esc_html__('Website', 'mscore'),
         'whatsapp' => esc_html__('WhatsApp', 'mscore'),
         'wordpress' => esc_html__('WordPress', 'mscore'),
         'xing' => esc_html__('Xing', 'mscore'),
         'yelp' => esc_html__('Yelp', 'mscore'),
         'youtube' => esc_html__('YouTube', 'mscore'),
      ];
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
         'ms_header_top',
         [
            'label' => esc_html__('Header Info', 'mscore'),
         ]
      );

      $this->add_control(
         'ms_header_right_switch',
         [
            'label' => esc_html__('Header Right Switch', 'mscore'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Show', 'mscore'),
            'label_off' => esc_html__('Hide', 'mscore'),
            'return_value' => 'yes',
            'default' => 'no',
         ]
      );

      $this->add_control(
         'ms_header_search_switch',
         [
            'label' => esc_html__('Header Search Switch', 'mscore'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Show', 'mscore'),
            'label_off' => esc_html__('Hide', 'mscore'),
            'return_value' => 'yes',
            'default' => 'no',
         ]
      );

      $this->add_control(
         'ms_header_wishlist_switch',
         [
            'label' => esc_html__('Header Wishlist Switch', 'mscore'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Show', 'mscore'),
            'label_off' => esc_html__('Hide', 'mscore'),
            'return_value' => 'yes',
            'default' => 'no',
         ]
      );

      $this->add_control(
         'ms_header_cart_switch',
         [
            'label' => esc_html__('Header Cart Switch', 'mscore'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Show', 'mscore'),
            'label_off' => esc_html__('Hide', 'mscore'),
            'return_value' => 'yes',
            'default' => 'no',
         ]
      );

      $this->add_control(
         'enable_bottom_menu',
         [
            'label'        => esc_html__('Enable Bottom Menu Switch', 'mscore'),
            'type'         => \Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__('Show', 'mscore'),
            'label_off'    => esc_html__('Hide', 'mscore'),
            'return_value' => 'yes',
            'default'      => 'no',
         ]
      );

      $this->end_controls_section();


      // _ms_image
      $this->start_controls_section(
         '_ms_image',
         [
            'label' => esc_html__('Site Logo', 'ms-core'),
         ]
      );

      $this->add_control(
         'ms_image',
         [
            'label' => esc_html__('Choose Image', 'ms-core'),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
               'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
         ]
      );
      $this->add_control(
         'ms_image_dark',
         [
            'label' => esc_html__('Choose Dark Image', 'ms-core'),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
               'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
         ]
      );

      $this->add_group_control(
         Group_Control_Image_Size::get_type(),
         [
            'name'    => 'ms_image_size',
            'label'   => __('Image Size', 'header-footer-elementor'),
            'default' => 'medium',
         ]
      );

      $this->end_controls_section();


      $this->start_controls_section(
         'section_menu',
         [
            'label' => __('Menu', 'header-footer-elementor'),
         ]
      );

      $menus = $this->get_available_menus();

      if (!empty($menus)) {
         $this->add_control(
            'menu',
            [
               'label'        => __('Menu', 'header-footer-elementor'),
               'type'         => Controls_Manager::SELECT,
               'options'      => $menus,
               'default'      => array_keys($menus)[0],
               'save_default' => true,
               /* translators: %s Nav menu URL */
               'description'  => sprintf(__('Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'header-footer-elementor'), admin_url('nav-menus.php')),
            ]
         );
      } else {
         $this->add_control(
            'menu',
            [
               'type'            => Controls_Manager::RAW_HTML,
               /* translators: %s Nav menu URL */
               'raw'             => sprintf(__('<strong>There are no menus in your site.</strong><br>Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'header-footer-elementor'), admin_url('nav-menus.php?action=edit&menu=0')),
               'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
            ]
         );
      }

      $this->add_control(
         'menu_last_item',
         [
            'label'     => __('Last Menu Item', 'header-footer-elementor'),
            'type'      => Controls_Manager::SELECT,
            'options'   => [
               'none' => __('Default', 'header-footer-elementor'),
               'cta'  => __('Button', 'header-footer-elementor'),
            ],
            'default'   => 'none',
            'condition' => [
               'layout!' => 'expandible',
            ],
         ]
      );

      $this->end_controls_section();

      $this->start_controls_section(
         'ms_offcanvas_secs',
         [
            'label' => esc_html__('Offcanvas Controls', 'mscore'),
            'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
         ]
      );

      $this->add_control(
         'ms_offcanvas_category_switch',
         [
            'label'        => esc_html__('Enable Category Menu', 'mscore'),
            'type'         => \Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__('Show', 'mscore'),
            'label_off'    => esc_html__('Hide', 'mscore'),
            'return_value' => 'yes',
            'default'      => 'no',
         ]
      );

      $this->add_control(
         'ms_offcanvas_category_text',
         [
            'label'       => esc_html__('Category Button Text', 'mscore'),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__('All Department', 'mscore'),
            'placeholder' => esc_html__('Your Text', 'mscore'),
            'label_block' => true
         ]
      );


      $menus = $this->get_available_menus();

      if (!empty($menus)) {
         $this->add_control(
            'category_menu',
            [
               'label'        => __('Menu', 'header-footer-elementor'),
               'type'         => Controls_Manager::SELECT,
               'options'      => $menus,
               'default'      => array_keys($menus)[0],
               'save_default' => true,
               /* translators: %s Nav menu URL */
               'description'  => sprintf(__('Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'header-footer-elementor'), admin_url('nav-menus.php')),
            ]
         );
      } else {
         $this->add_control(
            'category_menu',
            [
               'type'            => Controls_Manager::RAW_HTML,
               /* translators: %s Nav menu URL */
               'raw'             => sprintf(__('<strong>There are no menus in your site.</strong><br>Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'header-footer-elementor'), admin_url('nav-menus.php?action=edit&menu=0')),
               'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
            ]
         );
      }

      $this->add_control(
         'category_menu_last_item',
         [
            'label'     => __('Last Menu Item', 'header-footer-elementor'),
            'type'      => Controls_Manager::SELECT,
            'options'   => [
               'none' => __('Default', 'header-footer-elementor'),
               'cta'  => __('Button', 'header-footer-elementor'),
            ],
            'default'   => 'none',
            'condition' => [
               'layout!' => 'expandible',
            ],
         ]
      );

      $this->add_control(
         'shofy_offcanvas_style',
         [
            'label'   => esc_html__('Offcanvas Style', 'mscore'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
               'default'  => esc_html__('Default Style', 'mscore'),
               'dark_brown'  => esc_html__('Dark Brown Style', 'mscore'),
               'brown'  => esc_html__('Brown Style', 'mscore'),
               'green'  => esc_html__('Green Style', 'mscore'),
            ],
            'default' => 'default',
         ]
      );

      $this->add_control(
         'ms_offcanvas_lang_switch',
         [
            'label'        => esc_html__('Enable Language?', 'mscore'),
            'type'         => \Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__('Show', 'mscore'),
            'label_off'    => esc_html__('Hide', 'mscore'),
            'return_value' => 'yes',
            'default'      => 'no',
         ]
      );
      $this->add_control(
         'ms_offcanvas_currency_switch',
         [
            'label'        => esc_html__('Enable Currency?', 'mscore'),
            'type'         => \Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__('Show', 'mscore'),
            'label_off'    => esc_html__('Hide', 'mscore'),
            'return_value' => 'yes',
            'default'      => 'no',
         ]
      );
      $this->add_control(
         'ms_offcanvas_currency_shortcode',
         [
            'label'       => esc_html__('Currency Shortcode', 'mscore'),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__('[code]', 'mscore'),
            'placeholder' => esc_html__('YOur Text', 'mscore'),
            'condition' => [
               'ms_offcanvas_currency_switch' => 'yes'
            ]
         ]
      );

      $this->add_control(
         'ms_side_logo',
         [
            'label' => esc_html__('Choose Logo', 'ms-core'),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
               'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
         ]
      );

      $this->add_group_control(
         Group_Control_Image_Size::get_type(),
         [
            'name'    => 'ms_side_logo_size',
            'label'   => __('Image Size', 'header-footer-elementor'),
            'default' => 'medium',
         ]
      );


      $this->end_controls_section();

      $this->start_controls_section(
         'ms_tpbtn_button_group',
         [
            'label' => esc_html__('Offcanvas Button', 'mscore'),
         ]
      );

      $this->add_control(
         'ms_tpbtn_button_show',
         [
            'label' => esc_html__('Show Button', 'mscore'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Show', 'mscore'),
            'label_off' => esc_html__('Hide', 'mscore'),
            'return_value' => 'yes',
            'default' => 'no',
         ]
      );

      $this->add_control(
         'ms_tpbtn_text',
         [
            'label' => esc_html__('Offcanvas Button Text', 'mscore'),
            'type' => Controls_Manager::TEXT,
            'default' => 'Contact Us',
            'title' => esc_html__('Enter button text', 'mscore'),
            'label_block' => true,
            'condition' => [
               'ms_tpbtn_button_show' => 'yes'
            ],
         ]
      );
      $this->add_control(
         'ms_tpbtn_link_type',
         [
            'label' => esc_html__('Offcanvas Button' . ' Link Type', 'mscore'),
            'type' => Controls_Manager::SELECT,
            'options' => [
               '1' => 'Custom Link',
               '2' => 'Internal Page',
            ],
            'default' => '1',
            'label_block' => true,
            'condition' => [
               'ms_tpbtn_button_show' => 'yes'
            ],
         ]
      );
      $this->add_control(
         'ms_tpbtn_link',
         [
            'label' => esc_html__('Offcanvas Button' . ' link', 'mscore'),
            'type' => Controls_Manager::URL,
            'dynamic' => [
               'active' => true,
            ],
            'placeholder' => esc_html__('https://your-link.com', 'mscore'),
            'show_external' => false,
            'default' => [
               'url' => '#',
               'is_external' => false,
               'nofollow' => false,
            ],
            'condition' => [
               'ms_tpbtn_link_type' => '1',
               'ms_tpbtn_button_show' => 'yes'
            ],
            'label_block' => true,
         ]
      );
      $this->add_control(
         'ms_tpbtn_page_link',
         [
            'label' => esc_html__('Select ' . 'Offcanvas Button' . ' Page', 'mscore'),
            'type' => Controls_Manager::SELECT2,
            'label_block' => true,
            'options' => ms_get_all_pages(),
            'condition' => [
               'ms_tpbtn_link_type' => '2',
               'ms_tpbtn_button_show' => 'yes'
            ]
         ]
      );
      $this->end_controls_section();
   }

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
      $menus = $this->get_available_menus();

      if (empty($menus)) {
         return false;
      }

      require_once get_parent_theme_file_path() . '/inc/class-navwalker.php';

      $args = [
         'echo'        => false,
         'menu'        => $settings['menu'],
         'menu_class'  => 'ms-nav-menu',
         'menu_id'     => 'menu-' . $this->get_nav_menu_index() . '-' . $this->get_id(),
         'fallback_cb' => 'Shofy_Navwalker_Class::fallback',
         'container'   => '',
         'walker'         => new Shofy_Navwalker_Class,
      ];

      $menu_html = wp_nav_menu($args);

      $category_args = [
         'echo'        => false,
         'menu'        => $settings['category_menu'],
         'menu_class'  => 'ms-nav-menu',
         'menu_id'     => 'menu-' . $this->get_nav_menu_index() . '-' . $this->get_id(),
         'fallback_cb' => 'Shofy_Navwalker_Class::fallback',
         'container'   => '',
         'walker'         => new Shofy_Navwalker_Class,
      ];

      $category_menu_html = wp_nav_menu($category_args);

      // group image size
      $size = $settings['ms_image_size_size'];
      if ('custom' !== $size) {
         $image_size = $size;
      } else {
         require_once ELEMENTOR_PATH . 'includes/libraries/bfi-thumb/bfi-thumb.php';
         $image_dimension = $settings['ms_image_size_custom_dimension'];
         $image_size = [
            // Defaults sizes.
            0           => null, // Width.
            1           => null, // Height.

            'bfi_thumb' => true,
            'crop'      => true,
         ];
         $has_custom_size = false;
         if (!empty($image_dimension['width'])) {
            $has_custom_size = true;
            $image_size[0]   = $image_dimension['width'];
         }

         if (!empty($image_dimension['height'])) {
            $has_custom_size = true;
            $image_size[1]   = $image_dimension['height'];
         }

         if (!$has_custom_size) {
            $image_size = 'full';
         }
      }

      // side logo image size
      $side_logo_size = $settings['ms_side_logo_size_size'];

      if ('custom' !== $side_logo_size) {
         $side_logo_image_size = $side_logo_size;
      } else {
         require_once ELEMENTOR_PATH . 'includes/libraries/bfi-thumb/bfi-thumb.php';
         $side_logo_image_dimension = $settings['ms_side_logo_size_custom_dimension'];
         $side_logo_image_size = [
            // Defaults sizes.
            0           => null, // Width.
            1           => null, // Height.

            'bfi_thumb' => true,
            'crop'      => true,
         ];
         $side_logo_has_custom_size = false;
         if (!empty($side_logo_image_dimension['width'])) {
            $side_logo_has_custom_size = true;
            $side_logo_image_size[0]   = $side_logo_image_dimension['width'];
         }

         if (!empty($side_logo_image_dimension['height'])) {
            $side_logo_has_custom_size = true;
            $side_logo_image_size[1]   = $side_logo_image_dimension['height'];
         }

         if (!$side_logo_has_custom_size) {
            $side_logo_image_size = 'full';
         }
      }


      if (!empty($settings['ms_image']['url'])) {
         $ms_image = !empty($settings['ms_image']['id']) ? wp_get_attachment_image_url($settings['ms_image']['id'], $image_size, true) : $settings['ms_image']['url'];
         $ms_image_alt = get_post_meta($settings["ms_image"]["id"], "_wp_attachment_image_alt", true);
      }

      if (!empty($settings['ms_image_dark']['url'])) {
         $ms_image_dark = !empty($settings['ms_image_dark']['id']) ? wp_get_attachment_image_url($settings['ms_image_dark']['id'], $image_size, true) : $settings['ms_image_dark']['url'];
         $ms_image_dark_alt = get_post_meta($settings["ms_image_dark"]["id"], "_wp_attachment_image_alt", true);
      }

      if (!empty($settings['ms_side_logo']['url'])) {
         $ms_side_logo = !empty($settings['ms_side_logo']['id']) ? wp_get_attachment_image_url($settings['ms_side_logo']['id'], $side_logo_image_size, true) : $settings['ms_side_logo']['url'];
         $ms_side_logo_alt = get_post_meta($settings["ms_side_logo"]["id"], "_wp_attachment_image_alt", true);
      }


      if ('2' == $settings['ms_tpbtn_link_type']) {
         $link = get_permalink($settings['ms_tpbtn_page_link']);
         $target = '_self';
         $rel = 'nofollow';
      } else {
         $link = !empty($settings['ms_tpbtn_link']['url']) ? $settings['ms_tpbtn_link']['url'] : '';
         $target = !empty($settings['ms_tpbtn_link']['is_external']) ? '_blank' : '';
         $rel = !empty($settings['ms_tpbtn_link']['nofollow']) ? 'nofollow' : '';
      }


      $get_offcanvas_style = $settings['shofy_offcanvas_style'];


      if ($get_offcanvas_style == "dark_brown") {
         $offcanvas_style = 'offcanvas__style-darkRed';
      } elseif ($get_offcanvas_style == "brown") {
         $offcanvas_style = 'offcanvas__style-brown';
      } elseif ($get_offcanvas_style == "green") {
         $offcanvas_style = 'offcanvas__style-green';
      } else {
         $offcanvas_style = 'offcanvas__style-primary';
      }

?>

      <header>
         <div id="header-sticky" class="ms-header-area ms-header-style-transparent-white ms-header-sticky ms-header-transparent has-dark-logo ms-header-height" style="height: 62px;">
            <div class="ms-header-bottom-3 pl-85 pr-85">
               <div class="container-fluid">
                  <div class="row align-items-center">
                     <?php if (!empty($ms_image) && !empty($ms_image_dark)) : ?>
                        <div class="col-xl-2 col-lg-2 col-6">
                           <div class="logo">
                              <a href="<?php print esc_url(home_url('/')); ?>">
                                 <img class="logo-light" src="<?php echo esc_url($ms_image); ?>" alt="<?php echo esc_attr($ms_image_alt); ?>">
                                 <img class="logo-dark" src="<?php echo esc_url($ms_image_dark); ?>" alt="<?php echo esc_attr($ms_image_dark_alt); ?>">
                              </a>
                           </div>
                        </div>
                     <?php endif; ?>

                     <div class="col-xl-8 col-lg-8 d-none d-lg-block">
                        <div class="main-menu menu-style-3 menu-style-4 p-relative">
                           <nav class="ms-main-menu-content">
                              <?php echo $menu_html; ?>
                           </nav>
                        </div>
                     </div>
                     <div class="ms-category-menu-wrapper d-none">
                        <nav class="ms-category-menu-content">
                           <?php echo $category_menu_html; ?>
                        </nav>
                     </div>
                     <div class="col-xl-2 col-lg-2 col-6">
                        <div class="ms-header-action d-flex align-items-center justify-content-end ml-50">
                           <?php if ($settings['ms_header_right_switch'] === 'yes') : ?>

                              <?php if ($settings['ms_header_search_switch'] === 'yes') : ?>
                                 <div class="ms-header-action-item d-none d-sm-block">
                                    <button type="button" class="ms-header-action-btn ms-search-open-btn">
                                       <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M9 17C13.4183 17 17 13.4183 17 9C17 4.58172 13.4183 1 9 1C4.58172 1 1 4.58172 1 9C1 13.4183 4.58172 17 9 17Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                          <path d="M18.9999 19L14.6499 14.65" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                       </svg>
                                    </button>
                                 </div>
                              <?php endif; ?>

                              <?php if (class_exists('WPCleverWoosw') && ($settings['ms_header_wishlist_switch'] === 'yes')) :
                                 $wishlist_data = new \WPCleverWoosw();

                                 $key        = $wishlist_data::get_key();
                                 $products   = $wishlist_data::get_ids($key);
                                 $count      = count($products);
                              ?>
                                 <div class="ms-header-action-item d-none d-sm-block">
                                    <a href="wishlist.html" class="ms-header-action-btn">
                                       <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path fill-rule="evenodd" clip-rule="evenodd" d="M11.239 18.8538C13.4096 17.5179 15.4289 15.9456 17.2607 14.1652C18.5486 12.8829 19.529 11.3198 20.1269 9.59539C21.2029 6.25031 19.9461 2.42083 16.4289 1.28752C14.5804 0.692435 12.5616 1.03255 11.0039 2.20148C9.44567 1.03398 7.42754 0.693978 5.57894 1.28752C2.06175 2.42083 0.795919 6.25031 1.87187 9.59539C2.46978 11.3198 3.45021 12.8829 4.73806 14.1652C6.56988 15.9456 8.58917 17.5179 10.7598 18.8538L10.9949 19L11.239 18.8538Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                          <path d="M7.26062 5.05302C6.19531 5.39332 5.43839 6.34973 5.3438 7.47501" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                       </svg>
                                       <span class="ms-header-action-badge"><?php echo esc_html($count); ?></span>
                                    </a>
                                 </div>
                              <?php endif; ?>

                              <?php if (($settings['ms_header_cart_switch'] === 'yes') && class_exists('WooCommerce')) : ?>
                                 <div class="ms-header-action-item d-none d-sm-block">
                                    <button type="button" class="ms-header-action-btn cartmini-open-btn">
                                       <svg width="21" height="22" viewBox="0 0 21 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path fill-rule="evenodd" clip-rule="evenodd" d="M6.48626 20.5H14.8341C17.9004 20.5 20.2528 19.3924 19.5847 14.9348L18.8066 8.89359C18.3947 6.66934 16.976 5.81808 15.7311 5.81808H5.55262C4.28946 5.81808 2.95308 6.73341 2.4771 8.89359L1.69907 14.9348C1.13157 18.889 3.4199 20.5 6.48626 20.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                          <path d="M6.34902 5.5984C6.34902 3.21232 8.28331 1.27803 10.6694 1.27803V1.27803C11.8184 1.27316 12.922 1.72619 13.7362 2.53695C14.5504 3.3477 15.0081 4.44939 15.0081 5.5984V5.5984" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                          <path d="M7.70365 10.1018H7.74942" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                          <path d="M13.5343 10.1018H13.5801" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                       </svg>

                                       <?php if (!is_null(WC()->cart)) : ?>
                                          <span id="ms-cart-item" class="ms-header-action-badge cart__count">
                                             <?php echo esc_html(WC()->cart->cart_contents_count); ?>
                                          </span>
                                       <?php endif; ?>
                                    </button>
                                 </div>
                              <?php endif; ?>

                           <?php endif; ?> <!-- right endif here -->

                           <div class="ms-header-action-item d-lg-none">
                              <button type="button" class="ms-header-action-btn ms-offcanvas-open-btn">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="30" height="16" viewBox="0 0 30 16">
                                    <rect x="10" width="20" height="2" fill="currentColor"></rect>
                                    <rect x="5" y="7" width="25" height="2" fill="currentColor"></rect>
                                    <rect x="10" y="14" width="20" height="2" fill="currentColor"></rect>
                                 </svg>
                              </button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </header>


      <?php include(MSCORE_ELEMENTS_PATH . '/header-side/header-cart-mini.php'); ?>

      <?php if ($settings['enable_bottom_menu'] == 'yes') : ?>
         <?php include(MSCORE_ELEMENTS_PATH . '/header-side/bottom-menu.php'); ?>
      <?php endif; ?>

      <div class="offcanvas__area <?php echo esc_attr($offcanvas_style); ?>">
         <?php include(MSCORE_ELEMENTS_PATH . '/header-side/header-side-1.php'); ?>
      </div>


<?php
   }
}

$widgets_manager->register(new MS_Header_04());
