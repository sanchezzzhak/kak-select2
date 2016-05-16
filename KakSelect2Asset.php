<?php
namespace kak\widgets\select2;
use yii\web\AssetBundle;

class KakSelect2Asset extends AssetBundle
{
    public $sourcePath = '@vendor/kak/select2/assets';

    public $depends = [
        'yii\web\JqueryAsset',
    ];
    public $js = [
        'kak-select2.js'
    ];
    public $css = [
        'kak-select2.css'
    ];
} 