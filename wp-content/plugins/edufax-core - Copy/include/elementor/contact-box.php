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
class TP_Contact_Box extends Widget_Base {

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
		return 'contact-box';
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
		return __( 'Contact Box', 'tpcore' );
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

        $this->tp_section_title_render_controls('contact', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');

        // Service group
        $this->start_controls_section(
            '_TP_contact_info',
            [
                'label' => esc_html__('Contact Info List', 'tpcore'),
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
            'tp_contact_info_title',
            [
                'label' => esc_html__('Contact Type Title', 'tpcore'),
                'description' => esc_html__('This field is just used for title showing. It not reflect in main design.', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Email Contact',
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_1'],
                ]
            ]
        );

        $repeater->add_control(
            'tp_contact_email_title',
            [
                'label' => esc_html__('Email Info', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => '201 Stokes New York',
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_1'],
                ]
            ]
        );

        $repeater->add_control(
            'tp_contact_phone_title',
            [
                'label' => esc_html__('Phone Info', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => '201 Stokes New York',
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_1'],
                ]
            ]
        );

        $repeater->add_control(
            'tp_contact_map_title',
            [
                'label' => esc_html__('Map Info', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => '201 Stokes New York',
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_1'],
                ]
            ]
        );
        

        $repeater->add_control(
         'tp_contact_social_switch',
            [
                'label'        => esc_html__( 'Add Social Icons?', 'tpcore' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'tpcore' ),
                'label_off'    => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        

        $repeater->start_controls_tabs(
            '_tab_style_member_box_itemr',[
                'condition' => [
                    'tp_contact_social_switch' => 'yes',
                ]
            ]
        );

        $repeater->start_controls_tab(
            '_tab_member_info',
            [
                'label' => __( 'Information', 'tpcore' ),
            ]
        );

        $repeater->add_control(
            'tp_contact_social_title',
             [
                'label'       => esc_html__( 'Social Title', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Find on social media', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
                'label_block' => true,
                'condition' => [
                    'tp_contact_social_switch' => 'yes',
                ]
             ]
        );
        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
            '_tab_member_links',
            [
                'label' => __( 'Links', 'tpcore' ),
            ]
        );

        $repeater->add_control(
            'web_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Website Address', 'tpcore' ),
                'placeholder' => __( 'Add your profile link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'email_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Email', 'tpcore' ),
                'placeholder' => __( 'Add your email link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );           

        $repeater->add_control(
            'phone_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Phone', 'tpcore' ),
                'placeholder' => __( 'Add your phone link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'facebook_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Facebook', 'tpcore' ),
                'default' => __( '#', 'tpcore' ),
                'placeholder' => __( 'Add your facebook link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );                

        $repeater->add_control(
            'twitter_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Twitter', 'tpcore' ),
                'default' => __( '#', 'tpcore' ),
                'placeholder' => __( 'Add your twitter link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'instagram_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Instagram', 'tpcore' ),
                'default' => __( '#', 'tpcore' ),
                'placeholder' => __( 'Add your instagram link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );       

        $repeater->add_control(
            'linkedin_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'LinkedIn', 'tpcore' ),
                'placeholder' => __( 'Add your linkedin link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'youtube_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Youtube', 'tpcore' ),
                'placeholder' => __( 'Add your youtube link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'googleplus_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Google Plus', 'tpcore' ),
                'placeholder' => __( 'Add your Google Plus link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'flickr_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Flickr', 'tpcore' ),
                'placeholder' => __( 'Add your flickr link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'vimeo_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Vimeo', 'tpcore' ),
                'placeholder' => __( 'Add your vimeo link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'behance_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Behance', 'tpcore' ),
                'placeholder' => __( 'Add your hehance link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'dribble_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Dribbble', 'tpcore' ),
                'placeholder' => __( 'Add your dribbble link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'pinterest_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Pinterest', 'tpcore' ),
                'placeholder' => __( 'Add your pinterest link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'gitub_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Github', 'tpcore' ),
                'placeholder' => __( 'Add your github link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        ); 

        $repeater->end_controls_tab();
        $repeater->end_controls_tabs();

        $this->add_control(
            'tp_list',
            [
                'label' => esc_html__('Contact - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
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


        $this->start_controls_section(
            'tpcore_contact',
            [
                'label' => esc_html__('Contact Form', 'tpcore'),
            ]
        );

        $this->add_control(
        'tp_contact_form_title',
         [
            'label'       => esc_html__( 'Contact Title', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'Sent A Message', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
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
        $this->tp_section_style_controls('comint_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('about_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('about_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('about_description', 'Section - Description', '.tp-el-content p');

        $this->tp_section_style_controls('coming_box', 'Contact - Box', '.tp-el-contact-box');
        $this->tp_basic_style_controls('coming_title', 'Contact - Title', '.tp-el-box-title');
        $this->tp_basic_style_controls('coming_subtitle', 'Contact - Description', '.tp-el-box-desc p');
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

        $this->add_render_attribute('title_args', 'class', 'section__title-11 tp-el-title');  
        $bloginfo = get_bloginfo( 'name' );  

		?>

         <!-- contact area start -->
         <section class="tp-contact-area pb-100">
            <div class="container">
               <div class="tp-contact-inner">
                  <div class="row">
                     <div class="col-xl-9 col-lg-8">
                        <div class="tp-contact-wrapper">

                            <?php if(!empty($settings['tp_contact_form_title'])) :?>
                            <h3 class="tp-contact-title"><?php echo tp_kses($settings['tp_contact_form_title']); ?></h3>
                            <?php endif; ?>

                            <div class="tp-contact-form">
                                <?php if( !empty($settings['tpcore_select_contact_form']) ) : ?>
                                    <?php echo do_shortcode( '[contact-form-7  id="'.$settings['tpcore_select_contact_form'].'"]' ); ?>
                                <?php else : ?>
                                    <?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'tpcore' ). '</p></div>'; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                     </div>

                     <div class="col-xl-3 col-lg-4">
                        <div class="tp-contact-info-wrapper">
                        <?php foreach ($settings['tp_list'] as $item) : ?>
                           <div class="tp-contact-info-item">
                            <?php if(($item['tp_box_icon_type'] == 'icon') || !empty($item['tp_box_icon_image']['url']) || !empty($item['tp_box_icon_svg'])) : ?>
                              <div class="tp-contact-info-icon">
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
                              <?php endif; ?>

                              <div class="tp-contact-info-content">
                                <?php if($item['tp_contact_social_switch'] == 'yes') : ?>
                                    <div class="tp-contact-social-wrapper mt-5">

                                        <?php if(!empty($item['tp_contact_social_title'])) : ?>
                                        <h4 class="tp-contact-social-title"><?php echo esc_html($item['tp_contact_social_title']); ?></h4>
                                        <?php endif; ?>

                                        <div class="tp-contact-social-icon">
                                            <?php if( !empty($item['web_title'] ) ) : ?>
                                            <a href="<?php echo esc_url( $item['web_title'] ); ?>"><i class="fa-regular fa-globe"></i></a>
                                            <?php endif; ?>  

                                            <?php if( !empty($item['email_title'] ) ) : ?>
                                            <a href="mailto:<?php echo esc_url( $item['email_title'] ); ?>"><i class="fa-regular fa-envelope"></i></a>
                                            <?php endif; ?>  

                                            <?php if( !empty($item['phone_title'] ) ) : ?>
                                            <a href="tell:<?php echo esc_url( $item['phone_title'] ); ?>"><i class="fa-regular fa-phone"></i></a>
                                            <?php endif; ?>  

                                            <?php if( !empty($item['facebook_title'] ) ) : ?>
                                            <a href="<?php echo esc_url( $item['facebook_title'] ); ?>"><i class="fa-brands fa-facebook-f"></i></a>
                                            <?php endif; ?>

                                            <?php if( !empty($item['twitter_title'] ) ) : ?>
                                            <a href="<?php echo esc_url( $item['twitter_title'] ); ?>"><i class="fa-brands fa-twitter"></i></a>
                                            <?php endif; ?>

                                            <?php if( !empty($item['instagram_title'] ) ) : ?>
                                            <a href="<?php echo esc_url( $item['instagram_title'] ); ?>"><i class="fa-brands fa-instagram"></i></a>
                                            <?php endif; ?>

                                            <?php if( !empty($item['linkedin_title'] ) ) : ?>
                                            <a href="<?php echo esc_url( $item['linkedin_title'] ); ?>"><i class="fa-brands fa-linkedin-in"></i></a>
                                            <?php endif; ?>

                                            <?php if( !empty($item['youtube_title'] ) ) : ?>
                                            <a href="<?php echo esc_url( $item['youtube_title'] ); ?>"><i class="fa-brands fa-youtube"></i></a>
                                            <?php endif; ?>

                                            <?php if( !empty($item['googleplus_title'] ) ) : ?>
                                            <a href="<?php echo esc_url( $item['googleplus_title'] ); ?>"><i class="fa-brands fa-google-plus-g"></i></a>
                                            <?php endif; ?>

                                            <?php if( !empty($item['flickr_title'] ) ) : ?>
                                            <a href="<?php echo esc_url( $item['flickr_title'] ); ?>"><i class="fa-brands fa-flickr"></i></a>
                                            <?php endif; ?>

                                            <?php if( !empty($item['vimeo_title'] ) ) : ?>
                                            <a href="<?php echo esc_url( $item['vimeo_title'] ); ?>"><i class="fa-brands fa-vimeo-v"></i></a>
                                            <?php endif; ?>

                                            <?php if( !empty($item['behance_title'] ) ) : ?>
                                            <a href="<?php echo esc_url( $item['behance_title'] ); ?>"><i class="fa-brands fa-behance"></i></a>
                                            <?php endif; ?>

                                            <?php if( !empty($item['dribble_title'] ) ) : ?>
                                            <a href="<?php echo esc_url( $item['dribble_title'] ); ?>"><i class="fa-brands fa-dribbble"></i></a>
                                            <?php endif; ?>

                                            <?php if( !empty($item['pinterest_title'] ) ) : ?>
                                            <a href="<?php echo esc_url( $item['pinterest_title'] ); ?>"><i class="fa-brands fa-pinterest-p"></i></a>
                                            <?php endif; ?>

                                            <?php if( !empty($item['gitub_title'] ) ) : ?>
                                            <a href="<?php echo esc_url( $item['gitub_title'] ); ?>"><i class="fa-brands fa-github"></i></a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                 <?php else: ?>
                                    

                                <?php if(!empty($item['tp_contact_email_title'])) :?>
                                        <p data-info="mail">
                                            <?php echo tp_kses($item['tp_contact_email_title']); ?>
                                        </p>
                                    <?php endif;?>

                                    <?php if(!empty($item['tp_contact_phone_title'])) :?>
                                        <p data-info="phone">
                                        <?php echo tp_kses($item['tp_contact_phone_title']); ?>
                                        </p>
                                    <?php endif;?>

                                    <?php if(!empty($item['tp_contact_map_title'])) :?>
                                        <p data-info="map">
                                        <?php echo tp_kses($item['tp_contact_map_title']); ?>
                                        </p>
                                    <?php endif;?>

                                <?php endif; ?>
                              </div>
                           </div>
                           <?php endforeach; ?>

                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- contact area end -->

        <?php
	}
}

$widgets_manager->register( new TP_Contact_Box() );
