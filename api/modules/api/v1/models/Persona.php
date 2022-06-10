<?php

namespace app\modules\api\v1\models;

use Yii;
use \app\modules\api\v1\models\base\Persona as BasePersona;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "persona".
 */
class Persona extends BasePersona
{

    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                # custom behaviors
            ]
        );
    }

    public function rules()
    {
        return ArrayHelper::merge(
            parent::rules(),
            [
                # custom validation rules
            ]
        );
    }
}
