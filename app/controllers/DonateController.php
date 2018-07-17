<?php

namespace app\controllers;

use app\models\form\BalanceForm;
use app\models\PaymentSystem;
use delagics\liqpay\LiqPay;
use yii\easyii\components\helpers\LanguageHelper;
use yii\easyii\modules\page\api\Page;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Controller;

/**
 * Class DonateController
 * @package app\controllers
 */
class DonateController extends Controller
{
    private $_private_key = 'HAMDGoOyD9NC8dMsTniknwYKHJY3ciOiHniwOxTV';    

    public function actionIndex()
    {
        \Yii::$app->seo->setTitle("Фондувати");
        \Yii::$app->seo->setDescription('Фундація З країни в Україну - ми робимо країну краще');
        \Yii::$app->seo->setKeywords('фундація, україна');

        $params = [
            "version"     => 3,
            "public_key"  => "i85948745223",
            "action"      => "pay", 
            "amount"      => 10, 
            "currency"    => "UAH",
            "description" => "Фондувати БФ 'З країни в Україну'",
            "order_id"    => "order_id_{time()}",
            "result_url"  => Url::current(),
            "language"    => "uk",
        ];

        $data      = base64_encode(json_encode($params));
        $signature = $this->cnb_signature($params);

        return $this->render('index', [
            'data'      => $data,
            'signature' => $signature,
        ]);
    }

    /**
     * cnb_signature
     *
     * @param array $params
     *
     * @return string
     */
    public function cnb_signature($params)
    {
        $json      = base64_encode( json_encode($params) );
        $signature = $this->str_to_sign($this->_private_key . $json . $this->_private_key);

        return $signature;
    }

    /**
     * str_to_sign
     *
     * @param string $str
     *
     * @return string
     */
    public function str_to_sign($str)
    {
        $signature = base64_encode(sha1($str,1));

        return $signature;
    }
}