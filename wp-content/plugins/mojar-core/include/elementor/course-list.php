<?php

namespace MSCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Repeater;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Ms Core
 *
 * Elementor widget for course list.
 *
 * @since 1.0.0
 */
class MS_Course_List extends Widget_Base
{

   use \MSCore\Widgets\MSCoreElementFunctions;

   /**
    * Retrieve the widget name.
    *
    * @since 1.0.0
    *
    * @access public
    *
    * @return string Widget name.
    */
   public function get_name()
   {
      return 'ms-course-list';
   }

   /**
    * Retrieve the widget title.
    *
    * @since 1.0.0
    *
    * @access public
    *
    * @return string Widget title.
    */
   public function get_title()
   {
      return __('Course List', 'mscore');
   }

   /**
    * Retrieve the widget icon.
    *
    * @since 1.0.0
    *
    * @access public
    *
    * @return string Widget icon.
    */
   public function get_icon()
   {
      return 'eicon-posts-grid';
   }

   /**
    * Retrieve the list of categories the widget belongs to.
    *
    * @since 1.0.0
    *
    * @access public
    *
    * @return array Widget categories.
    */
   public function get_categories()
   {
      return ['mscore'];
   }

   /**
    * Retrieve the list of scripts the widget depended on.
    *
    * @since 1.0.0
    *
    * @access public
    *
    * @return array Widget scripts dependencies.
    */
   public function get_script_depends()
   {
      return ['mscore'];
   }

   /**
    * Register the widget controls.
    *
    * @since 1.0.0
    *
    * @access protected
    */
   protected function register_controls()
   {
      $this->start_controls_section(
         'content_section',
         [
            'label' => __('Content', 'mscore'),
            'tab' => Controls_Manager::TAB_CONTENT,
         ]
      );

      $this->add_control(
         'title',
         [
            'label' => __('Title', 'mscore'),
            'type' => Controls_Manager::TEXT,
            'default' => __('Our Popular Courses', 'mscore'),
         ]
      );

      $this->add_control(
         'description',
         [
            'label' => __('Description', 'mscore'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => __('Take your learning organization to the next level. Who will share their knowledge to people around the world.', 'mscore'),
         ]
      );

      $this->end_controls_section();

      $this->start_controls_section(
         'query_section',
         [
            'label' => __('Query', 'mscore'),
            'tab' => Controls_Manager::TAB_CONTENT,
         ]
      );

      $this->add_control(
         'number_of_courses',
         [
            'label' => __('Number of Courses', 'mscore'),
            'type' => Controls_Manager::NUMBER,
            'min' => 1,
            'max' => 20,
            'step' => 1,
            'default' => 3,
         ]
      );

      $this->add_control(
         'order',
         [
            'label' => __('Order', 'mscore'),
            'type' => Controls_Manager::SELECT,
            'default' => 'DESC',
            'options' => [
               'ASC' => __('Ascending', 'mscore'),
               'DESC' => __('Descending', 'mscore'),
            ],
         ]
      );

      $this->add_control(
         'orderby',
         [
            'label' => __('Order By', 'mscore'),
            'type' => Controls_Manager::SELECT,
            'default' => 'date',
            'options' => [
               'date' => __('Date', 'mscore'),
               'title' => __('Title', 'mscore'),
               'menu_order' => __('Menu Order', 'mscore'),
               'rand' => __('Random', 'mscore'),
            ],
         ]
      );

      $this->add_control(
         'specific_courses',
         [
            'label' => __('Specific Courses', 'mscore'),
            'type' => Controls_Manager::SELECT2,
            'options' => $this->get_courses(),
            'multiple' => true,
            'label_block' => true,
         ]
      );

      $this->end_controls_section();

      $this->start_controls_section(
         'style_section',
         [
            'label' => __('Style', 'mscore'),
            'tab' => Controls_Manager::TAB_STYLE,
         ]
      );

      $this->add_control(
         'title_color',
         [
            'label' => __('Title Color', 'mscore'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}} .tf__section_heading h2' => 'color: {{VALUE}};',
            ],
         ]
      );

      $this->add_group_control(
         Group_Control_Typography::get_type(),
         [
            'name' => 'title_typography',
            'label' => __('Title Typography', 'mscore'),
            'selector' => '{{WRAPPER}} .tf__section_heading h2',
         ]
      );

      $this->add_control(
         'description_color',
         [
            'label' => __('Description Color', 'mscore'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}} .tf__section_heading p' => 'color: {{VALUE}};',
            ],
         ]
      );

      $this->add_group_control(
         Group_Control_Typography::get_type(),
         [
            'name' => 'description_typography',
            'label' => __('Description Typography', 'mscore'),
            'selector' => '{{WRAPPER}} .tf__section_heading p',
         ]
      );

      $this->end_controls_section();
   }

   /**
    * Render the widget output on the frontend.
    *
    * @since 1.0.0
    *
    * @access protected
    */
   protected function render()
   {
      $settings = $this->get_settings_for_display();

      $args = [
         'post_type' => tutor()->course_post_type,
         'posts_per_page' => $settings['number_of_courses'],
         'order' => $settings['order'],
         'orderby' => $settings['orderby'],
      ];

      if (!empty($settings['specific_courses'])) {
         $args['post__in'] = $settings['specific_courses'];
      }

      $courses = new \WP_Query($args);

?>
<section class="tf__courses pt_110 xs_pt_75 pb_120 xs_pb_80" style="background: url(images/courses_bg.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-md-9 col-lg-7 m-auto">
                <div class="tf__section_heading heading_center mb_30">
                    <h2><?php echo esc_html($settings['title']); ?></h2>
                    <p><?php echo esc_html($settings['description']); ?></p>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
               if ($courses->have_posts()) :
                  while ($courses->have_posts()) : $courses->the_post();
                     $course_id = get_the_ID();
                     $category = get_tutor_course_categories();
                     $rating = tutor_utils()->get_course_rating($course_id);
                     $students = tutor_utils()->count_enrolled_users_by_course($course_id);
                     $price = tutor_utils()->get_course_price($course_id);
               ?>
            <div class="col-xl-4 col-md-6 wow fadeInUp" data-wow-duration="1s">
                <div class="tf__single_courses">
                    <div class="tf__single_courses_img">
                        <?php the_post_thumbnail('full', ['class' => 'img-fluid w-100']); ?>
                        <?php if (!empty($category)) : ?>
                        <a class="category"
                            href="<?php echo get_term_link($category[0]->term_id); ?>"><?php echo esc_html($category[0]->name); ?></a>
                        <?php endif; ?>
                    </div>
                    <div class="tf__single_courses_text">
                        <ul class="d-flex flex-wrap justify-content-between">
                            <li>
                                <span class="icon">
                                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/book_icon.svg'); ?>"
                                        alt="book" class="img-fluid w-100">
                                </span>
                                <?php echo esc_html(tutor_utils()->get_lesson_count_by_course($course_id)); ?>
                                <?php esc_html_e('Lesson', 'mscore'); ?>
                            </li>
                            <li>
                                <span class="icon">
                                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/star_icon.svg'); ?>"
                                        alt="start" class="img-fluid w-100">
                                </span>
                                <?php echo esc_html($rating->rating_avg); ?> <span
                                    class="d-block ml_5">(<?php echo esc_html($rating->rating_count); ?>)</span>
                            </li>
                        </ul>
                        <a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </div>
                    <ul class="tf__single_courses_footer d-flex flex-wrap justify-content-between">
                        <li>
                            <span>
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/user_icon.svg'); ?>"
                                    alt="user" class="img-fluid w-100">
                            </span>
                            <?php echo esc_html($students); ?> <?php esc_html_e('Students', 'mscore'); ?>
                        </li>
                        <li>
                            <span>
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/doller_icon.svg'); ?>"
                                    alt="user" class="img-fluid w-100">
                            </span>
                            <?php echo esc_html($price); ?>
                        </li>
                    </ul>
                </div>
            </div>
            <?php
                  endwhile;
                  wp_reset_postdata();
               endif;
               ?>
        </div>
    </div>
</section>
<?php
   }

   /**
    * Get all courses for the specific courses control.
    *
    * @return array
    */
   private function get_courses()
   {
      $courses = get_posts([
         'post_type' => tutor()->course_post_type,
         'posts_per_page' => -1,
      ]);

      $options = [];

      foreach ($courses as $course) {
         $options[$course->ID] = $course->post_title;
      }

      return $options;
   }
}

$widgets_manager->register(new MS_Course_List());