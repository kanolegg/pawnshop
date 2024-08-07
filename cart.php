<?php

include 'engine/core.class.php';
include 'engine/db.class.php';
$core = new core();

$config = $core->getConfig();
$menu = $core->menu('menu');

if (!empty($_POST)) {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $address = htmlspecialchars($_POST['address']);
    $products = $_POST['products'];
    $sum = $_POST['sum'];

    $order_id = $core->add(
        'orders',
        [
            'name' => '\''.$name.'\'',
            'email' => '\''.$email.'\'',
            'phone' => '\''.$phone.'\'',
            'address' => '\''.$address.'\'',
            'products' => '\''.$products.'\'',
            'sum' => '\''.$sum.'\'',
            'date' => '\''.$_SERVER['REQUEST_TIME'].'\''
        ]
    );

    unset($_COOKIE['cart']); 
    setcookie('cart', '', -1, '/');

    header('Location: /order/'.$order_id);
}

if (isset($_COOKIE['cart'])) {
    $cart = json_decode($_COOKIE['cart'], true);
} else {
    $cart = [];
}

$ids = [];

foreach ($cart as $t => $c) {
    $ids[] = $t;
}

if (!empty($ids)) {
    $ids = implode(',', $ids);

    $products = $core->cartGet($ids);
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

    <title>Корзина / <?=$config['site']['name']?></title>
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
                
                <div id="content">
                    <?php if (!empty($cart)):?>
                        <div class="row g-3" id="positions">
                        <h2>Корзина</h2>
                            <div class="col-md-8">
                                <?=$core->num_word(count($cart), array('товар', 'товара', 'товаров'))?>
                                <hr>
                                <div class="d-flex flex-column" id="cart-products">
                                    <?php foreach ($products as $product):?>
                                        <div class="row pb-3 border-bottom" id="cart-product-<?=$product['id']?>">
                                            <div class="col-md-2">
                                                <?php if ($product['image']):?>
                                                    <img src="<?=$product['image']?>" alt="<?=$product['title']?>" class="img-fluid">
                                                <?php else:?>
                                                    <img src="/assets/img/placeholder.jpg" alt="<?=$product['title']?>" class="img-fluid">
                                                <?php endif;?>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="d-flex flex-column justify-content-between h-100">
                                                    <div>
                                                        <small class="text-muted"><?=$product['vendor_code']?></small>
                                                        <h5>
                                                            <a class="text-dark" href="/product/<?=$product['id']?>"><?=$product['title']?></a>
                                                        </h5>
                                                        <h5><?=number_format($product['price'], 0, ',', ' ')?> ₽/шт.</h5>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <a class="remove-from-cart text-danger" href="javascript:void(0)" data-product-id="<?=$product['id']?>">
                                                            <i class="fa-duotone fa-trash"></i>
                                                            Удалить
                                                        </a>
                                                        <div class="d-flex amount-wrapper">
                                                            <button type="button" class="btn btn-outline-secondary px-2 py-1 amount-dec" data-product-id="<?=$product['id']?>">
                                                                <i class="fa-light fa-minus"></i>
                                                            </button>
                                                            <input type="text" class="form-control text-center text-muted fw-bold mx-1 p-0 amount" min="1" max="10000" value="1" style="width: 80px" data-product-id="<?=$product['id']?>">
                                                            <button type="button" class="btn btn-outline-secondary px-2 py-1 amount-inc" data-product-id="<?=$product['id']?>">
                                                                <i class="fa-light fa-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach;?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="rounded bg-light p-3">
                                    <div class="d-flex justify-content-between">
                                        <h4>Итого</h4>
                                        <h4><span id="total-price"><?=$sum?></span> ₽</h4>
                                    </div>
                                    <hr>
                                    <button type="button" class="btn btn-warning w-100 py-3 fw-bold" id="goto-checkout">Перейти к оформлению</button>
                                </div>
                            </div>
                        </div>
                        <div id="personal" style="display: none;">
                            <h2>Оформление заказа</h2>
                            <div class="rounded bg-white shadow p-3">
                                <form class="row" method="POST" id="personal-form">
                                    <div class="col-xl-9">
                                        <h4>
                                            <span class="text-warning me-2">
                                                <i class="fa-solid fa-user"></i>
                                            </span>
                                            Персональные данные
                                        </h4>

                                        <div class="row g-3 mb-3">
                                            <div class="col-md-4">
                                                <label for="name" class="form-label">Контактное лицо<span class="text-danger">*</span></label>
                                                <input type="text" id="name" name="name" class="form-control" autocomplete="off" required value="Имя">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                                                <input type="email" id="email" name="email" class="form-control email" autocomplete="off" required value="email">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="phone" class="form-label">Номер телефона<span class="text-danger">*</span></label>
                                                <input type="text" id="phone" name="phone" class="form-control phone" autocomplete="off" required value="+7(999) 999-9999">
                                            </div>
                                            <div class="col-12">
                                                <label for="address" class="form-label">Адрес<span class="text-danger">*</span></label>
                                                <textarea class="form-control" id="address" name="address"></textarea>
                                            </div>
                                        </div>

                                        <input type="hidden" name="products" id="products">
                                        <input type="hidden" name="sum" id="sum">
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <button type="button" class="btn btn-secondary" id="goto-positions">Назад</button>
                                        <button type="button" class="btn btn-warning" id="checkout">Оформить заказ</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php else:?>
                        <h2>Корзина</h2>
                        <p>В корзине пока пусто. Загляните в каталог, чтобы выбрать товары или найдите нужное в поиске</p>
                        <a href="/catalog" class="btn btn-warning px-3">Каталог</a>
                    <?php endif;?>
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

    <div class="modal fade" id="remove-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Подтверждение</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Вы действительно хотите убрать этот товар из корзины?</p>
                    <input type="hidden" id="remove-id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Нет</button>
                    <button type="button" class="btn btn-primary" id="remove-from-cart">Да</button>
                </div>
            </div>
        </div>
    </div>

    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript">
        products = <?=json_encode($products, JSON_UNESCAPED_UNICODE)?>;

        function checkout() {
            let products_count = 0;
            let total_price = 0;
            for (let product in cart) {
                products_count += Number(cart[product]);
                total_price += Number(products.find(o => o.id == product).price) * Number(cart[product]);
            }

            $("#products-count").text(products_count);
            $("#total-price").text(total_price);
            $("#sum").val(total_price);

            if (false) {
                $("#positions").hide();
                $("#personal").show();
            }
        }

        $(document).ready(function() {
            cart = <?=($_COOKIE['cart'])?$_COOKIE['cart']:'[]'?>;
            checkout();
        });

        $("#checkout").on("click", function() {
            let contact = $("#name").val().trim();
            if (contact === "")
                return $("#name").focus();

            let email = $("#email").val().trim();
            if (email === "")
                return $("#email").focus();

            let phone = $("#phone").val().trim();
            if (phone === "")
                return $("#phone").focus();

            let address = $("#address").val().trim();
            if (address === "")
                return $("#address").focus();

            $("#products").val(JSON.stringify(window.cart));

            $("#personal-form").submit();
        });

        $(".remove-from-cart").on("click", function() {
            $("#remove-id").val($(this).data("product-id"));
            $("#remove-modal").modal("toggle");
        });

        $("#remove-from-cart").on("click", function() {
            let product_id = Number($("#remove-id").val());

            $.ajax({
                type: "POST",
                url: "/handler",
                dataType: 'html',
                data: {
                    'method': 'cart.remove',
                    'params': {
                        'product_id': product_id
                    }
                },
                success: function(data) {
                    response = JSON.parse(data);
                    if (response.ok) {
                        $("#cart-product-"+product_id).remove();

                        checkout();

                        if ($("#cart-products").children().length === 0) {
                            $("#content").empty();

                            $("<h2>").text("Корзина").appendTo("#content");
                            $("<p>").text("В корзине пока пусто. Загляните в каталог, чтобы выбрать товары или найдите нужное в поиске").appendTo("#content");
                            $("<a>", {"href": "/catalog", "class": "btn btn-primary px-3"}).text("Каталог").appendTo("#content");

                            $("#cart-badge").hide();
                            $("#remove-modal").modal("toggle");
                        }
                    }
                }
            });
        });

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
                        $(button).removeClass("btn-primary");
                        $(button).addClass("btn-warning");

                        $(button).attr("href", "/cart");
                        $(button).text("В корзине");

                        return;
                    }
                }
            });
        });

        $(".amount-dec").on("click", function() {
            let amount = $(this).closest(".amount-wrapper").find(".amount");
            let product_id = $(this).data("product-id");
            let current_amount = Number($(amount).val().trim());

            if (/^\d+$/.test(current_amount) === false || current_amount <= 1)
                return $(amount).val("1");

            $(amount).val(current_amount - 1);
            cart[product_id]--;
            checkout();
        });

        $(".amount-inc").on("click", function() {
            let amount = $(this).closest(".amount-wrapper").find(".amount");
            let product_id = $(this).data("product-id");
            let current_amount = Number($(amount).val().trim());

            if (/^\d+$/.test(current_amount) === false || current_amount >= 10000)
                return $(amount).val("10000");

            let new_amount = current_amount + 1;

            $(amount).val(new_amount);
            cart[product_id]++;
            checkout();
        });

        $(".amount").on("input", function() {
            let new_amount = Number($(this).val().trim());
            let product_id = $(this).data("product-id");

            if (/^\d+$/.test(new_amount) === false || new_amount <= 1)
                return cart[product_id] = 1;

            cart[product_id] = new_amount;
            checkout();
        });

        $("#goto-positions").on("click", function() {
            $("#positions").show();
            $("#personal").hide();
        });

        $("#goto-checkout").on("click", function() {
            $("#positions").hide();
            $("#personal").show();
        });
    </script>
</body>
</html>