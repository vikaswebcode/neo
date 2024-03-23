<?php
/**
 * 
 */


// FONTS
if( !function_exists( 'ne_fonts_post_type' ) ) {

    function ne_fonts_post_type() {
        $labels = array(
            'name' => 'Fonts',
            'singular_name' => 'Font',
            'menu_name' => 'Fonts',
            'all_items' => 'All Fonts',
            'add_new' => 'Add New',
            'add_new_item' => 'Add New Font',
            'edit_item' => 'Edit Font',
            'new_item' => 'New Font',
            'view_item' => 'View Font',
            'search_items' => 'Search Fonts',
            'not_found' => 'No Fonts found',
            'not_found_in_trash' => 'No Fonts found in Trash',
        );
    
        $args = array(
            'labels' => $labels,
            'public' => true,
            'show_ui' => true,
            'menu_icon' => 'dashicons-welcome-widgets-menus', // Иконка меню (можете выбрать другую)
            'show_in_menu' => false,
            'supports' => array('title'), // Поддерживаемые поля (например, title)
            'publicly_queryable' => false, // Отключение архива
            'has_archive' => false,
            'hierarchical' => false, // Отключение иерархии
            'exclude_from_search' => true, // Исключение из поиска
            'show_in_nav_menus' => false, // Отключение из меню навигации
            'show_in_admin_bar' => false, // Отключение из админской панели
        );
    
        register_post_type('fonts', $args);
    };

    add_action('init', 'ne_fonts_post_type');

}

if( !function_exists( 'ne_fonts_metaboxes' ) )  {

    function ne_fonts_metaboxes() {
        add_meta_box('font_details', 'Font Details', 'ne_font_details_callback', 'fonts', 'normal', 'default');
    };

    add_action('add_meta_boxes', 'ne_fonts_metaboxes');
}

if( !function_exists( 'ne_font_details_callback' ) ) {

    function ne_font_details_callback($post) {

        wp_nonce_field('ne_font_details_nonce', 'ne_font_details_nonce');

        $base_font_size = get_post_meta($post->ID, 'base_font_size', true);
        $average_capital_price = get_post_meta($post->ID, 'average_capital_price', true);
        $average_small_price = get_post_meta($post->ID, 'average_small_price', true);

        echo '<label for="base_font_size">Base Font Size:</label>';
        echo '<input type="text" id="base_font_size" name="base_font_size" value="' . esc_attr($base_font_size) . '"><br>';

        echo '<label for="average_capital_price">Average Capital Price:</label>';
        echo '<input type="text" id="average_capital_price" name="average_capital_price" value="' . esc_attr($average_capital_price) . '"><br>';

        echo '<label for="average_small_price">Average Small Price:</label>';
        echo '<input type="text" id="average_small_price" name="average_small_price" value="' . esc_attr($average_small_price) . '"><br>';

        echo '<label for="font_file">Font file (ttf, otf):</label>';
        echo '<input type="file" name="font_file" id="font_file">';

        $font_file_format = get_post_meta($post->ID, '_font_file_url', true);
        if (!empty($font_file_format)) {
            $file_name = basename($font_file_format);
            echo '<p>Attached file: ' . esc_html($file_name) . '</p>';
        }

        echo '<label for="font_file_json">Font file JSON:</label>';
        echo '<input type="file" name="font_file_json" id="font_file_json">';

        $font_file_json = get_post_meta($post->ID, '_font_file_json', true);
        if (!empty($font_file_json)) {
            $file_name = basename($font_file_json);
            echo '<p>Attached file: ' . esc_html($file_name) . '</p>';
        }
    }

}

if (!function_exists('ne_save_font_details_meta')) {

    function ne_save_font_details_meta($post_id) {

        if (!isset($_POST['ne_font_details_nonce']) || !wp_verify_nonce($_POST['ne_font_details_nonce'], 'ne_font_details_nonce')) {
            return;
        }

        if (isset($_POST['base_font_size'])) {
            update_post_meta($post_id, 'base_font_size', sanitize_text_field($_POST['base_font_size']));
        }

        if (isset($_POST['average_capital_price'])) {
            update_post_meta($post_id, 'average_capital_price', sanitize_text_field($_POST['average_capital_price']));
        }

        if (isset($_POST['average_small_price'])) {
            update_post_meta($post_id, 'average_small_price', sanitize_text_field($_POST['average_small_price']));
        }
        
        if (!empty($_FILES['font_file']['name'])) {
            $uploaded_file = $_FILES['font_file'];
    
            // Параметры для wp_handle_upload
            $upload_overrides = array('test_form' => false);
    
            // Обрабатываем загрузку файла
            $upload_result = wp_handle_upload($uploaded_file, $upload_overrides);
    
            if ($upload_result && !isset($upload_result['error'])) {
                $file_path = $upload_result['url']; // Изменили получение URL файла
                $file_name = basename($file_path);

                $attachment = array(
                    'post_mime_type' => $upload_result['type'],
                    'post_title' => preg_replace('/\.[^.]+$/', '', $file_name),
                    'post_content' => '',
                    'post_status' => 'inherit'
                );
    
                $attachment_id = wp_insert_attachment($attachment, $file_path, $post_id);
                require_once ABSPATH . 'wp-admin/includes/image.php';
                $attachment_data = wp_generate_attachment_metadata($attachment_id, $file_path);
                wp_update_attachment_metadata($attachment_id, $attachment_data);
    
                update_post_meta($post_id, '_font_file_url', $file_path);
            }
        }

        if (!empty($_FILES['font_file_json']['name'])) {
            $uploaded_file = $_FILES['font_file_json'];
    
            // Параметры для wp_handle_upload
            $upload_overrides = array('test_form' => false);
    
            // Обрабатываем загрузку файла
            $upload_result = wp_handle_upload($uploaded_file, $upload_overrides);
    
            if ($upload_result && !isset($upload_result['error'])) {
                $file_path = $upload_result['url']; // Изменили получение URL файла
                $file_name = basename($file_path);

                $attachment = array(
                    'post_mime_type' => $upload_result['type'],
                    'post_title' => preg_replace('/\.[^.]+$/', '', $file_name),
                    'post_content' => '',
                    'post_status' => 'inherit'
                );
    
                $attachment_id = wp_insert_attachment($attachment, $file_path, $post_id);
                require_once ABSPATH . 'wp-admin/includes/image.php';
                $attachment_data = wp_generate_attachment_metadata($attachment_id, $file_path);
                wp_update_attachment_metadata($attachment_id, $attachment_data);
    
                update_post_meta($post_id, '_font_file_json', $file_path);
            }
        }
    }

    add_action('save_post', 'ne_save_font_details_meta');

}   

// BACKGROUNDS
if( !function_exists( 'ne_backgrounds_post_type' ) ) {

    function ne_backgrounds_post_type() {
        $labels = array(
            'name' => 'Backgrounds',
            'singular_name' => 'Background',
            'menu_name' => 'Backgrounds',
            'all_items' => 'All Backgrounds',
            'add_new' => 'Add New',
            'add_new_item' => 'Add New Background',
            'edit_item' => 'Edit Background',
            'new_item' => 'New Background',
            'view_item' => 'View Backgrounds',
            'search_items' => 'Search Backgrounds',
            'not_found' => 'No Backgrounds found',
            'not_found_in_trash' => 'No Backgrounds found in Trash',
        );
    
        $args = array(
            'labels' => $labels,
            'public' => true,
            'show_ui' => true,
            'menu_icon' => '', // Иконка меню (можете выбрать другую)
            'show_in_menu' => false,
            'supports' => array('title', 'thumbnail'), // Поддерживаемые поля (например, title)
            'publicly_queryable' => false, // Отключение архива
            'has_archive' => false,
            'hierarchical' => false, // Отключение иерархии
            'exclude_from_search' => true, // Исключение из поиска
            'show_in_nav_menus' => false, // Отключение из меню навигации
            'show_in_admin_bar' => false, // Отключение из админской панели
        );
    
        register_post_type('backgrounds', $args);
    };

    add_action('init', 'ne_backgrounds_post_type');
}

if( !function_exists( 'ne_backgrounds_metaboxes' ) ) {

    function ne_backgrounds_metaboxes() {
        add_meta_box(
            'ne_background_type',
            'Choose background type',
            'ne_background_type_content',
            'backgrounds',
            'normal',
            'default',
        );
    }

    add_action('add_meta_boxes', 'ne_backgrounds_metaboxes');

}

if( !function_exists( 'ne_background_type_content' ) ) {

    function ne_background_type_content($post) {
        $value = get_post_meta($post->ID, 'ne_background_type_field', true); // Получение сохраненного значения (если есть)
        
        echo '<label for="ne_background_type_field">Choose background type: </label>';
        echo '<select name="ne_background_type_field" id="ne_background_type_field">';
        echo '<option value="business" ' . selected($value, 'business', false) . '>Business</option>';
        echo '<option value="personal" ' . selected($value, 'personal', false) . '>Personal</option>';
        echo '</select>';
    }

}

if( !function_exists( 'ne_save_backgrounds_metaboxes_data' ) ) {

    function ne_save_backgrounds_metaboxes_data( $post_id ) {
        if (array_key_exists('ne_background_type_field', $_POST)) {
            update_post_meta(
                $post_id,
                'ne_background_type_field',
                sanitize_text_field($_POST['ne_background_type_field'])
            );
        }
    }

    add_action('save_post', 'ne_save_backgrounds_metaboxes_data');

}



// SYMBOLS
if( !function_exists( 'ne_symbols_post_type' ) ) {

    function ne_symbols_post_type() {
        $labels = array(
            'name' => 'Symbols',
            'singular_name' => 'Symbol',
            'menu_name' => 'Symbols',
            'all_items' => 'All Symbols',
            'add_new' => 'Add New',
            'add_new_item' => 'Add New Symbol',
            'edit_item' => 'Edit Symbol',
            'new_item' => 'New Symbol',
            'view_item' => 'View Symbols',
            'search_items' => 'Search Symbols',
            'not_found' => 'No Symbols found',
            'not_found_in_trash' => 'No Symbols found in Trash',
        );
    
        $args = array(
            'labels' => $labels,
            'public' => true,
            'show_ui' => true,
            'menu_icon' => '', // Иконка меню (можете выбрать другую)
            'show_in_menu' => false,
            'supports' => array('title', 'thumbnail'), // Поддерживаемые поля (например, title)
            'publicly_queryable' => false, // Отключение архива
            'has_archive' => false,
            'hierarchical' => false, // Отключение иерархии
            'exclude_from_search' => true, // Исключение из поиска
            'show_in_nav_menus' => false, // Отключение из меню навигации
            'show_in_admin_bar' => false, // Отключение из админской панели
        );
    
        register_post_type('symbols', $args);
    };

    add_action('init', 'ne_symbols_post_type');
}

if( !function_exists( 'ne_symbols_metaboxes' ) ) {

    function ne_symbols_metaboxes() {
        add_meta_box(
            'ne_glb_symbol',
            'Upload GLB File',
            'ne_symbols_metaboxes_content',
            'symbols',
            'normal',
            'default',
        );
    }

    add_action('add_meta_boxes', 'ne_symbols_metaboxes');

}

if (!function_exists('ne_symbols_metaboxes_content')) {

    function ne_symbols_metaboxes_content($post) {
        $base_symbol_price = get_post_meta($post->ID, '_base_symbol_price', true);
        echo '<label for="base_symbol_price">Base Symbol Price:</label>';
        echo '<input type="text" name="base_symbol_price" id="base_symbol_price" value="' . esc_attr($base_symbol_price) . '">';

        // Добавляем метаполе для базового размера символа
        $base_symbol_size = get_post_meta($post->ID, '_base_symbol_size', true);
        echo '<label for="base_symbol_size">Base Symbol Size:</label>';
        echo '<input type="text" name="base_symbol_size" id="base_symbol_size" value="' . esc_attr($base_symbol_size) . '">';

        echo '<label for="base_symbol_glb">Base Symbol GLB:</label>';
        echo '<input type="file" name="base_symbol_glb" id="base_symbol_glb">';

        $base_symbol_model_url = get_post_meta($post->ID, '_base_symbol_glb_url', true);
        if (!empty($base_symbol_model_url)) {
            $file_name = basename($base_symbol_model_url);
            echo '<p>Attached file: ' . esc_html($file_name) . '</p>';
        }
    }

}

if (!function_exists('ne_save_symbols_metaboxes')) {

    function ne_save_symbols_metaboxes($post_id) {
        if (isset($_POST['base_symbol_price'])) {
            update_post_meta($post_id, '_base_symbol_price', sanitize_text_field($_POST['base_symbol_price']));
        }
    
        // Сохраняем значение базового размера символа
        if (isset($_POST['base_symbol_size'])) {
            update_post_meta($post_id, '_base_symbol_size', sanitize_text_field($_POST['base_symbol_size']));
        }

        if (!empty($_FILES['base_symbol_glb']['name'])) {
            $uploaded_file = $_FILES['base_symbol_glb'];
    
            // Параметры для wp_handle_upload
            $upload_overrides = array('test_form' => false);
    
            // Обрабатываем загрузку файла
            $upload_result = wp_handle_upload($uploaded_file, $upload_overrides);
    
            if ($upload_result && !isset($upload_result['error'])) {
                $file_path = $upload_result['url']; // Изменили получение URL файла
                $file_name = basename($file_path);

                $attachment = array(
                    'post_mime_type' => $upload_result['type'],
                    'post_title' => preg_replace('/\.[^.]+$/', '', $file_name),
                    'post_content' => '',
                    'post_status' => 'inherit'
                );
    
                $attachment_id = wp_insert_attachment($attachment, $file_path, $post_id);
                require_once ABSPATH . 'wp-admin/includes/image.php';
                $attachment_data = wp_generate_attachment_metadata($attachment_id, $file_path);
                wp_update_attachment_metadata($attachment_id, $attachment_data);
    
                update_post_meta($post_id, '_base_symbol_glb_url', $file_path);
            }
        }
    }

    add_action('save_post', 'ne_save_symbols_metaboxes');

}


function update_edit_form() {
    echo ' enctype="multipart/form-data"';
} // end update_edit_form 
add_action('post_edit_form_tag', 'update_edit_form');
