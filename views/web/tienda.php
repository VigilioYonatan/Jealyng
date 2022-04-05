<?php require_once __DIR__ . '/includes/header.php';
?>

<!-- productps -->
<section class="products">
    <!-- categorias  -->
    <div class="category">
        <div class="filtros" id="filtros">
            <h3 class="filtros__title">Filter By</h3>
            <div class="filtro-section">
                <span class="filtro-section__title">Collection</span>
                <svg viewBox="0 0 16 16" class="ico-colleccion">
                    <path fill="currentColor"
                        d="M12.159 7.2h-8.319c-0.442 0-0.48 0.358-0.48 0.8s0.038 0.8 0.48 0.8h8.319c0.442 0 0.481-0.358 0.481-0.8s-0.038-0.8-0.481-0.8z">
                    </path>
                </svg>
                <div class="listados">
                    <span class="listados__category">All</span>
                    <span class="listados__category">Ropas</span>
                    <span class="listados__category">Zapatillas</span>
                    <span class="listados__category">Calzados</span>
                    <span class="listados__category">Ropas</span>
                    <span class="listados__category">Zapatillas</span>
                    <span class="listados__category">Calzados</span>
                </div>
            </div>
            <div class="filtro-section">
                <span class="filtro-section__title">Price</span>
                <div class="filter-category filter-category-range">
                    <input class="filter-category__range" type="range" min="0" max="100" value="20">
                    <div class="filter-category__value"></div>
                </div>
            </div>
            <div class="filtro-section">
                <span class="filtro-section__title">Collection</span>
                <svg viewBox="0 0 16 16" class="ico-colleccion">
                    <path fill="currentColor"
                        d="M12.159 7.2h-8.319c-0.442 0-0.48 0.358-0.48 0.8s0.038 0.8 0.48 0.8h8.319c0.442 0 0.481-0.358 0.481-0.8s-0.038-0.8-0.481-0.8z">
                    </path>
                </svg>
                <div class="listados">
                    <span class="listados__category">All</span>
                    <span class="listados__category">Ropas</span>
                    <span class="listados__category">Zapatillas</span>
                    <span class="listados__category">Calzados</span>
                    <span class="listados__category">Ropas</span>
                    <span class="listados__category">Zapatillas</span>
                    <span class="listados__category">Calzados</span>
                </div>
            </div>
        </div>
    </div>
    <!-- fin categorias  -->
    <!-- cards -->
    <div class="contenido-card">
        <h3 class="contenido-card__title"><?= $get ?></h3>
        <div class="pro-cards" class="cards" id="cards">

            <?php if (!empty($subCat)) :
                foreach ($subCat as $subCat => $key) : ?>
            <div class="best-card" data-id="<?= $key['id_prod'] ?>">
                <picture class="best-card__img">
                    <img class="best-card__image" src="./build/img/productos/<?= $key['imagen_prod'] ?>" alt="">
                    <?php if ($key['nombre_descuento'] > 0) : ?>
                    <span class="best-card__best">
                        %<?= $key['nombre_descuento'] * 100 ?> descuento</span>
                    <?php endif; ?>
                    <div class="best-card__img2">
                        <img class="best-card__image" src="./build/img/productos/<?= $key['imagen2_prod'] ?>" alt="">
                        <span class="best-card__view">Quick View</span>
                    </div>
                </picture>
                <div class="best-card-info">
                    <span class="best-card-info__title"><?= $key['nombre_prod'] ?></span>
                    <span class="best-card-info__price">Antes: S/. <?= $key['precio_prod'] ?></span>
                    <span class="best-card-info__desc">Ahora: S/.
                        <?= $key['precio_prod'] - ($key['precio_prod'] * $key['nombre_descuento']) ?></span>
                </div>
            </div>
            <?php endforeach; ?>
            <?php else : ?>
            <span>No hay productos por ahora :c</span>
            <?php endif; ?>
        </div>

    </div>

    </div>
    <!-- fin cards  -->
</section>
<!-- fin productos  -->
<?php require_once __DIR__ . '/includes/footer.php'; ?>
<script src="./build/js/web/slider/slider.js"></script>
<script src="./build/js/web/shop/price.js"></script>
<script src="./build/js/web/shop/card.js"></script>