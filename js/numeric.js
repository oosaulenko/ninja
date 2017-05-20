(function() {

    var decrement = $('.input-number-decrement');
    var increment = $('.input-number-increment');
    // $('.input-number').attr('disabled', true);

    decrement.on('click', function(){
        var input_number = $(this).siblings('.input-number');
        // input_number.attr('disabled', true);

        var min = input_number.attr('min') || false;
        var max = input_number.attr('max') || false;

        var value = input_number.val();
        value--;

        if(!min || value >= min) {
            input_number.val(value);
            input_number.change();
        }
    });

    increment.on('click', function(){
        var input_number = $(this).siblings('.input-number');

        var min = input_number.attr('min') || false;
        var max = input_number.attr('max') || false;

        var value = input_number.val();
        value++;

        if(!max || value <= max) {
            // value++;
            input_number.val(value);
            input_number.change();
        }
    });
})();

inputNumber($('.input-number'));