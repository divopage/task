<?php

namespace app\modules\task;


use app\modules\task\models\TaskUser;

class Module extends \yii\base\Module
{



    public function removeTask($task_id){
        foreach ( TaskUser::find()->where(['task_id'=>$task_id])->all() as $item){
            $item->delete();
        }
    }

}
