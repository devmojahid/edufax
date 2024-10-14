<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package edufax
 */

$edufax_audio_url = function_exists('tpmeta_field') ? tpmeta_field('edufax_post_audio') : NULL;
$gallery_images = function_exists('tpmeta_gallery_field') ? tpmeta_gallery_field('edufax_post_gallery') : '';
$edufax_video_url = function_exists('tpmeta_field') ? tpmeta_field('edufax_post_video') : NULL;



$edufax_blog_single_social = get_theme_mod('edufax_blog_single_social', true);
$blog_tag_col = $edufax_blog_single_social ? 'col-xl-8 col-lg-6' : 'col-xl-12';


if (is_single()) : ?>
    <!-- details start -->
    <article id="post-<?php the_ID(); ?>" <?php post_class('tp-postbox-details-article tf__blog_details_text'); ?>>
        <div class="tp-postbox-details-article-inner">
            <!-- content start -->
            <?php the_content(); ?>

            <?php
            wp_link_pages([
                'before'      => '<div class="page-links">' . esc_html__('Pages:', 'edufax'),
                'after'       => '</div>',
                'link_before' => '<span class="page-number">',
                'link_after'  => '</span>',
            ]);
            ?>
        </div>

        <?php if (has_tag() or $edufax_blog_single_social) : ?>
            <div class="tp-postbox-details-share-wrapper">
                <div class="row">
                    <div class="<?php echo esc_attr($blog_tag_col); ?>">
                        <div class="tp-postbox-details-tags tagcloud">
                            <?php print edufax_get_tag(); ?>
                        </div>
                    </div>

                    <?php if (!empty($edufax_blog_single_social)) : ?>
                        <div class="col-xl-4 col-lg-6">
                            <div class="tp-postbox-details-share text-md-end">
                                <?php if (function_exists('edufax_blog_single_social')) : ?>
                                    <?php print edufax_blog_single_social(); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif ?>

    </article>
    <!-- details end -->
<?php else : ?>
    <article id="post-<?php the_ID(); ?>" data-wow-duration="1s" <?php post_class('tp-postbox-item tf__single_blog format-image mb-50 transition-3 tp-postbox-wrapper col-xl-5 col-md-5 wow fadeInUp mr_25'); ?>>

        <!-- if post has thumbnail -->
        <?php if (has_post_format('image')) : ?>
            <?php if (has_post_thumbnail()) : ?>
                <div class="tp-postbox-thumb tf__single_blog_img">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('full', ['class' => 'img-responsive img-fluid w-100']); ?>
                    </a>
                </div>
            <?php endif; ?>

            <!-- if post has video -->
        <?php elseif (has_post_format('video')) : ?>
            <?php if (has_post_thumbnail()) : ?>
                <div class="tp-postbox-thumb tp-postbox-video tf__community_img">
                    <?php the_post_thumbnail('full', ['class' => 'img-responsive img-fluid w-100']); ?>
                    <?php if (!empty($edufax_video_url)) : ?>
                        <div class="tf__community_img_overlay">
                            <a href="<?php print esc_url($edufax_video_url); ?>" data-autoplay="true" data-vbtype="video" class="tp-postbox-video-btn popup-video venobox tf__play_btn"><i class="fas fa-play"></i></a>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <!-- if post has audio -->
        <?php elseif (has_post_format('audio')) : ?>

            <?php if (!empty($edufax_audio_url)) : ?>
                <div class="tp-postbox-thumb tp-postbox-audio tf__community_img">
                    <?php echo wp_oembed_get($edufax_audio_url); ?>
                </div>
            <?php endif; ?>

            <!-- if post has gallery -->
        <?php elseif (has_post_format('gallery')) : ?>
            <?php if (!empty($gallery_images)) : ?>
                <div class="tp-postbox-thumb tp-postbox-slider swiper-container tf__community_img">
                    <div class="slick-initialized slick-slider slick-dotted team_slider">
                        <div class="slick-list draggable">
                            <div class="slick-track">
                                <?php foreach ($gallery_images as $key => $image) : ?>
                                    <div class="tp-postbox-slider-item slick-slide slick-cloned">
                                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="tp-postbox-nav">
                        <button class="tp-postbox-slider-button-next"><i class="fal fa-arrow-right"></i></button>
                        <button class="tp-postbox-slider-button-prev"><i class="fal fa-arrow-left"></i></button>
                    </div>
                </div>
            <?php endif; ?>

        <?php else : ?>
            <?php if (has_post_thumbnail()) : ?>
                <div class="tp-postbox-thumb tf__single_blog_img">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('full', ['class' => 'img-responsive img-fluid w-100']); ?>
                    </a>
                </div>
            <?php endif; ?>
        <?php endif; ?>
        <div class="tp-postbox-content tf__single_blog_text">
            <!-- blog meta -->
            <?php get_template_part('template-parts/blog/blog-meta'); ?>

            <a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>

            <!-- blog btn -->
            <?php get_template_part('template-parts/blog/blog-btn'); ?>
        </div>

    </article>
<?php endif; ?>