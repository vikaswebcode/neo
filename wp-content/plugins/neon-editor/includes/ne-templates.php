<?php
/**
 * The file responsible for working with templates
 */

// Register Neon Editor Layout
if( !function_exists( 'neon_editor_register_template' ) )  {

    function neon_editor_register_template($templates) {
        $templates['neon-editor-template.php'] = 'Neon Editor Template';
        return $templates;
    }

    add_filter('theme_page_templates', 'neon_editor_register_template');
}

// Load Neon editor layout
if( !function_exists( 'neon_editor_load_template' ) ) {

    function neon_editor_load_template($template) {
        if (is_page()) {
            $page_template = get_page_template_slug();
            if ($page_template === 'neon-editor-template.php') {
                $new_template = plugin_dir_path(__DIR__) . 'templates/neon-editor-template.php';
                if ('' != $new_template) {
                    return $new_template;
                }
            }
        }
    
        return $template;
    }

    add_filter('page_template', 'neon_editor_load_template');
}

// Send templates
if( !function_exists( 'ne_get_template' ) ) {

    add_action('wp_ajax_neon_editor_get_template', 'ne_get_template');
    add_action('wp_ajax_nopriv_neon_editor_get_template', 'ne_get_template');

    function ne_get_template() {
        $args = array(
            'post_type' => 'relevant-templates', // Замените на имя вашего кастомного типа записей
            'posts_per_page' => -1, // Получить все записи
            'post_status' => 'publish',
        );
    
        $templates = get_posts($args);
    
        $template_objects = array();
    
        foreach ($templates as $template) {
            setup_postdata($template);
        
            $template_object = array(
                'name' => $template->post_title,
                'template' => json_decode(stripslashes(get_post_meta($template->ID, 'ne_json_field', true))),
                'image' => get_the_post_thumbnail_url($template, 'full'),
                'template_id' => $template->ID,
                'background' => get_post_meta($template->ID, 'background_url', true),
                'background_scale' => json_decode(stripslashes(get_post_meta($template->ID, 'background_scale', true))),
            );
        
            $template_objects[] = $template_object;

        }

        wp_reset_postdata();
    
        wp_send_json($template_objects);
    };

};

// Save templates
if( !function_exists( 'ne_save_template' ) ) {

    add_action('wp_ajax_neon_editor_save_template', 'ne_save_template');
    add_action('wp_ajax_nopriv_neon_editor_save_template', 'ne_save_template');

    function ne_save_template() {
        $image = $_FILES['image'];
        $model = $_POST['model'];
        $background_url = $_POST['background'];
        $background_scale = $_POST['background_scale'];

        $post_data = array(
            'post_title'   => 'New Template (Wait rename)',
            'post_status'  => 'draft',
            'post_type'    => 'relevant-templates', // Замените на ваш тип записи
        );

        $post_id = wp_insert_post($post_data);

        update_post_meta($post_id, 'ne_json_field', $model);
        update_post_meta($post_id, 'background_url', $background_url);
        update_post_meta($post_id, 'background_scale', $background_scale);

        if ($post_id) {
            $upload_dir = wp_upload_dir();
            $image_upload = wp_upload_bits(basename($image['name']), null, file_get_contents($image['tmp_name']));
            
            if (isset($image_upload['file'])) {
                $image_path = $upload_dir['path'] . '/' . basename($image_upload['file']);
                
                $attachment = array(
                    'post_mime_type' => $image_upload['type'],
                    'post_title'     => preg_replace('/\.[^.]+$/', '', basename($image_upload['file'])),
                    'post_content'   => '',
                    'post_status'    => 'inherit',
                );
                
                $image_id = wp_insert_attachment($attachment, $image_path, $post_id);
                
                if (!is_wp_error($image_id)) {
                    require_once(ABSPATH . 'wp-admin/includes/image.php');
                    $attachment_data = wp_generate_attachment_metadata($image_id, $image_path);
                    wp_update_attachment_metadata($image_id, $attachment_data);
                    
                    set_post_thumbnail($post_id, $image_id);
                }
            }
        }

        $response = array('model' => $model, 'image' => $image_url);
        wp_send_json($response);
    }

}



