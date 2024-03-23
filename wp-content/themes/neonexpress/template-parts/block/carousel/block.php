<?php
/**
 * Block Name: carousel
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
$block_title = $block_fields['carousel_title'];
$block_slider = $block_fields['carousel_gallery'];
$block_cta = $block_fields['carousel_cta'];
?>
<section 
	id="<?php echo $block_id; ?>" 
	class="<?php echo $slug; ?><?php echo $align_class ? ' ' . $align_class : ""; ?><?php echo $custom_class ? ' ' . $custom_class : ""; ?>">
	<div class="container container_fullwidth">

		<?php if( $block_title ) : ?>
			<h2 class="ideas__title"><?php echo $block_title; ?></h2>
		<?php endif; ?>

		<?php if( $block_slider ) : ?>
			<div class="ct_slider swiper">
				<div class="swiper-wrapper">
					
					<?php
					foreach( $block_slider as $slide ) :

					?>
						<div class="swiper-slide">
								<img src="<?php echo $slide; ?>" alt="" />

						</div>
						<?php endforeach; ?>
				</div>
				<div class="ct_slider-btn-prev swiper-button-prev"></div>
  				<div class="ct_slider-btn-next swiper-button-next"></div>
			</div>
		<?php endif; ?>
		<?php if( $block_cta ) : ?>
			<div class="button-container">
    		    <a href="<?php echo $block_cta; ?>"	title="" target="_blank" class="button button_text-uppercase button_round button_gradient-bg">
    			Create Your Neon
    		</a>
    		</div>
		<?php endif; ?>
		
		
	</div>
</section>
