<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Neon_Express
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found">
			<div class="neon-container">
				<h1 class="neon-text"><?php esc_html_e( 'That page can&rsquo;t be found.', 'ne' ); ?></h1>

				<div class="neon-buttons">
					<a 
						class="neon-text" 
						target="_self" 
						title="Previous page"
						href="javascript:history.go(-1)"><?php _e( 'Back', 'ne' ); ?></a>
					<a 
						class="neon-text" 
						target="_self" 
						title="Home page"
						href="<?php echo get_home_url(); ?>"><?php _e( 'Home', 'ne' ); ?></a>
				</div>
			</div><!-- .page-header -->
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
