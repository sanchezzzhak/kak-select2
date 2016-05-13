<?php

namespace kak\widgets\select2;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\base\InvalidConfigException;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\JsExpression;

class Select2 extends \yii\widgets\InputWidget
{
    const JS_KEY = 'kak/select2/';


    const THEME_DEFAULT   = 'classic';
    const THEME_BOOTSTRAP = 'bootstrap';

    //  Triggered whenever an option is selected or removed.
    const EVENT_CHANGE = 'change';
    //  Triggered whenever the dropdown is closed.
    const EVENT_CLOSE = 'select2:close';
    // Triggered before the dropdown is closed. This event can be prevented.
    const EVENT_CLOSING = 'select2:closing';
    //  Triggered whenever the dropdown is opened.
    const EVENT_OPEN = 'select2:open';
    //  Triggered before the dropdown is opened. This event can be prevented.
    const EVENT_OPENING = 'select2:opening';
    //  Triggered before a result is selected. This event can be prevented.
    const EVENT_SELECT = 'select2:select';
    //  Triggered whenever a result is selected.
    const EVENT_SELECTING = 'select2:selecting';
    //  Triggered whenever a selection is removed.
    const EVENT_UNSELECT = 'select2:unselect';
    //  Triggered before a selection is removed. This event can be prevented.
    const EVENT_UNSELECTING = 'select2:unselecting';

    /**
     * @var array the HTML attributes for the widget container tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    /** @var string */
    public $language;
    /** @var array */
    public $options = [];
    /** @var array */
    public $ajax;
    public $ajaxCache = true;
    public $minimumInputLength = 0;

    public $tags;

    public $multiple      = false;
    public $theme         = self::THEME_BOOTSTRAP;
    public $placeholder;

    public $events = [];

    /** @var bool The first element empty */
    public $firstItemEmpty = false;

    public $clientOptions = [];
    /** @var array */
    public $items = [];

    public function init()
    {
        parent::init();
        $this->initOption();
    }

    public function run()
    {

        if($this->firstItemEmpty) {
            $this->items = [''=>''] + $this->items;
        }
        // render input
        echo $this->hasModel()
            ? Html::activeDropDownList($this->model, $this->attribute, $this->items , $this->options)
            : Html::dropDownList($this->name, $this->value, $this->items, $this->options);

        $this->registerAssets();
    }

    /**
     * Registers Assets
     */
    public function registerAssets()
    {
        $view = $this->getView();
        Select2Asset::register($view)->addLanguage($this->language);
        if($this->theme == self::THEME_BOOTSTRAP) {
            ThemeBootstrap::register($view);
        }
        $id = $this->options['id'];
        $clientOptions = Json::htmlEncode($this->clientOptions);

        $view->registerJs("jQuery('#{$id}').select2({$clientOptions});" , $view::POS_READY, self::JS_KEY . $this->options['id'] );
        $this->registerEvents();
    }

    /**
     * Register plugin' events.
     */
    protected function registerEvents()
    {
        $view = $this->getView();
        $selector = '#' . $this->options['id'];
        if (!empty($this->events)) {
            $js = [];
            foreach ($this->events as $event => $callback) {
                if (is_array($callback)) {
                    foreach ($callback as $function) {
                        if (!$function instanceof JsExpression) {
                            $function = new JsExpression($function);
                        }
                        $js[] = "jQuery('$selector').on('$event', $function);";
                    }
                } else {
                    if (!$callback instanceof JsExpression) {
                        $callback = new JsExpression($callback);
                    }
                    $js[] = "jQuery('$selector').on('$event', $callback);";
                }
            }
            if (!empty($js)) {
                $js = implode("\n", $js);
                $view->registerJs($js, $view::POS_READY, self::JS_KEY .'events/'. $this->options['id']);
            }
        }
    }

    /**
      Init config set options
     */
    protected function initOption()
    {
        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }

        if ($this->multiple) {
            $this->options['data-multiple'] = 'true';
            $this->options['multiple'] = true;
        }

        if (isset($this->tags)) {
            $this->options['data-tags'] = $this->tags;
            $this->options['multiple'] = true;
        }

        if ($this->language)
            $this->options['data-language'] = $this->language;

        if (isset($this->ajax)) {
            $this->options['data-ajax--url'] = Url::to($this->ajax);

            $this->options['data-ajax--cache'] = $this->ajaxCache  ? 'true' : 'false';
            $this->options['data-minimum-input-length'] = $this->minimumInputLength;
        }

        if (isset($this->placeholder))
            $this->options['data-placeholder'] = $this->placeholder;

        $this->clientOptions['theme']    = $this->theme;

        Html::addCssStyle($this->options,['width'=>'100%'],false);
        Html::addCssClass($this->options,'select2 form-control');
    }

}
