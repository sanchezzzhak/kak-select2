<?php
namespace kak\widgets\select2;
use yii\web\AssetBundle;

class Select2AssetLib extends AssetBundle
{
    public $sourcePath = '@vendor/kak/select2/assets';
    public $depends = [
        'yii\web\JqueryAsset'
    ];

    public function init()
    {
        $this->js[] = 'js/select2.init.js' ;
        //(YII_DEBUG ? ".min" : "")  . ".js";
    }
} 