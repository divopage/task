<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\modules\task\models\Task;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\task\models\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Task', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            'name',
            [
                'label'=>'User',
                'value'=>function ($model){
                    foreach ( $model->users_r as $user){
                        return $user->username;
                    }
                    return '';
                }
            ],
             [
                'attribute'=>'status',
                'value'=>function ($model){
                    return  \app\modules\task\models\Task::$arrTxtStatus[ $model->status ];
                },
                'filter'=>Task::$arrTxtStatus,
            ],

            ['class' => 'yii\grid\ActionColumn','template'=>'{update}{delete}'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
