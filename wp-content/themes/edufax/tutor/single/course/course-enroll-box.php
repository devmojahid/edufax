<?php
/**
 * Template for displaying course content
 *
 * @since v.1.0.0
 *
 * @author Themeum
 * @url https://themeum.com
 *
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

if ( ! defined( 'ABSPATH' ) )
	exit;
?>

<div class="tutor-price-preview-box ccc">
    <div class="tutor-price-box-thumbnail single-course-price-normal">
		<?php
		if(tutor_utils()->has_video_in_single()){
			tutor_course_video();
		} else{
			get_tutor_course_thumbnail();
		}
		?>
    </div>

    <?php do_action('tutor_course/single/enroll_box/after_thumbnail'); ?>

	<?php tutor_course_price(); ?>
    <?php do_action('educal_course_enroll_info_list'); ?>

    <?php tutor_single_course_add_to_cart(); ?>

</div> <!-- tutor-price-preview-box -->
