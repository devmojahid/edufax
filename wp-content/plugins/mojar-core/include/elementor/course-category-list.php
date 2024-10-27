<?php

namespace MSCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

/**
 * Ms Core
 *
 * Elementor widget for course category list.
 *
 * @since 1.0.0
 */
class MS_Course_Category_List extends Widget_Base
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
        return 'course-category-list';
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
        return __('Course Category List', 'mscore');
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
        return 'ms-icon eicon-product-categories';
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
     * Get course categories
     *
     * @return array
     */
    private function get_course_categories()
    {
        $categories = get_terms([
            'taxonomy' => 'course-category',
            'hide_empty' => false,
        ]);

        $options = ['' => esc_html__('Select Category', 'mscore')];

        foreach ($categories as $category) {
            $options[$category->slug] = $category->name;
        }

        return $options;
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
                'label' => esc_html__('Content', 'mscore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'section_title',
            [
                'label' => esc_html__('Section Title', 'mscore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Explore Our Categories', 'mscore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'section_description',
            [
                'label' => esc_html__('Section Description', 'mscore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Take your learning organization to the next level. Who will share their knowledge to people around the world.', 'mscore'),
                'label_block' => true,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'category_title',
            [
                'label' => esc_html__('Category Title', 'mscore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Category Title', 'mscore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'category_icon',
            [
                'label' => esc_html__('Category Icon', 'mscore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'category_slug',
            [
                'label' => esc_html__('Category', 'mscore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => $this->get_course_categories(),
                'default' => '',
            ]
        );

        $this->add_control(
            'categories',
            [
                'label' => esc_html__('Categories', 'mscore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'category_title' => esc_html__('Data Science', 'mscore'),
                    ],
                    [
                        'category_title' => esc_html__('Finance', 'mscore'),
                    ],
                ],
                'title_field' => '{{{ category_title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__('Style', 'mscore'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'section_bg_image',
            [
                'label' => esc_html__('Background Image', 'mscore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
            ]
        );

        $this->add_control(
            'section_title_color',
            [
                'label' => esc_html__('Section Title Color', 'mscore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tf__section_heading h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'section_description_color',
            [
                'label' => esc_html__('Section Description Color', 'mscore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tf__section_heading p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'category_title_color',
            [
                'label' => esc_html__('Category Title Color', 'mscore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tf__category_item h3' => 'color: {{VALUE}};',
                ],
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

        $background_image = $settings['section_bg_image']['url'] ? 'style="background: url(' . $settings['section_bg_image']['url'] . ');"' : '';
?>

<section class="tf__category pt_110 xs_pt_75 pb_120 xs_pb_80" <?php echo $background_image; ?>>
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-md-9 col-lg-7 m-auto">
                <div class="tf__section_heading heading_center mb_30">
                    <h2><?php echo esc_html($settings['section_title']); ?></h2>
                    <p><?php echo esc_html($settings['section_description']); ?></p>
                </div>
            </div>
        </div>
        <div class="row">
            <?php foreach ($settings['categories'] as $index => $category) :
                        $category_class = 'category_' . ($index + 1);
                        $category_link = '';

                        if (!empty($category['category_slug'])) {
                            $term = get_term_by('slug', $category['category_slug'], 'course-category');
                            if ($term && !is_wp_error($term)) {
                                $category_link = add_query_arg('tutor-course-filter-category', $term->term_id, get_term_link($term));
                            }
                        }

                    ?>
            <div class="col-xl-3 col-sm-6 col-lg-4 wow fadeInUp" data-wow-duration="1s">
                <a href="<?php echo esc_url($category_link); ?>"
                    class="tf__category_item <?php echo esc_attr($category_class); ?>">
                    <div class="tf__category_logo">
                        <img src="<?php echo esc_url($category['category_icon']['url']); ?>"
                            alt="<?php echo esc_attr($category['category_title']); ?>" class="img-fluid w-100">
                    </div>
                    <h3><?php echo esc_html($category['category_title']); ?></h3>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php
    }

    /**
     * Render the widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function content_template()
    {
    ?>
<# var background_image=settings.section_bg_image.url ? 'style="background: url(' + settings.section_bg_image.url
    + ');"' : '' ; #>
    <section class="tf__category pt_110 xs_pt_75 pb_120 xs_pb_80" {{{ background_image }}}>
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-md-9 col-lg-7 m-auto">
                    <div class="tf__section_heading heading_center mb_30">
                        <h2>{{{ settings.section_title }}}</h2>
                        <p>{{{ settings.section_description }}}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <# _.each(settings.categories, function(category, index) { var category_class='category_' + (index + 1);
                    #>
                    <div class="col-xl-3 col-sm-6 col-lg-4 wow fadeInUp" data-wow-duration="1s">
                        <a href="{{ category.category_link }}" class="tf__category_item {{ category_class }}">
                            <div class="tf__category_logo">
                                <img src="{{ category.category_icon.url }}" alt="{{ category.category_title }}"
                                    class="img-fluid w-100">
                            </div>
                            <h3>{{{ category.category_title }}}</h3>
                        </a>
                    </div>
                    <# }); #>
            </div>
        </div>
    </section>
    <?php
    }
}

$widgets_manager->register(new MS_Course_Category_List());