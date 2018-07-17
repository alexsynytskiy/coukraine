<?php
/* @var $this yii\web\View */
/* @var $item yii\easyii\modules\news\api\NewsObject */

?>

<div class="timeline-section <?= $item->category ?>">
    <div class="col-md-5 timgline-img wow fadeInLeft">
        <img class="img-responsive" src="<?= $item->image ?>" alt="" />
    </div>
    <div class="history-separator"></div>
    <div class="col-md-5 timeline-section-detail wow fadeInRight">
        <div class="wow fadeIn">
            <div class="date">
                <span class="day"><?= date('d', $item->time); ?></span>
                <?php $monthNum = date('m', $item->time); ?>
                <span class="month"><?= Yii::t('easyii', date('F', mktime(0, 0, 0, $monthNum, 10))); ?></span>
                <span class="year"><?= date('Y', $item->time); ?></span>
            </div>
            <div class="meta"> <span class="category"><i class="fa fa-tags"></i> <?= \yii\easyii\components\helpers\CategoryHelper::getCategories()[$item->category] ?></span> </div>
            <a href="<?= \yii\helpers\Url::to(['/news/'.$item->slug]) ?>">
                <h2><?= $item->title ?></h2>
                <p><?= $item->short ?></p>
            </a>
            <a class="btn btn-primary" href="<?= \yii\helpers\Url::to(['/news/'.$item->slug]) ?>">Читати далі</a></div>
    </div>
</div>