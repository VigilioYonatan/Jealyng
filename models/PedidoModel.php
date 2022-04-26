<?php

namespace Model;


date_default_timezone_set("America/Lima");
class PedidoModel extends ActiveRecord
{
    protected static $tabla = 'pedido'; // nombre tabla
    protected static $idTabla = 'id_pedido'; //id producto
    public $id; //id

    //columnas de la tabla productos
    protected static $columnasDB = ['id_pedido', 'id_user', 'monto', 'referenciacobro', 'idtransaccionpaypal', 'datospaypal', 'fecha_pedido', 'direccionEnvio', 'id_metodoP', 'estado'];

    public function __construct($args = [])
    {
        $this->id_pedido                = $args['id_pedido']            ?? null;
        $this->id_user                  = $args['id_user']              ?? null;
        $this->monto                 = $args['monto']              ?? null;
        $this->referenciacobro          = $args['referenciacobro']      ?? null;
        $this->idtransaccionpaypal      = $args['idtransaccionpaypal']  ?? null;
        $this->datospaypal              = $args['datospaypal']          ?? null;
        $this->fecha_pedido             = $args['fecha_pedido']         ??  date('Y-m-d H:i:s');
        $this->direccionEnvio           = $args['direccionEnvio']       ?? null;
        $this->id_metodoP               = $args['id_metodoP']           ?? null;
        $this->estado                   = $args['estado']               ?? "Pendiente";
    }


    public function getId()
    {
        $this->id =  $this->id_pedido;
    }
}