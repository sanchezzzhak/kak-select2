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

    public $loadItemsUrl;
    public $ajax;
    public $ajaxCache = true;
    public $minimumInputLength = 0;

    public $tags;
    public $multiple      = false;
    public $theme         = self::THEME_BOOTSTRAP;
    public $placeholder;

    public $events = [];

    public $clientOptions = [];
    /** @var array */
    public $items = [];

    public $firstItemEmpty = false;

    public $selectLabel = 'Select all';
    public $unselectLabel = 'Unselect all';
    public $toggleEnable  = true;
    public $toggleOptions = [];

    public function init()
    {
        parent::init();
        $this->initOption();
    }

    public function run()
    {
        parent::run();
        $this->renderWidget();
    }


    protected function renderWidget()
    {
        $this->renderInput();
        $this->renderToggleAll();
        $this->registerAssets();
    }

    protected function renderInput()
    {
        if($this->firstItemEmpty && !$this->multiple ){
            $this->items = ['' => $this->placeholder ] +  $this->items;
        }

        if(isset($this->options['itemWidthAuto']) && !$this->options['itemWidthAuto']){
            Html::addCssClass($this->options,'select2-auto');
        }else{
            Html::addCssClass($this->options,'select2-width100');
        }

        // auto load get data
        $isModel =  $this->hasModel();
        if(!$isModel && $this->value === null){
            $this->value = \Yii::$app->request->get($this->name);
        }

        // render input
        $input = $isModel
            ? Html::activeDropDownList($this->model, $this->attribute, $this->items , $this->options)
            : Html::dropDownList($this->name, $this->value, $this->items, $this->options);


        echo Html::tag('div',$input,['class' => 'kak-select2']);
    }


    /**
     * @author https://github.com/kartik-v/yii2-widget-select2
     * @see tnx
     */
    protected function renderToggleAll()
    {
        if(!$this->multiple || !$this->toggleEnable){
            return;
        }
        $settings = ArrayHelper::merge([
            'selectLabel' => '<i class="glyphicon glyphicon-unchecked"></i>' . $this->selectLabel,
            'unselectLabel' => '<i class="glyphicon glyphicon-check"></i>'   . $this->unselectLabel,
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
        $labels = Html::tag('span', $settings['selectLabel'], $sOptions) . Html::tag('span', $settings['unselectLabel'], $uOptions);
        $out = Html::tag('span', $labels, $options);
        echo Html::tag('span', $out, ['id' => 'parent-' . $options['id'], 'style' => 'display:none']);
    }


    /**
     * Registers Assets
     */
    public function registerAssets()
    {
        $view = $this->getView();
        Select2Asset::register($view);
        KakSelect2Asset::register($view);
        
        KakSelect2LanguageAsset::register($view)->addLanguage($this->language);

        if($this->theme == self::THEME_BOOTSTRAP) {
            ThemeBootstrap::register($view);
        }

        $id = $this->options['id'];
        $clientOptions = Json::htmlEncode($this->clientOptions);

        $view->registerJs("jQuery('#{$id}').kakSelect2({$clientOptions});" , $view::POS_READY, self::JS_KEY . $id );
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
            $this->options['data-multiple'] = $this->boolToStr(true);
            $this->options['multiple'] = true;
        }

        if (isset($this->tags)) {
            $this->options['data-tags'] = $this->tags;
            $this->options['multiple'] = true;
        }

        if($this->loadItemsUrl!==null){
            $this->options['data-load-items-url'] = Url::to($this->loadItemsUrl);
        }

        if ($this->toggleEnable)
            $this->options['data-toggle-enable'] = $this->boolToStr($this->toggleEnable);

        if ($this->language)
            $this->options['data-language'] = $this->language;

        if (isset($this->ajax)) {
            $this->options['data-ajax--url'] = Url::to($this->ajax);

            $this->options['data-ajax--cache'] = $this->boolToStr($this->ajax);
            $this->options['data-minimum-input-length'] = $this->minimumInputLength;
        }

        if (isset($this->placeholder))
            $this->options['data-placeholder'] = $this->placeholder;

        $this->clientOptions['theme']    = $this->theme;

        Html::addCssStyle($this->options,['width'=>'100%'],false);
        Html::addCssClass($this->options,'select2 form-control');
    }

    protected function boolToStr($var)
    {
        return $var===true ? 'true' : 'false';
    }

}
