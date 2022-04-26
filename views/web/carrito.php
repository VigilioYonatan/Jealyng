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
<h1 class="carrito__title">

</h1>

<section class="carrito container">
    <div class="carrito-container">
        <div class="CarritoBtnOpciones">

            <span class="CarritoBtn " id="btnCarritoOption">Carrito</span>/
            <span class="CarritoBtn CarritoBtn__linked" id="btnPayOption">Procesar Pago</span>
        </div>
        <div class="tablaCarrito ">

            <div class="tablaCarrito-container " id="tabla-carrito">
                <!-- API  -->
            </div>

            <div class="tablaCarrito-pay ">
                <?php if (!isset($_SESSION['login'])) : ?>
                <a class="tablaCarrito-pay__btn" href="/login?go=carrito">Completar la transacción</a>
                <?php else : ?>
                <a class=" tablaCarrito-pay__btn" id="btnCompletar">Completar la transacción</a>
                <?php endif; ?>

                <div class="tablaCarrito-total">
                    <span>Subtotal:</span>
                    <p class="totalProducto">S/.

                    </p>
                </div>

            </div>

            <?php
            if (isset($_SESSION['id'])) :
                $usuario = selectSqlBYid($_SESSION['id']);
            ?>
            <div class="tablaCarrito-container2 hidden">
                <div class="tablaCarrito2-container__info">
                    <span class="tablaCarrito2-container__title">Direccion de envio:</span>
                    <p>Departamento:
                        <span><?= $usuario['departamento']; ?></span>
                    </p>
                    <p>Provincia:
                        <span><?= $usuario['provincia']; ?></bspan>
                    </p>
                    <p>Distrito:
                        <span><?= $usuario['distrito']; ?></span>
                    </p>
                    <p>Direccion:
                        <span><?= $usuario['direccion_user']; ?></span>
                    </p>
                    <a href="/perfil">Editar Direccion</a>
                    <p>Precio total:<b class="totalProducto">S/.</b>

                    </p>

                </div>
            </div>
            <?php endif; ?>
            <script
                src="https://www.paypal.com/sdk/js?client-id=Ae_LRNWE4nHb-kGgoyY2zDPPK0N6sK8Drjby4UNE8BDhYXoJfk883mC8amtmbr-m1KyKRGc0ldNSv2Ot&currency=USD">
            </script>
            <div class="tablaCarrito-pay2 hidden">
                <div id="paypal-button-container"></div>
            </div>

        </div>
    </div>

</section>






<?php require_once __DIR__ . '/includes/footer.php'; ?>
<script src="./build/js/web/shop/paypal.js">

</script>