<?php
/**
 * Block Name: Reviews
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

$slug         = str_replace( 'acf/', '', $block['name'] );
$block_id     = $slug . '-' . $block['id'];
$align_class  = $block['align'] ? 'align' . $block['align'] : '';
$custom_class = isset( $block['className'] ) ? $block['className'] : '';
$block_fields = get_fields();
$block_title = $block_fields['block_titile'];
$block_reviews = $block_fields['review'];
$block_cta = $block_fields['block_cta'];
$block_cta_custom = $block_fields['block_cta_second'];
?>
<section id="<?php echo $block_id; ?>" class="<?php echo $slug; ?> <?php echo $align_class; ?> <?php echo $custom_class; ?>">
	<div class="container">
		<div class="<?php echo $slug . '-top'; ?>">
		<?php if( $block_title ) : ?>
			<h2 class="<?php echo $slug . '__title'; ?>"><img src="<?php echo get_template_directory_uri() . '/dist/images/trust.png'?>" alt="Trustpilot" /><span><?php echo $block_title; ?></span></h2>
		<?php endif; ?>
		</div>
		<?php if( $block_reviews ) : ?>
			<div class="reviews-slider swiper">
				<div class="swiper-wrapper">
					<?php
					foreach( $block_reviews as $review ) :
						$review_id = $review;
						$review_name = get_the_title( $review_id );
						$review_thumb = get_the_post_thumbnail_url( $review_id );
						$review_rating = get_field( 'rating', $review_id );
						$review_content = get_field( 'review', $review_id );
					?>
					<div class="swiper-slide">
						<div class="gradient-border gradient-border_review">	
							<div class="review">
								<div class="review-rating">
									<?php for( $i = 1; $i <= $review_rating; $i++ ) : ?>
										<span class="review-star"></span>
									<?php endfor; ?>
								</div>
								<div class="review-content">
									<?php echo $review_content; ?>
								</div>
								<div class="review-info">
									<div class="review-thumb">
										<img src="<?php echo $review_thumb; ?>" alt="" />
									</div>
									<div class="review-meta">
										<span class="review-name"><?php echo $review_name; ?></span>
										<span class="review-date"><?php echo get_the_date( 'F j', $review_id ); ?></span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
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
