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

$edufax_multicurrency_shortcode = get_theme_mod('edufax_multicurrency_shortcode', __('[shortcode here]', 'edufax'));
?>

<!-- header area start -->
<header>
   <div id="header-sticky" class="tp-header-area tp-header-style-transparent-white tp-header-transparent tp-header-sticky has-dark-logo tp-header-height">
      <div class="tp-header-bottom-3 pl-35 pr-35">
         <div class="container-fluid">
            <div class="row align-items-center">
               <div class="col-xl-2 col-lg-2 col-6">
                  <div class="logo">
                     <?php edufax_header_double_logo(); ?>
                  </div>
               </div>
               <div class="col-xl-8 col-lg-8 d-none d-lg-block">
                  <div class="main-menu menu-style-3 p-relative d-flex align-items-center justify-content-center">
                     <nav class="tp-main-menu-content">
                        <?php edufax_header_menu(); ?>
                     </nav>
                  </div>
               </div>
               <div class="col-xl-2 col-lg-2 col-6">
                  <div class="tp-header-action d-flex align-items-center justify-content-end ml-50">
                     <?php if (!empty($header_right_switch)) : ?>

                        <?php if (!empty($edufax_header_search)) : ?>
                           <div class="tp-header-action-item d-none d-sm-block">
                              <button type="button" class="tp-header-action-btn tp-search-open-btn">
                                 <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 17C13.4183 17 17 13.4183 17 9C17 4.58172 13.4183 1 9 1C4.58172 1 1 4.58172 1 9C1 13.4183 4.58172 17 9 17Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M18.9999 19L14.6499 14.65" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                 </svg>
                              </button>
                           </div>
                        <?php endif; ?>

                        <?php if ((!empty($edufax_header_wishlist) || !empty($edufax_header_cart)) && class_exists('WooCommerce')) : ?>

                           <?php if (class_exists('WPCleverWoosw') && !empty($edufax_header_wishlist)) :
                              $wishlist_data = new WPCleverWoosw();

                              $key        = $wishlist_data::get_key();
                              $products   = $wishlist_data::get_ids($key);
                              $count      = count($products);
                           ?>
                              <div class="tp-header-action-item d-none d-sm-block">
                                 <a href="<?php echo esc_url($wishlist_data::get_url($key, true)); ?>" class="tp-header-action-btn">
                                    <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M11.239 18.8538C13.4096 17.5179 15.4289 15.9456 17.2607 14.1652C18.5486 12.8829 19.529 11.3198 20.1269 9.59539C21.2029 6.25031 19.9461 2.42083 16.4289 1.28752C14.5804 0.692435 12.5616 1.03255 11.0039 2.20148C9.44567 1.03398 7.42754 0.693978 5.57894 1.28752C2.06175 2.42083 0.795919 6.25031 1.87187 9.59539C2.46978 11.3198 3.45021 12.8829 4.73806 14.1652C6.56988 15.9456 8.58917 17.5179 10.7598 18.8538L10.9949 19L11.239 18.8538Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path d="M7.26062 5.05302C6.19531 5.39332 5.43839 6.34973 5.3438 7.47501" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span class="tp-header-action-badge"><?php echo esc_html($count); ?></span>
                                 </a>
                              </div>
                           <?php endif; ?>

                           <?php if (!empty($edufax_header_cart) && class_exists('WooCommerce')) : ?>
                              <div class="tp-header-action-item d-none d-sm-block">
                                 <button type="button" class="tp-header-action-btn cartmini-open-btn">
                                    <svg width="21" height="22" viewBox="0 0 21 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M6.48626 20.5H14.8341C17.9004 20.5 20.2528 19.3924 19.5847 14.9348L18.8066 8.89359C18.3947 6.66934 16.976 5.81808 15.7311 5.81808H5.55262C4.28946 5.81808 2.95308 6.73341 2.4771 8.89359L1.69907 14.9348C1.13157 18.889 3.4199 20.5 6.48626 20.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path d="M6.34902 5.5984C6.34902 3.21232 8.28331 1.27803 10.6694 1.27803V1.27803C11.8184 1.27316 12.922 1.72619 13.7362 2.53695C14.5504 3.3477 15.0081 4.44939 15.0081 5.5984V5.5984" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path d="M7.70365 10.1018H7.74942" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path d="M13.5343 10.1018H13.5801" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span id="tp-cart-item" class="tp-header-action-badge cart__count"><?php echo esc_html(WC()->cart->cart_contents_count); ?></span>
                                 </button>
                              </div>
                           <?php endif; ?> <!-- item endif here -->

                        <?php endif; ?> <!-- all action endif here -->

                     <?php endif; ?> <!-- right endif here -->

                     <div class="tp-header-action-item d-lg-none">
                        <button type="button" class="tp-header-action-btn tp-offcanvas-open-btn">
                           <svg xmlns="http://www.w3.org/2000/svg" width="30" height="16" viewBox="0 0 30 16">
                              <rect x="10" width="20" height="2" fill="currentColor" />
                              <rect x="5" y="7" width="25" height="2" fill="currentColor" />
                              <rect x="10" y="14" width="20" height="2" fill="currentColor" />
                           </svg>
                        </button>
                     </div>

                  </div>
               </div>
            </div>
         </div>
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