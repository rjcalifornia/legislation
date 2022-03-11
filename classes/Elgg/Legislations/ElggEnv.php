<?php


namespace Elgg\Legislations;
use Dotenv\Dotenv;

class ElggEnv{

    public function load(){        
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../../');
        $dotenv->load();
       // return 'test';
    
    }
}