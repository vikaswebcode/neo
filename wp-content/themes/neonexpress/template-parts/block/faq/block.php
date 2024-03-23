<?php
/**
 * Block Name: FAQ
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
$block_faq = $block_fields['faq'];
?>
<section 
	id="<?php echo $block_id; ?>" 
	class="<?php echo $slug; ?><?php echo $align_class ? ' ' . $align_class : ""; ?><?php echo $custom_class ? ' ' . $custom_class : ""; ?>">

	<div class="container">
		<?php if( $block_title ) : ?>
			<h2><?php _e( $block_title, 'ne' ); ?></h2>
		<?php endif; ?>

		<?php if( $block_faq ) : ?>
			<ul class="<?php echo $slug . '-accordeon'; ?>">

				<?php
				foreach( $block_faq as $item ) :
					$question = $item['question'];
					$answer = $item['answer'];
				?>
					<li class="gradient-border">

						<?php if( $question ) : ?>
							<h3 class="toggle">
								<span class="toggle-title"><?php _e( $question, 'ne' ); ?></span>
								<span class="toggle-icon">
									<svg xmlns="http://www.w3.org/2000/svg" width="12" height="20" viewBox="0 0 12 20" fill="none">
										<path fill-rule="evenodd" clip-rule="evenodd" d="M1.14001 19.4981C1.54141 19.8838 2.19126 19.8838 2.59163 19.4981L11.0806 11.3228C11.8823 10.5506 11.8823 9.29789 11.0806 8.5257L2.53004 0.289484C2.13274 -0.0921659 1.49111 -0.097364 1.08869 0.279339C0.678047 0.663947 0.672922 1.29797 1.0774 1.68852L8.90315 9.22474C9.30455 9.61132 9.30455 10.2372 8.90315 10.6238L1.14001 18.1001C0.73861 18.4857 0.73861 19.1126 1.14001 19.4981Z" fill="#F60793"/>
									</svg>
								</span>
							</h3>
						<?php endif; ?>

						<?php if( $answer ) : ?>
							<div class="inner">
								<?php _e( $answer, 'ne' ); ?>
							</div>
						<?php endif; ?>

					</li>

				<?php
				endforeach;
				?>

			</ul>
		<?php endif; ?>
	</div>
	
</section>
