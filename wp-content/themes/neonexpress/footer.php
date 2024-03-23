<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Neon_Express
 */

$logotype = get_field( 'company_logo', 'options' );
$google_scripts_3 = get_field( 'google_scripts_before_closed_body', 'options' );
$truspilot_footer = get_field( 'truspilot_footer', 'options' );
$first_button = get_field( 'first_button', 'options' );
$second_button = get_field( 'second_button', 'options' );
$payment_methods = get_field( 'payment_methods', 'options' );
?>

	<?php if( !is_404() ) : ?>
		<footer id="colophon" class="site-footer">
			<div class="container container_top">
				<a href="<?php echo home_url(); ?>" title="<?php echo get_bloginfo(); ?>" class="site-logo">
					<img 
						src="<?php echo esc_url( $logotype['url'] ); ?>"
						alt="<?php esc_attr_e( $logotype['alt'], 'ne' ); ?>" />
				</a>
				<?php if( $truspilot_footer || $payment_methods ) : ?>
					<div class="footer-truspilot">
						<?php echo $truspilot_footer; ?>

						<?php if( $payment_methods ) : ?>
							<div class="payment-methods">
								<?php 
									foreach( $payment_methods as $method ) : $method = $method['logo'];
									if( !empty($method) ) :
									?>
										<img class="payment-methods__logo" src="<?php echo $method['url']; ?>" alt="<?php echo $method['alt']; ?>" />
									<?php endif;?>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				<div class="footer-menus">
					<nav>
						<h4><?php echo wp_get_nav_menu_name( 'footer_menu_1' ); ?></h4>
						<?php
							wp_nav_menu( [
								'theme_location'  => 'footer_menu_1',
								'container'       => false,
								'menu_class'      => 'footer-menu',
								'echo'            => true,
								'fallback_cb'     => '__return_empty_string',
								'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
								'depth'           => 0,
							] );
						?>
					</nav>
					<nav>
						<h4><?php echo wp_get_nav_menu_name( 'footer_menu_2' ); ?></h4>
						<?php
							wp_nav_menu( [
								'theme_location'  => 'footer_menu_2',
								'container'       => false,
								'menu_class'      => 'footer-menu',
								'echo'            => true,
								'fallback_cb'     => '__return_empty_string',
								'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
								'depth'           => 0,
							] );
						?>
					</nav>
					<nav>
						<h4><?php echo wp_get_nav_menu_name( 'footer_menu_3' ); ?></h4>
						<?php
							wp_nav_menu( [
								'theme_location'  => 'footer_menu_3',
								'container'       => false,
								'menu_class'      => 'footer-menu',
								'echo'            => true,
								'fallback_cb'     => '__return_empty_string',
								'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
								'depth'           => 0,
							] );
						?>
					</nav>
				</div>
				<div class="footer-buttons">
					<?php if( $first_button ) : ?>
						<a href="<?php echo $first_button['url']; ?>" title="<?php echo $first_button['title']; ?>" class="button button_create button_text-uppercase button_round button_gradient-bg">
							<?php echo $first_button['title']; ?>
						</a>
					<?php endif; ?>
					<?php if( $second_button ) : ?>
						<div class="gradient-border gradient-border_round gradient-border_button">
							<a href="<?php echo $second_button['url']; ?>" title="<?php echo $second_button['title']; ?>" class="button button_text-uppercase button_round button_black">
								<?php echo $second_button['title']; ?>
							</a>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<div class="container container_bottom">
				<span class="copyright"><?php _e( '© 2023 NeonExpress. All rights reserved.', 'ne' ); ?></span>

				<?php get_template_part( 'template-parts/social-media' ); ?>
			</div>
		</footer>
	<?php endif; ?>	
</div><!-- #page -->

<?php wp_footer(); ?>
<?php
if( $google_scripts_3 ) : 
	echo $google_scripts_3;
endif;
?>
</body>
</html>
