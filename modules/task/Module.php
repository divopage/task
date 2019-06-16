<?php

namespace app\modules\task;


use app\modules\task\models\TaskUser;

class Module extends \yii\base\Module
{

    public function removeUserTask($task_id,$user_d){

    }

    public function removeTask($task_id){
        foreach ( TaskUser::find()->where(['task_id'=>$task_id]) as $item){
            $item->delete();
        }
    }

}
