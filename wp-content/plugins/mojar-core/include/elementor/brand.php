<?php

namespace MSCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class MS_Brand extends Widget_Base
{
    use \MSCore\Widgets\MSCoreElementFunctions;

    public function get_name()
    {
        return 'ms-brand';
    }

    public function get_title()
    {
        return __('Certificate Section', 'mscore');
    }

    public function get_icon()
    {
        return 'ms-icon eicon-certificate';
    }

    public function get_categories()
    {
        return ['mscore'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'mscore'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'background_image',
            [
                'label' => esc_html__('Background Image', 'mscore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'icon',
            [
                'label' => esc_html__('Icon', 'mscore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'mscore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Certificate Item', 'mscore'),
            ]
        );

        $this->add_control(
            'certificate_items',
            [
                'label' => esc_html__('Certificate Items', 'mscore'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'title' => esc_html__('Online Certification', 'mscore'),
                    ],
                    [
                        'title' => esc_html__('Top Instructors', 'mscore'),
                    ],
                    [
                        'title' => esc_html__('Unlimited Access', 'mscore'),
                    ],
                    [
                        'title' => esc_html__('Experienced Members', 'mscore'),
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__('Style', 'mscore'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'overlay_color',
            [
                'label' => esc_html__('Overlay Color', 'mscore'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tf__certificate_overlay' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'mscore'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tf__single_certificate h4' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>
        <section class="tf__certificate" style="background: url(<?php echo esc_url($settings['background_image']['url']); ?>);">
            <div class="tf__certificate_overlay pt_60 pb_60 xs_pb_5">
                <div class="container">
                    <div class="row">
                        <?php foreach ($settings['certificate_items'] as $index => $item) : ?>
                            <div class="col-xl-3 col-md-6 col-lg-3 wow fadeInUp" data-wow-duration="1s">
                                <div class="tf__single_certificate">
                                    <span>
                                        <img src="<?php echo esc_url($item['icon']['url']); ?>" alt="icon" class="img-fluid w-100">
                                    </span>
                                    <h4><?php echo esc_html($item['title']); ?></h4>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php
    }

    protected function content_template()
    {
    ?>
        <section class="tf__certificate" style="background: url({{ settings.background_image.url }});">
            <div class="tf__certificate_overlay pt_60 pb_60 xs_pb_5">
                <div class="container">
                    <div class="row">
                        <# _.each(settings.certificate_items, function(item, index) { #>
                            <div class="col-xl-3 col-md-6 col-lg-3 wow fadeInUp" data-wow-duration="1s">
                                <div class="tf__single_certificate">
                                    <span>
                                        <img src="{{ item.icon.url }}" alt="icon" class="img-fluid w-100">
                                    </span>
                                    <h4>{{{ item.title }}}</h4>
                                </div>
                            </div>
                            <# }); #>
                    </div>
                </div>
            </div>
        </section>
<?php
    }
}

$widgets_manager->register(new MS_Brand());
