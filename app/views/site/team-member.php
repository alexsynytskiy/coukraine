<?php
/* @var $member yii\easyii\modules\gallery\api\PhotoObject */

$activeLink = isset($member->link) && !empty($member->link);
?>

<div class="col-xs-12 col-sm-6 col-md-3">
    <div class="team-player">
        <img src="<?= $member->image ?>" alt="" class="img-responsive">
        <?= $member->description ?>
        <?php if($activeLink): ?>
	        <a href="mailto:<?= $member->link ?>"><?= \yii\helpers\Html::encode($member->link) ?></a>
	    <?php endif; ?>
        <div class="separator"></div>
        <div class="spacer"></div>
    </div>
</div>