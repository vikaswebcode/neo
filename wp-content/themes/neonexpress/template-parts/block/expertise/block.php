<?php
/**
 * Block Name: Expertise
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
$block_icons = $block_fields['block_icons'];
$block_content = $block_fields['block_content'];
?>
<section id="<?php echo $block_id; ?>" class="<?php echo $slug; ?> <?php echo $align_class; ?> <?php echo $custom_class; ?>">
	<div class="container">
		<?php if( $block_title ) : ?>
			<h2 class="<?php echo $slug . '__title'; ?>"><?php _e( $block_title ); ?></h2>
		<?php endif; ?>

		<?php if( $block_icons ) : ?>
			<ul class="<?php echo $slug . '-icons'; ?>">
				<?php
				foreach( $block_icons as $icon ) : 
					$icon = $icon['icon'];
				?>
				<li>
					<span class="<?php echo $slug . '-icons__icon ' . $slug . '-icons__icon_' . $icon; ?>"></span>
				</li>
				<?php
				endforeach;
				?>
			</ul>
		<?php endif; ?>

		<?php if( $block_content ) : ?>
			<div class="<?php echo $slug . '__content'; ?>">
				<?php echo $block_content; ?>
			</div>
		<?php endif; ?>
	</div>	
</section>
