<?php

require '../engine/core.class.php';
require '../engine/db.class.php';

$core = new core();
 
// Название <input type="file">
$input_name = 'file';
 
// Разрешенные расширения файлов
$allow = array();
 
// Запрещенные расширения файлов
$deny = array(
	'phtml', 'php', 'php3', 'php4', 'php5', 'php6', 'php7', 'phps', 'cgi', 'pl', 'asp', 
	'aspx', 'shtml', 'shtm', 'htaccess', 'htpasswd', 'ini', 'log', 'sh', 'bat', 'js', 'html', 
	'htm', 'css', 'sql', 'spl', 'scgi', 'fcgi', 'exe'
);
 
// Директория куда будут загружаться файлы
$path = '../uploads/';

$error = $success = '';

if (!isset($_FILES[$input_name])) {
	$error = 'Файл не загружен.';
	file_put_contents('a.txt', json_encode($_FILES, JSON_UNESCAPED_UNICODE));
} else {
	$file = $_FILES[$input_name];
 
	// Проверим на ошибки загрузки
	if (!empty($file['error']) || empty($file['tmp_name'])) {

		$error = 'Не удалось загрузить файл.';

	} elseif ($file['tmp_name'] == 'none' || !is_uploaded_file($file['tmp_name'])) {

		$error = 'Не удалось загрузить файл.';

	} else {

		// Оставляем в имени файла только буквы, цифры и некоторые символы.
		$pattern = '[^a-zа-яё0-9,~!@#%^-_\$\?\(\)\{\}\[\]\.]';
		$name = mb_eregi_replace($pattern, '-', $file['name']);
		$name = mb_ereg_replace('[-]+', '-', $name);
		$parts = pathinfo($name);
 
		if (empty($name) || empty($parts['extension'])) {

			$error = 'Недопустимый тип файла';

		} elseif (!empty($allow) && !in_array(strtolower($parts['extension']), $allow)) {

			$error = 'Недопустимый тип файла';

		} elseif (!empty($deny) && in_array(strtolower($parts['extension']), $deny)) {

			$error = 'Недопустимый тип файла';

		} else {

			$name = $core->generateHash(10);
			$ext = strtolower($parts['extension']);
			$filename = $path . $name.'.'.$ext;

			if(@is_array(getimagesize($file['tmp_name']))) {
				$ext = 'webp';
				$core->compress($file['tmp_name'], $path . $name.'.'.$ext, 90);
				$ok = true;
			} else {
				if (move_uploaded_file($file['tmp_name'], $filename)) {
					$ok = true;
				} else {
					$ok = false;
				}
			}
		}
	}
}
 
// Вывод сообщения о результате загрузки
if (!$ok) {
	exit(
		json_encode(
			array(
				'ok' => false
			),
			JSON_UNESCAPED_UNICODE
		)
	);  
}
 
exit(
	json_encode(
		array(
			'ok' => true,
			'path' => '/uploads/'.$name.'.'.$ext,
			'filename' => $name.'.'.$ext,
			'name' => $name,
			'ext' => $ext,
			'size' => $file['size']
		),
		JSON_UNESCAPED_UNICODE
	)
);
 
header('Content-Type: application/json');
echo json_encode($data, JSON_UNESCAPED_UNICODE);
exit();