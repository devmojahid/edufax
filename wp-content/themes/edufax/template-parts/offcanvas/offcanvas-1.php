<?php

/**
 * Template part for displaying header side information
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package edufax
 */

$edufax_offcanvas_logo = get_theme_mod('edufax_offcanvas_logo', get_template_directory_uri() . '/assets/img/logo/logo.svg');

// offcanvas Default Menu
$edufax_offcanvas_category_menu_switch = get_theme_mod('edufax_offcanvas_category_menu_switch', false);

$get_offcanvas_style = get_theme_mod('edufax_offcanvas_style');


if ($get_offcanvas_style == "dark_brown") {
   $offcanvas_style = 'offcanvas__style-darkRed';
} elseif ($get_offcanvas_style == "brown") {
   $offcanvas_style = 'offcanvas__style-brown';
} elseif ($get_offcanvas_style == "green") {
   $offcanvas_style = 'offcanvas__style-green';
} else {
   $offcanvas_style = 'offcanvas__style-primary';
}


// offcanvas btn
$edufax_offcanvas_btn = get_theme_mod('edufax_offcanvas_btn_text', __('Contact Us', 'edufax'));
$edufax_offcanvas_btn_url = get_theme_mod('edufax_offcanvas_btn_url', __('#', 'edufax'));

$edufax_offcanvas_multicurrency_switch = get_theme_mod('edufax_offcanvas_multicurrency_switch', false);
$edufax_offcanvas_lang = get_theme_mod('edufax_offcanvas_lang_switch', false);

$edufax_offcanvas_multicurrency_shortcode = get_theme_mod('edufax_offcanvas_multicurrency_shortcode', __('[shortcode here]', 'edufax'));
?>

<!-- offcanvas area start -->
<div class="offcanvas__area <?php echo esc_attr($offcanvas_style); ?>">
   <div class="offcanvas__wrapper">
      <div class="offcanvas__close">
         <button class="offcanvas__close-btn offcanvas-close-btn">
            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
               <path d="M11 1L1 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
               <path d="M1 1L11 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
         </button>
      </div>
      <div class="offcanvas__content">
         <?php if (!empty($edufax_offcanvas_logo)) : ?>
            <div class="offcanvas__top mb-70 d-flex justify-content-between align-items-center">
               <div class="offcanvas__logo logo">
                  <a href="<?php print esc_url(home_url('/')); ?>">
                     <img src="<?php print esc_url($edufax_offcanvas_logo); ?>" alt="<?php echo esc_attr__('logo', 'edufax'); ?>">
                  </a>
               </div>
            </div>
         <?php endif; ?>

         <?php if ($edufax_offcanvas_category_menu_switch) : ?>
            <div class="offcanvas__category pb-40">
               <button class="tp-offcanvas-category-toggle">
                  <i class="fa-solid fa-bars"></i>
                  <?php echo esc_html__('All Categories', 'edufax'); ?>
               </button>
               <div class="tp-category-mobile-menu">
                  <nav class="tp-category-menu-content">
                     <?php edufax_category_menu(); ?>
                  </nav>
               </div>
            </div>
         <?php endif; ?>

         <div class="tp-main-menu-mobile fix mb-40"></div>

         <?php if (!empty($edufax_offcanvas_btn)) : ?>
            <div class="offcanvas__btn">
               <a href="<?php echo esc_url($edufax_offcanvas_btn_url); ?>" class="tp-btn-2 tp-btn-border-2"><?php echo esc_html($edufax_offcanvas_btn); ?></a>
            </div>
         <?php endif; ?>

      </div>

      <div class="offcanvas__bottom">
         <div class="offcanvas__footer d-flex align-items-center justify-content-between">

            <?php if (!empty($edufax_offcanvas_multicurrency_switch)) : ?>
               <div class="offcanvas__currency-wrapper currency">

                  <?php if (!empty($edufax_offcanvas_multicurrency_shortcode)) : ?>
                     <?php echo do_shortcode("$edufax_offcanvas_multicurrency_shortcode"); ?>

                  <?php else : ?>
                     <span class="offcanvas__currency-selected-currency tp-currency-toggle" id="tp-offcanvas-currency-toggle"><?php echo esc_html__('Currency : USD', 'edufax'); ?></span>
                     <ul class="offcanvas__currency-list tp-currency-list">
                        <li><?php echo esc_html__('USD', 'edufax'); ?></li>
                        <li><?php echo esc_html__('YEAN', 'edufax'); ?></li>
                        <li> <?php echo esc_html__('EURO', 'edufax'); ?></li>
                     </ul>
                  <?php endif; ?>

               </div>
            <?php endif; ?>

            <?php if (!empty($edufax_offcanvas_lang)) : ?>
               <!-- language start -->
               <?php edufax_offcanvas_lang_defualt(); ?>
               <!-- language end -->
            <?php endif; ?>

         </div>
      </div>
   </div>
</div>
<div class="body-overlay"></div>
<!-- offcanvas area end -->