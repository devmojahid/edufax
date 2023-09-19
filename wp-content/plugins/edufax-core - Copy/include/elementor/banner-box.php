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
class TP_Banner_Box extends Widget_Base {

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
        return 'tp-banner-box';
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
        return __( 'Banner Box', 'tpcore' );
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
                    'layout-3' => esc_html__('Layout 3', 'tp-core'),
                    'layout-4' => esc_html__('Layout 4', 'tp-core'),
                    'layout-5' => esc_html__('Layout 5', 'tp-core'),
                    'layout-6' => esc_html__('Layout 6', 'tp-core'),
                    'layout-7' => esc_html__('Layout 7', 'tp-core'),
                    'layout-8' => esc_html__('Layout 8', 'tp-core'),
                    'layout-9' => esc_html__('Layout 9', 'tp-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
         'tp_banner_sec',
             [
               'label' => esc_html__( 'Title & Content', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );

        $this->add_control(
            'tp_image_subtitle',
            [
                'label' => esc_html__( 'Choose Image', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_design_style' => 'layout-9'
                ]
            ]
        );        

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_image_subtitle_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->add_control(
         'is_brown_style',
         [
           'label'        => esc_html__( 'Enable Brown Style?', 'tpcore' ),
           'type'         => \Elementor\Controls_Manager::SWITCHER,
           'label_on'     => esc_html__( 'Show', 'tpcore' ),
           'label_off'    => esc_html__( 'Hide', 'tpcore' ),
           'return_value' => 'yes',
           'default'      => 'no',
           'condition' => [
            'tp_design_style' => 'layout-7'
            ]
         ]
        );
        
        $this->add_control(
        'tp_banner_subtitle',
            [
                'label'       => esc_html__( 'Banner Subtitle', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Women', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
        'tp_banner_title',
         [
            'label'       => esc_html__( 'Banner Title', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'Tpp Blouse Shirts', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
            'label_block' => true
         ]
        );
        
        $this->add_control(
         'tp_banner_url',
         [
           'label'   => esc_html__( 'Banner Title URL', 'tpcore' ),
           'type'        => \Elementor\Controls_Manager::URL,
           'default'     => [
               'url'               => '#',
               'is_external'       => true,
               'nofollow'          => true,
               'custom_attributes' => '',
             ],
             'placeholder' => esc_html__( 'Your URL', 'tpcore' ),
             'label_block' => true,
           ]
         );

         $this->add_control(
          'tp_enable_square_style',
          [
            'label'        => esc_html__( 'Enable Square Style?', 'tpcore' ),
            'type'         => \Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Show', 'tpcore' ),
            'label_off'    => esc_html__( 'Hide', 'tpcore' ),
            'return_value' => 'yes',
            'default'      => 'no',
            'condition' => [
                'tp_design_style' => ['layout-1', 'layout-2']
            ]
          ]
         );

        
        $this->end_controls_section();

        // _tp_image
		$this->start_controls_section(
            '_tp_image',
            [
                'label' => esc_html__('Thumbnail', 'tp-core'),
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
                'name' => 'tp_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        $this->end_controls_section();

        $this->tp_button_render_controls('tpbtn', 'Button', ['layout-1', 'layout-2', 'layout-3', 'layout-4', 'layout-5', 'layout-6', 'layout-7', 'layout-8', 'layout-9']);
    }

    protected function style_tab_content(){
        $this->tp_section_style_controls('about_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('about_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('about_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('about_description', 'Section - Description', '.tp-el-content p');
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
            $this->add_render_attribute('title_args', 'class', 'research__title');
            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }

            $this->tp_link_controls_render('tpbtn', 'tp-link-btn', $this->get_settings());

            $enable_square_style = $settings['tp_enable_square_style'] == 'yes' ? 'has-square' : '';
        ?>

        <div class="tp-banner-item tp-banner-item-sm grey-bg <?php echo esc_attr($enable_square_style);?> tp-banner-height p-relative mb-30 z-index-1 fix">
            <div class="tp-banner-thumb include-bg transition-3" data-background="<?php echo esc_url($tp_image); ?>"></div>
            <div class="tp-banner-content">

                <?php if(!empty($settings['tp_banner_title'])) : ?>
                <h3 class="tp-banner-title">
                    <?php if(!empty($settings['tp_banner_url']['url'])): ?>
                    <a href="<?php echo esc_url($settings['tp_banner_url']['url']) ?>"><?php echo tp_kses($settings['tp_banner_title']); ?></a>

                    <?php else: ?>
                        <?php echo tp_kses($settings['tp_banner_title']); ?>
                    <?php endif; ?>
                </h3>
                <?php endif; ?>

                <?php if(!empty($settings['tp_banner_subtitle'])) : ?>
                <p><?php echo tp_kses($settings['tp_banner_subtitle']); ?></p>
                <?php endif; ?>
                

                <!-- button start -->
                <?php if ($settings['tp_' . $control_id .'_button_show'] == 'yes') : ?>
                <div class="tp-banner-btn">
                    <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>><?php echo $settings['tp_' . $control_id .'_text']; ?>
                        <svg width="15" height="13" viewBox="0 0 15 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.9998 6.19656L1 6.19656" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8.75674 0.975394L14 6.19613L8.75674 11.4177" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
                <?php endif; ?>
                <!-- button end --> 

            </div>
        </div>

        <?php elseif( $settings['tp_design_style']  == 'layout-3' ): 
            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }
            $this->tp_link_controls_render('tpbtn', 'tp-btn tp-btn-border tp-btn-border-white tp-btn-border-white-sm', $this->get_settings());
            
        ?>

            <div class="tp-trending-banner p-relative">
                <div class="tp-trending-banner-thumb w-img include-bg" data-background="<?php echo esc_url($tp_image); ?>"></div>
                <div class="tp-trending-banner-content">
                    <?php if(!empty($settings['tp_banner_subtitle'])) : ?>
                    <span class="tp-trending-banner-subtitle"><?php echo tp_kses($settings['tp_banner_subtitle']); ?></span>
                    <?php endif; ?>

                    <?php if(!empty($settings['tp_banner_title'])) : ?>
                    <h3 class="tp-trending-banner-title">
                        <?php if(!empty($settings['tp_banner_url']['url'])): ?>
                        <a href="<?php echo esc_url($settings['tp_banner_url']['url']) ?>"><?php echo tp_kses($settings['tp_banner_title']); ?></a>

                        <?php else: ?>
                            <?php echo tp_kses($settings['tp_banner_title']); ?>
                        <?php endif; ?>
                    </h3>
                    <?php endif; ?>

                    <?php if ($settings['tp_' . $control_id .'_button_show'] == 'yes') : ?>
                    <div class="tp-trending-banner-btn">
                        <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>>
                            <?php echo $settings['tp_' . $control_id .'_text']; ?>
                            <svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16 7.5L1 7.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9.9502 1.47541L16.0002 7.49941L9.9502 13.5244" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

        <?php elseif( $settings['tp_design_style']  == 'layout-4' ): 
            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }
            $this->tp_link_controls_render('tpbtn', 'tp-btn', $this->get_settings());
            
        ?>

        <div class="tp-collection-item tp-collection-height grey-bg p-relative z-index-1 fix">
            <div class="tp-collection-thumb include-bg include-bg transition-3" data-background="<?php echo esc_url($tp_image); ?>"></div>
            <div class="tp-collection-content">

                <?php if(!empty($settings['tp_banner_subtitle'])) : ?>
                <span><?php echo tp_kses($settings['tp_banner_subtitle']); ?></span>
                <?php endif; ?>

                <?php if(!empty($settings['tp_banner_title'])) : ?>
                    <h3 class="tp-collection-title">
                        <?php if(!empty($settings['tp_banner_url']['url'])): ?>
                        <a href="<?php echo esc_url($settings['tp_banner_url']['url']) ?>"><?php echo tp_kses($settings['tp_banner_title']); ?></a>

                        <?php else: ?>
                            <?php echo tp_kses($settings['tp_banner_title']); ?>
                        <?php endif; ?>
                    </h3>
                <?php endif; ?>

                <?php if ($settings['tp_' . $control_id .'_button_show'] == 'yes') : ?>
                <div class="tp-collection-btn">
                    <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>>
                    <?php echo $settings['tp_' . $control_id .'_text']; ?>
                        <svg width="12" height="10" viewBox="0 0 12 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.9994 4.99981L1.04004 4.99981" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M6.98291 1L10.9998 4.99967L6.98291 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <?php elseif( $settings['tp_design_style']  == 'layout-5' ): 
            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }
            $this->tp_link_controls_render('tpbtn', 'tp-link-btn-line', $this->get_settings());
            
        ?>

        <div class="tp-collection-item tp-collection-height grey-bg p-relative z-index-1 fix">
            <div class="tp-collection-thumb has-overlay include-bg transition-3" data-background="<?php echo esc_url($tp_image); ?>"></div>
            <div class="tp-collection-content-1">

                <?php if(!empty($settings['tp_banner_subtitle'])) : ?>
                <span><?php echo tp_kses($settings['tp_banner_subtitle']); ?></span>
                <?php endif; ?>

                <?php if(!empty($settings['tp_banner_title'])) : ?>
                    <h3 class="tp-collection-title-1">
                        <?php if(!empty($settings['tp_banner_url']['url'])): ?>
                        <a href="<?php echo esc_url($settings['tp_banner_url']['url']) ?>"><?php echo tp_kses($settings['tp_banner_title']); ?></a>

                        <?php else: ?>
                            <?php echo tp_kses($settings['tp_banner_title']); ?>
                        <?php endif; ?>
                    </h3>
                <?php endif; ?>

                <?php if ($settings['tp_' . $control_id .'_button_show'] == 'yes') : ?>
                <div class="tp-collection-btn-1">
                    <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>><?php echo $settings['tp_' . $control_id .'_text']; ?></a>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <?php elseif( $settings['tp_design_style']  == 'layout-6' ): 
            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }
            $this->tp_link_controls_render('tpbtn', 'tp-btn tp-btn-border', $this->get_settings());
            
        ?>

        <div class="tp-banner-item-4 tp-banner-height-4 fix p-relative z-index-1" data-bg-color="#F3F7FF">
            <div class="tp-banner-thumb-4 include-bg black-bg transition-3" data-background="<?php echo esc_url($tp_image); ?>"></div>
            <div class="tp-banner-content-4">

                <?php if(!empty($settings['tp_banner_subtitle'])) : ?>
                <span><?php echo tp_kses($settings['tp_banner_subtitle']); ?></span>
                <?php endif; ?>

                <?php if(!empty($settings['tp_banner_title'])) : ?>
                    <h3 class="tp-banner-title-4">
                        <?php if(!empty($settings['tp_banner_url']['url'])): ?>
                        <a href="<?php echo esc_url($settings['tp_banner_url']['url']) ?>"><?php echo tp_kses($settings['tp_banner_title']); ?></a>

                        <?php else: ?>
                            <?php echo tp_kses($settings['tp_banner_title']); ?>
                        <?php endif; ?>
                    </h3>
                <?php endif; ?>

                <?php if ($settings['tp_' . $control_id .'_button_show'] == 'yes') : ?>
                <div class="tp-banner-btn-4">
                    <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>>
                        <?php echo $settings['tp_' . $control_id .'_text']; ?>
                        <svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16 7.49988L1 7.49988" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9.9502 1.47554L16.0002 7.49954L9.9502 13.5245" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <?php elseif( $settings['tp_design_style']  == 'layout-7' ): 
            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }
            $this->tp_link_controls_render('tpbtn', 'tp-btn tp-btn-border', $this->get_settings());
            
            $color_style = $settings['is_brown_style'] == 'yes' ? 'has-brown' : 'has-green';
        ?>

        <div class="tp-banner-item-4 tp-banner-height-4 fix p-relative z-index-1 <?php echo esc_attr($color_style); ?> sm-banner" data-bg-color="#F0F6EF">
            <div class="tp-banner-thumb-4 include-bg black-bg transition-3" data-background="<?php echo esc_url($tp_image); ?>"></div>
            <div class="tp-banner-content-4">

                <?php if(!empty($settings['tp_banner_subtitle'])) : ?>
                <span><?php echo tp_kses($settings['tp_banner_subtitle']); ?></span>
                <?php endif; ?>

                <?php if(!empty($settings['tp_banner_title'])) : ?>
                    <h3 class="tp-banner-title-4">
                        <?php if(!empty($settings['tp_banner_url']['url'])): ?>
                        <a href="<?php echo esc_url($settings['tp_banner_url']['url']) ?>"><?php echo tp_kses($settings['tp_banner_title']); ?></a>

                        <?php else: ?>
                            <?php echo tp_kses($settings['tp_banner_title']); ?>
                        <?php endif; ?>
                    </h3>
                <?php endif; ?>

                <?php if ($settings['tp_' . $control_id .'_button_show'] == 'yes') : ?>
                <div class="tp-banner-btn-4">
                    <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>>
                        <?php echo $settings['tp_' . $control_id .'_text']; ?>
                        <svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16 7.49988L1 7.49988" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9.9502 1.47554L16.0002 7.49954L9.9502 13.5245" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <?php elseif( $settings['tp_design_style']  == 'layout-8' ): 
            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }
            $this->tp_link_controls_render('tpbtn', 'tp-btn tp-btn-border', $this->get_settings());
        ?>
        <div class="tp-banner-full tp-banner-full-height fix p-relative z-index-1">
            <div class="tp-banner-full-thumb include-bg black-bg transition-3" data-background="<?php echo esc_url($tp_image); ?>"></div>
            <div class="tp-banner-full-content">
                <?php if(!empty($settings['tp_banner_subtitle'])) : ?>
                <span><?php echo tp_kses($settings['tp_banner_subtitle']); ?></span>
                <?php endif; ?>

                <?php if(!empty($settings['tp_banner_title'])) : ?>
                    <h3 class="tp-banner-full-title">
                        <?php if(!empty($settings['tp_banner_url']['url'])): ?>
                        <a href="<?php echo esc_url($settings['tp_banner_url']['url']) ?>"><?php echo tp_kses($settings['tp_banner_title']); ?></a>

                        <?php else: ?>
                            <?php echo tp_kses($settings['tp_banner_title']); ?>
                        <?php endif; ?>
                    </h3>
                <?php endif; ?>

                <?php if ($settings['tp_' . $control_id .'_button_show'] == 'yes') : ?>
                <div class="tp-banner-full-btn">
                    <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>>
                        <?php echo $settings['tp_' . $control_id .'_text']; ?>
                        <svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16 7.49988L1 7.49988" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9.9502 1.47554L16.0002 7.49954L9.9502 13.5245" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <?php elseif( $settings['tp_design_style']  == 'layout-9' ): 
            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }
            if ( !empty($settings['tp_image_subtitle']['url']) ) {
                $tp_image_subtitle = !empty($settings['tp_image_subtitle']['id']) ? wp_get_attachment_image_url( $settings['tp_image_subtitle']['id'], $settings['tp_image_subtitle_size_size']) : $settings['tp_image_subtitle']['url'];
                $tp_image_subtitle_alt = get_post_meta($settings["tp_image_subtitle"]["id"], "_wp_attachment_image_alt", true);
            }
            $this->tp_link_controls_render('tpbtn', 'tp-btn-green tp-btn-green-sm', $this->get_settings());
        ?>

        <div class="tp-product-side-banner text-center mb-60 light-green-bg">
            <div class="tp-product-side-banner-content">


                <?php if(!empty($tp_image_subtitle)) : ?>
                <div class="tp-product-side-banner-subtitle">
                    <img src="<?php echo esc_url($tp_image_subtitle) ?>" alt="<?php echo esc_attr($tp_image_subtitle_alt); ?>">
                </div>
                <?php endif; ?>

                <?php if(!empty($settings['tp_banner_subtitle'])) : ?>
                <span><?php echo tp_kses($settings['tp_banner_subtitle']); ?></span>
                <?php endif; ?>

                <?php if(!empty($settings['tp_banner_title'])) : ?>
                    <h3 class="tp-product-side-banner-title">
                        <?php if(!empty($settings['tp_banner_url']['url'])): ?>
                        <a href="<?php echo esc_url($settings['tp_banner_url']['url']) ?>"><?php echo tp_kses($settings['tp_banner_title']); ?></a>

                        <?php else: ?>
                            <?php echo tp_kses($settings['tp_banner_title']); ?>
                        <?php endif; ?>
                    </h3>
                <?php endif; ?>


                <?php if ($settings['tp_' . $control_id .'_button_show'] == 'yes') : ?>
                <div class="tp-product-side-banner-btn">
                    <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>>
                        <?php echo $settings['tp_' . $control_id .'_text']; ?>
                        <svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16 7.49976L1 7.49976" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9.9502 1.47541L16.0002 7.49941L9.9502 13.5244" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
                <?php endif; ?>

                <?php if(!empty($tp_image)) : ?>
                <div class="tp-product-side-banner-thumb">
                    <img src="<?php echo esc_url($tp_image) ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                </div>
                <?php endif; ?>
            </div>
        </div>

        <?php else:
            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }

            $this->tp_link_controls_render('tpbtn', 'tp-link-btn', $this->get_settings());

            $enable_square_style = $settings['tp_enable_square_style'] == 'yes' ? 'has-square' : '';
        ?>


        <div class="tp-banner-item grey-bg <?php echo esc_attr($enable_square_style); ?> tp-banner-height p-relative mb-30 z-index-1 fix">
            <div class="tp-banner-thumb include-bg transition-3" data-background="<?php echo esc_url($tp_image); ?>"></div>
            <div class="tp-banner-content">
                <?php if(!empty($settings['tp_banner_subtitle'])) : ?>
                <span><?php echo tp_kses($settings['tp_banner_subtitle']); ?></span>
                <?php endif; ?>

                <?php if(!empty($settings['tp_banner_title'])) : ?>
                <h3 class="tp-banner-title">
                    <?php if(!empty($settings['tp_banner_url']['url'])): ?>
                    <a href="<?php echo esc_url($settings['tp_banner_url']['url']) ?>"><?php echo tp_kses($settings['tp_banner_title']); ?></a>

                    <?php else: ?>
                        <?php echo tp_kses($settings['tp_banner_title']); ?>
                    <?php endif; ?>
                </h3>
                <?php endif; ?>

                <!-- button start -->
                <?php if ($settings['tp_' . $control_id .'_button_show'] == 'yes') : ?>
                <div class="tp-banner-btn">
                    <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?> class=""><?php echo $settings['tp_' . $control_id .'_text']; ?>
                        <svg width="15" height="13" viewBox="0 0 15 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.9998 6.19656L1 6.19656" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8.75674 0.975394L14 6.19613L8.75674 11.4177" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
                <?php endif; ?>
                <!-- button end -->                    
            </div>
        </div>
        <?php endif; ?>

        <?php
    }
}

$widgets_manager->register( new TP_Banner_Box() );
