<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use TPCore\Elementor\Controls\Group_Control_TPBGGradient;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Instagram_Post extends Widget_Base {

    use \TPCore\Widgets\TPCoreElementFunctions;

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'tp-instagram';
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
	public function get_title() {
		return __( 'Instagram Post', 'tpcore' );
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
	public function get_icon() {
		return 'tp-icon';
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
	public function get_categories() {
		return [ 'tpcore' ];
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
	public function get_script_depends() {
		return [ 'tpcore' ];
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

    protected function register_controls(){
        $this->register_controls_section();
        $this->style_tab_content();
    }   


	protected function register_controls_section() {

        // layout Panel
        $this->start_controls_section(
            'tp_layout',
            [
                'label' => esc_html__('Design Layout', 'tpcore'),
            ]
        );
        $this->add_control(
            'tp_design_style',
            [
                'label' => esc_html__('Select Layout', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'tpcore'),
                    'layout-2' => esc_html__('Layout 2', 'tpcore'),
                    'layout-3' => esc_html__('Layout 3', 'tpcore'),
                    'layout-4' => esc_html__('Layout 4', 'tpcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

		// tp_section_title
        $this->tp_section_title_render_controls('instagram', 'Section Title', ['layout-4']);


		$this->start_controls_section(
            'tp_instagram_section',
            [
                'label' => __( 'Instagram Slider', 'tpcore' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

		
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
            'repeater_condition',
            [
                'label' => __( 'Field condition', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __( 'Style 1', 'tpcore' ),
                    'style_2' => __( 'Style 2', 'tpcore' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

		$repeater->add_control(
		 'tp_insta_banner',
		 [
		   'label'        => esc_html__( 'Is Instagram Banner?', 'tpcore' ),
		   'type'         => \Elementor\Controls_Manager::SWITCHER,
		   'label_on'     => esc_html__( 'Show', 'tpcore' ),
		   'label_off'    => esc_html__( 'Hide', 'tpcore' ),
		   'return_value' => 'yes',
		   'default'      => 'no',
		   'condition' => [
			'repeater_condition' => ['style_2'],
		   ]
		 ]
		);
		 $repeater->add_control(
		  'tp_image_icon',
			[
				'label'   => esc_html__( 'Upload Icon Image', 'tpcore' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'repeater_condition' => ['style_2'],
					'tp_insta_banner' => 'yes'
				]
		  	]
		 );
		 $repeater->add_control(
		 'tp_insta_banner_subtitle',
		  [
			 'label'       => esc_html__( 'Subtitle', 'tpcore' ),
			 'type'        => \Elementor\Controls_Manager::TEXT,
			 'default'     => esc_html__( 'Follow Us on', 'tpcore' ),
			 'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
			 'label_block' => true,
			 'condition' => [
				'repeater_condition' => ['style_2'],
				'tp_insta_banner' => 'yes'
			]
		  ]
		 );
		 $repeater->add_control(
		 'tp_insta_banner_follow_link_text',
		  [
			 'label'       => esc_html__( 'Title', 'tpcore' ),
			 'type'        => \Elementor\Controls_Manager::TEXT,
			 'default'     => esc_html__( 'Instagram', 'tpcore' ),
			 'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
			 'label_block' => true,
			 'condition' => [
				'repeater_condition' => ['style_2'],
				'tp_insta_banner' => 'yes'
			]
		  ]
		 );
		 $repeater->add_control(
		  'tp_image',
			[
				'label'   => esc_html__( 'Upload Image', 'tpcore' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
		  	]
		 );

		 $repeater->add_control(
		  'tp_insta_link',
		  [
			'label'   => esc_html__( 'Instagram Link', 'tpcore' ),
			'type'        => \Elementor\Controls_Manager::URL,
			'default'     => [
				'url'               => '#',
				'is_external'       => true,
				'nofollow'          => true,
				'custom_attributes' => '',
			  ],
			  'placeholder' => esc_html__( 'Your Link Here', 'tpcore' ),
			  'label_block' => true,
			]
		  );
		 
		 $this->add_control(
		   'tp_insta_list',
		   [
			 'label'       => esc_html__( 'Instagram List', 'tpcore' ),
			 'type'        => \Elementor\Controls_Manager::REPEATER,
			 'fields'      => $repeater->get_controls(),
			 'default'     => [
			   [
				 'tp_insta_title'   => esc_html__( 'Image 1', 'tpcore' ),
			   ],
			   [
				 'tp_insta_title'   => esc_html__( 'Image 2', 'tpcore' ),
			   ],
			   [
				 'tp_insta_title'   => esc_html__( 'Image 3', 'tpcore' ),
			   ],
			   [
				 'tp_insta_title'   => esc_html__( 'Image 4', 'tpcore' ),
			   ],
			 ],
			 'title_field' => '{{{ tp_insta_title }}}',
		   ]
		 );

		 $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
            ]
        );
        $this->end_controls_section();
	}


    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('section_section', 'Section - Style', '.tp-el-section');
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
	protected function render() {
		$settings = $this->get_settings_for_display();

		?>

		<?php if ( $settings['tp_design_style']  == 'layout-2' ) : 
            $this->add_render_attribute('title_args', 'class', 'tp-title tp-el-title');
        ?>
		<!-- instagram area start -->
		<section class="tp-instagram-area">
            <div class="container-fluid pl-20 pr-20">
               <div class="row row-cols-lg-5 row-cols-sm-2 row-cols-1 gx-2 gy-2 gy-lg-0">

					<?php foreach ($settings['tp_insta_list'] as $key => $item) :
						if ( !empty($item['tp_image']['url']) ) {
							$tp_image_url = !empty($item['tp_image']['id']) ? wp_get_attachment_image_url( $item['tp_image']['id'], $settings['thumbnail_size']) : $item['tp_image']['url'];
							$tp_image_alt = get_post_meta($item["tp_image"]["id"], "_wp_attachment_image_alt", true);
						}

						if ( !empty($item['tp_image_icon']['url']) ) {
							$tp_image_icon_url = !empty($item['tp_image_icon']['id']) ? wp_get_attachment_image_url( $item['tp_image_icon']['id'], $settings['thumbnail_size']) : $item['tp_image_icon']['url'];
							$tp_image_icon_alt = get_post_meta($item["tp_image_icon"]["id"], "_wp_attachment_image_alt", true);
						}

						$link = $item['tp_insta_link']['url'];
					?>

					<?php if($item['tp_insta_banner'] == 'yes') : ?>
					
					<div class="col">
						<div class="tp-instagram-banner text-center">
							<div class="tp-instagram-banner-icon mb-40">
								<a href="<?php echo esc_url($link); ?>" target="_blank">
									<img src="<?php echo esc_url($tp_image_icon_url); ?>" alt="<?php echo esc_attr($tp_image_icon_alt); ?>">
								</a>
							</div>
							<div class="tp-instagram-banner-content">
								<?php if(!empty($item['tp_insta_banner_subtitle'])) : ?>
								<span><?php echo esc_html($item['tp_insta_banner_subtitle']) ?></span>
								<?php endif; ?>

								<?php if(!empty($link)) : ?>
									<a href="<?php echo esc_url($link); ?>"><?php echo esc_html($item['tp_insta_banner_follow_link_text']); ?></a>
								<?php endif; ?>
							</div>
						</div>
					</div>

					<?php else:  ?>
						<div class="col">
							<div class="tp-instagram-item-2 w-img">
								<img src="<?php echo esc_url($tp_image_url); ?>" alt="<?php esc_attr($tp_image_alt); ?>">

								<?php if(!empty($link)): ?>
								<div class="tp-instagram-icon-2">
									<a href="<?php echo esc_url($link); ?>" class="popup-image"><i class="fa-brands fa-instagram"></i></a>
								</div>
								<?php endif; ?>
							</div>
						</div>
					<?php endif; ?>
					<?php endforeach; ?>
               </div>
            </div>
         </section>
         <!-- instagram area end -->

		<?php elseif ( $settings['tp_design_style']  == 'layout-3' ) : 
            $this->add_render_attribute('title_args', 'class', 'tp-title tp-el-title');
        ?>

         <!-- instagram area start -->
         <section class="tp-instagram-area tp-instagram-style-3">
            <div class="container-fluid pl-20 pr-20">
               <div class="row row-cols-lg-6 row-cols-sm-2 row-cols-1 gx-2 gy-2 gy-lg-0">
			   <?php foreach ($settings['tp_insta_list'] as $key => $item) :
					if ( !empty($item['tp_image']['url']) ) {
						$tp_image_url = !empty($item['tp_image']['id']) ? wp_get_attachment_image_url( $item['tp_image']['id'], $settings['thumbnail_size']) : $item['tp_image']['url'];
						$tp_image_alt = get_post_meta($item["tp_image"]["id"], "_wp_attachment_image_alt", true);
					}

					$link = $item['tp_insta_link']['url'];
				?>
                  <div class="col">
                     <div class="tp-instagram-item-2 w-img">
					 	<img src="<?php echo esc_url($tp_image_url) ?>" alt="<?php esc_attr($tp_image_alt); ?>">

						<?php if(!empty($link)): ?>
                        <div class="tp-instagram-icon-2">
                           <a href="<?php echo esc_url($link); ?>" class="popup-image"><i class="fa-brands fa-instagram"></i></a>
                        </div>
						<?php endif; ?>
                     </div>
                  </div>
				  <?php endforeach; ?>

               </div>
            </div>
         </section>
         <!-- instagram area end -->

		<?php elseif ( $settings['tp_design_style']  == 'layout-4' ) : 
            $this->add_render_attribute('title_args', 'class', 'tp-section-title-4 tp-el-title');
        ?>

         <!-- instagram area start -->
         <section class="tp-instagram-area tp-instagram-style-4 pt-110 pb-10">
            <div class="container-fluid pl-20 pr-20">
			<?php if ( !empty($settings['tp_instagram_section_title_show']) ) : ?>
               <div class="row">
                  <div class="col-xl-12">
                     <div class="tp-section-title-wrapper-4 mb-50 text-center">

						<?php if ( !empty($settings['tp_instagram_sub_title']) ) : ?>
							<span class="tp-section-title-pre-4"><?php echo tp_kses( $settings['tp_instagram_sub_title'] ); ?></span>
						<?php endif; ?>

						<?php
							if ( !empty($settings['tp_instagram_title' ]) ) :
								printf( '<%1$s %2$s>%3$s</%1$s>',
									tag_escape( $settings['tp_instagram_title_tag'] ),
									$this->get_render_attribute_string( 'title_args' ),
									tp_kses( $settings['tp_instagram_title' ] )
									);
							endif;
						?>

						<?php if ( !empty($settings['tp_instagram_description']) ) : ?>
							<p><?php echo tp_kses( $settings['tp_instagram_description'] ); ?></p>
						<?php endif; ?>
                     </div>
                  </div>
               </div>
			   <?php endif; ?>
               <div class="row row-cols-lg-6 row-cols-sm-2 row-cols-1 gx-2 gy-2 gy-lg-0">
					<?php foreach ($settings['tp_insta_list'] as $key => $item) :
						if ( !empty($item['tp_image']['url']) ) {
							$tp_image_url = !empty($item['tp_image']['id']) ? wp_get_attachment_image_url( $item['tp_image']['id'], $settings['thumbnail_size']) : $item['tp_image']['url'];
							$tp_image_alt = get_post_meta($item["tp_image"]["id"], "_wp_attachment_image_alt", true);
						}

						$link = $item['tp_insta_link']['url'];
					?>
                  <div class="col">
                     <div class="tp-instagram-item-2 w-img">
					 	<img src="<?php echo esc_url($tp_image_url) ?>" alt="<?php esc_attr($tp_image_alt); ?>">
						 <?php if(!empty($link)): ?>
                        <div class="tp-instagram-icon-2">
                           <a href="<?php echo esc_url($link); ?>" class="popup-image"><i class="fa-brands fa-instagram"></i></a>
                        </div>
						<?php endif; ?>
						
                     </div>
                  </div>
				  <?php endforeach; ?>
               </div>
            </div>
         </section>
         <!-- instagram area end -->

        <?php else : ?>

         <!-- instagram area start -->
         <div class="tp-instagram-area pb-70">
            <div class="container">
               <div class="row row-cols-lg-5 row-cols-md-3 row-cols-sm-2 row-cols-1">
				<?php foreach ($settings['tp_insta_list'] as $key => $item) :
					if ( !empty($item['tp_image']['url']) ) {
						$tp_image_url = !empty($item['tp_image']['id']) ? wp_get_attachment_image_url( $item['tp_image']['id'], $settings['thumbnail_size']) : $item['tp_image']['url'];
						$tp_image_alt = get_post_meta($item["tp_image"]["id"], "_wp_attachment_image_alt", true);
					}

					$link = $item['tp_insta_link']['url'];
				?>
                  <div class="col">
                     <div class="tp-instagram-item p-relative z-index-1 fix mb-30 w-img">
					 	<img src="<?php echo esc_url($tp_image_url) ?>" alt="<?php esc_attr($tp_image_alt); ?>">

						 <?php if(!empty($link)): ?>
                        <div class="tp-instagram-icon">
                           <a href="<?php echo esc_url($link); ?>" class="popup-image"><i class="fa-brands fa-instagram"></i></a>
                        </div>
						<?php endif; ?>
													  
                     </div>
                  </div>
				  <?php endforeach; ?>
               </div>
            </div>
         </div>
         <!-- instagram area end -->

	   <?php endif; ?>

		<?php
	}


}

$widgets_manager->register( new TP_Instagram_Post() );
