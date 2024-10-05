<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package edufax
 */

get_header();

$blog_column = is_active_sidebar('blog-sidebar') ? 'col-xl-8 col-lg-8 wow fadeInUp' : 'col-xl-12 col-lg-12';

?>

<section class="tf__blog_page pt_120 xs_pt_80 pb_120 xs_pb_80 tp-postbox-area">
	<div class="container">
		<div class="row mt_35">
			<div class="<?php print esc_attr($blog_column); ?>">
				<div class="row">

					<?php
					if (have_posts()) :
						if (is_home() && !is_front_page()) :
					?>
							<header>
								<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
							</header>
						<?php
						endif; ?>
						<?php
						/* Start the Loop */
						while (have_posts()) : the_post(); ?>
							<?php
							/*
							* Include the Post-Type-specific template for the content.
							* If you want to override this in a child theme, then include a file
							* called content-___.php (where ___ is the Post Type name) and that will be used instead.
							*/
							get_template_part('template-parts/content'); ?>
						<?php
						endwhile;
						?>
						<div class="tf__pagination mt_60">
							<nav class="Page navigation example">
								<?php edufax_pagination('<i class="far fa-chevron-left"></i>', '<i class="far fa-chevron-right"></i>', '', ['class' => '']); ?>
							</nav>
						</div>
					<?php else :
						get_template_part('template-parts/content', 'none');
					endif;
					?>
				</div>
			</div>

			<!-- add Blog Sidebar -->


			<?php if (is_active_sidebar('blog-sidebar')) : ?>
				<div class="col-xl-4 col-lg-4">
					<div class="tp-sidebar-wrapper tp-sidebar-ml--24">
						<?php get_sidebar(); ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php
get_footer();
