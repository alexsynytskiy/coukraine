<?php

$asset = \app\assets\AppAsset::register($this);
?>

<footer>
    <div class="container-fluid">
        
        <div class="row flex-row">

            <div class="col-xs-12 col-sm-6 col-md-6 padding-box-70 jetblackbg dark">
                <address>
                    Київ, вул. Дмитрівська 45, офіс 31<br>
                    Email: <a href="mailto:przkvu@gmail.com">przkvu@gmail.com</a><br>
                    <a href="tel: +380973492863">+38(097) 349 28 63</a>
                </address><a class="contacts btn btn-primary" href="<?= \yii\helpers\Url::to(['/contact']) ?>">Контакти</a>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-6 padding-box-70 blackbg dark">
                <div class="widget widget-newsletter" style="margin-bottom: 0;">
                    <h3>Будьте в курсі наших новин:</h3>
                    <?= yii\easyii\modules\subscribe\api\Subscribe::form(['successUrl' => '/', 'errorUrl' => '/']); ?>
                </div>
                <div class="widget widget-carlos-social-icons">
                    <h5 style="margin-top: 5px;">Follow Us:</h5>
                    <ul>
                        <li>
                            <a href="https://www.facebook.com/krainaUkraina.org/"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li>
                            <a href="https://www.youtube.com/channel/UCOfLJraHiWSwJuU2XkqSyNw"><i class="fa fa-youtube"></i></a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/co_ukraine/?hl=uk"><i class="fa fa-instagram"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>