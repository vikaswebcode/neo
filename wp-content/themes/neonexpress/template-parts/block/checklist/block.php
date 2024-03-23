<?php
/**
 * Block Name: checklist
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

if( isset( $block_fields['check_list_title'] ) ) {
	$block_title = $block_fields['check_list_title'];
	
}
if( isset( $block_fields['check_list_text'] ) ) {
	$block_text = $block_fields['check_list_text'];
	
}
?>
<?php if($block_title) : ?>
<section id="<?php echo $block_id; ?>" 
	class="<?php echo $slug; ?><?php echo $align_class ? ' ' . $align_class : ""; ?><?php echo $custom_class ? ' ' . $custom_class : ""; ?>">
    <div class="container">
    <h2 class="heading"><?php echo $block_title; ?></h2>
    <div class="listing"><?php echo $block_text; ?></div>
    </div>
</section>
<?php endif; ?>