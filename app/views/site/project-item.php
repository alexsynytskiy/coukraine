<?php
/* @var $project yii\easyii\modules\gallery\api\PhotoObject */

$activeLink = isset($project->link) && !empty($project->link);
?>

<li class="col-lg-4 col-md-12 col-xs-12 item">
    <?php if($activeLink): ?>
        <a target="_blank" href="<?= \yii\helpers\Html::encode($project->link) ?>">
    <?php endif; ?>
        <img style="height: 180px;" src="<?= $project->image ?>" alt="" />
        <span><?= $project->description ?></span>
    <?php if($activeLink): ?>
        </a>
    <?php endif; ?>
</li>
