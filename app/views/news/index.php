<?php
/* @var $this yii\web\View */
/* @var $showLoadMore bool */
/* @var $news yii\easyii\modules\news\models\News[] */
/* @var $tag string */

$asset = \app\assets\AppAsset::register($this);
?>

<section class="padding" id="news">
    <div class="container">
        <div class="row">
            <div class="section-title wow zoomIn">
                <h1>Новини</h1>
                <p><?= (isset($tag)) ? 'Новини за тегом: '.$tag : '' ?></p>
            </div>
            <?php foreach ($news as $item): ?>
                <?= $this->render('news-item', ['item' => $item]) ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>