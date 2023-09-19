<?php

namespace MS_ELEMENTOR\Templates;

defined('ABSPATH') || die();

class MS_Templates
{
    private static $instance = null;

    public static function url()
    {
        if (defined('MS_ADDONS_FILE_')) {
            $file = trailingslashit(plugin_dir_url(MS_ADDONS_FILE_)) . 'include/elementor/templates/';
        } else {
            $file = trailingslashit(plugin_dir_url(__FILE__));
        }
        return $file;
    }

    public static function dir()
    {
        if (defined('MS_ADDONS_FILE_')) {
            $file = trailingslashit(plugin_dir_path(MS_ADDONS_FILE_)) . 'include/elementor/templates/';
        } else {
            $file = trailingslashit(plugin_dir_path(__FILE__));
        }
        return $file;
    }

    public static function version()
    {
        if (defined('MS_ADDONS_VERSION_')) {
            return MS_ADDONS_VERSION_;
        } else {
            return apply_filters('tpaddons_pro_version', '1.0.0');
        }
    }

    public function init()
    {
        add_action(
            'wp_enqueue_scripts',
            function () {
                wp_enqueue_style("mscore-el-template-front", self::url() . 'css/template-frontend.min.css', ['elementor-frontend'], self::version());
            }
        );

        add_action(
            'elementor/editor/after_enqueue_scripts',
            function () {
                wp_enqueue_style("tpAdd-template-editor", self::url() . 'css/template-library.min.css', ['elementor-editor'], self::version());
                wp_enqueue_script("tpAdd-template-editor", self::url() . 'js/template-library.min.js', ['elementor-editor'], self::version(), true);
                $pro = get_option('__validate_author_dtaddons__', false);

                $localize_data = [
                    'hasPro'                          => !$pro ? false : true,
                    'templateLogo'                    => MS_EXT_LOGO_ICON_URL,
                    'i18n' => [
                        'templatesEmptyTitle'       => esc_html__('No Templates Found', 'mscore'),
                        'templatesEmptyMessage'     => esc_html__('Try different category or sync for new templates.', 'mscore'),
                        'templatesNoResultsTitle'   => esc_html__('No Results Found', 'mscore'),
                        'templatesNoResultsMessage' => esc_html__('Please make sure your search is spelled correctly or try a different words.', 'mscore'),
                    ],
                    'tab_style' => json_encode(self::get_tabs()),
                    'default_tab' => 'section'
                ];
                wp_localize_script(
                    'tpAdd-template-editor',
                    'mscoreEditor',
                    $localize_data
                );
            }
        );

        add_action('elementor/preview/enqueue_styles', function () {
            $data = '.elementor-add-new-section .ms_templates_add_button {
                background-color: #e3e3e3;
                margin-left: 5px;
                font-size: 18px;
                vertical-align: bottom;
            }
            ';
            wp_add_inline_style('mscore-el-template-front', $data);
        });
    }

    public static function get_tabs()
    {
        return apply_filters('ms_editor/templates_tabs', [
            'section' => ['title' => 'Harry Sections'],
            'page' => ['title' => 'Harry Pages'],
        ]);
    }
    public static function instance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}
