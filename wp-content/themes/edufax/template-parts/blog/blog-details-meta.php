<?php
$author_data = get_the_author_meta('description', get_query_var('author'));
$author_name = get_the_author_meta('edufax_write_by');
$facebook_url = get_the_author_meta('edufax_facebook');
$twitter_url = get_the_author_meta('edufax_twitter');
$linkedin_url = get_the_author_meta('edufax_linkedin');
$instagram_url = get_the_author_meta('edufax_instagram');
$edufax_url = get_the_author_meta('edufax_youtube');
$edufax_write_by = get_the_author_meta('edufax_write_by');
$author_bio_avatar_size = 180;


$categories = get_the_terms($post->ID, 'category');
$edufax_blog_date = get_theme_mod('edufax_blog_date', true);
$edufax_blog_comments = get_theme_mod('edufax_blog_comments', true);
$edufax_blog_author = get_theme_mod('edufax_blog_author', true);
$edufax_blog_cat = get_theme_mod('edufax_blog_cat', false);
$edufax_blog_view = get_theme_mod('edufax_blog_view', false);

?>

<div class="tf__blog_details_header">
    <ul>
        <?php if (!empty(get_author_posts_url(get_the_author_meta('ID'))) && !empty($edufax_blog_author)) : ?>
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
        <?php if (!empty($edufax_blog_date) || !empty($edufax_blog_comments)) : ?>
        <li>
            <?php if (!empty($edufax_blog_date)) : ?>
            <p>
                <i class="fal fa-calendar-alt"></i>
                <?php the_time(get_option('date_format')); ?>
            </p>
            <?php endif; ?>
            <?php if (!empty($edufax_blog_comments)) : ?>
            <p>
                <i class="fal fa-comment"></i>
                <?php comments_number(); ?>
            </p>
            <?php endif; ?>
        </li>
        <?php endif; ?>
    </ul>
</div>