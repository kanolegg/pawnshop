<?php

include 'engine/core.class.php';
include 'engine/db.class.php';

$core = new core();

if (!isset($_POST['method']))
	exit(json_encode(
		array(
			'ok' => false,
			'message' => 'Method not passed'
		),
		JSON_UNESCAPED_UNICODE
	));
else
	$method = $_POST['method'];

if (isset($_COOKIE['CSRF_TOKEN']) && isset($_SESSION['secret'])) {
    $check = $core->checkAuth($_COOKIE['CSRF_TOKEN']);
}

if (isset($_POST['params'])) $params = $_POST['params'];

if ($method === 'consultation.request') {
	$name = htmlspecialchars($params['name']);
	$phone = htmlspecialchars($params['phone']);

	$core->add('consultation', ['name' => '\''.$name.'\'', 'phone' => '\''.$phone.'\'', 'time' => '\''.$_SERVER['REQUEST_TIME'].'\'']);

	exit(
		json_encode(
			array(
				'ok' => true,
				'message' => 'Ваша заявка зарегистрирована! Наш менеджер скоро свяжется с вами.'
			),
			JSON_UNESCAPED_UNICODE
		)
	);
} else if ($method === 'product.delete') {
	$id = htmlspecialchars($params['id']);

	$core->delete('products', $id);

	exit(
		json_encode(
			array(
				'ok' => true,
				'message' => 'Продукт удалён.'
			),
			JSON_UNESCAPED_UNICODE
		)
	);
} else if ($method === 'cart.add') {
	$product_id = $params['product_id'];
	$amount = $params['amount'];

	$cart = json_decode($_COOKIE['cart'], true);

	$cart[$product_id] = $amount;

	setcookie(
		'cart',
		json_encode(
			$cart
		),
		$_SERVER['REQUEST_TIME']+60*60*24*7,
		'/'
	);

	exit(json_encode(['ok'=>true], JSON_UNESCAPED_UNICODE));
} else if ($method === 'cart.remove') {
	$product_id = $params['product_id'];

	$cart = json_decode($_COOKIE['cart'], true);

	unset($cart[$product_id]);

	setcookie(
		'cart',
		json_encode(
			$cart
		),
		$_SERVER['REQUEST_TIME']+60*60*24*7,
		'/'
	);

	exit(json_encode(['ok'=>true], JSON_UNESCAPED_UNICODE));
} else if ($method === 'branch.delete') {
	$id = htmlspecialchars($params['id']);

	$core->delete('branches', $id);

	exit(
		json_encode(
			array(
				'ok' => true,
				'message' => 'Филиал удалён.'
			),
			JSON_UNESCAPED_UNICODE
		)
	);
} 