<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Footer_Subscribe extends Widget_Base {

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
		return 'tp-footer-subscribe';
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
		return __( 'Footer Subscribe', 'tpcore' );
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


    protected static function get_profile_names()
    {
        return [
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

    public function get_tp_contact_form(){
        if ( ! class_exists( 'WPCF7' ) ) {
            return;
        }
        $tp_cfa         = array();
        $tp_cf_args     = array( 'posts_per_page' => -1, 'post_type'=> 'wpcf7_contact_form' );
        $tp_forms       = get_posts( $tp_cf_args );
        $tp_cfa         = ['0' => esc_html__( 'Select Form', 'tpcore' ) ];
        if( $tp_forms ){
            foreach ( $tp_forms as $tp_form ){
                $tp_cfa[$tp_form->ID] = $tp_form->post_title;
            }
        }else{
            $tp_cfa[ esc_html__( 'No contact form found', 'tpcore' ) ] = 0;
        }
        return $tp_cfa;
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

        $this->start_controls_section(
            'tpcore_contact',
            [
                'label' => esc_html__('Contact Form', 'tpcore'),
            ]
        );

        $this->add_control(
        'tp_contact_desc_text',
         [
            'label'       => esc_html__( 'Description Text', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXTAREA,
            'default'     => esc_html__( 'Our conversation is just getting started', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
            'label_block' => true,
         ]
        );

        $this->add_control(
            'tpcore_select_contact_form',
            [
                'label'   => esc_html__( 'Select Form', 'tpcore' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '0',
                'options' => $this->get_tp_contact_form(),
            ]
        );

        $this->end_controls_section();

	}

	// style_tab_content
	protected function style_tab_content(){
        $this->tp_basic_style_controls('about_title', 'Section - Title', '.tp-el-title');
        $this->tp_input_controls_style('coming_input', 'Form - Input', '.tp-el-box-input input', '.tp-el-box-input textarea');
        $this->tp_link_controls_style('coming_input_btn', 'Form - Button', '.tp-el-box-input button');
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

         <div class="tp-footer-subscribe">
            <?php if(!empty($settings['tp_contact_desc_text'])) :?>
            <p class="tp-contact-title tp-el-title"><?php echo tp_kses($settings['tp_contact_desc_text']); ?></p>
            <?php endif; ?>
            <div class="tp-footer-subscribe-form mb-30 tp-el-box-input">
                <?php if( !empty($settings['tpcore_select_contact_form']) ) : ?>
                    <?php echo do_shortcode( '[contact-form-7  id="'.$settings['tpcore_select_contact_form'].'"]' ); ?>
                <?php else : ?>
                    <?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'tpcore' ). '</p></div>'; ?>
                <?php endif; ?>
            </div>
        </div>

        <?php
	}
}

$widgets_manager->register( new TP_Footer_Subscribe() );
