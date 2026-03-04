<?php
/**
 * Custom archive layout for Fleet categories.
 *
 * @package GTS
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

do_action( 'woocommerce_before_main_content' );

$selected_filters   = function_exists( 'gts_theme_get_archive_selected_filters' ) ? gts_theme_get_archive_selected_filters() : array();
$attribute_taxonomy = function_exists( 'wc_get_attribute_taxonomies' ) ? wc_get_attribute_taxonomies() : array();
$archive_title      = woocommerce_page_title( false );
$archive_desc       = '';
$base_url           = wc_get_page_permalink( 'shop' );

if ( is_product_taxonomy() ) {
	$term_obj = get_queried_object();
	if ( $term_obj && ! is_wp_error( $term_obj ) ) {
		$term_link = get_term_link( $term_obj );
		if ( ! is_wp_error( $term_link ) ) {
			$base_url = $term_link;
		}
	}
	$archive_desc = wc_format_content( term_description() );
} else {
	$archive_desc = wc_format_content( get_the_archive_description() );
}
?>

<section class="gts-fleet-archive">
	<div class="gts-fleet-archive__container">
		<header class="gts-fleet-archive__header">
			<?php if ( ! empty( $archive_title ) ) : ?>
				<h1 class="gts-fleet-archive__title"><?php echo esc_html( $archive_title ); ?></h1>
			<?php endif; ?>
			<?php if ( ! empty( $archive_desc ) ) : ?>
				<div class="gts-fleet-archive__description"><?php echo wp_kses_post( $archive_desc ); ?></div>
			<?php endif; ?>
		</header>

		<button type="button" class="gts-fleet-filters-toggle" aria-expanded="false" aria-controls="gts-fleet-filters">
			<span class="gts-fleet-filters-toggle__icon" aria-hidden="true">
				<svg viewBox="0 0 24 24" width="18" height="18" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M4 7h16M7 12h10M10 17h4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
				</svg>
			</span>
			<span class="gts-fleet-filters-toggle__text"><?php esc_html_e( 'Filters', 'gts-theme' ); ?></span>
		</button>

		<div class="gts-fleet-archive__layout">
			<aside class="gts-fleet-filters" id="gts-fleet-filters">
				<div class="gts-fleet-filters__head">
					<h2 class="gts-fleet-filters__title"><?php esc_html_e( 'Filters', 'gts-theme' ); ?></h2>
					<button type="button" class="gts-fleet-filters__close" aria-label="<?php esc_attr_e( 'Close filters', 'gts-theme' ); ?>">×</button>
				</div>

				<form method="get" class="gts-fleet-filters__form" action="<?php echo esc_url( $base_url ); ?>">
					<?php if ( ! empty( $attribute_taxonomy ) ) : ?>
						<?php foreach ( $attribute_taxonomy as $attribute ) : ?>
							<?php
							$taxonomy = wc_attribute_taxonomy_name( $attribute->attribute_name );
							if ( ! taxonomy_exists( $taxonomy ) ) {
								continue;
							}

							$terms = get_terms(
								array(
									'taxonomy'   => $taxonomy,
									'hide_empty' => true,
								)
							);

							if ( is_wp_error( $terms ) || empty( $terms ) ) {
								continue;
							}

							$field_name = 'gtsf_' . $taxonomy;
							$selected   = isset( $selected_filters[ $taxonomy ] ) ? $selected_filters[ $taxonomy ] : array();
							?>
							<fieldset class="gts-fleet-filters__group">
								<legend class="gts-fleet-filters__legend"><?php echo esc_html( $attribute->attribute_label ); ?></legend>
								<div class="gts-fleet-filters__options">
									<?php foreach ( $terms as $term ) : ?>
										<label class="gts-fleet-filters__option">
											<input
												type="checkbox"
												name="<?php echo esc_attr( $field_name ); ?>[]"
												value="<?php echo esc_attr( $term->slug ); ?>"
												<?php checked( in_array( $term->slug, $selected, true ) ); ?>
											>
											<span><?php echo esc_html( $term->name ); ?></span>
										</label>
									<?php endforeach; ?>
								</div>
							</fieldset>
						<?php endforeach; ?>
					<?php endif; ?>

					<div class="gts-fleet-filters__actions">
						<button type="submit" class="btn btn-primary gts-fleet-filters__submit"><?php esc_html_e( 'Apply filters', 'gts-theme' ); ?></button>
						<a class="btn btn-secondary gts-fleet-filters__reset" href="<?php echo esc_url( $base_url ); ?>"><?php esc_html_e( 'Reset', 'gts-theme' ); ?></a>
					</div>
				</form>
			</aside>

			<div class="gts-fleet-products">
				<?php if ( woocommerce_product_loop() ) : ?>
					<?php woocommerce_product_loop_start(); ?>
					<?php while ( have_posts() ) : ?>
						<?php the_post(); ?>
						<?php wc_get_template_part( 'content', 'product' ); ?>
					<?php endwhile; ?>
					<?php woocommerce_product_loop_end(); ?>
					<?php do_action( 'woocommerce_after_shop_loop' ); ?>
				<?php else : ?>
					<?php do_action( 'woocommerce_no_products_found' ); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

<div class="gts-fleet-filters-overlay" aria-hidden="true"></div>

<?php
do_action( 'woocommerce_after_main_content' );
get_footer( 'shop' );
