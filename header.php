<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Mudita
 */

?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width">
    <?php wp_head(); ?>
    <link rel="stylesheet" href="<?php print get_template_directory_uri(); ?>/owlcarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php print get_template_directory_uri(); ?>/owlcarousel/owl.theme.default.min.css">
</head>

<body <?php body_class(); ?>>
<header id="l-header">
    <div class="phone">
        <div class="num">+38</div>
        <div class="operators" id="phone_slider">
            <div class="v vodafone"><span>095</span></div>
            <div class="kievstar"><span>068</span></div>
            <div class="lifecell"><span>073</span></div>
        </div>
        <div class="num">643-62-62</div>
    </div>
    <button class="button" data-target="formModal">Обратный звонок</button>
</header>
<nav id="l-nav">
    <ul>
        <li class="title_menu" id="buttonMenu">
            <div id="menu-toggle">
                <div id="hamburger">
                    <b></b>
                    <b></b>
                    <b></b>
                </div>
                <div id="cross">
                    <b></b>
                    <b></b>
                </div>
            </div>
            <span>Меню</span>
        </li>
        <?php wp_nav_menu(array(
            'menu' => 'primary',
            'container'       => '',
            'menu_class'      => '',
            'link_before' => '<span>',
            'link_after' => '</span>',
            'items_wrap' => '%3$s'
        )); ?>
        <li id="menu-item-25" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-25">
            <input type="hidden" id="countCartNum" value="<?php print WC()->cart->get_cart_contents_count(); ?>">
            <a href="http://ninja.com.ua/cart/"><i id="countCartNumShow"><?php print WC()->cart->get_cart_contents_count(); ?></i><span>Коробка</span></a>
        </li>
    </ul>
</nav>


<ul id="slide-out" class="side-nav">
    <li class="title_menu">Меню:</li>
    <li>
        <?php wp_nav_menu( array( 'theme_location' => 'primary', 'items_wrap' => '<ul><li id="item-id">Список: </li>%3$s</ul>' ) ); ?>
        <?php wp_nav_menu(array('theme_location' => 'secondary')); ?>
    </li>
</ul>

