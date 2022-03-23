<?php

namespace Model;

class RolesModel extends ActiveRecord
{
    protected static $db;
    protected static $tabla = 'roles'; // nombre tabla

    //columnas de la tabla roles
    protected static $columnasDB = ['id_rol', 'nombre_rol'];

    //constructor
    public function __construct($args = [])
    {
        $this->id_rol       =   $args['id_rol']     ?? null;
        $this->nombre_rol   =   $args['nombre_rol'] ?? null;
    }
}