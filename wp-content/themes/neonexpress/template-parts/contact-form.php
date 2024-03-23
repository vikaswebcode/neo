<?php
$name_pl = get_field('name_placeholder', 'options');
$label_contact = get_field('label_contact_field', 'options');
$email_pl = get_field('email_placeholder', 'options');
$msg_pl = get_field('message_placeholder', 'options');
$submit_txt = get_field('submit_button_text', 'options');
$thx_title = get_field('thank_you_title', 'options');
$thx_txt = get_field('thank_you_short_text', 'options');
?>
<form class="contact-form" action="" name="contact-form" method="POST">
    <div class="contact-form-field">
        <div class="gradient-border">
            <input type="text" name="name" placeholder="<?php _e( $name_pl, 'ne' ); ?>" />
        </div>
    </div>
    <div class="contact-form-field">
        <label for="contact-data"><?php _e( $label_contact, 'ne' ); ?></label>
        <div class="gradient-border">
            <input type="email" name="contact-data" data-contact-type="email" placeholder="<?php _e( $email_pl ); ?>" />
        </div>
    </div>
    <div class="contact-form-field">
        <div class="gradient-border">
            <textarea name="message" placeholder="<?php _e( $msg_pl, 'ne' ); ?>"></textarea>
        </div>
    </div>
    <div class="contact-form-field">
        <div class="button-container">
            <button id="submit-form" type="submit" name="submit" class="button button_create button_text-uppercase button_round button_gradient-bg">
                <?php _e( $submit_txt, 'ne' ); ?>
            </button>
        </div>
    </div>
</form>
<div class="thx-message hidden">
    <div class="gradient-border">
        <div class="thx-message-content">
            <h3 class="thx-message-content__title"><?php _e( $thx_title, 'ne' ); ?></h3>
            <p class="thx-message-content__text"><?php _e( $thx_txt, 'ne' ); ?></p>
        </div>
    </div>
</div>
<?php