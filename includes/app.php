<?php
// importando helpers y base datos
require_once __DIR__ . '/database.php';
require_once __DIR__ . '/helpers.php';

// importando autoload
require_once __DIR__ . '/../vendor/autoload.php';

use Model\ActiveRecord;
use Model\SubCategoriaModel;

// insertamos base de datos a nuestro active Record
ActiveRecord::setDb($cnx);

function categoria(): array
{
    global $cnx;
    $query = $cnx->query("SELECT * FROM categoria");

    $categoria = [];

    while ($row = $query->fetch_assoc()) {
        array_push($categoria, $row);
    }
    return $categoria;
}

/// subcategoria
function subcategoria($num): array
{
    global $cnx;
    $query = $cnx->query("SELECT * FROM `categoria` INNER JOIN subcategoria on categoria.id_categoria = subcategoria.id_categoria where categoria.id_categoria = $num");

    $subcategoria = [];

    while ($row = $query->fetch_assoc()) {
        array_push($subcategoria, $row);
    }
    return $subcategoria;
}

// funciones sql
function selectSql($tabla)
{
    global $cnx;
    $query = $cnx->query("SELECT * FROM " . $tabla . "");

    $objetos = [];

    while ($row = $query->fetch_assoc()) :
        array_push($objetos, $row);
    endwhile;

    return $objetos;
}
// funciones sql por id
function selectSqlBYid($id)
{
    global $cnx;
    $query = $cnx->query("SELECT * FROM usuario WHERE id_user=" . $id . " LIMIT 1");
    $row = $query->fetch_assoc();


    return $row;
}