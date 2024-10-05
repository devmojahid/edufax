<?php


new \Kirki\Panel(
    'panel_id',
    [
        'priority'    => 10,
        'title'       => esc_html__('Edufax Customizer', 'edufax'),
        'description' => esc_html__('Edufax Customizer Description.', 'edufax'),
    ]
);

// header_top_section
function header_top_section()
{
    // header_top_bar section 
    new \Kirki\Section(
        'header_top_section',
        [
            'title'       => esc_html__('Header Topbar Settings', 'edufax'),
            'description' => esc_html__('Header Topbar Controls.', 'edufax'),
            'panel'       => 'panel_id',
            'priority'    => 100,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'header_topbar_switch',
            'label'       => esc_html__('Header Topbar Switch', 'edufax'),
            'description' => esc_html__('Header Topbar switch On/Off', 'edufax'),
            'section'     => 'header_top_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__('Enable', 'edufax'),
                'off' => esc_html__('Disable', 'edufax'),
            ],
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'edufax_welcome_text',
            'label'    => esc_html__('Welcome Text', 'edufax'),
            'section'  => 'header_top_section',
            'default'  => esc_html__('FREE Express Shipping On Orders $570+', 'edufax'),
            'priority' => 10,
        ]
    );
}
header_top_section();

function header_main_section()
{
    // header_top_bar section 
    new \Kirki\Section(
        'header_main_section',
        [
            'title'       => esc_html__('Header Main Settings', 'edufax'),
            'description' => esc_html__('Header Main Controls.', 'edufax'),
            'panel'       => 'panel_id',
            'priority'    => 100,
        ]
    );
    // header_top_bar section 
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'header_right_switch',
            'label'       => esc_html__('Header Right Switch', 'edufax'),
            'description' => esc_html__('Header Right On/Off', 'edufax'),
            'section'     => 'header_main_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__('Enable', 'edufax'),
                'off' => esc_html__('Disable', 'edufax'),
            ],
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'edufax_header_search',
            'label'       => esc_html__('Header Search Switch', 'edufax'),
            'description' => esc_html__('Header Search On/Off', 'edufax'),
            'section'     => 'header_main_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__('Enable', 'edufax'),
                'off' => esc_html__('Disable', 'edufax'),
            ],
        ]
    );



    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'edufax_header_sign_up',
            'label'       => esc_html__('Header Sign Up Switch', 'edufax'),
            'description' => esc_html__('Header Sign Up On/Off', 'edufax'),
            'section'     => 'header_main_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__('Enable', 'edufax'),
                'off' => esc_html__('Disable', 'edufax'),
            ],
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'edufax_header_sign_up_text',
            'label'    => esc_html__('Header Sign Up Text', 'edufax'),
            'description' => esc_html__('Header Sign Up Text Hear', 'edufax'),
            'section'  => 'header_main_section',
            'default'  => esc_html__('Sign Up', 'edufax'),
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'edufax_header_sign_up_link',
            'label'    => esc_html__('Header Sign Up Link', 'edufax'),
            'description' => esc_html__('Header Sign Up Link Hear', 'edufax'),
            'section'  => 'header_main_section',
            'default'  => esc_html__('#', 'edufax'),
        ]
    );
}
header_main_section();

function preloader_section()
{

    new \Kirki\Section(
        'preloader_section',
        [
            'title'       => esc_html__('Preloader Settings', 'edufax'),
            'description' => esc_html__('Preloader Controls.', 'edufax'),
            'panel'       => 'panel_id',
            'priority'    => 100,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'edufax_preloader_switch',
            'label'       => esc_html__('Preloader Switch', 'edufax'),
            'description' => esc_html__('Preloader On/Off', 'edufax'),
            'section'     => 'preloader_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__('Enable', 'edufax'),
                'off' => esc_html__('Disable', 'edufax'),
            ],
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'edufax_preloader_text',
            'label'    => esc_html__('Preloader Text', 'edufax'),
            'section'  => 'preloader_section',
            'default'  => esc_html__('Edufax', 'edufax'),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'edufax_preloader_loading_text',
            'label'    => esc_html__('Preloader Loading Text', 'edufax'),
            'section'  => 'preloader_section',
            'default'  => esc_html__('Loading', 'edufax'),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Image(
        [
            'settings'    => 'edufax_preloader_logo',
            'label'       => esc_html__('Preloader Logo Icon', 'edufax'),
            'description' => esc_html__('Preloader Logo Here', 'edufax'),
            'section'     => 'preloader_section',
            'default'     => get_template_directory_uri() . '/assets/img/logo/preloader/preloader-icon.svg',
        ]
    );
}

preloader_section();

function back_to_top_section()
{

    new \Kirki\Section(
        'back_to_top_section',
        [
            'title'       => esc_html__('Back To Top Settings', 'edufax'),
            'description' => esc_html__('Back To Top Controls.', 'edufax'),
            'panel'       => 'panel_id',
            'priority'    => 100,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'edufax_backtotop',
            'label'       => esc_html__('Back To Top Switch', 'edufax'),
            'description' => esc_html__('Back To Top On/Off', 'edufax'),
            'section'     => 'back_to_top_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__('Enable', 'edufax'),
                'off' => esc_html__('Disable', 'edufax'),
            ],
        ]
    );
}

back_to_top_section();

// offcanvas_side_section
function offcanvas_side_section()
{
    // header_top_bar section 
    new \Kirki\Section(
        'offcanvas_side_section',
        [
            'title'       => esc_html__('Offcanvas Info', 'edufax'),
            'description' => esc_html__('Offcanvas Information.', 'edufax'),
            'panel'       => 'panel_id',
            'priority'    => 110,
        ]
    );

    new \Kirki\Field\Select(
        [
            'settings'    => 'edufax_offcanvas_style',
            'label'       => esc_html__('Choose Offcanvas Style', 'edufax'),
            'section'     => 'offcanvas_side_section',
            'default'     => 'default',
            'placeholder' => esc_html__('Choose an option', 'edufax'),
            'choices'     => [
                'default' => esc_html__('Default', 'edufax'),
                'dark_brown' => esc_html__('Dark Brown', 'edufax'),
                'brown' => esc_html__('Brown', 'edufax'),
                'green' => esc_html__('Green', 'edufax'),
            ],
        ]
    );

    new \Kirki\Field\Image(
        [
            'settings'    => 'edufax_offcanvas_logo',
            'label'       => esc_html__('Offcanvas Logo', 'edufax'),
            'description' => esc_html__('Offcanvas Logo Here', 'edufax'),
            'section'     => 'offcanvas_side_section',
            'default'     => get_template_directory_uri() . '/assets/img/logo/logo.svg',
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'edufax_offcanvas_category_menu_switch',
            'label'       => esc_html__('Category Menu Switch', 'edufax'),
            'description' => esc_html__('Category Menu On/Off', 'edufax'),
            'section'     => 'offcanvas_side_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__('Enable', 'edufax'),
                'off' => esc_html__('Disable', 'edufax'),
            ],
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'edufax_offcanvas_btn_text',
            'label'    => esc_html__('Button Text', 'edufax'),
            'section'  => 'offcanvas_side_section',
            'default'  => esc_html__('Contact Us', 'edufax'),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\URL(
        [
            'settings' => 'edufax_offcanvas_btn_url',
            'label'    => esc_html__('Button URL', 'edufax'),
            'section'  => 'offcanvas_side_section',
            'default'  => '#',
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'edufax_offcanvas_lang_switch',
            'label'       => esc_html__('Language Switch', 'edufax'),
            'description' => esc_html__('Language On/Off', 'edufax'),
            'section'     => 'offcanvas_side_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__('Enable', 'edufax'),
                'off' => esc_html__('Disable', 'edufax'),
            ],

        ]
    );
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'edufax_offcanvas_multicurrency_switch',
            'label'       => esc_html__('Currency Switch', 'edufax'),
            'description' => esc_html__('Currency On/Off', 'edufax'),
            'section'     => 'offcanvas_side_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__('Enable', 'edufax'),
                'off' => esc_html__('Disable', 'edufax'),
            ],

        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'edufax_offcanvas_multicurrency_shortcode',
            'label'    => esc_html__('Your Shortcode', 'edufax'),
            'section'  => 'offcanvas_side_section',
            'default'  => esc_html__('[shortcode]', 'edufax'),
            'priority' => 10,
            'active_callback' => [
                [
                    'setting' => 'edufax_offcanvas_multicurrency_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]

        ]
    );
}
offcanvas_side_section();


// header_logo_section
function header_logo_section()
{
    // header_logo_section section 
    new \Kirki\Section(
        'header_logo_section',
        [
            'title'       => esc_html__('Header Logo', 'edufax'),
            'description' => esc_html__('Header Logo Settings.', 'edufax'),
            'panel'       => 'panel_id',
            'priority'    => 130,
        ]
    );

    // header_logo_section section 
    new \Kirki\Field\Image(
        [
            'settings'    => 'header_logo',
            'label'       => esc_html__('Header Logo', 'edufax'),
            'description' => esc_html__('Theme Default/Primary Logo Here', 'edufax'),
            'section'     => 'header_logo_section',
            'default'     => get_template_directory_uri() . '/assets/images/logo.png',
        ]
    );
    new \Kirki\Field\Image(
        [
            'settings'    => 'header_secondary_logo',
            'label'       => esc_html__('Header Secondary Logo', 'edufax'),
            'description' => esc_html__('Theme Secondary Logo Here', 'edufax'),
            'section'     => 'header_logo_section',
            'default'     => get_template_directory_uri() . '/assets/img/logo/logo-white.svg',
        ]
    );

    // Contacts Text 
    new \Kirki\Field\Text(
        [
            'settings' => 'edufax_logo_width',
            'label'    => esc_html__('Logo Width', 'edufax'),
            'section'  => 'header_logo_section',
            'default'  => esc_html__('135', 'edufax'),
            'priority' => 10,
        ]
    );
}
header_logo_section();


// header_logo_section
function header_breadcrumb_section()
{
    // header_logo_section section 
    new \Kirki\Section(
        'header_breadcrumb_section',
        [
            'title'       => esc_html__('Breadcrumb', 'edufax'),
            'description' => esc_html__('Breadcrumb Settings.', 'edufax'),
            'panel'       => 'panel_id',
            'priority'    => 160,
        ]
    );

    // header_logo_section section 
    new \Kirki\Field\Image(
        [
            'settings'    => 'breadcrumb_image',
            'label'       => esc_html__('Breadcrumb Image', 'edufax'),
            'description' => esc_html__('Breadcrumb Image add/remove', 'edufax'),
            'section'     => 'header_breadcrumb_section',
        ]
    );
    new \Kirki\Field\Color(
        [
            'settings'    => 'breadcrumb_bg_color',
            'label'       => __('Breadcrumb BG Color', 'edufax'),
            'description' => esc_html__('You can change breadcrumb bg color from here.', 'edufax'),
            'section'     => 'header_breadcrumb_section',
            'default'     => '#f3fbfe',
        ]
    );

    new \Kirki\Field\Dimensions(
        [
            'settings'    => 'breadcrumb_padding',
            'label'       => esc_html__('Padding Control', 'edufax'),
            'description' => esc_html__('Padding', 'edufax'),
            'section'     => 'header_breadcrumb_section',
            'default'     => [
                'padding-top'  => '',
                'padding-bottom' => '',
            ],
        ]
    );
}
header_breadcrumb_section();

function full_site_typography()
{
    // header_logo_section section 
    new \Kirki\Section(
        'full_site_typography',
        [
            'title'       => esc_html__('Typography', 'edufax'),
            'description' => esc_html__('Typography Settings.', 'edufax'),
            'panel'       => 'panel_id',
            'priority'    => 190,
        ]
    );

    new \Kirki\Field\Typography(
        [
            'settings'    => 'full_site_typography_settings',
            'label'       => esc_html__('Typography Control', 'edufax'),
            'description' => esc_html__('The full set of options.', 'edufax'),
            'section'     => 'full_site_typography',
            'priority'    => 10,
            'transport'   => 'auto',
            'default'     => [
                'font-family'     => '',
                'variant'         => '',
                'color'           => '',
                'font-size'       => '',
                'line-height'     => '',
                'text-align'      => '',
            ],
            'output'      => [
                [
                    'element' => '.tpbreadcrumb-title',
                ],
            ],
        ]
    );
}
full_site_typography();

// footer layout
function footer_layout_section()
{

    new \Kirki\Section(
        'footer_layout_section',
        [
            'title'       => esc_html__('Footer', 'edufax'),
            'description' => esc_html__('Footer Settings.', 'edufax'),
            'panel'       => 'panel_id',
            'priority'    => 190,
        ]
    );
    // footer_widget_number section 
    new \Kirki\Field\Select(
        [
            'settings'    => 'footer_widget_number',
            'label'       => esc_html__('Footer Widget Number', 'edufax'),
            'section'     => 'footer_layout_section',
            'default'     => '4',
            'placeholder' => esc_html__('Choose an option', 'edufax'),
            'choices'     => [
                '1' => esc_html__('1', 'edufax'),
                '2' => esc_html__('2', 'edufax'),
                '3' => esc_html__('3', 'edufax'),
                '4' => esc_html__('4', 'edufax'),
            ],
        ]
    );


    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'edufax_footer_elementor_switch',
            'label'       => esc_html__('Footer Custom/Elementor Switch', 'edufax'),
            'description' => esc_html__('Footer Custom/Elementor On/Off', 'edufax'),
            'section'     => 'footer_layout_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__('Enable', 'edufax'),
                'off' => esc_html__('Disable', 'edufax'),
            ],
        ]
    );

    new \Kirki\Field\Radio_Image(
        [
            'settings'    => 'footer_layout_custom',
            'label'       => esc_html__('Footer Layout Control', 'edufax'),
            'section'     => 'footer_layout_section',
            'priority'    => 10,
            'choices'     => [
                'footer_1'   => get_template_directory_uri() . '/inc/img/footer/footer-1.png',
                'footer_2' => get_template_directory_uri() . '/inc/img/footer/footer-2.png',
                'footer_3' => get_template_directory_uri() . '/inc/img/footer/footer-3.png',
                'footer_4' => get_template_directory_uri() . '/inc/img/footer/footer-4.png',
                'footer_5' => get_template_directory_uri() . '/inc/img/footer/footer-5.png',
                'footer_6' => get_template_directory_uri() . '/inc/img/footer/footer-6.png',
            ],
            'default'     => 'footer_1',
            'active_callback' => [
                [
                    'setting' => 'edufax_footer_elementor_switch',
                    'operator' => '==',
                    'value' => false
                ]
            ]
        ]
    );

    $footer_posttype = array(
        'post_type'      => 'tp-footer',
        'posts_per_page' => -1,
    );
    $footer_posttype_loop = get_posts($footer_posttype);
    $footer_post_obj_arr = array();
    foreach ($footer_posttype_loop as $post) {
        $footer_post_obj_arr[$post->ID] = $post->post_title;
    }

    wp_reset_postdata();

    new \Kirki\Field\Select(
        [
            'settings'    => 'edufax_footer_templates',
            'label'       => esc_html__('Elementor Footer Template', 'edufax'),
            'section'     => 'footer_layout_section',
            'placeholder' => esc_html__('Choose an option', 'edufax'),
            'choices'     => $footer_post_obj_arr,
            'active_callback' => [
                [
                    'setting' => 'edufax_footer_elementor_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );



    // footer_layout_section section 
    new \Kirki\Field\Image(
        [
            'settings'    => 'footer_payment_img',
            'label'       => esc_html__('Footer Payment Image', 'edufax'),
            'description' => esc_html__('Footer Payment Image add/remove', 'edufax'),
            'section'     => 'footer_layout_section',
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings'    => 'edufax_footer_bg_color',
            'label'       => __('Footer BG Color', 'edufax'),
            'description' => esc_html__('You can change footer bg color from here.', 'edufax'),
            'section'     => 'footer_layout_section',
            'default'     => '#F4F7F9',
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'footer_style_2_switch',
            'label'       => esc_html__('Footer Style 2 Switch', 'edufax'),
            'description' => esc_html__('Footer Style 2 On/Off', 'edufax'),
            'section'     => 'footer_layout_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__('Enable', 'edufax'),
                'off' => esc_html__('Disable', 'edufax'),
            ],
        ]
    );
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'footer_style_3_switch',
            'label'       => esc_html__('Footer Style 3 Switch', 'edufax'),
            'description' => esc_html__('Footer Style 3 On/Off', 'edufax'),
            'section'     => 'footer_layout_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__('Enable', 'edufax'),
                'off' => esc_html__('Disable', 'edufax'),
            ],
        ]
    );
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'footer_style_4_switch',
            'label'       => esc_html__('Footer Style 4 Switch', 'edufax'),
            'description' => esc_html__('Footer Style 4 On/Off', 'edufax'),
            'section'     => 'footer_layout_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__('Enable', 'edufax'),
                'off' => esc_html__('Disable', 'edufax'),
            ],
        ]
    );
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'footer_style_5_switch',
            'label'       => esc_html__('Footer Style 5 Switch', 'edufax'),
            'description' => esc_html__('Footer Style 5 On/Off', 'edufax'),
            'section'     => 'footer_layout_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__('Enable', 'edufax'),
                'off' => esc_html__('Disable', 'edufax'),
            ],
        ]
    );
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'footer_style_6_switch',
            'label'       => esc_html__('Footer Style 6 Switch', 'edufax'),
            'description' => esc_html__('Footer Style 6 On/Off', 'edufax'),
            'section'     => 'footer_layout_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__('Enable', 'edufax'),
                'off' => esc_html__('Disable', 'edufax'),
            ],
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'edufax_copyright',
            'label'    => esc_html__('Footer Copyright', 'edufax'),
            'section'  => 'footer_layout_section',
            'default'  => esc_html__('© 2023 All Rights Reserved | WordPress Theme by Themepure', 'edufax'),
            'priority' => 10,
        ]
    );
}
footer_layout_section();


// blog_section
function blog_section()
{
    // blog_section section 
    new \Kirki\Section(
        'blog_section',
        [
            'title'       => esc_html__('Blog Section', 'edufax'),
            'description' => esc_html__('Blog Section Settings.', 'edufax'),
            'panel'       => 'panel_id',
            'priority'    => 150,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'edufax_blog_btn_switch',
            'label'       => esc_html__('Blog BTN On/Off', 'edufax'),
            'section'     => 'blog_section',
            'default'     => true,
            'priority' => 10,
        ]
    );

    // blog_section BTN 
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'edufax_blog_cat',
            'label'    => esc_html__('Blog Category Meta On/Off', 'edufax'),
            'section'  => 'blog_section',
            'default'  => false,
            'priority' => 10,
        ]
    );

    // blog_section Author Meta 
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'edufax_blog_author',
            'label'    => esc_html__('Blog Author Meta On/Off', 'edufax'),
            'section'  => 'blog_section',
            'default'  => true,
            'priority' => 10,
        ]
    );
    // blog_section Date Meta 
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'edufax_blog_date',
            'label'    => esc_html__('Blog Date Meta On/Off', 'edufax'),
            'section'  => 'blog_section',
            'default'  => true,
            'priority' => 10,
        ]
    );

    // blog_section Comments Meta 
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'edufax_blog_comments',
            'label'    => esc_html__('Blog Comments Meta On/Off', 'edufax'),
            'section'  => 'blog_section',
            'default'  => true,
            'priority' => 10,
        ]
    );


    // blog_section Blog BTN text 
    new \Kirki\Field\Text(
        [
            'settings' => 'edufax_blog_btn',
            'label'    => esc_html__('Blog Button Text', 'edufax'),
            'section'  => 'blog_section',
            'default'  => "Read More",
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'edufax_blog_single_social',
            'label'    => esc_html__('Single Blog Social Share', 'edufax'),
            'section'  => 'blog_section',
            'default'  => false,
            'priority' => 10,
        ]
    );
}
blog_section();


// 404 section
function error_404_section()
{
    // 404_section section 
    new \Kirki\Section(
        'error_404_section',
        [
            'title'       => esc_html__('404 Page', 'edufax'),
            'description' => esc_html__('404 Page Settings.', 'edufax'),
            'panel'       => 'panel_id',
            'priority'    => 150,
        ]
    );

    new \Kirki\Field\Image(
        [
            'settings'    => 'edufax_error_thumb',
            'label'       => esc_html__('Error Image', 'edufax'),
            'description' => esc_html__('rror Image Here', 'edufax'),
            'section'     => 'error_404_section',
            'default'     => get_template_directory_uri() . '/assets/img/error/error.png',
        ]
    );

    // 404_section 
    new \Kirki\Field\Text(
        [
            'settings' => 'edufax_error_title',
            'label'    => esc_html__('Not Found Title', 'edufax'),
            'section'  => 'error_404_section',
            'default'  => "Oops! Page not found",
            'priority' => 10,
        ]
    );

    // 404_section description
    new \Kirki\Field\Textarea(
        [
            'settings' => 'edufax_error_desc',
            'label'    => esc_html__('Not Found description', 'edufax'),
            'section'  => 'error_404_section',
            'default'  => "Whoops, this is embarassing. Looks like the page you were looking for was not found.",
            'priority' => 10,
        ]
    );

    // 404_section description
    new \Kirki\Field\Text(
        [
            'settings' => 'edufax_error_link_text',
            'label'    => esc_html__('Error Link Text', 'edufax'),
            'section'  => 'error_404_section',
            'default'  => "Back To Home",
            'priority' => 10,
        ]
    );
}
error_404_section();
