<?php
require_once('functions.php');
require_once('data.php');

if (isset($_COOKIE['viewed_lots_ids'])) {
	$viewed_lots_ids = json_decode($_COOKIE['viewed_lots_ids'], true);
	$lots_ids_indexes = array_column($lots, 'id');

	foreach ($viewed_lots_ids as $viewed_lots_id) {
		$viewed_lot_index = array_search($viewed_lots_id, $lots_ids_indexes);
		$viewed_lots[] = $lots[$viewed_lot_index];
	}
}

$page_content = include_template('templates/history.php', [
	'viewed_lots' => $viewed_lots,
	'lot_time_remaining' => $lot_time_remaining,
]);

$layout_content = include_template('templates/layout.php', [
	'content' => $page_content,
	'categories' => $categories,
	'title' => 'История просмотров',
]);

print($layout_content);
