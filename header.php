<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Aurora
 * @since 5.0.0
 * @version 5.0.0
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="site"><!-- closed in footer.php -->
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'aurora' ); ?></a>

	<!-- See /sass/0.variables/_options.scss for details on the classes horizontal-padding and vertical margin -->
	<header id="masthead" class="site-header horizontal-padding vertical-margin" role="banner">

		<div class="branding-holder">

			<!-- See /sass/0.variables/_options.scss for details on the class single-vertical-padding -->
			<div class="site-branding single-vertical-padding">
				<?php
				if ( is_front_page() && is_home() ) :
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
				else :
					?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
				endif;
				$aurora_description = get_bloginfo( 'description', 'display' );
				if ( $aurora_description || is_customize_preview() ) :
					?>
					<p class="site-description"><?php echo wp_kses_post( $aurora_description ); ?></p>
				<?php endif; ?>
			</div><!-- .site-branding -->

			<div class="top-search">
				<?php get_search_form(); ?>
			</div>

		</div><!-- .branding-holder -->

		<div class="custom-header-media">
			<?php the_custom_header_markup(); ?>
		</div>

		<?php if ( has_nav_menu( 'primary' ) ) { ?>
			<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'aurora' ); ?>">
				<div class="toggle-holder">
					<button class="menu-toggle"><?php esc_html_e( 'Primary Menu', 'aurora' ); ?></button>
				</div><!-- .toggle-holder -->
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'menu_id'        => 'primary-menu',
					)
				);
				?>
			</nav><!-- .main-navigation -->
		<?php } ?>

	</header><!-- .site-header -->

	<!-- See /sass/0.variables/_options.scss for details on the classes horizontal-padding and vertical-margin-->
	<div id="content" class="site-content horizontal-padding vertical-margin"><!-- closed in footer,php -->
