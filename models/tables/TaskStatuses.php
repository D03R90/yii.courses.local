<?php

namespace app\models\tables;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "task_statuses".
 *
 * @property int $id
 * @property string $name
 *
 * @property Tasks[] $tasks
 */
class TaskStatuses extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task_statuses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 50],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Tasks::className(), ['status_id' => 'id']);
    }

    public static function getStatusesList()
    {

        return  $statusesList = ArrayHelper::map(
            TaskStatuses::find()
                ->asArray()
                ->all(), 'id', 'name');

        var_dump($statusesList);
    }
}
