<?php

namespace kak\widgets\select2;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\base\InvalidConfigException;
use yii\helpers\Json;
use yii\helpers\Url;

class Select2 extends \yii\widgets\InputWidget
{
    const THEME_DEFAULT   = 'classic';
    const THEME_BOOTSTRAP = 'bootstrap';


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
    public $tags;
    public $multiple      = false;
    public $theme         = self::THEME_BOOTSTRAP;
    public $placeholder;

    /** @var bool The first element empty */
    public $firstItemEmpty = false;

    public $clientOptions = [];
    /** @var array */
    public $items = [];
    public $data;

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

        $view->registerJs("jQuery('#{$id}').select2({$clientOptions})");
    }


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
            $this->options['data-ajax--cache'] = 'true';
        }

        if (isset($this->placeholder))
            $this->options['data-placeholder'] = $this->placeholder;

        $this->clientOptions['theme']    = $this->theme;

        Html::addCssStyle($this->options,['width'=>'100%'],false);
        Html::addCssClass($this->options,'select2 form-control');


    }

}
