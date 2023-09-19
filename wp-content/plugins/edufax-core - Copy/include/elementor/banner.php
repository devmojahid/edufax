<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use TPCore\Elementor\Controls\Group_Control_TPBGGradient;
use TPCore\Elementor\Controls\Group_Control_TPGradient;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Banner extends Widget_Base {

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
        return 'tp-banner';
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
        return __( 'Banner', 'tpcore' );
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

    protected function register_controls(){
        $this->register_controls_section();
        $this->style_tab_content();
    }   
    protected function register_controls_section() {

        // layout Panel
        $this->start_controls_section(
            'tp_layout',
            [
                'label' => esc_html__('Design Layout', 'tpcore'),
            ]
        );
        $this->add_control(
            'tp_design_style',
            [
                'label' => esc_html__('Select Layout', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'tpcore'),
                    'layout-2' => esc_html__('Layout 2', 'tpcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->tp_section_title_render_controls('banner', 'Section - Title & Desciption', ['layout-2']);

        // Service group
        $this->start_controls_section(
            'tp_services',
            [
                'label' => esc_html__('Banner List', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
            'tp_services_image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'Image', 'tpcore' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        ); 


        $repeater->add_control(
            'tp_service_subtitle', [
                'label' => esc_html__('Sub Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('23 Products', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_2']
                ]
            ]
        );

        $repeater->add_control(
            'tp_service_title', [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_services_link_switcher',
            [
                'label' => esc_html__( 'Add Banner link', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        $repeater->add_control(
            'tp_services_btn_text',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_services_link_switcher' => 'yes',
                ],
            ]
        );
        $repeater->add_control(
            'tp_services_link_type',
            [
                'label' => esc_html__( 'Banner Link Type', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_services_link_switcher' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'tp_services_link',
            [
                'label' => esc_html__( 'Banner Link', 'tpcore' ),
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
                    'tp_services_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'tp_services_page_link',
            [
                'label' => esc_html__( 'Select Banner Link Page', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_services_link_type' => '2',
                    'tp_services_link_switcher' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'tp_service_list',
            [
                'label' => esc_html__('Banner - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_service_title' => esc_html__('Business Stratagy', 'tpcore'),
                    ],
                    [
                        'tp_service_title' => esc_html__('Website Development', 'tpcore')
                    ],
                    [
                        'tp_service_title' => esc_html__('Marketing & Reporting', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_service_title }}}',
            ]
        );
        $this->add_responsive_control(
            'tp_service_align',
            [
                'label' => esc_html__( 'Alignment', 'tpcore' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'text-left' => [
                        'title' => esc_html__( 'Left', 'tpcore' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__( 'Center', 'tpcore' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'text-right' => [
                        'title' => esc_html__( 'Right', 'tpcore' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => true,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'exclude' => ['custom'],
            ]
        );
        $this->end_controls_section();

        $this->tp_button_render_controls('tpbtn', 'Button', ['layout-2']);
        // colum controls
        $this->tp_columns('col');
    }

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('services_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('services_subtitle', 'Services - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('services_title', 'Services - Title', '.tp-el-title');
        $this->tp_basic_style_controls('services_description', 'Services - Description', '.tp-el-content p');
        
        $this->tp_basic_style_controls('services_box_title', 'Services - Box - Title', '.tp-el-box-title');
        $this->tp_basic_style_controls('services_box_subtitle', 'Services - Box - Subtitle', '.tp-el-box-subtitle');
        $this->tp_basic_style_controls('services_box_description', 'Services - Box - Description', '.tp-el-box-desc');
        $this->tp_icon_style('services_box_icon', 'Services - Icon/Image/SVG', '.tp-el-box-icon span');
        $this->tp_link_controls_style('services_box_link_btn', 'Services - Box - Button', '.tp-el-box-btn');

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
        ?>

        <?php if ( $settings['tp_design_style']  == 'layout-2' ):
            $this->add_render_attribute('title_args', 'class', 'tp-section-title-3 tp-el-title');

            $this->tp_link_controls_render('tpbtn', 'tp-btn', $this->get_settings());
        ?>

         <!-- category area start -->
         <section class="tp-category-area pt-95">
            <div class="container">
               <div class="row align-items-end">
                  <div class="col-lg-6 col-md-8">

                    <?php if ( !empty($settings['tp_banner_section_title_show']) ) : ?>
                     <div class="tp-section-title-wrapper-3 mb-45">
                        <?php if(!empty($settings['tp_banner_sub_title'])) : ?>
                        <span class="tp-section-title-pre-3 tp-el-subtitle"><?php echo tp_kses( $settings['tp_banner_sub_title'] ); ?></span>
                        <?php endif; ?>

                        <?php
                            if ( !empty($settings['tp_banner_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_banner_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    tp_kses( $settings['tp_banner_title' ] )
                                    );
                            endif;
                        ?>

                        <?php if ( !empty($settings['tp_banner_description']) ) : ?>
                        <p><?php echo tp_kses( $settings['tp_banner_description'] ); ?></p>
                        <?php endif; ?>
                     </div>
                     <?php endif; ?>

                  </div>

                  <?php if ($settings['tp_' . $control_id .'_button_show'] == 'yes') : ?>
                  <div class="col-lg-6 col-md-4">
                     <div class="tp-category-more-3 text-md-end mb-55">
                        <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>> 
                        <?php echo tp_kses($settings['tp_' . $control_id .'_text']); ?>
                            <svg width="12" height="10" viewBox="0 0 12 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M10.9994 4.99981L1.04004 4.99981" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M6.98291 1L10.9998 4.99967L6.98291 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                           </svg>
                        </a>
                     </div>
                  </div>
                  <?php endif; ?>
               </div>
               <div class="row">
                    <?php foreach ($settings['tp_service_list'] as $key => $item) :

                    if ( !empty($item['tp_services_image']['url']) ) {
                        $tp_image_url = !empty($item['tp_services_image']['id']) ? wp_get_attachment_image_url( $item['tp_services_image']['id'], $settings['thumbnail_size']) : $item['tp_services_image']['url'];
                        $tp_image_alt = get_post_meta($item["tp_services_image"]["id"], "_wp_attachment_image_alt", true);
                    }
                    // Link
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
                    <div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']); ?> col-<?php echo esc_attr($settings['tp_col_for_mobile']); ?>">
                        <div class="tp-category-item-3 p-relative black-bg text-center z-index-1 fix mb-30">
                            <div class="tp-category-thumb-3 include-bg" data-background="<?php echo esc_url($tp_image_url); ?>"></div>
                            <div class="tp-category-content-3 transition-3">

                                <?php if (!empty($item['tp_service_title' ])): ?>
                                <h3 class="tp-category-title-3 tp-el-box-title">
                                    <?php if ($item['tp_services_link_switcher'] == 'yes') : ?>
                                    <a href="<?php echo esc_url($link); ?>"><?php echo tp_kses($item['tp_service_title' ]); ?></a>
                                    <?php else : ?>
                                        <?php echo tp_kses($item['tp_service_title' ]); ?>
                                    <?php endif; ?>
                                </h3>
                                <?php endif; ?>

                                <?php if (!empty($item['tp_service_subtitle' ])): ?>
                                <span class="tp-categroy-ammount-3"><?php echo tp_kses($item['tp_service_subtitle' ]); ?></span>
                                <?php endif; ?>

                                <?php if (!empty($link)) : ?>
                                <div class="tp-category-btn-3">
                                    <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" class="tp-link-btn tp-link-btn-2">
                                        <?php echo tp_kses($item['tp_services_btn_text']); ?>
                                        <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1 1L6.02116 5.99958L1 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </a>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
               </div>
            </div>
         </section>
         <!-- category area end -->


        <?php else:
            $this->add_render_attribute('title_args', 'class', 'section__title tp-el-title');
            $bloginfo = get_bloginfo( 'name' );

        ?>
         
         <!-- banner area start -->
         <section class="tp-banner-area mt-20">
            <div class="container-fluid tp-gx-40">
               <div class="row tp-gx-20">
                <?php foreach ($settings['tp_service_list'] as $key => $item) :

                    if ( !empty($item['tp_services_image']['url']) ) {
                        $tp_image_url = !empty($item['tp_services_image']['id']) ? wp_get_attachment_image_url( $item['tp_services_image']['id'], $settings['thumbnail_size']) : $item['tp_services_image']['url'];
                        $tp_image_alt = get_post_meta($item["tp_services_image"]["id"], "_wp_attachment_image_alt", true);
                    }
                    // Link
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
                  <div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']); ?> col-<?php echo esc_attr($settings['tp_col_for_mobile']); ?>">
                     <div class="tp-banner-item-2 p-relative z-index-1 grey-bg-2 mb-20 fix">

                        <div class="tp-banner-thumb-2 include-bg transition-3" data-background="<?php echo esc_url($tp_image_url); ?>"></div>


                        <?php if (!empty($item['tp_service_title' ])): ?>
                        <h3 class="tp-banner-title-2 tp-el-box-title">
                            <?php if ($item['tp_services_link_switcher'] == 'yes') : ?>
                            <a href="<?php echo esc_url($link); ?>"><?php echo tp_kses($item['tp_service_title' ]); ?></a>
                            <?php else : ?>
                                <?php echo tp_kses($item['tp_service_title' ]); ?>
                            <?php endif; ?>
                        </h3>
                        <?php endif; ?>

                        <?php if (!empty($link)) : ?>
                        <div class="tp-banner-btn-2">

                           <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" class="tp-btn tp-btn-border tp-btn-border-sm">
                                <?php echo tp_kses($item['tp_services_btn_text']); ?>
                              <svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M16 7.49988L1 7.49988" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M9.9502 1.47554L16.0002 7.49954L9.9502 13.5245" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                              </svg>
                           </a>

                        </div>
                        <?php endif; ?>
                     </div>
                  </div>
                  <?php endforeach; ?>
               </div>
            </div>
         </section>
         <!-- banner area end -->


        <?php endif; ?>

        <?php
    }
}

$widgets_manager->register( new TP_Banner() ); 