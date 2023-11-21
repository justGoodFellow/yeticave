<?php
require_once('functions.php');
require_once('data.php');

// устанавливаем часовой пояс в Московское время
date_default_timezone_set('Europe/Moscow');

// записать в эту переменную оставшееся время в этом формате (ЧЧ:ММ)
$lot_time_remaining = '00:00';

// временная метка для полночи следующего дня
$tomorrow = strtotime('tomorrow midnight');

// временная метка для настоящего времени
$now = time();

// далее нужно вычислить оставшееся время до начала следующих суток и записать его в переменную $lot_time_remaining
$lot_time_remaining = gmdate('H:i', $tomorrow - $now);

// Массив категорий
$categories = ['Доски и лыжи', 'Крепления', 'Ботинки', 'Одежда', 'Инструменты', 'Разное'];

$page_content = include_template('templates/index.php', [
	'lots' => $lots,
	'lot_time_remaining' => $lot_time_remaining
]);
$layout_content = include_template('templates/layout.php', [
	'content' => $page_content,
	'categories' => $categories,
	'title' => 'Главная'
]);

print($layout_content);
