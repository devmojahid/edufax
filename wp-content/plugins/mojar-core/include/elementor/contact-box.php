<?php

namespace MSCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Ms Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class MS_Contact_Box extends Widget_Base
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
    public function get_title()
    {
        return __('Contact Box', 'mscore');
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


    protected static function get_profile_names()
    {
        return [
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

    public function get_ms_contact_form()
    {
        if (!class_exists('WPCF7')) {
            return;
        }
        $ms_cfa         = array();
        $ms_cf_args     = array('posts_per_page' => -1, 'post_type' => 'wpcf7_contact_form');
        $ms_forms       = get_posts($ms_cf_args);
        $ms_cfa         = ['0' => esc_html__('Select Form', 'mscore')];
        if ($ms_forms) {
            foreach ($ms_forms as $ms_form) {
                $ms_cfa[$ms_form->ID] = $ms_form->post_title;
            }
        } else {
            $ms_cfa[esc_html__('No contact form found', 'mscore')] = 0;
        }
        return $ms_cfa;
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

        $this->ms_section_title_render_controls('contact', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');

        // Service group
        $this->start_controls_section(
            '_MS_contact_info',
            [
                'label' => esc_html__('Contact Info List', 'mscore'),
                'description' => esc_html__('Control all the style settings from Style tab', 'mscore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'repeater_condition',
            [
                'label' => __('Field condition', 'mscore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __('Style 1', 'mscore'),
                    'style_2' => __('Style 2', 'mscore'),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'ms_box_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'mscore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'mscore'),
                    'icon' => esc_html__('Icon', 'mscore'),
                    'svg' => esc_html__('SVG', 'mscore'),
                ],
                'condition' => [
                    'repeater_condition' => ['style_1'],
                ]
            ]
        );
        $repeater->add_control(
            'ms_box_icon_svg',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'mscore'),
                'condition' => [
                    'ms_box_icon_type' => 'svg',
                    'repeater_condition' => ['style_1'],
                ]
            ]
        );

        $repeater->add_control(
            'ms_box_icon_image',
            [
                'label' => esc_html__('Upload Icon Image', 'mscore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'ms_box_icon_type' => 'image',
                    'repeater_condition' => ['style_1'],
                ]
            ]
        );

        if (ms_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'ms_box_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'ms_box_icon_type' => 'icon',
                        'repeater_condition' => ['style_1'],
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'ms_box_selected_icon',
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
                        'ms_box_icon_type' => 'icon',
                        'repeater_condition' => ['style_1'],
                    ]
                ]
            );
        }

        $repeater->add_control(
            'ms_contact_info_title',
            [
                'label' => esc_html__('Contact Type Title', 'mscore'),
                'description' => esc_html__('This field is just used for title showing. It not reflect in main design.', 'mscore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Email Contact',
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_1'],
                ]
            ]
        );

        $repeater->add_control(
            'ms_contact_email_title',
            [
                'label' => esc_html__('Email Info', 'mscore'),
                'description' => ms_get_allowed_html_desc('intermediate'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => '201 Stokes New York',
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_1'],
                ]
            ]
        );

        $repeater->add_control(
            'ms_contact_phone_title',
            [
                'label' => esc_html__('Phone Info', 'mscore'),
                'description' => ms_get_allowed_html_desc('intermediate'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => '201 Stokes New York',
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_1'],
                ]
            ]
        );

        $repeater->add_control(
            'ms_contact_map_title',
            [
                'label' => esc_html__('Map Info', 'mscore'),
                'description' => ms_get_allowed_html_desc('intermediate'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => '201 Stokes New York',
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_1'],
                ]
            ]
        );


        $repeater->add_control(
            'ms_contact_social_switch',
            [
                'label'        => esc_html__('Add Social Icons?', 'mscore'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'mscore'),
                'label_off'    => esc_html__('Hide', 'mscore'),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );



        $repeater->start_controls_tabs(
            '_tab_style_member_box_itemr',
            [
                'condition' => [
                    'ms_contact_social_switch' => 'yes',
                ]
            ]
        );

        $repeater->start_controls_tab(
            '_tab_member_info',
            [
                'label' => __('Information', 'mscore'),
            ]
        );

        $repeater->add_control(
            'ms_contact_social_title',
            [
                'label'       => esc_html__('Social Title', 'mscore'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Find on social media', 'mscore'),
                'placeholder' => esc_html__('Your Text', 'mscore'),
                'label_block' => true,
                'condition' => [
                    'ms_contact_social_switch' => 'yes',
                ]
            ]
        );
        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
            '_tab_member_links',
            [
                'label' => __('Links', 'mscore'),
            ]
        );

        $repeater->add_control(
            'web_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Website Address', 'mscore'),
                'placeholder' => __('Add your profile link', 'mscore'),
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
                'label' => __('Email', 'mscore'),
                'placeholder' => __('Add your email link', 'mscore'),
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
                'label' => __('Phone', 'mscore'),
                'placeholder' => __('Add your phone link', 'mscore'),
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
                'label' => __('Facebook', 'mscore'),
                'default' => __('#', 'mscore'),
                'placeholder' => __('Add your facebook link', 'mscore'),
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
                'label' => __('Twitter', 'mscore'),
                'default' => __('#', 'mscore'),
                'placeholder' => __('Add your twitter link', 'mscore'),
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
                'label' => __('Instagram', 'mscore'),
                'default' => __('#', 'mscore'),
                'placeholder' => __('Add your instagram link', 'mscore'),
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
                'label' => __('LinkedIn', 'mscore'),
                'placeholder' => __('Add your linkedin link', 'mscore'),
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
                'label' => __('Youtube', 'mscore'),
                'placeholder' => __('Add your youtube link', 'mscore'),
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
                'label' => __('Google Plus', 'mscore'),
                'placeholder' => __('Add your Google Plus link', 'mscore'),
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
                'label' => __('Flickr', 'mscore'),
                'placeholder' => __('Add your flickr link', 'mscore'),
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
                'label' => __('Vimeo', 'mscore'),
                'placeholder' => __('Add your vimeo link', 'mscore'),
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
                'label' => __('Behance', 'mscore'),
                'placeholder' => __('Add your hehance link', 'mscore'),
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
                'label' => __('Dribbble', 'mscore'),
                'placeholder' => __('Add your dribbble link', 'mscore'),
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
                'label' => __('Pinterest', 'mscore'),
                'placeholder' => __('Add your pinterest link', 'mscore'),
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
                'label' => __('Github', 'mscore'),
                'placeholder' => __('Add your github link', 'mscore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->end_controls_tab();
        $repeater->end_controls_tabs();

        $this->add_control(
            'ms_list',
            [
                'label' => esc_html__('Contact - List', 'mscore'),
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
            'mscore_contact',
            [
                'label' => esc_html__('Contact Form', 'mscore'),
            ]
        );

        $this->add_control(
            'ms_contact_form_title',
            [
                'label'       => esc_html__('Contact Title', 'mscore'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Sent A Message', 'mscore'),
                'placeholder' => esc_html__('Your Text', 'mscore'),
            ]
        );

        $this->add_control(
            'mscore_select_contact_form',
            [
                'label'   => esc_html__('Select Form', 'mscore'),
                'type'    => Controls_Manager::SELECT,
                'default' => '0',
                'options' => $this->get_ms_contact_form(),
            ]
        );

        $this->end_controls_section();
    }

    // style_tab_content
    protected function style_tab_content()
    {
        $this->ms_section_style_controls('comint_section', 'Section - Style', '.ms-el-section');
        $this->ms_basic_style_controls('about_subtitle', 'Section - Subtitle', '.ms-el-subtitle');
        $this->ms_basic_style_controls('about_title', 'Section - Title', '.ms-el-title');
        $this->ms_basic_style_controls('about_description', 'Section - Description', '.ms-el-content p');

        $this->ms_section_style_controls('coming_box', 'Contact - Box', '.ms-el-contact-box');
        $this->ms_basic_style_controls('coming_title', 'Contact - Title', '.ms-el-box-title');
        $this->ms_basic_style_controls('coming_subtitle', 'Contact - Description', '.ms-el-box-desc p');
        $this->ms_input_controls_style('coming_input', 'Form - Input', '.ms-el-box-input input', '.ms-el-box-input textarea');
        $this->ms_link_controls_style('coming_input_btn', 'Form - Button', '.ms-el-box-input button');
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

        $this->add_render_attribute('title_args', 'class', 'section__title-11 ms-el-title');
        $bloginfo = get_bloginfo('name');

?>

        <!-- contact area start -->
        <section class="ms-contact-area pb-100">
            <div class="container">
                <div class="ms-contact-inner">
                    <div class="row">
                        <div class="col-xl-9 col-lg-8">
                            <div class="ms-contact-wrapper">

                                <?php if (!empty($settings['ms_contact_form_title'])) : ?>
                                    <h3 class="ms-contact-title"><?php echo ms_kses($settings['ms_contact_form_title']); ?></h3>
                                <?php endif; ?>

                                <div class="ms-contact-form">
                                    <?php if (!empty($settings['mscore_select_contact_form'])) : ?>
                                        <?php echo do_shortcode('[contact-form-7  id="' . $settings['mscore_select_contact_form'] . '"]'); ?>
                                    <?php else : ?>
                                        <?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'mscore') . '</p></div>'; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-4">
                            <div class="ms-contact-info-wrapper">
                                <?php foreach ($settings['ms_list'] as $item) : ?>
                                    <div class="ms-contact-info-item">
                                        <?php if (($item['ms_box_icon_type'] == 'icon') || !empty($item['ms_box_icon_image']['url']) || !empty($item['ms_box_icon_svg'])) : ?>
                                            <div class="ms-contact-info-icon">
                                                <?php if ($item['ms_box_icon_type'] == 'icon') : ?>
                                                    <?php if (!empty($item['ms_box_icon']) || !empty($item['ms_box_selected_icon']['value'])) : ?>
                                                        <span><?php ms_render_icon($item, 'ms_box_icon', 'ms_box_selected_icon'); ?></span>
                                                    <?php endif; ?>
                                                <?php elseif ($item['ms_box_icon_type'] == 'image') : ?>
                                                    <span>
                                                        <?php if (!empty($item['ms_box_icon_image']['url'])) : ?>
                                                            <img src="<?php echo $item['ms_box_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['ms_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                                        <?php endif; ?>
                                                    </span>
                                                <?php else : ?>
                                                    <span>
                                                        <?php if (!empty($item['ms_box_icon_svg'])) : ?>
                                                            <?php echo $item['ms_box_icon_svg']; ?>
                                                        <?php endif; ?>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>

                                        <div class="ms-contact-info-content">
                                            <?php if ($item['ms_contact_social_switch'] == 'yes') : ?>
                                                <div class="ms-contact-social-wrapper mt-5">

                                                    <?php if (!empty($item['ms_contact_social_title'])) : ?>
                                                        <h4 class="ms-contact-social-title"><?php echo esc_html($item['ms_contact_social_title']); ?></h4>
                                                    <?php endif; ?>

                                                    <div class="ms-contact-social-icon">
                                                        <?php if (!empty($item['web_title'])) : ?>
                                                            <a href="<?php echo esc_url($item['web_title']); ?>"><i class="fa-regular fa-globe"></i></a>
                                                        <?php endif; ?>

                                                        <?php if (!empty($item['email_title'])) : ?>
                                                            <a href="mailto:<?php echo esc_url($item['email_title']); ?>"><i class="fa-regular fa-envelope"></i></a>
                                                        <?php endif; ?>

                                                        <?php if (!empty($item['phone_title'])) : ?>
                                                            <a href="tell:<?php echo esc_url($item['phone_title']); ?>"><i class="fa-regular fa-phone"></i></a>
                                                        <?php endif; ?>

                                                        <?php if (!empty($item['facebook_title'])) : ?>
                                                            <a href="<?php echo esc_url($item['facebook_title']); ?>"><i class="fa-brands fa-facebook-f"></i></a>
                                                        <?php endif; ?>

                                                        <?php if (!empty($item['twitter_title'])) : ?>
                                                            <a href="<?php echo esc_url($item['twitter_title']); ?>"><i class="fa-brands fa-twitter"></i></a>
                                                        <?php endif; ?>

                                                        <?php if (!empty($item['instagram_title'])) : ?>
                                                            <a href="<?php echo esc_url($item['instagram_title']); ?>"><i class="fa-brands fa-instagram"></i></a>
                                                        <?php endif; ?>

                                                        <?php if (!empty($item['linkedin_title'])) : ?>
                                                            <a href="<?php echo esc_url($item['linkedin_title']); ?>"><i class="fa-brands fa-linkedin-in"></i></a>
                                                        <?php endif; ?>

                                                        <?php if (!empty($item['youtube_title'])) : ?>
                                                            <a href="<?php echo esc_url($item['youtube_title']); ?>"><i class="fa-brands fa-youtube"></i></a>
                                                        <?php endif; ?>

                                                        <?php if (!empty($item['googleplus_title'])) : ?>
                                                            <a href="<?php echo esc_url($item['googleplus_title']); ?>"><i class="fa-brands fa-google-plus-g"></i></a>
                                                        <?php endif; ?>

                                                        <?php if (!empty($item['flickr_title'])) : ?>
                                                            <a href="<?php echo esc_url($item['flickr_title']); ?>"><i class="fa-brands fa-flickr"></i></a>
                                                        <?php endif; ?>

                                                        <?php if (!empty($item['vimeo_title'])) : ?>
                                                            <a href="<?php echo esc_url($item['vimeo_title']); ?>"><i class="fa-brands fa-vimeo-v"></i></a>
                                                        <?php endif; ?>

                                                        <?php if (!empty($item['behance_title'])) : ?>
                                                            <a href="<?php echo esc_url($item['behance_title']); ?>"><i class="fa-brands fa-behance"></i></a>
                                                        <?php endif; ?>

                                                        <?php if (!empty($item['dribble_title'])) : ?>
                                                            <a href="<?php echo esc_url($item['dribble_title']); ?>"><i class="fa-brands fa-dribbble"></i></a>
                                                        <?php endif; ?>

                                                        <?php if (!empty($item['pinterest_title'])) : ?>
                                                            <a href="<?php echo esc_url($item['pinterest_title']); ?>"><i class="fa-brands fa-pinterest-p"></i></a>
                                                        <?php endif; ?>

                                                        <?php if (!empty($item['gitub_title'])) : ?>
                                                            <a href="<?php echo esc_url($item['gitub_title']); ?>"><i class="fa-brands fa-github"></i></a>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            <?php else : ?>


                                                <?php if (!empty($item['ms_contact_email_title'])) : ?>
                                                    <p data-info="mail">
                                                        <?php echo ms_kses($item['ms_contact_email_title']); ?>
                                                    </p>
                                                <?php endif; ?>

                                                <?php if (!empty($item['ms_contact_phone_title'])) : ?>
                                                    <p data-info="phone">
                                                        <?php echo ms_kses($item['ms_contact_phone_title']); ?>
                                                    </p>
                                                <?php endif; ?>

                                                <?php if (!empty($item['ms_contact_map_title'])) : ?>
                                                    <p data-info="map">
                                                        <?php echo ms_kses($item['ms_contact_map_title']); ?>
                                                    </p>
                                                <?php endif; ?>

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

$widgets_manager->register(new MS_Contact_Box());
