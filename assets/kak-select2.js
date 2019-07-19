(function (root, factory) {
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
}(this, function ($) {
  'use strict';
  
  var selector = {
	base: '.kak-select2',
	items_selected_multiple: '.select2-selection--multiple .select2-selection__rendered'
  };
  
  // **********************************
  // Constructor
  // **********************************
  var kakSelect2 = function (element, options) {
	this.element = element;
	this.options = options;
	this.init();
  };
  
  kakSelect2.prototype = {
	constructor: kakSelect2,
	init: function () {
	  this.destroy();
	  this.create();
	},
	create: function () {
	  this.initS2();
	},
	destroy: function () {
	  
	},
	
	// ----------------------------------
	// Methods to override
	// ----------------------------------
	afterLoadData: function () {
	  var $el = $(this.element),
		deferred = new $.Deferred();
	  var url = $el.data('ajax-Url');
	  
	  if (!$el.data('ajaxAfterload') || !url) {
		deferred.resolve('afterLoadData not load');
		return deferred;
	  }
	  var requestType = $el.data('ajaxType');
	  var dataItems = [];
	  $el.find(':selected').each(function () {
		dataItems.push($(this).val());
	  });
	  
	  console.log('dataItems', this.dataItems);
	  
	  
	  $.ajax({
		url: url,
		data: {ids: dataItems, _type: 'load'},
		type: requestType,
		dataType: 'json',
		success: $.proxy(function (data) {
		  this.options['data'] = data.results;
		  deferred.resolve('afterLoadData success');
		}, this)
	  });
	  return deferred;
	},
	
	initS2: function () {
	  $.when(
		this.afterLoadData()
	  ).done($.proxy(function () {
		this.initWidget()
		this.initS2ToggleAll();
	  }, this));
	},
	initWidget: function () {
	  // $el.show();
	  
	  console.log('this.options', this.options);
	  
	  $(this.element).select2(this.options);
	  this.initScroll();
	},
	initScroll: function (e) {
	  var self = this;
	  var scroll = $(this.element).data('scrollHeight');
	  if (!scroll) {
		return;
	  }
	  $(self.element).closest(selector.base).find(selector.items_selected_multiple).slimScroll({
		height: ''
	  }).css('max-height', scroll + 'px');
	  
	},
	
	initS2ToggleAll: function () {
	  var $el = $(this.element);
	  var id = $el.attr('id'), togId = '#' + 's2-togall-' + id, $tog = $(togId);
	  
	  if (!$el.attr('multiple') || !$el.data('toggleEnable')) {
		return;
	  }
	  
	  $el.on('select2:open.kakselect2', function () {
		if ($tog.parent().attr('id') === 'parent-' + togId || !$el.attr('multiple')) {
		  return;
		}
		$('#select2-' + id + '-results').closest('.select2-dropdown').prepend($tog);
		$('#parent-' + togId).remove();
	  }).on('change.kakselect2', function () {
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
	  
	  $tog.off('.kakselect2').on('click.kakselect2', function () {
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
		$el.select2('close').trigger('kakselect2:' + ev).trigger('change');
	  });
	}
  };
  
  $.fn.kakSelect2 = function (option) {
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