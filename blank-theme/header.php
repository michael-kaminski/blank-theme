<?php
/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$bootstrap_version = get_theme_mod( 'understrap_bootstrap_version', 'bootstrap4' );
$navbar_type       = get_theme_mod( 'understrap_navbar_type', 'collapse' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php echo get_stylesheet_directory_uri(); ?>/img/apple-touch-icon-57x57.png" />
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_stylesheet_directory_uri(); ?>/img/apple-touch-icon-114x114.png" />
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_stylesheet_directory_uri(); ?>/img/apple-touch-icon-72x72.png" />
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_stylesheet_directory_uri(); ?>/img/apple-touch-icon-144x144.png" />
	<link rel="apple-touch-icon-precomposed" sizes="60x60" href="<?php echo get_stylesheet_directory_uri(); ?>/img/apple-touch-icon-60x60.png" />
	<link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?php echo get_stylesheet_directory_uri(); ?>/img/apple-touch-icon-120x120.png" />
	<link rel="apple-touch-icon-precomposed" sizes="76x76" href="<?php echo get_stylesheet_directory_uri(); ?>/img/apple-touch-icon-76x76.png" />
	<link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php echo get_stylesheet_directory_uri(); ?>/img/apple-touch-icon-152x152.png" />
	<link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon-196x196.png" sizes="196x196" />
	<link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon-96x96.png" sizes="96x96" />
	<link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon-32x32.png" sizes="32x32" />
	<link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon-16x16.png" sizes="16x16" />
	<link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon-128.png" sizes="128x128" />
	<meta name="application-name" content="Blank Theme"/>
	<meta name="msapplication-TileColor" content="#2C699A" />
	<meta name="msapplication-TileImage" content="<?php echo get_stylesheet_directory_uri(); ?>/img/mstile-144x144.png" />
	<meta name="msapplication-square70x70logo" content="<?php echo get_stylesheet_directory_uri(); ?>/img/mstile-70x70.png" />
	<meta name="msapplication-square150x150logo" content="<?php echo get_stylesheet_directory_uri(); ?>/img/mstile-150x150.png" />
	<meta name="msapplication-wide310x150logo" content="<?php echo get_stylesheet_directory_uri(); ?>/img/mstile-310x150.png" />
	<meta name="msapplication-square310x310logo" content="<?php echo get_stylesheet_directory_uri(); ?>/img/mstile-310x310.png" />

	<?php 
		understrap_tracking_code();
		wp_head();
	?>
</head>

<body <?php body_class(); ?> <?php understrap_body_attributes(); ?>>
<?php do_action( 'wp_body_open' ); ?>
<div class="site" id="page">

	<!-- ******************* The Navbar Area ******************* -->
	<header id="wrapper-navbar">

		<a class="skip-link <?php echo understrap_get_screen_reader_class( true ); ?>" href="#content">
			<?php esc_html_e( 'Skip to content', 'understrap' ); ?>
		</a>

		<?php get_template_part( 'global-templates/navbar', $navbar_type . '-' . $bootstrap_version ); ?>

	</header><!-- #wrapper-navbar -->
