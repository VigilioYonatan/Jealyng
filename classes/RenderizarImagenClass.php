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
        $size = getimagesize($this->imagen['tmp_name']);
        $width = $size[0];
        $height = $size[1];

        $resize = $num;
        $rwidth = ceil($width * $resize);
        $rheight = ceil($height * $resize);


        $imagenInfo = pathinfo($this->imagen['name'], PATHINFO_EXTENSION);
        switch ($imagenInfo) {
            case 'jpg':

                $original = imagecreatefromjpeg($this->imagen['tmp_name']);

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
                break;
            case 'webp':

                $original = imagecreatefromwebp($this->imagen['tmp_name']);

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

                imagewebp($render, "build/img/$carpeta/" . $nombreImagen);

                imagedestroy($original);
                imagedestroy($render);
                break;
            case 'png':
                // abir la imagen original
                $original = imagecreatefrompng($this->imagen['tmp_name']);
                // redimenzionar  la imgen
                $resizeImage = imagecreatetruecolor($rwidth, $rheight);
                imagealphablending($resizeImage, false);
                imagesavealpha($resizeImage, true);
                imagecopyresampled(
                    $resizeImage,
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
                imagepng($resizeImage, "build/img/$carpeta/" . $nombreImagen);
                break;

            default:
                # code...
                break;
        }
    }
}