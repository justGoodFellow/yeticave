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

if (isset($_GET['lot_id'])) {
	$lot_id = $_GET['lot_id'];

	foreach ($lots as $item) {
		if ($item['id'] == $lot_id) {
			$lot = $item;

			if (isset($_COOKIE['viewed_lots_ids'])) {
				$viewed_lots_ids_value = json_decode($_COOKIE['viewed_lots_ids'], true);

				if (!in_array($lot_id, $viewed_lots_ids_value)) {
					$viewed_lots_ids_value[] = $lot_id;
				}

				$viewed_lots_ids_value = json_encode($viewed_lots_ids_value);
			} else {
				$viewed_lots_ids_value[] = $lot_id;
				$viewed_lots_ids_value = json_encode($viewed_lots_ids_value);
			}

			break;
		}
	}
}

if (!$lot) {
	http_response_code(404);

	die();
}

$viewed_lots_ids_name = 'viewed_lots_ids';
$viewed_lots_ids_value;
$expire = strtotime('+30 days');
$path = '/';

setcookie($viewed_lots_ids_name, $viewed_lots_ids_value, $expire, $path);

$page_content = include_template('templates/lot.php', [
	'lot' => $lot,
]);

$layout_content = include_template('templates/layout.php', [
	'content' => $page_content,
	'categories' => $categories,
	'title' => $lot['name'],
]);

print($layout_content);
