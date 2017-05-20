<?php
/**
 * Template Name: Шаблон Доставка
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Mudita
 */

get_header();
$main_pages = get_the_ID();
?>
<div id="l-page">
    <section class="section-delivery">
        <div id="l-inner">
            <div class="block_delivery">
                <div class="col col-info">
                    <h3 class="title">Доставка</h3>
                    <div class="text">
                        Наши курьеры доставляют пиццу во все районы города. Время доставки может различатся в зависимости от удаления от нашей пиццерии. Подробности можно узнать у нашего оператора при оформлении заказа.
                    </div>
                </div>
                <div class="col col-time">
                    <div class="title">Среднее время доставки</div>
                    <div class="time">
                        <div class="icon"></div>
                        <div class="num">
                            <b>30</b>
                            <span>минут</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="block_pay">
                <h3 class="title">Способы оплаты</h3>
                <div class="method_pay">
                    <div class="item">
                        <div class="icon icon-coin"></div>
                        <div class="name">Наличными</div>
                        <div class="text">
                            Оплата наличными при
                            получении товара
                        </div>
                    </div>
                    <div class="item">
                        <div class="icon icon-card"></div>
                        <div class="name">Visa и MasterCard</div>
                        <div class="text">
                            Оплата заказа
                            банковской картой Visa
                            и MasterCard онлайн
                            или при получении товара
                        </div>
                    </div>
                    <div class="item">
                        <div class="icon icon-phone"></div>
                        <div class="name">Liqpay</div>
                        <div class="text">
                            Оплата заказа через
                            платежную систему

                            <a href="https://www.liqpay.com/" target="_blank"><img src="<?php print get_template_directory_uri(); ?>/img/icon/pay/liqpay.png" alt="liqpay"></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>

<?php get_footer(); ?>
