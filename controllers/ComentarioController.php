<?php

namespace Controller;

use Model\ComentariosModel;

class ComentarioController
{
    public static function ApiComentario()
    {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $comentario = new ComentariosModel($_POST);
            $comentario->id_user = $_SESSION['id'] ?? null;
            $guardar =  $comentario->guardar();
            $comment = $comentario->getComentarioId($guardar['id']);
            echo json_encode(["resultado" => $comment, "enviado" => $guardar]);
        }
    }
    public static function apiGetComentario()
    {
        session_start();
        $comentario = new ComentariosModel;
        $resultado = $comentario->getComentarioUser($_GET['id']);
        echo json_encode(["resultado" => $resultado, "id_user" => $_SESSION['id'] ?? null]);
    }

    public static function ApiEliminarComentario()
    {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $comentario = new ComentariosModel();
            $comentario->id_comentarios = $_POST['id_comentarios'];
            $comentario->getId();
            $resultado = $comentario->eliminarComentario($_SESSION['id']);
            echo json_encode(["eliminar" => $resultado, "id" => $_POST['id_comentarios']]);
        }
    }
    public static function actualizarComentario()
    {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $comentario =  ComentariosModel::find($_POST['id']);
            $comentario->getId();
            if($comentario->id_user === $_SESSION['id']){
                $comentario->comentarios = $_POST['comentarios'];
                $comentario->fecha = date('Y-m-d');
                $resultado = $comentario->guardar();
                echo json_encode(["resultado" => $resultado, "comentario" => $comentario]);
            }
          
        }
    }
}