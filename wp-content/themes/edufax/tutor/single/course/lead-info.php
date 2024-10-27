<?php

/**
 * Template for displaying lead info
 *
 * @since v.1.0.0
 *
 * @author Themeum
 * @url https://themeum.com
 *
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

if (! defined('ABSPATH'))
    exit;

global $post, $authordata;
$profile_url = tutor_utils()->profile_url($authordata->ID);
$terms = get_the_terms(get_the_ID(), 'course-category');

$educal_tutor_course_details_author_meta_switch = get_theme_mod('educal_tutor_course_details_author_meta_switch', true);

?>

<div class="tutor-single-course-segment tutor-single-course-lead-info sa">
    <div class="page__title-content mb-25">
        <span class="page__title-pres">
            <?php
            $course_categories = get_tutor_course_categories();
            if (!empty($course_categories) && is_array($course_categories) && count($course_categories)) { ?>
            <?php
                foreach ($course_categories as $course_category) {
                    $category_name = $course_category->name;
                    $category_link = get_term_link($course_category->term_id);
                    echo "<a class='page__title-pre' href='$category_link'>$category_name </a>";
                }
            }
            ?>
        </span>
        <h5 class="page__title-3"><?php the_title(); ?></h5>
    </div>
    <?php if (!empty($educal_tutor_course_details_author_meta_switch)) : ?>
        <div class="course__meta-2 d-sm-flex mb-25">
            <div class="course__teacher-3 d-flex align-items-center mr-70 mb-30">
                <div class="course__teacher-thumb-3 mr-15">
                    <?php echo get_avatar(get_the_author_meta('ID'), 32) ?>
                </div>
                <div class="course__teacher-info-3">
                    <h5>Teacher</h5>
                    <p><a href="<?php echo tutor_utils()->profile_url($authordata->ID); ?>"><?php echo get_the_author(); ?></a></p>
                </div>
            </div>
            <div class="course__update mr-80 mb-30">
                <h5>Last Update:</h5>
                <p><?php the_time(get_option('date_format')); ?></p>
            </div>
            <?php
            $disable = get_tutor_option('disable_course_review');
            if (! $disable) {
            ?>
                <div class="course__rating-2 mb-30">
                    <h5><?php echo esc_html__('Review:', 'educal'); ?></h5>
                    <div class="course__rating-inner d-flex align-items-center">
                        <div class="tutor-leadinfo-top-meta">
                            <div class="tutor-single-course-rating">
                                <?php
                                $course_rating = tutor_utils()->get_course_rating();
                                tutor_utils()->star_rating_generator($course_rating->rating_avg);
                                ?>
                                <span class="tutor-single-rating-count">
                                    <?php
                                    echo edufax_kses_intermediate($course_rating->rating_avg);
                                    echo '<i>(' . edufax_kses_intermediate($course_rating->rating_count) . ')</i>';
                                    ?>
                                </span>
                            </div>
                        </div>

                    </div>
                </div>
            <?php } ?>
        </div>
    <?php endif; ?>

    <div class="course__img w-img mb-30">
        <?php the_post_thumbnail(); ?>
    </div>

    <div class="mydiv-end"></div>

    <?php do_action('tutor_course/single/lead_meta/after'); ?>
    <?php do_action('tutor_course/single/excerpt/before'); ?>

    <?php
    $excerpt = tutor_get_the_excerpt();
    $disable_about = get_tutor_option('disable_course_about');
    if (! empty($excerpt) && ! $disable_about) {
    ?>
        <div class="tutor-course-summery">
            <h4 class="tutor-segment-title"><?php esc_html_e('About Course', 'educal') ?></h4>
            <?php print edufax_kses_intermediate($excerpt); ?>
        </div>
    <?php
    }
    ?>

    <?php do_action('tutor_course/single/excerpt/after'); ?>

</div>