<?php
use \yii\helpers\Url;

$asset = \app\assets\AppAsset::register($this);


$currentPage = Yii::$app->controller->action->id;
$controller  = Yii::$app->controller->id;

$health    = '';
$education = '';
$culture   = '';
$contacts  = '';
$team  = '';

switch($currentPage) {
    case 'team':
        $team = "active";
        break;
    case 'health':
        $health = "active";
        break;
    case 'education':
        $education = "active";
        break;
    case 'culture':
        $culture = "active";
        break;
    case 'index':
        $contacts = ($controller == 'contact') ? "active" : '';
        break;
}
?>

<nav id="main-menu" class="navbar navbar-inverse navbar-fixed-top" data-spy="affix" data-offset-top="100">
    <div class="container">
        <div class="navbar-header">
            <button aria-controls="navbar" aria-expanded="false" class="navbar-toggle collapsed" data-target="#navbar" data-toggle="collapse" type="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">
                <img src="<?= $asset->baseUrl ?>/img/logo-black.png">
            </a>
        </div>
        <div class="navbar-collapse collapse navbar-right" id="navbar">
            <ul class="nav navbar-nav">
                <li>
                    <?php if($controller == 'site' && $currentPage == 'index'): ?>
                        <a href="/" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Головна <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a data-scroll href="#activity">Про нас</a>
                            </li>
                            <li>
                                <a data-scroll href="#news">Новини</a>
                            </li>
                            <li>
                                <a data-scroll href="#partners">Проекти</a>
                            </li>
                        </ul>
                    <?php else : ?>
                        <a href="<?= Url::to(['/']) ?>">
                            Головна <span class="underline"></span>
                        </a>
                    <?php endif; ?>

                </li>
                <li>
                    <a class="<?= $culture ?>" href="<?= Url::to(['/culture']) ?>">
                        Культура
                        <span class="underline"></span>
                    </a>
                </li>
                <li>
                    <a class="<?= $education ?>" href="<?= Url::to(['/education']) ?>">
                        Освіта
                        <span class="underline"></span>
                    </a>
                </li>
                <li>
                    <a class="<?= $health ?>" href="<?= Url::to(['/health']) ?>">
                        Здоров'я
                        <span class="underline"></span>
                    </a>
                </li>
                
                <li>
                    <a class="<?= $contacts ?>" href="<?= Url::to(['/contact']) ?>">
                        Контакти
                        <span class="underline"></span>
                    </a>
                </li>
                
                <li>
                    <a href="/donate" class="donate">
                        Фондувати
                        <span class="underline" >
                            <span class="underline grey" style="position: absolute; top: 0; left: 0;"></span>
                        </span>
                    </a>
                </li>
            </ul>

        </div>

        <!--/.nav-collapse -->
    </div>
</nav>
