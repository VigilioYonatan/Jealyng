<?php require_once __DIR__ . '/includes/header.php';
?>
<div class="productos__linked">
    <a href="/categoria?nombre=<?= $producto['nombre_categoria'] ?>"><?= $producto['nombre_categoria'] ?>/</a>
    <p><?= $producto['nombre_prod'] ?></p>
</div>

<!-- productps -->
<section class="products">
    <div class="producto">
        <div class="mostrar-card-container4">
            <div class="mostrar-card-container2__card producto__img">
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
            <div class="mostrar-card__info mostrar-card__borde producto__info" data-id="<?= $producto['id_prod'] ?>">
                <span class="mostrar-card__id">ID: <?= $producto['id_prod'] ?></span>
                <span class="mostrar-card__name"><?= $producto['nombre_prod'] ?></span>
                <span class="mostrar-card__desc">Antes: <b>S/.<?= $producto['precio_prod'] ?></b> </span>
                <span class="mostrar-card__price">Ahora:
                    S/.
                    <?= number_format($producto['precio_prod'] - ($producto['precio_prod'] * $producto['nombre_descuento']), 2) ?></span>
                <div class="mostrar-card__qty">
                    <input class="mostrar-card__cantidad" type="number" value="1">

                    <span class="mostrar-card__stock">Stock: <b><?= $producto['stock_prod'] ?></b></span>

                </div>
                <div class="mostrar-card__marca">
                    <span>Marca:</span>
                    <img width="30px" src="./build/img/marcas/<?= $producto['imagen_marca'] ?>" alt="">
                </div>
                <div class="mostrar-card-desc producto__parrafo">
                    <span class="mostrar-card-desc__title">Descripcion:</span>
                    <p class="mostrar-card-desc__txt">
                        <?= $producto['descripcion_prod'] ?>
                    </p>
                </div>
                <?php if ($producto['stock_prod'] > 0) : ?>
                <a class="mostrar-card__add" id="addCart" href="#"><svg class="header-info__ico"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
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
        <section class="comentarios">
            <div class="comentario-container">
                <div class="comentarios-preguntar">
                    <h4 class="comentarios__title">Comentarios</h4>
                    <span>Pregúntale al Vendedor</span>
                    <form method="POST" class="comentarios-preguntar__input" id="comment">
                        <input type="text" placeholder="Escribe tu pregunta..." maxlength="100">
                        <button>Preguntar</button>
                    </form>
                </div>

                <article class="comentario" id="comentarios">
                    <!-- api Comentario -->
                </article>
            </div>
            <div class="comentario-offer">
                <span class="filtros__title">Productos relacionados</span>
                <div class="comentario-offer__product" id="cards">
                    <?php foreach ($relacionado as $rel) : ?>
                    <?php if ($rel['id_prod'] !== $producto['id_prod']) : ?>
                    <div class="offer-card" data-id="<?= $rel['id_prod'] ?>">
                        <picture class="best-card__img">
                            <img class="best-card__image2" src="./build/img/productos/<?= $rel['imagen_prod'] ?>"
                                alt="">
                            <?php if ($rel['nombre_descuento'] > 0) : ?>
                            <span class="best-card__best">
                                - %<?= $rel['nombre_descuento'] * 100 ?></span>
                            <?php endif; ?>
                            <div class="best-card__img2">
                                <img class="best-card__image" src="./build/img/productos/<?= $rel['imagen2_prod'] ?>"
                                    alt="">
                                <span class="best-card__view">Más información</span>
                            </div>
                        </picture>
                        <div class="best-card-info">
                            <span class="best-card-info__title"><?= $rel['nombre_prod'] ?></span>
                            <span class="best-card-info__price">Antes: S/.
                                <?= number_format($rel['precio_prod'], 2) ?></span>
                            <span class="best-card-info__desc">Ahora: S/.
                                <?= number_format($rel['precio_prod'] - ($rel['precio_prod'] * $rel['nombre_descuento']), 2) ?></span>
                        </div>

                        <?php
                                $show = false;
                                if (!empty($_SESSION['favorito'])) {
                                    $favColumna = array_column($_SESSION['favorito'], 'idFavorito');
                                    if (in_array($rel['id_prod'], $favColumna)) {
                                        $show = true;
                                    } else {
                                        $show = false;
                                    }
                                } else {
                                    $show = false;
                                }
                                ?>
                        <p class="icoFavorito <?= $show ? 'show' : ''; ?>"><svg width="24px" height="24px"
                                viewBox="0 0 24 24" fill="none" xmlns=" http://www.w3.org/2000/svg">
                                <path class="icoFavoritoBTN" opacity="0.75"
                                    d="M4.3314 12.0474L12 20L19.6686 12.0474C20.5211 11.1633 21 9.96429 21 8.71405C21 6.11055 18.9648 4 16.4543 4C15.2487 4 14.0925 4.49666 13.24 5.38071L12 6.66667L10.76 5.38071C9.90749 4.49666 8.75128 4 7.54569 4C5.03517 4 3 6.11055 3 8.71405C3 9.96429 3.47892 11.1633 4.3314 12.0474Z"
                                    fill="<?= $show ? 'red' : 'white'; ?>" />
                                <path d=" M4.3314 12.0474L12 20L19.6686 12.0474C20.5211 11.1633 21 9.96429 21 8.71405C21
                                    6.11055 18.9648 4 16.4543 4C15.2487 4 14.0925 4.49666 13.24 5.38071L12 6.66667L10.76
                                    5.38071C9.90749 4.49666 8.75128 4 7.54569 4C5.03517 4 3 6.11055 3 8.71405C3 9.96429
                                    3.47892 11.1633 4.3314 12.0474Z" stroke="var(--color-fonts-primary)"
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg></p>
                    </div>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

    </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
<script src=" ./build/js/web/slider/slider.js"></script>
<script src="./build/js/web/shop/comentarios.js"></script>
<script src="./build/js/web/shop/producto.js"></script>