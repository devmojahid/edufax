<?php get_header();
global $post;

use \Etn\Utils\Helper;

$single_event_id = get_the_id();
$categories = get_the_terms($single_event_id, 'etn_category');
$etn_terms = get_the_terms($single_event_id, 'etn_tags');
$event_options = get_option("etn_event_options");
$data = Helper::single_template_options($single_event_id);
$start_date = get_post_meta($single_event_id, 'etn_start_date', true);
$start_date_year_month = !empty($start_date) ? date("F d, Y", strtotime($start_date)) : '';

// Event details
$event_title = get_the_title($single_event_id);
$event_content = get_the_content($single_event_id);
$event_start_date = !empty($data['event_start_date']) ? $data['event_start_date'] : '';
$event_start_time = !empty($data['event_start_time']) ? $data['event_start_time'] : '';
$event_end_time = !empty($data['event_end_time']) ? $data['event_end_time'] : '';
$event_location = !empty($data['etn_event_location']) ? $data['etn_event_location'] : '';
$event_thumbnail = get_the_post_thumbnail_url($single_event_id, 'full');

// Sidebar details
$ongoing_count = !empty($data['etn_total_booked']) ? $data['etn_total_booked'] : 0;
$event_price = !empty($data['etn_ticket_price']) ? $data['etn_ticket_price'] : '';
?>

<!-- event details area start -->
<section class="tf__event_details_page pt_120 xs_pt_80 pb_120 xs_pb_80">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 wow fadeInUp" data-wow-duration="1s">
                <div class="tf__event_details_area">
                    <?php if (!empty($event_thumbnail)) : ?>
                    <div class="tf__event_details_img">
                        <img src="<?php echo esc_url($event_thumbnail); ?>" alt="<?php echo esc_attr($event_title); ?>"
                            class="img-fluid w-100">
                    </div>
                    <?php endif; ?>

                    <h2><?php echo esc_html($event_title); ?></h2>

                    <div class="tf__event_details_text">
                        <h3><?php echo esc_html__('Description', 'mojar-core'); ?></h3>
                        <?php echo wp_kses_post($event_content); ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="tf__sidebar" id="sticky_sidebar">
                    <div class="tf__sidebar_course_enrole">
                        <h3><?php echo esc_html__('Event Booking', 'mojar-core'); ?></h3>
                        <ul class="list">
                            <?php if (!empty($event_start_date)) : ?>
                            <li><span><i class="fal fa-calendar-alt"></i>
                                    <?php echo esc_html__('Start Date :', 'mojar-core'); ?></span>
                                <?php echo esc_html($event_start_date); ?></li>
                            <?php endif; ?>

                            <?php if (!empty($event_start_time)) : ?>
                            <li><span><i class="far fa-clock"></i>
                                    <?php echo esc_html__('Start Time :', 'mojar-core'); ?></span>
                                <?php echo esc_html($event_start_time); ?></li>
                            <?php endif; ?>

                            <?php if (!empty($ongoing_count)) : ?>
                            <li><span><i class="far fa-user"></i>
                                    <?php echo esc_html__('Ongoing :', 'mojar-core'); ?></span>
                                <?php echo esc_html($ongoing_count); ?></li>
                            <?php endif; ?>

                            <?php if (!empty($event_location)) : ?>

                            <li><span><i class="far fa-map-marker-alt"></i>
                                    <?php echo esc_html__('Location :', 'mojar-core'); ?></span>
                                <?php
                                    if (is_array($event_location)) {
                                        echo esc_html(implode(', ', $event_location));
                                    } else {
                                        echo esc_html($event_location);
                                    }
                                    ?></li>
                            <?php endif; ?>
                        </ul>

                        <?php if (!empty($event_price)) : ?>
                        <a class="tf__common_btn2"
                            href="#"><?php echo esc_html__('Price : ', 'mojar-core') . esc_html($event_price); ?></a>
                        <?php endif; ?>

                        <a class="tf__common_btn" href="#"><?php echo esc_html__('Enroll Now', 'mojar-core'); ?></a>

                        <?php
                        // Add social sharing buttons if needed
                        if (function_exists('mojar_social_share')) {
                            mojar_social_share();
                        }
                        ?>
                    </div>

                    <?php
                    // Recent Events
                    $recent_events = get_posts(array(
                        'post_type' => 'etn',
                        'posts_per_page' => 4,
                        'post__not_in' => array($single_event_id),
                    ));

                    if (!empty($recent_events)) :
                    ?>
                    <div class="tf__sidebar_event">
                        <h3><?php echo esc_html__('Recent Events', 'mojar-core'); ?></h3>
                        <ul>
                            <?php foreach ($recent_events as $recent_event) :
                                    $recent_event_id = $recent_event->ID;
                                    $recent_event_date = get_post_meta($recent_event_id, 'etn_start_date', true);
                                    $recent_event_time = get_post_meta($recent_event_id, 'etn_start_time', true);
                                    $recent_event_location = get_post_meta($recent_event_id, 'etn_event_location', true);
                                ?>
                            <li>
                                <div class="date">
                                    <h4><?php echo !empty($recent_event_date) ? esc_html(date('d', strtotime($recent_event_date))) : ''; ?>
                                    </h4>
                                    <p><?php echo !empty($recent_event_date) ? esc_html(date('M Y', strtotime($recent_event_date))) : ''; ?>
                                    </p>
                                </div>
                                <div class="text">
                                    <a
                                        href="<?php echo esc_url(get_permalink($recent_event_id)); ?>"><?php echo esc_html(get_the_title($recent_event_id)); ?></a>
                                    <p>
                                        <?php if (!empty($recent_event_time)) : ?>
                                        <span><i class="far fa-clock"></i>
                                            <?php echo esc_html($recent_event_time); ?></span>
                                        <?php endif; ?>
                                        <?php if (!empty($recent_event_location)) : ?>
                                        <span><i class="far fa-map-marker-alt"></i>
                                            <?php echo is_array($recent_event_location) ? esc_html(implode(', ', $recent_event_location)) : esc_html($recent_event_location); ?></span>
                                        <?php endif; ?>
                                    </p>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- event details area end -->

<?php
do_action("etn_before_single_event_meta", $single_event_id);
do_action("etn_single_event_meta", $single_event_id);

get_footer();