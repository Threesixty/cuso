<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'console\controllers',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'controllerMap' => [
        'fixture' => [
            'class' => 'yii\console\controllers\FixtureController',
            'namespace' => 'common\fixtures',
          ],
    ],
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'urlManager' => [
            'class' => 'codemix\localeurls\UrlManager',
            'baseUrl' => '/attitude-hotels',
            //'baseUrl' => '/',
            'hostInfo' => 'https://localhost',
            //'hostInfo' => 'https://attitudeii.greenshift.eu',
            //'hostInfo' => 'https://hotels-attitude.com',
            'languages' => ['fr', 'en', 'de'],
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableLanguageDetection' => true,
            'enableDefaultLanguageUrlCode' => true,
            'normalizer' => [
                'class' => 'yii\web\UrlNormalizer',
                'collapseSlashes' => true,
            ],
            'rules' => [
                '' => 'site/index',
                [
                    'pattern'      => '<url:[0-9a-zA-Z\-\/]+>',
                    'route'        => 'site/content',
                    'encodeParams' => false,
                ],
            ],
        ],
    ],
    'params' => $params,
];
