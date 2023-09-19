<?php

/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package edufax
 */

/** 
 *
 * edufax header
 */
function get_header_style($style)
{
    if ($style == 'header_2') {
        get_template_part('template-parts/header/header-2');
    } elseif ($style == 'header_3') {
        get_template_part('template-parts/header/header-3');
    } elseif ($style == 'header_4') {
        get_template_part('template-parts/header/header-4');
    } elseif ($style == 'header_5') {
        get_template_part('template-parts/header/header-5');
    } elseif ($style == 'header_6') {
        get_template_part('template-parts/header/header-6');
    } else {
        get_template_part('template-parts/header/header-1');
    }
}

function edufax_check_header()
{
    $tp_header_tabs = function_exists('tpmeta_field') ? tpmeta_field('edufax_header_tabs') : false;
    $tp_header_style_meta = function_exists('tpmeta_field') ? tpmeta_field('edufax_header_style') : '';
    $elementor_header_template_meta = function_exists('tpmeta_field') ? tpmeta_field('edufax_header_templates') : false;


    $edufax_header_option_switch = get_theme_mod('edufax_header_elementor_switch', false);
    $header_default_style_kirki = get_theme_mod('header_layout_custom', 'header_1');
    $elementor_header_templates_kirki = get_theme_mod('edufax_header_templates');

    if ($tp_header_tabs == 'default') {
        if ($edufax_header_option_switch) {
            if ($elementor_header_templates_kirki) {
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_header_templates_kirki);
            }
        } else {
            if ($header_default_style_kirki) {
                get_header_style($header_default_style_kirki);
            } else {
                get_template_part('template-parts/header/header-1');
            }
        }
    } elseif ($tp_header_tabs == 'custom') {
        if ($tp_header_style_meta) {
            get_header_style($tp_header_style_meta);
        } else {
            get_header_style($header_default_style_kirki);
        }
    } elseif ($tp_header_tabs == 'elementor') {
        if ($elementor_header_template_meta) {
            echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_header_template_meta);
        } else {
            echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_header_templates_kirki);
        }
    } else {
        if ($edufax_header_option_switch) {

            if ($elementor_header_templates_kirki) {
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_header_templates_kirki);
            } else {
                get_template_part('template-parts/header/header-1');
            }
        } else {
            get_header_style($header_default_style_kirki);
        }
    }
}
add_action('edufax_header_style', 'edufax_check_header', 10);


/* edufax offcanvas */

function edufax_check_offcanvas()
{
    $edufax_offcanvas_style = function_exists('tpmeta_field') ? tpmeta_field('edufax_offcanvas_style') : NULL;
    $edufax_default_offcanvas_style = get_theme_mod('choose_default_offcanvas', 'offcanvas-style-1');

    if ($edufax_offcanvas_style == 'offcanvas-style-1') {
        get_template_part('template-parts/offcanvas/offcanvas-1');
    } elseif ($edufax_offcanvas_style == 'offcanvas-style-2') {
        get_template_part('template-parts/offcanvas/offcanvas-2');
    } else {
        if ($edufax_default_offcanvas_style == 'offcanvas-style-2') {
            get_template_part('template-parts/offcanvas/offcanvas-2');
        } else {
            get_template_part('template-parts/offcanvas/offcanvas-1');
        }
    }
}

add_action('edufax_offcanvas_style', 'edufax_check_offcanvas', 10);




/**
 * [edufax_header_lang description]
 * @return [type] [description]
 */
function edufax_header_lang_defualt()
{
?>

    <div class="tp-header-top-menu-item tp-header-lang">
        <span class="tp-header-lang-toggle" id="tp-header-lang-toggle"><?php print esc_html__('English', 'edufax'); ?></span>
        <?php do_action('edufax_language'); ?>
    </div>
<?php
}

/**
 * [edufax_language_list description]
 * @return [type] [description]
 */
function _edufax_language($mar)
{
    return $mar;
}
function edufax_language_list()
{

    $mar = '';
    $languages = apply_filters('wpml_active_languages', NULL, 'orderby=id&order=desc');
    if (!empty($languages)) {
        $mar = '<ul class="">';
        foreach ($languages as $lan) {
            $active = $lan['active'] == 1 ? 'active' : '';
            $mar .= '<li class="' . $active . '"><a href="' . $lan['url'] . '">' . $lan['translated_name'] . '</a></li>';
        }
        $mar .= '</ul>';
    } else {
        //remove this code when send themeforest reviewer team
        $mar .= '<ul class="">';
        $mar .= '<li><a href="#">' . esc_html__('English', 'edufax') . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__('Spanish', 'edufax') . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__('French', 'edufax') . '</a></li>';
        $mar .= ' </ul>';
    }
    print _edufax_language($mar);
}
add_action('edufax_language', 'edufax_language_list');





/**
 * [edufax_offcanvas_language description]
 * @return [type] [description]
 */


/**
 * [edufax_header_lang description]
 * @return [type] [description]
 */
function edufax_offcanvas_lang_defualt()
{
?>

    <div class="offcanvas__select language">
        <div class="offcanvas__lang d-flex align-items-center justify-content-md-end">
            <div class="offcanvas__lang-img mr-15">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/language-flag.png" alt="<?php echo esc_attr__('language', 'edufax'); ?>">
            </div>

            <div class="offcanvas__lang-wrapper">
                <span class="offcanvas__lang-selected-lang tp-lang-toggle" id="tp-offcanvas-lang-toggle"><?php echo esc_html__('English', 'edufax'); ?></span>
                <?php do_action('edufax_offcanvas_language'); ?>
            </div>
        </div>
    </div>
<?php
}
function _edufax_offcanvas_language($mar)
{
    return $mar;
}
function edufax_offcanvas_language_list()
{

    $mar = '';
    $languages = apply_filters('wpml_active_languages', NULL, 'orderby=id&order=desc');
    if (!empty($languages)) {
        $mar = '<ul class="offcanvas__lang-list tp-lang-list">';
        foreach ($languages as $lan) {
            $active = $lan['active'] == 1 ? 'active' : '';
            $mar .= '<li class="' . $active . '"><a href="' . $lan['url'] . '">' . $lan['translated_name'] . '</a></li>';
        }
        $mar .= '</ul>';
    } else {
        //remove this code when send themeforest reviewer team
        $mar .= '<ul class="offcanvas__lang-list tp-lang-list">';
        $mar .= '<li><a href="#">' . esc_html__('English', 'edufax') . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__('Spanish', 'edufax') . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__('French', 'edufax') . '</a></li>';
        $mar .= ' </ul>';
    }
    print _edufax_language($mar);
}
add_action('edufax_offcanvas_language', 'edufax_offcanvas_language_list');



/**
 * [edufax_language_list description]
 * @return [type] [description]
 */
function _edufax_footer_language($mar)
{
    return $mar;
}
function edufax_footer_language_list()
{
    $mar = '';
    $languages = apply_filters('wpml_active_languages', NULL, 'orderby=id&order=desc');
    if (!empty($languages)) {
        $mar = '<ul class="footer__lang-list tp-lang-list-2">';
        foreach ($languages as $lan) {
            $active = $lan['active'] == 1 ? 'active' : '';
            $mar .= '<li class="' . $active . '"><a href="' . $lan['url'] . '">' . $lan['translated_name'] . '</a></li>';
        }
        $mar .= '</ul>';
    } else {
        //remove this code when send themeforest reviewer team
        $mar .= '<ul class="footer__lang-list tp-lang-list-2">';
        $mar .= '<li><a href="#">' . esc_html__('English', 'edufax') . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__('Spanish', 'edufax') . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__('French', 'edufax') . '</a></li>';
        $mar .= ' </ul>';
    }
    print _edufax_footer_language($mar);
}
add_action('edufax_footer_language', 'edufax_footer_language_list');



// header logo
function edufax_header_logo()
{ ?>
    <?php
    $edufax_logo_on = function_exists('tpmeta_field') ? tpmeta_field('edufax_en_secondary_logo') : NULL;
    $edufax_logo = get_template_directory_uri() . '/assets/images/logo.png';
    $edufax_logo_white = get_template_directory_uri() . '/assets/img/logo/logo-white.svg';

    $edufax_site_logo_width = get_theme_mod('edufax_logo_width', '135');

    $edufax_site_logo = get_theme_mod('header_logo', $edufax_logo);
    $edufax_secondary_logo = get_theme_mod('header_secondary_logo', $edufax_logo_white);
    ?>

    <?php if ($edufax_logo_on == 'on') : ?>
        <a class="secondary-logo navbar-brand" href="<?php print esc_url(home_url('/')); ?>">
            <img data-width="<?php echo esc_attr($edufax_site_logo_width); ?>" height="auto" src="<?php print esc_url($edufax_secondary_logo); ?>" alt="<?php print esc_attr__('logo', 'edufax'); ?>" />
        </a>
    <?php else : ?>
        <a class="standard-logo navbar-brand" href="<?php print esc_url(home_url('/')); ?>">
            <img data-width="<?php echo esc_attr($edufax_site_logo_width); ?>" height="auto" src="<?php print esc_url($edufax_site_logo); ?>" alt="<?php print esc_attr__('logo', 'edufax'); ?>" />
        </a>
    <?php endif; ?>
<?php
}

// header logo
function edufax_header_double_logo()
{ ?>
    <?php
    $edufax_logo = get_template_directory_uri() . '/assets/img/logo/logo.svg';
    $edufax_logo_white = get_template_directory_uri() . '/assets/img/logo/logo-white.svg';

    $edufax_site_logo_width = get_theme_mod('edufax_logo_width', '135');

    $edufax_site_logo = get_theme_mod('header_logo', $edufax_logo);
    $edufax_logo_white = get_theme_mod('header_secondary_logo', $edufax_logo_white);

    ?>

    <a href="<?php print esc_url(home_url('/')); ?>">
        <img data-width="<?php echo esc_attr($edufax_site_logo_width); ?>" height="auto" class="logo-light" src="<?php print esc_url($edufax_logo_white); ?>" alt="<?php print esc_attr__('logo', 'edufax'); ?>">
        <img data-width="<?php echo esc_attr($edufax_site_logo_width); ?>" height="auto" class="logo-dark" src="<?php print esc_url($edufax_site_logo); ?>" alt="<?php print esc_attr__('logo', 'edufax'); ?>">
    </a>
<?php
}


// edufax_footer_logo
function edufax_footer_logo()
{ ?>
    <?php
    $edufax_foooter_logo = function_exists('get_field') ? get_field('edufax_footer_logo') : NULL;

    $edufax_logo = get_template_directory_uri() . '/assets/img/logo/logo.svg';

    $edufax_footer_logo_default = get_theme_mod('edufax_footer_logo', $edufax_logo);
    $edufax_site_logo_width = get_theme_mod('edufax_logo_width', '120');
    ?>

    <?php if (!empty($edufax_foooter_logo)) : ?>
        <a href="<?php print esc_url(home_url('/')); ?>">
            <img data-width="<?php echo esc_attr($edufax_site_logo_width); ?>" height="auto" src="<?php print esc_url($edufax_foooter_logo); ?>" alt="<?php print esc_attr__('logo', 'edufax'); ?>" />
        </a>
    <?php else : ?>
        <a href="<?php print esc_url(home_url('/')); ?>">
            <img data-width="<?php echo esc_attr($edufax_site_logo_width); ?>" height="auto" src="<?php print esc_url($edufax_footer_logo_default); ?>" alt="<?php print esc_attr__('logo', 'edufax'); ?>" />
        </a>
    <?php endif; ?>
<?php
}


// header logo
function edufax_header_sticky_logo()
{ ?>
    <?php
    $edufax_sticky_logo = function_exists('get_field') ? get_field('edufax_sticky_logo') : NULL;
    $edufax_logo = get_theme_mod('edufax_sticky_logo', get_template_directory_uri() . '/assets/img/logo/logo-black-solid.svg');
    $edufax_secondary_logo = get_theme_mod('seconday_logo',  get_template_directory_uri() . '/assets/img/logo/logo.svg');
    $edufax_site_logo_width = get_theme_mod('edufax_logo_width', '120');
    ?>
    <?php if (!empty($edufax_sticky_logo)) : ?>
        <a href="<?php print esc_url(home_url('/')); ?>">
            <img data-width="<?php echo esc_attr($edufax_site_logo_width); ?>" height="auto" class="logo-dark" src="<?php print esc_url($edufax_sticky_logo); ?>" alt="logo">
        </a>
    <?php else : ?>
        <a href="<?php print esc_url(home_url('/')); ?>">
            <img data-width="<?php echo esc_attr($edufax_site_logo_width); ?>" height="auto" class="logo-dark" src="<?php print esc_url($edufax_logo); ?>" alt="logo">
            <img data-width="<?php echo esc_attr($edufax_site_logo_width); ?>" height="auto" class="logo-light" src="<?php print esc_url($edufax_secondary_logo); ?>" alt="logo">
        </a>
    <?php endif; ?>
<?php
}

function edufax_mobile_logo()
{
    // side info
    $edufax_mobile_logo_hide = get_theme_mod('edufax_mobile_logo_hide', false);

    $edufax_site_logo = get_theme_mod('logo', get_template_directory_uri() . '/assets/img/logo/logo.png');

?>

    <?php if (!empty($edufax_mobile_logo_hide)) : ?>
        <div class="side__logo mb-25">
            <a class="sideinfo-logo" href="<?php print esc_url(home_url('/')); ?>">
                <img src="<?php print esc_url($edufax_site_logo); ?>" alt="<?php print esc_attr__('logo', 'edufax'); ?>" />
            </a>
        </div>
    <?php endif; ?>



<?php }

/**
 * [edufax_header_social_profiles description]
 * @return [type] [description]
 */
function edufax_header_social_profiles()
{
    $edufax_topbar_fb_url = get_theme_mod('edufax_topbar_fb_url', __('#', 'edufax'));
    $edufax_topbar_twitter_url = get_theme_mod('edufax_topbar_twitter_url', __('#', 'edufax'));
    $edufax_topbar_instagram_url = get_theme_mod('edufax_topbar_instagram_url', __('#', 'edufax'));
    $edufax_topbar_linkedin_url = get_theme_mod('edufax_topbar_linkedin_url', __('#', 'edufax'));
    $edufax_topbar_youtube_url = get_theme_mod('edufax_topbar_youtube_url', __('#', 'edufax'));
?>
    <ul>
        <?php if (!empty($edufax_topbar_fb_url)) : ?>
            <li><a href="<?php print esc_url($edufax_topbar_fb_url); ?>"><span><i class="fab fa-facebook-f"></i></span></a></li>
        <?php endif; ?>

        <?php if (!empty($edufax_topbar_twitter_url)) : ?>
            <li><a href="<?php print esc_url($edufax_topbar_twitter_url); ?>"><span><i class="fab fa-twitter"></i></span></a></li>
        <?php endif; ?>

        <?php if (!empty($edufax_topbar_instagram_url)) : ?>
            <li><a href="<?php print esc_url($edufax_topbar_instagram_url); ?>"><span><i class="fab fa-instagram"></i></span></a></li>
        <?php endif; ?>

        <?php if (!empty($edufax_topbar_linkedin_url)) : ?>
            <li><a href="<?php print esc_url($edufax_topbar_linkedin_url); ?>"><span><i class="fab fa-linkedin"></i></span></a></li>
        <?php endif; ?>

        <?php if (!empty($edufax_topbar_youtube_url)) : ?>
            <li><a href="<?php print esc_url($edufax_topbar_youtube_url); ?>"><span><i class="fab fa-youtube"></i></span></a></li>
        <?php endif; ?>
    </ul>

<?php
}

/**
 * [edufax_offcanvas_social_profiles description]
 * @return [type] [description]
 */
function edufax_offcanvas_social_profiles()
{

    $edufax_offcanvas_fb_url = get_theme_mod('edufax_offcanvas_fb_url', __('#', 'edufax'));
    $edufax_offcanvas_twitter_url = get_theme_mod('edufax_offcanvas_twitter_url', __('#', 'edufax'));
    $edufax_offcanvas_instagram_url = get_theme_mod('edufax_offcanvas_instagram_url', __('#', 'edufax'));
    $edufax_offcanvas_linkedin_url = get_theme_mod('edufax_offcanvas_linkedin_url', __('#', 'edufax'));
    $edufax_offcanvas_youtube_url = get_theme_mod('edufax_offcanvas_youtube_url', __('#', 'edufax'));
?>
    <?php if (!empty($edufax_offcanvas_fb_url)) : ?>
        <a href="<?php print esc_url($edufax_offcanvas_fb_url); ?>"><span><i class="fab fa-facebook-f"></i></span></a>
    <?php endif; ?>

    <?php if (!empty($edufax_offcanvas_twitter_url)) : ?>
        <a href="<?php print esc_url($edufax_offcanvas_twitter_url); ?>"><span><i class="fab fa-twitter"></i></span></a>
    <?php endif; ?>

    <?php if (!empty($edufax_offcanvas_instagram_url)) : ?>
        <a href="<?php print esc_url($edufax_offcanvas_instagram_url); ?>"><span><i class="fab fa-instagram"></i></span></a>
    <?php endif; ?>

    <?php if (!empty($edufax_offcanvas_linkedin_url)) : ?>
        <a href="<?php print esc_url($edufax_offcanvas_linkedin_url); ?>"><span><i class="fab fa-linkedin"></i></span></a>
    <?php endif; ?>

    <?php if (!empty($edufax_offcanvas_youtube_url)) : ?>
        <a href="<?php print esc_url($edufax_offcanvas_youtube_url); ?>"><span><i class="fab fa-youtube"></i></span></a>
    <?php endif; ?>
<?php
}

function edufax_footer_social_profiles()
{
    $edufax_footer_fb_url = get_theme_mod('edufax_footer_fb_url', __('#', 'edufax'));
    $edufax_footer_twitter_url = get_theme_mod('edufax_footer_twitter_url', __('#', 'edufax'));
    $edufax_footer_instagram_url = get_theme_mod('edufax_footer_instagram_url', __('#', 'edufax'));
    $edufax_footer_linkedin_url = get_theme_mod('edufax_footer_linkedin_url', __('#', 'edufax'));
    $edufax_footer_youtube_url = get_theme_mod('edufax_footer_youtube_url', __('#', 'edufax'));
?>

    <?php if (!empty($edufax_footer_fb_url)) : ?>
        <a href="<?php print esc_url($edufax_footer_fb_url); ?>">
            <i class="fab fa-facebook-f"></i>
        </a>
    <?php endif; ?>

    <?php if (!empty($edufax_footer_twitter_url)) : ?>
        <a href="<?php print esc_url($edufax_footer_twitter_url); ?>">
            <i class="fab fa-twitter"></i>
        </a>
    <?php endif; ?>

    <?php if (!empty($edufax_footer_instagram_url)) : ?>
        <a href="<?php print esc_url($edufax_footer_instagram_url); ?>">
            <i class="fab fa-instagram"></i>
        </a>
    <?php endif; ?>

    <?php if (!empty($edufax_footer_linkedin_url)) : ?>
        <a href="<?php print esc_url($edufax_footer_linkedin_url); ?>">
            <i class="fab fa-linkedin"></i>
        </a>
    <?php endif; ?>

    <?php if (!empty($edufax_footer_youtube_url)) : ?>
        <a href="<?php print esc_url($edufax_footer_youtube_url); ?>">
            <i class="fab fa-youtube"></i>
        </a>
    <?php endif; ?>
<?php
}


/**
 * [edufax_header_menu description]
 * @return [type] [description]
 */
function edufax_header_menu()
{
?>
    <?php
    wp_nav_menu([
        'theme_location' => 'main-menu',
        'menu_class'     => 'navbar-nav ms-auto',
        'container'      => '',
        'fallback_cb'    => 'Edufax_Navwalker_Class::fallback',
        'walker'         => new \TPCore\Widgets\Edufax_Navwalker_Class,
    ]);
    ?>
<?php
}

/**
 * [edufax_footer_menu description]
 * @return [type] [description]
 */
function edufax_footer_menu()
{
    wp_nav_menu([
        'theme_location' => 'footer-menu',
        'menu_class'     => 'footer_link',
        'container'      => '',
        'fallback_cb'    => 'Edufax_Navwalker_Class::fallback',
        'walker'         => new \TPCore\Widgets\Edufax_Navwalker_Class,
    ]);
}


/**
 * [edufax_category_menu description]
 * @return [type] [description]
 */
function edufax_category_menu()
{
?>
    <?php
    wp_nav_menu([
        'theme_location' => 'category-menu',
        'menu_class'     => '',
        'container'      => '',
        'fallback_cb'    => 'Edufax_Navwalker_Class::fallback',
        'walker'         => new \TPCore\Widgets\Edufax_Navwalker_Class,
    ]);
    ?>
<?php
}

/**
 * [edufax_grocery_menu description]
 * @return [type] [description]
 */
function edufax_grocery_menu()
{
?>
    <?php
    wp_nav_menu([
        'theme_location' => 'grocery-menu',
        'menu_class'     => '',
        'container'      => '',
        'fallback_cb'    => 'Edufax_Navwalker_Class::fallback',
        'walker'         => new \TPCore\Widgets\Edufax_Navwalker_Class,
    ]);
    ?>
<?php
}

/**
 * [edufax_search_menu description]
 * @return [type] [description]
 */
function edufax_header_search_menu()
{
?>
    <?php
    wp_nav_menu([
        'theme_location' => 'header-search-menu',
        'menu_class'     => '',
        'container'      => '',
        'fallback_cb'    => 'Edufax_Navwalker_Class::fallback',
        'walker'         => new \TPCore\Widgets\Edufax_Navwalker_Class,
    ]);
    ?>
<?php
}


/**
 * [edufax_offcanvas_default_menu description]
 * @return [type] [description]
 */
function edufax_offcanvas_default_menu()
{
    wp_nav_menu([
        'theme_location' => 'offcanvas-menu',
        'menu_class'     => '',
        'container'      => '',
        'fallback_cb'    => 'Edufax_Navwalker_Class::fallback',
        'walker'         => new \TPCore\Widgets\Edufax_Navwalker_Class,
    ]);
}

/**
 *
 * edufax footer
 */
add_action('edufax_footer_style', 'edufax_check_footer', 10);

function get_footer_style($style)
{
    if ($style == 'footer_2') {
        get_template_part('template-parts/footer/footer-2');
    } elseif ($style == 'footer_3') {
        get_template_part('template-parts/footer/footer-3');
    } elseif ($style == 'footer_4') {
        get_template_part('template-parts/footer/footer-4');
    } elseif ($style == 'footer_5') {
        get_template_part('template-parts/footer/footer-5');
    } elseif ($style == 'footer_6') {
        get_template_part('template-parts/footer/footer-6');
    } else {
        get_template_part('template-parts/footer/footer-1');
    }
}

function edufax_check_footer()
{
    $tp_footer_tabs = function_exists('tpmeta_field') ? tpmeta_field('edufax_footer_tabs') : false;
    $tp_footer_style_meta = function_exists('tpmeta_field') ? tpmeta_field('edufax_footer_style') : '';
    $elementor_footer_template_meta = function_exists('tpmeta_field') ? tpmeta_field('edufax_footer_templates') : false;


    $edufax_footer_option_switch = get_theme_mod('edufax_footer_elementor_switch', false);
    $footer_default_style_kirki = get_theme_mod('footer_layout_custom', 'footer_1');
    $elementor_footer_templates_kirki = get_theme_mod('edufax_footer_templates');

    if ($tp_footer_tabs == 'default') {
        if ($edufax_footer_option_switch) {
            if ($elementor_footer_templates_kirki) {
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_footer_templates_kirki);
            }
        } else {
            if ($footer_default_style_kirki) {
                get_footer_style($footer_default_style_kirki);
            } else {
                get_template_part('template-parts/footer/footer-1');
            }
        }
    } elseif ($tp_footer_tabs == 'custom') {
        if ($tp_footer_style_meta) {
            get_footer_style($tp_footer_style_meta);
        } else {
            get_footer_style($footer_default_style_kirki);
        }
    } elseif ($tp_footer_tabs == 'elementor') {
        if ($elementor_footer_template_meta) {
            echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_footer_template_meta);
        } else {
            echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_footer_templates_kirki);
        }
    } else {
        if ($edufax_footer_option_switch) {

            if ($elementor_footer_templates_kirki) {
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_footer_templates_kirki);
            } else {
                get_template_part('template-parts/footer/footer-1');
            }
        } else {
            get_footer_style($footer_default_style_kirki);
        }
    }
}

// edufax_copyright_text
function edufax_copyright_text()
{
    print get_theme_mod('edufax_copyright', esc_html__('© 2023 All Rights Reserved | WordPress Theme by Themepure', 'edufax'));
}



/**
 *
 * pagination
 */
if (!function_exists('edufax_pagination')) {

    function _edufax_pagi_callback($pagination)
    {
        return $pagination;
    }

    //page navegation
    function edufax_pagination($prev, $next, $pages, $args)
    {
        global $wp_query, $wp_rewrite;
        $menu = '';
        $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

        if ($pages == '') {
            global $wp_query;
            $pages = $wp_query->max_num_pages;

            if (!$pages) {
                $pages = 1;
            }
        }

        $pagination = [
            'base'      => add_query_arg('paged', '%#%'),
            'format'    => '',
            'total'     => $pages,
            'current'   => $current,
            'prev_text' => $prev,
            'next_text' => $next,
            'type'      => 'array',
        ];

        //rewrite permalinks
        if ($wp_rewrite->using_permalinks()) {
            $pagination['base'] = user_trailingslashit(trailingslashit(remove_query_arg('s', get_pagenum_link(1))) . 'page/%#%/', 'paged');
        }

        if (!empty($wp_query->query_vars['s'])) {
            $pagination['add_args'] = ['s' => get_query_var('s')];
        }

        $pagi = '';
        if (paginate_links($pagination) != '') {
            $paginations = paginate_links($pagination);
            $pagi .= '<ul>';
            foreach ($paginations as $key => $pg) {
                $pagi .= '<li>' . $pg . '</li>';
            }
            $pagi .= '</ul>';
        }

        print _edufax_pagi_callback($pagi);
    }
}


// header top bg color
function edufax_breadcrumb_bg_color()
{
    $color_code = get_theme_mod('edufax_breadcrumb_bg_color', '#e1e1e1');
    wp_enqueue_style('edufax-custom', EDUFAX_THEME_CSS_DIR . 'edufax-custom.css', []);
    if ($color_code != '') {
        $custom_css = '';
        $custom_css .= ".breadcrumb-bg.gray-bg{ background: " . $color_code . "}";

        wp_add_inline_style('edufax-breadcrumb-bg', $custom_css);
    }
}
add_action('wp_enqueue_scripts', 'edufax_breadcrumb_bg_color');

// breadcrumb-spacing top
function edufax_breadcrumb_spacing()
{
    $padding_px = get_theme_mod('edufax_breadcrumb_spacing', '160px');
    wp_enqueue_style('edufax-custom', EDUFAX_THEME_CSS_DIR . 'edufax-custom.css', []);
    if ($padding_px != '') {
        $custom_css = '';
        $custom_css .= ".breadcrumb-spacing{ padding-top: " . $padding_px . "}";

        wp_add_inline_style('edufax-breadcrumb-top-spacing', $custom_css);
    }
}
add_action('wp_enqueue_scripts', 'edufax_breadcrumb_spacing');

// breadcrumb-spacing bottom
function edufax_breadcrumb_bottom_spacing()
{
    $padding_px = get_theme_mod('edufax_breadcrumb_bottom_spacing', '160px');
    wp_enqueue_style('edufax-custom', EDUFAX_THEME_CSS_DIR . 'edufax-custom.css', []);
    if ($padding_px != '') {
        $custom_css = '';
        $custom_css .= ".breadcrumb-spacing{ padding-bottom: " . $padding_px . "}";

        wp_add_inline_style('edufax-breadcrumb-bottom-spacing', $custom_css);
    }
}
add_action('wp_enqueue_scripts', 'edufax_breadcrumb_bottom_spacing');

// scrollup
function edufax_scrollup_switch()
{
    $scrollup_switch = get_theme_mod('edufax_scrollup_switch', false);
    wp_enqueue_style('edufax-custom', EDUFAX_THEME_CSS_DIR . 'edufax-custom.css', []);
    if ($scrollup_switch) {
        $custom_css = '';
        $custom_css .= "#scrollUp{ display: none !important;}";

        wp_add_inline_style('edufax-scrollup-switch', $custom_css);
    }
}
add_action('wp_enqueue_scripts', 'edufax_scrollup_switch');

// theme color
function edufax_custom_color()
{
    $color_code = get_theme_mod('edufax_color_option', '#F50963');
    wp_enqueue_style('edufax-custom', EDUFAX_THEME_CSS_DIR . 'edufax-custom.css', []);
    if ($color_code != '') {
        $custom_css = '';
        $custom_css .= "html:root { --tp-theme-1 : " . $color_code . "}";

        wp_add_inline_style('edufax-custom', $custom_css);
    }
}
add_action('wp_enqueue_scripts', 'edufax_custom_color');


// theme color secondary
function edufax_custom_color_secondary()
{
    $color_code = get_theme_mod('edufax_color_option_2', '#008080');
    wp_enqueue_style('edufax-custom', EDUFAX_THEME_CSS_DIR . 'edufax-custom.css', []);
    if ($color_code != '') {
        $custom_css = '';
        $custom_css .= "html:root { --tp-theme-2 : " . $color_code . "}";

        wp_add_inline_style('edufax-custom', $custom_css);
    }
}
add_action('wp_enqueue_scripts', 'edufax_custom_color_secondary');

// scroll to top color
function edufax_custom_color_scrollup()
{
    $color_code = get_theme_mod('edufax_color_scrollup', '#03041C');
    wp_enqueue_style('edufax-custom', EDUFAX_THEME_CSS_DIR . 'edufax-custom.css', []);
    if ($color_code != '') {
        $custom_css = '';
        $custom_css .= "html .back-to-top-btn { background-color: " . $color_code . "}";
        wp_add_inline_style('edufax-custom', $custom_css);
    }
}
add_action('wp_enqueue_scripts', 'edufax_custom_color_scrollup');


// edufax_kses_intermediate
function edufax_kses_intermediate($string = '')
{
    return wp_kses($string, edufax_get_allowed_html_tags('intermediate'));
}

function edufax_get_allowed_html_tags($level = 'basic')
{
    $allowed_html = [
        'b'      => [],
        'i'      => [],
        'u'      => [],
        'em'     => [],
        'br'     => [],
        'abbr'   => [
            'title' => [],
        ],
        'span'   => [
            'class' => [],
        ],
        'strong' => [],
        'a'      => [
            'href'  => [],
            'title' => [],
            'class' => [],
            'id'    => [],
        ],
    ];

    if ($level === 'intermediate') {
        $allowed_html['a'] = [
            'href' => [],
            'title' => [],
            'class' => [],
            'id' => [],
        ];
        $allowed_html['div'] = [
            'class' => [],
            'id' => [],
        ];
        $allowed_html['img'] = [
            'src' => [],
            'class' => [],
            'alt' => [],
        ];
        $allowed_html['del'] = [
            'class' => [],
        ];
        $allowed_html['ins'] = [
            'class' => [],
        ];
        $allowed_html['bdi'] = [
            'class' => [],
        ];
        $allowed_html['i'] = [
            'class' => [],
            'data-rating-value' => [],
        ];
    }

    return $allowed_html;
}



// WP kses allowed tags
// ----------------------------------------------------------------------------------------
function edufax_kses($raw)
{

    $allowed_tags = array(
        'a'                         => array(
            'class'   => array(),
            'href'    => array(),
            'rel'  => array(),
            'title'   => array(),
            'target' => array(),
        ),
        'abbr'                      => array(
            'title' => array(),
        ),
        'b'                         => array(),
        'blockquote'                => array(
            'cite' => array(),
        ),
        'cite'                      => array(
            'title' => array(),
        ),
        'code'                      => array(),
        'del'                    => array(
            'datetime'   => array(),
            'title'      => array(),
        ),
        'dd'                     => array(),
        'div'                    => array(
            'class'   => array(),
            'title'   => array(),
            'style'   => array(),
        ),
        'dl'                     => array(),
        'dt'                     => array(),
        'em'                     => array(),
        'h1'                     => array(),
        'h2'                     => array(),
        'h3'                     => array(),
        'h4'                     => array(),
        'h5'                     => array(),
        'h6'                     => array(),
        'i'                         => array(
            'class' => array(),
        ),
        'img'                    => array(
            'alt'  => array(),
            'class'   => array(),
            'height' => array(),
            'src'  => array(),
            'width'   => array(),
        ),
        'li'                     => array(
            'class' => array(),
        ),
        'ol'                     => array(
            'class' => array(),
        ),
        'p'                         => array(
            'class' => array(),
        ),
        'q'                         => array(
            'cite'    => array(),
            'title'   => array(),
        ),
        'span'                      => array(
            'class'   => array(),
            'title'   => array(),
            'style'   => array(),
        ),
        'iframe'                 => array(
            'width'         => array(),
            'height'     => array(),
            'scrolling'     => array(),
            'frameborder'   => array(),
            'allow'         => array(),
            'src'        => array(),
        ),
        'strike'                 => array(),
        'br'                     => array(),
        'strong'                 => array(),
        'data-wow-duration'            => array(),
        'data-wow-delay'            => array(),
        'data-wallpaper-options'       => array(),
        'data-stellar-background-ratio'   => array(),
        'ul'                     => array(
            'class' => array(),
        ),
        'svg' => array(
            'class' => true,
            'aria-hidden' => true,
            'aria-labelledby' => true,
            'role' => true,
            'xmlns' => true,
            'width' => true,
            'height' => true,
            'viewbox' => true, // <= Must be lower case!
        ),
        'g'     => array('fill' => true),
        'title' => array('title' => true),
        'path'  => array('d' => true, 'fill' => true,),
    );

    if (function_exists('wp_kses')) { // WP is here
        $allowed = wp_kses($raw, $allowed_tags);
    } else {
        $allowed = $raw;
    }

    return $allowed;
}

// / This code filters the Archive widget to include the post count inside the link /
add_filter('get_archives_link', 'edufax_archive_count_span');
function edufax_archive_count_span($links)
{
    $links = str_replace('</a>&nbsp;(', '<span > (', $links);
    $links = str_replace(')', ')</span></a> ', $links);
    return $links;
}


// / This code filters the Category widget to include the post count inside the link /
add_filter('wp_list_categories', 'edufax_cat_count_span');
function edufax_cat_count_span($links)
{
    $links = str_replace('</a> (', '<span> (', $links);
    $links = str_replace(')', ')</span></a>', $links);
    return $links;
}
