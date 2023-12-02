<?php
require_once('functions.php');
require_once('data.php');

$page_content = include_template('templates/index.php', [
	'lots' => $lots,
	'lot_time_remaining' => $lot_time_remaining,
]);
$layout_content = include_template('templates/layout.php', [
	'content' => $page_content,
	'categories' => $categories,
	'title' => 'Главная',
]);

print($layout_content);
