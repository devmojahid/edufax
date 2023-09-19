<?php

/**
 * Template part for displaying header layout one
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package edufax
 */

// header styles

$edufax_transparent_header = get_theme_mod('edufax_transparent_header', false);
$is_transparent_header = function_exists('tpmeta_field') ? tpmeta_field('enable_transparent_header') : NULL;


$edufax_sticky_switch = get_theme_mod('edufax_sticky_switch', false);
$enable_sticky = !empty($edufax_sticky_switch) ? 'header__sticky' : '';



// topbar settings
$edufax_topbar_switch = get_theme_mod('header_topbar_switch', false);
$enable_bottom_menu = get_theme_mod('enable_bottom_menu', false);

$edufax_fb_link    = get_theme_mod('edufax_fb_link', __('info@edufax.com', 'edufax'));
$edufax_fb_text    = get_theme_mod('edufax_fb_text', __('7500k Followers ', 'edufax'));

$edufax_tel_link   = get_theme_mod('edufax_tel_link', __('402763-282-46 ', 'edufax'));
$edufax_tel_text   = get_theme_mod('edufax_tel_text', __('+(402) 763 282 46  ', 'edufax'));

$edufax_header_lang         = get_theme_mod('edufax_header_lang', false);
$edufax_header_currency     = get_theme_mod('edufax_header_currency', false);
$edufax_header_account      = get_theme_mod('edufax_header_account', false);

// main header settings
$edufax_header_search      = get_theme_mod('edufax_header_search', false);
$edufax_header_hamburger   = get_theme_mod('edufax_header_hamburger', false);
$header_right_switch      = get_theme_mod('header_right_switch', false);
$edufax_menu_col           = $header_right_switch ? 'col-xl-5 d-none d-xl-block' : 'col-xl-10 col-lg-7 col-md-7 col-sm-8 col-6';

// woocommerce controls
$edufax_header_compare  = get_theme_mod('edufax_header_compare', false);
$edufax_header_wishlist = get_theme_mod('edufax_header_wishlist', false);
$edufax_header_cart     = get_theme_mod('edufax_header_cart', false);
$edufax_header_login     = get_theme_mod('edufax_header_login', false);

$edufax_menu_col_right  = (!empty($edufax_header_compare) || !empty($edufax_header_wishlist) || !empty($edufax_header_login) || !empty($edufax_header_cart)) && class_exists('WooCommerce') ? 'col-xl-8 col-lg-6 d-none d-xl-block' : 'col-xl-10 col-lg-6 col-md-6 col-sm-7 col-4';

$edufax_multicurrency_shortcode = get_theme_mod('edufax_multicurrency_shortcode', __('[shortcode here]', 'edufax'));
?>

<!-- header area start -->
<header>
    <div id="header-sticky" class="tp-header-area p-relative tp-header-sticky tp-header-height">
        <div class="tp-header-5 pl-25 pr-25 theme-green-bg">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-xl-2 col-lg-6 col-md-6 col-sm-5 col-8">
                        <div class="tp-header-left-5 d-flex align-items-center">
                            <div class="tp-header-hamburger-5 mr-15 d-none d-lg-block">
                                <button class="tp-hamburger-btn-2 tp-hamburger-toggle">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </button>
                            </div>
                            <div class="tp-header-hamburger-5 mr-15 d-lg-none">
                                <button class="tp-hamburger-btn-2 tp-offcanvas-open-btn">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </button>
                            </div>
                            <div class="logo">
                                <?php edufax_header_logo(); ?>
                            </div>
                        </div>
                    </div>

                    <?php if (!empty($header_right_switch)) : ?>
                        <?php if (!empty($edufax_header_search)) : ?>
                            <div class="<?php echo esc_attr($edufax_menu_col_right); ?>">
                                <div class="tp-header-search-5">
                                    <form method="GET" action="<?php echo esc_url(home_url('/shop')); ?>">
                                        <div class="tp-header-search-input-box-5">
                                            <div class="tp-header-search-input-5">
                                                <input placeholder="<?php echo esc_attr__('Search for products (e.g. eggs, milk, potato)', 'edufax'); ?>" type="text" name="s" class="searchbox" maxlength="128" value="<?php echo get_search_query(); ?>">
                                                <span class="tp-header-search-icon-5">
                                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M8.11111 15.2222C12.0385 15.2222 15.2222 12.0385 15.2222 8.11111C15.2222 4.18375 12.0385 1 8.11111 1C4.18375 1 1 4.18375 1 8.11111C1 12.0385 4.18375 15.2222 8.11111 15.2222Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M16.9995 17L13.1328 13.1333" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <button type="submit"><?php echo esc_html__('Search', 'edufax'); ?></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php endif; ?> <!-- search endif here -->

                        <?php if ((!empty($edufax_header_compare) || !empty($edufax_header_wishlist) || !empty($edufax_header_login) || !empty($edufax_header_cart)) && class_exists('WooCommerce')) : ?>
                            <div class="col-xl-2 col-lg-6 col-md-6 col-sm-7 col-4">
                                <div class="tp-header-right-5 d-flex align-items-center justify-content-end">

                                    <?php if (!empty($edufax_header_login) && class_exists('WooCommerce')) : ?>
                                        <div class="tp-header-login-5 d-none d-md-block">
                                            <?php
                                            $author_data = get_the_author_meta('description', get_query_var('author'));
                                            $author_bio_avatar_size = 180;

                                            if (is_user_logged_in()) :
                                            ?>
                                                <a href="<?php echo get_permalink(wc_get_page_id('myaccount')); ?>" class="d-flex align-items-center">
                                                    <div class="tp-header-login-icon-5">
                                                        <span>
                                                            <?php print get_avatar(get_the_author_meta('user_email'), $author_bio_avatar_size, '', '', ['class' => 'media-object img-circle']); ?>
                                                        </span>
                                                    </div>
                                                    <div class="tp-header-login-content-5">
                                                        <p><span><?php echo esc_html__('Hello', 'edufax') ?></span> <br> <?php $current_user = wp_get_current_user();
                                                                                                                            echo esc_html($current_user->display_name); ?></p>
                                                    </div>
                                                </a>
                                            <?php else : ?>
                                                <a href="<?php echo wp_logout_url(get_permalink(wc_get_page_id('myaccount'))) ?>" class="d-flex align-items-center">
                                                    <div class="tp-header-login-icon-5">
                                                        <span>
                                                            <svg width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M8.00029 9C10.2506 9 12.0748 7.20914 12.0748 5C12.0748 2.79086 10.2506 1 8.00029 1C5.75 1 3.92578 2.79086 3.92578 5C3.92578 7.20914 5.75 9 8.00029 9Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                <path d="M15 17C15 13.904 11.8626 11.4 8 11.4C4.13737 11.4 1 13.904 1 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>
                                                        </span>
                                                    </div>
                                                    <div class="tp-header-login-content-5">
                                                        <p><span><?php echo esc_html__('Hello', 'edufax') ?></span> <br><?php echo esc_html__('Register', 'edufax') ?></p>
                                                    </div>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?> <!-- login endif here -->

                                    <div class="tp-header-action-5 d-flex align-items-center ml-20">

                                        <?php if (class_exists('WPCleverWoosw') && !empty($edufax_header_wishlist)) :
                                            $wishlist_data = new WPCleverWoosw();

                                            $key        = $wishlist_data::get_key();
                                            $products   = $wishlist_data::get_ids($key);
                                            $count      = count($products);
                                        ?>
                                            <div class="tp-header-action-item-5 d-none d-sm-block">
                                                <a href="<?php echo esc_url($wishlist_data::get_url($key, true)); ?>">
                                                    <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9.20125 16.0348C11.0291 14.9098 12.7296 13.5858 14.2722 12.0865C15.3567 11.0067 16.1823 9.69033 16.6858 8.23822C17.5919 5.42131 16.5335 2.19649 13.5717 1.24212C12.0151 0.740998 10.315 1.02741 9.00329 2.01177C7.69109 1.02861 5.99161 0.742297 4.43489 1.24212C1.47305 2.19649 0.40709 5.42131 1.31316 8.23822C1.81666 9.69033 2.64228 11.0067 3.72679 12.0865C5.26938 13.5858 6.96983 14.9098 8.79771 16.0348L8.99568 16.1579L9.20125 16.0348Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M5.85156 4.41306C4.95446 4.69963 4.31705 5.50502 4.2374 6.45262" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                    <span class="tp-header-action-badge-5"><?php echo esc_html($count); ?></span>
                                                </a>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (!empty($edufax_header_cart) && class_exists('WooCommerce')) : ?>
                                            <div class="tp-header-action-item-5">
                                                <button type="button" class="cartmini-open-btn">
                                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M5.31165 17H12.6964C15.4091 17 17.4901 16.0781 16.899 12.3676L16.2107 7.33907C15.8463 5.48764 14.5912 4.77907 13.49 4.77907H4.48572C3.36828 4.77907 2.18607 5.54097 1.76501 7.33907L1.07673 12.3676C0.574694 15.659 2.59903 17 5.31165 17Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M5.19048 4.59622C5.19048 2.6101 6.90163 1.00003 9.01244 1.00003V1.00003C10.0289 0.99598 11.0052 1.37307 11.7254 2.04793C12.4457 2.72278 12.8506 3.6398 12.8506 4.59622V4.59622" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M6.38837 8.34478H6.42885" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M11.5466 8.34478H11.5871" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                    <span id="tp-cart-item" class="tp-header-action-badge cart__count"><?php echo esc_html(WC()->cart->cart_contents_count); ?></span>
                                                </button>
                                            </div>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>
                        <?php endif; ?> <!-- action endif here -->

                    <?php endif; ?> <!-- right endif here -->
                </div>
            </div>
        </div>
        <div class="tp-header-side-menu tp-side-menu-5">
            <nav class="tp-category-menu-content">
                <?php edufax_grocery_menu(); ?>
            </nav>
        </div>
    </div>
</header>
<!-- header area end -->

<?php if ($enable_bottom_menu) : ?>
    <?php print edufax_bottom_menu(); ?>
<?php endif; ?>

<?php if (class_exists('WooCommerce')) : ?>
    <?php print edufax_shopping_cart(); ?>
<?php endif; ?>

<?php do_action('edufax_offcanvas_style'); ?>