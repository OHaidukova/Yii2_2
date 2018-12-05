<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 02/12/2018
 * Time: 17:28
 */

namespace frontend\controllers;


use common\models\Project;
use common\models\Tasks;
use yii\web\Controller;

class ProjectController extends Controller
{
    public function actionIndex() {
        $projects = Project::find()->all();
        return $this->render("projects", ['projects' => $projects]);
    }

    public function actionProject($id) {
        $tasks = Tasks::getTasksProject($id);
        return $this->render("project", ["tasks" => $tasks]);
    }
}