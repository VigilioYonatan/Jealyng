<?php

use Classes\EmailClass;

require_once __DIR__ . '/pdf.php'; ?>
<?php require_once __DIR__ . '/../includes/header.php';
?>
<div class='success-container2'>
    <h4 class='success-container__title'>Felicidades <?= $usuario['nombre_user']; ?></h4>
    <span class='success-container__txt'><?= $_SESSION['dataorden']['mensaje'] ?></span>
    <p>N° de orden: <?= $_SESSION['dataorden']['orden'] ?></p>
    <p>N° de transaccion: <?= $_SESSION['dataorden']['transaccion']; ?></p>

    <a download="name" href="./build/pdf/<?= $_SESSION['dataorden']['nombrePDF'] ?>">Descargar PDf</a>
    <svg class='success-container__ico' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
        <path
            d="M128 447.1V223.1c0-17.67-14.33-31.1-32-31.1H32c-17.67 0-32 14.33-32 31.1v223.1c0 17.67 14.33 31.1 32 31.1h64C113.7 479.1 128 465.6 128 447.1zM512 224.1c0-26.5-21.48-47.98-48-47.98h-146.5c22.77-37.91 34.52-80.88 34.52-96.02C352 56.52 333.5 32 302.5 32c-63.13 0-26.36 76.15-108.2 141.6L178 186.6C166.2 196.1 160.2 210 160.1 224c-.0234 .0234 0 0 0 0L160 384c0 15.1 7.113 29.33 19.2 38.39l34.14 25.59C241 468.8 274.7 480 309.3 480H368c26.52 0 48-21.47 48-47.98c0-3.635-.4805-7.143-1.246-10.55C434 415.2 448 397.4 448 376c0-9.148-2.697-17.61-7.139-24.88C463.1 347 480 327.5 480 304.1c0-12.5-4.893-23.78-12.72-32.32C492.2 270.1 512 249.5 512 224.1z" />
    </svg>
</div>




<?php
$email = new EmailClass($usuario['email_user'], $usuario['nombre_user'], $_SESSION['dataorden']['nombrePDF']);
$email->enviarFacura();
$_SESSION['dataorden'] = [];
?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>