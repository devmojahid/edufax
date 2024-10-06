<?php

/**
 * edufax_scripts description
 * @return [type] [description]
 */
function edufax_scripts()
{

    /**
     * all css files
     */

    wp_enqueue_style('edufax-fonts', edufax_fonts_url(), array(), time());
    if (is_rtl()) {
        wp_enqueue_style('bootstrap-rtl', EDUFAX_THEME_CSS_DIR . 'bootstrap-rtl.min.css', array());
    } else {
        wp_enqueue_style('bootstrap', EDUFAX_THEME_CSS_DIR . 'bootstrap.min.css', array());
    }
    wp_enqueue_style('font-awesome', EDUFAX_THEME_CSS_DIR . 'all.min.css', []);
    wp_enqueue_style('animate', EDUFAX_THEME_CSS_DIR . 'animate.css', []);
    wp_enqueue_style('nice-select', EDUFAX_THEME_CSS_DIR . 'nice-select.css', []);
    wp_enqueue_style('slick', EDUFAX_THEME_CSS_DIR . 'slick.css', []);
    wp_enqueue_style('venobox', EDUFAX_THEME_CSS_DIR . 'venobox.min.css', []);
    wp_enqueue_style('videoPlayer', EDUFAX_THEME_CSS_DIR . 'videoPlayer.min.css', []);
    wp_enqueue_style('spacing', EDUFAX_THEME_CSS_DIR . 'spacing.css', []);
    wp_enqueue_style('edufax-core', EDUFAX_THEME_CSS_DIR . 'edufax-core.css', [], time());
    wp_enqueue_style('responsive', EDUFAX_THEME_CSS_DIR . 'responsive.css', []);
    wp_enqueue_style('edufax-unit', EDUFAX_THEME_CSS_DIR . 'edufax-unit.css', [], time());
    wp_enqueue_style('edufax-custom', EDUFAX_THEME_CSS_DIR . 'edufax-custom.css', []);
    wp_enqueue_style('edufax-style', get_stylesheet_uri());

    // all js
    wp_enqueue_script('bootstrap-bundle', EDUFAX_THEME_JS_DIR . 'bootstrap.bundle.min.js', ['jquery'], '', true);
    wp_enqueue_script('font-awesome', EDUFAX_THEME_JS_DIR . 'font-Awesome.js', ['jquery'], false, true);
    wp_enqueue_script('nice-select', EDUFAX_THEME_JS_DIR . 'jquery.nice-select.min.js', ['jquery'], false, true);
    wp_enqueue_script('slick', EDUFAX_THEME_JS_DIR . 'slick.min.js', ['jquery'], false, true);
    wp_enqueue_script('sticky-sidebar', EDUFAX_THEME_JS_DIR . 'sticky_sidebar.js', ['jquery'], false, true);
    wp_enqueue_script('venobox', EDUFAX_THEME_JS_DIR . 'venobox.min.js', ['jquery'], false, true);
    wp_enqueue_script('wow', EDUFAX_THEME_JS_DIR . 'wow.min.js', ['jquery'], '', true);
    wp_enqueue_script('videoPlayer', EDUFAX_THEME_JS_DIR . 'videoPlayer.min.js', ['jquery'], '', true);
    wp_enqueue_script('edufax-main', EDUFAX_THEME_JS_DIR . 'main.js', ['jquery'], time(), true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'edufax_scripts');

/*
Register Fonts
 */
function edufax_fonts_url()
{
    $font_url = '';

    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ('off' !== _x('on', 'Google font: on or off', 'edufax')) {
        $font_url = 'https://fonts.googleapis.com/css2?' . urlencode('family=Inter:wght@300;400;500;600;700;800;900&family=Open+Sans:wght@300;400;500;600;700;800&display=swap');
    }
    return $font_url;
}