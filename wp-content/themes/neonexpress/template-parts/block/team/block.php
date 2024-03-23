<?php
/**
 * Block Name: Team
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
$block_title = get_field('block_title');
$team = get_field('team');
?>
<section id="<?php echo $block_id; ?>" class="<?php echo $slug; ?>">
	<div class="container">
		<?php if( $block_title ) : ?>
			<h2 class="<?php echo $slug . '__title'; ?>"><?php _e( $block_title, 'ne' ); ?></h2>
		<?php endif; ?>
		<?php if( $team ) : ?>
			<ul class="team-listing">
				<?php 
				foreach( $team as $member ) : 
					$member_img = $member['member_avatar'];
					$member_name = $member['member_name'];
					$member_desc = $member['member_description'];
				?>
				<li>
					<div class="member">
						<?php if( $member_img ) : ?>
							<div class="gradient-border">
								<img 
									class="member-avatar"
									src="<?php echo esc_url( $member_img['url'] ); ?>" 
									alt="<?php esc_attr_e( $member_img['alt'] ); ?>" />
							</div>
						<?php endif; ?>

						<?php if( $member_name ) : ?>
							<h3 class="member-name"><?php _e( $member_name, 'ne' ); ?></h3>
						<?php endif; ?>

						<?php if( $member_desc ) : ?>
							<p class="member-desc"><?php _e( $member_desc, 'ne' ); ?></p>
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
