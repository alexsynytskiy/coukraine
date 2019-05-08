<?php

/* @var $this yii\web\View */
/* @var $news yii\easyii\modules\news\api\NewsObject[] */
/* @var $photosProjects yii\easyii\modules\gallery\api\PhotoObject[] */
/* @var bool $hasToLoadMore */
/* @var int $lastItemId */

$asset = \app\assets\AppAsset::register($this);
\app\assets\LazyLoadAsset::register($this);
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
                               class="button culture"
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

<?php
$pageOptions = \yii\helpers\Json::encode([
    'loadMoreUrl' => '/news/load-more/',
    'category' => \yii\easyii\components\helpers\CategoryHelper::CATEGORY_CULTURE
]);

$this->registerJs('NewsPage(' . $pageOptions . ')');
?>