<?php

namespace Model;

class ProductosModel extends ActiveRecord
{
    protected static $tabla = 'productos'; // nombre tabla
    protected static $idTabla = 'id_prod'; //id producto
    protected static $carpeta = 'productos/';
    public $id; //id
    //columnas de la tabla productos
    protected static $columnasDB = ['id_prod', 'nombre_prod', 'descripcion_prod', 'precio_prod', 'imagen_prod', 'imagen2_prod', 'stock_prod', 'id_categoria', 'id_subcategoria', 'id_marca', 'id_descuento', 'id_estado'];

    public function __construct($args = [])
    {
        $this->id_prod          = $args['id_prod']          ?? null;
        $this->nombre_prod      = $args['nombre_prod']      ?? null;
        $this->descripcion_prod = $args['descripcion_prod'] ?? null;
        $this->precio_prod      = $args['precio_prod']      ?? null;
        $this->imagen_prod      = $args['imagen_prod']      ?? null;
        $this->imagen2_prod      = $args['imagen2_prod']      ?? null;
        $this->stock_prod       = $args['stock_prod']       ?? null;
        $this->id_categoria     = $args['id_categoria']     ?? null;
        $this->id_subcategoria  = $args['id_subcategoria']     ?? null;
        $this->id_marca         = $args['id_marca']         ?? null;
        $this->id_descuento     = $args['id_descuento']     ?? null;
        $this->id_estado        = $args['id_estado']        ?? null;
    }
    public function getID()
    {
        $this->id =  $this->id_prod;
    }

    public function crearNombreImagen($imagen)
    {
        $tipoImagen = pathinfo($imagen['name'], PATHINFO_EXTENSION);
        $this->imagen_prod  = md5(uniqid(rand(), true)) . ".$tipoImagen";
    }
    public function crearNombreImagen2($imagen)
    {
        $tipoImagen = pathinfo($imagen['name'], PATHINFO_EXTENSION);
        $this->imagen2_prod  = md5(uniqid(rand(), true)) . ".$tipoImagen";
    }

    public function getAllInfo()
    {
        $query = self::$db->query("SELECT pro.id_prod, pro.nombre_prod, pro.descripcion_prod, pro.precio_prod, pro.imagen_prod,pro.imagen2_prod,pro.stock_prod, pro.id_categoria,pro.id_subcategoria,pro.id_marca, pro.id_descuento, pro.id_estado,  nombre_categoria, nombre_subcat,nombre_marca,nombre_descuento,nombre_estadoPro FROM productos pro
                                    INNER JOIN categoria cat on pro.id_categoria = cat.id_categoria
                                    INNER JOIN subcategoria sub on pro.id_subcategoria = sub.id_subcat
                                    INNER JOIN marca on pro.id_marca = marca.id_marca
                                    INNER JOIN descuento ON pro.id_descuento = descuento.id_descuento
                                    INNER JOIN estadoproducto on pro.id_estado = estadoproducto.id_estadoPro ORDER BY pro.id_prod  DESC LIMIT 10");
        $producto = [];

        while ($row = $query->fetch_assoc()) {
            array_push($producto, $row);
        }

        return  $producto;
    }

    public function buscadorProducto($nombre)
    {
        $query = self::$db->query("SELECT pro.id_prod, pro.nombre_prod, pro.descripcion_prod, pro.precio_prod, pro.imagen_prod,pro.stock_prod, pro.id_categoria,pro.id_subcategoria,pro.id_marca, pro.id_descuento, pro.id_estado,  nombre_categoria, nombre_subcat,nombre_marca,nombre_descuento,nombre_estadoPro FROM productos pro 
        INNER JOIN categoria cat on pro.id_categoria = cat.id_categoria
        INNER JOIN subcategoria sub on pro.id_subcategoria = sub.id_subcat
        INNER JOIN marca on pro.id_marca = marca.id_marca
        INNER JOIN descuento de ON pro.id_descuento = de.id_descuento
        INNER JOIN estadoproducto on pro.id_estado = estadoproducto.id_estadoPro WHERE pro.nombre_prod LIKE'%$nombre%' ");
        $producto = [];

        while ($row = $query->fetch_assoc()) {
            array_push($producto, $row);
        }

        return  $producto;
    }

    // tienda
    public function tiendaSubcategoria($sub, $cat, $desde, $porPagina, $condicion, $descuento)

    {
        $query = self::$db->query("SELECT * FROM productos
        INNER JOIN categoria cat on productos.id_categoria = cat.id_categoria
         INNER JOIN subcategoria on productos.id_subcategoria = subcategoria.id_subcat
         INNER JOIN estadoproducto est on productos.id_estado = est.id_estadoPro
          INNER JOIN descuento de on productos.id_descuento = de.id_descuento
           WHERE  cat.nombre_categoria =  '$cat' AND subcategoria.nombre_subcat LIKE '%$sub%'
             AND est.nombre_estadoPro LIKE '%$condicion%' AND de.nombre_descuento LIKE '%$descuento%' LIMIT $desde, $porPagina");


        if ($query->num_rows < 1) {
            header('Location: /error');
        }
        $tiendaSub = [];

        while ($row = $query->fetch_assoc()) {
            array_push($tiendaSub, $row);
        }

        return  $tiendaSub;
    }
    // productoId
    public function productoId($id)
    {
        $query = self::$db->query("SELECT pro.id_prod, pro.nombre_prod, pro.descripcion_prod, pro.precio_prod, pro.imagen_prod, pro.imagen2_prod,pro.stock_prod, sub.nombre_subcat, cat.nombre_categoria, des.nombre_descuento, mar.nombre_marca,est.nombre_estadoPro FROM productos pro
                                        INNER JOIN categoria cat on pro.id_categoria = cat.id_categoria
                                        INNER JOIN subcategoria sub on pro.id_subcategoria = sub.id_subcat
                                        INNER JOIN descuento des on pro.id_descuento = des.id_descuento 
                                        INNER JOIN marca mar on pro.id_marca = mar.id_marca 
                                        INNER JOIN estadoproducto est on pro.id_estado = est.id_estadoPro WHERE pro.id_prod = $id LIMIT 1");



        $row = $query->fetch_assoc();


        return  $row;
    }
    // paginador 

    public function paginador($sub, $cat, $condicion, $descuento)
    {
        $query = self::$db->query("SELECT COUNT(*) AS total FROM productos
         INNER JOIN categoria cat on productos.id_categoria = cat.id_categoria
        INNER JOIN estadoproducto est on productos.id_estado = est.id_estadoPro 
        INNER JOIN subcategoria on productos.id_subcategoria = subcategoria.id_subcat
        INNER JOIN descuento de on productos.id_descuento = de.id_descuento
        WHERE  cat.nombre_categoria =  '$cat' AND subcategoria.nombre_subcat LIKE '%$sub%'  
        AND est.nombre_estadoPro LIKE '%$condicion%' AND de.nombre_descuento LIKE '%$descuento%' ");
        $resultado = $query->fetch_assoc();
        return $resultado['total'];
    }

    public function nombreProducto($nombre)
    {
        $query = self::$db->query("SELECT pro.id_prod, pro.nombre_prod, pro.descripcion_prod, pro.precio_prod, pro.imagen_prod,pro.imagen2_prod,pro.stock_prod, pro.id_categoria,pro.id_subcategoria,pro.id_marca, pro.id_descuento, pro.id_estado,  nombre_categoria, nombre_subcat,nombre_marca,imagen_marca,nombre_descuento,nombre_estadoPro FROM productos pro 
        INNER JOIN categoria cat on pro.id_categoria = cat.id_categoria
        INNER JOIN subcategoria sub on pro.id_subcategoria = sub.id_subcat
        INNER JOIN marca on pro.id_marca = marca.id_marca
        INNER JOIN descuento ON pro.id_descuento = descuento.id_descuento
        INNER JOIN estadoproducto on pro.id_estado = estadoproducto.id_estadoPro WHERE pro.nombre_prod LIKE '%$nombre%' LIMIT 1");

        if ($query->num_rows < 1) {
            header('Location: /error');
        }
        $rowProducto = $query->fetch_assoc();

        return   $rowProducto;
    }

    // carrito 
    public function addCarritoProducto($id)
    {
        $query = self::$db->query("SELECT * FROM productos INNER JOIN descuento de on productos.id_descuento = de.id_descuento WHERE id_prod = '$id'");


        // if ($query->num_rows < 1) {
        //     header('Location: /error');
        // }


        $row = $query->fetch_assoc();

        return  $row;
    }
}