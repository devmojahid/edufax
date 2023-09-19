<?php
/**
 * The main template file
 *
 * @package  WordPress
 * @subpackage  tpcore
 */
get_header();

$post_column = is_active_sidebar( 'portfolio-sidebar' ) ? 'col-xxl-9 col-xl-9 col-lg-8' : 'col-xxl-10 col-xl-10 col-lg-10';
$post_column_center = is_active_sidebar( 'portfolio-sidebar' ) ? '' : 'justify-content-center';

?>

      <!-- project-details-area start -->
      <div class="project-details-area pt-140 pb-130">
         <?php
             
             if( have_posts() ):
             while( have_posts() ): the_post(); ?>

            <?php the_content(); ?>
            
            <?php
            endwhile; wp_reset_query();
            endif;
            ?>
      </div>
      <!-- project-details-area end -->

<?php get_footer();  ?>
