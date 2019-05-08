<?php

namespace app\components;

use yii\easyii\components\helpers\CategoryHelper;
use yii\easyii\components\helpers\LanguageHelper;
use yii\easyii\modules\news\api\News;
use yii\helpers\ArrayHelper;

/**
 * Class NewsHelper
 * @package app\components
 */
class NewsHelper
{
    /**
     * @param string $tag
     * @param array $category
     * @param int $limit
     * @param array $additionalParams
     *
     * @return array|null
     */
    public static function prepareNews($tag = '',
                                       array $category = [
                                           CategoryHelper::CATEGORY_HEALTH,
                                           CategoryHelper::CATEGORY_CULTURE,
                                           CategoryHelper::CATEGORY_EDUCATION
                                       ],
                                       $limit = News::ITEMS_PER_PAGE, array $additionalParams = [])
    {
        $params = [
            'limit' => $limit + 1,
            'language' => \Yii::$app->language !== LanguageHelper::LANG_UA ? 'en' : LanguageHelper::LANG_UA,
        ];

        if ($tag !== '') {
            $params = ArrayHelper::merge($params, ['tags' => $tag]);
        }

        if($additionalParams) {
            $params = ArrayHelper::merge($params, $additionalParams);
        }
        else {
            $params = ArrayHelper::merge($params, [
                'where' => [
                    ['category' => $category],
                ]
            ]);
        }

        //print_r($params); die;

        return News::items($params);
    }
}
