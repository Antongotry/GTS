<?php
/**
 * Service-like blocks bridge for regular pages.
 *
 * @package GTS
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get mapped service_blocks layouts for a page.
 *
 * @param int $page_id Page ID.
 * @return array<string, array>
 */
function gts_get_page_service_blocks_map( $page_id ) {
	static $cache = array();

	$page_id = (int) $page_id;
	if ( $page_id <= 0 ) {
		return array();
	}

	if ( isset( $cache[ $page_id ] ) ) {
		return $cache[ $page_id ];
	}

	$map = array();
	if ( ! function_exists( 'get_field' ) ) {
		$cache[ $page_id ] = $map;
		return $map;
	}

	$blocks = get_field( 'service_blocks', $page_id );
	if ( is_array( $blocks ) ) {
		foreach ( $blocks as $block ) {
			if ( ! is_array( $block ) || empty( $block['acf_fc_layout'] ) ) {
				continue;
			}
			$layout = (string) $block['acf_fc_layout'];
			$map[ $layout ] = $block;
		}
	}

	$cache[ $page_id ] = $map;
	return $map;
}

/**
 * Get one layout block data for current page.
 *
 * @param string $layout Layout key.
 * @param int    $page_id Optional page id.
 * @return array
 */
function gts_get_page_service_block( $layout, $page_id = 0 ) {
	$page_id = $page_id ? (int) $page_id : (int) get_queried_object_id();
	$map = gts_get_page_service_blocks_map( $page_id );
	return isset( $map[ $layout ] ) && is_array( $map[ $layout ] ) ? $map[ $layout ] : array();
}

/**
 * Check layout enabled state for current page.
 *
 * @param string $layout Layout key.
 * @param bool   $default Default state when layout is absent.
 * @param int    $page_id Optional page id.
 * @return bool
 */
function gts_is_page_service_block_enabled( $layout, $default = true, $page_id = 0 ) {
	$block = gts_get_page_service_block( $layout, $page_id );
	if ( empty( $block ) ) {
		return (bool) $default;
	}
	if ( isset( $block['enabled'] ) ) {
		return (bool) $block['enabled'];
	}
	return (bool) $default;
}

/**
 * Check whether current request is one of service-style pages.
 *
 * @return bool
 */
function gts_is_service_style_page() {
	return is_page_template( 'page-city-to-city.php' ) || is_page_template( 'page-limousine-service.php' ) || is_page( 'city-to-city' ) || is_page( 'limousine-service' );
}
