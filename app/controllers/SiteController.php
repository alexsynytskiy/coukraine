<?php

namespace app\controllers;

use app\components\NewsHelper;
use yii\easyii\components\helpers\CategoryHelper;
use yii\easyii\components\helpers\LanguageHelper;
use yii\easyii\modules\gallery\api\Gallery;
use yii\easyii\modules\news\api\News;
use yii\easyii\modules\page\api\Page;
use yii\web\Controller;

class SiteController extends Controller
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
        \Yii::$app->seo->setTitle('Головна');
        \Yii::$app->seo->setDescription('Фундація З країни в Україну - ми робимо країну краще');
        \Yii::$app->seo->setKeywords('фундація, україна');

        $mainSlider = [
            'main-slide-1',
            'main-slide-4',
            'main-slide-3',
            'main-slide-2',
        ];

        $slides = [];
        $ourDirections = null;

        if (\Yii::$app->language !== LanguageHelper::LANG_UA) {
            $ourDirections = Page::get(['our-directions', 'en']);
        } else {
            $ourDirections = Page::get(['our-directions']);
        }

        foreach ($mainSlider as $slideSlug) {
            if (\Yii::$app->language !== LanguageHelper::LANG_UA) {
                $slides[] = Page::get([$slideSlug, 'en']);
            } else {
                $slides[] = Page::get([$slideSlug]);
            }
        }

        $projects = [];
        $projectHealth = Gallery::cat('projects-health');
        $projects = array_merge($projects, $projectHealth->photos(['limit' => 2]));

        $projectCulture = Gallery::cat('projects-culture');
        $projects = array_merge($projects, $projectCulture->photos(['limit' => 2]));

        $projectEducation = Gallery::cat('projects-education');
        $projects = array_merge($projects, $projectEducation->photos(['limit' => 2]));

        $news = NewsHelper::prepareNews();
        $hasToLoadMore = false;
        $lastItemId = 0;

        if (count($news) > News::ITEMS_PER_PAGE) {
            $hasToLoadMore = true;

            array_pop($news);
            $lastItemId = $news[count($news) - 1]->id;
        }

        return $this->render('index', [
            'news' => $news,
            'hasToLoadMore' => $hasToLoadMore,
            'lastItemId' => $lastItemId,
            'mainSlider' => $slides,
            'ourDirections' => $ourDirections,
            'photosProjects' => $projects,
        ]);
    }

    public function actionHealth()
    {
        \Yii::$app->seo->setTitle('Здоров\'я');
        \Yii::$app->seo->setDescription('Фундація З країни в Україну - ми робимо країну краще');
        \Yii::$app->seo->setKeywords('фундація, україна');

        $project = Gallery::cat('projects-health');
        $photos = $project->photos(['limit' => 3]);

        $news = NewsHelper::prepareNews(
            '',
            [CategoryHelper::CATEGORY_HEALTH]
        );
        $hasToLoadMore = false;
        $lastItemId = 0;

        if (count($news) > News::ITEMS_PER_PAGE) {
            $hasToLoadMore = true;

            array_pop($news);
            $lastItemId = $news[count($news) - 1]->id;
        }

        return $this->render('health', [
            'news' => $news,
            'hasToLoadMore' => $hasToLoadMore,
            'lastItemId' => $lastItemId,
            'photosProjects' => $photos,
        ]);
    }

    public function actionCulture()
    {
        \Yii::$app->seo->setTitle('Культура');
        \Yii::$app->seo->setDescription('Фундація З країни в Україну - ми робимо країну краще');
        \Yii::$app->seo->setKeywords('фундація, україна');

        $project = Gallery::cat('projects-culture');
        $photos = $project->photos(['limit' => 3]);

        $news = NewsHelper::prepareNews(
            '',
            [CategoryHelper::CATEGORY_CULTURE]
        );
        $hasToLoadMore = false;
        $lastItemId = 0;

        if (count($news) > News::ITEMS_PER_PAGE) {
            $hasToLoadMore = true;

            array_pop($news);
            $lastItemId = $news[count($news) - 1]->id;
        }

        return $this->render('culture', [
            'news' => $news,
            'hasToLoadMore' => $hasToLoadMore,
            'lastItemId' => $lastItemId,
            'photosProjects' => $photos,
        ]);
    }

    public function actionEducation()
    {
        \Yii::$app->seo->setTitle('Освіта');
        \Yii::$app->seo->setDescription('Фундація З країни в Україну - ми робимо країну краще');
        \Yii::$app->seo->setKeywords('фундація, україна');

        $project = Gallery::cat('projects-education');
        $photos = $project->photos(['limit' => 3]);

        $news = NewsHelper::prepareNews(
            '',
            [CategoryHelper::CATEGORY_EDUCATION]
        );
        $hasToLoadMore = false;
        $lastItemId = 0;

        if (count($news) > News::ITEMS_PER_PAGE) {
            $hasToLoadMore = true;

            array_pop($news);
            $lastItemId = $news[count($news) - 1]->id;
        }

        return $this->render('education', [
            'news' => $news,
            'hasToLoadMore' => $hasToLoadMore,
            'lastItemId' => $lastItemId,
            'photosProjects' => $photos,
        ]);
    }

    public function actionHype()
    {
        \Yii::$app->seo->setTitle('Освітній хайп');
        \Yii::$app->seo->setDescription('Фундація З країни в Україну - ми робимо країну краще');
        \Yii::$app->seo->setKeywords('фундація, україна');

        $news = NewsHelper::prepareNews(
            '',
            [CategoryHelper::CATEGORY_HYPE]
        );
        $hasToLoadMore = false;
        $lastItemId = 0;

        if (count($news) > News::ITEMS_PER_PAGE) {
            $hasToLoadMore = true;

            array_pop($news);
            $lastItemId = $news[count($news) - 1]->id;
        }

        return $this->render('hype', [
            'news' => $news,
            'hasToLoadMore' => $hasToLoadMore,
            'lastItemId' => $lastItemId,
        ]);
    }

    public function actionTeam()
    {
        \Yii::$app->seo->setTitle('Культура');
        \Yii::$app->seo->setDescription('Фундація З країни в Україну - ми робимо країну краще');
        \Yii::$app->seo->setKeywords('фундація, україна');

        $team = Gallery::cat('komanda');
        $teamMembers = $team->photos();

        return $this->render('team', ['teamMembers' => $teamMembers]);
    }
}
