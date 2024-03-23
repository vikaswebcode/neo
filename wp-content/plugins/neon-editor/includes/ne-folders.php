<?php
/**
 * 
 */


if( !function_exists( 'neon_editor_upload_dir' ) ) {

    function neon_editor_upload_dir() {
        $upload_dir = wp_upload_dir();
        $target_dir = $upload_dir['basedir'] . '/neon-editor';
        
        if (!file_exists($target_dir)) {
            wp_mkdir_p($target_dir, 0777);
        }
    }

    add_action('admin_init', 'neon_editor_upload_dir');

}