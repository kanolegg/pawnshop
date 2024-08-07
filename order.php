<?php

include 'engine/core.class.php';
include 'engine/db.class.php';
$core = new core();

$config = $core->getConfig();
$menu = $core->menu('menu');

if (!isset($_GET['id']))
    header('Location: /');

if (!empty($_POST)) {
    $core->update('orders', $_GET['id'], ['status' => 1]);
    header('Location: /order/'.$_GET['id']);
}

$order = $core->get('orders', ['id' => $_GET['id']])[0];

if (!$order)
    header('Location: /');

$products = json_decode($order['products']);
$ids = [];

foreach ($products as $t => $c) {
    $ids[] = $t;
}

if (!empty($ids)) {
    $ids = implode(',', $ids);

    $products = $core->cartGet('id IN('.$ids.')');
}

?>

<!DOCTYPE html>
<html class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">

    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/fontawesome-pro-6.1.0-web/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/style.css?=<?=$_SERVER['REQUEST_TIME']?>">
    <title>Заказ #<?=$order['id']?> / <?=$config['site']['name']?></title>
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
        <section class="py-3">
            <div class="container">
                <?php if ($order['status'] === 0):?>
                    <h2>Заказ #<?=$order['id']?></h2>
                    <form method="POST" class="row justify-content-center" id="payment-form">
                        <div class="col-md-6">
                            <div class="rounded shadow">
                                <div class="p-3 bg-light">
                                    <h4 class="text-center">Оплата заказа</h4>
                                </div>
                                <div class="p-3">
                                    <div class="d-flex justify-content-between mb-3">
                                        <span>Сумма оплаты</span>
                                        <span class="fw-bold"><?=$order['sum']?> ₽</span>
                                    </div>

                                    <div class="mb-3">
                                        <input type="text" class="form-control" autocomplete="off" id="number" placeholder="Номер карты">
                                    </div>

                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Срок действия" id="expire" name="expire" autocomplete="off">
                                        <input type="text" class="form-control" placeholder="CVC/CVV" id="cvc" name="cvc" autocomplete="off">
                                    </div>

                                    <button id="pay" class="btn btn-primary">Оплатить</button>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php else:?>
                    <h2 class="mb-3">Готово!</h2>
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <p>Ваш заказ #<?=$order['id']?> оплачен и принят в обработку. Наш менеджер скоро свяжется с вами по телефону, который вы указали при заказе</p>
                        </div>
                        <div class="col-md-8">
                            <?php if ($products):?>
                                <h4>Позиции заказа</h4>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Фото</th>
                                                <th>Наименование</th>
                                                <th>Артикул</th>
                                                <th>Цена</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($products as $product):?>
                                                <tr id="product-<?=$product['id']?>">
                                                    <td>
                                                        <?php if ($product['image']):?>
                                                            <img src="<?=$product['image']?>" alt="<?=$product['title']?>" style="width: 4rem;">
                                                        <?php else:?>
                                                            <img src="/assets/img/placeholder.jpg" alt="<?=$product['title']?>" style="width: 4rem;">
                                                        <?php endif;?>
                                                    </td>
                                                    <td><?=$product['title']?></td>
                                                    <td><?=$product['vendor_code']?></td>
                                                    <td><?=$product['price']?> ₽</td>
                                                </tr>
                                            <?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif;?>
                        </div>
                    </div>
                    <div class="text-end"><a href="/" class="btn btn-warning">На главную</a></div>
                <?php endif;?>
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
    <script>
        $("#pay").on("click", function() {
            let number = $("#number").val().trim();
            if (number === "")
                return $("#number").focus();

            let expire = $("#expire").val().trim();
            if (expire === "")
                return $("#expire").focus();

            let cvc = $("#cvc").val().trim();
            if (cvc === "")
                return $("#cvc").focus();

            $("#payment-form").submit();
        });
    </script>
</body>
</html>