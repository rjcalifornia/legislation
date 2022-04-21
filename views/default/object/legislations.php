<?php
use Carbon\Carbon;
use Elgg\Legislations\ElggUtils;

$full = elgg_extract('full_view', $vars, FALSE);
$entity = elgg_extract('entity', $vars, FALSE);
$site_url = elgg_get_site_url();
$currentDate = Carbon::now();


if (!$entity) {
	return;
}

$legislationDraft = null;

$twig = elgg_legislation_twig();

$comments_link = '';

$owner = $entity->getOwnerEntity();
$owner_icon = elgg_view_entity_icon($owner, 'tiny');
$categories = elgg_view('output/categories', $vars);

$vars['owner_url'] = "legislations/owner/$owner->username";
$by_line = elgg_view('page/elements/by_line', $vars);

$subtitle = "$by_line $comments_link $categories";

$metadata = '';
if (!elgg_in_context('widgets')) {
	// only show entity menu outside of widgets
	$metadata = elgg_view_menu('entity', array(
		'entity' => $vars['entity'],
		'handler' => 'legislations',
		'sort_by' => 'priority',
		'class' => 'elgg-menu-hz',
	));
}

$single =  get_entity($entity->guid);
if ($full) {
    
    $endDate = Carbon::parse($single->end_date);

    $deadline = $currentDate->greaterThan($endDate);
    
    if($deadline == true){
        $responses = elgg_view_comments($entity, false);
    }else{
        $responses = elgg_view_comments($entity, true);
    }

    $tags = $single->tags;
    
    $getDraft = elgg_get_entities(array(
        'type' => 'object',
        'subtype' => 'legislation_draft',        
        'container_guid' => $entity->guid,	
        'limit' => 1,
        'no_results' => elgg_echo("file:none"),
        'preload_owners' => true,
        'preload_containers' => true,
        'distinct' => false,
    ));

    $legislationDraft = getLegislationFiles($getDraft);


    $getDocumentation = elgg_get_entities(array(
        'type' => 'object',
        'subtype' => 'additional_documentation',        
        'container_guid' => $entity->guid,	
        'limit' => 5,
        'no_results' => elgg_echo("file:none"),
        'preload_owners' => true,
        'preload_containers' => true,
        'distinct' => false,
    ));

    $additionalDocumentation = getLegislationFiles($getDocumentation);

    
   // var_dump($additionalDocumentation);
    /*

    $descriptiveImage = elgg_get_entities(array(
        'type' => 'object',
        'subtype' => 'proposals_descriptive_image',        
        'container_guid' => $proposals->guid,	
        'limit' => 1,
        'no_results' => elgg_echo("file:none"),
        'preload_owners' => true,
        'preload_containers' => true,
        'distinct' => false,
    ));

    if(!empty($descriptiveImage)){
        $descriptiveImageUrl = elgg_get_download_url($descriptiveImage[0]);
        $descriptiveImageFilename = $descriptiveImage[0]->title;

        $proposalImage = ['url'=> $descriptiveImageUrl, 'filename' => $descriptiveImageFilename];
    }
        foreach ($proposalDocuments as $prDoc) {
            $document = get_entity($prDoc->guid);
            $documentUrl = elgg_get_download_url($document);

            $getDocuments[] = ['filename' => $document->title, 'url' => $documentUrl];
        
        }*/
    $admin = elgg_is_admin_logged_in();
 
    

    //var_dump($single->selected);
    $data['admin'] = $admin;
   // $data['select_proposal'] = new \Twig\Markup($selectProposal, 'UTF-8');
    $data['legislation'] = $single->toObject();
    $data['summary'] =  $single->summary;
    $data['start_date'] =  $single->start_date;
    $data['end_date'] =  $single->end_date;
    $data['legislation_draft'] = $legislationDraft;
    $data['additional_documentation'] = $additionalDocumentation;
    $data['tags'] = $tags;
    $data['process_code'] = $single->process_code;
    $data['site_url'] = $site_url;
    $data['deadline'] = $deadline;
    $data['sustainable_goals'] = $entity->goals;
    $data['banner_image'] = ElggUtils::getSingleFile('legislation_banner', $entity);
    $data['responses'] = new \Twig\Markup($responses, 'UTF-8');

    

    echo $twig->render('legislation/pages/view.html.twig', 
    [
        'data' => $data,
    ]);
} else {
	// brief view

	$params = [
		'content' => $entity->getExcerpt(),
		'icon' => true,
	];
	$params = $params + $vars;

    $menu = elgg_view_menu('entity', [
        'entity' => $entity,
        'handler' => elgg_extract('handler', $vars),
        'prepare_dropdown' => true,
    ]);

    $likes = elgg_view_menu('social', [
        'entity' => $entity,
        'handler' => elgg_extract('handler', $vars),
        'class' => 'elgg-menu-hz',
    ]);

    $data['banner_image'] = ElggUtils::getSingleFile('legislation_banner', $entity);
    
	//echo elgg_view('object/elements/summary', $params);
    $data['entity'] = $single->toObject();
    $data['site_url'] = $site_url;
    $data['excerpt'] = $entity->getExcerpt();
    $data['start_date'] = Carbon::parse($entity->start_date);
    $data['end_date'] = Carbon::parse($entity->end_date);
    $data['tags'] = $entity->tags;
    $data['menu'] = new \Twig\Markup($menu, 'UTF-8');
    $data['likes'] = new \Twig\Markup($likes, 'UTF-8');

    //var_dump( $single->toObject());
    echo $twig->render('legislation/elements/summary.html.twig',  [ 
        'data' => $data, 
        
    ]);

}