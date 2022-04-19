<?php
$site_url = elgg_get_site_url();
$twig = elgg_legislation_twig();


 $options = [
	'type' => 'object',
	'subtype' => 'legislations',
	'threshold' => 0,
	'limit' => elgg_extract('limit', $vars, 50),
	'tag_name' => 'tags',
];

$tag_data = elgg_get_tags($options);


$cloud = elgg_view("custom/legislations/trending", [
	'value' => $tag_data,
	'type' => 'object',
	
]);
$title = null;
$trending = new \Twig\Markup(elgg_view_module('aside', $title, $cloud),'UTF-8');

 
 $data['site_url'] = $site_url;
 $data['trending'] = $trending;



echo $twig->render('legislation/layouts/all_sidebar.html.twig', 
    [
        'data' => $data,
    ]);