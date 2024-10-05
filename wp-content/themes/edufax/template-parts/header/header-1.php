<?php

/**
 * Template part for displaying header layout one
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package edufax
 */

$edufax_sticky_switch = get_theme_mod('edufax_sticky_switch', false);
$enable_sticky = !empty($edufax_sticky_switch) ? 'header__sticky' : '';


// topbar settings
$edufax_topbar_switch = get_theme_mod('header_topbar_switch', false);
$edufax_welcome_text = get_theme_mod('edufax_welcome_text', __('Enroll now and get 40% off any course. Courses from $5.99.', 'edufax'));

$edufax_tel_link   = get_theme_mod('edufax_tel_link', __('402763-282-46 ', 'edufax'));
$edufax_tel_text   = get_theme_mod('edufax_tel_text', __('+(402) 763 282 46  ', 'edufax'));

// main header settings
$edufax_header_search      = get_theme_mod('edufax_header_search', false);
$header_right_switch      = get_theme_mod('header_right_switch', false);
$edufax_menu_col           = $header_right_switch ? 'col-xl-5 d-none d-xl-block' : 'col-xl-10 col-lg-7 col-md-7 col-sm-8 col-6 d-none d-xl-block';
$edufax_menu_align           = $header_right_switch ? '' : 'justify-content-end';

// Sign up controls
$edufax_header_sign_up  = get_theme_mod('edufax_header_sign_up', false);
$edufax_header_sign_up_text  = get_theme_mod('edufax_header_sign_up_text', __('Sign Up', 'edufax'));
$edufax_header_sign_up_link  = get_theme_mod('edufax_header_sign_up_link', __('#', 'edufax'));

?>

<header>
   <?php if ($edufax_topbar_switch) : ?>
      <section class="tf__topbar">
         <div class="container">
            <div class="col-xl-12">
               <div class="tf__topbar_text">
                  <p><?php echo esc_html($edufax_welcome_text); ?></p>
                  <span class="close_topbar"><i class="far fa-times"></i></span>
               </div>
            </div>
         </div>
      </section>
   <?php endif; ?>
   <nav class="navbar navbar-expand-lg tf__main_menu">
      <div class="container">
         <?php edufax_header_logo(); ?>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="far fa-bars menu_bar_icon"></i>
            <i class="far fa-times menu_close_icon"></i>
         </button>
         <div class="collapse navbar-collapse" id="navbarNav">
            <?php edufax_header_menu(); ?>
            <?php if ($header_right_switch) : ?>
               <ul class="tf__right_menu d-flex flex-wrap">
                  <?php if ($edufax_header_search) : ?>
                     <li><a class="menu_search_icon"><i class="far fa-search"></i></a></li>
                  <?php endif; ?>
                  <?php if ($edufax_header_sign_up) : ?>
                     <li><a class="signin"
                           href="<?php echo esc_attr($edufax_header_sign_up_link); ?>"><?php echo esc_html($edufax_header_sign_up_text); ?></a>
                     </li>
                  <?php endif; ?>
               </ul>
            <?php endif; ?>
         </div>
      </div>
   </nav>
   <div class="menu_search">
      <form action="<?php print esc_url(home_url('/')); ?>">
         <input type="text" placeholder="<?php print esc_attr__('Search', 'edufax'); ?>" name="s"
            value="<?php print esc_attr(get_search_query()) ?>">
         <button class="tf__common_btn" type="submit"><i class="far fa-search"></i>
            <?php echo esc_html__('Search ', 'edufax'); ?></button>
         <span class="close_search"><i class="far fa-times"></i></span>
      </form>
   </div>
</header>