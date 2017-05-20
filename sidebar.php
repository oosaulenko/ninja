<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Mr.OWL
 */

if ( ! is_active_sidebar( 'right-sidebar' ) || is_search() ) {
	return;
}
?>

<aside id="secondary" class="widget-area" role="complementary"></aside><!-- #secondary -->
