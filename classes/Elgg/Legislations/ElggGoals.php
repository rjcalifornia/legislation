<?php


namespace Elgg\Legislations;


class ElggGoals{

    public function getGoals(){  
        $path = __DIR__ . '/../../../sdg.json';
        $goals = json_decode(file_get_contents($path), true);
        return $goals;
         // return 'test';
    
    }
}