<?php
namespace yii\easyii\modules\feedback\api;

use Yii;
use yii\easyii\modules\feedback\models\Feedback as FeedbackModel;

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use yii\widgets\ActiveForm;
use yii\easyii\widgets\ReCaptcha;


/**
 * Feedback module API
 * @package yii\easyii\modules\feedback\api
 *
 * @method static string form(array $options = []) Returns fully worked standalone html form.
 * @method static array save(array $attributes) If you using your own form, this function will be useful for manual saving feedback's.
 */

class Feedback extends \yii\easyii\components\API
{
    const SENT_VAR = 'feedback_sent';

    private $_defaultFormOptions = [
        'errorUrl' => '',
        'successUrl' => ''
    ];

    public function api_form($options = [])
    {
        $model    = new FeedbackModel;
        $settings = Yii::$app->getModule('admin')->activeModules['feedback']->settings;
        $options  = array_merge($this->_defaultFormOptions, $options);

        ob_start();
        $form = ActiveForm::begin([
            'action' => Url::to(['/admin/feedback/send']),
            'options' => [
                'class'   => 'contact-form',
                'enctype' => 'multipart/form-data'
            ],
            'fieldConfig' => [
                'template' => "<div class=\"form-group\">{input}</div>",
                'options' => [
                    'tag' => false,
                ],
            ],
        ]);

            echo Html::hiddenInput('errorUrl', $options['errorUrl'] ? $options['errorUrl'] : Url::current([self::SENT_VAR => 0]));
            echo Html::hiddenInput('successUrl', $options['successUrl'] ? $options['successUrl'] : Url::current([self::SENT_VAR => 1]));
    
            echo $form->field($model, 'name')->textInput(['class' => 'form-control', 'id' => 'first-name', 'placeholder' => 'Ім\'я']);
            
            echo $form->field($model, 'surname')->textInput(['class' => 'form-control', 'id' => 'last-name', 'placeholder' => 'Прізвище']);
    
            echo $form->field($model, 'email')->input('email', ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'E-mail']);
    
            echo $form->field($model, 'text')->textarea(['class' => 'form-control', 'rows' => '7', 'placeholder' => 'Повідомлення']);
    
            if($settings['enableCaptcha']) echo $form->field($model, 'reCaptcha')->widget(ReCaptcha::className());
    
            echo '<div class="row"><div class="col-md-4">';
                echo Html::submitButton('Надіслати', ['class' => 'send-message btn btn-primary btn-block btn-lg btn-fill']);
            echo '</div></div>';
        
        ActiveForm::end();

        return ob_get_clean();
    }

    public function api_save($data)
    {
        $model = new FeedbackModel($data);
        if($model->save()){
            return ['result' => 'success'];
        } else {
            return ['result' => 'error', 'error' => $model->getErrors()];
        }
    }
}