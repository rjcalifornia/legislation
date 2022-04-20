<?php

use Elgg\Legislations\ElggGoals;

$title = elgg_extract('title', $vars, '');
$desc = elgg_extract('description', $vars, '');
$summary = elgg_extract('summary', $vars, '');
$tags = elgg_extract('tags', $vars, '');
$goals = elgg_extract('goals', $vars, '');
$endDate = elgg_extract('end_date', $vars, '');
$startDate = elgg_extract('end_date', $vars, '');

$twig = elgg_legislation_twig();

$sdg = ElggGoals::getGoals();



$data['hidden_guid_input'] = '';
$guid = elgg_extract('guid', $vars, null);

if ($guid) {
	$hiddenGuid = elgg_view('input/hidden', array('name' => 'guid', 'value' => $guid));
	$data['hidden_guid_input'] = new \Twig\Markup($hiddenGuid, 'UTF-8');
	
}


$access_id = elgg_extract('access_id', $vars, ACCESS_DEFAULT);
$container_guid = elgg_extract('container_guid', $vars);



$data['process_label'] = elgg_echo('legislations:add:process_datetime');

$data['start_date_label'] = elgg_echo('legislations:add:date_start');
$data['start_date_input'] = new \Twig\Markup(elgg_view('input/date', ['name'=>'start_date', 'value'=> $startDate]), 'UTF-8');

$data['end_date_label'] = elgg_echo('legislations:add:date_end');
$data['end_date_input'] = new \Twig\Markup(elgg_view('input/date', ['name'=>'end_date', 'value'=> $endDate]), 'UTF-8');

$data['title_label'] = elgg_echo('legislations:add:title');
$data['title_input'] = new \Twig\Markup(elgg_view('input/text', ['name' => 'title', 'value' => $title]), 'UTF-8');

$data['summary_label'] = elgg_echo('legislation:add:summary');
$data['summary_input'] = new \Twig\Markup(elgg_view('input/plaintext', ['name' => 'summary', 'value' => $summary]), 'UTF-8');

$data['description_label'] = elgg_echo('legislation:add:text');
$data['description_input'] = new \Twig\Markup(elgg_view('input/longtext', ['name' => 'description', 'value' => $desc]), 'UTF-8');




$data['project_draft_label'] = elgg_echo('legislation:add:documents');
$data['project_draft_input'] = new \Twig\Markup(elgg_view('input/file', [
                                                'id' => 'project_draft',
                                                'name' => 'project_draft',
                                                'label' => 'Select documents to upload',
                                                'multiple' => false,
                                              //  'onChange'=>'getoutput()',
                                                'help' => 'Select one draft document',
                                                'required' => (!$guid),
                                        ]), 'UTF-8');

$data['additional_documentation_label'] = elgg_echo('legislation:additional:documentation');
$data['additional_documentation_input'] = new \Twig\Markup(elgg_view('input/file', [
                                                'id' => 'additional_documentation',
                                                'name' => 'additional_documentation[]',
                                                'label' => 'Select documents to upload',
                                                'multiple' => true,
                                                'help' => 'Select up to 5 documents',
                                                'required' => false,
                                        ]), 'UTF-8');

$data['banner_label'] = elgg_echo('legislation:add:banner');
$data['banner_input'] = new \Twig\Markup(elgg_view('input/file', [
                                                'id' => 'project_banner',
                                                'name' => 'project_banner',
                                                'label' => 'Select a banner image (Optional)',
                                                'multiple' => false,
                                                'help' => 'If empty, a placeholder image will be used instead',
                                                'required' => false,
                                        ]), 'UTF-8');


$data['sdg_label'] = elgg_echo('legislation:add:sdg');
$data['sdg_input'] =  new \Twig\Markup(elgg_view('input/select', array(
                                'name' => 'legislation_sdg',
                                'id' => 'legislation_sdg',
                                'required' => true,
                                'options_values' => $sdg,
                                'value' => $vars['goals'],
                                'class' => 'js-goals-single selection-sdg',
                                'multiple' => true,
                        )), 'UTF-8');


$data['tags_label'] = elgg_echo('tags');
$data['tags_input'] = new \Twig\Markup(elgg_view('input/tags', [
                                                    'name' => 'tags',
                                                    'id' => 'legislation_tags',
                                                    'value' => $tags
                                                ]), 'UTF-8');

                                        
        
$data['status_label'] = elgg_echo('status');
$data['status_input']  = new \Twig\Markup( elgg_view('input/select', [
                'name' => 'status',
                'id' => 'legislation_status',
                'value' => elgg_extract('status', $vars),
                'options_values' => [
			'draft' => elgg_echo('status:draft'),
			'published' => elgg_echo('status:published'),
                ]
        ]),'UTF-8');

$data['access_label'] = elgg_echo('access');
$data['access_input']  = new \Twig\Markup( elgg_view('input/access', [
                                                        'name' => 'access_id',
                                                        'value' => $access_id,
                                                        'entity' => get_entity($guid),
                                                        'entity_type' => 'object',
                                                        'entity_subtype' => 'legislations',
                                                    ]),'UTF-8');



$data['hidden_container_input'] = new \Twig\Markup(elgg_view('input/hidden', [
                                                                'name' => 'container_guid', 
                                                                'value' => $container_guid
                                                            ]), 'UTF-8');

$data['footer'] = new \Twig\Markup((elgg_view_field([
                        '#type' => 'submit',
                        'id' => 'share',
                        'value' => elgg_echo('save'),
                    ])), 'UTF-8');




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





$scopeLabel = elgg_echo('proposals:add:scope');
$scopeInput = elgg_view('input/select', array(
	'name' => 'scope_operation',
	'id' => 'scope_operation',
        'required' => true,
	'options_values' => $scopeOperationList,
'value' => $vars['scope_operation'],
));






$data['external_video_label'] = $externalVideoLabel;
$data['external_video_input'] = new \Twig\Markup($externalVideoInput, 'UTF-8');

$data['external_video_type'] = new \Twig\Markup($videoType, 'UTF-8');


$data['descriptive_image_label'] = $descriptiveImageLabel;
$data['descriptive_image_input'] = new \Twig\Markup($descriptiveImageInput, 'UTF-8');


$data['scope_label'] = $scopeLabel;
$data['scope_input'] = new \Twig\Markup($scopeInput, 'UTF-8');




echo $twig->render('forms/add-proposal.html.twig', 
        [
            'data' => $data,
        ]);*/