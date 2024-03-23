<?php
namespace BP3D\Addons;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

final class AddonsPro {

	const VERSION = '1.0.0';
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';
	const MINIMUM_PHP_VERSION = '7.0';
	private static $_instance = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct(){

	}

	public function register() {
		//Register Frontend Script
		add_action( "elementor/frontend/after_register_scripts", [ $this, 'frontend_assets_scripts' ] );

		// Add Plugin actions
		add_action( 'elementor/widgets/register', [ $this, 'init_widgets' ] );

	}


	/**
	 * Frontend script
	 */
	public function frontend_assets_scripts(){

		if(!wp_script_is('bp3d-model-viewer', 'registered')){

			wp_register_style( 'bp3d-public', BP3D_DIR . 'dist/public.css', [], BP3D_VERSION );

            wp_register_script('bp3d-model-viewer', BP3D_DIR.'public/js/model-viewer.min.js', [], BP3D_VERSION, true );
            wp_register_script('bp3d-public', BP3D_DIR . 'dist/public.js', [ 'react', 'react-dom', 'bp3d-model-viewer', 'jquery' ], BP3D_VERSION, true );
		}
	
	}

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_widgets() {
		// Include Widget files
		require_once( __DIR__ . '/ModelViewer.php' );

		// Register widget
		\Elementor\Plugin::instance()->widgets_manager->register( new ModelViewer() );
	}

}
