<?php
/**
 * Blog filters (categories) block.
 *
 * "Mobility Insights" tab works as "All posts" entry (matches the design screenshot).
 *
 * @package GTS
 */

$posts_page_id = (int) get_option( 'page_for_posts' );
$blog_url       = $posts_page_id ? get_permalink( $posts_page_id ) : home_url( '/' );

$is_category = is_category();
$current_cat = $is_category ? get_queried_object() : null;
$current_id  = ( $current_cat && isset( $current_cat->term_id ) ) ? (int) $current_cat->term_id : 0;

$categories = get_categories(
	array(
		'hide_empty' => true,
		'orderby'    => 'name',
		'order'      => 'ASC',
	)
);

// Desired order from design. If a category doesn't exist, it will be skipped.
$desired_order = array(
	'Corporate & Events',
	'Private Travel',
	'Travel Planning',
	'Behind the Scenes',
);

$by_name = array();
foreach ( $categories as $cat ) {
	$by_name[ $cat->name ] = $cat;
}

$ordered = array();
foreach ( $desired_order as $name ) {
	if ( isset( $by_name[ $name ] ) ) {
		$ordered[] = $by_name[ $name ];
	}
}

// Add any remaining categories (excluding Uncategorized).
foreach ( $categories as $cat ) {
	if ( 'Uncategorized' === $cat->name ) {
		continue;
	}
	$already = false;
	foreach ( $ordered as $o ) {
		if ( (int) $o->term_id === (int) $cat->term_id ) {
			$already = true;
			break;
		}
	}
	if ( ! $already ) {
		$ordered[] = $cat;
	}
}
?>

<nav class="blog-filters" aria-label="<?php echo esc_attr__( 'Blog categories', 'gts-theme' ); ?>">
	<a class="blog-filters__item <?php echo $is_category ? '' : 'is-active'; ?>" href="<?php echo esc_url( $blog_url ); ?>">
		<?php esc_html_e( 'All', 'gts-theme' ); ?>
	</a>

	<?php foreach ( $ordered as $cat ) : ?>
		<?php
		$is_active = $is_category && ( (int) $cat->term_id === $current_id );
		?>
		<a class="blog-filters__item <?php echo $is_active ? 'is-active' : ''; ?>" href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>">
			<?php echo esc_html( $cat->name ); ?>
		</a>
	<?php endforeach; ?>
</nav>
