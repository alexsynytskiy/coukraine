<?php

namespace app\controllers;

use app\components\NewsHelper;
use yii\easyii\components\helpers\CategoryHelper;
use yii\easyii\components\helpers\LanguageHelper;
use yii\easyii\modules\news\api\News;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

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

    /**
     * @param string $tag
     * @return string
     */
    public function actionIndex($tag = '')
    {
        \Yii::$app->seo->setTitle('Новини');
        \Yii::$app->seo->setDescription('Фундація З країни в Україну - ми робимо країну краще');
        \Yii::$app->seo->setKeywords('фундація, україна');

        $news = NewsHelper::prepareNews($tag);
        $hasToLoadMore = false;
        $lastItemId = 0;

        if (count($news) > News::ITEMS_PER_PAGE) {
            $hasToLoadMore = true;

            array_pop($news);
            $lastItemId = $news[count($news) - 1]->id;
        }

        $params = [
            'news' => $news,
            'hasToLoadMore' => $hasToLoadMore,
            'lastItemId' => $lastItemId,
            'tag' => $tag,
        ];

        return $this->render('index', $params);
    }

    /**
     * @param null $slug
     *
     * @return string
     */
    public function actionView($slug = null)
    {
        if (!$slug) {
            return $this->redirect(['news/index']);
        }

        $news = null;

        if (\Yii::$app->language !== LanguageHelper::LANG_UA) {
            $news = News::get([$slug, 'en']);
        } else {
            $news = News::get([$slug]);
        }

        isset($news->title) ? \Yii::$app->seo->setTitle($news->title) : null;
        isset($news->seo->description) ? \Yii::$app->seo->setDescription($news->seo->description) : null;
        isset($news->seo->keywords) ? \Yii::$app->seo->setKeywords($news->seo->keywords) : null;

        return $this->render('view', ['news' => $news]);
    }

    /**
     * @return array
     * @throws NotFoundHttpException
     */
    public function actionLoadMore()
    {
        if (!\Yii::$app->request->isPost || !\Yii::$app->request->isAjax) {
            throw new NotFoundHttpException();
        }

        \Yii::$app->response->format = Response::FORMAT_JSON;

        $lastNewsId = (int)\Yii::$app->request->post('lastId');
        $category = \Yii::$app->request->post('category');

        if (!$lastNewsId) {
            return [];
        }

        $tag = \Yii::$app->request->get('tag');

        $olderNews = NewsHelper::prepareNews(
            $tag,
            [],
            News::ITEMS_PER_PAGE,
            [
                'where' => [
                    ['<', 'news_id', $lastNewsId],
                    [
                        'category' => $category === 'all' ? [
                            CategoryHelper::CATEGORY_HEALTH,
                            CategoryHelper::CATEGORY_CULTURE,
                            CategoryHelper::CATEGORY_EDUCATION
                        ] : [$category]
                    ],
                ]
            ]
        );
        $hasToLoadMore = false;
        $lastItemId = 0;

        if (count($olderNews) > News::ITEMS_PER_PAGE) {
            $hasToLoadMore = true;
            $lastItemId = $olderNews[count($olderNews) - 1]->id;

            array_pop($olderNews);
        }

        $items = '';

        foreach ($olderNews as $item) {
            $items .= $this->renderPartial('news-item', ['item' => $item]);
        }

        return [
            'hasToLoadMore' => $hasToLoadMore,
            'lastItemId' => $lastItemId,
            'items' => $items,
        ];
    }
}
