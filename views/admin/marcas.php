<?php require_once __DIR__ . '/includes/header.php'; ?>
<div class="cardBox2">
    <div class="admin-container">
        <div class="card">
            <div>
                <div class="numbers"><?= $total; ?></div>
                <div class="cardName">Marcas</div>
            </div>

            <div class="icon-adminBx">
                <span class="icon-admin">
                    <svg class="ico-admin2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path
                            d="M411.4 175.5C417.4 185.4 417.5 197.7 411.8 207.8C406.2 217.8 395.5 223.1 384 223.1H192C180.5 223.1 169.8 217.8 164.2 207.8C158.5 197.7 158.6 185.4 164.6 175.5L260.6 15.54C266.3 5.897 276.8 0 288 0C299.2 0 309.7 5.898 315.4 15.54L411.4 175.5zM288 312C288 289.9 305.9 272 328 272H472C494.1 272 512 289.9 512 312V456C512 478.1 494.1 496 472 496H328C305.9 496 288 478.1 288 456V312zM0 384C0 313.3 57.31 256 128 256C198.7 256 256 313.3 256 384C256 454.7 198.7 512 128 512C57.31 512 0 454.7 0 384z" />
                    </svg>
                </span>
            </div>
        </div>
        <div class="admin-form">
            <form class="admin-form__form" id="formProductos" action="" method="POST" enctype="multipart/form-data">
                <h4>Agregar Marcas</h4>
                <label for="nombre">Nombre:
                    <input type="text" placeholder="Nombre de la marca" name="nombre_marca">
                </label>
                <?= isset($errores['nombreVacio']) ? $errores['nombreVacio'] : '';  ?>
                <label class=" lbl__imagen" for="imagen">Imagen:
                    <input type="file" id="imagen" name="imagen_marca">
                </label>
                <?= isset($errores['imagenVacio']) ? $errores['imagenVacio'] : '';  ?>

                <button>Agregar</button>
            </form>

        </div>

    </div>
    <!-- ================ Order Details List ================= -->
    <div class="detalles">
        <div class="tablas">
            <h2 class="tablas__title">Lista de Marcas</h2>

            <table>
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Nombre</td>
                        <td>imagen</td>
                        <td>Opciones</td>
                    </tr>
                </thead>
                <tbody id="tbody">
                    <?php foreach ($marcaList as $marca) : ?>

                    <tr data-id="<?= $marca->id_marca; ?>">
                        <td><?= $marca->id_marca; ?></td>
                        <td><?= $marca->nombre_marca; ?></td>
                        <td><img src="../build/img/marcas/<?= $marca->imagen_marca; ?>" width="50"></td>
                        <td>
                            <span class="status delivered">Actualizar</span>
                            <span class="status return">Borrar</span>
                        </td>
                    </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="paginador">
                <ul>
                    <?php if ($pagina != 1) : ?>
                    <li class="paginador-list"><a href="/admin/marcas?pagina=<?= 1; ?>">
                            <svg width='10px' viewBox="0 0 448 512">
                                <path
                                    d="M77.25 256l137.4-137.4c12.5-12.5 12.5-32.75 0-45.25s-32.75-12.5-45.25 0l-160 160c-12.5 12.5-12.5 32.75 0 45.25l160 160C175.6 444.9 183.8 448 192 448s16.38-3.125 22.62-9.375c12.5-12.5 12.5-32.75 0-45.25L77.25 256zM269.3 256l137.4-137.4c12.5-12.5 12.5-32.75 0-45.25s-32.75-12.5-45.25 0l-160 160c-12.5 12.5-12.5 32.75 0 45.25l160 160C367.6 444.9 375.8 448 384 448s16.38-3.125 22.62-9.375c12.5-12.5 12.5-32.75 0-45.25L269.3 256z" />
                            </svg>
                        </a></li>
                    <li class="paginador-list"><a href="/admin/marcas?pagina=<?= $pagina - 1; ?>">
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
                    <li class="paginador-list"><a href="/admin/marcas?pagina=<?= $i; ?>"><?= $i ?></a>
                    </li>
                    <?php endif; ?>
                    <?php endfor; ?>
                    <?php if ($pagina != $totalPaginas && $totalPaginas > 1) : ?>
                    <li class="paginador-list"><a href="/admin/marcas?pagina=<?= $pagina + 1; ?>">
                            <svg width='10px' viewBox="0 0 448 512">
                                <path
                                    d="M246.6 233.4l-160-160c-12.5-12.5-32.75-12.5-45.25 0s-12.5 32.75 0 45.25L178.8 256l-137.4 137.4c-12.5 12.5-12.5 32.75 0 45.25C47.63 444.9 55.81 448 64 448s16.38-3.125 22.62-9.375l160-160C259.1 266.1 259.1 245.9">
                            </svg>
                        </a></li>
                    <li class="paginador-list"><a href="/admin/marcas?pagina=<?= $totalPaginas; ?>">
                            <svg width='10px' viewBox="0 0 448 512">
                                <path
                                    d="M246.6 233.4l-160-160c-12.5-12.5-32.75-12.5-45.25 0s-12.5 32.75 0 45.25L178.8 256l-137.4 137.4c-12.5 12.5-12.5 32.75 0 45.25C47.63 444.9 55.81 448 64 448s16.38-3.125 22.62-9.375l160-160C259.1 266.1 259.1 245.9 246.6 233.4zM438.6 233.4l-160-160c-12.5-12.5-32.75-12.5-45.25 0s-12.5 32.75 0 45.25L370.8 256l-137.4 137.4c-12.5 12.5-12.5 32.75 0 45.25C239.6 444.9 247.8 448 256 448s16.38-3.125 22.62-9.375l160-160C451.1 266.1 451.1 245.9 438.6 233.4z" />
                            </svg>
                        </a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <!-- fin tabla -->

    </div>
    <?php //debugear($marcas) 
    ?>
</div>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
<script src="../build/js/admin/api/marcas.js"></script>