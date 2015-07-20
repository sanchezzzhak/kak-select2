(function($){

    $('.select2').each(function(k,select){
        var options = {};
        select = $(select);

        if(select.is('[placeholder]'))
            options = $.extend(options,{ placeholder: select.attr('placeholder')  });

        select.select2(options);
    });

})(jQuery);
