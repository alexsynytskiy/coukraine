<?php
namespace yii\easyii\controllers;

use yii\easyii\modules\lineup\models\Category;
use yii\easyii\modules\news\api\News;
use yii\helpers\StringHelper;

class DefaultController extends \yii\easyii\components\Controller
{
    public function actionIndex()
    {
        $newsList = News::items();
        $news     = [];

        /** @var \yii\easyii\modules\news\models\News $item */
        foreach ($newsList as $item) {
            if($item->title && $item->views) {
                $news['title'][] = StringHelper::truncate($item->title, 40);
                $news['views'][] = $item->views;
            }
        }

        return $this->render('index', [
            'news'    => $news
        ]);
    }
}