<?php

namespace Model;

use Model\ActiveRecord;

class ComentariosModel extends ActiveRecord
{
    protected static $tabla = 'comentariosproductos';
    protected static $idTabla = 'id_comentarios';
    protected static $columnasDB = ['id_comentarios', 'comentarios', 'fecha', 'id_user', 'id_prod'];
    public $id;
    public function __construct($args = [])
    {
        $this->id_comentarios = $args['id_comentarios'] ?? null;
        $this->comentarios = $args['comentarios'] ?? null;
        $this->fecha = $args['fecha'] ?? date('Y-m-d');
        $this->id_user = $args['id_user'] ?? null;
        $this->id_prod = $args['id_prod'] ?? null;
    }

    public function getID()
    {
        $this->id =   $this->id_comentarios;
    }

    public function getComentarioUser($id)
    {
        $query = self::$db->query("SELECT * FROM " . self::$tabla . " com INNER JOIN usuario usu ON com.id_user = usu.id_user WHERE id_prod = '$id'");

        $comentarios = [];
        while ($row = $query->fetch_assoc()) {
            array_push($comentarios, $row);
        }

        return $comentarios;
    }
    public function getComentarioId($id)
    {
        $query = self::$db->query("SELECT * FROM " . self::$tabla . " com INNER JOIN usuario usu ON com.id_user = usu.id_user WHERE id_comentarios = '$id' LIMIT 1");
        $row = $query->fetch_assoc();
        return $row;
    }

    public function eliminarComentario($id)
    {
        $query = "DELETE FROM "  . static::$tabla . " WHERE " . static::$idTabla . " = " . self::$db->escape_string($this->id) . " AND id_user = '$id'  LIMIT 1";
        $resultado = self::$db->query($query);
        return $resultado;
    }
    

}