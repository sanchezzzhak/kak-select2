<?php

namespace kak\widgets\select2;

use yii\helpers\Html;
use yii\base\InvalidConfigException;

class Select2 extends \yii\widgets\InputWidget
{
    const THEME_DEFAULT = 'default';
    const THEME_BOOTSTRAP = 'bootstrap';


    /**
     * @var array the HTML attributes for the widget container tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $language;
    public $options = [];
    public $items = [];

    public $multiple = false;
    public $theme = self::THEME_BOOTSTRAP;

    public function init()
    {
        $this->initDefaultOption();

        // render input
        echo $this->hasModel()
            ? Html::activeDropDownList($this->model, $this->attribute, $this->items , $this->options)
            : Html::dropDownList($this->name, $this->value, $this->items, $this->options);

        // asset attach
        $view = $this->getView();
        Select2Asset::register($view)->addLanguage($this->language);
    }


    protected function initDefaultOption()
    {
        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }
        if(!isset($this->options['multiple']))
        {
            $this->options['multiple'] = $this->multiple;
        }
    }

}
