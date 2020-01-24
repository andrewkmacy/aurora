<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Aurora
 * @since 5.0.0
 * @version 5.0.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header-page" role="banner">
	</header><!-- .entry-header-page -->

	<?php aurora_post_thumbnail(); ?>

	<div class="entry-content">
		<?php the_content(); ?>

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

	<?php if ( get_edit_post_link() ) { ?>
		<footer class="entry-footer" role="contentinfo">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'aurora' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php } ?>

</article><!-- #post-<?php the_ID(); ?> -->
