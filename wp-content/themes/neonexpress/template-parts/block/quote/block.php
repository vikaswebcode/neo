<?php
/**
 * Block Name: Quote
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
$block_title = $block_fields['title'];
$block_text = $block_fields['text'];
$block_cta = $block_fields['cta'];
$block_cta_custom = $block_fields['cta_second'];
?>
<section 
	id="<?php echo $block_id; ?>" 
	class="<?php echo $slug; ?><?php echo $align_class ? ' ' . $align_class : ""; ?><?php echo $custom_class ? ' ' . $custom_class : ""; ?>">
	<div class="container">

		<?php if( $block_title ) : ?>
			<h2><?php _e( $block_title, 'ne' ); ?></h2>
		<?php endif; ?>

		<?php if( $block_text ) : ?>
			<p><?php _e( $block_text ); ?></p>
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
