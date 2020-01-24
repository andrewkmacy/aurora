<?php
/**
 * Template Name: Full Width
 *
 * This template will show the relevant page as full-width
 * even if left or right sidebars have been selected in the Customizer.
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
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile;
			?>

		</main><!-- .site-main -->

	</div><!-- .content-area -->

<?php
get_footer();
