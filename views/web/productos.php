<?php require_once __DIR__ . '/includes/header.php'; ?>
<!-- productps -->
<section style="display: flex;" class="products">
    <!-- categorias  -->
    <div style="width:30%" class="category">
        Categorias
    </div>
    <!-- fin categorias  -->
    <!-- cards -->
    <div style="width:70%; display:flex; flex-wrap:wrap; align-items:center; " class="cards">
        <div style="width:20%; display:flex; flex-direction: column;  background-color: red;" class="cards-card">
            <picture style="display: flex; flex-direction:column; align-items :center;" class="card-image">
                <img style="width:80%; object-fit:cover" class=" card-image__img" src="./build/img/iphon12.jpg" alt="">
            </picture>
            <div style="display:flex; flex-direction: column; align-items:center; padding: .5rem 0;" class="card-info">
                <span style="" class="card-info__title">Iphone 12</span>
                <span style="" class="card-info__price">$ 3000</span>
                <button style="border-radius: 30%; background-color: purple;">Agregar Carrito</button>
            </div>
        </div>

    </div>
    <!-- fin cards  -->
</section>
<!-- fin productos  -->
<?php require_once __DIR__ . '/includes/footer.php'; ?>