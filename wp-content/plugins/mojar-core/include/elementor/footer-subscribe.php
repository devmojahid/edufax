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
class MS_Footer_Subscribe extends Widget_Base
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
        return 'ms-footer-subscribe';
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
        return __('Footer Subscribe', 'mscore');
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

        $this->start_controls_section(
            'mscore_contact',
            [
                'label' => esc_html__('Contact Form', 'mscore'),
            ]
        );

        $this->add_control(
            'ms_contact_desc_text',
            [
                'label'       => esc_html__('Description Text', 'mscore'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => esc_html__('Our conversation is just getting started', 'mscore'),
                'placeholder' => esc_html__('Your Text', 'mscore'),
                'label_block' => true,
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
        $this->ms_basic_style_controls('about_title', 'Section - Title', '.ms-el-title');
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

?>

        <div class="ms-footer-subscribe">
            <?php if (!empty($settings['ms_contact_desc_text'])) : ?>
                <p class="ms-contact-title ms-el-title"><?php echo ms_kses($settings['ms_contact_desc_text']); ?></p>
            <?php endif; ?>
            <div class="ms-footer-subscribe-form mb-30 ms-el-box-input">
                <?php if (!empty($settings['mscore_select_contact_form'])) : ?>
                    <?php echo do_shortcode('[contact-form-7  id="' . $settings['mscore_select_contact_form'] . '"]'); ?>
                <?php else : ?>
                    <?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'mscore') . '</p></div>'; ?>
                <?php endif; ?>
            </div>
        </div>

<?php
    }
}

$widgets_manager->register(new MS_Footer_Subscribe());
