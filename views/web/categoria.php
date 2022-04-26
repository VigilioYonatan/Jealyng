<?php require_once __DIR__ . '/includes/header.php';
?>
<section class="categorias">
    <a href="/tienda?categoria=<?= $categoria; ?>" class="categorias__wallpaper">
        <img src="./build/img/categorias/<?= $cats->wallpaper_categoria; ?>" alt="">
        <span><?= $categoria; ?></span>
        <div class="categorias__background"></div>
    </a>
    <!-- cards -->
    <div class="contenido-category">
        <h3 class="contenido-card__title2">TUS SUBCATEGORÍAS PREFERIDAS<span class="contenido-card__subtitle"></span>
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
        <h3 class="contenido-card__title2"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path
                    d="M496.3 202.5l-110-15.38l41.88-104.4c6.625-16.63-11.63-32.25-26.63-22.63L307.5 120l-34.13-107.1C270.6 4.25 263.4 0 255.1 0C248.6 0 241.4 4.25 238.6 12.88L204.5 120L110.5 60.12c-15-9.5-33.22 5.1-26.6 22.63l41.85 104.4L15.71 202.5C-1.789 205-5.915 228.8 9.71 237.2l98.14 52.63l-74.51 83.5c-10.88 12.25-1.78 31 13.35 31c1.25 0 2.657-.25 4.032-.5l108.6-23.63l-4.126 112.5C154.7 504.4 164.1 512 173.6 512c5.125 0 10.38-2.25 14.25-7.25l68.13-88.88l68.23 88.88C327.1 509.8 333.2 512 338.4 512c9.5 0 18.88-7.625 18.38-19.25l-4.032-112.5l108.5 23.63c17.38 3.75 29.25-17.25 17.38-30.5l-74.51-83.5l98.14-52.72C517.9 228.8 513.8 205 496.3 202.5zM338.5 311.6L286.6 300.4l2 53.75l-32.63-42.5l-32.63 42.5l2-53.75L173.5 311.6l35.63-39.87L162.1 246.6L214.7 239.2L194.7 189.4l45 28.63L255.1 166.8l16.25 51.25l45-28.63L297.2 239.2l52.63 7.375l-47 25.13L338.5 311.6z" />
            </svg>
            NUESTRAS MEJORES OFERTAS<span class="contenido-card__subtitle"></span>
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