<?php
namespace kak\widgets\select2;
use yii\web\AssetBundle;

class Select2Asset extends AssetBundle
{
    public $sourcePath = '@bower/select2/dist';
    public $depends = [
        'yii\web\JqueryAsset'
    ];

    public function init()
    {
        $this->js[] = 'js/select2' . (YII_DEBUG ? ".min" : "")  . ".js";
        $this->css[] = 'js/select2' . (YII_DEBUG ? ".min" : "") . ".css";
    }


    public function addLanguage($lang)
    {
        $lang =!empty($lang) ? $lang : 'en';
        $this->js[] = 'js/i18n'.$lang .'.js';
        return $this;
    }

} 