<?php
ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    body {
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }

    .header {
        background-color: #161616;
        padding: .3rem 0;
    }

    .footer {
        background-color: #161616;
        padding: .3rem 0;
        position: absolute;
        bottom: 0;
        right: 0;
        left: 0;
    }

    .footer span {
        display: block;
        text-align: center;
        color: #fff;
    }

    .intro h1 {
        text-align: center;
    }

    .intro-1 {
        float: left;
        margin: 0rem 1rem;

    }

    .intro-1 span {
        display: block;
    }


    .clearfix {
        clear: both;
    }

    h2 {
        font-size: 1.2rem;
        color: #161616;
        margin: 0;
    }

    .info h2 {
        margin: 0rem 1rem;
    }

    .info span {
        margin: 0rem 1rem;
        display: block;
    }

    .info-table {
        margin: 2rem 0;
        text-align: center;
    }

    table {
        border: 2px solid #161616;
        margin: 0 auto;
        font-size: .8rem;
    }

    thead {
        border-bottom: 2px solid #161616;
        /* padding: .3rem 1rem; */
    }

    th,
    td {
        width: 100px;

        text-align: center;
        border-left: 2px solid #161616;
    }

    td {
        min-height: 50px;
        overflow: hidden;
        border-bottom: 2px solid #161616;
    }

    .total {}

    .total span {
        text-align: center;
        background-color: #161616;
        color: #fff;
        padding: .5rem 1rem;
        border-radius: .5rem;
    }

    .total b {

        text-align: center;
        font-size: 1.2rem;
    }

    .total2 {
        float: right;
        margin-top: 2rem;
    }

    .total1 span {
        text-align: center;
        background-color: black;
        color: #fff;
        padding: .5rem 1rem;
    }
    </style>
</head>

<body>
    <div class="header">

    </div>
    <section class="intro">
        <h1>Jealyng S.A.C</h1>
        <div class="intro-1">
            <span>Sistema de ventas Web S.A</span>
            <span>Direccion de la empresa</span>
            <span>Perú</span>
        </div>
        <div class="intro-1">
            <span>Web: www.jealyng.com</span>
            <span>Email: jealyng-web@gmail.com</span>
            <span>Tel:
                + 51 934399322
            </span>
            <span>Facebook: Jealyng S.A.C</span>
        </div>
        <div class="intro-1">
            <span>Whatsapp: + 51 934399322
            </span>

        </div>
        <div class="clearfix">

        </div>
    </section>

    <section class="info">
        <h2>Factura</h2>
        <div class="info-user">
            <span>Nombre: <?= $_SESSION['dataorden']['info']['nombre']  ?>
            </span>
            <span>Apellido Paterno: <?= $_SESSION['dataorden']['info']['apellido'] ?></span>
            <span>Direccion: <?= $_SESSION['dataorden']['info']['direccion']  ?></span>
        </div>
        <div class="info-table">
            <table>
                <thead>
                    <tr>
                        <th>Id producto</th>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Precio c/u</th>
                        <th>Cantidad</th>
                        <th>Costo total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $producto = $_SESSION['dataorden']['producto'];
                    foreach ($producto as $pro) : ?>
                    <tr>
                        <td>1</td>
                        <td><img src="./build/img/productos/<?= $pro->imagen_prod ?>" width="50px" alt="">
                        </td>
                        <td><?= $pro->nombre_prod ?> </td>
                        <td>S/. <?= $pro->precio ?></td>
                        <td><?= $pro->cantidad_carrito ?> Unidades</td>
                        <td>S/. <?= $pro->precio * $pro->cantidad_carrito  ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="total">
            <span>Precio Total: <br><b>S/ <?= $_SESSION['dataorden']['info']['total']  ?></b></span>
            <div class="clearfix">

            </div>
        </div>
        <div class="total2">
            <span>Fecha: <br><b> <?= $_SESSION['dataorden']['info']['fecha']  ?></b></span>

        </div>
        <div class="clearfix">

        </div>
    </section>
    <div class=" footer">
        <span> Jealyng S.A.C 2022-</span>

    </div>
</body>

</html>
<?php



$html = ob_get_clean();
// instantiate and use the dompdf class
use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
// $options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
// $dompdf->setOptions($options);
$dompdf = new Dompdf($options);



$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

//Renderiza el archivo primero
$dompdf->render();

//Guardalo en una variable
$output = $dompdf->output();
// $nombre = md5(uniqid(rand(), true)) . '.pdf';
file_put_contents('./build/pdf/' . $_SESSION['dataorden']['nombrePDF'], $output);

// Output the generated PDF to Browser
//$dompdf->stream(); //mostrar el pdf en el navegador
?>