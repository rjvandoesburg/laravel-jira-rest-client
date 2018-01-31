<?php

return [

    'host' => env('JIRA_HOST'),

    'default_auth' => env('JIRA_AUTHENTICATION', 'basic'),

    'auth' => [
        'basic' => [
            'username' => env('JIRA_USER'),
            'password' => env('JIRA_PASS'),
        ],
        'oauth' => [
            'consumer_key' => env('JIRA_CONSUMER_KEY', ''),
            'consumer_secret' => env('JIRA_CONSUMER_SECRET', ''),
            'private_key' => env('JIRA_PRIVATE_KEY', ''),
            'private_key_passphrase' => env('JIRA_PRIVATE_KEY_PASSPHRASE', '')
        ]
    ],

    'log_level' => env('JIRA_LOG_LEVEL', 'WARNING'),

    'client_options' => [
        'auth' => \Atlassian\JiraRest\Requests\Middleware\BasicAuthMiddleware::class,
    ],

    // List of custom fields defined in Jira
    'customfields' => [],

    'session' => [
        'name' => 'jira_session',
        'duration' => 3600
    ]
];