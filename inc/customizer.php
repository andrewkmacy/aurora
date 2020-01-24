<?php
/**
 * Theme Customizer
 *
 * @package WordPress
 * @subpackage Aurora
 * @since 5.0.0
 * @version 5.0.0
 */
if ( ! function_exists( 'aurora_customize_register' ) ) {
	/**
	 * Customizer register.
	 *
	 * @param array $wp_customize Main class that makes it all work..
	 */
	 
	function aurora_customize_register( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
		$wp_customize->remove_control('background_color');

/** custom colors
*
*/

		// Background color
		$wp_customize->add_setting( '$color__primary_background', array(
		'default'   => '#ODOFOE',
		'transport' => 'refresh',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, '$color__primary_background', array(
		'section' => 'colors',
		'label'   => esc_html__( 'Background color', 'theme' ),
		) ) );

		// Text color
		$wp_customize->add_setting( '$color__primary', array(
		'default'   => '#CCCCCC',
		'transport' => 'refresh',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, '$color__primary', array(
		'section' => 'colors',
		'label'   => esc_html__( 'Text color', 'theme' ),
		) ) );
		
		// Link color
		$wp_customize->add_setting( '$color__link', array(
		'default'   => '#409940',
		'transport' => 'refresh',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, '$color__link', array(
		'section' => 'colors',
		'label'   => esc_html__( 'Link color', 'theme' ),
		) ) );

		// Link hover color
		$wp_customize->add_setting( '$color__secondary', array(
		'default'   => '#326344',
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, '$color__secondary', array(
		'section' => 'colors',
		'label'   => esc_html__( 'Link hover color', 'theme' ),
		) ) );

		// Border color
		$wp_customize->add_setting( '$color__border', array(
		'default'   => '#40384d',
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, '$color__border', array(
		'section' => 'colors',
		'label'   => esc_html__( 'Border color', 'theme' ),
		) ) );

		/**
		 * Add section for use by theme settings
		 */
		$wp_customize->add_section(
			'aurora_options_section',
			array(
				'title'    => __( 'Theme Options', 'aurora' ),
				'priority' => 35,
			)
		);
		$wp_customize->add_setting(
			'aurora_sidebar_position_setting',
			array(
				'default'           => 'none',
				'transport'         => 'refresh',
				'sanitize_callback' => 'aurora_radio_text_sanitization',
			)
		);
		$wp_customize->add_control(
			new aurora_Text_Radio_Button_Control(
				$wp_customize,
				'aurora_sidebar_position',
				array(
					'settings' => 'aurora_sidebar_position_setting',
					'section'  => 'aurora_options_section',
					'type'     => 'text_radio_button',
					'label'    => __( 'Sidebar Position', 'aurora' ),
					'choices'  => array(
						'none'  => __( 'None', 'aurora' ),
						'left'  => __( 'Left', 'aurora' ),
						'right' => __( 'Right', 'aurora' ),
					),
				)
			)
		);
		$wp_customize->add_setting(
			'aurora_post_content_setting',
			array(
				'default'           => 'excerpt',
				'transport'         => 'refresh',
				'sanitize_callback' => 'aurora_radio_text_sanitization',
			)
		);
		$wp_customize->add_control(
			new aurora_Text_Radio_Button_Control(
				$wp_customize,
				'aurora_post_content',
				array(
					'settings' => 'aurora_post_content_setting',
					'section'  => 'aurora_options_section',
					'type'     => 'text_radio_button',
					'label'    => __( 'Post Content on Archive Pages', 'aurora' ),
					'choices'  => array(
						'excerpt' => __( 'Excerpt', 'aurora' ),
						'more'    => __( 'More Link', 'aurora' ),
					),
				)
			)
		);
		$wp_customize->add_setting(
			'aurora_pagination_navigation_setting',
			array(
				'default'           => 'pagination',
				'transport'         => 'refresh',
				'sanitize_callback' => 'aurora_radio_text_sanitization',
			)
		);
		$wp_customize->add_control(
			new aurora_Text_Radio_Button_Control(
				$wp_customize,
				'aurora_pagination_navigation',
				array(
					'settings' => 'aurora_pagination_navigation_setting',
					'section'  => 'aurora_options_section',
					'type'     => 'text_radio_button',
					'label'    => __( 'Posts Navigation', 'aurora' ),
					'choices'  => array(
						'pagination' => __( 'Pagination', 'aurora' ),
						'navigation' => __( 'Navigation', 'aurora' ),
					),
				)
			)
		);
	}
	add_action( 'customize_register', 'aurora_customize_register' );
}

/**
 * Sanitize Callbacks
 */
if ( ! function_exists( 'aurora_text_sanitization' ) ) {
	/**
	 * Radio Text sanitization.
	 *
	 * @param  string $input Text to be sanitized.
	 * @return string $input Sanitized text.
	 */
	function aurora_radio_text_sanitization( $input ) {

		if ( strpos( $input, ',' ) !== false ) {
			$input = explode( ',', $input );
		}
		if ( is_array( $input ) ) {
			foreach ( $input as $key => $value ) {
				$input[ $key ] = sanitize_text_field( $value );
			}
			$input = implode( ',', $input );
		} else {
			$input = sanitize_text_field( $input );
		}

		return $input;

	}
}

/**
 * Binds JS handler to make Theme Customizer preview reload changes asynchronously.
 */
function aurora_customizer_preview() {
	wp_enqueue_script( 'aurora-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'jquery' ), '5.0.0', true );
}
add_action( 'customize_preview_init', 'aurora_customizer_preview' );

/**
 * Custom Control Styling.
 */
function aurora_customizer_custom_control_css() {
	?>

	<style>

		.text_radio_button_control:after {
			content: " ";
			display: block;
			clear: both;
		}

		.text_radio_button_control .radio-buttons {
			display: inline-block;
			border: 1px solid #f9f9fe;
		}

		.text_radio_button_control .radio-button-label {
			cursor: pointer;
			float: left;
		}

		.text_radio_button_control .radio-button-label > input {
			display: none;
		}

		.text_radio_button_control .radio-button-label span {
			cursor: pointer;
			font-weight: 500;
			border: 2px solid #f9f9fe;
			margin: 0;
			background-color: #eee;
			padding: 5px 15px 5px 15px;
			display: inline-block;
		}

		.text_radio_button_control .radio-button-label span:hover {
			background-color: rgba(255, 255, 255, .2);
			color: #2885bb;
		}

		.text_radio_button_control .radio-button-label > input:checked + span {
			background-color: #2084bd;
			color: #fff;
		}

		.text_radio_button_control .radio-button-label > input:checked + span:hover {
			color: #fff;
		}

	</style>
	<?php
}
add_action( 'customize_controls_print_styles', 'aurora_customizer_custom_control_css' );
