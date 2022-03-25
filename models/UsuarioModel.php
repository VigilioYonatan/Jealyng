<?php

namespace Model;

class UsuarioModel extends ActiveRecord
{
    protected static $db;
    protected static $tabla = 'usuario'; // nombre tabla

    //columnas de la tabla usuario
    protected static $columnasDB = ['id_user', 'nombre_user', 'apellidoMaterno_user', 'apellidoPaterno_user', 'email_user', 'password_user', 'nacimiento_user', 'telefono_user', 'id_departamento', 'id_provincia', 'id_distrito', 'direccion_user', 'imagen_user', 'estado_user', 'token_user', 'id_rol'];

    //constructor 
    public function __construct($args = [])
    {
        $this->id_user =                $args['id_user']                ?? null;
        $this->nombre_user =            $args['nombre_user']            ?? null;
        $this->apellidoMaterno_user =   $args['apellidoMaterno_user']   ?? null;
        $this->apellidoPaterno_user =   $args['apellidoPaterno_user']   ?? null;
        $this->email_user =             $args['email_user']             ?? null;
        $this->password_user =          $args['password_user']          ?? null;
        $this->nacimiento_user =        $args['nacimiento_user']        ?? null;
        $this->telefono_user =          $args['telefono_user']          ?? null;
        $this->id_departamento =        $args['id_departamento']        ?? 1;
        $this->id_provincia =           $args['id_provincia']           ?? 1;
        $this->id_distrito =            $args['id_distrito']            ?? 1;
        $this->direccion_user =         $args['direccion_user']         ?? null;
        $this->imagen_user =            $args['imagen_user']            ?? null;
        $this->estado_user =            $args['estado_user']            ?? null;
        $this->token_user =             $args['token_user']             ?? null;
        $this->id_rol =                 $args['id_rol']                 ?? 1;
    }
}