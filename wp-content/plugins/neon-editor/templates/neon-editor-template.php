<?php
/*
Template Name: Neon Editor Template
*/
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <link rel="icon" type="image/svg+xml" href="<?php echo plugin_dir_url(__FILE__) . 'dist/vite.svg'; ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>NeonExpress</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo plugin_dir_url(__FILE__) . 'dist/assets/index.css'; ?>">
  <?php wp_head(); ?>
  <?php
          $userType = '';

          if( current_user_can( 'edit_pages' ) ) {
              $userType = 'admin';
          } else {
              $userType = 'subscriber';
          }

          $status = 'publish';

          $fonts_args = array(
            'numberposts' => -1,
            'post_status' => $status,
            'orderby'     => 'date',
            'order'       => 'DESC',
            'post_type'   => 'fonts',
        );
        $fonts_data = get_posts($fonts_args);

        echo '<style>';
        foreach( $fonts_data as $font_data ) {
          $name = $font_data->post_title;
          $url = get_post_meta( $font_data->ID, '_font_file_url', true );
          $id = $font_data->ID;

          
          echo '@font-face {
            font-family:' . $font_data->post_title . ';' .
            'src: url("'. $url .'"),
        }';
      }
      echo '</style>';
  ?>
</head>
<body>
  <div id="root"></div>
  <?php wp_footer(); ?>
</body>

</html>