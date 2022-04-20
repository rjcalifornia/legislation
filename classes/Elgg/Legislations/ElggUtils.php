<?php


namespace Elgg\Legislations;


class ElggUtils{

    public function verifyDraft($draft){  
        if(empty($draft)){
            register_error("Please, select a draft legislation project");
            forward(REFERER);
        }
    
    }

    public function validateDraft($draft){
        $uploadedDraft =  array_shift($draft);
            if (!$uploadedDraft->isValid()) {
                    $error = elgg_get_friendly_upload_error($uploadedDraft->getError());
                    register_error($error);
                    forward(REFERER);
                }
        return $uploadedDraft;
    }

    public function uploadFile($file, $entity, $uploadedDraft){

        if($uploadedDraft) {
            $file->title = $file->getFilename();
            $file->container_guid = $entity->getGUID();
            $file->access_id = 2;
            if ($file->acceptUploadedFile($uploadedDraft)) {
                $file->save();
            }
        }
    }

    public function getSingleFile($subtype, $entity){

        $fileUrl = null;

        $getFile = elgg_get_entities(array(
            'type' => 'object',
            'subtype' => $subtype,        
            'container_guid' => $entity->guid,	
            'limit' => 1,
            'no_results' => elgg_echo("file:none"),
            'preload_owners' => true,
            'preload_containers' => true,
            'distinct' => false,
        ));
     
        foreach ($getFile as $file) {
            $img = get_entity($file->guid);
            $fileUrl = elgg_get_download_url($img);
            //$fileDetails = ['filename' => $entity->title, 'url' => $fileUrl];
            //$files[] = $fileDetails;
        }
        return $fileUrl;

    }
}