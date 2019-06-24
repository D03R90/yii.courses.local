<?php

namespace  app\validators\Validators;

use yii\validators\Validator;

class TaskNameValidator extends Validator {
    public function validateAttribute($model, $attribute)
    {
        if ($model->$attribute > 40){
            $this->addError($model, $attribute, "Слишком длинное название задачи");
        }
    }
}
