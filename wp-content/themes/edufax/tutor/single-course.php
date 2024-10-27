<?php

/**
 * Template for displaying single course
 *
 * @since v.1.0.0
 *
 * @author Themeum
 * @url https://themeum.com
 *
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

// Prepare the nav items
$course_nav_item = apply_filters('tutor_course/single/nav_items', tutor_utils()->course_nav_items(), get_the_ID());
$course_nav_item['instructors'] = array(
    'title' => __('Instructor', 'edufax'),
    'method' => 'tutor_course_instructors_html',
);;

tutor_utils()->tutor_custom_header();
do_action('tutor_course/single/before/wrap');
$disable_course  = get_tutor_option('disable_course_total_enrolled');
$enrolled = tutor_utils()->count_enrolled_users_by_course();
?>

<section class="tf__courses_details_page pt_120 xs_pt_80 pb_120 xs_pb_80">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 wow fadeInUp" data-wow-duration="1s">
                <div class="tf__courses_details_area">
                    <div class="tf__courses_details_img">
                        <?php tutor_utils()->has_video_in_single() ? tutor_course_video() : get_tutor_course_thumbnail(); ?>
                    </div>
                    <div class="tf__courses_details_header">
                        <ul class="d-flex flex-wrap">
                            <li>
                                <span>
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/book_icon.svg"
                                        alt="book" class="img-fluid w-100">
                                </span>
                                <?php echo esc_html(tutor_utils()->get_lesson_count_by_course(get_the_ID())); ?>
                                <?php echo  __('Lessons', 'edufax')  ?>
                            </li>
                            <?php if (! $disable_course) : ?>
                            <li>
                                <span>
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/user_icon.svg"
                                        alt="user" class="img-fluid w-100">
                                </span>
                                <?php echo esc_html($enrolled); ?> <?php echo  __('Students', 'edufax')  ?>
                            </li>
                            <?php endif; ?>
                            <li>
                                <span>
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/star_icon.svg"
                                        alt="star" class="img-fluid w-100">
                                </span>
                                <?php
                                $course_rating = tutor_utils()->get_course_rating();
                                echo $course_rating->rating_avg . ' (' . $course_rating->rating_count . ' ratings)';
                                ?>
                            </li>
                        </ul>
                        <h2><?php the_title(); ?></h2>
                    </div>
                    <div class="tf__courses_details_text">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <?php foreach ($course_nav_item as $key => $subpage) : ?>
                                <button class="nav-link <?php echo $key === 'info' ? 'active' : ''; ?>"
                                    id="nav-<?php echo esc_attr($key); ?>-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-<?php echo esc_attr($key); ?>" type="button" role="tab"
                                    aria-controls="nav-<?php echo esc_attr($key); ?>"
                                    aria-selected="<?php echo $key === 'info' ? 'true' : 'false'; ?>">
                                    <?php if (isset($subpage['icon'])) : ?>
                                    <i class="<?php echo esc_attr($subpage['icon']); ?>" aria-hidden="true"></i>
                                    <?php endif; ?>
                                    <?php if (isset($subpage['title'])) : ?>
                                    <?php echo esc_html($subpage['title']); ?>
                                    <?php endif; ?>
                                </button>
                                <?php endforeach; ?>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <?php foreach ($course_nav_item as $key => $subpage) : ?>
                            <div class="tab-pane fade <?php echo $key === 'info' ? 'show active' : ''; ?>"
                                id="nav-<?php echo esc_attr($key); ?>" role="tabpanel"
                                aria-labelledby="nav-<?php echo esc_attr($key); ?>-tab" tabindex="0">
                                <?php
                                    do_action('tutor_course/single/tab/' . $key . '/before');

                                    $method = $subpage['method'];
                                    if (is_string($method)) {
                                        $method();
                                    } else {
                                        $_object = $method[0];
                                        $_method = $method[1];
                                        $_object->$_method(get_the_ID());
                                    }

                                    do_action('tutor_course/single/tab/' . $key . '/after');
                                    ?>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="tf__sidebar" id="sticky_sidebar">
                    <div class="tf__sidebar_course_enrole">
                        <?php tutor_utils()->has_video_in_single() ? tutor_course_video() : get_tutor_course_thumbnail(); ?>
                        <?php tutor_load_template('single.course.course-entry-box'); ?>
                        <!-- <?php tutor_course_requirements_html(); ?>  There comes populer course-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php do_action('tutor_course/single/after/wrap'); ?>

<?php
tutor_utils()->tutor_custom_footer();
?>