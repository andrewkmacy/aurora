<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'single' );

			aurora_single_widgets();

			the_post_navigation(
				array(
					'prev_text'          => __( 'Previous Post: %title', 'aurora' ),
					'next_text'          => __( 'Next Post: %title', 'aurora' ),
					'screen_reader_text' => __( 'Continue Reading', 'aurora' ),
				)
			);

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile;
		?>

		</main><!-- .site-main -->

	</div><!-- .content-area -->

<?php
get_sidebar();
get_footer();
