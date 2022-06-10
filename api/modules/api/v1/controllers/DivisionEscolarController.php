<?php

namespace app\modules\api\v1\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\base\Exception;

use app\modules\api\v1\models\DivisionEscolar;

/*
 * Clase destina a publicar una serie de acciones para que puedan ser 
 * invocadas mediante una api de peticion via http.
 * Se exponen las funciones basicas para consultar data 
 */
class DivisionEscolarController extends ActiveController
{
    public $modelClass = 'app\modules\api\v1\models\DivisionEscolar';

   public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => \yii\filters\auth\CompositeAuth::className(),
            'authMethods' => [
                \yii\filters\auth\HttpBearerAuth::className(),
            ],
        ];
     
        // remove authentication filter
        $auth = $behaviors['authenticator'];
        unset($behaviors['authenticator']);

        // add CORS filter
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Allow-Credentials' => null,
                'Access-Control-Max-Age' => 86400,
                'Access-Control-Expose-Headers' => [],
            ],
        ];

        // re-add authentication filter
        $behaviors['authenticator'] = $auth;
        // avoid authentication on CORS-pre-flight requests (HTTP OPTIONS method)
        $behaviors['authenticator']['except'] = ['options', 'public'];
        
        return $behaviors;
    }
    
    
    public function actions()
    {
        $actions = parent::actions();
//        unset($actions['create']);
//        unset($actions['update']);
        $actions['index'] = [
            'class' => 'yii\rest\IndexAction',
            'modelClass' => $this->modelClass,
            'prepareDataProvider' => function () {
                return new \yii\data\ActiveDataProvider([
                    'query' => $this->modelClass::find(),
                    'pagination' => false,
                ]);
            },
        ];
        
        return $actions;
    }
    

    /*******************************************************/
    
    /*
     * Realiza una busqueda filtrabdo la data segun los datos paramnetrizxados; acepta
     * terminos de filtrado, paginacion y ordenación
     */
    public function actionListado(){
        try{
            $modelBusqueda = new DivisionEscolar();
            
            $modelSearchRequest = \Yii::$app->request->post('modelSearch');
            if(!empty($modelSearchRequest)){
                $modelSearchRequest =  json_decode($modelSearchRequest, true);
                $modelBusqueda->setAttributes($modelSearchRequest, true);
            }
            $query = DivisionEscolar::find();
            
            $parametros = \Yii::$app->request->post();
            $perPage = (!empty($parametros['perPage']))?$parametros['perPage']:\Yii::$app->params['pageSize'];
            $currentPage = (!empty($parametros['currentPage']))?$parametros['currentPage']:0;
                
            $expands =  (!empty($_GET['expand']))? explode(",", $_GET['expand']):[];
            
            /* filtros */
            $query->andFilterWhere(['like', 'nombre',  $modelBusqueda->nombre ]);
            
            $dataProvider = new \yii\data\ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'pageSize' => $perPage,
                    'page' => $currentPage - 1
                ]
            ]);
            
            if(!empty($parametros['sortName'])){
                $dataProvider->sort = ['defaultOrder' => [$parametros['sortName'] => $parametros['sortOrder']]]; 
            }
            
            $dataModels = [];
            $models = $dataProvider->getModels();
            foreach ($models as $oneModel)
                $dataModels[] = $oneModel->toArray([], $expands);
            
            $data['data']= $dataModels;
            $data['currentPage']= $currentPage;
            $data['perPage']= $perPage;
            $data['count']= $dataProvider->getCount();
            $data['totalCount']= $dataProvider->getTotalCount();
            
            return $data;
        }catch (Exception $e){
            \Yii::$app->getModule('audit')->data('errorAction', json_encode($e->getMessage()));            
            throw new \yii\web\HttpException($e->getCode(), $e->getMessage());
        }
    }    
    
    
    /*******************************************************/
    public function actionCreate(){
        try{
            $model = new Establecimiento();
            $modelRequest = \Yii::$app->request->post('model');
            $modelRequest =  json_decode($modelRequest, true);
            $model->setAttributes($modelRequest, true);
            
            //$model->fecha_apertura = \app\helpers\Fecha::formatear($model->fecha_apertura, "Y-m-d\TH:i:s.u\Z", 'Y-m-d');
            
            if($model->save()){     
                $responseHeader = \Yii::$app->getResponse();
                $responseHeader->setStatusCode(201);                
                $response['success'] = true;
                $response['mensaje'] = 'Carga Correcta';               
                $response['data'] = $model;   
            }else{
                $responseHeader = \Yii::$app->getResponse();
                $responseHeader->setStatusCode(203);                
                $response['success'] = false;
                $response['error'] = true;                
                $response['mensaje'] = 'Error al cargar.';
                $response['detalle_mensaje'] = $model->getErrors();                
                $response['data'] = $model;
            }
            
            return $response;
        }catch (\Exception $e){
            \Yii::$app->getModule('audit')->data('errorAction', json_encode($e));            
            throw new \yii\web\HttpException(500, $e->getMessage());
        }
    }
    
    /*******************************************************/
    public function actionActualizar(){
        try{
            $model = Establecimiento::findOne(\Yii::$app->request->get('id'));
            if(!$model)
                throw new \yii\web\HttpException(400, 'Objeto no encontrado');
            
            
            $modelRequest = \Yii::$app->request->post('model');
            $modelRequest =  json_decode($modelRequest, true);
            $model->setAttributes($modelRequest, true);
            
            $model->fecha_apertura = \app\helpers\Fecha::formatear($model->fecha_apertura, "Y-m-d\TH:i:s.u\Z", 'Y-m-d');
            
            if($model->save()){     
                $responseHeader = \Yii::$app->getResponse();
                $responseHeader->setStatusCode(201);                
                $response['success'] = true;
                $response['mensaje'] = 'Carga Correcta';               
                $response['data'] = $model;   
            }else{
                $responseHeader = \Yii::$app->getResponse();
                $responseHeader->setStatusCode(203);                
                $response['success'] = false;
                $response['error'] = true;                
                $response['mensaje'] = 'Error al cargar.';
                $response['detalle_mensaje'] = $model->getErrors();                
                $response['data'] = $model;
            }
            //throw new \yii\web\HttpException(400, json_encode($model->getErrors()));
            
            return $response;
        }catch (\Exception $e){
            \Yii::$app->getModule('audit')->data('errorAction', json_encode($e)); 
            throw new \yii\web\HttpException($e->statusCode, $e->getMessage());
        }
    }
    
    /*******************************************************/
    public function actionDelete($id)
    {
        try{
            $model = Establecimiento::findOne($id);
            if(!$model)
                throw new \yii\web\HttpException(400, 'Objeto no encontrado');
            
            if($model->delete()){
                $responseHeader = \Yii::$app->getResponse();
                $responseHeader->setStatusCode(200);
                $response['success'] = true;
                $response['mensaje'] = 'Eliminacion correcta';               
                $response['data'] = $model;
                return $response;
            }else{
                $responseHeader = \Yii::$app->getResponse();
                $responseHeader->setStatusCode(203);                
                $response['success'] = false;
                $response['error'] = true;                
                $response['mensaje'] = 'Error al eliminar.';
                $response['detalle_mensaje'] = $model->getErrors();                
                $response['data'] = $model;
            }
        } catch (Exception $ex) {
            \Yii::$app->getModule('audit')->data('errorAction', json_encode($e)); 
            throw new \yii\web\HttpException($e->statusCode,  $e->getMessage());
        }
    }
    
    public function actionView($id)
    {
        try{
           
            $model = DivisionEscolar::findOne($id);
            if(!$model)
                throw new \yii\web\HttpException(400, 'Objeto no encontrado');
             $responseHeader = \Yii::$app->getResponse();
                $responseHeader->setStatusCode(203);                
                $response['success'] = false;
                $response['error'] = true;            
                return $response;
            if($model->delete()){
                $responseHeader = \Yii::$app->getResponse();
                $responseHeader->setStatusCode(200);
                $response['success'] = true;
                $response['mensaje'] = 'Eliminacion correcta';               
                $response['data'] = $model;
                return $response;
            }else{
                $responseHeader = \Yii::$app->getResponse();
                $responseHeader->setStatusCode(203);                
                $response['success'] = false;
                $response['error'] = true;                
                $response['mensaje'] = 'Error al eliminar.';
                $response['detalle_mensaje'] = $model->getErrors();                
                $response['data'] = $model;
            }
        } catch (Exception $e) {
            \Yii::$app->getModule('audit')->data('errorAction', json_encode($e)); 
            throw new \yii\web\HttpException($e->statusCode,  $e->getMessage());
        }
    }
}
