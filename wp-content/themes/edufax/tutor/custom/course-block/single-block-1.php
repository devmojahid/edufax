<?php 
$is_purchasable = tutor_utils()->is_course_purchasable();
$price          = apply_filters( 'get_tutor_course_price', null, get_the_ID() );
if ( $is_purchasable && $price ) :
    $price = $price;
else :
    $price = __( 'Free', 'edublink' );
endif;

$course_rating   = tutor_utils()->get_course_rating();
$ratings_average = $course_rating->rating_avg;
$total_ratings   = $course_rating->rating_count;
$disable_course  = get_tutor_option( 'disable_course_total_enrolled' );
$enrolled = tutor_utils()->count_enrolled_users_by_course();
?>

<div class="tf__single_courses">
    <div class="tf__single_courses_img">
        <?php get_tutor_course_thumbnail(); ?>
        <?php $categories = get_the_terms(get_the_ID(), 'course-category'); ?>
        <?php if (!empty($categories) && !is_wp_error($categories)): ?>
        <?php $category = current($categories); ?>
        <a class="category"
            href="<?php echo esc_url(home_url('/course-category/' . $category->slug)); ?>"><?php echo esc_html($category->name); ?></a>
        <?php endif; ?>
    </div>
    <div class="tf__single_courses_text">
        <ul class="d-flex flex-wrap justify-content-between">
            <li>
                <span class="icon">
                    <img src="<?php echo EDUFAX_THEME_URI . '/assets' ?>/images/book_icon.svg" alt="book"
                        class="img-fluid w-100">
                </span>
                <?php echo esc_html(tutor_utils()->get_lesson_count_by_course( get_the_ID() ));?>
                <?php echo  __( 'Lessons', 'edufax' )  ?>
            </li>
            <li>
                <span class="icon">
                    <img src="<?php echo EDUFAX_THEME_URI . '/assets' ?>/images/star_icon.svg" alt="start"
                        class="img-fluid w-100">
                </span>
                <?php echo esc_html($ratings_average); ?> <span
                    class="d-block ml_5">(<?php echo esc_html($total_ratings); ?>)</span>
            </li>
        </ul>
        <a class="title" href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a>
    </div>
    <ul class="tf__single_courses_footer d-flex flex-wrap justify-content-between">
        <?php if( ! $disable_course ) : ?>
        <li>
            <span>
                <img src="<?php echo EDUFAX_THEME_URI . '/assets' ?>/images/user_icon.svg" alt="user"
                    class="img-fluid w-100">
            </span>
            <?php echo esc_html($enrolled); ?> <?php echo  __( 'Enrolled', 'edufax' )  ?>
        </li>
        <?php endif; ?>
        <li>
            <span>
                <img src="<?php echo EDUFAX_THEME_URI . '/assets' ?>/images/doller_icon.svg" alt="user"
                    class="img-fluid w-100">
            </span>
            <?php echo wp_kses_post($price) ?>
        </li>
    </ul>
</div>
<?php