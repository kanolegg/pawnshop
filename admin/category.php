<?php

include '../engine/core.class.php';
include '../engine/db.class.php';
$core = new core();

$config = $core->getConfig();
$menu = $core->menu('menu_admin');

if (!isset($_GET['category'])) {
	header('Location: /admin/catalog');
}

$category = $_GET['category'];

$categories = [
	'rings' => 'Кольца',
	'earrings' => 'Серьги',
	'chains' => 'Цепочки',
	'pendant' => 'Подвески',
	'bracelets' => 'Браслеты',
	'cufflinks' => 'Запонки',
	'watch' => 'Часы'
];

$products = $core->get('products', ['category' => $category]);

?>
<html class="h-100">
	<head>
		<meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="keywords" content="">

	    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
	    <link rel="stylesheet" href="/assets/fontawesome-pro-6.1.0-web/css/all.min.css">
	    <link rel="stylesheet" href="/assets/css/style.css?=<?=$_SERVER['REQUEST_TIME']?>">

	    <title><?=$categories[$category]?> / <?=$config['site']['name']?></title>
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
					
					<div class="d-flex align-items-center justify-content-between mb-3">
						<div class="d-flex align-items-center">
		                    <a href="/admin/catalog" class="badge badge-light">
		                        <i class="fa-regular fa-arrow-left"></i>
		                        Назад
		                    </a>
		                    <h1 class="ms-1 mb-0"><?=$categories[$category]?></h1>
		                </div>
		                <a href="/admin/product" class="btn btn-primary">Добавить</a>
					</div>
					<div class="rounded shadow-sm border p-3" id="content">
						<?php if ($products):?>
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr>
											<th>Фото</th>
											<th>Название</th>
											<th>Цена</th>
											<th></th>
										</tr>
									</thead>
									<tbody id="products">
										<?php foreach ($products as $product):?>
											<tr id="product-<?=$product['id']?>">
												<td>
													<?php if ($product['image']):?>
														<img src="<?=$product['image']?>" alt="<?=$product['title']?>" style="width: 4rem;">
													<?php else:?>
														<img src="/assets/img/placeholder.jpg" alt="<?=$product['title']?>" style="width: 4rem;">
													<?php endif;?>
												</td>
												<td>
													<a href="/admin/product/<?=$product['id']?>" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Перейти"><?=$product['title']?></a>
												</td>
												<td><?=number_format($product['price'], 0, ',', ' ')?> ₽</td>
												<td>
													<div class="d-flex" style="gap: 1rem;">
														<a href="/admin/product/<?=$product['id']?>" class="text-primary"><i class="fa-solid fa-arrow-up-right-from-square" data-bs-toggle="tooltip" data-bs-placement="top" title="Перейти"></i></a>
														<a href="javascript:void(0);" class="text-danger delete" data-id="<?=$product['id']?>" data-bs-toggle="modal" data-bs-target="#delete-modal"><i class="fa-solid fa-trash-can" data-bs-toggle="tooltip" data-bs-placement="top" title="Удалить"></i></a>
													</div>
												</td>
											</tr>
										<?php endforeach;?>
									</tbody>
								</table>
							</div>
						<?php else:?>
							<p class="mb-0">В этой категории ещё нет товаров</p>
						<?php endif;?>
					</div>
				</div>
			</section>
		</main>
		<div class="modal fade" id="delete-modal" tabindex="-1" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Подтверждение</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="delete-id">
						<span>Вы действительно хотите удалить этот товар?</span>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
						<button type="button" class="btn btn-primary" id="delete-product">Удалить</button>
					</div>
				</div>
			</div>
		</div>

		<div class="toast-container position-fixed end-0 bottom-0 p-3" id="toast-container" aria-live="polite" aria-atomic="true"></div>

		<script src="/assets/js/bootstrap.bundle.min.js"></script>
    	<script src="/assets/js/jquery-3.3.1.min.js"></script>
    	<script src="/assets/js/jquery.loadTemplate.min.js"></script>
    	<script type="text/html" id="toast-template">
	        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true">
				<div class="toast-header">
					<i class="fas fa-check fa-lg me-2"></i>
					<strong class="me-auto"><?=$config['site']['name']?></strong>
					<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
				</div>
				<div data-content="text" class="toast-body"></div>
			</div>
	    </script>
    	<script>
			let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
			let tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
				return new bootstrap.Tooltip(tooltipTriggerEl);
			});

			$("#delete-product").on("click", function() {
				let id = $("#delete-id").val();

				$.ajax({
	                url: '/handler',
	                method: 'post',
	                dataType: 'html',
	                data: {
	                    'method': 'product.delete',
	                    'params': {
	                    	'id': $("#delete-id").val()
	                    }
	                },
	                success: function(response) {
	                	console.log(response)
	                    response = JSON.parse(response);
	                    if (response.ok) {
	                    	$("#product-"+id).remove();

							$("#delete-modal").modal("toggle");

							if ($("#products").children().length === 0) {
								$("#content").empty();

								$("<span>", {"class": "text-center"}).text("Авторов ещё нет").appendTo("#content");
							}

							$(".toast-container").loadTemplate($("#toast-template"), {text: response.message}, {append: true});

						  	let bootstrapToast = new bootstrap.Toast($("#toast-container").children().last());
						  	bootstrapToast.show();
	                    }
	                }
	            });
			});

			$("#delete-modal").on("show.bs.modal", function(e) {
			  	$("#delete-id").val($(e.relatedTarget).data('id'));
			});
    	</script>
	</body>
</html>