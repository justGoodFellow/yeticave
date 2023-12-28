<?php

// Шаблонизатор
function include_template($path, $data = [])
{
	if (file_exists($path)) {
		extract($data);

		ob_start();

		include($path);

		return ob_get_clean();
	} else {
		return '';
	}
}

// Форматирует цену
function formatPrice($price)
{
	$price = ceil($price);

	if ($price >= 1000) {
		$price = number_format($price, 0, '.', ' ');
	}

	return $price . ' ₽';
}

// Ищет пользователя по email
function search_user_by_email($email, $users)
{
	$result = null;

	foreach ($users as $user) {
		if ($user['email'] === $email) {
			$result = $user;
			break;
		}
	}

	return $result;
}
