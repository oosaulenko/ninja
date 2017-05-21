<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Mr.OWL
 */

//$sidebar_layout = mrowl_sidebar_layout();

get_header(); ?>
	<div id="l-page">
	<div id="l-inner">
		<div class="header_page">
			<h1 class="main_title_page"><?php echo get_the_title(); ?></h1>
		</div>
		<div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
			<?php if(function_exists('bcn_display'))
			{
				bcn_display();
			}?>
		</div>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );
            
			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
	</div><!-- #primary -->
	</div><!-- #primary -->

<?php
get_footer();
