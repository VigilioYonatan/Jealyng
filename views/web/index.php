<?php require_once __DIR__ . '/includes/header.php';
?>
<!-- wallpaper  -->
<section class="wallpaper container">
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
                <img class="wallpaper__img" src="./build/img/offer1.jpg" alt="wallpaper__img">
            </div>
            <!-- <div class="wallpaper__elem">
                <img class="wallpaper__img" src="./build/img/img3.webp" alt="wallpaper__img2">
            </div>
            <div class="wallpaper__elem">
                <img class="wallpaper__img" src="./build/img/img4.jpg" alt="wallpaper__img3">
            </div> -->
        </div>
    </div>
    <!-- fin carousel  -->
</section>
<!-- fin wallpaper  -->
<!-- best cards  -->

<section class="best">
    <h3 class="contenido-card__title" id="btnOffer">NUESTRAS MEJORES OFERTAS</h3>
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
        </div>
        <?php endforeach; ?>
    </div>
</section>
<!-- fin best cards  -->
<!-- about  -->
<section class="about">
    <div class="about-info border-right">
        <div class="about-info__card">
            <h3 class="about-info__title">Cozy Sophistication</h3>
            <p class="about-info__txt">I'm a paragraph. Click here to add your own text and edit me. Let your users
                get
                to know you.
            </p>
            <a class="btn about-info__btn" href="#">Shop Furniture</a>
        </div>
        <img class="about-info__img" src="./build/img/Soft Couch.webp" alt="Shop Furniture">
    </div>
    <div class="about-info">
        <img class="about-info__img" src="./build/img/Woman Interior.webp" alt="Shop Furniture">
        <div class="about-info__card">
            <h3 class="about-info__title">Cozy Sophistication</h3>
            <p class="about-info__txt">I'm a paragraph. Click here to add your own text and edit me. Let your users
                get to know you.</p>
            <a class="btn about-info__btn" href="#">Read Story</a>
        </div>
    </div>
</section>
<!-- fin about  -->
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
<?php require_once __DIR__ . '/includes/footer.php'; ?>
<script src="./build/js/web/shop/price.js"></script>
<script src="./build/js/web/slider/slider.js"></script>
<script src="./build/js/web/slider/app.js"></script>