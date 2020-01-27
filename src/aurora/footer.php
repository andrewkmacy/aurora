<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Aurora
 * @since 5.0.0
 * @version 5.0.0
 */

?>

	</div><!-- .site-content (opened in header.php) -->

	<!-- See /sass/0.variables/_options.scss for details on the classes horizontal-padding and double-vertical-padding -->
	<footer id="colophon" class="site-footer horizontal-padding double-vertical-padding" role="contentinfo">

		<?php aurora_footer_widgets( 'footer' ); ?>

		<?php if ( has_nav_menu( 'footer' ) ) { ?>
			<nav id="footer-navigation" class="footer-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Menu', 'aurora' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'menu_id'        => 'footer-menu',
						'depth'          => -1,
					)
				);
				?>
			</nav><!-- .footer-navigation -->
		<?php } ?>

		<div class="site-info">
			<?php aurora_create_copyright(); ?>
			<span><?php esc_html_e( 'Powered by', 'aurora' ); ?>
				<a href="<?php echo esc_url( 'https://wordpress.org/', 'aurora' ); ?>">
					<?php
					/* translators: %s: CMS name, i.e. WordPress. */
					printf( esc_html( '%s', 'aurora' ), 'WordPress' );
					?>
				</a>
				<?php esc_html_e( ' and the ', 'aurora' ); ?>
				<a href="<?php echo esc_url( 'http://github.com/', 'aurora' ); ?>">
					<?php
					/* translators: %s: Author URI */
					printf( esc_html( '%s', 'aurora' ), 'Aurora Theme' );
					?>
				</a>
			</span>
		</div><!-- .site-info -->

	</footer><!-- .site-footer (opened  in header.php ) -->

</div><!-- .site (opened in header.php ) -->

<?php wp_footer(); ?>

</body>
</html>
