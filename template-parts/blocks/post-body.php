<?php
/**
 * Single post body (title + content).
 *
 * @package GTS
 */
?>

<section class="post-body">
	<div class="post-body__container">
		<article <?php post_class( 'post-body__article' ); ?>>
			<h1 class="post-title"><?php the_title(); ?></h1>
			<div class="post-content entry-content">
				<?php
				the_content();

				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'gts-theme' ),
						'after'  => '</div>',
					)
				);
				?>
			</div>
		</article>
	</div>
</section>

