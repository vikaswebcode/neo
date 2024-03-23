<?php
/**
 * Block Name: Contact
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
$address = $block_fields['address'];
$phone = $block_fields['phone_number'];
$email = $block_fields['email'];
$logotype = get_field( 'company_logo', 'option' );
$social_media = get_field( 'social_media', 'options' );
?>
<section 
	id="<?php echo $block_id; ?>" 
	class="<?php echo $slug; ?><?php echo $align_class ? ' ' . $align_class : ""; ?><?php echo $custom_class ? ' ' . $custom_class : ""; ?>">

	<div class="container">

		<?php if( $block_title ) : ?>
			<h2><?php _e( $block_title, 'ne' ); ?></h2>
		<?php endif; ?>
		
		<div class="row">

			<div class="column">
				<?php get_template_part( 'template-parts/contact-form' ); ?>
			</div>

			<div class="column">
				<div class="site-logo">
					<img 
						src="<?php echo esc_url( $logotype['url'] ); ?>"
						alt="<?php esc_attr_e( $logotype['alt'], 'ne' ); ?>" />
				</div>
					
				<div class="<?php echo $slug . '-info'; ?>">

					<?php if( $address ) : ?>
						<span class="contact-info-address"><?php _e( $address, 'ne' ); ?></span>
					<?php endif; ?>

					<?php if( $phone ) : ?>
						<a 
							href="tel:<?php _e( str_replace( ' ', '', $phone ), 'ne' ); ?>" 
							title="<?php _e( str_replace( ' ', '', $phone ), 'ne' ); ?>"
							class="<?php echo $slug . '-info-phone'; ?>"><?php _e( $phone, 'ne' ); ?></a>
					<?php endif; ?>

					<?php if( $email ) : ?>
						<a 
							href="mailto:<?php _e( str_replace( ' ', '', $email ), 'ne' ); ?>" 
							title="<?php _e( str_replace( ' ', '', $email ), 'ne' ); ?>"
							class="<?php echo $slug . '-info-email'; ?>"><?php _e( $email, 'ne' ); ?></a>
					<?php endif; ?>

					<div class="social-media-links">
						<?php
						foreach( $social_media as $link ) :
							$url = $link['link']['url'];
							$title = $link['link']['title'];
							$target = $link['link']['target'];
							$icon = $link['icon'];
						?>
						<a 
							href="<?php echo esc_url( $url ); ?>"
							title="<?php _e( $title, 'ne' ); ?>"
							target="<?php echo $target ? esc_attr( $target ) : '_self'; ?>"
							class="social-media__icon social-media__icon_<?php echo $icon; ?>"
						>
						</a>
						<?php
						endforeach;
						?>
					</div>

				</div>
			</div>

		</div>

	</div>
	
</section>
