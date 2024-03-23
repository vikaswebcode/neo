<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Neon_Express
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="article-content">

		<?php
			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'ne' ),
						array(
							'span' => array(
							'class' => array(),
								),
							)
					),
					wp_kses_post( get_the_title() )
				)
			);
		?>

	</div><!-- .entry-content -->

	<footer class="article-footer">
		<div class="ne-tags">
			<?php the_tags( '', '&nbsp; / &nbsp;', '' ); ?>
		</div>

		<?php get_template_part( 'template-parts/social-media' ); ?>
	</footer>

</article><!-- #post-<?php the_ID(); ?> -->
