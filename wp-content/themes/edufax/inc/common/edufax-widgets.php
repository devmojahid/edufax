<?php

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function edufax_widgets_init()
{

    $footer_style_2_switch = get_theme_mod('footer_style_2_switch', true);
    $footer_style_3_switch = get_theme_mod('footer_style_3_switch', true);
    $footer_style_4_switch = get_theme_mod('footer_style_4_switch', true);
    $footer_style_5_switch = get_theme_mod('footer_style_5_switch', true);
    $footer_style_6_switch = get_theme_mod('footer_style_6_switch', true);

    /**
     * blog sidebar
     */
    register_sidebar([
        'name'          => esc_html__('Blog Sidebar', 'edufax'),
        'id'            => 'blog-sidebar',
        'description'   => esc_html__('Set Your Blog Widget', 'edufax'),
        'before_widget' => '<div id="%1$s" class="tp-sidebar-widget mb-35 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="tp-sidebar-widget-title">',
        'after_title'   => '</h3>',
    ]);



    /**
     * product sidebar
     */
    register_sidebar([
        'name'          => esc_html__('Product Sidebar', 'edufax'),
        'id'            => 'product-sidebar',
        'description'          => esc_html__('Set Your Product Widget', 'edufax'),
        'before_widget' => '<div id="%1$s" class="tp-shop-widget mb-50 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="tp-shop-widget-title">',
        'after_title'   => '</h3>',
    ]);


    $footer_widgets = get_theme_mod('footer_widget_number', 4);

    // footer default
    for ($num = 1; $num <= $footer_widgets; $num++) {
        register_sidebar([
            'name'          => sprintf(esc_html__('Footer %1$s', 'edufax'), $num),
            'id'            => 'footer-' . $num,
            'description'   => sprintf(esc_html__('Footer column %1$s', 'edufax'), $num),
            'before_widget' => '<div id="%1$s" class="tf__footer_content tp-footer-widget mb-50 footer-col-' . $num . ' %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="tp-footer-widget-title">',
            'after_title'   => '</h3>',
        ]);
    }

    // footer 2
    if ($footer_style_2_switch) {
        for ($num = 1; $num <= $footer_widgets; $num++) {

            register_sidebar([
                'name'          => sprintf(esc_html__('Footer Style 2 : %1$s', 'edufax'), $num),
                'id'            => 'footer-2-' . $num,
                'description'   => sprintf(esc_html__('Footer Style 2 : %1$s', 'edufax'), $num),
                'before_widget' => '<div id="%1$s" class="tp-footer-widget mb-50 footer-col-' . $num . ' footer-col-2-' . $num . ' %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h4 class="tp-footer-widget-title">',
                'after_title'   => '</h4>',
            ]);
        }
    }

    // footer 3
    if ($footer_style_3_switch) {
        for ($num = 1; $num <= $footer_widgets; $num++) {
            register_sidebar([
                'name'          => sprintf(esc_html__('Footer Style 3 : %1$s', 'edufax'), $num),
                'id'            => 'footer-3-' . $num,
                'description'   => sprintf(esc_html__('Footer Style 3 : %1$s', 'edufax'), $num),
                'before_widget' => '<div id="%1$s" class="tp-footer-widget footer-col-' . $num . ' mb-50 footer-col-3-' . $num . ' %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h4 class="tp-footer-widget-title">',
                'after_title'   => '</h4>',
            ]);
        }
    }

    // footer 4
    if ($footer_style_4_switch) {
        for ($num = 1; $num <= $footer_widgets; $num++) {
            register_sidebar([
                'name'          => sprintf(esc_html__('Footer Style 4 : %1$s', 'edufax'), $num),
                'id'            => 'footer-4-' . $num,
                'description'   => sprintf(esc_html__('Footer Style 4 : %1$s', 'edufax'), $num),
                'before_widget' => '<div id="%1$s" class="tp-footer-widget footer-col-' . $num . ' mb-50 footer-col-4-' . $num . ' %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h4 class="tp-footer-widget-title">',
                'after_title'   => '</h4>',
            ]);
        }
    }

    // footer 5
    if ($footer_style_5_switch) {
        for ($num = 1; $num <= $footer_widgets; $num++) {
            register_sidebar([
                'name'          => sprintf(esc_html__('Footer Style 5 : %1$s', 'edufax'), $num),
                'id'            => 'footer-5-' . $num,
                'description'   => sprintf(esc_html__('Footer Style 5 : %1$s', 'edufax'), $num),
                'before_widget' => '<div id="%1$s" class="tp-footer-widget mb-50 footer-col-4-' . $num . ' %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h4 class="tp-footer-widget-title">',
                'after_title'   => '</h4>',
            ]);
        }
    }

    // footer 6
    if ($footer_style_6_switch) {
        for ($num = 1; $num <= $footer_widgets; $num++) {
            register_sidebar([
                'name'          => sprintf(esc_html__('Footer Style 6 : %1$s', 'edufax'), $num),
                'id'            => 'footer-6-' . $num,
                'description'   => sprintf(esc_html__('Footer Style 6 : %1$s', 'edufax'), $num),
                'before_widget' => '<div id="%1$s" class="tp-footer-widget mb-50 footer-col-' . $num . ' %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h4 class="tp-footer-widget-title">',
                'after_title'   => '</h4>',
            ]);
        }
    }
}
add_action('widgets_init', 'edufax_widgets_init');
