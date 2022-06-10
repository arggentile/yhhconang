<?php
namespace app\modules\api\v1;

use Yii;
use yii\base\Exception;

//use app\modules\v1\models\User;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\api\v1\controllers';
    
    public function init()
    {    
        try{            
            parent::init();
//            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;       
//            \Yii::$app->user->enableSession = false;
//            \Yii::$app->user->loginUrl = null;
//            \Yii::$app->user->identityClass = 'app\modules\v1\models\User';
        }catch (Exception $e){
            Yii::error(json_encode($e));
            throw new \yii\web\HttpException($e->statusCode, $e->getMessage());
        }
        
        
    }
}