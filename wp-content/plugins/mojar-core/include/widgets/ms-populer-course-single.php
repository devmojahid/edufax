<?php

/**
 * MSCore Popular Course Widget
 *
 * @author      Theme_Pure
 * @category    Widgets
 * @package     MSCore/Widgets
 * @version     1.0.0
 * @extends     WP_Widget
 */

class MS_Popular_Course_Widget extends WP_Widget
{
	public function __construct()
	{
		parent::__construct('ms_popular_course', 'Popular Course', array(
			'description'   => 'Show Popular Course Widget By Mojar'
		));
	}

	public function widget($args, $instance)
	{
		extract($args);
		extract($instance);

		echo $before_widget;

		if ($instance['title']) :
			echo $before_title;
			echo apply_filters('widget_title', $instance['title']);
			echo $after_title;
		endif;
?>

<ul>
    <?php
			$course_args = array(
				'post_type'      => tutor()->course_post_type,
				'posts_per_page' => ($instance['count']) ? $instance['count'] : '3',
				'order'          => ($instance['posts_order']) ? $instance['posts_order'] : 'DESC',
				'orderby'        => 'date'
			);

			$courses = new WP_Query($course_args);

			if ($courses->have_posts()) :
				while ($courses->have_posts()) : $courses->the_post();
					$course_id = get_the_ID();
					$course_rating = tutor_utils()->get_course_rating($course_id);
					$lesson_count = tutor_utils()->get_lesson_count_by_course($course_id);
			?>
    <li>
        <div class="img">
            <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('thumbnail', array('class' => 'img-fluid w-100')); ?>
            <?php endif; ?>
        </div>
        <div class="text">
            <a
                href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $instance['title_length'], '...'); ?></a>
            <p>
                <span>
                    <img src="<?php echo get_template_directory_uri() . '/assets/images/book_icon.svg' ?>" alt="book"
                        class="img-fluid w-100">
                    <?php echo esc_html($lesson_count); ?> <?php echo esc_html($instance['lesson_text']); ?>
                </span>
                <span>
                    <img src="<?php echo get_template_directory_uri() . '/assets/images/star_icon.svg' ?>" alt="star"
                        class="img-fluid w-100">
                    <?php echo number_format($course_rating->rating_avg, 1); ?>
                    (<?php echo esc_html($course_rating->rating_count); ?>)
                </span>
            </p>
        </div>
    </li>
    <?php
				endwhile;
			endif;
			wp_reset_postdata();
			?>
</ul>
<?php

		echo $after_widget;
	}

	public function form($instance)
	{
		$title = !empty($instance['title']) ? $instance['title'] : '';
		$count = !empty($instance['count']) ? $instance['count'] : '3';
		$posts_order = !empty($instance['posts_order']) ? $instance['posts_order'] : 'DESC';
		$title_length = !empty($instance['title_length']) ? $instance['title_length'] : '10';
		$lesson_icon = !empty($instance['lesson_icon']) ? $instance['lesson_icon'] : get_template_directory_uri() . '/assets/img/book_icon.svg';
		$rating_icon = !empty($instance['rating_icon']) ? $instance['rating_icon'] : get_template_directory_uri() . '/assets/img/star_icon.svg';
		$lesson_text = !empty($instance['lesson_text']) ? $instance['lesson_text'] : 'Lesson';
	?>
<p>
    <label for="<?php echo $this->get_field_id('title'); ?>">Widget Title</label>
    <input type="text" name="<?php echo $this->get_field_name('title'); ?>"
        id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo esc_attr($title); ?>" class="widefat">
</p>

<p>
    <label for="<?php echo $this->get_field_id('count'); ?>">Number of courses to show</label>
    <input type="number" name="<?php echo $this->get_field_name('count'); ?>"
        id="<?php echo $this->get_field_id('count'); ?>" value="<?php echo esc_attr($count); ?>" class="widefat">
</p>

<p>
    <label for="<?php echo $this->get_field_id('posts_order'); ?>">Courses Order</label>
    <select name="<?php echo $this->get_field_name('posts_order'); ?>"
        id="<?php echo $this->get_field_id('posts_order'); ?>" class="widefat">
        <option value="ASC" <?php selected($posts_order, 'ASC'); ?>>ASC</option>
        <option value="DESC" <?php selected($posts_order, 'DESC'); ?>>DESC</option>
    </select>
</p>

<p>
    <label for="<?php echo $this->get_field_id('title_length'); ?>">Title Length (words)</label>
    <input type="number" name="<?php echo $this->get_field_name('title_length'); ?>"
        id="<?php echo $this->get_field_id('title_length'); ?>" value="<?php echo esc_attr($title_length); ?>"
        class="widefat">
</p>

<p>
    <label for="<?php echo $this->get_field_id('lesson_icon'); ?>">Lesson Icon URL</label>
    <input type="text" name="<?php echo $this->get_field_name('lesson_icon'); ?>"
        id="<?php echo $this->get_field_id('lesson_icon'); ?>" value="<?php echo esc_attr($lesson_icon); ?>"
        class="widefat">
</p>

<p>
    <label for="<?php echo $this->get_field_id('rating_icon'); ?>">Rating Icon URL</label>
    <input type="text" name="<?php echo $this->get_field_name('rating_icon'); ?>"
        id="<?php echo $this->get_field_id('rating_icon'); ?>" value="<?php echo esc_attr($rating_icon); ?>"
        class="widefat">
</p>

<p>
    <label for="<?php echo $this->get_field_id('lesson_text'); ?>">Lesson Text</label>
    <input type="text" name="<?php echo $this->get_field_name('lesson_text'); ?>"
        id="<?php echo $this->get_field_id('lesson_text'); ?>" value="<?php echo esc_attr($lesson_text); ?>"
        class="widefat">
</p>
<?php
	}

	public function update($new_instance, $old_instance)
	{
		$instance = array();
		$instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
		$instance['count'] = (!empty($new_instance['count'])) ? absint($new_instance['count']) : 3;
		$instance['posts_order'] = (!empty($new_instance['posts_order'])) ? sanitize_text_field($new_instance['posts_order']) : 'DESC';
		$instance['title_length'] = (!empty($new_instance['title_length'])) ? absint($new_instance['title_length']) : 10;
		$instance['lesson_icon'] = (!empty($new_instance['lesson_icon'])) ? esc_url_raw($new_instance['lesson_icon']) : '';
		$instance['rating_icon'] = (!empty($new_instance['rating_icon'])) ? esc_url_raw($new_instance['rating_icon']) : '';
		$instance['lesson_text'] = (!empty($new_instance['lesson_text'])) ? sanitize_text_field($new_instance['lesson_text']) : 'Lesson';

		return $instance;
	}
}

add_action('widgets_init', function () {
	register_widget('MS_Popular_Course_Widget');
});