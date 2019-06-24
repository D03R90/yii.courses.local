<?php

namespace app\controllers;

use app\models\forms\TaskAttachmentsAddForm;
use app\models\tables\TaskAttachments;
use app\models\tables\TaskComments;
use app\models\tables\Tasks;
use app\models\tables\TaskStatuses;
use app\models\tables\Users;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\UploadedFile;

class TaskController extends Controller
{
    public function actionTest()
    {
        $model = new RegisterUserForm([
            'login' => 'polzovatel',
            'password' => '123456789',
            'email' => 'vadim@mail.ru',
        ]);

        $model->register();
        exit();
    }


    public function actionIndex()
    {

        $month = 6;
        $query = Tasks::find()->where("MONTH(deadline) = {$month}");

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        \Yii::$app->db->cache(function () use ($dataProvider) {
            return $dataProvider->prepare();
        });

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionOne($id){
        return $this->render("one", [
            'model' => Tasks::findOne($id),
            'statusesList' => TaskStatuses::getStatusesList(),
            'usersList' => Users::getUsersList(),
            'taskCommentForm' => new TaskComments(),
            'taskAttachmentForm' => new TaskAttachmentsAddForm(),
            'userId' => \Yii::$app->user->id
        ]);
    }

    public function actionSave($id)
    {

        if ($model = Tasks::findOne($id)) {
            $model->load(\Yii::$app->request->post());
            $model->save();
            \Yii::$app->session->setFlash('success', "Изменеия сохранены");
        } else {
            \Yii::$app->session->setFlash('error', "Не удалось сохранить изменения");
        }
        $this->redirect(\Yii::$app->request->referrer);
    }

    public function actionAddComment()
    {
        $model = new TaskComments();
        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->session->setFlash('success', "Комментарий добавлен");
        } else {
            \Yii::$app->session->setFlash('error', "Не удалось добавить комментарий");
        }
        $this->redirect(\Yii::$app->request->referrer);
    }

    public function actionAddAttachment()
    {
        $model = new TaskAttachmentsAddForm();
        $model->load(\Yii::$app->request->post());
        $model->attachment = UploadedFile::getInstance($model, 'attachment');
        if ($model->save()) {
            \Yii::$app->session->setFlash('success', "Файл добавлен");
        } else {
            \Yii::$app->session->setFlash('error', "Не удалось добавить файл");
        }
        $this->redirect(\Yii::$app->request->referrer);
    }
}