<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 13/12/2018
 * Time: 21:36
 */

namespace frontend\modules\task\controllers;

use Yii;
use common\models\Tasks;
use common\models\User;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;

class TaskController extends ActiveController
{
    public $modelClass = Tasks::class;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors ['authentificator'] = [
            'class' => HttpBasicAuth::class,
            'auth' => function($username, $password) {
                $user = User::findByUsername($username);
                if($user !== null && $user->validatePassword($password)) {
                    return $user;
                } return null;
            }
        ];
        return $behaviors;
    }


}