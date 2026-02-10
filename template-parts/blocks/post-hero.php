<?php
/**
 * Single post hero (share + image + meta).
 *
 * @package GTS
 */

$permalink = get_permalink();
$title     = get_the_title();

$tg_share = 'https://t.me/share/url?url=' . rawurlencode( $permalink ) . '&text=' . rawurlencode( $title );
$fb_share = 'https://www.facebook.com/sharer/sharer.php?u=' . rawurlencode( $permalink );

$thumb_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
$author    = get_the_author();
$date      = get_the_date( 'F j, Y' );
?>

<section class="post-hero">
	<div class="post-hero__container">
		<div class="post-share">
			<p class="post-share__title"><?php esc_html_e( 'Share', 'gts-theme' ); ?></p>
			<div class="footer-social-icons post-share__icons">
				<a class="footer-social-icon post-share__icon" href="<?php echo esc_url( $tg_share ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr__( 'Share on Telegram', 'gts-theme' ); ?>">
					<img src="<?php echo esc_url( get_site_url() . '/wp-content/uploads/2026/01/telegram.svg' ); ?>" alt="" width="25" height="25">
				</a>
				<a class="footer-social-icon post-share__icon" href="<?php echo esc_url( $fb_share ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr__( 'Share on Facebook', 'gts-theme' ); ?>">
					<img src="<?php echo esc_url( get_site_url() . '/wp-content/uploads/2026/01/fb.svg' ); ?>" alt="" width="25" height="25">
				</a>
				<a class="footer-social-icon post-share__icon" href="#" aria-label="<?php echo esc_attr__( 'Instagram', 'gts-theme' ); ?>">
					<img src="<?php echo esc_url( get_site_url() . '/wp-content/uploads/2026/01/inst.svg' ); ?>" alt="" width="25" height="25">
				</a>
			</div>
		</div>

		<div class="post-hero__media">
			<?php if ( $thumb_url ) : ?>
				<img class="post-hero__img" src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php echo esc_attr( $title ); ?>" fetchpriority="high" loading="eager" width="1200" height="520">
			<?php else : ?>
				<div class="post-hero__img post-hero__img--placeholder" aria-hidden="true"></div>
			<?php endif; ?>
		</div>

		<div class="post-meta">
			<div class="post-meta__group">
				<p class="post-meta__label"><?php esc_html_e( 'Publication date:', 'gts-theme' ); ?></p>
				<p class="post-meta__value"><?php echo esc_html( $date ); ?></p>
			</div>
			<div class="post-meta__group">
				<p class="post-meta__label"><?php esc_html_e( 'Author:', 'gts-theme' ); ?></p>
				<p class="post-meta__value"><?php echo esc_html( $author ); ?></p>
			</div>
		</div>
	</div>
</section>

