<?php

/* @var $this yii\web\View */
/* @var $news yii\easyii\modules\news\api\NewsObject[] */
/* @var $mainSlider yii\easyii\modules\page\api\PageObject[] */
/* @var $ourDirections yii\easyii\modules\page\api\PageObject */
/* @var $photosProjects yii\easyii\modules\gallery\api\PhotoObject[] */
/* @var bool $hasToLoadMore */
/* @var int $lastItemId */

$asset = \app\assets\AppAsset::register($this);
?>

<div id="main-slider">
    <div class="container-fluid">
        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 no-padding">
                <div class="tp-banner-container">
                    <div class="tp-banner" >
                        <ul>	<!-- SLIDE  -->
                            <?php foreach ($mainSlider as $slide): ?>
                                <?= $slide->text ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section id="activity" class="padding">
    <div class="container">
        <div class="row">
            <?= $ourDirections->text ?>
        </div>
    </div>

</section>

<section class="padding cta style-one dark wow zoomIn">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-xs-6">
                <h2>Підтримайте Наш Проект:</h2> </div>
            <div class="col-md-6"><a href="/donate" class="donate btn btn-info btn-lg">Фондувати</a> </div>
        </div>
    </div>
</section>

<section class="padding" id="news">
    <div class="container">
        <div class="row">
            <div class="section-title wow zoomIn">
                <h1>Новини</h1>
                <p>Слідкуйте за нашою діяльністю:</p>
            </div>

            <?php if(count($news)): ?>
                <div id="news-list">
                    <?php foreach ($news as $item): ?>
                        <?= $this->render('news-item', ['item' => $item]) ?>
                    <?php endforeach; ?>
                </div>

                <?php if ($hasToLoadMore): ?>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-lg-12">
                            <a href="#"
                               id="load-more-news"
                               class="button"
                               data-last-id="<?= $lastItemId ?>">Більше новин</a>
                        </div>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="panel-footer">
                    <div class="heading-elements">
                        <span class="heading-text text-semibold">Новин поки немає</span>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Here donate block must be -->
<section class="themegradient partners-main" id="partners">
    <div class="container">
        <div class="row text-center wow fadeInDown">
            <ul class="logos">
                <?php foreach ($photosProjects as $project): ?>
                    <?php $activeLink = isset($project->link) && !empty($project->link); ?>
                    <li class="item">
                        <?php if($activeLink): ?>
                            <a target="_blank" href="<?= \yii\helpers\Html::encode($project->link) ?>">
                        <?php endif; ?>
                                <img style="max-height: 90px;" src="<?= \yii\helpers\Html::encode($project->image) ?>" alt="<?= $project->description ?>" />
                                <span><?= $project->description ?></span>
                        <?php if($activeLink): ?>
                            </a>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</section>

<?php
$pageOptions = \yii\helpers\Json::encode([
    'loadMoreUrl' => '/news/load-more/',
]);

$this->registerJs('NewsPage(' . $pageOptions . ')');
?>