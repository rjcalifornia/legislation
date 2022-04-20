<?php

require_once(__DIR__ . '/lib/functions.php');

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();


return [

    'entities' =>[
        
                    //Declare Legislations Entity
                    [
                        'type' => 'object',
                        'subtype' => 'legislations',
                        'class' => 'ElggLegislations',
                        'capabilities' => [
                            'commentable' => true,
                            'searchable' => true,
                            'likable' => true,
                        ],
                    ],

                    //Declarar entity de los documentos
                    [
                        'type' => 'object',
                        'subtype' => 'legislation_draft',
                        'class' => 'LegislationDraft',
                        'searchable' => false,
                    ],
                    //Declarar entity de los documentos
                    [
                        'type' => 'object',
                        'subtype' => 'additional_documentation',
                        'class' => 'AdditionalDocumentation',
                        'searchable' => false,
                    ],
                    //Banner image entity
                    [
                        'type' => 'object',
                        'subtype' => 'legislation_banner',
                        'class' => 'LegislationBanner',
                        'searchable' => false,
                    ],
                ],
                
    //Acciones (Guardar la propuesta, marcar designada, etc)
    'actions' => [
        'legislation/save' => [],
    ],

    //Rutas del plugin (Todos, Ver, Editar)
    'routes' => [
        
        //Ruta necesaria para el link del menu principal
        'default:object:legislations' => [
			'path' => '/legislations',
			'resource' => 'legislations/all',
		],

        //Ruta para todas las propuestas
        'collection:object:legislations:all' =>[
            'path' => '/legislations/all',
            'resource' => 'legislations/all'
        ],

        //Ruta para agregar una nueva propuesta
        'add:object:legislations' => [
			'path' => '/legislations/add/{guid}',
			'resource' => 'legislations/add',
			'middleware' => [
				\Elgg\Router\Middleware\Gatekeeper::class,
			],
		],

        //Ver la propuesta que se ha publicado
        'view:object:legislations' => [
			'path' => '/legislations/view/{guid}/{title?}',
			'resource' => 'legislations/view',
		],

        //Editar la propuesta
        'edit:object:legislations' => [
			'path' => '/legislations/edit/{guid}',
			'resource' => 'legislations/edit',
			'middleware' => [
				\Elgg\Router\Middleware\Gatekeeper::class,
			],
		],

        //Ver propuestas seleccionadas
        'selected:object:legislations' => [
			'path' => '/legislations/selected',
			'resource' => 'legislations/selected',
			
		],

    ],




    
    'view_extensions' => [
        'elgg.css' => [
			'custom/legislations/sidebar.css' => [],
		],
    ],

    'hooks' =>[
         //Add plugin menu
         'register' =>[
            
            //Register the site menu. It is located in the folder /Elgg/Legistations/Menus/Site.php
            'menu:site' => [
                'Elgg\Legislations\Menus\Site::register' => [],
            ],
            'menu:title:object:legislations' => [
                \Elgg\Notifications\RegisterSubscriptionMenuItemsHandler::class => [],
            ],
        ],
    ],

];