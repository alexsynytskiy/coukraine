<?php

/* @var $this yii\web\View */

$asset = \app\assets\AppAsset::register($this);
?>

<section class="padding" style="padding-top: 120px;">
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-lg-2"></div>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                <h2>Надіслати нам листа</h2>
                <?= yii\easyii\modules\feedback\api\Feedback::form(['successUrl' => \yii\helpers\Url::to(['/contact']), 'errorUrl' => \yii\helpers\Url::to(['/contact'])]); ?>
            </div>
        </div>
    </div>
</section>