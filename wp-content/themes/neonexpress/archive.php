<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Neon_Express
 */

$page_id = get_option('page_for_posts');
$posts_categories = get_fields($page_id)['top_categories'];
$top_categories = array();
foreach( $posts_categories as $category ) : 
	$cat_id = $category;
	$cat_name = get_cat_name($category);
	$top_categories[] = array(
		'cat_name' => $cat_name,
		'cat_id' => $cat_id,
	);
endforeach;
get_header();
?>

<main class="ne-main archive-page">
	<section class="archive-hero"></section>
	<section class="archive-section">
		<div class="container">
			<nav class="archive-navigation">
				<ul>
					<?php
						$count = count( $top_categories );
						for( $i = 0; $i < $count; ++$i ) :
							$cat_id = $top_categories[$i]['cat_id'];
							$cat_name = $top_categories[$i]['cat_name'];
							$cat_url = get_category_link( $cat_id );
							$current_cat = is_category( $cat_name ) ? 'class="current-category"' : '';

							switch( $i ) :
								case $i: 
					?>
					<li <?php echo $current_cat; ?>>
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
	<section class="archive-listing">
		<div class="container">

		<?php
				if ( function_exists('yoast_breadcrumb') ) :
					yoast_breadcrumb( '<div id="ne-breadcrumbs" class="ne-breadcrumbs">','</div>' );
				endif;
			?>

				<?php 
				if ( have_posts() ) : 
				?>

					<ul>

						<?php
						while ( have_posts() ) : the_post(); ?>

							<li>
								<?php get_template_part( 'template-parts/article-card' ); ?>
							</li>
						<?php
						endwhile;
						?>

					</ul>

				<?php 
				else : 

					get_template_part( 'template-parts/content', 'none' );
				
				endif; 
				?>
			</ul>
		</div>
	</section>
</main>
<?php
get_footer();
