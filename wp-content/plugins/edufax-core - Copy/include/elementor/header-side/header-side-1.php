<div class="offcanvas__wrapper">
   <div class="offcanvas__close">
      <button class="offcanvas__close-btn offcanvas-close-btn">
         <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M11 1L1 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M1 1L11 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </button>
   </div>
   <div class="offcanvas__content">

   <?php if ( !empty($tp_side_logo) ) : ?>
      <div class="offcanvas__top mb-70 d-flex justify-content-between align-items-center">
         <div class="offcanvas__logo logo">
         <a href="<?php print esc_url( home_url( '/' ) );?>">
                <img src="<?php echo esc_url($tp_side_logo); ?>" alt="<?php echo esc_url($tp_side_logo_alt); ?>">
             </a>
         </div>
      </div>
      <?php endif;?>


      <?php if($settings['tp_offcanvas_category_switch'] == 'yes') : ?>
      <div class="offcanvas__category pb-40">
         <button class="tp-offcanvas-category-toggle">
            <i class="fa-solid fa-bars"></i>
            <?php echo esc_html($settings['tp_offcanvas_category_text']); ?>
         </button>
         <div class="tp-category-mobile-menu">
            <nav class="tp-category-menu-content">
               
            </nav>
         </div>
      </div>
      <?php endif;?>

      <div class="tp-main-menu-mobile fix mb-40"></div>

      <?php if (!empty($link)) : ?>
        <div class="offcanvas__btn">
            <a class="tp-btn-2 tp-btn-border-2 tp-el-box-btn" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>"><?php echo esc_html($settings['tp_tpbtn_text']); ?></a>
        </div>
    <?php endif; ?>

   </div>

   <div class="offcanvas__bottom">
      <div class="offcanvas__footer d-flex align-items-center justify-content-between">

         <?php if($settings['tp_offcanvas_currency_switch'] == 'yes') : ?>
         <div class="offcanvas__currency-wrapper currency">

         <?php if(!empty($settings['tp_offcanvas_currency_shortcode'])) : ?>
            <?php echo do_shortcode($settings['tp_offcanvas_currency_shortcode']); ?>

         <?php else : ?>
            <span class="offcanvas__currency-selected-currency tp-currency-toggle" id="tp-offcanvas-currency-toggle"><?php echo esc_html__('Currency : USD', 'shofy'); ?></span>
            <ul class="offcanvas__currency-list tp-currency-list">
               <li><?php echo esc_html__('USD', 'shofy'); ?></li>
               <li><?php echo esc_html__('YEAN', 'shofy'); ?></li>
               <li> <?php echo esc_html__('EURO', 'shofy'); ?></li>
            </ul>
         <?php endif; ?>
            
         </div>
         <?php endif; ?>

         <?php if($settings['tp_offcanvas_lang_switch'] == 'yes') : ?>
         <!-- language start -->
         <?php shofy_offcanvas_lang_defualt(); ?>
         <!-- language end -->
         <?php endif; ?>

      </div>
   </div>
</div>
      