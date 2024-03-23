<?php
$social_media = get_field( 'social_media', 'options' );

if( $social_media ) :
?>
<div class="social-media">

    <span><?php _e( 'Follow us', 'ne' ); ?></span>

    <div class="social-media-links">
        <?php
        foreach( $social_media as $link ) :
            $url = $link['link']['url'];
            $title = $link['link']['title'];
            $target = $link['link']['target'];
            $icon = $link['icon'];
        ?>
        <a 
            href="<?php echo esc_url( $url ); ?>"
            title="<?php _e( $title, 'ne' ); ?>"
            target="<?php echo $target ? esc_attr( $target ) : '_self'; ?>"
            class="social-media__icon social-media__icon_<?php echo $icon; ?>"
        >
        </a>
        <?php
        endforeach;
        ?>
    </div>
</div>
<?php
endif;