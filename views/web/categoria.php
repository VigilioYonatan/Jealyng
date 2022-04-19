<?php require_once __DIR__ . '/includes/header.php';
?>
<section class="categorias container">
    <a href="/tienda?categoria=<?= $categoria; ?>" class="categorias__wallpaper">
        <img src="./build/img/categorias/<?= $cats->wallpaper_categoria; ?>" alt="">
        <span><?= $categoria; ?></span>
        <div class="categorias__background"></div>
    </a>
    <!-- cards -->
    <div class="contenido-category">
        <h3 class="contenido-card__title">TUS SUBCATEGORÍAS PREFERIDAS<span class="contenido-card__subtitle"></span>
        </h3>
        <div class="pro-cards" class="cards">
            <?php foreach ($categorias as $sub) : ?>
            <a href="/tienda?categoria=<?= $categoria; ?>&producto=<?= $sub->nombre_subcat ?>" class="best-category">
                <picture class="best-category__img">
                    <img class="best-category__image2" src="./build/img/subcategorias/<?= $sub->imagen_subcat ?>"
                        alt="">
                </picture>
                <div class="best-category-info">
                    <span class="best-category-info__title"><?= $sub->nombre_subcat ?></span>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
        <h3 class="contenido-card__title">NUESTRAS MEJORES OFERTAS<span class="contenido-card__subtitle"></span>
        </h3>
        <div class="pro-cards container" class="cards" id="cards">
            <?php foreach ($catDescuento as $catDes) : ?>
            <div class="best-card" data-id="<?= $catDes['id_prod'] ?>">
                <picture class="best-card__img">
                    <img class="best-card__image2" src="./build/img/productos/<?= $catDes['imagen_prod'] ?>"
                        alt="<?= $catDes['nombre_prod'] ?>">
                    <span class="best-card__best">
                        <?= $catDes['nombre_descuento'] * 100 ?>% </span>

                    <div class="best-card__img2">
                        <img class="best-card__image" src="./build/img/productos/<?= $catDes['imagen2_prod'] ?>"
                            alt="<?= $catDes['nombre_prod'] ?>">
                        <span class="best-card__view">Más Información</span>
                    </div>
                </picture>
                <div class="best-card-info">
                    <span class="best-card-info__title"><?= $catDes['nombre_prod'] ?></span>
                    <span class="best-card-info__price">Antes: S/.
                        <?= number_format($catDes['precio_prod']); ?></span>
                    <span class="best-card-info__desc">Ahora: S/.
                        <?= number_format($catDes['precio_prod'] - ($catDes['precio_prod'] * $catDes['nombre_descuento']), 2) ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php';
?>
<script src=" ./build/js/web/slider/slider.js"></script>