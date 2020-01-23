<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Aurora
 * @since 5.0.0
 * @version 5.0.0
 */

get_header();?>

	<div id="primary" class="content-area">

		<main id="main" class="site-main" role="main">

			<?php if ( have_posts() ) { ?>

				<header class="page-header" role="banner">
					<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
					?>
				</header><!-- .page-header -->

				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content', get_post_type() );

				endwhile;

				if ( 'pagination' === get_theme_mod( 'aurora_pagination_navigation_setting', 'pagination' ) ) {
					?>
					<div class="posts-pagination">
						<?php
						the_posts_pagination(
							array(
								'mid_size'  => 1,
								'prev_text' => '&#60;',
								'next_text' => '&#62;',
							)
						);
						?>
					</div><!-- .posts-pagination -->
				<?php } else { ?>
					<div class="posts-navigation">
						<?php the_posts_navigation(); ?>
					</div><!-- .posts-navigation -->
				<?php } ?>

				<?php
			} else {

				get_template_part( 'template-parts/content', 'none' );
				?>

			<?php } ?>

		</main><!-- .site-main -->

	</div><!-- .content-area -->

<?php
get_sidebar();
get_footer();
