<?php

namespace app\modules\task\models;

use app\modules\user\models\User;
use Yii;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $status
 */
class Task extends \yii\db\ActiveRecord
{

    public $user_task_id;

    const ST_O =  0;
    const ST_C =  1;

    public static  $arrTxtStatus = [self::ST_O => 'Закрыта',self::ST_C =>'Открыта'];


    public static function tableName()
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 45],
            [['description'], 'string'],
            [['user_task_id'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'status' => 'Status',
            'user_task_id'=>'User'
        ];
    }


    public function getUsers_r()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])
            ->viaTable('task_user', ['task_id' => 'id']);
    }

}
