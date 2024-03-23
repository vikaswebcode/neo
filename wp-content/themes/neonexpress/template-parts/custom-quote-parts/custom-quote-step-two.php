<?php
/**
 * Template part of custom quote template
 * Name: Step two
 */

$quote_fields = get_fields();
$q_title = $quote_fields['main_title'];
$q_c_n_f = $quote_fields['company_name_translate'];
$q_n_f = $quote_fields['name_field_translate'];
$q_e_f = $quote_fields['email_field_translate'];
$q_p_f = $quote_fields['phone_field_translate'];
$q_c_f = $quote_fields['country_field_translate'];
$q_c_l = $quote_fields['country_list'];
$q_r_f = $quote_fields['reference_field_translate']; 
$q_r_l = $quote_fields['reference_list'];
$q_n_s_1 = $quote_fields['next_step_btn_1'];
$error_empty = $quote_fields['empty_email_error_translate'];
$error_incorrect = $quote_fields['incorrect_email_error_translate'];
$bg_type = $quote_fields['background_type_second'];

if( $bg_type === 'img' ) {
    $bg_img = $quote_fields['background_image_second'];
    $bg_type_class = 'column_img';
} elseif( $bg_type === 'video' ) {
    $bg_video = $quote_fields['background_video_second'];
    $bg_type_class = 'column_video';
}
?>
<div class="get-a-quote__part-two">

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

            <div class="get-a-quote-nav">

                <button id="back-to-one" class="get-a-quote-nav__arrow get-a-quote-nav__arrow_back">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="25" viewBox="0 0 14 25" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12.9056 0.354069C12.4142 -0.118023 11.6186 -0.118023 11.1284 0.354069L0.735535 10.363C-0.246064 11.3084 -0.246064 12.8421 0.735535 13.7875L11.2038 23.8709C11.6902 24.3382 12.4758 24.3445 12.9684 23.8834C13.4712 23.4125 13.4775 22.6363 12.9823 22.1581L3.40131 12.9316C2.90988 12.4584 2.90988 11.6921 3.40131 11.2188L12.9056 2.0657C13.397 1.59361 13.397 0.826151 12.9056 0.354069Z" fill="white"/>
                    </svg>
                </button>

                <?php if( $q_title ) : ?>
                    <h2 class="get-a-quote-nav__title"><?php _e( $q_title, 'ne' ); ?></h2>
                <?php endif; ?>

                <span class="get-a-quote-nav__number">
                    <?php __( '3/3', 'ne' ); ?>
                </span>

            </div>

            <div class="customer-form">

                <div id="quote-company-field" class="contact-form-field">

                    <div class="gradient-border">

                        <input 
                            id="quote-company" 
                            type="text" 
                            name="quote-company" 
                            placeholder="<?php echo $q_c_n_f ? $q_c_n_f : __( 'Company name', 'ne' ); ?>" 
                        />

                    </div>

                </div>

                <div class="contact-form-field">

                    <div class="gradient-border">

                        <input 
                            id="quote-name" 
                            type="text" 
                            name="quote-name" 
                            placeholder="<?php echo $q_n_f ? $q_n_f : __( 'Your name', 'ne' ); ?>" 
                        />

                    </div>

                </div>

                <div class="contact-form-field">

                    <div class="gradient-border">

                        <input 
                            id="quote-email" 
                            type="email" 
                            name="quote-email" 
                            placeholder="<?php echo $q_e_f ? $q_e_f : __( 'Your email', 'ne' ); ?>" 
                        />

                    </div>

                    <div class="error-email email-empty"><?php echo $error_empty ? $error_empty : __( 'Please enter your email', 'ne' ); ?></div>
                    <div class="error-email email-incorrect"><?php echo $error_incorrect ? $error_incorrect : __( 'Please enter the correct email', 'ne' ); ?></div>

                </div>

                <div class="contact-form-field">

                    <div class="gradient-border">

                        <input 
                            id="quote-phone" 
                            type="text" 
                            name="quote-phone" 
                            placeholder="<?php echo $q_p_f ? $q_p_f : __( 'Your phone', 'ne' ); ?>" 
                        />

                    </div>

                </div>

                <div class="contact-form-field">

                    <div class="gradient-border">

                        <select id="quote-country" name="quote-country">

                            <option value="" selected="selected"><?php echo $q_c_f ? $q_c_f : __( 'Country', 'ne' ); ?></option>
                            
                            <?php if( $q_c_l ) : ?>
                                <?php foreach( $q_c_l as $country ) : $country = $country['country']; ?> 
                                    <option value="<?php echo __( $country, 'ne' ); ?>"><?php echo __( $country, 'ne' ); ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>

                        </select>

                    </div>

                </div>

                <div class="contact-form-field">

                    <div class="gradient-border">

                        <select id="quote-reference" name="quote-reference">

                            <option value="" selected="selected"><?php echo $q_r_f ? $q_r_f : __( 'How did you hear about us?', 'ne' ); ?></option>

                            <?php if( $q_r_l ) : ?>
                                <?php foreach( $q_r_l as $reference ) : $reference = $reference['reference']; ?> 
                                    <option value="<?php echo __( $reference, 'ne' ); ?>"><?php echo __( $reference, 'ne' ); ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>

                        </select>

                    </div>

                </div>

                <a 
                    id="step-3" 
                    href="#" 
                    class="button button_create button_text-uppercase button_round button_gradient-bg">
                    <?php echo $q_n_s_1 ? $q_n_s_1 : __( 'Next', 'ne' ); ?>
                </a>

            </div>

        </div>
        
    </div>

</div>