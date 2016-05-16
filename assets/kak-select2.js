(function(root, factory) {
    // CommonJS support
    if (typeof exports === 'object') {
        module.exports = factory();
    }
    // AMD
    else if (typeof define === 'function' && define.amd) {
        define(['jquery'], factory);
    }
    // Browser globals
    else {
        factory(root.jQuery);
    }
}(this, function($) {
    'use strict';

    // **********************************
    // Constructor
    // **********************************
    var kakSelect2 = function (element, options) {
        this.element = element;
        this.options = options;
        this.initS2();
    };

    kakSelect2.prototype = {
        constructor: kakSelect2,
        // ----------------------------------
        // Methods to override
        // ----------------------------------
        afterLoadData: function(){
            var $el = $(this.element),
                deferred = new $.Deferred();

            if(!$el.data('loadItemsUrl')){
                deferred.resolve('afterLoadData not load');
                return deferred;
            }
            var url = $el.data('loadItemsUrl');
            $.ajax({
                url:url,
                dataType:'json',
                success: $.proxy( function(data){
                    this.options['data'] = data.results;
                    deferred.resolve('afterLoadData success');
                },this)
            });
            return deferred;
        },

        initS2:function(){
            $.when(
                this.afterLoadData()
            ).done($.proxy(function(){
                this.initWidget()
                this.initS2ToggleAll();
            },this));
        },
        initWidget: function(){
           // $el.show();
            $(this.element).select2(this.options);
        },
        initS2ToggleAll : function () {
            var $el = $(this.element);
            var id = $el.attr('id'), togId = '#' + 's2-togall-' + id, $tog = $(togId);

            if (!$el.attr('multiple')  || !$el.data('toggleEnable')) {
                return;
            }

            $el.on('select2:open.krajees2', function () {
                if ($tog.parent().attr('id') === 'parent-' + togId || !$el.attr('multiple')) {
                    return;
                }
                $('#select2-' + id + '-results').closest('.select2-dropdown').prepend($tog);
                $('#parent-' + togId).remove();
            }).on('change.krajeeselect2', function () {
                if (!$el.attr('multiple')) {
                    return;
                }
                var tot = 0, sel = $el.val() ? $el.val().length : 0;
                $tog.removeClass('s2-togall-select s2-togall-unselect');
                $el.find('option:enabled').each(function () {
                    if ($(this).val().length) {
                        tot++;
                    }
                });
                if (tot === 0 || sel !== tot) {
                    $tog.addClass('s2-togall-select');
                } else {
                    $tog.addClass('s2-togall-unselect');
                }
            });
            $tog.off('.krajees2').on('click.krajees2', function () {
                var isSelect = $tog.hasClass('s2-togall-select'), flag = true, ev = 'selectall';
                if (!isSelect) {
                    flag = false;
                    ev = 'unselectall';
                }
                $el.find('option').each(function () {
                    var $opt = $(this);
                    if (!$opt.attr('disabled') && $opt.val().length) {
                        $opt.prop('selected', flag);
                    }
                });
                $el.select2('close').trigger('krajeeselect2:' + ev).trigger('change');
            });
        }

    };

    $.fn.kakSelect2 = function(option) {
        var options = typeof option == 'object' && option;
        new kakSelect2(this, options);
        return this;
    };
    $.fn.kakSelect2.Constructor = kakSelect2;

}));