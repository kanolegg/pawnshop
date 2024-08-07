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

    <title>Каталог / <?=$config['site']['name']?></title>
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
                <div class="row g-3">
                    <div class="col-md-6">
                        <a href="/category/rings" class="p-4 d-flex flex-row justify-content-between align-items-start catalog-item h-100 text-dark">
                            <div class="d-flex flex-column">
                                <h2 class="catalog-link">Кольца</h2>
                                <span>от 4 025 ₽</span>
                            </div>
                            <img src="/assets/img/catalog-rings.png" alt="Кольца">
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="/category/earrings" class="p-4 d-flex flex-row justify-content-between align-items-start catalog-item h-100 text-dark">
                            <div class="d-flex flex-column">
                                <h2 class="catalog-link">Серьги</h2>
                                <span>от 6 300 ₽</span>
                            </div>
                            <img src="/assets/img/catalog-earrings.png" alt="Серьги">
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="/category/chains" class="p-4 d-flex flex-row justify-content-between align-items-start catalog-item h-100 text-dark">
                            <div class="d-flex flex-column">
                                <h2 class="catalog-link">Цепочки</h2>
                                <span>от 6 900 ₽</span>
                            </div>
                            <img src="/assets/img/catalog-chains.png" alt="Цепочки">
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="/category/pendants" class="p-4 d-flex flex-row justify-content-between align-items-start catalog-item h-100 text-dark">
                            <div class="d-flex flex-column">
                                <h2 class="catalog-link">Подвески</h2>
                                <span>от 3 675 ₽</span>
                            </div>
                            <img src="/assets/img/catalog-pendant.png" alt="Подвески">
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <a href="/category/bracelets" class="p-4 d-flex flex-row justify-content-between align-items-start catalog-item h-100 text-dark">
                            <div class="d-flex flex-column">
                                <h2 class="catalog-link">Браслеты</h2>
                                <span>от 7 400 ₽</span>
                            </div>
                            <img src="/assets/img/catalog-bracelets.png" alt="Браслеты">
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <a href="/category/necklaces" class="p-4 d-flex flex-row justify-content-between align-items-start catalog-item h-100 text-dark">
                            <div class="d-flex flex-column">
                                <h2 class="catalog-link">Колье</h2>
                                <span>от 12 300 ₽</span>
                            </div>
                            <img src="/assets/img/catalog-necklace.png" alt="Колье">
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <a href="/category/brooch" class="p-4 d-flex flex-row justify-content-between align-items-start catalog-item h-100 text-dark">
                            <div class="d-flex flex-column">
                                <h2 class="catalog-link">Броши</h2>
                                <span>от 8 600 ₽</span>
                            </div>
                            <img src="/assets/img/catalog-brooch.png" alt="Броши">
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <a href="/category/cufflinks" class="p-4 d-flex flex-row justify-content-between align-items-start catalog-item h-100 text-dark">
                            <div class="d-flex flex-column">
                                <h2 class="catalog-link">Запонки</h2>
                                <span>от 12 000 ₽</span>
                            </div>
                            <img src="/assets/img/catalog-cufflinks.png" alt="Запонки">
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <a href="/category/watch" class="p-4 d-flex flex-row justify-content-between align-items-start catalog-item h-100 text-dark">
                            <div class="d-flex flex-column">
                                <h2 class="catalog-link">Часы</h2>
                                <span>от 197 000 ₽</span>
                            </div>
                            <img src="/assets/img/catalog-watch.png" alt="Часы">
                        </a>
                    </div>
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

    <div class="modal fade" id="consultation" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Отправить заявку</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div role="alert" id="modal-result" class="alert alert-warning rounded-0" style="display: none;"></div>
                    <div class="mb-3">
                        <input type="text" id="modal-name" placeholder="Ваше имя" autocomplete="off" class="form-control py-2 rounded-0">
                    </div>
                    <div class="mb-3">
                        <input type="text" id="modal-phone" placeholder="Ваш номер телефона" autocomplete="off" class="form-control py-2 rounded-0">
                    </div>
                    <div class="mb-3">
                        <button type="button" id="modal-get-consultation" class="btn btn-danger w-100 py-2 rounded-0">Получить консультацию</button>
                    </div>
                    <p class="mb-0" style="font-size: 10px;">Нажимая кнопку «Получить консультацию», выражаю согласие с Политиками обработки персональных данных ООО «<?=$config['site']['name']?> «Ломбард», а также подтверждаю ознакомление с условиями Оферты.</p>
                </div>
            </div>
        </div>
    </div>

    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript">
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

        $("#modal-get-consultation").on("click", function() {
            let name = $("#modal-name").val().trim();
            if (!name) {
                $("#modal-name").focus();
            }
            let phone = $("#modal-phone").val().trim();
            if (!phone) {
                $("#modal-phone").focus();
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
                        $("#modal-name").val("");
                        $("#modal-phone").val("");

                        $("#modal-result").text(response.message);

                        $("#modal-result").show();
                    }
                }
            });
        });
    </script>
</body>
</html>