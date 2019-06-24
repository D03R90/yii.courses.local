<?php

namespace app\controllers;

use app\models\Test;
use yii\web\Controller;
use yii\web\UploadedFile;

class UploadController extends Controller
{
    public function actionIndex()
    {
        $model = new Test();
        if($model->load(\Yii::$app->request->post())){
            $model->upload = UploadedFile::getInstance($model, 'upload');
            $model->save();
        }
        return $this->render('test',['model' => $model]);
    }

    public function actionLang()
    {
        \Yii::$app->language='ru';
        echo \Yii::t("app", "error", ['number' => 404]);
    }
}