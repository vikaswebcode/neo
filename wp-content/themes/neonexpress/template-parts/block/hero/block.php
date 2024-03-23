<?php
/**
 * Block Name: Hero
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
$block_fields  = get_fields();
$block_type	   = $block_fields['type_of_hero'];
$block_bg_type = $block_fields['type_of_background'];
$block_height  = $block_fields['hero_height'];

if( $block_bg_type === 'img' && !empty( $block_fields['hero_background_image'] ) ) {
	$block_bg_url = $block_fields['hero_background_image']['url'];
} elseif( $block_bg_type === 'video' && !empty( $block_fields['hero_background_video'] ) ) {
	$block_bg_url = $block_fields['hero_background_video']['url'];
}

if( $block_type === 'fr' ) {
	$block_title = $block_fields['fr_hero']['fr_hero_content']; 
	$block_cta = $block_fields['fr_hero']['fr_hero_cta'];
	$block_cta_custom = $block_fields['fr_hero']['fr_hero_cta_second'];
}

if( $block_type === 'bs' ) {
	$block_title = $block_fields['bs_hero']['bs_hero_content'];
	$block_cta = $block_fields['bs_hero']['bs_cta_create'];
	$block_cta_custom = $block_fields['bs_hero']['bs_cta_custom'];
}

if( $block_type === 'df' ) {
	$block_title = $block_fields['df_hero']['df_hero_content'];
	$block_cta = $block_fields['df_hero']['df_hero_cta'];
	$block_cta_custom = $block_fields['df_hero']['df_hero_cta_second'];
}

if( $block_height === '1/3' ) {
	$block_height_class = $slug . '_height-33';
} elseif( $block_height === '2/3' ) {
	$block_height_class = $slug . '_height-66';
} elseif( $block_height === '3/3' ) {
	$block_height_class = $slug . '_height-100';
}
?>
<section 
	id="<?php echo $block_id; ?>" 
	class="<?php echo $slug . ' ' . $slug . '_' . $block_type . ' ' . $block_height_class; ?>"
	<?php echo $block_bg_type === 'img' && isset( $block_bg_url ) ? "style=background-image:url(" . $block_bg_url . ")" : "";?>>

	<?php if( $block_bg_type === 'video' && isset( $block_bg_url ) ) : ?>
		<video class="<?php echo $slug . '-video-bg'; ?>" autoplay muted loop poster="">
			<source src="<?php echo esc_url( $block_bg_url ); ?>" type="video/mp4">
		</video>
	<?php endif; ?>

	<!--- Render hero for front-page --->
	<?php if( $block_type === 'fr' && $block_fields ) : ?>
		<div class="container">

			<div class="hero-content">
				<?php 
					if( $block_title || $block_cta ) :
						if( $block_title ) :
							echo $block_title;
						endif;

						if( $block_cta || $block_cta_custom ) : ?>
							<div class="hero-content-cta hero-content-cta_fr">
								<?php if( $block_cta ) : ?>
								<a 
									href="<?php _e( esc_url( $block_cta['url']), 'ne' ); ?>"
									title="<?php esc_attr_e( $block_cta['title'], 'ne' ); ?>"
									target="<?php echo $block_cta['target'] ? esc_attr( $block_cta['target'], 'ne' ) : '_self'; ?>"
									class="button button_text-uppercase button_round button_gradient-bg">
									<?php _e( $block_cta['title'], 'ne' ); ?>
								</a>
								<?php endif; ?>
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
				<?php 	endif;
					endif; ?>
			</div>

			<?php if( !wp_is_mobile() ) : ?>
				<div class="hero-scroll">
					<div class="hero-scroll__icon animate__animated animate__flash animate__infinite"></div>
					<span><?php _e('See More', 'ne'); ?></span>
			</div>
			<?php endif; ?>

		</div>
	<?php endif; ?>
	<!--- Render hero for front-page --->

	<!--- Render hero for business page --->
	<?php if( $block_type === 'bs' && $block_fields ) : ?>
		<div class="container">

			<div class="hero-content">
				<?php 
					if( $block_title || $block_cta ) :
						if( $block_title ) :
							echo $block_title;
						endif;

						if( $block_cta || $block_cta_custom ) : ?>
							<div class="hero-content-cta hero-content-cta_bs">
								<?php if( $block_cta ) : ?>
								<a 
									href="<?php _e( esc_url( $block_cta['url']), 'ne' ); ?>"
									title="<?php esc_attr_e( $block_cta['title'], 'ne' ); ?>"
									target="<?php echo $block_cta['target'] ? esc_attr( $block_cta['target'], 'ne' ) : '_self'; ?>"
									class="button button_text-uppercase button_round button_gradient-bg">
									<?php _e( $block_cta['title'], 'ne' ); ?>
								</a>
								<?php endif; ?>
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
				<?php 	endif;
					endif; ?>
			</div>

		</div>

	<?php endif; ?>
	<!--- Render hero for business page --->

	<!--- Render hero for default page --->
	<?php if( $block_type === 'df' && $block_fields ) : ?>
		<div class="container">

			<div class="hero-content">

				<?php 
				if( $block_title ) :
					echo $block_title;
				endif;
				?>

				<?php						
					if( $block_cta || $block_cta_custom ) : ?>
							<div class="hero-content-cta hero-content-cta_df">
							<?php if( $block_cta ) : ?>
								<a 
									href="<?php _e( esc_url( $block_cta['url']), 'ne' ); ?>"
									title="<?php esc_attr_e( $block_cta['title'], 'ne' ); ?>"
									target="<?php echo $block_cta['target'] ? esc_attr( $block_cta['target'], 'ne' ) : '_self'; ?>"
									class="button button_text-uppercase button_round button_gradient-bg">
									<?php _e( $block_cta['title'], 'ne' ); ?>
								</a>
								<?php endif; ?>
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
				<?php 	endif; ?>

			</div>

		</div>
	<?php endif; ?>
	<!--- Render hero for default page --->
</section>
