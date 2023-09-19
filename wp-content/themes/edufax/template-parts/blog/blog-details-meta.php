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

<div class="tp-postbox-details-meta mb-50">
    <?php if (!empty(get_author_posts_url(get_the_author_meta('ID'))) && !empty($edufax_blog_author)) : ?>
        <span data-meta="author">
            <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7.4104 8C9.33922 8 10.9028 6.433 10.9028 4.5C10.9028 2.567 9.33922 1 7.4104 1C5.48159 1 3.91797 2.567 3.91797 4.5C3.91797 6.433 5.48159 8 7.4104 8Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M13.4102 15.0001C13.4102 12.2911 10.721 10.1001 7.41016 10.1001C4.09933 10.1001 1.41016 12.2911 1.41016 15.0001" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
            <?php echo esc_html__('By', 'edufax'); ?> <a href="<?php print esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php print get_the_author(); ?></a>
        </span>
    <?php endif; ?>

    <?php if (!empty($edufax_blog_date)) : ?>
        <span>
            <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M15 8.5C15 12.364 11.864 15.5 8 15.5C4.136 15.5 1 12.364 1 8.5C1 4.636 4.136 1.5 8 1.5C11.864 1.5 15 4.636 15 8.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M10.5972 10.7259L8.42721 9.43093C8.04921 9.20693 7.74121 8.66793 7.74121 8.22693V5.35693" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
            <?php the_time(get_option('date_format')); ?>
        </span>
    <?php endif; ?>

    <?php if (!empty($edufax_blog_comments)) : ?>
        <span>
            <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12.5287 11.881L12.8017 14.093C12.8717 14.674 12.2487 15.08 11.7517 14.779L8.8187 13.036C8.4967 13.036 8.1817 13.015 7.8737 12.973C8.3917 12.364 8.6997 11.594 8.6997 10.761C8.6997 8.77299 6.9777 7.16302 4.8497 7.16302C4.0377 7.16302 3.2887 7.394 2.6657 7.8C2.6447 7.625 2.6377 7.44999 2.6377 7.26799C2.6377 4.08299 5.4027 1.5 8.8187 1.5C12.2347 1.5 14.9997 4.08299 14.9997 7.26799C14.9997 9.15799 14.0267 10.831 12.5287 11.881Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M8.7 10.7611C8.7 11.5941 8.39201 12.3641 7.87401 12.9731C7.18101 13.8131 6.082 14.3521 4.85 14.3521L3.023 15.437C2.715 15.626 2.323 15.3671 2.365 15.0101L2.54 13.6311C1.602 12.9801 1 11.9371 1 10.7611C1 9.52905 1.658 8.44407 2.666 7.80007C3.289 7.39407 4.038 7.16309 4.85 7.16309C6.978 7.16309 8.7 8.77305 8.7 10.7611Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
            <a href="<?php comments_link(); ?>"><?php comments_number(); ?></a>
        </span>
    <?php endif; ?>
</div>