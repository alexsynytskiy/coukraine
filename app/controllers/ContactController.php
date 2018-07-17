<?php

namespace app\controllers;

use yii\web\Controller;

class ContactController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        \Yii::$app->seo->setTitle("Контакти");
        \Yii::$app->seo->setDescription('Фундація З країни в Україну - ми робимо країну краще');
        \Yii::$app->seo->setKeywords('фундація, україна');
        
        return $this->render('index', []);
    }
}