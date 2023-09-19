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
class TP_App_Download extends Widget_Base {

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
		return 'tp-app-download';
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
		return __( 'App Download', 'tpcore' );
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
		 'tp_text_sec',
			 [
			   'label' => esc_html__( 'Title & Description', 'tpcore' ),
			   'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			 ]
		);

		$this->add_control(
        'tp_text_title',
            [
                'label'       => esc_html__( 'Title', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Get the app & get Your Groceries from home', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Title', 'tpcore' ),
                'label_block' => true
            ]
        );

        $this->add_control(
         'tp_app_shape',
         [
           'label'        => esc_html__( 'Enable Shape ?', 'tpcore' ),
           'type'         => \Elementor\Controls_Manager::SWITCHER,
           'label_on'     => esc_html__( 'Show', 'tpcore' ),
           'label_off'    => esc_html__( 'Hide', 'tpcore' ),
           'return_value' => 'yes',
           'default'      => 'yes',
         ]
        );
        
		$this->end_controls_section();
        
        $this->tp_button_render_controls('tpbtn', 'Play Store Button', ['layout-1']);
        $this->tp_button_render_controls('tpbtn2', 'App Strore Button', ['layout-1']);

        $this->start_controls_section(
         'tp_app_image_sec',
             [
               'label' => esc_html__( 'Thumbnail', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );
        
        $this->add_control(
         'tp_app_image',
         [
           'label'   => esc_html__( 'Upload Thumbnail', 'tpcore' ),
           'type'    => \Elementor\Controls_Manager::MEDIA,
             'default' => [
               'url' => \Elementor\Utils::get_placeholder_image_src(),
           ],
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
    }

    protected function style_tab_content(){
		$this->tp_basic_style_controls('history_title', 'Title', '.tp-el-box-title');
		$this->tp_basic_style_controls('history_list', 'List', '.tp-el-box-list');
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
        $bloginfo = get_bloginfo( 'name' );  
        
		?>

		<?php if ( $settings['tp_design_style']  == 'layout-2' ): ?>

		<?php else: 
            $control_id = 'tpbtn';
            $control_id_2 = 'tpbtn2';
            $this->tp_link_controls_render('tpbtn', 'd-flex align-items-center google-btn', $this->get_settings());
            $this->tp_link_controls_render('tpbtn2', 'd-flex align-items-center apple-btn', $this->get_settings());

            if ( !empty($settings['tp_app_image']['url']) ) {
                $tp_app_image_url = !empty($settings['tp_app_image']['id']) ? wp_get_attachment_image_url( $settings['tp_app_image']['id'], $settings['thumbnail_size']) : $settings['tp_app_image']['url'];
                $tp_app_image_alt = get_post_meta($settings["tp_app_image"]["id"], "_wp_attachment_image_alt", true);
            }
		?>	
        

         <!-- cta area start -->
         <section class="tp-cta-area fix pt-50 p-relative z-index-1 ">
            <div class="tp-cta-inner p-relative pt-80 pb-55 cta-green-bg">
                <?php if($settings['tp_app_shape'] == 'yes') : ?>
                <div class="tp-cta-shape">
                    <img class="tp-cta-shape-1" src="<?php echo get_template_directory_uri(); ?>/assets/img/cta/shape/cta-shape-1.png" alt="<?php echo esc_attr($bloginfo); ?>">
                    <img class="tp-cta-shape-2" src="<?php echo get_template_directory_uri(); ?>/assets/img/cta/shape/cta-shape-2.png" alt="<?php echo esc_attr($bloginfo); ?>">
                </div>
                <?php endif;  ?>
               <div class="container">
                  <div class="row">
                     <div class="col-xl-6 col-lg-6 col-md-7">
                        <div class="tp-cta-wrapper p-relative z-index-1">

                            <?php if(!empty($settings['tp_text_title'])) : ?>
                            <h3 class="tp-cta-title"><?php echo esc_html($settings['tp_text_title']); ?></h3>
                            <?php endif; ?>

                           <div class="tp-cta-btn-wrapper d-flex flex-wrap">
                                <!-- button start -->
                                <?php if ($settings['tp_' . $control_id .'_button_show'] == 'yes') : ?>
                                <div class="tp-app-btn mb-30">
                                    <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>>
                                        <div class="app-icon mr-10">
                                            <span>
                                                <svg width="22" height="24" viewBox="0 0 22 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M16.0244 7.91774L13.4801 10.6447L3.16459 0.187162C6.21506 2.0179 11.0875 4.95113 11.0875 4.95113L16.0244 7.91774ZM21.6008 11.2727C21.2282 11.0666 18.6192 9.48973 17.2574 8.66061L14.4692 11.6465L17.5887 14.8096C18.9737 13.9756 21.1591 12.6626 21.5641 12.4181C22.1667 12.0538 22.1116 11.5603 21.6008 11.2727ZM13.5076 12.6768L3.72583 23.1488C6.83156 21.2797 11.0875 18.7205 11.0875 18.7205L16.3464 15.5574L13.5076 12.6768ZM1.20276 0.210599C0.753662 -0.244648 0 0.0868497 0 0.739721V23.2604C0 23.9228 0.772922 24.25 1.21644 23.7751L12.5176 11.6765L1.20276 0.210599Z" fill="currentColor"/>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="app-content">
                                            <span><?php echo esc_html__('Get it on', 'tpcore'); ?></span>
                                            <p><?php echo $settings['tp_' . $control_id .'_text']; ?></p>
                                        </div>
                                    </a>
                                </div>
                                <?php endif; ?>
                                <!-- button end --> 

                                <!-- button start -->
                                <?php if ($settings['tp_' . $control_id_2 .'_button_show'] == 'yes') : ?>
                                <div class="tp-app-btn mb-30">
                                    <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>>
                                        <div class="app-icon mr-10">
                                            <span>
                                                <svg width="20" height="24" viewBox="0 0 20 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M18.4945 20.5917C19.1995 19.5117 19.4623 18.9598 20 17.7478C16.0332 16.2358 15.4 10.5599 19.319 8.38794C18.1241 6.87597 16.4394 6 14.8503 6C13.7033 6 12.9147 6.30001 12.2098 6.576C11.6124 6.804 11.0747 7.00798 10.4056 7.00798C9.68874 7.00798 9.05548 6.78 8.38638 6.54C7.65754 6.27601 6.89286 6 5.93701 6C4.15673 6 2.25698 7.09198 1.05021 8.96394C-0.646428 11.6039 -0.347721 16.5478 2.38841 20.7717C3.36816 22.2837 4.68245 23.9756 6.39104 23.9996C7.10793 24.0116 7.57391 23.7957 8.08768 23.5677C8.67314 23.3037 9.30639 23.0157 10.4176 23.0157C11.5287 23.0037 12.1501 23.3037 12.7355 23.5677C13.2373 23.7957 13.6914 24.0116 14.3963 23.9996C16.1288 23.9756 17.5148 22.1037 18.4945 20.5917Z" fill="currentColor"/>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.6006 0C14.7918 1.31997 14.2541 2.62796 13.5492 3.53994C12.7964 4.52393 11.4821 5.29189 10.2156 5.24389C9.98862 3.97192 10.5741 2.66394 11.291 1.78795C12.0915 0.827972 13.4416 0.0839983 14.6006 0Z" fill="currentColor"/>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="app-content">
                                            <span><?php echo esc_html__('Download on the', 'tpcore'); ?></span>
                                            <p><?php echo $settings['tp_' . $control_id_2 .'_text']; ?></p>
                                        </div>
                                    </a>
                                </div>
                                <?php endif; ?>
                                <!-- button end --> 
                           </div>
                        </div>
                     </div>
                     <?php if(!empty($tp_app_image_url)) : ?>
                     <div class="col-lg-6">
                        <div class="tp-cta-thumb">
                           <span class="tp-cta-thumb-mobile"></span>
                           <img src="<?php echo esc_url($tp_app_image_url); ?>" alt="<?php echo esc_attr($tp_app_image_alt); ?>">
                        </div>
                        <span class="tp-cta-thumb-gradient"></span>
                     </div>
                     <?php endif; ?>
                  </div>
               </div>
            </div>
         </section>
         <!-- cta area end -->

        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new TP_App_Download() );