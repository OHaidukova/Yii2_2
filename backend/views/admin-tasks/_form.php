<?php

use yii\helpers\Html;
use \yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\tables\Tasks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tasks-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_project')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'details')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_developer')->dropDownList(ArrayHelper::map(User::find()->all(), 'id', 'username')) ?>

    <?= $form->field($model, 'id_initiator')->dropDownList(ArrayHelper::map(User::find()->all(), 'id', 'username')) ?>

    <?= $form->field($model, 'date_create')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'date_resolve')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'id_status')->textInput() ?>
    

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?// echo \yii\jui\DatePicker::widget([
//        'name' => 'date',
//        'value' => $model->date_create,
//        'dateFormat' => 'yyyy-MM-dd',
//        'language' => 'ru'
//]);
//?>