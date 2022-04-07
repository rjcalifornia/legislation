<?php

$page_type = elgg_extract('page_type', $vars);
$guid = elgg_extract('guid', $vars);

elgg_entity_gatekeeper($guid, 'object', 'legislations');
//elgg_group_gatekeeper();

$entity = get_entity($guid);
//elgg_extend_view('page/elements/head', 'extras/scripts');

elgg_set_page_owner_guid($entity->container_guid);

// no header or tabs for viewing an individual entity
$params = [
	'filter' => '',
	'title' => $entity->title
];

$container = $entity->getContainerEntity();
$crumbs_title = $container->name;



//elgg_push_breadcrumb($entity->title);
//elgg_push_entity_breadcrumbs($entity, false);
elgg_push_collection_breadcrumbs('object', 'legislations');
$params['content'] = elgg_view_entity($entity, array('full_view' => true, 
                                                      //  'twig'=> $vars['twig']
                                                    ));




$params['sidebar'] = elgg_view('custom/legislations/sidebar', [
					'page' => $page_type,

				]);

$body = elgg_view_layout('content', $params);

echo elgg_view_page($params['title'], $body);
