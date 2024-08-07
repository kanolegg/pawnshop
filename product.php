<?php

include 'engine/core.class.php';
include 'engine/db.class.php';
$core = new core();

$config = $core->getConfig();
$menu = $core->menu('menu');

if (isset($_GET['id'])) {
    $product = $core->get('products', ['id' => $_GET['id']])[0];

} else {
    header('Location: /catalog');
}

$categories = [
    'rings' => 'Кольца',
    'earrings' => 'Серьги',
    'chains' => 'Цепочки',
    'pendant' => 'Подвески',
    'bracelets' => 'Браслеты',
    'cufflinks' => 'Запонки',
    'watch' => 'Часы'
];

$title = $product['title'];

if (isset($_COOKIE['cart'])) {
    $cart = json_decode($_COOKIE['cart'], true);
} else {
    $cart = [];
}

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

    <title><?=$title?> / <?=$config['site']['name']?></title>
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
                    <div class="col-7">
                        <?php if ($product['image']):?>
                            <img src="<?=$product['image']?>" alt="<?=$product['title']?>" class="img-fluid">
                        <?php else:?>
                            <img src="/assets/img/placeholder.jpg" alt="<?=$product['title']?>" class="img-fluid">
                        <?php endif;?>
                    </div>
                    <div class="col-5">
                        <h2><?=$product['title']?></h2>
                        <div class="h5"><?=number_format($product['price'], 0, ',', ' ')?> ₽</div>
                        <?php if (in_array($product['id'], array_keys($cart))):?>
                            <a href="/cart" class="btn btn-outline-warning mt-3 add-to-cart w-100 rounded-0" data-id="<?=$product['id']?>">В корзине</a>
                        <?php else:?>
                            <a href="javascript:void(0)" class="btn btn-warning mt-3 add-to-cart w-100 rounded-0" data-id="<?=$product['id']?>">В корзину</a>
                        <?php endif;?>
                        <div class="accordion mt-3" id="product-accordion">
                            <div class="accordion-item border-0 rounded-0">
                                <h2 class="accordion-header" id="htwo">
                                    <button class="accordion-button rounded-0 px-0" type="button" data-bs-toggle="collapse" data-bs-target="#a-info" aria-expanded="true" aria-controls="a-info">Информация</button>
                                </h2>
                                <div id="a-info" class="accordion-collapse collapse show" aria-labelledby="htwo" data-bs-parent="#product-accordion">
                                    <div class="accordion-body px-0">
                                        <table class="table my-3">
                                            <tbody>
                                                <tr>
                                                    <td>Артикул</td>
                                                    <td><?=$product['vendor_code']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Металл</td>
                                                    <td><?=$product['metal']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Вес</td>
                                                    <td><?=$product['weight']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Проба</td>
                                                    <td><?=$product['content']?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0 rounded-0">
                                <h2 class="accordion-header" id="hone">
                                    <button class="accordion-button rounded-0 px-0 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#a-guarantee" aria-expanded="false" aria-controls="a-guarantee">Гарантия и возврат</button>
                                </h2>
                                <div id="a-guarantee" class="accordion-collapse collapse" aria-labelledby="hone" data-bs-parent="#product-accordion">
                                    <div class="accordion-body px-0">
                                        <ul>
                                            <li>Вернем деньги без объяснения причины. У Вас есть право передумать, если изделие вам не подошло. 5 дней на возврат.</li>
                                            <li>Данное изделие проверено и имеет сертификат</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if ($product['description']):?>
                    <h4>Описание</h4>
                    <div><?=$product['description']?></div>
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
        $(".add-to-cart").on("click", function() {
            let id = $(this).data("id");
            let button = $(this);

            $.ajax({
                type: "POST",
                url: "/handler",
                dataType: 'html',
                data: {
                    'method': 'cart.add',
                    'params': {
                        'product_id': id,
                        'amount': 1
                    }
                },
                success: function(data) {
                    response = JSON.parse(data);
                    if (response.ok) {
                        $(button).removeClass("btn-warning");
                        $(button).addClass("btn-outline-warning");

                        $(button).attr("href", "/cart");
                        $(button).text("В корзине");

                        return;
                    }
                }
            });
        });
    </script>
</body>
</html>