<?php
/**
 * Template part for displaying posts on single pages
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
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header-single" role="banner">

		<div class="entry-date-single">
			<?php aurora_entry_posted_on(); ?>
		</div><!-- entry-date-single -->

		<div class="entry-categories-single">
			<?php aurora_entry_categories(); ?>
			<?php aurora_entry_tags(); ?>
		</div><!-- entry-categories-single -->

	</header><!-- .entry-header-single -->

	<div class="entry-title-single">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</div><!-- .entry-title-single -->

	<?php aurora_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
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

	</div><!-- .entry-content -->

	<footer class="entry-footer-single" role="contentinfo">
		<?php aurora_author_avatar(); ?>
	</footer><!-- .entry-footer-single -->

</article><!-- #post-<?php the_ID(); ?> -->
