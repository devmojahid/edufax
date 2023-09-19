<?php

/**
 * The main template file
 *
 * @package  WordPress
 * @subpackage  mscore
 */
get_header();

$post_column = is_active_sidebar('services-sidebar') ? 'col-lg-8 order-first order-lg-last' : 'col-xxl-10 col-xl-10 col-lg-10';
$post_column_center = is_active_sidebar('services-sidebar') ? '' : 'justify-content-center';

?>

<!-- services area start -->
<section class="services__area pt-120 pb-125">
   <div class="container">
      <?php
      if (have_posts()) :
         while (have_posts()) :
            the_post();
      ?>
            <div class="row  <?php echo esc_attr($post_column_center); ?>">
               <?php if (is_active_sidebar('services-sidebar')) : ?>
                  <div class="col-lg-4">
                     <div class="services__widget-2 pr-50">
                        <?php dynamic_sidebar('services-sidebar'); ?>
                     </div>
                  </div>
               <?php endif; ?>
               <div class="<?php echo esc_attr($post_column); ?>">
                  <div class="services__details-wrapper">
                     <?php the_content(); ?>
                  </div>
               </div>
            </div>
      <?php
         endwhile;
         wp_reset_query();
      endif;
      ?>
   </div>
</section>
<!-- services area end -->


<?php get_footer();  ?>