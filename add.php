<?php
require_once('functions.php');
require_once('data.php');

session_start();

if (!isset($_SESSION['user'])) {
	http_response_code(403);

	die();
}

$title = 'Добавление лота';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$required = ['name', 'category', 'message', 'price', 'lot-step', 'lot-date'];
	$errors = [];
	$lot = $_POST;

	foreach ($required as $key) {
		if (empty($_POST[$key])) {
			$errors[$key] = 'Заполните это поле';
		} elseif ($key === 'price' || $key === 'lot-step') {
			if (!is_numeric($_POST[$key])) {
				$errors[$key] = 'Допустимы только цифры';
			}
		}
	}

	if ($_FILES['lot-picture']['error'] === 0) {
		$file_info = finfo_open(FILEINFO_MIME_TYPE);
		$tmp_name = $_FILES['lot-picture']['tmp_name'];
		$file_type = finfo_file($file_info, $tmp_name);

		if ($file_type === 'image/jpeg') {
			$path = $_FILES['lot-picture']['name'];
			move_uploaded_file($tmp_name, 'img/' . $path);
			$lot['url'] = 'img/' . $path;
		} else {
			$errors['file'] = 'Загрузите изображение в формате jpeg';
		}
	} else {
		$errors['file'] = 'Вы не загрузили изображение';
	}

	if (empty($errors)) {
		$title = $lot['name'];
		$page_content = include_template('templates/lot.php', ['lot' => $lot]);
	} else {
		$page_content = include_template('templates/add.php', [
			'categories' => $categories,
			'errors' => $errors,
		]);
	}
} else {
	$page_content = include_template('templates/add.php', [
		'categories' => $categories,
	]);
}

$layout_content = include_template('templates/layout.php', [
	'content' => $page_content,
	'categories' => $categories,
	'title' => $title,
]);

print($layout_content);
