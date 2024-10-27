<?php

/**
 * Template for displaying course instructors/ instructor
 *
 * @since v.1.0.0
 *
 * @author Themeum
 * @url https://themeum.com
 *
 * @package TutorLMS/Templates
 * @version 1.4.3
 */



do_action('tutor_course/single/enrolled/before/instructors');

$instructors = tutor_utils()->get_instructors_by_course();
if ($instructors) {
	$count = is_array($instructors) ? count($instructors) : 0;

?>
<div class="tutor-course-instructors-wrap tutor-single-course-segment" id="single-course-ratings">
    <?php
		foreach ($instructors as $instructor) {
			$profile_url = tutor_utils()->profile_url($instructor->ID);
			$instructor_rating = tutor_utils()->get_instructor_ratings($instructor->ID);
			$course_count = tutor_utils()->get_course_count_by_instructor($instructor->ID);
			$student_count = tutor_utils()->get_total_students_by_instructor($instructor->ID);

			$instructor_bio = $instructor->tutor_profile_bio ?? '';
		?>
    <div class="tf__course_instructor">
        <div class="row">
            <div class="col-xl-5 col-sm-8 col-md-6">
                <div class="tf__course_instructor_img">
                    <a href="<?php echo esc_url($profile_url); ?>">
                        <?php echo get_avatar($instructor->ID, 500, '', '', array('class' => 'img-fluid w-100')); ?>
                    </a>
                </div>
            </div>
            <div class="col-xl-7">
                <div class="tf__course_instructor_text">
                    <h3><?php echo esc_html($instructor->display_name); ?>
                    </h3>
                    <h5>
                        <?php echo esc_html($instructor->tutor_profile_job_title); ?>
                        <span>
                            <?php
									$rating = $instructor_rating->rating_avg;
									for ($i = 1; $i <= 5; $i++) {
										echo $i <= $rating ? '<i class="fas fa-star"></i>' : '<i class="far fa-star"></i>';
									}
									?>
                            <b>(<?php echo esc_html($instructor_rating->rating_count); ?>
                                <?php esc_html_e('Review', 'educal'); ?>)</b>
                        </span>
                    </h5>
                    <ul class="course_rating">
                        <li>
                            <span><img src="<?php echo get_template_directory_uri(); ?>/assets/images/book_icon.svg"
                                    alt="book" class="img-fluid w-100"></span>
                            <?php echo esc_html($course_count); ?> <?php esc_html_e('Courses', 'educal'); ?>
                        </li>
                        <li>
                            <span><img src="<?php echo get_template_directory_uri(); ?>/assets/images/user_icon.svg"
                                    alt="user" class="img-fluid w-100"></span>
                            <?php echo esc_html($student_count); ?> <?php esc_html_e('Students', 'educal'); ?>
                        </li>
                    </ul>

                    <p class="about"><?php echo wp_kses_post($instructor->tutor_profile_bio ?? ''); ?></p>

                    <?php if (!empty($instructor->user_url)) : ?>
                    <p class="address"><i class="fas fa-map-marker-alt"></i>
                        <?php echo esc_html($instructor->user_url); ?></p>
                    <?php endif; ?>

                    <?php if (!empty($instructor->phone_number)) : ?>
                    <p class="address"><i class="fas fa-phone-alt"></i>
                        <?php echo esc_html($instructor->phone_number); ?></p>
                    <?php endif; ?>

                    <?php if (!empty($instructor->user_email)) : ?>
                    <p class="address"><i class="fas fa-envelope"></i> <?php echo esc_html($instructor->user_email); ?>
                    </p>
                    <?php endif; ?>

                    <ul class="social_link d-flex flex-wrap">
                        <?php
								$tutor_user_social_icons = tutor_utils()->tutor_user_social_icons();
								foreach ($tutor_user_social_icons as $key => $social_icon) {
									$social_url = get_user_meta($instructor->ID, $key, true);
									if (!empty($social_url)) {
										echo '<li><a class="' . esc_attr($key) . '" href="' . esc_url($social_url) . '"><i class="' . esc_attr($social_icon['icon_classes']) . '"></i></a></li>';
									}
								}
								?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php
		}
		?>
</div>
<?php
}

do_action('tutor_course/single/enrolled/after/instructors');