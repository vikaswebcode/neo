<?php
/**
 * Front page template file
 * 
 * This is the file for displaying home page if you choose "static page" option
 * in site settings
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Neon_Express
 */

get_header();
?>
<main class="ne-main">
    <?php the_content(); ?>
</main>
<?php
get_footer();