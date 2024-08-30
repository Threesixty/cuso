<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'cuso-frontend',
    'name' => 'Clubs Utilisateurs Oracle',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-cuso-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-cuso-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'session-cuso-frontend',
            'class' => 'yii\web\Session',
            'cookieParams' => ['httponly' => true, 'lifetime' => 3600*4],
            'timeout' => 3600*4, //session expire
            'useCookies' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'assetManager' => [
            'assetMap' => [
                'google-fonts.css' => '//fonts.googleapis.com/css2?family=Lato:wght@300;400;700',
                'jquery-ui.css' => '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css',
                'jquery-ui.js' => '//code.jquery.com/ui/1.12.1/jquery-ui.js',
            ],
            'bundles' => [
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js'=>[]
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [],
                ],
            ],
        ],
        'urlManager' => [
            'class' => 'codemix\localeurls\UrlManager',
            'languages' => ['fr'],
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
