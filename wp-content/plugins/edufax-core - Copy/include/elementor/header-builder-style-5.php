<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Utils;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
Use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Repeater;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Header_05 extends Widget_Base {

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
		return 'tp-header-style-5';
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
		return __( 'Header Builder Style 5', 'tpcore' );
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
    protected function get_nav_menu_index() {
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
    private function get_available_menus() {

        $menus = wp_get_nav_menus();

        $options = [];

        foreach ( $menus as $menu ) {
            $options[ $menu->slug ] = $menu->name;
        }

        return $options;
    }



     protected static function get_profile_names()
     {
         return [
             '500px' => esc_html__('500px', 'tpcore'),
             'apple' => esc_html__('Apple', 'tpcore'),
             'behance' => esc_html__('Behance', 'tpcore'),
             'bitbucket' => esc_html__('BitBucket', 'tpcore'),
             'codepen' => esc_html__('CodePen', 'tpcore'),
             'delicious' => esc_html__('Delicious', 'tpcore'),
             'deviantart' => esc_html__('DeviantArt', 'tpcore'),
             'digg' => esc_html__('Digg', 'tpcore'),
             'dribbble' => esc_html__('Dribbble', 'tpcore'),
             'email' => esc_html__('Email', 'tpcore'),
             'facebook' => esc_html__('Facebook', 'tpcore'),
             'flickr' => esc_html__('Flicker', 'tpcore'),
             'foursquare' => esc_html__('FourSquare', 'tpcore'),
             'github' => esc_html__('Github', 'tpcore'),
             'houzz' => esc_html__('Houzz', 'tpcore'),
             'instagram' => esc_html__('Instagram', 'tpcore'),
             'jsfiddle' => esc_html__('JS Fiddle', 'tpcore'),
             'linkedin' => esc_html__('LinkedIn', 'tpcore'),
             'medium' => esc_html__('Medium', 'tpcore'),
             'pinterest' => esc_html__('Pinterest', 'tpcore'),
             'product-hunt' => esc_html__('Product Hunt', 'tpcore'),
             'reddit' => esc_html__('Reddit', 'tpcore'),
             'slideshare' => esc_html__('Slide Share', 'tpcore'),
             'snapchat' => esc_html__('Snapchat', 'tpcore'),
             'soundcloud' => esc_html__('SoundCloud', 'tpcore'),
             'spotify' => esc_html__('Spotify', 'tpcore'),
             'stack-overflow' => esc_html__('StackOverflow', 'tpcore'),
             'tripadvisor' => esc_html__('TripAdvisor', 'tpcore'),
             'tumblr' => esc_html__('Tumblr', 'tpcore'),
             'twitch' => esc_html__('Twitch', 'tpcore'),
             'twitter' => esc_html__('Twitter', 'tpcore'),
             'vimeo' => esc_html__('Vimeo', 'tpcore'),
             'vk' => esc_html__('VK', 'tpcore'),
             'website' => esc_html__('Website', 'tpcore'),
             'whatsapp' => esc_html__('WhatsApp', 'tpcore'),
             'wordpress' => esc_html__('WordPress', 'tpcore'),
             'xing' => esc_html__('Xing', 'tpcore'),
             'yelp' => esc_html__('Yelp', 'tpcore'),
             'youtube' => esc_html__('YouTube', 'tpcore'),
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

    protected function register_controls(){
        $this->register_controls_section();
        $this->style_tab_content();
    } 

	protected function register_controls_section() {

        // layout Panel
        $this->start_controls_section(
            'tp_header_top',
            [
                'label' => esc_html__('Header Info', 'tpcore'),
            ]
        ); 
   
        $this->add_control(
            'tp_header_right_switch',
            [
                'label' => esc_html__( 'Header Right Switch', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tpcore' ),
                'label_off' => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );        

        $this->add_control(
            'tp_header_search_switch',
            [
                'label' => esc_html__( 'Header Search Switch', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tpcore' ),
                'label_off' => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );     
        $this->add_control(
        'tp_header_search_text',
         [
            'label'       => esc_html__( 'Search Text', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'Search', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
            'lable_block' => true,
            'condition' => [
                'tp_header_search_switch' => 'yes'
            ]
         ]
        );   

        $this->add_control(
            'tp_header_wishlist_switch',
            [
                'label' => esc_html__( 'Header Wishlist Switch', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tpcore' ),
                'label_off' => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );        

        $this->add_control(
            'tp_header_cart_switch',
            [
                'label' => esc_html__( 'Header Cart Switch', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tpcore' ),
                'label_off' => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'tp_header_login_switch',
            [
                'label' => esc_html__( 'Header Login Switch', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tpcore' ),
                'label_off' => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'no',                
            ]
        );

        $this->add_control(
        'tp_header_login_text',
         [
            'label'       => esc_html__( 'Login Text', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'Welcome ', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
            'condition' => [
               'tp_header_login_switch' => 'yes'
             ]
         ]
        );
        $this->add_control(
        'tp_header_login_text_not',
         [
            'label'       => esc_html__( 'Not Login Text', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'Hello ', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
            'condition' => [
               'tp_header_login_switch' => 'yes'
             ]
         ]
        );
        $this->add_control(
        'tp_header_login_register_text',
         [
            'label'       => esc_html__( 'Register Text', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'Register ', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
            'condition' => [
               'tp_header_login_switch' => 'yes'
             ]
         ]
        );

        $this->add_control(
            'enable_bottom_menu',
            [
              'label'        => esc_html__( 'Enable Bottom Menu Switch', 'tpcore' ),
              'type'         => \Elementor\Controls_Manager::SWITCHER,
              'label_on'     => esc_html__( 'Show', 'tpcore' ),
              'label_off'    => esc_html__( 'Hide', 'tpcore' ),
              'return_value' => 'yes',
              'default'      => 'no',
            ]
           );

        $this->end_controls_section();

		// _tp_image
		$this->start_controls_section(
            '_tp_image',
            [
                'label' => esc_html__('Site Logo', 'tp-core'),
            ]
        );

        $this->add_control(
            'tp_image',
            [
                'label' => esc_html__( 'Choose Image', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'    => 'tp_image_size',
				'label'   => __( 'Image Size', 'header-footer-elementor' ),
				'default' => 'medium',
			]
		);

        $this->end_controls_section();


		$this->start_controls_section(
            'section_menu',
            [
                'label' => __( 'Menu', 'header-footer-elementor' ),
            ]
        );

        $menus = $this->get_available_menus();

        if ( ! empty( $menus ) ) {
            $this->add_control(
                'menu',
                [
                    'label'        => __( 'Menu', 'header-footer-elementor' ),
                    'type'         => Controls_Manager::SELECT,
                    'options'      => $menus,
                    'default'      => array_keys( $menus )[0],
                    'save_default' => true,
                    /* translators: %s Nav menu URL */
                    'description'  => sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'header-footer-elementor' ), admin_url( 'nav-menus.php' ) ),
                ]
            );
        } else {
            $this->add_control(
                'menu',
                [
                    'type'            => Controls_Manager::RAW_HTML,
                    /* translators: %s Nav menu URL */
                    'raw'             => sprintf( __( '<strong>There are no menus in your site.</strong><br>Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'header-footer-elementor' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                ]
            );
        }

        $this->add_control(
            'menu_last_item',
            [
                'label'     => __( 'Last Menu Item', 'header-footer-elementor' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'none' => __( 'Default', 'header-footer-elementor' ),
                    'cta'  => __( 'Button', 'header-footer-elementor' ),
                ],
                'default'   => 'none',
                'condition' => [
                    'layout!' => 'expandible',
                ],
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
            'category_menu_section',
            [
                'label' => __( 'Category Menu', 'header-footer-elementor' ),
            ]
        );

        $this->add_control(
         'category_menu_switch',
         [
           'label'        => esc_html__( 'Show Category Menu', 'tpcore' ),
           'type'         => \Elementor\Controls_Manager::SWITCHER,
           'label_on'     => esc_html__( 'Show', 'tpcore' ),
           'label_off'    => esc_html__( 'Hide', 'tpcore' ),
           'return_value' => 'yes',
           'default'      => 'no',
         ]
        );

        
        $menus = $this->get_available_menus();

        if ( ! empty( $menus ) ) {
            $this->add_control(
                'category_menu',
                [
                    'label'        => __( 'Menu', 'header-footer-elementor' ),
                    'type'         => Controls_Manager::SELECT,
                    'options'      => $menus,
                    'default'      => array_keys( $menus )[0],
                    'save_default' => true,
                    /* translators: %s Nav menu URL */
                    'description'  => sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'header-footer-elementor' ), admin_url( 'nav-menus.php' ) ),
                ]
            );
        } else {
            $this->add_control(
                'category_menu',
                [
                    'type'            => Controls_Manager::RAW_HTML,
                    /* translators: %s Nav menu URL */
                    'raw'             => sprintf( __( '<strong>There are no menus in your site.</strong><br>Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'header-footer-elementor' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                ]
            );
        }

        $this->add_control(
            'category_menu_last_item',
            [
                'label'     => __( 'Last Menu Item', 'header-footer-elementor' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'none' => __( 'Default', 'header-footer-elementor' ),
                    'cta'  => __( 'Button', 'header-footer-elementor' ),
                ],
                'default'   => 'none',
                'condition' => [
                    'layout!' => 'expandible',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'tp_offcanvas_secs',
                [
                  'label' => esc_html__( 'Offcanvas Controls', 'tpcore' ),
                  'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
           );
           
           $this->add_control(
            'tp_offcanvas_category_switch',
            [
              'label'        => esc_html__( 'Enable Category Menu', 'tpcore' ),
              'type'         => \Elementor\Controls_Manager::SWITCHER,
              'label_on'     => esc_html__( 'Show', 'tpcore' ),
              'label_off'    => esc_html__( 'Hide', 'tpcore' ),
              'return_value' => 'yes',
              'default'      => 'no',
            ]
           );
   
           $this->add_control(
           'tp_offcanvas_category_text',
            [
               'label'       => esc_html__( 'Category Button Text', 'tpcore' ),
               'type'        => \Elementor\Controls_Manager::TEXT,
               'default'     => esc_html__( 'All Department', 'tpcore' ),
               'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
               'label_block' => true
            ]
           );
   
           $this->add_control(
            'shofy_offcanvas_style',
            [
              'label'   => esc_html__( 'Offcanvas Style', 'tpcore' ),
              'type' => \Elementor\Controls_Manager::SELECT,
              'options' => [
                  'default'  => esc_html__( 'Default Style', 'tpcore' ),
                  'dark_brown'  => esc_html__( 'Dark Brown Style', 'tpcore' ),
                  'brown'  => esc_html__( 'Brown Style', 'tpcore' ),
                  'green'  => esc_html__( 'Green Style', 'tpcore' ),
              ],
              'default' => 'default',
            ]
           );
   
           $this->add_control(
            'tp_offcanvas_lang_switch',
            [
              'label'        => esc_html__( 'Enable Language?', 'tpcore' ),
              'type'         => \Elementor\Controls_Manager::SWITCHER,
              'label_on'     => esc_html__( 'Show', 'tpcore' ),
              'label_off'    => esc_html__( 'Hide', 'tpcore' ),
              'return_value' => 'yes',
              'default'      => 'no',
            ]
           );
           $this->add_control(
            'tp_offcanvas_currency_switch',
            [
              'label'        => esc_html__( 'Enable Currency?', 'tpcore' ),
              'type'         => \Elementor\Controls_Manager::SWITCHER,
              'label_on'     => esc_html__( 'Show', 'tpcore' ),
              'label_off'    => esc_html__( 'Hide', 'tpcore' ),
              'return_value' => 'yes',
              'default'      => 'no',
            ]
           );
           $this->add_control(
           'tp_offcanvas_currency_shortcode',
            [
               'label'       => esc_html__( 'Currency Shortcode', 'tpcore' ),
               'type'        => \Elementor\Controls_Manager::TEXT,
               'default'     => esc_html__( '[code]', 'tpcore' ),
               'placeholder' => esc_html__( 'YOur Text', 'tpcore' ),
               'condition' => [
                  'tp_offcanvas_currency_switch' => 'yes'
               ]
            ]
           );
   
           $this->add_control(
                  'tp_side_logo',
                  [
                     'label' => esc_html__( 'Choose Logo', 'tp-core' ),
                     'type' => \Elementor\Controls_Manager::MEDIA,
                     'default' => [
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
                     ],
                  ]
            );
            
            $this->add_group_control(
               Group_Control_Image_Size::get_type(),
               [
                  'name'    => 'tp_side_logo_size',
                  'label'   => __( 'Image Size', 'header-footer-elementor' ),
                  'default' => 'medium',
               ]
            );
   
           $this->end_controls_section();
   
           $this->start_controls_section(
                  'tp_tpbtn_button_group',
                  [
                     'label' => esc_html__('Offcanvas Button', 'tpcore'),
                  ]
            );
   
            $this->add_control(
                  'tp_tpbtn_button_show',
                  [
                     'label' => esc_html__( 'Show Button', 'tpcore' ),
                     'type' => \Elementor\Controls_Manager::SWITCHER,
                     'label_on' => esc_html__( 'Show', 'tpcore' ),
                     'label_off' => esc_html__( 'Hide', 'tpcore' ),
                     'return_value' => 'yes',
                     'default' => 'no',
                  ]
            );
   
            $this->add_control(
                  'tp_tpbtn_text',
                  [
                     'label' => esc_html__('Offcanvas Button Text', 'tpcore'),
                     'type' => Controls_Manager::TEXT,
                     'default' => 'Contact Us',
                     'title' => esc_html__('Enter button text', 'tpcore'),
                     'label_block' => true,
                     'condition' => [
                        'tp_tpbtn_button_show' => 'yes'
                     ],
                  ]
            );
            $this->add_control(
                  'tp_tpbtn_link_type',
                  [
                     'label' => esc_html__('Offcanvas Button' . ' Link Type', 'tpcore'),
                     'type' => Controls_Manager::SELECT,
                     'options' => [
                        '1' => 'Custom Link',
                        '2' => 'Internal Page',
                     ],
                     'default' => '1',
                     'label_block' => true,
                     'condition' => [
                        'tp_tpbtn_button_show' => 'yes'
                     ],
                  ]
            );
            $this->add_control(
                  'tp_tpbtn_link',
                  [
                     'label' => esc_html__('Offcanvas Button' . ' link', 'tpcore'),
                     'type' => Controls_Manager::URL,
                     'dynamic' => [
                        'active' => true,
                     ],
                     'placeholder' => esc_html__('https://your-link.com', 'tpcore'),
                     'show_external' => false,
                     'default' => [
                        'url' => '#',
                        'is_external' => false,
                        'nofollow' => false,
                     ],
                     'condition' => [
                        'tp_tpbtn_link_type' => '1',
                        'tp_tpbtn_button_show' => 'yes'
                     ],
                     'label_block' => true,
                  ]
            );
            $this->add_control(
                  'tp_tpbtn_page_link',
                  [
                     'label' => esc_html__('Select ' . 'Offcanvas Button' . ' Page', 'tpcore'),
                     'type' => Controls_Manager::SELECT2,
                     'label_block' => true,
                     'options' => tp_get_all_pages(),
                     'condition' => [
                        'tp_tpbtn_link_type' => '2',
                        'tp_tpbtn_button_show' => 'yes'
                     ]
                  ]
            );
            $this->end_controls_section();



	}

    protected function style_tab_content(){
        
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
		$control_id = 'tpbtn';
        $menus = $this->get_available_menus();

        if ( empty( $menus ) ) {
            return false;
        }

        require_once get_parent_theme_file_path(). '/inc/class-navwalker.php';

        $args = [
            'echo'        => false,
            'menu'        => $settings['menu'],
            'menu_class'  => 'tp-nav-menu',
            'menu_id'     => 'menu-' . $this->get_nav_menu_index() . '-' . $this->get_id(),
            'fallback_cb' => 'Shofy_Navwalker_Class::fallback',
            'container'   => '',
            'walker'         => new Shofy_Navwalker_Class,
        ];

        $menu_html = wp_nav_menu( $args );

        $category_args = [
            'echo'        => false,
            'menu'        => $settings['category_menu'],
            'menu_class'  => 'tp-nav-menu',
            'menu_id'     => 'menu-' . $this->get_nav_menu_index() . '-' . $this->get_id(),
            'fallback_cb' => 'Shofy_Navwalker_Class::fallback',
            'container'   => '',
            'walker'         => new Shofy_Navwalker_Class,
        ];

        $category_menu_html = wp_nav_menu( $category_args );



        // group image size
        $size = $settings['tp_image_size_size'];
		if ( 'custom' !== $size ) {
			$image_size = $size;
		} else {
        	require_once ELEMENTOR_PATH . 'includes/libraries/bfi-thumb/bfi-thumb.php';
			$image_dimension = $settings['tp_image_size_custom_dimension'];
			$image_size = [
				// Defaults sizes.
				0           => null, // Width.
				1           => null, // Height.

				'bfi_thumb' => true,
				'crop'      => true,
			];
			$has_custom_size = false;
			if ( ! empty( $image_dimension['width'] ) ) {
				$has_custom_size = true;
				$image_size[0]   = $image_dimension['width'];
			}

			if ( ! empty( $image_dimension['height'] ) ) {
				$has_custom_size = true;
				$image_size[1]   = $image_dimension['height'];
			}

			if ( ! $has_custom_size ) {
				$image_size = 'full';
			}
		}

        // side logo image size
        $side_logo_size = $settings['tp_side_logo_size_size'];       

		if ( 'custom' !== $side_logo_size ) {
			$side_logo_image_size = $side_logo_size;
		} else {
        	require_once ELEMENTOR_PATH . 'includes/libraries/bfi-thumb/bfi-thumb.php';
			$side_logo_image_dimension = $settings['tp_side_logo_size_custom_dimension'];
			$side_logo_image_size = [
				// Defaults sizes.
				0           => null, // Width.
				1           => null, // Height.

				'bfi_thumb' => true,
				'crop'      => true,
			];
			$side_logo_has_custom_size = false;
			if ( ! empty( $side_logo_image_dimension['width'] ) ) {
				$side_logo_has_custom_size = true;
				$side_logo_image_size[0]   = $side_logo_image_dimension['width'];
			}

			if ( ! empty( $side_logo_image_dimension['height'] ) ) {
				$side_logo_has_custom_size = true;
				$side_logo_image_size[1]   = $side_logo_image_dimension['height'];
			}

			if ( ! $side_logo_has_custom_size ) {
				$side_logo_image_size = 'full';
			}
		}


	    if ( !empty($settings['tp_image']['url']) ) {
	        $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $image_size, true) : $settings['tp_image']['url'];
	        $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
	    }	    

	    if ( !empty($settings['tp_image_dark']['url']) ) {
	        $tp_image_dark = !empty($settings['tp_image_dark']['id']) ? wp_get_attachment_image_url( $settings['tp_image_dark']['id'], $image_size, true) : $settings['tp_image_dark']['url'];
	        $tp_image_dark_alt = get_post_meta($settings["tp_image_dark"]["id"], "_wp_attachment_image_alt", true);
	    }	    

	    if ( !empty($settings['tp_side_logo']['url']) ) {
	        $tp_side_logo = !empty($settings['tp_side_logo']['id']) ? wp_get_attachment_image_url( $settings['tp_side_logo']['id'], $side_logo_image_size, true) : $settings['tp_side_logo']['url'];
	        $tp_side_logo_alt = get_post_meta($settings["tp_side_logo"]["id"], "_wp_attachment_image_alt", true);
	    }

       
       if ('2' == $settings['tp_tpbtn_link_type']) {
            $link = get_permalink($settings['tp_tpbtn_page_link']);
            $target = '_self';
            $rel = 'nofollow';
      } else {
            $link = !empty($settings['tp_tpbtn_link']['url']) ? $settings['tp_tpbtn_link']['url'] : '';
            $target = !empty($settings['tp_tpbtn_link']['is_external']) ? '_blank' : '';
            $rel = !empty($settings['tp_tpbtn_link']['nofollow']) ? 'nofollow' : '';
      }
       

       $get_offcanvas_style = $settings['shofy_offcanvas_style'];
   

       if( $get_offcanvas_style == "dark_brown"){
          $offcanvas_style = 'offcanvas__style-darkRed';
       }
       elseif ($get_offcanvas_style == "brown") {
          $offcanvas_style = 'offcanvas__style-brown';
       }
       elseif ($get_offcanvas_style == "green") {
          $offcanvas_style = 'offcanvas__style-green';
       }
       else{
          $offcanvas_style = 'offcanvas__style-primary';
       }

		?>

      <!-- header area start -->
      <header>
         <div id="header-sticky" class="tp-header-area p-relative tp-header-sticky tp-header-height">
            <div class="tp-header-5 pl-25 pr-25 theme-green-bg">
               <div class="container-fluid">
                  <div class="row align-items-center">
                     <div class="col-xl-2 col-lg-6 col-md-6 col-sm-5 col-8">
                        <div class="tp-header-left-5 d-flex align-items-center">

                        <?php if($settings['category_menu_switch'] == 'yes') :?>
                            <!-- category menu open -->
                           <div class="tp-header-hamburger-5 mr-15 d-none d-lg-block">
                              <button class="tp-hamburger-btn-2 tp-hamburger-toggle">
                                 <span></span>
                                 <span></span>
                                 <span></span>
                              </button>
                           </div>
                           <?php endif; ?>


                           <!-- offcanvas btn -->
                           <div class="tp-header-hamburger-5 mr-15 d-lg-none">
                              <button class="tp-hamburger-btn-2 tp-offcanvas-open-btn">
                                 <span></span>
                                 <span></span>
                                 <span></span>
                              </button>
                           </div>

                           <?php if(!empty($tp_image)) :?>
                           <div class="logo">
                                <a href="<?php print esc_url( home_url( '/' ) );?>">
                                    <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                                </a>
                           </div>
                        <?php endif; ?>

                        </div>
                     </div>
                     <div class="col-xl-8 col-lg-6 d-none d-xl-block">
                        <div class="main-menu d-none">
                            <nav class="tp-main-menu-content">
                              <?php echo $menu_html; ?>
                           </nav>
                        </div>

                        <?php if ( $settings['tp_header_search_switch'] === 'yes') : ?>
                        <div class="tp-header-search-5">

                           <form name="myform" method="GET"  action="<?php echo esc_url(home_url('/shop')); ?>">
                              <div class="tp-header-search-input-box-5">
                                 <div class="tp-header-search-input-5">
                                    <input placeholder="<?php echo esc_attr__('Search for products (e.g. eggs, milk, potato)', 'shofy'); ?>" type="text"  name="s" class="searchbox" maxlength="128" value="<?php echo get_search_query(); ?>">
                                    <span class="tp-header-search-icon-5">
                                       <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M8.11111 15.2222C12.0385 15.2222 15.2222 12.0385 15.2222 8.11111C15.2222 4.18375 12.0385 1 8.11111 1C4.18375 1 1 4.18375 1 8.11111C1 12.0385 4.18375 15.2222 8.11111 15.2222Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                          <path d="M16.9995 17L13.1328 13.1333" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                       </svg>
                                    </span>
                                 </div>
                                 <button type="submit"><?php echo esc_html($settings['tp_header_search_text']); ?></button>
                              </div>
                           </form>
                        </div>
                        <?php endif; ?>

                     </div>

                     <?php if ( $settings['tp_header_right_switch'] === 'yes' ) : ?>
                     <?php if ((($settings['tp_header_wishlist_switch'] === 'yes') || ($settings['tp_header_cart_switch'] === 'yes' ) || ($settings['tp_header_login_switch'] === 'yes' )) && class_exists( 'WooCommerce' )): ?> 
                        <div class="col-xl-2 col-lg-6 col-md-6 col-sm-7 col-4">
                            <div class="tp-header-right-5 d-flex align-items-center justify-content-end">

                                <?php if ( ($settings['tp_header_login_switch'] === 'yes') && class_exists( 'WooCommerce' )): ?>
                                <div class="tp-header-login-5 d-none d-md-block">
                                    <?php 
                                        $author_data = get_the_author_meta( 'description', get_query_var( 'author' ) );
                                        $author_bio_avatar_size = 180;

                                        if (is_user_logged_in()): 
                                    ?>
                                    <a href="<?php echo get_permalink(wc_get_page_id('myaccount')); ?>" class="d-flex align-items-center">
                                        <div class="tp-header-login-icon-5">
                                            <span>
                                                <?php print get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size, '', '', [ 'class' => 'media-object img-circle' ] );?>
                                            </span>
                                        </div>
                                        <div class="tp-header-login-content-5">
                                            <p><span><?php echo esc_html($settings['tp_header_login_text']); ?></span> <br> <?php $current_user = wp_get_current_user();  echo esc_html($current_user->display_name) ;?></p>
                                        </div>
                                    </a>
                                    <?php else : ?>
                                        <a href="<?php echo wp_logout_url(get_permalink(wc_get_page_id('myaccount'))) ?>" class="d-flex align-items-center">
                                            <div class="tp-header-login-icon-5">
                                                <span>
                                                    <svg width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M8.00029 9C10.2506 9 12.0748 7.20914 12.0748 5C12.0748 2.79086 10.2506 1 8.00029 1C5.75 1 3.92578 2.79086 3.92578 5C3.92578 7.20914 5.75 9 8.00029 9Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path d="M15 17C15 13.904 11.8626 11.4 8 11.4C4.13737 11.4 1 13.904 1 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="tp-header-login-content-5">
                                                <p><span><?php echo esc_html($settings['tp_header_login_text_not']); ?></span> <br><?php echo esc_html($settings['tp_header_login_register_text']); ?></p>
                                            </div>
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?> <!-- login endif here -->

                                <div class="tp-header-action-5 d-flex align-items-center ml-20">

                                    <?php if(class_exists( 'WPCleverWoosw' ) && ($settings['tp_header_wishlist_switch'] === 'yes')) :
                                        $wishlist_data = new \WPCleverWoosw();

                                        $key        = $wishlist_data::get_key();
                                        $products   = $wishlist_data::get_ids( $key );
                                        $count      = count( $products );
                                    ?>
                                    <div class="tp-header-action-item-5 d-none d-sm-block">
                                        <a href="<?php echo esc_url( $wishlist_data::get_url( $key, true ) ); ?>">
                                            <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.20125 16.0348C11.0291 14.9098 12.7296 13.5858 14.2722 12.0865C15.3567 11.0067 16.1823 9.69033 16.6858 8.23822C17.5919 5.42131 16.5335 2.19649 13.5717 1.24212C12.0151 0.740998 10.315 1.02741 9.00329 2.01177C7.69109 1.02861 5.99161 0.742297 4.43489 1.24212C1.47305 2.19649 0.40709 5.42131 1.31316 8.23822C1.81666 9.69033 2.64228 11.0067 3.72679 12.0865C5.26938 13.5858 6.96983 14.9098 8.79771 16.0348L8.99568 16.1579L9.20125 16.0348Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M5.85156 4.41306C4.95446 4.69963 4.31705 5.50502 4.2374 6.45262" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <span class="tp-header-action-badge-5"><?php echo esc_html($count); ?></span>
                                        </a>
                                    </div>
                                    <?php endif; ?>

                                    <?php if ( ($settings['tp_header_cart_switch'] === 'yes') && class_exists( 'WooCommerce' ) ): ?>
                                    <div class="tp-header-action-item-5">
                                        <button type="button" class="cartmini-open-btn">
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M5.31165 17H12.6964C15.4091 17 17.4901 16.0781 16.899 12.3676L16.2107 7.33907C15.8463 5.48764 14.5912 4.77907 13.49 4.77907H4.48572C3.36828 4.77907 2.18607 5.54097 1.76501 7.33907L1.07673 12.3676C0.574694 15.659 2.59903 17 5.31165 17Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M5.19048 4.59622C5.19048 2.6101 6.90163 1.00003 9.01244 1.00003V1.00003C10.0289 0.99598 11.0052 1.37307 11.7254 2.04793C12.4457 2.72278 12.8506 3.6398 12.8506 4.59622V4.59622" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M6.38837 8.34478H6.42885" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M11.5466 8.34478H11.5871" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>

                                            <?php if(!is_null(WC()->cart)) :?>
                                                <span id="tp-cart-item" class="tp-header-action-badge cart__count">
                                                <?php echo esc_html(WC()->cart->cart_contents_count); ?>
                                                </span>                                                                          
                                            <?php endif; ?>  
                                        </button>
                                    </div>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                        <?php endif; ?> <!-- action endif here -->
                        <?php endif; ?>

                  </div>
               </div>
            </div>
            <?php if($settings['category_menu_switch'] == 'yes') :?>
            <div class="tp-header-side-menu tp-side-menu-5">
               <nav  class="tp-category-menu-content">
                    <?php echo $category_menu_html; ?>
               </nav>
            </div>
            <?php endif; ?>
         </div>
      </header>

      <?php include(TPCORE_ELEMENTS_PATH . '/header-side/header-cart-mini.php'); ?>

      <?php if($settings['enable_bottom_menu'] == 'yes') :?>
      <?php include(TPCORE_ELEMENTS_PATH . '/header-side/bottom-menu.php'); ?>
      <?php endif; ?>

      <div class="offcanvas__area <?php echo esc_attr($offcanvas_style); ?>">
         <?php include(TPCORE_ELEMENTS_PATH . '/header-side/header-side-1.php'); ?>
      </div>


<?php
	}
}

$widgets_manager->register( new TP_Header_05() );
