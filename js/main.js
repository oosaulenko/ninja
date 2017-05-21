
$('.block_products').flickity({
    groupCells: 2,
    pageDots: false,
    selectedAttraction: 0.01,
    friction: 0.15,
    imagesLoaded: true,
    percentPosition: false,
    wrapAround: true
});

$('.block_reviews').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    dots: false
});

$('.block_sale').slick();

$('.main_fullpage').fullpage({

    afterLoad: function(anchorLink, index){
        var title = $('.section-' + index).find('.title_section');
        var info = $('.section-' + index).find('.info');

        setTimeout(function(){ title.addClass('title_section-active'); }, 0);
        setTimeout(function(){ title.children('b').addClass('active'); }, 0);
        setTimeout(function(){ title.children('span').addClass('active'); }, 20);

        setTimeout(function(){ info.addClass('info-active'); }, 40);
    },
    onLeave: function(index, nextIndex, direction){
        var title = $('.section-' + index).find('.title_section');
        var info = $('.section-' + index).find('.info');

        title.removeClass('title_section-active');
        title.children('b').removeClass('active');
        title.children('span').removeClass('active');
        info.removeClass('info-active');
    },
    onSlideLeave : function(anchorLink, index, slideIndex, direction, nextSlideIndex){
        alert(anchorLink + index + slideIndex);
    }
});

$( ".typePizza" ).on( "change", function () {
    var valueID = $(this);
    var blockInfoProduct = valueID.parents('.block_info');
    var productIDhidden = blockInfoProduct.find('.productIDhidden');

    // alert(productIDhidden.val());

    productIDhidden.val(valueID.val());
} );

$('#buttonRandom').on('click', function(){
   var productIDhiddenRandom = $('.productIDhiddenRandom');
   if(productIDhiddenRandom.val() > 0){
       $('#buttonRandomHidden').click();
       $(this).html('Получить рандомную пиццу').removeClass('buttonRandomFinish');
       productIDhiddenRandom.val('0');
   }
   else{
       $(this).attr('disabled','disabled');
       $(this).html('<p><input type="radio" class="typePizzaRandom" id="typePizzaRandom_1" name="typePizzaRandom" value="176"><label for="typePizzaRandom_1"><span class="dimensions">30 см</span></label></p><p><input type="radio" class="typePizzaRandom" id="typePizzaRandom_2" name="typePizzaRandom" value="177"><label for="typePizzaRandom_2"><span class="dimensions">40 см</span></label></p>');
   }
});

$(document).on( "change", ".typePizzaRandom", function () {
    var valueID = $(this);
    var blockInfoProduct = valueID.parents('.block_info');
    var productIDhidden = $('.productIDhiddenRandom');
    productIDhidden.val(valueID.val());

    $('#buttonRandom').html('Добавить в коробку').removeAttr('disabled').addClass('buttonRandomFinish');
} );



$('.remove-item').on('click', function(e){
    e.preventDefault();
    var remove_item = $(this).parent();
    var data = {
        'action': 'remove_product',
        'cart_item_key' : $(this).parent().attr('data-item-key')
    };

    $.ajax({
        type: 'POST',
        url: mytheme_ajax.url,
        data: data,
        success: function(response){
            var parseResp = $.parseJSON(response);

            remove_item.fadeOut(500);
            $('#allPriceTotal').html('<strong><span class="woocommerce-Price-amount amount">' + parseResp.subtotal + '&nbsp;<span class="woocommerce-Price-currencySymbol">грн</span></span></strong>');
        },
        error: function(){
            alert('Фатальная ошибка');
        }

    });

    return false;
});

$('.block_quantity_cart .input-number').on('change', function(){
    var remove_item = $(this).parents('.cart_item');
    var data_item_key = remove_item.attr('data-item-key');
    var data_item_id = remove_item.attr('data-item-id');
    var data_item_price = remove_item.attr('data-item-price');

    // alert($(this).val());
    var data = {
        'action': 'quantity_product',
        'cart_item_key' : data_item_key,
        'data_item_id' : data_item_id,
        'data_item_price' : data_item_price,
        'quantity': $(this).val()
    };

    $.ajax({
        type: 'POST',
        url: mytheme_ajax.url,
        data: data,
        success: function(response){
            var parseResp = $.parseJSON(response);

            // alert(parseResp.test);

            if(parseResp.status == false){
                remove_item.fadeOut(500);
            }
            else{

            }
            $('#allPriceTotal').html('<strong><span class="woocommerce-Price-amount amount">' + parseResp.subtotal + '&nbsp;<span class="woocommerce-Price-currencySymbol">грн</span></span></strong>');
            var price = remove_item.find('.all_price');
            price.children('.info').html('<span class="woocommerce-Price-amount amount">' + parseResp.total + '&nbsp;<span class="woocommerce-Price-currencySymbol">грн</span></span>');
            //
            // remove_item.fadeOut(500);
        //     $('#allPriceTotal').html('<strong><span class="woocommerce-Price-amount amount">' + parseResp.subtotal + '&nbsp;<span class="woocommerce-Price-currencySymbol">грн</span></span></strong>');
        },
        error: function(){
            alert('Фатальная ошибка');
        }

    });
});