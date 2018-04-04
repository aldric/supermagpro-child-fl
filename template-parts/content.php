<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Acmethemes
 * @subpackage SuperMag
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php supermag_posted_on(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php
	$blog_thumbnails = supermag_blog_image_size();
	if( 'no-image' != $blog_thumbnails['thumb_size'] ){
		?>
		<div class="post-thumb">
			<?php
			if( has_post_thumbnail() ):
				$image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), $blog_thumbnails['thumb_size'] );
			else:
				$image_url[0] = $blog_thumbnails['no_image'];
			endif;
			?>
			<a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url( $image_url[0] ); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" /></a>
		</div>
		<?php
	}
	?>
	<div class="entry-content">
		<?php
		$supermag_content = supermag_blog_content_layout();
		echo $supermag_content;
		$supermag_blog_archive_read_more = supermag_blog_archive_more_text();
		if( !empty( $supermag_blog_archive_read_more )){
			?>
			<a class="read-more" href="<?php the_permalink(); ?> ">
				<?php echo $supermag_blog_archive_read_more; ?>
			</a>
		<?php
		}
		?>
		<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'supermag' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->
	<footer class="entry-footer">
		<?php supermag_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->