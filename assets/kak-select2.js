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

  var selector = {
    base: '.kak-select2',
    items_selected_multiple: '.select2-selection--multiple .select2-selection__rendered',
  };

  // **********************************
  // Constructor
  // **********************************
  var kakSelect2 = function(element, options) {
    this.element = element;
    this.options = options;
    this.init();
  };

  kakSelect2.prototype = {
    constructor: kakSelect2,
    init: function() {
      this.destroy();
      this.create();
    },
    create: function() {
      this.initS2();
    },
    destroy: function() {

    },

    // ----------------------------------
    // Methods to override
    // ----------------------------------
    afterLoadData: function() {
      var $el = $(this.element),
          deferred = new $.Deferred();

      if (!$el.data('loadItemsUrl')) {
        deferred.resolve('afterLoadData not load');
        return deferred;
      }
      var url = $el.data('loadItemsUrl');
      $.ajax({
        url: url,
        dataType: 'json',
        success: $.proxy(function(data) {
          this.options['data'] = data.results;
          deferred.resolve('afterLoadData success');
        }, this),
      });
      return deferred;
    },
    initS2: function() {
      $.when(
          this.afterLoadData(),
      ).done($.proxy(function() {
        this.initWidget();
        this.initS2ToggleAll();
      }, this));
    },
    initWidget: function() {
      // $el.show();
      $(this.element).select2(this.options);
      this.initScroll();
    },
    initScroll: function(e) {
      var self = this;
      var scroll = $(this.element).data('scrollHeight');
      if (!scroll) {
        return;
      }
      $(self.element).
      closest(selector.base).
      find(selector.items_selected_multiple).
      slimScroll({
        height: '',
      }).
      css('max-height', scroll + 'px');

    },
    initS2ToggleAll: function() {
      var $el = $(this.element);


      var id = $el.attr('id'),
          togId = '#' + 's2-togall-' + id,
          $tog = $(togId);

      if (!$el.attr('multiple') || !$el.data('toggleEnable')) {
        return;
      }

      var isAjax = !!$el.data('ajax--url');

      $el.on('select2:open.kak-select2', function() {
        $('#select2-' + id + '-results').
        closest('.select2-dropdown').
        prepend($tog);
        $('#parent-' + togId).remove();

        $tog.removeClass('s2-togall-select s2-togall-unselect');
        if ($el.find('option:selected').length > 0) {
          $tog.addClass('s2-togall-unselect');
        } else {
          $tog.addClass('s2-togall-select');
        }
        
      }).on('change.kak-select2', function() {
        var tot = 0, sel = $el.val() ? $el.val().length : 0;
        $tog.removeClass('s2-togall-select s2-togall-unselect');
        $el.find('option:enabled').each(function() {
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

      var EVENT_SELECTALL = 'selectall';
      var EVENT_UNSELECTALL = 'unselectall';

      $tog.off('.kak-select2').on('click.kak-select2', function() {
        var $search = $el.closest('.kak-select2').find('input.select2-search__field');
        var $options = $('.select2-results__options li');
        var isSelect = $tog.hasClass('s2-togall-select');
        var flag = true;
        var ev = EVENT_SELECTALL;


        if (!isSelect) {
          flag = false;
          ev = EVENT_UNSELECTALL;
        }

        if (isAjax && ev === EVENT_SELECTALL || ($search && $search.val().length > 0) ) {
          $options.each(function(){
            var $item = $(this);
            if ($item.attr('aria-disabled') === 'true') {
              return;
            }
            $item.trigger('mouseup');
          })
        } else if (isAjax === false || ev === EVENT_UNSELECTALL) {
          $el.find('option').each(function() {
            var $opt = $(this);
            if (!$opt.attr('disabled') && $opt.val().length) {
              $opt.prop('selected', flag);
            }
          });
          $el.select2('close').trigger('kak-select2:' + ev).trigger('change');
        }

      });
    },
  };

  $.fn.kakSelect2 = function(option) {
    var options = typeof option == 'object' && option;
    new kakSelect2(this, options);
    return this;
  };
  $.fn.kakSelect2.Constructor = kakSelect2;

}));

/*
 select2-selection select2-selection--multiple
 height: 150px;
 overflow: auto;
 */
