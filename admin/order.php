<?php

include '../engine/core.class.php';
include '../engine/db.class.php';
$core = new core();

$config = $core->getConfig();
$menu = $core->menu('menu_admin');

if (isset($_COOKIE['CSRF_TOKEN']) && isset($_SESSION['secret'])) {
    if (!$check = $core->checkAuth($_COOKIE['CSRF_TOKEN']))
        header('Location: /account/login');
} else {
    header('Location: /account/login');
}

$config = $core->getConfig();

if (!isset($_GET['id']))
    header('Location: /');

if (!empty($_POST)) {
    $core->update('orders', $_GET['id'], ['status' => 2]);
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
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">

    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/fontawesome-pro-6.1.0-web/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/style.css?=<?=$_SERVER['REQUEST_TIME']?>">
    <title>Заказ #<?=$order['id']?> / <?=$config['site']['name']?></title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light py-3">
            <div class="container">
                <button  class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"> <i class="fas fa-bars"></i> </button>
                <div class="collapse navbar-collapse" id="navbar">
                    <a class="navbar-brand mt-2 mt-lg-0" href="/"><?=$config['site']['name']?></a>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <?php if ($menu):?>
                            <?php foreach ($menu as $m):?>
                                <li class="nav-item"> <a class="nav-link" href="<?=$m['url']?>"><?=$m['title']?></a> </li>
                            <?php endforeach;?>
                        <?php endif;?>
                    </ul>
                </div>
                <div class="d-flex align-items-center">
                    <div class="dropstart">
                        <a class="dropdown-toggle" href="" role="button" id="account-button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="account-button">
                            <li><a class="dropdown-item" href="/account">Профиль</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="/account/login?act=logout">Выйти</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <section class="py-3">
            <div class="container">
                <div class="d-flex align-items-center">
                    <a href="/admin/orders" class="badge badge-light">
                        <i class="fa-regular fa-arrow-left"></i>
                        Назад
                    </a>
                    <h2 class="ms-1">Заказ #<?=$order['id']?></h2>
                </div>

                <div class="rounded shadow p-3">
                    <h4>Клиент</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Имя</td>
                                            <td><?=$order['name']?></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td><?=$order['email']?></td>
                                        </tr>
                                        <tr>
                                            <td>Телефон</td>
                                            <td><?=$order['phone']?></td>
                                        </tr>
                                        <tr>
                                            <td>Адрес</td>
                                            <td><?=$order['address']?></td>
                                        </tr>
                                        <tr>
                                            <td>Статус</td>
                                            <td>
                                                <?php if ($order['status'] === 0):?>
                                                    <div class="badge badge-primary">Не оплачен</div>
                                                <?php elseif ($order['status'] === 1):?>
                                                    <div class="badge badge-success">Оплачен</div>
                                                <?php endif;?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php if ($products):?>
                        <h4>Позиции заказа</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Наименование</th>
                                        <th>Артикул</th>
                                        <th>Цена</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($products as $product):?>
                                        <tr id="product-<?=$product['id']?>">
                                            <td><?=$product['title']?></td>
                                            <td><?=$product['vendor_code']?></td>
                                            <td><?=$product['price']?> ₽</td>
                                        </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif;?>
                    <h4 class="text-end">Итого: <?=number_format($order['sum'], 0, ',', ' ')?> ₽</h4>
                </div>
            </div>
        </section>
    </main>

    <div class="modal fade" tabindex="-1" id="delete-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Подтверждение</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Вы действительно хотите удалить этот раздел каталога?
                    <input type="hidden" id="delete-id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="button" class="btn btn-primary" id="delete">Да</button>
                </div>
            </div>
        </div>
    </div>

    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript">

        let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        let tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        })

        $(".delete").on("click", function() {
            $("#delete-id").val($(this).data("id"));
            $("#delete-modal").modal("toggle");

        });

        $("#delete").on("click", function() {
            let id = $("#delete-id").val();

            $.ajax({
                type: "POST",
                url: "/handler",
                dataType: 'html',
                data: {
                    'method': 'order.delete',
                    'params': {
                        'id': id
                    }
                },
                success: function(response) {
                    response = JSON.parse(response);
                    if (response.ok) {
                        $("#order-"+id).remove();
                        $("#delete-modal").modal("toggle");
                    }
                }
            });
        });
    </script>
</body>
</html>