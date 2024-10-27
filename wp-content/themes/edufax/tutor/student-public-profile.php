<?php

/**
 * Template for displaying student & instructor Public Profile.
 * It is used for both of instructor and student. Separate file has not been introduced due to complicacy and backward compatibility. -JK
 *
 * @since v.1.0.0
 *
 * @author Themeum
 * @url https://themeum.com
 *
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

$user_name = sanitize_text_field(get_query_var('tutor_student_username'));
$get_user = tutor_utils()->get_user_by_login($user_name);

if (!is_object($get_user) || !property_exists($get_user, 'ID')) {
    wp_redirect(get_home_url() . '/404');
    exit;
}

$user_id = $get_user->ID;
$is_instructor = tutor_utils()->is_instructor($user_id);

$profile_layout = tutor_utils()->get_option(($is_instructor ? 'instructor' : 'student') . '_public_profile_layout', 'pp-circle');
!$is_instructor ? $profile_layout = 'pp-circle' : 0; // For now

$tutor_user_social_icons = tutor_utils()->tutor_user_social_icons();

foreach ($tutor_user_social_icons as $key => $social_icon) {
    $url = get_user_meta($user_id, $key, true);
    $tutor_user_social_icons[$key]['url'] = $url;
}

get_header();
?>

<?php
// Rating content 
ob_start();
if ($is_instructor) {
    $instructor_rating = tutor_utils()->get_instructor_ratings($user_id);
?>
    <div class="tutor-rating-container">
        <div class="ratings">
            <div class="rating-generated">
                <?php tutor_utils()->star_rating_generator($instructor_rating->rating_avg); ?>
            </div>

            <?php
            echo " <span class='rating-digits'>{$instructor_rating->rating_avg}</span> ";
            echo " <span class='rating-total-meta'>({$instructor_rating->rating_count})</span> ";
            ?>
        </div>
    </div>
<?php
}
$rating_content = ob_get_clean();


// Social media content
ob_start();
foreach ($tutor_user_social_icons as $key => $social_icon) {
    $url = $social_icon['url'];
    echo !empty($url) ? '<a href="' . $url . '" target="_blank" rel="noopener noreferrer nofollow" class="' . $social_icon['icon_classes'] . '" title="' . $social_icon['label'] . '"></a>' : '';
}
$social_media = ob_get_clean();
?>

<?php do_action('tutor_student/before/wrap'); ?>

<div <?php tutor_post_class('tutor-full-width-student-profile tutor-page-wrap tutor-user-public-profile tutor-user-public-profile-' . $profile_layout); ?>>
    <section class="teacher__area">
        <div class="page__title-shape">
            <img class="page-title-shape-5 d-none d-sm-block" src="<?php print get_template_directory_uri(); ?>/assets/img/page-title/page-title-shape-1.png" alt="<?php echo esc_attr__('img', 'educal'); ?>">
            <img class="page-title-shape-6" src="<?php print get_template_directory_uri(); ?>/assets/img/page-title/page-title-shape-6.png" alt="<?php echo esc_attr__('img', 'educal'); ?>">
            <img class="page-title-shape-3" src="<?php print get_template_directory_uri(); ?>/assets/img/page-title/page-title-shape-3.png" alt="<?php echo esc_attr__('img', 'educal'); ?>">
            <img class="page-title-shape-7" src="<?php print get_template_directory_uri(); ?>/assets/img/page-title/page-title-shape-4.png" alt="<?php echo esc_attr__('img', 'educal'); ?>">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                    <div class="teacher__details-thumb p-relative w-img pr-30">
                        <div class="teacher-img" style="background-image:url(<?php echo get_avatar_url($user_id, array('size' => 500)); ?>)"></div>
                        <div class="teacher__details-shape">
                            <img class="teacher-details-shape-1" src="<?php print get_template_directory_uri(); ?>/assets/img/teacher/details/shape/shape-1.png" alt="<?php echo esc_attr__('img', 'educal'); ?>">
                            <img class="teacher-details-shape-2" src="<?php print get_template_directory_uri(); ?>/assets/img/teacher/details/shape/shape-2.png" alt="<?php echo esc_attr__('img', 'educal'); ?>">
                        </div>
                    </div>
                </div>
                <div class="col-xxl-8 col-xl-8 col-lg-8">
                    <div class="teacher__wrapper">
                        <div class="teacher__top d-md-flex align-items-end justify-content-between">
                            <div class="teacher__info">
                                <h4><?php echo esc_html($get_user->display_name); ?></h4>
                                <?php
                                if ($is_instructor) {
                                    $course_count = tutor_utils()->get_course_count_by_instructor($user_id);
                                    $student_count = tutor_utils()->get_total_students_by_instructor($user_id);
                                ?>
                                    <span>
                                        <span><?php echo esc_html($course_count); ?></span>
                                        <?php $course_count > 1 ? _e('Courses', 'educal') : _e('Course', 'educal'); ?>
                                    </span>
                                    <span><span>•</span></span>
                                    <span>
                                        <span><?php echo esc_html($student_count); ?></span>
                                        <?php $student_count > 1 ? _e('Students', 'educal') : _e('Student', 'educal'); ?>
                                    </span>
                                <?php
                                } else {
                                    $enrolled_course = tutor_utils()->get_enrolled_courses_by_user($user_id);
                                    $enrol_count = is_object($enrolled_course) ? $enrolled_course->found_posts : 0;

                                    $complete_count = tutor_utils()->get_completed_courses_ids_by_user($user_id);
                                    $complete_count = $complete_count ? count($complete_count) : 0;
                                ?>
                                    <span>
                                        <span><?php echo esc_html($enrol_count); ?></span>
                                        <?php $enrol_count > 1 ? _e('Courses Enrolled', 'educal') : _e('Course Enrolled', 'educal'); ?>
                                    </span>
                                    <span><span>•</span></span>
                                    <span>
                                        <span><?php echo esc_html($complete_count); ?></span>
                                        <?php $complete_count > 1 ? _e('Courses Completed', 'educal') : _e('Course Completed', 'educal'); ?>
                                    </span>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="teacher__rating">
                                <h5><?php _e('Review:', 'educal'); ?> </h5>
                                <div class="teacher__rating-inner d-flex align-items-center">
                                    <?php echo edufax_kses_intermediate($rating_content); ?>
                                </div>
                            </div>
                            <div class="teacher__social-2">
                                <h4><?php _e('Follow Us:', 'educal'); ?></h4>
                                <?php echo edufax_kses_intermediate($social_media); ?>
                            </div>
                            <div class="teacher__follow mb-5">
                                <a href="#" class="teacher__follow-btn">follow <i class="icon_plus"></i> </a>
                            </div>
                        </div>

                        <div class="teacher__bio">
                            <h3><?php _e('Biography', 'educal'); ?></h3>
                            <?php tutor_load_template('profile.bio'); ?>
                        </div>

                        <div class="teacher__courses pt-55">
                            <div class="section__title-wrapper mb-30">
                                <h2 class="section__title"><?php _e('Teacher', 'educal'); ?> <span class="yellow-bg yellow-bg-big">Course<img src="<?php print get_template_directory_uri(); ?>/assets/img/shape/yellow-bg.png" alt="img"></span></h2>
                            </div>

                            <div class="teacher__course-wrapper">
                                <?php
                                if ($is_instructor) {
                                ?>
                                    <?php
                                    add_filter('courses_col_per_row', function () {
                                        return 3;
                                    });

                                    tutor_load_template('profile.courses_taken');
                                    ?>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php do_action('tutor_student/after/wrap'); ?>

<?php
get_footer();
