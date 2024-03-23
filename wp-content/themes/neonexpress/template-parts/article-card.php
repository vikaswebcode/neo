<?php
$post_thumb_url = get_the_post_thumbnail_url();
$post_title = get_the_title();
$post_permalink = get_the_permalink();
$post_excerpt = get_the_excerpt();
?>
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