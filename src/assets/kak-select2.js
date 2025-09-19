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
		base: '.wrap-select2',
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

		isToggleEnable() {
			return !!this.getElement().data('toggleEnable')
		}

		isAjax() {
			return !!this.getElement().data('ajax--url')
		}

		isMultiple() {
			return !!this.getElement().attr('multiple')
		}

		isCounter() {
			return !!!this.getElement().data('counterShow')
		}

		afterLoadData() {
			const $el = this.getElement();
			return new Promise((resolve, reject) => {
				if (!$el.data('loadItemsUrl')) {
					resolve('afterLoadData not load');
					return;
				}
				$.ajax({
					url: $el.data('loadItemsUrl'), dataType: 'json', success: function (data) {
						this.options['data'] = data.results;
						resolve('afterLoadData success');
					}
				});
			});
		}

		async initS2() {
			this.showLoading()
			await this.afterLoadData();
			await this.initWidget();
			this.initScroll();
			this.initCounter();
			this.initS2ToggleAll();
			this.hideLoading()
		}

		showLoading() {
			let loading = this.getPreLoading();
			let container = this.getElement().parent();
			if (loading) {
				container.addClass('pre-loading');
				loading.addClass('show');
			}
		}

		hideLoading() {
			let loading = this.getPreLoading();
			let el = this.getElement();
			let container = el.parent();
			setTimeout(() => {
				if (loading) {
					container.removeClass('pre-loading');
					loading.remove();
					el.trigger('update-counter')
				}
			}, el.data('loadingDelay') || 500)

		}

		/**
		 * get preloading element
		 * @return {jQuery|HTMLElement|*}
		 */
		getPreLoading() {
			return this.getElement().closest(selector.base).find('.select2-pre-loading')
		}

		/**
		 * get select container block
		 * @return {jQuery|HTMLElement|*}
		 */
		getSelectContainer() {
			return this.getElement().closest(selector.base)
				.find('.select2-container .select2-selection');
		}

		/**
		 * get current Element
		 * @return {jQuery|HTMLElement|*}
		 */
		getElement() {
			return $(this.element)
		}

		/**
		 * get input search
		 * @return {jQuery|HTMLElement|*}
		 */
		getSelectSearch() {
			return this.getSelectContainer().find('.select2-search__field');
		}

		/**
		 * get html render block
		 * @return {jQuery|HTMLElement|*}
		 */
		getSelectRender() {
			return this.getSelectContainer().find('.select2-selection__rendered');
		}

		/**
		 * get html counter block
		 * @return {jQuery|HTMLElement|*}
		 */
		getSelectCounter() {
			return this.getSelectContainer().find('.select2-counter');
		}

		/**
		 * get html Elemtnts for selects
		 * @return {jQuery|HTMLElement|*}
		 */
		getSelectChoices() {
			return this.getSelectContainer().find('.select2-selection__choice');
		}

		/**
		 * update counter current values
		 * @param value
		 */
		updateCounterSelect(value) {
			this.getSelectCounter().find('span:eq(0)').text(value)
		}

		/**
		 * update counter max count values
		 * @param value
		 */
		updateCounterMax(value) {
			if (value > 999) {
				value = '999+'
			}
			this.getSelectCounter().find('span:eq(1)').text(value)
		}

		isMaxSelected() {
			const el = this.getElement();
			const maxShowItems = parseInt(el.data('maxShowItems'));
			const optionCount = this.getElement().find('option:selected').length;
			return optionCount > maxShowItems;
		}

		getAvailableWidth() {
			const selectCounter = this.getSelectCounter();

			return parseInt(this.getSelectContainer().outerWidth()) -
				selectCounter.outerWidth(true) - parseInt(getComputedStyle(selectCounter.get(0)).right);
		}

		getSelectedFiltersWidth() {
			const selectedFilters = this.getSelectChoices();
			let selectedFiltersWidth = 0;
			selectedFilters.each(function () {
				selectedFiltersWidth += $(this).outerWidth(true);
			});
			return selectedFiltersWidth;
		}

		/**
		 * update counter and UI
		 */
		updateCounter(event) {
			const el = this.getElement();

			const placeholder = this.options['placeholder'] ?? ''

			const container = el.closest(selector.base).find('.select2-container');
			const searchField = this.getSelectSearch();
			const selectCounter = this.getSelectCounter()
			const selectedFilters = this.getSelectChoices();
			const optionCount = this.getElement().find('option').length;
			let counterMax = el.attr('data-counter-count');
			counterMax = counterMax > 0 && counterMax !== optionCount ? counterMax : optionCount;

			this.updateCounterSelect(this.getElement().find('option:selected').length)
			this.updateCounterMax(counterMax)

			if (selectedFilters.length) {
				selectCounter.show();
			} else {
				selectCounter.hide();
			}

			const isOpen = container.hasClass('select2-container--open');
			const isChange = event === 'change';
			const isClose = event === 'select2:close';

			const availableWidth = this.getAvailableWidth();
			const selectedFiltersWidth = this.getSelectedFiltersWidth();

			const isHide = availableWidth < selectedFiltersWidth
				|| this.isMaxSelected()
				|| selectedFilters.length === 0;


			if (event === 'select2:open') {
				selectedFilters.hide();
				searchField.show();
				searchField.attr('placeholder', placeholder);
				requestAnimationFrame(() => {
					searchField.blur().focus();
				})
				return;
			}

			if (isHide) {
				selectedFilters.hide()
				searchField.show();
				searchField.attr('placeholder', placeholder);
			} else {
				selectedFilters.show();
				if (isClose && selectedFilters.length > 0 && !isOpen) {
					searchField.attr('placeholder', placeholder);
					searchField.hide();
				}
			}
		}

		/**
		 * get select instance select2
		 * @return {*}
		 */
		getSelect2() {
			return this.getElement().data('select2');
		}

		/**
		 * init counter block
		 */
		initCounter() {
			if (!this.isMultiple()) {
				return;
			}
			if (this.isCounter()) {
				return;
			}

			const el = this.getElement();
			const select2 = this.getSelect2();
			const container = this.getSelectContainer();

			container.addClass('select2-selection--select2-counter')
			container.append($(el.data('counterTemplate')))

			el.on('change select2:open select2:close update-counter', (e) => {
				requestAnimationFrame(() => {
					this.updateCounter(e.type);
				})
			});

			// select2.on('blur', () => {
			// 	this.updateCounter('blur');
			// });

			select2.on('results:all',  (resultData, params) => {
				const totalCount = resultData.data ? resultData.data.total : 0;
				const isUpdated = String(el.attr('data-counter-once')) !== '1';
				if (String(el.attr('data-counter-once')) === '0') {
					el.attr('data-counter-once', '1');
				}
				if (isUpdated) {
					el.attr('data-counter-count', totalCount);
				}
			})

			$(window).on('resize', () => {
				this.updateCounter('resize');
			})
		}

		/**
		 * init select2 widget base
		 */
		async initWidget() {
			const el = this.getElement();
			el.select2(this.options);

			this.getSelectContainer().addClass('select2-choice-direction-' + el.data('choiceDirection'))

			if (this.isAjax()) {
				el.on('select2:unselect', e => {
					if (e.params.originalEvent) {
						const target = $(e.params.originalEvent.target);
						const {id, text, selected} = e.params.data;
						const option = el.find('option[value="' + id + '"]');
						this.isMultiple() ? option.remove() : option.prop('selected', selected);
						el.trigger('change');
						target.removeClass('select2-results__option--highlighted')
					}
				})
			}
		}

		/**
		 * inti slimScroll in selection container
		 */
		initScroll() {
			const scroll = this.getElement().data('scrollHeight');
			if (!scroll) {
				return;
			}
			this.getElement()
				.closest(selector.base)
				.find(selector.items_selected_multiple)
				.slimScroll({height: ''})
				.css('max-height', scroll + 'px');

		}

		initS2ToggleAll() {
			const $el = this.getElement();
			const id = $el.attr('id'), togId = '#' + 's2-togall-' + id, $tog = $(togId);

			if (!this.isMultiple() || !this.isToggleEnable()) {
				return;
			}

			const isAjax = this.isAjax();

			$el.on('select2:open.wrap-select2', function () {
				$('#select2-' + id + '-results').closest('.select2-dropdown').prepend($tog);
				$('#parent-' + togId).remove();

				$tog.removeClass('s2-togall-select s2-togall-unselect');
				if ($el.find('option:selected').length > 0) {
					$tog.addClass('s2-togall-unselect');
				} else {
					$tog.addClass('s2-togall-select');
				}
			}).on('change', function () {
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

			$tog.off('.wrap-select2').on('click.wrap-select2', function () {
				const $search = $el.closest(selector.base).find('input.select2-search__field');
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
					$el.select2('close').trigger('wrap-select2:' + ev).trigger('change');
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
