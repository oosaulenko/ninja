<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Mudita
 */
?>

<div class="modal" id="formModal">
    <div class="form_modal_block">
        <?php print do_shortcode('[ninja_form id=3]'); ?>
    </div>
</div>

<footer id="l-footer">
    <div id="l-inner">

    </div>
</footer>

<script>
    $('.modal').modal();
</script>
<?php wp_footer(); ?>
</body>
</html>