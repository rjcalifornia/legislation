<?php
/**
 * Add bookmark page
 *
 * @package Bookmarks
 */

use Elgg\Exceptions\Http\EntityPermissionsException;

$guid = elgg_extract('guid', $vars);
if (!$guid) {
	$guid = elgg_get_logged_in_user_guid();
}

$container = get_entity($guid);

elgg_import_esm("legislations/select2");

elgg_import_esm("legislations/format");

elgg_entity_gatekeeper($guid);

$page_owner = elgg_get_page_owner_entity();


// Make sure user has permissions to add to container
if (!$container->canWriteToContainer(0, 'object', 'legislations')) {
	throw new EntityPermissionsException();
}

$title = elgg_echo('legislation:add');
elgg_push_breadcrumb($title);
$form_vars = ['enctype' => 'multipart/form-data'];
$vars = legislations_prepare_form_vars();

$content = elgg_view_form('legislation/save', $form_vars, $vars);
//$content = '3333';
$body = elgg_view_layout('content', [
	'filter' => '',
	'content' => $content,
	'title' => $title,
	
]);

echo elgg_view_page($title, $body);