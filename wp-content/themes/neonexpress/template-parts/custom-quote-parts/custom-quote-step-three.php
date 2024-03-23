<?php
/**
 * Template part of custom quote template
 * Name: Step two
 */

$quote_fields = get_fields();
$q_title = $quote_fields['main_title'];
$q_d_z = $quote_fields['drop_zone_translate'];
$q_d_z_r = $quote_fields['dropzone_remove_file_translate'];
$q_m_f = $quote_fields['message_translate'];
$q_s_s = $quote_fields['sign_size_translate'];
$q_e_p = $quote_fields['estimated_price_translate'];
$q_i_o = $quote_fields['indooroutdoor_translate'];
$q_i_o_opt = $quote_fields['indooroutdoor_options'];
$q_q_f = $quote_fields['quantity_translate'];
$q_d_f = $quote_fields['date_translate'];
$q_g_q = $quote_fields['get_quote_translate'];
$q_mount_f = $quote_fields['mounting_translate'];
$q_mount_o = $quote_fields['mounting_options'];
$q_mount_l = $quote_fields['mounting_link'];
$bg_type = $quote_fields['background_type_third'];

if( $bg_type === 'img' ) {
    $bg_img = $quote_fields['background_image_third'];
    $bg_type_class = 'column_img';
} elseif( $bg_type === 'video' ) {
    $bg_video = $quote_fields['background_video_third'];
    $bg_type_class = 'column_video';
}

$quote_vars = array(
    'dictDefaultMessage' => $q_d_z,
    'dictRemoveFile' => $q_d_z_r,
);
wp_localize_script( 'main-javascript', 'quoteVars', $quote_vars );
?>
<div class="get-a-quote__part-three">

    <div class="row">

        <div class="column column_content">

            <div class="get-a-quote-nav">

                <button id="back-to-two" class="get-a-quote-nav__arrow get-a-quote-nav__arrow_back">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="25" viewBox="0 0 14 25" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12.9056 0.354069C12.4142 -0.118023 11.6186 -0.118023 11.1284 0.354069L0.735535 10.363C-0.246064 11.3084 -0.246064 12.8421 0.735535 13.7875L11.2038 23.8709C11.6902 24.3382 12.4758 24.3445 12.9684 23.8834C13.4712 23.4125 13.4775 22.6363 12.9823 22.1581L3.40131 12.9316C2.90988 12.4584 2.90988 11.6921 3.40131 11.2188L12.9056 2.0657C13.397 1.59361 13.397 0.826151 12.9056 0.354069Z" fill="white"/>
                    </svg>
                </button>

                <h2 class="get-a-quote-nav__title">
                    <?php _e( $q_title, 'ne' ); ?>
                </h2>

                <span class="get-a-quote-nav__number">
                    <?php _e( '2/3', 'ne' ); ?>
                </span>

            </div>

            <div class="customer-form">

                <div class="contact-form-field">

                    <div class="gradient-border">

                        <div class="upload-container" id="uploadContainer">

                            <label for="fileInput" class="upload-label">
                                <?php 
                                    echo $q_d_z ? $q_d_z : __( 'Click here or drag files here to upload your designs. Allowed file types are: JPG, SVG, PNG, .AI', 'ne' ); 
                                ?> 
                            </label>

                            <input type="file" id="fileInput" name="uploaded_files[]" accept=".jpg, .jpeg, .png, .svg, .ai" multiple />

                        </div>

                    </div>

                    <div id="dropzone-previews" class="dropzone"></div>

                </div>

                <div class="contact-form-field">

                    <div class="gradient-border">

                        <textarea 
                            id="quote-description" 
                            name="quote-description" 
                            placeholder="<?php echo $q_m_f ? $q_m_f : __( 'Please describe your idea in as much detail as possible. If you have links to any examples feel free to include them', 'ne' ); ?>"></textarea>

                    </div>

                </div>

                <div class="contact-form-field">

                    <div class="slider-container">

                        <div class="slider-nav">

                            <h3>
                                <?php echo $q_s_s ? $q_s_s : __( 'Sign Size', 'ne' ); ?>
                            </h3>

                            <h3>
                                <?php echo $q_e_p ? $q_e_p . ' ' : __( 'Estimated Price: ', 'ne' ); ?><span id="price" class="price">110€</span>
                            </h3>

                        </div>

                        <div id="slider"></div>

                        <div class="slider-labels">

                            <span>10</span>
                            <span>20</span>
                            <span>30</span>
                            <span>40</span>
                            <span>50</span>
                            <span>60</span>
                            <span>70</span>
                            <span>80</span>
                            <span>90</span>
                            <span>100</span>

                        </div>

                    </div>

                </div>

                <div class="customer-form-grid">

                    <div class="contact-form-field">

                        <div class="gradient-border">

                            <select id="quote-mounting" name="quote-mounting">
                                <option value="" selected="selected"><?php echo $q_mount_f ? $q_mount_f : __( 'Mounting', 'ne' ); ?></option>
                                
                                <?php if( $q_mount_o ) : ?>
                                    <?php foreach( $q_mount_o as $option ) : $option = $option['option']; ?> 
                                        <option value="<?php echo __( $option, 'ne' ); ?>"><?php echo __( $option, 'ne' ); ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                            </select>

                        </div>

                        
                        <?php if( $q_mount_l ) : ?>
                                <a 
                                    href="<?php echo $q_mount_l['url']; ?>" 
                                    target="<?php echo $q_mount_l['target'] ? $q_mount_l['target'] : '_self'; ?>"
                                >
                                    <?php echo $q_mount_l['title']; ?>
                                </a>
                        <?php endif; ?>

                    </div>

                    <div class="contact-form-field">

                        <div class="gradient-border">

                            <select id="quote-indoor-outdoor">
                                <option value="" selected="selected"><?php echo $q_i_o ? $q_i_o : __( 'Indoor/Outdoor', 'ne' ); ?></option>
                                
                                <?php if( $q_i_o_opt ) : ?>
                                    <?php foreach( $q_i_o_opt as $option ) : $option = $option['option']; ?> 
                                        <option value="<?php echo __( $option, 'ne' ); ?>"><?php echo __( $option, 'ne' ); ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                            </select>

                        </div>

                    </div>

                    <div class="contact-form-field">

                        <div class="gradient-border">
                            
                            <input 
                                id="quote-quantity" 
                                type="number" 
                                inputmode="numeric" 
                                placeholder="<?php echo $q_q_f ? $q_q_f : __( 'Quantity', 'ne' ); ?>" 
                                min="1"
                                step="1"
                            />

                            <div class="contact-form-field-icons">

                                <div class="contact-form-field-icons__up contact-form-field-icons__up_quantity">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="9" viewBox="0 0 24 9" fill="none">
                                        <path d="M12 0L23.2583 8.25L0.74167 8.25L12 0Z" fill="#F60793"/>
                                    </svg>

                                </div>

                                <div class="contact-form-field-icons__down contact-form-field-icons__down_quantity">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="9" viewBox="0 0 24 9" fill="none">
                                        <path d="M12 9L0.741669 0.749998L23.2583 0.75L12 9Z" fill="#F60793"/>
                                    </svg>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="contact-form-field">
                        <div class="gradient-border">
                            <input id="quote-date" type="text" placeholder="<?php echo $q_d_f ? $q_d_f : __( 'Date', 'ne' ); ?>" onfocus="(this.type='date')" onblur="(this.type='text')">

                            <div class="contact-form-field-icons contact-form-field-icons_date">
                                <div class="contact-form-field-icons__down">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="9" viewBox="0 0 24 9" fill="none">
                                        <path d="M12 9L0.741669 0.749998L23.2583 0.75L12 9Z" fill="#F60793"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="contact-form-field">
                <div class="button-container">
                    <button id="submit-quote" type="submit" name="submit" class="button button_create button_text-uppercase button_round button_gradient-bg">
                        <?php echo $q_g_q ? $q_g_q : __( 'Get Quote', 'ne' ); ?> 
                    </button>
                </div>
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