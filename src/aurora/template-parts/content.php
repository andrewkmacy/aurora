<?php
/**
 * Template part for displaying posts
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

	<header class="entry-header-archive" role="banner"> 

		<div class="entry-title-archive">
			<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
		</div><!-- .entry-title-archive -->

		<div class="entry-date-archive">
			<?php aurora_entry_posted_on(); ?>
		</div><!-- ,entry-date-archive -->

		<div class="entry-categories-archive">
			<?php aurora_entry_categories(); ?>
			<?php aurora_entry_tags(); ?>
		</div><!-- .entry-categories-archive -->

		<div class="entry-featured-archive">
			<?php aurora_post_thumbnail(); ?>
		</div><!-- .entry-featured-archive -->

	</header><!-- .entry-header-archive -->

	<div class="entry-content-archive">
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
	</div><!-- .entry-content-archive -->

	<footer class="entry-footer-archive" role="contentinfo">

		<div class="entry-author-archive">
			<?php aurora_entry_posted_by(); ?>
		</div><!-- .entry-author-archive -->

		<div class="entry-comments-archive">
			<?php aurora_entry_comments(); ?>
			<?php aurora_entry_edit_link(); ?>
		</div><!-- .entry-comments-archive -->

	</footer><!-- .entry-footer-archive -->

</article><!-- #post-<?php the_ID(); ?> -->
