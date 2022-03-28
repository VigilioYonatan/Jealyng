<header class="header">
    <div class="container-header">
        <a href="/" class="header__logo">Logo</a>
        <div class="header-categorias">
            <a class="header-categorias__hmb" id="hamburguer" href="#">
                <svg class="header-categorias__ico" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path
                        d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z" />
                </svg>
            </a>
            <span class="header-categorias__title">Menú de Categorias</span>

        </div>
        <div class="header-search">
            <input class="header-search__inp" type="text" placeholder="Buscar productos">
            <a class="header-search__ico" ref="#">
                <svg width='20px' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path
                        d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z" />
                </svg>
            </a>
        </div>
        <div class="header-info">
            <!-- <a href=""><svg width='20px' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path
                    d="M283.211 512c78.962 0 151.079-35.925 198.857-94.792 7.068-8.708-.639-21.43-11.562-19.35-124.203 23.654-238.262-71.576-238.262-196.954 0-72.222 38.662-138.635 101.498-174.394 9.686-5.512 7.25-20.197-3.756-22.23A258.156 258.156 0 0 0 283.211 0c-141.309 0-256 114.511-256 256 0 141.309 114.511 256 256 256z" />
            </svg></a> -->
            <a href="/login" class="header-info__login">
                <svg class="header-info__ico" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512">
                    <path
                        d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z" />
                </svg>
                <span class="header-info__title">Login</span>
            </a>
            <a href="" class="header-info__cart"><svg class="header-info__ico" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 448 512">
                    <path
                        d="M352 160v-32C352 57.42 294.579 0 224 0 153.42 0 96 57.42 96 128v32H0v272c0 44.183 35.817 80 80 80h288c44.183 0 80-35.817 80-80V160h-96zm-192-32c0-35.29 28.71-64 64-64s64 28.71 64 64v32H160v-32zm160 120c-13.255 0-24-10.745-24-24s10.745-24 24-24 24 10.745 24 24-10.745 24-24 24zm-192 0c-13.255 0-24-10.745-24-24s10.745-24 24-24 24 10.745 24 24-10.745 24-24 24z" />
                </svg></a>
        </div>


    </div>
    </div>

</header>
<nav class="navbar">
    <div class="navbar-container">
        <?php for ($i = 0; $i < 5; $i++) : ?>
        <ul class="navbar-categorias">
            <li class="navbar-categorias__list"><span class="navbar-categorias__title">Ropa</span></li>
            <li class="navbar-categorias__list"><a class="navbar-categorias__link" href="">loremx2d sds</a></li>
            <li class="navbar-categorias__list"><a class="navbar-categorias__link" href="">loremx2d sds</a></li>
            <li class="navbar-categorias__list"><a class="navbar-categorias__link" href="">loremx2d sds</a></li>
            <li class="navbar-categorias__list"><a class="navbar-categorias__link" href="">loremx2d sds</a></li>
            <li class="navbar-categorias__list"><a class="navbar-categorias__link" href="">loremx2d sds</a></li>
            <li class="navbar-categorias__list"><a class="navbar-categorias__link" href="">loremx2d sds</a></li>
        </ul>
        <?php endfor; ?>
    </div>
</nav>