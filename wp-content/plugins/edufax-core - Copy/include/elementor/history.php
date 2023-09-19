<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;
use TPCore\Elementor\Controls\Group_Control_TPBGGradient;
use TPCore\Elementor\Controls\Group_Control_TPGradient;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_History extends Widget_Base {

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
		return 'history';
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
		return __( 'History', 'tpcore' );
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();


		$this->tp_section_title_render_controls('history', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');

        // history group
		$this->start_controls_section(
            'tp_history',
            [
                'label' => esc_html__('History List', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
            'tp_history_image',
            [
                'label' => esc_html__('Upload Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

		$repeater->add_control(
		'tp_history_thumb_text',
		 [
			'label'       => esc_html__( 'Thumb Text', 'tpcore' ),
			'type'        => \Elementor\Controls_Manager::TEXTAREA,
			'default'     => esc_html__( 'Welcome to our Shofy eCommerce Theme', 'tpcore' ),
			'placeholder' => esc_html__( 'Placeholder Text', 'tpcore' ),
		 ]
		);

        $repeater->add_control(
            'tp_history_title', [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('History Title', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_history_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered.',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_history_year',
            [
                'label' => esc_html__('Year', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '2000',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tp_history_list',
            [
                'label' => esc_html__('History - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_history_title' => esc_html__('Discover', 'tpcore'),
					],
                    [
                        'tp_history_title' => esc_html__('Latest', 'tpcore'),
					],
                    [
                        'tp_history_title' => esc_html__('Invention', 'tpcore'),
					],
                ],
                'title_field' => '{{{ tp_history_title }}}',
            ]
        );

		$this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
		
        $this->end_controls_section();

	}
	
	// style_tab_content
    protected function style_tab_content(){
		$this->tp_section_style_controls('history_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('history_subtitle', 'History - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('history_title', 'History - Title', '.tp-el-title');
        $this->tp_basic_style_controls('history_description', 'History - Description', '.tp-el-content > p');
		
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

		<?php if ( $settings['tp_design_style']  == 'layout-2' ) : ?>



		<?php else:
			$this->add_render_attribute('title_args', 'class', 'section__title-4 tp-el-title');
		?>

         <!-- history area start -->
         <section class="tp-history-area pt-140 pb-140" data-bg-color="#F8F8F8">
            <div class="container">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="tp-history-slider mb-50">
                        <div class="tp-history-slider-active swiper-container">
                           <div class="swiper-wrapper">
						   	<?php foreach ($settings['tp_history_list'] as $key => $item) : 

								if ( !empty($item['tp_history_image']['url']) ) {
									$tp_history_image_url = !empty($item['tp_history_image']['id']) ? wp_get_attachment_image_url( $item['tp_history_image']['id'], $settings['thumbnail_size']) : $item['tp_history_image']['url'];
									$tp_history_image_alt = get_post_meta($item["tp_history_image"]["id"], "_wp_attachment_image_alt", true);
								}
							?>
                              <div class="tp-thistory-item swiper-slide" data-bg-color="#F8F8F8">
                                 <div class="row">
                                    <div class="col-xl-5 col-lg-6 col-md-6">
                                       <div class="tp-history-wrapper pr-45">
                                          <div class="tp-history-content mb-40">

											<?php if(!empty($item['tp_history_title'])): ?>
											<h3 class="tp-history-title tp-el-box-title"><?php echo tp_kses($item['tp_history_title']); ?></h3>
											<?php endif; ?>

											<?php if(!empty($item['tp_history_description'])): ?>
											<p class="tp-el-box-desc"><?php echo tp_kses($item['tp_history_description']); ?></p>
											<?php endif; ?>
                                          </div>

										  <?php if(!empty($item['tp_history_year'])): ?>
                                          <div class="tp-history-year">
                                             <p><?php echo esc_html($item['tp_history_year']); ?></p>
                                          </div>
										  <?php endif; ?>
                                       </div>
                                    </div>

                                    <div class="col-xl-7 col-lg-6 col-md-6">
                                       <div class="tp-history-thumb-wrapper ml-150 p-relative">
									   <?php if(!empty($tp_history_image_url)): ?>
											<?php if(!empty($item['tp_history_thumb_text'])): ?>
											<div class="tp-history-thumb-text">
                                           	 	<p><?php echo tp_kses($item['tp_history_thumb_text']); ?></p>
											</div>
											<?php endif; ?>
										  
											<div class="tp-history-thumb m-img">
												<img src="<?php echo esc_url($tp_history_image_url); ?>" alt="<?php echo esc_attr($tp_history_image_alt); ?>">
											</div>
										<?php endif; ?>
                                       </div>
                                    </div>
                                 </div>
                              </div>
							  <?php endforeach; ?>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               
               <div class="tp-history-nav">
                  <div class="row">
                     <div class="col-xl-12">
                        <div class="tp-history-nav-active swiper-container">
                           <div class="swiper-wrapper">
						   <?php foreach ($settings['tp_history_list'] as $key => $item) : ?>
								<?php if(!empty($item['tp_history_year'])): ?>
								<div class="tp-history-nav-year swiper-slide text-center">
									<p><?php echo esc_html($item['tp_history_year']); ?></p>
								</div>
								<?php endif; ?>
							  <?php endforeach; ?>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- history area end -->


        <?php endif; ?>

        <?php
	}
}

$widgets_manager->register( new TP_History() );
