<?php
/**
 * Template part of custom quote template
 * Name: Step one
 */

$quote_fields = get_fields();
$q_title = $quote_fields['main_title'];
$q_t_t = $quote_fields['type_title_translate'];
$q_t_p = $quote_fields['type_personal_translate'];
$q_t_b = $quote_fields['type_business_translate'];
$bg_type = $quote_fields['background_type_first'];

if( $bg_type === 'img' ) {
    $bg_img = $quote_fields['background_image_first'];
    $bg_type_class = 'column_img';
} elseif( $bg_type === 'video' ) {
    $bg_video = $quote_fields['background_video_first'];
    $bg_type_class = 'column_video';
}
?>
<div class="get-a-quote__part-one">

    <div class="row">

        <div class="column column_content">

            <div class="get-a-quote-nav">

                <?php if( $q_title ) : ?>
                    <h1 class="get-a-quote-nav__title" style="margin: 0 auto;"><?php _e( $q_title, 'ne' ); ?></h1>
                <?php endif; ?>

                <span class="get-a-quote-nav__number">
                    <?php __( '1/3', 'ne' ); ?>
                </span>

            </div>

            <h2 class="get-a-quote__slide-caption">
                <?php echo $q_t_t ? $q_t_t : __( 'Please select your type', 'ne' ); ?>
            </h2>

            <div class="quote-type">

                <div class="gradient-border">

                    <a 
                        class="quote-type__link quote-type__link_personal"
                        href="#"
                        data-type="personal">
                        <?php echo $q_t_p ? $q_t_p : _( 'Personal', 'ne' ); ?>
                    </a>

                </div>

                <div class="gradient-border">

                    <a 
                        class="quote-type__link quote-type__link_business"
                        href="#"
                        data-type="business">
                        <?php echo $q_t_b ? $q_t_b : _( 'Business', 'ne' ); ?>
                    </a>

                </div>

            </div>

        </div>

        <div 
            class="column column_bg <?php echo $bg_type_class; ?>" 
            style="<?php echo isset( $bg_img ) ? 'background-image: url('. $bg_img['url'] .')' : ''; ?>">
            
            <?php if( isset( $bg_video ) ) : ?>
                <video autoplay muted loop poster="">
			        <source src="<?php echo esc_url( $bg_video['url'] ); ?>" type="video/mp4">
		        </video>
            <?php endif; ?>

        </div>

    </div>

</div>