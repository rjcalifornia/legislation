<?php

$title = elgg_extract('title', $vars, '');
$desc = elgg_extract('description', $vars, '');
$summary = elgg_extract('summary', $vars, '');

$twig = elgg_legislation_twig();

$data['hidden_guid_input'] = '';
$guid = elgg_extract('guid', $vars, null);

if ($guid) {
	$hiddenGuid = elgg_view('input/hidden', array('name' => 'guid', 'value' => $guid));
	$data['hidden_guid_input'] = new \Twig\Markup($hiddenGuid, 'UTF-8');
	
}

$access_id = elgg_extract('access_id', $vars, ACCESS_DEFAULT);
$container_guid = elgg_extract('container_guid', $vars);


$data['title_label'] = elgg_echo('legislations:add:title');
$data['title_input'] = new \Twig\Markup(elgg_view('input/text', ['name' => 'title', 'value' => $title]), 'UTF-8');

$data['summary_label'] = elgg_echo('legislation:add:summary');
$data['summary_input'] = new \Twig\Markup(elgg_view('input/plaintext', ['name' => 'summary', 'value' => $summary]), 'UTF-8');

$data['description_label'] = elgg_echo('legislation:add:text');
$data['description_input'] = new \Twig\Markup(elgg_view('input/longtext', ['name' => 'description', 'value' => $desc]), 'UTF-8');


$tagsInput = elgg_view('input/tags', [
	'name' => 'tags',
	'id' => 'legislation_tags',
	'value' => $vars['tags']
]);


$data['tags_label'] = elgg_echo('tags');
$data['tags_input'] = new \Twig\Markup($tagsInput, 'UTF-8');


echo $twig->render('legislation/forms/add-new.html.twig', 
        [
            'data' => $data,
        ]);
/*


$scopeOperationList = [
   'All city' => elgg_echo('scope:one') ,
   'Central District' => elgg_echo('scope:two') ,
];







$externalVideoLabel = elgg_echo('proposals:add:external_video');
$externalVideoInput = elgg_view('input/text', array('name' => 'external_video', 'id'=>'external_video', 'value' => $externalVideo));


$videoType = elgg_view('input/text', array(
	'name' => 'external_video_type',
	'id' => 'external_video_type',
	'hidden' => true,
	'value' => $videoTypeValue,
));


$descriptiveImageLabel = elgg_echo('proposals:add:descriptive_image');
$descriptiveImageInput = elgg_view('input/file', array(
	'id' => 'descriptive_image',
	'name' => 'descriptive_image',
        'label' => 'Select a descriptive image',
        'help' => 'Only jpeg, png and png images are supported',
        'required' => false,
));


$proposalsDocumentsLabel = elgg_echo('proposals:add:documents');
$proposalsDocumentsInput = elgg_view('input/file', array(
	'id' => 'proposals_documents',
	'name' => 'proposals_documents[]',
        'label' => 'Select documents to upload',
        'multiple' => true,
        'help' => 'Select up to 3 documents',
        'required' => false,
));



$scopeLabel = elgg_echo('proposals:add:scope');
$scopeInput = elgg_view('input/select', array(
	'name' => 'scope_operation',
	'id' => 'scope_operation',
        'required' => true,
	'options_values' => $scopeOperationList,
'value' => $vars['scope_operation'],
));

$accessLabel = elgg_echo('access');
$accessInput = elgg_view('input/access', array(
	'name' => 'access_id',
	'value' => $access_id,
	'entity' => get_entity($guid),
	'entity_type' => 'object',
	'entity_subtype' => 'simple_bills',
));

$hiddenContainer = elgg_view('input/hidden', array('name' => 'container_guid', 'value' => $container_guid));


$footer = elgg_view_field([
	'#type' => 'submit',
	'id' => 'share',
	'value' => elgg_echo('save'),
]);






$data['external_video_label'] = $externalVideoLabel;
$data['external_video_input'] = new \Twig\Markup($externalVideoInput, 'UTF-8');

$data['external_video_type'] = new \Twig\Markup($videoType, 'UTF-8');

$data['access_label'] = $accessLabel;
$data['access_input'] = new \Twig\Markup($accessInput, 'UTF-8');

$data['descriptive_image_label'] = $descriptiveImageLabel;
$data['descriptive_image_input'] = new \Twig\Markup($descriptiveImageInput, 'UTF-8');


$data['proposals_documents_label'] = $proposalsDocumentsLabel;
$data['proposals_documents_input'] = new \Twig\Markup($proposalsDocumentsInput, 'UTF-8');

$data['scope_label'] = $scopeLabel;
$data['scope_input'] = new \Twig\Markup($scopeInput, 'UTF-8');




$data['hidden_container_input'] = new \Twig\Markup($hiddenContainer, 'UTF-8');

$data['footer'] = new \Twig\Markup(($footer), 'UTF-8');


echo $twig->render('forms/add-proposal.html.twig', 
        [
            'data' => $data,
        ]);*/