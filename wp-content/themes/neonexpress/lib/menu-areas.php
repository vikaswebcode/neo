<?php
/**
 * Register navigation menus
 *
 * @link https://codex.wordpress.org/Function_Reference/register_nav_menus
 * @package Neon_Express
 */

add_action( 'after_setup_theme', 'register_theme_menus' );

/**
 * register_theme_menus
 *
 * @return void
 */
function register_theme_menus() {
	register_nav_menus(
		array(
			'primary'     => __( 'Primary Menu', 'wp_dev' ),
			'footer_menu_1' => __( 'Footer Menu 1', 'wp_dev' ),
			'footer_menu_2' => __( 'Footer Menu 2', 'wp_dev' ),
			'footer_menu_3' => __( 'Footer Menu 3', 'wp_dev' ),
		)
	);
}
