<?php

// esta funcion ordena los arreglos
function debugear($var)
{
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
}

// para limpiar los metodos get

function htmlGet($var): string
{
    $resultado = htmlspecialchars($var);
    return $resultado;
}