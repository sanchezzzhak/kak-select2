<?php

namespace kak\widgets\select2;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\InputWidget;

/**
 * Class Select2
 * @package kak\widgets\select2
 */
class Select2 extends InputWidget
{
    private const JS_KEY = 'kak/select2/';

    public const THEME_DEFAULT = 'classic';
    public const THEME_BOOTSTRAP = 'bootstrap';

    //  Triggered whenever an option is selected or removed.
    public const EVENT_CHANGE = 'change';
    //  Triggered whenever the dropdown is closed.
    public const EVENT_CLOSE = 'select2:close';
    // Triggered before the dropdown is closed. This event can be prevented.
    public const EVENT_CLOSING = 'select2:closing';
    //  Triggered whenever the dropdown is opened.
    public const EVENT_OPEN = 'select2:open';
    //  Triggered before the dropdown is opened. This event can be prevented.
    public const EVENT_OPENING = 'select2:opening';
    //  Triggered before a result is selected. This event can be prevented.
    public const EVENT_SELECT = 'select2:select';
    //  Triggered whenever a result is selected.
    public const EVENT_SELECTING = 'select2:selecting';
    //  Triggered whenever a selection is removed.
    public const EVENT_UNSELECT = 'select2:unselect';
    //  Triggered before a selection is removed. This event can be prevented.
    public const EVENT_UNSELECTING = 'select2:unselecting';


    public bool $autoLanguage = true;
    /** @var string - Specify the language used for Select2 messages. https://select2.org/i18n#message-translations */
    public ?string $language = null;
    public array $options = [];
    /** @var string|array */
    public $loadItemsUrl;
    /** @var string|array */
    public $ajax;
    /** @var bool */
    public $ajaxCache = true;
    /** @var int - Minimum number of characters required to start a search. */
    public int $minimumInputLength = 0;
    /** @var array|null */
    public ?array $tags = null;
    /** @var bool */
    public bool $multiple = false;
    /** @var string */
    public string $theme = self::THEME_BOOTSTRAP;
    /** @var string|null */
    public ?string $placeholder = null;
    /** @var array */
    public array $events = [];
    /** @var array */
    public array $clientOptions = [];
    /** @var array */
    public array $items = [];

    public bool $firstItemEmpty = false;
    public string $selectLabel = 'Select all';
    public string $unselectLabel = 'Unselect all';

    public string $selectIcon = '<i class="glyphicon glyphicon-unchecked"></i>';
    public string $unSelectIcon = '<i class="glyphicon glyphicon-check"></i>';

    public bool $toggleEnable = true;
    public array $toggleOptions = [];

    public function init()
    {
        parent::init();
        $this->initOption();
        $this->initLanguageOption();
    }

    public function run()
    {
        parent::run();
        $this->renderWidget();
    }

    /**
     * render widget HTML
     */
    protected function renderWidget(): void
    {
        $this->renderInput();
        $this->renderToggleAll();
        $this->registerAssets();
    }

    /**
     * render standard input or active input
     */
    protected function renderInput(): void
    {
        if ($this->firstItemEmpty && !$this->multiple) {
            $this->items = ['' => $this->placeholder] + $this->items;
        }

        if (isset($this->options['itemWidthAuto']) && !$this->options['itemWidthAuto']) {
            Html::addCssClass($this->options, 'select2-auto');
        } else {
            Html::addCssClass($this->options, 'select2-width100');
        }

        // auto load get data
        $isModel = $this->hasModel();
        if (!$isModel && $this->value === null) {
            $this->value = \Yii::$app->request->get($this->name);
        }

        // render input
        $input = $isModel
            ? Html::activeDropDownList($this->model, $this->attribute, $this->items, $this->options)
            : Html::dropDownList($this->name, $this->value, $this->items, $this->options);


        echo Html::tag('div', $input, ['class' => 'kak-select2']);
    }


    /**
     * @author https://github.com/kartik-v/yii2-widget-select2
     * @see tnx
     */
    protected function renderToggleAll(): void
    {
        if (!$this->multiple || !$this->toggleEnable) {
            return;
        }

        $selectIcon = stripos($this->selectIcon, '<i') !== false
            ? $this->selectIcon
            : Html::tag('i', '', ['class' => $this->selectIcon]);

        $unSelectIcon = stripos($this->unSelectIcon, '<i') !== false
            ? $this->unSelectIcon
            : Html::tag('i', '', ['class' => $this->unSelectIcon]);

        $settings = ArrayHelper::merge([
            'selectLabel' => sprintf('%s%s', $selectIcon, $this->selectLabel),
            'unselectLabel' => sprintf('%s%s', $unSelectIcon, $this->unselectLabel),
            'selectOptions' => [],
            'unselectOptions' => [],
            'options' => ['class' => 's2-togall-button']
        ], $this->toggleOptions);

        $sOptions = $settings['selectOptions'];
        $uOptions = $settings['unselectOptions'];
        $options = $settings['options'];

        $prefix = 's2-togall-';
        Html::addCssClass($options, "{$prefix}select");
        Html::addCssClass($sOptions, "s2-select-label");
        Html::addCssClass($uOptions, "s2-unselect-label");

        $options['id'] = $prefix . $this->options['id'];

        $labels = sprintf('%s%s',
            Html::tag('span', $settings['selectLabel'], $sOptions),
            Html::tag('span', $settings['unselectLabel'], $uOptions)
        );

        $out = Html::tag('span', $labels, $options);
        echo Html::tag('span', $out, ['id' => 'parent-' . $options['id'], 'style' => 'display:none']);
    }

    /**
     * take language initialization from framework settings if not specified $this->language property
     */
    protected function initLanguageOption()
    {
        if ($this->autoLanguage && $this->language !== false && empty($this->language)) {
            $languageApp = \Yii::$app->language;
            if ($languageApp !== '') {
                $this->language = $languageApp;
            }
        }
    }

    /**
     * Registers assets
     */
    public function registerAssets()
    {
        $view = $this->getView();
        Select2Asset::register($view);
        KakSelect2Asset::register($view);

        KakSelect2LanguageAsset::register($view)->addLanguage($this->language);

        if ((string)$this->theme === self::THEME_BOOTSTRAP) {
            ThemeBootstrap::register($view);
        }

        $id = $this->options['id'];
        $clientOptions = Json::htmlEncode($this->clientOptions);

        $view->registerJs("jQuery('#{$id}').kakSelect2({$clientOptions});", $view::POS_READY, self::JS_KEY . $id);
        $this->registerEvents();
    }

    /**
     * Register plugin events.
     */
    protected function registerEvents(): void
    {
        $view = $this->getView();
        $selector = '#' . $this->options['id'];

        if (empty($this->events)) {
            return;
        }

        $js = [];

        foreach ($this->events as $event => $callback) {
            if (is_array($callback)) {
                foreach ($callback as $function) {
                    if (!$function instanceof JsExpression) {
                        $function = new JsExpression($function);
                    }

                    $js[] = "jQuery('$selector').on('$event', $function);";
                }
                continue;
            }

            if (!$callback instanceof JsExpression) {
                $callback = new JsExpression($callback);
            }

            $js[] = "jQuery('$selector').on('$event', $callback);";
        }

        if (!empty($js)) {
            $js = implode("\n", $js);
            $view->registerJs($js, $view::POS_READY, self::JS_KEY . 'events/' . $this->options['id']);
        }
    }

    /**
     * Init config set options
     */
    protected function initOption(): void
    {
        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }

        if ($this->multiple) {
            $this->options['data-multiple'] = $this->boolToStr(true);
            $this->options['multiple'] = true;
        }

        if (isset($this->tags)) {
            $this->options['data-tags'] = $this->tags;
            $this->options['multiple'] = true;
        }

        if ($this->loadItemsUrl !== null) {
            $this->options['data-load-items-url'] = Url::to($this->loadItemsUrl);
        }

        if ($this->toggleEnable) {
            $this->options['data-toggle-enable'] = $this->boolToStr($this->toggleEnable);
        }

        if ($this->language) {
            $this->options['data-language'] = $this->language;
        }

        if (isset($this->ajax)) {
            $this->options['data-ajax--url'] = Url::to($this->ajax);

            $this->options['data-ajax--cache'] = $this->boolToStr($this->ajax);
            $this->options['data-minimum-input-length'] = $this->minimumInputLength;
        }

        if (isset($this->placeholder)) {
            $this->options['data-placeholder'] = $this->placeholder;
        }

        $this->clientOptions['theme'] = $this->theme;

        Html::addCssStyle($this->options, ['width' => '100%'], false);
        Html::addCssClass($this->options, 'select2 form-control');
    }

    /**
     * Convert boolean to string js bool
     *
     * @param $var
     * @return string
     */
    protected function boolToStr($var): string
    {
        return $var === true ? 'true' : 'false';
    }

}
