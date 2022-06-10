<?php

namespace app\modules\api\v1\models;

use Yii;
use \app\modules\api\v1\models\base\BonificacionAlumno as BaseBonificacionAlumno;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "bonificacion_alumno".
 */
class BonificacionAlumno extends BaseBonificacionAlumno
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
