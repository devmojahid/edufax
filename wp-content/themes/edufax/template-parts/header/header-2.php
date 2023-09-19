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
$edufax_header_category = get_theme_mod('edufax_header_category', false);

$edufax_header_category_is_enable = !empty($edufax_header_category) ? 'col-xl-6 col-lg-6' : 'col-xl-9 col-lg-9';

$edufax_welcome_text   = get_theme_mod('edufax_welcome_text', __('FREE Express Shipping On Orders $570+', 'edufax'));

$edufax_fb_link    = get_theme_mod('edufax_fb_link', __('info@edufax.com', 'edufax'));
$edufax_fb_text    = get_theme_mod('edufax_fb_text', __('7500k Followers ', 'edufax'));

$edufax_tel_subtitle   = get_theme_mod('edufax_tel_subtitle', __('Hotline', 'edufax'));
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

$edufax_multicurrency_shortcode = get_theme_mod('edufax_multicurrency_shortcode', __('[shortcode here]', 'edufax'));
?>

<!-- header area start -->
<header>
   <div class="tp-header-area">
      <?php if (!empty($edufax_topbar_switch)) : ?>
         <!-- header top start  -->
         <div class="tp-header-top black-bg p-relative z-index-1 d-none d-md-block">
            <div class="container">
               <div class="row align-items-center">
                  <div class="col-md-6">
                     <?php if (!empty($edufax_welcome_text)) : ?>
                        <div class="tp-header-welcome d-flex align-items-center">
                           <span>
                              <svg width="22" height="19" viewBox="0 0 22 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M14.6364 1H1V12.8182H14.6364V1Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                 <path d="M14.6364 5.54545H18.2727L21 8.27273V12.8182H14.6364V5.54545Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                 <path d="M5.0909 17.3636C6.3461 17.3636 7.36363 16.3461 7.36363 15.0909C7.36363 13.8357 6.3461 12.8182 5.0909 12.8182C3.83571 12.8182 2.81818 13.8357 2.81818 15.0909C2.81818 16.3461 3.83571 17.3636 5.0909 17.3636Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                 <path d="M16.9091 17.3636C18.1643 17.3636 19.1818 16.3461 19.1818 15.0909C19.1818 13.8357 18.1643 12.8182 16.9091 12.8182C15.6539 12.8182 14.6364 13.8357 14.6364 15.0909C14.6364 16.3461 15.6539 17.3636 16.9091 17.3636Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                              </svg>
                           </span>
                           <p><?php echo esc_html($edufax_welcome_text); ?></p>
                        </div>
                     <?php endif; ?>
                  </div>
                  <div class="col-md-6">
                     <div class="tp-header-top-right d-flex align-items-center justify-content-end">
                        <div class="tp-header-top-menu d-flex align-items-center justify-content-end">

                           <?php if (!empty($edufax_header_lang)) : ?>
                              <?php edufax_header_lang_defualt(); ?>
                           <?php endif; ?>


                           <?php if (!empty($edufax_header_currency)) : ?>
                              <div class="tp-header-top-menu-item tp-header-currency">
                                 <?php if (!empty($edufax_multicurrency_shortcode)) : ?>
                                    <?php echo do_shortcode("$edufax_multicurrency_shortcode"); ?>

                                 <?php else : ?>
                                    <select>
                                       <option><?php echo esc_html__('USD', 'edufax'); ?></option>
                                       <option><?php echo esc_html__('YEAN', 'edufax'); ?></option>
                                       <option><?php echo esc_html__('EURO', 'edufax'); ?></option>
                                    </select>
                                 <?php endif; ?>
                              </div>
                           <?php endif; ?>

                           <?php if (class_exists('WooCommerce') && !empty($edufax_header_account)) : ?>
                              <div class="tp-header-top-menu-item tp-header-setting">
                                 <span class="tp-header-setting-toggle" id="tp-header-setting-toggle"><?php echo esc_html__('Setting', 'edufax'); ?></span>
                                 <ul>
                                    <li>
                                       <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>"><?php echo esc_html__('My Profile', 'edufax'); ?></a>
                                    </li>

                                    <?php
                                    if (class_exists('WPCleverWoosw') && !empty($edufax_header_wishlist)) :

                                       $wishlist_data = new WPCleverWoosw();

                                       $key        = $wishlist_data::get_key();
                                       $products   = $wishlist_data::get_ids($key);
                                       $count      = count($products);
                                    ?>
                                       <li>
                                          <a href="<?php echo esc_url($wishlist_data::get_url($key, true)); ?>"><?php echo esc_html__('Wishlist', 'edufax'); ?></a>
                                       </li>
                                    <?php endif; ?>

                                    <li>
                                       <a href="<?php echo esc_url(wc_get_cart_url()); ?>"><?php echo esc_html__('Cart', 'edufax'); ?></a>
                                    </li>

                                    <?php if (is_user_logged_in()) : ?>
                                       <li>
                                          <a href="<?php echo esc_url(wc_logout_url()); ?>"><?php echo esc_html__('Logout', 'edufax'); ?></a>
                                       </li>
                                    <?php else : ?>
                                       <li>
                                          <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>"><?php echo esc_html__('Login', 'edufax'); ?></a>
                                       </li>
                                    <?php endif; ?>
                                 </ul>
                              </div>
                           <?php endif; ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      <?php endif; ?>

      <!-- header main start -->
      <div id="header-sticky" class="tp-header-main tp-header-sticky tp-header-electronics">
         <div class="container">
            <div class="row align-items-center">
               <div class="col-xl-2 col-lg-2 col-md-4 col-6">
                  <div class="logo">
                     <?php edufax_header_logo(); ?>
                  </div>
               </div>
               <div class="col-xl-6 col-lg-7 d-none d-lg-block">
                  <div class="tp-header-search pl-70">
                     <form name="myform" method="GET" action="<?php echo esc_url(home_url('/shop')); ?>">
                        <div class="tp-header-search-wrapper d-flex align-items-center">
                           <div class="tp-header-search-box">
                              <input placeholder="<?php echo esc_attr__('Search for Products...', 'edufax'); ?>" type="text" name="s" class="searchbox" maxlength="128" value="<?php echo get_search_query(); ?>">
                           </div>
                           <?php if (class_exists('WooCommerce')) : ?>
                              <div class="tp-header-search-category">
                                 <?php
                                 if (isset($_REQUEST['product_cat']) && !empty($_REQUEST['product_cat'])) {
                                    $optsetlect = $_REQUEST['product_cat'];
                                 } else {
                                    $optsetlect = 0;
                                 }
                                 $args = array(
                                    'show_option_all' => esc_html__('All Items', 'edufax'),
                                    'hierarchical' => 1,
                                    'class' => 'cat',
                                    'echo' => 1,
                                    'value_field' => 'slug',
                                    'selected' => $optsetlect
                                 );
                                 $args['taxonomy'] = 'product_cat';
                                 $args['name'] = 'product_cat';
                                 $args['class'] = 'cate-dropdown hidden-xs';
                                 wp_dropdown_categories($args);
                                 ?>
                              </div>
                              <input type="hidden" value="product" name="post_type" class="tp-woo-cat">
                           <?php endif; ?>
                           <div class="tp-header-search-btn">
                              <button type="submit">
                                 <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 17C13.4183 17 17 13.4183 17 9C17 4.58172 13.4183 1 9 1C4.58172 1 1 4.58172 1 9C1 13.4183 4.58172 17 9 17Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M19 19L14.65 14.65" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                 </svg>
                              </button>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
               <div class="col-xl-4 col-lg-3 col-md-8 col-6">
                  <div class="tp-header-main-right d-flex align-items-center justify-content-end">
                     <?php if (!empty($header_right_switch)) : ?>
                        <div class="tp-header-main-right-inner d-flex align-items-center justify-content-end">
                           <?php if (!empty($edufax_header_login) && class_exists('WooCommerce')) : ?>
                              <div class="tp-header-login d-none d-lg-block">
                                 <?php
                                 $author_data = get_the_author_meta('description', get_query_var('author'));
                                 $author_bio_avatar_size = 180;
                                 if (is_user_logged_in()) :

                                 ?>
                                    <a href="<?php echo get_permalink(wc_get_page_id('myaccount')); ?>" class="d-flex align-items-center">
                                       <div class="tp-header-login-icon">
                                          <span>
                                             <?php print get_avatar(get_the_author_meta('user_email'), $author_bio_avatar_size, '', '', ['class' => 'media-object img-circle']); ?>
                                          </span>
                                       </div>

                                       <div class="tp-header-login-content d-none d-xl-block">
                                          <span><?php echo esc_html__('Hello', 'edufax') ?></span>
                                          <h5 class="tp-header-login-title">
                                             <?php $current_user = wp_get_current_user();
                                             echo esc_html($current_user->display_name); ?>
                                          </h5>
                                       </div>
                                    </a>

                                 <?php else : ?>
                                    <a href="<?php echo wp_logout_url(get_permalink(wc_get_page_id('myaccount'))) ?>" class="d-flex align-items-center">
                                       <div class="tp-header-login-icon">
                                          <span>
                                             <svg width="17" height="21" viewBox="0 0 17 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="8.57894" cy="5.77803" r="4.77803" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.00002 17.2014C0.998732 16.8655 1.07385 16.5337 1.2197 16.2311C1.67736 15.3158 2.96798 14.8307 4.03892 14.611C4.81128 14.4462 5.59431 14.336 6.38217 14.2815C7.84084 14.1533 9.30793 14.1533 10.7666 14.2815C11.5544 14.3367 12.3374 14.4468 13.1099 14.611C14.1808 14.8307 15.4714 15.27 15.9291 16.2311C16.2224 16.8479 16.2224 17.564 15.9291 18.1808C15.4714 19.1419 14.1808 19.5812 13.1099 19.7918C12.3384 19.9634 11.5551 20.0766 10.7666 20.1304C9.57937 20.2311 8.38659 20.2494 7.19681 20.1854C6.92221 20.1854 6.65677 20.1854 6.38217 20.1304C5.59663 20.0773 4.81632 19.9641 4.04807 19.7918C2.96798 19.5812 1.68652 19.1419 1.2197 18.1808C1.0746 17.8747 0.999552 17.5401 1.00002 17.2014Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                             </svg>
                                          </span>
                                       </div>
                                       <div class="tp-header-login-content d-none d-xl-block">
                                          <span><?php echo esc_html__('Hello, Sign In', 'edufax') ?></span>
                                          <h5 class="tp-header-login-title"><?php echo esc_html__('Your Account', 'edufax') ?></h5>
                                       </div>
                                    </a>
                                 <?php endif; ?>
                              </div>
                           <?php endif; ?>

                           <?php if ((!empty($edufax_header_compare) || !empty($edufax_header_wishlist) || !empty($edufax_header_cart)) && class_exists('WooCommerce')) : ?>
                              <div class="tp-header-action d-flex align-items-center ml-50">

                                 <?php if (class_exists('WPCleverWoosc') && !empty($edufax_header_compare)) :

                                    $total_compared_product = apply_filters('edufax_woo_compare_filter', '');

                                 ?>
                                    <div class="tp-header-action-item d-none d-lg-block">

                                       <div class="tp-header-woosc-btn-wrapper">
                                          <button class="woosc-btn"></button>
                                          <button type="button" class="tp-header-action-btn tp-header-compare-open-btn">
                                             <svg width="20" height="19" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M14.8396 17.3319V3.71411" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M19.1556 13L15.0778 17.0967L11 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M4.91115 1.00056V14.6183" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M0.833496 5.09667L4.91127 1L8.98905 5.09667" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                             </svg>
                                             <span class="tp-header-action-badge"><?php echo esc_html($total_compared_product); ?></span>
                                          </button>
                                       </div>
                                    </div>

                                 <?php endif; ?>

                                 <?php if (class_exists('WPCleverWoosw') && !empty($edufax_header_wishlist)) :
                                    $wishlist_data = new WPCleverWoosw();

                                    $key        = $wishlist_data::get_key();
                                    $products   = $wishlist_data::get_ids($key);
                                    $count      = count($products);
                                 ?>
                                    <div class="tp-header-action-item d-none d-lg-block">
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
                                    <div class="tp-header-action-item">
                                       <button type="button" class="tp-header-action-btn cartmini-open-btn">
                                          <svg width="21" height="22" viewBox="0 0 21 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <path fill-rule="evenodd" clip-rule="evenodd" d="M6.48626 20.5H14.8341C17.9004 20.5 20.2528 19.3924 19.5847 14.9348L18.8066 8.89359C18.3947 6.66934 16.976 5.81808 15.7311 5.81808H5.55262C4.28946 5.81808 2.95308 6.73341 2.4771 8.89359L1.69907 14.9348C1.13157 18.889 3.4199 20.5 6.48626 20.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                             <path d="M6.34902 5.5984C6.34902 3.21232 8.28331 1.27803 10.6694 1.27803V1.27803C11.8184 1.27316 12.922 1.72619 13.7362 2.53695C14.5504 3.3477 15.0081 4.44939 15.0081 5.5984V5.5984" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                             <path d="M7.70365 10.1018H7.74942" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                             <path d="M13.5343 10.1018H13.5801" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                          </svg>
                                          <span id="tp-cart-item" class="tp-header-action-badge cart__count "><?php echo esc_html(WC()->cart->cart_contents_count); ?></span>
                                       </button>
                                    </div>
                                 <?php endif; ?>

                              </div>
                           <?php endif; ?>
                        </div>
                     <?php endif; ?>

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

      <!-- header bottom start -->
      <div class="tp-header-bottom tp-header-bottom-border d-none d-lg-block">
         <div class="container">
            <div class="tp-mega-menu-wrapper p-relative">
               <div class="row align-items-center">
                  <?php if (!empty($edufax_header_category)) : ?>
                     <div class="col-xl-3 col-lg-3">
                        <div class="tp-header-category tp-category-menu tp-header-category-toggle">
                           <button class="tp-category-menu-btn tp-category-menu-toggle">
                              <span>
                                 <svg width="18" height="14" viewBox="0 0 18 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0 1C0 0.447715 0.447715 0 1 0H15C15.5523 0 16 0.447715 16 1C16 1.55228 15.5523 2 15 2H1C0.447715 2 0 1.55228 0 1ZM0 7C0 6.44772 0.447715 6 1 6H17C17.5523 6 18 6.44772 18 7C18 7.55228 17.5523 8 17 8H1C0.447715 8 0 7.55228 0 7ZM1 12C0.447715 12 0 12.4477 0 13C0 13.5523 0.447715 14 1 14H11C11.5523 14 12 13.5523 12 13C12 12.4477 11.5523 12 11 12H1Z" fill="currentColor" />
                                 </svg>
                              </span>
                              <?php echo esc_html__('All Departments', 'edufax'); ?>
                           </button>
                           <nav class="tp-category-menu-content">
                              <?php edufax_category_menu(); ?>
                           </nav>
                        </div>
                     </div>
                  <?php endif; ?>
                  <div class="<?php echo esc_html($edufax_header_category_is_enable); ?>">
                     <div class="main-menu menu-style-1">
                        <nav class="tp-main-menu-content">
                           <?php edufax_header_menu(); ?>
                        </nav>
                     </div>
                  </div>
                  <div class="col-xl-3 col-lg-3">
                     <div class="tp-header-contact d-flex align-items-center justify-content-end">
                        <div class="tp-header-contact-icon">
                           <span>
                              <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path fill-rule="evenodd" clip-rule="evenodd" d="M1.96977 3.24859C2.26945 2.75144 3.92158 0.946726 5.09889 1.00121C5.45111 1.03137 5.76246 1.24346 6.01544 1.49057H6.01641C6.59631 2.05874 8.26011 4.203 8.35352 4.65442C8.58411 5.76158 7.26378 6.39979 7.66756 7.5157C8.69698 10.0345 10.4707 11.8081 12.9908 12.8365C14.1058 13.2412 14.7441 11.9219 15.8513 12.1515C16.3028 12.2459 18.4482 13.9086 19.0155 14.4894V14.4894C19.2616 14.7414 19.4757 15.0537 19.5049 15.4059C19.5487 16.6463 17.6319 18.3207 17.2583 18.5347C16.3767 19.1661 15.2267 19.1544 13.8246 18.5026C9.91224 16.8749 3.65985 10.7408 2.00188 6.68096C1.3675 5.2868 1.32469 4.12906 1.96977 3.24859Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                 <path d="M12.936 1.23685C16.4432 1.62622 19.2124 4.39253 19.6065 7.89874" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                 <path d="M12.936 4.59337C14.6129 4.92021 15.9231 6.23042 16.2499 7.90726" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                              </svg>
                           </span>
                        </div>
                        <div class="tp-header-contact-content">
                           <?php if (!empty($edufax_tel_subtitle)) : ?>
                              <h5><?php echo esc_html($edufax_tel_subtitle); ?></h5>
                           <?php endif; ?>
                           <p><a href="tel:<?php echo esc_url($edufax_tel_link); ?>"> <?php echo esc_html($edufax_tel_text); ?></a></p>
                        </div>
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