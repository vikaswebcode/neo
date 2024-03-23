<?php
/**
 * Block Name: Benefits
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
$block_type = $block_fields['block_type'];
$block_benefits = $block_fields['benefits'];

if( isset( $block_fields['block_title'] ) ) {
	$block_title = $block_fields['block_title'];
}
?>
<section 
	id="<?php echo $block_id; ?>" 
	class="<?php echo $slug; ?><?php echo $align_class ? ' ' . $align_class : ""; ?><?php echo $custom_class ? ' ' . $custom_class : ""; ?>">

	<?php if( $block_benefits ) : ?>
		<div class="container">

			<?php if( isset( $block_fields['block_title'] ) ) : ?>
				<?php if( $block_title ) : ?>
					<h2><?php _e( $block_title, 'ne' ); ?></h2>
				<?php endif; ?>
			<?php endif; ?>

			<ul>

				<?php 
				foreach( $block_benefits as $item ) :
					$link = $item['link'];
					$icon = $item['icon'];
					$text = $item['text'];
					$description = $item['description'];
				?>
					<li>
						<div class="<?php echo $slug . '-benefit' . ' ' . $slug . '-benefit_' . $block_type; ?>">
							<?php if( $link ) : ?>
								<a class="<?php echo $slug . '-benefit__link'; ?>" href="<?php echo $link['url']; ?>">

									<?php if( $icon != 'select' ) : ?>
										<span class="<?php echo $slug . '-benefit-icon ' . $slug . '-benefit-icon_' . $icon; ?>"></span>
									<?php endif; ?>

									<?php if( $text ) : ?>
										<p><?php echo $text; ?></p>
									<?php endif; ?>
										
									<?php if( $description ) : ?>
										<p class="<?php echo $slug . '-benefit__description'; ?>">
											<?php _e( $description, 'ne' ); ?>
										</p>
									<?php endif; ?>

								</a>
							<?php endif; ?>
							<?php if( empty( $link ) ) : ?>
								<?php if( $icon != 'select' ) : ?>
										<span class="<?php echo $slug . '-benefit-icon ' . $slug . '-benefit-icon_' . $icon; ?>"></span>
									<?php endif; ?>

									<?php if( $text ) : ?>
										<p><?php echo $text; ?></p>
									<?php endif; ?>
										
									<?php if( $description ) : ?>
										<p class="<?php echo $slug . '-benefit__description'; ?>">
											<?php _e( $description, 'ne' ); ?>
										</p>
									<?php endif; ?>
							<?php endif; ?>
						</div>
					</li>
				<?php
				endforeach;
				?>

			</ul>
		</div>
	<?php endif; ?>

</section>
