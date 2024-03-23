<?php
/**
 * 
 */

if( !function_exists( 'ne_add_neon_editor_menu' ) ) {

    function ne_add_neon_editor_menu() {
        add_menu_page(
            'Neon Editor',
            'Neon Editor',
            'manage_options',
            'neon_editor',
            'neon_editor',
            'dashicons-editor-code',
            81,
        );
    
        add_submenu_page(
            'neon_editor',
            'Symbols',
            'Symbols',
            'manage_options',
            'edit.php?post_type=symbols',
        );
    
        add_submenu_page(
            'neon_editor',
            'Backgrounds',
            'Backgrounds',
            'manage_options',
            'edit.php?post_type=backgrounds',
        );
    
        add_submenu_page(
            'neon_editor',
            'Fonts',
            'Fonts',
            'manage_options',
            'edit.php?post_type=fonts',
        );
    }

    add_action('admin_menu', 'ne_add_neon_editor_menu');
}

