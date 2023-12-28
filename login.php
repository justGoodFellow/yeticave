<?php
require_once('functions.php');
require_once('data.php');
require_once('userdata.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$form = $_POST;
	$required = ['email', 'password'];
	$errors = [];

	foreach ($required as $key) {
		if ($key === 'email') {
			if (empty($form[$key])) {
				$errors[$key] = 'Введите e-mail';
			} elseif (!filter_var($form[$key], FILTER_VALIDATE_EMAIL)) {
				$errors[$key] = 'Введите корректный email';
			}
		} elseif ($key === 'password') {
			if (empty($form[$key])) {
				$errors[$key] = 'Введите пароль';
			}
		}
	}

	if (empty($errors['email'])) {
		if ($user = search_user_by_email($form['email'], $users)) {
			if (empty($errors['password'])) {
				if (password_verify($form['password'], $user['password'])) {
					$_SESSION['user'] = $user;
				} else {
					$errors['password'] = 'Неверный пароль';
				}
			}
		} else {
			$errors['email'] = 'Такой пользователь не найдет';
		}
	}

	if (count($errors)) {
		$page_content = include_template('templates/login.php', [
			'errors' => $errors,
		]);
	} else {
		header('Location: /index.php');
		exit();
	}
} else {
	$page_content = include_template('templates/login.php', []);
}

$layout_content = include_template('templates/layout.php', [
	'content' => $page_content,
	'categories' => $categories,
	'title' => 'Вход',
]);

print($layout_content);
