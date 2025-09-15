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

	const selector = {
		base: '.kak-select2',
		items_selected_multiple: '.select2-selection--multiple .select2-selection__rendered',
	};

	class kakSelect2 {
		constructor(element, options) {
			this.element = element;
			this.options = options;
			this.init();
		}

		init() {
			this.destroy();
			this.create();
		}

		create() {
			this.initS2().then();
		}

		destroy() {
		}

		afterLoadData() {
			const $el = $(this.element);
			return new Promise((resolve, reject) => {
				if (!$el.data('loadItemsUrl')) {
					resolve('afterLoadData not load');
					return;
				}
				$.ajax({
					url: $el.data('loadItemsUrl'),
					dataType: 'json',
					success: function (data) {
						this.options['data'] = data.results;
						resolve('afterLoadData success');
					}
				});
			});
		}

		async initS2() {
			this.showLoading()
			await this.afterLoadData();
			this.initWidget();
			this.initScroll();
			this.initS2ToggleAll();
			this.hideLoading()
		}

		getPreLoading() {
			return $(this.element).parent().find('.select2-pre-loading')
		}

		showLoading() {
			let loading = this.getPreLoading();
			let container = $(this.element).parent();
			if (loading) {
				container.addClass('pre-loading');
				loading.addClass('show');
			}
		}

		hideLoading() {
			let loading = this.getPreLoading();
			let el = $(this.element);
			let container = el.parent();
			setTimeout(() => {
				if (loading) {
					container.removeClass('pre-loading');
					loading.remove();
				}
			}, el.data('loadingDelay') || 500)

		}

		initWidget() {
			let loading = this.getPreLoading()
			// $el.show();
			$(this.element).select2(this.options);

		}

		initScroll(e) {
			const scroll = $(this.element).data('scrollHeight');
			if (!scroll) {
				return;
			}
			$(this.element)
				.closest(selector.base)
				.find(selector.items_selected_multiple)
				.slimScroll({height: ''})
				.css('max-height', scroll + 'px');

		}

		initS2ToggleAll() {
			const $el = $(this.element);
			const id = $el.attr('id'),
				togId = '#' + 's2-togall-' + id,
				$tog = $(togId);

			if (!$el.attr('multiple') || !$el.data('toggleEnable')) {
				return;
			}

			const isAjax = !!$el.data('ajax--url');

			$el.on('select2:open.kak-select2', function () {
				$('#select2-' + id + '-results').closest('.select2-dropdown').prepend($tog);
				$('#parent-' + togId).remove();

				$tog.removeClass('s2-togall-select s2-togall-unselect');
				if ($el.find('option:selected').length > 0) {
					$tog.addClass('s2-togall-unselect');
				} else {
					$tog.addClass('s2-togall-select');
				}

			}).on('change.kak-select2', function () {
				let tot = 0, sel = $el.val() ? $el.val().length : 0;
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

			const EVENT_SELECTALL = 'selectall';
			const EVENT_UNSELECTALL = 'unselectall';

			$tog.off('.kak-select2').on('click.kak-select2', function () {
				const $search = $el.closest('.kak-select2').find('input.select2-search__field');
				const $options = $('.select2-results__options li');
				const isSelect = $tog.hasClass('s2-togall-select');
				let flag = true;
				let ev = '' + EVENT_SELECTALL;

				if (!isSelect) {
					flag = false;
					ev = '' + EVENT_UNSELECTALL;
				}

				if (isAjax && ev === EVENT_SELECTALL || ($search && $search.val().length > 0)) {
					$options.each(function () {
						var $item = $(this);
						if ($item.attr('aria-disabled') === 'true') {
							return;
						}
						$item.trigger('mouseup');
					})
				} else if (isAjax === false || ev === EVENT_UNSELECTALL) {
					$el.find('option').each(function () {
						const $opt = $(this);
						if (!$opt.attr('disabled') && $opt.val().length) {
							$opt.prop('selected', flag);
						}
					});
					$el.select2('close').trigger('kak-select2:' + ev).trigger('change');
				}
			});
		}
	}

	$.fn.kakSelect2 = function (option) {
		new kakSelect2(this, option);
		return this;
	};

}));

/*
 select2-selection select2-selection--multiple
 height: 150px;
 overflow: auto;
 */
