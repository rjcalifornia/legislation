<?php

use Ramsey\Uuid\Uuid;
use Elgg\Legislations\ElggUtils;

$title = get_input('title');
$startDate = get_input('start_date');
$endDate = get_input('end_date');
$summary = get_input('summary');
$status = get_input('status');
$description = get_input('description');
$access_id = get_input('access_id');
$tags = get_input('tags');
$guid = get_input('guid');
$container = (int)get_input('container_guid');
$tagarray = string_to_tag_array($tags);
$goals = get_input('legislation_sdg');
$uuid = Uuid::uuid4();
$process_code = $_ENV['PROCESS_IDENTIFICATION'] . substr($uuid, 0, 12);
$newProcess = true;

$draft = elgg_get_uploaded_files('project_draft');
$banner = elgg_get_uploaded_files('project_banner');




if ($guid) {
    $entity = get_entity($guid);
    $newProcess = false;
}else{
    
    $entity = new ElggLegislations;
    $entity->process_code = $process_code;
    ElggUtils::verifyDraft($draft);
    
    
} 
    $entity->title = $title;
    $entity->summary = $summary;
    $entity->description = $description;
    $entity->start_date = $startDate;
    $entity->end_date = $endDate;

    $entity->access_id = $access_id;
    $entity->tags = $tagarray;
    $entity->comments_on = 'On';
    $entity->status = $status;
    

    if($goals){
        $goalsArray = string_to_tag_array($goals);
        $entity->goals= $goalsArray;
    }
   


/*

$descriptiveImage = elgg_get_uploaded_file('descriptive_image');
if ($descriptiveImage != null) {
    $media = new ElggFile();
        $media->owner_guid = elgg_get_logged_in_user_guid();
        //$media->content = 'video';
        $media->container_guid = $proposalsEntity->getGUID();
        if ($media->acceptUploadedFile($descriptiveImage)) {
                $media->save();
        }
}*/

    $guid = $entity->save();

    if ($draft) {
        $uploadedDraft = ElggUtils::validateDraft($draft);
        ElggUtils::uploadFile(new LegislationDraft(),$entity, $uploadedDraft);  
    }
    

    if ($banner) {
        $uploadedBanner = ElggUtils::validateDraft($banner);
        ElggUtils::uploadFile(new LegislationBanner(),$entity, $uploadedBanner);  
    }
    
  
    $additionalDocumentation = elgg_get_uploaded_files('additional_documentation');
    foreach($additionalDocumentation as $ad){
            ElggUtils::uploadFile(new AdditionalDocumentation(),$entity, $ad);  
    }

 /**** 
    $descriptiveImage = elgg_get_uploaded_files('descriptive_image');

    
    if ($descriptiveImage) {
    $uploadedImage = array_shift($descriptiveImage);
    if (!$uploadedImage->isValid()) {
            $error = elgg_get_friendly_upload_error($uploadedImage->getError());
            register_error($error);
            forward(REFERER);
    }
    }

    if($uploadedImage){
        $media =  new ProposalFeatured();
        $media->title = $media->getFilename();
        $media->container_guid = $proposalsEntity->getGUID();
        $media->access_id = 2;
        if ($media->acceptUploadedFile($uploadedImage)) {
        $media->save();
        }
    }
    

**********/

    if($newProcess == true){
        elgg_create_river_item([
            'view' => 'river/object/legislation/create',
            'action_type' => 'create',
            'subject_guid' => $entity->owner_guid,
            'object_guid' => $entity->getGUID(),
        ]);
    }
    if ($guid) {
        system_message("The legislation project was published.");
        forward('legislations');
     } else {
        register_error("There was a problem. Data could not be saved.");
        forward(REFERER); // REFERER is a global variable that defines the previous page
     }

