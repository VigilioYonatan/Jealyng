<?php
// importando helpers y base datos
require_once __DIR__ . '/database.php';
require_once __DIR__ . '/helpers.php';

// importando autoload
require_once __DIR__ . '/../vendor/autoload.php';

use Model\ActiveRecord;
// insertamos base de datos a nuestro active Record
ActiveRecord::setDb($cnx);