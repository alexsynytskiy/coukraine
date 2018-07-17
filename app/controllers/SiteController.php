<?php

namespace app\controllers;

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

    /**
     * @param     $category
     * @param int $limit
     *
     * @return array|null
     */
    public function getNewsList($category = [
        CategoryHelper::CATEGORY_HEALTH, 
        CategoryHelper::CATEGORY_CULTURE, 
        CategoryHelper::CATEGORY_EDUCATION], $limit = 9) {
        $news = null;

        if(\Yii::$app->language != LanguageHelper::LANG_UA) {
            $news = News::items([
                'limit'    => $limit,
                'language' => 'en',
                'tags'     => \Yii::$app->request->get('tag'),
                'where'    => [
                    'category' => $category,
                ],
            ]);
        }
        else {
            $news = News::items([
                'limit' => $limit,
                'tags'  => \Yii::$app->request->get('tag'),
                'where'    => [
                    'category' => $category,
                ],
            ]);
        }
        
        return $news;
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

        $slides        = [];
        $ourDirections = null;

        if(\Yii::$app->language != LanguageHelper::LANG_UA) {
            $ourDirections = Page::get(['our-directions', 'en']);
        }
        else {
            $ourDirections = Page::get(['our-directions']);
        }

        foreach ($mainSlider as $slideSlug) {
            if(\Yii::$app->language != LanguageHelper::LANG_UA) {
                $slides[] = Page::get([$slideSlug, 'en']);
            }
            else {
                $slides[] = Page::get([$slideSlug]);
            }
        }

        $projects      = [];
        $projectHealth = Gallery::cat('projects-health');
        $projects      = array_merge($projects, $projectHealth->photos(['limit' => 2]));

        $projectCulture = Gallery::cat('projects-culture');
        $projects       = array_merge($projects, $projectCulture->photos(['limit' => 2]));

        $projectEducation = Gallery::cat('projects-education');
        $projects         = array_merge($projects, $projectEducation->photos(['limit' => 2]));

        return $this->render('index', [
            'news'           => $this->getNewsList(),
            'mainSlider'     => $slides,
            'ourDirections'  => $ourDirections,
            'photosProjects' => $projects,
        ]);
    }

    public function actionHealth()
    {
        \Yii::$app->seo->setTitle("Здоров'я");
        \Yii::$app->seo->setDescription('Фундація З країни в Україну - ми робимо країну краще');
        \Yii::$app->seo->setKeywords('фундація, україна');
        
        $project = Gallery::cat('projects-health');
        $photos  = $project->photos(['limit' => 3]);

        return $this->render('health', ['news' => $this->getNewsList([
            CategoryHelper::CATEGORY_HEALTH
        ]),
            'photosProjects' => $photos,
        ]);
    }

    public function actionCulture()
    {
        \Yii::$app->seo->setTitle("Культура");
        \Yii::$app->seo->setDescription('Фундація З країни в Україну - ми робимо країну краще');
        \Yii::$app->seo->setKeywords('фундація, україна');
        
        $project = Gallery::cat('projects-culture');
        $photos  = $project->photos(['limit' => 3]);

        return $this->render('culture', ['news' => $this->getNewsList([
            CategoryHelper::CATEGORY_CULTURE
        ]),
            'photosProjects' => $photos,
        ]);
    }

    public function actionEducation()
    {
        \Yii::$app->seo->setTitle("Освіта");
        \Yii::$app->seo->setDescription('Фундація З країни в Україну - ми робимо країну краще');
        \Yii::$app->seo->setKeywords('фундація, україна');
        
        $project = Gallery::cat('projects-education');
        $photos  = $project->photos(['limit' => 3]);

        return $this->render('education', ['news' => $this->getNewsList([
            CategoryHelper::CATEGORY_EDUCATION
        ]),
            'photosProjects' => $photos,
        ]);
    }

    public function actionTeam()
    {
        \Yii::$app->seo->setTitle("Культура");
        \Yii::$app->seo->setDescription('Фундація З країни в Україну - ми робимо країну краще');
        \Yii::$app->seo->setKeywords('фундація, україна');
        
        $team = Gallery::cat('komanda');
        $teamMembers  = $team->photos();

        return $this->render('team', ['teamMembers' => $teamMembers]);
    }
}