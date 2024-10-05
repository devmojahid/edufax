<?php

namespace MSCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Ms Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class MS_Info_Box extends Widget_Base
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
        return 'ms-info-box';
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
        return __('Info Box', 'mscore');
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
                'label' => esc_html__('Design Layout', 'ms-core'),
            ]
        );
        $this->add_control(
            'ms_design_style',
            [
                'label' => esc_html__('Select Layout', 'ms-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'ms-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->ms_section_title_render_controls('info', 'Section Title');

        $this->start_controls_section(
            'ms_info_sec',
            [
                'label' => esc_html__('Info List', 'mscore'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_control(
            'ms_info_bottom_quote',
            [
                'label'       => esc_html__('Bottom Quote Text', 'mscore'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'rows'        => 10,
                'default'     => esc_html__('So start browsing today and find the perfect ', 'mscore'),
                'placeholder' => esc_html__('Your Text', 'mscore'),
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
            'ms_info_title',
            [
                'label' => esc_html__('Title', 'mscore'),
                'description' => ms_get_allowed_html_desc('basic'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Info Title', 'mscore'),
                'label_block' => true,
            ]
        );


        $repeater->add_control(
            'ms_info_link_switcher',
            [
                'label' => esc_html__('Add Info link', 'mscore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'mscore'),
                'label_off' => esc_html__('No', 'mscore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'ms_info_link_type',
            [
                'label' => esc_html__('Info Link Type', 'mscore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'ms_info_link_switcher' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'ms_info_link',
            [
                'label' => esc_html__('Info Link', 'mscore'),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'mscore'),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'condition' => [
                    'ms_info_link_type' => '1',
                    'ms_info_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'ms_info_page_link',
            [
                'label' => esc_html__('Select Info Link Page', 'mscore'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => ms_get_all_pages(),
                'condition' => [
                    'ms_info_link_type' => '2',
                    'ms_info_link_switcher' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'ms_info_list',
            [
                'label' => esc_html__('Info - List', 'mscore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'ms_info_title' => esc_html__('Business Stratagy', 'mscore'),
                    ],
                    [
                        'ms_info_title' => esc_html__('Website Development', 'mscore')
                    ],
                    [
                        'ms_info_title' => esc_html__('Marketing & Reporting', 'mscore')
                    ]
                ],
                'title_field' => '{{{ ms_info_title }}}',
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
        $this->ms_columns('col');
    }

    protected function style_tab_content()
    {
        $this->ms_section_style_controls('history_section', 'Section - Style', '.ms-el-section');
        $this->ms_basic_style_controls('history_subtitle', 'Section - Subtitle', '.ms-el-subtitle');
        $this->ms_basic_style_controls('history_title', 'Section - Title', '.ms-el-title');
        $this->ms_basic_style_controls('history_description', 'Section - Description', '.ms-el-content p');

        $this->ms_link_controls_style('portfolio_description', 'Box - Button', '.ms-el-box-btn');
        $this->ms_link_controls_style('slider_social_link', 'Social - Link', '.ms-el-social-link');
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

        ?>

        <?php else :
            $this->add_render_attribute('title_args', 'class', 'ms-work-section-title ms-el-title');
        ?>

            <!-- work area start -->
            <section class="ms-work-area pt-115 pb-95">
                <div class="container">
                    <?php if (!empty($settings['ms_info_section_title_show'])) : ?>
                        <div class="row justify-content-center">
                            <div class="col-xl-6">
                                <div class="ms-work-section-title-wrapper text-center mb-60">

                                    <?php if (!empty($settings['ms_info_sub_title'])) : ?>
                                        <span class="ms-work-section-subtitle ms-el-subtitle"><?php echo ms_kses($settings['ms_info_sub_title']) ?></span>
                                    <?php endif; ?>

                                    <?php
                                    if (!empty($settings['ms_info_title'])) :
                                        printf(
                                            '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape($settings['ms_info_title_tag']),
                                            $this->get_render_attribute_string('title_args'),
                                            ms_kses($settings['ms_info_title'])
                                        );
                                    endif;
                                    ?>

                                    <?php if (!empty($settings['ms_info_description'])) : ?>
                                        <p><?php echo ms_kses($settings['ms_info_description']); ?></p>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="row">
                        <?php foreach ($settings['ms_info_list'] as $key => $item) :

                            // Link
                            if ('2' == $item['ms_info_link_type']) {
                                $link = get_permalink($item['ms_info_page_link']);
                                $target = '_self';
                                $rel = 'nofollow';
                            } else {
                                $link = !empty($item['ms_info_link']['url']) ? $item['ms_info_link']['url'] : '';
                                $target = !empty($item['ms_info_link']['is_external']) ? '_blank' : '';
                                $rel = !empty($item['ms_info_link']['nofollow']) ? 'nofollow' : '';
                            }
                        ?>
                            <div class="col-xl-<?php echo esc_attr($settings['ms_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['ms_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['ms_col_for_tablet']); ?> col-<?php echo esc_attr($settings['ms_col_for_mobile']); ?>">
                                <div class="ms-work-item mb-35 text-center">
                                    <div class="ms-work-icon d-flex align-items-end justify-content-center">
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
                                    <div class="ms-work-content">
                                        <?php if (!empty($item['ms_info_title'])) : ?>
                                            <h4 class="ms-work-title ms-el-box-title">
                                                <?php if ($item['ms_info_link_switcher'] == 'yes') : ?>
                                                    <a href="<?php echo esc_url($link); ?>"><?php echo ms_kses($item['ms_info_title']); ?></a>
                                                <?php else : ?>
                                                    <?php echo ms_kses($item['ms_info_title']); ?>
                                                <?php endif; ?>
                                            </h4>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php if (!empty($settings['ms_info_bottom_quote'])) : ?>
                        <div class="row justify-content-center">
                            <div class="col-xl-4">
                                <div class="ms-work-quote text-center">
                                    <p><?php echo ms_kses($settings['ms_info_bottom_quote']); ?></p>
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

$widgets_manager->register(new MS_Info_Box());
