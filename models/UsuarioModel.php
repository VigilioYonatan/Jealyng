<?php

namespace Model;

class UsuarioModel extends ActiveRecord
{

    protected static $tabla = 'usuario'; // nombre tabla
    protected static $idTabla = 'id_user'; //id usuario
    protected static $carpeta = 'usuarios/'; //carpeta usuarios
    public $id; //id
    //columnas de la tabla usuario
    protected static $columnasDB = ['id_user', 'nick_user', 'nombre_user', 'apellidoMaterno_user', 'apellidoPaterno_user', 'email_user', 'password_user', 'nacimiento_user', 'telefono_user', 'id_departamento', 'id_provincia', 'id_distrito', 'direccion_user', 'imagen_user', 'wallpaper_user', 'estado_user', 'token_user', 'fechaCreado_user', 'id_rol'];

    //constructor 
    public function __construct($args = [])
    {
        $this->id_user =                $args['id_user']                ?? null;
        $this->nick_user =                $args['nick_user']                ?? null;
        $this->nombre_user =            $args['nombre_user']            ?? null;
        $this->apellidoMaterno_user =   $args['apellidoMaterno_user']   ?? null;
        $this->apellidoPaterno_user =   $args['apellidoPaterno_user']   ?? null;
        $this->email_user =             $args['email_user']             ?? null;
        $this->password_user =          $args['password_user']          ?? null;
        $this->nacimiento_user =        $args['nacimiento_user']        ?? date('Y-m-d');
        $this->telefono_user =          $args['telefono_user']          ?? null;
        $this->id_departamento =        $args['id_departamento']        ?? 1;
        $this->id_provincia =           $args['id_provincia']           ?? 1;
        $this->id_distrito =            $args['id_distrito']            ?? 1;
        $this->direccion_user =         $args['direccion_user']         ?? null;
        $this->imagen_user =            $args['imagen_user']            ?? null;
        $this->wallpaper_user =         $args['wallpaper_user']         ?? 'wallpaperDefecto.jpg';
        $this->estado_user =            $args['estado_user']            ?? 0;
        $this->token_user =             $args['token_user']             ?? null;
        $this->fechaCreado_user =       $args['fechaCreado_user']             ?? date('Y-m-d');
        $this->id_rol =                 $args['id_rol']                ?? 1;
    }

    public function getID()
    {
        $this->id =  $this->id_user;
    }


    public function tokenUsuario()
    {
        $this->token_user = uniqid();
    }
    public function hashPassword()
    {
        $this->password_user = password_hash($this->password_user, PASSWORD_BCRYPT);
    }

    //si existe un usuario en el sistema
    public function existeUsuario()
    {

        $query = self::$db->query("SELECT * FROM " . self::$tabla . " WHERE email_user = '$this->email_user' LIMIT 1");

        return $query->num_rows;
    }
    //si existe un usuario en el sistema
    public function existeNick()
    {

        $query = self::$db->query("SELECT * FROM " . self::$tabla . " WHERE nick_user = '$this->nick_user' LIMIT 1");

        return $query->num_rows;
    }

    // hash password
    public function hashearPassword($password)
    {
        $this->password_user = password_hash(self::$db->escape_string($password), PASSWORD_BCRYPT);
    }

    public function crearNombreImagen($imagen)
    {
        $tipoImagen = pathinfo($imagen['name'], PATHINFO_EXTENSION);
        $this->imagen_user = md5(uniqid(rand(), true)) . ".$tipoImagen";
    }
    public function crearNombrePortada($imagen)
    {
        $tipoImagen = pathinfo($imagen['name'], PATHINFO_EXTENSION);
        $this->wallpaper_user = md5(uniqid(rand(), true)) . ".$tipoImagen";
    }
}