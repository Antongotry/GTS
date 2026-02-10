<?php
/**
 * Other articles (prev/next by date).
 *
 * @package GTS
 */

$prev_post = get_previous_post();
$next_post = get_next_post();

$posts_page_id = (int) get_option( 'page_for_posts' );
$blog_url       = $posts_page_id ? get_permalink( $posts_page_id ) : home_url( '/' );

$other_posts = array();
if ( $prev_post instanceof WP_Post ) {
	$other_posts[] = $prev_post;
}
if ( $next_post instanceof WP_Post ) {
	$other_posts[] = $next_post;
}

if ( empty( $other_posts ) ) {
	return;
}
?>

<section class="post-other">
	<div class="post-other__container">
		<h2 class="post-other__heading"><?php esc_html_e( 'Other articles', 'gts-theme' ); ?></h2>

		<div class="blog-grid">
			<?php foreach ( $other_posts as $p ) : ?>
				<?php
				$p_thumb = get_the_post_thumbnail_url( $p->ID, 'large' );
				$p_date  = get_the_date( 'd.m.Y', $p->ID );
				$p_title = get_the_title( $p->ID );
				$p_link  = get_permalink( $p->ID );
				?>
				<article <?php post_class( 'blog-card', $p->ID ); ?>>
					<a class="blog-card__wrap" href="<?php echo esc_url( $p_link ); ?>" aria-label="<?php echo esc_attr( $p_title ); ?>">
						<div class="blog-card__content">
							<div class="blog-card__top">
								<p class="blog-card__date"><?php echo esc_html( $p_date ); ?></p>
								<h3 class="blog-card__title"><?php echo esc_html( $p_title ); ?></h3>
							</div>

							<span class="blog-card__link"><?php esc_html_e( 'Read more', 'gts-theme' ); ?></span>
						</div>

						<div class="blog-card__image">
							<?php if ( $p_thumb ) : ?>
								<img
									class="blog-card__img"
									src="<?php echo esc_url( $p_thumb ); ?>"
									alt="<?php echo esc_attr( $p_title ); ?>"
									loading="lazy"
									width="520"
									height="335"
								>
							<?php else : ?>
								<div class="blog-card__img blog-card__img--placeholder" aria-hidden="true"></div>
							<?php endif; ?>
						</div>
					</a>
				</article>
			<?php endforeach; ?>
		</div>

		<div class="post-other__footer">
			<a class="post-other__all" href="<?php echo esc_url( $blog_url ); ?>"><?php esc_html_e( 'Show all', 'gts-theme' ); ?></a>
		</div>
	</div>
</section>
