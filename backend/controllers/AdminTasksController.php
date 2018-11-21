<?php

namespace backend\controllers;

use common\models\User;
use Yii;
use common\models\Tasks;
use common\models\TasksSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * AdminTasksController implements the CRUD actions for Tasks model.
 */
class AdminTasksController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Tasks models.
     * @return mixed
     */
    public function actionIndex()
    {
//        if(Yii::$app->user->can("viewTasks")) {
        $searchModel = new TasksSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
//        } else {
//            var_dump("You don't have permission");
//        }
    }

    /**
     * Displays a single Tasks model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
//        if(Yii::$app->user->can("viewTask")) {
        $cache = \Yii::$app->cache;
        $key = 'task_' . $id;

        var_dump($cache->exists($key));
        if($cache->exists($key)) {
            $model = $cache->get($key);
        }
        else {
            $model = $this->findModel($id);
            $cache->set($key, $model, 40);
        };

        return $this->render('view', [
            'model' => $model,
        ]);
//        } else {
//            var_dump("You don't have permission");
//        }
    }

    /**
     * Creates a new Tasks model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
//        if(Yii::$app->user->can("createTask")) {
        $model = new Tasks();

        if ($model->load(Yii::$app->request->post())) {
            $model->image = UploadedFile::getInstance($model, 'image');
            if ($model->image) {
                $model->img = $model->upload();
            };

            $model->image = null;

            if($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

        }

        return $this->render('create', [
            'model' => $model,
        ]);
//        } else {
//            var_dump("You don't have permission");
//        }
    }

    /**
     * Updates an existing Tasks model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
//        if(Yii::$app->user->can("updateTask")) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
//        } else {
//            var_dump("You don't have permission");
//        }
    }

    /**
     * Deletes an existing Tasks model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
//        if(Yii::$app->user->can("deleteTask")) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
//        } else {
//            var_dump("You don't have permission");
//        }
    }

    /**
     * Finds the Tasks model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tasks the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tasks::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}