<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Neon_Express
 */

$sticky = get_option( 'sticky_posts' );
$page_id = get_option('page_for_posts');
$page_fields = get_fields( $page_id );
$page_hero_url = get_the_post_thumbnail_url( $page_id );
$page_subtitle = $page_fields['blog_subtitle'];
$posts_categories = $page_fields['top_categories'];
$top_categories = array();
foreach( $posts_categories as $category ) : 
	$cat_id = $category;
	$cat_name = get_cat_name($category);
	$cat_posts = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'cat' => $cat_id,
		'posts_per_page' => 3,
	);
	$cat_posts = get_posts( $cat_posts );
	$top_categories[] = array(
		'cat_name' => $cat_name,
		'cat_id' => $cat_id,
		'cat_posts' => $cat_posts,
	);
endforeach;
get_header();
?>
<main class="ne-main blog-page">
	<section class="blog-hero" style="background-image: url(<?php echo !empty( $page_hero_url ) ? esc_url( $page_hero_url ) : ''; ?>)">
		<div class="container">
			<h1><?php _e( get_the_title( $page_id, true ), 'ne' ) ?></h1>

			<?php if( !empty( $page_subtitle ) ) : ?>
				<h2><?php _e( $page_subtitle, 'ne' ); ?></h2>
			<?php endif; ?>
		</div>
	</section>
	<section class="blog-section">
		<div class="container">
			<nav class="blog-navigation">
				<ul>
					<?php
						$count = count( $top_categories );
						for( $i = 0; $i < $count; ++$i ) :
							$cat_id = $top_categories[$i]['cat_id'];
							$cat_name = $top_categories[$i]['cat_name'];
							$cat_posts = $top_categories[$i]['cat_posts'];
							$cat_url = get_category_link( $cat_id );

							switch( $i ) :
								case $i: 
					?>
					<li>
						<a 
							class="category-link"
							href="<?php echo esc_url( $cat_url ); ?>" 
							title="<?php _e( $cat_name, 'ne' ); ?>"
							target="_self"><?php _e( $cat_name ); ?></a>
					</li>
					<?php
							endswitch;
						endfor;
					?>
				</ul>
			</nav>
		</div>
	</section>

	<?php get_template_part( 'template-parts/sticky-posts' ); ?>

	<section class="blog-section">
		<div class="container">

			<?php if( $posts_categories ) : ?>

				<div class="top-categories">

					<?php
						$count = count( $top_categories );
						for( $i = 0; $i < $count; ++$i ) :
							$cat_id = $top_categories[$i]['cat_id'];
							$cat_name = $top_categories[$i]['cat_name'];
							$cat_posts = $top_categories[$i]['cat_posts'];
							$cat_url = get_category_link( $cat_id );
							if( $cat_posts ) :
								switch( $i ) :
									case $i: 
									?>
									<div class="top-category">
										<h2><?php _e( $cat_name, 'ne' ); ?></h2>
										<ul>
									<?php
										foreach( $cat_posts as $cat_post ) :
											setup_postdata( $cat_post );
											$post_thumb_url = get_the_post_thumbnail_url();
											$post_title = get_the_title();
											$post_permalink = get_the_permalink();
											$post_excerpt = get_the_excerpt(); ?>
											<li>
												<article>
													<a class="gradient-border" href=<?php echo esc_url( $post_permalink ); ?>>
														<img 
															src="<?php echo esc_url( $post_thumb_url ); ?>"
															alt="<?php _e( $post_title ); ?>" />
													</a>
													<h3>
														<a href=<?php echo esc_url( $post_permalink ); ?>><?php _e( $post_title ); ?></a>
													</h3>
													<p><?php echo $post_excerpt; ?></p>
													<a href=<?php echo esc_url( $post_permalink ); ?>><?php _e( 'Read more...', 'ne' ); ?></a>
												</article>
											</li>
										
									<?php
										endforeach;
									?>
									</ul>
									<?php wp_reset_postdata(); ?>
									<div class="button-container">
										<a 
											class="button button_create button_text-uppercase button_round button_gradient-bg" 
											href="<?php echo esc_url( $cat_url ); ?>">
											<?php _e( 'Read more ' . $cat_name  ); ?>
										</a>
									</div>
									</div>
									<?php
										break;
								endswitch;
							endif;
						endfor;
					?>

				</div>

			<?php endif; ?>

		</div>
	</section>	
</main>
<?php
get_footer();
