<?php
/*
Plugin Name: Neon Editor
Description: Editor for creating neon signs templates.
Version: 1.0
Author: SweetStackDigital
*/

// Load modules
$ne_inc_dir = plugin_dir_path(__FILE__) . 'includes/';
$ne_inc_files = array(
    'ne-navigation.php',
    'ne-folders.php',
    'ne-post-types.php',
    'ne-data.php',
    'ne-templates.php',
    'ne-price.php',
    'ne-order.php',
);

foreach ($ne_inc_files as $file) {
    require_once $ne_inc_dir . $file;
}

function neon_editor_disable_theme_scripts() {
    if (is_page_template( 'neon-editor-template.php' ) || is_page_template( 'neon-editor-template.php' ) && is_user_logged_in() ) {
        add_filter('wp_enqueue_scripts', function() {
            wp_dequeue_style('main-stylesheet'); // Заменитые 'theme-style' на реальное название стиля вашей темы
            wp_dequeue_script('main-javascript'); // Замените 'theme-script' на реальное название скрипта вашей темы
        }, 999);

        wp_enqueue_script('neon-app', plugin_dir_url(__FILE__) . 'templates/dist/assets/index.js', [ 'jquery' ], null, true);
    }
}

add_action('wp_enqueue_scripts', 'neon_editor_disable_theme_scripts', 1);




if( !function_exists( 'ne_load_files' ) ) {

    function ne_load_files() {
        $userType = '';

        if( current_user_can( 'edit_pages' ) ) {
            $userType = 'admin';
        } else {
            $userType = 'subscriber';
        }

        $status = 'publish';

        // LOAD BACKGROUNDS
        $bg_args = array(
            'numberposts' => -1,
            'post_status' => $status,
            'orderby'     => 'date',
            'order'       => 'DESC',
            'post_type'   => 'backgrounds',
        );
        $bg_data = get_posts($bg_args);
        $backgrounds = array();
        
        foreach( $bg_data as $obj_data ) {
            $url = get_the_post_thumbnail_url( $obj_data->ID, 'full' );
            $type = get_post_meta( $obj_data->ID, 'ne_background_type_field', true );
            $alt = get_the_title( $obj_data->ID );
            
            array_push(
                $backgrounds, 
                array(
                    'url' => $url,
                    'type' => $type,
                    'alt' => $alt,
                )
            );
        }

        // LOAD SYMBOLS
        $symbols_args = array(
            'numberposts' => -1,
            'post_status' => $status,
            'orderby'     => 'date',
            'order'       => 'DESC',
            'post_type'   => 'symbols',
        );
        $symbols_data = get_posts($symbols_args);
        $symbols = array();

        foreach( $symbols_data as $symbol_data ) {
            $name = get_the_title( $symbol_data->ID );
            $glb = get_post_meta( $symbol_data->ID, '_base_symbol_glb_url', true );
            $svg = get_the_post_thumbnail_url( $symbol_data->ID, 'full' );
            $id = $symbol_data->ID;
            

            array_push(
                $symbols, 
                array(
                    'name' => $name,
                    'glb' => $glb,
                    'svg' => $svg,
                    'id' => $id,
                )
            );
        }

        // LOAD FONTS
        $fonts_args = array(
            'numberposts' => -1,
            'post_status' => $status,
            'orderby'     => 'date',
            'order'       => 'DESC',
            'post_type'   => 'fonts',
        );
        $fonts_data = get_posts($fonts_args);
        $fonts = array();
        foreach( $fonts_data as $font_data ) {
            $name = $font_data->post_title;
            $url = get_post_meta( $font_data->ID, '_font_file_json', true );
            $id = $font_data->ID;

            array_push(
                $fonts, 
                array(
                    'name' => $name,
                    'url' => $url,
                    'id' => $id,
                )
            );
        }

        $pluginVars = array(
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'pluginUrl' => plugin_dir_url(__FILE__),
            'backgrounds' => $backgrounds,
            'fonts' => $fonts,
            'userType' => $userType,
            'symbols' => $symbols,
            'wallMountPrice' => 20,
            'outdoorPlacementPrice' => 20,
        );

        wp_localize_script('neon-app', 'pluginVars', $pluginVars); 
    }

    add_action('wp_enqueue_scripts', 'ne_load_files', 1);

}

function ne_generate_id() {
    return rand(1000, 9999);
}

add_action('wp_ajax_neon_editor_place_order', 'ne_place_order');
add_action('wp_ajax_nopriv_neon_editor_place_order', 'ne_place_order');

function ne_place_order() {
    $product_data = $_POST;
    $product_img = $_FILES['image'];
    $product_placement = $product_data['placement'];
    $product_placement_price = 0;
    $product_mounting_kit = json_decode(stripslashes($product_data['mounting_kit']));
    $product_mounting_kit_price = 0;

    if( $product_placement === 'outdoor' ) {
        $product_placement_price = 20;
    }

    if( $product_mounting_kit[0]->mounting === 'wall' ) {
        $product_mounting_kit_price = 20;
    }

    $product_price = $product_mounting_kit_price + $product_placement_price;

    $upload_dir = wp_upload_dir();
    $image_upload = wp_upload_bits(basename($product_img['name']), null, file_get_contents($product_img['tmp_name']));

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
        }
    }

    $texts_array = json_decode(stripslashes( $_POST['texts'] ) );
    $symbols_array = json_decode(stripslashes( $_POST['symbols'] ) );


    $all_prices = array();
    $symbol_prices = array();
    $text_prices = array();

    if( !empty( $texts_array ) ) {
        for( $i = 0; $i < count($texts_array); $i++ ) {
            $text_item = $texts_array[$i];
            $os = intval( $text_item->text_height );
            $ac = intval( get_post_meta($text_item->font_id, 'average_capital_price', true) );
            $as = intval( get_post_meta($text_item->font_id, 'average_small_price', true) );
            $bfs = intval( get_post_meta( $text_item->font_id, 'base_font_size', true) );

            $word = $text_item->text; // Замените это слово на нужное вам
            $letters = mb_str_split($word);
            $ns = 0;
            $nc = 0;

            foreach ($letters as $letter) {
                if (mb_strtolower($letter) === $letter) {
                    $ns++;
                } elseif (mb_strtoupper($letter) === $letter) {
                    $nc++;
                }
            }

            $text_price = ( ( $ac * $nc ) + ( $as * $ns ) ) * ( $os / $bfs );

            array_push( $text_prices, array(
                'text' => $text_item->text,
                'price' => $text_price,
            ) );
        }

        foreach( $text_prices as $text_price ) {
            array_push($all_prices, $text_price['price']);
        }
    }

    if( !empty( $symbols_array ) ) {

        for( $i = 0; $i < count($symbols_array); $i++ ) {
            $symbol_item = $symbols_array[$i];
            $os = intval( $symbol_item->model_height );
            $bp = intval( get_post_meta($symbol_item->model_id, '_base_symbol_price', true) );
            $bfs = intval( get_post_meta($symbol_item->model_id, '_base_symbol_size', true) );

            $symbol_price = $bp * ( $os / $bfs );

            array_push( $symbol_prices, array(
                'symbol' => get_the_title( $symbol_item->model_id ),
                'price' => $symbol_price,
            ) );
        }

        foreach( $symbol_prices as $symbol_price ) {
            array_push($all_prices, $symbol_price['price']);
        }

    }

    $total_price = ceil( array_sum( $all_prices ) + intval( $product_placement_price ) + intval( $product_mounting_kit_price ) );

    $product_id = ne_generate_id();
    $product_size = array_map('intval', mb_split("[\[\],]", $product_data['board_size']));
    $product_width = $product_size[1];
    $product_height = $product_size[2];
    $product_slug = 'order-number-' . $product_id;
    $product_placement = $product_data['placement'];
    $product_cable = $product_data['cable_color'];
    $product = new WC_Product_Simple();
    $product->set_name( 'Order #' . $product_id ); // product title
    $product->set_slug( $product_slug );
    $product->set_regular_price( $total_price ); // in current shop currbn
    $product->set_image_id( $image_id );
    $product->set_width( $product_width );
    $product->set_height( $product_height );

    $product->save();

    $product_obj = get_page_by_path( $product_slug, OBJECT, 'product' );
    $product_internal_id = $product_obj->ID;

    update_post_meta($product_internal_id, 'placement', $product_placement);
    update_post_meta($product_internal_id, 'cable_color', $product_cable);
    update_post_meta($product_internal_id, 'mounting', $product_mounting_kit[0]->mounting);
    update_post_meta($product_internal_id, 'mounting_color', $product_mounting_kit[1]->color);
    WC()->cart->add_to_cart( $product_internal_id );
    $cart_url = wc_get_cart_url();

    $response = array( 'redirectUrl' => esc_url( $cart_url ) );
    wp_send_json( $response );
}
