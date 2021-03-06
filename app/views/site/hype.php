<?php

/* @var $this yii\web\View */
/* @var $news yii\easyii\modules\news\api\NewsObject[] */
/* @var bool $hasToLoadMore */
/* @var int $lastItemId */

$asset = \app\assets\AppAsset::register($this);
\app\assets\LazyLoadAsset::register($this);
?>

<section style="padding-top: 120px;"></section>

<section class="culture-news">
    <div class="container">
        <div class="row">
            <div class="section-title wow zoomIn">
                <h1>Новини</h1>
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
                               class="button hype"
                               data-last-id="<?= $lastItemId ?>">Більше новин</a>
                        </div>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="no-news">
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
    'category' => \yii\easyii\components\helpers\CategoryHelper::CATEGORY_HYPE
]);

$this->registerJs('NewsPage(' . $pageOptions . ')');
?>