<?php
/**
 * Block Name: Trusted by
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
$block_fields          = get_fields();
$block_title_sub_title = $block_fields['tr_title_with_subtitle'];
$block_logotypes       = $block_fields['tr_logotypes'];
$block_cta;
$block_cta_custom;
?>
<section 
	id="<?php echo $block_id; ?>" 
	class="<?php echo $slug; ?><?php echo $align_class ? ' ' . $align_class : ""; ?><?php echo $custom_class ? ' ' . $custom_class : ""; ?>">

	<?php if( $block_fields ) : ?>
		<div class="container">

			<?php 
				if( $block_title_sub_title ) : 
					echo $block_title_sub_title;
				endif;
			?>

			<?php if( isset( $block_logotypes ) && !empty( $block_logotypes ) ) : ?>
				<div class="<?php echo $slug . '-companies'; ?> swiper">
					<div class="swiper-wrapper">

						<?php
							foreach( $block_logotypes as $item ) :
								if( !empty($item['tr_logo']) ) :
									$logo_url = $item['tr_logo']['url'];
									$logo_alt = $item['tr_logo']['alt'];
								endif;

								// if( $item ) :
						?>
							<div class="swiper-slide">
								<div class="<?php echo $slug . '-company-box'; ?>">
									<img src="<?php _e( esc_url( $logo_url, 'ne' ) ); ?>" alt="<?php _e( esc_attr( $logo_alt ), 'ne' ); ?>"/>
								</div>
							</div>
						<?php
								// endif;
							endforeach
						?>
					</div>
				</div>
			<?php endif; ?>

		</div>
	<?php endif; ?>

</section>
