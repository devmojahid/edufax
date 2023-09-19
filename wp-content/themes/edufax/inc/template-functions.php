<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package edufax
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function edufax_body_classes($classes)
{
    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }
    // Adds a class of no-sidebar when there is no sidebar present.
    if (!is_active_sidebar('sidebar-1')) {
        $classes[] = 'no-sidebar';
    }

    if (!empty($get_user)) {
        $classes[] = 'profile-breadcrumb';
    }

    return $classes;
}
add_filter('body_class', 'edufax_body_classes');

/**
 * Get tags.
 */
function edufax_get_tag()
{
    $html = '';
    if (has_tag()) {
        $html .= '<div class="tagcloud tagcloud-sm"><span>' . esc_html__('Post Tags : ', 'edufax') . '</span>';
        $html .= get_the_tag_list('', ' ', '');
        $html .= '</div>';
    }
    return $html;
}

/**
 * Get categories.
 */
function edufax_get_category()
{

    $categories = get_the_category(get_the_ID());
    $x = 0;
    foreach ($categories as $category) {

        if ($x == 2) {
            break;
        }
        $x++;
        print '<a class="news-tag" href="' . get_category_link($category->term_id) . '">' . $category->cat_name . '</a>';
    }
}

/** img alt-text **/
function edufax_img_alt_text($img_er_id = null)
{
    $image_id = $img_er_id;
    $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', false);
    $image_title = get_the_title($image_id);

    if (!empty($image_id)) {
        if ($image_alt) {
            $alt_text = get_post_meta($image_id, '_wp_attachment_image_alt', false);
        } else {
            $alt_text = get_the_title($image_id);
        }
    } else {
        $alt_text = esc_html__('Image Alt Text', 'edufax');
    }

    return $alt_text;
}

// edufax_ofer_sidebar_func
function edufax_offer_sidebar_func()
{
    if (is_active_sidebar('offer-sidebar')) {

        dynamic_sidebar('offer-sidebar');
    }
}
add_action('edufax_offer_sidebar', 'edufax_offer_sidebar_func', 20);

// edufax_service_sidebar
function edufax_service_sidebar_func()
{
    if (is_active_sidebar('services-sidebar')) {

        dynamic_sidebar('services-sidebar');
    }
}
add_action('edufax_service_sidebar', 'edufax_service_sidebar_func', 20);

// edufax_portfolio_sidebar
function edufax_portfolio_sidebar_func()
{
    if (is_active_sidebar('portfolio-sidebar')) {

        dynamic_sidebar('portfolio-sidebar');
    }
}
add_action('edufax_portfolio_sidebar', 'edufax_portfolio_sidebar_func', 20);

// edufax_faq_sidebar
function edufax_faq_sidebar_func()
{
    if (is_active_sidebar('faq-sidebar')) {

        dynamic_sidebar('faq-sidebar');
    }
}
add_action('edufax_faq_sidebar', 'edufax_faq_sidebar_func', 20);
