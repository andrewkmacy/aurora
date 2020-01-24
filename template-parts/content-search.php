<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Aurora
 * @since 5.0.0
 * @version 5.0.0
 */

?>

<!-- See /sass/0.variables/_options.scss for details on the class vertical margin -->
<article id="post-<?php the_ID(); ?>" <?php post_class( 'vertical-margin' ); ?>>

	<header class="entry-header-search" role="banner"> 

		<div class="entry-title-search">
			<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
		</div><!-- .entry-title-search -->

		<div class="entry-date-search">
			<?php aurora_entry_posted_on(); ?>
		</div><!-- ,entry-date-search -->

		<div class="entry-categories-search">
			<?php aurora_entry_categories(); ?>
			<?php aurora_entry_tags(); ?>
		</div><!-- .entry-categories-search -->

	</header><!-- .entry-header-search -->

	<div class="entry-content-search">
		<?php
		if ( 'excerpt' === get_theme_mod( 'aurora_post_content_setting', 'excerpt' ) ) {
			the_excerpt();
			?>
			<?php
		} else {
			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'aurora' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			?>

			<?php
			$aurora_args = array(
				'before'           => '<div class="page-links-XXX"><span class="page-link-text">' . __( 'More Pages: ', 'aurora' ) . '</span>',
				'after'            => '</div>',
				'link_before'      => '<span class="page-link">',
				'link_after'       => '</span>',
				'next_or_number'   => 'next',
				'separator'        => ' | ',
				'nextpagelink'     => __( 'Next &raquo', 'aurora' ),
				'previouspagelink' => __( '&laquo Previous', 'aurora' ),
			);

			wp_link_pages( $aurora_args );
			?>

		<?php } ?>
	</div><!-- .entry-content-search -->

	<footer class="entry-footer-search" role="contentinfo">

		<div class="entry-author-search">
			<?php aurora_entry_posted_by(); ?>
		</div><!-- .entry-author-search -->

		<div class="entry-comments-search">
			<?php aurora_entry_comments(); ?>
			<?php aurora_entry_edit_link(); ?>
		</div><!-- .entry-comments-search -->

	</footer><!-- .entry-footer-search -->

</article><!-- #post-<?php the_ID(); ?> -->
