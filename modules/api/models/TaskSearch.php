<?php
namespace app\modules\api\models;

use app\modules\api\models\Task;
use app\modules\user\models\User;
use yii\data\ActiveDataProvider;

/**
 * Created by PhpStorm.
 * User: o.trushkov
 * Date: 18.03.19
 * Time: 15:43
 */
class TaskSearch extends \app\modules\task\models\Task
{
    public function rules()
    {
        return [
            [['user_task_id'], 'safe'],
        ];
    }

    public function search($params)
    {

        $query = Task::find();




        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        ex($params);
        if ($this->user_id){
            $query->innerJoin('task_user','task.id = task_user.task_id AND task_user.user_id = :uid ',
                ['uid'=>$this->user_id]);
        }
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere(['id_region' => $this->id_region]);
        $query->andFilterWhere(['id' => $this->id]);
        $query->andFilterWhere(['city_translit' => $this->city_translit]);


        return $dataProvider;
    }
}
