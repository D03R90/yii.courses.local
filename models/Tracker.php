<?php
namespace app\models;
use yii\base\Model;

class Tracker extends Model
{
    public $content;
    public $title;
    public $count;

    public function rules()
    {
        return[
            [['title', 'content'], 'required'], //TODO указать имя валидатора с namespace
            ['count', 'myValidate']
        ];
    }

    public function myValidate($attr)
    {
        if(!in_array($this->$attr)){
            $this->addError('$attr', 'Ошибка');
        }
    }
}