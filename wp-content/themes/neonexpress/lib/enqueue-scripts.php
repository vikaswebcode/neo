<?php
/**
 * Enqueue all styles and scripts.
 *
 * Learn more about enqueue_script: {@link https://codex.wordpress.org/Function_Reference/wp_enqueue_script}
 * Learn more about enqueue_style: {@link https://codex.wordpress.org/Function_Reference/wp_enqueue_style}
 *
 * @package Neon_Express
 */

if ( ! function_exists( 'ne_scripts' ) ) :
	/**
	 * ne_scripts
	 *
	 * @return void
	 */
	function ne_scripts() {
		// Enqueue the main Stylesheet.
		wp_enqueue_style( 'main-stylesheet', asset_path( 'styles/main.css' ), false, '1.0.0', 'all' );

		// Enqueue the main JS file.
		wp_enqueue_script( 'main-javascript', asset_path( 'scripts/main.js' ), [ 'jquery' ], '1.0.0', true );


		$upload_dir_info = wp_upload_dir();

		// Получение пути к папке загрузок
		$uploads_dir_path = $upload_dir_info['basedir'];

		// Получение URL папки загрузок
		$uploads_url = $upload_dir_info['baseurl'];

		// Throw variables from back to front end.
		$theme_vars = array(
			'home'   => get_home_url(),
			'isHome' => is_front_page(),
			'uploadUrl' => 'http://localhost:3000/wp-content/themes/neonexpress/lib/upload.php',
			'ajaxUrl' => admin_url('admin-ajax.php'),
			'uploadsDir' => $uploads_url,
		);
		
		wp_localize_script( 'main-javascript', 'themeVars', $theme_vars );

		// Comments reply script
		if ( is_singular() && comments_open() ) :
			wp_enqueue_script( 'comment-reply' );
		endif;
	}

	add_action( 'wp_enqueue_scripts', 'ne_scripts' );
endif;