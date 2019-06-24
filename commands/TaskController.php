<?php


namespace app\commands;


use app\models\tables\Tasks;
use app\models\tables\Users;
use yii\console\Controller;
use yii\helpers\Console;

class TaskController extends Controller
{


    public function actionDeadline()
    {
        $tasks = Tasks::find()
            ->where("DATEDIFF(NOW(), tasks.deadline) <= 1")
            ->with('responsible')
            ->all();

        foreach ($tasks as $task){
            $responsible = $task->responsible;
            \Yii::$app->mailer->compose()
                ->setTo($responsible->email)
                ->setFrom('Yii-admin@test.ru')
                ->setSubject('Deadline')
                ->setTextBody("Dear {$responsible->login}, new task {$task->id} created")
                ->send();
        }
    }


    public $message = 'hello';

    /**
     * PHP doc
     */
    public function actionTest($id)
    {
        if($user = Users::findOne($id)){
            ;
            $this->stdout("{$this->message}, {$user->login}!!!!", Console::BG_BLUE);
            return static::EXIT_CODE_NORMAL;
        }
        return static::EXIT_CODE_ERROR;
    }

    public function actionHandler()
    {
        $count = 100;
        Console::startProgress(1, $count);
        for($i = 1; $i< $count; $i++){
            sleep(1);
            Console::updateProgress($i, $count);
        }
        Console::endProgress();
    }


    public function options($actionId)
    {
        return ['message'];
    }

    public function optionAliases()
    {
        return [
            'm' => 'message'
        ];
    }


}