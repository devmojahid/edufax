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
   <div class="tp-header-area tp-header-style-darkRed tp-header-height">
      <?php if (!empty($edufax_topbar_switch)) : ?>
         <!-- header top start  -->
         <div class="tp-header-top-2 p-relative z-index-11 tp-header-top-border d-none d-md-block">
            <div class="container">
               <div class="row align-items-center">
                  <div class="col-md-6">
                     <div class="tp-header-info d-flex align-items-center">
                        <?php if (!empty($edufax_fb_link)) : ?>
                           <div class="tp-header-info-item">
                              <a href="<?php echo esc_url($edufax_fb_link); ?>">
                                 <span>
                                    <svg width="8" height="15" viewBox="0 0 8 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M8 0H5.81818C4.85376 0 3.92883 0.383116 3.24688 1.06507C2.56493 1.74702 2.18182 2.67194 2.18182 3.63636V5.81818H0V8.72727H2.18182V14.5455H5.09091V8.72727H7.27273L8 5.81818H5.09091V3.63636C5.09091 3.44348 5.16753 3.25849 5.30392 3.1221C5.44031 2.98571 5.6253 2.90909 5.81818 2.90909H8V0Z" fill="currentColor" />
                                    </svg>
                                 </span> <?php echo esc_html($edufax_fb_text); ?>
                              </a>
                           </div>
                        <?php endif; ?>

                        <?php if (!empty($edufax_tel_link)) : ?>
                           <div class="tp-header-info-item">
                              <a href="tel:<?php echo esc_url($edufax_tel_link); ?>">
                                 <span>
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M1.359 2.73916C1.59079 2.35465 2.86862 0.958795 3.7792 1.00093C4.05162 1.02426 4.29244 1.1883 4.4881 1.37943H4.48885C4.93737 1.81888 6.22423 3.47735 6.29648 3.8265C6.47483 4.68282 5.45362 5.17645 5.76593 6.03954C6.56213 7.98771 7.93402 9.35948 9.88313 10.1549C10.7455 10.4679 11.2392 9.44752 12.0956 9.62511C12.4448 9.6981 14.1042 10.9841 14.5429 11.4333V11.4333C14.7333 11.6282 14.8989 11.8698 14.9214 12.1422C14.9553 13.1016 13.4728 14.3966 13.1838 14.5621C12.502 15.0505 11.6125 15.0415 10.5281 14.5373C7.50206 13.2784 2.66618 8.53401 1.38384 5.39391C0.893174 4.31561 0.860062 3.42016 1.359 2.73916Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path d="M9.84082 1.18318C12.5534 1.48434 14.6952 3.62393 15 6.3358" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path d="M9.84082 3.77927C11.1378 4.03207 12.1511 5.04544 12.4039 6.34239" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                 </span> <?php echo esc_html($edufax_tel_text); ?>
                              </a>
                           </div>
                        <?php endif; ?>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="tp-header-top-right tp-header-top-black d-flex align-items-center justify-content-end">

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

      <!-- header bottom start -->
      <div id="header-sticky" class="tp-header-bottom-2 tp-header-sticky">
         <div class="container">
            <div class="tp-mega-menu-wrapper p-relative">
               <div class="row align-items-center">
                  <div class="col-xl-2 col-lg-5 col-md-5 col-sm-4 col-6">
                     <div class="logo">
                        <?php edufax_header_logo(); ?>
                     </div>
                  </div>
                  <div class="col-xl-5 d-none d-xl-block">
                     <div class="main-menu menu-style-2">
                        <nav class="tp-main-menu-content">
                           <?php edufax_header_menu(); ?>
                        </nav>
                     </div>
                  </div>
                  <div class="col-xl-5 col-lg-7 col-md-7 col-sm-8 col-6">
                     <div class="tp-header-bottom-right d-flex align-items-center justify-content-end">
                        <?php if (!empty($header_right_switch)) : ?>
                           <div class="tp-header-bottom-right-inner d-flex align-items-center justify-content-end pl-30">
                              <?php if (!empty($edufax_header_search)) : ?>
                                 <div class="tp-header-search-2 d-none d-sm-block">
                                    <form action="<?php print esc_url(home_url('/shop')); ?>">
                                       <input type="text" placeholder="<?php print esc_attr__('Search for Products...', 'edufax'); ?>" name="s" value="<?php print esc_attr(get_search_query()) ?>">
                                       <button type="submit">
                                          <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <path d="M9 17C13.4183 17 17 13.4183 17 9C17 4.58172 13.4183 1 9 1C4.58172 1 1 4.58172 1 9C1 13.4183 4.58172 17 9 17Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                             <path d="M18.9999 19L14.6499 14.65" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                          </svg>
                                       </button>
                                    </form>
                                 </div>
                              <?php endif; ?>

                              <?php if ((!empty($edufax_header_compare) || !empty($edufax_header_wishlist) || !empty($edufax_header_cart)) && class_exists('WooCommerce')) : ?>
                                 <div class="tp-header-action d-flex align-items-center ml-30">

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
                                          <button class="tp-header-action-btn cartmini-open-btn">
                                             <svg width="21" height="22" viewBox="0 0 21 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.48626 20.5H14.8341C17.9004 20.5 20.2528 19.3924 19.5847 14.9348L18.8066 8.89359C18.3947 6.66934 16.976 5.81808 15.7311 5.81808H5.55262C4.28946 5.81808 2.95308 6.73341 2.4771 8.89359L1.69907 14.9348C1.13157 18.889 3.4199 20.5 6.48626 20.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M6.34902 5.5984C6.34902 3.21232 8.28331 1.27803 10.6694 1.27803V1.27803C11.8184 1.27316 12.922 1.72619 13.7362 2.53695C14.5504 3.3477 15.0081 4.44939 15.0081 5.5984V5.5984" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M7.70365 10.1018H7.74942" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M13.5343 10.1018H13.5801" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                             </svg>
                                             <span id="tp-cart-item" class="tp-header-action-badge cart__count"><?php echo esc_html(WC()->cart->cart_contents_count); ?></span>
                                          </button>
                                       </div>
                                    <?php endif; ?>
                                 </div>
                              <?php endif; ?>
                           </div>

                           <div class="tp-header-action-item tp-header-hamburger mr-20 d-xl-none">
                              <button type="button" class="tp-offcanvas-open-btn">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="30" height="16" viewBox="0 0 30 16">
                                    <rect x="10" width="20" height="2" fill="currentColor" />
                                    <rect x="5" y="7" width="25" height="2" fill="currentColor" />
                                    <rect x="10" y="14" width="20" height="2" fill="currentColor" />
                                 </svg>
                              </button>
                           </div>
                     </div>
                  </div>
               <?php endif; ?>
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