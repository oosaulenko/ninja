var item_title = $('.item-title');

function countUp(count)
{
    var div_by = 0,
        speed = Math.round(count / div_by),
        $display = $('#totalSum'),
        run_count = 1,
        int_speed = 24;

    var int = setInterval(function() {
        if(run_count < div_by){
            $display.text(speed * run_count);
            run_count++;
        } else if(parseInt($display.text()) < count) {
            var curr_count = parseInt($display.text()) + 1;
            $display.text(curr_count);
        } else {
            clearInterval(int);
        }
    }, int_speed);
}

item_title.on('click', function(){

    var main_back = $('.block_list_ingredients').children('.main-back');

    var main_item_old = $('.block_list_ingredients').children('.main-item');
    main_item_old.removeClass('active');
    main_item_old.hide();
    // main_item_old.addClass('hidden');

    main_back.addClass('active');

    var main_item = $(this).parent('.main-item');
    main_item.show();
    main_item.removeClass('hidden');
    main_item.addClass('active');
});

$('.main-back').on('click', function () {
    $(this).removeClass('active');
    var main_item_old = $('.block_list_ingredients').children('.main-item');
    main_item_old.removeClass('active');
    main_item_old.show();

    var item_element = $('.item-element');
    item_element.addClass('hidden');

    setTimeout(function(){
        item_element.removeClass('hidden');
    },500);
});

// $('.item-element').on('click', function(){
//    var id_element = $(this).attr('data-id');
//    var main_layers = $('.main-layer');
//    var element = main_layers.children('.layer-'+ id_element);
//    element.addClass('active');
// });

var element_minus = $('.minus');
var element_plus = $('.plus');
var element_num = $('.num');

element_minus.on('click', function(){
    var block_count =  $(this).parent('.count');

    var allPriceHidden = $('.allPrice');
    var allPrice = $('#totalSum');

    var element_numHidden = block_count.children('.numHidden');
    var element_numHiddenPrice = block_count.children('.numHiddenPrice');
    var element_num = block_count.children('.num');

    if(element_numHidden.val() > 0){
        var element_countOld = Number(element_numHidden.val()) - 1;
        element_numHidden.val(element_countOld);
        element_num.html(element_countOld);

        if(element_countOld == 0){
            var item_element = block_count.parent('.item-element');
            var id_element = item_element.attr('data-id');
            var main_layers = $('.main-layer');
            var element = main_layers.children('.layer-'+ id_element);
            element.removeClass('active');
        }

        allPriceHidden.val(Number(allPriceHidden.val()) - Number(element_numHiddenPrice.val()));
        allPrice.html(allPriceHidden.val());
        // countUp(allPriceHidden.val());
    }
    // else{
    //
    // }

});

element_plus.on('click', function(){
    var block_count =  $(this).parent('.count');

    var allPriceHidden = $('.allPrice');
    var allPrice = $('#totalSum');

    var item_element = block_count.parent('.item-element');
    var id_element = item_element.attr('data-id');
    var main_layers = $('.main-layer');
    var element = main_layers.children('.layer-'+ id_element);
    element.addClass('active');


    var element_numHidden = block_count.children('.numHidden');
    var element_numHiddenPrice = block_count.children('.numHiddenPrice');
    var element_num = block_count.children('.num');
    var element_countOld = Number(element_numHidden.val()) + 1;
    element_numHidden.val(element_countOld);
    element_num.html(element_countOld);

    allPriceHidden.val(Number(allPriceHidden.val()) + Number(element_numHiddenPrice.val()));
    allPrice.html(allPriceHidden.val());
    // countUp(allPriceHidden.val());
});

$('#makerAccept').on('click', function(){
   alert('Ну-ну');
});

$('#makerCancel').on('click', function(){
    alert('Может не надо ?');
});
