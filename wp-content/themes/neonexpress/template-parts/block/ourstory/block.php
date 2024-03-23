<?php
/**
 * Block Name: Case
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
$block_fields    = get_fields();
$block_type      = $block_fields['block_type'];
$block_content   = $block_fields['os_content'];
$block_cta       = $block_fields['os_cta'];
$block_cta_classes = ' button button_text-uppercase button_round button_gradient-bg';
$block_cta_custom = $block_fields['os_cta_second'];


if( $block_type === 'default' ) {
	$block_cta_style = $block_fields['os_cta_style'];
	$block_bg        = $block_fields['os_background_color'];
	$block_inc_logo  = $block_fields['os_logotype_on_background'];
	$block_showcase_type = $block_fields['os_showcase_type'];

	if( $block_showcase_type === 'image' ) {
		$block_showcase = $block_fields['os_showcase'];
	} else if( $block_showcase_type === 'videofile' ) {
		$block_showcase = $block_fields['os_video_file'];
	} else if( $block_showcase_type === 'iframe' ) {
		$block_showcase = $block_fields['os_youtube_iframe'];
	}
} else {
	$bg_image = $block_fields['bg_image'];
	
	if( $block_type === 'left' ) {
		$bg_filter_class = $slug . '_dark ' . $slug . '_left';
	} else if( $block_type === 'right' ) {
		$bg_filter_class = $slug . '_dark ' . $slug . '_right';
	}
}

if( isset($block_bg) ) {
	if( $block_bg === '#1b0f2a') {
		$block_bg = 'secondary';
	} else if( $block_bg === '#120c19' ) {
		$block_bg = 'tertiary';
	}
}

if( isset($block_cta_style) ) {
	if( $block_cta_style === 'default' ) {
		$block_cta_classes = ' button button_text-uppercase button_round button_gradient-bg';
	} else if( $block_cta_style === 'transparent' ) {
		$block_cta_classes = ' button_without-bg button_gradient-text button_text-capitalize button_arrow-right';
	}
}
?>
<section 
	id="<?php echo $block_id; ?>" 
	class="<?php echo $slug; ?><?php echo isset( $block_bg ) ? ' ' . $slug . '_' . $block_bg : ""; ?><?php echo $align_class ? ' ' . $align_class : ""; ?><?php echo $custom_class ? ' ' . $custom_class : ""; ?><?php echo isset( $bg_filter_class ) ? ' ' . $bg_filter_class : "" ?>"
	<?php echo isset( $bg_image ) && !empty( $bg_image ) ? 'style="background-image: url(' . $bg_image['url'] . ');"' : "" ?>>
	<div class="container">

		<?php if( $block_content || $block_cta ) : ?>
			<div class="<?php echo $slug . '-text-content'; ?>">

				<?php 
				if( $block_content ) :
					echo $block_content;
				endif;
				?>

				<?php if( $block_cta ) : ?>
					<div class="button-container">
					<a 
						href="<?php echo esc_url( $block_cta['url'] ); ?>"
						title="<?php esc_attr_e( $block_cta['title'], 'ne' ); ?>"
						target="<?php echo $block_cta['target'] ? esc_attr( $block_cta['target'], 'ne' ) : '_self'; ?>"
						class="button<?php echo $block_cta_classes; ?>">
						<?php _e( $block_cta['title'], 'ne' ); ?></a>
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

		<?php if( isset( $block_showcase_type ) ) : ?>
			<?php if( $block_showcase_type === 'image' ) : ?>
				<?php if( isset( $block_showcase ) && !empty( $block_showcase )  ) : ?>
					<div class="<?php echo $slug . '-showcase'; ?><?php echo $block_inc_logo != null ? ' ' . $slug . '-showcase_logo' : ""; ?>">
						<img 
							src="<?php echo esc_url( $block_showcase['url'] ); ?>" 
							alt="<?php esc_attr_e( $block_showcase['alt'], 'ne' ); ?>" />
					</div>
				<?php endif; ?>
			<?php endif; ?>
		<?php endif; ?>

		<?php if( isset( $block_showcase_type ) ) : ?>
			<?php if( $block_showcase_type === 'videofile' ) : ?>
				<?php if( isset($block_showcase) ) : ?>
					<div class="<?php echo $slug . '-showcase ' . $slug . '-showcase_video'; ?>">
						<div class="gradient-border">
							<video class="<?php echo $slug . '-video'; ?>" autoplay muted loop poster="">
								<source src="<?php echo esc_url( $block_showcase['url'] ); ?>" type="video/mp4">
							</video>
						</div>
					</div>
				<?php endif; ?>
			<?php endif; ?>
		<?php endif; ?>

		<?php if( isset( $block_showcase_type ) ) : ?>
			<?php if( $block_showcase_type === 'iframe' ) : ?>
				<?php if( isset($block_showcase) && !empty( $block_showcase ) ) : ?>
					<div class="<?php echo $slug . '-showcase ' . $slug . '-showcase_iframe'; ?>">
						<div class="gradient-border">
							<div class="iframe-container">
								<?php echo $block_showcase; ?>
							</div>
						</div>
					</div>
				<?php endif; ?>
			<?php endif; ?>
		<?php endif; ?>

	</div>
</section>
