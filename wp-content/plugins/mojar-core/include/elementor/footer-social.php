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
class MS_Footer_Social extends Widget_Base
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
        return 'ms-footer-social';
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
        return __('Footer Social', 'mscore');
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
            '500px' => esc_html__('500px', 'mscore'),
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



    protected function register_controls()
    {
        $this->register_controls_section();
        $this->style_tab_content();
    }



    protected function register_controls_section()
    {

        // layout Panel
        $this->start_controls_section(
            'ms_layout',
            [
                'label' => esc_html__('Design Layout', 'mscore'),
            ]
        );
        $this->add_control(
            'ms_design_style',
            [
                'label' => esc_html__('Select Layout', 'mscore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'mscore'),
                    'layout-2' => esc_html__('Layout 2', 'mscore'),
                ],
                'default' => 'layout-1',
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            '_section_social',
            [
                'label' => esc_html__('Social Profiles', 'mscore'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'name',
            [
                'label' => esc_html__('Profile Name', 'mscore'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'select2options' => [
                    'allowClear' => false,
                ],
                'options' => self::get_profile_names()
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__('Profile Link', 'mscore'),
                'placeholder' => esc_html__('Add your profile link', 'mscore'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'autocomplete' => false,
                'show_external' => false,
                'condition' => [
                    'name!' => 'email'
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        $this->add_control(
            'profiles',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(name.slice(0,1).toUpperCase() + name.slice(1)) #>',
                'default' => [
                    [
                        'link' => ['url' => 'https://facebook.com/'],
                        'name' => 'facebook'
                    ],
                    [
                        'link' => ['url' => 'https://linkedin.com/'],
                        'name' => 'linkedin'
                    ],
                    [
                        'link' => ['url' => 'https://twitter.com/'],
                        'name' => 'twitter'
                    ]
                ],
            ]
        );

        $this->add_control(
            'show_profiles',
            [
                'label' => esc_html__('Show Profiles', 'mscore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'mscore'),
                'label_off' => esc_html__('Hide', 'mscore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'ms_profile_title',
            [
                'label' => esc_html__('Profile Title', 'mscore'),
                'description' => ms_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('MS Profile Title', 'mscore'),
                'placeholder' => esc_html__('Type Sub Heading Text', 'mscore'),
                'label_block' => true,
                'condition' => [
                    'ms_design_style' => 'layout-2'
                ],
            ]
        );


        $this->end_controls_section();
    }

    protected function style_tab_content()
    {
        $this->ms_basic_style_controls('footer_subtitle', 'Title', '.ms-el-title');
        $this->ms_link_controls_style('slider_social_link', 'Footer Social - Link', '.ms-el-social-link');
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

        <?php if ($settings['ms_design_style']  == 'layout-2') :
            $this->add_render_attribute('title_args', 'class', 'ms-title ms-el-title');
        ?>


            <div class="ms-footer-social-4 ms-footer-social">
                <?php if (!empty($settings['ms_profile_title'])) : ?>
                    <h4 class="ms-footer-social-title-4 ms-el-title"><?php echo ms_kses($settings['ms_profile_title']); ?> </h4>
                <?php endif; ?>

                <?php if ($settings['show_profiles'] && is_array($settings['profiles'])) : ?>
                    <?php
                    foreach ($settings['profiles'] as $profile) :
                        $icon = $profile['name'];
                        $url = esc_url($profile['link']['url']);

                        printf(
                            '<a target="_blank" rel="noopener"  href="%s" class="ms-el-social-link elementor-repeater-item-%s"><i class="fab fa-%s" aria-hidden="true"></i></a>',
                            $url,
                            esc_attr($profile['_id']),
                            esc_attr($icon)
                        );
                    endforeach;
                    ?>
                <?php endif; ?>
            </div>

        <?php else : ?>

            <?php if ($settings['show_profiles'] && is_array($settings['profiles'])) : ?>
                <div class="ms-footer-social">
                    <?php
                    foreach ($settings['profiles'] as $profile) :
                        $icon = $profile['name'];
                        $url = esc_url($profile['link']['url']);

                        printf(
                            '<a target="_blank" rel="noopener"  href="%s" class="ms-el-social-link elementor-repeater-item-%s"><i class="fab fa-%s" aria-hidden="true"></i></a>',
                            $url,
                            esc_attr($profile['_id']),
                            esc_attr($icon)
                        );
                    endforeach;
                    ?>
                </div>
            <?php endif; ?>

        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new MS_Footer_Social());
