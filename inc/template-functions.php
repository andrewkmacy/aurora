<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package WordPress
 * @subpackage Aurora
 * @since 5.0.0
 * @version 5.0.0
 */

if ( ! function_exists( 'aurora_body_classes' ) ) {
	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 * @return array
	 */
	function aurora_body_classes( $classes ) {
		
		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		// Adds class for sidebar position selection in Customizer.
		if ( 'none' === get_theme_mod( 'aurora_sidebar_position_setting', 'none' ) ) {
			$classes[] = 'sidebar-none';
		} elseif ( 'left' === get_theme_mod( 'aurora_sidebar_position_setting', 'none' ) ) {
			if ( ! have_posts() ) {
				$classes[] = 'sidebar-none';
			} else {
				$classes[] = 'sidebar-left';
			}
		} elseif ( 'right' === get_theme_mod( 'aurora_sidebar_position_setting', 'none' ) ) {
			if ( ! have_posts() ) {
				$classes[] = 'sidebar-none';
			} else {
				$classes[] = 'sidebar-right';
			}
		}

		return $classes;
	}
	add_filter( 'body_class', 'aurora_body_classes' );
}


if ( ! function_exists( 'aurora_pingback_header' ) ) {
	/**
	 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
	 */
	function aurora_pingback_header() {
		if ( is_singular() && pings_open() ) {
			echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
		}
	}
	add_action( 'wp_head', 'aurora_pingback_header' );
}

if ( ! function_exists( 'aurora_footer_widgets' ) ) {
	/**
	 * Add dynamic widget areas in footer.
	 */
	function aurora_footer_widgets() {

		$widget_area    = sanitize_html_class( 'footer-widget-area' );
		$widget         = sanitize_html_class( 'widget-area-' );
		$sidebar_prefix = 'footer-';

		$active = 0;

		for ( $count = 1; $count <= 3; $count++ ) {
			$sidebar  = $sidebar_prefix;
			$sidebar .= (int) $count;
			if ( is_active_sidebar( $sidebar ) ) {
				$active++;
			}
		}

		if ( $active > 0 ) {
			echo '<aside class="' . esc_attr( $widget_area ) . '" role="complementary">';
		} else {
			return;
		}

		if ( $active > 0 ) {
			$widget .= (int) $active;
			for ( $count = 1; $count <= 3; $count++ ) {
				$sidebar  = $sidebar_prefix;
				$sidebar .= (int) $count;
				if ( is_active_sidebar( $sidebar ) ) {
					echo '<div class="widget ' . esc_attr( $widget ) . '">';
					dynamic_sidebar( $sidebar );
					echo '</div><!-- .widget-area-? -->';
				}
			}
		}
		echo '</aside><!-- .footer-widget-area -->';
	}
}

if ( ! function_exists( 'aurora_single_widgets' ) ) {
	/**
	 * Add dynamic widget areas in below header.
	 */
	function aurora_single_widgets() {

		$widget_area    = sanitize_html_class( 'single-widget-area' );
		$widget         = sanitize_html_class( 'widget-area-' );
		$sidebar_prefix = 'single-';

		$active = 0;

		for ( $count = 1; $count <= 2; $count++ ) {
			$sidebar  = $sidebar_prefix;
			$sidebar .= (int) $count;
			if ( is_active_sidebar( $sidebar ) ) {
				$active++;
			}
		}

		if ( $active > 0 ) {
			echo '<aside class="' . esc_attr( $widget_area ) . '" role="complementary">';
		} else {
			return;
		}

		if ( $active > 0 ) {
			$widget .= (int) $active;
			for ( $count = 1; $count <= 2; $count++ ) {
				$sidebar  = $sidebar_prefix;
				$sidebar .= (int) $count;
				if ( is_active_sidebar( $sidebar ) ) {
					echo '<div class="widget ' . esc_attr( $widget ) . '">';
					dynamic_sidebar( $sidebar );
					echo '</div><!-- .widget-area-? -->';
				}
			}
		}
		echo '</aside><!-- .single-widget-area -->';
	}
}
if ( ! function_exists( 'aurora_comment_args' ) ) {
	/**
	 * Sets arguments for comments
	 * Sets comment policy, the reply title on the comment form as well as sets the textarea to required.
	 */
	function aurora_comment_args() {
		$commenter = wp_get_current_commenter();
		$req       = get_option( 'require_name_email' );
		$aria_req  = ( $req ? " aria-required='true'" : '' );

		$fields            = array(
			'author' => '<p class="comment-form-author"><label for="author">' . __( 'Name', 'aurora' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '<br /><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
			'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email', 'aurora' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
			'<br /><input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
			'url'    => '<p class="comment-form-url"><label for="url">' . __( 'Website', 'aurora' ) . '</label> <br /><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
		);
		$consent           = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';
		$fields['cookies'] = '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' /><label for="wp-comment-cookies-consent" class="consent-label">' . __( 'Save my name, email, and website in this browser for the next time I comment.', 'aurora' ) . '</label></p>';

		if ( isset( $args['fields'] ) && ! isset( $args['fields']['cookies'] ) ) {
			$args['fields']['cookies'] = $fields['cookies'];
		}
		if ( get_comments_number() ) {
			$reply = __( 'Join the Conversation', 'aurora' );
		} else {
			$reply = __( 'Start the Conversation', 'aurora' );
		}
		$comments_args = array(
			'title_reply'         => $reply,
			'comment_notes_after' => '',
			'comment_field'       => '<p style="margin-bottom: 0;" class="comment-form-comment"><label for="comment">' . __( 'Comment', 'aurora' ) . '<span class="required"> *</span></label><br /><textarea id="comment" name="comment" aria-required="true"></textarea></p>',
			'fields'              => apply_filters( 'aurora_comment_form_default_fields', $fields ),
		);
		comment_form( $comments_args );

	}
	add_action( 'aurora_comment_args', 'aurora_comment_args' );
}

if ( ! function_exists( 'aurora_filter_login_head' ) ) {
	/**
	 * Can only happen if there is a custom logo
	 */
	if ( has_custom_logo() ) {
		/**
		 * Adds custom logo to WordPress login page.
		 */
		function aurora_filter_login_head() {
				$image = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );?>
				<style type="text/css">
					.login h1 a {
						background-image: url(<?php echo esc_url( $image[0] ); ?>);
						-webkit-background-size: <?php echo absint( $image[1] ); ?>px;
						background-size: <?php echo absint( $image[1] ); ?>px;
						height: <?php echo absint( $image[2] ); ?>px;
						width: <?php echo absint( $image[1] ); ?>px;
					}
				</style>
			<?php
		}
		add_action( 'login_head', 'aurora_filter_login_head', 100 );
	}
}

if ( ! function_exists( 'aurora_add_search_form' ) ) {
	/**
	 * Appends search form to primary menu.
	 *
	 * @param string   $items The HTML list content for the menu items.
	 * @param stdClass $args An object containing wp_nav_menu() arguments.
	 * @return string returns string with search-form added.
	 */
	function aurora_add_search_form( $items, $args ) {
		if ( 'primary' === $args->theme_location ) {
			$form   = get_search_form( false );
			$items .= '<li class="search">' . $form . '</li>';
		}
		return $items;
	}
	add_filter( 'wp_nav_menu_items', 'aurora_add_search_form', 10, 2 );
}

if ( ! function_exists( 'aurora_prepend_custom_logo_to_title' ) ) {
	/**
	 * Pre-pends custom logo to site-title.
	 */
	function aurora_prepend_custom_logo_to_title() {

		$custom_logo_id              = get_theme_mod( 'custom_logo' );
		$image                       = wp_get_attachment_image_src( $custom_logo_id, 'full' );
		$aurora_title_background_image = $image[0];

		if ( is_rtl() ) {
			$css = '.wp-custom-logo .site-title a {background-image: url("%1$s");background-size: 32px 32px;background-position: right center;background-repeat: no-repeat;padding-right: 37px;}';
		} else {
			$css = '.wp-custom-logo .site-title a {background-image: url("%1$s");background-size: 32px 32px;background-position: left center;background-repeat: no-repeat;padding-left: 37px;}';
		}

		wp_add_inline_style( 'aurora-style', sprintf( $css, $aurora_title_background_image ) );
	}
	add_action( 'wp_enqueue_scripts', 'aurora_prepend_custom_logo_to_title', 11 );
}

if ( ! function_exists( 'aurora_custom_required' ) ) {
	/**
	 * Customize required field labels on JetPack contact form.
	 */
	function aurora_custom_required() {
		return __( ' *', 'aurora' );
	}
	add_filter( 'jetpack_required_field_text', 'aurora_custom_required' );
}

if ( ! function_exists( 'aurora_create_copyright' ) ) {
	/**
	 * Create a copyright notice.
	 */
	function aurora_create_copyright() {
		echo '<span class="aurora-copyright">';
		esc_html_e( 'Copyright &copy; ', 'aurora' );
		echo esc_html( date( 'Y' ) );
		esc_attr_e( ' - ', 'aurora' );
		echo esc_html( get_bloginfo( 'name' ) );
		echo '</span>';
	}
}

if ( ! function_exists( 'aurora_block_editor_color_palette' ) ) {
	/**
	 * Adds a custom color palette in the block editor.
	 */
	function aurora_block_editor_color_palette() {
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => esc_html__( 'White', 'aurora' ),
					'slug'  => 'white',
					'color' => '#ffffff',
				),
				array(
					'name'  => esc_html__( 'Lightest Grey', 'aurora' ),
					'slug'  => 'lightest-grey',
					'color' => '#f5f5f5',
				),
				array(
					'name'  => esc_html__( 'Lighter Grey', 'aurora' ),
					'slug'  => 'lighter-grey',
					'color' => '#d1d1d1',
				),
				array(
					'name'  => esc_html__( 'Light Grey', 'aurora' ),
					'slug'  => 'light-grey',
					'color' => '#575757',
				),
				array(
					'name'  => esc_html__( 'Red', 'aurora' ),
					'slug'  => 'red',
					'color' => '#a30f1e',
				),
				array(
					'name'  => esc_html__( 'Blue', 'aurora' ),
					'slug'  => 'blue',
					'color' => '#15587e',
				),
				array(
					'name'  => esc_html__( 'Black', 'aurora' ),
					'slug'  => 'black',
					'color' => '#000000',
				),
			)
		);
	}
	add_action( 'after_setup_theme', 'aurora_block_editor_color_palette' );
}

if ( ! function_exists( 'aurora_custom_excerpt_length' ) ) {
	if ( ! is_admin() ) {
		/**
		 * Filter the except length to 25 words.
		 *
		 * @param int $length Excerpt length.
		 * @return int (Maybe) modified excerpt length.
		 */
		function aurora_custom_excerpt_length( $length ) {
			return 25;
		}
		add_filter( 'excerpt_length', 'aurora_custom_excerpt_length', 999 );
	}
}

if ( ! function_exists( 'aurora_excerpt_more' ) ) {
	if ( ! is_admin() ) {
		/**
		 * Filter ending of excerpt.
		 *
		 * @param string $more The string shown within the more link.
		 * @return string.
		 */
		function aurora_excerpt_more( $more ) {
			return '...';
		}
		add_filter( 'excerpt_more', 'aurora_excerpt_more' );
	}
}

if ( ! function_exists( 'aurora_alt_custom_header' ) ) {
	/**
	 * Change alt attribute of custom header.
	 *
	 * @param string $html The HTML image tag markup being filtered.
	 * @param object $header The custom header object returned by 'get_custom_header()'.
	 * @param array  $attr Array of the attributes for the image tag.
	 * @return $html.
	 */
	function aurora_alt_custom_header( $html, $header, $attr ) {
		return '<figure><img src="' . $attr['src'] . '" width="' . $attr['width'] . '" height="' . $attr['height'] . '" alt="' . esc_attr__( 'Custom header for ', 'aurora' ) . $attr['alt'] . '" srcset="' . $attr['srcset'] . '" sizes="' . $attr['sizes'] . '"></figure>';
	};
	add_filter( 'get_header_image_tag', 'aurora_alt_custom_header', 10, 3 );
}

function theme_get_customizer_css() {
	ob_start();

	$color__primary_background = get_theme_mod( '$color__primary_background', '' );
	if ( ! empty( $color__primary_background ) ) {
		?>
		body {
			color: <?php echo $color__primary_background; ?>;
		}
		<?php
	}

	$color__primary = get_theme_mod( '$color__primary', '' );
	if ( ! empty( $color__primary ) ) {
		?>
		body {
			color: <?php echo $color__primary; ?>;
		}
		<?php
	}
	
	$color__link = get_theme_mod( 'color__link', '' );
	if ( ! empty( $color__link ) ) {
		?>
		a {
			color: <?php echo $color__link; ?>;
			border-bottom-color: <?php echo $color__link; ?>;
		}
		<?php
	}
	
	$color__border = get_theme_mod( '$color__border', '' );
	if ( ! empty( $color__border ) ) {
		?>
		input,
		textarea {
			border-color: <?php echo $color__border; ?>;
		}
		<?php
	}

	$color__secondary = get_theme_mod( '$color__secondary', '' );
	if ( ! empty( $color__secondary ) ) {
		?>
		a:hover {
			color: <?php echo $color__secondary; ?>;
			border-bottom-color: <?php echo $color__secondary; ?>;
		}

		button,
		input[type="submit"] {
			background-color: <?php echo $color__secondary; ?>;
		}
		<?php
	}

	$css = ob_get_clean();
	return $css;
}

// Modify our styles registration like so:

function theme_enqueue_styles() {
wp_enqueue_style( 'theme-styles', get_stylesheet_uri() ); // This is where you enqueue your theme's main stylesheet
$custom_css = theme_get_customizer_css();
wp_add_inline_style( 'theme-styles', $custom_css );
}

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
