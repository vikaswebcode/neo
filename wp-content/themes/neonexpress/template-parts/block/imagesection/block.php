<?php
/**
 * Block Name: Image Section
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
$slug         = str_replace( 'acf/', '', 'image_section' );
$block_id     = $slug . '-' . $block['id'];
$align_class  = $block['align'] ? 'align' . $block['align'] : '';
$custom_class = isset( $block['className'] ) ? $block['className'] : '';

// BLOCK FIELDS
$block_fields       = get_fields();
$block_benefits = $block_fields['image_section'];

$block_img = $block_fields['img_sec_image'];
$block_position = $block_fields['image_postion'];

$block_content = $block_fields['img_sec_content'];

$block_cta          = $block_fields['cta_link'];
$block_cta_sec   = $block_fields['cta_link_sec'];


?>
<section id="<?php echo $block_id; ?>" 	class="<?php echo $slug; ?> <?php echo $align_class ? ' ' . $align_class : ""; ?><?php echo $custom_class ? ' ' . $custom_class : ""; ?>" style="background: <?php the_field('img_sec_background_color'); ?>">
	<?php if( $block_fields ) : ?>
		<div class="container imagebox">
			<?php if( $block_position === 'left' ) : ?>
					<div class="<?php echo $slug . '-showcase'; ?>">
						<div class="gradient-border">
						    <img src="<?php echo $block_img;  ?>" alt="" />
						</div>
					</div>
			<?php endif; ?>
					<div class="content">
						<?php echo $block_content; ?>
						
						<?php if( $block_benefits ) : ?>
                            <div class="rowbox" style=" margin-bottom: 55px">
                                <?php 
                    				foreach( $block_benefits as $item ) :
                                        $img = $item['image_section_image'];
                    					$heading = $item['image_section_heading'];
                    					$text = $item['image_section_text'];
                    				?>
                    
                    				<div class="<?php echo $slug; ?>_image-box">
                    				    <div class="boximg">
                						<?php if( $img ) : ?>
                							<img src="<?php echo $img; ?>" class="img-fluid" width="50" />
                						<?php endif; ?></div>
                						<div class="contentbox">
                						<h3><?php echo $heading; ?></h3>
                						<p><?php echo $text; ?></p>
                						</div>
                					</div>
                    			<?php
                    				endforeach;
                    			?>
                                
                            </div>
                		
                	<?php endif; ?>
						
						
						
						
						
						
						<a href="<?php echo $block_cta; ?>" class="button button_text-uppercase button_round button_gradient-bg">TRY NOW OMG I WANT IT!</a>
						&nbsp; <a class ="button button_text-uppercase button_round button_gradient-bg" href="<?php echo $block_cta_sec; ?>">TRY NOW OMG I WANT IT!</a>
						
					</div>
			<?php if( $block_position === 'right' ) : ?>
					<div class="<?php echo $slug . '-showcase'; ?>">
						<div class="gradient-border">
						    <img src="<?php echo $block_img;  ?>" alt="" />
						</div>
					</div>
			<?php endif; ?>
			
        </div>
        <?php endif; ?>
</section>