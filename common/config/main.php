<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'bootstrap' => ['bootstrap'],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'bot' => [
            'class' => \SonkoDmitry\Yii\TelegramBot\Component::class,
            'apiToken' => '637582410:AAGmRPaCLDD0tNlFNaBm9_vX6ca0AMOErP8'
        ],
        'bootstrap' => [
            'class' => \common\components\Bootstrap::className()
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],

];
