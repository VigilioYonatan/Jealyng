<?php

namespace Model;

class HistorialComprasModel extends ActiveRecord
{
    protected static $tabla = 'historialcompras'; // nombre tabla
    protected static $idTabla = 'id_compras'; //id producto
    public $id; //id
    //columnas de la tabla productos
    protected static $columnasDB = ['id_compras', 'id_pedido', 'id_user', 'id_prod', 'cantidad', 'costoTotalCarrito'];

    public function __construct($args = [])
    {
        $this->id_compras         = $args['id_compras']          ?? null;
        $this->id_pedido     = $args['id_pedido']        ?? null;
        $this->id_user             = $args['id_user']        ?? null;
        $this->id_prod              = $args['id_prod']        ?? null;
        $this->cantidad             = $args['cantidad']        ?? null;
        $this->costoTotalCarrito    = $args['costoTotalCarrito']        ?? null;
    }
    public function getID()
    {
        $this->id =  $this->id_compras;
    }
}