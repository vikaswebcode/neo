<?php
/**
 * Block Name: Inspiration
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
$block_fields = get_fields();
$block_title = $block_fields['ins_title'];
$block_slider = $block_fields['ins_showcases'];
$block_cta = $block_fields['ins_cta'];
$block_cta_custom = $block_fields['ins_cta'];
?>
<section 
	id="<?php echo $block_id; ?>" 
	class="<?php echo $slug; ?><?php echo $align_class ? ' ' . $align_class : ""; ?><?php echo $custom_class ? ' ' . $custom_class : ""; ?>">
	<div class="container container_fullwidth">

		<?php if( $block_title ) : ?>
			<h2><?php echo $block_title; ?></h2>
		<?php endif; ?>

		<?php get_template_part( 'template-parts/social-media' ); ?>

		<?php if( $block_slider ) : ?>
			<div class="<?php echo $slug . '-slider'; ?> swiper">
				<div class="swiper-wrapper">
					
					<?php
					foreach( $block_slider as $slide ) :
						$slide_type = $slide['slide']['slide_type'];
						$main_img = $slide['slide']['main_slide_image'];
						$main_url = $slide['slide']['main_slide_link'];

						if( $slide_type === '2' ) {
							$secondary_img = $slide['slide']['secondary_slide_image'];
							$secondary_url = $slide['slide']['secondary_slide_link'];
						}
					?>
						<div class="<?php echo $slug . '-slider-slide'; echo $slide_type === '2' ? ' ' . $slug . '-slider-slide_double' : ''; ?> swiper-slide">

							<?php if( $main_img && empty( $main_url ) ) : ?>
								<img 
									src="<?php echo esc_url( $main_img['url'] ); ?>" 
									alt="<?php echo esc_attr( $main_img['alt'] ); ?>" />
							<?php elseif( $main_img && !empty( $main_url ) ) : ?>
								<a href="<?php echo esc_url( $main_url ); ?>" target="_self">
									<img 
										src="<?php echo esc_url( $main_img['url'] ); ?>" 
										alt="<?php echo esc_attr( $main_img['alt'] ); ?>" />
								</a>
							<?php endif; ?>

							<?php 
							if( $slide_type === '2' ) :
								if( $secondary_img && empty( $secondary_url ) ) : ?>
									<img 
										src="<?php echo esc_url( $secondary_img['url'] ); ?>"
										alt="<?php echo esc_attr( $secondary_img['alt'] ); ?>" />
							<?php elseif( $secondary_img && !empty( $secondary_url ) ) : ?>
								<a href="<?php echo esc_url( $secondary_url ); ?>" target="_self">
									<img 
										src="<?php echo esc_url( $secondary_img['url'] ); ?>" 
										alt="<?php echo esc_attr( $secondary_img['alt'] ); ?>" />
								</a>
							<?php endif;
							endif;
							?>

						</div>
						<?php endforeach; ?>
				</div>
				<div class="<?php echo $slug . '-slider-btn-prev'; ?> swiper-button-prev"></div>
  				<div class="<?php echo $slug . '-slider-btn-next'; ?> swiper-button-next"></div>
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
</section>
