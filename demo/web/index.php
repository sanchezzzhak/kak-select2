<?php

use yii\web\Application;

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../vendor/yiisoft/yii2/Yii.php';


$config = require __DIR__ . '/../config/main.php';
$app = new Application([

   'defaultRoute' => 'site',
   'controllerPath' => __DIR__ . '/../controllers',
   'components' => [
       'urlManager' => [
           'enablePrettyUrl' => true,
           'showScriptName' => false,
       ],
       'request' => [
           'cookieValidationKey' => 'demo-test'
       ]
   ],
    ...$config
]);

$app->run();
