<?php
// educal lesson
function educal_lesson()
{
    global $post, $authordata;

    $tutor_lesson_count = tutor_utils()->get_lesson_count_by_course(get_the_ID());

    $course_rating = tutor_utils()->get_course_rating();
?>
    <div class="course__meta d-flex align-items-center justify-content-between">

        <div class="course__lesson">
            <span><i class="far fa-book-alt"></i>
                <?php print esc_html($tutor_lesson_count); ?>
                <?php print esc_html__('lessons', 'educal'); ?>
            </span>
        </div>
        <div class="course__rating">
            <span>
                <?php
                if ($course_rating->rating_avg >= 0) {
                    echo '<i class="icon_star"></i>' . apply_filters('tutor_course_rating_average', $course_rating->rating_avg) . '';

                    echo '<span class="rating-count-gap">(' . apply_filters('tutor_course_rating_count', $course_rating->rating_count) . ') </span>';
                }
                ?>
            </span>
        </div>
    </div>
<?php
}

add_action('educal_course_lesson', 'educal_lesson');

// educal instructor
function educal_instructor()
{
    global $post, $authordata;

    $profile_url = tutor_utils()->profile_url($authordata->ID);

?>
    <div class="course__teacher d-flex align-items-center">
        <div class="course__teacher-thumb mr-15">
            <?php echo get_avatar(get_the_author_meta('ID'), 32) ?>
        </div>
        <h6><a
                href="<?php echo esc_url($profile_url); ?>"><?php echo get_the_author_meta('display_name', get_the_author_meta('ID')); ?></a>
        </h6>
    </div>
<?php
}

add_action('educal_course_instructor', 'educal_instructor');

// educal footer
function educal_course_footer()
{
    global $post, $authordata;

    $profile_url = tutor_utils()->profile_url($authordata->ID);

?>
    <div class="course__more d-flex justify-content-between align-items-center">
        <div class="course__status">
            <?php
            $course_id = get_the_ID();
            $default_price = apply_filters('tutor-loop-default-price', __('Free', 'educal'));
            $price_html = '<span> ' . $default_price . '</span>';
            if (tutor_utils()->is_course_purchasable()) {
                $product_id = tutor_utils()->get_course_product_id($course_id);
                $product = wc_get_product($product_id);

                if ($product) {
                    $price_html = '<span> ' . $product->get_price_html() . ' </span>';
                }
            }
            echo edufax_kses_intermediate($price_html);
            ?>
        </div>
        <div class="course__btn">
            <a href="<?php the_permalink(); ?>" class="link-btn">
                <?php _e('Know Details', 'educal'); ?>
                <i class="far fa-arrow-right"></i>
                <i class="far fa-arrow-right"></i>
            </a>
        </div>
    </div>
<?php
}

add_action('educal_course_footer_down', 'educal_course_footer');

// educal footer
function educal_course_enroll_info()
{
    global $post, $authordata;

    $profile_url = tutor_utils()->profile_url($authordata->ID);
    $tutor_lesson_count = tutor_utils()->get_lesson_count_by_course(get_the_ID());

    $disable_course_duration = get_tutor_option('disable_course_duration');
    $disable_total_enrolled = get_tutor_option('disable_course_total_enrolled');
    $disable_update_date = get_tutor_option('disable_course_update_date');
    $course_duration = get_tutor_course_duration_context();
    $disable_course_level = get_tutor_option('disable_course_level');
    $disable_course_share = get_tutor_option('disable_course_share');
    $course_language = function_exists('get_field') ? get_field('course_language') : NULL;
    $educal_tutor_course_details_payment_switch = get_theme_mod('educal_tutor_course_details_payment_switch', true);
?>
    <div class="course__video-content mb-35">
        <ul>
            <li class="d-flex align-items-center">
                <div class="course__video-icon">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                        y="0px" viewBox="0 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve">
                        <path class="st0" d="M2,6l6-4.7L14,6v7.3c0,0.7-0.6,1.3-1.3,1.3H3.3c-0.7,0-1.3-0.6-1.3-1.3V6z" />
                        <polyline class="st0" points="6,14.7 6,8 10,8 10,14.7 " />
                    </svg>
                </div>
                <div class="course__video-info">
                    <span><?php _e('Instructor', 'educal'); ?></span>
                    <h5><?php echo get_the_author_meta('display_name', get_the_author_meta('ID')); ?></h5>
                </div>
            </li>
            <li class="d-flex align-items-center">
                <div class="course__video-icon">
                    <svg>
                        <circle class="st0" cx="8" cy="8" r="6.7" />
                        <line class="st0" x1="1.3" y1="8" x2="14.7" y2="8" />
                        <path class="st0"
                            d="M8,1.3c1.7,1.8,2.6,4.2,2.7,6.7c-0.1,2.5-1,4.8-2.7,6.7C6.3,12.8,5.4,10.5,5.3,8C5.4,5.5,6.3,3.2,8,1.3z" />
                    </svg>
                </div>
                <div class="course__video-info">
                    <span><?php _e('Language', 'educal'); ?></span>
                    <h5><?php print esc_html($course_language); ?></h5>
                </div>
            </li>

        </ul>
    </div>
    <?php if (!empty($educal_tutor_course_details_payment_switch)) : ?>
        <div class="course__payment mb-35">
            <h3><?php _e('Payment :', 'educal'); ?></h3>
            <a href="#">
                <img src="<?php print get_template_directory_uri(); ?>/assets/img/course/payment/payment-1.png" alt="img">
            </a>
        </div>
    <?php endif; ?>
<?php
}

add_action('educal_course_enroll_info_list', 'educal_course_enroll_info');

// educal single tab
function educal_course_info_tab()
{
    global $post, $authordata;
    $course_tags = get_tutor_course_tags();
    $disable_course_share = get_tutor_option('disable_course_share');
    $educal_tutor_course_desc_tab_switch = get_theme_mod('educal_tutor_course_desc_tab_switch', true);
    $educal_tutor_course_curriculum_tab_switch = get_theme_mod('educal_tutor_course_curriculum_tab_switch', true);
    $educal_tutor_course_reviews_tab_switch = get_theme_mod('educal_tutor_course_reviews_tab_switch', true);
    $educal_tutor_course_instructor_tab_switch = get_theme_mod('educal_tutor_course_instructor_tab_switch', true);
?>
    <div class="course__tab-2 mb-45">
        <ul class="nav nav-tabs" id="courseTab" role="tablist">
            <?php if (!empty($educal_tutor_course_desc_tab_switch)): ?>
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description"
                        type="button" role="tab" aria-controls="description" aria-selected="true"> <i
                            class="icon_ribbon_alt"></i> <span><?php _e('Discription', 'educal'); ?></span> </button>
                </li>
            <?php endif; ?>

            <?php if (!empty($educal_tutor_course_curriculum_tab_switch)): ?>
                <li class="nav-item" role="presentation">
                    <button class="nav-link " id="curriculum-tab" data-bs-toggle="tab" data-bs-target="#curriculum"
                        type="button" role="tab" aria-controls="curriculum" aria-selected="false"> <i class="icon_book_alt"></i>
                        <span><?php _e('Curriculum', 'educal'); ?></span> </button>
                </li>
            <?php endif; ?>

            <?php if (!empty($educal_tutor_course_reviews_tab_switch)): ?>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="review-tab" data-bs-toggle="tab" data-bs-target="#review" type="button"
                        role="tab" aria-controls="review" aria-selected="false"> <i class="icon_star_alt"></i>
                        <span><?php _e('Reviews', 'educal'); ?></span> </button>
                </li>
            <?php endif; ?>

            <?php if (!empty($educal_tutor_course_instructor_tab_switch)): ?>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="member-tab" data-bs-toggle="tab" data-bs-target="#member" type="button"
                        role="tab" aria-controls="member" aria-selected="false"> <i class="fal fa-user"></i>
                        <span><?php _e('Instructor', 'educal'); ?></span> </button>
                </li>
            <?php endif; ?>
        </ul>
    </div>
    <div class="course__tab-content mb-95">
        <div class="tab-content" id="courseTabContent">
            <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                <div class="course__description">
                    <?php tutor_course_content(); ?>
                    <?php tutor_course_benefits_html(); ?>

                    <?php if (is_array($course_tags) && count($course_tags)) : ?>
                        <div class="course__tag-2 mb-35 mt-35">
                            <i class="fal fa-tag"></i>
                            <?php
                            foreach ($course_tags as $course_tag) {
                                $tag_link = get_term_link($course_tag->term_id);
                                echo "<a href='$tag_link'> $course_tag->name<span>,</span> </a>";
                            }
                            ?>
                        </div>
                    <?php endif; ?>


                    <?php if (!$disable_course_share) : ?>
                        <div class="course__share">
                            <h3><?php _e('Share :', 'educal'); ?></h3>
                            <?php tutor_social_share();
                            $tutor_social_share_icons = tutor_utils()->tutor_social_share_icons();
                            $share_config = array(
                                'title' => get_the_title(),
                                'text'  => get_the_excerpt(),
                                'image' => get_tutor_course_thumbnail('post-thumbnail', true),
                            );
                            ?>

                            <div class="tutor-social-share-wrap"
                                data-social-share-config="<?php echo esc_attr(json_encode($share_config)); ?>">
                                <?php
                                foreach ($tutor_social_share_icons as $icon) {
                                    echo '<button class="tutor_share ' . $icon['share_class'] . '"> ' .
                                        $icon['icon_html'] .
                                        ' </button>';
                                }
                                ?>
                            </div>
                        </div>

                    <?php endif; ?>

                </div>
            </div>
            <div class="tab-pane fade" id="curriculum" role="tabpanel" aria-labelledby="curriculum-tab">
                <div class="course__curriculum">
                    <?php tutor_course_topics(); ?>
                </div>
            </div>
            <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                <div class="course__review">
                    <?php tutor_course_target_reviews_html(); ?>
                    <?php tutor_course_target_review_form_html(); ?>
                </div>
            </div>
            <div class="tab-pane fade" id="member" role="tabpanel" aria-labelledby="member-tab">
                <div class="course__member mb-45">
                    <?php tutor_course_instructors_html(); ?>
                </div>
            </div>



        </div>
    </div>
<?php
}

add_action('educal_course_info_tab_action', 'educal_course_info_tab');


function educal_sidebar_before_wrapper()
{
    echo '<div class="educal_single_course_wrapper">';
}
add_action('tutor_course/single/before/sidebar', 'educal_sidebar_before_wrapper');


function educal_sidebar_after_wrapper()
{
    echo '</div>';
}
add_action('tutor_course/single/after/sidebar', 'educal_sidebar_after_wrapper');
