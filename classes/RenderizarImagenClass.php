<?php

namespace Classes;

class RenderizarImagenClass
{
    public $imagen;
    public function __construct($imagen)
    {

        $this->imagen = $imagen;
    }

    public function renderizar($carpeta, $nombreImagen, $num)
    {
        $size = getimagesize($this->imagen);
        $width = $size[0];
        $height = $size[1];

        $resize = $num;
        $rwidth = ceil($width * $resize);
        $rheight = ceil($height * $resize);

        $original = imagecreatefromjpeg($this->imagen);

        $render = imagecreatetruecolor($rwidth, $rheight);
        imagecopyresampled(
            $render,
            $original,
            0,
            0,
            0,
            0,
            $rwidth,
            $rheight,
            $width,
            $height
        );

        imagejpeg($render, "build/img/$carpeta/" . $nombreImagen);

        imagedestroy($original);
        imagedestroy($render);
    }
}