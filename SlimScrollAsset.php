<?php
namespace kak\widgets\select2;

use yii\web\AssetBundle;

class SlimScrollAsset extends AssetBundle
{
    public $sourcePath = '@bower/slimscroll';
    public $depends = [
        'yii\web\JqueryAsset'
    ];
    public $js = [
        'jquery.slimscroll.min.js'
    ];
} 