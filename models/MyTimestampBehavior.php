<?php


namespace app\controllers;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class MyTimestampBehavior extends \yii\db\ActiveRecord


public function behaviors()
{
    return [
        [
            'class' => TimestampBehavior::className(),
            'attributes' => [
                ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
            ],
        ],
    ];
}