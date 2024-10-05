<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package edufax
 */

get_header();

$blog_column = is_active_sidebar('blog-sidebar') ? 'col-xl-9 col-lg-8' : 'col-xl-12 col-lg-12';
$categories = get_the_terms($post->ID, 'category');
$edufax_audio_url = function_exists('tpmeta_field') ? tpmeta_field('edufax_post_audio') : NULL;
$gallery_images = function_exists('tpmeta_gallery_field') ? tpmeta_gallery_field('edufax_post_gallery') : '';
$edufax_video_url = function_exists('tpmeta_field') ? tpmeta_field('edufax_post_video') : NULL;

$enable_post_details_style_2 = function_exists('tpmeta_field') ? tpmeta_field('enable_post_details_style_2') : NULL;

if (function_exists('setPostViews')) {
	setPostViews(get_the_ID());
}
?>


<?php if (!empty($enable_post_details_style_2)) : ?>

<!-- postbox details area start -->
<section class="postbox__area">
    <div class="postbox__wrapper postbox__style-2">
        <?php
			while (have_posts()) :
				the_post();

				global $post;
				$categories = get_the_category($post->ID);

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

				if (function_exists('setPostViews')) {
					setPostViews(get_the_ID());
				}

			?>
        <div class="postbox__top">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-10">

                        <div class="postbox__category">
                            <a
                                href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a>
                        </div>

                        <h3 class="postbox__title">
                            <?php the_title(); ?>
                        </h3>

                        <div class="postbox__thumb postbox__thumb-overlay black-bg m-img mb-55"
                            data-background="<?php echo get_the_post_thumbnail_url($post->ID); ?>"></div>
                        <div class="postbox__meta-wrapper d-flex align-items-center justify-content-center flex-wrap">

                            <?php if (!empty(get_author_posts_url(get_the_author_meta('ID'))) && !empty($edufax_blog_author)) : ?>
                            <div class="postbox__meta-item mb-30">
                                <div class="postbox__meta-author d-flex align-items-center">
                                    <?php if (!empty(get_avatar(get_the_author_meta('user_email'), $author_bio_avatar_size, '', '', ['class' => 'media-object img-circle']))) : ?>
                                    <div class="postbox__meta-author-thumb">
                                        <a
                                            href="<?php print esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                                            <?php print get_avatar(get_avatar(get_the_author_meta('user_email'), $author_bio_avatar_size, '', '', ['class' => 'media-object img-circle'])); ?>
                                        </a>
                                    </div>
                                    <?php endif; ?>

                                    <div class="postbox__meta-content">
                                        <span
                                            class="postbox__meta-type"><?php echo esc_html__('Author', 'edufax'); ?></span>
                                        <p class="postbox__meta-name">
                                            <a
                                                href="<?php print esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                                                <?php print get_the_author(); ?>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>

                            <?php if (!empty($edufax_blog_date)) : ?>
                            <div class="postbox__meta-item mb-30">
                                <div class="postbox__meta-content">
                                    <span
                                        class="postbox__meta-type"><?php echo esc_html__('Published', 'edufax'); ?></span>
                                    <p class="postbox__meta-name"><?php the_time(get_option('date_format')); ?></p>
                                </div>
                            </div>
                            <?php endif; ?>

                            <?php if (!empty($edufax_blog_comments)) : ?>
                            <div class="postbox__meta-item mb-30">
                                <div class="postbox__meta-content">
                                    <span class="postbox__meta-type"><?php comments_number(); ?></span>
                                    <!-- for wp comment, this link will redirected to its coment section -->
                                    <p class="postbox__meta-name"><a
                                            href="<?php comments_link(); ?>"><?php echo esc_html__('Join the Conversation', 'edufax'); ?></a>
                                    </p>
                                </div>
                            </div>
                            <?php endif; ?>

                            <?php if (function_exists('getPostViews') && !empty($edufax_blog_view)) : ?>
                            <div class="postbox__meta-item mb-30">
                                <div class="postbox__meta-content">
                                    <span class="postbox__meta-type"><?php echo esc_html__('View', 'edufax'); ?></span>
                                    <p class="postbox__meta-name"><?php echo getPostViews(get_the_ID()); ?>
                                        <?php echo esc_html__('views', 'edufax'); ?></p>
                                </div>
                            </div>
                            <?php endif; ?>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?php endwhile;  // End of the loop. 
			?>
        <div class="postbox__main-wrapper pt-75">
            <div class="container">
                <?php the_content(); ?>
            </div>
        </div>

        <div class="postbox__comment-wrapper postbox__comment-style-2 pt-90 pb-65">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-8 col-lg-10">
                        <?php

							// If comments are open or we have at least one comment, load up the comment template.
							if (comments_open() || get_comments_number()) :
								comments_template();
							endif;

							?>

                    </div>
                </div>
            </div>
        </div>

        <?php if (get_previous_post_link() and get_next_post_link()) :
				$prev_post = get_adjacent_post(false, '', true);
				$next_post = get_adjacent_post(false, '', false);
			?>
        <div class="postbox__more-navigation postbox__more-navigation-2 grey-bg-7 d-none d-sm-block">
            <div class="container">
                <div class="row">
                    <?php if (get_previous_post_link()) : ?>
                    <div class="col-md-5">
                        <div class="postbox__more-left d-flex align-items-center">
                            <div class="postbox__more-icon">
                                <a href="<?php echo get_permalink($prev_post->ID) ?>">
                                    <svg width="8" height="14" viewBox="0 0 8 14" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M7 12.9718L2.06061 8.04401C1.47727 7.46205 1.47727 6.50975 2.06061 5.92778L7 1"
                                            stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                            </div>
                            <div class="postbox__more-content">
                                <p><?php print esc_html__('Previous Article', 'edufax'); ?></p>
                                <h4><?php print get_previous_post_link('%link ', '%title'); ?></h4>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="col-md-2">
                        <div class="postbox__more-menu text-center">
                            <span>
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11.6673 4.66662C12.9559 4.66662 14.0006 3.62196 14.0006 2.33331C14.0006 1.04466 12.9559 0 11.6673 0C10.3786 0 9.33398 1.04466 9.33398 2.33331C9.33398 3.62196 10.3786 4.66662 11.6673 4.66662Z"
                                        fill="currentColor" />
                                    <path
                                        d="M2.33331 4.66662C3.62196 4.66662 4.66662 3.62196 4.66662 2.33331C4.66662 1.04466 3.62196 0 2.33331 0C1.04466 0 0 1.04466 0 2.33331C0 3.62196 1.04466 4.66662 2.33331 4.66662Z"
                                        fill="currentColor" />
                                    <path
                                        d="M11.6673 13.9996C12.9559 13.9996 14.0006 12.955 14.0006 11.6663C14.0006 10.3777 12.9559 9.33301 11.6673 9.33301C10.3786 9.33301 9.33398 10.3777 9.33398 11.6663C9.33398 12.955 10.3786 13.9996 11.6673 13.9996Z"
                                        fill="currentColor" />
                                    <path
                                        d="M2.33331 13.9996C3.62196 13.9996 4.66662 12.955 4.66662 11.6663C4.66662 10.3777 3.62196 9.33301 2.33331 9.33301C1.04466 9.33301 0 10.3777 0 11.6663C0 12.955 1.04466 13.9996 2.33331 13.9996Z"
                                        fill="currentColor" />
                                </svg>
                            </span>
                        </div>
                    </div>
                    <?php if (get_next_post_link()) : ?>
                    <div class="col-md-5">
                        <div class="postbox__more-right d-flex align-items-center justify-content-end">
                            <div class="postbox__more-content">
                                <p> <?php print esc_html__('Next Article', 'edufax'); ?></p>
                                <h4><?php print get_next_post_link('%link ', '%title'); ?></h4>
                            </div>
                            <div class="postbox__more-icon">
                                <a href="<?php echo get_permalink($next_post->ID) ?>">
                                    <svg width="8" height="14" viewBox="0 0 8 14" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M1 12.9718L5.93939 8.04401C6.52273 7.46205 6.52273 6.50975 5.93939 5.92778L1 1"
                                            stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>
<!-- postbox details area end -->

<!-- default style -->
<?php else : ?>
<!-- breadcrumb area start -->
<section class="tf__blog_details_page pt_120 xs_pt_80 pb_120 xs_pb_80">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-8 wow fadeInUp" data-wow-duration="1s"
                style="visibility: visible; animation-duration: 1s; animation-name: fadeInUp;">
                <?php
					while (have_posts()) :
						the_post();
					?>
                <div class="tf__blog_details_area">
                    <?php if (!empty($categories)) : ?>
                    <div class="tp-postbox-details-category">
                        <span>
                            <a
                                href="<?php print esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a>
                        </span>
                    </div>
                    <?php endif; ?>
                    <div class="tf__blog_details_text">
                        <h2><?php the_title(); ?></h2>
                    </div>

                    <?php get_template_part('template-parts/blog/blog-details-meta'); ?>


                </div>
                <?php endwhile;  // End of the loop. 
					?>
            </div>

            <?php
				while (have_posts()) :
					the_post();
				?>

            <div class="col-xl-12">
                <?php if (has_post_format('image')) : ?>

                <!-- if post has image -->
                <?php if (has_post_thumbnail()) : ?>
                <div class="tf__blog_details_img">
                    <?php the_post_thumbnail('full', ['class' => 'img-responsive']); ?>
                </div>
                <?php endif; ?>


                <!-- if post has video -->
                <?php elseif (has_post_format('video')) : ?>
                <?php if (has_post_thumbnail()) : ?>
                <div class="tp-postbox-details-thumb tp-postbox-details-video">

                    <?php the_post_thumbnail('full', ['class' => 'img-responsive']); ?>

                    <?php if (!empty($edufax_video_url)) : ?>
                    <a href="<?php print esc_url($edufax_video_url); ?>" class="tp-postbox-video-btn popup-video"><i
                            class="fas fa-play"></i></a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>


                <!-- if post has audio -->
                <?php elseif (has_post_format('audio')) : ?>
                <?php if (!empty($edufax_audio_url)) : ?>
                <div class="tp-postbox-details-thumb tp-postbox-details-audio">
                    <?php echo wp_oembed_get($edufax_audio_url); ?>
                </div>
                <?php endif; ?>

                <!-- if post has gallery -->
                <?php elseif (has_post_format('gallery')) : ?>
                <?php if (!empty($gallery_images)) : ?>
                <div class="tp-postbox-thumb tp-postbox-slider swiper-container p-relative">
                    <div class="swiper-wrapper">
                        <?php foreach ($gallery_images as $key => $image) : ?>
                        <div class="tp-postbox-slider-item swiper-slide">
                            <img src="<?php echo esc_url($image['url']); ?>"
                                alt="<?php echo esc_attr($image['alt']); ?>">
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="tp-postbox-nav">
                        <button class="tp-postbox-slider-button-next"><i class="fal fa-arrow-right"></i></button>
                        <button class="tp-postbox-slider-button-prev"><i class="fal fa-arrow-left"></i></button>
                    </div>
                </div>
                <?php endif; ?>
                <!-- defalut image format -->
                <?php else : ?>
                <?php if (has_post_thumbnail()) : ?>
                <div class="tp-postbox-details-thumb">
                    <?php the_post_thumbnail('full', ['class' => 'img-responsive']); ?>
                </div>
                <?php endif; ?>

                <?php endif; ?>
            </div>
            <?php endwhile;  // End of the loop. 
				?>
        </div>


        <div class="row">
            <div class="<?php echo esc_attr($blog_column); ?>">

                <div class="tp-postbox-details-main-wrapper">
                    <div class="tp-postbox-details-content postbox__text">
                        <?php
							while (have_posts()) :
								the_post();

								get_template_part('template-parts/content', get_post_format());

							?>

                        <?php if (get_previous_post_link() and get_next_post_link()) :
									$prev_post = get_adjacent_post(false, '', true);
									$next_post = get_adjacent_post(false, '', false);
								?>

                        <div
                            class="tp-postbox-details-navigation d-md-flex justify-content-between align-items-center flex-wrap">
                            <?php if (get_previous_post_link()) : ?>
                            <div class="tp-postbox-details-navigation-item d-flex align-items-center">
                                <div class="tp-postbox-details-navigation-icon mr-15">
                                    <span>
                                        <a href="<?php echo get_permalink($prev_post->ID) ?>">
                                            <svg width="17" height="14" viewBox="0 0 17 14" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M0.999965 7.04891L15.939 7.04891" stroke="currentColor"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M7.02588 1.04883L1.00048 7.04833L7.02588 13.0488"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </a>
                                    </span>
                                </div>
                                <div class="tp-postbox-details-navigation-content">
                                    <span><?php print esc_html__('Previous Post', 'edufax'); ?></span>
                                    <h3 class="tp-postbox-details-navigation-title">
                                        <a
                                            href="<?php echo get_permalink($prev_post->ID) ?>"><?php print get_previous_post_link('%link ', '%title'); ?></a>
                                    </h3>
                                </div>
                            </div>
                            <?php endif; ?>

                            <?php if (get_next_post_link()) : ?>
                            <div
                                class="tp-postbox-details-navigation-item d-flex align-items-center text-end justify-content-end">
                                <div class="tp-postbox-details-navigation-content">
                                    <span> <?php print esc_html__('Next Post', 'edufax'); ?></span>
                                    <h3 class="tp-postbox-details-navigation-title">
                                        <a
                                            href="<?php echo get_permalink($next_post->ID) ?>"><?php print get_next_post_link('%link ', '%title'); ?></a>
                                    </h3>
                                </div>
                                <div class="tp-postbox-details-navigation-icon ml-15">
                                    <span>
                                        <a href="<?php echo get_permalink($next_post->ID) ?>">
                                            <svg width="17" height="14" viewBox="0 0 17 14" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15.939 7.00008L1 7.00008" stroke="currentColor"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M9.91211 1L15.9375 6.9995L9.91211 13" stroke="currentColor"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </a>
                                    </span>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>

                        <?php endif; ?>
                        <!-- navigation end -->

                        <?php
								get_template_part('template-parts/biography', get_post_format());

								// If comments are open or we have at least one comment, load up the comment template.
								if (comments_open() || get_comments_number()) :
									comments_template();
								endif;

							endwhile; // End of the loop.
							?>
                    </div>
                </div>

            </div>

            <?php if (is_active_sidebar('blog-sidebar')) : ?>
            <div class="col-xl-3 col-lg-4">
                <div class="tp-sidebar-wrapper tp-sidebar-ml--24">
                    <?php get_sidebar(); ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<!-- breadcrumb area end -->
<?php endif; ?>

<?php
get_footer();