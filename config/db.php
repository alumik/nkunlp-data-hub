<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=10.10.1.210;port=13307;dbname=nkunlp_data',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    'enableSchemaCache' => true,
    'schemaCacheDuration' => 60,
    'schemaCache' => 'cache',
];
