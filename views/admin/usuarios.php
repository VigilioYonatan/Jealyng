<?php require_once __DIR__ . '/includes/header.php'; ?>
<div class="cardBox2">
    <!-- ================ Order Details List ================= -->
    <div class="detalles">
        <div class="tablas">
            <h2 class="tablas__title">Lista de Usuarios</h2>
            <div class="tablas-search">
                <input class="tablas-search__inp" type="text" placeholder="Buscar..." id="buscador">
                <a href="">
                    <svg style="width: 20px; fill:var(--color-terciary);" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 512 512">
                        <path
                            d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z">
                        </path>
                    </svg>
                </a>
            </div>
            <table>
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Nombre</td>
                        <td>Email</td>
                        <td>Fecha</td>
                        <td>imagen</td>
                        <td>Rol</td>
                        <td>Opciones</td>
                    </tr>
                </thead>

                <tbody id="tbody">
                    <?php foreach ($usuarios as $user) : ?>

                    <tr data-id="<?= $user->id_user; ?>">
                        <td><?= $user->id_user; ?></td>
                        <td><?= $user->nombre_user; ?></td>
                        <td><?= $user->email_user; ?></td>
                        <td><?= $user->fechaCreado_user; ?></td>
                        <td><img src="../build/img/usuarios/<?= $user->imagen_user; ?>" width="50"></td>

                        <td>
                            <?php foreach ($roles as $rol) : ?>
                            <label><?= $rol->nombre_rol ?>
                                <input name="<?= $user->email_user ?>" type="radio" value="<?= $rol->id_rol ?>"
                                    <?php echo $user->id_rol === $rol->id_rol ? 'checked="checked"' : ''; ?>>
                            </label>

                            <?php endforeach; ?>
                        </td>

                        <td> <?php if ($user->id_user !== $_SESSION['id']) : ?>
                            <span class=" status return">Borrar</span>
                            <?php endif; ?>
                        </td>


                    </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>
            <div class="paginador">
                <ul>
                    <?php if ($pagina != 1) : ?>
                    <li class="paginador-list"><a href="/admin/usuarios?pagina=<?= 1; ?>">
                            <svg width='10px' viewBox="0 0 448 512">
                                <path
                                    d="M77.25 256l137.4-137.4c12.5-12.5 12.5-32.75 0-45.25s-32.75-12.5-45.25 0l-160 160c-12.5 12.5-12.5 32.75 0 45.25l160 160C175.6 444.9 183.8 448 192 448s16.38-3.125 22.62-9.375c12.5-12.5 12.5-32.75 0-45.25L77.25 256zM269.3 256l137.4-137.4c12.5-12.5 12.5-32.75 0-45.25s-32.75-12.5-45.25 0l-160 160c-12.5 12.5-12.5 32.75 0 45.25l160 160C367.6 444.9 375.8 448 384 448s16.38-3.125 22.62-9.375c12.5-12.5 12.5-32.75 0-45.25L269.3 256z" />
                            </svg>
                        </a></li>
                    <li class="paginador-list"><a href="/admin/usuarios?pagina=<?= $pagina - 1; ?>">
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
                    <li class="paginador-list"><a href="/admin/usuarios?pagina=<?= $i; ?>"><?= $i ?></a>
                    </li>
                    <?php endif; ?>
                    <?php endfor; ?>
                    <?php if ($pagina != $totalPaginas && $totalPaginas > 1) : ?>
                    <li class="paginador-list"><a href="/admin/usuarios?pagina=<?= $pagina + 1; ?>">
                            <svg width='10px' viewBox="0 0 448 512">
                                <path
                                    d="M246.6 233.4l-160-160c-12.5-12.5-32.75-12.5-45.25 0s-12.5 32.75 0 45.25L178.8 256l-137.4 137.4c-12.5 12.5-12.5 32.75 0 45.25C47.63 444.9 55.81 448 64 448s16.38-3.125 22.62-9.375l160-160C259.1 266.1 259.1 245.9">
                            </svg>
                        </a></li>
                    <li class="paginador-list"><a href="/admin/usuarios?pagina=<?= $totalPaginas; ?>">
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

</div>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
<script src="../build/js/admin/api/usuario.js"></script>