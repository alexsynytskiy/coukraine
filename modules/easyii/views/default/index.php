<?php
/* @var $news array */

$this->title = 'З поверненням, '.Yii::$app->user->identity->username;
?>

<?= \dosamigos\chartjs\ChartJs::widget([
    'type' => 'line',
    'options' => [
        'height' => 150,
        'width' => 400
    ],
    'data' => [
        'labels' => $news['title'],
        'datasets' => [
            [
                'label' => "Просмотры новостей",
                'backgroundColor' => "rgba(179,181,198,0.2)",
                'borderColor' => "rgba(179,181,198,1)",
                'pointBackgroundColor' => "rgba(179,181,198,1)",
                'pointBorderColor' => "#fff",
                'pointHoverBackgroundColor' => "#fff",
                'pointHoverBorderColor' => "rgba(179,181,198,1)",
                'data' => $news['views']
            ],
        ]
    ]
]);
?>
