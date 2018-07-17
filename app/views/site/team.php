<?php

/* @var $this yii\web\View */
/* @var $teamMembers yii\easyii\modules\gallery\api\PhotoObject[] */

$asset = \app\assets\AppAsset::register($this);
?>

<section style="padding-top: 120px;"></section>

<section id="team">
    <div class="container">
        <div class="row">
            <div class="section-title wow zoomIn">
                <h1>Команда</h1>
            </div>
            <?php foreach ($teamMembers as $member): ?>
                <?= $this->render('team-member', ['member' => $member]) ?>
            <?php endforeach; ?>
            <div class="clearfix"></div>
        </div>
    </div>
</section>