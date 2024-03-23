<?php
/**
 * Block Name: Ideas
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
$block_title = $block_fields['block_title'];
$templates = $block_fields['templates'];
$block_cta = $block_fields['block_cta'];
?>
<section id="<?php echo $block_id; ?>" class="<?php echo $slug; ?> <?php echo $align_class; ?> <?php echo $custom_class; ?>">
	<div class="container">
		<h2 class="ideas__title"><?php echo $block_title; ?></h2>
		<?php if( isset( $templates ) && !empty( $templates ) ) : ?>
			<div class="templates-slider swiper">
				<div class="swiper-wrapper">
					<?php
					foreach( $templates as $template ) :
						$template_id = $template;
						$template_img = get_the_post_thumbnail_url( $template_id );
						$template_name = get_the_title( $template_id );
					?>
					<div class="swiper-slide">
						<div class="gradient-border gradient-border_template">
							<div class="template">
								<div class="template-thumb">
									<img src="<?php echo $template_img; ?>" />
								</div>
								<div class="template-meta">
									<span class="template-name"><?php echo $template_name; ?></span>
									<a href="#" class="button button_text-uppercase button_round button_gradient-bg">Customize</a>
								</div>
							</div>
						</div>
					</div>
					<?php
					endforeach;
					?>
				</div>
				<div class="swiper-button-prev templates-slider-btn-prev"></div>
				<div class="swiper-button-next templates-slider-btn-next"></div>
			</div>
		<?php endif; ?>
	</div>
</section>
