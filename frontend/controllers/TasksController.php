<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 01/12/2018
 * Time: 15:22
 */

namespace frontend\controllers;


use common\models\Chat;
use common\models\Tasks;
use yii\web\Controller;

class TasksController extends Controller
{
    public function actionIndex() {

    }

    public function actionSingle($id) {
        $model = Tasks::findOne($id);
        $channel = "task_{$id}";
        return $this->render("single", [
            'model' => $model,
            'history' => Chat::getChannelHistory($channel),
            'channel' => $channel
        ]);
    }
}