<?php
/**
 * Template Name: Idea Gallery
 *
 * @package Neon_Express
 */

$top_parent_category_first = get_field( 'top_category_first', 'options' );

$top_parent_category_second = get_field( 'top_category_second', 'options' );

$top_cat_first = [
	'taxonomy' => 'relevant_templates_categories',
	'child_of' => $top_parent_category_first, 
    'hide_empty' => false,
	'title_li' => '',
	'show_option_none' => '',
];

$top_cat_second = [
	'taxonomy' => 'relevant_templates_categories',
	'child_of' => $top_parent_category_second, 
    'hide_empty' => false, 
	'title_li' => '',
	'show_option_none' => '',
];

$default_posts = get_posts([
	'numberposts' => -1,
	'orderby'     => 'date',
	'order'       => 'DESC',
	'post_type'   => 'relevant-templates',
	'suppress_filters' => true,
]);	

$post_hero_url = get_the_post_thumbnail_url();

get_header(); ?>

<main class="ne-main idea-gallery">
	<section class="blog-hero" style="background-image: url(<?php echo !empty( $post_hero_url ) ? esc_url( $post_hero_url ) : ''; ?>)">
		<h1><?php the_title(); ?></h1>
	</section>
    <div class="container">
		<div class="row">
			<div class="idea-gallery-overlay">
				<div class="idea-gallery-top-categories">
					<span class="category-name top-category top-category_first active" data-category-id=<?php echo $top_parent_category_first; ?>><?php echo get_term( $top_parent_category_first )->name; ?></span>
					<span class="category-name top-category top-category_second" data-category-id=<?php echo $top_parent_category_second; ?>><?php echo get_term( $top_parent_category_second )->name; ?></span>
				</div>
				<button class="navigation-trigger filter-trigger">
					<span></span>
				</button>
				<div class="category-filter-box">
					<ul class="category-filter category-filter_top-first">
						<?php wp_list_categories( $top_cat_first ); ?>
					</ul>
					<ul class="category-filter category-filter_top-second" style="display: none;">
						<?php wp_list_categories( $top_cat_second ); ?>
					</ul>
				</div>
			</div>
			<div class="idea-gallery-categories">
				<button class="navigation-trigger filter-trigger">
					<span></span>
				</button>
				<div class="idea-gallery-top-categories">
					<span class="category-name top-category top-category_first active" data-category-id=<?php echo $top_parent_category_first; ?>><?php echo get_term( $top_parent_category_first )->name; ?></span>
					<span class="category-name top-category top-category_second" data-category-id=<?php echo $top_parent_category_second; ?>><?php echo get_term( $top_parent_category_second )->name; ?></span>
				</div>
				<div class="category-filter-box">
					<ul class="category-filter category-filter_top-first">
						<?php wp_list_categories( $top_cat_first ); ?>
					</ul>
					<ul class="category-filter category-filter_top-second" style="display: none;">
						<?php wp_list_categories( $top_cat_second ); ?>
					</ul>
				</div>
			</div>
			<div class="idea-gallery-listing">
				<h2 class="idea-gallery-listing-caption"><?php echo get_term( $top_parent_category_first )->name; ?></h2>
				<ul class="templates-list">
					<?php
					foreach( $default_posts as $post ) : 
						setup_postdata( $post );
					?>
					<li class="templates-list__item">
						<?php get_template_part( 'template-parts/template-card' ); ?>
					</li>
					<?php 
					endforeach;
					wp_reset_postdata();
					?>
				</ul>
			</div>
		</div>
    </div>
</main>

<?php

get_footer();
