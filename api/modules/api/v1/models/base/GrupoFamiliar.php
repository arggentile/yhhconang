<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace app\modules\api\v1\models\base;

use Yii;

/**
 * This is the base-model class for table "grupo_familiar".
 *
 * @property integer $id
 * @property string $apellidos
 * @property string $descripcion
 * @property string $folio
 * @property integer $id_pago_asociado
 * @property string $cbu_cuenta
 * @property string $nro_tarjetacredito
 * @property string $tarjeta_banco
 * @property string $prestador_tarjeta
 *
 * @property \app\modules\api\v1\models\Alumno[] $alumnos
 * @property \app\modules\api\v1\models\FormaPago $pagoAsociado
 * @property \app\modules\api\v1\models\Responsable[] $responsables
 * @property string $aliasModel
 */
abstract class GrupoFamiliar extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'grupo_familiar';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['apellidos', 'folio', 'id_pago_asociado'], 'required'],
            [['id_pago_asociado'], 'default', 'value' => null],
            [['id_pago_asociado'], 'integer'],
            [['apellidos'], 'string', 'max' => 100],
            [['descripcion'], 'string', 'max' => 255],
            [['folio'], 'string', 'max' => 4],
            [['cbu_cuenta'], 'string', 'max' => 22],
            [['nro_tarjetacredito'], 'string', 'max' => 16],
            [['tarjeta_banco', 'prestador_tarjeta'], 'string', 'max' => 50],
            [['id_pago_asociado'], 'exist', 'skipOnError' => true, 'targetClass' => \app\modules\api\v1\models\FormaPago::className(), 'targetAttribute' => ['id_pago_asociado' => 'id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'apellidos' => 'Apellidos',
            'descripcion' => 'Descripcion',
            'folio' => 'Folio',
            'id_pago_asociado' => 'Id Pago Asociado',
            'cbu_cuenta' => 'Cbu Cuenta',
            'nro_tarjetacredito' => 'Nro Tarjetacredito',
            'tarjeta_banco' => 'Tarjeta Banco',
            'prestador_tarjeta' => 'Prestador Tarjeta',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlumnos()
    {
        return $this->hasMany(\app\modules\api\v1\models\Alumno::className(), ['id_grupofamiliar' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPagoAsociado()
    {
        return $this->hasOne(\app\modules\api\v1\models\FormaPago::className(), ['id' => 'id_pago_asociado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponsables()
    {
        return $this->hasMany(\app\modules\api\v1\models\Responsable::className(), ['id_grupofamiliar' => 'id']);
    }




}
