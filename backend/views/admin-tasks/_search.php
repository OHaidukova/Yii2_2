<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\tables\TasksSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tasks-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'number') ?>

    <?= $form->field($model, 'id_project') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'details') ?>

    <?= $form->field($model, 'id_developer') ?>

    <?= $form->field($model, 'id_initiator') ?>

    <?php // echo $form->field($model, 'date_create') ?>

    <?php // echo $form->field($model, 'date_resolve') ?>

    <?php // echo $form->field($model, 'id_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>