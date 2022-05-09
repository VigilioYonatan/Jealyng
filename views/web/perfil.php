<?php require_once __DIR__ . '/includes/header.php'; ?>
<section class="perfil">
    <div class="perfil-info">
        <div class="perfil-info-user">
            <div class="perfil-info-user__wallpaper">
                <img id="imgWallpaper" class="" src=" ./build/img/usuarios/<?= $perfil->wallpaper_user ?>" alt="">
                <?php if (isset($_SESSION['login']) && $perfil->id_user === $_SESSION['id']) : ?>
                <a class="perfil-info-user__cameraWall" href="#" id="btnWallpaper">
                    <svg width="15px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path
                            d="M194.6 32H317.4C338.1 32 356.4 45.22 362.9 64.82L373.3 96H448C483.3 96 512 124.7 512 160V416C512 451.3 483.3 480 448 480H64C28.65 480 0 451.3 0 416V160C0 124.7 28.65 96 64 96H138.7L149.1 64.82C155.6 45.22 173.9 32 194.6 32H194.6zM256 384C309 384 352 341 352 288C352 234.1 309 192 256 192C202.1 192 160 234.1 160 288C160 341 202.1 384 256 384z" />
                    </svg>
                    <span>Cambiar Fondo de Pantalla</span>
                </a>
                <?php endif; ?>
            </div>

            <div class="perfil-info-user__profile">
                <div class="perfil-info-user__imgProfile">
                    <?php if (empty($perfil->imagen_user)) : ?>
                    <span class="perfil-info-user__spanProfile"><?= $perfil->nick_user[0] ?></span>
                    <?php else : ?>
                    <img id="imgPerfil" class="header-info-perfil__img"
                        src="./build/img/usuarios/<?= $perfil->imagen_user ?>" alt="">
                    <?php endif; ?>
                    <?php if (isset($_SESSION['login']) && $perfil->id_user === $_SESSION['id']) : ?>
                    <a class="perfil-info-user__camera" href="#" id="btnFoto">
                        <svg width="15px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path
                                d="M194.6 32H317.4C338.1 32 356.4 45.22 362.9 64.82L373.3 96H448C483.3 96 512 124.7 512 160V416C512 451.3 483.3 480 448 480H64C28.65 480 0 451.3 0 416V160C0 124.7 28.65 96 64 96H138.7L149.1 64.82C155.6 45.22 173.9 32 194.6 32H194.6zM256 384C309 384 352 341 352 288C352 234.1 309 192 256 192C202.1 192 160 234.1 160 288C160 341 202.1 384 256 384z" />
                        </svg>
                    </a>
                    <?php endif; ?>
                </div>
                <span class="perfil-info-user__title"><?= $perfil->nick_user; ?></span>
            </div>
            <div class="perfil-info-user__categorias" id="links">
                <a class="perfil-info-user__cat" href="#" data-link="datos">Datos Personales</a>
                <?php if (isset($_SESSION['login']) && $perfil->id_user === $_SESSION['id']) : ?>
                <a class="perfil-info-user__cat" href="#" data-link="direccion">Dirección de Envio</a>
                <a class=" perfil-info-user__cat" href="#" data-link="historial">Historial de pedidos</a>
                <a class="perfil-info-user__cat" href="#" data-link="favoritos">Favoritos</a>
                <?php endif; ?>
            </div>
        </div>
        <div class="perfil-info-info" id="formularios">
            <!-- datos personales  -->
            <form class="form" id="formDatos" method="POST" data-form="datos">
                <h4 class="form__title">Datos Personales</h4>
                <div class="form-prop">
                    <label class="form-prop__lbl" for="nombre">Nombre:</label>
                    <div class="form-prop-inp <?= $perfil->id_user !== $_SESSION['id'] ? 'form-prop-disabled' : ''; ?>">
                        <svg class="ico-form" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">

                            <path
                                d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z" />
                        </svg>
                        <input class="form-prop-inp__input" type="text" placeholder="Nombre de usuario..." id="nombre"
                            value="<?= $perfil->nombre_user ?>">
                    </div>
                </div>
                <div class="form-prop">
                    <label class="form-prop__lbl" for="apellidoPaterno">Apellido Paterno:</label>
                    <div class="form-prop-inp <?= $perfil->id_user !== $_SESSION['id'] ? 'form-prop-disabled' : ''; ?>">
                        <svg class="ico-form" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                            <path
                                d="M224 64C224 99.35 195.3 128 160 128C124.7 128 96 99.35 96 64C96 28.65 124.7 0 160 0C195.3 0 224 28.65 224 64zM144 384V480C144 497.7 129.7 512 112 512C94.33 512 80.01 497.7 80.01 480V287.8L59.09 321C49.67 336 29.92 340.5 14.96 331.1C.0016 321.7-4.491 301.9 4.924 286.1L44.79 223.6C69.72 184 113.2 160 160 160C206.8 160 250.3 184 275.2 223.6L315.1 286.1C324.5 301.9 320 321.7 305.1 331.1C290.1 340.5 270.3 336 260.9 321L240 287.8V480C240 497.7 225.7 512 208 512C190.3 512 176 497.7 176 480V384L144 384z" />
                        </svg>
                        <input class="form-prop-inp__input" type="text" placeholder="Apellido Paterno..."
                            id="apellidoPaterno" value="<?= $perfil->apellidoPaterno_user ?>">
                    </div>
                </div>
                <div class="form-prop">
                    <label class="form-prop__lbl" for="apellidoMaterno">Apellido Materno:</label>
                    <div class="form-prop-inp <?= $perfil->id_user !== $_SESSION['id'] ? 'form-prop-disabled' : ''; ?>">
                        <svg class="ico-form" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                            <path
                                d="M223.1 64C223.1 99.35 195.3 128 159.1 128C124.7 128 95.1 99.35 95.1 64C95.1 28.65 124.7 0 159.1 0C195.3 0 223.1 28.65 223.1 64zM70.2 400C59.28 400 51.57 389.3 55.02 378.9L86.16 285.5L57.5 323.3C46.82 337.4 26.75 340.2 12.67 329.5C-1.415 318.8-4.175 298.7 6.503 284.7L65.4 206.1C87.84 177.4 122.9 160 160 160C197.2 160 232.2 177.4 254.6 206.1L313.5 284.7C324.2 298.7 321.4 318.8 307.3 329.5C293.3 340.2 273.2 337.4 262.5 323.3L233.9 285.6L264.1 378.9C268.4 389.3 260.7 400 249.8 400H232V480C232 497.7 217.7 512 200 512C182.3 512 168 497.7 168 480V400H152V480C152 497.7 137.7 512 120 512C102.3 512 88 497.7 88 480V400H70.2z" />
                        </svg>
                        <input class="form-prop-inp__input" type="text" placeholder="Apellido Materno..."
                            id="apellidoMaterno" value="<?= $perfil->apellidoMaterno_user ?>">
                    </div>
                </div>
                <div class="form-prop">
                    <label class="form-prop__lbl" for="telefono">Telefono:</label>
                    <div class="form-prop-inp <?= $perfil->id_user !== $_SESSION['id'] ? 'form-prop-disabled' : ''; ?>">
                        <svg class="ico-form" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path
                                d="M511.2 387l-23.25 100.8c-3.266 14.25-15.79 24.22-30.46 24.22C205.2 512 0 306.8 0 54.5c0-14.66 9.969-27.2 24.22-30.45l100.8-23.25C139.7-2.602 154.7 5.018 160.8 18.92l46.52 108.5c5.438 12.78 1.77 27.67-8.98 36.45L144.5 207.1c33.98 69.22 90.26 125.5 159.5 159.5l44.08-53.8c8.688-10.78 23.69-14.51 36.47-8.975l108.5 46.51C506.1 357.2 514.6 372.4 511.2 387z" />
                        </svg>
                        <input class="form-prop-inp__input" type="tel" placeholder="Telefono..." id="telefono"
                            value="<?= $perfil->telefono_user ?>">
                    </div>
                </div>
                <div class="form-prop">
                    <label class="form-prop__lbl" for="nacimiento">Fecha de Nacimiento:</label>
                    <div class="form-prop-inp <?= $perfil->id_user !== $_SESSION['id'] ? 'form-prop-disabled' : ''; ?>">
                        <svg class="ico-form" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path
                                d="M255.1 192H.1398C2.741 117.9 41.34 52.95 98.98 14.1C112.2 5.175 129.8 9.784 138.9 22.92L255.1 192zM384 160C384 124.7 412.7 96 448 96H480C497.7 96 512 110.3 512 128C512 145.7 497.7 160 480 160H448V224C448 249.2 442.2 274.2 430.9 297.5C419.7 320.8 403.2 341.9 382.4 359.8C361.6 377.6 336.9 391.7 309.7 401.4C282.5 411 253.4 416 223.1 416C194.6 416 165.5 411 138.3 401.4C111.1 391.7 86.41 377.6 65.61 359.8C44.81 341.9 28.31 320.8 17.05 297.5C5.794 274.2 0 249.2 0 224H384L384 160zM31.1 464C31.1 437.5 53.49 416 79.1 416C106.5 416 127.1 437.5 127.1 464C127.1 490.5 106.5 512 79.1 512C53.49 512 31.1 490.5 31.1 464zM416 464C416 490.5 394.5 512 368 512C341.5 512 320 490.5 320 464C320 437.5 341.5 416 368 416C394.5 416 416 437.5 416 464z" />
                        </svg>
                        <input class="form-prop-inp__input" type="date" id="nacimiento"
                            value="<?= $perfil->nacimiento_user ?>">
                    </div>
                    <?php if (isset($_SESSION['login']) && $perfil->id_user === $_SESSION['id']) : ?>
                    <button class="form__btn">
                        <svg class="ico-form2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path
                                d="M362.7 19.32C387.7-5.678 428.3-5.678 453.3 19.32L492.7 58.75C517.7 83.74 517.7 124.3 492.7 149.3L444.3 197.7L314.3 67.72L362.7 19.32zM421.7 220.3L188.5 453.4C178.1 463.8 165.2 471.5 151.1 475.6L30.77 511C22.35 513.5 13.24 511.2 7.03 504.1C.8198 498.8-1.502 489.7 .976 481.2L36.37 360.9C40.53 346.8 48.16 333.9 58.57 323.5L291.7 90.34L421.7 220.3z" />
                        </svg>Actualizar</button>
                    <?php endif; ?>
                </div>
            </form>
            <!-- fin datos personales -->
            <!-- origen envio  -->
            <form class="form hidden" method="POST" id="formEnvio" data-form="datos">
                <h4 class="form__title">Origen de Envío</h4>
                <div class="form-prop">
                    <label class="form-prop__lbl" for="departamento">Departamento:</label>
                    <div class="form-prop-inpSelect ">
                        <select id='departamento' name="departamento" class="form-prop-inp__select">
                            <?php foreach (selectSql('departamentos') as $dep) : ?>
                            <option value="<?= $dep['idDepartamento'] ?>"
                                <?= $dep['idDepartamento'] === $perfil->id_departamento ? "selected" : ''; ?>>
                                <?= $dep['departamento'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class=" form-prop">
                    <label class="form-prop__lbl" for="provincia">Provincia:</label>
                    <div class="form-prop-inpSelect ">
                        <select id='provincia' name="provincia" class="form-prop-inp__select">
                            <?php foreach (selectSql('provincia') as $dep) : ?>
                            <option value="<?= $dep['idProvincia'] ?>"
                                <?= $dep['idProvincia'] === $perfil->id_provincia ? "selected" : ''; ?>>
                                <?= $dep['provincia'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-prop">
                    <label class="form-prop__lbl" for="distrito">Distrito:</label>
                    <div class="form-prop-inpSelect ">
                        <select id='distrito' name="distrito" class="form-prop-inp__select">
                            <?php foreach (selectSql('distrito') as $dep) : ?>
                            <option value="<?= $dep['idDistrito'] ?>"
                                <?= $dep['idDistrito'] === $perfil->id_distrito ? "selected" : ''; ?>>
                                <?= $dep['distrito'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-prop">
                    <label class="form-prop__lbl" for="direccion">Direccion:</label>
                    <div class="form-prop-inp">
                        <svg class="ico-form" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                            <path
                                d="M168.3 499.2C116.1 435 0 279.4 0 192C0 85.96 85.96 0 192 0C298 0 384 85.96 384 192C384 279.4 267 435 215.7 499.2C203.4 514.5 180.6 514.5 168.3 499.2H168.3zM192 256C227.3 256 256 227.3 256 192C256 156.7 227.3 128 192 128C156.7 128 128 156.7 128 192C128 227.3 156.7 256 192 256z" />
                        </svg>
                        <input class="form-prop-inp__input" type="text" placeholder="Direccion..." name="direccion"
                            id="direccion" value="<?= $perfil->direccion_user ?>">
                    </div>
                </div>
                <button class="form__btn">
                    <svg class="ico-form2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path
                            d="M362.7 19.32C387.7-5.678 428.3-5.678 453.3 19.32L492.7 58.75C517.7 83.74 517.7 124.3 492.7 149.3L444.3 197.7L314.3 67.72L362.7 19.32zM421.7 220.3L188.5 453.4C178.1 463.8 165.2 471.5 151.1 475.6L30.77 511C22.35 513.5 13.24 511.2 7.03 504.1C.8198 498.8-1.502 489.7 .976 481.2L36.37 360.9C40.53 346.8 48.16 333.9 58.57 323.5L291.7 90.34L421.7 220.3z" />
                    </svg>Actualizar</button>
            </form>
            <!-- fin origen envio  -->

            <div class="form hidden">
                <h1>Historial de compras</h1>
                <?php if (count($historial) < 1) : ?>
                <p>No hay compras realizadas</p>
                <?php else : ?>
                <?php foreach ($historial as $his) : ?>
                <div class="tablaCarrito__products">
                    <img src="./build/img/productos/<?= $his['imagen_prod'] ?>" alt="">
                    <b><?= $his['nombre_prod'] ?></b>
                    <div class="tablaCarrito__qty">
                        <p class="cart-info__spn">cantidad </p>
                        <div class="tablaCarrito__cantidad">
                            <b class="cart-info__spn">
                                <?= $his['cantidad'] ?></b>
                        </div>
                    </div>
                    <div class="tablaCarrito__qty">
                        <p class="cart-info__spn">Precio </p>
                        <p>S/ <?= $his['costoTotalCarrito'] ?></p>
                    </div>
                    <div class="tablaCarrito__qty">
                        <b class="cart-info__spn">Fecha Pedido: </b>
                        <p><?= $his['fecha_pedido'] ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <!-- favoritos -->
            <div class="form hidden" id="favoritosPe">
                <h1>Productos Favoritos</h1>

            </div>
        </div>
    </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>

<script src=" ./build/js/web/perfil/perfil.js"></script>
<script src="./build/js/web/perfil/wallpaper.js"></script>
<script src="./build/js/web/perfil/foto.js"></script>