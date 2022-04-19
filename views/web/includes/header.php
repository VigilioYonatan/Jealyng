<header class="header">
    <div class="container-header">
        <a href="/" class="header__logo">Jealyng</a>
        <div class="header-categorias">
            <a class="header-categorias__hmb" id="hamburguer" href="#">
                <svg class="header-categorias__ico" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path
                        d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z" />
                </svg>
                <svg class="header-categorias__ico hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                    <path
                        d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z" />
                </svg>
            </a>
            <span class="header-categorias__title">Menú de Categorias</span>

        </div>
        <div class="header-search">
            <input class="header-search__inp" type="text" id="buscador" placeholder="Buscar productos">
            <a class="header-search__ico" id="icoBuscador" ref="#">
                <svg width='20px' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path
                        d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z" />
                </svg>
            </a>
            <div class="header-search__buscador">
                <div href="/producto?nombre=" class="header-search__tipo" id="contendorBuscador">
                    <div class="header-search__type">
                        <b>ID</b>
                        <b>Nombre</b>
                        <b>Imagen</b>
                        <b>Precio</b>
                    </div>

                </div>
            </div>

        </div>
        <div class="header-info">
            <a href="/login" class="header-info__login" id="mode">
                <svg class="header-info__ico" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path
                        d="M32 256c0-123.8 100.3-224 223.8-224c11.36 0 29.7 1.668 40.9 3.746c9.616 1.777 11.75 14.63 3.279 19.44C245 86.5 211.2 144.6 211.2 207.8c0 109.7 99.71 193 208.3 172.3c9.561-1.805 16.28 9.324 10.11 16.95C387.9 448.6 324.8 480 255.8 480C132.1 480 32 379.6 32 256z" />
                </svg>
                <svg class="header-info__ico hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path
                        d="M256 159.1c-53.02 0-95.1 42.98-95.1 95.1S202.1 351.1 256 351.1s95.1-42.98 95.1-95.1S309 159.1 256 159.1zM509.3 347L446.1 255.1l63.15-91.01c6.332-9.125 1.104-21.74-9.826-23.72l-109-19.7l-19.7-109c-1.975-10.93-14.59-16.16-23.72-9.824L256 65.89L164.1 2.736c-9.125-6.332-21.74-1.107-23.72 9.824L121.6 121.6L12.56 141.3C1.633 143.2-3.596 155.9 2.736 164.1L65.89 256l-63.15 91.01c-6.332 9.125-1.105 21.74 9.824 23.72l109 19.7l19.7 109c1.975 10.93 14.59 16.16 23.72 9.824L256 446.1l91.01 63.15c9.127 6.334 21.75 1.107 23.72-9.822l19.7-109l109-19.7C510.4 368.8 515.6 356.1 509.3 347zM256 383.1c-70.69 0-127.1-57.31-127.1-127.1c0-70.69 57.31-127.1 127.1-127.1s127.1 57.3 127.1 127.1C383.1 326.7 326.7 383.1 256 383.1z" />
                </svg>
            </a>
            <?php
            if (isset($_SESSION['id'])) :
                $usuario = selectSqlBYid($_SESSION['id']);
            ?>
            <a class="header-info-perfil" href="#" id="perfil_imagen">
                <?php if (empty($usuario['imagen_user'])) : ?>
                <span><?= $usuario['nombre_user'][0] ?></span>
                <?php else : ?>
                <img class="header-info-perfil__img" src="./build/img/usuarios/<?= $usuario['imagen_user'] ?>"
                    alt="<?= $usuario['nombre_user'] ?>">
                <?php endif; ?>
            </a>
            <div class="header-info-user" id="perfilInfo">
                <!-- wallpaper  -->
                <img class="header-info-perfil__wallpaper" src="./build/img/usuarios/<?= $usuario['wallpaper_user'] ?>"
                    alt="">
                <!-- perfil foto  -->
                <?php if (empty($usuario['imagen_user'])) : ?>
                <span class="header-info-user__perfil"><?= $usuario['nombre_user'][0] ?></span>
                <?php else : ?>
                <img class=" header-info-perfil__img2" src="./build/img/usuarios/<?= $usuario['imagen_user'] ?>"
                    alt="<?= $usuario['nombre_user'] ?>">
                <?php endif; ?>
                <span class="header-info-user__title">Hola <b><?= $usuario['nombre_user'] ?></b></span>
                <div class="header-info-user__section">
                    <?php if (isset($_SESSION['admin'])) : ?>
                    <a class="header-info-user__link" href="/admin">Admin</a>
                    <?php endif; ?>
                    <a class="header-info-user__link" href="/perfil">Mi Perfil</a>
                    <a class="header-info-user__link" href="#">Mis Pedidos</a>
                    <a class="header-info-user__link header-info-user__link--logout" href="/salir">Salir</a>
                </div>
            </div>
            <?php else : ?>
            <a href="/login" class="header-info__login">
                <svg class="header-info__ico" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512">
                    <path
                        d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z" />
                </svg>
                <span class="header-info__title">Login</span>
            </a>
            <?php endif; ?>
            <a href="" id="btn-carrito" class="header-info__cart">
                <svg class="header-info__ico" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path
                        d="M352 160v-32C352 57.42 294.579 0 224 0 153.42 0 96 57.42 96 128v32H0v272c0 44.183 35.817 80 80 80h288c44.183 0 80-35.817 80-80V160h-96zm-192-32c0-35.29 28.71-64 64-64s64 28.71 64 64v32H160v-32zm160 120c-13.255 0-24-10.745-24-24s10.745-24 24-24 24 10.745 24 24-10.745 24-24 24zm-192 0c-13.255 0-24-10.745-24-24s10.745-24 24-24 24 10.745 24 24-10.745 24-24 24z" />

                </svg>
                <b id="carritoTotal"></b>
            </a>

        </div>


    </div>

</header>
<nav class="navbar">
    <div class="navbar-container">
        <?php foreach (categoria() as $cat) : ?>
        <ul class="navbar-categorias">
            <li class="navbar-categorias__list"><a href="/categoria?nombre=<?= $cat['nombre_categoria']; ?>"
                    class="navbar-categorias__title"><?= $cat['nombre_categoria']; ?></a>
            </li>
            <?php $subcategoria = subcategoria($cat['id_categoria']); ?>

            <?php foreach ($subcategoria as $sub) : ?>
            <li class="navbar-categorias__list"><a class="navbar-categorias__link"
                    href="/tienda?categoria=<?= $cat['nombre_categoria'] ?>&producto=<?= $sub['nombre_subcat'] ?>"><?= $sub['nombre_subcat'] ?></a>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php endforeach; ?>
    </div>
</nav>
<div class="cart-float" id="carrito">
    <span class="cart-float__title">
        <svg class="ico-form" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
            <path
                d="M352 160v-32C352 57.42 294.579 0 224 0 153.42 0 96 57.42 96 128v32H0v272c0 44.183 35.817 80 80 80h288c44.183 0 80-35.817 80-80V160h-96zm-192-32c0-35.29 28.71-64 64-64s64 28.71 64 64v32H160v-32zm160 120c-13.255 0-24-10.745-24-24s10.745-24 24-24 24 10.745 24 24-10.745 24-24 24zm-192 0c-13.255 0-24-10.745-24-24s10.745-24 24-24 24 10.745 24 24-10.745 24-24 24z">
            </path>
        </svg>
        Mi Carrito
        <h4></h4>
    </span>
    <div class="cart-cards">
        <!-- api  -->
    </div>
    <div class="cart-total">
        <span class="cart-total__total">Total: <b class="totalProducto"></b></span>
        <a class="mostrar-card__masinfo" href="/carrito">Más informacion</a>
        <a class="cart-total__link cart-total__link--pay" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                <path
                    d="M512 32C547.3 32 576 60.65 576 96V128H0V96C0 60.65 28.65 32 64 32H512zM576 416C576 451.3 547.3 480 512 480H64C28.65 480 0 451.3 0 416V224H576V416zM112 352C103.2 352 96 359.2 96 368C96 376.8 103.2 384 112 384H176C184.8 384 192 376.8 192 368C192 359.2 184.8 352 176 352H112zM240 384H368C376.8 384 384 376.8 384 368C384 359.2 376.8 352 368 352H240C231.2 352 224 359.2 224 368C224 376.8 231.2 384 240 384z" />
            </svg><b>Pagar</b></a>
        <button id="btnCloseCart">X Cerrar</button>
    </div>
</div>