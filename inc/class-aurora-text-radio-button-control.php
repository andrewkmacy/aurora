<?php
/**
 * Class for text radio button custom control
 *
 * @package WordPress
 * @subpackage Aurora
 * @since 5.0.0
 * @version 5.0.0
 */

if ( class_exists( 'WP_Customize_Control' ) ) {

	/**
	 * Class for text radio button custom control
	 */
	class aurora_Text_Radio_Button_Control extends WP_Customize_Control {
		/**
		 * The type of control being rendered.
		 *
		 * @var none
		 */
		public $type = 'text_radio_button';
		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
			?>
			<div class="text_radio_button_control">
				<?php if ( ! empty( $this->label ) ) { ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>
				<?php if ( ! empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>

				<div class="radio-buttons">
					<?php foreach ( $this->choices as $key => $value ) { ?>
						<label class="radio-button-label">
							<input type="radio" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $key ); ?>" <?php $this->link(); ?> <?php checked( esc_attr( $key ), $this->value() ); ?>/>
							<span><?php echo esc_attr( $value ); ?></span>
						</label>
					<?php	} ?>
				</div>
			</div>
			<?php
		}
	}

}
