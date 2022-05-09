<?php require_once __DIR__ . '/includes/header.php';
?>
<!-- wallpaper  -->
<section class="wallpaper">
    <div class="wallpaper-info">
        <div class="wallpaper-info__info">
            <span>Bienvenido a</span>
            <h2 class="wallpaper-info__title"> Jealyng</h2>
            <a href="#cards">Comprar</a>
        </div>

    </div>
    <!-- carousel -->
    <div class="wallpaper-carousel">
        <button aria-label="Anterior" class="wallpaper-next">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                <path
                    d="M224 480c-8.188 0-16.38-3.125-22.62-9.375l-192-192c-12.5-12.5-12.5-32.75 0-45.25l192-192c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25L77.25 256l169.4 169.4c12.5 12.5 12.5 32.75 0 45.25C240.4 476.9 232.2 480 224 480z" />
            </svg>
        </button>
        <button aria-label="Siguiente" class="wallpaper-previous">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">

                <path
                    d="M96 480c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L242.8 256L73.38 86.63c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l192 192c12.5 12.5 12.5 32.75 0 45.25l-192 192C112.4 476.9 104.2 480 96 480z" />
            </svg>
        </button>

        <div id="glider" class="wallpaper-list">
            <div class="wallpaper__elem">
                <img class="wallpaper__img" src="./build/img/offer1.jpg" alt="">
            </div>
            <div class="wallpaper__elem">
                <img class="wallpaper__img" src="./build/img/offer2.jpg" alt="_img2">
            </div>
            <div class="wallpaper__elem">
                <img class="wallpaper__img" src="./build/img/offer3.jpg" alt=" wallpaper__img3">
            </div>
            <div class="wallpaper__elem">
                <img class="wallpaper__img" src="./build/img/offer4.jpg" alt=" wallpaper__img3">
            </div>
        </div>
    </div>
    <!-- fin carousel  -->
</section>
<!-- fin wallpaper  -->
<!-- best cards  -->

<section class="best">
    <h3 class="contenido-card__title" id="btnOffer">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            <path
                d="M496.3 202.5l-110-15.38l41.88-104.4c6.625-16.63-11.63-32.25-26.63-22.63L307.5 120l-34.13-107.1C270.6 4.25 263.4 0 255.1 0C248.6 0 241.4 4.25 238.6 12.88L204.5 120L110.5 60.12c-15-9.5-33.22 5.1-26.6 22.63l41.85 104.4L15.71 202.5C-1.789 205-5.915 228.8 9.71 237.2l98.14 52.63l-74.51 83.5c-10.88 12.25-1.78 31 13.35 31c1.25 0 2.657-.25 4.032-.5l108.6-23.63l-4.126 112.5C154.7 504.4 164.1 512 173.6 512c5.125 0 10.38-2.25 14.25-7.25l68.13-88.88l68.23 88.88C327.1 509.8 333.2 512 338.4 512c9.5 0 18.88-7.625 18.38-19.25l-4.032-112.5l108.5 23.63c17.38 3.75 29.25-17.25 17.38-30.5l-74.51-83.5l98.14-52.72C517.9 228.8 513.8 205 496.3 202.5zM338.5 311.6L286.6 300.4l2 53.75l-32.63-42.5l-32.63 42.5l2-53.75L173.5 311.6l35.63-39.87L162.1 246.6L214.7 239.2L194.7 189.4l45 28.63L255.1 166.8l16.25 51.25l45-28.63L297.2 239.2l52.63 7.375l-47 25.13L338.5 311.6z" />
        </svg>
        <b>NUESTRAS MEJORES OFERTAS</b>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            <path
                d="M496.3 202.5l-110-15.38l41.88-104.4c6.625-16.63-11.63-32.25-26.63-22.63L307.5 120l-34.13-107.1C270.6 4.25 263.4 0 255.1 0C248.6 0 241.4 4.25 238.6 12.88L204.5 120L110.5 60.12c-15-9.5-33.22 5.1-26.6 22.63l41.85 104.4L15.71 202.5C-1.789 205-5.915 228.8 9.71 237.2l98.14 52.63l-74.51 83.5c-10.88 12.25-1.78 31 13.35 31c1.25 0 2.657-.25 4.032-.5l108.6-23.63l-4.126 112.5C154.7 504.4 164.1 512 173.6 512c5.125 0 10.38-2.25 14.25-7.25l68.13-88.88l68.23 88.88C327.1 509.8 333.2 512 338.4 512c9.5 0 18.88-7.625 18.38-19.25l-4.032-112.5l108.5 23.63c17.38 3.75 29.25-17.25 17.38-30.5l-74.51-83.5l98.14-52.72C517.9 228.8 513.8 205 496.3 202.5zM338.5 311.6L286.6 300.4l2 53.75l-32.63-42.5l-32.63 42.5l2-53.75L173.5 311.6l35.63-39.87L162.1 246.6L214.7 239.2L194.7 189.4l45 28.63L255.1 166.8l16.25 51.25l45-28.63L297.2 239.2l52.63 7.375l-47 25.13L338.5 311.6z" />
        </svg>
    </h3>
    <div class="best-cards" id="cards">
        <?php foreach ($ofertas as $ofer) : ?>
        <div class="best-card" data-id="<?= $ofer['id_prod'] ?>">
            <picture class="best-card__img">
                <img class="best-card__image2" src="./build/img/productos/<?= $ofer['imagen_prod'] ?>"
                    alt="<?= $ofer['nombre_prod'] ?>">
                <?php if ($ofer['nombre_descuento'] > 0) : ?>
                <span class="best-card__best">
                    - %<?= $ofer['nombre_descuento'] * 100 ?></span>
                <?php endif; ?>
                <div class="best-card__img2">
                    <img class="best-card__image" src="./build/img/productos/<?= $ofer['imagen2_prod'] ?>"
                        alt="<?= $ofer['nombre_prod'] ?>">
                    <span class="best-card__view">Más información</span>
                </div>
            </picture>
            <div class="best-card-info">
                <span class="best-card-info__title"><?= $ofer['nombre_prod'] ?></span>
                <span class="best-card-info__price">Antes: S/. <?= number_format($ofer['precio_prod'], 2) ?></span>
                <span class="best-card-info__desc">Ahora: S/.
                    <?= number_format($ofer['precio_prod'] - ($ofer['precio_prod'] * $ofer['nombre_descuento']), 2) ?></span>
            </div>

            <p class="icoFavorito"><svg width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                    xmlns=" http://www.w3.org/2000/svg">
                    <path class="icoFavoritoBTN" opacity="0.75"
                        d="M4.3314 12.0474L12 20L19.6686 12.0474C20.5211 11.1633 21 9.96429 21 8.71405C21 6.11055 18.9648 4 16.4543 4C15.2487 4 14.0925 4.49666 13.24 5.38071L12 6.66667L10.76 5.38071C9.90749 4.49666 8.75128 4 7.54569 4C5.03517 4 3 6.11055 3 8.71405C3 9.96429 3.47892 11.1633 4.3314 12.0474Z"
                        fill="
                      <?php
                        if (!empty($_SESSION['favorito'])) {
                            $favColumna = array_column($_SESSION['favorito'], 'idFavorito');
                            if (in_array($ofer['id_prod'], $favColumna)) {
                                echo "red";
                            } else {
                                echo "white";
                            }
                        } else {
                            echo "white";
                        }  ?>  
                        
                        " />
                    <path
                        d="M4.3314 12.0474L12 20L19.6686 12.0474C20.5211 11.1633 21 9.96429 21 8.71405C21 6.11055 18.9648 4 16.4543 4C15.2487 4 14.0925 4.49666 13.24 5.38071L12 6.66667L10.76 5.38071C9.90749 4.49666 8.75128 4 7.54569 4C5.03517 4 3 6.11055 3 8.71405C3 9.96429 3.47892 11.1633 4.3314 12.0474Z"
                        stroke="var(--color-fonts-primary)" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg></p>
        </div>
        <?php endforeach; ?>
    </div>
</section>
<!-- fin best cards  -->

<section class="categorias2">
    <h3 class="categorias2__title">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
            <path
                d="M0 155.2C0 147.9 2.153 140.8 6.188 134.7L81.75 21.37C90.65 8.021 105.6 0 121.7 0H518.3C534.4 0 549.3 8.021 558.2 21.37L633.8 134.7C637.8 140.8 640 147.9 640 155.2C640 175.5 623.5 192 603.2 192H36.84C16.5 192 .0003 175.5 .0003 155.2H0zM64 224H128V384H320V224H384V464C384 490.5 362.5 512 336 512H112C85.49 512 64 490.5 64 464V224zM512 224H576V480C576 497.7 561.7 512 544 512C526.3 512 512 497.7 512 480V224z" />
        </svg>
        <b>categorias</b>
    </h3>
    <!-- carousel -->
    <div class="categorias2-carousel ">


        <div id="glider" class="categorias2-list">
            <?php foreach ($categorias as $cat) : ?>
            <a href="/categoria?nombre=<?= $cat->nombre_categoria; ?>" class="categorias2__elem">
                <div class="categorias2__img">
                    <img src="./build/img/categorias/<?= $cat->imagen_categoria; ?>"
                        alt=" <?= $cat->nombre_categoria; ?>">
                </div>
                <span><?= $cat->nombre_categoria ?></span>
            </a>
            <?php endforeach; ?>

        </div>
        <button aria-label="Anterior" class="categorias2-previous">
            <svg class="categorias2-previous" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512">
                <path
                    d="M64 448c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L178.8 256L41.38 118.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25l-160 160C80.38 444.9 72.19 448 64 448z" />
            </svg>
        </button>
        <button aria-label="Siguiente" class="categorias2-next">
            <svg class="categorias2next" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512">
                <path
                    d="M192 448c-8.188 0-16.38-3.125-22.62-9.375l-160-160c-12.5-12.5-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25L77.25 256l137.4 137.4c12.5 12.5 12.5 32.75 0 45.25C208.4 444.9 200.2 448 192 448z" />
            </svg>
        </button>
    </div>
    <!-- fin carousel  -->
</section>
<!-- marcas -->
<section class="brands ">
    <div class="contenido-title">
        <h4 class="brands__title">LAS MEJORES MARCAS</h4>
    </div>

    <!-- carousel -->
    <div class="brand-carousel ">
        <button aria-label="Anterior" class="brand-previous">
            <svg class="brand-previous" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512">
                <path
                    d="M64 448c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L178.8 256L41.38 118.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25l-160 160C80.38 444.9 72.19 448 64 448z" />
            </svg>
        </button>
        <button aria-label="Siguiente" class="brand-next">
            <svg class="brand-next" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512">
                <path
                    d="M192 448c-8.188 0-16.38-3.125-22.62-9.375l-160-160c-12.5-12.5-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25L77.25 256l137.4 137.4c12.5 12.5 12.5 32.75 0 45.25C208.4 444.9 200.2 448 192 448z" />
            </svg>
        </button>

        <div id="glider" class="brand-list">
            <?php foreach ($marcas as $marca) : ?>
            <div class="brand__elem">
                <div class="brand__img">
                    <img src="./build/img/marcas/<?= $marca->imagen_marca; ?>" alt="<?= $marca->nombre_marca ?>">
                </div>
                <span><?= $marca->nombre_marca ?></span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <!-- fin carousel  -->
</section>
<!-- fin marcas  -->
<!-- about  -->
<section class="about">
    <div class="about-info border-right">
        <div class="about-info__card">
            <h3 class="about-info__title">Jealyng</h3>
            <p class="about-info__txt">
                Jealyng es una tienda especializada en productos de primera y segunda mano.
                Ofrecemos todo tipo de productos que buscas a buenos precios. Somos una tienda con muchos años en el
                mercado ...
            </p>
            <a class="btn about-info__btn" href="#">Mas información</a>
        </div>
        <img class="about-info__img" src="./build/img/Soft Couch.webp" alt="Shop Furniture">
    </div>
    <div class="about-info">
        <img class="about-info__img" src="./build/img/Woman Interior.webp" alt="Shop Furniture">
        <div class="about-info__card">
            <h3 class="about-info__title">Nuestra Historia</h3>
            <p class="about-info__txt">Empezamos como una tienda pequeña con pocos productos, al pasar el tiempo Jealyng
                creció demasiado ...
            </p>
            <a class="btn about-info__btn" href="#">Leer Historia</a>
        </div>
    </div>
</section>
<!-- fin about  -->
<?php require_once __DIR__ . '/includes/footer.php'; ?>
<script src="./build/js/web/slider/slider.js"></script>
<script src="./build/js/web/slider/app.js"></script>