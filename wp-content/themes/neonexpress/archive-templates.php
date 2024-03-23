<?php
/**
 * The template for displaying template  archive page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Neon_Express
 */

$top_parent_category_first = get_field( 'top_category_first', 'options' );

$top_parent_category_second = get_field( 'top_category_first', 'options' );

$categories_top_first = get_categories([
    'taxonomy'     => 'category',
	'type'         => 'templates',
    // 'child_of'     => $top_parent_category_first,
    'parent'       => $top_parent_category_first,
	'orderby'      => 'name',
	'order'        => 'ASC',
	'hide_empty'   => false,
	'hierarchical' => 1,
]);

$categories_top_second = get_categories([
    'taxonomy'     => 'category',
	'type'         => 'templates',
	'child_of'     => $top_parent_category_second,
	'orderby'      => 'name',
	'order'        => 'ASC',
	'hide_empty'   => 1,
	'hierarchical' => 1,
	'exclude'      => '',
	'include'      => '',
	'number'       => 0,
	'pad_counts'   => false,
]);

function display_categories($categories, $parent = 0) {
    // Проверяем, есть ли дочерние категории для указанного родителя
    $children = get_categories(array('parent' => $parent ));
  
    // Если есть дочерние категории, выводим список
    if ($children) {
        // Выводим открывающий тег <ul>
        echo '<ul>';

        // Проходимся по каждой дочерней категории
        foreach ($children as $category) {
            // Выводим название категории с ссылкой внутри <li>
            echo '<li><a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a>';

            // Рекурсивно вызываем функцию для вывода вложенных категорий
            display_categories($categories, $category->term_id);

            echo '</li>';
        }

        // Выводим закрывающий тег </ul>
        echo '</ul>';
    }
}

get_header();
?>

<main class="ne-main archive-page">
	<section class="archive-hero"></section>
	<section class="archive-listing">
		<div class="container">

                <div class="archive-listing-categories">
                    <?php display_categories( $categories_top_first, $top_parent_category_first ); ?>
                </div>
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
