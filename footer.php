<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Mr.OWL
 */
?>

<div class="modal" id="formModal">
    <div class="form_modal_block">
        <?php print do_shortcode('[ninja_form id=3]'); ?>
    </div>
    <div class="modal-close"></div>
</div>

<script>$('.modal').modal();</script>

<?php wp_footer(); ?>
</body>
</html>