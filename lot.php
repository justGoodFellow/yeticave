<?php
require_once('functions.php');
require_once('data.php');

// ставки пользователей, которыми надо заполнить таблицу
$bets = [
	['name' => 'Иван', 'price' => 11500, 'ts' => strtotime('-' . rand(1, 50) . ' minute')],
	['name' => 'Константин', 'price' => 11000, 'ts' => strtotime('-' . rand(1, 18) . ' hour')],
	['name' => 'Евгений', 'price' => 10500, 'ts' => strtotime('-' . rand(25, 50) . ' hour')],
	['name' => 'Семён', 'price' => 10000, 'ts' => strtotime('last week')]
];

$lot = null;

if (isset($_GET['lot_index'])) {
	$lot_index = $_GET['lot_index'];

	foreach ($lots as $item) {
		if (array_search($item, $lots) == $lot_index) {
			$lot = $item;
			break;
		}
	}
}

if (!$lot) {
	http_response_code(404);

	die();
}

$page_content = include_template('templates/lot.php', [
	'lot' => $lot,
]);
$layout_content = include_template('templates/layout.php', [
	'content' => $page_content,
	'categories' => $categories,
	'title' => $lot['name'],
]);

print($layout_content);
