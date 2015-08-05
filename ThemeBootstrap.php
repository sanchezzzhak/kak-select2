<?php
namespace kak\widgets\select2;
use yii\web\AssetBundle;

class ThemeBootstrap extends AssetBundle
{
    public $sourcePath = '@bower/select2-bootstrap-theme/dist';

    public function init()
    {
        $this->css[] = 'css/select2-bootstrap' . (!YII_DEBUG ? ".min" : "") . ".css";
    }
}