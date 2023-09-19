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
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'enable_bottom_menu',
            'label'       => esc_html__('Enable Bottom Menu Switch', 'edufax'),
            'description' => esc_html__('Enable Bottom Menu On/Off', 'edufax'),
            'section'     => 'header_top_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__('Enable', 'edufax'),
                'off' => esc_html__('Disable', 'edufax'),
            ],
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'edufax_header_lang',
            'label'       => esc_html__('Header Language Switch', 'edufax'),
            'description' => esc_html__('Header Language On/Off', 'edufax'),
            'section'     => 'header_top_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__('Enable', 'edufax'),
                'off' => esc_html__('Disable', 'edufax'),
            ],
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'edufax_header_currency',
            'label'       => esc_html__('Header Currency Switch', 'edufax'),
            'description' => esc_html__('Header Currency On/Off', 'edufax'),
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
            'settings' => 'edufax_multicurrency_shortcode',
            'label'    => esc_html__('Multi Currency Shortcode', 'edufax'),
            'section'  => 'header_top_section',
            'default'  => esc_html__('[your_short_code]', 'edufax'),
            'priority' => 10,
            'active_callback' => [
                [
                    'setting'  => 'edufax_header_currency',
                    'operator' => '==',
                    'value'    => true,
                ]
            ],
        ]
    );
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'edufax_header_account',
            'label'       => esc_html__('Header Account Switch', 'edufax'),
            'description' => esc_html__('Header Account On/Off', 'edufax'),
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
    new \Kirki\Field\Text(
        [
            'settings' => 'edufax_tel_subtitle',
            'label'    => esc_html__('Phone Subtitle', 'edufax'),
            'section'  => 'header_top_section',
            'default'  => esc_html__('Hotline: ', 'edufax'),
            'priority' => 10,
        ]
    );
    new \Kirki\Field\Text(
        [
            'settings' => 'edufax_tel_text',
            'label'    => esc_html__('Phone Number', 'edufax'),
            'section'  => 'header_top_section',
            'default'  => esc_html__('+(402) 763 282 46 ', 'edufax'),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'edufax_tel_link',
            'label'    => esc_html__('Phone Number URL', 'edufax'),
            'section'  => 'header_top_section',
            'default'  => esc_html__('402-763-282-46 ', 'edufax'),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'edufax_fb_text',
            'label'    => esc_html__('Facebook Text', 'edufax'),
            'section'  => 'header_top_section',
            'default'  => esc_html__('7500k Followers ', 'edufax'),
            'priority' => 10,
        ]
    );
    new \Kirki\Field\Text(
        [
            'settings' => 'edufax_fb_link',
            'label'    => esc_html__('Facebook Link', 'edufax'),
            'section'  => 'header_top_section',
            'default'  => esc_html__('mybook.com', 'edufax'),
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
            'settings'    => 'edufax_header_elementor_switch',
            'label'       => esc_html__('Header Custom/Elementor Switch', 'edufax'),
            'description' => esc_html__('Header Custom/Elementor On/Off', 'edufax'),
            'section'     => 'header_main_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__('Enable', 'edufax'),
                'off' => esc_html__('Disable', 'edufax'),
            ],
        ]
    );

    new \Kirki\Field\Radio_Image(
        [
            'settings'    => 'header_layout_custom',
            'label'       => esc_html__('Chose Header Style', 'edufax'),
            'section'     => 'header_main_section',
            'priority'    => 10,
            'choices'     => [
                'header_1'   => get_template_directory_uri() . '/inc/img/header/header-1.png',
                'header_2' => get_template_directory_uri() . '/inc/img/header/header-2.png',
                'header_3'  => get_template_directory_uri() . '/inc/img/header/header-3.png',
                'header_4'  => get_template_directory_uri() . '/inc/img/header/header-4.png',
                'header_5'  => get_template_directory_uri() . '/inc/img/header/header-5.png',
                'header_6'  => get_template_directory_uri() . '/inc/img/header/header-6.png',
            ],
            'default'     => 'header_1',
            'active_callback' => [
                [
                    'setting' => 'edufax_header_elementor_switch',
                    'operator' => '==',
                    'value' => false
                ]
            ]
        ]
    );

    $header_posttype = array(
        'post_type'      => 'tp-header',
        'posts_per_page' => -1,
    );
    $header_posttype_loop = get_posts($header_posttype);

    $header_post_obj_arr = array();
    foreach ($header_posttype_loop as $post) {
        $header_post_obj_arr[$post->ID] = $post->post_title;
    }


    wp_reset_query();


    new \Kirki\Field\Select(
        [
            'settings'    => 'edufax_header_templates',
            'label'       => esc_html__('Elementor Header Template', 'edufax'),
            'section'     => 'header_main_section',
            'placeholder' => esc_html__('Choose an option', 'edufax'),
            'choices'     => $header_post_obj_arr,
            'active_callback' => [
                [
                    'setting' => 'edufax_header_elementor_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

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
            'settings'    => 'edufax_header_hamburger',
            'label'       => esc_html__('Header Hamburger Switch', 'edufax'),
            'description' => esc_html__('Header Hamburger On/Off', 'edufax'),
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
            'settings'    => 'edufax_header_category',
            'label'       => esc_html__('Header Category Switch', 'edufax'),
            'description' => esc_html__('Header Category On/Off', 'edufax'),
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
            'settings'    => 'edufax_header_compare',
            'label'       => esc_html__('Header Compare Switch', 'edufax'),
            'description' => esc_html__('Header Compare On/Off', 'edufax'),
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
            'settings'    => 'edufax_header_wishlist',
            'label'       => esc_html__('Header Wishlist Switch', 'edufax'),
            'description' => esc_html__('Header Wishlist On/Off', 'edufax'),
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
            'settings'    => 'edufax_header_cart',
            'label'       => esc_html__('Header Cart Switch', 'edufax'),
            'description' => esc_html__('Header Cart On/Off', 'edufax'),
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
            'label'       => esc_html__('Preloader Switch', 'edufax'),
            'description' => esc_html__('Preloader On/Off', 'edufax'),
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

// shop_section
function shop_settings()
{

    new \Kirki\Section(
        'shop_settings',
        [
            'title'       => esc_html__('Shop Settings', 'edufax'),
            'description' => esc_html__('Shop Settings', 'edufax'),
            'panel'       => 'panel_id',
            'priority'    => 101,
        ]
    );

    new \Kirki\Field\Select(
        [
            'settings'    => 'shop_layout',
            'label'       => esc_html__('Shop Layout', 'edufax'),
            'section'     => 'shop_settings',
            'default'     => 'default',
            'placeholder' => esc_html__('Choose an option', 'edufax'),
            'choices'     => [
                'default' => esc_html__('Default', 'edufax'),
                'right_sidebar' => esc_html__('Right Sidebar', 'edufax'),
                'left_sidebar' => esc_html__('Left Sidebar', 'edufax'),
                'no_sidebar' => esc_html__('No Sidebar', 'edufax'),
                'full' => esc_html__('Full Layout', 'edufax'),
                '1600px' => esc_html__('1600px Layout', 'edufax'),
            ],
        ]
    );

    new \Kirki\Field\Select(
        [
            'settings'    => 'shop_grid_layout',
            'label'       => esc_html__('Shop Grid Layout', 'edufax'),
            'section'     => 'shop_settings',
            'default'     => 'default',
            'placeholder' => esc_html__('Choose an option', 'edufax'),
            'choices'     => [
                'default' => esc_html__('Default', 'edufax'),
                '2' => esc_html__('Layout 2', 'edufax'),
                '3' => esc_html__('Layout 3', 'edufax'),
                '4' => esc_html__('Layout 4', 'edufax'),
                '5' => esc_html__('Layout 5', 'edufax'),
                '6' => esc_html__('Layout 6', 'edufax'),
            ],
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'edufax_product_sale_countdown_switch',
            'label'       => esc_html__('Enable Countdown', 'edufax'),
            'section'     => 'shop_settings',
            'default'     => 'on',
            'placeholder' => esc_html__('Choose an option', 'edufax'),
            'choices'     => [
                'on'  => esc_html__('Enable', 'edufax'),
                'off' => esc_html__('Disable', 'edufax'),
            ],
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'enable_trending_badge',
            'label'       => esc_html__('Enable Trending Badge', 'edufax'),
            'section'     => 'shop_settings',
            'default'     => 'off',
            'placeholder' => esc_html__('Choose an option', 'edufax'),
            'choices'     => [
                'on'  => esc_html__('Enable', 'edufax'),
                'off' => esc_html__('Disable', 'edufax'),
            ],
        ]
    );

    // badge settings
    new \Kirki\Field\Select(
        [
            'settings'    => 'trending_badge_showing_condition',
            'label'       => esc_html__('Trending Badge Showing', 'edufax'),
            'section'     => 'shop_settings',
            'default'     => 'sales',
            'placeholder' => esc_html__('Choose an option', 'edufax'),
            'choices'     => [
                'sales' => esc_html__('Based On Sales', 'edufax'),
                'rating' => esc_html__('Based On Rating', 'edufax'),
                'review' => esc_html__('Based On Review', 'edufax'),
                'views' => esc_html__('Based On Views', 'edufax'),
            ],
            'active_callback' => [
                [
                    'setting' => 'enable_trending_badge',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'sale_count_to_show',
            'label'    => esc_html__('Sales Count', 'edufax'),
            'section'  => 'shop_settings',
            'default'  => esc_html__('2', 'edufax'),
            'description' => esc_html__('How many sales are need to show this badge', 'edufax'),
            'priority' => 10,
            'active_callback' => [
                [
                    'setting' => 'trending_badge_showing_condition',
                    'operator' => '==',
                    'value' => 'sales'
                ],
                [
                    'setting' => 'enable_trending_badge',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );
    new \Kirki\Field\Text(
        [
            'settings' => 'rating_count_to_show',
            'label'    => esc_html__('Rating Count', 'edufax'),
            'section'  => 'shop_settings',
            'default'  => esc_html__('4', 'edufax'),
            'description' => esc_html__('How many rating are need to show this badge', 'edufax'),
            'priority' => 10,
            'active_callback' => [
                [
                    'setting' => 'trending_badge_showing_condition',
                    'operator' => '==',
                    'value' => 'rating'
                ],
                [
                    'setting' => 'enable_trending_badge',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );
    new \Kirki\Field\Text(
        [
            'settings' => 'review_count_to_show',
            'label'    => esc_html__('Review Count', 'edufax'),
            'section'  => 'shop_settings',
            'default'  => esc_html__('3', 'edufax'),
            'description' => esc_html__('How many review are need to show this badge', 'edufax'),
            'priority' => 10,
            'active_callback' => [
                [
                    'setting' => 'trending_badge_showing_condition',
                    'operator' => '==',
                    'value' => 'review'
                ],
                [
                    'setting' => 'enable_trending_badge',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );
    new \Kirki\Field\Text(
        [
            'settings' => 'view_count_to_show',
            'label'    => esc_html__('View Count', 'edufax'),
            'section'  => 'shop_settings',
            'default'  => esc_html__('5', 'edufax'),
            'description' => esc_html__('How many views are need to show this badge', 'edufax'),
            'priority' => 10,
            'active_callback' => [
                [
                    'setting' => 'trending_badge_showing_condition',
                    'operator' => '==',
                    'value' => 'views'
                ],
                [
                    'setting' => 'enable_trending_badge',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'enable_hot_badge',
            'label'       => esc_html__('Enable Hot Badge', 'edufax'),
            'section'     => 'shop_settings',
            'default'     => 'off',
            'placeholder' => esc_html__('Choose an option', 'edufax'),
            'choices'     => [
                'on'  => esc_html__('Enable', 'edufax'),
                'off' => esc_html__('Disable', 'edufax'),
            ],
        ]
    );


    new \Kirki\Field\Text(
        [
            'settings' => 'date_diff_to_show',
            'label'    => esc_html__('Date Differcence Count', 'edufax'),
            'section'  => 'shop_settings',
            'default'  => esc_html__('10', 'edufax'),
            'description' => esc_html__('How many days are showing this badge from upload date', 'edufax'),
            'priority' => 10,
            'active_callback' => [
                [
                    'setting' => 'enable_hot_badge',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );
}
shop_settings();

function shop_single_settinges()
{
    new \Kirki\Section(
        'shop_single_settinges',
        [
            'title'       => esc_html__('Product Single', 'edufax'),
            'description' => esc_html__('Product Single Settings.', 'edufax'),
            'panel'       => 'panel_id',
            'priority'    => 102,
        ]
    );

    new \Kirki\Field\Select(
        [
            'settings'    => 'shop_single_layout',
            'label'       => esc_html__('Product Signle Layout', 'edufax'),
            'section'     => 'shop_single_settinges',
            'default'     => 'default',
            'placeholder' => esc_html__('Choose an option', 'edufax'),
            'choices'     => [
                'default' => esc_html__('Default', 'edufax'),
                'list' => esc_html__('List View', 'edufax'),
                'grid' => esc_html__('Grid View', 'edufax'),
                'vertical' => esc_html__('Vertical Tab View', 'edufax'),
                'carousel' => esc_html__('Carousel View', 'edufax'),
            ],
        ]
    );

    // category switch
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'edufax_product_single_category_switch',
            'label'       => esc_html__('Category Switch', 'edufax'),
            'description' => esc_html__('Category On/Off', 'edufax'),
            'section'     => 'shop_single_settinges',
            'default'     => 'on',
            'choices'     => [
                'on'  => esc_html__('Enable', 'edufax'),
                'off' => esc_html__('Disable', 'edufax'),
            ],

        ]
    );

    // category switch
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'edufax_product_single_buy_now_switch',
            'label'       => esc_html__('Buy Now Button Switch', 'edufax'),
            'description' => esc_html__('Buy Now On/Off', 'edufax'),
            'section'     => 'shop_single_settinges',
            'default'     => 'on',
            'choices'     => [
                'on'  => esc_html__('Enable', 'edufax'),
                'off' => esc_html__('Disable', 'edufax'),
            ],

        ]
    );

    // Stock switch
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'edufax_product_single_in_stock_switch',
            'label'       => esc_html__('Stock Switch', 'edufax'),
            'description' => esc_html__('Stock On/Off', 'edufax'),
            'section'     => 'shop_single_settinges',
            'default'     => 'on',
            'choices'     => [
                'on'  => esc_html__('Enable', 'edufax'),
                'off' => esc_html__('Disable', 'edufax'),
            ],

        ]
    );

    // flash sale switch
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'edufax_product_single_flash_sale_switch',
            'label'       => esc_html__('Flash Sale Switch', 'edufax'),
            'description' => esc_html__('Flash Sale On/Off', 'edufax'),
            'section'     => 'shop_single_settinges',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__('Enable', 'edufax'),
                'off' => esc_html__('Disable', 'edufax'),
            ],

        ]
    );
    // sale text
    new \Kirki\Field\Text(
        [
            'settings' => 'edufax_product_single_flash_sale_text',
            'label'    => esc_html__('Sale Text', 'edufax'),
            'section'  => 'shop_single_settinges',
            'default'  => esc_html__('Flash Sale end in: ', 'edufax'),
            'priority' => 10,
            'active_callback' => [
                [
                    'setting' => 'edufax_product_single_flash_sale_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    // Stock Left switch
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'edufax_product_single_stock_left_switch',
            'label'       => esc_html__('Stock Left Switch', 'edufax'),
            'description' => esc_html__('Stock Left On/Off', 'edufax'),
            'section'     => 'shop_single_settinges',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__('Enable', 'edufax'),
                'off' => esc_html__('Disable', 'edufax'),
            ],

        ]
    );
    // sale text
    new \Kirki\Field\Text(
        [
            'settings' => 'edufax_product_single_stock_left_count',
            'label'    => esc_html__('Stock Left Text', 'edufax'),
            'description' => esc_html__('How many items are left when you want to show it', 'edufax'),
            'default'  => esc_html__('49', 'edufax'),
            'section'  => 'shop_single_settinges',
            'priority' => 10,
            'active_callback' => [
                [
                    'setting' => 'edufax_product_single_stock_left_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    // Compare Hide switch
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'edufax_product_single_compare_switch',
            'label'       => esc_html__('Compare Switch', 'edufax'),
            'description' => esc_html__('Compare On/Off', 'edufax'),
            'section'     => 'shop_single_settinges',
            'default'     => 'on',
            'choices'     => [
                'on'  => esc_html__('Enable', 'edufax'),
                'off' => esc_html__('Disable', 'edufax'),
            ],

        ]
    );

    // Wishlist Hide switch
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'edufax_product_single_wishlist_switch',
            'label'       => esc_html__('Wishlist Switch', 'edufax'),
            'description' => esc_html__('Wishlist On/Off', 'edufax'),
            'section'     => 'shop_single_settinges',
            'default'     => 'on',
            'choices'     => [
                'on'  => esc_html__('Enable', 'edufax'),
                'off' => esc_html__('Disable', 'edufax'),
            ],

        ]
    );

    // sku Hide switch
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'edufax_product_single_sku_switch',
            'label'       => esc_html__('SKU Switch', 'edufax'),
            'description' => esc_html__('SKU On/Off', 'edufax'),
            'section'     => 'shop_single_settinges',
            'default'     => 'on',
            'choices'     => [
                'on'  => esc_html__('Enable', 'edufax'),
                'off' => esc_html__('Disable', 'edufax'),
            ],

        ]
    );

    // Categories switch
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'edufax_product_single_categories_switch',
            'label'       => esc_html__('Categories Switch', 'edufax'),
            'description' => esc_html__('Categories On/Off', 'edufax'),
            'section'     => 'shop_single_settinges',
            'default'     => 'on',
            'choices'     => [
                'on'  => esc_html__('Enable', 'edufax'),
                'off' => esc_html__('Disable', 'edufax'),
            ],

        ]
    );

    // Tags switch
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'edufax_product_single_tags_switch',
            'label'       => esc_html__('Tags Switch', 'edufax'),
            'description' => esc_html__('Tags On/Off', 'edufax'),
            'section'     => 'shop_single_settinges',
            'default'     => 'on',
            'choices'     => [
                'on'  => esc_html__('Enable', 'edufax'),
                'off' => esc_html__('Disable', 'edufax'),
            ],

        ]
    );

    // Social switch
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'edufax_product_single_social_switch',
            'label'       => esc_html__('Social Switch', 'edufax'),
            'description' => esc_html__('Social On/Off', 'edufax'),
            'section'     => 'shop_single_settinges',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__('Enable', 'edufax'),
                'off' => esc_html__('Disable', 'edufax'),
            ],

        ]
    );


    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'edufax_product_single_payment_switch',
            'label'       => esc_html__('Payment Info Switch', 'edufax'),
            'description' => esc_html__('Payment Info On/Off', 'edufax'),
            'section'     => 'shop_single_settinges',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__('Enable', 'edufax'),
                'off' => esc_html__('Disable', 'edufax'),
            ],

        ]
    );

    // product single payment text
    new \Kirki\Field\Text(
        [
            'settings' => 'edufax_product_single_payment_text',
            'label'    => esc_html__('Payment Text', 'edufax'),
            'section'  => 'shop_single_settinges',
            'default'  => esc_html__('Guaranteed safe & secure checkout', 'edufax'),
            'priority' => 10,
            'active_callback' => [
                [
                    'setting' => 'edufax_product_single_payment_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    // product single payment
    new \Kirki\Field\Image(
        [
            'settings'    => 'edufax_product_single_payment_img',
            'label'       => esc_html__('Payment Image', 'edufax'),
            'description' => esc_html__('Payment Image add/remove', 'edufax'),
            'section'     => 'shop_single_settinges',
            'active_callback' => [
                [
                    'setting' => 'edufax_product_single_payment_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );
}
shop_single_settinges();


function free_shipping_settings()
{
    new \Kirki\Section(
        'free_shipping_settings',
        [
            'title'       => esc_html__('Free Shipping Settings', 'edufax'),
            'description' => esc_html__('Free Shipping Settings.', 'edufax'),
            'panel'       => 'panel_id',
            'priority'    => 102,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'enable_free_shipping_bar',
            'label'       => esc_html__('Shipping Bar Switch', 'edufax'),
            'description' => esc_html__('Shipping Bar On/Off', 'edufax'),
            'section'     => 'free_shipping_settings',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__('Enable', 'edufax'),
                'off' => esc_html__('Disable', 'edufax'),
            ],
        ]
    );


    new \Kirki\Field\Text(
        [
            'settings' => 'shipping_progress_bar_amount',
            'label' => esc_attr__('Goal Amount', 'edufax'),
            'description' => esc_attr__('Amount to reach 100% defined in your currency absolute value. For example: 300', 'edufax'),
            'section'  => 'free_shipping_settings',
            'default'  => '100',
            'priority' => 10,
            'active_callback' => [
                [
                    'setting' => 'enable_free_shipping_bar',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );


    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'shipping_progress_bar_location_mini_cart',
            'label'       => esc_html__('Cartmini Switch', 'edufax'),
            'description' => esc_html__('Enable For Cartmini', 'edufax'),
            'section'     => 'free_shipping_settings',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__('Enable', 'edufax'),
                'off' => esc_html__('Disable', 'edufax'),
            ],
            'active_callback' => [
                [
                    'setting' => 'enable_free_shipping_bar',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'shipping_progress_bar_location_card_page',
            'label'       => esc_html__('Cart Page Switch', 'edufax'),
            'description' => esc_html__('Enable For Cart Page', 'edufax'),
            'section'     => 'free_shipping_settings',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__('Enable', 'edufax'),
                'off' => esc_html__('Disable', 'edufax'),
            ],
            'active_callback' => [
                [
                    'setting' => 'enable_free_shipping_bar',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'shipping_progress_bar_location_checkout',
            'label'       => esc_html__('Checkout Page Switch', 'edufax'),
            'description' => esc_html__('Enable For Checkout Page', 'edufax'),
            'section'     => 'free_shipping_settings',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__('Enable', 'edufax'),
                'off' => esc_html__('Disable', 'edufax'),
            ],
            'active_callback' => [
                [
                    'setting' => 'enable_free_shipping_bar',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    new \Kirki\Field\Textarea(
        [
            'settings' => 'shipping_progress_bar_message_initial',
            'label'    => esc_html__('Initial Message', 'edufax'),
            'section'  => 'free_shipping_settings',
            'default' => 'Add [remainder] to cart and get free shipping!',
            'description' => esc_attr__('Message to show before reaching the goal. Use shortcode [remainder] to display the amount left to reach the minimum.', 'edufax'),
            'priority' => 10,
            'active_callback' => [
                [
                    'setting' => 'enable_free_shipping_bar',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );
    new \Kirki\Field\Textarea(
        [
            'settings' => 'shipping_progress_bar_message_success',
            'label'    => esc_html__('Success message', 'edufax'),
            'section'  => 'free_shipping_settings',
            'default' => 'Your order qualifies for free shipping!',
            'description' => esc_attr__('Message to show after reaching 100%.', 'edufax'),
            'priority' => 10,
            'active_callback' => [
                [
                    'setting' => 'enable_free_shipping_bar',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );
}
free_shipping_settings();


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
            'default'     => get_template_directory_uri() . '/assets/img/logo/logo.svg',
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
    new \Kirki\Field\Typography(
        [
            'settings'    => 'breadcrumb_typography',
            'label'       => esc_html__('Typography Control', 'edufax'),
            'description' => esc_html__('The full set of options.', 'edufax'),
            'section'     => 'header_breadcrumb_section',
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
