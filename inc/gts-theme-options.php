<?php
/**
 * GTS Theme Options – admin section for header and other editable elements.
 *
 * @package GTS
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register GTS as a top-level admin menu (separate from Appearance).
 */
function gts_theme_options_menu() {
	add_menu_page(
		__( 'GTS Settings', 'gts-theme' ),
		__( 'GTS', 'gts-theme' ),
		'manage_options',
		'gts-theme-options',
		'gts_theme_options_page',
		'dashicons-admin-generic',
		30
	);
}
add_action( 'admin_menu', 'gts_theme_options_menu', 20 );

/**
 * Register GTS theme options.
 */
function gts_theme_options_register_settings() {
	register_setting(
		'gts_theme_options',
		'gts_header_phone',
		array(
			'type'              => 'string',
			'default'           => '+44 00 1111 2222',
			'sanitize_callback' => 'gts_sanitize_header_phone',
		)
	);
}
add_action( 'admin_init', 'gts_theme_options_register_settings' );

/**
 * Sanitize header phone: allow digits, spaces, +, -, (, ).
 *
 * @param string $value Raw value.
 * @return string Sanitized value.
 */
function gts_sanitize_header_phone( $value ) {
	$value = is_string( $value ) ? $value : '';
	$value = preg_replace( '/[^\d\s+\-()]/', '', $value );
	return trim( $value );
}

/**
 * Output digits-only string for tel: link.
 *
 * @param string $display_phone Value from gts_header_phone (can contain spaces, etc).
 * @return string Digits only, e.g. 440011112222.
 */
function gts_header_phone_tel_digits( $display_phone ) {
	$display_phone = is_string( $display_phone ) ? $display_phone : '';
	return preg_replace( '/\D/', '', $display_phone );
}

/**
 * Render GTS Settings page.
 */
function gts_theme_options_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$header_phone = get_option( 'gts_header_phone', '+44 00 1111 2222' );
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'GTS Settings', 'gts-theme' ); ?></h1>
		<p><?php esc_html_e( 'Edit elements used across the site (header, etc.).', 'gts-theme' ); ?></p>

		<form method="post" action="options.php">
			<?php settings_fields( 'gts_theme_options' ); ?>

			<table class="form-table" role="presentation">
				<tr>
					<th scope="row">
						<label for="gts_header_phone"><?php esc_html_e( 'Header phone number', 'gts-theme' ); ?></label>
					</th>
					<td>
						<input type="text" id="gts_header_phone" name="gts_header_phone" value="<?php echo esc_attr( $header_phone ); ?>" class="regular-text" placeholder="+44 00 1111 2222">
						<p class="description"><?php esc_html_e( 'Shown in the header on all screen sizes. Use digits and + - ( ) spaces as needed; click will use digits only for tel: link.', 'gts-theme' ); ?></p>
					</td>
				</tr>
			</table>

			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}
