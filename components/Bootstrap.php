<?php


namespace app\components;
use app\models\tables\Tasks;
use app\models\tables\Users;
use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\base\Component;
use yii\base\Event;

class Bootstrap extends Component implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $this->setLang();
        $this->attachEventsHandler();
    }

    private function attachEventsHandler(){
        Event::on(Tasks::class, Tasks::EVENT_AFTER_INSERT, function (Event $event){
            /** @var Tasks $task */
            $task = $event->sender;
            /** @var Users $responsible */
            $responsible = $task->responsible;
            \Yii::$app->mailer->compose()
                ->setTo($responsible->email)
                ->setFrom('Yii-admin@test.ru')
                ->setSubject('New Task')
                ->setTextBody("Dear {$responsible->login}, new task {$task->id} created")
                ->send();
        });
    }

    private function setLang(){
        if($lang = \Yii::$app->session->get('lang'))[
            \Yii::$app->language = $lang
        ];
    }

}