<?php
namespace yii\easyii\components\helpers;

use acp\components\AcpMsg;
use acp\components\ActiveRecord;
use yii\base\Model;

/**
 * Class CategoryHelper
 * @package yii\easyii\components\helpers
 */
class CategoryHelper
{
    /**
     * Const allowed languages
     */
    const CATEGORY_HEALTH    = 'health';
    const CATEGORY_EDUCATION = 'education';
    const CATEGORY_CULTURE   = 'culture';

    /**
     * @return array
     */
    public static function getCategories() {
        return [
            self::CATEGORY_HEALTH    => 'Здоров\'я',
            self::CATEGORY_EDUCATION  => 'Освіта',
            self::CATEGORY_CULTURE    => 'Культура',
        ];
    }
}