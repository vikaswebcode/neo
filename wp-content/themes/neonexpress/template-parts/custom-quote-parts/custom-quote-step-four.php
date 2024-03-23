<?php
$quote_fields = get_fields();
$q_title = $quote_fields['main_title'];
$q_thx_title = $quote_fields['thank_you_title_translate'];
$q_thx_desc = $quote_fields['thank_you_description_translate'];
$logotype = get_field( 'company_logo', 'option' );
$bg_type = $quote_fields['background_type_fourth'];

if( $bg_type === 'img' ) {
    $bg_img = $quote_fields['background_image_fourth'];
    $bg_type_class = 'column_img';
} elseif( $bg_type === 'video' ) {
    $bg_video = $quote_fields['background_video_fourth'];
    $bg_type_class = 'column_video';
}
?>
			<div class="get-a-quote__part-four" style="display: none;">
				<div class="row">
					<div 
						class="column column_bg <?php echo $bg_type_class; ?>" 
						style="<?php echo isset( $bg_img ) ? 'background-image: url('. $bg_img['url'] .')' : ''; ?>">
            
						<?php if( isset( $bg_video ) ) : ?>
							<video autoplay muted loop poster="">
								<source src="<?php echo esc_url( $bg_video['url'] ); ?>" type="video/mp4">
							</video>
						<?php endif; ?>

        			</div>
					<div class="column column_content">
						<h2><?php echo $q_thx_title ? $q_thx_title : __( 'Thank you!', 'ne' ); ?></h2>
						<p><?php echo $q_thx_desc ? $q_thx_desc : __( 'We’ll be in touch in no time.', 'ne' ); ?></p>
						<a href="<?php echo home_url(); ?>" title="<?php echo get_bloginfo(); ?>" class="site-logo">
							<img 
								src="<?php echo esc_url( $logotype['url'] ); ?>"
								alt="<?php esc_attr_e( $logotype['alt'], 'ne' ); ?>" />
						</a>
					</div>
				</div>
			</div>