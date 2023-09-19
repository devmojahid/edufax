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
class TP_Info_Box extends Widget_Base {

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
		return 'tp-info-box';
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
		return __( 'Info Box', 'tpcore' );
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
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */

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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->tp_section_title_render_controls('info', 'Section Title');

        $this->start_controls_section(
         'tp_info_sec',
             [
               'label' => esc_html__( 'Info List', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );

        
        $this->add_control(
         'tp_info_bottom_quote',
            [
                'label'       => esc_html__( 'Bottom Quote Text', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'rows'        => 10,
                'default'     => esc_html__( 'So start browsing today and find the perfect ', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'repeater_condition',
            [
                'label' => __( 'Field condition', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __( 'Style 1', 'tpcore' ),
                    'style_2' => __( 'Style 2', 'tpcore' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );


        $repeater->add_control(
            'tp_box_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'tpcore'),
                    'icon' => esc_html__('Icon', 'tpcore'),
                    'svg' => esc_html__('SVG', 'tpcore'),
                ],
                'condition' => [
                    'repeater_condition' => ['style_1'],
                ]
            ]
        );
        $repeater->add_control(
            'tp_box_icon_svg',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'tpcore'),
                'condition' => [
                    'tp_box_icon_type' => 'svg',
                    'repeater_condition' => ['style_1'],
                ]
            ]
        );

        $repeater->add_control(
            'tp_box_icon_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_box_icon_type' => 'image',
                    'repeater_condition' => ['style_1'],
                ]
            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tp_box_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tp_box_icon_type' => 'icon',
                        'repeater_condition' => ['style_1'],
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'tp_box_selected_icon',
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
                        'tp_box_icon_type' => 'icon',
                        'repeater_condition' => ['style_1'],
                    ]
                ]
            );
        }


        $repeater->add_control(
            'tp_info_title', [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Info Title', 'tpcore'),
                'label_block' => true,
            ]
        );


        $repeater->add_control(
            'tp_info_link_switcher',
            [
                'label' => esc_html__( 'Add Info link', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'tp_info_link_type',
            [
                'label' => esc_html__( 'Info Link Type', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_info_link_switcher' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'tp_info_link',
            [
                'label' => esc_html__( 'Info Link', 'tpcore' ),
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
                    'tp_info_link_type' => '1',
                    'tp_info_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'tp_info_page_link',
            [
                'label' => esc_html__( 'Select Info Link Page', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_info_link_type' => '2',
                    'tp_info_link_switcher' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'tp_info_list',
            [
                'label' => esc_html__('Info - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_info_title' => esc_html__('Business Stratagy', 'tpcore'),
                    ],
                    [
                        'tp_info_title' => esc_html__('Website Development', 'tpcore')
                    ],
                    [
                        'tp_info_title' => esc_html__('Marketing & Reporting', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_info_title }}}',
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

        // colum controls
        $this->tp_columns('col');
    
    }

    protected function style_tab_content(){
        $this->tp_section_style_controls('history_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('history_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('history_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('history_description', 'Section - Description', '.tp-el-content p');

        $this->tp_link_controls_style('portfolio_description', 'Box - Button', '.tp-el-box-btn');
        $this->tp_link_controls_style('slider_social_link', 'Social - Link', '.tp-el-social-link');
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

		<?php if ( $settings['tp_design_style']  == 'layout-2' ): 
            
        ?>

		<?php else: 
              $this->add_render_attribute('title_args', 'class', 'tp-work-section-title tp-el-title');
		?>	

         <!-- work area start -->
         <section class="tp-work-area pt-115 pb-95">
            <div class="container">
            <?php if ( !empty($settings['tp_info_section_title_show']) ) : ?>
               <div class="row justify-content-center">
                  <div class="col-xl-6">
                     <div class="tp-work-section-title-wrapper text-center mb-60">

                        <?php if(!empty($settings['tp_info_sub_title' ])): ?>
                        <span class="tp-work-section-subtitle tp-el-subtitle"><?php echo tp_kses( $settings['tp_info_sub_title' ] ) ?></span>
                        <?php endif; ?>

                        <?php
                            if ( !empty($settings['tp_info_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_info_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    tp_kses( $settings['tp_info_title' ] )
                                    );
                            endif;
                        ?>

                        <?php if ( !empty($settings['tp_info_description']) ) : ?>
                            <p><?php echo tp_kses( $settings['tp_info_description'] ); ?></p>
                        <?php endif; ?>

                     </div>
                  </div>
               </div>
               <?php endif; ?>

               <div class="row">
               <?php foreach ($settings['tp_info_list'] as $key => $item) :

                    // Link
                    if ('2' == $item['tp_info_link_type']) {
                        $link = get_permalink($item['tp_info_page_link']);
                        $target = '_self';
                        $rel = 'nofollow';
                    } else {
                        $link = !empty($item['tp_info_link']['url']) ? $item['tp_info_link']['url'] : '';
                        $target = !empty($item['tp_info_link']['is_external']) ? '_blank' : '';
                        $rel = !empty($item['tp_info_link']['nofollow']) ? 'nofollow' : '';
                    }
                    ?>
                  <div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']); ?> col-<?php echo esc_attr($settings['tp_col_for_mobile']); ?>">
                     <div class="tp-work-item mb-35 text-center">
                        <div class="tp-work-icon d-flex align-items-end justify-content-center">
                            <?php if($item['tp_box_icon_type'] == 'icon') : ?>
                                <?php if (!empty($item['tp_box_icon']) || !empty($item['tp_box_selected_icon']['value'])) : ?>
                                        <span><?php tp_render_icon($item, 'tp_box_icon', 'tp_box_selected_icon'); ?></span>
                                <?php endif; ?>
                            <?php elseif( $item['tp_box_icon_type'] == 'image' ) : ?>
                                <span>
                                    <?php if (!empty($item['tp_box_icon_image']['url'])): ?>
                                    <img src="<?php echo $item['tp_box_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                    <?php endif; ?>
                                </span>
                            <?php else : ?>
                                <span>
                                    <?php if (!empty($item['tp_box_icon_svg'])): ?>
                                    <?php echo $item['tp_box_icon_svg']; ?>
                                    <?php endif; ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="tp-work-content">
                            <?php if (!empty($item['tp_info_title' ])): ?>
                            <h4 class="tp-work-title tp-el-box-title">
                                <?php if ($item['tp_info_link_switcher'] == 'yes') : ?>
                                <a href="<?php echo esc_url($link); ?>"><?php echo tp_kses($item['tp_info_title' ]); ?></a>
                                <?php else : ?>
                                    <?php echo tp_kses($item['tp_info_title' ]); ?>
                                <?php endif; ?>
                            </h4>
                            <?php endif; ?>
                        </div>
                     </div>
                  </div>
                  <?php endforeach; ?>
               </div>
               <?php if (!empty($settings['tp_info_bottom_quote'])): ?>
               <div class="row justify-content-center">
                  <div class="col-xl-4">
                     <div class="tp-work-quote text-center">
                        <p><?php echo tp_kses($settings['tp_info_bottom_quote']); ?></p>
                     </div>
                  </div>
               </div>
               <?php endif; ?>
            </div>
         </section>
         <!-- work area end -->

        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new TP_Info_Box() );