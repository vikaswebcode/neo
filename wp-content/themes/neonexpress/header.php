<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Neon_Express
 */

$logotype = get_field( 'company_logo', 'option' );
$google_scripts_1 = get_field( 'google_analytics_scripts', 'options' );
$google_scripts_2 = get_field( 'google_scripts_after_open_body', 'options' );
$truspilot_scripts = get_field( 'truspilot_scripts_for_widgets', 'options' ); 
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
	<?php wp_head(); ?>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
	<?php 
	if( $truspilot_scripts ) :
		echo $truspilot_scripts;
	endif;
	?>
	<?php 
	if( $google_scripts_1 ) : 
		echo $google_scripts_1;
	endif;
	?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php
if( $google_scripts_2 ) : 
	echo $google_scripts_2;
endif;
?>
<div id="ne-page" class="ne-page">
	<?php if( !is_404() ) : ?>
		<header id="masthead" class="site-header" style="background:rgba(0, 0, 0, 0.85);">
			<div class="site-header__overlay">
				<button class="navigation-trigger menu-trigger">
					<span></span>
				</button>
				
				<div class="container">
				<?php
				wp_nav_menu( [
					'theme_location'  => 'primary',
					'container'       => 'nav',
					'menu_class'      => 'menu',
					'echo'            => true,
					'fallback_cb'     => '__return_empty_string',
					'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'depth'           => 0,
				] );
				?>
					<a href="#" title="#" class="button button_create button_text-uppercase button_round button_gradient-bg">
						<?php _e( 'Create', 'ne' ); ?>
					</a>
					<a href="<?php echo home_url(); ?>" title="<?php echo get_bloginfo(); ?>" class="site-logo">
						<img 
							src="<?php echo esc_url( $logotype['url'] ); ?>"
							alt="<?php esc_attr_e( $logotype['alt'], 'ne' ); ?>" />
					</a>
				</div>
			</div>
			<div class="container">
				<a href="<?php echo home_url(); ?>" title="<?php echo get_bloginfo(); ?>" class="site-logo">
					<img 
						src="<?php echo esc_url( $logotype['url'] ); ?>"
						alt="<?php esc_attr_e( $logotype['alt'], 'ne' ); ?>" />
				</a>
				<?php
				wp_nav_menu( [
					'theme_location'  => 'primary',
					'container'       => 'nav',
					'menu_class'      => 'menu',
					'echo'            => true,
					'fallback_cb'     => '__return_empty_string',
					'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'depth'           => 0,
				] );
				?>
				<a href="https://neonexpress.nl/configurator" title="#" class="button button_create button_text-uppercase button_round button_gradient-bg">
					<?php _e( 'Create', 'ne' ); ?>
				</a>
				<a href="#" title="#" class="button button_cart"></a>
				<button class="navigation-trigger menu-trigger">
					<span></span>
				</button>
			</div>
		</header><!-- #masthead -->
	<?php endif; ?>
