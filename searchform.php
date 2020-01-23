<?php
/**
 * Template for displaying search forms in Aurora
 *
 * Do not modify this code, please use a child theme to make changes.
 *
 * @package WordPress
 * @subpackage Aurora
 * @since 5.0.0
 * @version 5.0.0
 */

?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php esc_html_e( 'Search for', 'aurora' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr__( 'Search &hellip;', 'aurora' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	</label>
	<button type="submit" class="search-submit"><?php esc_attr_e( 'Submit', 'aurora' ); ?></button>
</form>
