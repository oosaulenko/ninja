<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.3.8
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>
<div class="block_info_woocommerce">
    <div class="item active">
        <i class="i">1</i>
        <div class="name">Коробка</div>
    </div>
    <div class="item">
        <i class="i">2</i>
        <div class="name">Информация заказа</div>
    </div>
</div>
<form action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

    <?php do_action( 'ATocommerce_before_cart_table' ); ?>

    <div class="shop_table">
        <?php do_action( 'woocommerce_before_cart_contents' ); ?>

        <?php
        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
            $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
            $product_size   = apply_filters( 'woocommerce_cart_item_product_size', $cart_item['variation']['attribute_pa_size'], $cart_item, $cart_item_key );
            $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
//            print_r($cart_item['variation_id']);
            ?>
            <div class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
                <div class="item-image">
                    <?php
                    $image = get_post_meta($product_id, 'photo_persona', true);
                    $images = wp_get_attachment_image($image, 'full');
                    print $images;
                    ?>

                    <?php
                    $image = get_post_meta($product_id, 'photo_pizza', true);
                    $images = wp_get_attachment_image($image, 'full');
                    ?>
                    <div class="pizza"><?php print $images; ?></div>
                </div>
                <div class="item-info">
                    <h2 class="title"><?php echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;'; ?></h2>
                    <div class="infocart">
                        <div class="inner">
                            <div class="item">
                                <div class="info">
                                    <div class="name">Состав:</div>
                                    <?php
                                    foreach (get_post_meta( $product_id, 'ingredients', true ) as $item){
                                        print '<b>'.$item.'</b> ';
                                    }
                                    ?>

                                </div>
                            </div>
                            <div class="item">
                                <div class="info">
                                    <div class="name">Размер:</div>
                                    <b><?php print get_post_meta( $cart_item['variation_id'], '_length', true ); ?> см</b>
                                </div>
                            </div>

                            <div class="item">
                                <div class="info">
                                    <div class="name">Вес:</div>
                                    <b><?php print get_post_meta( $cart_item['variation_id'], '_weight', true ); ?> гр</b>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info_total">
                        <div class="price">
                            <div class="name">Цена:</div>
                            <div class="info"><?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?></div>
                        </div>
                        <div class="block_quantity">
                            <?php
                            if ( $_product->is_sold_individually() ) {
                                $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                            } else {
                                $product_quantity = woocommerce_quantity_input( array(
                                    'input_name'  => "cart[{$cart_item_key}][qty]",
                                    'input_value' => $cart_item['quantity'],
                                    'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
                                    'min_value'   => '0'
                                ), $_product, false );
                            }
                            echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
                            ?>
                        </div>
                        <div class="all_price">
                            <span class="name">Всего:</span>
                            <?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
                        </div>
                    </div>
                </div>
                <?php
                echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                    '<a href="%s" class="remove" title="%s" data-product_id="%s" data-product_sku="%s"><i></i></a>',
                    esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
                    __( 'Remove this item', 'woocommerce' ),
                    esc_attr( $product_id ),
                    esc_attr( $_product->get_sku() )
                ), $cart_item_key );
                ?>
            </div>

            <?php
//            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
//                $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
//                ?>
<!--                <div class="--><?php //echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?><!--">-->
<!---->
<!--                    <div class="product-section product-thumbnail">-->
<!--                        <div class="inner">-->
<!--                            --><?php
//                            $thumbnail = apply_filters( 'medium', $_product->get_image(), $cart_item, $cart_item_key );
//
//                            if ( ! $product_permalink ) {
//                                echo $thumbnail;
//                            } else {
//                                printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
//                            }
//                            ?>
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                    <div class="product-section product-name" data-title="--><?php //_e( 'Product', 'woocommerce' ); ?><!--">-->
<!--                        <div class="inner">-->
<!--                            --><?php
//                            if ( ! $product_permalink ) {
//                                echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;';
//                            } else {
//                                echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_title() ), $cart_item, $cart_item_key );
//                            }
//
//                            // Meta data
//                            echo WC()->cart->get_item_data( $cart_item );
//
//                            // Backorder notification
//                            if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
//                                echo '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>';
//                            }
//                            ?>
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                    <div class="product-section product-price" data-title="--><?php //_e( 'Price', 'woocommerce' ); ?><!--">-->
<!--                        <div class="inner">-->
<!--                            <div class="item">-->
<!--                                <div class="name">Цена:</div>-->
<!--                                <div class="info">--><?php //echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?><!--</div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                    <div class="product-section product-quantity" data-title="--><?php //_e( 'Quantity', 'woocommerce' ); ?><!--">-->
<!--                        <div class="inner">-->
<!--                            --><?php
//                            if ( $_product->is_sold_individually() ) {
//                                $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
//                            } else {
//                                $product_quantity = woocommerce_quantity_input( array(
//                                    'input_name'  => "cart[{$cart_item_key}][qty]",
//                                    'input_value' => $cart_item['quantity'],
//                                    'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
//                                    'min_value'   => '0'
//                                ), $_product, false );
//                            }
//
//                            echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
//                            ?>
<!--                            <div class="price">-->
<!--                                <span class="name">Всего:</span>--><?php //echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <!---->
<!--                    <!--                    <div class="product-section product-subtotal" data-title="--><?php ////_e( 'Total', 'woocommerce' ); ?><!--<!--">-->
<!--                    <!--                        <div class="inner">-->
<!--                    <!--                            --><?php ////echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
<!--                    <!--                        </div>-->
<!--                    <!--                    </div>-->
<!---->
<!--                    <div class="product-remove">-->
<!--                        --><?php
//                        echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
//                            '<a href="%s" class="remove" title="%s" data-product_id="%s" data-product_sku="%s"></a>',
//                            esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
//                            __( 'Remove this item', 'woocommerce' ),
//                            esc_attr( $product_id ),
//                            esc_attr( $_product->get_sku() )
//                        ), $cart_item_key );
//                        ?>
<!--                    </div>-->
<!--                </div>-->
<!--                --><?php
//            }
        }
        do_action( 'woocommerce_cart_contents' );
        ?>

        <div class="actions block_woocommerce_total">
            <div class="inner">
                <div class="back_shop"><a href="/"><i class="icon"></i><span>Продолжить покупки</span></a></div>
                
                <div class="price-actions">
                    <span class="name">Общая стоимость заказа:</span>
                    <div class="price"><?php wc_cart_totals_order_total_html(); ?></div>
                    <a href="/checkout" class="button">Заказать</a>
                </div>
                <div class="button-actions">
                    <input type="submit" class="button" name="update_cart" value="<?php esc_attr_e( 'Update Cart', 'woocommerce' ); ?>" />
                </div>

                <?php do_action( 'woocommerce_cart_actions' ); ?>
                <?php wp_nonce_field( 'woocommerce-cart' ); ?>
            </div>
        </div>

        <?php do_action( 'woocommerce_after_cart_contents' ); ?>
    </div>


    <?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>

<!--<div class="cart-collaterals">-->
<!---->
<!--    --><?php //do_action( 'woocommerce_cart_collaterals' ); ?>
<!---->
<!--</div>-->

<?php do_action( 'woocommerce_after_cart' ); ?>
