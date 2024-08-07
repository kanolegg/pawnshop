<?php

include '../engine/core.class.php';
include '../engine/db.class.php';
$core = new core();

$config = $core->getConfig();
$menu = $core->menu('menu');

if (isset($_GET['act']) && $_GET['act'] === 'logout') {
    $core->logout($_COOKIE['CSRF_TOKEN']);
    header('Location: /account/login');
}

if (isset($_COOKIE['CSRF_TOKEN']) && isset($_SESSION['secret'])) {
    if ($core->checkAuth($_COOKIE['CSRF_TOKEN']))
        header('Location: /admin/');
}

$error = false;

if (isset($_POST['login'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    $userdata = $core->userGet($email);
    if ($userdata) {
        if ($core->isValidPassword($password, $userdata['password'])) {
            $secret = $core->generateHash(8);
            $salt = $core->generateHash(8);
            $token = $salt . ':' . md5($salt . ':' . $secret);

            $core->sessionCreate($userdata['id'], $token, ip2long($_SERVER['REMOTE_ADDR']));

            $_SESSION['secret'] = $secret;
            setcookie('CSRF_TOKEN', $token, time()+60*60*24*30, '/');
            header('Location: /admin/');
        } else {
            $error = 'Неверный пароль';
        }
    } else {
        $error = 'Пользователь не найден';
    }
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
    <title>Вход / <?=$config['site']['name']?></title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
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
            <div class="container d-flex justify-content-center">
                <div class="border rounded p-3 bg-white shadow box-area col-md-6 mt-md-5">
                    <form method="POST">
                        <div class="header-text mb-4">
                            <h2>Вход</h2>
                        </div>
                        <?php if ($error):?>
                            <div class="alert alert-danger"><?=$error?></div>
                        <?php endif;?>
                        <div class="input-group mb-3">
                            <input type="email" name="email" class="form-control form-control-lg bg-light fs-6" placeholder="Email">
                        </div>

                        <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control form-control-lg bg-light fs-6" placeholder="Пароль">
                        </div>

                        <div class="mb-3">
                            <button type="submit" name="login" class="btn btn-lg btn-primary w-100 fs-6">Войти</button>
                        </div>
                        
                        <!-- <div class="row">
                            <small>Нет аккаунта? <a href="/account/register">Регистрация</a></small>
                        </div> -->
                    </form>
                </div>
            </div>
        </section>
    </main>

    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript">

        let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        let tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    </script>
</body>
</html>