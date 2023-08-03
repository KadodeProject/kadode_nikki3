<?php

declare(strict_types=1);

return [
    'collections' => [
        'default' => [
            'info'        => [
                'title'       => 'kadode_nikki_api',
                'description' => 'かどで日記のバックエンドAPIのOpenAPI',
                'version'     => '1.0.0',
                'contact'     => [],
            ],

            'servers'     => [
                [
                    'url'         => env('APP_URL'),
                    'description' => '環境変数に応じて適切なURLに置き換え',
                    'variables'   => [],
                ],
            ],

            'tags'        => [
                // [
                //    'name' => 'user',
                //    'description' => 'Application users',
                // ],
            ],

            'security'    => [
                // GoldSpecDigital\ObjectOrientedOAS\Objects\SecurityRequirement::create()->securityScheme('JWT'),
            ],

            // Non standard attributes used by code/doc generation tools can be added here
            'extensions'  => [
                // 'x-tagGroups' => [
                //     [
                //         'name' => 'General',
                //         'tags' => [
                //             'user',
                //         ],
                //     ],
                // ],
            ],

            // Route for exposing specification.
            // Leave uri null to disable.
            'route'       => [
                'uri'        => '/openapi',
                'middleware' => [],
            ],

            // Register custom middlewares for different objects.
            'middlewares' => [
                'paths'      => [],
                'components' => [],
            ],
        ],
    ],

    // Directories to use for locating OpenAPI object definitions.
    'locations'   => [
        'callbacks'        => [
            app_path('OpenApi/Callbacks'),
        ],

        'request_bodies'   => [
            app_path('OpenApi/RequestBodies'),
        ],

        'responses'        => [
            app_path('OpenApi/Responses'),
        ],

        'schemas'          => [
            app_path('OpenApi/Schemas'),
        ],

        'security_schemes' => [
            app_path('OpenApi/SecuritySchemes'),
        ],
    ],
];
