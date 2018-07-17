<?php

/* @var $this yii\web\View */
/* @var $news yii\easyii\modules\news\api\NewsObject[] */
/* @var $photosProjects yii\easyii\modules\gallery\api\PhotoObject[] */

$asset = \app\assets\AppAsset::register($this);
?>

<section style="padding-top: 120px;"></section>

<section class="culture themegradient culture-themegradient" id="partners">
    <div class="container">
        <div class="row text-center wow fadeInDown">
            <ul class="logos col-lg-12">
                <?php foreach ($photosProjects as $project): ?>
                    <?= $this->render('project-item', ['project' => $project]) ?>
                <?php endforeach; ?>
                <div class="clearfix"></div>
            </ul>
        </div>
    </div>
</section>

<section class="culture-news">
    <div class="container">
        <div class="row">
            <div class="section-title wow zoomIn">
                <h1>Новини</h1>
                <p>Наші новини за напрямом культура:</p>
            </div>
            <?php foreach ($news as $item): ?>
                <?= $this->render('news-item', ['item' => $item]) ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>