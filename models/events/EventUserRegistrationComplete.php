<?php


namespace app\models\events;
use yii\base\Event;

class EventUserRegistrationComplete extends Event
{
    public $userId;
}