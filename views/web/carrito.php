<?php require_once __DIR__ . '/includes/header.php';
?>
<?php if (!isset($_SESSION['login'])) : ?>
<div class="no-login">
    <svg viewBox="0 0 512 512">
        <path
            d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM232 152C232 138.8 242.8 128 256 128s24 10.75 24 24v128c0 13.25-10.75 24-24 24S232 293.3 232 280V152zM256 400c-17.36 0-31.44-14.08-31.44-31.44c0-17.36 14.07-31.44 31.44-31.44s31.44 14.08 31.44 31.44C287.4 385.9 273.4 400 256 400z" />
    </svg>
    <p>Estás fuera de la sesión. Para guardar estos artículos y realizar pagos, <a href="">inicia sesión</a>. </p>

</div>
<?php endif; ?>

<h1 class="carrito__title">Carrito de compras
    (<?= isset($_SESSION['carrito']) ? count($_SESSION['carrito']) . " articulos " : "0 articulos";  ?>) </h1>

<section class="tablaCarrito container">
    <div class="tablaCarrito-container" id="tabla-carrito">
        <!-- API  -->
    </div>
    <div class="tablaCarrito-pay">
        <a class="tablaCarrito-pay__btn" href="">Completar la transacción</a>
        <div class="tablaCarrito-total">
            <span>Subtotal:</span>
            <p class="totalProducto">S/.

            </p>
        </div>
    </div>

</section>
<?php require_once __DIR__ . '/includes/footer.php';
