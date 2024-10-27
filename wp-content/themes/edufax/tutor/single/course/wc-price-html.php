<?php

/**
 * Template for displaying price
 *
 * @since v.1.0.0
 *
 * @author Themeum
 * @url https://themeum.com
 *
 * @package TutorLMS/Templates
 * @version 1.4.3
 */


$is_purchasable = tutor_utils()->is_course_purchasable();
$price = apply_filters('get_tutor_course_price', null, get_the_ID());

if ($is_purchasable && $price) : ?>
   <div class="course__video-meta mb-25 d-flex align-items-center justify-content-between">
      <div class="course__video-price">
         <h5><?php echo edufax_kses_intermediate($price); ?> </h5>
      </div>
      <div class="course__video-discount d-none">
         <span>68% OFF</span>
      </div>
   </div>
<?php else : ?>
   <div class="course__video-meta mb-25 d-flex align-items-center justify-content-between">
      <div class="course__video-price">
         <h5><?php _e('Free', 'educal'); ?></h5>
      </div>
   </div>
<?php endif; ?>