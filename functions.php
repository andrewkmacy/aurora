<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Aurora
 * @since 5.0.0
 * @version 5.0.0
 */

if ( ! function_exists( 'aurora_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function aurora_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Ukuqala, use a find and replace
		 * to change 'aurora' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'aurora', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Add styling for tiny-mce editor.
		 */
		add_editor_style( 'editor-style.css' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * The theme uses wp_nav_menu() in two locations.
		 */
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary', 'aurora' ),
				'footer'  => esc_html__( 'Footer', 'aurora' ),
			)
		);

		/*
		 * Switch default core markup for comment form, gallery, captions
		 * and comments to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'aurora_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);
		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 100,
				'width'       => 100,
				'flex-width'  => false,
				'flex-height' => false,
			)
		);

		/**
		 * Block Editor.
		 * Add support for full and wide align images.
		 */
		add_theme_support( 'align-wide' );

		/**
		 * Block Editor.
		 * Add support for Block Styles.
		 */
		add_theme_support( 'wp-block-styles' );

	}

	add_action( 'after_setup_theme', 'aurora_setup' );
}

if ( ! function_exists( 'aurora_content_width' ) ) {
	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global int $content_width
	 */
	function aurora_content_width() {
		// This variable is intended to be overruled from themes.
		// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
		// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound.
		$GLOBALS['content_width'] = apply_filters( 'aurora_content_width', 960 );
	}
	add_action( 'after_setup_theme', 'aurora_content_width', 0 );
}

if ( ! function_exists( 'aurora_widgets_init' ) ) {
	/**
	 * Register widget area.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	 */
	function aurora_widgets_init() {
		register_sidebar(
			array(
				'name'          => esc_html__( 'Sidebar 1', 'aurora' ),
				'id'            => 'sidebar-1',
				'description'   => esc_html__( 'Main sidebar.', 'aurora' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);
		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer 1', 'aurora' ),
				'id'            => 'footer-1',
				'description'   => esc_html__( 'First of 3 footer widgets.', 'aurora' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);
		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer 2', 'aurora' ),
				'id'            => 'footer-2',
				'description'   => esc_html__( 'Second of 3 footer widgets.', 'aurora' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);
		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer 3', 'aurora' ),
				'id'            => 'footer-3',
				'description'   => esc_html__( 'Third of 3 footer widgets.', 'aurora' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);
		register_sidebar(
			array(
				'name'          => esc_html__( 'Single Page 1', 'aurora' ),
				'id'            => 'single-1',
				'description'   => esc_html__( 'First of 2 single page widgets.', 'aurora' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);
		register_sidebar(
			array(
				'name'          => esc_html__( 'Single Page 2', 'aurora' ),
				'id'            => 'single-2',
				'description'   => esc_html__( 'Second of 2 single page widgets.', 'aurora' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);
	}
	add_action( 'widgets_init', 'aurora_widgets_init' );
}

if ( ! function_exists( 'aurora_scripts' ) ) {
	/**
	 * Enqueue scripts and styles.
	 */
	function aurora_scripts() {
		wp_enqueue_style( 'aurora-style', get_stylesheet_uri(), array(), '5.0.0' );

		wp_enqueue_script( 'aurora-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '5.0.0', true );
		wp_enqueue_script( 'aurora-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '5.0.0', true );

		wp_enqueue_script( 'aurora-fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array( 'jquery' ), '5.0.0', true );
		wp_enqueue_script( 'aurora-fitvids-init', get_template_directory_uri() . '/js/jquery.fitvids-init.js', array( 'jquery' ), '5.0.0', true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
	add_action( 'wp_enqueue_scripts', 'aurora_scripts' );
}

if ( ! function_exists( 'aurora_block_editor_styles' ) ) {
	/**
	 * Enqueue WordPress theme styles within the block editor.
	 */
	function aurora_block_editor_styles() {
		// Load the theme styles within the block editor.
		wp_enqueue_style( 'aurora-block-editor', get_theme_file_uri( 'block-editor-style.css' ), array(), '5.0.0', false );
	}
	add_action( 'enqueue_block_editor_assets', 'aurora_block_editor_styles' );
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Custom header.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Text Radio Customizer Control Class.
 */
require get_template_directory() . '/inc/class-aurora-text-radio-button-control.php';
