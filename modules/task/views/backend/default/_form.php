<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\task\models\Task;
use app\modules\user\models\User;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\task\models\Task */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows'=>6]) ?>

    <?= $form->field($model, 'status')->dropDownList(Task::$arrTxtStatus) ?>

    <?= $form->field($model, 'user_task_id')->dropDownList(ArrayHelper::map(User::findAll(['role'=>'user']),
        'id','username'),['prompt'=>' --- ']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
