<?php

/**
 * MSCore Sidebar Posts Image
 *
 * @author      Theme_Pure
 * @category    Widgets
 * @package     MSCore/Widgets
 * @version     1.0.0
 * @extends     WP_Widget
 */

class MS_Post_Sidebar_Widget extends WP_Widget
{
	public function __construct()
	{
		parent::__construct('ms-latest-posts', 'MS Sidebar Posts Image', array(
			'description'   => 'Latest Blog Post Widget by Mojar'
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
		<div class="tf__sidebar_post post-sidebar-sow">
			<ul>
				<?php
				$q = new WP_Query(array(
					'post_type'     => 'post',
					'posts_per_page' => ($instance['count']) ? $instance['count'] : '3',
					'order'         => ($instance['posts_order']) ? $instance['posts_order'] : 'DESC',
					'orderby'       => 'date'
				));

				if ($q->have_posts()) :
					while ($q->have_posts()) : $q->the_post();
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
								<p><i class="<?php echo esc_attr($instance['date_icon']); ?>"></i>
									<?php echo get_the_date($instance['date_format']); ?></p>
							</div>
						</li>
				<?php
					endwhile;
				endif;
				wp_reset_postdata();
				?>
			</ul>
		</div>
	<?php

		echo $after_widget;
	}

	public function form($instance)
	{
		$title = !empty($instance['title']) ? $instance['title'] : '';
		$count = !empty($instance['count']) ? $instance['count'] : '3';
		$posts_order = !empty($instance['posts_order']) ? $instance['posts_order'] : 'DESC';
		$title_length = !empty($instance['title_length']) ? $instance['title_length'] : '10';
		$date_format = !empty($instance['date_format']) ? $instance['date_format'] : 'd M, Y';
		$date_icon = !empty($instance['date_icon']) ? $instance['date_icon'] : 'fal fa-calendar-alt';
	?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Widget Title</label>
			<input type="text" name="<?php echo $this->get_field_name('title'); ?>"
				id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo esc_attr($title); ?>" class="widefat">
		</p>


		<p>
			<label for="<?php echo $this->get_field_id('count'); ?>">Number of posts to show</label>
			<input type="number" name="<?php echo $this->get_field_name('count'); ?>"
				id="<?php echo $this->get_field_id('count'); ?>" value="<?php echo esc_attr($count); ?>" class="widefat">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('posts_order'); ?>">Posts Order</label>
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
			<label for="<?php echo $this->get_field_id('date_format'); ?>">Date Format</label>
			<input type="text" name="<?php echo $this->get_field_name('date_format'); ?>"
				id="<?php echo $this->get_field_id('date_format'); ?>" value="<?php echo esc_attr($date_format); ?>"
				class="widefat">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('date_icon'); ?>">Date Icon Class</label>
			<input type="text" name="<?php echo $this->get_field_name('date_icon'); ?>"
				id="<?php echo $this->get_field_id('date_icon'); ?>" value="<?php echo esc_attr($date_icon); ?>"
				class="widefat">
		</p>
<?php
	}

	public function update($new_instance, $old_instance)
	{
		$instance = array();
		$instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
		$instance['count'] = (!empty($new_instance['count'])) ? absint($new_instance['count']) : 3;
		$instance['posts_order'] = (!empty($new_instance['posts_order'])) ? $new_instance['posts_order'] : 'DESC';
		$instance['title_length'] = (!empty($new_instance['title_length'])) ? absint($new_instance['title_length']) : 10;
		$instance['date_format'] = (!empty($new_instance['date_format'])) ? $new_instance['date_format'] : 'd M, Y';
		$instance['date_icon'] = (!empty($new_instance['date_icon'])) ? $new_instance['date_icon'] : 'fal fa-calendar-alt';

		return $instance;
	}
}

add_action('widgets_init', function () {
	register_widget('MS_Post_Sidebar_Widget');
});
