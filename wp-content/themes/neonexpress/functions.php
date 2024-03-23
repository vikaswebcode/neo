<?php
/**
 * Theme functions and definitions.
 *
 * @package Neon_Express
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 */

//  function custom_allow_ai_upload( $mimes ) {
//     $mimes['ai'] = 'application/postscript';
//     return $mimes;
// }
// add_filter( 'upload_mimes', 'custom_allow_ai_upload' ); 

/**
 * Text domain definition
 */
defined( 'THEME_TD' ) ? THEME_TD : define( 'THEME_TD', 'ne' );

// Load modules
$theme_includes = [
    '/lib/helpers.php',
    '/lib/cleanup.php',                        // Clean up default theme includes
    '/lib/enqueue-scripts.php',                // Enqueue styles and scripts
    '/lib/protocol-relative-theme-assets.php', // Protocol (http/https) relative assets path
    '/lib/framework.php',                      // Css framework related stuff (content width, nav walker class, comments, pagination, etc.)
    '/lib/theme-support.php',                  // Theme support options
    '/lib/template-tags.php',                  // Custom template tags
    '/lib/menu-areas.php',                     // Menu areas
    '/lib/widget-areas.php',                   // Widget areas
    '/lib/customizer.php',                     // Theme customizer
    '/lib/vc_shortcodes.php',                  // Visual Composer shortcodes
    '/lib/jetpack.php',                        // Jetpack compatibility file
    '/lib/acf_field_groups_type.php',          // ACF Field Groups Organizer
    '/lib/acf_blocks_loader.php',              // ACF Blocks Loader
    '/lib/acf_options_page.php',               // ACF Options Page Loader
    '/lib/acf_fields.php',
    '/lib/wp_dashboard_customizer.php',        // WP Dashboard customizer
];

foreach ( $theme_includes as $file ) {
    if ( ! locate_template( $file ) ) {
        /* translators: %s error*/
        trigger_error( esc_html( sprintf( esc_html( __('Error locating %s for inclusion', 'ne') ), $file ) ), E_USER_ERROR ); // phpcs:ignore
        continue;
    }
    require_once locate_template( $file );
}
unset( $file, $filepath );


/**
 * wp_has_sidebar Add body class for active sidebar
 *
 * @param array $classes - classes
 * @return array
 */
function wp_has_sidebar( $classes ) {
    if ( is_active_sidebar( 'sidebar' ) ) {
        // add 'class-name' to the $classes array
        $classes[] = 'has_sidebar';
    }
    return $classes;
}

add_filter( 'body_class', 'wp_has_sidebar' );

// Remove the version number of WP
// Warning - this info is also available in the readme.html file in your root directory - delete this file!
remove_action( 'wp_head', 'wp_generator' );


/**
 * Obscure login screen error messages
 *
 * @return string
 */
function wp_login_obscure() {
    return sprintf(
        '<strong>%1$s</strong>: %2$s',
        __( 'Error' ),
        __( 'wrong username or password' )
    );
}

add_filter( 'login_errors', 'wp_login_obscure' );

/**
 * Require Authentication for All WP REST API Requests
 *
 * @param WP_Error|null|true $result WP_Error if authentication error, null if authentication method wasn't used, true if authentication succeeded.
 * @return WP_Error
 */
function rest_authentication_require( $result ) {
    if ( true === $result || is_wp_error( $result ) ) {
        return $result;
    }

    if ( ! is_user_logged_in() ) {
        return new WP_Error(
            'rest_not_logged_in',
            __( 'You are not currently logged in.' ),
            array( 'status' => 401 )
        );
    }

    return $result;
}

add_filter( 'rest_authentication_errors', 'rest_authentication_require' );


// Disable the theme / plugin text editor in Admin
define( 'DISALLOW_FILE_EDIT', true );

add_action('wp_ajax_send_contact_form', 'send_form');
add_action('wp_ajax_nopriv_send_contact_form', 'send_form');

function send_form() {

  $to = get_bloginfo('admin_email');
  $subject = get_field( 'subject_for_default_contact_form', 'options' ); 
   
  $name = $_POST['name'];
  $email = $_POST['contact'];
  $comment = $_POST['message'];
  
  $message = '<strong>Naam: </strong>' . $name . '<br>' . '<strong>E-mail: </strong>' . $email . '<br>' . '<strong>Bericht: </strong>' . $comment;
  
  $headers = array('Content-Type: text/html; charset=UTF-8',);

  wp_mail($to, $subject, $message, $headers);
}

add_action('wp_ajax_send_quote_form', 'send_quote_form');
add_action('wp_ajax_nopriv_send_quote_form', 'send_quote_form');

function calc_price($height, $width) {
	$basePrice = 100;
	$size = intval( $height ) * intval( $width );
	$price = $basePrice + ($size * 0.1);

	return $price;
}

function handle_dropzone_upload() {
    // Путь к директории, в которую будут загружены файлы
    // $upload_dir = wp_upload_dir();
    // $upload_path = $upload_dir['path'];

    // // Проверяем, есть ли директория для загрузки файлов
    // if (!file_exists($upload_path)) {
    //     wp_mkdir_p($upload_path);
    // }

    // // Обработка каждого файла
    // foreach ($_FILES['file']['name'] as $key => $name) {
    //     // Генерируем уникальное имя для файла
    //     $unique_name = wp_unique_filename($upload_path, $name);

    //     // Полный путь к файлу
    //     $file_path = trailingslashit($upload_path) . $unique_name;

    //     // Перемещаем файл из временной директории в нужное место
    //     if (move_uploaded_file($_FILES['file']['tmp_name'][$key], $file_path)) {
    //         // Файл успешно загружен, можно выполнить дополнительные действия
    //     }
    // }

    // Возвращаем ответ в формате JSON
    $response = array(
        'success' => true, // Успешная загрузка
        'message' => 'Файлы успешно загружены.',
    );

    wp_send_json($response); // Отправляем ответ в формате JSON
}

add_action('wp_ajax_handle_dropzone_upload', 'handle_dropzone_upload');
add_action('wp_ajax_nopriv_handle_dropzone_upload', 'handle_dropzone_upload');

function send_quote_form() {
	$to = get_bloginfo('admin_email');
	$subject = '';
	 
	$quote_type = $_POST['quote-type'];
	$company = $_POST['company'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$country = $_POST['country'];
	$reference = $_POST['reference'];
	$description = $_POST['description'];
	$mounting = $_POST['mounting'];
	$type = $_POST['type'];
	$quantity = $_POST['quantity'];
	$deadline = $_POST['deadline'];
	$size = $_POST['size'];
	$price = calc_price($size, $size);
	$uploadedFiles = $_FILES['uploaded_files'];

	if($company != '') {
		$company = $company;
		$subject = $company; 
	}  else {
		$company = '';
		$subject = $name;
	}

	$attachments = array();

	foreach ( $uploadedFiles['name'] as $key => $value ) {

		if( empty( $uploadedFiles['name'][ $key ] ) ){
			continue;
		}
	
		$file = array(
			'name'     => $uploadedFiles['name'][ $key ],
			'type'     => $uploadedFiles['type'][ $key ],
			'tmp_name' => $uploadedFiles['tmp_name'][ $key ],
			'error'    => $uploadedFiles['error'][ $key ],
			'size'     => $uploadedFiles['size'][ $key ],
		);
	
		$movefile = wp_handle_upload( $file, [ 'test_form' => false ] );
	
		if( $movefile && empty( $movefile['error'] ) ){
			$attachments[] = $movefile['file'];
		}
		else {
			echo $movefile['error'];
		}
	}
	
	$message =
	'<strong>Quote type: </strong>' . $quote_type . '<br>' .
	'<strong>Company name: </strong>' . $company . '<br>' .
	'<strong>Name: </strong>' . $name . '<br>' . 
	'<strong>E-mail: </strong>' . $email . '<br>' . 
	'<strong>Phone: </strong>' . $phone . '<br>' .
	'<strong>Country: </strong>' . $country . '<br>' .
	'<strong>Reference: </strong>' . $reference . '<br>' .
	'<strong>Message: </strong>' . $description . '<br>' .
	'<strong>Size: </strong>' . $size . 'cm x ' . $size . 'cm' . '<br>' .
	'<strong>Estimated price: </strong>' . calc_price( intval($size), intval($size) ) * intval($quantity) . '€' . '<br>' .
	'<strong>Mounting: </strong>' . $mounting . '<br>' .
	'<strong>Indoor/Outdoor: </strong>' . $type . '<br>' .
	'<strong>Quantity: </strong>' . $quantity . '<br>' .
	'<strong>Deadline: </strong>' . $deadline . '<br><br><br>';
	
	$headers = array(
			'Content-Type: text/html; charset=UTF-8',
	);

	$is_email_sent = wp_mail($to, $subject, $message, $headers, $attachments);

	if($is_email_sent) {		
		$new_post = array(
			'post_title'   => 'Customer email: ' . $email,
			'post_status'  => 'private', // или 'draft', 'pending', 'future' для разных статусов
			'post_type'    => 'requests' // Тип записи (post, page, custom post type и т.д.)
		);
		
		$new_post_id = wp_insert_post( $new_post );
		
		if ( $new_post_id ) {
			update_field('field_64ca11cab8787', $quote_type, $new_post_id);
			update_field('field_64ca11e7b8788', $name, $new_post_id);
			update_field('field_64ca11f1b8789', $email, $new_post_id);
			update_field('field_64ca1201b878a', $phone, $new_post_id);
			update_field('field_64ca120cb878b', $country, $new_post_id);
			update_field('field_64ca1213b878c', $reference, $new_post_id);
			update_field('field_64ca1253b878d', $description, $new_post_id);
			update_field('field_64ca126db878f', $mounting, $new_post_id);
			update_field('field_64ca1275b8790', $type, $new_post_id);
			update_field('field_64ca128ab8791', $quantity, $new_post_id);
			update_field('field_64ca128fb8792', $deadline, $new_post_id);
			update_field('field_64ca1ee1854e2', $size . 'x' . $size, $new_post_id);
			update_field('field_64ca1263b878e', $price, $new_post_id);
		}
	}
}

function ne_excerpt( $args = '' ){
	global $post;

	if( is_string( $args ) ){
		parse_str( $args, $args );
	}

	$rg = (object) array_merge( [
		'maxchar'           => 350,
		'text'              => '',
		'autop'             => true,
		'more_text'         => 'Читать дальше...',
		'ignore_more'       => false,
		'save_tags'         => '<strong><b><a><em><i><var><code><span>',
		'sanitize_callback' => static function( string $text, object $rg ){
			return strip_tags( $text, $rg->save_tags );
		},
	], $args );

	$rg = apply_filters( 'ne_excerpt_args', $rg );

	if( ! $rg->text ){
		$rg->text = $post->post_excerpt ?: $post->post_content;
	}

	$text = $rg->text;
	// strip content shortcodes: [foo]some data[/foo]. Consider markdown
	$text = preg_replace( '~\[([a-z0-9_-]+)[^\]]*\](?!\().*?\[/\1\]~is', '', $text );
	// strip others shortcodes: [singlepic id=3]. Consider markdown
	$text = preg_replace( '~\[/?[^\]]*\](?!\()~', '', $text );
	// strip direct URLs
	$text = preg_replace( '~(?<=\s)https?://.+\s~', '', $text );
	$text = trim( $text );

	// <!--more-->
	if( ! $rg->ignore_more && strpos( $text, '<!--more-->' ) ){

		preg_match( '/(.*)<!--more-->/s', $text, $mm );

		$text = trim( $mm[1] );

		$text_append = sprintf( ' <a href="%s#more-%d">%s</a>', get_permalink( $post ), $post->ID, $rg->more_text );
	}
	// text, excerpt, content
	else {

		$text = call_user_func( $rg->sanitize_callback, $text, $rg );
		$has_tags = false !== strpos( $text, '<' );

		// collect html tags
		if( $has_tags ){
			$tags_collection = [];
			$nn = 0;

			$text = preg_replace_callback( '/<[^>]+>/', static function( $match ) use ( & $tags_collection, & $nn ){
				$nn++;
				$holder = "~$nn";
				$tags_collection[ $holder ] = $match[0];

				return $holder;
			}, $text );
		}

		// cut text
		$cuted_text = mb_substr( $text, 0, $rg->maxchar );
		if( $text !== $cuted_text ){

			// del last word, it not complate in 99%
			$text = preg_replace( '/(.*)\s\S*$/s', '\\1...', trim( $cuted_text ) );
		}

		// bring html tags back
		if( $has_tags ){
			$text = strtr( $text, $tags_collection );
			$text = force_balance_tags( $text );
		}
	}

	// add <p> tags. Simple analog of wpautop()
	if( $rg->autop ){

		$text = preg_replace(
			[ "/\r/", "/\n{2,}/", "/\n/" ],
			[ '', '</p><p>', '<br />' ],
			"<p>$text</p>"
		);
	}

	$text = apply_filters( 'ne_excerpt', $text, $rg );

	if( isset( $text_append ) ){
		$text .= $text_append;
	}

	return $text;
}

function custom_wp_list_categories($output, $args) {
    $pattern = '/<a(.*?)>(.*?)<\/a>/i';
    $replacement = '<a$1 data-category-id="$2">$2</a>';
    $output = preg_replace_callback($pattern, 'custom_wp_list_categories_callback', $output);
    return $output;
}

function custom_wp_list_categories_callback($matches) {
    $name = $matches[2];
    $category = get_category_by_slug($name);

    return "<span class='category-name'>$name</span>";
}
add_filter('wp_list_categories', 'custom_wp_list_categories', 10, 2);

add_action('wp_ajax_get_posts_by_category', 'get_posts_by_category');
add_action('wp_ajax_nopriv_get_posts_by_category', 'get_posts_by_category');
function get_posts_by_category() {
    $categoryId = $_POST['category_id'];

	$args = array(
		'posts_per_page' => -1,
		'post_type' => 'relevant-templates', // Тип поста, который вам нужен
		'tax_query' => array(
			array(
				'taxonomy' => 'relevant_templates_categories',
				'field' => 'term_id',
				'terms' => $categoryId,
			)
		)
	);

	$posts = get_posts($args);

	if(!empty($posts))  {
		foreach ($posts as $post) {
			$post_thumb_url = get_the_post_thumbnail_url( $post->ID );
			$post_title = get_the_title( $post->ID );
			$post_permalink = get_the_permalink( $post->ID );
			$html = <<<HTML
			<li class="templates-list__item">
				<div class="relevant-template">
					<div class="relevant-template-thumb">
						<div class="gradient-border">
							<img src="{$post_thumb_url}" alt="">
						</div>
					</div>
					<div class="relevant-template-content">
						<h3>$post_title</h3>
						<a class="button button_text-uppercase button_round button_gradient-bg" href="{$post_permalink}">Customize</a>
					</div>
				</div>
			</li>
HTML;
	
			echo $html;
	
		}
	
		wp_reset_postdata();
	
		wp_die();
	} else {
		$html = <<<HTML
		<section class="no-results not-found" style="width: 100%;">
			<div class="neon-container">
				<h1 class="neon-text">Nothing Found</h1>
			</div>
		</section>
HTML;

		echo $html;

		wp_die();
	}
}
function ne_add_json_field_meta_box() {
    add_meta_box(
        'ne_json_field', // Идентификатор метабокса
        'JSON Field',   // Заголовок метабокса
        'ne_render_json_field', // Функция для вывода содержимого метабокса
        'relevant-templates',   // Тип записи, к которому применяется метабокс
        'normal',   // Местоположение метабокса (нормально)
        'high'      // Приоритет метабокса (высокий)
    );
}
add_action('add_meta_boxes', 'ne_add_json_field_meta_box');

function ne_render_json_field($post) {
    $json_data = get_post_meta($post->ID, 'ne_json_field', true);
    ?>
    <textarea name="ne_json_field" rows="5" style="width: 100%;"><?php echo esc_textarea($json_data); ?></textarea>
    <?php
}

function ne_save_json_field($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (isset($_POST['ne_json_field'])) {
        update_post_meta($post_id, 'ne_json_field', sanitize_text_field($_POST['ne_json_field']));
    }
}
add_action('save_post', 'ne_save_json_field');

// if (class_exists('WooCommerce')) {
    
//     // Создание массива данных для нового товара
//     $new_product_data = array(
//         'post_title' => 'Новый товар',  // Название товара
//         'post_content' => 'Описание товара',  // Описание товара
//         'post_status' => 'publish',  // Статус публикации
//         'post_type' => 'product',  // Тип записи - товар
//     );

//     // Создание нового товара
//     $new_product_id = wp_insert_post($new_product_data);

//     // Установка цены
//     update_post_meta($new_product_id, '_price', 10.99);

//     // Установка категории (если требуется)
//     wp_set_object_terms($new_product_id, 'Категория', 'product_cat');

//     // Установка изображения
//     //$image_url = 'URL_изображения';  // Замените на URL вашего изображения
//     // $image_id = wc_import_product_image($image_url, $new_product_id);

//     // Установка изображения как Featured Image
//     //set_post_thumbnail($new_product_id, $image_id);

//     // Добавление товара в метку "Хит продаж" (по желанию)
//     update_post_meta($new_product_id, '_featured', 'yes');
// }

// $args = array(
// 	'numberposts' => -1,
// 	'post_status' => 'publish',
// 	'orderby'     => 'date',
// 	'order'       => 'DESC',
// 	'post_type'   => 'symbols',
// );
// var_dump(get_posts($args));
function custom_country_list($countries) {
    // Оставляем только страну "Нидерланды" в списке
    $filtered_countries = array(
        'NL' => $countries['NL']
    );

    return $filtered_countries;
}
add_filter('woocommerce_countries', 'custom_country_list');