<?php
function remove_product(){
//получим экземпляр класса Корзина
    $cart = WC()->instance()->cart;

//Принимаем в переменную данные из POST
    $cart_item_key = $_POST['cart_item_key'];

//Если там что-то есть...
    if($cart_item_key){
//устанавливаем значение 0 для этого продукта
        $cart->set_quantity($cart_item_key,0);
//можем теперь получить какие то данные, добавить других действий после удаления продукта,
//например, моя функция my_function_total возвращает свежий total, купоны и т.п.
        $response = my_function_total();
//добавим служебной информации
        $response['status'] = true;
        $response['message'] = __('Product is remove', 'octava');

    }else{
        $response['status'] = false;
        $response['message'] = __('Unknown error', 'octava');
    }
//отправим все в json формате.
    print json_encode($response);
    wp_die();
}
add_action('wp_ajax_remove_product', 'remove_product');
add_action('wp_ajax_nopriv_remove_product', 'remove_product');

?>