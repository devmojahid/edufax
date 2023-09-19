<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Footer_Call extends Widget_Base {

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
        return 'tp-footer-call';
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
        return __( 'Footer Call', 'tpcore' );
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

        $this->start_controls_section(
            'tp_footer_call_sec',
                [
                  'label' => esc_html__( 'Footer Call', 'tpcore' ),
                  'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
           );

           $this->add_control(
           'tp_footer_call_subtitle',
            [
               'label'       => esc_html__( 'Title', 'tpcore' ),
               'type'        => \Elementor\Controls_Manager::TEXT,
               'default'     => esc_html__( 'Got Questions? Call us', 'tpcore' ),
               'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
               'label_block' => true
            ]
           );
           
           
           $repeater = new \Elementor\Repeater();

           
            $repeater->add_control(
            'tp_footer_call_title',
              [
                'label'   => esc_html__( 'Contact Title', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Contact Title', 'tpcore' ),
                'label_block' => true,
              ]
            );
   
            $repeater->add_control(
               'tp_footer_call_type',
               [
                 'label'   => esc_html__( 'Select Type', 'tpcore' ),
                 'type' => \Elementor\Controls_Manager::SELECT,
                 'options' => [
                   'email'  => esc_html__( 'Email', 'tpcore' ),
                   'phone'  => esc_html__( 'Phone', 'tpcore' ),
                   'map'  => esc_html__( 'Map', 'tpcore' ),
                   'default'  => esc_html__( 'Default', 'tpcore' ),
                 ],
                 'default' => 'default',
               ]
              );
      
              $repeater->add_control(
               'tp_footer_call_default_url',
               [
                 'label'   => esc_html__( 'Default URL', 'tpcore' ),
                 'type'        => \Elementor\Controls_Manager::URL,
                 'default'     => [
                     'url'               => '#',
                     'is_external'       => true,
                     'nofollow'          => true,
                     'custom_attributes' => '',
                   ],
                   'placeholder' => esc_html__( 'Your URL', 'tpcore' ),
                   'label_block' => true,
                   'condition' => [
                      'tp_footer_call_type' => 'default'
                   ]
                 ]
               );
               
              $repeater->add_control(
               'tp_footer_call_phone_url',
               [
                 'label'   => esc_html__( 'Phone URL', 'tpcore' ),
                 'type'        => \Elementor\Controls_Manager::URL,
                 'default'     => [
                     'url'               => '#',
                     'is_external'       => true,
                     'nofollow'          => true,
                     'custom_attributes' => '',
                   ],
                   'placeholder' => esc_html__( 'Your URL', 'tpcore' ),
                   'label_block' => true,
                   'condition' => [
                      'tp_footer_call_type' => 'phone'
                   ]
                 ]
               );
              $repeater->add_control(
               'tp_footer_call_mail_url',
               [
                 'label'   => esc_html__( 'Email URL', 'tpcore' ),
                 'type'        => \Elementor\Controls_Manager::URL,
                 'default'     => [
                     'url'               => '#',
                     'is_external'       => true,
                     'nofollow'          => true,
                     'custom_attributes' => '',
                   ],
                   'placeholder' => esc_html__( 'Your URL', 'tpcore' ),
                   'label_block' => true,
                   'condition' => [
                      'tp_footer_call_type' => 'email'
                   ]
                 ]
               );
   
              $repeater->add_control(
               'tp_footer_call_map_url',
               [
                 'label'   => esc_html__( 'Map URL', 'tpcore' ),
                 'type'        => \Elementor\Controls_Manager::URL,
                 'default'     => [
                     'url'               => '#',
                     'is_external'       => true,
                     'nofollow'          => true,
                     'custom_attributes' => '',
                   ],
                   'placeholder' => esc_html__( 'Your URL', 'tpcore' ),
                   'label_block' => true,
                   'condition' => [
                      'tp_footer_call_type' => 'map'
                   ]
                 ]
               );
            
            $this->add_control(
              'tp_footer_call_list',
              [
                'label'       => esc_html__( 'Call Repeater', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                  [
                    'tp_footer_call_title'   => esc_html__( '012 458 246', 'tpcore' ),
                  ],
                ],
                'title_field' => '{{{ tp_footer_call_title }}}',
              ]
            );
           
           $this->end_controls_section();
   


    }


    protected function style_tab_content(){
        $this->tp_basic_style_controls('footer_subtitle', 'Title', '.tp-el-title');
        $this->tp_link_controls_style('portfolio_description', 'Link - Style', '.tp-el-box-btn');
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

        <div class="tp-footer-talk">

            <?php if(!empty($settings['tp_footer_call_subtitle'])) : ?>
            <span class="tp-el-title"><?php echo esc_html($settings['tp_footer_call_subtitle']); ?></span>
            <?php endif; ?>

            <?php foreach ($settings['tp_footer_call_list'] as $item) : 
                
                $contact_type = $item['tp_footer_call_type'];

                if($contact_type === 'mail'){
                    $contact_url = 'mailto:'.$item['tp_footer_call_mail_url']['url'];
                }
                elseif ($contact_type === 'phone') {
                    $contact_url = 'tel:'.$item['tp_footer_call_phone_url']['url'];
                }
                elseif ($contact_type === 'map') {
                    $contact_url = $item['tp_footer_call_map_url']['url'];
                }
                elseif ($contact_type === 'default') {
                    $contact_url = $item['tp_footer_call_default_url']['url'];
                }
                else{
                    $contact_url = "#";
                }

            ?>
            <h4><a href="<?php echo esc_url($contact_url ); ?>" class="tp-el-box-btn"><?php echo esc_html($item['tp_footer_call_title']); ?></a></h4>
            <?php endforeach; ?>
        </div>

        <?php
    }
}

$widgets_manager->register( new TP_Footer_Call() );
