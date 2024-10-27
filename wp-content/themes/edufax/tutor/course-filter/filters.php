<?php
var_dump("Hello World");
$filter_object = new \TUTOR\Course_Filter();
$filter_levels = array(
    'beginner' => __('Beginner', 'educal'),
    'intermediate' => __('Intermediate', 'educal'),
    'expert' => __('Expert', 'educal')
);
$filter_prices = array(
    'free' => __('Free', 'educal'),
    'paid' => __('Paid', 'educal'),
);

$supported_filters = tutor_utils()->get_option('supported_course_filters', array());
$supported_filters = array_keys($supported_filters);
?>
<form>
    <?php do_action('tutor_course_filter/before'); ?>
    <?php
    if (in_array('search', $supported_filters)) {
    ?>
    <div class="tutor-course-search-fields course__sidebar-search mb-50">
        <input type="text" name="keyword" placeholder="<?php _e('Search...', 'educal'); ?>" />
        <button type="submit"><i class="far fa-search"></i></button>
    </div>
    <?php
    }
    ?>
    <div>
        <?php
        if (in_array('category', $supported_filters)) {
        ?>
        <div class="course__sidebar-widget grey-bg">
            <h4 class="course__sidebar-title"><?php _e('Category', 'educal'); ?></h4>
            <?php $filter_object->render_terms('category'); ?>
        </div>
        <?php
        }

        if (in_array('tag', $supported_filters)) {
        ?>
        <div class="course__sidebar-widget grey-bg">
            <h4 class="course__sidebar-title"><?php _e('Tag', 'educal'); ?></h4>
            <?php $filter_object->render_terms('tag'); ?>
        </div>
        <?php
        }
        ?>
    </div>
    <div>
        <?php
        if (in_array('difficulty_level', $supported_filters)) {
        ?>
        <div class="course__sidebar-widget grey-bg">
            <h4 class="course__sidebar-title"><?php _e('Level', 'educal'); ?></h4>
            <?php
                foreach ($filter_levels as $value => $title) {
                ?>
            <div class="tutor-course-filter-nested-terms">
                <label>
                    <input type="checkbox" name="tutor-course-filter-level"
                        value="<?php echo esc_attr($value); ?>" />&nbsp;
                    <?php echo esc_html($title); ?>
                </label>
            </div>
            <?php
                }
                ?>
        </div>
        <?php
        }


        $is_membership = get_tutor_option('monetize_by') == 'pmpro' && tutils()->has_pmpro();
        if (!$is_membership && in_array('price_type', $supported_filters)) {
        ?>
        <div class="course__sidebar-widget grey-bg">
            <h4 class="course__sidebar-title"><?php _e('Price', 'educal'); ?></h4>
            <?php
                foreach ($filter_prices as $value => $title) {
                ?>
            <div class="tutor-course-filter-nested-terms">
                <label>
                    <input type="checkbox" name="tutor-course-filter-price"
                        value="<?php echo esc_attr($value); ?>" />&nbsp;
                    <?php echo esc_html($title); ?>
                </label>
            </div>
            <?php
                }
                ?>
        </div>
        <?php
        }
        ?>
    </div>
    <div class="tutor-clear-all-filter">
        <a href="#" onclick="window.location.reload()">
            <i class="tutor-icon-cross"></i> Clear All Filter
        </a>
    </div>
    <?php do_action('tutor_course_filter/after'); ?>
</form>