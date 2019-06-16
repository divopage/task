<?php
namespace app\modules\api\controllers;

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
class UserController extends ActiveController
{
    public $modelClass = 'app\modules\api\models\User';

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

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create']);
        unset($actions['delete']);
        unset($actions['update']);

        return $actions;

    }



}
