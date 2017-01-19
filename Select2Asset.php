<?php

namespace kak\widgets\select2;

use yii\web\AssetBundle;

/**
 * Class Select2Asset
 * @package kak\widgets\select2
 */
class Select2Asset extends AssetBundle
{
    public $sourcePath = '@bower/select2/dist';

    public $css = [
        'css/select2' . (!YII_DEBUG ? ".min" : "") . ".css"
    ];

    public $js = [
        'js/select2' . (!YII_DEBUG ? ".min" : "") . ".js"
    ];

    public $depends = [
        'yii\web\JqueryAsset'
    ];

} 