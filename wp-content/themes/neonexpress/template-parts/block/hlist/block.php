<?php
/**
 * Block Name: hlist
 * Description: h_list will add a horizontal list with icon and title.
 * Category: common
 * Icon: list-view
 * Keywords: Horizontal icon list
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
$block_benefits = $block_fields['hlist'];

if( isset( $block_fields['block_title'] ) ) {
	$block_title = $block_fields['block_title'];
}
?>
<section 
	id="<?php echo $block_id; ?>" 
	class="<?php echo $slug; ?><?php echo $align_class ? ' ' . $align_class : ""; ?><?php echo $custom_class ? ' ' . $custom_class : ""; ?>">

	<?php if( $block_benefits ) : ?>
		<div class="container">
            <div class="row hlist_row">
                <?php 
    				foreach( $block_benefits as $item ) :
    
    					$icon = $item['hlist_image'];
    					$title = $item['hlist_text'];
    				?>
    				<div class="hlist_image-box">
						<?php if( $icon ) : ?>
							<img src="<?php echo $icon; ?>" class="img-fluid" width="50" />
						<?php endif; ?>
						<h2><?php echo $title; ?></h2>
					</div>
    			<?php
    				endforeach;
    			?>
                
            </div>
		</div>
	<?php endif; ?>

</section>
