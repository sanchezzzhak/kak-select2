<?php

use yii\bootstrap\BootstrapAsset;
use yii\helpers\Html;
use yii\web\JqueryAsset;
use yii\web\View;

/**
 * @var string $content
 * @var View $this
 */


BootstrapAsset::register($this);
JqueryAsset::register($this)

?>
<?php $this->beginPage() ?><!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
<?php $this->beginBody() ?>
<div class="content content-full-width" id="content">
    <div class="container-fluid">
        <?= $content ?>
    </div>
</div>
<?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
