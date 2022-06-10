<?php

namespace app\modules\api\v1\models;

use Yii;
use \app\modules\api\v1\models\base\DivisionEscolar as BaseDivisionEscolar;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "division_escolar".
 */
class DivisionEscolar extends BaseDivisionEscolar
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
