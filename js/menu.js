var buttonMenu = $('#buttonMenu');
var blockMenu = $('#l-nav');

buttonMenu.on('click', function(){
    if(blockMenu.hasClass('active')){
        blockMenu.removeClass('active');
        $('#menu-toggle').removeClass('active');
        $(this).removeClass('active');
    }
    else{
        blockMenu.addClass('active');
        $('#menu-toggle').addClass('active');
        $(this).addClass('active');
    }
});


$(document).click( function(event){
    if( $(event.target).closest(blockMenu).length ){

    }
    else{
        blockMenu.removeClass('active');
        $('#menu-toggle').removeClass('active');
        buttonMenu.removeClass('active');
    }
});
// (function ($) {
    $(function () {
        (function phs() {
            var op = $('#phone_slider > div.v');
            op.removeClass('v').fadeOut(300);
            if (op.next().length) {
                op.next().addClass('v').fadeIn(300);
            } else {
                op.parent().children().first().addClass('v').fadeIn(300);
            }
            setTimeout(phs, 1500);
        }());
    });
// });

$( ".typePizza" ).on( "change", function () {
    var valueID = $(this);
    var blockInfoProduct = valueID.parents('.block_info');
    var productIDhidden = blockInfoProduct.find('.productIDhidden');

    // alert(productIDhidden.val());

    productIDhidden.val(valueID.val());
} );