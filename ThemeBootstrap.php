<?php
namespace kak\widgets\select2;
use yii\web\AssetBundle;

class ThemeBootstrap extends AssetBundle
{
    public $sourcePath = __DIR__ . '/assets';

    public $css = [
        'select2-bootstrap-theme' . (!YII_DEBUG ? '.min' : '') . '.css',
    ];
}
