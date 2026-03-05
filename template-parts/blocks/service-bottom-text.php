<?php
/**
 * Service Bottom Text block renderer.
 *
 * @package GTS
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$block = isset( $args['block'] ) && is_array( $args['block'] ) ? $args['block'] : array();
if ( empty( $block ) ) {
	return;
}

$is_enabled = ! isset( $block['enabled'] ) || (bool) $block['enabled'];
if ( ! $is_enabled ) {
	return;
}

$title = ! empty( $block['title'] ) ? (string) $block['title'] : '';
$full_text = ! empty( $block['description'] ) ? trim( wp_strip_all_tags( (string) $block['description'] ) ) : '';
$preview_text = ! empty( $block['preview_description'] ) ? trim( wp_strip_all_tags( (string) $block['preview_description'] ) ) : '';
$enable_toggle = ! isset( $block['enable_toggle'] ) || (bool) $block['enable_toggle'];
$link_text = ! empty( $block['link_text'] ) ? trim( (string) $block['link_text'] ) : 'Read more';
$collapse_text = ! empty( $block['collapse_text'] ) ? trim( (string) $block['collapse_text'] ) : 'Show less';
$link_url = ! empty( $block['link_url'] ) ? (string) $block['link_url'] : '#';

if ( '' === $full_text ) {
	return;
}

if ( '' === $preview_text ) {
	$preview_text = wp_trim_words( $full_text, 28, '...' );
}

$has_expandable = $enable_toggle && '' !== $preview_text && $preview_text !== $full_text;
?>
<section class="service-bottom-text">
	<div class="service-bottom-text__container">
		<?php if ( '' !== trim( $title ) ) : ?>
			<p class="service-bottom-text__title"><?php echo esc_html( $title ); ?></p>
		<?php endif; ?>

		<p
			class="service-bottom-text__description<?php echo $has_expandable ? ' service-bottom-text__description--collapsible' : ''; ?>"
			<?php if ( $has_expandable ) : ?>
				data-preview="<?php echo esc_attr( $preview_text ); ?>"
				data-full="<?php echo esc_attr( $full_text ); ?>"
				data-expanded="false"
			<?php endif; ?>
		><?php echo esc_html( $has_expandable ? $preview_text : $full_text ); ?></p>

		<?php if ( $has_expandable ) : ?>
			<button
				type="button"
				class="service-bottom-text__toggle"
				data-expand="<?php echo esc_attr( $link_text ); ?>"
				data-collapse="<?php echo esc_attr( $collapse_text ); ?>"
			><?php echo esc_html( $link_text ); ?></button>
		<?php elseif ( '#' !== trim( $link_url ) && '' !== trim( $link_url ) ) : ?>
			<a class="service-bottom-text__link" href="<?php echo esc_url( $link_url ); ?>">
				<?php echo esc_html( $link_text ); ?>
			</a>
		<?php endif; ?>
	</div>
</section>
