<?php


namespace app\models;
use app\models\forms\RegisterUserForm;
use yii\base\Behavior;

class SubscribeBehavior extends Behavior
{
    public $message = "Поведение!";

    public function events()
    {
        return [
            RegisterUserForm::EVENT_REGISTRATION_COMPLETE => 'foo'
        ];
    }


    public function foo($event)
    {
        (new Subscribe())->attache($event->userId);
    }
}