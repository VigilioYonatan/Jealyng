<?php

namespace Controller;

use Model\FavoritoModel;

class FavoritoController
{
    public static  function apiAddFavorito()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();

            if (isset($_SESSION['login'])) {

                $fav = new FavoritoModel;
                $fav->id_user = $_SESSION['id'];
                $fav->id_prod = $_POST['id_prod'];
                $existe = $fav->issetFav();

                if ($existe < 1) {

                    $guardarFv = $fav->guardar();
                    $favorito = [
                        "idFavorito" => $_POST['id_prod']
                    ];
                    $_SESSION['favorito'] = [...$_SESSION['favorito'], $favorito];

                    echo json_encode(["resultado" =>  $guardarFv, "id" => $_POST['id_prod'], "nombre" => $_SESSION['nick']]);
                } else {
                    $eliminado = $fav->eliminarFavorito();
                    foreach ($_SESSION['favorito'] as $key => $value) {

                        if ($value['idFavorito'] == $_POST['id_prod']) {
                            unset($_SESSION['favorito'][$key]);
                        }
                    }
                    echo json_encode(["eliminado" =>  $eliminado]);
                }
            } else {
                if (empty($_SESSION['favorito'])) {


                    $_SESSION['favorito'] = [];
                    $favorito = [
                        "idFavorito" => $_POST['id_prod']
                    ];
                    $_SESSION['favorito'] = [...$_SESSION['favorito'], $favorito];



                    echo json_encode(["id" => $_POST['id_prod']]);
                } else {

                    $favColumna = array_column($_SESSION['favorito'], 'idFavorito');

                    if (in_array($_POST['id_prod'], $favColumna)) {

                        foreach ($_SESSION['favorito'] as $key => $value) {

                            if ($value['idFavorito'] == $_POST['id_prod']) {
                                unset($_SESSION['favorito'][$key]);
                                echo json_encode(["eliminado" => true]);
                            }
                        }
                    } else {
                        $favorito = [
                            "idFavorito" => $_POST['id_prod']
                        ];
                        $_SESSION['favorito'] = [...$_SESSION['favorito'], $favorito];
                        echo json_encode(["id" => $_POST['id_prod']]);
                    }
                }
            }
        }
    }

    public static function apiViewFavorito()
    {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            // favoritos
            if (isset($_SESSION['login'])) {
                $inner2 = " fav INNER JOIN productos pro ON fav.id_prod = pro.id_prod WHERE fav.id_user = $_SESSION[id]";
                $favoritos = FavoritoModel::buscadorPageInner(0, 20, $inner2);
                echo json_encode(["fav" => true,  "favoritos" => $favoritos]);
            }else{
                echo json_encode(["fav" => false]);

            }
        }
    }

    public static function apiRemoveFavorito()
    {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $eliminarFav = new FavoritoModel($_POST);
            $eliminarFav->getId();
            $resultado = $eliminarFav->eliminar();
            foreach ($_SESSION['favorito'] as $key => $value) {

                if ($value['idFavorito'] == $_POST['id_prod']) {
                    unset($_SESSION['favorito'][$key]);
                }
            }
            echo json_encode(["resultado" => $resultado, "eliminado" => $eliminarFav->idFavorito]);
        }
    }
}