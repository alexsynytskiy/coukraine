<?php
namespace yii\easyii\modules\feedback\controllers;

use Yii;
use yii\easyii\modules\feedback\models\Feedback as FeedbackModel;

class SendController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = new FeedbackModel;

        $request = Yii::$app->request;

        if ($model->load($request->post())) {
            $returnUrl = $model->save() ? $request->post('successUrl') : $request->post('errorUrl');
            \Yii::$app->session->setFlash('success', 'Дякуємо за відгук! Найближчим часом ми відповімо');
            return $this->redirect($returnUrl);
        } else {
            return $this->redirect(Yii::$app->request->baseUrl);
        }
    }
}