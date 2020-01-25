<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package WordPress
 * @subpackage Aurora
 * @since 5.0.0
 * @version 5.0.0
 */

if ( ! function_exists( 'aurora_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function aurora_entry_posted_on() {
		$aurora_time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';

		$aurora_time_string = sprintf(
			$aurora_time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$aurora_posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted: %s', 'post date', 'aurora' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $aurora_time_string . '</a>'
		);

		echo '<span class="posted-on">' . wp_kses_post( $aurora_posted_on ) . '</span>';
	}
endif;

if ( ! function_exists( 'aurora_entry_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function aurora_entry_posted_by() {
		$aurora_byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'Author: %s', 'post author', 'aurora' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . wp_kses_post( $aurora_byline ) . '</span>';

	}
endif;

if ( ! function_exists( 'aurora_author_avatar' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function aurora_author_avatar() {
		$aurora_intro  = esc_html__( 'Published by ', 'aurora' );
		$aurora_avatar = get_avatar( get_the_author_meta( 'ID' ), 48 );
		$aurora_author = sprintf(
			/* translators: %s: post author. */
			'%s',
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline">' . wp_kses_post( $aurora_intro ) . '</span> <span class="author-avatar">' . wp_kses_post( $aurora_avatar ) . '</span> <span class="author-name">' . wp_kses_post( $aurora_author ) . '</span>';

	}
endif;

if ( ! function_exists( 'aurora_entry_categories' ) ) :
	/**
	 * Prints HTML with meta information for the categories link(s).
	 */
	function aurora_entry_categories() {
		// Hide category for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$aurora_categories_list = get_the_category_list( esc_html__( ', ', 'aurora' ) );
			if ( $aurora_categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Categories: %1$s', 'aurora' ) . '</span>', wp_kses_post( $aurora_categories_list ) ); // WPCS: XSS OK.
			}
		}
	}
endif;

if ( ! function_exists( 'aurora_entry_tags' ) ) :
	/**
	 * Prints HTML with meta information for the tags link(s).
	 */
	function aurora_entry_tags() {
		// Hide tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$aurora_tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'aurora' ) );
			if ( $aurora_tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tags: %1$s', 'aurora' ) . '</span>', wp_kses_post( $aurora_tags_list ) ); // WPCS: XSS OK.
			}
		}
	}
endif;

if ( ! function_exists( 'aurora_entry_comments' ) ) :
	/**
	 * Prints HTML with meta information for the comments link.
	 */
	function aurora_entry_comments() {
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'aurora' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}
	}
endif;

if ( ! function_exists( 'aurora_entry_edit_link' ) ) :
	/**
	 * Prints HTML with meta information for the edit link.
	 */
	function aurora_entry_edit_link() {
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
	}
endif;

if ( ! function_exists( 'aurora_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function aurora_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		// is_singular returns true on single and page.
		if ( is_singular() ) : ?>

			<div class="post-thumbnail-singular">
				<?php the_post_thumbnail( 'full' ); ?>
			</div><!-- .post-thumbnail-singular -->

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'large' ); ?>
			</a>

			<?php
		endif;
	}
endif;
