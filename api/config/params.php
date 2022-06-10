<?php

return [
    /* Parametros Base Local */
  'dbURL' => getenv('DB_URL') ? getenv('DB_URL') : 'pgsql:host=postgres;port=5432;dbname=yii2angular',
  'dbUser' => getenv('DB_USER') ? getenv('DB_USER') : 'user',
  'dbPass' => getenv('DB_PASSWORD') ? getenv('DB_PASSWORD') : 'user123',

  
  /* Parametro para conexion Api */
  'schPrincipal' => 'principal/api/v1/',

    /* Parametro de mensajes unificados al sistema */
  'flashModeloInexiste' => 'Modelo de registro Inexistente',
  'flashEliminacionCorrecta' => 'Eliminación Correcta',
  'flashEliminacionInCorrecta' => 'La eliminación no se pudo llevarse a cabo.',
  'flashEliminacionNoPermitida' => 'El modelo no permite su eliminación.',
  'flashEdicionNoPermitida' => 'El modelo no permite su edición.',
  'flashAltaCorrecta' => 'El registro fue dado de alta  correctamente',
  'flashEdicionCorrecta' => 'El registro fue editado correctamente',
   
   'pageSize' => 5000000
];
