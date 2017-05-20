<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Mudita
 */

?>
<div id="l-page">
	<div id="l-inner">
		<div class="header_page">
			<h1 class="main_title_page main_title_page_post"><?php echo get_the_title(); ?></h1>
			<span class="line_page"></span>
		</div>

		<div class="entry-post" id="post-<?php the_ID(); ?>">

			<?php
			if( is_single() ){
				the_content( sprintf(
				/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'mudita' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );
			}else{
				if( false === get_post_format() ){
					the_excerpt();
				}else{
					the_content( sprintf(
					/* translators: %s: Name of current post. */
						wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'mudita' ), array( 'span' => array( 'class' => array() ) ) ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					) );
				}
			}
			?>
		</div>
	</div>
</div>