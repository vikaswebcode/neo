<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Neon_Express
 */

/*--- SINGLE POST FUNCTIONS START ---*/
$post_fields = get_fields();
if( !empty( $post_fields ) ) :
	$post_subtitle = $post_fields['post_subtitle'];
endif;
$page_id = get_option('page_for_posts');
$top_cats_data = get_fields($page_id)['top_categories'];
$top_cats = array();
$post_cats_data = get_the_terms($post->ID, 'category');
$post_cats = array();
$post_hero_url = get_the_post_thumbnail_url();
foreach( $top_cats_data as $category ) : 
	$cat_id = $category;
	$cat_name = get_cat_name($category);
	$top_cats[] = array(
		'cat_name' => $cat_name,
		'cat_id' => $cat_id,
	);
endforeach;
for( $i = 0; $i < count( $post_cats_data ); ++$i ) :
	$current_cat = $post_cats_data[$i]->name;
	$post_cats[] = $current_cat;
endfor;

/*--- SINGLE POST FUNCTIONS END ---*/

get_header();

?>

<main class="ne-main single-page">
	<section class="article-hero" style="background-image: url(<?php echo !empty( $post_hero_url ) ? esc_url( $post_hero_url ) : ''; ?>)">
	
		<div class="container">
			<h1><?php the_title(); ?></h1>

			<?php if( !empty( $post_subtitle ) ) : ?>
				<h2><?php _e( $post_subtitle, 'ne' ); ?></h2>
			<?php endif; ?>
		</div>

	</section>

	<section class="article-section">

	<section class="article-section">
		<div class="container">
			<nav class="article-navigation">
				<ul>
					<?php
						$count = count( $top_cats );
						for( $i = 0; $i < $count; ++$i ) :
							$cat_id = $top_cats[$i]['cat_id'];
							$cat_name = $top_cats[$i]['cat_name'];
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

	<section class="article-section">

		<div class="container">

			<?php
				if ( function_exists('yoast_breadcrumb') ) :
					yoast_breadcrumb( '<div id="ne-breadcrumbs" class="ne-breadcrumbs">','</div>' );
				endif;
			?>

			<div class="row">

				<div class="column column_left">
					<?php get_template_part( 'template-parts/article' ); ?>
				</div>

				<div class="column column_right">
					<div class="relevant-templates">
						<div class="relevant-template">
							<div class="relevant-template-thumb">
								<div class="gradient-border">
									<img src="<?php echo get_template_directory_uri() . '/assets/images/showcase-1.jpg'; ?>" alt="" />
								</div>
							</div>
							<div class="relevant-template-content">
								<h3>Custom name</h3>
								<a class="button button_text-uppercase button_round button_gradient-bg" href="#">Customize</a>
							</div>
						</div>
						<div class="relevant-template">
							<div class="relevant-template-thumb">
								<div class="gradient-border">
									<img src="<?php echo get_template_directory_uri() . '/assets/images/showcase-1.jpg'; ?>" alt="" />
								</div>
							</div>
							<div class="relevant-template-content">
								<h3>Custom name</h3>
								<a class="button button_text-uppercase button_round button_gradient-bg" href="#">Customize</a>
							</div>
						</div>
						<div class="relevant-template">
							<div class="relevant-template-thumb">
								<div class="gradient-border">
									<img src="<?php echo get_template_directory_uri() . '/assets/images/showcase-1.jpg'; ?>" alt="" />
								</div>
							</div>
							<div class="relevant-template-content">
								<h3>Custom name</h3>
								<a class="button button_text-uppercase button_round button_gradient-bg" href="#">Customize</a>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>

	</section>

	<section class="article-section">
		<div class="container">
			<div class="recent-posts">
				<h2><?php _e( 'You might also like', 'ne' ); ?></h2>
				<ul>
					<?php
						$recent_posts = get_posts(array(
							'numberposts' => 3,
							'order' => 'desc',
							'orderb' => 'post_data'
						));

						foreach( $recent_posts as $recent_post ) :
							setup_postdata( $recent_post );
							$post_thumb_url = get_the_post_thumbnail_url( $recent_post->ID );
							$post_title = get_the_title( $recent_post->ID );
							$post_permalink = get_the_permalink( $recent_post->ID );
							$post_excerpt = get_the_excerpt( $recent_post->ID );
					?>
					<li>
					<article>
						<div class="gradient-border">
							<img 
								src="<?php echo esc_url( $post_thumb_url ); ?>"
								alt="<?php _e( $post_title ); ?>" />
							</div>
							<h3><?php _e( $post_title ); ?></h3>
							<p><?php echo $post_excerpt; ?></p>
							<a href=<?php echo esc_url( $post_permalink ); ?>><?php _e( 'Read more...', 'ne' ); ?></a>
					</article>
					</li>
					<?php endforeach; 
					wp_reset_postdata();?>
				</ul>
			</div>
		<div>
	</section>

</main><!-- #main -->

<?php
get_footer();
