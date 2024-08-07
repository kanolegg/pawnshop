<?php

include '../engine/core.class.php';
include '../engine/db.class.php';
$core = new core();

if (isset($_COOKIE['CSRF_TOKEN']) && isset($_SESSION['secret'])) {
    if (!$check = $core->checkAuth($_COOKIE['CSRF_TOKEN']))
        header('Location: /account/login');
} else {
    header('Location: /account/login');
}

$config = $core->getConfig();

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
    <title><?=$config['site']['name']?></title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light py-3">
            <div class="container">
                <a class="navbar-brand fw-bold" href="/"><?=$config['site']['name']?></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
                    <form class="d-flex w-auto mb-md-0">
                        <div class="input-group">
                            <input autocomplete="off" type="search" name="query" class="form-control" required placeholder="Поиск" />
                            <button type="submit" class="input-group-text btn btn-primary border-0">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                    <div class="d-flex justify-content-center justify-content-md-end align-items-center my-3 my-md-0">
                        <div class="d-flex top-buttons">
                            
                            <a class="text-reset me-3" href="/cart" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Корзина">
                                <i class="fa-duotone fa-cart-shopping"></i>
                            </a>
                            <a class="text-reset me-3" href="/account" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Профиль">
                                <i class="fa-duotone fa-user"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <section class="py-3">
            <div class="container"></div>
        </section>
    </main>
    <footer class="text-center text-lg-start">
        <section class="py-4">
            <div class="container text-center text-md-start">
                <div class="d-flex justify-content-between">
                    <div class="footer-item"> <a class="footer-link" href="/horses">Лошади</a> </div>
                </div>
            </div>
        </section>
    </footer>

    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript">

        let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        let tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        })

        $("#feedback-send").on("click", function() {
            let phone = $("#feedback-phone").val();
            let re = /^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?$/;

            if (!re.test(phone)) {
                return $("#feedback-phone").addClass("invalid");
            } else {
                $("#feedback-phone").removeClass("invalid");
            }

            let name = $("#feedback-name").val();
            let text = $("#feedback-text").val();

            $.ajax({
                type: "POST",
                url: "/handler",
                dataType: 'html',
                data: {
                    'method': 'feedback.send',
                    'params': {
                        'phone': phone,
                        'name': name,
                        'text': text
                    }
                },
                success: function(data) {
                    response = JSON.parse(data);
                    if (response.ok) {
                        $("#feedback-name").val("");
                        $("#feedback-phone").val("");
                        $("#feedback-text").val("");
                        $("#feedback-success").fadeIn(100);

                        return;
                    }
                }
            });
        });
    </script>
</body>
</html>