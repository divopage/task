<?php

namespace app\modules\api\models;

class User extends \app\modules\user\models\backend\User
{
    public function fields()
    {
        return [
            'id', 'created_at','username','email',
        ];
    }

}
