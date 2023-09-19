<?php

/**
 * edufax functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package edufax
 */

if (!function_exists('edufax_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function edufax_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on edufax, use a find and replace
         * to change 'edufax' to the name of your theme in all the template files.
         */
        load_theme_textdomain('edufax', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus([
            'main-menu' => esc_html__('Main Menu', 'edufax'),
            'footer-menu' => esc_html__('Footer Menu', 'edufax'),
        ]);

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ]);

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('edufax_custom_background_args', [
            'default-color' => 'ffffff',
            'default-image' => '',
        ]));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        //Enable custom header
        add_theme_support('custom-header');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support('custom-logo', [
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        ]);

        /**
         * Enable suporrt for Post Formats
         *
         * see: https://codex.wordpress.org/Post_Formats
         */
        add_theme_support('post-formats', [
            'image',
            'audio',
            'video',
            'gallery',
            'quote',
        ]);

        // Add support for Block Styles.
        add_theme_support('wp-block-styles');

        // Add support for full and wide align images.
        add_theme_support('align-wide');

        // Add support for editor styles.
        add_theme_support('editor-styles');

        // Add support for responsive embedded content.
        add_theme_support('responsive-embeds');

        remove_theme_support('widgets-block-editor');

        // Add support for woocommerce.
        add_theme_support('woocommerce');

        // Remove woocommerce defauly styles
        add_filter('woocommerce_enqueue_styles', '__return_false');

        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');

        add_theme_support('woocommerce', array(
            'thumbnail_image_width' => 200,
            'gallery_thumbnail_image_width' => 200,
        ));
    }
endif;
add_action('after_setup_theme', 'edufax_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function edufax_content_width()
{
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters('edufax_content_width', 640);
}
add_action('after_setup_theme', 'edufax_content_width', 0);



/**
 * Enqueue scripts and styles.
 */

define('EDUFAX_THEME_DIR', get_template_directory());
define('EDUFAX_THEME_URI', get_template_directory_uri());
define('EDUFAX_THEME_CSS_DIR', EDUFAX_THEME_URI . '/assets/css/');
define('EDUFAX_THEME_JS_DIR', EDUFAX_THEME_URI . '/assets/js/');
define('EDUFAX_THEME_INC', EDUFAX_THEME_DIR . '/inc/');



// wp_body_open
if (!function_exists('wp_body_open')) {
    function wp_body_open()
    {
        do_action('wp_body_open');
    }
}

/**
 * Implement the Custom Header feature.
 */
require EDUFAX_THEME_INC . 'custom-header.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require EDUFAX_THEME_INC . 'template-functions.php';

/**
 * Custom template helper function for this theme.
 */
require EDUFAX_THEME_INC . 'template-helper.php';

/**
 * initialize kirki customizer class.
 */

if (class_exists('Kirki')) {
    include_once EDUFAX_THEME_INC . 'kirki-customizer.php';
}
include_once EDUFAX_THEME_INC . 'class-edufax-kirki.php';


/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require EDUFAX_THEME_INC . 'jetpack.php';
}


/**
 * include edufax functions file
 */
require_once EDUFAX_THEME_INC . 'class-navwalker.php';
require_once EDUFAX_THEME_INC . 'class-tgm-plugin-activation.php';
require_once EDUFAX_THEME_INC . 'add_plugin.php';
require_once EDUFAX_THEME_INC . '/common/edufax-breadcrumb.php';
require_once EDUFAX_THEME_INC . '/common/edufax-scripts.php';
require_once EDUFAX_THEME_INC . '/common/edufax-widgets.php';
if (class_exists('WooCommerce')) {
    require_once EDUFAX_THEME_INC . '/woocommerce/tp-woocommerce.php';
}
if (function_exists('tpmeta_kick')) {
    require_once EDUFAX_THEME_INC . 'tp-metabox.php';
}

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function edufax_pingback_header()
{
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
    }
}
add_action('wp_head', 'edufax_pingback_header');



// edufax_comment 
if (!function_exists('edufax_comment')) {
    function edufax_comment($comment, $args, $depth)
    {
        $GLOBAL['comment'] = $comment;
        extract($args, EXTR_SKIP);
        $args['reply_text'] = 'Reply';
        $replayClass = 'comment-depth-' . esc_attr($depth);
?>
        <li id="comment-<?php comment_ID(); ?>">
            <div class="comments-box tp-postbox-details-comment-box d-sm-flex align-items-start">
                <div class="tp-postbox-details-comment-thumb">
                    <?php print get_avatar($comment, 102, null, null, ['class' => []]); ?>
                </div>
                <div class="tp-postbox-details-comment-content">
                    <div class="tp-postbox-details-comment-top d-flex justify-content-between align-items-start">
                        <div class="tp-postbox-details-comment-avater">
                            <h4 class="tp-postbox-details-comment-avater-title"><?php print get_comment_author_link(); ?></h4>
                            <span class="tp-postbox-details-avater-meta"><?php comment_time(get_option('date_format')); ?></span>
                        </div>
                        <div class="tp-postbox-details-comment-reply">
                            <?php comment_reply_link(array_merge($args, ['depth' => $depth, 'max_depth' => $args['max_depth']])); ?>
                        </div>
                    </div>

                    <?php comment_text(); ?>

                </div>
            </div>
        </li>
<?php
    }
}


/**
 * shortcode supports for removing extra p, spance etc
 *
 */
add_filter('the_content', 'edufax_shortcode_extra_content_remove');
/**
 * Filters the content to remove any extra paragraph or break tags
 * caused by shortcodes.
 *
 * @since 1.0.0
 *
 * @param string $content  String of HTML content.
 * @return string $content Amended string of HTML content.
 */
function edufax_shortcode_extra_content_remove($content)
{

    $array = [
        '<p>['    => '[',
        ']</p>'   => ']',
        ']<br />' => ']',
    ];
    return strtr($content, $array);
}

// edufax_search_filter_form
if (!function_exists('edufax_search_filter_form')) {
    function edufax_search_filter_form($form)
    {

        $form = sprintf(
            '<div class="sidebar__widget-px salim"><div class="search-px">
                    <form class="sidebar__search p-relative" action="%s" method="get">
                        <div class="tp-sidebar-search-input">
                            <input type="text" value="%s" required name="s" placeholder="%s">
                            <button type="submit">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.11111 15.2222C12.0385 15.2222 15.2222 12.0385 15.2222 8.11111C15.2222 4.18375 12.0385 1 8.11111 1C4.18375 1 1 4.18375 1 8.11111C1 12.0385 4.18375 15.2222 8.11111 15.2222Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M16.9995 17L13.1328 13.1333" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>',
            esc_url(home_url('/')),
            esc_attr(get_search_query()),
            esc_html__('Search', 'edufax')
        );

        return $form;
    }
    add_filter('get_search_form', 'edufax_search_filter_form');
}

add_action('admin_enqueue_scripts', 'edufax_admin_custom_scripts');

function edufax_admin_custom_scripts()
{
    wp_enqueue_media();
    wp_enqueue_style('customizer-style', get_template_directory_uri() . '/inc/css/customizer-style.css', array());
    wp_register_script('edufax-admin-custom', get_template_directory_uri() . '/inc/js/admin_custom.js', ['jquery'], '', true);
    wp_enqueue_script('edufax-admin-custom');
}



add_filter('intermediate_image_sizes_advanced', 'stop_thumbs');
function stop_thumbs($sizes)
{
    return array();
}
