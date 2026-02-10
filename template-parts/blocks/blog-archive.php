<?php
/**
 * Blog archive grid block (filters + cards + "Show more").
 *
 * @package GTS
 */
?>

<section class="blog-archive">
	<div class="blog-archive__container">

		<?php get_template_part( 'template-parts/blocks/blog-filters' ); ?>

		<?php if ( have_posts() ) : ?>
			<div class="blog-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					$thumb_url = get_the_post_thumbnail_url( get_the_ID(), 'large' );
					?>
					<article <?php post_class( 'blog-card' ); ?>>
						<div class="blog-card__content">
							<div class="blog-card__top">
								<p class="blog-card__date"><?php echo esc_html( get_the_date( 'd.m.Y' ) ); ?></p>
								<h3 class="blog-card__title"><?php the_title(); ?></h3>
							</div>

							<a class="blog-card__link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more', 'gts-theme' ); ?></a>
						</div>

						<div class="blog-card__image">
							<?php if ( $thumb_url ) : ?>
								<img
									class="blog-card__img"
									src="<?php echo esc_url( $thumb_url ); ?>"
									alt="<?php echo esc_attr( get_the_title() ); ?>"
									loading="lazy"
									width="520"
									height="335"
								>
							<?php else : ?>
								<div class="blog-card__img blog-card__img--placeholder" aria-hidden="true"></div>
							<?php endif; ?>
						</div>
					</article>
				<?php endwhile; ?>
			</div>

			<?php
			$next_link = get_next_posts_link( __( 'Show more', 'gts-theme' ) );
			if ( $next_link ) :
				$next_link = preg_replace( '/<a\\s+/i', '<a class="blog-show-more" ', $next_link, 1 );
				?>
				<div class="blog-archive__more">
					<?php echo wp_kses_post( $next_link ); ?>
				</div>
			<?php endif; ?>

		<?php else : ?>
			<p class="blog-archive__empty"><?php esc_html_e( 'No posts found.', 'gts-theme' ); ?></p>
		<?php endif; ?>

	</div>
</section>

