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
      $this->style_tab_content();
   }

   protected function register_controls_section()
   {

      $this->ms_section_title_render_controls('blog', 'Section - Title & Desciption', ['layout-1', 'layout-2']);

      // ms_btn_button_group
      $this->ms_button_render_controls('tpbtn', 'Button', ['layout-1', 'layout-2']);

      // Blog Query
      $this->ms_query_controls('blog', 'Blog');

      // layout Panel
      $this->ms_post_layout('post', 'Blog');

      // ms_post__columns_section
      $this->ms_columns('col', 'Blog Column');
   }

   // style_tab_content
   protected function style_tab_content()
   {
      $this->ms_section_style_controls('blog_section', 'Section - Style', '.ms-el-section');
      $this->ms_basic_style_controls('blog_subtitle', 'Blog - Subtitle', '.ms-el-subtitle');
      $this->ms_basic_style_controls('blog_title', 'Blog - Title', '.ms-el-title');
      $this->ms_basic_style_controls('blog_description', 'Blog - Description', '.ms-el-content p');
      $this->ms_link_controls_style('blog_box_btn', 'Blog - Button', '.ms-el-btn');


      $this->ms_basic_style_controls('blog_box_title', 'Box - Title', '.ms-el-box-title');
      $this->ms_basic_style_controls('blog_box_desc', 'Box - Description', '.ms-el-box-desc');
      $this->ms_link_controls_style('blog_box_tag', 'Box - Tag', '.ms-el-box-tag');
      $this->ms_basic_style_controls('blog_box_meta', 'Box - Meta', '.ms-el-box-meta span');
      $this->ms_link_controls_style('blog_box_btn_2', 'Box - Button', '.ms-el-box-btn');
      $this->ms_link_controls_style('blog_box_author', 'Box - Author', '.ms-el-author-title');
      $this->ms_link_controls_style('blog_box_arrow', 'Box - Author', '.ms-el-box-arrow');
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


      $filter_list = $settings['category'];

      $control_id = 'tpbtn';
?>

      <?php if ($settings['ms_design_style']  == 'layout-2') :
         $this->add_render_attribute('title_args', 'class', 'ms-section-title-2 ms-el-title');

         $this->ms_link_controls_render('tpbtn', 'ms-btn ms-btn-border ms-btn-border-sm', $this->get_settings());
      ?>

         <!-- blog area start -->
         <section class="ms-blog-area pt-110 pb-120">
            <div class="container">
               <?php if (!empty($settings['ms_blog_section_title_show'])) : ?>
                  <div class="row">
                     <div class="col-xl-12">
                        <div class="ms-section-title-wrapper-2 mb-50 text-center">
                           <?php if (!empty($settings['ms_blog_sub_title'])) : ?>
                              <span class="ms-section-title-pre-2 ms-el-subtitle"><?php echo ms_kses($settings['ms_blog_sub_title']); ?></span>
                           <?php endif; ?>
                           <?php
                           if (!empty($settings['ms_blog_title'])) :
                              printf(
                                 '<%1$s %2$s>%3$s</%1$s>',
                                 tag_escape($settings['ms_blog_title_tag']),
                                 $this->get_render_attribute_string('title_args'),
                                 ms_kses($settings['ms_blog_title'])
                              );
                           endif;
                           ?>
                           <?php if (!empty($settings['ms_blog_description'])) : ?>
                              <p><?php echo ms_kses($settings['ms_blog_description']); ?></p>
                           <?php endif; ?>
                        </div>
                     </div>
                  </div>
               <?php endif; ?>

               <div class="row">
                  <?php if ($query->have_posts()) : ?>
                     <?php while ($query->have_posts()) :
                        $query->the_post();
                        global $post;

                        $categories = get_the_category($post->ID);

                     ?>

                        <div class="col-xl-<?php echo esc_attr($settings['ms_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['ms_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['ms_col_for_tablet']); ?> col-<?php echo esc_attr($settings['ms_col_for_mobile']); ?>">
                           <div class="ms-blog-item-2 mb-40">
                              <?php if (has_post_thumbnail()) : ?>
                                 <div class="ms-blog-thumb-2 p-relative fix">
                                    <a href="<?php the_permalink(); ?>">
                                       <?php the_post_thumbnail($post->ID, $settings['thumbnail_size']); ?>
                                    </a>
                                    <div class="ms-blog-meta-date-2">
                                       <span><?php the_time(get_option('date_format')); ?></span>
                                    </div>
                                 </div>
                              <?php endif; ?>
                              <div class="ms-blog-content-2 has-thumbnail">
                                 <div class="ms-blog-meta-2">
                                    <span>
                                       <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M12.636 8.14182L8.14808 12.6297C8.03182 12.7461 7.89375 12.8384 7.74178 12.9014C7.58981 12.9644 7.42691 12.9969 7.26239 12.9969C7.09788 12.9969 6.93498 12.9644 6.78301 12.9014C6.63104 12.8384 6.49297 12.7461 6.37671 12.6297L1 7.25926V1H7.25926L12.636 6.37671C12.8691 6.61126 13 6.92854 13 7.25926C13 7.58998 12.8691 7.90727 12.636 8.14182V8.14182Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                          <path d="M4.12964 4.12988H4.13694" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                       </svg>
                                    </span>
                                    <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a>
                                 </div>
                                 <h3 class="ms-blog-title-2">
                                    <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['ms_blog_title_word'], ''); ?></a>
                                 </h3>
                              </div>
                           </div>
                        </div>
                     <?php endwhile;
                     wp_reset_query(); ?>
                  <?php endif; ?>
               </div>

               <?php if ($settings['ms_' . $control_id . '_button_show'] == 'yes') : ?>
                  <div class="row">
                     <div class="col-xl-12">
                        <div class="ms-blog-more-2 mt-10 text-center">
                           <a <?php echo $this->get_render_attribute_string('ms-button-arg'); ?>> <?php echo ms_kses($settings['ms_' . $control_id . '_text']); ?></a>
                        </div>
                     </div>
                  </div>
               <?php endif; ?>
            </div>
         </section>
         <!-- blog area end -->

      <?php else :
         $this->add_render_attribute('title_args', 'class', 'ms-section-title ms-el-title');

         $this->ms_link_controls_render('tpbtn', 'ms-btn ms-btn-2 ms-btn-blue', $this->get_settings());
      ?>
         <!-- blog area start -->
         <section class="ms-blog-area pt-50 pb-75">
            <div class="container">
               <div class="row align-items-end">
                  <?php if (!empty($settings['ms_blog_section_title_show'])) : ?>
                     <div class="col-xl-4 col-md-6">
                        <div class="ms-section-title-wrapper mb-50">

                           <?php if (!empty($settings['ms_blog_sub_title'])) : ?>
                              <span class="ms-section-subtitle ms-el-subtitle"><?php echo ms_kses($settings['ms_blog_sub_title']); ?></span>
                           <?php endif; ?>

                           <?php
                           if (!empty($settings['ms_blog_title'])) :
                              printf(
                                 '<%1$s %2$s>%3$s</%1$s>',
                                 tag_escape($settings['ms_blog_title_tag']),
                                 $this->get_render_attribute_string('title_args'),
                                 ms_kses($settings['ms_blog_title'])
                              );
                           endif;
                           ?>

                           <?php if (!empty($settings['ms_blog_description'])) : ?>
                              <p><?php echo ms_kses($settings['ms_blog_description']); ?></p>
                           <?php endif; ?>
                        </div>
                     </div>
                  <?php endif; ?>

                  <?php if ($settings['ms_' . $control_id . '_button_show'] == 'yes') : ?>
                     <div class="col-xl-8 col-md-6">
                        <div class="ms-blog-more-wrapper d-flex justify-content-md-end">
                           <div class="ms-blog-more mb-50 text-md-end">
                              <a <?php echo $this->get_render_attribute_string('ms-button-arg'); ?>>
                                 <?php echo ms_kses($settings['ms_' . $control_id . '_text']); ?>
                                 <svg width="17" height="14" viewBox="0 0 17 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16 6.99976L1 6.99976" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M9.9502 0.975414L16.0002 6.99941L9.9502 13.0244" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                 </svg>
                              </a>
                              <span class="ms-blog-more-border"></span>
                           </div>
                        </div>
                     </div>
                  <?php endif; ?>

               </div>
               <div class="row">
                  <div class="col-xl-12">
                     <div class="ms-blog-main-slider">
                        <div class="ms-blog-main-slider-active swiper-container">
                           <div class="swiper-wrapper">
                              <?php if ($query->have_posts()) : ?>
                                 <?php while ($query->have_posts()) :
                                    $query->the_post();
                                    global $post;

                                    $categories = get_the_category($post->ID);

                                 ?>
                                    <div class="ms-blog-item mb-30 swiper-slide">
                                       <?php if (has_post_thumbnail()) : ?>
                                          <div class="ms-blog-thumb p-relative fix">
                                             <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail($post->ID, $settings['thumbnail_size']); ?>
                                             </a>

                                             <div class="ms-blog-meta ms-blog-meta-date">
                                                <span><?php the_time(get_option('date_format')); ?></span>
                                             </div>

                                          </div>
                                       <?php endif; ?>
                                       <div class="ms-blog-content">
                                          <h3 class="ms-blog-title">
                                             <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['ms_blog_title_word'], ''); ?></a>
                                          </h3>

                                          <div class="ms-blog-tag">
                                             <span><i class="fa-light fa-tag"></i></span>
                                             <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a>
                                          </div>

                                          <?php if (!empty($settings['ms_post_content'])) :
                                             $ms_post_content_limit = (!empty($settings['ms_post_content_limit'])) ? $settings['ms_post_content_limit'] : '';
                                          ?>
                                             <p class="ms-el-box-desc"><?php print wp_trim_words(get_the_excerpt(get_the_ID()), $ms_post_content_limit, ''); ?></p>
                                          <?php endif; ?>


                                          <?php if (!empty($settings['ms_post_button'])) : ?>
                                             <div class="ms-blog-btn">
                                                <a href="<?php the_permalink(); ?>" class="ms-btn-2 ms-btn-border-2">
                                                   <?php echo ms_kses($settings['ms_post_button']); ?>
                                                   <span>
                                                      <svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                         <path d="M16 7.5L1 7.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                         <path d="M9.9502 1.47541L16.0002 7.49941L9.9502 13.5244" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                      </svg>
                                                   </span>
                                                </a>
                                             </div>
                                          <?php endif; ?>

                                       </div>
                                    </div>
                                 <?php endwhile;
                                 wp_reset_query(); ?>
                              <?php endif; ?>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>


      <?php endif; ?>

<?php
   }
}

$widgets_manager->register(new MS_Blog_Post());
