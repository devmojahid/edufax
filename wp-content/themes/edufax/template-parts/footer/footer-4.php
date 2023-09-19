<?php

/**
 * Template part for displaying footer layout one
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package edufax
 */

$footer_bg_img = get_theme_mod('edufax_footer_bg');
$edufax_footer_logo = get_theme_mod('edufax_footer_logo');
$edufax_footer_top_space = function_exists('tpmeta_field') ? tpmeta_field('edufax_footer_top_space') : '0';

$edufax_footer_payment = get_theme_mod('footer_payment_img');
$edufax_footer_payment_url_from_page = function_exists('tpmeta_image_field') ? tpmeta_image_field('edufax_footer_payment') : '';
$edufax_footer_payment = !empty($edufax_footer_payment_url_from_page['url']) ? $edufax_footer_payment_url_from_page['url'] : $edufax_footer_payment;

$edufax_copyright_center = $edufax_footer_payment ? 'col-sm-6' : 'col-sm-12 text-center';
$edufax_footer_bg_url_from_page = function_exists('tpmeta_field') ? tpmeta_field('edufax_footer_bg') : '';
$edufax_footer_bg_color_from_page = function_exists('tpmeta_field') ? tpmeta_field('edufax_footer_bg_color') : '';
$footer_bg_color = get_theme_mod('edufax_footer_bg_color', '#fff');

// bg image
$bg_img = !empty($edufax_footer_bg_url_from_page['url']) ? $edufax_footer_bg_url_from_page['url'] : $footer_bg_img;


// bg color
$bg_color = !empty($edufax_footer_bg_color_from_page) ? $edufax_footer_bg_color_from_page : $footer_bg_color;

// footer_columns
$footer_columns = 0;
$footer_widgets = get_theme_mod('footer_widget_number', 4);

for ($num = 1; $num <= $footer_widgets; $num++) {
   if (is_active_sidebar('footer-4-' . $num)) {
      $footer_columns++;
   }
}

switch ($footer_columns) {
   case '1':
      $footer_class[1] = 'col-lg-12';
      break;
   case '2':
      $footer_class[1] = 'col-lg-6 col-md-6';
      $footer_class[2] = 'col-lg-6 col-md-6';
      break;
   case '3':
      $footer_class[1] = 'col-xl-4 col-lg-6 col-md-5';
      $footer_class[2] = 'col-xl-4 col-lg-6 col-md-7';
      $footer_class[3] = 'col-xl-4 col-lg-6';
      break;
   case '4':
      $footer_class[1] = 'col-xl-4 col-lg-3 col-md-4 col-sm-6';
      $footer_class[2] = 'col-xl-2 col-lg-3 col-md-4 col-sm-6';
      $footer_class[3] = 'col-xl-3 col-lg-3 col-md-4 col-sm-6';
      $footer_class[4] = 'col-xl-3 col-lg-3 col-md-4 col-sm-6';
      break;
   default:
      $footer_class = 'col-xl-3 col-lg-3 col-md-6';
      break;
}

?>

<!-- footer area start style home electronics -->
<footer>
   <div class="tp-footer-area tp-footer-style-2 tp-footer-style-3" data-bg-color="<?php print esc_attr($bg_color); ?>">

      <?php if (is_active_sidebar('footer-4-1') or is_active_sidebar('footer-4-2') or is_active_sidebar('footer-4-3') or is_active_sidebar('footer-4-4')) : ?>
         <div class="tp-footer-top pt-95 pb-40">
            <div class="container">
               <div class="row">

                  <?php
                  if ($footer_columns < 5) {
                     print '<div class="col-xl-4 col-lg-3 col-md-4 col-sm-6">';
                     dynamic_sidebar('footer-4-1');
                     print '</div>';

                     print '<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">';
                     dynamic_sidebar('footer-4-2');
                     print '</div>';

                     print '<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">';
                     dynamic_sidebar('footer-4-3');
                     print '</div>';

                     print '<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">';
                     dynamic_sidebar('footer-4-4');
                     print '</div>';
                  } else {
                     for ($num = 1; $num <= $footer_columns; $num++) {
                        if (!is_active_sidebar('footer-4-' . $num)) {
                           continue;
                        }
                        print '<div class="' . esc_attr($footer_class[$num]) . '">';
                        dynamic_sidebar('footer-4-' . $num);
                        print '</div>';
                     }
                  }
                  ?>
               </div>
            </div>
         </div>
      <?php endif; ?>

      <div class="tp-footer-bottom">
         <div class="container">
            <div class="tp-footer-bottom-wrapper">
               <div class="row align-items-center">

                  <div class="<?php echo esc_attr($edufax_copyright_center); ?>">
                     <div class="tp-footer-copyright">
                        <p><?php print edufax_copyright_text(); ?></p>
                     </div>
                  </div>

                  <?php if (!empty($edufax_footer_payment)) : ?>
                     <div class="col-md-6">
                        <div class="tp-footer-payment text-md-end">
                           <p>
                              <img src="<?php echo esc_url($edufax_footer_payment) ?>" alt="<?php echo esc_attr__('payment', 'edufax') ?>">
                           </p>
                        </div>
                     </div>
                  <?php endif; ?>
               </div>
            </div>
         </div>
      </div>

   </div>
</footer>
<!-- footer area end -->