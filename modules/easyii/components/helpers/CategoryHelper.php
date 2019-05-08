<?php

namespace yii\easyii\components\helpers;

/**
 * Class CategoryHelper
 * @package yii\easyii\components\helpers
 */
class CategoryHelper
{
    /**
     * Const allowed languages
     */
    const CATEGORY_HEALTH = 'health';
    const CATEGORY_EDUCATION = 'education';
    const CATEGORY_CULTURE = 'culture';
    const CATEGORY_HYPE = 'hype';

    /**
     * @return array
     */
    public static function getCategories()
    {
        return [
            self::CATEGORY_HEALTH => 'Здоров\'я',
            self::CATEGORY_EDUCATION => 'Освіта',
            self::CATEGORY_CULTURE => 'Культура',
            self::CATEGORY_HYPE => 'Освітній хайп',
        ];
    }
}