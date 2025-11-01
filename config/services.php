<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'github' => [
        'client_id' => env('GITHUB_CLIENT_ID', 'YOUR_GITHUB_API'), //Github API
        'client_secret' => env('GITHUB_CLIENT_SECRET', 'YOUR_GITHUB_SECRET'), //Github Secret
        'redirect' => env('GITHUB_REDIRECT_URI', env('APP_URL') . '/login/github/callback'),
     ],
     'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID', 'YOUR_GOOGLE_API'), //Google API
        'client_secret' => env('GOOGLE_CLIENT_SECRET', 'YOUR_GOOGLE_SECRET'), //Google Secret
        'redirect' => env('GOOGLE_REDIRECT_URI', env('APP_URL') . '/login/google/callback'),
     ],
     'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID', 'YOUR_FACEBOOK_API'), //Facebook API
        'client_secret' => env('FACEBOOK_CLIENT_SECRET', 'YOUR_FACEBOK_SECRET'), //Facebook Secret
        'redirect' => env('FACEBOOK_REDIRECT_URI', env('APP_URL') . '/login/facebook/callback'),
     ],

    /*
    |--------------------------------------------------------------------------
    | Google Analytics & SEO Services
    |--------------------------------------------------------------------------
    */
    'google_analytics_id' => env('GOOGLE_ANALYTICS_ID', 'G-J8C3Z5FSDB'),
    'google_tag_manager_id' => env('GOOGLE_TAG_MANAGER_ID', 'GTM-KK8KT37D'),

];
