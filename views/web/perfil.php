<?php require_once __DIR__ . '/includes/header.php'; ?>
<section class="perfil">
    <div class="perfil-categorias">

    </div>
    <div class="perfil-info">
        <div class="perfil-info-user">
            <div class="perfil-info-user__wallpaper">
                <img class="" src=" ./build/img/usuarios/<?= $usuario['wallpaper_user'] ?>" alt="">
                <a class="perfil-info-user__cameraWall" href="#" id="btnWallpaper">
                    <svg width="15px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path
                            d="M194.6 32H317.4C338.1 32 356.4 45.22 362.9 64.82L373.3 96H448C483.3 96 512 124.7 512 160V416C512 451.3 483.3 480 448 480H64C28.65 480 0 451.3 0 416V160C0 124.7 28.65 96 64 96H138.7L149.1 64.82C155.6 45.22 173.9 32 194.6 32H194.6zM256 384C309 384 352 341 352 288C352 234.1 309 192 256 192C202.1 192 160 234.1 160 288C160 341 202.1 384 256 384z" />
                    </svg>
                    <span>Cambiar Fondo de Pantalla</span>
                </a>
            </div>

            <div class="perfil-info-user__profile">
                <div class="perfil-info-user__imgProfile">
                    <?php if (empty($usuario['imagen_user'])) : ?>
                    <span class="perfil-info-user__spanProfile"><?= $usuario['nombre_user'][0] ?></span>
                    <?php else : ?>
                    <img class="header-info-perfil__img" src="./build/img/usuarios/<?= $usuario['imagen_user'] ?>"
                        alt="">
                    <?php endif; ?>
                    <a class="perfil-info-user__camera" href="#" id="btnFoto">
                        <svg width="15px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path
                                d="M194.6 32H317.4C338.1 32 356.4 45.22 362.9 64.82L373.3 96H448C483.3 96 512 124.7 512 160V416C512 451.3 483.3 480 448 480H64C28.65 480 0 451.3 0 416V160C0 124.7 28.65 96 64 96H138.7L149.1 64.82C155.6 45.22 173.9 32 194.6 32H194.6zM256 384C309 384 352 341 352 288C352 234.1 309 192 256 192C202.1 192 160 234.1 160 288C160 341 202.1 384 256 384z" />
                        </svg>
                    </a>
                </div>
                <span class="perfil-info-user__title"><?= $usuario['nombre_user']; ?></span>
            </div>
            <div class="perfil-info-user__categorias" id="links">
                <a class="perfil-info-user__cat" href="#" data-link="datos">Datos Personales</a>
                <a class="perfil-info-user__cat" href="#" data-link="direccion">Dirección de Envio</a>
                <a class=" perfil-info-user__cat" href="#">Historial de pedidos</a>
                <a class="perfil-info-user__cat" href="#">Favoritos</a>
            </div>
        </div>
        <div class="perfil-info-info" id="formularios">

        </div>
    </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>

<script src="./build/js/web/perfil/perfil.js"></script>
<script src="./build/js/web/perfil/wallpaper.js"></script>
<script src="./build/js/web/perfil/foto.js"></script>