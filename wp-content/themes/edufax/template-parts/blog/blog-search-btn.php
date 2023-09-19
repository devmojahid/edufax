<?php

/**
 * Template part for displaying post btn
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package edufax
 */

$edufax_search_btn = get_theme_mod('edufax_blog_btn', 'Read More');
$edufax_search_btn_switch = get_theme_mod('edufax_blog_btn_switch', true);

?>


<?php if (!empty($edufax_search_btn_switch)) : ?>
    <div class="tp-blog-grid-btn">
        <a href="<?php the_permalink(); ?>" class="tp-link-btn-3">
            <?php print esc_html($edufax_search_btn); ?>
            <span>
                <svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M16 7.5L1 7.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M9.9502 1.47541L16.0002 7.49941L9.9502 13.5244" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </span>
        </a>
    </div>
<?php endif; ?>