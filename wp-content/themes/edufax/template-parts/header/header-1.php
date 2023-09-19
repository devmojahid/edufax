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
$edufax_menu_col           = $header_right_switch ? 'col-xl-5 d-none d-xl-block' : 'col-xl-10 col-lg-7 col-md-7 col-sm-8 col-6 d-none d-xl-block';
$edufax_menu_align           = $header_right_switch ? '' : 'justify-content-end';

// woocommerce controls
$edufax_header_wishlist = get_theme_mod('edufax_header_wishlist', false);
$edufax_header_cart     = get_theme_mod('edufax_header_cart', false);
// Sign up controls
$edufax_header_sign_up  = get_theme_mod('edufax_header_sign_up', false);
$edufax_header_sign_up_text  = get_theme_mod('edufax_header_sign_up_text', __('Sign Up', 'edufax'));
$edufax_header_sign_up_link  = get_theme_mod('edufax_header_sign_up_link', __('#', 'edufax'));


$edufax_multicurrency_shortcode = get_theme_mod('edufax_multicurrency_shortcode', __('[shortcode here]', 'edufax'));
?>

<header>
   <!--==============================
        MENU START
    ===============================-->
   <nav class="navbar navbar-expand-lg tf__main_menu">
      <div class="container">
         <?php edufax_header_logo(); ?>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="far fa-bars menu_bar_icon"></i>
            <i class="far fa-times menu_close_icon"></i>
         </button>
         <div class="collapse navbar-collapse" id="navbarNav">
            <?php edufax_header_menu(); ?>
            <?php if ($header_right_switch) : ?>
               <ul class="tf__right_menu d-flex flex-wrap">
                  <li><a class="menu_search_icon"><i class="far fa-search"></i></a></li>
                  <?php if ($edufax_header_sign_up) : ?>
                     <li><a class="signin" href="<?php echo esc_attr($edufax_header_sign_up_link); ?>"><?php echo esc_html($edufax_header_sign_up_text); ?></a></li>
                  <?php endif; ?>
               </ul>
            <?php endif; ?>
         </div>
      </div>
   </nav>
   <div class="menu_search">
      <form action="<?php print esc_url(home_url('/')); ?>">
         <input type="text" placeholder="<?php print esc_attr__('Search', 'edufax'); ?>" name="s" value="<?php print esc_attr(get_search_query()) ?>">
         <button class="tf__common_btn" type="submit"><i class="far fa-search"></i> <?php echo esc_html__('Search ', 'edufax'); ?></button>
         <span class="close_search"><i class="far fa-times"></i></span>
      </form>
   </div>
   <!--==============================
        MENU END
    ===============================-->
</header>