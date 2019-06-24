<?php


namespace app\models\forms;

use app\models\events\EventUserRegistrationComplete;
use app\models\SubscribeBehavior;
use app\models\tables\Users;
use yii\base\Model;

class RegisterUserForm extends Model
{
    public $login;
    public $password;
    public $email;

    const EVENT_REGISTRATION_BEGIN = 'registration_begin';
    const EVENT_REGISTRATION_VALIDATE_SUCCESS = 'registration_validate_success';
    const EVENT_REGISTRATION_COMPLETE = 'registration_complete';

    public function rules()
    {
        return [
            [['login', 'password', 'email'], 'required'],
            ['email', 'email'],
            ['password', 'string', 'min' => '10']
        ];
    }

    public function behaviors()
    {
        return [
            'my' => [
                'class' => SubscribeBehavior::class,
                'message' => "Плохое поведение"
            ]
        ];
    }


    public function register()
    {
        $this->trigger(self::EVENT_REGISTRATION_BEGIN);
        if ($this->validate()) {
            $this->trigger(self::EVENT_REGISTRATION_VALIDATE_SUCCESS);
            $user = new Users($this->toArray());
            if ($user->save()) {
                $event = new EventUserRegistrationComplete(['userId' => $user->id]);
                $this->trigger(self::EVENT_REGISTRATION_COMPLETE, $event);
                return true;
            }
        }
        return false;
    }
}