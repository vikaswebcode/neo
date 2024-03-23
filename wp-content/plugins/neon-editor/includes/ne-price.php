<?php
/**
 * 
 */

if( !function_exists( 'ne_calc_price' ) ) {

    add_action('wp_ajax_neon_editor_calc_price', 'ne_calc_price');
    add_action('wp_ajax_nopriv_neon_editor_calc_price', 'ne_calc_price');
    
    function ne_calc_price() {
        $texts_array = $_POST['texts'];
        $symbols_array = $_POST['symbols'];


        $all_prices = array();
        $symbol_prices = array();
        $text_prices = array();

        if( !empty( $texts_array ) ) {
            for( $i = 0; $i < count($texts_array); $i++ ) {
                $text_item = $texts_array[$i];
                $os = intval( $text_item['text_height'] );
                $ac = intval( get_post_meta($text_item['font_id'], 'average_capital_price', true) );
                $as = intval( get_post_meta($text_item['font_id'], 'average_small_price', true) );
                $bfs = intval( get_post_meta( $text_item['font_id'], 'base_font_size', true) );
    
                $word = $text_item['text']; // Замените это слово на нужное вам
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
                    'text' => $text_item['text'],
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
                $os = intval( $symbol_item['model_height'] );
                $bp = intval( get_post_meta($symbol_item['model_id'], '_base_symbol_price', true) );
                $bfs = intval( get_post_meta($symbol_item['model_id'], '_base_symbol_size', true) );
    
                $symbol_price = $bp * ( $os / $bfs );
    
                array_push( $symbol_prices, array(
                    'symbol' => get_the_title( $symbol_item['model_id'] ),
                    'price' => $symbol_price,
                ) );
            }
    
            foreach( $symbol_prices as $symbol_price ) {
                array_push($all_prices, $symbol_price['price']);
            }

        }

        $total_price = array_sum( $all_prices );

        $averagePrice = array('price' => 0);
        wp_send_json( array( 'price' => $total_price ) );
    }

}
