<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Menu_Demo extends Widget_Base {

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
		return 'tp-menu-demo';
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
		return __( 'Mega Menu Demo', 'tpcore' );
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

    private function get_available_menus() {

        $menus = wp_get_nav_menus();

        $options = [];

        foreach ( $menus as $menu ) {
            $options[ $menu->slug ] = $menu->name;
        }

        return $options;
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

    protected function register_controls_section(){

        // layout Panel
        $this->start_controls_section(
            'tp_layout',
            [
                'label' => esc_html__('Design Layout', 'tp-core'),
            ]
        );
        $this->add_control(
            'tp_design_style',
            [
                'label' => esc_html__('Select Layout', 'tp-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'tp-core'),
                    'layout-2' => esc_html__('Layout 2', 'tp-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();


		$this->start_controls_section(
		 'tp_list_sec',
			 [
			   'label' => esc_html__( 'Image List', 'tpcore' ),
			   'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			 ]
		);
		
		$repeater = new \Elementor\Repeater();
		
		$repeater->add_control(
		'tp_menu_title',
		  [
			'label'   => esc_html__( 'Title', 'tpcore' ),
			'type'        => \Elementor\Controls_Manager::TEXT,
			'default'     => esc_html__( 'Home', 'tpcore' ),
			'label_block' => true,
		  ]
		);
        
        $repeater->add_control(
            'tp_image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'Image', 'tpcore' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );  

        $repeater->add_control(
            'tp_services_link_type',
            [
                'label' => esc_html__( 'Link Type', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
            ]
        );
        $repeater->add_control(
            'tp_services_link',
            [
                'label' => esc_html__( 'link', 'tpcore' ),
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
                    'tp_services_link_type' => '1',
                ]
            ]
        );
        $repeater->add_control(
            'tp_services_page_link',
            [
                'label' => esc_html__( 'Select Link Page', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_services_link_type' => '2',
                ]
            ]
        );
		
		$this->add_control(
		  'tp_menu_list',
		  [
			'label'       => esc_html__( 'Menu List', 'tpcore' ),
			'type'        => \Elementor\Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'default'     => [
			  [
				'tp_menu_title'   => esc_html__( 'Menu Item 1', 'tpcore' ),
			  ],
			  [
				'tp_menu_title'   => esc_html__( 'Menu Item 2', 'tpcore' ),
			  ],
			  [
				'tp_menu_title'   => esc_html__( 'Menu Item 3', 'tpcore' ),
			  ],
			],
			'title_field' => '{{{ tp_menu_title }}}',
		  ]
		);

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'medium_large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
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

        
		?>

        <?php if ( $settings['tp_design_style']  == 'layout-2' ): ?>

            <div class="home-menu">
                <div class="row row-cols-1 row-cols-lg-3 row-cols-xl-3">
                    <?php foreach ($settings['tp_menu_list'] as $key => $item) :
                        if ( !empty($item['tp_image']['url']) ) {
                            $tp_image_url = !empty($item['tp_image']['id']) ? wp_get_attachment_image_url( $item['tp_image']['id'], $settings['thumbnail_size']) : $item['tp_image']['url'];
                            $tp_image_alt = get_post_meta($item["tp_image"]["id"], "_wp_attachment_image_alt", true);
                        } 

                        if ('2' == $item['tp_services_link_type']) {
                            $link = get_permalink($item['tp_services_page_link']);
                            $target = '_self';
                            $rel = 'nofollow';
                        } else {
                            $link = !empty($item['tp_services_link']['url']) ? $item['tp_services_link']['url'] : '';
                            $target = !empty($item['tp_services_link']['is_external']) ? '_blank' : '';
                            $rel = !empty($item['tp_services_link']['nofollow']) ? 'nofollow' : '';
                        }
                        
                    ?>
                    <div class="col">
                        <div class="home-menu-item ">
                            <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>">
                                <div class="home-menu-thumb p-relative fix">
                                    <img src="<?php echo esc_url($tp_image_url); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                                </div>
                                <div class="home-menu-content">
                                    <h5 class="home-menu-title"><?php echo esc_html($item['tp_menu_title']) ?></h5>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

        <?php else:  ?>	

        <div class="row row-cols-1 row-cols-lg-4 row-cols-xl-5">
            <?php foreach ($settings['tp_menu_list'] as $key => $item) :
                if ( !empty($item['tp_image']['url']) ) {
                    $tp_image_url = !empty($item['tp_image']['id']) ? wp_get_attachment_image_url( $item['tp_image']['id'], $settings['thumbnail_size']) : $item['tp_image']['url'];
                    $tp_image_alt = get_post_meta($item["tp_image"]["id"], "_wp_attachment_image_alt", true);
                } 

                if ('2' == $item['tp_services_link_type']) {
                    $link = get_permalink($item['tp_services_page_link']);
                    $target = '_self';
                    $rel = 'nofollow';
                } else {
                    $link = !empty($item['tp_services_link']['url']) ? $item['tp_services_link']['url'] : '';
                    $target = !empty($item['tp_services_link']['is_external']) ? '_blank' : '';
                    $rel = !empty($item['tp_services_link']['nofollow']) ? 'nofollow' : '';
                }
                
            ?>
            <div class="col">
                <div class="home-menu-item ">
                    <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" >
                        <div class="home-menu-thumb p-relative fix">
                            <img src="<?php echo esc_url($tp_image_url); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                        </div>
                        <div class="home-menu-content">
                            <h5 class="home-menu-title"><?php echo esc_html($item['tp_menu_title']) ?></h5>
                        </div>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <?php endif; ?>
        <?php 
	}
}

$widgets_manager->register( new TP_Menu_Demo() );