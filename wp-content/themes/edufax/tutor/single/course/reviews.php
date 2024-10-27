<?php

/**
 * Template for displaying course reviews
 *
 * @package Tutor\Templates
 * @subpackage Single\Course
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 1.0.0
 */

use TUTOR\Input;

$disable = ! get_tutor_option('enable_course_review');
if ($disable) {
	return;
}

global $is_enrolled, $course_rating;

$per_page     = tutor_utils()->get_option('pagination_per_page', 10);
$current_page = max(1, Input::post('current_page', 0, Input::TYPE_INT));
$offset       = ($current_page - 1) * $per_page;

$current_user_id = get_current_user_id();
$course_id       = Input::post('course_id', get_the_ID(), Input::TYPE_INT);
$reviews         = tutor_utils()->get_course_reviews($course_id, $offset, $per_page, false, array('approved'), $current_user_id);
$reviews_total   = tutor_utils()->get_course_reviews($course_id, null, null, true, array('approved'), $current_user_id);
$my_rating       = tutor_utils()->get_reviews_by_user(0, 0, 150, false, $course_id, array('approved', 'hold'));

if (Input::has('course_id')) {
	// It's load more.
	tutor_load_template('single.course.reviews-loop', array('reviews' => $reviews));
	return;
}

/**
 * Global $is_enrolled, $course_rating get null for third party
 * who only include this file without single-course.php file.
 * 
 * @since 2.1.9
 */
if (is_null($is_enrolled)) {
	$is_enrolled = tutor_utils()->is_enrolled($course_id, $current_user_id);
}

if (is_null($course_rating)) {
	$course_rating = tutor_utils()->get_course_rating($course_id);
}

do_action('tutor_course/single/enrolled/before/reviews');
?>

<div class="tf__courses_review">
    <h3><?php echo esc_html(sprintf('%02d Review', $reviews_total)); ?></h3>

    <?php if (! is_array($reviews) || ! count($reviews)) : ?>
    <?php tutor_utils()->tutor_empty_state(__('No Review Yet', 'tutor')); ?>
    <?php else : ?>
    <?php foreach ($reviews as $review) : ?>
    <div class="tf__single_review">
        <div class="tf__single_review_img">
            <?php echo get_avatar($review->user_id, 70, '', '', array('class' => 'img-fluid w-100')); ?>
        </div>
        <div class="tf__single_review_text">
            <h4><?php echo esc_html($review->display_name); ?> <span><i class="fal fa-calendar-alt"></i>
                    <?php echo esc_html(date('F d, Y', strtotime($review->comment_date))); ?></span></h4>
            <p class="rating">
                <?php tutor_utils()->star_rating_generator($review->rating); ?>
            </p>
            <p class="comment"><?php echo esc_html($review->comment_content); ?></p>
        </div>
    </div>
    <?php endforeach; ?>

    <div class="tf__pagination">
        <div class="row">
            <div class="col-12">
                <nav aria-label="Page navigation example">
                    <?php
						$pagination_data              = array(
							'total_items' => $reviews_total,
							'per_page'    => $per_page,
							'paged'       => $current_page,
							'layout'      => array(
								'type'           => 'load_more',
								'load_more_text' => __('Load More', 'tutor'),
							),
							'ajax'        => array(
								'action'    => 'tutor_single_course_reviews_load_more',
								'course_id' => $course_id,
							),
						);
						$pagination_template_frontend = tutor()->path . 'templates/dashboard/elements/pagination.php';
						tutor_load_template_from_custom_path($pagination_template_frontend, $pagination_data);
						?>
                </nav>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if ($is_enrolled) : ?>
    <div class="tf__courses_review_input_area">
        <h3><?php esc_html_e('Write A Review', 'tutor'); ?></h3>
        <form method="post" class="tutor-write-review-form">
            <p><?php esc_html_e('Select your rating:', 'tutor'); ?>
                <span class="tutor-star-rating-container">
                    <?php tutor_utils()->star_rating_generator(tutor_utils()->get_rating_value($my_rating ? $my_rating->rating : 0)); ?>
                </span>
            </p>
            <div class="row">
                <div class="col-xl-6">
                    <div class="tf__courses_review_input_sigle">
                        <label><?php esc_html_e('Name', 'tutor'); ?></label>
                        <input type="text" name="name"
                            value="<?php echo esc_attr($current_user_id ? wp_get_current_user()->display_name : ''); ?>"
                            placeholder="<?php esc_attr_e('Name', 'tutor'); ?>" required>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="tf__courses_review_input_sigle">
                        <label><?php esc_html_e('Email', 'tutor'); ?></label>
                        <input type="email" name="email"
                            value="<?php echo esc_attr($current_user_id ? wp_get_current_user()->user_email : ''); ?>"
                            placeholder="<?php esc_attr_e('Email', 'tutor'); ?>" required>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="tf__courses_review_input_sigle">
                        <label><?php esc_html_e('Your review', 'tutor'); ?></label>
                        <textarea name="review" rows="8" placeholder="<?php esc_attr_e('Type here', 'tutor'); ?>"
                            required><?php echo stripslashes($my_rating ? $my_rating->comment_content : ''); ?></textarea>
                        <input type="hidden" name="course_id" value="<?php echo esc_attr($course_id); ?>" />
                        <input type="hidden" name="review_id"
                            value="<?php echo esc_attr($my_rating ? $my_rating->comment_ID : ''); ?>" />
                        <input type="hidden" name="action" value="tutor_place_rating" />
                        <button type="submit"
                            class="tf__common_btn tutor_submit_review_btn"><?php esc_html_e('Submit Review', 'tutor'); ?></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php endif; ?>
</div>

<?php do_action('tutor_course/single/enrolled/after/reviews'); ?>