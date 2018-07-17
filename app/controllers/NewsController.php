<?php

namespace app\controllers;

use yii\easyii\components\helpers\LanguageHelper;
use yii\easyii\modules\news\api\News;
use yii\easyii\modules\page\api\Page;
use yii\helpers\VarDumper;
use yii\web\Controller;

/**
 * Class NewsController
 * @package app\controllers
 */
class NewsController extends Controller
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
        \Yii::$app->seo->setTitle("Новини");
        \Yii::$app->seo->setDescription('Фундація З країни в Україну - ми робимо країну краще');
        \Yii::$app->seo->setKeywords('фундація, україна');

        $news = null;

        if(\Yii::$app->language != LanguageHelper::LANG_UA) {
            $news = News::items(['limit' => 6, 'language' => 'en', 'tags' => \Yii::$app->request->get('tag')]);
        }
        else {
            $news = News::items(['limit' => 6, 'tags' => \Yii::$app->request->get('tag')]);
        }

        $showLoadMore = false;
        if(count($news) > 6) {
            $showLoadMore = true;
            array_pop($news);
        }
        
        $tag = \Yii::$app->request->get('tag');

        return $this->render('index', [
            'news'         => $news,
            'showLoadMore' => $showLoadMore,
            'tag'          => $tag,
        ]);
    }

    /**
     * @param null $slug
     *
     * @return string
     */
    public function actionView($slug = null)
    {        
        if(!$slug) {
            return $this->redirect(['news/index']);
        }

        $news = null;

        if(\Yii::$app->language != LanguageHelper::LANG_UA) {
            $news = News::get([$slug, 'en']);
        }
        else {
            $news = News::get([$slug]);
        }

        (isset($news->title)) ? \Yii::$app->seo->setTitle($news->title) : null;
        (isset($news->seo->description)) ? \Yii::$app->seo->setDescription($news->seo->description) : null;
        (isset($news->seo->keywords)) ? \Yii::$app->seo->setKeywords($news->seo->keywords) : null;
        
        return $this->render('view', ['news' => $news]);
    }
}