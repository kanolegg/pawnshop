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

    <title>Информация о компании / <?=$config['site']['name']?></title>
</head>
<body class="d-flex flex-column h-100">
    <header>
        <nav class="navbar navbar-expand-lg navbar-light shadow-sm bg-white bg-body-tertiary">
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
                <h2 class="mb-5">О компании</h2>
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="d-flex flex-column align-items-center">
                            <h1 class="fw-bold" style="color: #ff8c3f;">15</h1>
                            <h2 class="">лет работы</h2>
                            <p class="mb-0 text-center" style="font-size: 14px;">С 2009 года мы успешно работаем на рынке ломбардов и ювелирных магазинов</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex flex-column align-items-center">
                            <h1 class="fw-bold" style="color: #ff8c3f;">1068</h1>
                            <h2 class="">клиентов</h2>
                            <p class="mb-0 text-center" style="font-size: 14px;">У нас есть постоянные клиенты и число их постоянно растёт Нам доверяют!</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex flex-column align-items-center">
                            <h1 class="fw-bold" style="color: #ff8c3f;">12</h1>
                            <h2 class="">филиалов</h2>
                            <p class="mb-0 text-center" style="font-size: 14px;">Мы постоянно развиваемся. На сегодняшний день у нас 47 филиалов и планы по открытию новых отделений в Наб. Челнах</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-10">
                    <div class="mt-3">
                        <p>Мы – отраслевой лидер на рынке кредитования под залог ювелирных украшений, предоставляющий своим клиентам возможность найти простое, выгодное и безопасное решение в ситуации, когда Вам необходима срочная финансовая поддержка.</p>
                        <p>Мы не торгуем деньгами, мы быстро и эффективно находим выход из Вашей жизненной ситуации.</p>
                        <p>Уютные, современные филиалы на территории Москвы открыты для вас 7 дней в неделю. Здесь, в одном месте, Вы сможете получить компетентную консультацию профессиональных экспертов, оценить Ваше ювелирное украшение - получив экспертное заключение, которое ценится даже у наших конкурентов, оформить займ под залог ювелирного украшения, приобрести украшения, которые, как правило, уже не найдешь в обычных ювелирных магазинах, а также продать ювелирное украшение – если таков Ваш выбор.</p>
                        <p>В 2017 году группа компаний «<?=$config['site']['name']?>» была признана лучшей компанией страны, предоставляющей услуги по кредитованию под залог ювелирных украшений, по версии журнала Навигатор Ювелирной Торговли.</p>
                        <p>Мы держим марку!</p>
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

    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/jquery-3.3.1.min.js"></script>
</body>
</html>