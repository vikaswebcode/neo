<?php
$post_id = get_the_ID();
$post_thumb_url = get_the_post_thumbnail_url();
$post_title = get_the_title();
$post_permalink = get_the_permalink();
$post_categories = get_the_terms( $post_id, 'relevant_templates_categories' );
?>
<div class="relevant-template">
	<div class="relevant-template-thumb">
		<div class="gradient-border">
			<img src="<?php _e( esc_url( $post_thumb_url ), 'ne' ); ?>" alt="">
		</div>
	</div>
	<div class="relevant-template-content">
		<h3><?php echo $post_title; ?></h3>
		<a class="button button_text-uppercase button_round button_gradient-bg" href="<?php _e( esc_url( get_home_url() . '/configurator/?id=' . $post_id . '' ), 'ne' ); ?>">
			<?php _e( 'Customize', 'ne' ); ?>
		</a>
	</div>
</div>
<?php