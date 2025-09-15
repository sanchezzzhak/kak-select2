<?php

namespace kak\widgets\select2;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class KakSelect2Asset extends AssetBundle
{
    public $sourcePath = __DIR__ . '/assets';

    public $depends = [
        JqueryAsset::class,
        SlimScrollAsset::class
    ];

    public $js = [
        'kak-select2.js'
    ];

    public $css = [
        'kak-select2.css'
    ];
}
