<div class="offcanvas__area">
   <div class="offcanvas__wrapper">
      <div class="offcanvas__close">
         <button class="offcanvas__close-btn offcanvas-close-btn">
            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
               <path d="M11 1L1 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
               <path d="M1 1L11 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
         </button>
      </div>
      <div class="offcanvas__content d-xl-none">
         <?php if (!empty($ms_side_logo)) : ?>
            <div class="offcanvas__top mb-70 d-flex justify-content-between align-items-center">
               <div class="offcanvas__logo logo">
                  <a href="<?php print esc_url(home_url('/')); ?>">
                     <img src="<?php echo esc_url($ms_side_logo); ?>" alt="<?php echo esc_url($ms_side_logo_alt); ?>">
                  </a>
               </div>
            </div>
         <?php endif; ?>

         <div class="ms-main-menu-mobile"></div>
         <?php if (!empty($settings['ms_btn_text'])) : ?>
            <div class="offcanvas__btn">
               <a <?php echo $this->get_render_attribute_string('ms-button-side'); ?>> <?php echo $settings['ms_btn_text']; ?> <i class="fa-regular fa-chevron-right"></i></a>
            </div>
         <?php endif; ?>

         <?php if (!empty($settings['ms_header_side_address'])) : ?>
            <div class="side-info-contact">
               <span><?php echo wp_kses_post($settings['ms_header_side_label']); ?></span>
               <p><?php echo wp_kses_post($settings['ms_header_side_address']); ?></p>
            </div>
         <?php endif; ?>

         <?php if ($settings['side_social_show_profiles'] && is_array($settings['side_social_profiles'])) : ?>
            <div class="side-info-social">
               <?php
               foreach ($settings['side_social_profiles'] as $profile) :
                  $icon = $profile['side_social_name'];
                  $url = esc_url($profile['side_social_link']['url']);

                  printf(
                     '<a target="_blank" rel="noopener"  href="%s" class="ms-el-box-social-link ele-social-button elementor-repeater-item-%s"><i class="fa-brands fa-%s" aria-hidden="true"></i></a>',
                     $url,
                     esc_attr($profile['_id']),
                     esc_attr($icon)
                  );
               endforeach;
               ?>
            </div>
         <?php endif; ?>
      </div>

      <div class="side-info d-none d-xl-block">
         <div class="side-info-wrapper">
            <div class="side-info-logo mb-30">
               <a href="<?php print esc_url(home_url('/')); ?>">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo/logo.png" alt="logo">
               </a>
            </div>
            <div class="side-info-content mb-45">
               <h4 class="side-info-title"><?php echo wp_kses_post($settings['ms_header_side_address']); ?></h4>
            </div>

            <div class="side-info-gallery mb-55">
               <?php foreach ($settings['gallery_list'] as $index => $item) :
                  if (!empty($item['side_gallery_image']['url'])) {
                     $side_gallery_image = !empty($item['side_gallery_image']['id']) ? wp_get_attachment_image_url($item['side_gallery_image']['id'], $settings['thumbnail_size_size']) : $item['side_gallery_image']['url'];
                     $side_gallery_image_alt = get_post_meta($item["side_gallery_image"]["id"], "_wp_attachment_image_alt", true);
                  }
               ?>
                  <a class="popup-image" href="<?php echo esc_url($side_gallery_image); ?>"><img src="<?php echo esc_url($side_gallery_image); ?>" alt="<?php echo esc_attr($side_gallery_image_alt); ?>"></a>
               <?php endforeach; ?>
            </div>

            <?php if (!empty($settings['ms_header_side_address'])) : ?>
               <div class="side-info-contact text-center">
                  <span><?php echo wp_kses_post($settings['ms_header_side_label']); ?></span>
                  <p><?php echo wp_kses_post($settings['ms_header_side_address']); ?></p>
               </div>
            <?php endif; ?>

            <?php if ($settings['side_social_show_profiles'] && is_array($settings['side_social_profiles'])) : ?>
               <div class="side-info-social text-center">
                  <?php
                  foreach ($settings['side_social_profiles'] as $profile) :
                     $icon = $profile['side_social_name'];
                     $url = esc_url($profile['side_social_link']['url']);

                     printf(
                        '<a target="_blank" rel="noopener"  href="%s" class="ms-el-box-social-link ele-social-button elementor-repeater-item-%s"><i class="fa-brands fa-%s" aria-hidden="true"></i></a>',
                        $url,
                        esc_attr($profile['_id']),
                        esc_attr($icon)
                     );
                  endforeach;
                  ?>

               </div>
            <?php endif; ?>
         </div>
      </div>
   </div>
</div>
<div class="body-overlay"></div>