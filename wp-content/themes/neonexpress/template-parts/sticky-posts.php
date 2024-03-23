<?php
$sticky_posts = get_option( 'sticky_posts' );
rsort( $sticky_posts );
$sticky_posts = array_slice( $sticky_posts, 0, 2 );
$query = new WP_Query( array( 'post__in' => $sticky_posts, 'ignore_sticky_posts' => 1 ) );
?>
<section class="blog-section">
    <div class="container">
        <?php if ( $query->have_posts() ) : $index = 0; ?>

            <ul class="sticky-posts">

            <?php while ( $query->have_posts() ) : $index++; $query->the_post(); ?>

                <li>
                    <article class="sticky-post">
                        <div class="sticky-post-thumb">
                            <a class="gradient-border" href=<?php echo esc_url( get_the_permalink() ); ?>>
                                <img 
                                    src="<?php echo get_the_post_thumbnail_url(); ?>" 
                                    alt="<?php echo get_the_title(); ?>" />
                            </a>
                        </div>
                        <div class="sticky-post-content">

                            <h3>
                                <a href=<?php echo esc_url( get_the_permalink() ); ?>>
                                    <?php echo get_the_title(); ?>
                                </a>
                            </h3>

                            <?php 
                            if( $index === 2 ) :
                                echo ne_excerpt( [ 'maxchar'=>100, 'text'=>get_the_excerpt() ] );
                            else :
                                the_excerpt();
                            endif;
                            ?>

                            <a 
                                class="button button_create button_text-uppercase button_round button_gradient-bg"
                                href="<?php echo get_the_permalink(); ?>"><?php _e( 'Read more', 'ne' ); ?></a>
                        </div>
                    </article>
                </li>

            <?php endwhile; ?>

            </ul>
        
        <?php endif; ?>
    </div>
</section>