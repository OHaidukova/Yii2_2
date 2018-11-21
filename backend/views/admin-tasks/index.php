<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\tables\TasksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tasks', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?

    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'number',
            'name',
            'details',
            'id_developer',
            'date_create',
            'date_resolve',
            'id_status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);

//    echo \yii\widgets\ListView::widget([
//            'dataProvider' => $dataProvider,
//            'itemView' => 'view',
//            'viewParams' => [
//                'hideBreadcrumbs' => true,
//                ]
//
//    ])

    ?>
</div>