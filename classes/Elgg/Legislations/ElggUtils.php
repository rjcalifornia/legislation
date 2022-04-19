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
}