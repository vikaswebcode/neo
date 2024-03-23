<?php
/**
 * Block Name: Steps
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
$block_title = $block_fields['st_title'];
$block_steps = $block_fields['st_steps'];
?>
<section 
	id="<?php echo $block_id; ?>" 
	class="<?php echo $slug; ?><?php echo $align_class ? ' ' . $align_class : ""; ?><?php echo $custom_class ? ' ' . $custom_class : ""; ?>">
	<!-- <img 
		src="<?php echo get_template_directory_uri() . '/assets/images/wave.png'; ?>"
		alt="<?php _e( 'Section background', 'ne' ); ?>"
		class="<?php echo $slug . '-bg'; ?>" /> -->
	<div class="container">
		
		<?php if( $block_title ) : ?>
			<h2><?php _e( $block_title, 'ne' ); ?></h2>
		<?php endif; ?>

		<?php if( $block_steps ) : ?>
			<ul>
				<?php
				$index = 0;
				foreach( $block_steps as $step ) :
					$index++;
					$step_icon = $step['step_icon'];
					$step_title = $step['step_title'];
					$step_content = $step['step_content'];
					$icon_class = $slug . '-step__icon ' . $slug . '-step__icon_' . $step_icon;
					$middle_el_class = 'middle';
				?>
				<li class="<?php echo $index == 2 ? $middle_el_class : ''; ?>">
					<div class="<?php echo $slug . '-step'; ?>">
					
						<?php if( $step_icon ) : ?>
							<div class="<?php echo $slug . '-step-icon-container'; ?>">
								<span class="<?php echo $icon_class; ?>"></span>
							</div>
						<?php endif; ?>

						<?php if( $step_title ) : ?>
							<h3><span><?php _e( $index, 'ne' ); ?></span><?php _e( $step_title, 'ne' ); ?></h3>
						<?php endif; ?>

						<?php if( $step_content ) : ?>
							<p><?php _e( $step_content, 'ne' ); ?>
						<?php endif; ?>

					</div>
				</li>
				<?php
				endforeach;
				?>
			</ul>
		<?php endif; ?>

	</div>
</section>
