<?php

/**
 * Course Loop End
 *
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

if (! defined('ABSPATH')) {
	exit;
}
$shortcode_arg = isset($GLOBALS['tutor_shortcode_arg']) ? $GLOBALS['tutor_shortcode_arg']['column_per_row'] : null;
$courseCols = $shortcode_arg === null ? tutor_utils()->get_option('courses_col_per_row', 3) : $shortcode_arg;
?>
<div class="col-xl-<?php echo esc_attr($courseCols); ?> col-md-6 wow fadeInUp" data-wow-duration="1s">