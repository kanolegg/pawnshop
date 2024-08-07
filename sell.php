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

    <title>Скупка / <?=$config['site']['name']?></title>
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
                <h2 class="text-center mb-5">Справедливая оценка. Экспертиза и безопасность</h2>
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="d-flex flex-column align-items-center">
                            <img class="mb-3" style="height: 70px;width:70px" src="/assets/img/features-1.svg" alt="">
                            <h5>Высокая оценка</h5>
                            <p class="mb-0 text-center" style="font-size: 14px;">Наши профессиональные эксперты-геммологи оценивают не только вес и пробу золота, но и вставки из драгоценных камней</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex flex-column align-items-center">
                            <img class="mb-3" style="height: 70px;width:70px" src="/assets/img/features-2.svg" alt="">
                            <h5>Комфорт и безопасность</h5>
                            <p class="mb-0 text-center" style="font-size: 14px;">Мы гарантируем безопасность личных данных клиентов и конфиденциальность осуществляемых сделок</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex flex-column align-items-center">
                            <img class="mb-3" style="height: 70px;width:70px" src="/assets/img/features-3.svg" alt="">
                            <h5>Быстрое оформление</h5>
                            <p class="mb-0 text-center" style="font-size: 14px;">Продать украшение можно буквально за 10 минут - провести оценку и получить деньги</p>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <button type="button" class="btn btn-outline-warning rounded-0" data-bs-toggle="modal" data-bs-target="#consultation">Записаться на оценку украшения</button>
                </div>
            </div>
        </section>
        <section class="py-5">
            <div class="container">
                <h4 class="text-center mb-3">Продать украшение или оформить займ? Выберите выгодный вариант</h4>
                <div class="d-flex mb-3 justify-content-center" id="pills-tab" role="tablist">
                    <div class="input-group justify-content-center">
                        <button class="btn sell-btn active" id="pills-gold-tab" data-bs-toggle="pill" data-bs-target="#pills-gold" type="button" role="tab" aria-controls="pills-gold" aria-selected="true">Золото</button>
                        <button class="btn sell-btn" id="pills-silver-tab" data-bs-toggle="pill" data-bs-target="#pills-silver" type="button" role="tab" aria-controls="pills-silver" aria-selected="false">Серебро</button>
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
                                            <th>Наличные, ₽/грамм</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-gold">
                                        <tr>
                                            <td>375</td>
                                            <td>2300</td>
                                            <td>2250</td>
                                        </tr>
                                        <tr>
                                            <td>500, 56</td>
                                            <td>2870 — 3450</td>
                                            <td>2820 — 3400</td>
                                        </tr>
                                        <tr>
                                            <td>585</td>
                                            <td>3400 — 4200</td>
                                            <td>3350 — 4150</td>
                                        </tr>
                                        <tr class="fw-bold">
                                            <td>750</td>
                                            <td>4400 — 5200</td>
                                            <td>4350 — 5150</td>
                                        </tr>
                                        <tr>
                                            <td>850</td>
                                            <td>5030 — 5230</td>
                                            <td>4980 — 5180</td>
                                        </tr>
                                        <tr>
                                            <td>916</td>
                                            <td>5350 — 5550</td>
                                            <td>5300 — 5500</td>
                                        </tr>
                                        <tr>
                                            <td>958</td>
                                            <td>5300 — 5500</td>
                                            <td>5650 — 5850</td>
                                        </tr>
                                        <tr>
                                            <td>875</td>
                                            <td>5180 — 5380</td>
                                            <td>5130 — 5330</td>
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
                <div class="text-center mt-3">
                    <button type="button" class="btn btn-warning rounded-0" data-bs-toggle="modal" data-bs-target="#consultation">Получить консультацию</button>
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
                <p>Услуги по скупке предоставляются ООО «<?=$config['site']['name']?> «Ломбард»</p>
                <p>Набережные Челны, Мира 7</p>
                <p>ОГРН 1137746167338</p>
                <p class="mb-0">ИНН 7729733707</p>
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