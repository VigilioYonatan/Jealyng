<?php require_once __DIR__ . '/includes/header.php'; ?>
<div class="cardBox2">
    <div class="admin-form">
        <form class="admin-form__form" id="formProductos">
            <h4>Agregar Productos</h4>
            <label for="nombre">Nombre:
                <input type="text" placeholder="Nombre del producto">
            </label>
            <label for="descripcion">Descripcion:
                <textarea name="" id="descripcion" placeholder="descripcion" cols="30" rows="5">

                </textarea>
            </label>

            <div class="inputs-number">
                <label for="precio">S/. Precio:
                    <input type="number" id="precio">
                </label>
                <label for="stock">Stock:
                    <input type="number" id="stock">
                </label>
                <label for="marca">Marca:
                    <select name="" id="marca">
                        <option value="marca">Marca</option>
                        <?php foreach ($marca as $marc) : ?>
                        <option value="<?= $marc->id_marca; ?>"><?= $marc->nombre_marca; ?></option>
                        <?php endforeach ?>
                    </select>
                </label>
            </div>
            <div class="inputs-number">
                <label for="descuento">Descuento:
                    <select name="" id="descuento">
                        <option value="descuento">descuento</option>
                        <?php foreach ($descuento as $desc) : ?>
                        <option value="<?= $desc->id_descuento; ?>"><?= $desc->nombre_descuento; ?></option>
                        <?php endforeach ?>
                    </select>
                </label>
                <label for="estado">Estado:
                    <select name="" id="estado">
                        <option value="estado">estado</option>
                        <?php foreach ($estadoPro as $estadoP) : ?>
                        <option value="<?= $estadoP->id_estadoPro; ?>"><?= $estadoP->nombre_estadoPro; ?></option>
                        <?php endforeach ?>
                    </select>
                </label>

                <label for="categoria">Categoria:
                    <select name="" id="categoria">
                        <option value="categoria">categoria</option>
                        <?php foreach ($categorias as $cat) : ?>
                        <option value="<?= $cat->id_categoria; ?>"><?= $cat->nombre_categoria; ?></option>
                        <?php endforeach ?>
                    </select>
                </label>
            </div>
            <label class=" lbl__imagen" for="imagen">Imagen:
                <input type="file" id="imagen">
            </label>
            <label class=" lbl__imagen" for="imagen3">Imagen2:
                <input type="file" id="imagen3">
            </label>
            <button>Agregar</button>
        </form>
    </div>
    <!-- ================ Order Details List ================= -->
    <div class="detalles">
        <div class="tablas">
            <h2 class="tablas__title">Lista de Producto</h2>
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
                        <td>imagen</td>
                        <td>Precio</td>
                        <td>stock</td>
                        <td>Estado</td>
                        <td>Opciones</td>
                    </tr>
                </thead>

                <tbody id="tbody">
                    <!-- api productos  -->
                </tbody>
            </table>
        </div>
        <!-- fin tabla -->

    </div>
    <div class="mostrar-card-upd">
        <div class="mostrar-card__containerCard">
            <form class="admin-form__form" id="updProductos">
                <h4></h4>
                <label>Nombre:
                    <input type="text" placeholder="Nombre del producto">
                </label>
                <label>Descripcion:
                    <textarea name="" placeholder="descripcion" cols="30" rows="5">

                </textarea>
                </label>

                <div class="inputs-number">
                    <label>S/. Precio:
                        <input type="number">
                    </label>
                    <label>Stock:
                        <input type="number">
                    </label>
                    <label>Marca:
                        <select name="">
                            <option value="marca">Marca</option>
                            <?php foreach ($marca as $marc) : ?>
                            <option value="<?= $marc->id_marca; ?>"><?= $marc->nombre_marca; ?></option>
                            <?php endforeach ?>
                        </select>
                    </label>
                </div>
                <div class="inputs-number">
                    <label>Descuento:
                        <select name="">
                            <option value="descuento">descuento</option>
                            <?php foreach ($descuento as $desc) : ?>
                            <option value="<?= $desc->id_descuento; ?>"><?= $desc->nombre_descuento; ?></option>
                            <?php endforeach ?>
                        </select>
                    </label>
                    <label>Estado:
                        <select name="">
                            <option value="estado">estado</option>
                            <?php foreach ($estadoPro as $estadoP) : ?>
                            <option value="<?= $estadoP->id_estadoPro; ?>"><?= $estadoP->nombre_estadoPro; ?>
                            </option>
                            <?php endforeach ?>
                        </select>
                    </label>

                    <label for="categoria">Categoria:
                        <select name="" id="categoria">
                            <option value="categoria">categoria</option>
                            <?php foreach ($categorias as $cat) : ?>
                            <option value="<?= $cat->id_categoria; ?>"><?= $cat->nombre_categoria; ?></option>
                            <?php endforeach ?>
                        </select>
                    </label>
                </div>
                <label class=" lbl__imagen" for="imagen2">Imagen:
                    <input type="file" id="imagen2">
                </label>
                <label class=" lbl__imagen" for="imagen3">Imagen2:
                    <input type="file" id="imagen3">
                </label>
                <img src="" alt="" style="width: 80px; align-self:center; margin:.5rem 0">
                <button>Actualizar</button>
            </form>
            <span class="mostrar-card__close">x</span>
        </div>
    </div>
</div>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
<script src="../build/js/admin/api/productos.js"></script>