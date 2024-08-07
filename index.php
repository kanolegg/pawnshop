<?php

include 'engine/core.class.php';
include 'engine/db.class.php';
$core = new core();

$config = $core->getConfig();
$menu = $core->menu('menu');

?>

<!DOCTYPE html>
<html class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">

    <link rel="stylesheet" href="/assets/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/fontawesome-pro-6.1.0-web/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/style.css?=<?=$_SERVER['REQUEST_TIME']?>">

    <title><?=$config['site']['name']?></title>
</head>
<body class="d-flex flex-column h-100">
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm bg-body-tertiary">
            <div class="container">
                <a class="navbar-brand me-2 fw-bold" href="/">
                    <div class="logo" title="<?=$config['site']['name']?>">
                        <i class="fa-regular fa-gem fa-2x"></i>
                    </div>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <?php foreach ($menu as $m):?>
                            <li class="nav-item"> <a class="nav-link" aria-current="page" href="<?=$m['url']?>"><?=$m['title']?></a> </li>
                        <?php endforeach;?>
                        <li class="nav-item">
                            <a class="text-muted d-block d-lg-none" href="/cart" title="Корзина">
                                <i class="fa-regular fa-shopping-cart"></i>
                            </a>
                            <a class="text-muted d-block d-lg-none" href="/account/" title="Профиль">
                                <i class="fa-regular fa-user"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="d-none d-lg-flex" style="gap: 1rem;">
                    <a class="text-muted" href="/account/" title="Профиль">
                        <i class="fa-regular fa-user"></i>
                    </a>
                    <a class="text-muted" href="/cart" title="Корзина">
                        <i class="fa-regular fa-shopping-cart"></i>
                    </a>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <section class="py-5">
            <div class="container">
                <a href="/sell">
                    <img class="w-100" src="/assets/img/banner.jpg" alt="">
                </a>
            </div>
        </section>
        <section class="py-5">
            <div class="container">
                <div class="row g-3">
                    <a href="/sell" class="col-md-6">
                        <div class="bg-secondary p-3 sales-button rounded d-flex justify-content-center flex-column align-items-center">
                            <span style="--sales-buttons-item-src: url(/assets/img/sales-button-1.svg)"></span>
                            Хочу продать
                        </div>
                    </a>
                    <a href="/catalog" class="col-md-6">
                        <div class="bg-secondary p-3 sales-button rounded d-flex justify-content-center flex-column align-items-center">
                            <span style="--sales-buttons-item-src: url(/assets/img/sales-button-2.svg)"></span>
                            Хочу купить
                        </div>
                    </a>
                    <!-- <a href="/loan" class="col-md-4">
                        <div class="bg-secondary p-3 sales-button rounded d-flex justify-content-center flex-column align-items-center">
                            <span style="--sales-buttons-item-src: url(/assets/img/sales-button-3.svg)"></span>
                            Хочу взять займ
                        </div>
                    </a> -->
                </div>
            </div>
        </section>
        <section class="py-5 bg-light">
            <div class="container">
                <h2>Ювелирный комиссионный магазин / ломбард</h2>
                <p>Помогаем быстро, просто и безопасно продавать и покупать украшения на вторичном рынке. Выдаем займы под залог ювелирных изделий.</p>
                <div class="row g-3">
                    <div class="col-md-6 col-lg-3">
                        <div class="promo-block big bg-white p-3 rounded d-flex justify-content-between flex-column h-100">
                            <strong>12</strong>
                            <span>уютных филиалов в Челнах</span>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="promo-block bg-white p-3 rounded d-flex justify-content-between flex-column h-100">
                            <strong>Широкий ассортимент</strong>
                            <span>более 10 000 изделий</span>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="promo-block big bg-white p-3 rounded d-flex justify-content-between flex-column h-100">
                            <strong>15</strong>
                            <span>лет мы работаем для вас</span>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="promo-block bg-white p-3 rounded d-flex justify-content-between flex-column h-100">
                            <strong>Большой ювелирный гипермаркет</strong>
                            <span>в центре города</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-5">
            <div class="container">
                <h4 class="text-center mb-3">Прайс-лист</h4>
                <div class="d-flex mb-3 justify-content-center" id="pills-tab" role="tablist">
                    <div class="nav-item" role="presentation">
                        <a class="price-button active" id="pills-gold-tab" data-bs-toggle="pill" data-bs-target="#pills-gold" type="button" role="tab" aria-controls="pills-gold" aria-selected="true">Золото</a>
                    </div>
                    <div class="nav-item" role="presentation">
                        <a class="price-button" id="pills-silver-tab" data-bs-toggle="pill" data-bs-target="#pills-silver" type="button" role="tab" aria-controls="pills-silver" aria-selected="false">Серебро</a>
                    </div>
                </div>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-gold" role="tabpanel" aria-labelledby="pills-gold-tab">
                        <div class="d-flex justify-content-center">
                            <div class="col-md-8">
                                <table class="table rounded price">
                                    <thead>
                                        <tr>
                                            <th>Проба золота</th>
                                            <th>На карту, ₽/грамм</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-gold">
                                        <tr>
                                            <td>375</td>
                                            <td>2300</td>
                                        </tr>
                                        <tr>
                                            <td>500, 56</td>
                                            <td>2870 — 3450</td>
                                        </tr>
                                        <tr>
                                            <td>585</td>
                                            <td>3400 — 4200</td>
                                        </tr>
                                        <tr>
                                            <td>750</td>
                                            <td>4400 — 5200</td>
                                        </tr>
                                        <tr>
                                            <td>850</td>
                                            <td>5030 — 5230</td>
                                        </tr>
                                        <tr>
                                            <td>916</td>
                                            <td>5350 — 5550</td>
                                        </tr>
                                        <tr>
                                            <td>958</td>
                                            <td>5700 — 5900</td>
                                        </tr>
                                        <tr>
                                            <td>875</td>
                                            <td>5180 — 5380</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-silver" role="tabpanel" aria-labelledby="pills-silver-tab">
                        <div class="d-flex justify-content-center">
                            <div class="col-md-8">
                                <table class="table rounded price">
                                    <thead>
                                        <tr>
                                            <th>Проба серебра</th>
                                            <th>На карту, ₽/грамм</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-gold">
                                        <tr>
                                            <td>84</td>
                                            <td>45 — 50</td>
                                        </tr>
                                        <tr>
                                            <td>800</td>
                                            <td>40 — 45</td>
                                        </tr>
                                        <tr>
                                            <td>875</td>
                                            <td>40 — 45</td>
                                        </tr>
                                        <tr>
                                            <td>925</td>
                                            <td>40 — 45</td>
                                        </tr>
                                        <tr>
                                            <td>960</td>
                                            <td>40 — 45</td>
                                        </tr>
                                        <tr>
                                            <td>999</td>
                                            <td>40 — 45</td>
                                        </tr>
                                        <tr>
                                            <td>900</td>
                                            <td>40 — 45</td>
                                        </tr>
                                        <tr>
                                            <td>916</td>
                                            <td>40 — 45</td>
                                        </tr>
                                        <tr>
                                            <td>830</td>
                                            <td>40 — 45</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-5" id="sell-banner">
            <div class="container">
                <div class="text-white">
                    <div class="row g-3 align-items-center">
                        <div class="col-md-6 col-xl-8">
                            <h2 class="mb-3">Прямо сейчас вы можете продать своё украшение 585 пробы по цене до 4 200 рублей за грамм</h2>
                        </div>
                        <div class="col-md-6 col-xl-4">
                            <div class="bg-white p-4 p-xl-5">
                                <div role="alert" id="result" class="alert alert-warning rounded-0" style="display: none;"></div>
                                <div class="mb-3">
                                    <input type="text" id="name" placeholder="Ваше имя" autocomplete="off" class="form-control py-2 rounded-0">
                                </div>
                                <div class="mb-3">
                                    <input type="text" id="phone" placeholder="Ваш номер телефона" autocomplete="off" class="form-control py-2 rounded-0">
                                </div>
                                <div class="mb-3">
                                    <button type="button" id="get-consultation" class="btn btn-danger w-100 py-2 rounded-0">Получить консультацию</button>
                                </div>
                                <p class="mb-0 text-dark" style="font-size: 10px;">Нажимая кнопку «Получить консультацию», выражаю согласие с Политиками обработки персональных данных ООО «<?=$config['site']['name']?> «Ломбард», а также подтверждаю ознакомление с условиями Оферты.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-5">
            <div class="container">
                <div class="swiper" id="jewelry">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="d-flex flex-column">
                                <img class="img-fluid" src="/assets/img/bracelets.png" alt="">
                                <p class="mb-0 text-center mt-2">Браслеты</p>
                            </div>   
                        </div>
                        <div class="swiper-slide">
                            <div class="d-flex flex-column">
                                <img class="img-fluid" src="/assets/img/brooch.png" alt="">
                                <p class="mb-0 text-center mt-2">Броши</p>
                            </div>   
                        </div>
                        <div class="swiper-slide">
                            <div class="d-flex flex-column">
                                <img class="img-fluid" src="/assets/img/chains.png" alt="">
                                <p class="mb-0 text-center mt-2">Цепочки</p>
                            </div>   
                        </div>
                        <div class="swiper-slide">
                            <div class="d-flex flex-column">
                                <img class="img-fluid" src="/assets/img/earrings.png" alt="">
                                <p class="mb-0 text-center mt-2">Серьги</p>
                            </div>   
                        </div>
                        <div class="swiper-slide">
                            <div class="d-flex flex-column">
                                <img class="img-fluid" src="/assets/img/necklace.png" alt="">
                                <p class="mb-0 text-center mt-2">Колье</p>
                            </div>   
                        </div>
                        <div class="swiper-slide">
                            <div class="d-flex flex-column">
                                <img class="img-fluid" src="/assets/img/pendant.png" alt="">
                                <p class="mb-0 text-center mt-2">Подвески</p>
                            </div>   
                        </div>
                        <div class="swiper-slide">
                            <div class="d-flex flex-column">
                                <img class="img-fluid" src="/assets/img/rings.png" alt="">
                                <p class="mb-0 text-center mt-2">Кольца</p>
                            </div>   
                        </div>
                        <div class="swiper-slide">
                            <div class="d-flex flex-column">
                                <img class="img-fluid" src="/assets/img/cufflinks.png" alt="">
                                <p class="mb-0 text-center mt-2">Запонки</p>
                            </div>   
                        </div>
                    </div>
                    <div class="swiper-pagination position-relative mt-3"></div>
                </div>
            </div>
        </section>
        <section class="py-5">
            <div class="container">
                <h2 class="text-center">Наши преимущества</h2>
                <div class="row g-3">
                    <div class="col-4">
                        <div class="d-flex justify-content-center align-items-center flex-column w-100">
                            <img class="advantages__icon mb-1 h-auto" src="/assets/img/benefits.svg" alt="15 лет на рынке" width="40" height="40">
                            <h4 class="text-center">15 лет на рынке</h4>
                            <p class="mb-0 text-center">Более 15 лет мы помогаем продавать и покупать ювелирные украшения, хорошо зная то, что вам дорого</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="d-flex justify-content-center align-items-center flex-column w-100">
                            <img class="advantages__icon mb-1 h-auto" src="/assets/img/high-mark.svg" alt="Выкупим дорого" width="40" height="40">
                            <h4 class="text-center">Выкупим дорого</h4>
                            <p class="mb-0 text-center">Выкупим украшения дорого – знаем настоящую цену! Бриллианты имеют значение</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="d-flex justify-content-center align-items-center flex-column w-100">
                            <img class="advantages__icon mb-1 h-auto" src="/assets/img/special-conditions.svg" alt="Особые условия" width="40" height="40">
                            <h4 class="text-center">Особые условия</h4>
                            <p class="mb-0 text-center">Для постоянных клиентов беспроцентный займ и до 30% к нужной сумме</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="d-flex justify-content-center align-items-center flex-column w-100">
                            <img class="advantages__icon mb-1 h-auto" src="/assets/img/exact-expertise.svg" alt="Точная экспертиза" width="40" height="40">
                            <h4 class="text-center">Точная экспертиза</h4>
                            <p class="mb-0 text-center">В собственной геммологической лаборатории мы высоко и точно оцениваем украшения</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="d-flex justify-content-center align-items-center flex-column w-100">
                            <img class="advantages__icon mb-1 h-auto" src="/assets/img/exact-expertise.svg" alt="Доверие и надежность" width="40" height="40">
                            <h4 class="text-center">Займ онлайн</h4>
                            <p class="mb-0 text-center">Легко взять займ - нужен только паспорт. Легко оплатить проценты, не выходя из дома. Деньги на карту</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="d-flex justify-content-center align-items-center flex-column w-100">
                            <img class="advantages__icon mb-1 h-auto" src="/assets/img/reliability-trust.svg" alt="Займ онлайн" width="40" height="40">
                            <h4 class="text-center">Доверие и надежность</h4>
                            <p class="mb-0 text-center">Все украшения надежно застрахованы, бережно хранятся и защищены от любых рисков</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-5">
            <div class="container">
                <h2 class="text-center">Отзывы</h2>
                <div class="swiper" id="feedback">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="border rounded p-3">
                                <h5>Имя</h5>
                                <div class="d-flex flex-row align-items-center mb-2">
                                    <div class="d-flex flex-row text-warning">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                    <div class="text-muted ms-3">09 мая</div>
                                </div>
                                <p class="mb-0"><?=$core->trim_text('Хороший ломбард, цены приемлемые, как на выкуп золота, так и на залог. Пользуюсь только этим ломбардом. И очень вежливый персонал, особенно в ломбарде на стороне макдака..', 200)?></p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination position-relative mt-3"></div>
                </div>
            </div>
        </section>
    </main>
    <footer class="text-center text-lg-start bg-body-tertiary text-muted bg-light mt-auto">
        <section class="">
            <div class="container text-center text-md-start mt-5">
                <div class="row mt-3">
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">Контакты</h6>
                        <p><i class="fas fa-home me-3"></i>Набережные Челны, Мира 7</p>
                        <p> <i class="fas fa-envelope me-3"></i><?=$config['site']['email']?></p>
                        <p><i class="fas fa-phone me-3"></i><?=$config['site']['phone']?></p>
                    </div>
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">
                            <i class="fas fa-gem me-3"></i><?=$config['site']['name']?></h6>
                        <p><?=$config['site']['footer_description']?></p>
                    </div>
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">
                Информация
              </h6>
                        <p> <a href="/about" class="text-reset">О нас</a> </p>
                        <p> <a href="#!" class="text-reset">Политика</a> </p>
                        <p> <a href="#!" class="text-reset">Контакты</a> </p>
                    </div>
                </div>
            </div>
        </section>
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);"> © <?=date('Y')?> <a class="text-reset fw-bold" href="/"><?=$config['site']['name']?></a> </div>
    </footer>

    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/jquery-3.3.1.min.js"></script>
    <script src="/assets/js/swiper-bundle.min.js"></script>
    <script type="text/javascript">
        let swiper1 = new Swiper("#jewelry", {
            slidesPerView: 3,
            spaceBetween: 10,
            calculateHeight:true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true
            },
            mousewheel: true,
            autoHeight: true,
            breakpoints: {
                640: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 5,
                    spaceBetween: 40,
                },
            },
        });

        let swiper2 = new Swiper("#feedback", {
            slidesPerView: 1,
            spaceBetween: 10,
            calculateHeight:true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true
            },
            mousewheel: true,
            autoHeight: true,
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 40,
                },
            },
        });

        $("#get-consultation").on("click", function() {
            let name = $("#name").val().trim();
            if (!name) {
                $("#name").focus();
            }
            let phone = $("#phone").val().trim();
            if (!phone) {
                $("#phone").focus();
            }

            $.ajax({
                url: '/handler',
                method: 'post',
                dataType: 'html',
                data: {
                    'method': 'consultation.request',
                    'params': {
                        'name': name,
                        'phone': phone
                    }
                },
                success: function(response) {
                    console.log(response)
                    response = JSON.parse(response);
                    if (response.ok) {
                        $("#name").val("");
                        $("#phone").val("");

                        $("#result").text(response.message);

                        $("#result").show();
                    }
                }
            });
        });

        $("#search").on("click", function() {
            if (!$("#query").val().trim()) {
                return $('html, body').animate({
                    scrollTop: $("#books").offset().top
                }, 0);
            } else {
                $("#search-form").submit();
            }
        });
    </script>
</body>
</html>