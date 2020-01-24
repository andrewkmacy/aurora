<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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

		<?php
		if ( have_posts() ) {

			if ( is_home() && ! is_front_page() ) :
				?>
				<header role="banner">
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
				<?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
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

		<?php } else { ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php } ?>

		</main><!-- .site-main -->

	</div><!-- .content-area -->

<?php
get_sidebar();
get_footer();
