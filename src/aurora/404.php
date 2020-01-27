<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage Aurora
 * @since 5.0.0
 * @version 5.0.0
 */

get_header();
?>

	<div id="primary" class="content-area">

		<main id="main" class="site-main" role="main">

			<article class="error-404">

				<header class="page-header" role="banner">
					<?php $aurora_var_name = '"' . get_query_var( 'name' ) . '"'; ?>
					<h1 class="page-title"><?php esc_html_e( 'Sorry, we could not find the page ', 'aurora' ); ?><?php echo esc_html( $aurora_var_name ); ?></h1>
				</header><!-- .page-header -->

				<section class="page-content">
					<p><?php esc_html_e( 'The menus above or a search will assist you in finding that which you are looking for. You could just have typed the name of the page incorrectly but all the same, we will investigate the issue.', 'aurora' ); ?></p>
				</section><!-- .page-content -->

			</article><!-- .error-404-->

		</main><!-- #main -->

	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
