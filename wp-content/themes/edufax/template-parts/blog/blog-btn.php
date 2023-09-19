<?php

/**
 * Template part for displaying post btn
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package edufax
 */

$edufax_blog_btn = get_theme_mod('edufax_blog_btn', 'View Details');
$edufax_blog_btn_switch = get_theme_mod('edufax_blog_btn_switch', true);

?>

<?php if (!empty($edufax_blog_btn_switch)) : ?>
    <div class="postbox__read-more">
        <div class="tf__single_blog_footer">
            <?php if (!empty($edufax_blog_btn)) : ?>
                <a href="<?php the_permalink(); ?>"><?php echo esc_html($edufax_blog_btn); ?> <i class="far fa-long-arrow-right"></i></a>
            <?php endif; ?>
            <span><i class="far fa-eye"></i> 80 View</span>
        </div>
    </div>
<?php endif; ?>