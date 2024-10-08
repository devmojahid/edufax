<?php

/**
 * Template part for displaying post meta
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package edufax
 */

$edufax_blog_date = get_theme_mod('edufax_blog_date', true);
$edufax_blog_author = get_theme_mod('edufax_blog_author', true);

?>


<div class="tp-postbox-meta">

    <ul>
        <?php if (!empty($edufax_blog_author)) : ?>
        <li>
            <span>
                <img src="
                    <?php
                    $author_bio_avatar_size = apply_filters('edufax_author_bio_avatar_size', 50);
                    echo get_avatar_url(get_the_author_meta('user_email'), $author_bio_avatar_size);
                    ?>
                    " alt="bloger" class="img-fluid w-100">
            </span>
            <?php print get_the_author(); ?>
        </li>
        <?php endif; ?>
        <?php if (!empty($edufax_blog_date)) : ?>
        <li><i class="fal fa-calendar-alt"></i> <?php the_time(get_option('date_format')); ?></li>
        <?php endif; ?>
    </ul>

</div>