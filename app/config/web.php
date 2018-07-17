<?php

$params = require(__DIR__ . '/params.php');

$basePath =  dirname(__DIR__);
$webroot = dirname($basePath);

$config = [
    'id'             => 'app',
    'basePath'       => $basePath,
    'bootstrap'      => [
        'log',
        "app\\components\\AdminBootstrap",
    ],
    'language'       => 'uk',
    'sourceLanguage' => 'uk',
    'timeZone'       => 'Europe/Kiev',
    'runtimePath'    => $webroot . '/runtime',
    'vendorPath'     => $webroot . '/vendor',
    'on beforeRequest' => function () use (&$config) {
        $app      = Yii::$app;
        $pathInfo = $app->request->pathInfo;

        $getParam = $app->request->get('parent');
        preg_match('/[^\/]+$/', $pathInfo, $matches);

        $startRedirect = ['admin', 'site', 'location'];
        $stopRedirect  = ['items', 'edit', 'photos', 'settings', 'index', 'list', 'redactor'];

        $redirect = false;

        if(empty($getParam) && (isset($matches[0]) && !is_numeric($matches[0]))) {
            foreach ($startRedirect as $startItem) {
                if (strpos($pathInfo, $startItem) !== false) {
                    $redirect = true;
                    break;
                }
            }

            foreach ($stopRedirect as $stopItem) {
                if (strpos($pathInfo, $stopItem) !== false) {
                    $redirect = false;
                    break;
                }
            }
        }

        if (!$app->request->post() && $redirect && !empty($pathInfo) && substr($pathInfo, -1) !== '/') {
            $app->response->redirect('/' . rtrim($pathInfo) . '/', 301);
            $app->end();
        }
    },
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '5EQS1r3ySDhlyuurHzud',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,//set this property to false to send mails to real email addresses
            //comment the following array to send mail using php's mail function
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host'  => 'mx1.mirohost.net',
                'username' => 'alexsynytskiy@coukraine.org',
                'password' => 'z91XRQpzgqXA',
                'port'     => 25,
                'encryption' => 'tls',
            ],
        ],
        'urlManager' => [
//            'class' => 'codemix\localeurls\UrlManager',
//            'languages' => ['ua' => 'uk', 'en' => 'en-US', 'sk', 'pl', 'hu', 'ro'],
            'rules' => [
                'team/'                              => 'site/team',
                'health/'                            => 'site/health',
                'education/'                         => 'site/education',
                'culture/'                           => 'site/culture',
                '<controller:\w+>/'                  => '<controller>/index',
                '<controller:\w+>/<slug:[\w-]+>'     => '<controller>/view',
                '<controller:\w+>/<action:\w+>/'     => '<controller>/<action>',
                '<controller:\w+>/cat/<slug:[\w-]+>' => '<controller>/cat',
            ],
            //'enableStrictParsing' => false,
            //'enableLanguageDetection' => false,
            //'enableDefaultLanguageUrlCode' => true,
        ],
        'assetManager' => [
            'class'   => 'yii\web\AssetManager',
            'bundles' => [
                //Disable this bundle, because we have our jquery
                'yii\web\JqueryAsset'          => [
                    'sourcePath' => null,   // do not publish the bundle
                    'js'         => [],
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'sourcePath' => null,   // do not publish the bundle
                    'css'        => [],
                    'js'         => [],
                ],
                //Overrides standard yii.activeForm.js file
                //@see https://github.com/yiisoft/yii2/issues/12174
                'yii\widgets\ActiveFormAsset'  => [
                    'js'         => [
                        'yii.activeForm.js',
                    ],
                    'depends'    => [
                        'yii\web\YiiAsset',
                    ],
                ],
            ],
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
        'db' => require(__DIR__ . '/db.php'),
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
    
    $config['components']['db']['enableSchemaCache'] = false;
}

return \yii\helpers\ArrayHelper::merge($config, require($webroot . '/modules/easyii/config/easyii.php'));