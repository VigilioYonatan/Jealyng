<?php

namespace Controller;


use Model\MarcaModel;

class MarcaController
{
    public static function apiActualizarMarcas()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $marca = MarcaModel::find($_POST['id_marca']);
            $marca->getId();
            $marca->nombre_marca = $_POST['nombre_marca'];
            if (isset($_FILES['imagen_marca'])) {
                if (!empty($marca->imagen_marca)) {
                    $marca->eliminarImagen($marca->imagen_marca);
                }
                $imagen = $_FILES['imagen_marca'];
                $marca->crearCarpeta();
                $marca->nombreMarcaImagen($imagen);
                $marca->subirImagen($imagen,  $marca->imagen_marca);
            }
            $resultado = $marca->guardar();
            echo json_encode(["actualizado" => $resultado]);
        }
    }

    public static function apiEliminarMarcas()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $marca = MarcaModel::find($_POST['id_marca']);
            $marca->getId();
            $marca->eliminarImagen($marca->imagen_marca);
            $resultado = $marca->eliminar();
            echo json_encode(["eliminado" => $resultado]);
        }
    }
}