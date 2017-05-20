<?php
/**
 * Template Name: Шаблон Корзины
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Mudita
 */

get_header();
?>
<script src="//cdnjs.cloudflare.com/ajax/libs/gsap/1.18.0/TweenMax.min.js"></script>
<script src="//s3-us-west-2.amazonaws.com/s.cdpn.io/16327/DrawSVGPlugin.js?r=12"></script>

<!--<script src="--><?php //print get_template_directory_uri(); ?><!--/js/cart.js"></script>-->

<style>
    svg {
        width: 100%;
        height: 100vh;
    }
</style>

<div id="l-page">
    <?php
    while ( have_posts() ) : the_post();
    the_content();
    endwhile; // End of the loop.
    ?>
</div>

<script src="<?php print get_template_directory_uri(); ?>/js/cart.js"></script>

<?php get_footer(); ?>
