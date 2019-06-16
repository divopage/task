<?php

namespace app\modules\task\controllers\backend;

use app\modules\task\models\TaskUser;
use Yii;
use app\modules\task\models\Task;
use app\modules\task\models\TaskSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class DefaultController extends Controller
{

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


    public function actionIndex()
    {
        $searchModel = new TaskSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    public function actionCreate()
    {
        $model = new Task();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->preseachTaskUser($model);
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $this->loadUser($model);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->preseachTaskUser($model);
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    private function loadUser($task){
        $link = TaskUser::findOne(['task_id'=>  $task->id]);
        if ($link !== null){
            $task->user_task_id = $link->user_id;
        }
    }

    private function preseachTaskUser($task){

        $selected_user_id = (int)$task->user_task_id;

        if ( $selected_user_id ) {
            $arrSets = [$selected_user_id];

            $old_links = TaskUser::findAll(['task_id'=>  $task->id]);
            $old_users = ArrayHelper::getColumn($old_links,'user_id');

            $del_user_id = array_diff($old_users,$arrSets);

            foreach ($old_links as $link){
                if ( in_array( $link->user_id,$del_user_id)){
                    $link->delete();
                }
            }

            $new_user_ids = array_diff($arrSets,$old_users);

            foreach ( $new_user_ids as $new_user_id ){
                $l = new TaskUser();
                $l->task_id = $task->id;
                $l->user_id = (int) $new_user_id;
                $l->save();
            }


        }  else {
            TaskUser::deleteAll(['task_id'=>  $task->id]);
        }
    }


    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->getModule('task')->removeTask($id);

        return $this->redirect(['index']);
    }


    protected function findModel($id)
    {
        if (($model = Task::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
