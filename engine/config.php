<?php

$config = array(
	'site' => array(
		'name' => 'Люкс',
		'phone' => '+7 (495) 123-12-12',
		'email' => 'conatct@lombard.ru',
		'footer_description' => 'Помогаем быстро, просто и безопасно продавать и покупать украшения на вторичном рынке. Выдаем займы под залог ювелирных изделий.'
	),
	'db' => array(
		'host' 		=> '127.0.0.1',
		'user' 		=> 'root',
		'password' 	=> '',
		'name' 		=> 'pawnshop'
	),

	'menu' => array(
		array(
			'title' => 'Скупка',
			'url' => '/sell'
		),
		array(
			'title' => 'Каталог',
			'url' => '/catalog'
		),
		array(
			'title' => 'О нас',
			'url' => '/about'
		),
		array(
			'title' => 'Филиалы',
			'url' => '/branches'
		),
	),

	'menu_admin' => array(
		array(
			'title' => 'Каталог',
			'url' => '/admin/catalog'
		),
		array(
			'title' => 'Заказы',
			'url' => '/admin/orders'
		),
		array(
			'title' => 'Заявки',
			'url' => '/admin/consultation'
		),
		array(
			'title' => 'Филиалы',
			'url' => '/admin/branches'
		),
	)
);