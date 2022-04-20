<?php


//elgg_pop_breadcrumb();
elgg_push_collection_breadcrumbs('object', 'legislations');

elgg_register_title_button('legislations', 'add', 'object', 'legislations');

$content = elgg_list_entities(array(
	'type' => 'object',
	'subtype' => 'legislations',
	'full_view' => false,
	'view_toggle_type' => false,
	'no_results' => elgg_echo('legislations:none'),
	'preload_owners' => true,
	'preload_containers' => true,
	'distinct' => false,
));

$title = elgg_echo('collection:object:legislations:all');

$sidebar = elgg_view('custom/legislations/all',  ['page' => 'all']);
/*
$body = elgg_view_layout('content', array(
	'filter_value' => 'all',
	'content' => $content,
	'title' => $title,
	'sidebar' => $sidebar,
));*/
echo elgg_view_page($title, [
	'content' => $content,
	'sidebar' => elgg_view('custom/legislations/all', ['page' => 'all']),
	'filter_value' => 'all',
]);
//echo elgg_view_page($title, $body);