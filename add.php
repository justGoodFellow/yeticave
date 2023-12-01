<?php
require_once('functions.php');
require_once('data.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$required = ['lot-name', 'category', 'message', 'lot-rate', 'lot-step', 'lot-date'];
	$errors = [];
	$lot = $_POST;

	foreach ($required as $key) {
		if (empty($_POST[$key])) {
			$errors[$key] = 'Заполните это поле';
		} elseif ($key === 'lot-rate' || $key === 'lot-step') {
			if (!is_numeric($_POST[$key])) {
				$errors[$key] = 'Допустимы только цифры';
			}
		}
	}

	if (!empty($_FILES['lot-picture']['name'])) {
		$path = $_FILES['lot-picture']['name'];
		move_uploaded_file($_FILES['lot-picture']['tmp_name'], 'img/' . $path);
		$lot['url'] = 'img/' . $path;
	} else {
		$errors['file'] = 'Вы не загрузили изображение';
	}

	if (empty($errors)) {
		$page_content = include_template('templates/lot.php', ['lot' => $lot]);
	} else {
		$page_content = include_template('templates/add.php', [
			'categories' => $categories,
			'errors' => $errors
		]);
	}
} else {
	$page_content = include_template('templates/add.php', [
		'categories' => $categories
	]);
}

$layout_content = include_template('templates/layout.php', [
	'content' => $page_content,
	'categories' => $categories,
	'title' => 'Главная'
]);

print($layout_content);
