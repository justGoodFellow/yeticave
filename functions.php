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
