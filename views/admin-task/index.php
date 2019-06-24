<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\filters\TasksFilter */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Tasks', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?

//    echo \yii\widgets\ListView::widget([
//        'itemView' => 'view',
//        'dataProvider' => $dataProvider,
//        'viewParams' => [
//            'hide' => 'true'
//        ]
//    ]);

    echo \app\widgets\MyWidget::widget([
       'label' => "Практика с виджетами"
    ]);

     echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            'description',
            'creator_id',
            'responsible_id',
            //'deadline',
            //'status_id',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);  ?>


</div>
