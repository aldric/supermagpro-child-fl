<?php

/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Acmethemes
 * @subpackage SuperMag
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main archive-cards">

		<?php if (have_posts()) : ?>

			<header class="page-header">
			<?php if (is_category() || is_archive()) {
			$post_type = get_post_type();
			?>
				<h1><?php echo single_cat_title() . " " . $post_type; ?></h1>
			<?php } ?>
				<?php
				//	the_archive_title( '<h1 class="page-title">', '</h1>' );
				//	the_archive_description( '<div class="taxonomy-description">', '</div>' );
			?>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while (have_posts()) : the_post(); ?>

				<?php

					/*
			 * Include the Post-Format-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
			 */
			get_template_part('template-parts/content', get_post_format());
			?>

			<?php endwhile; ?>

			<?php

		/**
		 * supermag_action_navigation hook
		 * @since supermag 1.0.0
		 *
		 * @hooked: supermag_posts_navigation - 10
		 *
		 */
		do_action('supermag_action_navigation');
		?>

		<?php else : ?>

			<?php get_template_part('template-parts/content', 'none'); ?>

		<?php endif; ?>

		 <?php if (is_category() || is_archive()) {
			$post_type = get_post_type();
			$post_type_data = get_post_type_object($post_type);
			$post_type_slug = $post_type_data->rewrite['slug'];
			$queried_object = get_queried_object();
			$categories_desc = get_field('descriptions', $queried_object);
			foreach ($categories_desc as $categorie_desc) {
				if ($categorie_desc['post_type'] === $post_type_slug) {
					echo '<div class="categorie-description">';
					echo $categorie_desc['description'];
					echo '</div>';
				}
			}
		}
		?>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_sidebar('left'); ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
