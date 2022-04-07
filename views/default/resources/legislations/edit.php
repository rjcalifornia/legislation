<?php
/**
 * Add bookmark page
 *
 * @package Elggproposals
 */
use Elgg\Exceptions\Http\EntityNotFoundException;
elgg_gatekeeper();

$entity_guid = elgg_extract('guid', $vars);
$entity = get_entity($entity_guid);

 
elgg_require_js("legislations/select2");
elgg_require_js("legislations/format"); 

$page_owner = elgg_get_page_owner_entity();

$title = elgg_echo('legislation:edit');
elgg_push_breadcrumb($title);

$vars = legislations_prepare_form_vars($entity);

$content = elgg_view_form('legislation/save', array(), $vars);



$body = elgg_view_layout('content', array(
	'filter' => '',
	'content' => $content,
	'title' => $title,
));

echo elgg_view_page($title, $body);