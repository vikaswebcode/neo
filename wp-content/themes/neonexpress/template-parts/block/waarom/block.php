<?php
/**
 * Block Name: waarom
 * Description: 
 * Category: common
 * Icon: list-view
 * Keywords: 
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
$block_benefits = $block_fields['warronlist'];


if( isset( $block_fields['waaron_heading'] ) ) {
	$block_title = $block_fields['waaron_heading'];
	$block_subtitle = $block_fields['waaron_subheading'];
	
}
?>
<section id="<?php echo $block_id; ?>" 
	class="<?php echo $slug; ?><?php echo $align_class ? ' ' . $align_class : ""; ?><?php echo $custom_class ? ' ' . $custom_class : ""; ?>">
    <div class="container waaromsec">
    <div class="heading"><?php echo $block_title; ?></div>
    <div class="subheading"><?php echo $block_subtitle; ?></div>
	<?php if( $block_benefits ) : ?>
            <div class="rowbox">
                <?php 
    				foreach( $block_benefits as $item ) :
                        $img = $item['warronlist_img'];
    					$heading = $item['warronlist_heading'];
    					$text = $item['warronlist_text'];
    				?>
    
    				<div class="<?php echo $slug; ?>_image-box">
    				    <div class="boximg">
						<?php if( $img ) : ?>
							<img src="<?php echo $img; ?>" class="img-fluid" width="50" />
						<?php endif; ?></div>
						<div class="contentbox">
						<h2><?php echo $heading; ?></h2>
						<p><?php echo $text; ?></p>
						</div>
					</div>
    			<?php
    				endforeach;
    			?>
                
            </div>
		
	<?php endif; ?>
    </div>
</section>
