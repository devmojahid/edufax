<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package edufax
 */
?>

<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <?php if (is_singular() && pings_open(get_queried_object())) : ?>
    <?php endif; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <?php wp_body_open(); ?>


    <?php
    $edufax_preloader = get_theme_mod('edufax_preloader_switch', false);
    $edufax_preloader_text = get_theme_mod('edufax_preloader_text', __('Edufax', 'edufax'));
    $edufax_preloader_loading_text = get_theme_mod('edufax_preloader_loading_text', __('Loading', 'edufax'));
    $edufax_preloader_logo = get_theme_mod('edufax_preloader_logo', get_template_directory_uri() . '/assets/img/logo/preloader/preloader-icon.svg');

    $edufax_backtotop = get_theme_mod('edufax_backtotop', false);
    ?>

    <?php if (!empty($edufax_preloader)) : ?>
        <!-- pre loader area start -->
        <div id="loading">
            <div id="loading-center">
                <div id="loading-center-absolute">
                    <svg class="pl" viewBox="0 0 128 128" width="128px" height="128px">
                        <defs>
                            <linearGradient id="pl-grad" x1="0" y1="0" x2="1" y2="1">
                                <stop offset="0%" stop-color="#000" />
                                <stop offset="100%" stop-color="#fff" />
                            </linearGradient>
                            <mask id="pl-mask">
                                <rect x="0" y="0" width="128" height="128" fill="url(#pl-grad)" />
                            </mask>
                        </defs>
                        <g stroke-linecap="round" stroke-width="8" stroke-dasharray="32 32">
                            <g stroke="hsl(193,90%,50%)">
                                <line class="pl__line1" x1="4" y1="48" x2="4" y2="80" />
                                <line class="pl__line2" x1="19" y1="48" x2="19" y2="80" />
                                <line class="pl__line3" x1="34" y1="48" x2="34" y2="80" />
                                <line class="pl__line4" x1="49" y1="48" x2="49" y2="80" />
                                <line class="pl__line5" x1="64" y1="48" x2="64" y2="80" />
                                <g transform="rotate(180,79,64)">
                                    <line class="pl__line6" x1="79" y1="48" x2="79" y2="80" />
                                </g>
                                <g transform="rotate(180,94,64)">
                                    <line class="pl__line7" x1="94" y1="48" x2="94" y2="80" />
                                </g>
                                <g transform="rotate(180,109,64)">
                                    <line class="pl__line8" x1="109" y1="48" x2="109" y2="80" />
                                </g>
                                <g transform="rotate(180,124,64)">
                                    <line class="pl__line9" x1="124" y1="48" x2="124" y2="80" />
                                </g>
                            </g>
                            <g stroke="hsl(283,90%,50%)" mask="url(#pl-mask)">
                                <line class="pl__line1" x1="4" y1="48" x2="4" y2="80" />
                                <line class="pl__line2" x1="19" y1="48" x2="19" y2="80" />
                                <line class="pl__line3" x1="34" y1="48" x2="34" y2="80" />
                                <line class="pl__line4" x1="49" y1="48" x2="49" y2="80" />
                                <line class="pl__line5" x1="64" y1="48" x2="64" y2="80" />
                                <g transform="rotate(180,79,64)">
                                    <line class="pl__line6" x1="79" y1="48" x2="79" y2="80" />
                                </g>
                                <g transform="rotate(180,94,64)">
                                    <line class="pl__line7" x1="94" y1="48" x2="94" y2="80" />
                                </g>
                                <g transform="rotate(180,109,64)">
                                    <line class="pl__line8" x1="109" y1="48" x2="109" y2="80" />
                                </g>
                                <g transform="rotate(180,124,64)">
                                    <line class="pl__line9" x1="124" y1="48" x2="124" y2="80" />
                                </g>
                            </g>
                        </g>
                    </svg>
                </div>
            </div>
        </div>
        <!-- pre loader area end -->
    <?php endif; ?>

    <?php if (!empty($edufax_backtotop)) : ?>
        <!-- back to top start -->
        <div class="back-to-top-wrapper">
            <div class="tf__scroll_btn"><i class="far fa-long-arrow-up"></i></div>
        </div>
        <!-- back to top end -->
    <?php endif; ?>

    <!-- header start -->
    <?php do_action('edufax_header_style'); ?>
    <!-- header end -->

    <!-- wrapper-box start -->
    <?php do_action('edufax_before_main_content'); ?>