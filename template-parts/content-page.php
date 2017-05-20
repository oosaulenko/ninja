<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Mudita
 */

global $post;
$sidebar_layout = get_post_meta( $post->ID, 'mudita_sidebar_layout', true );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    <?php if( has_post_thumbnail() ){ ?>
    <div class="post-thumbnail">

        
    </div>
    <?php }?>
    
	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
