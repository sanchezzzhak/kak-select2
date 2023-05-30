<?php
namespace kak\widgets\select2;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class SlimScrollAsset extends AssetBundle
{
    public $sourcePath = '@bower/slimscroll';
    public $depends = [
        JqueryAsset::class
    ];
    public $js = [
        'jquery.slimscroll.min.js'
    ];

    public $publishOptions = [
        'only' => [
            'jquery.slimscroll.min.js',
        ],
        'except' => [
            'examples',
        ]
    ];
}
