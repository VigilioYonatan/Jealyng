<?php require_once __DIR__ . '/includes/header.php';
?>

<!-- productps -->
<section class="products">
    <!-- categorias  -->
    <div class="category">
        <div class="filtros" id="filtros">
            <span class="filtros__title"><?= !isset($get) ? $category : $get;  ?><b>(filtros)</b></span>
            <div class="filtro-section">
                <span class="filtro-section__title">Condición</span>
                <div class="listados">
                    <a class="listados__category" href="/tienda?categoria=<?= $category;  ?>">Todos</a>
                    <?php foreach (selectSql('estadoproducto') as $est) : ?>
                    <a href=" /tienda?categoria=<?= $category;  ?>&producto=<?= $get;  ?>&condicion=<?= $est['nombre_estadoPro'];  ?>"
                        class="listados__category"><?= $est['nombre_estadoPro']; ?></a>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="filtro-section">
                <span class="filtro-section__title">% Descuentos</span>
                <div class="listados">
                    <?php if (count(filtroDescuento($category, $get)) > 1) : ?>
                    <?php foreach (filtroDescuento($category, $get) as $descuento) : ?>
                    <a href="/tienda?categoria=<?= $category; ?>&producto=<?= $get; ?>&descuento=<?= $descuento['nombre_descuento'] ?>"
                        class="listados__category">
                        <?= $descuento['nombre_descuento'] > 0.0 ? "Desde " . $descuento['nombre_descuento'] * 100 . "%"  : '' ?></a>
                    <?php endforeach; ?>
                    <?php else : ?>
                    <span class="listados__category">No hay descuento</span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="filtro-section">
                <span class="filtro-section__title">Otras Sub-Categorias</span>
                <div class="listados">
                    <?php foreach (filtroSubcategorias($category) as $subcate) : ?>
                    <?php if ($subcate['nombre_subcat'] != $get) : ?>
                    <a href="/tienda?categoria=<?= $category ?>&producto=<?= $subcate['nombre_subcat'] ?>"
                        class="listados__category"><?= $subcate['nombre_subcat'] ?></a>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <button id="btnCerrarFiltro"
                class="filtro__cerrar header-info-user__link header-info-user__link--logout">Cerrar</button>
        </div>
    </div>
    <!-- fin categorias  -->
    <!-- cards -->
    <div class=" contenido-card">
        <h3 class="contenido-card__title2"><?= $category;  ?><?= !empty($get) ? "($get)" : ''; ?><span
                class="contenido-card__subtitle">(<?= $total; ?>
                resultados)</span></h3>
        <button class="contenido-card__btn" id="btnFiltro">Filtros</button>
        <div class="pro-cards" class="cards" id="cards">

            <?php if (!empty($subCat)) :
                foreach ($subCat as $subCat => $key) : ?>
            <div class="best-card" data-id="<?= $key['id_prod'] ?>">
                <picture class="best-card__img">
                    <img class="best-card__image2" src="./build/img/productos/<?= $key['imagen_prod'] ?>" alt="">
                    <?php if ($key['nombre_descuento'] > 0) : ?>
                    <span class="best-card__best">
                        - %<?= $key['nombre_descuento'] * 100 ?></span>
                    <?php endif; ?>
                    <div class="best-card__img2">
                        <img class="best-card__image" src="./build/img/productos/<?= $key['imagen2_prod'] ?>" alt="">
                        <span class="best-card__view">Más información</span>
                    </div>
                </picture>
                <div class="best-card-info">
                    <span class="best-card-info__title"><?= $key['nombre_prod'] ?></span>
                    <span class="best-card-info__price">Antes: S/.
                        <?= number_format($key['precio_prod'], 2) ?></span>
                    <span class="best-card-info__desc">Ahora: S/.
                        <?= number_format($key['precio_prod'] - ($key['precio_prod'] * $key['nombre_descuento']), 2) ?></span>
                </div>
                <?php
                        $show = false;
                        if (!empty($_SESSION['favorito'])) {
                            $favColumna = array_column($_SESSION['favorito'], 'idFavorito');
                            if (in_array($key['id_prod'], $favColumna)) {
                                $show = true;
                            } else {
                                $show = false;
                            }
                        } else {
                            $show = false;
                        }
                        ?>
                <p class="icoFavorito <?= $show ? 'show' : ''; ?>"><svg width="24px" height="24px" viewBox="0 0 24 24"
                        fill="none" xmlns=" http://www.w3.org/2000/svg">
                        <path class="icoFavoritoBTN" opacity="0.75"
                            d="M4.3314 12.0474L12 20L19.6686 12.0474C20.5211 11.1633 21 9.96429 21 8.71405C21 6.11055 18.9648 4 16.4543 4C15.2487 4 14.0925 4.49666 13.24 5.38071L12 6.66667L10.76 5.38071C9.90749 4.49666 8.75128 4 7.54569 4C5.03517 4 3 6.11055 3 8.71405C3 9.96429 3.47892 11.1633 4.3314 12.0474Z"
                            fill="<?= $show ? 'red' : 'white'; ?> " />
                        <path
                            d="M4.3314 12.0474L12 20L19.6686 12.0474C20.5211 11.1633 21 9.96429 21 8.71405C21 6.11055 18.9648 4 16.4543 4C15.2487 4 14.0925 4.49666 13.24 5.38071L12 6.66667L10.76 5.38071C9.90749 4.49666 8.75128 4 7.54569 4C5.03517 4 3 6.11055 3 8.71405C3 9.96429 3.47892 11.1633 4.3314 12.0474Z"
                            stroke="var(--color-fonts-primary)" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg></p>
            </div>
            <?php endforeach; ?>
            <?php else : ?>
            <span>No hay productos por ahora :c</span>
            <?php endif; ?>
        </div>
        <div class="paginador">
            <ul>
                <?php if ($pagina != 1) : ?>
                <li class="paginador-list"><a
                        href="/tienda?categoria=<?= $category; ?>&producto=<?= $get; ?><?php echo isset($_GET['condicion']) ? "&condicion=$_GET[condicion]" : null; ?><?php echo isset($_GET['descuento']) ? "&descuento=$_GET[descuento]" : null; ?>&pagina=<?= 1; ?>">
                        <svg width='10px' viewBox="0 0 448 512">
                            <path
                                d="M77.25 256l137.4-137.4c12.5-12.5 12.5-32.75 0-45.25s-32.75-12.5-45.25 0l-160 160c-12.5 12.5-12.5 32.75 0 45.25l160 160C175.6 444.9 183.8 448 192 448s16.38-3.125 22.62-9.375c12.5-12.5 12.5-32.75 0-45.25L77.25 256zM269.3 256l137.4-137.4c12.5-12.5 12.5-32.75 0-45.25s-32.75-12.5-45.25 0l-160 160c-12.5 12.5-12.5 32.75 0 45.25l160 160C367.6 444.9 375.8 448 384 448s16.38-3.125 22.62-9.375c12.5-12.5 12.5-32.75 0-45.25L269.3 256z" />
                        </svg>
                    </a></li>
                <li class="paginador-list"><a
                        href="/tienda?categoria=<?= $category; ?>&producto=<?= $get; ?><?php echo isset($_GET['condicion']) ? "&condicion=$_GET[condicion]" : null; ?><?php echo isset($_GET['condicion']) ? "&condicion=$_GET[condicion]" : null; ?><?php echo isset($_GET['descuento']) ? "&descuento=$_GET[descuento]" : null; ?>&pagina=<?= $pagina - 1; ?>">
                        <svg width='10px' viewBox="0 0 448 512">
                            <path
                                d="M77.25 256l137.4-137.4c12.5-12.5 12.5-32.75 0-45.25s-32.75-12.5-45.25 0l-160 160c-12.5 12.5-12.5 32.75 0 45.25l160 160C175.6 444.9 183.8 448 192 448s16.38-3.125 22.62-9.375c12.5-12.5 12.5-32.75 " />
                        </svg>
                    </a></li>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $pagina; $i++) : ?>
                <?php if ($i == $pagina) : ?>
                <li class="paginador-list selected"><?= $i ?></li>
                <?php else : ?>
                <li class="paginador-list"><a
                        href=" /tienda?categoria=<?= $category; ?>&producto=<?= $get; ?><?php echo isset($_GET['condicion']) ? "&condicion=$_GET[condicion]" : null; ?><?php echo isset($_GET['condicion']) ? "&condicion=$_GET[condicion]" : null; ?><?php echo isset($_GET['descuento']) ? "&descuento=$_GET[descuento]" : null; ?>&pagina=<?= $i; ?>"><?= $i ?></a>
                </li>
                <?php endif; ?>
                <?php endfor; ?>
                <?php if ($pagina != $totalPaginas && $totalPaginas > 1) : ?>
                <li class="paginador-list"><a
                        href="/tienda?categoria=<?= $category; ?>&producto=<?= $get; ?><?php echo isset($_GET['condicion']) ? "&condicion=$_GET[condicion]" : null; ?><?php echo isset($_GET['condicion']) ? "&condicion=$_GET[condicion]" : null; ?><?php echo isset($_GET['descuento']) ? "&descuento=$_GET[descuento]" : null; ?>&pagina=<?= $pagina + 1; ?>">
                        <svg width='10px' viewBox="0 0 448 512">
                            <path
                                d="M246.6 233.4l-160-160c-12.5-12.5-32.75-12.5-45.25 0s-12.5 32.75 0 45.25L178.8 256l-137.4 137.4c-12.5 12.5-12.5 32.75 0 45.25C47.63 444.9 55.81 448 64 448s16.38-3.125 22.62-9.375l160-160C259.1 266.1 259.1 245.9">
                        </svg>
                    </a></li>
                <li class="paginador-list"><a
                        href=" /tienda?categoria=<?= $category; ?>&producto=<?= $get; ?><?php echo isset($_GET['condicion']) ? "&condicion=$_GET[condicion]" : null; ?><?php echo isset($_GET['condicion']) ? "&condicion=$_GET[condicion]" : null; ?><?php echo isset($_GET['descuento']) ? "&descuento=$_GET[descuento]" : null; ?>&pagina=<?= $totalPaginas; ?>">
                        <svg width='10px' viewBox="0 0 448 512">
                            <path
                                d="M246.6 233.4l-160-160c-12.5-12.5-32.75-12.5-45.25 0s-12.5 32.75 0 45.25L178.8 256l-137.4 137.4c-12.5 12.5-12.5 32.75 0 45.25C47.63 444.9 55.81 448 64 448s16.38-3.125 22.62-9.375l160-160C259.1 266.1 259.1 245.9 246.6 233.4zM438.6 233.4l-160-160c-12.5-12.5-32.75-12.5-45.25 0s-12.5 32.75 0 45.25L370.8 256l-137.4 137.4c-12.5 12.5-12.5 32.75 0 45.25C239.6 444.9 247.8 448 256 448s16.38-3.125 22.62-9.375l160-160C451.1 266.1 451.1 245.9 438.6 233.4z" />
                        </svg>
                    </a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>

    </div>
    <!-- fin cards  -->
</section>
<!-- fin productos  -->
<?php require_once __DIR__ . '/includes/footer.php'; ?>
<script src=" ./build/js/web/slider/slider.js"></script>
<script src="./build/js/web/shop/price.js"></script>