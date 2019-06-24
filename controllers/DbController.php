<?php


namespace app\controllers;


use app\models\tables\Tasks;
use yii\web\Controller;

class DbController extends Controller
{
    public function actionIndex()
    {
        $db = \Yii::$app->db;

       $id = 1;

        $result = $db->createCommand("UPDATE test SET content = :update 
                                      WHERE id = :id")
            ->bindValues([
                ':update' => 'update',
                ':id' => $id
            ])
            ->execute();


        var_dump($result);

        exit;

    }


    public function actionAr()
    {
        $model = new Tasks();
        $model->name = 'Task 1';
        $model->description = 'Install Framework';
        $model->creator_id = 1;
        $model->responsible_id = 2;
        $model->deadline = date("Y-m-d");
        $model->status_id = 1;

        $model->save();

        var_dump($model);
        exit;

//        $result = Tasks::findOne(1);
//        var_dump($result->status);
//        exit;



    }
}