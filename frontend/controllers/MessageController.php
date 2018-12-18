<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 13/12/2018
 * Time: 21:36
 */

namespace frontend\controllers;

use common\models\MessageFilter;
use Yii;
use common\models\Message;
use common\models\User;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;

class MessageController extends ActiveController
{
    public $modelClass = Message::class;

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

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    public function actionIndex() {

        $filter = \Yii::$app->request->get('filter');
        var_dump($filter); exit;

        $query = Message::find();
//        $query->where(['user_id' => 2]);
        return new ActiveDataProvider([
            'query' => (new MessageFilter)->filter($filter, $query)
        ]);
    }

//    public function checkAccess($action, $model = null, $params = []) {
//        if(!Yii::$app->user->id) {
//            throw new ForbiddenHttpException();
//        }
//    }

}