<?php
/**
 * Block Name: USP
 * Description: It is sample ACF Block. Just copy and rename `sample/` into `block/`. Also dont forget to change file data.
 * Category: common
 * Icon: list-view
 * Keywords: sample acf block example
 * Supports: { "align":false, "anchor":true }
 *
 * @package Neon_Express
 *
 * @var array $block
 */

// DEFAULT BLOCK VARS
$slug         = str_replace( 'acf/', '', $block['name'] );
$block_id     = $slug . '-' . $block['id'];
$align_class  = $block['align'] ? 'align' . $block['align'] : '';
$custom_class = isset( $block['className'] ) ? $block['className'] : '';

// BLOCK FIELDS
$block_fields       = get_fields();
$block_showcase_pos = $block_fields['showcase_position'];
$block_title        = $block_fields['usp_title'];
$block_subtitle     = $block_fields['usp_subtitle'];
$block_cta          = $block_fields['usp_cta'];
$block_cta_custom   = $block_fields['usp_cta_second'];
$block_c_type       = $block_fields['usp_type_of_content'];
$block_showcase_type = $block_fields['showcase_type'];
if( $block_showcase_type === 'image' ) {
	$block_showcase = $block_fields['usp_showcase'];
} else if( $block_showcase_type === 'videofile' ) {
	$block_showcase = $block_fields['usp_video_file'];
} else if( $block_showcase_type === 'iframe' ) {
	$block_showcase = $block_fields['usp_youtube_iframe'];
}


if( $block_c_type === 'list' ) {
	$block_list = $block_fields['usp_list'];
}

if( $block_c_type === 'content' ) {
	$block_content = $block_fields['usp_content'];
}

?>
<section 
	id="<?php echo $block_id; ?>" 
	class="<?php echo $slug; ?><?php echo $align_class ? ' ' . $align_class : ""; ?><?php echo $custom_class ? ' ' . $custom_class : ""; ?><?php echo ' ' . $slug . '_' . $block_showcase_pos; ?>">
	<?php if( $block_fields ) : ?>
		<div class="container">
			<?php if( $block_showcase_type === 'image' ) : ?>
				<?php if( $block_showcase ) : ?>
					<div class="<?php echo $slug . '-showcase'; ?>">
						<div class="gradient-border">
						<img 
								src="<?php _e( esc_url($block_showcase['url']), 'ne' );  ?>"
								alt="<?php _e( $block_showcase['alt'], 'ne' ); ?>" />
						</div>
					</div>
				<?php endif; ?>
			<?php endif; ?>

			<?php if( $block_showcase_type === 'videofile' ) : ?>
				<?php if( $block_showcase ) : ?>
					<div class="<?php echo $slug . '-showcase'; ?>">
						<div class="gradient-border">
							<video class="<?php echo $slug . '-video'; ?>" autoplay muted loop poster="">
								<source src="<?php echo esc_url( $block_showcase['url'] ); ?>" type="video/mp4">
							</video>
						</div>
					</div>
				<?php endif; ?>
			<?php endif; ?>

			<?php if( $block_showcase_type === 'iframe' ) : ?>
				<?php if( $block_showcase ) : ?>
					<div class="<?php echo $slug . '-showcase'; ?>">
						<div class="gradient-border">
							<div class="iframe-container">
								<?php echo $block_showcase; ?>
							</div>
						</div>
					</div>
				<?php endif; ?>
			<?php endif; ?>

			<?php if( $block_title || $block_subtitle || $block_cta ) : ?>
				<div class="<?php echo $slug . '-content'; ?>">

					<?php if( $block_title ) : ?>
						<h2><?php _e( $block_title, 'ne' ); ?></h2>
					<?php endif; ?>

					<?php if( $block_subtitle ) : ?>
						<span><?php _e( $block_subtitle, 'ne' ); ?></span>
					<?php endif; ?>

					<?php if( $block_c_type === 'list' ) : ?>

						<?php if( $block_list ) : ?>
							<ul>
								<?php 
								foreach( $block_list as $item ) :
									if( !empty($item['usp_icon']) ) :
										$icon_url = $item['usp_icon']['url'];
									endif;
									if( !empty($item['usp_content']) ) :
										$content = $item['usp_content'];
									endif;
								?>
									<li>

										<?php if( $icon_url ) : ?> 
											<span 
												class="usp-icon" 
												style="background-image:url(<?php _e( esc_url( $icon_url ) ); ?>)"></span>
										<?php endif; ?>

										<?php if( $content ) : ?>
											<p><?php _e( $content, 'ne' ); ?></p>
										<?php endif; ?>
										
									</li>
								<?php
								endforeach;
								?>
							</ul>
						<?php endif; ?>

					<?php endif; ?>

					<?php if( $block_c_type === 'content' ) : ?>
						<div class="<?php echo $slug . '-text'; ?>">
							<?php echo $block_content; ?>
						</div>
					<?php endif; ?>

					<?php if( $block_cta ) : ?>
						<div class="button-container">
							<a 
								href="<?php _e( esc_url( $block_cta['url']), 'ne' ); ?>"
								title="<?php esc_attr_e( $block_cta['title'], 'ne' ); ?>"
								target="<?php echo $block_cta['target'] ? esc_attr( $block_cta['target'], 'ne' ) : '_self'; ?>"
								class="button button_text-uppercase button_round button_gradient-bg">
								<?php _e( $block_cta['title'], 'ne' ); ?>
							</a>
							<?php if( $block_cta_custom ) : ?>
									<span><?php _e( '&nbsp;or&nbsp;', 'ne' ); ?></span>
									<div class="gradient-border gradient-border_round gradient-border_button">
										<a 
											href="<?php _e( esc_url( $block_cta_custom['url']), 'ne' ); ?>"
											title="<?php esc_attr_e( $block_cta_custom['title'], 'ne' ); ?>"
											target="<?php echo $block_cta_custom['target'] ? esc_attr( $block_cta_custom['target'], 'ne' ) : '_self'; ?>"
											class="button button_text-uppercase button_round button_black">
											<?php _e( $block_cta_custom['title'], 'ne' ); ?>
										</a>
									</div>
								<?php endif; ?>
						</div>
					<?php endif; ?>

				</div>
			<?php endif; ?>
			
		</div>
	<?php endif; ?>

</section>
