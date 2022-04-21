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
    $query = $cnx->query("SELECT * FROM categoria INNER JOIN subcategoria on categoria.id_categoria = subcategoria.id_categoria where categoria.id_categoria = $num");

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
    $query = $cnx->query("SELECT * FROM usuario usu
    INNER JOIN departamentos dep ON dep.idDepartamento = usu.id_departamento
    INNER JOIN provincia pro ON pro.idProvincia = usu.id_provincia 
    INNER JOIN distrito dis ON dis.idDistrito = usu.id_distrito
     WHERE id_user=" . $id . " LIMIT 1");
    $row = $query->fetch_assoc();


    return $row;
}


//fitro descuento
function filtroDescuento($categoria, $subcat)
{
    global $cnx;

    $query = $cnx->query("SELECT DISTINCT descuento.nombre_descuento FROM productos
                        INNER JOIN categoria cat on productos.id_categoria = cat.id_categoria
                        INNER JOIN subcategoria on productos.id_subcategoria =subcategoria.id_subcat
                        INNER JOIN descuento on productos.id_descuento = descuento.id_descuento
                        WHERE productos.id_descuento = descuento.id_descuento AND cat.nombre_categoria = '$categoria' AND  subcategoria.nombre_subcat LIKE '%$subcat%' ORDER BY descuento.nombre_descuento ASC");

    $descuentos = [];

    while ($row = $query->fetch_assoc()) :
        array_push($descuentos, $row);
    endwhile;

    return $descuentos;
}
//fitro subcategorias
function filtroSubcategorias($cat)
{
    global $cnx;

    $query = $cnx->query("SELECT sub.nombre_subcat FROM subcategoria sub INNER JOIN categoria cat on sub.id_categoria = cat.id_categoria WHERE cat.nombre_categoria = '$cat'");

    $subcat = [];

    while ($row = $query->fetch_assoc()) :
        array_push($subcat, $row);
    endwhile;

    return $subcat;
}
//fitro menosCosto
function filtroMenor($MAX, $cat)
{
    global $cnx;

    $query = $cnx->query("SELECT $MAX(productos.precio_prod - productos.precio_prod * de.nombre_descuento) as minimo FROM productos INNER JOIN descuento de on productos.id_descuento = de.id_descuento INNER JOIN categoria cat on productos.id_categoria = cat.id_categoria WHERE cat.nombre_categoria = '$cat'");

    $row = $query->fetch_assoc();

    return $row;
}