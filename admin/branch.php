<?php

include '../engine/core.class.php';
include '../engine/db.class.php';
$core = new core();

$config = $core->getConfig();
$menu = $core->menu('menu_admin');

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$branch = $core->get('branches', ['id' => $id])[0];

	$title = $branch['address'];
} else {
	$title = 'Новый филиал';
}

if (isset($_POST) && !empty($_POST)) {
	$address = $_POST['address'];
	$text = $_POST['text'];
	$image = $_POST['image'];

	if (isset($id)) {
		$core->update('branches', $_POST['id'], [
			'address' => '\''.$address.'\'',
			'text' => '\''.$text.'\'',
			'image' => '\''.$image.'\''
		]);
	} else {
		$core->add('branches', [
			'address' => '\''.$address.'\'',
			'text' => '\''.$text.'\'',
			'image' => '\''.$image.'\''
		]);
	}

	header('Location: /admin/branches');
}

?>
<html class="h-100">
	<head>
		<meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="keywords" content="">

	    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
	    <link rel="stylesheet" href="/assets/fontawesome-pro-6.1.0-web/css/all.min.css">
	    <link rel="stylesheet" href="/assets/css/style.css?=<?=$_SERVER['REQUEST_TIME']?>">

	    <title><?=$title?> / <?=$config['site']['name']?></title>
	</head>
	<body class="d-flex flex-column h-100">
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
					<div class="d-flex align-items-center mb-3">
	                    <a href="<?=$_SERVER['HTTP_REFERER']?>" class="badge badge-light">
	                        <i class="fa-regular fa-arrow-left"></i>
	                        Назад
	                    </a>
	                    <h1 class="ms-1 mb-0"><?=$title?></h1>
	                </div>
					<div class="rounded shadow-sm border p-3" id="content">
						<form method="POST" class="row g-3">
							<div class="col-md-6">
								<input type="text" class="form-control" placeholder="Адрес" autocomplete="off" required name="address" value="<?=@$branch['address']?>">
							</div>
							<div class="col-md-6">
								<input type="text" class="form-control" placeholder="Описание" autocomplete="off" required name="text" value="<?=@$branch['text']?>">
							</div>
							<div class="col-12">
								<input type="file" name="image" class="form-control" id="image-input" accept=".jpg,.png,.jpeg,.gif,.webp">
                        		<input type="hidden" id="image" name="image" value="<?=@$branch['image']?>">
							</div>
							<h4 class="mt-3">Изображение</h4>
							<div class="row">
								<div class="col-md-4">
									<div class="mt-0" id="image-wrapper">
										<?php if ($branch['image']):?>
			                                <div class="">
			                                    <img src="<?=$branch['image']?>" alt="<?=$branch['title']?>" class="w-100 rounded">
			                                </div>

			                                <a href="javascript:void(0)" class="text-danger" id="remove-photo">Удалить фото</a>
			                            <?php endif;?>
									</div>
								</div>
							</div>
							<input type="hidden" name="id" value="<?=@$branch['id']?>">
							<div class="mt-3">
								<button type="submit" class="btn btn-primary" name="save">Сохранить</button>
							</div>
						</form>
					</div>
				</div>
			</section>
		</main>

		<script src="/assets/js/bootstrap.bundle.min.js"></script>
    	<script src="/assets/js/jquery-3.3.1.min.js"></script>
    	<script>
			let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
			let tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
				return new bootstrap.Tooltip(tooltipTriggerEl);
			});

			$("#image-input").change(function() {
	            let fd = new FormData();

	            fd.append('file', $('#image-input')[0].files[0]);

	            $.ajax({
	                url: '/admin/upload',
	                type: 'post',
	                data: fd,
	                contentType: false,
	                processData: false,
	                dataType: 'json',
	                success: function(data) {
	                    $("#image-wrapper").empty();

	                    $("#image").val(data.path);

	                    $("<img>", {"src": data.path, "class": "w-100 rounded"}).appendTo("#image-wrapper");

	                    $("<a>", {"href": "javascript:void(0)", "class": "text-danger", "id": "remove-photo"}).text("Удалить фото").insertAfter("#image-wrapper");
	                }
	            });
	        });

	        $("body").on("click", "#remove-photo", function() {
	            $("#image").val("");

	            $("#image-wrapper").empty();

	            $("#remove-photo").remove();
	        });
    	</script>
	</body>
</html>