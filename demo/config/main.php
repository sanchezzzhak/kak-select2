<?php

return [
    'id' => 'kak-select2-demo',
    'basePath' => dirname(__DIR__),
    'vendorPath' => __DIR__ . '/../../vendor',
    'runtimePath' => __DIR__ . '/../runtime',
    'viewPath' => __DIR__ . '/../views',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
];