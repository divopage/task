<?php

namespace app\modules\api\models;

class Task extends \app\modules\task\models\Task
{
    public function fields()
    {
        return [
            'id', 'name','description'
        ];
    }

}
