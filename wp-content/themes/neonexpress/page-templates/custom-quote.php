<?php
/**
 * Template Name: Get Custom Quote
 *
 * @package Neon_Express
 */

get_header(); ?>

<main class="ne-main custom-quote">
	<section class="get-a-quote">
		<div id="quote-form" class="container">

			<?php get_template_part( 'template-parts/custom-quote-parts/custom-quote-step-one', '' ); ?>

			<?php get_template_part( 'template-parts/custom-quote-parts/custom-quote-step-two', '' ); ?>

			<?php get_template_part( 'template-parts/custom-quote-parts/custom-quote-step-three', '' ); ?>

			<?php get_template_part( 'template-parts/custom-quote-parts/custom-quote-step-four', '' ); ?>

		</div>
	</section>
</main>

<?php

get_footer();
