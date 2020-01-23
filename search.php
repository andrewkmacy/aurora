<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage Aurora
 * @since 5.0.0
 * @version 5.0.0
 */

get_header();?>

	<section id="primary" class="content-area">

		<main id="main" class="site-main" role="main">

		<!-- The strlen bit on the line below prevents an empty search from returning all the posts. -->
		<?php if ( have_posts() ) { ?>

			<header class="page-header" role="banner">
				<h1 class="page-title">
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', 'aurora' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'search' );

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

	</section><!-- .content-area -->

<?php
get_sidebar();
get_footer();
