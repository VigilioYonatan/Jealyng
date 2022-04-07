<?php require_once __DIR__ . '/includes/header.php';
?>

<!-- productps -->
<section class="products">
    <div class="producto">
        <div class="mostrar-card-container4">
            <div class="mostrar-card-container2__card">
                <div id="glider" class="mostrar-card-container2__list">
                    <div class="mostrar-card-container2__elm">
                        <img class="mostrar-card-container2__img"
                            src="./build/img/productos/<?= $producto['imagen_prod'] ?>" alt="">
                        <?php if ($producto['nombre_descuento'] > 0) : ?>
                        <span class="best-card__best2">
                            - %<?= $producto['nombre_descuento'] * 100 ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="mostrar-card-container2__elm">
                        <img class="mostrar-card-container2__img"
                            src="./build/img/productos/<?= $producto['imagen2_prod'] ?>" alt="">
                        <?php if ($producto['nombre_descuento'] > 0) : ?>
                        <span class="best-card__best2">
                            - %<?= $producto['nombre_descuento'] * 100 ?></span>
                        <?php endif; ?>
                    </div>
                </div>


                <div role="tablist" class="carousel__indicadores"></div>
            </div>
            <div class="mostrar-card__info">
                <span class="mostrar-card__id">ID: <?= $producto['id_prod'] ?></span>
                <span class="mostrar-card__name"><?= $producto['nombre_prod'] ?></span>
                <span class="mostrar-card__desc">Antes: <b>S/.<?= $producto['precio_prod'] ?></b> </span>
                <span class="mostrar-card__price">Ahora:
                    <?= number_format($producto['precio_prod'] - ($producto['precio_prod'] * $producto['nombre_descuento']), 2) ?></span>
                <div class="mostrar-card__qty">
                    <input class="mostrar-card__cantidad" type="tel" value="0">

                    <span class="mostrar-card__stock">Stock: <b><?= $producto['stock_prod'] ?></b></span>

                </div>
                <div class="mostrar-card-desc">
                    <span class="mostrar-card-desc__title">Descripcion:</span>
                    <p class="mostrar-card-desc__txt">
                        <?= $producto['descripcion_prod'] ?>
                    </p>
                </div>
                <?php if ($producto['stock_prod'] > 0) : ?>
                <a class="mostrar-card__add" href="#"><svg class="header-info__ico" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 448 512">
                        <path
                            d="M352 160v-32C352 57.42 294.579 0 224 0 153.42 0 96 57.42 96 128v32H0v272c0 44.183 35.817 80 80 80h288c44.183 0 80-35.817 80-80V160h-96zm-192-32c0-35.29 28.71-64 64-64s64 28.71 64 64v32H160v-32zm160 120c-13.255 0-24-10.745-24-24s10.745-24 24-24 24 10.745 24 24-10.745 24-24 24zm-192 0c-13.255 0-24-10.745-24-24s10.745-24 24-24 24 10.745 24 24-10.745 24-24 24z">
                        </path>
                    </svg> <b>Agregar Carrito</b>
                    <?php else : ?>
                    <span class="mostrar-card__agotado"><svg class="header-info__ico" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 448 512">
                            <path
                                d="M80 192V144C80 64.47 144.5 0 224 0C303.5 0 368 64.47 368 144V192H384C419.3 192 448 220.7 448 256V448C448 483.3 419.3 512 384 512H64C28.65 512 0 483.3 0 448V256C0 220.7 28.65 192 64 192H80zM144 192H304V144C304 99.82 268.2 64 224 64C179.8 64 144 99.82 144 144V192z" />
                        </svg> <b>Agotado</b></span>
                    <?php endif; ?>
                </a>
            </div>
        </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
<script src=" ./build/js/web/slider/slider.js"></script>
<script src="./build/js/web/shop/producto.js"></script>