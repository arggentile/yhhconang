<?php

namespace app\modules\api\v1\models;

use Yii;
use \app\modules\api\v1\models\base\TipoSexo as BaseTipoSexo;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tipo_sexo".
 */
class TipoSexo extends BaseTipoSexo
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
