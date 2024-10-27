<?php

namespace MSCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Box_Shadow;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Ms Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class MS_Blog_Post extends Widget_Base
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
      return 'blogpost';
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
      return __('Blog Post', 'mscore');
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
      return 'ms-icon';
   }

   /**
    * Retrieve the list of categories the widget belongs to.
    *
    * Used to determine where to display the widget in the editor.
    *
    * Note that currently Elementor supports only one category.
    * When multiple categories passed, Elementor uses the first one.
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
    * Used to set scripts dependencies required to run the widget.
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
    * Adds different input fields to allow the user to change and customize the widget settings.
    *
    * @since 1.0.0
    *
    * @access protected
    */
   protected function register_controls()
   {
      $this->register_controls_section();
   }

   protected function register_controls_section()
   {
      $this->start_controls_section(
         'ms_blog_settings',
         [
            'label' => __('Blog Settings', 'mscore'),
            'tab' => Controls_Manager::TAB_CONTENT,
         ]
      );

      $this->add_control(
         'ms_blog_title',
         [
            'label' => __('Blog Title', 'mscore'),
            'type' => Controls_Manager::TEXT,
            'default' => __('Default Blog Title', 'mscore'),
         ]
      );

      $this->add_control(
         'ms_blog_description',
         [
            'label' => __('Blog Description', 'mscore'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => __('Default Blog Description', 'mscore'),
         ]
      );


      $this->end_controls_section();

      // Blog Query
      $this->ms_query_controls('blog', 'Blog');
   }



   /**
    * Render the widget output on the frontend.
    *
    * Written in PHP and used to generate the final HTML.
    *
    * @since 1.0.0
    *
    * @access protected
    */
   protected function render()
   {
      $settings = $this->get_settings_for_display();

      /**
       * Setup the post arguments.
       */
      $query_args = MS_Helper::get_query_args('post', 'category', $this->get_settings());

      // The Query
      $query = new \WP_Query($query_args);
?>

<!-- blog area start -->
<section class="tf__blog pt_110 xs_pt_75 pb_100 xs_pb_60" style="background: url(images/blog_bg.jpg);">
    <div class="container">
        <?php if (!empty($settings['ms_blog_title'])) : ?>
        <div class="row">
            <div class="col-xl-6 col-md-9 col-lg-7 m-auto">
                <div class="tf__section_heading heading_center mb_30 xs_mb_30">
                    <?php if (!empty($settings['ms_blog_title'])) : ?>
                    <h2>
                        <?php echo ms_kses($settings['ms_blog_title']); ?>
                    </h2>
                    <?php endif; ?>
                    <?php if (!empty($settings['ms_blog_description'])) : ?>
                    <p><?php echo ms_kses($settings['ms_blog_description']); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="row blog_slider">
            <?php if ($query->have_posts()) : ?>
            <?php while ($query->have_posts()) :
                     $query->the_post();
                     global $post;
                     $categories = get_the_category($post->ID);

                  ?>
            <div class="col-xl-4 wow fadeInUp" data-wow-duration="1s">
                <div class="tf__single_blog">
                    <?php if (has_post_thumbnail()) : ?>
                    <div class="tf__single_blog_img">
                        <?php the_post_thumbnail($post->ID); ?>
                    </div>
                    <?php endif; ?>
                    <div class="tf__single_blog_text">
                        <ul>
                            <li>
                                <span>
                                    <?php echo get_avatar(get_the_author_meta('ID'), 32); // Display the author's avatar 
                                       ?>
                                </span>
                                <?php echo get_the_author(); // Display the author's name 
                                    ?>
                            </li>
                            <li><i class="fal fa-calendar-alt"></i> <?php echo get_the_date(); ?>
                            </li>
                        </ul>
                        <a class="title"
                            href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['ms_blog_title_word'], ''); ?></a>
                        <div class="tf__single_blog_footer">
                            <?php if (!empty($settings['ms_post_button'])) : ?>
                            <a href="<?php the_permalink(); ?>"><?php echo ms_kses($settings['ms_post_button']); ?><i
                                    class="far fa-long-arrow-right"></i></a>
                            <?php endif; ?>
                            <span><i class="far fa-eye"></i> 80 View</span>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile;
                  wp_reset_query(); ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php
   }
}

$widgets_manager->register(new MS_Blog_Post());