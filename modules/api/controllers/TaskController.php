<?php
namespace app\modules\api\controllers;

use app\modules\api\models\TaskSearch;
use app\modules\task\models\Task;
use yii\data\ActiveDataFilter;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use Yii;
/**
 * Created by PhpStorm.
 * User: o.trushkov
 * Date: 15.03.19
 * Time: 20:21
 */
class TaskController extends ActiveController
{
    public $modelClass = 'app\modules\api\models\Task';
/*
    public function behaviors()
    {
        return [
            [
                'class' => \yii\filters\ContentNegotiator::className(),
                'only' => ['index', 'view'],
                'formats' => [
                'application/json' => \yii\web\Response::FORMAT_JSON,
                ],
            ],
        ];
    }
*/
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create']);
        unset($actions['delete']);
        unset($actions['update']);

        $actions['index']['prepareDataProvider'] = function ($action) {
            $query = $this->modelClass::find();
            if ((int)Yii::$app->request->get('user_id')){
                $query->innerJoin('task_user','task.id = task_user.task_id AND task_user.user_id = :uid ',
                    ['uid'=>(int)Yii::$app->request->get('user_id')]);
            }
            return new ActiveDataProvider([
                'query' => $query,
            ]);
        };
        return $actions;

    }


    public function prepareDataProvider()
    {

        $filter = new ActiveDataFilter([
            'searchModel' => 'app\modules\api\models\TaskSearch'
        ]);

        $filterCondition = null;

        if ($filter->load(\Yii::$app->request->get() )) {
            $filterCondition = $filter->build();

            if ($filterCondition === false) {
                return $filter;
            }
        }

        $query = Task::find();
        if ($filterCondition !== null) {
            $query->andWhere($filterCondition);
        }

        return new ActiveDataProvider([
            'query' => $query,
            'pagination'=>false
        ]);

    }




}
